<?php


namespace App\Services;


class GetCalendar
{
    public function get()
    {
        $period = new \DatePeriod(
            new \DateTime('2050-12-01'),
            new \DateInterval('P1D'),
            new \DateTime('2050-12-31')
        );
        foreach ($period as $key => $value) {
            $month[$value->format('Y-m-d')] = [];
        }
        return $month;
    }

    public function add($calendar, $item)
    {
        $calendar[$item->date->format('Y-m-d')][$item->type] = $item;

        return  $calendar;
    }
}
