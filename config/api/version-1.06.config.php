<?php
return array (
        'min-zsversion' => '6.2',
        'console' => array (
                'router' => array (
                        'routes' => array (
                                'vhostGetStatus' => array (
                                        'options' => array (
                                                'route' => 'vhostGetStatus [--vhosts=] [--limit=] [--offset=] [--order=] [--direction=] [--filters=]',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'vhostGetStatus'
                                                ),
                                                'arrays' => array(
                                                        'vhosts',
                                                        'filters'
                                                ),
                                        		'group' => 'virtualhost',
                                        		'info' => array(
                                        			'Get the list of virtual hosts currently used by the web server and information about each virtual host.',
                                        			array('--vhosts', 'Comma separated list of virtual host IDs.'),
                                        			array('--limit','The number of rows to retrieve. Default lists all vhost entries up to an arbitrary limit set by the system'),
                                        			array('--offset','A paging offset to begin the list from. Default: 0'),
                                        			array('--order','Column identifier for sorting the result set (name, last_updated, port, owner). Default: name'),
                                        			array('--direction','Sorting direction: ASC or DESC. Default: DESC'),
                                        			array('--filters',"Add filter parameters in an ad-hoc manner. These filters will be added to the predefined filter that was passed.
This parameter is an array with a predefined set of parameters that accept arrays to hold multiple values:
ssl: array, a list of ssl support (ssl_enabled, ssl_disabled)
type: array, a list of vhost type (system_defined, zs_defined)
deployment: array, a list of deployment status (deployment_enabled, deployment_disabled)
freeText: string
                                        			    "),
												)
                                        )
                                ),
                        		'vhostRemove' => array (
                        				'options' => array (
                        						'route' => 'vhostRemove --vhosts=',
                        						'defaults' => array (
                        								'controller' => 'webapi-api-controller',
                        								'action' => 'vhostRemove',
                        								'apiMethod' => 'post'
                        						),
                        						'arrays' => array(
                        								'vhosts'
                        						),
                        						'group' => 'virtualhost',
                        						'info' => array(
                        								'Remove the list of virtual hosts currently used by the web server and information about each virtual host.',
                        								array('--vhosts', 'Comma separated list of virtual host IDs.'),
                        								
                        						)
                        				)
                        		),
                        		
                        		'vhostAdd' => array (
                        				'options' => array (
                        						'route' => 'vhostAdd --name= --port= [--template=] [--forceCreation=]',
                        						'defaults' => array (
                        								'controller' => 'webapi-api-controller',
                        								'action' => 'vhostAdd',
                        								'apiMethod' => 'post'
                        						),
                        						'group' => 'virtualhost',
                        						'info' => array(
                        								'Add a new virtual host. Receives name, port and template and returns a single virtual hostelement with the same information.',
                        								array('--name', 'Name of virtual host.'),
                        								array('--port', 'Port of virtual host.'),
                        								array('--template', 'Template of the virtual host settings according to the web server configuration options. Or an absolute path to a local template vhost file.'),
                        								array('--forceCreation', 'Force the creation of a virtual host, even if it fails syntax validation. Default: FALSE'),
                        								//array('Example:','configurationExport --directivesBlacklist="zend_optimizerplus.blacklist_filename,pgsql.auto_reset_persistent"'),
                        						)
                        				)
                        		),              		
                        		'vhostAddSecure' => array (
                        				'options' => array (
                        						'route' => 'vhostAddSecure --name= --port= --sslCertificatePath= --sslCertificateKeyPath= [--sslCertificateChainPath=]  [--template=] [--forceCreation=]',
                        						'defaults' => array (
                        								'controller' => 'webapi-api-controller',
                        								'action' => 'vhostAddSecure',
                        								'apiMethod' => 'post'
                        						),
                        						'group' => 'virtualhost',
                        						'info' => array(
                        								'This action is similar to vhostAdd, it adds a new vhost which is intended to be secure using SSL. Receives name, port, template and certificate paths and returns a single virtual host element with the same information.',
                        								array('--name', 'Name of virtual host.'),
                        								array('--port', 'Port of virtual host.'),
                        								array('--sslCertificatePath', 'File path to locate the SSL certificate file.'),
                        								array('--sslCertificateKeyPath', 'File path to locate the SSL public key file.'),
                        								array('--sslCertificateChainPath', 'Full file path to the SSL chain file.'),
                        								array('--template', 'Template of the virtual host settings according to the web server configuration options. Or an absolute path to a local template vhost file. Or an absolute path to a local template vhost file.'),
                        								array('--forceCreation', 'Force the creation of a virtual host, even if it fails syntax validation. Default: FALSE'),
                        								//array('Example:','configurationExport --directivesBlacklist="zend_optimizerplus.blacklist_filename,pgsql.auto_reset_persistent"'),
                        						)
                        				)
                        		),
                        		'vhostAddSecureIbmi' => array (
                        				'options' => array (
                        						'route' => 'vhostAddSecureIbmi --name= --port= --sslAppName=  [--template=] [--forceCreation=]',
                        						'defaults' => array (
                        								'controller' => 'webapi-api-controller',
                        								'action' => 'vhostAddSecureIbmi',
                        								'apiMethod' => 'post'
                        						),
                        						'group' => 'virtualhost',
                        						'info' => array(
                        								'Adds a new virtual host which is intended to be secure using SSL. Receives name, port, template and certificate application name and returns a single virtual host element with the same information.',
                        								array('--name', 'Name of virtual host.'),
                        								array('--port', 'Port of virtual host.'),
                        								array('--sslAppName', 'Application name for SSL.'),
                        								array('--template', 'Template of the virtual host settings according to the web server configuration options. Or an absolute path to a local template vhost file.'),
                        								array('--forceCreation', 'Force the creation of a virtual host, even if it fails syntax validation. Default: FALSE'),
                        								//array('Example:','configurationExport --directivesBlacklist="zend_optimizerplus.blacklist_filename,pgsql.auto_reset_persistent"'),
                        						)
                        				)
                        		),
                        		'vhostEdit' => array (
                        				'options' => array (
                        						'route' => 'vhostEdit --vhostId= --template= [--forceCreate=] [--sslEnabled=] [--sslCertificatePath=] [--sslCertificateKeyPath=] '.
                        								   '[--sslCertificateChainPath=] [--sslAppName]',
                        						'defaults' => array (
                        								'controller' => 'webapi-api-controller',
                        								'action' => 'vhostEdit',
                        								'apiMethod' => 'post',
                        								'sslEnabled' => 'false'
                        						),
                        						'group' => 'virtualhost',
                        						'info' => array(
                        								'Get the list of virtual hosts currently used by the web server and information about each virtual host.',
                        								array('--vhostId', 'virtual host ID.'),
                        								array('--template', 'New vhost template of virtual host settings. Or an absolute path to a local template vhost file.'),
                        								array('--forceCreate', 'Force edit of the virtual host template even if any errors are detected.'),
                        						       		array('--sslEnabled', 'Indicates if the provided template to be used is SSL template. Default value is FALSE.'),
                        								array('--sslCertificatePath', 'File path to locate the SSL certificate file'),
                        								array('--sslCertificateKeyPath', 'File path to locate the SSL key file.'),
                        								array('--sslCertificateChainPath', 'File path to locate the SSL chain file.'),
                        								array('--sslAppName', 'Application name for SSL (IBMI only).'),
                        								//array('Example:','configurationExport --directivesBlacklist="zend_optimizerplus.blacklist_filename,pgsql.auto_reset_persistent"'),
                        						)
                        				)
                        		),
                        		'vhostGetDetails' => array (
                        				'options' => array (
                        						'route' => 'vhostGetDetails --vhost=',
                        						'defaults' => array (
                        								'controller' => 'webapi-api-controller',
                        								'action' => 'vhostGetDetails',
                        						),
                        						'group' => 'virtualhost',
                        						'info' => array(
                        								'Get the list of virtual hosts currently used by the web server and full information about each virtual host.',
                        								array('--vhost', 'The ID of a single virtual host.'),
                        								//array('Example:','configurationExport --directivesBlacklist="zend_optimizerplus.blacklist_filename,pgsql.auto_reset_persistent"'),
                        						)
                        		
                        				)
                        		),
                        		'vhostValidateSsl' => array (
                        				'options' => array (
                        						'route' => 'vhostValidateSsl --sslCertificatePath= --sslCertificateKeyPath [--sslChainPath=]',
                        						'defaults' => array (
                        								'controller' => 'webapi-api-controller',
                        								'action' => 'vhostValidateSsl'
                        						),
                        						'group' => 'virtualhost',
                        						'info' => array(
                        								'Validate the existence of the supplied SSL certificate, key and chain provided during creation or edit of a virtual host.',
                        								array('--sslCertificatePath', 'Full filepath to the ssl certificate file.'),
                        								array('--sslCertificateKeyPath', 'Full filepath to the ssl key file.'),
                        								array('--sslChainPath', 'Full filepath to the chain file.'),	
                        								//array('Example:','configurationExport --directivesBlacklist="zend_optimizerplus.blacklist_filename,pgsql.auto_reset_persistent"'),
                        						)
                        		
                        				)
                        		),
                        		'vhostValidateTemplate' => array (
                        				'options' => array (
                        						'route' => 'vhostValidateTemplate --name= --port= --template= [--sslEnabled=] [--sslCertificatePath=] --sslCertificateKeyPath [--sslChainPath=]',
                        						'defaults' => array (
                        								'controller' => 'webapi-api-controller',
                        								'action' => 'vhostValidateTemplate',
                        								'apiMethod' => 'post'
                        						),
                        						'group' => 'virtualhost',
                        						'info' => array(
                        								'Validate the existence of the supplied SSL certificate, key and chain provided during creation or edit of a virtual host.',
                        								array('--name', 'Name of virtual host.'),
                        								array('--port', 'Port of virtual host.'),
                        								array('--template', 'Template text to be validated. Or an absolute path to a local template vhost file.'),
                        								array('--sslEnabled', 'Indicates if the provided template to be used is SSL template.'),
                        								array('--sslCertificatePath', 'File path to locate the SSL certificate file.'),
                        								array('--sslCertificateKeyPath', 'File path to locate the SSL public key file.'),
                        								array('--sslCertificateChainPath', 'Full file path to the SSL chain file.'),
                        								//array('Example:','configurationExport --directivesBlacklist="zend_optimizerplus.blacklist_filename,pgsql.auto_reset_persistent"'),
                        						)
                        		
                        				)
                        		),
                        		'vhostRedeploy' => array (
                        				'options' => array (
                        						'route' => 'vhostRedeploy --vhost=',
                        						'defaults' => array (
                        								'controller' => 'webapi-api-controller',
                        								'action' => 'vhostRedeploy',
                        								'apiMethod' => 'post'
                        						),
                        						'group' => 'virtualhost',
                        						'info' => array(
                        								'Get the list of virtual hosts currently used by the web server and full information about each virtual host.',
                        								array('--vhost', 'The ID of a single virtual host.'),
                        								//array('Example:','configurationExport --directivesBlacklist="zend_optimizerplus.blacklist_filename,pgsql.auto_reset_persistent"'),
                        						)
                        		
                        				)
                        		),
                        		'vhostEnableDeployment' => array (
                        				'options' => array (
                        						'route' => 'vhostEnableDeployment --vhost= [--applyImmediately=]',
                        						'defaults' => array (
                        								'controller' => 'webapi-api-controller',
                        								'action' => 'vhostEnableDeployment',
                        								'apiMethod' => 'post'
                        						),
                        						'group' => 'virtualhost',
                        						'info' => array(
                        								'Enable deployment to a system virtual host. This action requires user intervention.
Enabling deployment is performed in two stages:
A file is created to contain the overriding virtual host configuration.
A blueprint entry is created to control and monitor the virtual host (performed if applyImmediately is TRUE)
After these two steps, the user is expected to link this new configuration file to the server’s virtual host section of the configuration file. This step is required because Zend Server generally does not have the write permissions needed to perform the action.
The split to two workflow modes allows the user to create a minimal setup, complete the file system part of the workflow and only then enforce blueprint control. Changes will come into effect only after a full restart anyway.',
                        								array('--vhost', 'The ID of a single virtual host.'),
                        								array('--applyImmediately', 'False: will only create an overriding configuration file.
True: will create an overriding configuration.'),
                        								//array('Example:','configurationExport --directivesBlacklist="zend_optimizerplus.blacklist_filename,pgsql.auto_reset_persistent"'),
                        						)
                        		
                        				)
                        		),
                        		'vhostDisableDeployment' => array (
                        				'options' => array (
                        						'route' => 'vhostDisableDeployment --vhost=',
                        						'defaults' => array (
                        								'controller' => 'webapi-api-controller',
                        								'action' => 'vhostDisableDeployment',
                        								'apiMethod' => 'post'
                        						),
                        						'group' => 'virtualhost',
                        						'info' => array(
                        								'Disable deployment to system virtual host that was enabled for deployment.',
                        								array('--vhost', 'The ID of a single virtual host.'),
                        								//array('Example:','configurationExport --directivesBlacklist="zend_optimizerplus.blacklist_filename,pgsql.auto_reset_persistent"'),
                        						)
                        		
                        				)
                        		),
                            
                                'librarySetDefault' => array (
                                    'options' => array (
                                        'route' => 'librarySetDefault --libraryVersionId=',
                                        'defaults' => array (
                                            'controller' => 'webapi-api-controller',
                                            'action' => 'librarySetDefault',
                                            'apiMethod' => 'post'
                                        ),
                                        'group' => 'library',
                                        'info' => array(
                                            'Change library version to be the default version for the library.',
                                            array('--libraryVersionId', 'A library version ID.'),
                                        )
                                
                                    )
                                ),
                     	)       
                )
        )
);
