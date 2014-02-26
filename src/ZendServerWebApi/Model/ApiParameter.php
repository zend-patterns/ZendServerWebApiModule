<?php
namespace ZendServerWebApi\Model;

/**
 * Api method parameter definition
 * 
 * Define api method parameter.
 */
class ApiParameter
{
	const VAR_TYPE_STRING = 'string';
	const VAR_TYPE_ARRAY = 'array';
	const VAR_TYPE_FILE = 'file';
	
	/**
	 * Check if the parameter is required or not
	 * 
	 * @var boolean
	 */
	protected $isRequired = false;
	
	/**
	 * Parameter type
	 * 
	 * @var string
	 */
	protected $varType = self::VAR_TYPE_STRING;
	
	/**
	 * Parameter name
	 * 
	 * @var string
	 */
	protected $name;
	
	/**
	 * Constructor
	 * 
	 * @param string $name
	 * @param string $varType
	 * @param boolean $isRequired
	 */
	public function __construct($name, $varType= self::VAR_TYPE_STRING, $isRequired = false)
	{
		$this->setName($name);
		$this->setIsRequired($isRequired);
		$this->setVarType($varType);
	}
	
	/**
	 * Get parameter value
	 * 
	 * @return mixed
	 */
	public function getValue() {
		return $this->value;
	}
	
	/**
	 * Check if parameter is required
	 * 
	 * @return the $isRequired
	 */
	public function isRequired() {
		return $this->isRequired;
	}

	/**
	 * et parameter var type
	 * 
	 * @return string
	 */
	public function getVarType() {
		return $this->varType;
	}

	/**
	 * Get parameter name
	 * 
	 * @return string
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * Set parameter required status
	 * 
	 * @param boolean $isRequired
	 */
	public function setIsRequired($isRequired) {
		$this->isRequired = $isRequired;
	}

	/**
	 * set parameter var type
	 * 
	 * @param string $varType
	 */
	public function setVarType($varType) {
		$this->varType = $varType;
	}

	/**
	 * set parameter name
	 * 
	 * @param string $name
	 */
	public function setName($name) {
		$this->name = $name;
	}
	
	/**
	 * Check if parameter is a file
	 * 
	 * @return boolean
	 */
	public function isFile()
	{
		return ($this->getVarType() == self::VAR_TYPE_FILE);
	}
	
	/**
	 * Check if parameter is an array
	 *
	 * @return boolean
	 */
	public function isArray()
	{
		return ($this->getVarType() == self::VAR_TYPE_ARRAY);
	}
}