<?php

return array(
    'min-zsversion' => '9.1',
    'console' => array(
        'router' => array(
            'routes' => array(
               
            	// privacy
                'privacyGetStatus' => array(
                    'options' => array(
                        'route' => 'privacyGetStatus',
                        'defaults' => array(
                            'controller' => 'webapi-api-controller',
                            'action' => 'privacyGetStatus',
                            'apiMethod' => 'get'
                        ),
                        'group' => 'security',
                        'info' => array(
                            'Get privacy settings.',
                        )
                    )
                ),
            		
            	//  Monitoring
                'monitorGetJobsIssuesBySeverity' => array(
                    'options' => array(
                        'route' => 'monitorGetJobsIssuesBySeverity',
                        'defaults' => array(
                            'controller' => 'webapi-api-controller',
                            'action' => 'monitorGetJobsIssuesBySeverity',
                            'apiMethod' => 'get'
                        ),
                        'group' => 'monitor',
                        'info' => array(
                            'Get the events related to running job ordered by severity (from critical to warning)',
                        )
                    )
                ),
            		
            	// Job queue
            	'jobqueueJobInfo' => array(
            		'options' => array(
            			'route' => 'jobqueueJobInfo',
            			'defaults' => array(
            				'controller' => 'webapi-api-controller',
            				'action' => 'jobqueueJobInfo',
            				'apiMethod' => 'get'
            			),
            			'group' => 'jobqueue',
            			'info' => array(
            				'Retrieve a job info with job retries details if exists. The web API is since 1.3, but in 1.14 "retries" were added to the response.',
            			)
            		)
            	),
            		
            	'getJQPulseTypes' => array(
            		'options' => array(
            			'route' => 'getJQPulseTypes',
            			'defaults' => array(
            				'controller' => 'webapi-api-controller',
            				'action' => 'getJQPulseTypes',
            				'apiMethod' => 'get'
            			),
            			'group' => 'jobqueue',
            			'info' => array(
            				'Get the list Pulse types.',
            			)
            		)
            	),  
            		
            	'JQPulseStatus' => array(
            		'options' => array(
            			'route' => 'JQPulseStatus',
            			'defaults' => array(
            				'controller' => 'webapi-api-controller',
            				'action' => 'JQPulseStatus',
            				'apiMethod' => 'get'
            			),
            			'group' => 'jobqueue',
            			'info' => array(
            				'Get the jq Pulse status.',
            			)
            		)
            	),
            		
            	'JQFailedTypesExecutions' => array(
            		'options' => array(
            			'route' => 'JQFailedTypesExecutions',
            			'defaults' => array(
            				'controller' => 'webapi-api-controller',
            				'action' => 'JQFailedTypesExecutions',
            				'apiMethod' => 'get'
            			),
            			'group' => 'jobqueue',
            			'info' => array(
            				'Get the list of job failures.',
            			)
            		)
            	),
            		
            	'JQExecutions' => array(
            		'options' => array(
            			'route' => 'JQExecutions',
            			'defaults' => array(
            				'controller' => 'webapi-api-controller',
            				'action' => 'JQExecutions',
            				'apiMethod' => 'get'
            			),
            			'group' => 'jobqueue',
            			'info' => array(
            				'Get the list of job executions ordered by success and failures.',
            			)
            		)
            	),
            		
            	'JQExecutionStats' => array(
            		'options' => array(
            			'route' => 'JQExecutionStats',
            			'defaults' => array(
            				'controller' => 'webapi-api-controller',
            				'action' => 'JQExecutionStats',
            				'apiMethod' => 'get'
            			),
            			'group' => 'jobqueue',
            			'info' => array(
            				'Get the list of job types statistics, also the total served and success ratio.',
            			)
            		)
            	),
            		
            	'getExecuteJobsFlag' => array(
            		'options' => array(
	            		'route' => 'getExecuteJobsFlag',
	            		'defaults' => array(
	            			'controller' => 'webapi-api-controller',
	            			'action' => 'getExecuteJobsFlag',
	            			'apiMethod' => 'get'
	            		),
	            		'group' => 'jobqueue',
	            		'info' => array(
	            			'Get execute jobs flag.',
	            		)
	            	)
				),
            		
            	// Admin
            	'getShowGuidePageFlag' => array(
            		'options' => array(
            			'route' => 'getShowGuidePageFlag',
            			'defaults' => array(
            				'controller' => 'webapi-api-controller',
            				'action' => 'getShowGuidePageFlag',
            				'apiMethod' => 'get'
            			),
            			'group' => 'admin',
            			'info' => array(
            				'Returns a flag whether to show guide page or not.',
            			)
            		)
            	),
            		
            	// Configuration
            	'configurationGetServerData' => array(
            		'options' => array(
            			'route' => 'configurationGetServerData',
            			'defaults' => array(
            				'controller' => 'webapi-api-controller',
            				'action' => 'configurationGetServerData',
            				'apiMethod' => 'get'
            			),
            			'group' => 'configuration',
            			'info' => array(
            				'Get the server data - all the available data about the server - its status, basic configuration, and useful information',
            			)
            		)
            	),
            	
            	'configurationGetMonitoringSettings' => array(
            		'options' => array(
            			'route' => 'configurationGetMonitoringSettings',
            			'defaults' => array(
							'controller' => 'webapi-api-controller',
            				'action' => 'configurationGetMonitoringSettings',
            				'apiMethod' => 'get'
            			),
            			'group' => 'configuration',
            			'info' => array(
            				'Get monitoring settings values - like monitoring, statistics and URL insight components status (enabled / disabled) and other relavent directives - check the response example. The API is used in monitoring settings page.',
            			)
            		)
            	),
                
            ) // end of routes
        )
    )
);