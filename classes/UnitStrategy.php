<?php
namespace Bmi\Classes;

abstract class UnitStrategy {
	abstract function calculate($weight, $height);
}