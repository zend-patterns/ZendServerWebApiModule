<?php
namespace ZendServerWebApi\Service;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use ZendServerWebApi\Model\ApiTargetManager;

/**
 * Target Manager Factory
 */
class TargetManagerFactory implements FactoryInterface
{

    /**
     * Create a Target manager
     *
     * @param  ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService (ServiceLocatorInterface $serviceLocator)
    {   
    	$config = $serviceLocator->get('config');
    	$targetConfig = $config['target_manager_config'];
    	$targetManager = new ApiTargetManager($targetConfig);
    	return array($targetManager);
    }
}
