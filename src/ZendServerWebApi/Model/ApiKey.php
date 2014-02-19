<?php
namespace ZendServerWebApi\Model;

/**
 * Zend Server API key
 */
class ApiKey
{

    /**
     * Key name
     * 
     * @var string
     */
    protected $name;

    /**
     * Secret hash key
     * 
     * @var string
     */
    protected $key;

    /**
     * Consrtructor 
     * @param string $name            
     * @param string $key            
     */
    public function __construct ($name, $key)
    {
        $this->setName($name);
        $this->setKey($key);
    }

    /**
     * Return api key name
     * 
     * @return string
     */
    public function getName ()
    {
        return $this->name;
    }

    /**
     * Return api key secret hash
     * 
     * @return string
     */
    public function getKey ()
    {
        return $this->key;
    }

    /**
     * Set key name
     * 
     * @param string $name            
     */
    public function setName ($name)
    {
        $this->name = $name;
    }

    /**
     * Set key secret hash
     * 
     * @param string $key            
     */
    public function setKey ($key)
    {
        $this->key = $key;
    }
}