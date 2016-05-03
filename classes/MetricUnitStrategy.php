<?php
namespace Bmi\Classes;

class MetricUnitStrategy extends UnitStrategy {
	public function calculate($weight, $height)
	{
		return $weight / ($height * $height / 10000);
	}
}