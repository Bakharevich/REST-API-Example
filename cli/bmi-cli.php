<?php
use \Bmi\Classes;

require '../vendor/autoload.php';
require 'functions.php';

// allowed unit types
$allowedUnitTypes = ['metric', 'imperial'];

// check if CLI mode enabled
if (empty($_SERVER['argc'])) {
	echoCliError('CLI mode disabled');
}

// get vars
$data = getopt('', ['height:', 'weight:', 'unit:']);

// sanitize data into userData arr
$userData = [];
$userData['height'] = filter_var($data['height'], FILTER_SANITIZE_NUMBER_INT);
$userData['weight'] = filter_var($data['weight'], FILTER_SANITIZE_NUMBER_INT);
$userData['unit'] 	= filter_var($data['unit'], FILTER_SANITIZE_STRING);

// check if all params
if (empty($userData['height']) || empty($userData['weight']) || empty($userData['unit'])) {
	echoCliError('Some required params missed');
}

// check if unit type is allowed
if (!in_array($userData['unit'], $allowedUnitTypes)) {
	echoCliError('Invalid unit type');
}

// define unit type class
$unitClassName = 'Bmi\Classes\\' . ucfirst($userData['unit']) . "UnitStrategy";
$unitObject = new $unitClassName;

// calculate BMI
$Bmi = new Bmi\Classes\Bmi($userData['height'], $userData['weight'], $unitObject);
$bmiResult = $Bmi->calculate();

echo "
\033[0;32mBMI Calculation\033[0m
\n\033[1mBMI:\033[0m " . $bmiResult['bmi'] . "
\n\033[1mDescription:\033[0m " . $bmiResult['description'] . "
\n
";