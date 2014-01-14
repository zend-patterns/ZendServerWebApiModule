<?php
namespace ZendServerWebApi\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use ZendServerWebApi\Model\ApiManager;

/**
 * API Manager Factory
 */
class ApiManagerFactory implements FactoryInterface
{

    /**
     * Create APIManager as a service
     *
     * @param  ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService (ServiceLocatorInterface $serviceLocator)
    {   
        $apiManager = new ApiManager();
        $apiManager->setServiceLocator($serviceLocator);
        return $apiManager;
    }
}
