<?php

namespace Infrastructure;

use App\Repositories\FeeRepository;

class SubwayFeeRepository implements FeeRepository
{
    private const SUBWAY_FEES = [
        1 => 210,
        2 => 240,
        3 => 270,
        4 => 300
    ];
    
    public function getFeeByDistance(int $distance): int
    {
        return self::SUBWAY_FEES[$distance];
    }
}