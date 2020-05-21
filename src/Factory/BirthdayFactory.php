<?php

namespace App\Factory;

use App\Entity\Birthday;
use DateTime;

class BirthdayFactory
{
    public function create(DateTime $date, string $firstName, string $lastName, string $additionalNotes)
    {
        return (new Birthday())
            ->setDate($date)
            ->setFirstName($firstName)
            ->setLastName($lastName)
            ->setAdditionalNotes($additionalNotes)
        ;
    }
}
