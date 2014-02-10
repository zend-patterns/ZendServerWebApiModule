<?php
namespace ZendServerWebApi\Model;

use ZendServerWebApi\Model\Request;

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
	 * Parameter value
	 * 
	 * @var mixed
	 */
	protected $value;
	
	/**
	 * Constructor
	 * 
	 * @param string $name
	 * @param string $varType
	 * @param boolean $isRequired
	 */
	public function __construct($name, $value, $varType= self::VAR_TYPE_STRING, $isRequired = false)
	{
		$this->setName($name);
		$this->setIsRequired($isRequired);
		$this->setVarType($varType);
		$this->setValue($value);
	}
	
	/**
	 * @return the $value
	 */
	public function getValue() {
		return $this->value;
	}
	
	/**
	 * @param \ZendServerWebApi\Model\mixed $value
	 */
	public function setValue($value) {
		if ($this->isFile()) {
			$value = array(
				$value => array(
					'formname' => $this->getName(),
					'filename' => basename($value),
					'data'     => null,
					'ctype'    => null,
				),
			);
		}
		$this->value = $value;
	}
	
	/**
	 * @return the $isRequired
	 */
	public function isRequired() {
		return $this->isRequired;
	}

	/**
	 * @return the $varType
	 */
	public function getVarType() {
		return $this->varType;
	}

	/**
	 * @return the $name
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 * @param boolean $isRequired
	 */
	public function setIsRequired($isRequired) {
		$this->isRequired = $isRequired;
	}

	/**
	 * @param string $varType
	 */
	public function setVarType($varType) {
		$this->varType = $varType;
	}

	/**
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