<?php
namespace ZendServerWebApi\Model\Http\Adapter;

interface DirectWriteInterface
{
    /**
     * Writes directly data to the remote server
     * @param string|resource $data
     * @return int length of the sent bytes
     */
    public function directWrite($data);
}
