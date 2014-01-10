ZendServerWebApi
================

ZF2 module that ease Zend Server API usage

Zend Framework 2 API
--------------------
To use a Zend Server API, call the APIManager form the application service locator :

    $apiManager = $serviceLocator->get('zend_server_api');

And then send the request and retrieve the response like this :

    $apiResponse = $apiManager->[apiMethodName]();
    
Where ApiMethodName is the API method : getNotifications, cacheClear, etc.
If you want know which ZS API services are available for your Zend Server version please  refer to the see Zend Server Web API documentation : [Zend Server API documentation] (http://files.zend.com/help/Zend-Server/zend-server.htm#web_api_reference_guide.htm)
 
$apiResponse will be ApiResponse instance and can be used a SimpleXMLElement to get XML Data.
By exemple the clusterGetServerStatus method will return a response in which you can acces data like that :

    // To know the number a nodes in the cluster
    $nodeCount = $apiResponse->responseData->serverList->count(); 
    // To know the status of the first node
    $serverStatus = $apiResponse->responseData->serverList->serverInfo[0]->status
    
API Request parameters POST or GET can be passed to the ApiManager by using an array :

    $response = $apiManager->auditGetList(array(
            'limit' => 5,
            'order' => 'creation_time',
            'direction' => 'DESC'
        ));

Setting
-------

To acces Zend Server web api, you have to use an Web API key available on the server.
You can set a default API key for your application in any configuration file at module, or application level under the 'zsapi' key:

 	'zsapi' => array (
		// Target - the Zend Server you want to reach through API
		'target' => new ArrayObject(array (
			'zsurl' => 'http://localhost:10081',
            		'zskey' => 'admin',
            		'zssecret' => '123abc...',
            		'zsversion' => '6.x',
		)),


You can pass the API key and target server at runtime as well. For that, use the APIManager :

	$apiKey = new ZendServerWebApi\Model\Apikey('admin', '123abc...');
	$targetServer = new ZendServerWebApi\Model\ZendServer(array(
		'zsurl' => 'http://localhost:10081',
		'zsversion' => '6.x',
	));
	$apiManager->setApiKey($apiKey);
	$apiManager->setTargetServer($targetServer);

You can also pass the whole web API context in one configuration array :

	$apiManager->setApiContext(array(
		'zsurl' => 'http://localhost:10081',
         	'zskey' => 'admin',
         	'zssecret' => '123abc...',
         	'zsversion' => '6.x',
	));


