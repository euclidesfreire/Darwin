public function index(){
    	$population = new Population(256);
        $fitness = 0;

    	// $avaliacao = new Avaliacao();

    	$cromo = array();

    	for($i=0; $i<256; $i++){
    		$g = array();
    		for($j=0; $j<10; $j++){
    			array_push($g, Random::randomFloat(0, 1,2));
    		}
    		array_push($cromo, $g);
    	}

    	$population->init($cromo,10);


        $q = array(0.54, 0.15, 1.0, 0.77, 0.88, 0.59, 0.36, 0.02, 0.75, 0.10
    );

    	$geracao = 1;


    	while ($geracao <= 504) {


            foreach ($population->getPopulation() as $chromosome) {
                $i = 0;
                $fitness = 0;
                foreach ($chromosome->getChromosome() as $gene) {
                    $fitness += pow($gene->getAllele() - $q[$i], 2);
                    $i++;
                }
                $fitness = sqrt($fitness);
                $chromosome->setFitness($fitness);
            }

            $selF = false;
            $selCromossomo;

            foreach ($population->getPopulation() as $chromosome) {
                if($selF == false){
                    $selCromossomo = $chromosome;
                    $selF = true;
                } else if($chromosome->getFitness() < $selCromossomo->getFitness()) {
                    $selCromossomo = $chromosome;
                }
            }


            $population->crossover();

            $population->mutation();

            $escolha = rand(0, 255);

            $population->getPopulation()[$escolha]->setChromosome($selCromossomo->getChromosome());


            $geracao++;

        }

        $selF = false;
        $selCromossomo;

        foreach ($population->getPopulation() as $chromosome) {
                if($selF == false){
                    $selCromossomo = $chromosome;
                    $selF = true;
                } else if($chromosome->getFitness() < $selCromossomo->getFitness()) {
                    $selCromossomo = $chromosome;
                }
        }

        foreach ($selCromossomo->getChromosome() as $gene) {
                    echo $gene->getAllele() .  "  |  ";
         }


    }

<?php

namespace App\Http\Controllers;

use App\Library\Darwin\Population;
use App\Library\Darwin\Chromosome;
use App\Library\Darwin\Gene;
use App\Library\Random\Random;
use App\Library\Darwin\Traits\Core;


class HomeController extends Controller
{

    use Core;

    public function index()
    {

        $dataset = $this->fileCsv('historyfinance/BIDI4.SA.csv');

        $media = $this->calculateAverage($dataset);

        $parameters = array(
            'size' => 100,
            'geracao' => 200,
            'min' => 0,
            'max' => 1,
            'mutationRate' => 0.05,
            'mutationMin' => 0.0,
            'mutationMax' => 0.2,
            'crossoverRate' => 0.8,
            'functionFitness' => 'negative',
            'RandomDecimals' => 2,
            'chromosomeSize' => 2,
        );

        $population = new Population($parameters);

        $size = array('population' => $parameters['size'], 
            'chromosome' => $parameters['chromosomeSize']);

        $populationReal = $population->populationReal($size,0,1,2);

        $population->init($populationReal,$parameters['chromosomeSize']);

        $geracao = 1;


        while ($geracao <= $parameters['geracao']) {

            $this->calculateFitness($population, $media);

            $population->arithmeticCrossover();
            //$population->crossover();

            $population->mutation();

            $geracao++;

        }



        $bestChromosome = $population->bestChromosome();

        $this->printResult($bestChromosome, $dataset);



    }
}