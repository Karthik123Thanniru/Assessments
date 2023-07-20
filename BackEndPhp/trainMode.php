<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
$servername = "localhost";
$username = "root";
$password = "Ziffity#23";
$dbname = "employee";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = 'SELECT * FROM trainMode';
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
    echo json_encode($response);
} else {
    echo "0 results";
}
$conn->close();
?>