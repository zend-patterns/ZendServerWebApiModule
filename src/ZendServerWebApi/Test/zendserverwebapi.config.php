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
						'targetManager' => 'ZendServerWebApi\Service\TargetManagerFactory',
						'apiMethodsConfig' => 'ZendServerWebApi\Service\ApiMethodsConfigFactory'
				),
		),
		'target_manager_config' => array(
				'default' => array(
						'zsurl' => 'http://localhost:10081',
						'zskey' => 'nagios',
						'zssecret' => '39007905543029a96f3c2ffb24f624eaaccefd9ae8cf291ffd398c14830a6b0f',
						'zsversion' => '6.2',
				),
		),

        'zsapilog' => array (
            'file' => '/tmp/webapi.log',
        )
);
