<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
require_once 'DataBaseDetails.php';
class RegisteredDetails
{    private $data;
    public function __construct()
    {
        $dataBaseDetails=new DataBaseDetails();
        $this->data = $dataBaseDetails->registering();
    }
    public function displayData()
    {
        echo $this->data;
    }
}
$RegisteredDetails = new RegisteredDetails();
$RegisteredDetails->displayData();
