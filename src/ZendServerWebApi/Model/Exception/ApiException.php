<?php

namespace ZendServerWebApi\Model\Exception;

use ZendServerWebApi\Model\Response\ApiResponse;

/**
 * API Exception
 */
class ApiException extends \Exception {
	protected $apiErrorCode;
	
	/**
	 * Constructor
	 *
	 * @param unknown $message        	
	 * @param unknown $code        	
	 * @param unknown $previous        	
	 */
	public function __construct(ApiResponse $response, $previous = null) {
		$this->code = $response->getHttpResponse ()->getstatusCode ();
		$this->apiErrorCode = $response->getApiErrorCode();
		$this->message = '['. $this->apiErrorCode .'] ' . $response->getErrorMessage ();
		//$this->message .= "\r" . $response->getHttpResponse()->getBody();
	}
	/**
	 *
	 * @return the $apiErrorCode
	 */
	public function getApiErrorCode() {
		return $this->apiErrorCode;
	}
	
	/**
	 *
	 * @param field_type $apiErrorCode        	
	 */
	protected function setApiErrorCode($apiErrorCode) {
		$this->apiErrorCode = $apiErrorCode;
	}
}