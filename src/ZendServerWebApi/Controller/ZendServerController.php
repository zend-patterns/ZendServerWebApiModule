<?php
namespace ZendServerWebApi\Controller;
use Zend\Mvc\Controller\AbstractController;
use Zend\Mvc\MvcEvent;

/**
 * Main Console Controller
 *
 * Controller that manage all CLI commands
 */
class ZendServerController extends AbstractController
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
        foreach ($routeMatch->getParams() as $name => $value){
        	if (in_array($name, array('action','controller'))) continue;
        	$arrayValue = json_decode($value,true);
        	if ($arrayValue !== NULL) {
        		$requestParameters[$name] = $arrayValue;
        	}
        	else $requestParameters[$name] = $value;
        }
        //var_dump($requestParameters);
        $response = $this->sendApiRequest($requestParameters);
        $e->setResult(false);
        echo $response->getHttpResponse()->getBody();
    }

    /**
     * Send the API Request to Zend Server
     *
     * @param array $params Request parameter
     * @return Response
     */
    protected function sendApiRequest($params)
    {
        $serviceLocator = $this->getServiceLocator();
        $apiManager = $serviceLocator->get('zend_server_api');
        $action = $this->params('action');
        $response = $apiManager->$action($params);
        return $response;
    }
}