<?php
namespace ZendServerWebApi\Model;
use Zend\Http as Http;
use Zend\Http\Headers;
use Zend\Stdlib\Parameters;

/**
 * API request 
 * 
 * Extends the HTTP request to manage HTTP Headers specific work
 * needed by the Zend Server API
 */
class Request extends Http\Request
{

    /**
     * Api version
     * 
     * @var string
     */
    protected $apiVersion;

    /**
     * API key
     * 
     * @var ApiKey
     */
    protected $apiKey;

    /**
     * Requested Action
     * 
     * @var string
     */
    protected $action;

    /**
     * The Zend Server the request is suppose to be addressed
     * 
     * @var ZendServer
     */
    protected $targetServer;

    /**
     * Api Method Parameters
     * 
     * @var array
     */
    protected $parameter = array();

    /**
     * Main URI Path for Web Api
     * 
     * @var string
     */
    const API_URI = '/ZendServer/Api/';

    /**
     * User agent
     * 
     * @var String
     */
    const USER_AGENT = 'Zend\Http\Client';

    /**
     * API reqiest constructor
     * 
     * @param ZendServer $targetServer            
     * @param string $action            
     * @param ApiKey $apiKey            
     */
    public function __construct (ZendServer $targetServer, $action, 
            ApiKey $apiKey)
    {
        $this->setAction($action);
        $this->setApiKey($apiKey);
        $this->setTargetServer($targetServer);
        $this->setApiVersion($targetServer->getApiVersion());
        $this->setUri();
    }

    /**
     * (non-PHPdoc)
     * 
     * @see \Zend\Http\Request::setUri()
     */
    public function setUri ()
    {
        parent::setUri($this->targetServer->getUri());
        $this->uri->setPath(self::API_URI . $this->action);
    }

    /**
     * Prepare the request before it been send to Zend Server
     */
    public function prepareRequest ()
    {
        $date = gmdate('D, d M Y H:i:s ') . 'GMT';
        $webApiUri = self::API_URI . $this->action;
        $signatureData = $this->uri->getHost() . ':';
        $signatureData .= $this->uri->getPort() . ':';
        $signatureData .= $webApiUri . ':';
        $signatureData .= self::USER_AGENT . ':';
        $signatureData .= $date;
        $signature = hash_hmac('sha256', $signatureData, 
                $this->apiKey->getKey());
        $headers = new Headers();
        $headers->addHeaderLine('Host', 
                $this->uri->getHost() . ':' . $this->uri->getPort());
        $headers->addHeaderLine('Date', $date);
        $headers->addHeaderLine('Accept', 
                'application/vnd.zend.serverapi+xml;version=' . $this->apiVersion);
        $headers->addHeaderLine('X-Zend-Signature', 
                $this->apiKey->getName() . ';' . $signature);
        if ($this->isPost()) {
            $headers->addHeaderLine('Content-Type', 'multipart/form-data');
            $this->setPostParameter();
        } else
            $this->setGetParameter();
        $this->setHeaders($headers);
    }

    /**
     * Setting URI GET parameter
     */
    protected function setGetParameter ()
    {
        $this->uri->setQuery($this->parameter);
    }

    /**
     * Setting XML Post data
     */
    protected function setPostParameter ()
    {
        $postParameters = new Parameters($this->parameter);
        $this->setPost($postParameters);
    }

    /**
     * Set Api Method parameter
     * 
     * @param string $name            
     * @param string $value            
     */
    public function setParameter ($name, $value)
    {
        $this->parameter[$name] = $value;
    }

    /**
     * Return parameter value
     * 
     * @param string $name            
     * @return multitype:
     */
    public function getParameter ($name)
    {
        return $this->parameter[$name];
    }

    /**
     * Set parameters
     * 
     * @param array $params            
     */
    public function setParameters ($params)
    {
        foreach ($params as $name => $value) {
            $this->setParameter($name, $value);
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
     * @return the $apiKey
     */
    public function getApiKey ()
    {
        return $this->apiKey;
    }

    /**
     *
     * @return the $action
     */
    public function getAction ()
    {
        return $this->action;
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
     * @param \ZendServerWebApi\Model\ApiKey $apiKey            
     */
    public function setApiKey ($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     *
     * @param string $action            
     */
    public function setAction ($action)
    {
        $this->action = $action;
    }

    /**
     *
     * @return the $targetServer
     */
    public function getTargetServer ()
    {
        return $this->targetServer;
    }

    /**
     *
     * @param \ZendServerWebApi\Model\ZendServer $targetServer            
     */
    public function setTargetServer ($targetServer)
    {
        $this->targetServer = $targetServer;
    }
}