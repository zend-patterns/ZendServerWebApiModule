<?php
namespace ZendServerWebApi\Test;

use ZendServerWebApi\Test\WebApiTestCase;

class CodetracingTest extends WebApiTestCase
{
	/**
	 * @test
	 */
	public function codetracingDisable()
	{
		$response = $this->apiManager->codetracingDisable();
		$this->isValidApiResponse($response);
	}
	
	/**
	 * @test
	 */
	public function codetracingEnable()
	{
		$response = $this->apiManager->codetracingEnable();
		$this->isValidApiResponse($response);
	}
	
	/**
	 * @test
	 */
	public function codetracingIsEnabled()
	{
		$response = $this->apiManager->codetracingIsEnabled();
		$this->isValidApiResponse($response);
		$traceEnabled = (string)$response->responseData->codeTracingStatus->traceEnabled;
		$this->assertEquals('1', $traceEnabled);
	}

	/**
	 * @test
	 */
	public function codetracingCreate()
	{
		$tarceUrl = 'http://localhost/demo';
		$response = $this->apiManager->codetracingCreate(array(
			'url' => $tarceUrl
		));
		$this->isValidApiResponse($response);
		$id = (string)$response->responseData->codeTrace->id;
		return $id;
	}
	
	/**
	 * @test
	 * @depends codetracingCreate
	 * @param traceId $id
	 */
	public function codetracingGetInfo($id)
	{
		$response = $this->apiManager->codetracingGetInfo(array(
			'id' => $id
		));
		$this->isValidApiResponse($response);
	}
	
	/**
	 * @test
	 */
	public function codetracingList()
	{
		$response = $this->apiManager->codetracingList();
		$this->isValidApiResponse($response);
	}
	
	/**
	 * @test
	 * @depends codetracingCreate
	 * @param traceId $id
	 */
	public function codetracingDownloadTraceFile($id)
	{
		$response = $this->apiManager->codetracingDownloadTraceFile(array(
			'traceFile' => $id,
		));
		$this->isValidApiResponse($response);
	}
	
	/**
	 * @test
	 * @depends codetracingCreate
	 * @param traceId $id
	 */
	public function codetracingDelete($id)
	{
		$response = $this->apiManager->codetracingDelete(array(
				'traceFile' => $id
		));
		$this->isValidApiResponse($response);
	}
}