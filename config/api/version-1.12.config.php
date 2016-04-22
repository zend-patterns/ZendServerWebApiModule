<?php
return array(
    'min-zsversion' => '9.0',
    'console' => array(
        'router' => array(
            'routes' => array(
               
                'getLogFiles' => array(
                    'options' => array(
                        'route' => 'getLogFiles',
                        'defaults' => array(
                            'controller' => 'webapi-api-controller',
                            'action' => 'getLogFiles',
                            'apiMethod' => 'get'
                        ),
                        'group' => 'server',
                        'info' => array(
                            'Get list of log files on the server.',
                        )
                    )
                ),

           
                'getBrowserIp' => array(
                    'options' => array(
                        'route' => 'getBrowserIp',
                        'defaults' => array(
                            'controller' => 'webapi-api-controller',
                            'action' => 'getBrowserIp',
                            'apiMethod' => 'get'
                        ),
                        'group' => 'server',
                        'info' => array(
                            'Get the IP of the browser that accesses the web API - used as a button "use browser IP" in IP filters.',
                        )
                    )
                ),

                                
                // Z-Ray Commands:
                'zrayDeleteByPredefinedFilter' => array(
                    'options' => array(
                        'route' => 'zrayDeleteByPredefinedFilter [--filterId=] [--filter=]',
                        'defaults' => array(
                            'controller' => 'webapi-api-controller',
                            'action' => 'zrayDeleteByPredefinedFilter',
                            'apiMethod' => 'post'
                        ),
                        'group' => 'zray',
                        'arrays' => array(
                            'filter'
                        ),
                        'info' => array(
                            'Remove the zray records by passed filter (name or filter firlds).',
                            array('--filterId', 'Filter name as it was saved in the filters table of gui db.'),
                            array('--filter', "
Filter fields to filter the zray entries to remove. Array can contains the following fields: 'severity', 'response', 'method', 'from', 'to', 'freeText'.
‘method’ is one of: 'GET','POST','CLI'
‘response’ is one of : 2xx, 4xx, 5xx
freeText is looking for the strin gin url string or response (specific like 404,500…)
                                "),
                        )
                    )
                ),

                'zrayGetAllRequestsInfo' => array(
                    'options' => array(
                        'route' => 'zrayGetAllRequestsInfo [--from_timestamp=] [--filters=] [--limit=] [--offset=]',
                        'defaults' => array(
                            'controller' => 'webapi-api-controller',
                            'action' => 'zrayGetAllRequestsInfo',
                            'apiMethod' => 'get'
                        ),
                        'group' => 'zray',
                        'arrays' => array(
                            'filters'
                        ),
                        'info' => array(
                            'Get a list of requests starting from a specific timestamp (same as `zrayGetRequestsInfo` but not by pageID). The API receives 3 parameters - `from_timestamp`, `limit` and `offset`. The default limit is 10.',
                            array('--from_timestamp', 'Specify the timestamp to get all the requests that came after (microseconds - 13 digits).'),
                            array('--filters', "Added in 1.12 filters: 'severity', 'response', 'method', 'from', 'to', 'freeText'"),
                            array('--limit', 'Limit number of requests. Default is 10. Max value is 500.'),
                            array('--offset', 'Get data starting from a specific offset. Default is 0.'),
                        )
                    )
                ),
                
                                
                // Administration
                'usersGetList' => array(
                    'options' => array(
                        'route' => 'usersGetList',
                        'defaults' => array(
                            'controller' => 'webapi-api-controller',
                            'action' => 'usersGetList',
                            'apiMethod' => 'get'
                        ),
                        'group' => 'admin',
                        'info' => array(
                            'Get users and roles in Zend Server. The data will provided accordingly to the users who request this method, not admin user will get his user only, the received roles will be only his role + parent roles',
                        )
                    )
                ),
                
                'userGetAuthenticationSettings' => array(
                    'options' => array(
                        'route' => 'userGetAuthenticationSettings',
                        'defaults' => array(
                            'controller' => 'webapi-api-controller',
                            'action' => 'userGetAuthenticationSettings',
                            'apiMethod' => 'get'
                        ),
                        'group' => 'admin',
                        'info' => array(
                            'Get current authentication settings, allowing the user to switch between simple and extended authentication and authorization schemes.',
                        )
                    )
                ),
                
                'usersGetMappedGroups' => array(
                    'options' => array(
                        'route' => 'usersGetMappedGroups',
                        'defaults' => array(
                            'controller' => 'webapi-api-controller',
                            'action' => 'usersGetMappedGroups',
                            'apiMethod' => 'get'
                        ),
                        'group' => 'admin',
                        'info' => array(
                            'Get current mapped groups (LDAP) for roles and applications.',
                        )
                    )
                ),
                

               
                // Monitor
                'monitorCountIssuesByPredefinedFilter' => array (
                    'options' => array (
                            'route' => 'monitorCountIssuesByPredefinedFilter --filterId= [--filters=]',
                            'defaults' => array (
                                    'controller' => 'webapi-api-controller',
                                    'action' => 'monitorCountIssuesByPredefinedFilter'
                            ),
                    		'group' => 'monitor',
                            'arrays' => array(
                                'filters' 
                            ),
                    		'info' => array (
                    				'Count the number of issues according to a particular filter or customized filters’ list. This action’s filterId and filters parameter behaves the same way as monitorGetIssuesByPredefinedFilter.',
                    				array('--filterId',"The predefined filter's name. This parameter is case-sensitive."),
                    		        array('--filters',"Add filter parameters in an ad-hoc manner. These filters will be added to the predefined filter that was passed.
This parameter is an array with a predefined set of parameters that accept strings or arrays to hold multiple values:
applicationIds: array, a list of application IDs to use for retrieving issue rows
severities: array, a list of severities (info, normal, severe)
statuses: array, a list of statuses (open, closed, reopened, ignored)
eventTypes: array, a list of eventTypes (zend-error, function-error, request-slow-exec, function-slow-exec, request-relative-slow-exec, java-exception, request-large-mem-usage, request-relative-large-mem-usage, request-relative-large-out-size, jq-job-exec-error, jq-job-logical-failure, jq-job-exec-delay, jq-daemon-high-concurrency, tracer-write-file-fail, zsm-node-added-successfully, zsm-node-enabled, zsm-node-disabled, zsm-node-removed-successfully, zsm-node-is-not-responding, zsm-configuration-mismatch, zsm-restart-failed, zdd-deploy-success, zdd-deploy-error, zdd-redeploy-success, zdd-redeploy-error, zdd-remove-success, zdd-remove-error, zdd-update-success, zdd-update-error, zdd-rollback-success, zdd-rollback-error, custom
freeText: string: issues.full_url,request_components.comp_value, issues.function_name, issues.rule_name
from: integer, a unix timestamp that defines the start date & time for filtering. All events retrieved will have occurred after this timestamp
to: integer, a unix timestamp that defines the last date & time for filtering. All events retrieved will have occurred before this timestamp
ruleNames: array, a list of rule names that  are defined in the system: Function Error, Database Error, Slow Function Execution, Slow Query Execution, Slow Request Execution, High Memory Usage, Inconsistent Output Size, PHP Error, Uncaught 
                        		            "),
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
eventTypes:array, a list of eventTypes (zend-error, function-error, request-slow-exec, function-slow-exec, request-relative-slow-exec, java-exception, request-large-mem-usage, request-relative-large-mem-usage, request-relative-large-out-size, jq-job-exec-error, jq-job-logical-failure, jq-job-exec-delay, jq-daemon-high-concurrency, tracer-write-file-fail, zsm-node-added-successfully, zsm-node-enabled, zsm-node-disabled, zsm-node-removed-successfully, zsm-node-is-not-responding, zsm-configuration-mismatch, zsm-restart-failed, zdd-deploy-success, zdd-deploy-error, zdd-redeploy-success, zdd-redeploy-error, zdd-remove-success, zdd-remove-error, zdd-update-success, zdd-update-error, zdd-rollback-success, zdd-rollback-error, custom
freeText: string: issues.full_url,request_components.comp_value, issues.function_name, issues.rule_name
from: string, a timestamp to use for retrieving rows
to: string, a timestamp to use for retrieving rows
ruleNames: array, a list of rule names that are defined in the system: Function Error, Database Error, Slow Function Execution, Slow Query Execution, Slow Request Execution, High Memory Usage, Inconsistent Output Size, PHP Error, Uncaught Java Exception, Custom Event, Zend Framework Exception, Job Execution Error, Job Logical Failure, Job Execution Delay, Failed Writing Code Tracing Data and other custom names')
                        )
                    )
                ),
                
                // Codetracing
                'codetracingGetDbFileSize' => array(
                    'options' => array(
                        'route' => 'codetracingGetDbFileSize --traceId=',
                        'defaults' => array(
                            'controller' => 'webapi-api-controller',
                            'action' => 'codetracingGetDbFileSize',
                            'apiMethod' => 'get'
                        ),
                        'group' => 'codetracing',
                        'info' => array(
                            'Get the actual size of the dump DB file.',
                            array('--traceId', 'Trace Id.'),
                        )
                    )
                ),
                
                // Codetracing
                'codetracingGetRootNode' => array(
                    'options' => array(
                        'route' => 'codetracingGetRootNode --traceId=',
                        'defaults' => array(
                            'controller' => 'webapi-api-controller',
                            'action' => 'codetracingGetRootNode',
                            'apiMethod' => 'get'
                        ),
                        'group' => 'codetracing',
                        'info' => array(
                            'Get the root node of the codetracing tree.',
                            array('--traceId', 'Trace Id.'),
                        )
                    )
                ),
                
                // Codetracing
                'codetracingGetNodeChildren' => array(
                    'options' => array(
                        'route' => 'codetracingGetNodeChildren --traceId= --nodeId=',
                        'defaults' => array(
                            'controller' => 'webapi-api-controller',
                            'action' => 'codetracingGetNodeChildren',
                            'apiMethod' => 'get'
                        ),
                        'group' => 'codetracing',
                        'info' => array(
                            'Get list of children of a node.',
                            array('--traceId', 'Trace Id.'),
                            array('--nodeId', 'Node Id.'),
                        )
                    )
                ),
                
                // Codetracing
                'codetracingGetPathToSearchResult' => array(
                    'options' => array(
                        'route' => 'codetracingGetPathToSearchResult --traceId= [--searchString=] [--counter=] [--getErrors=]',
                        'defaults' => array(
                            'controller' => 'webapi-api-controller',
                            'action' => 'codetracingGetPathToSearchResult',
                            'apiMethod' => 'get'
                        ),
                        'group' => 'codetracing',
                        'info' => array(
                            'Get the open tree until the `counter` th node that matches the search string or the error 
(error means script error, segfault, event, etc). The response is unique (usually nodes do not have
"children" key), and it has special treatment on the client side.',
                            array('--searchString', 'Search string.'),
                            array('--counter', 'Counter.'),
                            array('--getErrors', 'Get errors.'),
                        )
                    )
                ),
                
                'codetracingGetFunctionsList' => array(
                    'options' => array(
                        'route' => 'codetracingGetFunctionsList --traceId=',
                        'defaults' => array(
                            'controller' => 'webapi-api-controller',
                            'action' => 'codetracingGetFunctionsList',
                            'apiMethod' => 'get'
                        ),
                        'group' => 'codetracing',
                        'info' => array(
                            'Get list of all the functions with their basic statistics.',
                            array('--traceId', 'Trace Id.'),
                        )
                    )
                ),
                
                'codetracingGetFunctionCalls' => array(
                    'options' => array(
                        'route' => 'codetracingGetFunctionCalls --traceId= --functionName=',
                        'defaults' => array(
                            'controller' => 'webapi-api-controller',
                            'action' => 'codetracingGetFunctionCalls',
                            'apiMethod' => 'get'
                        ),
                        'group' => 'codetracing',
                        'info' => array(
                            'Get list of calls to that function in the application.',
                            array('--traceId', 'Trace Id.'),
                            array('--functionName', 'Function name.'),
                        )
                    )
                ),
                
            ) // end of routes
            
        )
    )
);