<?php
require_once 'adminPage.php';
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $spaceName = htmlspecialchars($_POST["spaceName"]);
    $description = htmlspecialchars($_POST["description"]);
    $admin = new Admin("admin", "admin");
    $admin->spaceCreate($spaceName, $description);
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Admin Dashboard</title>
</head>

<body>
    <h2>Admin Dashboard</h2>
    <form method="post" action="">
        <label>Space Name:</label>
        <input type="text" name="spaceName" required><br>

        <label>Description:</label>
        <textarea name="description" rows="4" required></textarea><br>

        <input type="submit" name="submit" value="Create Space">
    </form>
</body>

</html>
