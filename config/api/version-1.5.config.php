<?php
return array (
		'console' => array (
				'router' => array (
						'routes' => array (
								'libraryGetStatus' => array (
										'options' => array (
												'route' => 'libraryGetStatus [--libraries=] [--direction=]',
												'defaults' => array (
														'controller' => 'webapi-api-controller',
														'action' => 'libraryGetStatus' 
												),
												'arrays' => array(
													'libraries',
												),
										),
										'info' => array (
												'Get the list of libraries currently deployed on the server or the cluster, and information about each library’s available versions.' 
										) 
								),
								'libraryVersionCheckDependents' => array (
										'options' => array (
												'route' => 'libraryVersionCheckDependents --libraryVersionId=',
												'defaults' => array (
														'controller' => 'webapi-api-controller',
														'action' => 'libraryVersionCheckDependents'
												)
										),
										'info' => array (
												'Check if a library version has another application or library which depends on it.'
										)
								),
								'libraryCheckDependents' => array (
										'options' => array (
												'route' => 'libraryCheckDependents --libraryId=',
												'defaults' => array (
														'controller' => 'webapi-api-controller',
														'action' => 'libraryCheckDependents',
														
												)
										),
										'info' => array (
												'Check if a library has another application or library which depends on it.'
										)
								),
								'libraryVersionRemove' => array (
										'options' => array (
												'route' => 'libraryVersionRemove --libraryVersionId= [--ignoreFailures]',
												'defaults' => array (
														'controller' => 'webapi-api-controller',
														'action' => 'libraryVersionRemove',
														'apiMethod' => 'post'
												)
										),
										'info' => array (
												'Remove existing library versions.'
										)
								),
								'libraryVersionDeploy' => array (
										'options' => array (
												'route' => 'libraryVersionDeploy --libPackage= [--ignoreFailures]',
												'defaults' => array (
														'controller' => 'webapi-api-controller',
														'action' => 'libraryVersionDeploy',
														'apiMethod' => 'post',
												),
												'files' => array(
														'libPackage',
												),
										),
										'info' => array (
												'Deploy a new library version to the server or cluster.'
										)
								),
								'libraryRemove' => array (
										'options' => array (
												'route' => 'libraryRemove --libraryIds= [--ignoreFailures]',
												'defaults' => array (
														'controller' => 'webapi-api-controller',
														'action' => 'libraryRemove',
														'apiMethod' => 'post',
												),
												'arrays' => array(
														'libraryIds',
												),
										),
										'info' => array (
												'Remove existing library/ies'
										)
								),
								'libraryVersionSynchronize' => array (
										'options' => array (
												'route' => 'libraryVersionSynchronize --libraryVersionId=',
												'defaults' => array (
														'controller' => 'webapi-api-controller',
														'action' => 'libraryVersionSynchronize',
														'apiMethod' => 'post',
												),
										),
										'info' => array (
												'Cause the library version to be deployed again from its original package file.'
										)
								),
								'downloadLibraryVersionFile' => array (
										'options' => array (
												'route' => 'downloadLibraryVersionFile --libraryVersionId=',
												'defaults' => array (
														'controller' => 'webapi-api-controller',
														'action' => 'downloadLibraryVersionFile'
												),
										),
										'info' => array (
												'Download the .zpk file specified by the library version identifier.'
										)
								),
								'libraryVersionGetStatus' => array (
										'options' => array (
												'route' => 'libraryVersionGetStatus --libraryVersionId=',
												'defaults' => array (
														'controller' => 'webapi-api-controller',
														'action' => 'libraryVersionGetStatus'
												),
										),
										'info' => array (
												'Get the library version ID that is deployed on the server or the cluster, and information about that version and its library.'
										)
								),
						) 
				) 
		) 
);
