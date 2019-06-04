<?php

namespace App\Library\Darwin\Fitness;

use App\Library\Darwin\Chromosome;
use App\Library\Random\Random;

class FitnessFunction
{
	private $fitness;

	public function __construct(){
		$this->fitness = 0;
	}

	 public function setFitness($fitness)
	{
    	$this->fitness = $fitness;
	}

	public function  getFitness()	
	{
    	return this->fitness;
	}

	public function calcularFitness()
	{
	}

}