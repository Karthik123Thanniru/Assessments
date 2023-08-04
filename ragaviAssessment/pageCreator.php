<?php
class PageCreator
{
    private $spaceId;
    
    public function __construct()
    {
        if (isset($_GET['id'])) {
            $this->spaceId = $_GET['id'];
        } else {
            echo "Error in getting id.";
        }
    }
    
    public function getSpaceId()
    {
        return $this->spaceId;
    }
    
    
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Page Creator</title>
</head>
<body>
    <h2>Page Creator</h2>
    <?php
    $pageCreator = new PageCreator();
    $spaceId = $pageCreator->getSpaceId();

    if ($spaceId) {
        echo "Space ID: " . $spaceId;
    } else {
        echo "Space ID not provided.";
    }
    ?>
    <form method="post" action="formPage.php">
        <input type="submit" value="Create Page">
    </form>
</body>
</html>
