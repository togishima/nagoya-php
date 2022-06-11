<?php

namespace App\UseCase;

use RuntimeException;

class CalculateFee {
    private const SUBWAY_FEES = [
        1 => 210,
        2 => 240,
        3 => 270,
        4 => 300
    ];

    private $definitions;

    public function calculate($definitions, $to, $from): int
    {
        $this->definitions = explode(',', $definitions);

        $distance = $this->getDistance($to, $from);

        return self::SUBWAY_FEES[$distance];
    }

    private function getDistance($toStation, $fromStation): int 
    {
        $from = $this->getUpStream($toStation, $fromStation);
        $to = $this->getDownStream($toStation, $fromStation);

        $distance = 0;
        for($i = $from; $i < $to; $i++) {
            if ($i === 0 || $i%2 === 0) {
                continue;
            }
            $distance += (int)$this->definitions[$i];
        }
        return $distance;
    }

    private function getUpStream($toStation, $fromStation):int
    {
        return $this->getIndex($toStation) < $this->getIndex($fromStation) 
            ? $this->getIndex($toStation) 
            : $this->getIndex($fromStation);
    }

    private function getDownStream($toStation, $fromStation):int
    {
        return $this->getIndex($toStation) > $this->getIndex($fromStation) 
            ? $this->getIndex($toStation) 
            : $this->getIndex($fromStation);
    }

    private function getIndex($target) {
        $index = array_search($target, $this->definitions);
        if ($index === false) {
            throw new RuntimeException('value not found in definitions');
        }
        return $index;
    }
}



