<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \Bmi\Classes;

require '../vendor/autoload.php';

// set config
$config = [];
$config['displayErrorDetails'] = true;
$config['allowedUnitTypes'] = ['metric', 'imperial'];

// autoload classes
spl_autoload_register(function ($classname) {
	//require("../classes/" . $classname . ".php");
});

// init app
$app = new \Slim\App(["settings" => $config]);

// dependencies container
$container = $app->getContainer();

// inject monolog for logging
$container['logger'] = function($c) {
	$logger = new \Monolog\Logger('logger');
	$fileHandler = new \Monolog\Handler\StreamHandler("../logs/app.log");
	$logger->pushHandler($fileHandler);

	return $logger;
};

/**
 * ROUTES
 */
$app->get('/get/', function(Request $request, Response $response) {
	// log event
	$this->logger->addInfo('Get BMI called');

	// get params
	$data = $request->getQueryParams();

	// get allowed unit types
	$allowedUnitTypes = $this->get('settings')['allowedUnitTypes'];

	// sanitize data into userData arr
	$userData = [];
	$userData['height'] = filter_var($data['height'], FILTER_SANITIZE_NUMBER_INT);
	$userData['weight'] = filter_var($data['weight'], FILTER_SANITIZE_NUMBER_INT);
	$userData['unit'] 	= filter_var($data['unit'], FILTER_SANITIZE_STRING);

	// check if all required params
	if (empty($userData['height']) || empty($userData['weight']) || empty($userData['unit'])) {
		$this->logger->error('Some required params are empty');

		$res = array(
			'status' => array(
				'code' => 400,
				'message' => 'Some required params are empty'
			)
		);
		return $response->withJson($res, 400);
	}

	// check if such unit type exists
	if (!in_array($userData['unit'], $allowedUnitTypes)) {
		$this->logger->error("Type {$userData['unit']} doesn't allowed");

		$res = array(
			'status' => array(
				'code' => 400,
				'message' => "Type {$userData['unit']} doesn't allowed"
			)
		);
		return $response->withJson($res, 400);
	}

	// define unit type class
	$unitClassName = 'Bmi\Classes\\' . ucfirst($userData['unit']) . "UnitStrategy";
	$unitObject = new $unitClassName;

	// calculate BMI
	$Bmi = new Bmi\Classes\Bmi($userData['height'], $userData['weight'], $unitObject);
	$bmiResult = $Bmi->calculate();

	// result
	$res = array(
		'status' => array(
			'code' => 200,
			'message' => "Success"
		),
		'data' => $bmiResult
	);
	return $response->withJson($res, 200);

})->setName('get_bmi_result');

$app->run();