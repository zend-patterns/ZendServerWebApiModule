<?php
return array (
        'controllers' => array (
                'invokables' => array (
                        'webapi-api-controller'    => 'ZendServerWebApi\Controller\ApiController',
                        'webapi-target-controller' => 'ZendServerWebApi\Controller\TargetController',
                )
        ),
        'console' => array (
                'router' => array (
                        'routes' => array (
                                'addTarget' => array (
                                        'options' => array (
                                                'route' => 'addTarget --target= [--zsurl=] --zskey= --zssecret= [--zsversion=]',
                                                'defaults' => array (
                                                        'controller' => 'webapi-target-controller',
                                                        'action' => 'add',
                                                        'zsurl'     => "http://localhost:10081",
                                                        'zsversion' => '6.1',
                                                ),
                                                'info' => array (
                                                    'This command has to be executed first if you do not want to pass always the zskey zssecret and zsurl.',
                                                    array('--target', 'The unique name of the target'),
                                                    array('--zsurl','The Zend Server URL. If not specified then it will be http://localhost:10081'),
                                                    array('--zskey', 'The name of the API key'),
                                                    array('--zssecret', 'The hash of the API key'),
                                                ),
                                                'no-target' => true,
                                        )
                                ),
                        ),
                )

        ),

        'service_manager' => array (
                'factories' => array (
                     'zend_server_api' => 'ZendServerWebApi\Service\ApiManagerFactory'
                ),
        ),

        //  Zend Server API specific Settings
        'zsapi' => array (
            //Target definition file
            'file' => (isset($_SERVER['HOME'])? $_SERVER['HOME']: 
                             $_SERVER['HOMEDRIVE'].$_SERVER['HOMEPATH'] // Available on Windows
                      ).DIRECTORY_SEPARATOR.
                      '.zsapi.ini',
            // Default Zend Server Target
            'default_target' => array(
                'zsurl' => 'http://localhost:10081',
                'zskey' => 'zf',
                'zssecret' => 'a1c5b69aa706450c6715fd817b5c7cd643144bb2c70d1e4d34c8a0f3098e2c65',
                'zsversion' => '6.1',
            ),
            // HTTP Client
            'client' => array(
                'adapter' => '\ZendServerWebApi\Model\Http\Adapter\Socket',
            ),
        ),
);
