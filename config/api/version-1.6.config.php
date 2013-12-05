<?php
return array(
        'min-zsversion' => '6.2',
        'console' => array(
                'router' => array(
                        'routes' => array(
                                'deploymentDownloadFile' => array (
                                        'options' => array (
                                                'route' => 'deploymentDownloadFile --url= --name= --version= [--override=]',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'deploymentDownloadFile',
                                                        'apiMethod' => 'post'
                                                ),
                                        		'info' => array(
                                                	'Download a deployment package file from a given URL to allow passing it to the deployment mechanism later.'
                                        		)
                                        )
                                ),
                        		'jobqueueAddJob' => array (
                        				'options' => array (
                        						'route' => 'jobqueueAddJob --url= [--vars=] --options=',
                        						'defaults' => array (
                        								'controller' => 'webapi-api-controller',
                        								'action' => 'jobqueueAddJob',
                        								'apiMethod' => 'post'
                        						),
                        						'arrays' => array(
                        								'url','vars','options'
                        						),
                        						'info' => array(
                        								'Create a new job.'
                        						)
                        				)
                        		),
                        		'librarySetDefault' => array (
                        				'options' => array (
                        						'route' => 'librarySetDefault [--libraryVersionId=]',
                        						'defaults' => array (
                        								'controller' => 'webapi-api-controller',
                        								'action' => 'librarySetDefault',
                        								'apiMethod' => 'post'
                        						)
                        				)
                        		),
                        		//Vhost
                                'vhostGetStatus' => array(
                                        'options' => array(
                                                'route' => 'vhostGetStatus [--vhosts=]',
                                                'defaults' => array(
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'vhostGetStatus'
                                                ),
		                                		'arrays' => array(
		                                				'vhosts'
		                                		),
		                                        'info' => array(
		                                                'Get the list of virtual hosts currently used by the web server and information about each virtual host.'
		                                        )
                                        ),
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
		                        				'info' => array(
		                        						'Remove the list of virtual hosts currently used by the web server and information about each virtual host.'
		                        				)
                        				),
                        		),
                        		'vhostAdd' => array (
                        				'options' => array (
                        						'route' => 'vhostAdd --name= --port= [--template=] [--forceCreate=]',
                        						'defaults' => array (
                        								'controller' => 'webapi-api-controller',
                        								'action' => 'vhostAdd',
                        								'apiMethod' => 'post'
                        						),
		                        				'info' => array(
		                        						'Add a new virtual host.'
		                        				)
                        				),
                        		),
                        		'vhostAddSecure' => array (
                        				'options' => array (
                        						'route' => 'vhostAddSecure --name= --port= --sslCertificatePath= --sslCertificateKeyPath= [--template=] [--sslCertificateChainPath=] [--forceCreate=]',
                        						'defaults' => array (
                        								'controller' => 'webapi-api-controller',
                        								'action' => 'vhostAddSecure',
                        								'apiMethod' => 'post'
                        						),
		                        				'info' => array(
		                        						'This action is similar to vhostAdd, it adds a new vhost which is intended to be secure using SSL.'
		                        				)
                        				),
                        		),
                        		'vhostAddSecureIbmi' => array (
                        				'options' => array (
                        						'route' => 'vhostAddSecureIbmi --name= --port= --sslAppName= [--template=] [--forceCreate=]',
                        						'defaults' => array (
                        								'controller' => 'webapi-api-controller',
                        								'action' => 'vhostAddSecureIbmi',
                        								'apiMethod' => 'post'
                        						),
		                        				'info' => array(
		                        						'Adds a new virtual host which is intended to be secure using SSL. For IBMi systems only'
		                        				)
                        				),
                        		),
                        		'vhostEdit' => array (
                        				'options' => array (
                        						'route' => 'vhostEdit --vhostId= --template= [--sslCertificatePath=] [--forceCreate=] [--sslCertificateKeyPath=] [--sslCertificateChainPath=] [--sslAppName=]',
                        						'defaults' => array (
                        								'controller' => 'webapi-api-controller',
                        								'action' => 'vhostEdit',
                        								'apiMethod' => 'post'
                        						),
		                        				'info' => array(
		                        						'Edit an existing vhost.'
		                        				)
                        				),
                        		),
                        		'vhostGetDetails' => array (
                        				'options' => array (
                        						'route' => 'vhostGetDetails --vhost=',
                        						'defaults' => array (
                        								'controller' => 'webapi-api-controller',
                        								'action' => 'vhostGetDetails',
                        						),
		                        				'info' => array(
		                        						'Get the list of virtual hosts currently used by the web server and full information about each virtual host.'
		                        				)
                        				),
                        		),
                        		'vhostValidateSsl' => array (
                        				'options' => array (
                        						'route' => 'vhostValidateSsl --sslCertificatePath= --sslCertificateKeyPath= [--sslCertificateChainPath=]',
                        						'defaults' => array (
                        								'controller' => 'webapi-api-controller',
                        								'action' => 'vhostValidateSsl',
                        								'apiMethod' => 'post'
                        						),
		                        				'info' => array(
		                        						'Validate the existence of the supplied SSL certificate, key and chain provided during creation or edit of a virtual host.'
		                        				)
                        				),
                        		),
                        		'vhostValidateTemplate' => array (
                        				'options' => array (
                        						'route' => 'vhostValidateTemplate --name= --port= --template= [--sslEnabled=] [--sslCertificatePath=] [--sslCertificateKeyPath=] [--sslChainPath=]',
                        						'defaults' => array (
                        								'controller' => 'webapi-api-controller',
                        								'action' => 'vhostValidateTemplate',
                        								'apiMethod' => 'post'
                        						),
		                        				'info' => array(
		                        						'Validate the structure and syntax of a virtual host template.'
		                        				)
                        				),
                        		),
                        		'vhostRedeploy' => array (
                        				'options' => array (
                        						'route' => 'vhostRedeploy --vhost=',
                        						'defaults' => array (
                        								'controller' => 'webapi-api-controller',
                        								'action' => 'vhostRedeploy',
                        								'apiMethod' => 'post'
                        						),
		                        				'info' => array(
		                        						'Redeploy a virtual host to all servers.'
		                        				)
                        				),
                        		),
                        		'vhostEnableDeployment' => array (
                        				'options' => array (
                        						'route' => 'vhostEnableDeployment --vhost= [--applyImmediately=]',
                        						'defaults' => array (
                        								'controller' => 'webapi-api-controller',
                        								'action' => 'vhostEnableDeployment',
                        								'apiMethod' => 'post'
                        						),
		                        				'info' => array(
		                        						'Enable deployment to a system virtual host..'
		                        				)
                        				),
                        		),
                        		'vhostDisableDeployment' => array (
                        				'options' => array (
                        						'route' => 'vhostDisableDeployment --vhost=',
                        						'defaults' => array (
                        								'controller' => 'webapi-api-controller',
                        								'action' => 'vhostDisableDeployment',
                        								'apiMethod' => 'post'
                        						),
		                        				'info' => array(
		                        						'Disable deployment to system virtual host that was enabled for deployment.'
		                        				)
                        				),
                        		),
                        )
                )
        )
);
