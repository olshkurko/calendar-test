<?php

namespace App\Factory;

use App\Entity\Order;
use DateTime;

class OrderFactory
{
    public function createFromApiResponse(array $apiItem): Order
    {
        return (new Order())
            ->setCreatedAt(new DateTime($apiItem['purchase_date']))
            ->setProductName($apiItem['name'])
            ->setPrice($apiItem['price'])
            ->setShippingInfo($apiItem['delivery_information'])
        ;
    }

    public function create(DateTime $createdAt, string $productName, float $price, string $shippingInfo)
    {
        return (new Order())
            ->setCreatedAt($createdAt)
            ->setProductName($productName)
            ->setPrice($price)
            ->setShippingInfo($shippingInfo)
        ;
    }
}
