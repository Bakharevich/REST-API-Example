<?php
namespace Bmi\Classes;

class Bmi {
	protected $height;
	protected $weight;
	protected $strategy;

	public function __construct($height, $weight, UnitStrategy $strategy) {
		$this->height 	= $height;
		$this->weight 	= $weight;
		$this->strategy = $strategy;
	}

	public function calculate()
	{
		$res = $this->strategy->calculate($this->weight, $this->height);

		$res = round($res, 2);

		// get description
		$description = $this->getDescription($res);

		$data = array(
			'bmi' => $res,
			'description' => $description
		);

		return $data;
	}

	protected function getDescription($res)
	{
		$text = '';

		if ($res < 18.5) {
			$text = 'Underweight';
		}
		elseif ($res >= 18.5 && $res < 24.9) {
			$text = 'Normal';
		}
		elseif ($res >= 24.9 && $res < 29.9) {
			$text = 'Overweight';
		}
		elseif ($res >= 30) {
			$text = 'Obese';
		}

		return $text;
	}
}