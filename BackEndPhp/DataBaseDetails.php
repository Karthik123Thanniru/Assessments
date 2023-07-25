<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
require_once 'TravellingMode.php';
class DataBaseDetails
{
    const servername = "localhost";
   const username = "root";
    const password = "Ziffity#23";
    const dbname = "employee";
    public static function connection()
    {
        $conn = new mysqli(self::servername, self::username, self::password,self:: dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        return $conn;    
    }
    public static function getDetailsFromDb($mode)
    {
        $conn = self::connection();

        $sql = "SELECT * FROM {$mode}";

        $result = $conn->query($sql);
    if ($result->num_rows > 0) {
    $data = array();
    $destination=array();
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
        $destination[] = $row['destination_from']; 
        $destination[] = $row['destination_to']; 
    }
    $response = array(
        'data' => $data,
        'destination' => array_unique($destination)
    );
    return json_encode($response);
    
    } else {
    return "0 results";
    }
    }
    public static function busBooking($travel)
    {
      
     return TravellingMode::travelling($travel,'busMode','bus_no');
    }
    public static  function flightBooking($travel)
{
    return TravellingMode::travelling($travel,'flightMode','flight_no');
}
public static function trainBooking($travel)
{
    return TravellingMode::travelling($travel,'trainMode','train_no');
}
public static function busTravelling()
{
    return self::selectData('busMode','bus_no');

}
public static function flightTravelling()
{
    return self::selectData('flightMode','flight_no');
}
public static function trainTravelling()
{

    return self::selectData('trainMode','train_no');
}
public static function registering()
{
    $conn = self::connection();
    $response = array();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $newPassword = $_POST["newPassword"];
    $encrypPass=password_hash($password,PASSWORD_BCRYPT);
    $checkQuery = "SELECT * FROM registeredDetails WHERE username = '$username'";
    $checkResult = $conn->query($checkQuery);
    if ($checkResult->num_rows > 0) {
        $response["status"] = "exists";
    } else {
        $sql = "INSERT INTO registeredDetails (username, pass_word, new_password)
                VALUES ('$username','$encrypPass', ' $encrypPass')";
        if ($conn->query($sql) === TRUE) {
            $response["status"] = "success";
        } else {
            $response["status"] = "error";
            $response["message"] = "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
$conn->close();
return json_encode($response);
} 
public static function selectData($mode,$modeNumber)
{
    $conn = self::connection();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $departure = $_POST["departure"];
        $destination = $_POST["destination"];
        $sql = "SELECT * FROM $mode WHERE destination_from = '$departure' AND destination_to = '$destination'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $response = array();  
            while ($row = $result->fetch_assoc()) {
                $response[] = array(
                    $modeNumber => $row[$modeNumber],
                    "destination_from" => $row["destination_from"],
                    "destination_to" => $row["destination_to"],
                    "days" => $row["days"],
                    "timings" => $row["timings"],
                    "amount" => $row["amount"]
                );
            }    
           return json_encode($response);
        } else {
           return json_encode(array("error" => "No Bus details found for the given departure and destination."));
        }
    } else {
       return json_encode(array("error" => "Invalid request method"));
    }
}
}
