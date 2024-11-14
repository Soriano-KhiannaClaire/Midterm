<?php
include_once '../config/database.php';
include_once '../classes/Customer.php';

$database = new Database();
$db = $database->getConnection();

if ($_POST) {
    $customer = new Customer($db);
    $customer->username = $_POST['username'];
    $customer->password = $_POST['password'];
    $customer->email = $_POST['email'];
    $customer->signup();
    header("Location: login.php");
}
?>

<form method="post">
    Username: <input type="text" name="username" required><br>
    Password: <input type="password" name="password" required><br>
    Email: <input type="email" name="email" required><br>
    <button type="submit">Sign Up</button>
</form>
