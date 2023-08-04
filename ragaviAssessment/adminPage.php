<?php
require_once 'pageCreator.php';
class Admin
{
    private $username;
    private $password;
    const servername = "localhost";
    const username = "root";
    const password = "Karthik@5039";
    const dbname = "spaceProject";
    private $conn;
    public function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
        try {
            $this->conn = new mysqli(self::servername, self::username, self::password, self::dbname);
            if ($this->conn->connect_error) {
                throw new Exception("Connection failed: " . $this->conn->connect_error);
            }
        } catch (Exception $e) {
            die("Error: " . $e->getMessage());
        }
    }
    public function isValidAdmin()
    {
        $adminUsername = 'admin';
        $adminPassword = 'admin';

        return ($this->username === $adminUsername && $this->password === $adminPassword);
    }
    public function spaceCreate($spaceName, $description)
    {
        $spaceName = $this->conn->real_escape_string($spaceName);
        $description = $this->conn->real_escape_string($description);

        $sql = "INSERT INTO spaces (spaceName, description) VALUES ('$spaceName', '$description')";

        if ($this->conn->query($sql) === TRUE) {
            echo "Space created successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . $this->conn->error;
        }
    }
    public function displaySpace()
    {
        $sql = "SELECT * FROM spaces";
        $result = $this->conn->query($sql);
        return $result;
    }
    public function pageInsert($page_description, $title)
    {
        $pageCreator = new PageCreator();
        $spaceId = $pageCreator->getSpaceId(); 

        $sql = "INSERT INTO pages (`content`, spaceId, `title`) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sis", $page_description, $spaceId, $title);

        if ($stmt->execute()) {
            return "Page created successfully!";
        } else {
            return "Error: " . $stmt->error;
        }
    }
}
?>
