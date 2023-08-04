<?php
require_once 'adminPage.php';

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $admin = new Admin($username, $password);
    if ($admin->isValidAdmin()) {
        header('Location: admin_dashboard.php');
        exit;
    } else {
        $errorMessage = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Admin Login</title>
</head>

<body>
    <h2>Admin Login</h2>
    <?php if (isset($errorMessage)) : ?>
        <p style="color: red;"><?php echo $errorMessage; ?></p>
    <?php endif; ?>
    <form method="post" action="">
        <label>Username:</label>
        <input type="text" name="username" required><br>
        <br>
        <label>Password:</label>
        <input type="password" name="password" required><br>
        <br>
        <input type="submit" name="submit" value="Login">
    </form>
</body>

</html>
