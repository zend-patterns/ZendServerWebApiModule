<?php
use Zend\Log\Logger;
return array (
        'controllers' => array (
                'invokables' => array (
                        'webapi-api-controller'    => 'ZendServerWebApi\Controller\ApiController',
                )
        ),
        'service_manager' => array (
                'factories' => array (
                     'log' => 'ZendServerWebApi\Service\LogFactory',
                	 'zend_server_api' => 'ZendServerWebApi\Service\ApiManagerFactory',
                ),
        ),

        //  Zend Server API specific Settings
        'zsapi' => array (
            // Default Zend Server Target
            'target' => array(
                'zsurl' => 'http://localhost:10081',
                'zskey' => 'admin',
                'zssecret' => 'fdbe02cc14bf1b48787e379bc420fd46ba9c88a3cc85c2030b5e32610e75efa5',
                'zsversion' => '6.2',
            ),
            // HTTP Client
            'client' => array(
                'adapter' => '\ZendServerWebApi\Model\Http\Adapter\Socket',
            ),
        ),
        'zsapilog' => array (
            'file' => 'php://stderr',
            'priority' => getenv('DEBUG')? Logger::DEBUG: Logger::WARN,    	
        )
);
