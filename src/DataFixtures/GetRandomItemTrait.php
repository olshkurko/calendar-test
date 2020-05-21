<?php

namespace App\DataFixtures;

trait GetRandomItemTrait
{
    private function getRandomItem(array $data)
    {
        return $data[rand(0, count($data) - 1)];
    }
}
