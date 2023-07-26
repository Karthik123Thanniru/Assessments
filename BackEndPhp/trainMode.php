<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
require_once 'DataBaseDetails.php';
class TrainMode
{    private $data;
    public function __construct()
    {
        $dataBaseDetails = new DataBaseDetails();
        $this->data = $dataBaseDetails->getDetailsFromDb('trainMode');
    }
    public function displayData()
    {
        echo $this->data;
    }
}
$TrainMode = new TrainMode();
$TrainMode->displayData();
