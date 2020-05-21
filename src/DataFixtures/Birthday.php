<?php

namespace App\DataFixtures;

use App\Factory\BirthdayFactory;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class Birthday extends Fixture
{
    use GetRandomItemTrait;

    private BirthdayFactory $factory;

    public function __construct(BirthdayFactory $factory)
    {
        $this->factory = $factory;
    }

    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 5; ++$i) {
            $item = $this->factory->create(
                new DateTime('2050-12-'.rand(1, 31)),
                $this->getFirstName(),
                $this->getLastName(),
                $this->getAdditionalNotes()
            );

            $manager->persist($item);
        }

        $manager->flush();
    }

    private function getFirstName()
    {
        $data = [
            'Will',
            'Bill',
            'Bob',
            'Alfons',
            'Pedro',
        ];

        return $this->getRandomItem($data);
    }

    private function getLastName()
    {
        $data = [
            'Forrestman',
            'Smith',
            'Buritto',
            'Jones',
            'Moraes',
        ];

        return $this->getRandomItem($data);
    }

    private function getAdditionalNotes()
    {
        $data = [
            'The friend of mine!',
            'He\'s so old...',
            'Met this guy in 1920',
            'Congratulate him one day before',
            'Do not congratulate him!',
        ];

        return $this->getRandomItem($data);
    }
}
