<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Library\Darwin\Population;
use App\Library\Darwin\Chromosome;
use App\Library\Darwin\Gene;
use App\Library\Random\Random;
use App\Library\Darwin\Traits\Core;


class HomeController extends Controller
{

    use Core;

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function oracle(Request $request)
    {

        $dataset = $this->fileCsv('historyfinance/'. $request->acao . '.SA.csv');

        $media = $this->calculateAverage($dataset);

        $parameters = array(
            'size' => 256,
            'geracao' => 1024,
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

            //$population->arithmeticCrossover();
            $population->crossover();

            $population->mutation();

            $geracao++;

        }



        $bestChromosome = $population->bestChromosome();

        $close = $this->printResult($bestChromosome, $dataset);

        return view('oracle', ['close' => $close['close'], 'variant' => $close['variant'], 'dataset' => $dataset, 'datasetSize' => count($dataset), ]);

    }
}
