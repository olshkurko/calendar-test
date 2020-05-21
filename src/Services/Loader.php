<?php


namespace App\Services;


use App\Entity\Birthday;
use App\Entity\Meeting;
use App\Entity\Order;
use Doctrine\ORM\EntityManagerInterface;

class Loader
{
    public function __construct(GetData $data)
    {
        $this->data = $data;
    }

    public function load ()
    {
        return $this->data->getAllData();
    }

}
