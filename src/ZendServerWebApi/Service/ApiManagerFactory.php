<?php
namespace ZendServerWebApi\Service;
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
     * @param  ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService (ServiceLocatorInterface $serviceLocator)
    {
        $apiManager = new ApiManager($serviceLocator);
        return $apiManager;
    }
}
