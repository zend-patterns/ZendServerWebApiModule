<?php
return array (
		'min-zsversion' => '6.3',
		'console' => array (
				'router' => array (
						'routes' => array (
								'cacheClear' => array (
										'options' => array (
												'route' => 'cacheClear --component=',
												'defaults' => array (
														'controller' => 'webapi-api-controller',
														'action' => 'cacheClear',
														'apiMethod' => 'post' 
												),
												'group' => 'cache',
												'info' => array (
														'Clear cache data of a specified component.',
														array (
																'--component',
																'One of ‘Zend Data Cache’, ‘Zend Page Cache’, ‘Zend Optimizer+’, ’Zend OPcache’' 
														) 
												) 
										) 
								),
								
								'datacacheClear' => array (
										'options' => array (
												'route' => 'datacacheClear --keys=',
												'defaults' => array (
														'controller' => 'webapi-api-controller',
														'action' => 'datacacheClear',
														'apiMethod' => 'post' 
												),
												'arrays' => array (
														'keys' 
												),
												'group' => 'cache',
												'info' => array (
														'Clear data cache stored data.',
														array (
																'--keys',
																'Stored items to clear. This is an array of explicit items to be cleared from the cache. This array must have at least one value.If an item has a namespace it is formatted <namespace>::<item-key>To Clear a namespace of all items, use the format (without any key specified): ‘<namespace>::' 
														) 
												) 
										) 
								) 
						) 
				) 
		) 
);
