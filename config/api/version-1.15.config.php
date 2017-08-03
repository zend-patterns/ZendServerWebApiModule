<?php

return array(
		'min-zsversion' => '9.2',
		'console' => array(
				'router' => array(
						'routes' => array(
								// Deployment
								'applicationAttachVhosts' => array (
										'options' => array (
												'route' => 'applicationAttachVhosts --appId= --vhosts=',
												'defaults' => array(
														'controller' => 'webapi-api-controller',
														'action' => 'applicationAttachVhosts',
														'apiMethod' => 'post'
												),
												'arrays' => array(
														'vhosts',
												),
												'group' => 'deployment',
												'info' => array(
														'Attach Virtual hosts to application.',
														array('--appId','Application id.'),
														array('--vhosts','Array with virtual hosts ids'),
												)
										)
								),
								
								'applicationDetachVhosts' => array (
										'options' => array (
												'route' => 'applicationDetachVhosts --appId= --vhosts=',
												'defaults' => array(
														'controller' => 'webapi-api-controller',
														'action' => 'applicationDetachVhosts',
														'apiMethod' => 'post'
												),
												'arrays' => array(
														'vhosts',
												),
												'group' => 'deployment',
												'info' => array(
														'Detach Virtual hosts from application.',
														array('--appId','Application id.'),
														array('--vhosts','Array with virtual hosts ids'),
												)
										)
								),
								
								'getApplicationsSimpleList' => array (
										'options' => array (
												'route' => 'getApplicationsSimpleList',
												'defaults' => array(
														'controller' => 'webapi-api-controller',
														'action' => 'getApplicationsSimpleList',
														'apiMethod' => 'post'
												),
												'group' => 'deployment',
												'info' => array(
														'Simple application list: id -> name.',
												)
										)
								),
								
								// Data Cache
								'dataCachePulseStatus' => array (
										'options' => array (
												'route' => 'dataCachePulseStatus',
												'defaults' => array(
														'controller' => 'webapi-api-controller',
														'action' => 'dataCachePulseStatus',
														'apiMethod' => 'get'
												),
												'group' => 'datacache',
												'info' => array(
														'Get the data cache status.',
												)
										)
								),
								
								'dataCacheCollectTask' => array (
										'options' => array (
												'route' => 'dataCacheCollectTask',
												'defaults' => array(
														'controller' => 'webapi-api-controller',
														'action' => 'dataCacheCollectTask',
														'apiMethod' => 'get'
												),
												'group' => 'datacache',
												'info' => array(
														'Set a task for calculation of data cache statistics sizes.',
												)
										)
								),
								
								'dataCachePulseExecutions' => array (
										'options' => array (
												'route' => 'dataCachePulseExecutions',
												'defaults' => array(
														'controller' => 'webapi-api-controller',
														'action' => 'dataCachePulseExecutions',
														'apiMethod' => 'get'
												),
												'group' => 'datacache',
												'info' => array(
														'Set a task for calculation of data cache statistics sizes.',
												)
										)
								),
								
								'dataCachePulseMetadata' => array (
										'options' => array (
												'route' => 'dataCachePulseMetadata',
												'defaults' => array(
														'controller' => 'webapi-api-controller',
														'action' => 'dataCachePulseMetadata',
														'apiMethod' => 'get'
												),
												'group' => 'datacache',
												'info' => array(
														'Get the data cache metadata, like disk size and disk entries.',
												)
										)
								),
								
								'dataCacheStatistics' => array (
										'options' => array (
												'route' => 'dataCacheStatistics',
												'defaults' => array(
														'controller' => 'webapi-api-controller',
														'action' => 'dataCacheStatistics',
														'apiMethod' => 'get'
												),
												'group' => 'datacache',
												'info' => array(
														'Get the list data cache pulse statistics.',
												)
										)
								),
								
						) // end of routes
				)
		)
);