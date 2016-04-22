<?php
return array(
    'min-zsversion' => '7.0',
    'console' => array(
        'router' => array(
            'routes' => array(
                'zrayGetRequestsInfo' => array(
                    'options' => array(
                        'route' => 'zrayGetRequestsInfo --pageId= [--lastId=]',
                        'defaults' => array(
                            'controller' => 'webapi-api-controller',
                            'action' => 'zrayGetRequestsInfo',
                            'apiMethod' => 'get'
                        ),
                        'group' => 'zray',
                        'info' => array(
                            'Get the list of requests according to specific page ID. If lastId is specified, only requests that have a larger ID will be returned.',
                            array('--pageId', 'The page id to retrieve requests from.'),
                            array('--lastId', 'Specify the lastId used to retrieve only new requests.'),
                        )
                    )
                ),
                
                'zrayListAccessTokens' => array(
                    'options' => array(
                        'route' => 'zrayListAccessTokens',
                        'defaults' => array(
                            'controller' => 'webapi-api-controller',
                            'action' => 'zrayListAccessTokens',
                            'apiMethod' => 'get'
                        ),
                        'group' => 'zray',
                        'info' => array(
                            'Display a list of all access tokens in the system.',
                        )
                    )
                ),
                
                'zrayCreateAccessToken' => array(
                    'options' => array(
                        'route' => 'zrayCreateAccessToken --iprange= --ttl= [--baseUrl=]',
                        'defaults' => array(
                            'controller' => 'webapi-api-controller',
                            'action' => 'zrayCreateAccessToken',
                            'apiMethod' => 'post'
                        ),
                        'group' => 'zray',
                        'info' => array(
                            'Generate a random access token for use in the Z-Ray Secured Access mode.',
                            array('--iprange', 'IP Range allowed access to Z-Ray with this token. The iprange can be any IP address or CIDR range.'),
                            array('--ttl', 'Limit this token’s access to expire after the given time in seconds is passed.'),
                            array('--baseUrl', 'Limit access with Z-Ray to a specific base URL. Z-Ray and its activities will only be active on this specific base URL and any sub-paths. If no baseUrl is specified, this token will not be limited to a specific baseUrl.'),
                        )
                    )
                ),
                
                'zrayRemoveAccessToken' => array(
                    'options' => array(
                        'route' => 'zrayRemoveAccessToken --tokenId=',
                        'defaults' => array(
                            'controller' => 'webapi-api-controller',
                            'action' => 'zrayRemoveAccessToken',
                            'apiMethod' => 'post'
                        ),
                        'group' => 'zray',
                        'info' => array(
                            "Remove an access token. Removing a token means that pages loaded with this token will not display Z-Ray. Existing Z-Ray's will still have access to information.",
                            array('--tokenId', 'The identifier for the token to be removed. Note that this is a number representing the token, not the token itself.'),
                        )
                    )
                ),
                
                'zrayGetRequestFunctions' => array(
                    'options' => array(
                        'route' => 'zrayGetRequestFunctions --requestId=',
                        'defaults' => array(
                            'controller' => 'webapi-api-controller',
                            'action' => 'zrayGetRequestFunctions',
                            'apiMethod' => 'get'
                        ),
                        'group' => 'zray',
                        'info' => array(
                            "Get a list of all functions used in the request and their statistics.",
                            array('--requestId', 'The request ID of the function information to retrieve.'),
                        )
                    )
                ),
                
                'zrayGetRequestEnvironment' => array(
                    'options' => array(
                        'route' => 'zrayGetRequestEnvironment --requestId=',
                        'defaults' => array(
                            'controller' => 'webapi-api-controller',
                            'action' => 'zrayGetRequestEnvironment',
                            'apiMethod' => 'get'
                        ),
                        'group' => 'zray',
                        'info' => array(
                            "Get superglobal arrays for a particular request.",
                            array('--requestId', 'The request ID of the function information to retrieve.'),
                        )
                    )
                ),
                
                'zrayGetDebuggerConfigurations' => array(
                    'options' => array(
                        'route' => 'zrayGetDebuggerConfigurations',
                        'defaults' => array(
                            'controller' => 'webapi-api-controller',
                            'action' => 'zrayGetDebuggerConfigurations',
                            'apiMethod' => 'get'
                        ),
                        'group' => 'zray',
                        'info' => array(
                            "Retrieve the Zend Debugger configurations array.",
                        )
                    )
                ),
                
                'zrayGetBacktrace' => array(
                    'options' => array(
                        'route' => 'zrayGetBacktrace --id',
                        'defaults' => array(
                            'controller' => 'webapi-api-controller',
                            'action' => 'zrayGetBacktrace',
                            'apiMethod' => 'get'
                        ),
                        'group' => 'zray',
                        'info' => array(
                            "Get the backtrace for a specific backtrace ID.",
                            array('--id', 'The backtrace ID.'),
                        )
                    )
                ),
                
                
            )
        )
    )
);