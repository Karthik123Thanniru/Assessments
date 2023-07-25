<?php
header("Access-Control-Allow-Origin: *");
require_once 'DataBaseDetails.php';
class BusBooking
{
    private $data;

    public function __construct()
    {
        $this->data = DataBaseDetails::busBooking('bus_no');
    }
    public function displayData()
    {
        echo $this->data;
    }
}

$busBooking = new BusBooking();

$busBooking->displayData();
