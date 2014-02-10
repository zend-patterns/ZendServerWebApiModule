<?php
namespace ZendServerWebApi\Model;

use ZendServerWebApi\Model\Response\ApiResponse;
use ZendServerWebApi\Model\ApiRequest;
use ZendServerWebApi\Model\ApiTarget;
use ZendServerWebApi\Model\Exception\ApiException;
use ZendServerWebApi\Model\Http\Client;

/**
 * API Manager
 *
 * Class that manage Zend server API Request and Response.
 * Request can be send as an internal method of this class :
 * $this->getNotifications() will call "getNotications" API Method
 */
class ApiManager
{
    /**
     * Api Target
     * 
     * @var ApiTarget
     */
    protected $target;
    
    /**
     * Api Manager config
     * 
     * @var array
     */
    protected $apiMethodsConfig;
    
    /**
     * Zend Server HTTP client
     * 
     * @var ZendClient
     */
    protected $zendServerClient;
    
    /**
     * Magical function to use API method has API Manager method.
     *
     * @param string $action            
     * @param array $args            
     * @return ApiResponse;
     */
    public function __call ($action, $args)
    {
        $apiMethodConfig = $this->apiMethodsConfig[$action]['options'];
    	$apiMethod = new ApiMethod($apiMethodConfig);
        $apiRequest = new ApiRequest($this->target, $apiMethod);
        $apiRequest->setParameters($args[0]);
        if(isset($args[0]['zsoutput'])) 
        	$apiRequest->setOutputType($args[0]['zsoutput']);
        $apiRequest->prepareRequest();
        $httpResponse = $this->getZendServerClient()->send($apiRequest);
        $apiResponse = ApiResponse::factory($httpResponse);
        if ($apiResponse->isError()) {
        	$message = $apiRequest->getMethod() . '-';
        	$message .= $apiResponse->getErrorMessage();
        	$message .= $apiResponse->getHttpResponse()->getBody();
            throw new ApiException($apiResponse);
        }
        return $apiResponse;
    }

	/**
	 * @param multitype: $config
	 */
	public function setApiMethodsConfig($config) {
		$this->apiMethodsConfig = $config;
	}
    
    /**
     * Set the target
     * 
     * @param ApiTarget $target
     */
    public function setTarget(ApiTarget $target)
    {
    	$this->target = $target;
    }

    /**
     * @param \ZendServerWebApi\Model\ZendClient $zendServerClient
     */
    public function setZendServerClient($zendServerClient) {
    	$this->zendServerClient = $zendServerClient;
    }
    
    /**
     *
     * @return the $zendServerClient
     */
    public function getZendServerClient ()
    {
    	if ( ! $this->zendServerClient){
    		$config = $this->config;
    		$httpConfig = $config['zsapi']['client'];
    		$zendserverClient= new Client(null, $httpConfig);
    		$this->setZendServerClient($zendserverClient);
    	}
        return $this->zendServerClient;
    }
}
