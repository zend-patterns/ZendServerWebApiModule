<?php
namespace ZendServerWebApi\Test;

use ZendServerWebApi\Test\WebApiTestCase;

class StudioTest extends WebApiTestCase
{
	/**
	 * @test
	 */
	public function studioStartDebug()
	{
		$response = $this->apiManager->studioStartDebug(array(
			'eventsGroupId' => 1,
		));
		$this->isValidApiResponse($response);
	}
	
	/**
	 * @test
	 */
	public function studioStartProfile()
	{
		$response = $this->apiManager->studioStartProfile(array(
				'eventsGroupId' => 1,
		));
		$this->isValidApiResponse($response);
	}
	
	/**
	 * @test
	 */
	public function studioShowSource()
	{
		$response = $this->apiManager->studioShowSource(array(
				'eventsGroupId' => 1,
		));
		$this->isValidApiResponse($response);
	}
	
	/**
	 * @test
	 */
	public function studioStartDebugMode()
	{
		$response = $this->apiManager->studioStartDebugMode(array(
			'filters' => array(),
		));
		$this->isValidApiResponse($response);
	}
	
	/**
	 * @test
	 */
	public function studioStopDebugMode()
	{
		$response = $this->apiManager->studioStopDebugMode();
		$this->isValidApiResponse($response);
	}
	
	/**
	 * @test
	 */
	public function studioIsDebugModeEnabled()
	{
		$response = $this->apiManager->studioIsDebugModeEnabled();
		$this->isValidApiResponse($response);
	}
	
}