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
     * Api methods configuration
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
        
        if(isset($args[0]['zsoutput'])) {
            $apiRequest->setOutputType($args[0]['zsoutput']);
            unset($args[0]['zsoutput']);
        }
        
        $apiRequest->setParameters($args[0]);
        
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
	 * Set Api methods configuration
	 * 
	 * @param array $config
	 */
	public function setApiMethodsConfig($config) {
		$this->apiMethodsConfig = $config;
	}
    
    /**
     * Set Api target
     * 
     * @param ApiTarget $target
     */
    public function setTarget(ApiTarget $target)
    {
    	$this->target = $target;
    }

    /**
     * Set Http client
     * 
     * Http client to be used to connect Api server
     * @param Zend\Http\Client $zendServerClient
     */
    public function setZendServerClient($zendServerClient) {
    	$this->zendServerClient = $zendServerClient;
    }
    
    /**
     * Get Http client
     * 
     * @return Zend\Http\Client
     */
    public function getZendServerClient ()
    {
        return $this->zendServerClient;
    }
}
