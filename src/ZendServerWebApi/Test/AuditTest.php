<?php
namespace ZendServerWebApi\Test;

use ZendServerWebApi\Test\WebApiTestCase;

class AuditTest extends WebApiTestCase
{
	/**
	 * @test
	 */
	public function auditGetList()
	{
		$response = $this->apiManager->auditGetList();
		$this->isValidApiResponse($response);
		foreach ($response->responseData->auditMessages->auditMessage as $auditMessage)
		{
			$id = (string)$auditMessage->id;
			return $id;
		}
	}
	
	/**
	 * @test
	 * @depends auditGetList
	 */
	public function auditGetDetails($auditId)
	{
		$response = $this->apiManager->auditGetDetails(array(
			'auditId' => $auditId,
		));
		$this->isValidApiResponse($response);
		foreach ($response->responseData->auditMessageDetails->auditMessage as $auditMessage)
		{
			$id = (string)$auditMessage->id;
			if ($id == $auditId){
				$this->assertEquals($id, $auditId);
				return $id;
			}
		}
		$this->assertTrue(false,'AuditId ' . $auditId . ' not found');
	}
	
	/**
	 * @test
	 */
	public function auditSetSettings()
	{
		$response = $this->apiManager->auditSetSettings(array(
			'history' =>  rand(1, 100),
		));
		$this->isValidApiResponse($response);
	}
	
	/**
	 * @test
	 */
	public function auditExport()
	{
		$response = $this->apiManager->auditExport();
		$this->isValidApiResponse($response);
	}
	
	
}