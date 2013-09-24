<?php
namespace ZendServerWebApi\Model;
use ZendServerWebApi\Model\Response\ApiResponse;
use ZendServerWebApi\Model\Request;
use ZendServerWebApi\Model\Exception\ApiException;

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
     * ApiKey
     *
     * @var ZendServerWebApi\Model\ApiKey
     */
    protected $apiKey;

    /**
     * Zend server to request
     *
     * @var ZendServerwebApi\Model\ZendServer
     */
    protected $targetServer;

    /**
     * HTTP client to connect with Zend server
     *
     * @var Zend\Http\Client
     */
    protected $zendServerClient;

    /**
     * API Configuration
     *
     * @var unknown
     */
    protected $apiConfig = array();

    /**
     * API Manager constructor
     *
     * @param unknown $targetServer
     * @param unknown $apiKey
     * @param unknown $zendServerClient
     */
    public function __construct ($targetServer, $apiKey, $zendServerClient,
            $apiConfig)
    {
        $this->setTargetServer($targetServer);
        $this->setApiKey($apiKey);
        $this->setZendServerClient($zendServerClient);
        $this->setApiConfig($apiConfig);
    }

    /**
     * Magical function to use API method has API Manager method.
     *
     * @param  string       $action
     * @param  array        $args
     * @return ApiResponse;
     */
    public function __call ($action, $args)
    {
        $methodConf = 'get';
        $actionOptions = $this->apiConfig[$action]['options'];
        if (isset($actionOptions['defaults']['apiMethod'])) {
            $methodConf = $actionOptions['defaults']['apiMethod'];
        }
        $apiRequest = new Request($this->targetServer, $action, $this->apiKey);
        if (isset($args[0])) {
            if ($methodConf == 'post') {
                $files = array();
                if(isset($actionOptions['files'])) {
                    foreach($actionOptions['files'] as $fileParam) {
                        $filePath = $args[0][$fileParam];
                        $files[$filePath] = array(
                            'formname' => $fileParam,
                            'filename' => basename($filePath),
                            'data'     => null,
                            'ctype'    => null,
                        );
                        unset($args[0][$fileParam]);
                    }
                    unset($args[0]['files']);
                }

                if(count($files)) {
                    $apiRequest->setFiles(new \Zend\Stdlib\Parameters($files));
                }
            }

            $apiRequest->setParameters($args[0]);
        }
        
        if(isset($args[0]['zsoutput'])) {
        	$apiRequest->setOutputType($args[0]['zsoutput']);	
        }	

        if ($methodConf == 'post') {
            $apiRequest->setMethod(Request::METHOD_POST);
        }
        $apiRequest->prepareRequest();
        $httpResponse = $this->zendServerClient->send($apiRequest);
        $response = ApiResponse::factory($httpResponse);
        if ($response->isError()) {
            throw new ApiException($response);
        }

        return $response;
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
     * @return the $targetServer
     */
    public function getTargetServer ()
    {
        return $this->targetServer;
    }

    /**
     *
     * @return the $zendServerClient
     */
    public function getZendServerClient ()
    {
        return $this->zendServerClient;
    }

    /**
     *
     * @param \ZendServerWebApi\Model\ZendServerWebApi\Model\ApiKey $apiKey
     */
    public function setApiKey ($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     *
     * @param \ZendServerWebApi\Model\ZendServerwebApi\Model\ZendServer $targetServer
     */
    public function setTargetServer ($targetServer)
    {
        $this->targetServer = $targetServer;
    }

    /**
     *
     * @param \ZendServerWebApi\Model\Zend\Http\Client $zendServerClient
     */
    public function setZendServerClient ($zendServerClient)
    {
        $this->zendServerClient = $zendServerClient;
    }

    /**
     *
     * @return the $apiConfig
     */
    public function getApiConfig ()
    {
        return $this->apiConfig;
    }

    /**
     *
     * @param \ZendServerWebApi\Model\unknown $apiConfig
     */
    public function setApiConfig ($apiConfig)
    {
        $this->apiConfig = $apiConfig;
    }
}
