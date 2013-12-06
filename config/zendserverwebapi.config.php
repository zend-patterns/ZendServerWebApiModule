<?php
return array (
        'controllers' => array (
                'invokables' => array (
                        'webapi-api-controller'    => 'ZendServerWebApi\Controller\ApiController',
                )
        ),
        'service_manager' => array (
                'factories' => array (
                     'zend_server_api' => 'ZendServerWebApi\Service\ApiManagerFactory',
                     'log' => 'ZendServerWebApi\Service\LogFactory'
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
            ),
            // HTTP Client
            'client' => array(
                'adapter' => '\ZendServerWebApi\Model\Http\Adapter\Socket',
            ),
        ),
);
