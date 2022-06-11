<?php

namespace App\Services;

use RuntimeException;

class DistanceCalculator
{
    public function setDefinitions($definitions)
    {
        $this->definitions = explode(',', $definitions);

        return $this;
    }

    public function calculateDistance($toStation, $fromStation): int 
    {
        $from = $this->getUpStreamIndex($toStation, $fromStation);
        $to = $this->getDownStreamIndex($toStation, $fromStation);

        $distance = 0;
        for($i = $from; $i < $to; $i++) {
            if ($i === 0 || $i%2 === 0) {
                continue;
            }
            $distance += (int)$this->definitions[$i];
        }
        return $distance;
    }

    private function getUpStreamIndex($toStation, $fromStation):int
    {
        $to = $this->getIndex($toStation);
        $from = $this->getIndex($fromStation);
        return $to < $from 
            ? $to 
            : $from;
    }

    private function getDownStreamIndex($toStation, $fromStation):int
    {
        $to = $this->getIndex($toStation);
        $from = $this->getIndex($fromStation);
        return $to > $from 
            ? $to 
            : $from;
    }

    private function getIndex($target) {
        $index = array_search($target, $this->definitions);
        if ($index === false) {
            throw new RuntimeException('value not found in definitions');
        }
        return $index;
    }
}