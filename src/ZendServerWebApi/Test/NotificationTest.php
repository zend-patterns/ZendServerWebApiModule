<?php
namespace ZendServerWebApi\Test;

class NotificationTest extends WebApiTestCase
{
	/**
	 * @test
	 */
	public function getNotifications()
	{
		$response = $this->apiManager->getNotifications();
		$this->assertFalse($response->isError());
		$id = (string)$response->responseData->notifications->notification->id;
		return $id;
	}
	
	/**
	 * @test
	 */
	public function deleteNotification()
	{
		$response = $this->apiManager->deleteNotification(array(
			'type' => 'serverOffline',
		));
		$this->assertFalse($response->isError());
	}
	
	/**
	 * @test
	 */
	public function updateNotification()
	{
		$response = $this->apiManager->updateNotification(array(
			'type' => 'serverOffline',
			'repeat' => 1
		));
		$this->assertFalse($response->isError());
	}
	
	/**
	 * @test
	 */
	public function sendNotification()
	{
		$response = $this->apiManager->sendNotification(array(
			'type' => 'serverOffline',
			'ip' => '127.0.0.1',
		));
		$this->assertFalse($response->isError());
	}
}