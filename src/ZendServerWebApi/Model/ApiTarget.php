<?php
namespace ZendServerWebApi\Model;

use ZendServerWebApi\Model\ApiKey;
use ZendServerWebApi\Model\ZendServer;

class ApiTarget
{
	/**
	 * Api Key
	 * @var ApiKey
	 */
	protected $apiKey;
	
	/**
	 * Zend Server
	 * 
	 * @var Zend Server
	 */
	protected $zendServer;
	
	/**
	 * Target name
	 * 
	 * @var string
	 */
	protected $name;
	
	/**
	 * Construtcor
	 * 
	 * @param string $name
	 * @param array $targetConfig
	 */
	public function __construct($name, $targetConfig = null)
	{
		$this->name = $name;
		if ($targetConfig) $this->setConfig($targetConfig);
	}
	
	/**
	 * Set targte configuration
	 * 
	 * @param array $targetConfig
	 */
	public function setConfig($targetConfig)
	{
		$this->apiKey = new ApiKey($targetConfig['zskey'], $targetConfig['zssecret']);
		$this->zendServer = ZendServer::factory($targetConfig);
	}
	
	/**
	 * @return the $apiKey
	 */
	public function getApiKey() {
		return $this->apiKey;
	}

	/**
	 * @return the $zendServer
	 */
	public function getZendServer() {
		return $this->zendServer;
	}

	/**
	 * @return the $name
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @param string $name
	 */
	public function setName($name) {
		$this->name = $name;
	}

}