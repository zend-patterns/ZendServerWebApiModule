<?php
namespace ZendServerWebApi\Test;

class MonitoringRulesTest extends WebApiTestCase
{
	/**
	 * @test
	 */
	public function monitorSetRuleUpdated()
	{
		$response = $this->apiManager->monitorSetRuleUpdated();
		$this->assertFalse($response->isError());
	}
	
	/**
	 * @test
	 */
	public function monitorExportRules()
	{
		$response = $this->apiManager->monitorExportRules();
		$this->assertFalse($response->isError());
	}
	
	/**
	 * @test
	 */
	public function monitorImportRules()
	{
		$response = $this->apiManager->monitorImportRules(array(
				'monitorRules' => '<xml>',
		));
		$this->assertFalse($response->isError());
	}
	
	/**
	 * @test
	 */
	public function monitorGetRulesList()
	{
		$response = $this->apiManager->monitorGetRulesList();
		$this->assertFalse($response->isError());
		$id = (string) $response->responseData->rules->rule->id;
		return $id;
	}
	
	/**
	 * @test
	 * @depends monitorGetRulesList
	 */
	public function monitorDisableRules($id)
	{
		$response = $this->apiManager->monitorDisableRules(array(
				'rulesIds' => array($id)
		));
		$this->assertFalse($response->isError());
	}
	
	/**
	 * @test
	 * @depends monitorGetRulesList
	 */
	public function monitorEnableRules($id)
	{
		$response = $this->apiManager->monitorEnableRules(array(
				'rulesIds' => array($id)
		));
		$this->assertFalse($response->isError());
	}
	
	/**
	 * @test
	 */
	public function monitorSetRule()
	{
		$response = $this->apiManager->monitorSetRule(array(
				'rulesId' => -1,
				'ruleProperties' => array(
						"rule_type_id" => 'request-large-mem-usage',
						"rule_parent_id" => '',
						"app_id" => -1,
						"name" => 'testRuleWebApi' . time(),
						"enabled" => 1,
						"description" => 'test rule',
						"url" => '',
						"creator" => 1
				),
				'ruleTriggers' => array(
						array(
							'triggerProperties' => array(
									'severity' => 1,
									'trigger_id' => -1
							),
						),
				),
		));
		$this->assertFalse($response->isError());
		$id = (string)$response->responseData->rules->rule->id;
		return $id;
	}
	
	/**
	 * @test
	 * @depends monitorSetRule
	 */
	public function monitorRemoveRules($id)
	{
		$response = $this->apiManager->monitorRemoveRules(array(
				'rulesIds' => array($id)
		));
		$this->assertFalse($response->isError());
	}
}