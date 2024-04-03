<?php

namespace App\Strategy;

interface OrderIntervalStrategy
{
    public function getInterval(array $intervals): int;
}