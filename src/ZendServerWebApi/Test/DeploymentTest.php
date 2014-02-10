<?php
namespace ZendServerWebApi\Test;

class DeploymentTest extends WebApiTestCase
{
	/**
	 * @test
	 */
	public function applicationDefine()
	{
		$response = $this->apiManager->applicationDefine(array(
				'name' => 'test defined app',
				'baseUrl' => 'http://<default-server>/test-app',
				'logo' => $this->getRootDir() . '/data/logo-zend.jpg',
	
		));
		$this->assertFalse($response->isError());
		$appName = (string)$response->responseData->applicationInfo->appName;
		$this->assertEquals('test defined app', $appName);
		$id = (string)$response->responseData->applicationInfo->id;
		return $id;
	}
	
	/**
	 * @test
	 */
	public function applicationGetStatus()
	{
		$response = $this->apiManager->applicationGetStatus();
		//var_dump($response->getHttpResponse()->getBody());
		//die();
		$this->assertFalse($response->isError());
		$id = (string)$response->responseData->applicationsList->applicationInfo->id;
		return $id;
		
	}
	
	/**
	 * @test
	 * @depends applicationGetStatus
	 */
	public function applicationGetDetails($id)
	{
		$response = $this->apiManager->applicationGetDetails(array(
			'application' => $id,
		));
		$resultId = (string)$response->responseData->applicationsList->applicationInfo->id;
		$this->assertFalse($response->isError());
	}
	
	/**
	 * @test
	 */
	public function redeployAllApplications()
	{
		$this->marktestIncomplete('Not developped yet');
	}
	
	/**
	 * @test
	 */
	public function applicationDeploy()
	{
		$response = $this->apiManager->applicationDeploy(array(
			'appPackage' => $this->getRootDir() . '/data/dummyapp-1.0.0.zpk',
			'baseUrl' => 'http://<default-server>/dummyapp',
			'userAppName' => 'dummyApp',
		));
		$this->assertFalse($response->isError());
	}
	
	/**
	 * @test
	 */
	public function applicationUpdate()
	{
		$this->marktestIncomplete('Not developped yet');
	}
	
	/**
	 * @test
	 */
	public function applicationRemove()
	{
		$this->marktestIncomplete('Not developped yet');
	}
	
	/**
	 * @test
	 */
	public function applicationSynchronize()
	{
		$this->marktestIncomplete('Not developped yet');
	}
	
	/**
	 * @test
	 */
	public function applicationRollback()
	{
		$this->marktestIncomplete('Not developped yet');
	}
	
	/**
	 * @test
	 */
	public function deploymentDownloadFile()
	{
		$this->marktestIncomplete('Not developped yet');
	}
	
}