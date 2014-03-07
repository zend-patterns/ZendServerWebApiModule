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
                     'log' => 'ZendServerWebApi\Service\LogFactory'
                ),
                'invokables' => array (
                    'zend_server_api' => 'ZendServerWebApi\Model\ApiManager',
                ),
        ),

        //  Zend Server API specific Settings
        'zsapi' => array (
            // Default Zend Server Target
            'target' => array(
                'zsurl' => 'http://localhost:10081',
                'zskey' => 'zf',
                'zssecret' => 'a1c5b69aa706450c6715fd817b5c7cd643144bb2c70d1e4d34c8a0f3098e2c65',
                'zsversion' => '6.2',
                'http' => array (
                    'timeout' => 30 // 30 seconds by default for the HTTP timeout
            	)
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
