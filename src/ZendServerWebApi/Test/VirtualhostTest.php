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
		$this->isValidApiResponse($response);
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
		$this->isValidApiResponse($response);
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
		$this->isValidApiResponse($response);
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
		$this->isValidApiResponse($response);
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
		$this->isValidApiResponse($response);
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
		$this->isValidApiResponse($response);
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
		$this->isValidApiResponse($response);
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
		$this->isValidApiResponse($response);
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
		$this->isValidApiResponse($response);
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
		$$this->isValidApiResponse($response);
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
		$this->isValidApiResponse($response);
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
		$this->isValidApiResponse($response);
	}
}