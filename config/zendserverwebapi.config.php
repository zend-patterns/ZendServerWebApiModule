<?php
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
                	'targetManager' => 'ZendServerWebApi\Service\TargetManagerFactory',
                	'apiMethodsConfig' => 'ZendServerWebApi\Service\ApiMethodsConfigFactory'
                	
                ),
        ),
		
		'target_manager_config' => array(
				'default' => array(
						'zsurl' => 'http://localhost:10081',
						'zskey' => 'admin',
						'zssecret' => 'f4db592a7dc1d7076c6d83ba13c0eb277859cba1bc1933f19a6ad4da8da982f0',
						'zsversion' => '6.3',
				),
		),
		'api_http_client' => array(
				'class' => 'ZendServerWebApi\Model\Http\Client',
				'config' => array(
						'adapter'=> 'ZendServerWebApi\Model\Http\Adapter\Socket'
				),
		),
		
        /*'zsapilog' => array (
            'file' => 'php://stderr',
            'priority' => getenv('DEBUG')? Logger::DEBUG: Logger::WARN,    	
        )*/
);
