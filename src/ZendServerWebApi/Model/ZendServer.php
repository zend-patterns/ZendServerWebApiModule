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
     * API Version
     * 
     * @var string
     */
    protected $apiVersion = '1.0';

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
     * Array of available api version dapending on Zend Server version
     * 
     * @var array
     */
    protected $apiVersionAvailability = array(
            '5.1' => '1.0',
            '5.5' => '1.1',
            '5.6' => '1.2',
            '6.0' => '1.3',
            '6.1' => '1.4',
    )
    ;

    /**
     *
     * @param string $config            
     */
    public function __construct ($config)
    {
        $this->setUri(new \Zend\Uri\Http($config['zsurl']));
        if (isset($config['zsversion'])){
            $this->setVersion($config['zsversion']);
            preg_match('@(^[0-9]*\.[0-9]*)@', $config['zsversion'], $shortVersion);
            if (count($shortVersion) == 0) return;
            if (count($shortVersion) > 0)
            $shortVersion = $shortVersion[0];
            $this->setApiVersion($this->apiVersionAvailability[$shortVersion]);
        }
    }

    /**
     *
     * @return the $apiVersion
     */
    public function getApiVersion ()
    {
        return $this->apiVersion;
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
     * @param string $apiVersion            
     */
    public function setApiVersion ($apiVersion)
    {
        $this->apiVersion = $apiVersion;
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
}