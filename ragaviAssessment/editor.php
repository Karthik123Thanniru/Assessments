<?php
header("Access-Control-Allow-Origin: *");
require_once 'adminPage.php';
print_r($_POST["toolbox"]);
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['publish'])) {
    $page_description = $_POST["toolbox"];
    $title = $_POST["page_title"];
    $admin = new Admin("admin", "admin");
    $result = $admin->pageInsert($page_description, $title);
    echo $result;
}

?>
