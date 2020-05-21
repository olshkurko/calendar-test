<?php


namespace App\Services\Model;


use App\Entity\Birthday;
use App\Services\Model\CalendarItem;

class BirthdayCalendarItems extends CalendarItemsManager
{
    public function create($entity)
    {
        $date = $entity->getDate();
        $type = 'Birthday';
        $title = 'Birthday ' . $entity->getFirstName() . ' ' . $entity->getLastName();;
        $description = $entity->getAdditionalNotes();

        return new CalendarItem($date, $title, $description, $type);
    }


}
