<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");
require_once 'DataBaseDetails.php';

class RegisteredDetailsAPI
{
    public  function getData()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST["username"];
            $password = $_POST["password"];
            $dataBaseDetails=new DataBaseDetails();
            $conn = $dataBaseDetails->getConnection();
            $sql = "SELECT * FROM registeredDetails WHERE username = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $data = $result->fetch_assoc();
                $hashedPassword = $data['pass_word'];

                if (password_verify($password, $hashedPassword)) {
                    echo json_encode(array("status" => "success"));
                } else {
                    echo json_encode(array("status" => "error", "message" => "Username and password do not match."));
                }
            } else {
                echo json_encode(array("status" => "error", "message" => "Username not found."));
            }

            $stmt->close();
          
        }
    }
}
$RegisteredDetails=new RegisteredDetailsAPI();
$RegisteredDetails->getData();
