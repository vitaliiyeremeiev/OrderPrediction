<?php

namespace App\Strategy;

class MaxOrderInterval implements OrderIntervalStrategy
{
    public function getInterval(array $intervals): int
    {
        return max($intervals);
    }
}