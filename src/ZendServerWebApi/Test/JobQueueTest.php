<?php
namespace ZendServerWebApi\Test;

class JobQueueTest extends WebApiTestCase
{
	/**
	 * @test
	 */
	public function jobqueueAddJob()
	{
		$response = $this->apiManager->jobqueueAddJob(array(
				'url' => 'http://'  .time(),
		));
		$this->isValidApiResponse($response);
	}
	
	/**
	 * @test
	 */
	public function jobqueueStatistics()
	{
		$response = $this->apiManager->jobqueueStatistics();
		$this->isValidApiResponse($response);
	}
	
	/**
	 * @test
	 */
	public function jobqueueJobsList()
	{
		$response = $this->apiManager->jobqueueJobsList();
		$this->isValidApiResponse($response);
		$id = (string) $response->responseData->jobs->job->id;
		return $id;
	}
	
	/**
	 * @test
	 * @depends jobqueueJobsList
	 */
	public function jobqueueJobInfo($id)
	{
		$response = $this->apiManager->jobqueueJobInfo(array(
				'id' => $id,
		));
		$this->isValidApiResponse($response);
	}
	
	/**
	 * @test
	 */
	public function jobqueueDeleteJobs()
	{
		$this->marktestIncomplete('Not developped yet');
	}
	
	/**
	 * @test
	 */
	public function jobqueueDeleteJobsByPredefinedFilter()
	{
		$this->marktestIncomplete('Not developped yet');
	}
	
	/**
	 * @test
	 */
	public function jobqueueRequeueJobs()
	{
		$this->marktestIncomplete('Not developped yet');
	}
	
	/**
	 * @test
	 */
	public function jobqueueSaveRule()
	{
		$response = $this->apiManager->jobqueueSaveRule(array(
				'url' => 'http://' .time(),
				'options' => array(
						'interval' => 'H 1',
						'name' => 'test JQ rule'
				)
		));
		$this->isValidApiResponse($response);
		$id = (string)$response->responseData->ruleInfo->rule->id;
		return $id;
	}
	
	/**
	 * @test
	 */
	public function jobqueueRulesList()
	{
		$response = $this->apiManager->jobqueueRulesList();
		$this->isValidApiResponse($response);
		$id = (string)$response->responseData->rules->rule->id;
		return $id;
	}
	
	/**
	 * @test
	 * @depends jobqueueRulesList
	 */
	public function jobqueueRuleInfo($id)
	{
		$response = $this->apiManager->jobqueueRuleInfo(array(
				'id' => $id,
		));
		$this->isValidApiResponse($response);
	}
	
	/**
	 * @test
	 * @depends jobqueueSaveRule
	 */
	public function jobqueueDisableRules($id)
	{
		$response = $this->apiManager->jobqueueDisableRules(array(
			'rules' => array($id),
		));
		$this->isValidApiResponse($response);
	}
	
	/**
	 * @test
	 * @depends jobqueueSaveRule
	 */
	public function jobqueueResumeRules($id)
	{
		$response = $this->apiManager->jobqueueResumeRules(array(
				'rules' => array($id),
		));
		$this->isValidApiResponse($response);
	}
	
	/**
	 * @test
	 * @depends jobqueueSaveRule
	 */
	public function jobqueueRunNowRule($id)
	{
		$response = $this->apiManager->jobqueueRunNowRule(array(
				'ruleId' => $id,
		));
		$this->isValidApiResponse($response);
	}
	
	/**
	 * @test
	 * @depends jobqueueSaveRule
	 */
	public function jobqueueDeleteRules($id)
	{
		$response = $this->apiManager->jobqueueDeleteRules(array(
				'rules' => array($id),
		));
		$this->isValidApiResponse($response);
	}
}