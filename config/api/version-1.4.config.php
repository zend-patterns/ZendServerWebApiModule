<?php
return array(
        'console' => array(
                'router' => array(
                        'routes' => array(
                                // Zend Server Daemons
                                'daemonProbe' => array(
                                        'options' => array(
                                                'route' => 'daemonProbe',
                                                'defaults' => array(
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'userAuthentificationSettings'
                                                )
                                        ),
                                        'info' => array(
                                                'Retrieve a list of daemon restart states according to ZSD messages.'
                                        )
                                )
                        )
                )
        )
);
