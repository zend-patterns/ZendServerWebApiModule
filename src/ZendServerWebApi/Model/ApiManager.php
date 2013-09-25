<?php
namespace ZendServerWebApi\Model;
use ZendServerWebApi\Model\Response\ApiResponse;
use ZendServerWebApi\Model\Request;
use ZendServerWebApi\Model\Exception\ApiException;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * API Manager
 *
 * Class that manage Zend server API Request and Response.
 * Request can be send as an internal method of this class :
 * $this->getNotifications() will call "getNotications" API Method
 */
class ApiManager implements ServiceLocatorAwareInterface
{
    /**
     * Service manager
     * @var ServiceManager
     */
    protected $serviceManager;
    
    /**
     * 
     * @param ServiceLocatorInterface $serviceLocator
     */
    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceManager = $serviceLocator; 
    }
 
    /**
     * Get Service manager
     * @return \ZendServerWebApi\Model\ServiceManager
     */
    public function getServiceLocator()
    {
        return $this->serviceManager;
    }

    /**
     * API Manager constructor
     *
     * @param unknown $targetServer            
     * @param unknown $apiKey            
     * @param unknown $zendServerClient            
     */
    public function __construct ($serviceManager)
    {
        $this->setServiceLocator($serviceManager);
    }

    /**
     * Magical function to use API method has API Manager method.
     *
     * @param string $action            
     * @param array $args            
     * @return ApiResponse;
     */
    public function __call ($action, $args)
    {
        $methodConf = 'get';
        if (isset($this->apiConfig[$action]['options']['defaults']['apiMethod'])) {
            $methodConf = $this->apiConfig[$action]['options']['defaults']['apiMethod'];
        }
        $apiRequest = new Request($this->getTargetServer(), $action, $this->getApiKey());
        if (isset($args[0]))
            $apiRequest->setParameters($args[0]);
        if ($methodConf == 'post')
            $apiRequest->setMethod(Request::METHOD_POST);
        $apiRequest->prepareRequest();
        $this->getServiceLocator()->get('log')->info($apiRequest->getUriString());
        $httpResponse = $this->getZendServerClient()->send($apiRequest);
        $response = ApiResponse::factory($httpResponse);
        if ($response->isError()) {
            $this->getServiceLocator()->get('log')->err($response->getErrorMessage() . $response->getHttpResponse()->getBody());
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
        return $this->getServiceLocator()->get('defaultApiKey');
    }

    /**
     *
     * @return the $targetServer
     */
    public function getTargetServer ()
    {
        return $this->getServiceLocator()->get('targetZendServer');
    }

    /**
     *
     * @return the $zendServerClient
     */
    public function getZendServerClient ()
    {
        return $this->getServiceLocator()->get('zendserverclient');
    }

    /**
     *
     * @return the $apiConfig
     */
    public function getApiConfig ()
    {
        $apiConfig = $this->getServiceLocator()->get('config');
        $apiConfig = $apiConfig['console']['router']['routes'];
        return $apiConfig;
    }
}