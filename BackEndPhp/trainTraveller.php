<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
require_once 'DataBaseDetails.php';
class TrainTravelling
{    private $data;
    public function __construct()
    {
        $dataBaseDetails=new DataBaseDetails();
        $this->data = $dataBaseDetails->flightTravelling();
    }
    public function displayData()
    {
        echo $this->data;
    }
}
$TrainTravelling = new TrainTravelling();
$TrainTravelling->displayData();

