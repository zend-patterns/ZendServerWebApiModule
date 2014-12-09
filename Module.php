<?php
namespace ZendServerWebApi;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\BootstrapListenerInterface;
use Zend\Mvc\MvcEvent;
use Zend\EventManager\EventInterface;
use ZendServerWebApi\Model\ApiKey;
use ZendServerWebApi\Model\ZendServer;
use Zend\ModuleManager\Feature\ConsoleUsageProviderInterface;
use Zend\Console\Adapter\AdapterInterface as Console;
use Zend\ModuleManager\Feature\ConsoleBannerProviderInterface;
use Zend\Stdlib\ArrayObject;

class Module implements ConfigProviderInterface, AutoloaderProviderInterface,
        BootstrapListenerInterface, ConsoleUsageProviderInterface,
        ConsoleBannerProviderInterface
{
    /**
     * The configuration service
     * @var array
     */
    protected $config;

    /**
     * (non-PHPdoc)
     *
     * @see \Zend\ModuleManager\Feature\ConfigProviderInterface::getConfig()
     */
    public function getConfig ()
    {
        $mainConfig = include __DIR__ . '/config/zendserverwebapi.config.php';
        $mainConfig['min-zsversion'] = array();
        $apiConf = array();
        foreach (scandir(__DIR__ . '/config/api') as $confFile) {
            if ($confFile == '.' || $confFile == '..')
                continue;
            $tmp = preg_split('@-@', $confFile);
            $apiVersion = preg_replace('@\.config\.php@', '', $tmp[1]);
            $apiConf[$apiVersion] = include __DIR__ . '/config/api/' . $confFile;
            $mainConfig['min-zsversion'][$apiVersion] = $apiConf[$apiVersion]['min-zsversion'];
            unset($apiConf[$apiVersion]['min-zsversion']);
        }
        ksort($apiConf);
        foreach ($apiConf as $version => $config) {
            if (isset($config['console']['router']['routes'])) {
                foreach ($config['console']['router']['routes'] as &$router) {
                    if (! isset($router['options']['no-target'])) {
                        $router['options']['route'] .= ' [--target=] [--zsurl=] [--zskey=] [--zssecret=] [--zsversion=] [--http=]';
                        $router['options']['arrays'][] = 'http';
                    }
                    if (isset($router['options']['async'])) {
                        $router['options']['route'] .= ' [--wait] ';
                        $router['options']['info'][] = array('--wait', 'This operation is asynchronous. When the "wait" option is added the client will wait  until the operation really finishes on all servers.');
                    }
                    if(!isset($router['options']['no-format'])) {
                        $router['options']['route'] .= ' [--output-format=] ';
                        $router['options']['info'][] = array('--output-format', 'Output format. Default is "xml", but you can use json or kv(for key-value)');
                    }
                }
            }
            $mainConfig = array_merge_recursive($mainConfig, $config);
        }

        return $mainConfig;
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Zend\ModuleManager\Feature\AutoloaderProviderInterface::getAutoloaderConfig()
     */
    public function getAutoloaderConfig ()
    {
        return array(
                'Zend\Loader\StandardAutoloader' => array(
                        'namespaces' => array(
                                'ZendServerWebApi' => __DIR__ . '/src/ZendServerWebApi'
                        )
                )
        );
    }

    /**
     * Attach the module to the main MVC event
     *
     * @param MvcEvent $e
     */
    public function onBootstrap (EventInterface $event)
    {
        $serviceManager = $event->getApplication()->getServiceManager();
        $this->config = $serviceManager->get('config');
        $eventManager = $event->getApplication()->getEventManager();
        $eventManager->attach(MvcEvent::EVENT_DISPATCH,
                array(
                        $this,
                        'preDispatch'
                ), 100);

        $serviceManager->setService('targetConfig', new ArrayObject($this->config['zsapi']['target']));
    }

    /**
     * Manage API Key usage and define HTTP client
     *
     * @param  MvcEvent                                 $event
     * @throws \Zend\Console\Exception\RuntimeException
     */
    public function preDispatch (MvcEvent $event)
    {
        $match = $event->getRouteMatch();
        if (! $match) {
            return;
        }
        $serviceManager = $event->getApplication()->getServiceManager();
        $config = $serviceManager->get('config');
        $targetConfig = $serviceManager->get('targetConfig');
        $httpConfig = $config['zsapi']['client'];
        if(!empty($targetConfig['http'])) {
        	foreach($targetConfig['http'] as $k=>$v) {
        		$httpConfig[$k]=$v;
        	}
        }
        $zendServerClient = new Model\Http\Client(null, $httpConfig);
        $serviceManager->setService('zendServerClient', $zendServerClient);
        $defaultApiKey = new ApiKey($targetConfig['zskey'], $targetConfig['zssecret']);
        $serviceManager->setService('defaultApiKey', $defaultApiKey);
        $apiVersion  = $config['min-zsversion'];
        $detectApiVersion = false;
        if(empty($targetConfig['zsversion'])) {
            $targetConfig['zsversion'] = array_shift($config['min-zsversion']);
            $detectApiVersion = true;
        }
        
        ZendServer::setApiVersionConf($config['min-zsversion']);
        $targetServer = ZendServer::factory($targetConfig);
        $serviceManager->setService('targetZendServer', $targetServer);
        
        if($detectApiVersion) {
            // auto-detect the version
            $apiManager = $serviceManager->get('zend_server_api');
            $versions = $apiManager->getSupportedVersions();
            $apiVersion = $versions[2][0];
            $targetServer->setApiVersion($apiVersion);
        }
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Zend\ModuleManager\Feature\ConsoleUsageProviderInterface::getConsoleUsage()
     */
    public function getConsoleUsage (Console $console)
    {
        $config = $this->config;
        $command = @$_SERVER['argv'][1];
        $routes = $config['console']['router']['routes'];
        if (isset($routes[$command])) {
            $routes = array(
                    $command => $routes[$command]
            );
        } else {
        	$parts = explode(':',$command);
        	$noCommandFound = false;
        	if(count($parts)!=2) {
        		$noCommandFound = true;
        	}
        	else if($parts[1]!='all') {
        		$foundRoutes = array();
        		foreach ($routes as $route) {
        			if(isset($route['options']['group']) && $route['options']['group'] == $parts[1]) {
        				$foundRoutes[] = $route; 
        			}
        		}
        		if(empty($foundRoutes)) {
        			$noCommandFound = true;
        		}	
        		else {
        			$routes = $foundRoutes;
        		}
        	}
        	
        	if($noCommandFound) {
        		// go through the commands and get their groups
        		$groups = array();
        		foreach ($routes as $route) {
        			if(!isset($route['options']['group'])) {
        				continue;
        			}
        			$group = $route['options']['group'];
        			$groups[$group] = 1;
        		}
        		
        		$usage = array();
        		$usage[] = "The following group of command are available:";
        		foreach($groups as $group=>$tmp) {
        			if(empty($group)) {
        				continue;
        			}
        			$usage[]=array('command:'.$group, ucfirst($group));
        		}
        		$usage[]=array('command:all', 'For all available commands');
        		$usage[]='Below is an example how to get the list of commands in a group';
        		$usage[]=array('Example:', $_SERVER['PHP_SELF'].' command:'.$group);
        		$usage[]=array('', 'Will list all commands in the group "'.ucfirst($group).'".');
        		$usage[]='If you want to see all commands in all groups type:';
        		$usage[]=array(' ', $_SERVER['PHP_SELF'].' command:all');
        		
        		return $usage; 
        	}
        }
        
        foreach ($routes as $route) {
            $command = $route['options']['route'];
            $usage[] = "* $command";
            if (isset($route['options']['info'])) {
                $usage[] = '';
                if (! is_array($route['options']['info'])) {
                    $usage[] = $route['options']['info'];
                } else {
                    foreach ($route['options']['info'] as $value) {
                        $usage[] = $value;
                    }
                }
            } elseif (isset($route['options']['arrays'])) {
                 $usage[] = sprintf("\tThe following options accept multiple values: %s",implode(',',$route['options']['arrays']));
                 $usage[] = "\tYou can provide multiple values either with comma separated values or like HTTP query string.\n".
                              "\tEx: Comma separated: --extensions='mysql,gd,iconv' \n".
                              "\tEx: Query string: --userParams='APPLICAITON_ENV=develpment&user[x]=1&user[y]=2'";
            }
            $usage[]="-------------------------------------------------------------------";
        }

        return $usage;
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Zend\ModuleManager\Feature\ConsoleBannerProviderInterface::getConsoleBanner()
     */
    public function getConsoleBanner (Console $console)
    {
        return 'ZendServerWebApi Client version 1.2';
    }
}
