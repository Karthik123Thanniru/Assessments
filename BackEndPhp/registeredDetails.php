<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
require_once 'DataBaseDetails.php';
class RegisteredDetails
{    private $data;
    public function __construct()
    {
        $this->data = DataBaseDetails::registering();
    }
    public function displayData()
    {
        echo $this->data;
    }
}
$RegisteredDetails = new RegisteredDetails();
$RegisteredDetails->displayData();
