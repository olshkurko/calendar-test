<?php


namespace App\Services;


use App\Entity\Birthday;
use App\Entity\Meeting;
use App\Entity\Order;
use App\Services\Model\BirthdayCalendarItems;
use App\Services\Model\MeetingCalendarItems;
use App\Services\Model\OrderCalendarItems;
use Doctrine\ORM\EntityManagerInterface;

class GetData
{

    public function __construct(EntityManagerInterface $em, BirthdayCalendarItems $birthdayCI, MeetingCalendarItems $meetingCI,
                                OrderCalendarItems $orderCI, Loader $loader, GetCalendar $calendar)
    {
        $this->em = $em;
        $this->loader = $loader;
        $this->calendar = $calendar;
        $this->birthdayCI = $birthdayCI;
        $this->meetingCI = $meetingCI;
        $this->orderCI = $orderCI;
    }

    public function getAllData()
    {
        $emptyCalendar = $this->calendar->get();
        $birthdays = $this->birthdayCI->convert($this->loader->getFromDB(Birthday::class));
        $meetings = $this->meetingCI->convert($this->loader->getFromDB(Meeting::class));
        $orders = $this->orderCI->convert($this->loader->getFromDB(Order::class));
        $apiOrders = $this->orderCI->convert($this->loader->getFromApi('orderApiData'));

        $data = array_merge($birthdays, $meetings, $orders, $apiOrders);

        return $this->addItems($emptyCalendar, $data);
    }


    public function addItems($calendar, $items)
    {
        foreach ($items as $item) {
            $calendar = $this->calendar->add($calendar, $item);
        }

        return $calendar;
    }

}
