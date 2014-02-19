<?php
namespace ZendServerWebApi\Model;

/**
 * Api Target Zend Server
 * 
 * Define the target Zend Server which request will be send
 */
class ZendServer
{
	static $apiVersion = array(
		'5.1' => '1.0',
		'5.5' => '1.1',
		'5.6' => '1.2',
		'6.0' => '1.3',
		'6.0.1' => '1.4',
		'6.1' => '1.5',
		'6.2' => '1.6',
		'6.3' => '1.7',
	);
	
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
     * 
     * @param string $uri
     */
    public function __construct($uri = null, $version = null)
    {
    	if ($uri) $this->setUri(new \Zend\Uri\Http($uri));
    	if ($version) $this->setVersion($version);
    }

    /**
     * Get zend server version
     * 
     * @return string
     */
    public function getVersion ()
    {
        return $this->version;
    }

    /**
     * Set server version
     * 
     * @param string $version            
     */
    public function setVersion ($version)
    {
        $this->version = $version;
    }

    /**
     * Get Zend Server URI
     * 
     * @return Zend\Uri\http
     */
    public function getUri ()
    {
        return $this->uri;
    }

    /**
     * Set Zend Server URI
     * 
     * @param \ZendServerWebApi\Model\Zend\Uri\http $uri            
     */
    public function setUri ($uri)
    {
        $this->uri = $uri;
    }
    
    /**
     * Return api version
     * 
     * @return string
     */
    public function getApiVersion()
    {
    	return self::$apiVersion[$this->version];
    }
}
