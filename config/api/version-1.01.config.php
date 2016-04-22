<?php
return array (
        'min-zsversion' => '5.5',
        'console' => array (
                'router' => array (
                        'routes' => array (
                                'codetracingList' => array (
                                        'options' => array (
                                                'route' => 'codetracingList [--applications=] [--freetext=] [--type=] [--limit=] [--offset=] [--orderBy=] [--direction=]',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'codetracingList'
                                                ),
                                        		'arrays' => array(
                                        				'applications'
												),
                                        		'group'=> 'codetracing',
                                        		'info' => array(
                                        				'Retrieve a list of code-tracing files available for download using codetracingDownloadTraceFile.',
                                        				array('--applications','List of application IDs. If specified, code-tracing entries will be returned for these applications only. Default: all applications'),
                                        				array('--freetext','If specified, code-tracing entries will be returned based on URL or ID'),
                                        				array('--type','0: Triggered by Code
1: Triggered by Event
2: Manual request
3: Triggered by segmentation fault
Defaults to -1: All types'),
                                        				array('--limit','Row limit to retrieve, defaults to value defined in zend-user-user.ini'),
                                        				array('--offset','The page offset to be displayed, defaults to 0'),
                                        				array('--orderBy','Column to sort the result by (Id, Date, Url, CreatedBy, Filesize), defaults to Date'),
                                        				array('--direction','Sorting direction , defaults to Desc'),
												),
                                        )
                                )
                        )
                )
        )
);
