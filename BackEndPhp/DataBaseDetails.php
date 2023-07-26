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
    private $conn;
    public function __construct()
    {
        try {
            $this->conn = new mysqli(self::servername, self::username, self::password, self::dbname);
            if ($this->conn->connect_error) {
                throw new Exception("Connection failed: " . $this->conn->connect_error);
            }
        } catch (Exception $e) {
            die("Error: " . $e->getMessage());
        }
    }
    public function getConnection()
    {
        return $this->conn;
    }


    public function getDetailsFromDb($mode)
    {
        try {
            $sql = "SELECT * FROM {$mode}";
            $result = $this->conn->query($sql);

            if ($result === false) {
                throw new Exception("Error executing the query: " . $this->conn->error);
            }
            if ($result->num_rows > 0) {
                $data = array();
                $destination = array();
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
        } catch (Exception $e) {
            return json_encode(array("error" => $e->getMessage()));
        }
    }

    public  function busBooking($travel)
    {
        $travellingMode=new TravellingMode();
        return $travellingMode->travelling($travel, 'busMode', 'bus_no');
    }

    public  function flightBooking($travel)
    {
        $travellingMode=new TravellingMode();
        return $travellingMode->travelling($travel, 'flightMode', 'flight_no');
    }

    public  function trainBooking($travel)
    {
        $travellingMode=new TravellingMode();
        return $travellingMode->travelling($travel, 'trainMode', 'train_no');
    }

    public  function busTravelling()
    {
        return $this->selectData('busMode', 'bus_no');
    }

    public  function flightTravelling()
    {
        return $this->selectData('flightMode', 'flight_no');
    }

    public  function trainTravelling()
    {
        return $this->selectData('trainMode', 'train_no');
    }


    public function registering()
    {
        $response = array();
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST["username"];
            $password = $_POST["password"];
            $encrypPass = password_hash($password, PASSWORD_BCRYPT);

            try {
                $checkQuery = "SELECT * FROM registeredDetails WHERE username = '$username'";
                $checkResult = $this->conn->query($checkQuery);

                if ($checkResult === false) {
                    throw new Exception("Error executing the query: " . $this->conn->error);
                }

                if ($checkResult->num_rows > 0) {
                    $response["status"] = "exists";
                } else {
                    $sql = "INSERT INTO registeredDetails (username, pass_word, new_password)
                            VALUES ('$username','$encrypPass', ' $encrypPass')";
                    if ($this->conn->query($sql) === TRUE) {
                        $response["status"] = "success";
                    } else {
                        throw new Exception("Error inserting data: " . $this->conn->error);
                    }
                }
            } catch (Exception $e) {
                $response["status"] = "error";
                $response["message"] = $e->getMessage();
            }
        }
        return json_encode($response);
    }

    public  function selectData($mode, $modeNumber)
    {
        try {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $departure = $_POST["departure"];
                $destination = $_POST["destination"];
                $sql = "SELECT * FROM $mode WHERE destination_from = '$departure' AND destination_to = '$destination'";
                $result = $this->conn->query($sql);
    
                if ($result === false) {
                    throw new Exception("Error executing the query: " . $this->conn->error);
                }
    
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
        } catch (Exception $e) {
            return json_encode(array("error" => $e->getMessage()));
        }
    }
}
