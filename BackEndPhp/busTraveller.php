<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
require_once 'DataBaseDetails.php';
class BusTravelling
{    private $data;
    public function __construct()
    {
        $this->data = DataBaseDetails::busTravelling();
    }
    public function displayData()
    {
        echo $this->data;
    }
}
$BusTravelling = new BusTravelling();
$BusTravelling->displayData();
