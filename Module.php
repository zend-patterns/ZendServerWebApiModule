<?php
namespace ZendServerWebApi;

use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\BootstrapListenerInterface;
use Zend\Mvc\MvcEvent;
use Zend\EventManager\EventInterface;
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
    	$apiConfigManager = new Model\ApiConfigManager(__DIR__ . '/config/api');
    	$routerConfig = $apiConfigManager->getRouterConfig();
    	return array_merge($mainConfig, $routerConfig);
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
    }


    /**
     * (non-PHPdoc)
     *
     * @see \Zend\ModuleManager\Feature\ConsoleUsageProviderInterface::getConsoleUsage()
     */
    public function getConsoleUsage (Console $console)
    {
    	
        $command = @$_SERVER['argv'][1];
        $routes = $this->config['console']['router']['routes'];
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
