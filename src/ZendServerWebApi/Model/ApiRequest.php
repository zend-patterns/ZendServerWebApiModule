<?php
namespace ZendServerWebApi\Model;

use Zend\Http as Http;
use Zend\Http\Headers;
use Zend\Stdlib\Parameters;
use ZendServerWebApi\Model\ApiMethod;
use ZendServerWebApi\Model\ApiTarget;

/**
 * API request 
 * 
 * Extends the HTTP request to manage HTTP Headers specific work
 * needed by the Zend Server API
 */
class ApiRequest extends Http\Request
{
    /**
     * Api method
     * 
     * @var ApiMethod
     */
    protected $apiMethod;
    
    /**
     * Server response output type
     * @var string 
     * 		- xml
     * 		- json
     */
    protected $outputType = "xml";

    /**
     * Api Target
     * 
     * @var ApiTarget
     */
    protected $target;

    /**
     * Api Method Parameters
     * 
     * @var array
     */
    protected $parameter = array();
    
    /**
     * File parameters definition
     * @var array
     */
    protected $files = array();

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
     * @param ApiMethod $apiMethod            
     * @param ApiKey $apiKey            
     */
    public function __construct (ApiTarget $target, ApiMethod $apiMethod)
    {
        $this->setApiMethod($apiMethod);
        if ($this->apiMethod->isPost()) $this->setMethod(self::METHOD_POST);
        $this->setTarget($target);
        $this->setUri();
    }

    /**
     * (non-PHPdoc)
     * 
     * @see \Zend\Http\Request::setUri()
     */
    public function setUri ($uri = null)
    {
        parent::setUri($this->target->getZendServer()->getUri());
        $this->uri->setPath(self::API_URI . $this->apiMethod->getName());
    }

    /**
     * Prepare the request before it been send to Zend Server
     */
    public function prepareRequest ()
    {
        $date = gmdate('D, d M Y H:i:s ') . 'GMT';
        $webApiUri = self::API_URI . $this->apiMethod->getName();
        $signatureData = $this->uri->getHost() . ':';
        $signatureData .= $this->uri->getPort() . ':';
        $signatureData .= $webApiUri . ':';
        $signatureData .= self::USER_AGENT . ':';
        $signatureData .= $date;
        $signature = hash_hmac('sha256', $signatureData, $this->getApiKey());
        $headers = new Headers();
        $headers->addHeaderLine('Host', $this->uri->getHost() . ':' . $this->uri->getPort());
        $headers->addHeaderLine('Date', $date);
        $headers->addHeaderLine('Accept', 'application/vnd.zend.serverapi+'.$this->outputType.';version=' . $this->getApiVersion());
        $headers->addHeaderLine('X-Zend-Signature', $this->getApiKeyName() . '; ' . $signature);
        if ($this->isPost()) {
        	$contentLength = 0;
            if(count($this->getFiles())) {
                $headers->addHeaderLine('Content-Type', 'multipart/form-data');
                /*foreach ($this->getFiles() as $path => $fileParam){
                	$size = strlen(file_get_contents($path));
                	$contentLength += $size;
                }*/
            } else {
                $headers->addHeaderLine('Content-Type', 'application/x-www-form-urlencoded');
            }
            $this->setPostParameter();
            $contentLength += strlen($this->getContent());
            $headers->addHeaderLine('Content-Length',$contentLength);
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
        $this->setContent($this->getPost()->toString());
    }

    /**
     * Set Api Method parameter
     * 
     * @param string $name            
     * @param string $value            
     */
    public function setParameter ($name, $value)
    {
    	$paramDefinition = $this->apiMethod->getParamDefinition($name);
    	if ( ! $paramDefinition) return null;
    	if ($paramDefinition->isFile()) {
    		$this->files[$value] = array(
    			'formname' => $paramDefinition->getName(),
    			'filename' => basename($value),
    			'data'     => null,
    			'ctype'    => null,
    		);
    	}
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
        $this->setFiles(new \Zend\Stdlib\Parameters($this->files));
    }

    /**
     *
     * @return the $apiVersion
     */
    public function getApiVersion ()
    {
        return $this->target->getZendServer()->getApiVersion();
    }

    /**
     * Return Api key secret
     * 
     * @return string
     */
    public function getApiKey ()
    {
        return $this->target->getApiKey()->getKey();
    }
    
    /**
     * Return Api Key name
     * 
     * @return string
     */
    public function getApiKeyName()
    {
    	return $this->target->getApiKey()->getName();
    }
    /**
     *
     * @param ApiMethod $apiMethod            
     */
    public function setApiMethod ($apiMethod)
    {
        $this->apiMethod = $apiMethod;
    }
    
    /**
     * 
     * @param unknown $contentType
     */
    public function setOutputType($contentType)
    {
    	$this->outputType = $contentType;
    }
    
    /**
     * 
     * @return string
     */
    public function getOutputType()
    {
    	return $this->outputType;
    }
    
	/**
	 * @param \ZendServerWebApi\Model\ApiTarget $target
	 */
	public function setTarget($target) {
		$this->target = $target;
	}
}