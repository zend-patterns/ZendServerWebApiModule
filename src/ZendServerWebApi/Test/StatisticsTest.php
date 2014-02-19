<?php
namespace ZendServerWebApi\Test;

use ZendServerWebApi\Test\WebApiTestCase;

class StatisticsTest extends WebApiTestCase
{
	/**
	 * @test
	 * @dataProvider StatisticsType
	 */
	public function statisticsGetSeries($type)
	{
		$response = $this->apiManager->statisticsGetSeries(array(
			'type' => $type,
		));
		$this->isValidApiResponse($response);
	}
	
	/**
	 * @test
	 */
	public function statisticsClearData()
	{
		$response = $this->apiManager->statisticsClearData();
		$this->isValidApiResponse($response);
	}
	
	/**
	 * 
	 * @return multitype:string
	 */
	public function StatisticsType()
	{
		return array(
			array('OPLUS_UTILIZATION'),
			array('DC_SHM_UTILITZATION'),
			array('PC_NUM_OF_RULES'),
		);
	} 
}