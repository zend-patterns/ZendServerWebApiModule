<?php
namespace ZendServerWebApi\Model\Http;

use Zend\Http\Client as ZendClient;
use Zend\Http\Request;
use Zend\Http\Response;
use Zend\Uri\Http;
use Zend\Http\Client\Exception;

/**
 * Http client that supports upload or download of big files
 */
class Client extends ZendClient
{
    /**
     * HTTP Content Boundary
     * @var string
     */
    protected $boundary;

    /**
     * Send HTTP request
     *
     * @param  Request $request
     * @return Response
     * @throws Exception\RuntimeException
     * @throws Client\Exception\RuntimeException
     */
    public function send(Request $request = null)
    {
        if ($request !== null) {
            $this->setRequest($request);
        }

        if(!count($this->getRequest()->getFiles())) {
            return parent::send($request);
        }

        $this->redirectCounter = 0;
        $response = null;

        // Make sure the adapter is loaded
        if ($this->adapter == null) {
            $this->setAdapter($this->config['adapter']);
        }

        if(!($this->adapter instanceof Adapter\DirectWriteInterface)) {
             throw new ZendClient\Exception\RuntimeException('Adapter must implement DirectWriteInterface');
        }

        // Send the first request. If redirected, continue.
        do {
            // uri
            $uri = $this->getUri();

            // query
            $query = $this->getRequest()->getQuery();

            if (!empty($query)) {
                $queryArray = $query->toArray();

                if (!empty($queryArray)) {
                    $newUri = $uri->toString();
                    $queryString = http_build_query($query, null, $this->getArgSeparator());

                    if ($this->config['rfc3986strict']) {
                        $queryString = str_replace('+', '%20', $queryString);
                    }

                    if (strpos($newUri, '?') !== false) {
                        $newUri .= $this->getArgSeparator() . $queryString;
                    } else {
                        $newUri .= '?' . $queryString;
                    }

                    $uri = new Http($newUri);
                }
            }
            // If we have no ports, set the defaults
            if (!$uri->getPort()) {
                $uri->setPort($uri->getScheme() == 'https' ? 443 : 80);
            }

            // method
            $method = $this->getRequest()->getMethod();

            // headers
            $headers = $this->prepareHeaders(null, $uri);

            $secure = $uri->getScheme() == 'https';

            if(isset($this->config['debug']) && $this->config['debug']) {
                $debugCookies = "debug_host=127.0.0.1&debug_port=10137&start_debug=1&send_debug_header=1&send_sess_end=1&debug_jit=1&debug_stop=1&use_remote=0&debug_session_id=1212593";
                $cookies = array();
                parse_str($debugCookies, $cookies);
                foreach($cookies as $name=>$value) {
                    $this->addCookie($name, $value);
                }
            }

            // cookies
            $cookie = $this->prepareCookies($uri->getHost(), $uri->getPath(), $secure);
            if ($cookie->getFieldValue()) {
                $headers['Cookie'] = $cookie->getFieldValue();
            }

            $body = $this->prepareBody();
            if($this->boundary) {
                $headers['Content-Type'] .= "; boundary=".$this->boundary;
            }

            // calling protected method to allow extending classes
            // to wrap the interaction with the adapter
            $response = $this->doRequest($uri, $method, $secure, $headers, $body);

            if (! $response) {
                throw new Exception\RuntimeException('Unable to read response, or response is empty');
            }

            if ($this->config['storeresponse']) {
                $this->lastRawResponse = $response;
            } else {
                $this->lastRawResponse = null;
            }

            if ($this->config['outputstream']) {
                $stream = $this->getStream();
                if (!is_resource($stream) && is_string($stream)) {
                    $stream = fopen($stream, 'r');
                }
                $streamMetaData = stream_get_meta_data($stream);
                if ($streamMetaData['seekable']) {
                    rewind($stream);
                }
                // cleanup the adapter
                $this->adapter->setOutputStream(null);
                $response = Response\Stream::fromStream($response, $stream);
                $response->setStreamName($this->streamName);
                if (!is_string($this->config['outputstream'])) {
                    // we used temp name, will need to clean up
                    $response->setCleanup(true);
                }
            } else {
                $response = Response::fromString($response);
            }

            // Get the cookies from response (if any)
            $setCookies = $response->getCookie();
            if (!empty($setCookies)) {
                $this->addCookie($setCookies);
            }

            // If we got redirected, look for the Location header
            if ($response->isRedirect() && ($response->getHeaders()->has('Location'))) {

                // Avoid problems with buggy servers that add whitespace at the
                // end of some headers
                $location = trim($response->getHeaders()->get('Location')->getFieldValue());

                // Check whether we send the exact same request again, or drop the parameters
                // and send a GET request
                if ($response->getStatusCode() == 303 ||
                   ((! $this->config['strictredirects']) && ($response->getStatusCode() == 302 ||
                       $response->getStatusCode() == 301))) {

                    $this->resetParameters(false, false);
                    $this->setMethod(Request::METHOD_GET);
                }


                // If we got a well formed absolute URI
                if (($scheme = substr($location, 0, 6)) &&
                        ($scheme == 'http:/' || $scheme == 'https:')) {
                    // setURI() clears parameters if host changed, see #4215
                    $this->setUri($location);
                } else {

                    // Split into path and query and set the query
                    if (strpos($location, '?') !== false) {
                        list($location, $query) = explode('?', $location, 2);
                    } else {
                        $query = '';
                    }
                    $this->getUri()->setQuery($query);

                    // Else, if we got just an absolute path, set it
                    if (strpos($location, '/') === 0) {
                        $this->getUri()->setPath($location);
                        // Else, assume we have a relative path
                    } else {
                        // Get the current path directory, removing any trailing slashes
                        $path = $this->getUri()->getPath();
                        $path = rtrim(substr($path, 0, strrpos($path, '/')), "/");
                        $this->getUri()->setPath($path . '/' . $location);
                    }
                }
                ++$this->redirectCounter;

            } else {
                // If we didn't get any location, stop redirecting
                break;
            }

        } while ($this->redirectCounter <= $this->config['maxredirects']);

        $this->response = $response;
        return $response;
    }

