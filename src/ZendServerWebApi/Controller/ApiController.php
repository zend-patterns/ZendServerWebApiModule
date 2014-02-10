<?php
namespace ZendServerWebApi\Controller;
use Zend\Mvc\Controller\AbstractController;
use Zend\Mvc\MvcEvent;

/**
 * Main Console Controller
 *
 * Controller that manage all CLI commands
 */
class ApiController extends AbstractController
{
    protected $apiManager;

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
        if(!$this->apiManager) {
            $serviceLocator = $this->getServiceLocator();
            $this->apiManager = $serviceLocator->get('zend_server_api');
        }
        $action = $this->params('action');
        $response = $this->apiManager->$action($params);
        return $response;
    }
}
