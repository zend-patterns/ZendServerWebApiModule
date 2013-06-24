<?php
return array (
		'console' => array (
				'router' => array (
						'routes' => array (
								'codetracingDisable' => array (
										'options' => array (
												'route' => 'zsapi codetracingDisable [--restartNow=]',
												'defaults' => array (
														'controller' => 'ZendServerWebApi\Controller\ZendServer',
														'action' => 'codetracingDisable',
														'apiMethod' => 'post' 
												) 
										) 
								)
								,
								'codetracingEnable' => array (
										'options' => array (
												'route' => 'zsapi codetracingEnable [--restartNow=]',
												'defaults' => array (
														'controller' => 'ZendServerWebApi\Controller\ZendServer',
														'action' => 'codetracingEnable',
														'apiMethod' => 'post' 
												) 
										) 
								)
								,
								'codetracingIsEnabled' => array (
										'options' => array (
												'route' => 'zsapi codetracingIsEnabled',
												'defaults' => array (
														'controller' => 'ZendServerWebApi\Controller\ZendServer',
														'action' => 'codetracingIsEnabled' 
												) 
										) 
								)
								,
								'codetracingCreate' => array (
										'options' => array (
												'route' => 'zsapi codetracingCreate --url=',
												'defaults' => array (
														'controller' => 'ZendServerWebApi\Controller\ZendServer',
														'action' => 'codetracingCreate',
														'apiMethod' => 'post' 
												) 
										) 
								)
								,
								'codetracingGetInfo' => array (
										'options' => array (
												'route' => 'zsapi codetracingGetInfo --id=',
												'defaults' => array (
														'controller' => 'ZendServerWebApi\Controller\ZendServer',
														'action' => 'codetracingGetInfo' 
												) 
										) 
								)
								,
								'codetracingDelete' => array (
										'options' => array (
												'route' => 'zsapi codetracingDelete --traceFile=',
												'defaults' => array (
														'controller' => 'ZendServerWebApi\Controller\ZendServer',
														'action' => 'codetracingDelete',
														'apiMethod' => 'post' 
												) 
										) 
								)
								,
								'codetracingDownloadTraceFile' => array (
										'options' => array (
												'route' => 'zsapi codetracingDownloadTraceFile --traceFile= [--eventsGroupId=]',
												'defaults' => array (
														'controller' => 'ZendServerWebApi\Controller\ZendServer',
														'action' => 'codetracingDownloadTraceFile' 
												) 
										) 
								)
								,
								// Deployment
								'applicationGetStatus' => array (
										'options' => array (
												'route' => 'zsapi applicationGetStatus [--applications=] [--direction=]',
												'defaults' => array (
														'controller' => 'ZendServerWebApi\Controller\ZendServer',
														'action' => 'applicationGetStatus' 
												) 
										) 
								)
								,
								'applicationDeploy' => array (
										'options' => array (
												'route' => 'zsapi applicationDeploy --appPackage= --baseUrl= [--createVhost=] [--defaultserver=] [--userAppName=] [--ignoreFialures=] [--userParams=]',
												'defaults' => array (
														'controller' => 'ZendServerWebApi\Controller\ZendServer',
														'action' => 'applicationDeploy',
														'apiMethod' => 'post' 
												) 
										) 
								)
								,
								'applicationUpdate' => array (
										'options' => array (
												'route' => 'zsapi applicationUpdate --appId= --appPackage= [--ignoreFailures=] [--userParams=]',
												'defaults' => array (
														'controller' => 'ZendServerWebApi\Controller\ZendServer',
														'action' => 'applicationUpdate',
														'apiMethod' => 'post' 
												) 
										) 
								)
								,
								'applicationRemove' => array (
										'options' => array (
												'route' => 'zsapi applicationRemove --appId=',
												'defaults' => array (
														'controller' => 'ZendServerWebApi\Controller\ZendServer',
														'action' => 'applicationRemove',
														'apiMethod' => 'post' 
												) 
										) 
								)
								,
								'applicationSynchronize' => array (
										'options' => array (
												'route' => 'zsapi applicationSynchronize --appId= [--servers=] [--ignoreFailures=]',
												'defaults' => array (
														'controller' => 'ZendServerWebApi\Controller\ZendServer',
														'action' => 'applicationSynchronize',
														'apiMethod' => 'post' 
												) 
										) 
								)
								,
								'applicationRollback' => array (
										'options' => array (
												'route' => 'zsapi applicationRollback --appId=',
												'defaults' => array (
														'controller' => 'ZendServerWebApi\Controller\ZendServer',
														
														'action' => 'applicationRollback',
														'apiMethod' => 'post' 
												) 
										) 
								),
								// Monitor
								'monitorGetRequestSummary' => array (
										'options' => array (
												'route' => 'zsapi monitorGetRequestSummary --requestUid=',
												'defaults' => array (
														'controller' => 'ZendServerWebApi\Controller\ZendServer',
														'action' => 'monitorGetRequestSummary' 
												) 
										) 
								)
								,
								'monitorGetIssuesByPredefinedFilter' => array (
										'options' => array (
												'route' => 'zsapi monitorGetIssuesByPredefinedFilter --filterId= [--limit=] [--offset=] [--order=] [--direction=] [--filters=]',
												'defaults' => array (
														'controller' => 'ZendServerWebApi\Controller\ZendServer',
														'action' => 'monitorGetIssuesByPredefinedFilter' 
												) 
										) 
								)
								,
								'monitorGetIssuesDetails' => array (
										'options' => array (
												'route' => 'zsapi monitorGetIssuesDetails --issueId= [--limit=]',
												'defaults' => array (
														'controller' => 'ZendServerWebApi\Controller\ZendServer',
														'action' => 'monitorGetIssuesDetails' 
												) 
										) 
								)
								,
								'monitorGetEventGroupDetails' => array (
										'options' => array (
												'route' => 'zsapi monitorGetEventGroupDetails --issueId= --eventsGroupId=',
												'defaults' => array (
														'controller' => 'ZendServerWebApi\Controller\ZendServer',
														'action' => 'monitorGetEventGroupDetails' 
												) 
										) 
								)
								,
								'monitorExportIssueByEventsGroup' => array (
										'options' => array (
												'route' => 'zsapi monitorExportIssueByEventsGroup --eventsGroupId=',
												'defaults' => array (
														'controller' => 'ZendServerWebApi\Controller\ZendServer',
														'action' => 'monitorExportIssueByEventsGroup' 
												) 
										) 
								)
								,
								'monitorChangeIssueStatus' => array (
										'options' => array (
												'route' => 'zsapi monitorChangeIssueStatus --issueId= --newStatus=',
												'defaults' => array (
														'controller' => 'ZendServerWebApi\Controller\ZendServer',
														'action' => 'monitorChangeIssueStatus',
														'apiMethod' => 'post' 
												) 
										) 
								)
								,
								// Studio integration
								'studioStartDebug' => array (
										'options' => array (
												'route' => 'zsapi studioStartDebug --eventsGroupId= [--noRemote=] [--overrideHost=]',
												'defaults' => array (
														'controller' => 'ZendServerWebApi\Controller\ZendServer',
														'action' => 'studioStartDebug',
														'apiMethod' => 'post' 
												) 
										) 
								)
								,
								'studioStartProfile' => array (
										'options' => array (
												'route' => 'zsapi studioStartProfile --eventsGroupId= [--overrideHost=]',
												'defaults' => array (
														'controller' => 'ZendServerWebApi\Controller\ZendServer',
														'action' => 'studioStartProfile',
														'apiMethod' => 'post' 
												) 
										) 
								)
								,
								'studioShowSource' => array (
										'options' => array (
												'route' => 'zsapi studioShowSource --eventsGroupId= [--overrideHost=]',
												'defaults' => array (
														'controller' => 'ZendServerWebApi\Controller\ZendServer',
														'action' => 'studioShowSource',
														'apiMethod' => 'post' 
												) 
										) 
								)
								 
						) 
				) 
		) 
);
