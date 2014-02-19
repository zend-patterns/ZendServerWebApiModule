<?php
namespace ZendServerWebApi\Model;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\ServiceManager;
/**
 * Service locator to manage targets lists
 */
class ApiTargetManager implements ServiceLocatorAwareInterface
{
	/**
	 * Service locator
	 * 
	 * @var ServiceLocatorInterface
	 */
	protected $serviceLocator;
	
	/**
	 * (non-PHPdoc)
	 * @see \Zend\ServiceManager\ServiceLocatorAwareInterface::setServiceLocator()
	 */
    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
    	$this->serviceLocator = $serviceLocator;
    }

    /**
     * (non-PHPdoc)
     * @see \Zend\ServiceManager\ServiceLocatorAwareInterface::getServiceLocator()
     */
    public function getServiceLocator()
    {
    	if ($this->serviceLocator) return $this->serviceLocator;
    	$this->serviceLocator = new ServiceManager();
    	return $this->serviceLocator;
    }
    
    /**
     * Add a atrget to manager
     * 
     * @param string $name
     * @param array $targetConfig
     */
    public function addTarget($name,$targetConfig)
    {
    	$target = new ApiTarget($name,$targetConfig);
    	$this->getServiceLocator()->setService($name, $target);
    }
    
    /**
     * Get a Target
     * 
     * @param string $name
     * @return ApiTarget
     */
    public function getTarget($name)
    {
    	return $this->getServiceLocator()->get($name);
    }
    
    /**
     * Set Target Manager confug
     * 
     * @param array $targetManagerConfig
     */
    public function setConfig($targetManagerConfig)
    {
    	foreach ($targetManagerConfig as $name => $targetConfig) {
    		$this->addTarget($name, $targetConfig);
    	}
    }
    
    /**
     * Constructor
     * 
     * @param array $targetManagerConfig
     */
    public function __construct($targetManagerConfig = null)
    {
    	if ($targetManagerConfig) $this->setConfig($targetManagerConfig);
    }
}