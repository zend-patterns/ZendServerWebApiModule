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
		$this->assertFalse($response->isError());
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
		$this->assertFalse($response->isError());
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
			'history' => 10,
				
		));
		$this->assertFalse($response->isError());
	}
	
	/**
	 * @test
	 */
	public function auditExport()
	{
		$response = $this->apiManager->auditExport();
		$this->assertFalse($response->isError());
	}
	
	
}