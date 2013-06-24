<?php
namespace ZendServerWebApi\Model\Service;
use Zend\ServiceManager\FactoryInterface;
use ZendServerWebApi\Model\ApiManager;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * API Manager Factory
 */
class ApiManagerFactory implements FactoryInterface
{

    /**
     * Create APIManager as a service
     *
     * @param ServiceLocatorInterface $serviceLocator            
     * @return mixed
     */
    public function createService (ServiceLocatorInterface $serviceLocator)
    {
        $apiKey = $serviceLocator->get('defaultApiKey');
        $server = $serviceLocator->get('targetZendServer');
        $client = $serviceLocator->get('zendserverclient');
        $apiConfig = $serviceLocator->get('config');
        $apiConfig = $apiConfig['console']['router']['routes'];
        $apiManager = new ApiManager($server, $apiKey, $client, $apiConfig);
        return $apiManager;
    }
}