<?php

namespace App\Factory;

use App\Entity\Meeting;
use DateTime;

class MeetingFactory
{
    public function create(DateTime $date, string $title, string $description)
    {
        return (new Meeting())
            ->setDate($date)
            ->setTitle($title)
            ->setDescription($description)
        ;
    }
}
