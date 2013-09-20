<?php
return array(
        'min-zsversion' => '6.1',
        'console' => array(
                'router' => array(
                        'routes' => array(
                                // Library
                                'libraryGetStatus' => array(
                                        'options' => array(
                                                'route' => 'libraryGetStatus',
                                                'defaults' => array(
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'libraryGetStatus'
                                                )
                                        ),
                                        'info' => array(
                                                'Get the list of libraries currently deployed on the server or the cluster, and information about each library’s available versions.'
                                        )
                                )
                        )
                )
        )
);
