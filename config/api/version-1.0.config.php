<?php
return array (
        'min-zsversion' => '5.3',
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
                                                ),
                                        		'group' => 'configuration',
                                        		'info' => array(
                                        			'Export the current server/cluster configuration into a file.',
                                        			array('--directivesBlacklist', 'Added in v1.3. Allows passing an array of blacklist directives which will not be exported. If the parameter is not passed, the list of blacklist directives is taken from <ZendGuiDir>/config/autoload/global.config.php.'),
                                        			array('--snapshotName', 'Added in v1.3. If this argument is passed, then a a snapshot will be created from the exported configuration. If such snapshot already exists, then the command will fail.'),
                                        			array('Example:','configurationExport --directivesBlacklist="zend_optimizerplus.blacklist_filename,pgsql.auto_reset_persistent"'),
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
                                                ),
                                        		'group' => 'configuration',
                                        		'info' => array (
                                        				'Import a saved configuration snapshot into the server.',
                                        				array('--configFile','The configuration snapshot file to import.'),
                                        				array('--ignoreSystemMismatch','If set to TRUE, configuration must be applied even if it was exported from a different system (other major PHP version, Zend Server version or operating system). The default value is FALSE.'),
												)
                                        )
                                ),
                                'getSystemInfo' => array (
                                        'options' => array (
                                                'route' => 'getSystemInfo',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'getSystemInfo'
                                                ),
                                        		'group' => 'server',
                                        		'info' => array (
                                        				'Use this method to get information about the system, including the Zend Server edition and version, PHP version, licensing information, etc. This method produces similar output on all Zend Server systems, and is future compatible.',
                                        		)
                                        )
                                ),
                                'clusterGetServersStatus' => array (
                                        'options' => array (
                                                'route' => 'clusterGetServersStatus [--servers=] [--force=]',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'clusterGetServersStatus'
                                                ),
                                        		'arrays' => array(
                                        				'servers'
                                                ),
                                        		'group' => 'server',
                                        		'info' => array (
                                        				'Use this method to get the list of servers in the cluster and the status of each one. On a Zend Server with no valid license, this operation fails. This operation causes Zend Server to check the status of servers and return fresh, non-cached information. This is different from the Servers List tab in the GUI, which may present cached information. Users interested in reducing load by caching this information should do it in their own code.',
                                        				array('--servers','A list of server IDs. If specified, the status is returned for these servers only. If not specified, the status of all the servers is returned.'),
                                        				array('--force',"Force. Default is false"),
                                        		)
                                        )
                                ),
                                'clusterAddServer' => array (
                                        'options' => array (
                                                'route' => 'clusterAddServer --serverName= --serverIp=',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'clusterAddServer',
                                                        'apiMethod' => 'post'
                                                ),
                                        		'group' => 'server',
                                        		'info' => array (
                                        				'Add a new server to the cluster. On a Zend Server Cluster Manager with no valid license, this operation fails.',
                                        				array('--serverName','Server name.'),
                                        				array('--serverIp','Server IP.'),
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
                                                ),
                                        		'group' => 'server',
                                        		'info' => array (
                                        				'This method removes a server from the cluster. The removal process may be asynchronous if Session Clustering is used. If this is the case, the initial operation will return an HTTP 202 response. As long as the server is not fully removed, further calls to remove the same server should be idempotent. On a Zend Server with no valid license, this operation fails.',
                                        				array('--serverId','Server ID.'),
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
                                                ),
                                        		'group' => 'server',
                                        		'info' => array (
                                        				'This method disables a cluster member. This process may be asynchronous if Session Clustering is used. If this is the case, the initial operation returns an HTTP 202 response. As long as the server is not fully disabled, further calls to this method are idempotent. On a Zend Server with no valid license, this operation fails.',
                                        				array('--serverId','Server ID.'),
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
                                                ),
                                        		'group' => 'server',
                                        		'info' => array (
                                        				'This method is used to re-enable a cluster member. This process may be asynchronous if Session Clustering is used. If this is the case, the initial operation will return an HTTP 202 response. This action is idempotent, and running it on an enabled server will result in a 200 OK response with no consequences. On a Zend Server with no valid license this operation fails.',
                                        				array('--serverId','Server ID.'),
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
                                                ),
                                        		'group' => 'server',
                                        		'info' => array (
                                        				"Re-configure a cluster member to match the cluster's profile. This operation will fail on a Zend Server with no valid license.",
                                        				array('--serverId','Server ID.'),
                                        				array('--doRestart',"Specify if the re-configured server should be restarted after the re-configure action. The default is FALSE."),
                                        		)
                                        )
                                ),
                                'restartPhp' => array (
                                        'options' => array (
                                                'route' => 'restartPhp [--servers=] [--force=] [--parallelRestart=]',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'restartPhp',
                                                        'apiMethod' => 'post'
                                                ),
                                        		'arrays' => array( 
                                        			'servers'
                                        		),
                                        		'group' => 'server',
                                        		'info' => array (
                                        				'This method restarts PHP on all servers or on specified servers in the cluster. A 202 response in this case does not always indicate a successful restart of all servers. Use the clusterGetServerStatus command to check the server(s) status again after a few seconds.',
                                        				array('--servers','A list of server IDs to restart. If not specified, all servers in the cluster will be restarted. In a single Zend Server context this parameter is ignored.'),
                                        				array('--force',"Force a full restart of all server’s components. The default value is 'FALSE'."),
                                        				array('--parallelRestart',"This parameter was removed in version 1.3 and has no effect on ZS6, even if used in 1.2 context"),
                                        		)
                                        )
                                )
                        )
                )
        )
);
