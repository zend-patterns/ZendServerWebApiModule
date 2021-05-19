<?php
return array(
    'min-zsversion' => '8.1',
    'console' => array(
        'router' => array(
            'routes' => array(
                // JQ methods 
                'jobqueueGetQueues' => array(
                    'options' => array(
                        'route' => 'jobqueueGetQueues',
                        'defaults' => array(
                            'controller' => 'webapi-api-controller',
                            'action' => 'jobqueueGetQueues',
                            'apiMethod' => 'get'
                        ),
                        'group' => 'jobqueue',
                        'info' => array(
                            'Get list of all jobqueue queues.',
                        )
                    )
                ),
                'jobqueueCreateQueue' => array(
                    'options' => array(
                        'route' => 'jobqueueCreateQueue --name= [--status=] [--priority=] [--max_http_jobs=] [--max_wait_time=] [--connection_timeout=] [--http_job_timeout=] [--http_job_retry_count=] [--http_job_retry_timeout=]',
                        'defaults' => array(
                            'controller' => 'webapi-api-controller',
                            'action' => 'jobqueueCreateQueue',
                            'apiMethod' => 'post'
                        ),
                        'group' => 'jobqueue',
                        'info' => array(
                            'Add new queue to Jobqueue queues list, and get back the new created ID.',
                            array('--name', 'The unique name of the new queue. Length: 2 - 32 characters.'),
                            array('--status', 'Can be 1 (active) or 2 (suspended). Default is 1.'),
                            array('--priority', 'Value between 0 and 4. (4 is highest priority). Default is 2.'),
                            array('--max_http_jobs', 'Max concurrent jobs in this queue. Default is 5.'),
                            array('--max_wait_time', 'Max waiting time for a job inside a queue. used to avoid starvation. Default is 5.'),
                            array('--connection_timeout', 'Number of seconds the daemon tries to establish a connection with a back-end server. Default is 30.'),
                            array('--http_job_timeout', 'Number of seconds a URL-based job must be completed. Default is 120.'),
                            array('--http_job_retry_count', 'Number of retries for failed HTTP jobs. Default is 10.'),
                            array('--http_job_retry_timeout', 'The number of seconds between retries for failed HTTP jobs. Default is 1.'),
                        )
                    )
                ),
                'jobqueueUpdateQueue' => array(
                    'options' => array(
                        'route' => 'jobqueueUpdateQueue --id= [--name=] [--status=] [--priority=] [--max_http_jobs=] [--max_wait_time=] [--connection_timeout=] [--http_job_timeout=] [--http_job_retry_count=] [--http_job_retry_timeout=]',
                        'defaults' => array(
                            'controller' => 'webapi-api-controller',
                            'action' => 'jobqueueUpdateQueue',
                            'apiMethod' => 'post'
                        ),
                        'group' => 'jobqueue',
                        'info' => array(
                            'Update queue in queues list.',
                            array('--id', 'The ID of the queue.'),
                            array('--name', 'The unique name of the new queue. Length: 2 - 32 characters.'),
                            array('--status', 'Can be 1 (active) or 2 (suspended). Default is 1.'),
                            array('--priority', 'Value between 0 and 4. (4 is highest priority). Default is 2.'),
                            array('--max_http_jobs', 'Max concurrent jobs in this queue. Default is 5.'),
                            array('--max_wait_time', 'Max waiting time for a job inside a queue. used to avoid starvation. Default is 5.'),
                            array('--connection_timeout', 'Number of seconds the daemon tries to establish a connection with a back-end server. Default is 30.'),
                            array('--http_job_timeout', 'Number of seconds a URL-based job must be completed. Default is 120.'),
                            array('--http_job_retry_count', 'Number of retries for failed HTTP jobs. Default is 10.'),
                            array('--http_job_retry_timeout', 'The number of seconds between retries for failed HTTP jobs. Default is 1.'),
                        )
                    )
                ),
                'jobqueueDeleteQueue' => array(
                    'options' => array(
                        'route' => 'jobqueueDeleteQueue --id= [--delete_related_stuff=]',
                        'defaults' => array(
                            'controller' => 'webapi-api-controller',
                            'action' => 'jobqueueDeleteQueue',
                            'apiMethod' => 'post'
                        ),
                        'group' => 'jobqueue',
                        'info' => array(
                            'Update queue in queues list.',
                            array('--id', 'The ID of the queue.'),
                            array('--delete_related_stuff', 'Delete related rules and future jobs (pending, scheduled and suspended). The value can be 0 or 1. Default is 0.'),
                        )
                    )
                ),
                'jobqueueSuspendQueue' => array(
                    'options' => array(
                        'route' => 'jobqueueSuspendQueue --id=',
                        'defaults' => array(
                            'controller' => 'webapi-api-controller',
                            'action' => 'jobqueueSuspendQueue',
                            'apiMethod' => 'post'
                        ),
                        'group' => 'jobqueue',
                        'info' => array(
                            'Suspend queue. "Pause" queue\'s jobs.',
                            array('--id', 'The ID of the queue.'),
                        )
                    )
                ),
                'jobqueueImportQueues' => array(
                    'options' => array(
                        'route' => 'jobqueueImportQueues --delete_current= --file=',
                        'defaults' => array(
                            'controller' => 'webapi-api-controller',
                            'action' => 'jobqueueImportQueues',
                            'apiMethod' => 'post'
                        ),
                        'files'=>array(
                            'file'
                        ),
                        'group' => 'jobqueue',
                        'info' => array(
                            'Import action for queues. Upload the backup file using this web api.',
                            array('--delete_current', 'Accepts 1 or 0. 1 is to delete the current queues before import'),
                            array('--file', 'Location of the file to be imported.'),
                        )
                    )
                ),
                'jobqueueExportQueues' => array(
                    'options' => array(
                        'route' => 'jobqueueExportQueues',
                        'defaults' => array(
                            'controller' => 'webapi-api-controller',
                            'action' => 'jobqueueExportQueues',
                            'apiMethod' => 'get'
                        ),
                        'group' => 'jobqueue',
                        'info' => array(
                            'Get the backup file for the queues. The file is zipped sql file.',
                        )
                    )
                ),
                'jobqueueQueueStats' => array(
                    'options' => array(
                        'route' => 'jobqueueQueueStats [--queue_id=]',
                        'defaults' => array(
                            'controller' => 'webapi-api-controller',
                            'action' => 'jobqueueQueueStats',
                            'apiMethod' => 'get'
                        ),
                        'group' => 'jobqueue',
                        'info' => array(
                            'Get queue live statistics - running and pending jobs.',
                            array('--queue_id', 'Get statistics for the requested queue only.'),
                        )
                    )
                ),
            	'jobqueueActivateQueue' => array(
            		'options' => array(
            			'route' => 'jobqueueActivateQueue [--id=]',
            			'defaults' => array(
            				'controller' => 'webapi-api-controller',
            					'action' => 'jobqueueActivateQueue',
            					'apiMethod' => 'post'
            			),
            			'group' => 'jobqueue',
            			'info' => array(
            				'Reactivates a queue. Un-pauses queue jobs.',
            				array('--id', 'The ID of the queue.'),
            			)
            		)
            	),

                // IDE integration
                'debuggerSettings' => array(
                    'options' => array(
                        'route' => 'debuggerSettings --activeDebugger= [--studioAllowedHostsList=] [--studioDeniedHostsList=] [--studioAutoDetection=] [--studioHost=] [--studioAutoDetectionEnabled=] [--studioPort=] [--studioUseSsl=] [--studioBreakOnFirstLine=] [--studioUseRemote=] [--remote_enable=] [--remote_handler=] [--remote_host=] [--remote_port=]',
                        'defaults' => array(
                            'controller' => 'webapi-api-controller',
                            'action' => 'debuggerSettings',
                            'apiMethod' => 'post'
                        ),
                        'group' => 'jobqueue',
                        'info' => array(
                            'Choose preferred debugger - zend debugger, xdebug or none, and change debugger settings.',
                            array('--activeDebugger', 'Debugger name: "Zend Debugger", "xdebug" or "none"'),
                            array('--studioAllowedHostsList', 'Comma separated list of allowed hosts. Example: 1.2.3.4/32,5.6.7.8/16.'),
                            array('--studioDeniedHostsList', 'Comma separated list of denied hosts. Example: 1.2.3.4/32,5.6.7.8/16.'),
                            array('--studioAutoDetection', '1 or 0. Auto-detect IDE settings.'),
                            array('--studioHost', 'Host IP/name.'),
                            array('--studioAutoDetectionEnabled', '1 or 0. Detect IDE IP/host automatically by the browser IP.'),
                            array('--studioPort', 'IDE port.'),
                            array('--studioUseSsl', '1 or 0. Connect with IDE using SSL.'),
                            array('--studioBreakOnFirstLine', '1 or 0. Tell the debugger to break on first line.'),
                            array('--studioUseRemote', '1 or 0. 1 is to use local copy if available.'),
                            array('--remote_enable', 'Xdebug setting: 1 or 0.  Use local copy if available'),
                            array('--remote_handler', 'Xdebug setting: Allowed values are "php3", "gdb", or "dbgp". xdebug 2.1 and higher supports only "dbgp" protocol'),
                            array('--remote_host', 'Xdebug setting: IDE host/IP.'),
                            array('--remote_port', 'Xdebug setting: IDE port.'),
                        )
                    )
                ),
                
                // Z-Ray
                'zrayCreateSelectiveAccess' => array(
                    'options' => array(
                        'route' => 'zrayCreateSelectiveAccess --iprange= --ttl= [--baseUrl=] [--title=] [--token=] [--actions=] [--inject=]',
                        'defaults' => array(
                            'controller' => 'webapi-api-controller',
                            'action' => 'zrayCreateSelectiveAccess',
                            'apiMethod' => 'post'
                        ),
                        'group' => 'zray',
                        'info' => array(
                            'Generate a random selective access for use in Z-Ray Selective Access mode.',
                            array('--iprange', 'IP Range allowed access to Z-Ray with this token. The iprange can be any ip address or CIDR range.'),
                            array('--ttl', 'Limit this token’s access to expire after the given time in seconds is passed'),
                            array('--title', 'Title, name or description of the access token. This field is not used for anything but display'),
                            array('--token', 'Define if the token is required. Default - true.'),
                            array('--actions', 'Allows server-side actions from Z-Ray. Default - false.'),
                            array('--inject', 'Display Z-Ray on all pages open in a browser. Default - true.'),
                        )
                    )
                ),
                
                // Z-Ray Plugins
                'pluginDeploy' => array(
                    'options' => array(
                        'route' => 'pluginDeploy --pluginPackage=',
                        'defaults' => array(
                            'controller' => 'webapi-api-controller',
                            'action' => 'pluginDeploy',
                            'apiMethod' => 'post'
                        ),
                        'files' => array (
                            'pluginPackage'
                        ),
                        'group' => 'plugins',
                        'info' => array(
                            'Deploys a plugin.',
                            array('--pluginPackage', 'Deploy package file. Content type for the file must be ‘application/vnd.zend.pluginpackage’.'),
                        )
                    )
                ),
                'pluginUpdate' => array(
                    'options' => array(
                        'route' => 'pluginUpdate --pluginPackage=',
                        'defaults' => array(
                            'controller' => 'webapi-api-controller',
                            'action' => 'pluginUpdate',
                            'apiMethod' => 'post'
                        ),
                        'files' => array (
                             'pluginPackage'  
                        ),
                        'group' => 'plugins',
                        'info' => array(
                            'Updates a plugin.',
                            array('--pluginPackage', 'Deploy package file. Content type for the file must be ‘application/vnd.zend.pluginpackage’.'),
                        )
                    )
                ),
                'disablePlugins' => array(
                    'options' => array(
                        'route' => 'disablePlugins --plugins=',
                        'defaults' => array(
                            'controller' => 'webapi-api-controller',
                            'action' => 'disablePlugins',
                            'apiMethod' => 'post'
                        ),
                        'arrays' => array (
                            'plugins'
                        ),
                        'group' => 'plugins',
                        'info' => array(
                            'Disable plugin entries.',
                            array('--plugins', 'Comma separated list of plugin identifiers.'),
                        )
                    )
                ),
                'pluginRemove' => array(
                    'options' => array(
                        'route' => 'pluginRemove --pluginId=',
                        'defaults' => array(
                            'controller' => 'webapi-api-controller',
                            'action' => 'pluginRemove',
                            'apiMethod' => 'post'
                        ),
                        'group' => 'plugins',
                        'info' => array(
                            'Remove a plugin.',
                            array('--pluginId', 'Plugin identifier.'),
                        )
                    )
                ),
                
                'pluginSynchronize' => array(
                    'options' => array(
                        'route' => 'pluginSynchronize --pluginId=',
                        'defaults' => array(
                            'controller' => 'webapi-api-controller',
                            'action' => 'pluginSynchronize',
                            'apiMethod' => 'post'
                        ),
                        'group' => 'plugins',
                        'info' => array(
                            'Redeploys a plugin.',
                            array('--pluginId', 'Plugin identifier.'),
                        )
                    )
                ),
                
                'enablePlugins' => array(
                    'options' => array(
                        'route' => 'enablePlugins --plugins=',
                        'defaults' => array(
                            'controller' => 'webapi-api-controller',
                            'action' => 'enablePlugins',
                            'apiMethod' => 'post'
                        ),
                        'arrays' => array (
                            'plugins'
                        ),
                        'group' => 'plugins',
                        'info' => array(
                            'Enable plugin entries.',
                            array('--plugins', 'Comma separated list of plugin identifiers.'),
                        )
                    )
                ),
                
                'pluginGetList' => array(
                    'options' => array(
                        'route' => 'pluginGetList [--order=] [--direction=]',
                        'defaults' => array(
                            'controller' => 'webapi-api-controller',
                            'action' => 'pluginGetList',
                            'apiMethod' => 'get'
                        ),
                        'group' => 'plugins',
                        'info' => array(
                            'Get a list of plugin entries.',
                            array('--order', 'Column identifier for sorting the result set (id, name, version, creationTimeTimestamp). Default is id.'),
                            array('--direction', 'Sorting direction: ASC or DESC. Default is DESC'),
                        )
                    )
                ),
            		
            		
            	// Server Profile
            	
            	'getServerProfile' => array(
            			'options' => array(
            				'route' => 'getServerProfile',
            				'defaults' => array(
            					'controller' => 'webapi-api-controller',
            					'action' => 'getServerProfile',
            					'apiMethod' => 'get'
            				),
            				'group' => 'server',
            				'info' => array(
            					'Gets the server profile: Development or Production .',
            				)
            			)
            	),

            	'setServerProfile' => array(
            			'options' => array(
            				'route' => 'setServerProfile [--production=]',
            				'defaults' => array(
            					'controller' => 'webapi-api-controller',
            					'action' => 'setServerProfile',
            					'apiMethod' => 'post',
            					'production' => 'true',
            				),
            				'group' => 'server',
            				'info' => array(
            					'Sets the server profile after the server was bootsraped: Development or Production.',
            					array('--production', 'Production flag. If "true" - sets production mode, if "false" - development. By default TRUE.'),
            				)
            			)
            	),
           )
        )
    )
);