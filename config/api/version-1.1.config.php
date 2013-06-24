<?php
return array (
        'console' => array (
                'router' => array (
                        'routes' => array (
                                'codetracingList' => array (
                                        'options' => array (
                                                'route' => 'codetracingList [--applications=] [--freetext=] [--type=] [--limit=] [--offset=] [--orderBy=] [--direction=]',
                                                'defaults' => array (
                                                        'controller' => 'webapi-api-controller',
                                                        'action' => 'codetracingList'
                                                )
                                        )
                                )
                        )
                )
        )
);
