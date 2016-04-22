<?php
return array (
        'min-zsversion' => '5.6',
        'console' => array (
                'router' => array (
                        'routes' => array (
                                'codetracingDisable' => array (
                                        'options' => array (
                                                'route' => 'codetracingDisable [--restartNow=]',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'codetracingDisable',
                                                        'apiMethod' => 'post'
                                                ),
                                        		'group'=> 'codetracing',
                                        		'info' => array(
                                        				"Disable the code-tracing directive two directives necessary for creating tracing dumps, this action does not disable the code-tracing component. This action unsets the special 'zend_monitor.developer_mode' and 'zend_monitor.event_generate_trace_file' directives.",
                                        				array('--restartNow','Perform a php restart as part of the action to apply the new settings, defaults to true'),
												),
                                        )
                                )
                                ,
                                'codetracingEnable' => array (
                                        'options' => array (
                                                'route' => 'codetracingEnable [--restartNow=]',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'codetracingEnable',
                                                        'apiMethod' => 'post'
                                                ),
                                        		'group'=> 'codetracing',
                                        		'info' => array(
                                        				"Sets the special 'zend_monitor.developer_mod'e and 'zend_monitor.event_generate_trace_file' directives.",
                                        				array('--restartNow','Perform a php restart as part of the action to apply the new settings, defaults to true'),
												),
                                        )
                                )
                                ,
                                'codetracingIsEnabled' => array (
                                        'options' => array (
                                                'route' => 'codetracingIsEnabled',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'codetracingIsEnabled'
                                                ),
                                        		'group'=> 'codetracing',
                                        		'info' => array(
                                        				"Checks the values of the special 'zend_monitor.developer_mode' and 'zend_monitor.event_generate_trace_file' directives. The action also checks the current status of the Code Tracing component and whether a restart is required in order for the directives settings to come into effect.",
												),
                                        )
                                )
                                ,
                                'codetracingCreate' => array (
                                        'options' => array (
                                                'route' => 'codetracingCreate --url=',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'codetracingCreate',
                                                        'apiMethod' => 'post'
                                                ),
                                        		'group'=> 'codetracing',
                                        		'info' => array(
                                        				"Create a new code-tracing entry.",
                                        				array('--url','URL to call the code tracing request'),
												),
                                        )
                                )
                                ,
                                'codetracingGetInfo' => array (
                                        'options' => array (
                                                'route' => 'codetracingGetInfo --id=',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'codetracingGetInfo'
                                                ),
                                        		'group'=> 'codetracing',
                                        		'info' => array(
                                        				"Get a code tracing entry.",
                                        				array('--id','Code trace file id.'),
												),
                                        )
                                )
                                ,
                                'codetracingDelete' => array (
                                        'options' => array (
                                                'route' => 'codetracingDelete --traceFile=',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'codetracingDelete',
                                                        'apiMethod' => 'post'
                                                ),
                                        		'arrays' => array (
                                        				'traceFile'
												),
                                        		'group'=> 'codetracing',
                                        		'info' => array(
                                        				"Delete a code-tracing file entry.",
                                        				array('--traceFile','Trace file identifier or a list of Trace file identifiers. The option to pass an array was added in version 1.3.'),
												),
                                        )
                                )
                                ,
                                'codetracingDownloadTraceFile' => array (
                                        'options' => array (
                                                'route' => 'codetracingDownloadTraceFile --traceFile= [--eventsGroupId=]',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'codetracingDownloadTraceFile'
                                                ),
                                        		'group'=> 'codetracing',
                                        		'info' => array(
                                        				"Download the amf file specified by the codetracing identifier.",
                                        				array('--traceFile','Trace file identifier.'),
                                        				array('--eventsGroupId','EventsGroupId associated with the tracefile. This parameter can serve instead of the traceFile parameter.'),
												),
                                        )
                                )
                                ,
                                // Deployment
                                'applicationGetStatus' => array (
                                        'options' => array (
                                                'route' => 'applicationGetStatus [--applications=] [--direction=]',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'applicationGetStatus'
                                                ),
                                        		'arrays' => array(
                                        			'applications'
                                        		),
                                        		'group'=> 'deployment',
                                        		'info' => array(
                                        				"Get the list of applications currently deployed (or staged) on the server or the cluster and information about each application. If application IDs are specified, this method will return information about the specified applications. If no IDs are specified, this method will return information about all applications on the server or cluster.",
                                        				array('--applications','A list of application IDs. If specified, information will be returned about the specific applications only. If not specified, information about all applications will be returned. If a non-existing application ID is provided this action will not fail but instead will return no information about the specific application.'),
                                        				array('--direction','One of ASC|DESC. Sets the ordering direction. Ordering is always by User application name.'),
												),
                                        )
                                )
                                ,
                                'applicationDeploy' => array (
                                        'options' => array (
                                                'route' => 'applicationDeploy --appPackage= --baseUrl= [--createVhost=] [--defaultServer=] [--userAppName=] [--ignoreFailures=] [--userParams=]',
                                                'defaults' => array (
                                                        'controller'    => 'webapi-api-controller',
                                                        'action'        => 'applicationDeploy',
                                                        'apiMethod'     => 'post',
                                                        'defaultServer' => 'FALSE'
                                                ),
                                                'files'   => array(
                                                        // Specifies which parameter values should be treated as file names
                                                        'appPackage'
                                                ),
                                                'arrays' => array(
                                                        'userParams'
                                                ),
                                        		'group'=> 'deployment',
                                        		'info' => array(
                                        				"Deploy a new application to the server or cluster. This process is asynchronous, meaning the initial request will wait until the application is uploaded and verified, and  the initial response will show information about the application being deployed. However, the staging and activation process will proceed after the response is returned. You must continue checking the application status using the applicationGetStatus method until the deployment process is complete.",
                                        				array('--appPackage','The application package file. '),
                                        				array('--baseUrl','The base URL to which the application will be deployed. This must be an HTTP URL.'),
                                        				array('--createVhost',"Create a virtual host based on the base URL (if the virtual host wasn't already created by Zend Server). The default value is FALSE."),
                                        				array('--defaultServer',"Deploy the application on the default server. The provided base URL will be ignored and replaced with '<default-server>'.  
If this parameter and createVhost are both used, createVhost will be ignored. The default value is FALSE.
                                        		"),
                                        				array('--userAppName','Free text for a user defined application identifier. If not specified, the baseUrl parameter will be used.'),
                                        				array('--ignoreFailures','Ignore failures during staging if only some servers report failures. If all servers report failures the operation will fail in any case. 
The default value is FALSE, meaning any failure will return an error.'),
                                        				array('--userParams','Set values for user parameters defined in the package. Depending on package definitions, this parameter may be required. 
Each user parameter defined in the package must be provided as a key for this parameter.'),
                                        				array('Example:','applicationDeploy --appPackage=/path/to/application.zpk --baseUrl="http://test.domain.com/" --userParams="APPLICATION_ENV=staging&p[a]=1&p[b]=2"')
                                        		),
                                        )
                                )
                                ,
                                'applicationUpdate' => array (
                                        'options' => array (
                                                'route' => 'applicationUpdate --appId= --appPackage= [--ignoreFailures=] [--userParams=]',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'applicationUpdate',
                                                        'apiMethod' => 'post'
                                                ),
                                                'files' => array(
                                                    'appPackage'
                                                ),
                                                'arrays' => array(
                                                    'userParams'
                                                ),
                                        		'group'=> 'deployment',
                                        		'info' => array(
                                        				"This method allows you to update an existing application. The package you provide must contain the same application. Additionally, any new parameters or new values for existing parameters must be provided. This process is asynchronous, meaning the initial request will wait until the package is uploaded and verified, and the initial response will show information about the new version being deployed. However, the staging and activation process will proceed after the response is returned. You must continue checking the application status using the applicationGetStatus method until the deployment process is complete.",
                                        				array('--appId','The application ID you would like to update.'),
                                        				array('--appPackage','The application package file. '),
                                        				array('--ignoreFailures','Ignore failures during staging if only some servers report failures. If all servers report failures the operation will fail in any case. 
The default value is FALSE, meaning any failure will return an error.'),
                                        				array('--userParams','Set values for user parameters defined in the package. Depending on package definitions, this parameter may be required. 
Each user parameter defined in the package must be provided as a key for this parameter.'),
                                        				array('Example:','applicationUpdate --appId=3 --appPackage=/path/to/application-v0.3.zpk --userParams="APPLICATION_ENV=staging&p[a]=1&p[b]=2"')
                                        		),
                                        )
                                )
                                ,
                                'applicationRemove' => array (
                                        'options' => array (
                                                'route' => 'applicationRemove --appId=',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'applicationRemove',
                                                        'apiMethod' => 'post'
                                                ),
                                        		'group'=> 'deployment',
                                        		'info' => array(
                                        				"This method allows you to remove an existing application. This process is asynchronous, meaning the initial request will start the removal process and the initial response will show information about the application being removed. However, the removal process will proceed after the response is returned. You must continue checking the application status using the applicationGetStatus method until the removal process is complete. Once applicationGetStatus contains no information about the application, it has been completely removed.",
                                        				array('--appId','The application ID you would like to remove.'),
                                        		),
                                        )
                                )
                                ,
                                'applicationSynchronize' => array (
                                        'options' => array (
                                                'route' => 'applicationSynchronize --appId= [--servers=] [--ignoreFailures=]',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'applicationSynchronize',
                                                        'apiMethod' => 'post'
                                                ),
                                        		'arrays' => array(
                                        				'servers'
												),
                                        		'group'=> 'deployment',
                                        		'info' => array(
                                        				"Synchronizing an existing application, whether in order to fix a problem or to reset an installation. This process is asynchronous, meaning the initial request will start the synchronize process and the initial response will show information about the application being synchronized. However, the synchronize process will proceed after the response is returned. You must continue checking the application status using the applicationGetStatus method until the process is complete.",
                                        				array('--appId','The application ID you would like to synchronize.'),
                                        				array('--servers',"Comma separated list of server ID's. If defined, the action will be done only on the servers whose ID's are specified and which are currently members of the cluster."),
                                        				array('--ignoreFailures','Ignore failures during staging or activation if only some servers report failures. If all servers report failures the operation will fail in any case. 
The default value is FALSE, meaning any failure will return an error.'),
                                        		),
                                        )
                                )
                                ,
                                'applicationRollback' => array (
                                        'options' => array (
                                                'route' => 'applicationRollback --appId=',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',

                                                        'action' => 'applicationRollback',
                                                        'apiMethod' => 'post'
                                                ),
                                        		'group'=> 'deployment',
                                        		'info' => array(
                                        				"Rollback an existing application to its previous version. This process is asynchronous, meaning the initial request will start the rollback process and the initial response will show information about the application being rolled back. You must continue checking the application status using the applicationGetStatus method until the process is complete",
                                        				array('--appId','The application ID you would like to rollback.'),
                                        		),
                                        )
                                ),
                                // Monitor
                                'monitorGetRequestSummary' => array (
                                        'options' => array (
                                                'route' => 'monitorGetRequestSummary --requestUid=',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'monitorGetRequestSummary'
                                                ),
                                        		'group' => 'monitor',
                                        		'info' => array (
                                        				'Get the library version ID that is deployed on the server or the cluster, and information about that version and its library.',
                                        				array('--requestUid','Library version identifier. Note that a codetracing identifier is provided as part of the LibraryGetStatus xml response.')
                                        		)
                                        )
                                )
                                ,
                                'monitorGetIssuesListPredefinedFilter' => array (
                                        'options' => array (
                                                'route' => 'monitorGetIssuesListPredefinedFilter --filterId= [--limit=] [--offset=] [--order=] [--direction=] [--filters=]',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'monitorGetIssuesListPredefinedFilter'
                                                ),
                                        		'arrays' => array(
                                        				'filters'
                                        		),
                                        		'group' => 'monitor',
                                        		'info' => array (
                                        				'Get the library version ID that is deployed on the server or the cluster, and information about that version and its library.',
                                        				array('--filterId',"The predefined filter's name. This parameter is case-sensitive."),
                                        				array('--limit','The number of rows to retrieve. Default lists all audit entries up to an arbitrary limit set by the system'),
                                        				array('--offset','A paging offset to begin the list from. Default: 0'),
                                        				array('--order','Column identifier for sorting the result set (audit_id, node_id, time). Default: audit_id'),
                                        				array('--direction','Sorting direction: ASC or DESC. Default: DESC'),
                                        				array('--filters','Add filter parameters in an ad-hoc manner. These filters will be added to the predefined filter that was passed. This parameter is an array with a predefined set of parameters that accept strings or arrays to hold multiple values:
applicationIds: array, a list of application IDs to use for retrieving issue rows
severities: array, a list of severities (info, normal, severe)
statuses: array, a list of statuses (open, closed, reopened, ignored) - Removed in version 1.3.
eventTypes:array, a list of eventTypes (zend-error, function-error, request-slow-exec, function-slow-exec, request-relative-slow-exec, java-exception, request-large-mem-usage, request-relative-large-mem-usage, request-relative-large-out-size, jq-job-exec-error, jq-job-logical-failure, jq-job-exec-delay, jq-daemon-high-concurrency, tracer-write-file-fail, zsm-node-added-successfully, zsm-node-enabled, zsm-node-disabled, zsm-node-removed-successfully, zsm-node-is-not-responding, zsm-configuration-mismatch, zsm-restart-failed, zdd-deploy-success, zdd-deploy-error, zdd-redeploy-success, zdd-redeploy-error, zdd-remove-success, zdd-remove-error, zdd-update-success, zdd-update-error, zdd-rollback-success, zdd-rollback-error, custom
freeText: string
from: string, a timestamp to use for retrieving rows
to: string, a timestamp to use for retrieving rows
ruleNames: array, a list of rule names that are defined in the system: Function Error, Database Error, Slow Function Execution, Slow Query Execution, Slow Request Execution, High Memory Usage, Inconsistent Output Size, PHP Error, Uncaught Java Exception, Custom Event, Zend Framework Exception, Job Execution Error, Job Logical Failure, Job Execution Delay, Failed Writing Code Tracing Data and other custom names')
                                        		)
                                        )
                                ),
                            
                                'monitorGetIssuesByPredefinedFilter' => array (
                                    'options' => array (
                                        'route' => 'monitorGetIssuesByPredefinedFilter --filterId= [--limit=] [--offset=] [--order=] [--direction=] [--filters=]',
                                        'defaults' => array (
                                            'controller' => 'webapi-api-controller',
                                            'action' => 'monitorGetIssuesByPredefinedFilter'
                                        ),
                                        'arrays' => array(
                                            'filters'
                                        ),
                                        'group' => 'monitor',
                                        'info' => array (
                                            'Get the library version ID that is deployed on the server or the cluster, and information about that version and its library.',
                                            array('--filterId',"The predefined filter's name. This parameter is case-sensitive."),
                                            array('--limit','The number of rows to retrieve. Default lists all audit entries up to an arbitrary limit set by the system'),
                                            array('--offset','A paging offset to begin the list from. Default: 0'),
                                            array('--order','Column identifier for sorting the result set (audit_id, node_id, time). Default: audit_id'),
                                            array('--direction','Sorting direction: ASC or DESC. Default: DESC'),
                                            array('--filters','Add filter parameters in an ad-hoc manner. These filters will be added to the predefined filter that was passed. This parameter is an array with a predefined set of parameters that accept strings or arrays to hold multiple values:
    applicationIds: array, a list of application IDs to use for retrieving issue rows
    severities: array, a list of severities (info, normal, severe)
    statuses: array, a list of statuses (open, closed, reopened, ignored) - Removed in version 1.3.
    eventTypes:array, a list of eventTypes (zend-error, function-error, request-slow-exec, function-slow-exec, request-relative-slow-exec, java-exception, request-large-mem-usage, request-relative-large-mem-usage, request-relative-large-out-size, jq-job-exec-error, jq-job-logical-failure, jq-job-exec-delay, jq-daemon-high-concurrency, tracer-write-file-fail, zsm-node-added-successfully, zsm-node-enabled, zsm-node-disabled, zsm-node-removed-successfully, zsm-node-is-not-responding, zsm-configuration-mismatch, zsm-restart-failed, zdd-deploy-success, zdd-deploy-error, zdd-redeploy-success, zdd-redeploy-error, zdd-remove-success, zdd-remove-error, zdd-update-success, zdd-update-error, zdd-rollback-success, zdd-rollback-error, custom
    freeText: string
    from: string, a timestamp to use for retrieving rows
    to: string, a timestamp to use for retrieving rows
    ruleNames: array, a list of rule names that are defined in the system: Function Error, Database Error, Slow Function Execution, Slow Query Execution, Slow Request Execution, High Memory Usage, Inconsistent Output Size, PHP Error, Uncaught Java Exception, Custom Event, Zend Framework Exception, Job Execution Error, Job Logical Failure, Job Execution Delay, Failed Writing Code Tracing Data and other custom names')
                                        )
                                    )
                                ),
                            
                                'monitorGetIssueDetails' => array (
                                        'options' => array (
                                                'route' => 'monitorGetIssueDetails --issueId= [--limit=]',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'monitorGetIssueDetails'
                                                ),
                                        		'group' => 'monitor',
                                        		'info' => array (
                                        				"Retrieve an issue's details according to the issueId passed as a parameter. Additional information about event groups is also displayed.",
                                        				array('--issueId',"The predefined filter's id. Can be the filter's “name” or the actual identifier randomly created by the system. This parameter is case-sensitive."),
                                        				array('--limit','Limits the number of eventsGroups returned with the issue details.')
                                        		)
                                        )
                                )
                                ,
                                'monitorGetEventGroupDetails' => array (
                                        'options' => array (
                                                'route' => 'monitorGetEventGroupDetails --issueId= --eventsGroupId=',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'monitorGetEventGroupDetails'
                                                ),
                                        		'group' => 'monitor',
                                        		'info' => array (
                                        				"Retrieve an events list object identified by an events-group identifier. The events-group identifier is retrieved from an Issue element's data.",
                                        				array('--issueId','This parameter was removed due to redundancy and is no longer used in either WebAPI 1.2 or 1.3 on ZS6.x.'),
                                        				array('--eventsGroupId','Events group identifier, provided in the eventsGroup element. Note that for backwards compatibility you may also submit an “eventGroupId” parameter and it will be accepted on ZS6.x'),
                                        		)
                                        )
                                )
                                ,
                                'monitorExportIssueByEventsGroup' => array (
                                        'options' => array (
                                                'route' => 'monitorExportIssueByEventsGroup --eventsGroupId=',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'monitorExportIssueByEventsGroup'
                                                ),
                                        		'group' => 'monitor',
                                        		'info' => array (
                                        				"Export an archive containing all of the issue's information, event groups and code tracing if available, ready for consumption by Zend Studio. The response is a binary payload.",
                                        				array('--eventsGroupId','The issue event group identifier.')
                                        		)
                                        )
                                )
                                ,
                                'monitorChangeIssueStatus' => array (
                                        'options' => array (
                                                'route' => 'monitorChangeIssueStatus --issueId= --newStatus=',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'monitorChangeIssueStatus',
                                                        'apiMethod' => 'post'
                                                ),
                                        		'group' => 'monitor',
                                        		'info' => array (
                                        				"Modify an Issue's status code based on an Issue's Id and a status code.",
                                        				array('--issueId','The issue identifier.'),
                                        				array('--newStatus','The new status to set: Open | Closed | Ignored.')
                                        		)
                                        )
                                )
                                ,
                                // Studio integration
                                'studioStartDebug' => array (
                                        'options' => array (
                                                'route' => 'studioStartDebug --eventsGroupId= [--noRemote=] [--overrideHost=]',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'studioStartDebug',
                                                        'apiMethod' => 'post'
                                                ),
                                        		'group' => 'studio',
                                        		'info' => array (
                                        				'Start a debug session for a specific issue.',
                                        				array('--eventsGroupId','The issue event group identifier.'),
                                        				array('--noRemote',"Use server's own local files for debug display. Default: true. Setting to false will use local files from studio if available."),
                                        				array('--overrideHost','Override the host address sent to Zend Server for initiating a Debug session. This is used to point Zend Server at the right address where Studio is executed.'),
                                        		)
                                        )
                                )
                                ,
                                'studioStartProfile' => array (
                                        'options' => array (
                                                'route' => 'studioStartProfile --eventsGroupId= [--overrideHost=]',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'studioStartProfile',
                                                        'apiMethod' => 'post'
                                                ),
                                        		'group' => 'studio',
                                        		'info' => array (
                                        				"Start a profiling session with Zend Studio's integration using an event-group's identifier.",
                                        				array('--eventsGroupId','The issue event group identifier.'),
                                        				array('--overrideHost','Override the host address sent to Zend Server for initiating a Debug session. This is used to point Zend Server at the right address where Studio is executed.'),
                                        		)
                                        )
                                )
                                ,
                                'studioShowSource' => array (
                                        'options' => array (
                                                'route' => 'studioShowSource --eventsGroupId= [--overrideHost=]',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'studioShowSource',
                                                        'apiMethod' => 'post'
                                                ),
                                        		'group' => 'studio',
                                        		'info' => array (
                                        				'Show source of a file that triggered an error event.',
                                        				array('--eventsGroupId','The issue event group identifier.'),
                                        				array('--overrideHost','Override the host address sent to Zend Server for initiating a Debug session. This is used to point Zend Server at the right address where Studio is executed.'),
                                        		)
                                        )
                                )

                        )
                )
        )
);
