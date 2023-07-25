<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
require_once 'DataBaseDetails.php';
class TravellingMode
{

public static function travelling($travel,$mode,$modeNo)
{
    $conn = DataBaseDetails::connection();
    if (isset($_GET[$travel])) {
        $travelNumber = $_GET[$travel]; 
        $stmt = $conn->prepare("SELECT * FROM $mode WHERE bus_no = ?");
        $stmt->bind_param("s", $travelNumber);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $response = array();
            while ($row = $result->fetch_assoc()) {
                $response[] = array(
                    $modeNo => $row[$modeNo],
                    "destination_from" => $row["destination_from"],
                    "destination_to" => $row["destination_to"],
                    "days" => $row["days"],
                    "timings" => $row["timings"],
                    "amount" => $row["amount"]
                );
            }
            return json_encode($response); // Return the JSON response as a string
        } else {
            return json_encode(array("error" => "No bus data found for the given bus number."));
        }
      
    } else {
        return json_encode(array("error" => "Bus number not provided."));
    }
}
}