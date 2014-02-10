<?php
namespace ZendServerWebApi\Model;

use Zend\XmlRpc\Value\String;
/**
 * Modelize a API method
 * 
 * The configuration of these instances are based on route definition
 *
 */

class ApiMethod
{
	/**
	 * Method name
	 * 
	 * @var string
	 */
	protected $name;
	
	/**
	 * Method group (Administration, Audit...)
	 * 
	 * @var String
	 */
	protected $group = 'none';
	
	/**
	 * HTTP Method
	 * 
	 * @var string
	 */
	protected $httpMethod = 'get';
	
	/**
	 * Method description
	 * 
	 * @var array
	 */
	protected $info = array();
	
	/**
	 * Minimal API version required to use the moethod
	 * 
	 * @var string
	 */
	protected $minVersion = "1.0";
	
	/**
	 * Controller in charge of the method
	 * 
	 * @var string
	 */
	protected $controllerName = 'webapi-api-controller';
	
	/**
	 * Controller action in charge of the method
	 * 
	 * @var unknown
	 */
	protected $controllerActionName;
	
	/**
	 * Method parameters definitions
	 * 
	 * @var array
	 */
	protected $paramDefinitions;
	
	/**
	 * Set method configuration
	 * 
	 * @param array $config
	 */
	public function setConfig($config)
	{
		if (isset($config['group'])) $this->group = $config['group'];
		if (isset($config['defaults']['controller']))
			$this->controllerName = $config['defaults']['controller'];
		if (isset($config['defaults']['action']))
			$this->controllerActionName = $config['defaults']['action'];
		if (isset($config['defaults']['apiMethod']))
			$this->httpMethod = $config['defaults']['apiMethod'];
		if (isset($config['info'])) $this->info = $config['info'];
		$parametersList = preg_split('@ @', $config['route']);
		$this->name = trim(array_shift($parametersList));
		foreach ($parametersList as $parameter)
		{
			$isRequired= false;
			$paramName = preg_replace('@[-=]@', '', $parameter);
			if (preg_match('@[\[\]]@',$paramName)) {
				$paramName = preg_replace('@[\[\]]@', '',$paramName);
				$isRequired = true;
			}
			$varType = ApiParameter::VAR_TYPE_STRING;
			if (isset($config['arrays']))
				if (in_array($paramName, $config['arrays'])) $varType = ApiParameter::VAR_TYPE_ARRAY;
			if (isset($config['files']))
				if (in_array($paramName, $config['files'])) $varType = ApiParameter::VAR_TYPE_FILE;
			$this->paramDefinitions[$paramName] = new ApiParameter($paramName, $varType, $isRequired);
		}
		
	}
	
	/**
	 * @return the $name
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @return the $group
	 */
	public function getGroup() {
		return $this->group;
	}

	/**
	 * @return the $httpMethod
	 */
	public function isPost() {
		return ($this->httpMethod == 'post');
	}

	/**
	 * @return the $info
	 */
	public function getInfo() {
		return $this->info;
	}

	/**
	 * @return the $minVersion
	 */
	public function getMinVersion() {
		return $this->minVersion;
	}

	/**
	 * @return the $controllerName
	 */
	public function getControllerName() {
		return $this->controllerName;
	}

	/**
	 * @return the $controllerActioName
	 */
	public function getControllerActioName() {
		return $this->controllerActionName;
	}

	/**
	 * @return the $parameters
	 */
	public function getParamDefinitions() {
		return $this->paramDefinitions;
	}
	
	/**
	 * Return the "File" type parameters
	 * 
	 * @return array
	 */
	public function getFileParamDefinitions()
	{
		$array = array();
		foreach ($this->paramDefinitions as $name => $param)
		{
			if ( ! $param->getVarType() == ApiParameter::VAR_TYPE_FILE) continue;
			$array[$name] = $param;
		}
		return $array;
	}
	
	/**
	 * Return a parameter
	 * 
	 * @param string $name
	 */
	public function getParamDefinition($name)
	{
		return $this->paramDefinitions[$name];
	}
	
	/**
	 * Check if Api methodcan manage files
	 * 
	 * @return boolean
	 */
	public function hasFileParamDefintions()
	{
		if (count($this->getFileParamDefinitons()) > 0) return true;
		return false;
	}

	/**
	 * @param string $name
	 */
	public function setName($name) {
		$this->name = $name;
	}

	/**
	 * @param \Zend\XmlRpc\Value\String $group
	 */
	public function setGroup($group) {
		$this->group = $group;
	}

	/**
	 * @param string $httpMethod
	 */
	public function setHttpMethod($httpMethod) {
		$this->httpMethod = $httpMethod;
	}

	/**
	 * @param multitype: $info
	 */
	public function setInfo($info) {
		$this->info = $info;
	}

	/**
	 * @param string $minVersion
	 */
	public function setMinVersion($minVersion) {
		$this->minVersion = $minVersion;
	}

	/**
	 * @param string $controllerName
	 */
	public function setControllerName($controllerName) {
		$this->controllerName = $controllerName;
	}

	/**
	 * @param \ZendServerWebApi\Model\unknown $controllerActioName
	 */
	public function setControllerActioName($controllerActioName) {
		$this->controllerActionName = $controllerActioName;
	}

	/**
	 * @param multitype: $parameters
	 */
	public function setParameters($parameters) {
		$this->paramDefinitions = $parameters;
	}

	/**
	 * Constructor
	 * 
	 * @param array $config
	 */
	public function __construct($config = null)
	{
		if (is_array($config)) $this->setConfig($config);
	}
	
}
