<?php
namespace ZendServerWebApi\Test;

use ZendServerWebApi\Test\WebApiTestCase;

class VirtualhostTest extends WebApiTestCase
{
	/**
	 * @test
	 */
	public function vhostGetStatus()
	{
		$response = $this->apiManager->vhostGetStatus();
		$this->assertFalse($response->isError());
	}
	
	/**
	 * @test
	 */
	public function vhostAdd()
	{
		$response = $this->apiManager->vhostAdd(array(
				'name' => 'vhost-test',
				'port' => 80,
		));
		$this->assertFalse($response->isError());
		$id= (string)$response->responseData->vhostList->vhostInfo->id;
		return $id;
	}
	
	/**
	 * @test
	 */
	public function vhostAddSecure()
	{
		$response = $this->apiManager->vhostAddSecure(array(
				'name' => 'vhost-test-secure',
				'port' => 80,
				'sslCertificatePath' => $this->getRootDir() . '/data/ssl.key',
				'sslCertificateKeyPath' => '123'
		));
		$this->assertFalse($response->isError());
	}
	
	/**
	 * @test
	 */
	public function vhostAddSecureIbmi()
	{
		$response = $this->apiManager->vhostAddSecureIbmi(array(
				'name' => 'vhost-test-secure',
				'port' => 80,
				'sslAppName' => 'sslIBMi',
		));
		$this->assertFalse($response->isError());
	}
	
	/**
	 * @test
	 * @depends vhostAdd
	 */
	public function vhostEdit($id)
	{
		$response = $this->apiManager->vhostEdit(array(
				'vhostId' => $id,
				'template' => 'xxx',
		));
		$this->assertFalse($response->isError());
	}
	
	/**
	 * @test
	 * @depends vhostAdd
	 */
	public function vhostGetDetails($id)
	{
		$response = $this->apiManager->vhostGetDetails(array(
			'vhost' => $id
		));
		$this->assertFalse($response->isError());
	}
	
	/**
	 * @test
	 * @depends vhostAdd
	 */
	public function vhostRedeploy($id)
	{
		$response = $this->apiManager->vhostRedeploy(array(
				'vhost' => $id
		));
		$this->assertFalse($response->isError());
	}
	
	/**
	* @test
	* @depends vhostAdd
	*/
	public function vhostEnableDeployment($id)
	{
		$response = $this->apiManager->vhostEnableDeployment(array(
				'vhost' => $id
		));
		$this->assertFalse($response->isError());
	}
	
	/**
	 * @test
	 * @depends vhostAdd
	 */
	public function vhostDisableDeployment($id)
	{
		$response = $this->apiManager->vhostDisableDeployment(array(
				'vhost' => $id
		));
		$this->assertFalse($response->isError());
	}
	
	/**
	 * @test
	 * @depends vhostAdd
	 */
	public function vhostRemove($id)
	{
		$response = $this->apiManager->vhostRemove(array(
			'vhosts' => array($id)
		));
		$this->assertFalse($response->isError());
	}
	
	/**
	 * @test
	 */
	public function vhostValidateSsl()
	{
		$response = $this->apiManager->vhostValidateSsl(array(
			'sslCertificatePath' => '/',
			'sslCertificateKeyPath' => '123'
		));
		$this->assertFalse($response->isError());
	}
	
	/**
	 * @test
	 */
	public function vhostValidateTemplate()
	{
		$response = $this->apiManager->vhostValidateTemplate(array(
				'name' => 'test vhsot',
				'port' => 80,
				'template' => 'test template'
		));
		$this->assertFalse($response->isError());
	}
}