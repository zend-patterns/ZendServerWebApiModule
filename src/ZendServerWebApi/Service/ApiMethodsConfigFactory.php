<?php
namespace ZendServerWebApi\Service;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Log\Logger;
use Zend\Log\Writer\Stream;
use Zend\Log\Filter\Priority;

/**
 * API Manager Factory
 */
class ApiMethodsConfigFactory implements FactoryInterface
{

    /**
     * Create ApigConfig service
     *
     * @param  ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService (ServiceLocatorInterface $serviceLocator)
    {   
        $config = $serviceLocator->get('config');
        $apiMethodConfig = $config['console']['router']['routes'];
        return $apiMethodConfig;
    }
}
