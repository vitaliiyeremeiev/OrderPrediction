<?php

namespace App\Strategy;

class AvgOrderInterval implements OrderIntervalStrategy
{
    public function getInterval(array $intervals): int
    {
        return floor(array_sum($intervals)/count($intervals));
    }
}