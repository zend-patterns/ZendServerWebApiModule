<?php
return array(
    'min-zsversion' => '8.0',
    'console' => array(
        'router' => array(
            'routes' => array(
                'apmGetUrls' => array(
                    'options' => array(
                        'route' => 'apmGetUrls [--limit=] [--offset=] [--applicationId=] [--filter=] [--period=]',
                        'defaults' => array(
                            'controller' => 'webapi-api-controller',
                            'action' => 'apmGetUrls',
                            'apiMethod' => 'get'
                        ),
                        'group' => 'apm',
                        'info' => array(
                            'Get a list of URL statistics.',
                            array('--limit', 'The number of rows to retrieve. Default lists all rules up to an arbitrary limit set by the system.'),
                            array('--offset', 'A paging offset to begin the list from. Default: 0'),
                            array('--applicationId', 'Display URLs of a specific application. If not supplied, display URLs from all the applications.'),
                            array('--filter', 'Predefined filters/order
1 - “most time consuming” - order by number of samples multiply average time, descending.
2 - “slowest response time” - order by average time, descending.
3 - “most visited” - ordered by number of sample,s descending.
If not supplied, default is 1.'),
                            array('--period', 'Period in hours (one week is 24*7, etc.). Default is 24.'),
                        )
                    )
                ),
                
                'apmGetUrlInfo' => array(
                    'options' => array(
                        'route' => 'apmGetUrlInfo --id= [--order=] [--period=]',
                        'defaults' => array(
                            'controller' => 'webapi-api-controller',
                            'action' => 'apmGetUrlInfo',
                            'apiMethod' => 'get'
                        ),
                        'group' => 'apm',
                        'info' => array(
                            'Get a single request statistics info with its requests. The requests can be filtered and ordered using \'period\' and \'order\' parameter',
                            array('--id', 'The URL ID to retrieve the info from.'),
                            array('--order', 'The order of the requests list. The format is like in \'order\' clause in SQL, e.g. \'from_time desc\' or \'until_time\'.'),
                            array('--period', 'Number of hours. Limits the requests list to a specific period - \'period\' hours back until now. Default is 24 (i.e. by default bring requests from the last 24 hours).'),
                        )
                    )
                ),
                
                'zrayGetAllRequestsInfo' => array(
                    'options' => array(
                        'route' => 'zrayGetAllRequestsInfo [--from_timestamp=] [--limit=] [--offset=]',
                        'defaults' => array(
                            'controller' => 'webapi-api-controller',
                            'action' => 'zrayGetAllRequestsInfo',
                            'apiMethod' => 'get'
                        ),
                        'group' => 'zray',
                        'info' => array(
                            'Get a list of requests starting from a specific timestamp (same as `zrayGetRequestsInfo` but not by pageID). The API receives 3 parameters - `from_timestamp`, `limit` and `offset`. The default limit is 10.',
                            array('--from_timestamp', 'Specify the timestamp to get all the requests that came after (microseconds - 13 digits).'),
                            array('--limit', 'Limit number of requests. Default is 10. Max value is 500.'),
                            array('--offset', 'Get data starting from a specific offset. Default is 0.'),
                        )
                    )
                ),
                
                'zrayGetCustomData' => array(
                    'options' => array(
                        'route' => 'zrayGetCustomData --requestId=',
                        'defaults' => array(
                            'controller' => 'webapi-api-controller',
                            'action' => 'zrayGetCustomData',
                            'apiMethod' => 'get'
                        ),
                        'group' => 'zray',
                        'info' => array(
                            'Get all custom data stored for the current request. Custom data is collected using the ZRayExtension class API and is stored with the official data collected by ZRay’s default operations. Custom data can be formatted in any way the extension is designed to hold. This may mean an unusually large payload.',
                            array('--requestId', 'The request ID of the environment information to retrieve.'),
                        )
                    )
                ),
                
                'urlinsightGetUrls' => array(
                    'options' => array(
                        'route' => 'urlinsightGetUrls [--limit=] [--offset=] [--applicationId=] [--filter=] [--period=]',
                        'defaults' => array(
                            'controller' => 'webapi-api-controller',
                            'action' => 'urlinsightGetUrls',
                            'apiMethod' => 'get'
                        ),
                        'group' => 'urlinsight',
                        'info' => array(
                            'Get the list of url statistics.',
                            array('--limit', 'The number of rows to retrieve. Default lists all rules up to an arbitrary limit set by the system.'),
                            array('--offset', 'A paging offset to begin the rules list from. Default is 0.'),
                            array('--applicationId', 'Display URLs of a specific application. If not supplied, display URLs from all the applications.'),
                            array('--filter', 'Predefined filters/order
1 - "most time consuming" - order by num of samples multiply average time, descending
2 - "slowest response time" - order by average time descending
3 - "most visited" - ordered by number of samples descending

If not supplied, default is 1.'),
                            array('--period', 'Period in hours. (one week is 24*7, etc…). Default is 24.'),
                        )
                    )
                ),
                
                'urlinsightGetUrlInfo' => array(
                    'options' => array(
                        'route' => 'urlinsightGetUrlInfo --id= [--order=] [--period=]',
                        'defaults' => array(
                            'controller' => 'webapi-api-controller',
                            'action' => 'urlinsightGetUrlInfo',
                            'apiMethod' => 'get'
                        ),
                        'group' => 'urlinsight',
                        'info' => array(
                            'Get a single request statistics info with its requests. The requests can be filtered and ordered using `period` and `order` parameter.',
                            array('--id', 'The url id to retrieve the info from.'),
                            array('--order', 'The order of the requests list. The format is like in "order" clause in sql, e.g. "from_time desc" or "until_time".'),
                            array('--period', 'Number of hours. Limit the requests list to a specific period - "period"| hours back until now. Default is 24 (i.e. by default bring requests from the last 24 hours)'),
                        )
                    )
                ),
                
                'urlinsightGetZraySnapshots' => array(
                    'options' => array(
                        'route' => 'urlinsightGetZraySnapshots --resource_id=',
                        'defaults' => array(
                            'controller' => 'webapi-api-controller',
                            'action' => 'urlinsightGetZraySnapshots',
                            'apiMethod' => 'get'
                        ),
                        'group' => 'urlinsight',
                        'info' => array(
                            'Get stored z-ray snapshots for a requested resource ID.',
                            array('--resource_id', 'The url id to retrieve the info from.'),
                        )
                    )
                ),
            )
        )
    )
);