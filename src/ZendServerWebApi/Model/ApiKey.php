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
     *
     * @param string $name            
     * @param string $key            
     */
    public function __construct ($name, $key)
    {
        $this->setName($name);
        $this->setKey($key);
    }

    /**
     *
     * @return the $name
     */
    public function getName ()
    {
        return $this->name;
    }

    /**
     *
     * @return the $key
     */
    public function getKey ()
    {
        return $this->key;
    }

    /**
     *
     * @param string $name            
     */
    public function setName ($name)
    {
        $this->name = $name;
    }

    /**
     *
     * @param string $key            
     */
    public function setKey ($key)
    {
        $this->key = $key;
    }
}