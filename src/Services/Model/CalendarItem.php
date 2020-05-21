<?php


namespace App\Services\Model;


use DateTimeInterface;

final class CalendarItem
{
    public DateTimeInterface $date;

    public string $title;

    public string $description;

    public string $type;

   public function __construct($date, $title, $description, $type)
   {
       $this->date = $date;
       $this->title = $title;
       $this->description = $description;
       $this->type = $type;
   }
}
