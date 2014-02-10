<?php
namespace ZendServerWebApi\Test;

class FilterTest extends WebApiTestCase
{
	/**
	 * @test
	 */
	public function filterGetByType()
	{
		$response = $this->apiManager->filterGetByType(array(
				'type' => 'issue',
		));
		$this->assertFalse($response->isError());
		$id = (string)$response->responseData->filters->filter->id;
		$this->assertTrue(is_string($id));
	}
	
	/**
	 * @test
	 */
	public function filterSave()
	{
		$name = 'testFilter' . time();
		$response = $this->apiManager->filterSave(array(
				'type' => 'issue',
				'name' => $name,
		));
		$this->assertFalse($response->isError());
		$id = (string)$response->responseData->filters->filter->id;
		$this->assertTrue(is_string($id));
		return $name;
	}
	
	/**
	 * @test
	 * @depends filterSave
	 */
	public function filterDelete($name)
	{
		$response = $this->apiManager->filterDelete(array(
				'name' => $name
		));
		$this->assertFalse($response->isError());
	}
}