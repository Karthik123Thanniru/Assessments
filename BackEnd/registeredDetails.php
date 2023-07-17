<?php
$servername = "localhost";
$username = "root";
$password = "Karthik@5039";
$dbname = "registeredDetails";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $newPassword = $_POST["newPassword"];
    $checkQuery = "SELECT * FROM userDetails WHERE username = '$username'";
    $checkResult = $conn->query($checkQuery);
    if ($checkResult->num_rows > 0) {
        echo "exists";
    } else {
        $sql = "INSERT INTO userDetails (username, pass_word, new_password)
                VALUES ('$username', '$password', '$newPassword')";
        if ($conn->query($sql) === TRUE) {
            echo "success";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
$conn->close();
?>
