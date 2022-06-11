<?php

namespace App\Repositories;

interface FeeRepository
{
    /**
     * Get fees
     *
     * @return int
     */
    public function getFeeByDistance(int $distance): int;
}