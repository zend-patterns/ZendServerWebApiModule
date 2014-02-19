<?php
namespace ZendServerWebApi\Test;

class ConfigurationTest extends WebApiTestCase
{
	/**
	 * @test
	 */
	public function emailSend()
	{
		$response = $this->apiManager->emailSend(array(
				'to' => 'zend@zend.com',
				'from' => 'from@zend.com',
				'subject' => 'test sbject',
				'templateName' => 'default',
		));
		$this->isValidApiResponse($response);
	}
	
	/**
	 * @test
	 * @dataProvider ExtensionList
	 */
	public function configurationExtensionsOn($extension)
	{
		$response = $this->apiManager->configurationExtensionsOn(array(
			'extensions' => array($extension),
		));
		$name= (string) $response->responseData->extensions->extension->name;
		$this->isValidApiResponse($response);
		$this->assertEquals($extension,$name);
	}
	
	/**
	 * @test
	 * @dataProvider extensionList
	 */
	public function configurationExtensionsOff($extension)
	{
		$response = $this->apiManager->configurationExtensionsOff(array(
				'extensions' => array($extension),
		));
		$name= (string) $response->responseData->extensions->extension->name;
		$this->isValidApiResponse($response);
		$this->assertEquals($extension,$name);
	}
	
	/**
	 * 
	 * @return multitype:multitype:string
	 */
	public function extensionList()
	{
		return array(
			array('mssql'),
		);
	}
	
	/**
	 * @test
	 * @dataProvider extensionDirectives
	 */
	public function configurationValidateDirectives($directive, $value, $isValid)
	{
		$response = $this->apiManager->configurationValidateDirectives(array(
			'directives' => array( $directive => $value),
		));
		$this->isValidApiResponse($response);
		$valid = (string)$response->responseData->validates->validate->valid;
		$this->assertEquals($isValid,$valid);
	}
	
	/**
	 * @test
	 * @dataProvider extensionDirectives
	 */
	public function configurationStoreDirectives($directive, $value, $isValid)
	{
		if ($isValid == 'No') $this->markTestSkipped();
		$response = $this->apiManager->configurationStoreDirectives(array(
				'directives' => array( $directive => $value),
		));
		$this->isValidApiResponse($response);
	}
	
	/**
	 * List of extension directives to test
	 * @return multitype:multitype:
	 */
	public function extensionDirectives()
	{
		return array(
			array('mssql.max_links' ,0,'Yes'),
		);
	}

	/**
	 * @test
	 */
	/*public function configurationSearch()
	{
		$this->markTestIncomplete();
		$response = $this->apiManager->configurationSearch(array(
				'query' => 'timezone',
		));
		$this->assertFalse($response->isError());
	}*/
	
	/**
	 * @test
	 */
	public function configurationExtensionsList()
	{
		$response = $this->apiManager->configurationExtensionsList();
		$this->isValidApiResponse($response);
	}
	
	/**
	 * @test
	 */
	public function configurationDirectivesList()
	{
		$response = $this->apiManager->configurationDirectivesList();
		$this->isValidApiResponse($response);
	}
	
	/**
	 * @test
	 */
	public function configurationComponentsList()
	{
		$response = $this->apiManager->configurationComponentsList();
		$this->isValidApiResponse($response);
	}
	
	/**
	 * @test
	 */
	public function configurationExport()
	{
		$response = $this->apiManager->configurationExport();
		$this->isValidApiResponse($response);
	}
	
	/**
	 * @test
	 */
	public function configurationImport()
	{
		$response = $this->apiManager->configurationImport(array(
			'configFile' => '',
		));
		$this->isValidApiResponse($response);
	}
	
	/**
	 * @test
	 */
	public function configurationsRevertChanges()
	{
		$response = $this->apiManager->configurationRevertChanges(array(
			'serverId' => 1,
		));
		$this->isValidApiResponse($response);
	}
	
	/**
	 * @test
	 */
	public function configurationsApplyChanges()
	{
		$response = $this->apiManager->configurationApplyChanges(array(
			'serverId' => 1,
		));
		$this->isValidApiResponse($response);
	}
	
	/**
	 * @test
	 */
	public function configurationReset()
	{
		$response = $this->apiManager->configurationReset(array(
			'configFile' => '',
		));
		$this->isValidApiResponse($response);
	}
	
}