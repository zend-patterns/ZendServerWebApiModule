<?php
namespace ZendServerWebApi\Model\Http\Adapter;

use Zend\Http\Client\Adapter\Socket as ZendSocket;
use Zend\Http\Client\Adapter\Exception as AdapterException;
use Zend\Stdlib\ErrorHandler;

/**
 * A sockets based (stream\socket\client) adapter class for Zend\Http\Client. Can be used
 * on almost every PHP environment, and does not require any special extensions.
 */
class Socket extends ZendSocket implements DirectWriteInterface
{
    /**
     * Writes directly data to the remote server
     * @param string|resource $data
     * @return int length of the sent bytes
     */
    public function directWrite($data)
    {
        if(is_resource($data)) {
            if (($length = stream_copy_to_stream($data, $this->socket)) == 0) {
                throw new AdapterException\RuntimeException('Error writing request to server');
            }

            return $length;
        }

        // Send the request
        ErrorHandler::start();
        $length  = fwrite($this->socket, $data);
        $error = ErrorHandler::stop();
        if (false === $length) {
           throw new AdapterException\RuntimeException('Error writing request to server', 0, $error);
        }

        return $length;
    }
}
