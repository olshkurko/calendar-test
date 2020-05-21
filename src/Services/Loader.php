<?php


namespace App\Services;


use App\Factory\OrderFactory;
use Doctrine\ORM\EntityManagerInterface;

class Loader
{
    public function __construct(EntityManagerInterface $em, DataFromApi $api, OrderFactory $factory)
    {
        $this->em = $em;
        $this->api = $api;
        $this->factory = $factory;
    }


    public function getFromDB($class)
    {
        return $this->em->getRepository($class)->findAll();
    }

    public function getFromApi($url)
    {
        $orders = [];
        $data = $this->api->get($url);
        foreach ($data as $item) {
            $orders[] = $this->factory->createFromApiResponse($item);
        }

        return $orders;
    }
}
