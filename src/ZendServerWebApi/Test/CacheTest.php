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
		$this->isValidApiResponse($response);
	}
	
	/**
	 * @test
	 */
	public function datacacheClear()
	{
		$response = $this->apiManager->datacacheClear(array(
				'keys' => array('bidule'),
		));
		$this->isValidApiResponse($response);
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