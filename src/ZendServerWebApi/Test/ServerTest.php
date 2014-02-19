<?php
namespace ZendServerWebApi\Test;

use ZendServerWebApi\Test\WebApiTestCase;

class ServerTest extends WebApiTestCase
{
	/**
	 * @test
	 */
	public function tasksComplete()
	{
		$response = $this->apiManager->tasksComplete();
		$this->isValidApiResponse($response);
	}
	
	/**
	 * @test
	 */
	public function getServerInfo()
	{
		$response = $this->apiManager->getServerInfo(array(
			'serverId' => 0
		));
		$this->isValidApiResponse($response);
	}
	
	/**
	 * @test
	 */
	public function getSystemInfo()
	{
		$response = $this->apiManager->getSystemInfo();
		$this->isValidApiResponse($response);
	}
	
	/**
	 * @test
	 */
	public function clusterGetServersCount()
	{
		$response = $this->apiManager->clusterGetServersCount();
		$this->isValidApiResponse($response);
	}
	
	/**
	 * @test
	 */
	public function clusterGetServerStatus()
	{
		$response = $this->apiManager->clusterGetServerStatus();
		$this->isValidApiResponse($response);
	}
	
	/**
	 * @test
	 */
	public function serverAddToCluster()
	{
		$this->markTestIncomplete('no cluster');
	}
	
	/**
	 * @test
	 */
	public function changeServerNameById()
	{
		$response = $this->apiManager->changeServerNameById(array(
			'serverName' => 'server_test',
			'serverId' => 0
		));
		$this->isValidApiResponse($response);
	}
	
	/**
	 * @test
	 */
	public function clusterAddServer()
	{
		$this->markTestIncomplete('no cluster');
	}
	
	/**
	 * @test
	 */
	public function clusterRemoveServer()
	{
		$this->markTestIncomplete('no cluster');
	}
	
	/**
	 * @test
	 */
	public function clusterForceRemoveServer()
	{
		$this->markTestIncomplete('no cluster');
	}
	
	/**
	 * @test
	 */
	public function clusterDisableServer()
	{
		$this->markTestIncomplete('no cluster');
	}
	
	/**
	 * @test
	 */
	public function clusterEnableServer()
	{
		$this->markTestIncomplete('no cluster');
	}
	
	/**
	 * @test
	 */
	public function clusterReconfigureServer()
	{
		$response = $this->apiManager->clusterReconfigureServer(array(
				'serverId' => 0
		));
		$this->isValidApiResponse($response);
	}
	
	/**
	 * @test
	 */
	public function restartPhp()
	{
		$response = $this->apiManager->restartPhp();
		$this->isValidApiResponse($response);
	}
	
	/**
	 * @test
	 */
	public function restartDaemon()
	{
		$response = $this->apiManager->restartDaemon(array(
				'daemon' => 'monitor_node'
		));
		$this->isValidApiResponse($response);
	}
	
	/**
	 * @test
	 */
	public function daemonsProbe()
	{
		$response = $this->apiManager->daemonsProbe();
		$this->isValidApiResponse($response);
	}
	
	/**
	 * @test
	 */
	public function logsReadLines()
	{
		$response = $this->apiManager->logsReadLines(array(
				'logName' => 'deployment'
		));
		$this->isValidApiResponse($response);
	}
	
	/**
	 * @test
	 */
	public function logsGetLogfile()
	{
		$response = $this->apiManager->logsGetLogfile(array(
				'logName' => 'deployment'
		));
		$this->isValidApiResponse($response);
	}
}