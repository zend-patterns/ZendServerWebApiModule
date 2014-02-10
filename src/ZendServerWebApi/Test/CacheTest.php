<?php
namespace ZendServerWebApi\Test;

use ZendServerWebApi\Test\WebApiTestCase;

class CacheTest extends WebApiTestCase
{
	/**
	 * @test
	 * @dataProvider CacheBackend
	 */
	public function cacheClear($backend)
	{
		$response = $this->apiManager->cacheClear(array(
			'component' => $backend,
		));
		$this->assertFalse($response->isError(), $backend . ' has not been cleared');
	}
	
	/**
	 * @test
	 */
	public function datacacheClear()
	{
		$response = $this->apiManager->datacacheClear(array(
				'keys' => array(),
		));
		$this->assertFalse($response->isError());
	}
	
	/**
	 * 
	 * @return multitype:string
	 */
	public function CacheBackend()
	{
		return array(
			array('Zend Data Cache'),
			array('Zend Page Cache'),
			array('Zend Optimizer+'),
		);
	} 
}