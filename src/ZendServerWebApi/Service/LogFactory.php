<?php
namespace ZendServerWebApi\Service;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Log\Logger;
use Zend\Log\Writer\Stream;

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
        $client = $serviceLocator->get('zendserverclient');
        $config = $serviceLocator->get('config');
        $log = new Logger();
        $logWriter = new Stream($config['zsapilog']['file']);
        $log->addWriter($logWriter);
        return $log;
    }
}
