<?php

namespace Tests\unit;

use App\PredictionService;
use App\Repository\GoodLoaderFromArray;
use App\Strategy\MinOrderInterval;
use PHPUnit\Framework\TestCase;

class PredictionServiceTest extends TestCase
{
    /**
     * @test
     * @dataProvider testPredictNextOrderDataProvider
     *
     * @return void
     */
    public function testPredictNextOrderDate($orders, $expected)
    {
        $predictions = (new PredictionService())->predictNextOrder(
            $orders,
            new GoodLoaderFromArray,
            new MinOrderInterval
        );

        $this->assertEquals($expected, $predictions[0]['date']);
    }

    private function testPredictNextOrderDataProvider()
    {
        return [
            [
                $this->getOrdersCollection1(), '2017-03-21'
            ],
            [
                $this->getOrdersCollection2(), '2015-05-31'
            ],
            [
                $this->getOrdersCollection3(), '2015-01-28'
            ]
        ];
    }

    private function getOrdersCollection1()
    {
        return [
            '2015-04-01' => [
                [1, 2, '-2.00'],
                [1, 2, '-3.00'],
            ],
        ];
    }

    private function getOrdersCollection2()
    {
        return [
            '2014-10-01' => [
                [3, 2, '-1.50'],
                [3, 2, '-3.50'],
            ],
            '2015-01-01' => [
                [3, 2, '-1.50'],
                [3, 2, '-3.50'],
            ],
            '2015-04-15' => [
                [3, 1, '-1.50'],
                [3, 1, '-3.50'],
            ],
        ];
    }

    private function getOrdersCollection3()
    {
        return [
            '2014-08-01' => [
                [2, 2, '+0.50'],
            ]
        ];
    }
}

