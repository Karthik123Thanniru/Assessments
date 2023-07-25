<?php

header("Access-Control-Allow-Origin: *");
require_once 'DataBaseDetails.php';
class TrainBooking
{
    private $data;

    public function __construct()
    {
        $this->data = DataBaseDetails::trainBooking('train_no');
    }
    public function displayData()
    {
        echo $this->data;
    }
}

$TrainBooking = new TrainBooking();
$TrainBooking->displayData();
