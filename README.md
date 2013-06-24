ZendServerWebApi
================

ZF2 module that ease Zend Server API usage

Zend Framework 2 API
--------------------
To use a Zend Server API, call the APIManager form the service locator :

    $apiManager = $serviceLocator->get('zend_server_api');
And then send the request and retrieve the response like this :

    $apiResponse = $apiManager->apiMethodName();
    
Where ApiMethodName is the API method : getNotifications, cacheClear, etc.... see Zend Server Web API documentation.
$apiResponse will be ApiResponse instance and can be used a SimpleXMLElement to get XML Data.
By exemple the clusterGetServerStatus method will return a response in which you can acces data like that :

    $nodeCount = $apiResponse->responseData->serverList->count(); //To know the number a nodes in the cluster
    $serverStatus = $apiResponse->responseData->serverList->serverInfo[0]->status // To know the status of the first node
    
API Request parameters POST or GET can be passed to the ApiManger by using an array :

    $response = $apiManager->auditGetList(array(
            'limit' => 5,
            'order' => 'creation_time',
            'direction' => 'DESC'
        ));

CLI mode
--------
Zend Server Web API can be called in CLI mode by using :
    php index.php zsapi <method name> --parameterName paramValue
    
/!\ Array parameters like "filter" are not supported in CLI mode.

Setting
-------
You can set a default configuration of your environment in the zendserverwebapi.conf.php file :

       //Configuratin of the HTTP client that will connect to the Zend Server
		'zend_server_client' => array (
				'adapter' => 'Zend\Http\Client\Adapter\Curl'.
		),
		// Zend Server API : The Zend Server you want to reach through API
		'target_zend_server' => array (
				'version' => '6.0.1',
				'url' => 'http://localhost:10081' 
		),
		//The API key used within the request.
		'default_api_key' => array (
				'name' => 'zf',
				'key' => 'a1c5b69aa706450c6715fd817b5c7cd643144b...' 
		),




