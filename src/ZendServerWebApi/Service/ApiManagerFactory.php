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
    	$targetManager = current($serviceLocator->get('target_manager'));
    	$target = $targetManager->getTarget('default');
    	$apiMethodsConfig = $serviceLocator->get('apiMethodsConfig');
        $apiManager = new ApiManager();
    	$apiManager->setTarget($target);
    	$apiManager->setApiMethodsConfig($apiMethodsConfig);
        return $apiManager;
    }
}
