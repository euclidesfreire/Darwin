<?php

namespace App\Library\Darwin;

class Gene
{
	private $allele;

	public function __construct($allele)
	{
		$this->allele = $allele;
	}

	public function setAllele($allele)
	{
		$this->allele = $allele;
	}

	public function getAllele()
	{
		return $this->allele;
	}
}