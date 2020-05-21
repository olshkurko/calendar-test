<?php

namespace App\DataFixtures;

use App\Factory\OrderFactory;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class Order extends Fixture
{
    use GetRandomItemTrait;

    private OrderFactory $factory;

    public function __construct(OrderFactory $factory)
    {
        $this->factory = $factory;
    }

    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 5; ++$i) {
            $item = $this->factory->create(
                new DateTime('2050-12-'.rand(1, 31)),
                $this->getProductName(),
                (float) rand(1, 9999),
                $this->getShippingInfoName()
            );

            $manager->persist($item);
        }

        $manager->flush();
    }

    private function getProductName(): string
    {
        $data = [
            'IShoes',
            'IGloves',
            'IBoots',
            'IHat',
            'IScarf',
        ];

        return $this->getRandomItem($data);
    }

    private function getShippingInfoName(): string
    {
        $data = [
            'Delivery is not free!',
            'Takeaway!',
            'By ITram tomorrow morning',
            'A bird will deliver it tomorrow!',
            '',
        ];

        return $this->getRandomItem($data);
    }
}
