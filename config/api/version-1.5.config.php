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
												'group' => 'library',
												'info' => array (
														'Get the list of libraries currently deployed on the server or the cluster, and information about each library’s available versions.',
														array('--libraries','List of library IDs. If specified, information will be returned about these applications only. If not specified, information about all applications will be returned. Note that if a non-existing application ID is provided, this action will not fail but instead will return no information about the specific app.'),
														array('--direction','One of ASC|DESC. Sets the ordering direction. Ordering is always by User application name')
												)
										),
										
								),
								'libraryVersionCheckDependents' => array (
										'options' => array (
												'route' => 'libraryVersionCheckDependents --libraryVersionId=',
												'defaults' => array (
														'controller' => 'webapi-api-controller',
														'action' => 'libraryVersionCheckDependents'
												),
												'group' => 'library',
												'info' => array (
														'Check if a library version has another application or library which depends on it.',
														array('--libraryVersionId','A library version id for checking prerequisites.')
												)
										),
										
								),
								'libraryCheckDependents' => array (
										'options' => array (
												'route' => 'libraryCheckDependents --libraryId=',
												'defaults' => array (
														'controller' => 'webapi-api-controller',
														'action' => 'libraryCheckDependents',
														
												),
												'group' => 'library',
												'info' => array (
														'Check if a library has another application or library which depends on it.',
														array('--libraryId','A library version id for checking prerequisites.')
												)
										),
								),
								'libraryVersionRemove' => array (
										'options' => array (
												'route' => 'libraryVersionRemove --libraryVersionId= [--ignoreFailures=]',
												'defaults' => array (
														'controller' => 'webapi-api-controller',
														'action' => 'libraryVersionRemove',
														'apiMethod' => 'post'
												),
												'group' => 'library',
												'info' => array (
														'Remove existing library versions.',
														array('--libraryVersionId','Library Version IDs to remove. In case of empty array no version is not removed .'),
														array('--ignoreFailures','Ignore failures during removing library versions if only some servers reported failures; If all servers report failures the operation will fail in any case. The default value is FALSE – meaning any failure will return an error.'),
												)
										),
								),
								'libraryVersionDeploy' => array (
										'options' => array (
												'route' => 'libraryVersionDeploy --libPackage= [--ignoreFailures=]',
												'defaults' => array (
														'controller' => 'webapi-api-controller',
														'action' => 'libraryVersionDeploy',
														'apiMethod' => 'post',
												),
												'files' => array(
														'libPackage',
												),
												'group' => 'library',
												'info' => array (
														'Deploy a new library version to the server or cluster.',
														array('--libPackage','Library package file.'),
														array('--ignoreFailures','Ignore failures during removing library versions if only some servers reported failures; If all servers report failures the operation will fail in any case. The default value is FALSE – meaning any failure will return an error.'),
												)
										)
								),
								'libraryRemove' => array (
										'options' => array (
												'route' => 'libraryRemove --libraryIds= [--ignoreFailures=]',
												'defaults' => array (
														'controller' => 'webapi-api-controller',
														'action' => 'libraryRemove',
														'apiMethod' => 'post',
												),
												'arrays' => array(
														'libraryIds',
												),
												'group' => 'library',
												'info' => array (
														'Remove existing library/ies',
														array('--libraryIds','Library IDs to remove. In case of empty array, no library is removed .'),
														array('--ignoreFailures','Ignore failures during removing library versions if only some servers reported failures; If all servers report failures the operation will fail in any case. The default value is FALSE – meaning any failure will return an error.'),
												)
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
												'group' => 'library',
												'info' => array (
														'Cause the library version to be deployed again from its original package file.',
														array('--libraryVersionId','Library version ID.')
												)
										)
								),
								'downloadLibraryVersionFile' => array (
										'options' => array (
												'route' => 'downloadLibraryVersionFile --libraryVersionId=',
												'defaults' => array (
														'controller' => 'webapi-api-controller',
														'action' => 'downloadLibraryVersionFile'
												),
												'group' => 'library',
												'info' => array (
														'Download the .zpk file specified by the library version identifier.',
														array('--libraryVersionId','A library version ID.')
												)
										)
								),
								'libraryVersionGetStatus' => array (
										'options' => array (
												'route' => 'libraryVersionGetStatus --libraryVersionId=',
												'defaults' => array (
														'controller' => 'webapi-api-controller',
														'action' => 'libraryVersionGetStatus'
												),
												'group' => 'library',
												'info' => array (
														'Get the library version ID that is deployed on the server or the cluster, and information about that version and its library.',
														array('--libraryVersionId','Library version identifier. Note that a codetracing identifier is provided as part of the LibraryGetStatus xml response.')
												)
										)
								),
						) 
				) 
		) 
);
