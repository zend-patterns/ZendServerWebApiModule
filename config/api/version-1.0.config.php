<?php
return array (
		'console' => array (
				'router' => array (
						'routes' => array (
								'configurationExport' => array (
										'options' => array (
												'route' => 'zsapi configurationExport [--directivesBlacklist=] [--snapshotName=]',
												'defaults' => array (
														'controller' => 'ZendServerWebApi\Controller\ZendServer',
														'action' => 'configurationExport' 
												) 
										) 
								),
								'configurationImport' => array (
										'options' => array (
												'route' => 'zsapi configurationImport --configFile= [--ignoreSystemMismatch=]',
												'defaults' => array (
														'controller' => 'ZendServerWebApi\Controller\ZendServer',
														'action' => 'configurationImport',
														'apiMethod' => 'post' 
												) 
										) 
								),
								'getSystemInfo' => array (
										'options' => array (
												'route' => 'zsapi getSystemInfo',
												'defaults' => array (
														'controller' => 'ZendServerWebApi\Controller\ZendServer',
														'action' => 'getSystemInfo' 
												) 
										) 
								),
								'clusterGetServersStatus' => array (
										'options' => array (
												'route' => 'zsapi clusterGetServersStatus [--servers=] [--forec=]',
												'defaults' => array (
														'controller' => 'ZendServerWebApi\Controller\ZendServer',
														'action' => 'clusterGetServersStatus' 
												) 
										) 
								),
								'clusterAddServer' => array (
										'options' => array (
												'route' => 'zsapi clusterAddServer --serverName= --serverIp=',
												'defaults' => array (
														'controller' => 'ZendServerWebApi\Controller\ZendServer',
														'action' => 'changeServerNameById',
														'apiMethod' => 'post' 
												) 
										) 
								),
								'clusterRemoveServer' => array (
										'options' => array (
												'route' => 'zsapi clusterRemoveServer --serverId=',
												'defaults' => array (
														'controller' => 'ZendServerWebApi\Controller\ZendServer',
														'action' => 'clusterRemoveServer',
														'apiMethod' => 'post' 
												) 
										) 
								),
								'clusterDisableServer' => array (
										'options' => array (
												'route' => 'zsapi clusterDisableServer --serverId=',
												'defaults' => array (
														'controller' => 'ZendServerWebApi\Controller\ZendServer',
														'action' => 'clusterDisableServer',
														'apiMethod' => 'post' 
												) 
										) 
								),
								'clusterEnableServer' => array (
										'options' => array (
												'route' => 'zsapi clusterEnableServer --serverId=',
												'defaults' => array (
														'controller' => 'ZendServerWebApi\Controller\ZendServer',
														'action' => 'clusterEnableServer',
														'apiMethod' => 'post' 
												) 
										) 
								),
								'clusterReconfigureServer' => array (
										'options' => array (
												'route' => 'zsapi clusterReconfigureServer --serverId= [--doRestart=]',
												'defaults' => array (
														'controller' => 'ZendServerWebApi\Controller\ZendServer',
														'action' => 'clusterReconfigureServer',
														'apiMethod' => 'post' 
												) 
										) 
								),
								'restartPHP' => array (
										'options' => array (
												'route' => 'zsapi restartPHP [--servers=] [--force=] [--parallelRestart=]',
												'defaults' => array (
														'controller' => 'ZendServerWebApi\Controller\ZendServer',
														'action' => 'restartPHP',
														'apiMethod' => 'post' 
												) 
										) 
								) 
						) 
				) 
		) 
);