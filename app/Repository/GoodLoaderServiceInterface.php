<?php

namespace App\Repository;

use App\Entity\Good;

interface GoodLoaderServiceInterface
{
    public function getGoodById(int $gid): Good;
}