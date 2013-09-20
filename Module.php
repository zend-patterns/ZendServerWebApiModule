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
use Zend\Config\Reader\Ini as ConfigReader;
use Zend\Http\Response as HttpResponse;

class Module implements ConfigProviderInterface, AutoloaderProviderInterface, 
        BootstrapListenerInterface, ConsoleUsageProviderInterface, 
        ConsoleBannerProviderInterface
{

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
                        $router['options']['route'] .= ' [--target=] [--zsurl=] [--zskey=] [--zssecret=]';
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
        $eventManager = $event->getApplication()->getEventManager();
        $eventManager->attach(MvcEvent::EVENT_ROUTE, 
                array(
                        $this,
                        'postRoute'
                ), - 2);
        
        $eventManager->attach(MvcEvent::EVENT_DISPATCH, 
                array(
                        $this,
                        'preDispatch'
                ), 100);
        
        $eventManager->attach(MvcEvent::EVENT_FINISH, 
                array(
                        $this,
                        'preFinish'
                ), 100);
    }

    /**
     * Manage Array-like parameters
     *
     * @param MvcEvent $event            
     */
    public function postRoute (MvcEvent $event)
    {
        $match = $event->getRouteMatch();
        if (! $match) {
            return;
        }
        // normalization of the arguments
        $config = $event->getApplication()
            ->getServiceManager()
            ->get('config');
        $routeName = $match->getMatchedRouteName();
        if (isset(
                $config['console']['router']['routes'][$routeName]['options']['arrays'])) {
            foreach ($config['console']['router']['routes'][$routeName]['options']['arrays'] as $arrayParam) {
                if ($value = $match->getParam($arrayParam)) {
                    $data = array();
                    // @todo: add exception if the value is not a valid query
                    // string
                    parse_str($value, $data); // the values is provided like
                                              // a query string
                    $match->setParam($arrayParam, $data);
                }
            }
        }
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
        if (! $match)
            return;
        $serviceManager = $event->getApplication()->getServiceManager();
        $appConfig = $serviceManager->get('config');
        //$targetConfig = array();
        if ($match->getParam('no-target')) return;
        // Set a default target
        if (isset($appConfig['zsapi']['default_target']))
            $targetConfig = $appConfig['zsapi']['default_target'];
        // Manage named target (config file defined target)
        $target = $match->getParam('target');
        if ($target) {
            try {
                $reader = new ConfigReader();
                $data = $reader->fromFile($appConfig['zsapi']['file']);
                $targetConfig = $data[$target];
            } catch (\Zend\Config\Exception $ex) {
                throw new \Zend\Console\Exception\RuntimeException(
                        'Make sure that you have set your target first. \n
                                                                This can be done with ' .
                                 __FILE__ .
                                 ' add-target --target=<UniqueName> --zsurl=http://localhost:10081/ZendServer --zskey= --zssecret=');
            }
        }         // Command line overrided target
        else {
            if (! $targetConfig && ! ($match->getParam('zskey') || $match->getParam('zssecret') ||
                     $match->getParam('zsurl'))) {
                throw new \Zend\Console\Exception\RuntimeException(
                        'Specify either a --target= parameter or --zsurl=http://localhost:10081/ZendServer --zskey= --zssecret=');
            }
            foreach (array(
                    'zsurl',
                    'zskey',
                    'zssecret'
            ) as $key) {
                if ( ! $match->getParam($key)) continue;
                $targetConfig[$key] = $match->getParam($key);
            }
        }
        $zendServerClient = new Model\Http\Client(null, 
                $appConfig['zsapi']['client']);
        $serviceManager->setService('zendServerClient', $zendServerClient);
        $defaultApiKey = new ApiKey($targetConfig['zskey'], 
                $targetConfig['zssecret']);
        $serviceManager->setService('defaultApiKey', $defaultApiKey);
        $targetServer = new ZendServer($targetConfig, $appConfig['min-zsversion']);
        $serviceManager->setService('targetZendServer', $targetServer);
    }

    /**
     *
     * @param MvcEvent $event            
     */
    public function preFinish (MvcEvent $event)
    {
        $response = $event->getResponse();
        if ($response instanceof HttpResponse) {
            $response->setContent($response->getBody());
        }
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Zend\ModuleManager\Feature\ConsoleUsageProviderInterface::getConsoleUsage()
     */
    public function getConsoleUsage (Console $console)
    {
        $config = $this->getConfig();
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
