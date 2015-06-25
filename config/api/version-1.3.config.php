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
                                                ),
                                        		'arrays' => array(
                                        				'ldap'
												),
                                        		'group' => 'admin',
                                        		'info' => array(
                                        				'Modify current authentication settings, allowing the user to switch between simple and extended authentication and authorization schemes.',
                                        				array('--type','One of : simple, extended'),
                                        				array('--ldap','Array of ldap properties:
host: host, ip or location of the active directory
port: port part of the URL above
encryption:
ssl - use SSL to secure communications
tls - start TLS to secure communications
none - no encryption is used
username: directory username, broken to CN and DC parts for use in querying the active directory
password: matching password for the above username
baseDn: DN broken down to CN and DC parts for using during user authentication
bindRequiresDn: 0 for use with Active Directory, 1 for use with other LDAP services
groupsAttribute: Name for a list of user groups’ membership'),
                                        				array('--password','Current user’s password for authentication'),
                                        				array('--confirmNewPassword','Confirmation of new password'),
                                        				
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
                                                ),
                                        		'group' => 'admin',
                                        		'info' => array(
                                        				'Modify a specific user password. This action changes any user password and is an administrative action. Note that a separate action exists for the user to modify his own password and has a lower permission level.',
                                        				array('--username','This username will have his password modified.'),
                                        				array('--password','Password of the user executing this command.'),
                                        				array('--newPassword','New password.'),
                                        				array('--confirmNewPassword','Confirmation of new password.'),
                                        		)
                                        )
                                ),
                                'setPassword' => array (
                                        'options' => array (
                                                'route' => 'setPassword --password= --newPassword= --confirmNewPassword=',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'setPassword',
                                                        'apiMethod' => 'post'
                                                ),
                                        		'group' => 'admin',
                                        		'info' => array(
                                        				'Modify a current user password.',
                                        				array('--password','Current password.'),
                                        				array('--newPassword','New password.'),
                                        				array('--confirmNewPassword','Confirmation of new password.'),
                                        		)
                                        )
                                ),
                                'apiKeysGetList' => array (
                                        'options' => array (
                                                'route' => 'apiKeysGetList',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'apiKeysGetList'
                                                ),
                                        		'group' => 'admin',
                                        		'info' => array(
                                        				'Get a list of api keys.',
                                        		)
                                        )
                                ),
                                'apiKeysAddKey' => array (
                                        'options' => array (
                                                'route' => 'apiKeysAddKey --name= --username= [--hash=]',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'apiKeysAddKey',
                                                        'apiMethod' => 'post'
                                                ),
                                        		'group' => 'admin',
                                        		'info' => array(
                                        				'Add a WebAPI Key.',
                                        				array('--name','The name of the key'),
                                        				array('--username','Any username supplied for retrieving ACL information'),
									array('--hash','The hash for the key'),
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
                                                ),
                                        		'arrays' => array(
                                        			'ids'
                                        		),
                                        		'group' => 'admin',
                                        		'info' => array(
                                        				'Remove a WebAPI Key.',
                                        				array('--ids','Id of the key'),
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
                                                ),
                                        		'group' => 'admin',
                                        		'info' => array(
                                        				'Validate a Zend Server license.',
                                        				array('--licenseName','The name of the license'),
                                        				array('--licenseValue','The value of the license'),
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
                                                ),
                                        		'arrays' => array(
                                        				'role_groups',
                                        				'app_groups'
												),
                                        		'group' => 'admin',
                                        		'info' => array(
                                        				'Store a set of group mappings for resolving user roles during authentication. These groups correspond to roles within the system or to applications that implicitly grant the developerLimited role to the user.',
                                        				array('--role_groups','An associative list of role names and their corresponding group.'),
                                        				array('--app_groups','An associative list of application IDs (numbers) and their corresponding group.'),
                                        		)
                                        )
                                ),
                                'bootstrapSingleServer' => array (
                                        'options' => array (
                                                'route' => 'bootstrapSingleServer [--zsurl=] [--production=] --adminPassword= [--applicationUrl=] [--adminEmail=] [--developerPassword=] [--orderNumber=] [--licenseKey=] --acceptEula [--simple-output]',
                                                'defaults' => array (
                                                        'zsurl'     => 'http://localhost:10081',
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'bootstrapSingleServer',
                                                        'apiMethod' => 'post'
                                                ),
                                                'no-target' => true,
                                                'async' => true,
                                        		'group' => 'admin',
                                        		'info' => array(
                                        				'Bootstrap a server for standalone usage in production or development environment. This action is designed to give an automated process the option to bootstrap a server with particular settings.',
                                        				array('--zsurl','The url of the Zend Server to be bootstrapped. Default is http://localhost:10081.'),
                                        				array('--production','Bootstrap this server using the factory “production” usage profile. Default value: true. If joining a cluster, a special “cluster” value will be stored.'),
                                        				array('--adminPassword','The new administrator password to store for authentication'),
                                        				array('--applicationUrl','The default application URL to use when displaying and handling deployed application URLs in the UI. Default: empty'),
                                        				array('--adminEmail','The default Email to use when sending notifications about events, audit entries and other features'),
                                        				array('--developerPassword','The new developer user password to be stored for authentication. If no password is supplied, the developer user will not be created'),
                                        				array('--orderNumber','License order number to store in the server’s configuration. This license can be obtained from zend.com'),
                                        				array('--licenseKey','License key to store in the server’s configuration. This license can be obtained from zend.com'),
                                        				array('--acceptEula','Must be set to true to accept ZS6’s EULA'),
                                        				array('--simple-output','If provided returns simple output with the web api key and secret.'),
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
                                                ),
                                        		'group' => 'admin',
                                        		'info' => array(
                                        				'Validate and store a Zend Server license key.',
                                        				array('--licenseName','The license name.'),
                                        				array('--licenseValue','The license value.'),
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
                                                ),
                                        		'arrays' => array(
                                        				'filters'
												),
                                        		'group' => 'audit',
                                        		'info'  => array(
                                        			'Get a list of audit entries.',
                                        			array('--limit','The number of rows to retrieve. Default lists all audit entries up to an arbitrary limit set by the system'),
                                        			array('--offset','A paging offset to begin the list from. Default: 0'),
                                        			array('--order','Column identifier for sorting the result set (audit_id, node_id, time). Default: audit_id'),
                                        			array('--direction','Sorting direction: ASC or DESC. Default: DESC'),
                                        			array('--filter','Add filter parameters in an ad-hoc manner. These filters will be added to the predefined filter that was passed. This parameter is an array with a predefined set of parameters that accept strings or arrays to hold multiple values:
from: string, a timestamp to use for retrieving audit rows
to: string, a timestamp to use for retrieving audit rows
freeText: string
auditGroups: array, a list of auditGroups-
AUDIT_GROUP_DEPLOYMENT
AUDIT_GROUP_CONFIGURATION
AUDIT_GROUP_RESTART
AUDIT_GROUP_SETTINGS_CHANGES
AUDIT_GROUP_AUTHENTICATION
AUDIT_GROUP_AUTHORIZATION
AUDIT_GROUP_BOOTSTRAP
AUDIT_GROUP_CLUSTER_MANAGEMENT
AUDIT_GROUP_CODETRACING
AUDIT_GROUP_MONITOR
AUDIT_GROUP_STUDIO
AUDIT_GROUP_CLEAR_CACHE
AUDIT_GROUP_PAGE_CACHE_RULES
AUDIT_GROUP_JOBQUEUE_RULES
AUDIT_GROUP_PHPINFO
AUDIT_GROUP_WEBAPI
AUDIT_GROUP_LICENSE'),
												)
                                        )
                                ),
                                'auditGetDetails' => array (
                                        'options' => array (
                                                'route' => 'auditGetDetails --auditId=',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'auditGetDetails'
                                                ),
                                        		'group' => 'audit',
                                        		'info'  => array(
                                        			'Get all details available on a particular audit item.',
                                        			array('--auditId','Audit ID to get all details for'),
                                        		),	
                                        )
                                ),
                                'auditSetSettings' => array (
                                        'options' => array (
                                                'route' => 'auditSetSettings --history= [--email=] [--callbackUrl=]',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'auditSetSettings',
                                                        'apiMethod' => 'post'
                                                ),
                                        		'group' => 'audit',
                                        		'info'  => array(
                                        			'Save settings of audit history and triggers.',
                                        			array('--history','Number of saved days in history'),
                                        			array('--email','Array of email value and array of audit types'),
                                        			array('--callbackUrl','Array of URL value and array of audit types'),
                                        		),	
                                        )
                                ),
                        		'auditExport' => array (
                        				'options' => array (
                        						'route' => 'auditExport [--filters=]',
                        						'defaults' => array (
                        								'controller' => 'webapi-api-controller',
                        								'action' => 'auditExport',
                        						),
                        						'arrays' => array(
                        							'filters'
                        						),
                        						'group' => 'audit',
                        						'info'  => array(
                        								'Export the audit log to zipped log file.',
                        								array('--filters','Array of filters: ‘from’ and ‘to’ timestamps, ‘auditGroups’ for groups types, ‘freeText’ for string search and ‘outcome’ for status of result.'),
                        						),
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
                                                ),
                        						'group' => 'cache',
                        						'info'  => array(
                        								'Clear cache data of a specified component.',
                        								array('--component','One of ‘Zend Data Cache’, ‘Zend Page Cache’, ‘Zend Optimizer+’'),
                        						),
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
                                                ),
                                                'arrays' => array(
                                                        'templateParams',
                                                        'headers'
                                                ),
                                        		'group' => 'configuration',
                                        		'info' => array(
                                        				'This action allows you to send email.',
                                        				array('--to','Valid email address of a recipient.'),
		                                        		array('--toName','Name the recipient.'),
		                                        		array('--from','Valid email address from your domain.'),
		                                        		array('--fromName=','This is name appended to the from email field.'),
		                                        		array('--subject','The subject of your email.'),
		                                        		array('--templateName','The template name without an extension .phtml.'),
		                                        		array('--templateParams','Parameters that will be assigned to your template.'),
		                                        		array('--headers','Add a raw header line, either in name1=value1&name2=value2 (valid query string format).'),
		                                        		array('--html','The content type: ‘true’ for html, ‘false’ for plain text. Default is true.'),
                                        				array('Example:','emailSend --to=slavey@zend.com --from=admin@test.com --subject="Failed test" --templateName="failed" --templateParams="user=Peter&type=error" --headers="X-Importance=High&Return-To=admin@test.com"')
                                        		),
                                        )
                                ),
                                'configurationExtensionsOn' => array (
                                        'options' => array (
                                                'route' => 'configurationExtensionsOn --extensions=',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'configurationExtensionsOn',
                                                        'apiMethod' => 'post'
                                                ),
                                                'arrays' => array(
                                                        'extensions'
                                                ),
                                        		'group' => 'configuration',
                                        		'info' => array(
                                        				'Activates an extension by loading it. This action requires a restart be performed on the server to apply the change.',
                                        				array('--extensions','Comma separated list of extensions to activate.'),
                                        				array('Example:','configurationExtensionsOn --extensions="mysql,gd,ftp"')
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
                                                ),
                                                'arrays' => array(
                                                        'extensions'
                                                ),
                                        		'group' => 'configuration',
                                        		'info' => array(
                                        				'Deactivates an extension by unloading it. This action requires a restart be performed on the server to apply the change.',
                                        				array('--extensions','Comma separated list of extensions to deactivate.'),
                                        				array('Example:','configurationExtensionsOff --extensions="mysql,gd,ftp"')
												)
                                        )
                                ),
                                'configurationValidateDirectives' => array (
                                        'options' => array (
                                                'route' => 'configurationValidateDirectives --directives=',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'configurationValidateDirectives'
                                                ),
                                                'arrays' => array(
                                                        'directives'
                                                ),
                                        		'group' => 'configuration',
                                        		'info' => array(
                                        				'Validate and list directives and their corresponding values. Directives are validated according to their type and a predefined validation scheme. This action does not make any configuration changes.',
                                        				array('--directives','HTTP query string representing associative array of directive names and values to be validated'),
                                        				array('Example:','configurationValidateDirectives --directives="date.timezone=Europe/Berlin&allow_url_include=Off"')
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
                                                ),
                                                'arrays' => array(
                                                        'directives'
                                                ),
                                        		'group' => 'configuration',
                                        		'info' => array(
                                        				'Validate and store a list of directives and their corresponding values in the server’s configuration. Directives are validated according to their type and a predefined validation scheme.',
                                        				array('--directives','HTTP query string representing associative array of directive names and values to be validated'),
                                        				array('Example:','configurationStoreDirectives --directives="date.timezone=Europe/Berlin&allow_url_include=Off"')
                                        		)
                                        )
                                ),
                                'configurationSearch' => array (
                                        'options' => array (
                                                'route' => 'configurationSearch --query= [--filter=]',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'configurationSearch'
                                                ),
                                        		'group' => 'configuration',
                                        		'info' => array(
                                        				'Retrieve a list of extension and directive names that correspond to a search executed on a filter.',
                                        				array('--query','Search keyword'),
                                        				array('--filter','String'),
                                        				array('Example:','configurationSearch --query="gob" --filter="All Extensions"')
                                        		)
                                        )
                                ),
                                'configurationExtensionsList' => array (
                                        'options' => array (
                                                'route' => 'configurationExtensionsList [--type=] [--order=] [--direction=] [--filter=]',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'configurationExtensionsList'
                                                ),
                                        		'group' => 'configuration',
                                        		'info' => array(
                                        				'Retrieve a list of extensions and associated information. This list can be filtered by extension type (PHP Extension and Zend Extension). This list of extensions contains only meta and operation information about the extension, and does not include directives and internal state.',
                                        				array('--type','Retrieve only extensions of a specific type (one of “all”, ”zend”, “php”). Default: All'),
                                        				array('--order','Column to sort the result by (name, status). Default: (extension) name'),
                                        				array('--direction','Sorting direction: ASC or DESC. Default: ASC'),
                                        				array('--filter','Apply a certain case-insensitive string filter to the extensions returned'),
                                        				array('Example:','configurationExtensionsList --type=php --order=name --direction=ASC')
                                        		)
                                        )
                                ),
                                'configurationDirectivesList' => array (
                                        'options' => array (
                                                'route' => 'configurationDirectivesList [--extension=] [--daemon=] [--filter=]',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                		'action'     => 'configurationDirectivesList'
                                                ),
                                        		'group' => 'configuration',
                                        		'info' => array(
                                        				'Retrieve a filtered list of directives and associated information. This list can be filtered by extension name, however if an invalid or non-existing extension is passed, an valid empty result will be returned.',
                                        				array('--extension','Retrieve only directives of a specific extension. Default: Retrieve all known directives regardless of extensions. If no extension name is provided, the output will be modified so that the extension element is empty'),
                                        				array('--daemon','Retrieve only directives of a specific zend daemon. Note that both extension and daemon parameters cannot be passed.'),
                                        				array('--filter','Filter out the directives returned according to a certain text.'),
                                        				array('Example:','configurationDirectivesList --extension="mysql"')
                                        		)
                                        )
                                ),

                                'configurationComponentsList' => array (
                                        'options' => array (
                                                'route' => 'configurationComponentsList [--filter=]',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'configurationComponentsList'
                                                ),
                                        		'group' => 'configuration',
                                        		'info' => array(
                                        				'Retrieve a list of zend components and associated information. Each component holds information both on it’s extension and it’s daemon (service). If the component does not have a daemon, then daemon status returned is ‘None’.',
                                        				array('--filter','Apply a certain case-insensitive string filter to the components returned.'),
                                        				array('Example:','configurationComponentsList --filter="zend_opti"')
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
                                                ),
                                        		'group' => 'configuration',
                                        		'info' => array(
                                        				'Revert the configuration on a given server to their default settings.',
                                        				array('--serverId','ID of the server that needed to be reverted to blueprint'),
                                        				array('--doRestart','Should a restart be performed after the changes were reverted.'),
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
                                                ),
                                        		'group' => 'configuration',
                                        		'info' => array(
                                        				'Apply the configuration changes on a given server to the blueprint. In a cluster environment, this will apply the changes to all servers in the cluster.',
                                        				array('--serverId','ID of the server that needed to be reverted to blueprint'),
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
                                                ),
                                                'files' => array(
                                                        'configFile'
                                                ),
                                        		'group' => 'configuration',
                                        		'info' => array(
                                        				'Import a saved configuration snapshot into the server.',
                                        				array('--configFile','Configuration snapshot file to import.'),
                                        				array('--ignoreSystemMismatch','If set to TRUE, configuration must be applied even if it was exported from a different system (other major PHP version, ZS version or operating system). Default is FALSE.'),
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
                                                ),
                                        		'group'=> 'deployment',
                                        		'info' => array(
                                        				"Retrieve package and meta information about a deployed application. This action provides the most complete list of information about a single application we can provide.",
                                        				array('--application','An application ID.'),
												),
                                        )
                                ),
                                'redeployAllApplications' => array (
                                        'options' => array (
                                                'route' => 'redeployAllApplications [--servers=]',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'redeployAllApplications',
                                                        'apiMethod' => 'post'
                                                ),
                                        		'arrays' => array(
                                        			'servers'
                                        		),
                                        		'group'=> 'deployment',
                                        		'info' => array(
                                        				"Redeploy all applications currently registered in the system for the specified servers. This action only sends the operation request and will not wait on completion.",
                                        				array('--servers','List of servers to perform the operation on. Default: All servers.'),
                                        				array('Example:','redeployAllApplications --servers="1,4"')
												),
                                        )
                                ),

                                'applicationDefine' => array (
                                        'options' => array (
                                                'route' => 'applicationDefine --name= --baseUrl= [--version=] [--healthCheck=] [--logo=]',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'applicationDefine',
                                                        'apiMethod' => 'post'
                                                ),
                                        		'files' => array(
                                        				'logo'
												),
                                        		'group'=> 'deployment',
                                        		'info' => array(
                                        				"Define application to the server or cluster. This process is asynchronous – the initial request will wait until the application is defined, and the initial response will show information about the application being defined – however the staging and activation process will proceed after the response is returned. The user is expected to continue checking the application status using the applicationGetStatus method until the deployment process is complete.",
                                        				array('--name','Application name.'),
                                        				array('--baseUrl','Base URL to define the application to. Must be an HTTP URL. use <default-server> if needed.'),
                                        				array('--version','The version of the application.'),
                                        				array('--healthCheck','The health check url.'),
                                        				array('--logo','Logo image file.'),
												),
                                        )
                                ),
                                // Filter
                                'filterGetByType' => array (
                                        'options' => array (
                                                'route' => 'filterGetByType --type=',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'filterGetByType'
                                                ),
                                        		'group'=> 'filter',
                                        		'info' => array(
                                        				"Retrieve and display a list of filters.",
                                        				array('--type','Type of a filter (issue,job)'),
                                        		),
                                        )
                                ),
                                'filterSave' => array (
                                        'options' => array (
                                                'route' => 'filterSave --type= --name= [--data=] [--id=]',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'filterSave',
                                                        'apiMethod' => 'post'
                                                ),
                                        		'arrays' => array(
                                        				'data'
												),
                                        		'group'=> 'filter',
                                        		'info' => array(
                                        				"Save a filter.",
                                        				array('--type','Type of a filter (issue,job)'),
                                        				array('--name','Name of filter.'),
                                        				array('--data','Array of parameters to be saved.'),
                                        				array('--id','ID of a filter.'),
                                        		),
                                        )
                                ),
                                'filterDelete' => array (
                                        'options' => array (
                                                'route' => 'filterDelete --name=',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'filterDelete'
                                                ),
                                        		'group'=> 'filter',
                                        		'info' => array(
                                        				"Delete a filter.",
                                        				array('--name','Name of filter.'),
                                        		),
                                        )
                                ),
                                // Job Queue
                                'jobqueueStatistics' => array (
                                        'options' => array (
                                                'route' => 'jobqueueStatistics',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'jobqueueStatistics'
                                                ),
                                        		'group'=> 'jobqueue',
                                        		'info' => array(
                                        				"Retrieve and display JobQueue daemon statistics. Note that these statistics are collected separately from the centralized Statistics mechanism.",
                                        		),
                                        )
                                ),
                                'jobqueueJobsList' => array (
                                        'options' => array (
                                                'route' => 'jobqueueJobsList [--limit=] [--offset=] [--orderBy=] [--direction=] [--filter=]',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                		'action'=> 'jobqueueJobsList'
                                                ),
                                        		'arrays' => array(
                                        				'filter'
                                        		),
                                        		'group'=> 'jobqueue',
                                        		'info' => array(
                                        				"Job Queue API actions provide external actors with ways to query and manipulate jobs and their recurring definitions.",
                                        				array('--limit','Row limit to retrieve, defaults to value defined in zend-user-user.ini'),
                                        				array('--offset','The page offset to be displayed, defaults to 0'),
                                        				array('--orderBy','Column to sort the result by. Defaults to Date'),
                                        				array('--direction','Sorting direction , defaults to Desc.'),
                                        				array('--filter','Associative array, accteps any of the following keys: app_id, name, script, priority, status, rule_id, scheduled_before, scheduled_after, executed_before, executed_after, freeText The priority key, accepts the following values: low, normal, high, urgent. The status key, accepts the following values: Active, Waiting, Running, Completed, Failed, Timeout, Removed, Scheduled, Suspended'),
                                        		),
                                        )
                                ),
                                'jobqueueJobInfo' => array (
                                        'options' => array (
                                                'route' => 'jobqueueJobInfo --id=',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'jobqueueJobInfo'
                                                ),
                                        		'group'=> 'jobqueue',
                                        		'info' => array(
                                        				"Retrieve and display a list of jobs.",
                                        				array('--id','ID of the job.'),
                                        		),
                                        )
                                ),
                                'jobqueueDeleteJobs' => array (
                                        'options' => array (
                                                'route' => 'jobqueueDeleteJobs --jobs=',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'jobqueueDeleteJobs',
                                                        'apiMethod' => 'post'
                                                ),
                                        		'arrays' => array(
                                        				'jobs'
                                        		),
                                        		'group'=> 'jobqueue',
                                        		'info' => array(
                                        				"Delete job queue.",
                                        				array('--jobs','A list of Job IDs'),
                                        		),
                                        )
                                ),
                        		'jobqueueDeleteJobsByPredefinedFilter ' => array (
                        				'options' => array (
                        						'route' => 'jobqueueDeleteJobsByPredefinedFilter  [--filterName=] [--filter=]',
                        						'defaults' => array (
                        								'controller' => 'webapi-api-controller',
                        								'action' => 'jobqueueDeleteJobsByPredefinedFilter ',
                        								'apiMethod' => 'post'
                        						),
                        						'arrays' => array(
                        								'filter'
                        						),
                        						'group'=> 'jobqueue',
                        						'info' => array(
                        								"Delete job queue jobs according to a filter.",
                        								array('--filterName',"A predefined filter's name. This parameter is case-sensitive."),
                        								array('--filter','Associative array, accepts any of the following keys: app_id, name, script, priority, status, rule_id, scheduled_before, scheduled_after, executed_before, executed_after, freeText The priority key, accepts the following values: low, normal, high, urgent. The status key, accepts the following values: Active, Waiting, Running, Completed, Failed, Timeout, Removed, Scheduled, Suspended'),
                        						),
                        				)
                        		),
                                'jobqueueRequeueJobs' => array (
                                        'options' => array (
                                                'route' => 'jobqueueRequeueJobs --jobs=',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'jobqueueRequeueJobs',
                                                        'apiMethod' => 'post'
                                                ),
                                        		'arrays' => array(
                                        				'jobs'
                                        		),
                                        		'group'=> 'jobqueue',
                                        		'info' => array(
                                        				"Requeue a job.",
                                        				array('--jobs','A comma separated list of Job IDs'),
                                        		),
                                        )
                                ),
                                'jobqueueListRules' => array (
                                        'options' => array (
                                                'route' => 'jobqueueListRules [--limit=] [--offset=] [--orderBy=] [--direction=]',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'jobqueueListRules'
                                                ),
                                        		'group'=> 'jobqueue',
                                        		'info' => array(
                                        				"Retrieve and display a list of jobs rules.",
                                        				array('--limit','Row limit to retrieve, defaults to value defined in zend-user-user.ini.'),
                                        				array('--offset','The page offset to be displayed, defaults to 0.'),
                                        				array('--orderBy','Column to sort the result by, defaults to Date.'),
                                        				array('--direction','Sorting direction , defaults to Desc.'),
                                        		),
                                        )
                                ),
                                'jobqueueRuleInfo' => array (
                                        'options' => array (
                                                'route' => 'jobqueueRuleInfo --id=',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'jobqueueRuleInfo'
                                                ),
                                        		'group'=> 'jobqueue',
                                        		'info' => array(
                                        				"Retrieve and display a job rule information.",
                                        				array('--id','Rule ID'),
                                        		),
                                        )
                                ),
                                'jobqueueSaveRule' => array (
                                        'options' => array (
                                                'route' => 'jobqueueSaveRule --url= --options= [--vars=]',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'jobqueueSaveRule',
                                                        'apiMethod' => 'post'
                                                ),
                                        		'arrays' => array(
                                        				'options',
                                        				'vars'
                                        		),
                                        		'group'=> 'jobqueue',
                                        		'info' => array(
                                        				"Create a job queue rule.",
                                        				array('--url','A URL for the job.'),
                                        				array('--options','Rule options.'),
                                        				array('--vars','Variables for the rule.'),
                                        		),
                                        )
                                ),
                        		'jobqueueDisableRules' => array (
                        				'options' => array (
                        						'route' => 'jobqueueDisableRules --rules=',
                        						'defaults' => array (
                        								'controller' => 'webapi-api-controller',
                        								'action' => 'jobqueueDisableRules',
                        								'apiMethod' => 'post'
                        						),
                        						'arrays' => array(
                        								'rules',
                        						),
                        						'group'=> 'jobqueue',
                        						'info' => array(
                        								"Suspend a job queue rule.",
                        								array('--rules','A comma-separated list of rule IDs.'),
                        						),
                        				)
                        		),
                                'jobqueueResumeRules' => array (
                                        'options' => array (
                                                'route' => 'jobqueueResumeRules --rules=',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'jobqueueResumeRules',
                                                        'apiMethod' => 'post'
                                                ),
                        						'arrays' => array(
                        								'rules',
                        						),
                                        		'group'=> 'jobqueue',
                                        		'info' => array(
                                        				"Resume a suspended job queue rule.",
                                        				array('--rules','A comma-separated list of rule IDs.'),
                                        		),
                                        )
                                ),
                                'jobqueueDeleteRules' => array (
                                        'options' => array (
                                                'route' => 'jobqueueDeleteRules --rules=',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'jobqueueDeleteRules',
                                                        'apiMethod' => 'post'
                                                ),
                        						'arrays' => array(
                        								'rules',
                        						),
                                        		'group'=> 'jobqueue',
                                        		'info' => array(
                                        				"Delete a job queue rule.",
                                        				array('--rules','A comma-separated list of rule IDs.'),
                                        		),
                                        )
                                ),
                                'jobqueueRunNowRule' => array (
                                        'options' => array (
                                                'route' => 'jobqueueRunNowRule --rule=',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'jobqueueRunNowRule',
                                                        'apiMethod' => 'post'
                                                ),
                                        		'group'=> 'jobqueue',
                                        		'info' => array(
                                        				"Run a scheduled job that was scheduled for a later time.",
                                        				array('--rule','A rule ID.'),
                                        		),
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
                                        		'info' => array (
                                        				'Get the library version ID that is deployed on the server or the cluster, and information about that version and its library.',
                                        				array('--libraryVersionId','Library version identifier. Note that a codetracing identifier is provided as part of the LibraryGetStatus xml response.')
                                        		)
                                        )
                                ),

                                'getBacktraceFile' => array (
                                        'options' => array (
                                                'route' => 'getBacktraceFile --backtraceNum= --eventsGroupId=',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'getBacktraceFile'
                                                ),
                                        		'group' => 'monitor',
                                        		'info' => array (
                                        				'Retrieve an event’s backtrace file payload. The file is returned encoded in base64 to conserve the xml structure of the response and its internal information.',
                                        				array('--backtraceNum','The backtrace step from the events group to be retrieved, used to choose which file to retrieve.'),
                                        				array('--eventsGroupId','Events group identifier, provided in the eventsGroup element.'),
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
                                                ),
                                        		'arrays'=> array (
                                        				'filters'
												),
                                        		'group' => 'monitor',
                                        		'info' => array (
                                        				"Delete monitor issues based on some filtering parameters Response returns the amount of issues that were deleted. Note though, that as this method only marks the issues for deletion, subsequent calls with the same parameters will return the same size of issues deleted rather than expected 0.
Modify an Issue's status code based on an Issue's Id and a status code.",
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
                                'monitorDeleteIssues' => array (
                                        'options' => array (
                                                'route' => 'monitorDeleteIssues --issueIds=',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'monitorDeleteIssues',
                                                        'apiMethod' => 'post'
                                                ),
                                        		'arrays' => array(
                                        				'issueIds'
												),
                                        		'group' => 'monitor',
                                        		'info' => array (
                                        				'Delete monitor issues based on issueIds passed. Response returns the amount of issues that were deleted. Note though, that as this method only marks the issues for deletion, subsequent calls with the same parameters will return the same size of issues deleted rather than expected 0.',
                                        				array('--issueIds','Comma-separated list of issue ids.')
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
                                                ),
                                        		'group' => 'monitor-rules',
                                        		'info' => array (
                                        				'Cause monitor rules to be applied to the monitor extension.',
                                        		)
                                        )
                                ),
                                'monitorExportRules' => array (
                                        'options' => array (
                                                'route' => 'monitorExportRules [--applicationId=]',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'monitorExportRules'
                                                ),
                                        		'group' => 'monitor-rules',
                                        		'info' => array (
                                        				'Create an xml document that contains all monitor rules for an application. This document conforms to the structure required by the Deployment package to include rules in a zpk.
Note that this action returns an unusual xml format and does not conform to the rest of the API in terms of structural conformity. The XSD for validating the document is provided in the appendices at the end of the document
Also note that this action returns only an XML output - it is not allowed to return a JSON format and an 406 error will be returned for a JSON output request.',
                                        				array('--applicationId','Application to retrieve rules for. Default: Global rules')
                                        		)
                                        )
                                ),
                                'monitorImportRules' => array (
                                        'options' => array (
                                                'route' => 'monitorImportRules --monitorRules=',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                		'action'=> 'monitorImportRules',
                                                		'apiMethod' => 'post'
                                                ),
                                        		'group' => 'monitor-rules',
                                        		'info' => array (
                                        				'Receives a list of global rules in XML formats. Refactors the XML to an array and updates the server’s rules accordingly.',
                                        				array('--monitorRules','An XML string that describes the rules to be imported. This xml structure is identical to the one use in monitorExportRules action.')
                                        		)
                                        )
                                ),
                                'monitorGetRulesList' => array (
                                        'options' => array (
                                                'route' => 'monitorGetRulesList [--filters=]',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'monitorGetRulesList'
                                                ),
                                        		'arrays' => array(
                                        				'filters'
                                        		),
                                        		'group' => 'monitor-rules',
                                        		'info' => array (
                                        				'Retrieve a list of monitor rules.',
                                        				array('--filters','Add filter parameters in an ad-hoc manner. This parameter is an array with a predefined set of parameters that accept strings or arrays to hold multiple values:
applications: array, a list of application IDs to use for retrieving rules rows 
ruleIds: array, a list of rules IDs to use for retrieving rules rows
freeText: Free text filter')
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
                                                ),
                                        		'arrays' => array(
                                        				'rulesIds'
												),
                                        		'group' => 'monitor-rules',
                                        		'info' => array (
                                        				'Enable a list of Monitor rules.',
                                        				array('--rulesIds','Comma-separated list of rules ids to be enabled.')
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
                                                ),
                                        		'arrays' => array(
                                        				'rulesIds'
												),
                                        		'group' => 'monitor-rules',
                                        		'info' => array (
                                        				'Disable a list of Monitor rules.',
                                        				array('--rulesIds','Comma-separated list of rules ids to be disabled.')
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
                                                ),
                                        		'arrays' => array(
                                        				'ruleProperties',
                                        				'ruleConditions',
                                        				'ruleTriggers',
												),
                                        		'group' => 'monitor-rules',
                                        		'info' => array (
                                        				'Add/modify a monitor rule.',
                                        				array('--rulesId','The ruleId of the rule to be set. -1 for new rule'),
                                        				array('--ruleProperties','Associative array with the following mandatory rule properties: "rule_type_id", "rule_parent_id", "app_id", "name", "enabled" (1|0), "description", "url" and the following optional property: "creator" (0|1|2) - creator field with value “0” indicates that this is a Global rule, while value “1” indicates that this is a user defined rule and value“2” indicates that this rule originated from an application package. Default value is 1'),
                                        				array('--ruleConditions','Optional Array of conditions, each condition should have the following list of properties: "condition_id", "operation", "attribute", "operand" .'),
                                        				array('--ruleTriggers','List of triggers. Each trigger is an associative array, with the following properties: triggerProperties - Mandatory Array with the following properties: "severity" (integer), "trigger_id" triggerConditions - Optional Array of conditions, each condition should have the following list of properties: "condition_id", "operation", "attribute", "operand" triggerActions - Optional Array of actions, each action should have the following list of properties: "action_id", "action_type" (integer), "action_url", "tracing_duration" (integer)'),
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
                                                ),
                                        		'arrays' => array(
                                        				'rulesIds'
												),
                                        		'group' => 'monitor-rules',
                                        		'info' => array (
                                        				'Remove a monitor application rule (Global rules cannot be removed).',
                                        				array('--rulesIds','Comma-separated list of rules ids to be removed.')
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
                                                ),
                                        		'group' => 'notification',
                                        		'info' => array (
                                        				'Retrieve a list of system messages, their details and meta information. The list of messages includes state messages which cannot be modified and instance messages which can be changed. The list is always ordered by level and date. Note that “Restart” level is the highest level and will appear first in any list.',
                                        				array('--hash','Hash string that represent the notifications. This hash is generated by the getNotifications API and shows in the response structure. Use this parameter to tell what version of notifications you use, and only if notifications are changed they will be sent.')
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
                                                ),
                                        		'group' => 'notification',
                                        		'info' => array (
                                        				'Delete notification by type.',
                                        				array('--type','One of types:
serverOffline, restartRequired, daemonOffline, phpExtDirectiveMismatch, phpExtNotLoaded, phpExtNotInstalled, zendExtDirectiveMismatch, zendExtNotLoaded, zendExtNotInstalled, deploymentFailure, deploymentUpdateFailure, deploymentRedeployFailure, deploymentHealthcheckFailure, deploymentRemoveFailure, deploymentRollbackFailure, deploymentDefineAppFailure, serverAddError, serverRemoveError, serverEnableError, serverDisableError, serverForceRemoveError, jobqueueHighConcurrency, serverRestarting, sessionClusteringWrongHandler, invalidLicense, licenseAboutToExpire, webserverNotResponding, maxServersInCluster, licenseAboutToExpire45, licenseAboutToExpire15, databaseConnectionRestored, sessionClusteringStdbyMode, zendServerDaemonOffline, sessionClusteringErrorMode.')
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
                                                ),
                                        		'group' => 'notification',
                                        		'info' => array (
                                        				'Update notification properties.',
                                        				array('--type','One of types:
serverOffline, restartRequired, daemonOffline, phpExtDirectiveMismatch, phpExtNotLoaded, phpExtNotInstalled, zendExtDirectiveMismatch, zendExtNotLoaded, zendExtNotInstalled, deploymentFailure, deploymentUpdateFailure, deploymentRedeployFailure, deploymentHealthcheckFailure, deploymentRemoveFailure, deploymentRollbackFailure, deploymentDefineAppFailure, serverAddError, serverRemoveError, serverEnableError, serverDisableError, serverForceRemoveError, jobqueueHighConcurrency, serverRestarting, sessionClusteringWrongHandler, invalidLicense, licenseAboutToExpire, webserverNotResponding, maxServersInCluster, licenseAboutToExpire45, licenseAboutToExpire15, databaseConnectionRestored, sessionClusteringStdbyMode, zendServerDaemonOffline, sessionClusteringErrorMode.'),
                                        				array('--repeat','How long the notification should be hidden from user (in minutes).'),
                                        				
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
                                                ),
                                        		'group' => 'notification',
                                        		'info' => array (
                                        				'Sends notification email message.',
                                        				array('--type','One of types:
serverOffline, restartRequired, daemonOffline, phpExtDirectiveMismatch, phpExtNotLoaded, phpExtNotInstalled, zendExtDirectiveMismatch, zendExtNotLoaded, zendExtNotInstalled, deploymentFailure, deploymentUpdateFailure, deploymentRedeployFailure, deploymentHealthcheckFailure, deploymentRemoveFailure, deploymentRollbackFailure, deploymentDefineAppFailure, serverAddError, serverRemoveError, serverEnableError, serverDisableError, serverForceRemoveError, jobqueueHighConcurrency, serverRestarting, sessionClusteringWrongHandler, invalidLicense, licenseAboutToExpire, webserverNotResponding, maxServersInCluster, licenseAboutToExpire45, licenseAboutToExpire15, databaseConnectionRestored, sessionClusteringStdbyMode, zendServerDaemonOffline, sessionClusteringErrorMode.'),
                                        				array('--ip','The public IP of Zend Server.'),
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
                                                ),
                                        		'arrays' => array(
                                        				'servers',
                                        				'tasks'
												),
                                        		'group' => 'server',
                                        		'info' => array (
                                        				'Check if server has completed all of its assigned tasks. This action is used for polling on Zend Server Daemon activities which start asynchronously. When used in a cluster, the entire cluster may be considered a single entity so that a positive response is returned only when the entire cluster has completed its assigned tasks.
This action only returns a general Boolean response and does not display which tasks remain to be performed, etc.',
                                        				array('--servers','List of server IDs. If specified, status will be returned for these servers only. If not specified, the status of all servers will be returned.'),
                                        				array('--tasks','Check completion of the provided task IDs only, ignore other tasks. If no task IDs are specified, default is all tasks.'),
                                        		)
                                        )
                                ),
                                'getServerInfo' => array (
                                        'options' => array (
                                                'route' => 'getServerInfo --serverId=',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'getServerInfo'
                                                ),
                                        		'group' => 'server',
                                        		'info' => array (
                                        				'Use this method to get information about the system, including the Zend Server edition and version, PHP version, licensing information, etc. This method produces similar output on all Zend Server systems, and is future compatible.',
                                        				array('--serverId','Server identifier to retrieve information for. On a single-server this should always be 0.'),
                                        		)
                                        )
                                ),

                                'clusterGetServersCount' => array (
                                        'options' => array (
                                                'route' => 'clusterGetServersCount',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'clusterGetServersCount'
                                                ),
                                        		'group' => 'server',
                                        		'info' => array (
                                        				'Get the number of servers registered in the cluster. Note that this action ignores the servers’ current state and returns only a total number of known servers. In a single-server the response to this action will always be 0.',
                                        		)
                                        )
                                ),

                                'serverAddToCluster' => array (
                                        'options' => array (
                                                'route' => 'serverAddToCluster --serverName= --dbHost= --dbUsername= --dbPassword= --nodeIp= --dbName= [--failIfConnected=] [--wait-db]',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                		'action'=> 'serverAddToCluster',
                                                		'apiMethod' => 'post'
                                                ),
                                        		'group' => 'server',
                                                'async' => true,
                                        		'info' => array (
                                        				'Join the current server to a cluster. If the cluster database is not set up, the server will attempt to create the database and then perform the join using the provided credentials. If possible, a user “zend” will be created and used to perform the connection.',
                                        				array('--serverName','Server name.'),
                                        				array('--dbHost','Database host address to join the cluster.'),
                                        				array('--dbUsername','Database credentials (username).'),
                                        				array('--dbPassword','Database credentials (password).'),
                                        				array('--nodeIp','Server IP.'),
                                        				array('--dbName','Database name.'),
                                        				array('--failIfConnected','Cause the action to completely fail if the server is already connected. Otherwise, a normal 200 status is returned without performing any action. Default: false.'),
                                        				array('--wait-db','Checks if the DB credentials are correct from the machine where this script is running and waits max 3 minutes. Set this flag only if you are sure that the machine from where this tool is run can connect to the database server.'),
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
                                                ),
                                        		'group' => 'server',
                                        		'info' => array (
                                        				'Replace the current server name with a new one. This change is purely cosmetic - the server’s name does not influence any aspect of its accessibility or functionality.',
                                        				array('--serverName','Server name.'),
                                        				array('--serverId','Server ID.'),
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
                                                ),
                                        		'group' => 'server',
                                        		'info' => array (
                                        				'Remove a server from the cluster. The removal process may be asynchronous if Session Clustering is used – if this is the case, the initial operation will return an HTTP 202 response. As long as the server is not fully removed, further calls to remove the same server should be idempotent. On a Zend Server with no valid license, this operation will fail.',
                                        				array('--serverId','Server ID.'),
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
                                                ),
                                        		'arrays' => array(
                                        				'servers'
                                        		),
                                        		'group' => 'server',
                                        		'info' => array (
                                        				'Restart a Zend Server daemon on all servers or on specified servers in the cluster. A 202 response in this case does not always indicate a successful restart of all servers, and the user is advised to check the server(s) status again after a few seconds using the clusterGetServerStatus command.',
                                        				array('--daemon','One of the following values: jqd, monitor_node, scd, zdd.'),
                                        				array('--servers','A list of server IDs to restart. If not specified, all servers in the cluster will be restarted. In a single Zend Server context this parameter is ignored.'),
                                        		)
                                        )
                                ),
                                'logsReadLines' => array (
                                        'options' => array (
                                                'route' => 'logsReadLines --logName= [--serverId=] [--lineToRead=] [--filter=]',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'logsReadLines'
                                                ),
                                        		'group' => 'server',
                                        		'info' => array (
                                        				'Read a certain number of log lines from the end of the file log. If serverId is passed, then the request will be performed against that cluster member, otherwise it is performed locally.',
                                        				array('--logName','One of the following values:
codetracing, datacache, deployment, dserver, jobqueue, jqd, monitor, monitor_node, monitor_ui, pagecache, php, sc, scd, statistics, utils, zdd, zem, zsd, php.'),
                                        				array('--serverId','If passed, the log contents will be fetched from that cluster member, otherwise performed locally.'),
                                        				array('--lineToRead','How many lines to read. defaults to a certain system-wide configurable setting. Limited by another such setting.'),
                                        				array('--filter','Apply a certain case-insensitive string filter to the log lines.'),
                                        		)
                                        )
                                ),
                                'logsGetLogfile' => array (
                                        'options' => array (
                                                'route' => 'logsGetLogfile --logName= [--serverId=]',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'logsGetLogfile'
                                                ),
                                        		'group' => 'server',
                                        		'info' => array (
                                        				'Retrieve the entire log file from the server or a remove cluster member.',
                                        				array('--logName','One of the following values:
codetracing, datacache, deployment, dserver, jobqueue, jqd, monitor, monitor_node, monitor_ui, pagecache, php, sc, scd, statistics, utils, zdd, zem, zsd, php.'),
                                        				array('--serverId','If passed, the log contents will be fetched from that cluster member, otherwise performed locally.'),
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
                                                ),
                                        		'group' => 'statistics',
                                        		'info' => array (
                                        				'Retrieve a series of data according to a counter type identifier. The series retrieved is an aggregate of statistical information provided by Zend Server’s various components during execution.',
                                        				array('--type','One of:
OPLUS_UTILIZATION
OPLUS_HITS
OPLUS_MISSES
OPLUS_FILES_CONSUMPTION
OPLUS_MEMORY_CONSUMPTION
OPLUS_MEMORY_WASTED
DC_SHM_UTILITZATION
DC_SHM_HITS
DC_SHM_MISSES
DC_DISK_HITS
DC_DISK_MISSES
DC_NUM_OF_NAMESPACES
DC_SHM_NUM_OF_ENTRIES
PC_NUM_OF_RULES
PC_HITS_PER_RUL
PC_MISSES_PER_RULE
PC_AVG_PROC_TIME_NON_CACHED_PAGE
PC_AVG_PROC_TIME_CACHED_PAGE
PC_NON_HANDLED_REQUESTS
JQ_JOBS_PER_STATUS
JQ_JOBS_ENQUEUED
JQ_JOBS_SCHEDULED_ENQUEUED
JQ_JOBS_DEQUEUED
SC_SESSIONS_CREATED
SC_SESSIONS_REUSED
SC_AVG_SESSION_SIZE
SC_MIN_SESSION_SIZE
SC_MAX_SESSION_SIZE
SC_SESSIONS_PER_APP
SC_SESSIONS_DATA_SPACE
MON_NUM_OF_EVENTS
NUM_REQUESTS_PER_SECOND
NUM_PHP_WORKERS
AVG_REQUEST_PROCESSING_TIME
MAX_REQUEST_PROCESSING_TIME
MIN_REQUEST_PROCESSING_TIME
AVG_REQUEST_PROCESSING_TIME_PER_APP
AVG_MEMORY_USAGE
AVG_CPU_USAGE
AVG_REQUEST_OUTPUT_SIZE
AVG_DATABASE_TIME.'),
                                        				array('--appId','Filter statistics by the specified application id.
Filtering by a particular application id still retrieves “global” statistic counters’ data. Default: all applications’ data.'),
                                        				array('--from','Unix timestamp of the start date timestamp.'),
                                        				array('--to','Unix timestamp of the end date.'),
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
                                                ),
                                        		'group' => 'statistics',
                                        		'info' => array (
                                        				'Clear all statistics data.',
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
                                                ),
                                        		'arrays' => array(
                                        				'filters',
                                        				'options'
                                        		),
                                        		'group' => 'studio',
                                        		'info' => array (
                                        				'Start debug mode on the target server.
Note that if this server is a member of a cluster, it will modify its own directive only and will not affect the rest of the cluster. When checking the cluster management UI, a notification may be displayed to show that this particular server deviates from the cluster blueprint of directive values, this is normal.',
                                        				array('--filters','Non empty array with filters.'),
                                        				array('--options','Debugging options.'),
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
                                                ),
                                        		'group' => 'studio',
                                        		'info' => array (
                                        				'Stop debug mode on the target server.
Note that if this server is a member of a cluster, it will modify its own directive only and will not affect the rest of the cluster. When checking the cluster management UI, a notification may be displayed to show that this particular server deviates from the cluster blueprint of directive values, this is normal.
Starting and stopping debug mode requires a restart of the user’s PHP server and happens in an asynchronous process. Polling should be performed in a few steps:
Until the server requires a restart, which signals the directive change operation was successful.
Call restartPhp action.
Poll until the server no longer requires a restart at which point the server is fully operational in debug mode.',
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
                                                ),
                                        		'group' => 'studio',
                                        		'info' => array (
                                        				'Return the current debug mode status on the server.',
                                        		)
                                        )
                                ),
                                // Page cache
                                'pagecacheRulesList' => array (
                                        'options' => array (
                                                'route' => 'pagecacheRulesList [--applicationsId=] [--freeText=]',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'pagecacheRulesList'
                                                ),
                                        		'arrays' => array(
                                        				'applicationsId'
												),
                                        		'group' => 'pagecache',
                                        		'info' => array (
                                        				'Retrieve and display a list of page cache rules.',
                                        				array('--applicationsId','The application Ids the rules may be associated with.'),
                                        				array('--freeText','Free test to search in rule details.'),
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
                                                ),
                                        		'arrays' => array(
                                        				'conditionsType',
                                        				'conditions',
                                        				'splitBy'
                                        		),
                                        		'group' => 'pagecache',
                                        		'info' => array (
                                        				'Creates or updates a page cache rule.',
                                        				array('--ruleId','Required when updating an existing rule.'),
                                        				array('--urlScheme',"'http', 'https' or 'https?' for all."),
                                        				array('--urlHost','The issue event group identifier.'),
                                        				array('--urlPath',' '),
                                        				array('--matchType',"'exactMatch', 'regexMatch' or 'regexlMatch'."),
                                        				array('--lifetime',' '),
                                        				array('--compress','Default TRUE'),
                                        				array('--name','Non empty string.'),
                                        				array('--conditionsType',"'and' or 'or'"),
                                        				array('--conditions',' '),
                                        				array('--splitBy',' '),
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
                                                ),
                                        		'arrays' => array(
                                        				'conditionsType',
                                        				'conditions',
                                        				'splitBy'
                                        		),
                                        		'group' => 'pagecache',
                                        		'info' => array (
                                        				'Creates or updates a page cache rule for a specific application.',
                                        				array('--ruleId','Required when updating an existing rule.'),
                                        				array('--urlPath',' '),
                                        				array('--matchType',"'exactMatch', 'regexMatch' or 'regexlMatch'."),
                                        				array('--lifetime',' '),
                                        				array('--compress','Default TRUE'),
                                        				array('--name','Non empty string.'),
                                        				array('--applicationId',' '),
                                        				array('--conditionsType',"'and' or 'or'"),
                                        				array('--conditions',' '),
                                        				array('--splitBy',' '),
                                        		)
                                        )
                                ),
                        		'pagecacheExportRules' => array (
                        				'options' => array (
                        						'route' => 'pagecacheExportRules [--applicationId=]',
                        						'defaults' => array (
                        								'controller' => 'webapi-api-controller',
                        								'action' => 'pagecacheExportRules'
                        						),
                        						'group' => 'pagecache',
                        						'info' => array (
                        								'Create an XMLdocument that contains all page cache rules for an application. This document conforms to the structure required by the Deployment package to include rules in a zpk.
Note that this action returns an unusual XMLformat and does not conform to the rest of the API in terms of structural conformity. The XSD for validating the document is provided in the appendices at the end of the document.
Also note that this action returns only an XML output - it is not allowed to return a JSON format and an 406 error will be returned for a JSON output request.',
                        								array('--applicationId','The issue event group identifier.'),
                        						)
                        				)
                        		),
                        		'pagecacheImportRules' => array (
                        				'options' => array (
                        						'route' => 'pagecacheImportRules --paceCacheRules=',
                        						'defaults' => array (
                        								'controller' => 'webapi-api-controller',
                        								'action' => 'pagecacheExportRules'
                        						),
                        						'group' => 'pagecache',
                        						'info' => array (
                        								'Receives a list of rules in XML format, and stores them as global page cache rules.',
                        								array('--paceCacheRules','An XML string that describes the rules to be imported. This xml structure is identical to the one returned in pagecacheRules action.'),
                        						)
                        				)
                        		),
                                'pagecacheDeleteRules' => array (
                                        'options' => array (
                                                'route' => 'pagecacheDeleteRules [--rules=]',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'pagecacheListRules'
                                                ),
                                        		'arrays' => array(
                                        			'rules'
                                        		),
                                        		'group' => 'pagecache',
                                        		'info' => array (
                                        				'Delete a list of page cache rules.',
                                        				array('--rules','A list of rule IDs'),
                                        		)
                                        )
                                ),
                                'pagecacheRuleInfo' => array (
                                        'options' => array (
                                                'route' => 'pagecacheRuleInfo --id=',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'pagecacheRuleInfo'
                                                ),
                                        		'group' => 'pagecache',
                                        		'info' => array (
                                        				'Retrieve and display a page cache rule information.',
                                        				array('--id','Rule ID.'),
                                        		)
                                        )
                                ),
                                'pagecacheClearCacheByRuleName' => array (
                                        'options' => array (
                                                'route' => 'pagecacheClearCacheByRuleName --ruleName= --uri=',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'pagecacheClearCacheByRuleName',
                                                        'apiMethod' => 'post'
                                                ),
                                        		'group' => 'pagecache',
                                        		'info' => array (
                                        				'Clear all cached items for a specific rule.',
                                        				array('--ruleName','Rule name.'),
                                        				array('--uri','URI (added in 1.5).'),
                                        		)
                                        )
                                ),
                                'pagecacheClearRulesCache' => array (
                                        'options' => array (
                                                'route' => 'pagecacheClearRulesCache [--rules=]',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'pagecacheClearRulesCache',
                                                        'apiMethod' => 'post'
                                                ),
                                        		'arrays' => array(
                                        			'rules'
                                        		),
                                        		'group' => 'pagecache',
                                        		'info' => array (
                                        				'Clear all cached items for a specific rule ids (multiple).',
                                        				array('--rules','List of rule ids.'),
                                        		)
                                        )
                                )
                        )
                )
        )
);
