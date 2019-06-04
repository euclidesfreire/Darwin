<?php

namespace App\Library\Random;

class Random
{
	public static function randomFloat($min, $max, $decimals = 1)
	{

		$divisor = pow(10, $decimals);
		$randFloat = mt_rand($min, $max * $divisor) / $divisor;

		return $randFloat;

	}
}