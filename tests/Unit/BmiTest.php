<?php
namespace Bmi\Tests;

use \Bmi\Classes;

class BmiTest extends \PHPUnit_Framework_TestCase {
	public function testCalculate_With185And85AndMetric_Returns2484()
	{
		$strategy = $this->getMock('\Bmi\Classes\MetricUnitStrategy', ['calculate']);
		$strategy->method('calculate')
			->willReturn('24.84');

		$Bmi = new \Bmi\Classes\Bmi(185, 85, $strategy);
		$data = $Bmi->calculate();

		$this->assertEquals(24.84, $data['bmi']);
	}

	/**
	 * @param $original
	 * @param $expected
	 *
	 * @dataProvider providerTestDescription
	 */
	public function testDescription($original, $expected)
	{
		$strategy = new \Bmi\Classes\MetricUnitStrategy();

		$Bmi = new \Bmi\Classes\Bmi($original[0], $original[1], $strategy);
		$data = $Bmi->calculate();

		$this->assertEquals($data['description'], $expected);
	}

	/**
	 * @return array
	 */
	public function providerTestDescription()
	{
		return [
			[
				[220, 85, 'metric'], 'Underweight'
			],
			[
				[185, 85, 'metric'], 'Normal'
			],
			[
				[170, 85, 'metric'], 'Overweight'
			],
			[
				[150, 85, 'metric'], 'Obese'
			],
		];
	}
}