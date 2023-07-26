<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
require_once 'DataBaseDetails.php';
class BusTravelling
{    private $data;
    public function __construct()
    {
        $dataBaseDetails=new DataBaseDetails();
        $this->data = $dataBaseDetails->busTravelling();
    }
    public function displayData()
    {
        echo $this->data;
    }
}
$BusTravelling = new BusTravelling();
$BusTravelling->displayData();
