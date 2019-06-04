<?php

namespace App\Library\Darwin\Traits;

trait Core
{

	public function fileCsv($path){

		$file = fopen($path, 'r');

        $dataset = array();

        while (($line = fgetcsv($file)) !== FALSE)
        {
            $dataset[] = $line;
        }

        fclose($file);

        return $dataset;
	}

	public function calculateAverage($dataset)
	{

		$average = array('open' => 0,'high'=> 0, 'low' => 0, 
			'close' => 0, 'variant' => 0);

		$weight = 1;
        $mostCurrent = 0;

        foreach ($dataset as $line) {

            if($mostCurrent >= 25)
                $weight++;

            $average['open']  += $line[1] * $weight;
            $average['high']  += $line[2] * $weight;
            $average['low']   += $line[3] * $weight;
            $average['close'] += $line[4] * $weight;

            $mostCurrent++;

        }

        $average['variant'] = pow($average['open'] - $average['close'],2);
        $average['variant'] = sqrt($average['variant']);

        foreach ($average as $key => $value) {
            $average[$key]  /= count($dataset);
        }

		return $average;
	}

	public function calculateFitness($population, $media)
	{
        foreach ($population->getPopulation() as $chromosome) 
        {
         	$y = $chromosome->getChromosome()[0]->getAllele() + 
           	($chromosome->getChromosome()[1]->getAllele() * $media['open']);

           	$fitness = pow(($y - $media['close']), 2);
           	$fitness = sqrt($fitness);
           	$chromosome->setFitness($fitness);
        }
	}

	public function printResult($bestChromosome, $dataset)
	{  
        $close =array();
        $variant=array();
		$weight = array();

		foreach ($bestChromosome as $gene) {
                    array_push($weight,$gene->getAllele());
         }


        foreach ($dataset as $line) {

            $close[] = $weight[0] +
            ($weight[1] * $line[1]);

            // echo $close . " | " . $line[4] . " | " . ($close - $line[4]) . "<br/>";

        }

        for($i=0;$i<count($close);$i++) {

            $variant[] = $close[$i] - $dataset[$i][4];

            // echo $close . " | " . $line[4] . " | " . ($close - $line[4]) . "<br/>";

        }

        return compact('close','variant');

	}


}