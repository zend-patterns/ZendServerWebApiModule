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
        $apiConf = array();
        foreach (scandir(__DIR__ . '/config/api') as $confFile) {
            if ($confFile == '.' || $confFile == '..')
                continue;
            $tmp = preg_split('@-@', $confFile);
            $apiVersion = preg_replace('@\.config\.php@', '', $tmp[1]);
            $apiConf[$apiVersion] = include __DIR__ . '/config/api/' . $confFile;
        }
        ksort($apiConf);
        foreach ($apiConf as $version => $config) {
            if (isset($config['console']['router']['routes'])) {
                foreach ($config['console']['router']['routes'] as &$router) {
                    if (! isset($router['options']['no-target'])) {
                        $router['options']['route'] .= ' [--target=] [--zsurl=] [--zskey=] [--zssecret=] [--zsversion=]';
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
        
        $serviceManager->setService('targetconfig', new ArrayObject($this->config['zsapi']['target']));
    }

    /**
     * Manage API Key usage and define HTTP client
     *
     * @param MvcEvent $event            
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
        $zendServerClient = new Model\Http\Client(null, $config['zsapi']['client']);
        $serviceManager->setService('zendServerClient', $zendServerClient);
        $defaultApiKey = new ApiKey($targetConfig['zskey'], $targetConfig['zssecret']);
        $serviceManager->setService('defaultApiKey', $defaultApiKey);
        $targetServer = new ZendServer($targetConfig);
        $serviceManager->setService('targetZendServer', $targetServer);
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
            $usage = array(
                    "The following commands are available:"
            );
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
            }
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
        return 'ZendServerWebApi Client version 1.0';
    }
}
