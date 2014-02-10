<?php
namespace ZendServerWebApi\Test;

class MonitorTest extends WebApiTestCase
{
	/**
	 * @test
	 */
	public function monitorGetIssuesByPredefinedFilter()
	{
		$response = $this->apiManager->monitorGetIssuesByPredefinedFilter(array(
				'filterId' => 'All Issues'
		));
		$this->assertFalse($response->isError());
		$id = (string) $response->responseData->issues->issue->id;
		$eventGroupId =( string) $response->responseData->issues->issue->codeTracingEventGroupId; 
		return array('eventGroupId' => $eventGroupId,'id' => $id);
	}
	
	/**
	 * @test
	 * @depends monitorGetIssuesByPredefinedFilter
	 */
	public function monitorGetBacktraceFile($event)
	{
		$response = $this->apiManager->monitorGetBacktraceFile(array(
				'eventsGroupId' => $event['eventGroupId'],
				'backtraceNum' => 0
		));
		$this->assertFalse($response->isError());
	}
	
	/**
	 * @test
	 * @depends monitorGetIssuesByPredefinedFilter
	 */
	public function monitorExportIssueByEventsGroup($event)
	{
		$response = $this->apiManager->monitorExportIssueByEventsGroup(array(
				'eventsGroupId' => $event['eventGroupId'],
		));
		$this->assertFalse($response->isError());
	}
	
	/**
	 * @test
	 * @depends monitorGetIssuesByPredefinedFilter
	 */
	public function monitorGetIssueDetails($event)
	{
		$response = $this->apiManager->monitorGetIssueDetails(array(
				'issueId' => $event['id'],
		));
		$this->assertFalse($response->isError());
	}
	
	/**
	 * @test
	 * @depends monitorGetIssuesByPredefinedFilter
	 */
	public function monitorChangeIssueStatus($event)
	{
		$response = $this->apiManager->monitorChangeIssueStatus(array(
				'issueId' => $event['id'],
				'newStatus' => 'ignored'
		));
		$this->assertFalse($response->isError());
	}
	
	/**
	 * @test
	 * @depends monitorGetIssuesByPredefinedFilter
	 */
	public function monitorGetEventGroupDetails($event)
	{
		$response = $this->apiManager->monitorGetEventGroupDetails(array(
				'eventsGroupId' => $event['eventGroupId'],
				'issueId' => $event['id'],
		));
		$this->assertFalse($response->isError());
	}
	
	/**
	 * @test
	 */
	public function monitorDeleteIssuesByPredefinedFilter()
	{
		$this->markTestSkipped('To damn hazardous !');
		$response = $this->apiManager->monitorDeleteIssuesByPredefinedFilter(array(
				'filterId' => 'org',
		));
		$this->assertFalse($response->isError());
	}
	
	/**
	 * @test
	 * @depends monitorGetIssuesByPredefinedFilter
	 */
	public function monitorDeleteIssues($event)
	{
		$response = $this->apiManager->monitorDeleteIssues(array(
				'issuesIds' => array($event['id']),
		));
		$this->assertFalse($response->isError());
	}
}