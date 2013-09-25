<?php
return array(
        'min-zsversion' => '6.1',
        'console' => array(
                'router' => array(
                        'routes' => array(
                                // Library
                                'libraryGetStatus' => array(
                                        'options' => array(
                                                'route' => 'libraryGetStatus [--libraries=] [--direction=]',
                                                'defaults' => array(
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'libraryGetStatus'
                                                )
                                        ),
                                        'info' => array(
                                                'Get the list of libraries currently deployed on the server or the cluster, and information about each library’s available versions.'
                                        ),
                                        'arrays' => array(
                                                'libraries'
                                        )
                                ),
                                'libraryVersionCheckDependents' => array(
                                        'options' => array(
                                                'route' => 'libraryVersionCheckDependents [--libraryVersionId=]',
                                                'defaults' => array(
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'libraryVersionCheckDependents'
                                                )
                                        ),
                                        'info' => array(
                                                'Check if a library version has another application or library which depends on it.'
                                        )
                                ),
                                'libraryCheckDependents' => array(
                                        'options' => array(
                                                'route' => 'libraryCheckDependents [--libraryId=]',
                                                'defaults' => array(
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'libraryCheckDependents'
                                                )
                                        ),
                                        'info' => array(
                                                'Check if a library has another application or library which depends on it.'
                                        )
                                ),
                                'libraryVersionsRemove' => array(
                                        'options' => array(
                                                'route' => 'libraryVersionsRemove --libraryId= [--ignoreFailures=]',
                                                'defaults' => array(
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'libraryVersionsRemove'
                                                )
                                        ),
                                        'info' => array(
                                                'Remove existing library versions'
                                        )
                                ),
                                'libraryVersionDeploy' => array(
                                        'options' => array(
                                                'route' => 'libraryVersionDeploy --libPackage= [--ignoreFailures=]',
                                                'defaults' => array(
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'libraryVersionDeploy',
                                                        'apiMethod' => 'post'
                                                )
                                        ),
                                        'info' => array(
                                                'Deploy a new library version to the server or cluster'
                                        ),
                                        'files' => array(
                                                'libPackage'
                                        ),
                                ),
                                'libraryRemove' => array(
                                        'options' => array(
                                                'route' => 'libraryRemove --libraryIds= [--ignoreFailures=]',
                                                'defaults' => array(
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'libraryRemove'
                                                )
                                        ),
                                        'arrays' => array(
                                                'libraryIds'
                                        ),
                                        'info' => array(
                                                'Remove existing library/ies'
                                        )
                                ),
                                'libraryVersionSynchronize' => array(
                                        'options' => array(
                                                'route' => 'libraryVersionSynchronize --libraryVersionId=',
                                                'defaults' => array(
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'libraryVersionSynchronize',
                                                        'apiMethod' => 'post'
                                                )
                                        ),
                                        'info' => array(
                                                'Cause the library version to be deployed again from its original package file'
                                        ),
                                ),
                                'downloadLibraryVersionFile' => array(
                                        'options' => array(
                                                'route' => 'downloadLibraryVersionFile --libraryVersionId=',
                                                'defaults' => array(
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'downloadLibraryVersionFile'
                                                )
                                        ),
                                        'info' => array(
                                                'Download the .zpk file specified by the library version identifier'
                                        )
                                ),
                                'libraryVersionGetStatus' => array(
                                        'options' => array(
                                                'route' => 'libraryVersionGetStatus --libraryVersionId=',
                                                'defaults' => array(
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'libraryVersionGetStatus'
                                                )
                                        ),
                                        'info' => array(
                                                'Get the library version ID that is deployed on the server or the cluster, and information about that version and its library.'
                                        ),
                                ),
                        )
                )
        )
);
