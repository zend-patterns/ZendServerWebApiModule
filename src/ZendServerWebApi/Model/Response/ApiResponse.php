<?php
namespace ZendServerWebApi\Model\Response;
use Zend\Http\Response;

/**
 * API Response skeleton
 *
 * API Response model based on HTTP response.
 * Inner XML data can be accessed as an SimpleXMLelement
 */
class ApiResponse
{

    /**
     * Http response from Zend Server Api
     *
     * @var Response
     */
    protected $httpResponse;

    /**
     * Response XML Data
     *
     * @var \SimpleXMLElement
     */
    protected $xml;

    /**
     * Check if the API Response is an error
     *
     * Can be an HTTP error or a API fonctionnal error.
     *
     * @var boolean
     */
    protected $isError = false;

    /**
     * Error message
     *
     * @var string
     */
    protected $errorMessage = '';

     /**
     * API error code
     * @var string
     */
    protected $apiErrorCode = '';

    /**
     * Build the API response from the given HTTP response
     *
     * @param Response $httpResponse
     */
    public function __construct (Response $httpResponse)
    {
        $this->setHttpResponse($httpResponse);
        // Looking for HTTP error
        $statusCode = $this->httpResponse->getStatusCode();
        if (!($statusCode> 199 && $statusCode<300)) {
            $this->isError = true;
            $this->setErrorMessage($this->httpResponse->getReasonPhrase());
        }

        $contentType  = $httpResponse->getHeaders()->get('content-type')->getFieldValue();
        if(strpos($contentType,'application/vnd.zend.serverapi+xml')===0) {
            // Looking for XML error
            libxml_use_internal_errors(true);
            $xml = simplexml_load_string($httpResponse->getBody());
            if (! $xml) {
                $errorMessage = '';
                foreach (libxml_get_errors() as $error) {
                    $errorMessage .= $error->message . "\n";
                }
                $this->isError = true;
                $this->setErrorMessage($errorMessage);

                return;
            }
            // Lookign for API error
            if ($xml->errorData) {
                $this->isError = true;
                $this->setErrorMessage((string) $xml->errorData->errorMessage);
                $this->setApiErrorCode((string) $xml->errorData->errorCode);
                return;
            }
            $this->setXml($xml);
        }
    }

    /**
     * Api response Factory.
     *
     * If a API response class corresponding to the api method exist
     * will return an instance of this class instead of the generic API
     * response.
     *
     * @param Response $HttpResponse
     */
    public static function factory (Response $httpResponse)
    {
        $responseBody = $httpResponse->getBody();
        $contentType  = $httpResponse->getHeaders()->get('content-type')->getFieldValue();

        if(strpos($contentType,'application/vnd.zend.serverapi+xml')===0) {
            if(preg_match('@<method>([a-zA-Z]*)</method>@', $responseBody,$methodMatch)) {
                $method = $methodMatch[1];
                $className = __NAMESPACE__ . '\\' . ucfirst($method);
                if (class_exists($className)) {
                    return new $className($httpResponse);
                }
            }
        }

        return new ApiResponse($httpResponse);
    }

    /**
     *
     * @return the $httpResponse
     */
    public function getHttpResponse ()
    {
        return $this->httpResponse;
    }

    /**
     *
     * @param Response $httpResponse
     */
    public function setHttpResponse ($httpResponse)
    {
        $this->httpResponse = $httpResponse;
    }

    /**
     *
     * @return string
     */
    protected function setXml (\SimpleXMLElement $xml)
    {
        $this->xml = $xml;
    }

    /**
     * Magical function to acceed easily to response data
     *
     * @param  string $name
     * @return NULL   | \SimpleXMLElement
     */
    public function __get ($name)
    {
        if (isset($this->xml->$name))
            return $this->xml->$name;
        return null;
    }

    /**
     * Check if the response is an HTTP Error or an API Error
     *
     * @return \ZendServerWebApi\Model\Response\unknown
     */
    public function isError ()
    {
        return $this->isError;
    }

    /**
     *
     * @return the $errorMessage
     */
    public function getErrorMessage ()
    {
        return $this->errorMessage;
    }

    /**
     *
     * @param \ZendServerWebApi\Model\Response\unknown $errorMessage
     */
    protected function setErrorMessage ($errorMessage)
    {
        $this->errorMessage = $errorMessage;
    }

    /**
     * @return the $apiErrorCode
     */
    public function getApiErrorCode()
    {
            return $this->apiErrorCode;
    }

    /**
     * @param string $apiErrorCode
     */
    protected function setApiErrorCode($apiErrorCode)
    {
            $this->apiErrorCode = $apiErrorCode;
    }
}
