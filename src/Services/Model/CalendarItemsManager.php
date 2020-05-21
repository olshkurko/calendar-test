<?php


namespace App\Services\Model;


use App\Entity\Birthday;
use App\Services\Model\CalendarItem;
use phpDocumentor\Reflection\Types\Iterable_;


class CalendarItemsManager
{
    public function create($entity)
    {
    }

    public function convert($entities)
    {
        $items = [];
        foreach ($entities as $entity) {
            $items[] = $this->create($entity);
        }

        return $items;
    }
}
