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
                                        'group' => 'server',
                                        'info' => array (
                                        		'Retrieve a list of daemon restart states according to ZSD messages. This action presents a list of currently flagged daemons and the reason for their flaggin. Inclusion in this list usually indicates the daemon needs to be reloaded or restarted.',
                                        )
                                )
                        )
                )
        )
);
