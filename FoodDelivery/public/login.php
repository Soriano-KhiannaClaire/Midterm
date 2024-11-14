<?php
include_once '../config/database.php';
include_once '../classes/Customer.php';

session_start(); 

$database = new Database();
$db = $database->getConnection();

if ($_POST) {
    $customer = new Customer($db);
    $customer->username = $_POST['username'];
    $customer->password = $_POST['password'];
    
    if ($customer->login()) {
        $_SESSION['customer_id'] = $customer->id; 
        $_SESSION['username'] = $customer->username; 
        
        header("Location: menu.php"); 
        exit(); 
    } else {
        echo "Login failed!";
    }
}
?>

<form method="post">
    Username: <input type="text" name="username" required><br>
    Password: <input type="password" name="password" required><br>
    <button type="submit">Login</button>
</form>
