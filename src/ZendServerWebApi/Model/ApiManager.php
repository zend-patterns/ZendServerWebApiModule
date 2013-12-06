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
     * Magical function to use API method has API Manager method.
     *
     * @param string $action            
     * @param array $args            
     * @return ApiResponse;
     */
    public function __call ($action, $args)
    {
        $methodConf = 'get';
        $apiConfig  = $this->getApiConfig();
        $actionOptions = $apiConfig[$action]['options'];
        if (isset($actionOptions['defaults']['apiMethod'])) {
            $methodConf = $actionOptions['defaults']['apiMethod'];
        }
        $apiRequest = new Request($this->getTargetServer(), $action, $this->getApiKey());
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
        $log = $this->getServiceLocator()->get('log');
        $log->info($apiRequest->getUriString());
        $httpResponse = $this->getZendServerClient()->send($apiRequest);
        $response = ApiResponse::factory($httpResponse);
        if ($response->isError()) {
            $log->err($response->getErrorMessage() . $response->getHttpResponse()->getBody());
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
