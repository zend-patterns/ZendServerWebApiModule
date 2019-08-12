<?php

namespace ZendServerWebApi\Model;

use Zend\Uri\Http;

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
     * @var Http
     */
    protected $uri;

    /**
     * @var array
     * @see http://files.zend.com/help/Zend-Server/zend-server.htm#web_api_reference_guide.htm
     */
    protected $apiVersionAvailability = array(
        '5.1' => '1.0',
        '5.5' => '1.1',
        '5.6' => '1.2',
        '6.0' => '1.4',
        '6.1' => '1.5',
        '6.2' => '1.6',
        '6.3' => '1.7',
        '7.0' => '1.8',
        '8.0' => '1.9',
        '8.5' => '1.10',
        '9.0' => '1.12',
        '9.1' => '1.14',
        '2018.0' => '1.15',
        '2019.0' => '1.16',
    );

    /**
     * Api Version / zs version converter
     * @var array
     */
    protected static $apiVersionConfig = array();

    /**
     *
     * @param array $config
     */
    protected function __construct(array $config)
    {
        $this->setUri(new Http($config['zsurl']));
        $this->setVersion($config['zsversion']);
        preg_match('@(^[0-9]*\.[0-9]*)@', $config['zsversion'], $shortVersion);
        $shortVersion = $shortVersion[0];
        if (!isset($this->apiVersionAvailability[$shortVersion])) {
            throw new \RuntimeException(
                "Invalid or unsupported Zend Server version"
            );
        }
        $this->setApiVersion($this->apiVersionAvailability[$shortVersion]);
    }

    /**
     *
     * @return string $version
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     *
     * @param string $version
     */
    public function setVersion($version)
    {
        $this->version = $version;
    }

    /**
     *
     * @return Http $uri
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     *
     * @param Http $uri
     */
    public function setUri($uri)
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
    public function setApiVersion($apiVersion)
    {
        $this->apiVersion = $apiVersion;
    }

    /**
     * Zend Server factory
     *
     * @param array $config
     *
     * @return ZendServer
     */
    public static function factory(array $config)
    {
        $zendServer = new self($config);
        $apiVersion = current(
            array_keys(self::$apiVersionConfig, $zendServer->getVersion())
        );
        $zendServer->setApiVersion($apiVersion);
        return $zendServer;
    }

    /**
     * Set the Api version configurator
     *
     * @param $apiVersionConfig
     */
    public static function setApiVersionConf($apiVersionConfig)
    {
        self::$apiVersionConfig = $apiVersionConfig;
    }
}
