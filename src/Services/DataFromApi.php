<?php


namespace App\Services;


class DataFromApi
{
  public function get($url) {
      return [
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
  }
}
