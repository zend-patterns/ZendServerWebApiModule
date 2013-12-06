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
class LogFactory implements FactoryInterface
{

    /**
     * Create APIManager as a service
     *
     * @param  ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService (ServiceLocatorInterface $serviceLocator)
    {   
        $config = $serviceLocator->get('config');
        $log = new Logger();
        $logWriter = new Stream($config['zsapilog']['file']);
        $log->addWriter($logWriter);
        
        if(!empty($config['zsapilog']['priority'])) {
        	$filter = new Priority($config['zsapilog']['priority']);
        	$logWriter->addFilter($filter);
        }
        
        return $log;
    }
}
