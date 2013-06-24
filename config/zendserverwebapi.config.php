<?php
return array (
		'controllers' => array (
				'invokables' => array (
						'ZendServerWebApi\Controller\ZendServer' => 'ZendServerWebApi\Controller\ZendServerController' 
				) 
		),
		'console' => array (
				'router' => array (
						'routes' => array (
								'zendserver' => array (
										'options' => array (
												'route' => 'zsapi <action>',
												'defaults' => array (
														'controller' => 'ZendServerWebApi\Controller\ZendServer',
														'apiMethod' => 'get' 
												) 
										) 
								)
						),
				)
				
				 
		),
		// Zend Server API specific HTTP Client
		'zend_server_client' => array (
				'adapter' => 'Zend\Http\Client\Adapter\Curl' 
		),
		// Zend Server API
		'target_zend_server' => array (
				'version' => '6.0.1',
				'url' => 'http://localhost:10081' 
		),
		'default_api_key' => array (
				'name' => 'zf',
				'key' => 'a1c5b69aa706450c6715fd817b5c7cd643144bb2c70d1e4d34c8a0f3098e2c65' 
		),
		'service_manager' => array (
				'factories' => array (
						'zend_server_api' => 'ZendServerWebApi\Model\Service\ApiManagerFactory' 
				) 
		) 
);
