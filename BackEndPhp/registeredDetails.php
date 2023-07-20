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
$response = array();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $newPassword = $_POST["newPassword"];
    $checkQuery = "SELECT * FROM registeredDetails WHERE username = '$username'";
    $checkResult = $conn->query($checkQuery);
    if ($checkResult->num_rows > 0) {
        $response["status"] = "exists";
    } else {
        $sql = "INSERT INTO registeredDetails (username, pass_word, new_password)
                VALUES ('$username', '$password', '$newPassword')";
        if ($conn->query($sql) === TRUE) {
            $response["status"] = "success";
        } else {
            $response["status"] = "error";
            $response["message"] = "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
$conn->close();
echo json_encode($response);
?>

