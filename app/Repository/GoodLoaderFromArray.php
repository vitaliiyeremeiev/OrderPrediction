<?php

namespace App\Repository;

use App\Entity\Good;

class GoodLoaderFromArray implements GoodLoaderServiceInterface
{
    public function __construct()
    {
    }

    public function getGoodById(int $gid): Good
    {
        $goods = [
            1 => 180,   // Biofinity (6 lenses)
            2 => 90,    // Biofinity (3 lenses)
            3 => 30,    // Focus Dailies (30 lenses)
        ];

        if (!isset($goods[$gid])) {
            throw new \Exception('The good with id ' . $gid . ' does not exist.');
        }

        return new Good($gid, $goods[$gid]);
    }
}