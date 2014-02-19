<?php
namespace ZendServerWebApi\Model;

use ZendServerWebApi\Model\ApiKey;
use ZendServerWebApi\Model\ZendServer;
/**
 * Model for api target
 * 
 * Api target is a combination of a target Zend Server to request
 * and an Api key to use/
 */
class ApiTarget
{
	/**
	 * Api Key
	 * 
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
	 * Set targtet configuration
	 * 
	 * @param array $targetConfig
	 */
	public function setConfig($targetConfig)
	{
		$this->apiKey = new ApiKey($targetConfig['zskey'], $targetConfig['zssecret']);
		$this->zendServer = new ZendServer($targetConfig['zsurl'],$targetConfig['zsversion']);
	}
	
	/**
	 * Get api key
	 * 
	 * @return ApiKey
	 */
	public function getApiKey() {
		return $this->apiKey;
	}

	/**
	 * Get Zend server
	 * 
	 * @return ZendServer
	 */
	public function getZendServer() {
		return $this->zendServer;
	}

	/**
	 * Get target name
	 * 
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}
}