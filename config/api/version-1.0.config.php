<?php
return array (
        'console' => array (
                'router' => array (
                        'routes' => array (
                                'configurationExport' => array (
                                        'options' => array (
                                                'route' => 'configurationExport [--directivesBlacklist=] [--snapshotName=]',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'configurationExport'
                                                ),
                                                'arrays' => array(
                                                        'directivesBlacklist'
                                                )
                                        )
                                ),
                                'configurationImport' => array (
                                        'options' => array (
                                                'route' => 'configurationImport --configFile= [--ignoreSystemMismatch=]',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'configurationImport',
                                                        'apiMethod' => 'post'
                                                ),
                                                'files'=>array(
                                                        'configFile'
                                                )
                                        )
                                ),
                                'getSystemInfo' => array (
                                        'options' => array (
                                                'route' => 'getSystemInfo',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'getSystemInfo'
                                                )
                                        )
                                ),
                                'clusterGetServersStatus' => array (
                                        'options' => array (
                                                'route' => 'clusterGetServersStatus [--servers=] [--forec=]',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'clusterGetServersStatus'
                                                )
                                        )
                                ),
                                'clusterAddServer' => array (
                                        'options' => array (
                                                'route' => 'clusterAddServer --serverName= --serverIp=',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'changeServerNameById',
                                                        'apiMethod' => 'post'
                                                )
                                        )
                                ),
                                'clusterRemoveServer' => array (
                                        'options' => array (
                                                'route' => 'clusterRemoveServer --serverId=',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'clusterRemoveServer',
                                                        'apiMethod' => 'post'
                                                )
                                        )
                                ),
                                'clusterDisableServer' => array (
                                        'options' => array (
                                                'route' => 'clusterDisableServer --serverId=',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'clusterDisableServer',
                                                        'apiMethod' => 'post'
                                                )
                                        )
                                ),
                                'clusterEnableServer' => array (
                                        'options' => array (
                                                'route' => 'clusterEnableServer --serverId=',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'clusterEnableServer',
                                                        'apiMethod' => 'post'
                                                )
                                        )
                                ),
                                'clusterReconfigureServer' => array (
                                        'options' => array (
                                                'route' => 'clusterReconfigureServer --serverId= [--doRestart=]',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'clusterReconfigureServer',
                                                        'apiMethod' => 'post'
                                                )
                                        )
                                ),
                                'restartPHP' => array (
                                        'options' => array (
                                                'route' => 'restartPHP [--servers=] [--force=] [--parallelRestart=]',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'restartPHP',
                                                        'apiMethod' => 'post'
                                                )
                                        )
                                )
                        )
                )
        )
);
