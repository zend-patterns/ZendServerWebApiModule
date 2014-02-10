<?php
return array(
        'min-zsversion' => '6.0.1',
        'console' => array(
                'router' => array(
                        'routes' => array(
                                // Zend Server Daemons
                                'daemonsProbe' => array(
                                        'options' => array(
                                                'route' => 'daemonsProbe',
                                                'defaults' => array(
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'daemonsProbe'
                                                ),
		                                        'info' => array(
		                                                'Retrieve a list of daemon restart states according to ZSD messages.'
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
