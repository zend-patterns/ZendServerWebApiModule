<?php
namespace ZendServerWebApi\Test;


use Zend\Mvc\Service\ServiceManagerConfig;

abstract class WebApiTestCase extends \PHPUnit_Framework_TestCase
{
	/**
	 * Api Manager
	 * @var unknown
	 */
	protected $apiManager;
	
	/**
	 * Service manager
	 * @var unknown
	 */
	protected $serviceManager;
	
	/**
	 * test parameters
	 * 
	 * @var array
	 */
	protected $params = array();
	
	/**
	 * (non-PHPdoc)
	 * @see PHPUnit_Framework_TestCase::setUp()
	 */
	public function setUp()
	{
		$configuration = $this->getConfig();
		$smConfig = $configuration['service_manager'];
		$smConfig = new ServiceManagerConfig($smConfig);
		$this->serviceManager = new \Zend\ServiceManager\ServiceManager($smConfig);
		$this->serviceManager->setService('config', $configuration);
		$this->apiManager = $this->serviceManager->get('zend_server_api');
        $this->setParams(__DIR__ . '/data/testparameters.php');
	}
	
	/**
	 * Get configuration of the given service
	 * 
	 * @param string $service
	 */
	protected function getServiceConfig($service)
	{
		$apiConfiguration = $this->getConfig();
		return $apiConfiguration['console']['router']['routes'][$service];
	}
	
	/**
	 * Get whole configuration
	 * @return unknown
	 */
	protected function getConfig()
	{
		$apiConfigFileDir = __DIR__ .'/../../../config/api';
		$mainConfigFile = __DIR__ . '/zendserverwebapi.config.php';
		$apiConfiguration = new \ZendServerWebApi\Model\ApiConfigManager($apiConfigFileDir, $mainConfigFile);
		$apiConfiguration = $apiConfiguration->getConfig();
		return $apiConfiguration;
	}
	
	/**
	 * Check if the given response if a ApiResponse object
	 * @param unknown $response
	 */
	protected function isValidApiResponse($response)
	{
		$this->assertTrue(is_a($response, ApiResponse));
	}
	
	/**
	 * Return the Test directory
	 * @return string
	 */
	protected function getRootDir()
	{
		return __DIR__;
	}
	
	/**
	 * Set test parameter
	 * 
	 * @param stirng $file
	 */
	protected function setParams($file)
	{
		$this->params = include $file;
	}
	
	/**
	 * 
	 * @param unknown $name
	 * @param unknown $value
	 */
	protected function getParam($name)
	{
		return $this->params[$name];
	}
}