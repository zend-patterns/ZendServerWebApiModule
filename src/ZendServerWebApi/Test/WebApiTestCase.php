<?php
namespace ZendServerWebApi\Test;


use Zend\Mvc\Service\ServiceManagerConfig;
use ZendServerWebApi\Model\Http\Client;
use ZendServerWebApi\Model\ApiManager;

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
		$target = current($this->serviceManager->get('target_manager'))->getTarget('default');
		$apiMethodsConfig = $this->serviceManager->get('apiMethodsConfig');
		$httpClientConfig = $configuration['api_http_client'];
		$zsclient = new $httpClientConfig['class']('',$httpClientConfig['config']);
		$this->apiManager = new ApiManager();
		$this->apiManager->setTarget($target);
		$this->apiManager->setApiMethodsConfig($apiMethodsConfig);
		$this->apiManager->setZendServerClient($zsclient);
        $this->setParams(__DIR__ . '/data/testparameters.php');
	}
	
	/**
	 * Check if the given response if a ApiResponse object
	 * @param unknown $response
	 */
	protected function isValidApiResponse($response)
	{
		$isValid = is_a($response, 'ZendServerWebApi\Model\Response\ApiResponse');
		if ( ! $isValid) $this->debugResponse($response);
		$this->assertTrue($isValid);
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