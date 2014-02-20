<?php
namespace ZendServerWebApi\Controller;

use Zend\Mvc\Controller\AbstractController;
use Zend\Mvc\MvcEvent;
use ZendServerWebApi\Model\ApiManager;
use ZendServerWebApi\Model\ApiTarget;

/**
 * Main Console Controller
 *
 * Controller that manage all CLI commands
 */
class ApiController extends AbstractController
{
    /**
     * (non-PHPdoc)
     *
     * @see \Zend\Mvc\Controller\AbstractController::onDispatch()
     */
    public function onDispatch (MvcEvent $e)
    {
        $routeMatch = $e->getRouteMatch();
        if (! $routeMatch) {
            throw new \Exception(
                    'Missing route matches; unsure how to retrieve action');
        }
        $action = $routeMatch->getParam('action', 'not-found');
        //Manage parameter
        $requestParameters = array();
        foreach ($routeMatch->getParams() as $name => $value) {
            if (in_array($name, array('action','controller'))) continue;
            $requestParameters[$name] = $value;
        }
        if(method_exists($this, $action.'Action')) {
            $response = $this->{$action.'Action'}($requestParameters);
        } else {
            $response = $this->sendApiRequest($requestParameters);
        }
        return $response->getHttpResponse();
    }

    /**
     * Send the API Request to Zend Server
     *
     * @param  array    $params Request parameter
     * @return Response
     */
    protected function sendApiRequest($params)
    {
    	$target = $this->getTarget();
        $action = $this->params('action');
        $apiMethodsConfig = $this->serviceLocator->get('apiMethodsConfig');
        $config = $this->serviceLocator->get('config');
        $httpClientConfig = $config['api_http_client'];
        $zsclient = new $httpClientConfig['class']('',$httpClientConfig['config']);
        $apiManager = new ApiManager();
        $apiManager->setTarget($target);
        $apiManager->setApiMethodsConfig($apiMethodsConfig);
        $apiManager->setZendServerClient($zsclient);
        $response = $apiManager->$action($params);
        return $response;
    }
    
    /**
     * Return the target to use
     * 
     * Will return the default target or the target given in parameters
     * @return ApiTarget
     */
    protected function getTarget()
    {
    	$target = $this->getTargetByName();
    	if ($target) return $target;
    	$target = $this->getTragetByParemeters();
    	if ($target) return $target;
    	$targetManager = current($this->serviceLocator->get('target_manager'));
    	return $targetManager->getTarget('default');
    }
    
    /**
     * Compute a target from requets parameters
     * 
     * When setting taget by its parameter in command line
     * @return void|\ZendServerWebApi\Model\ApiTarget
     */
    protected function getTragetByParemeters()
    {
    	if ( ! $this->params('zsurl',null)) return;
    	$target = new ApiTarget('anonymous', array(
    		'zsurl' => $this->params('zsurl'),
    		'zskey' => $this->params('zskey'),
    		'zssecret' => $this->params('zssecret'),
    		'zsversion' => $this->params('zsversion'),
    	));
    	return $target;
    }
    
    /**
     * Get target from target manager
     * 
     * Use target request parameter to look into target manager.
     * @return void|\ZendServerWebApi\Model\ApiTarget
     */
    protected function getTargetByName()
    {
    	if ( ! $this->params('target',null)) return;
    	$targetName = $this->params('target',null);
    	if ( ! $targetName) return;
    	$targetManager = current($this->serviceLocator->get('target_manager'));
    	return $targetManager->getTarget($targetName);
    }
}
