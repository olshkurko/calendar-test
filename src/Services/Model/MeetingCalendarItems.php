<?php


namespace App\Services\Model;


use App\Entity\Birthday;
use App\Entity\Meeting;
use App\Services\Model\CalendarItem;

class MeetingCalendarItems extends CalendarItemsManager
{
    public function create($entity)
    {
        $date = $entity->getDate();
        $title = $entity->getTitle();
        $description = $entity->getDescription();
        $type = 'Meeting';

        return new CalendarItem($date, $title, $description, $type);
    }

}
