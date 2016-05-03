<?php
namespace Bmi\Classes;

class ImperialUnitStrategy extends UnitStrategy {
	public function calculate($weight, $height)
	{
		return ($weight * 703) / ($height * $height);
	}
}