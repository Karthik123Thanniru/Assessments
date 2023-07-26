<?php
header("Access-Control-Allow-Origin: *");
require_once 'DataBaseDetails.php';
class FlightBooking
{
    private $data;
    public function __construct()
    {
        $dataBaseDetails=new DataBaseDetails();
        $this->data = $dataBaseDetails->flightBooking('flight_no');
    }
    public function displayData()
    {
        echo $this->data;
    }
}

$flightBooking = new FlightBooking();
$flightBooking->displayData();
