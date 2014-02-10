<?php
namespace ZendServerWebApi\Test;

class LibraryTest extends WebApiTestCase
{
	/**
	 * @test
	 */
	public function libraryGetStatus()
	{
		$response = $this->apiManager->libraryGetStatus();
		//var_dump($response->getHttpResponse()->getBody());
		//die();
		$this->assertFalse($response->isError());
		$versionId = (string) $response->responseData->libraryList->libraryInfo->libraryVersions->libraryVersion->libraryVersionId;
		$libraryId = (string) $response->responseData->libraryList->libraryInfo->libraryId;
		return array('versionId' => $versionId, 'id' => $libraryId);
	}
	
	/**
	 * @test
	 * @depends libraryGetStatus
	 */
	public function libraryVersionCheckDependents($lib)
	{
		$response = $this->apiManager->libraryVersionCheckDependents(array(
				'libraryVersionId' => $lib['versionId'],
		));
		$this->assertFalse($response->isError());
	}
	
	/**
	 * @test
	 * @depends libraryGetStatus
	 */
	public function libraryCheckDependents($lib)
	{
		$response = $this->apiManager->libraryCheckDependents(array(
				'libraryId' => $lib['id'],
		));
		$this->assertFalse($response->isError());
	}
	
	/**
	 * @test
	 */
	public function libraryVersionRemove()
	{
		$this->markTestIncomplete('****');
		$response = $this->apiManager->libraryVersionRemove();
		$this->assertFalse($response->isError());
	}
	
	/**
	 * @test
	 */
	public function libraryVersionDeploy()
	{
		$this->markTestIncomplete('****');
		$response = $this->apiManager->libraryVersionDeploy();
		$this->assertFalse($response->isError());
	}
	
	/**
	 * @test
	 */
	public function libraryRemove()
	{
		$this->markTestIncomplete('****');
		$response = $this->apiManager->libraryRemove();
		$this->assertFalse($response->isError());
	}
	
	/**
	 * @test
	 */
	public function libraryVersionSynchronize()
	{
		$this->markTestIncomplete('****');
		$response = $this->apiManager->libraryVersionSynchronize();
		$this->assertFalse($response->isError());
	}
	
	/**
	 * @test
	 * @depends libraryGetStatus
	 */
	public function libraryVersionGetStatus($lib)
	{
		$response = $this->apiManager->libraryVersionGetStatus(array(
			'libraryVersionId' => $lib['versionId'],
		));
		$this->assertFalse($response->isError());
	}
	
	/**
	 * @test
	 */
	public function downloadLibraryVersionFile()
	{
		$this->markTestIncomplete('****');
		$response = $this->apiManager->downloadLibraryVersionFile();
		$this->assertFalse($response->isError());
	}
	
	/**
	 * @test
	 * @depends libraryGetStatus
	 */
	public function librarySetDefault($lib)
	{
		$response = $this->apiManager->librarySetDefault(array(
				'libraryVersionId' => $lib['versionId'],
		));
		$this->assertFalse($response->isError());
	}
	
}