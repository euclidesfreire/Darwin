<?php

namespace App\Library\Darwin;

use App\Library\Darwin\Gene; 

class Chromosome
{
	private $chromosome;
	private $fitness;
	private $size;

	public function __construct($chromosomeSize)
	{
		$this->chromosome = array();
		$this->fitness = 0;
		$this->size = $chromosomeSize;
	}

	public function setChromosome($chromosome)
	{
		$this->chromosome = $chromosome;
	}

	public function getChromosome()
	{
		return $this->chromosome;	
	}

	public function setFitness($fitness)
	{
		$this->fitness = $fitness;
	}

	public function getFitness()
	{
		return $this->fitness;	
	}

	public function setSize($size)
	{
		$this->size = $size;
	}

	public function getSize()
	{
		return $this->size;	
	}

	public function add($gene)
	{

		array_push($this->chromosome, $gene);
	}

	public function init($chromosome)
	{
		foreach ($chromosome as $gene)
		{
			$newGene = new Gene($gene);
			$this->add($newGene);
		}
	}

}