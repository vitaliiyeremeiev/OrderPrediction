<?php

namespace App\Entity;

class Good
{
    public function __construct(
        private int $id,
        private int $duration
    )
    {

    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getDuration(): int
    {
        return $this->duration;
    }
}