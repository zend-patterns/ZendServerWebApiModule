<?php
namespace ZendServerWebApi\Test;

use ZendServerWebApi\Test\WebApiTestCase;
use ZendServerWebApi\Model\Exception\ApiException;

class AdministrationTest extends WebApiTestCase
{
	/**
	 * @test
	 */
	public function apiKeysAddKey()
	{
		$response = $this->apiManager->apiKeysAddKey(array(
				'name' => $this->getParam('apiKeyName'),
				'username' => $this->getParam('apiKeyUsername')
		));
		$this->isValidApiResponse($response);
		return $this->getParam('apiKeyName');
	}
	
	/**
	 * @test
	 * @depends apiKeysAddKey
	 */
	public function apiKeysGetList($keyName)
	{
		$response = $this->apiManager->apiKeysGetList();
		$this->isValidApiResponse($response);
		foreach ($response->responseData->apiKeys->apiKey as $apiKey)
		{
			$name = (string)$apiKey->name;
			$username = (string)$apiKey->username;
			$id = (string)$apiKey->id;
			if ($name == $keyName){
				$this->assertEquals($name, $keyName);
				return $id;
			}
		}
		$this->assertTrue(false);
	}
	
	/**
	 * @test
	 * @depends apiKeysGetList
	 */
	public function apiKeysRemoveKey($id)
	{
		$response = $this->apiManager->apiKeysRemoveKey(array(
				'ids' => array($id),
		));
		$this->isValidApiResponse($response);
	}
	
	/**
	 * @test
	 */
	public function userAuthenticationSettings()
	{
		$response = $this->apiManager->userAuthenticationSettings(array(
			'type' => 'simple',
			'ldap' => array(),
			'password' => 'admin',
			'confirmNewPassword' => 'admin'
		));
		$this->isValidApiResponse($response);
	}
	
	/**
	 * @test
	 */
	public function userSetPassword()
	{
		$response = $this->apiManager->userSetPassword(array(
			'username' => 'admin',
			'password' => 'admin',
			'newPassword' => 'admin',
			'confirmNewPassword' => 'admin'
		));
		$this->isValidApiResponse($response);
	}
	
	/**
	 * @test
	 */
	public function setPassword()
	{
		$response = $this->apiManager->setPassword(array(
			'password' => 'admin',
			'newPassword' => 'admin',
			'confirmNewPassword' => 'admin'
		));
		$this->isValidApiResponse($response);
	}
	
	/**
	 * @test
	 */
	public function serverValidateLicense()
	{
		$response = $this->apiManager->serverValidateLicense(array(
			'licenseName' => 'sophie.b',
			'licenseValue' => 'G8VO7050C01H21CF2ACD532A8718CEE0',
		));
		$this->isValidApiResponse($response);
	}
	
	/**
	 * @test
	 */
	public function aclSetGroups()
	{
		$response = $this->apiManager->aclSetGroups(array(
			'role_groups' => array('administrator' => 'Admin-test'),
		));
		$this->isValidApiResponse($response);
	}
	
	/**
	 * @test
	 */
	public function bootstrapSingleServer()
	{
		try {
			$response = $this->apiManager->bootstrapSingleServer(array(
				'adminPassword' => 'admin',
				'acceptEula' => true,
			));
			$this->isValidApiResponse($response);
		} catch (ApiException $e)
		{
			$this->assertEquals('alreadyBootstrapped', $e->getApiErrorCode());
		}
	}
	
	/**
	 * @test
	 */
	public function serverStoreLicense()
	{
		$response = $this->apiManager->serverStoreLicense(array(
			'licenseName' => 'sophie.b',
			'licenseValue' => 'G8VO7050C01H21CF2ACD532A8718CEE0',
		));
		$this->isValidApiResponse($response);
	}
}