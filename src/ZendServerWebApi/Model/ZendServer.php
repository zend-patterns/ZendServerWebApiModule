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
    protected $version;

    /**
     * Zend Server uri
     * 
     * @var Zend\Uri\http
     */
    protected $uri;
    
    /**
     * Api Version
     * @var string
     */
    protected $apiVersion;
    
    
    /**
     * Api Version / zs version converter
     * @var array
     */
    protected static $apiVersionConfig = array();

    /**
     *
     * @param string $config            
     */
    protected function __construct ($config)
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
        return $this->apiVersion;
    }
    
	/**
     * @param string $apiVersion
     */
    public function setApiVersion ($apiVersion)
    {
        $this->apiVersion = $apiVersion;
    }
    
    /**
     * Zend Server factory
     * @param unknown $config
     * @param unknown $apiVersionConfig
     */
    public static function factory($config)
    {
        $zendServer = new self($config);
        $apiVersion = current(array_keys(self::$apiVersionConfig,$zendServer->getVersion()));
        $zendServer->setApiVersion($apiVersion);
        return $zendServer;
    }
    
    /**
     * Set the Api version configurator
     */
    public static function setApiVersionConf($apiVersionConfig)
    {
        self::$apiVersionConfig = $apiVersionConfig;
    }

}