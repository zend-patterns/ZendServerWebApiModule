<?php
namespace ZendServerWebApi;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\BootstrapListenerInterface;
use Zend\Http\Client;
use Zend\Mvc\MvcEvent;
use Zend\EventManager\EventInterface;
use ZendServerWebApi\Model\ApiKey;
use ZendServerWebApi\Model\ZendServer;

class Module implements ConfigProviderInterface, AutoloaderProviderInterface, 
        BootstrapListenerInterface
{

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
                                __NAMESPACE__ => __DIR__ . '/src/' .
                                         __NAMESPACE__
                        )
                )
        );
    }

    /**
     *
     * @param MvcEvent $e            
     */
    public function onBootstrap (EventInterface $e)
    {
        $serviceManager = $e->getApplication()->getServiceManager();
        $config = $serviceManager->get('config');
        $zendServerClient = new Client(null, $config['zend_server_client']);
        $serviceManager->setService('zendServerClient', $zendServerClient);
        $defaultApiKey = new ApiKey($config['default_api_key']['name'], 
                $config['default_api_key']['key']);
        $serviceManager->setService('defaultApiKey', $defaultApiKey);
        $targetServer = new ZendServer($config['target_zend_server']);
        $serviceManager->setService('targetZendServer', $targetServer);
    }
}
