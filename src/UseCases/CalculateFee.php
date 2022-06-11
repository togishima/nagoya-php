<?php

namespace App\UseCases;

use App\Repositories\FeeRepository;
use App\Services\DistanceCalculator;

class CalculateFee {

    public function __construct(
        private FeeRepository $feeRepository,
        private DistanceCalculator $distanceCalculator
    ){}

    public function calculate($definitions, $to, $from): int
    {
        $distance = $this->distanceCalculator
            ->setDefinitions($definitions)
            ->calculateDistance($to, $from);

        return $this->feeRepository->getFeeByDistance($distance);
    }

    
}



