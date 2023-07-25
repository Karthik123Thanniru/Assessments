<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
require_once 'DataBaseDetails.php';
class FlightTravelling
{    private $data;
    public function __construct()
    {
        $this->data = DataBaseDetails::flightTravelling();
    }
    public function displayData()
    {
        echo $this->data;
    }
}
$FlightTravelling = new FlightTravelling();
$FlightTravelling->displayData();

