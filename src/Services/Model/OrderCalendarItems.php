<?php


namespace App\Services\Model;


use App\Entity\Birthday;
use App\Entity\Meeting;
use App\Entity\Order;
use App\Factory\OrderFactory;
use App\Services\Model\CalendarItem;

class OrderCalendarItems extends CalendarItemsManager
{
    public function create($entity)
    {
        $date = $entity->getCreatedAt();
        $title = $entity->getProductName() . ' Price: ' . $entity->getPrice();
        $description = $entity->getShippingInfo();
        $type = 'Order';

        return new CalendarItem($date, $title, $description, $type);
    }

}
