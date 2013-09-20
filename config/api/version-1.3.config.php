<?php
return array (
        'min-zsversion' => '6.0',
        'console' => array (
                'router' => array (
                        'routes' => array (
                                // Adminsitration
                                'userAuthentificationSettings' => array (
                                        'options' => array (
                                                'route' => 'userAuthentificationSettings --type= --ldap= --password= --confirmNewPassword=',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'userAuthentificationSettings',
                                                        'apiMethod' => 'post'
                                                )
                                        )
                                ),
                                'userSetPassword' => array (
                                        'options' => array (
                                                'route' => 'userSetPassword --username= --password= --newPassword= --confirmNewPassword=',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'userSetPassword',
                                                        'apiMethod' => 'post'
                                                )
                                        )
                                ),
                                'setPassword' => array (
                                        'options' => array (
                                                'route' => 'setPassword --password= --newPassword= --confirmNewPassword=',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'userSetPassword',
                                                        'apiMethod' => 'post'
                                                )
                                        )
                                ),
                                'apiKeysGetList' => array (
                                        'options' => array (
                                                'route' => 'apiKeysGetList',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'apiKeysGetList'
                                                )
                                        )
                                ),
                                'apiKeysAddKey' => array (
                                        'options' => array (
                                                'route' => 'apiKeysAddKey --name= --username=',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'apiKeysAddKey',
                                                        'apiMethod' => 'post'
                                                )
                                        )
                                ),
                                'apiKeysRemoveKey' => array (
                                        'options' => array (
                                                'controller' => 'webapi-api-controller',
                                                'route' => 'apiKeysRemoveKey --ids=',
                                                'defaults' => array (
                                                        'action' => 'apiKeysRemoveKey',
                                                        'apiMethod' => 'post'
                                                )
                                        )
                                ),
                                'serverValidateLicense' => array (
                                        'options' => array (
                                                'route' => 'serverValidateLicense --licenseName= --licenseValue=',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'serverValidateLicense',
                                                        'apiMethod' => 'post'
                                                )
                                        )
                                ),
                                'aclSetGroups' => array (
                                        'options' => array (
                                                'route' => 'aclSetGroups --role_groups= [--app_groups=]',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'aclSetGroups',
                                                        'apiMethod' => 'post'
                                                )
                                        )
                                ),
                                'bootstrapSingleserver' => array (
                                        'options' => array (
                                                'route' => 'bootstrapSingleserver [--production=] --adminPassword= [--applicationUrl=] [--adminEmail=] [--developerPassword=] [--orderNumber=] [--licenseKey=] --acceptEula=',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'bootstrapSingleserver',
                                                        'apiMethod' => 'post'
                                                )
                                        )
                                ),
                                'serverStoreLicense' => array (
                                        'options' => array (
                                                'route' => 'serverStoreLicense --licenseName= --licenseValue=',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'serverStoreLicense',
                                                        'apiMethod' => 'post'
                                                )
                                        )
                                ),
                                // Audit
                                'auditGetList' => array (
                                        'options' => array (
                                                'route' => 'auditGetList [--limit=] [--offset=] [--order=] [--direction=] [--filter=]',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'auditGetList'
                                                )
                                        )
                                ),
                                'auditGetDetails' => array (
                                        'options' => array (
                                                'route' => 'auditGetDetails --auditId=',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'auditGetDetails'
                                                )
                                        )
                                ),
                                'auditSetSettings' => array (
                                        'options' => array (
                                                'route' => 'auditSetSettings --history= [--email=] [--callbackUrl=]',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'auditSetSettings',
                                                        'apiMethod' => 'post'
                                                )
                                        )
                                ),
                                // Cache
                                'cacheClear' => array (
                                        'options' => array (
                                                'route' => 'cacheClear --component=',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'cacheClear',
                                                        'apiMethod' => 'post'
                                                )
                                        )
                                ),
                                // Configuration Management
                                'emailSend' => array (
                                        'options' => array (
                                                'route' => 'emailSend --to= [--toName=] --from= [--fromName=] --subject= --templateName= [--templateParams=] [--headers=] [--html=]',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'emailSend',
                                                        'apiMethod' => 'post'
                                                )
                                        )
                                ),
                                'configurationExtensionsOn' => array (
                                        'options' => array (
                                                'route' => 'configurationExtensionsOn --extensions=',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'configurationExtensionsOn',
                                                        'apiMethod' => 'post'
                                                )
                                        )
                                ),
                                'configurationExtensionsOff' => array (
                                        'options' => array (
                                                'route' => 'configurationExtensionsOff --extensions=',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'configurationExtensionsOff',
                                                        'apiMethod' => 'post'
                                                )
                                        )
                                ),
                                'configurationValidateDirectives' => array (
                                        'options' => array (
                                                'route' => 'configurationValidateDirectives --directives=',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'configurationValidateDirectives'
                                                )
                                        )
                                ),
                                'configurationStoreDirectives' => array (
                                        'options' => array (
                                                'route' => 'configurationStoreDirectives --directives=',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'configurationStoreDirectives',
                                                        'apiMethod' => 'post'
                                                )
                                        )
                                ),
                                'configurationSearch' => array (
                                        'options' => array (
                                                'route' => 'configurationSearch --query= [--filter=]',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'configurationSearch'
                                                )
                                        )
                                ),
                                'configurationExtensionsList' => array (
                                        'options' => array (
                                                'route' => 'configurationExtensionsList [--type=] [--order=] [--direction=] [--filter=]',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'configurationExtensionsList'
                                                )
                                        )
                                ),
                                'configurationDirectivesList' => array (
                                        'options' => array (
                                                'route' => 'configurationDirectivesList [--extension=] [--daemon=] [--filter=]',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller'
                                                )
                                        )
                                ),

                                'configurationComponentsList' => array (
                                        'options' => array (
                                                'route' => 'configurationComponentsList [--filter=]',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',

                                                        'action' => 'configurationComponentsList'
                                                )
                                        )
                                ),
                                'configurationRevertChanges' => array (
                                        'options' => array (
                                                'route' => 'configurationRevertChanges --serverId= [--doRestart=]',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'configurationRevertChanges',
                                                        'apiMethod' => 'post'
                                                )
                                        )
                                ),
                                'configurationApplyChanges' => array (
                                        'options' => array (
                                                'route' => 'configurationApplyChanges --serverId=',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'configurationApplyChanges',
                                                        'apiMethod' => 'post'
                                                )
                                        )
                                ),
                                'configurationReset' => array (
                                        'options' => array (
                                                'route' => 'configurationReset --configFile= [--ignoreSystemMismatch=]',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'configurationReset',
                                                        'apiMethod' => 'post'
                                                )
                                        )
                                ),
                                // Deployment
                                'applicationGetDetails' => array (
                                        'options' => array (
                                                'route' => 'applicationGetDetails --application=',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'applicationGetDetails'
                                                )
                                        )
                                ),
                                'redeployAllApplications' => array (
                                        'options' => array (
                                                'route' => 'redeployAllApplications [--servers=]',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'redeployAllApplications',
                                                        'apiMethod' => 'post'
                                                )
                                        )
                                ),

                                'applicationDefine' => array (
                                        'options' => array (
                                                'route' => 'applicationDefine --name= --baseUrl= [--version=] [--healthCheck=] [--logo=]',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'applicationDefine',
                                                        'apiMethod' => 'post'
                                                )
                                        )
                                ),
                                // Filter
                                'filterGetByType' => array (
                                        'options' => array (
                                                'route' => 'filterGetByType --type=',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'filterGetByType'
                                                )
                                        )
                                ),
                                'filterSave' => array (
                                        'options' => array (
                                                'route' => 'filterSave --type= --name= [--data=] [--id=]',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'filterSave'
                                                )
                                        )
                                ),
                                'filterDelete' => array (
                                        'options' => array (
                                                'route' => 'filterDelete --name=',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'filterDelete'
                                                )
                                        )
                                ),
                                // Job Queue
                                'jobqueueStatistics' => array (
                                        'options' => array (
                                                'route' => 'jobqueueStatistics',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'jobqueueStatistics'
                                                )
                                        )
                                ),
                                'jobqueueJobsList' => array (
                                        'options' => array (
                                                'route' => 'jobqueueJobsList [--limit=] [--offset=] [--orderBy=] [--direction=] [--filter=]',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller'
                                                )
                                        )
                                ),
                                'jobqueueJobInfo' => array (
                                        'options' => array (
                                                'route' => 'jobqueueJobInfo --id=',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'jobqueueJobInfo'
                                                )
                                        )
                                ),
                                'jobqueueDeleteJobs' => array (
                                        'options' => array (
                                                'route' => 'jobqueueDeleteJobs --jobs=',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'jobqueueDeleteJobs',
                                                        'apiMethod' => 'post'
                                                )
                                        )
                                ),
                                'jobqueueRequeueJobs' => array (
                                        'options' => array (
                                                'route' => 'jobqueueRequeueJobs --jobs=',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'jobqueueRequeueJobs',
                                                        'apiMethod' => 'post'
                                                )
                                        )
                                ),
                                'jobqueueListRules' => array (
                                        'options' => array (
                                                'route' => 'jobqueueListRules [--limit=] [--offset=] [--orderBy=] [--direction=]',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'jobqueueListRules'
                                                )
                                        )
                                ),
                                'jobqueueRuleInfo' => array (
                                        'options' => array (
                                                'route' => 'jobqueueRuleInfo [--limit=] [--offset=] [--orderBy=] [--direction=] --id=',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'jobqueueRuleInfo'
                                                )
                                        )
                                ),
                                'jobqueueSaveRule' => array (
                                        'options' => array (
                                                'route' => 'jobqueueSaveRule --url= --options= [--vars=]',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'jobqueueSaveRule',
                                                        'apiMethod' => 'post'
                                                )
                                        )
                                ),
                                'jobqueueSuspendRules' => array (
                                        'options' => array (
                                                'route' => 'jobqueueSuspendRules --rules=',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'jobqueueSuspendRules',
                                                        'apiMethod' => 'post'
                                                )
                                        )
                                ),
                                'jobqueueResumeRules' => array (
                                        'options' => array (
                                                'route' => 'jobqueueResumeRules --rules=',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'jobqueueResumeRules',
                                                        'apiMethod' => 'post'
                                                )
                                        )
                                ),
                                'jobqueueDeleteRules' => array (
                                        'options' => array (
                                                'route' => 'jobqueueDeleteRules --rules=',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'jobqueueDeleteRules',
                                                        'apiMethod' => 'post'
                                                )
                                        )
                                ),
                                'jobqueueRunNowRule' => array (
                                        'options' => array (
                                                'route' => 'jobqueueRunNowRule --rule=',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'jobqueueRunNowRule',
                                                        'apiMethod' => 'post'
                                                )
                                        )
                                ),
                                // Monitor

                                'monitorCountIssuesListPredefinedFilter' => array (
                                        'options' => array (
                                                'route' => 'monitorCountIssuesListPredefinedFilter --filterId= [--filters=]',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'monitorCountIssuesListPredefinedFilter'
                                                )
                                        )
                                ),

                                'getBacktraceFile' => array (
                                        'options' => array (
                                                'route' => 'getBacktraceFile --backtraceNum= --eventsGroupId=',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'getBacktraceFile'
                                                )
                                        )
                                ),

                                'monitorDeleteIssuesByPredefinedFilter' => array (
                                        'options' => array (
                                                'route' => 'monitorDeleteIssuesByPredefinedFilter --filterId= [--limit=] [--offset=] [--order=] [--direction=] [--filters=]',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'monitorDeleteIssuesByPredefinedFilter',
                                                        'apiMethod' => 'post'
                                                )
                                        )
                                ),
                                'monitorDeleteIssues' => array (
                                        'options' => array (
                                                'route' => 'monitorDeleteIssues --issueIds=',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'monitorDeleteIssues',
                                                        'apiMethod' => 'post'
                                                )
                                        )
                                ),
                                // Monitor Rules
                                'monitorSetRuleUpdated' => array (
                                        'options' => array (
                                                'route' => 'monitorSetRuleUpdated',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'monitorSetRuleUpdated',
                                                        'apiMethod' => 'post'
                                                )
                                        )
                                ),
                                'monitorExportRules' => array (
                                        'options' => array (
                                                'route' => 'monitorExportRules [--applicationId=]',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'monitorExportRules'
                                                )
                                        )
                                ),
                                'monitorImportRules' => array (
                                        'options' => array (
                                                'route' => 'monitorImportRules --monitorRules=',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller'
                                                )
                                        )
                                ),
                                'monitorGetRulesList' => array (
                                        'options' => array (
                                                'route' => 'monitorGetRulesList [--filters=]',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'monitorGetRulesList'
                                                )
                                        )
                                ),
                                'monitorEnableRules' => array (
                                        'options' => array (
                                                'route' => 'monitorEnableRules --rulesIds=',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'monitorEnableRules',
                                                        'apiMethod' => 'post'
                                                )
                                        )
                                ),
                                'monitorDisableRules' => array (
                                        'options' => array (
                                                'route' => 'monitorDisableRules --rulesIds=',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'monitorDisableRules',
                                                        'apiMethod' => 'post'
                                                )
                                        )
                                ),
                                'monitorSetRule' => array (
                                        'options' => array (
                                                'route' => 'monitorSetRule --rulesId= --ruleProperties= [--ruleConditions=] --ruleTriggers=',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'monitorSetRule',
                                                        'apiMethod' => 'post'
                                                )
                                        )
                                ),
                                'monitorRemoveRules' => array (
                                        'options' => array (
                                                'route' => 'monitorRemoveRules --rulesIds=',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'monitorRemoveRules',
                                                        'apiMethod' => 'post'
                                                )
                                        )
                                ),
                                // Notification
                                'getNotifications' => array (
                                        'options' => array (
                                                'route' => 'getNotifications [--hash=]',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'getNotifications'
                                                )
                                        )
                                ),
                                'deleteNotification' => array (
                                        'options' => array (
                                                'route' => 'deleteNotification --type=',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'deleteNotification',
                                                        'apiMethod' => 'post'
                                                )
                                        )
                                ),
                                'updateNotification' => array (
                                        'options' => array (
                                                'route' => 'updateNotification --type= [--repeat=]',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'updateNotification',
                                                        'apiMethod' => 'post'
                                                )
                                        )
                                ),
                                'sendNotification' => array (
                                        'options' => array (
                                                'route' => 'sendNotification --type= --ip=',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'sendNotification',
                                                        'apiMethod' => 'post'
                                                )
                                        )
                                ),
                                // Server & Cluster Management
                                'tasksComplete' => array (
                                        'options' => array (
                                                'route' => 'tasksComplete [--servers=] [--tasks=]',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'tasksComplete'
                                                )
                                        )
                                ),
                                'getServerInfo' => array (
                                        'options' => array (
                                                'route' => 'getServerInfo --serverId=',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'getServerInfo'
                                                )
                                        )
                                ),

                                'clusterGetServersCount' => array (
                                        'options' => array (
                                                'route' => 'clusterGetServersCount',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'clusterGetServersCount'
                                                )
                                        )
                                ),

                                'serverAddToCluster' => array (
                                        'options' => array (
                                                'route' => 'serverAddToCluster --serverName= --dbHost= --dbUsername= --dbPassword= --nodeIp= [--failIfConnected=]',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller'
                                                )
                                        )
                                ),
                                'changeServerNameById' => array (
                                        'options' => array (
                                                'route' => 'changeServerNameById --serverName= --serverId=',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'changeServerNameById',
                                                        'apiMethod' => 'post'
                                                )
                                        )
                                ),
                                'clusterForceRemoveServer' => array (
                                        'options' => array (
                                                'route' => 'clusterForceRemoveServer --serverId=',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'clusterForceRemoveServer',
                                                        'apiMethod' => 'post'
                                                )
                                        )
                                ),
                                'restartDaemon' => array (
                                        'options' => array (
                                                'route' => 'restartDaemon --daemon= [--servers=]',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'restartDaemon',
                                                        'apiMethod' => 'post'
                                                )
                                        )
                                ),
                                'logsReadLines' => array (
                                        'options' => array (
                                                'route' => 'logsReadLines --logName= [--serverId=] [--lineToRead=] [--filter=]',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'logsReadLines'
                                                )
                                        )
                                ),
                                'logsGetLogfile' => array (
                                        'options' => array (
                                                'route' => 'logsGetLogfile --logName= [--serverId=]',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'logsGetLogfile'
                                                )
                                        )
                                ),
                                // Statistics
                                'statisticsGetSeries' => array (
                                        'options' => array (
                                                'route' => 'statisticsGetSeries --type= [--appId=] [--from=] [--to=]',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'statisticsGetSeries'
                                                )
                                        )
                                ),
                                'statisticsClearData' => array (
                                        'options' => array (
                                                'route' => 'statisticsClearData',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'statisticsClearData',
                                                        'apiMethod' => 'post'
                                                )
                                        )
                                ),
                                // Studio integration
                                'studioStartDebugMode' => array (
                                        'options' => array (
                                                'route' => 'studioStartDebugMode --filters= [--options=]',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'studioStartDebugMode',
                                                        'apiMethod' => 'post'
                                                )
                                        )
                                ),
                                'studioStopDebugMode' => array (
                                        'options' => array (
                                                'controller' => 'webapi-api-controller',
                                                'route' => 'studioStopDebugMode',
                                                'defaults' => array (
                                                        'action' => 'studioStopDebugMode',
                                                        'apiMethod' => 'post'
                                                )
                                        )
                                ),
                                'studioIsDebugModeenabled' => array (
                                        'options' => array (
                                                'route' => 'studioIsDebugModeenabled',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'studioIsDebugModeenabled',
                                                        'apiMethod' => 'post'
                                                )
                                        )
                                ),
                                // Page cache
                                'pagecacheListRules' => array (
                                        'options' => array (
                                                'route' => 'pagecacheListRules [--applicationsId=] [--freeText=]',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'pagecacheListRules'
                                                )
                                        )
                                ),
                                'pagecacheSaveRule' => array (
                                        'options' => array (
                                                'route' => 'pagecacheSaveRule [--ruleId=] --urlScheme= --urlHost= --urlPath= --matchType= --lifetime= [--compress=] [--name=] [--conditionsType=] [--conditions=] [--splitBy=]',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'pagecacheSaveRule',
                                                        'apiMethod' => 'post'
                                                )
                                        )
                                ),
                                'pagecacheSaveApplicationRule' => array (
                                        'options' => array (
                                                'route' => 'pagecacheSaveApplicationRule [--ruleId=] --urlPath= --matchType= --lifetime= [--compress=] [--name=] --applicationId [--conditionsType=] [--conditions=] [--splitBy=]',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'pagecacheSaveApplicationRule',
                                                        'apiMethod' => 'post'
                                                )
                                        )
                                ),
                                'pagecacheDeleteRules' => array (
                                        'options' => array (
                                                'route' => 'pagecacheDeleteRules [--rules=]',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'pagecacheListRules'
                                                )
                                        )
                                ),
                                'pagecacheRuleInfo' => array (
                                        'options' => array (
                                                'route' => 'pagecacheRuleInfo --id=',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'pagecacheRuleInfo'
                                                )
                                        )
                                ),
                                'pagecacheClearCacheByRuleName' => array (
                                        'options' => array (
                                                'route' => 'pagecacheClearCacheByRuleName --ruleName=',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'pagecacheClearCacheByRuleName',
                                                        'apiMethod' => 'post'
                                                )
                                        )
                                ),
                                'pagecacheClearRulesCache' => array (
                                        'options' => array (
                                                'route' => 'pagecacheClearRulesCache --rules=',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'pagecacheClearRulesCache',
                                                        'apiMethod' => 'post'
                                                )
                                        )
                                )
                        )
                )
        )
);
