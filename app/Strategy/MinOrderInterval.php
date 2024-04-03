<?php

namespace App\Strategy;

class MinOrderInterval implements OrderIntervalStrategy
{
    public function getInterval(array $intervals): int
    {
        return min($intervals);
    }
}