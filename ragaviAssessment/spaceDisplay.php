<?php
require_once 'adminPage.php';

$admin = new Admin("admin", "admin");
$result = $admin->displaySpace();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Display Spaces</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .space-block {
            width: 300px;
            border: 1px solid #ccc;
            padding: 10px;
            margin: 10px;
            border-radius: 5px;
            background-color: #f2f2f2;
            cursor: pointer; /* Add pointer cursor to indicate clickable elements */
        }

        .space-name {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .space-description {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <h2>Spaces</h2>
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $spaceId = $row["spaceId"];
            $spaceName = $row["spaceName"];
            $description = $row["description"];
            echo '<div class="space-block" onclick="goToPageCreator(' . $spaceId . ')">';
            echo '<div class="space-name">' . $spaceName . '</div>';
            echo '<div class="space-description">' . $description . '</div>';
            echo '</div>';
        }
    } else {
        echo "No spaces found.";
    }
    ?>

    <script>
        function goToPageCreator(spaceId) {
            window.location.href = 'pageCreator.php?id=' + spaceId;
        }
    </script>
</body>
</html> 
