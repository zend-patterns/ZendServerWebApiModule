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
		$this->isValidApiResponse($response);
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
		$this->isValidApiResponse($response);
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
		$this->isValidApiResponse($response);
	}
	
	/**
	 * @test
	 */
	public function libraryVersionRemove()
	{
		$this->markTestIncomplete('****');
		$response = $this->apiManager->libraryVersionRemove();
		$this->isValidApiResponse($response);
	}
	
	/**
	 * @test
	 */
	public function libraryVersionDeploy()
	{
		$this->markTestIncomplete('****');
		$response = $this->apiManager->libraryVersionDeploy();
		$this->isValidApiResponse($response);
	}
	
	/**
	 * @test
	 */
	public function libraryRemove()
	{
		$this->markTestIncomplete('****');
		$response = $this->apiManager->libraryRemove();
		$this->isValidApiResponse($response);
	}
	
	/**
	 * @test
	 */
	public function libraryVersionSynchronize()
	{
		$this->markTestIncomplete('****');
		$response = $this->apiManager->libraryVersionSynchronize();
		$this->isValidApiResponse($response);
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
		$this->isValidApiResponse($response);
	}
	
	/**
	 * @test
	 */
	public function downloadLibraryVersionFile()
	{
		$this->markTestIncomplete('****');
		$response = $this->apiManager->downloadLibraryVersionFile();
		$this->isValidApiResponse($response);
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
		$this->isValidApiResponse($response);
	}
	
}