<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

require_once 'DataBaseDetails.php';
class FlightMode
{
    private $data;

    public function __construct()
    {
        $this->data = DataBaseDetails::getDetailsFromDb('flightMode');
    }
    public function displayData()
    {
        echo $this->data;
    }
}
$flightMode = new FlightMode();

$flightMode->displayData();