    /**
     * Prepare the request body (for PATCH, POST and PUT requests)
     *
     * @return string
     * @throws \Zend\Http\Client\Exception\RuntimeException
     */
    protected function prepareBody()
    {
        if(!count($this->getRequest()->getFiles())) {
            return parent::prepareBody();
        }

        // According to RFC2616, a TRACE request should not have a body.
        if ($this->getRequest()->isTrace()) {
            return '';
        }

        $rawBody = $this->getRequest()->getContent();
        if (!empty($rawBody)) {
            return $rawBody;
        }

        $body = '';
        $totalFiles = count($this->getRequest()->getFiles()->toArray());

        if (!$this->getRequest()->getHeaders()->has('Content-Type')) {
            // If we have files to upload, force encType to multipart/form-data
            if ($totalFiles > 0) {
                $this->setEncType(self::ENC_FORMDATA);
            }
        } else {
            $this->setEncType($this->getHeader('Content-Type'));
        }
        
        // If we have POST parameters encode and add them to the body
        // Do not add the files at that moment
        if (count($this->getRequest()->getPost()->toArray()) > 0 || $totalFiles > 0) {
            if (stripos($this->getEncType(), self::ENC_FORMDATA) === 0) {
                $boundary = '---ZENDHTTPCLIENT-' . md5(microtime());
                $this->boundary = $boundary;
                $this->setEncType(self::ENC_FORMDATA, $boundary);

                // Get POST parameters and encode them
                $params = self::flattenParametersArray($this->getRequest()->getPost()->toArray());
                foreach ($params as $pp) {
                    $body .= $this->encodeFormData($boundary, $pp[0], $pp[1]);
                }

                // Notice: The files will be added later
            } elseif (stripos($this->getEncType(), self::ENC_URLENCODED) === 0) {
                // Encode body as application/x-www-form-urlencoded
                $body = http_build_query($this->getRequest()->getPost()->toArray());
            } else {
                throw new ZendClient\Exception\RuntimeException("Cannot handle content type '{$this->encType}' automatically");
            }
        }

        return $body;
    }

    protected function writeChunk($data)
    {
        $chunk  = dechex(strlen($data))."\r\n";
        $chunk .= $data."\r\n";
        $this->adapter->directWrite($chunk);
    }

    /**
     * Separating this from send method allows subclasses to wrap
     * the interaction with the adapter
     *
     * @param Http $uri
     * @param string $method
     * @param  bool $secure
     * @param array $headers
     * @param string $body
     * @return string the raw response
     * @throws Exception\RuntimeException
     */
    protected function doRequest(Http $uri, $method, $secure = false, $headers = array(), $body = '')
    {
        if(!count($this->getRequest()->getFiles())) {
            return parent::doRequest($uri, $method, $secure, $headers, $body);
        }

        // Open the connection, send the request and read the response
        $this->adapter->connect($uri->getHost(), $uri->getPort(), $secure);

        if ($this->config['outputstream']) {
            if ($this->adapter instanceof ZendClient\Adapter\StreamInterface) {
                $stream = $this->openTempStream();
                $this->adapter->setOutputStream($stream);
            } else {
                throw new Exception\RuntimeException('Adapter does not support streaming');
            }
        }

        // HTTP connection
        $ending = "\r\n--".$this->boundary."--\r\n";
        $headers['Content-Length'] = strlen($body) + $this->filesContentLength() + strlen($ending);
        $this->lastRawRequest = $this->adapter->write($method,$uri, $this->config['httpversion'], $headers, '');
        $this->adapter->directWrite($body);

        // Encode files
        foreach ($this->getRequest()->getFiles()->toArray() as $key=>$file) {
            $this->writeFile($key,  $file['formname']);
        }
        $this->adapter->directWrite($ending);

        return $this->adapter->read();
    }

    protected function getFileHeader($file, $name)
    {
        $header  = "--".$this->boundary."\r\n";
        $header .= 'Content-Disposition: form-data; name="'.$name.'"; filename="'.basename($file)."\"\r\n";
        $header .= "Content-Type: ".$this->detectFileMimeType($file)."\r\n";

        $header .= "\r\n";

        return $header;
    }

    /**
     * Gets the length of the HTTP body for all files
     * @return int
     */
    protected function filesContentLength()
    {
        $length = 0;
        foreach ($this->getRequest()->getFiles()->toArray() as $key=>$file) {
            $header = $this->getFileHeader($key,  $file['formname']);
            $length += strlen($header);
            $data = stat($key);
            $length += $data['size'];
        }

        return $length;
    }

    protected function writeFile($file, $name)
    {
       $fh = fopen($file,'r');
       if (!$fh) {
               throw new ZendClient\Exception\RuntimeException('File not readable or non existent: '.$file);
       }

       $this->adapter->directWrite($this->getFileHeader($file, $name));
       while(!feof($fh)) {
           $buffer = fread($fh, 1024);
           $this->adapter->directWrite($buffer);
       }
       fclose($fh);
    }
}
