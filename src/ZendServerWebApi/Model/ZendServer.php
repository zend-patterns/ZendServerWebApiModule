<?php
namespace ZendServerWebApi\Model;

/**
 * Api Target Zend Server
 * 
 * Define the target Zend Server which request will be send
 */
class ZendServer
{
    /**
     * Zend Server Version
     * 
     * @var string
     */
    protected $version = '5.1';

    /**
     * Zend Server uri
     * 
     * @var Zend\Uri\http
     */
    protected $uri;
    
    /**
     * Api Version / zs version converter
     * @var array
     */
    protected $apiVersionConfig = array();

    /**
     *
     * @param string $config            
     */
    public function __construct ($config,$apiVersionConfig)
    {
        $this->setUri(new \Zend\Uri\Http($config['zsurl']));
        $this->setVersion($config['zsversion']);
    }
    
    /**
     *
     * @return the $version
     */
    public function getVersion ()
    {
        return $this->version;
    }

    /**
     *
     * @param string $version            
     */
    public function setVersion ($version)
    {
        $this->version = $version;
    }

    /**
     *
     * @return the $uri
     */
    public function getUri ()
    {
        return $this->uri;
    }

    /**
     *
     * @param \ZendServerWebApi\Model\Zend\Uri\http $uri            
     */
    public function setUri ($uri)
    {
        $this->uri = $uri;
    }
    
    /**
     * Return the available web API versions
     */
    public function getApiVersion()
    {
        return current(array_keys($this->apiVersionConfig,$this->version));
    }
}