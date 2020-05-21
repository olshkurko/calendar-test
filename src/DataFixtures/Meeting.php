<?php

namespace App\DataFixtures;

use App\Factory\MeetingFactory;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class Meeting extends Fixture
{
    use GetRandomItemTrait;

    private MeetingFactory $factory;

    public function __construct(MeetingFactory $factory)
    {
        $this->factory = $factory;
    }

    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 5; ++$i) {
            $item = $this->factory->create(
                new DateTime('2050-12-'.rand(1, 31)),
                $this->getTitle(),
                $this->getDescription()
            );

            $manager->persist($item);
        }

        $manager->flush();
    }

    private function getTitle()
    {
        $data = [
            'Hunting a bear',
            'Celebrating my birthday',
            'Buying IPond',
            'Playing football',
            'Sleeping',
        ];

        return $this->getRandomItem($data);
    }

    private function getDescription()
    {
        $data = [
            'Hunt a bear to... hunt a bea',
            'Just to buy an IPond as a gift',
            'Buy a the best bed in the world!',
            'Score as many times as you can',
            'Do nothing at all...',
        ];

        return $this->getRandomItem($data);
    }
}
