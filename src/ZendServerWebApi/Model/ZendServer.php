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
    protected $apiVersion;

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
     * Array of available api version dapending on Zend Server version
     *
     * @var array
     */
    protected $apiVersionAvailability = array(
            '5.1' => '1.0',
            '5.5' => '1.1',
            '5.6' => '1.2',
            '6.0' => '1.3'
    )
    ;

    /**
     *
     * @param string $config
     */
    public function __construct ($config)
    {
        $this->setUri(new \Zend\Uri\Http($config['url']));
        $this->setVersion($config['version']);
        preg_match('@(^[0-9]*\.[0-9]*)@', $config['version'], $shortVersion);
        $shortVersion = $shortVersion[0];
        $this->setApiVersion($this->apiVersionAvailability[$shortVersion]);
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
