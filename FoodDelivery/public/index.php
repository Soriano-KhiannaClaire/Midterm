<?php
session_start();

if (isset($_SESSION['customer_id'])) {
    $customer_id = $_SESSION['customer_id'];
} else {
    $customer_id = null; 
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Food Delivery System</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="../assets/styles.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="index.php">Food Delivery</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <?php if (isset($_SESSION['username'])): ?>
                <li class="nav-item">
                    <a class="nav-link" href="menu.php">Restaurants</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="cart.php">Cart</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="checkout.php">Checkout</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            <?php else: ?>
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="signup.php">Sign Up</a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>

<div class="container mt-5">
    <div class="jumbotron text-center">
        <h1 class="display-4">Welcome to Our Food Delivery System</h1>
        <p class="lead">Discover delicious meals from top restaurants and get them delivered quickly.</p>
        <hr class="my-4">

        <?php if (isset($_SESSION['username'])): ?>
            <h4>Hello, <?= htmlspecialchars($_SESSION['username']) ?>!</h4>
            <a href="menu.php" class="btn btn-primary btn-lg mt-3">Explore Restaurants</a>
            <a href="cart.php" class="btn btn-secondary btn-lg mt-3">View Cart</a>
        <?php else: ?>
            <a href="login.php" class="btn btn-success btn-lg mt-3">Login</a>
            <a href="signup.php" class="btn btn-info btn-lg mt-3">Sign Up</a>
        <?php endif; ?>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
