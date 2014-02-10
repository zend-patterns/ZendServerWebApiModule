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
		$this->assertFalse($response->isError());
		//$traceEnabled = (string)$response->responseData->codeTracingStatus->traceEnabled;
		//$this->assertEquals('0', $traceEnabled);
	}
	
	/**
	 * @test
	 */
	public function codetracingEnable()
	{
		$response = $this->apiManager->codetracingEnable();
		$this->assertFalse($response->isError());
		//$traceEnabled = (string)$response->responseData->codeTracingStatus->traceEnabled;
		//$this->assertEquals('1', $traceEnabled);
	}
	
	/**
	 * @test
	 */
	public function codetracingIsEnabled()
	{
		$response = $this->apiManager->codetracingIsEnabled();
		$this->assertFalse($response->isError());
		$traceEnabled = (string)$response->responseData->codeTracingStatus->traceEnabled;
		$this->assertEquals('1', $traceEnabled);
	}

	/**
	 * @test
	 */
	public function codetracingCreate()
	{
		$tarceUrl = 'http://www.symfony-simple-app.dev/';
		$response = $this->apiManager->codetracingCreate(array(
			'url' => $tarceUrl
		));
		$this->assertFalse($response->isError());
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
		$this->assertFalse($response->isError());
	}
	
	/**
	 * @test
	 */
	public function codetracingList()
	{
		$response = $this->apiManager->codetracingList();
		$this->assertFalse($response->isError());
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
		$this->assertFalse($response->isError());
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
		$this->assertFalse($response->isError());
	}
}