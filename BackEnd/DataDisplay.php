<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
$servername = "localhost";
$username = "root";
$password = "Karthik@5039";
$dbname = "registeredDetails";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = 'SELECT * FROM userDetails';
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $data = array();
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    echo json_encode($data);
} else {
    echo "0 results";
}

$conn->close();
?>
