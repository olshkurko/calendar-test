<?php


namespace App\Services;


use App\Entity\Birthday;
use App\Entity\Meeting;
use App\Entity\Order;
use Doctrine\ORM\EntityManagerInterface;

class GetData
{
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function getAllData()
    {

        $result = $this->getPeriod();
        $result = $this->getDataFromDB($result);
        $result = $this->getDataApi($result);
        $result = $this->getDataTxt($result);

        ksort($result);

        return $result;
    }

    public function getDataTxt($period)
    {
        $dataFromTXT = [];
        $result = $this->formatData($dataFromTXT, $period);

        return $result;
    }

    public function getDataApi($period)
    {
        $dataFromApi = [
            [
                'id' => 15,
                'name' => 'IPond mega',
                'delivery_information' => 'to pond use IPond! delivery is free!',
                'purchase_date' => '2050-12-01 17:59',
                'price' => '667',
            ],
            [
                'id' => 17,
                'name' => 'IPond mega XL',
                'delivery_information' => 'Delivery is not free!',
                'purchase_date' => '2050-01-31 17:30',
                'price' => '668',
            ],
        ];

        $result = $this->formatData($dataFromApi, $period);

        return $result;

    }

    public function getDataFromDB($period)
    {
        $result = [];

        $result = $this->formatData($this->em->getRepository(Birthday::class)->findAll(), $period);
        $result = $this->formatData($this->em->getRepository(Meeting::class)->findAll(), $result);
        $result = $this->formatData($this->em->getRepository(Order::class)->findAll(), $result);

        return $result;
    }

    public function getPeriod()
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


    public function formatData($entities, $period)
    {
        $result = [];

        foreach ($entities as $entity) {
            $calendarItem = new \stdClass();
            if ($entity instanceof Birthday) {
                $calendarItem->date = $entity->getDate()->format('Y-m-d');
                $calendarItem->title = 'Birthday ' . $entity->getFirstName() . ' ' . $entity->getLastName();
                $calendarItem->description = $entity->getAdditionalNotes();
                $period[$entity->getDate()->format('Y-m-d')]['birthday'] = $calendarItem;
            } elseif ($entity instanceof Meeting) {
                $calendarItem->date = $entity->getDate()->format('Y-m-d');
                $calendarItem->title = $entity->getTitle();
                $calendarItem->description = $entity->getDescription();
                $period[$entity->getDate()->format('Y-m-d')]['meeting'] = $calendarItem;
            } elseif ($entity instanceof Order) {
                $calendarItem->date = $entity->getCreatedAt()->format('Y-m-d');
                $calendarItem->title = $entity->getProductName() . ' Price: ' . $entity->getPrice();
                $calendarItem->description = $entity->getShippingInfo();
                $period[$entity->getCreatedAt()->format('Y-m-d')]['order'] = $calendarItem;
            } elseif (is_array($entity)) {
                $calendarItem->date = $entity['purchase_date'];
                $calendarItem->title = $entity['name'] . ' Price: ' . $entity['price'];
                $calendarItem->description = $entity['delivery_information'];
                $time = strtotime($entity['purchase_date']);
                $date = date('Y-m-d', $time);
                $period[$date]['api order'] = $calendarItem;
            } else {
                continue;
            }
        }

        return $period;
    }
}
