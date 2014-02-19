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
		$this->isValidApiResponse($response);
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
		$this->isValidApiResponse($response);
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
		$this->isValidApiResponse($response);
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
		$this->isValidApiResponse($response);
	}
}