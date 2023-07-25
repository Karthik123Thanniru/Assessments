<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
require_once 'DataBaseDetails.php';
class BusMode
{    private $data;
    public function __construct()
    {
        $this->data = DataBaseDetails::getDetailsFromDb('busMode');
    }
    public function displayData()
    {
        echo $this->data;
    }
}
$BusMode = new BusMode();

$BusMode->displayData();
