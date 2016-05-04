<?php
namespace Bmi\Tests;

class ApiTest extends \PHPUnit_Framework_TestCase
{
	public function testApiRequest()
	{
		$client = new \GuzzleHttp\Client();
		$response = $client->request(
			'GET',
			'http://bmi.lt/get/',
			[
				'query' => [
					'weight' => 85,
					'height' => 185,
					'unit' => 'metric'
				]
			]
		);

		$result = $response->getBody()->getContents();

		$this->assertJsonStringEqualsJsonFile(
			__DIR__ . '/../Fixtures/api-result.json',
			$result
		);
	}
}