<?php
namespace ZendServerWebApi\Test;

use ZendServerWebApi\Test\WebApiTestCase;

class PagecacheTest extends WebApiTestCase
{
	/**
	 * @test
	 */
	public function pagecacheRulesList()
	{
		$response = $this->apiManager->pagecacheRulesList();
		$this->assertFalse($response->isError());
	}
	
	/**
	 * @test
	 */
	public function pagecacheSaveRule()
	{
		$response = $this->apiManager->pagecacheSaveRule(array(
				'urlScheme' => 'http',
				'urlHost' => time(),
				'urlPath' => '/',
				'matchType' => 'exactMatch',
				'lifetime' => 360,
				'name' => 'test rule'. time(),
		));
		$this->assertFalse($response->isError());
		$id= (string)$response->responseData->ruleInfo->rule->id;
		return $id;
	}
	
	/**
	 * @test
	 */
	public function pagecacheSaveApplicationRule()
	{
		$applicationStatus = $this->apiManager->applicationGetStatus();
		$appId = (string)$applicationStatus->responseData->applicationsList->applicationInfo->id;
		$response = $this->apiManager->pagecacheSaveApplicationRule(array(
				'urlScheme' => 'http',
				'urlHost' => time(),
				'urlPath' => '/',
				'matchType' => 'exactMatch',
				'lifetime' => 360,
				'applicationId' => $appId,
				'name' => 'test rule'. time(),
		));
		$this->assertFalse($response->isError());
		$id= (string)$response->responseData->ruleInfo->rule->id;
		$response = $this->apiManager->pagecacheDeleteRules(array(
				'rules' => array($id)
		));
	}
	
	/**
	 * @test
	 */
	public function pagecacheExportRules()
	{
		$response = $this->apiManager->pagecacheExportRules();
		$this->assertFalse($response->isError());
	}
	
	/**
	 * @test
	 */
	public function pagecacheImportRules()
	{
		$xmlContent = file_get_contents($this->getRootDir() . '/data/pagecache_rules.xml');
		$response = $this->apiManager->pagecacheImportRules(array(
			'pageCacheRules' => $xmlContent
		));
		$this->assertFalse($response->isError());
	}
	
	/**
	 * @test
	 * @depends pagecacheSaveRule
	 */
	public function pagecacheRuleInfo($id)
	{
		$response = $this->apiManager->pagecacheRuleInfo(array(
			'id' => $id
		));
		$this->assertFalse($response->isError());
	}
	
	/**
	 * @test
	 * @depends pagecacheSaveRule
	 */
	public function pagecacheClearRulesCache($id)
	{
		$response = $this->apiManager->pagecacheClearRulesCache(array(
				'rules' => array($id)
		));
		$this->assertFalse($response->isError());
	}
	
	/**
	 * @test
	 */
	public function pagecacheClearCacheByRuleName()
	{
		$response = $this->apiManager->pagecacheClearCacheByRuleName(array(
				'ruleName' => 'test rule'
		));
		$this->assertFalse($response->isError());
	}
	
	/**
	 * @test
	 * @depends pagecacheSaveRule
	 */
	public function pagecacheDeleteRules($id)
	{
		$response = $this->apiManager->pagecacheDeleteRules(array(
			'rules' => array($id)
		));
		$this->assertFalse($response->isError());
	}
	
	
	
}