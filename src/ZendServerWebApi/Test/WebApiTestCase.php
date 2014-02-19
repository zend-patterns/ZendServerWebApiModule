<?php
namespace ZendServerWebApi\Test;


use Zend\Mvc\Service\ServiceManagerConfig;
use ZendServerWebApi\Model\Http\Client;

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
		$module = new \ZendServerWebApi\Module();
		$configuration = $module->getConfig();
		$smConfig = $configuration['service_manager'];
		$smConfig = new ServiceManagerConfig($smConfig);
		$this->serviceManager = new \Zend\ServiceManager\ServiceManager($smConfig);
		$this->serviceManager->setService('config', $configuration);
		$this->apiManager = $this->serviceManager->get('zend_server_api');
		$apiMethodsConfig = $this->serviceManager->get('apiMethodsConfig');
		$this->apiManager->setApiMethodsConfig($apiMethodsConfig);
		$targetManager = current($this->serviceManager->get('targetManager'));
		$this->apiManager->setTarget($targetManager->getTarget('default'));
		$client = new Client();
		$this->apiManager->setZendServerClient($client);
        $this->setParams(__DIR__ . '/data/testparameters.php');
	}
	
	/**
	 * Check if the given response if a ApiResponse object
	 * @param unknown $response
	 */
	protected function isValidApiResponse($response)
	{
		$this->assertTrue(is_a($response, 'ZendServerWebApi\Model\Response\ApiResponse'));
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
	 * Set test parameters
	 * 
	 * @param stirng $file
	 */
	protected function setParams($file)
	{
		$this->params = include $file;
	}
	
	/**
	 * Get test parameter
	 * 
	 * @param string $name
	 */
	protected function getParam($name)
	{
		return $this->params[$name];
	}
	
	/**
	 * Display response XML data
	 * @param ApiResponse $response
	 */
	protected function debugResponse($response)
	{
		var_dump($response->getHttpResponse()->getBody());
	}
}