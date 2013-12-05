<?php
return array(
        'min-zsversion' => '6.0.1',
        'console' => array(
                'router' => array(
                        'routes' => array(
                                // Zend Server Daemons
                                'daemonProbe' => array(
                                        'options' => array(
                                                'route' => 'daemonProbe',
                                                'defaults' => array(
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'daemonProbe'
                                                ),
		                                        'info' => array(
		                                                'Retrieve a list of daemon restart states according to ZSD messages.'
		                                        )
                                        ),
                                )
                        )
                )
        )
);
