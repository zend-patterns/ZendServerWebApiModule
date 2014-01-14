<?php
namespace ZendServerWebApi\Test;


use ZendServerWebApi\Model\ApiConfigManager;
use Zend\Mvc\Service\ServiceManagerConfig;
use ZendServerWebApi\Model\ApiKey;
abstract class WebApiTestCase extends \PHPUnit_Framework_TestCase
{
	protected $apiManager;
	
	/**
	 * Service manager
	 * @var unknown
	 */
	protected $serviceManager;
	
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
		$this->serviceManager->setService('targetConfig', new \ArrayObject($configuration['zsapi']['target']));
		$targetConfig = $this->serviceManager->get('targetConfig');
		$targetServer = \ZendServerWebApi\Model\ZendServer::factory($targetConfig);
		$this->serviceManager->setService('targetZendServer', $targetServer);
		$defaultApiKey = new ApiKey($targetConfig['zskey'], $targetConfig['zssecret']);
		$this->serviceManager->setService('defaultApiKey', $defaultApiKey);
		$httpConfig = $configuration['zsapi']['client'];
        if(!empty($targetConfig['http'])) {
        	foreach($targetConfig['http'] as $k=>$v) {
        		$httpConfig[$k]=$v;
        	}
        }
        $zendServerClient = new \ZendServerWebApi\Model\Http\Client(null, $httpConfig);
        $this->serviceManager->setService('zendServerClient', $zendServerClient);
	}
	
	/**
	 * Test that the service is reachable
	 */
	public function test_ServiceIsReachable()
	{
		$serviceName = get_called_class();
		$serviceName = str_replace('Test', '', $serviceName);
		$serviceName = current(array_reverse(explode( '\\',$serviceName)));
		$serviceName = lcfirst($serviceName);
		$config = $this->getServiceConfig($serviceName);
		$httpMethod = 'get';
		if (isset($config['options']['defaults']['apiMethod']))
			$httpMethod = $config['options']['defaults']['apiMethod'];
		$apiManager = $this->serviceManager->get('zend_server_api');
		$response = $apiManager->$serviceName();
		$this->assertFalse($response->isError());
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
}