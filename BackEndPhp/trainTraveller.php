<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
$servername = "localhost";
$username = "root";
$password = "Ziffity#23";
$dbname = "employee";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $departure = $_POST["departure"];
    $destination = $_POST["destination"];
    $currentTime = $_POST["currentTime"];
    $sql = "SELECT * FROM trainMode WHERE destination_from = '$departure' AND destination_to = '$destination'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $response = array();  
        while ($row = $result->fetch_assoc()) {
            $response[] = array(
                "train_no" => $row["train_no"],
                "destination_from" => $row["destination_from"],
                "destination_to" => $row["destination_to"],
                "days" => $row["days"],
                "timings" => $row["timings"],
                "amount" => $row["amount"]
            );
        }     
        echo json_encode($response);
    } else {
        echo json_encode(array("error" => "No train details found for the given departure and destination."));
    }
} else {
    echo json_encode(array("error" => "Invalid request method"));
}
$conn->close();
?>
