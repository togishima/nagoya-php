<?php

use App\UseCase\CalculateFee;
use PHPUnit\Framework\TestCase;

class TestCalculateFee extends TestCase
{
    public function setUp(): void
    {
        $this->testData = [
            ['A,1,B,2,C|A|B', 210],
            ['A,1,B,2,C|A|C', 270],
            ['W,1,X,1,Y,2,Z|W|X', 210],
            ['W,1,X,1,Y,2,Z|W|Y', 240],
            ['W,1,X,1,Y,2,Z|Z|X', 270],
        ];
        $this->calculator = new CalculateFee();
    }

    /**
     * @test
     */
    public function basicCalculation()
    {
        foreach($this->testData as $testCase) {
            [$definitions, $to, $from] = explode('|', $testCase[0]);
            $calculated_fee = $this->calculator->calculate($definitions, $to, $from);
            $this->assertTrue($calculated_fee === $testCase[1]);
        }
    }
}