<?php
session_start();

if (!isset($_GET['order_id'])) {
    echo "Invalid order ID.";
    exit;
}

$orderId = $_GET['order_id'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Method</title>
</head>
<body>
    <h2>Choose Payment Method</h2>
    <p>Order ID: <?= htmlspecialchars($orderId) ?></p>
    
    <form action="processPayment.php" method="POST">
        <input type="hidden" name="order_id" value="<?= htmlspecialchars($orderId) ?>">
        
        <div>
            <label for="payment_method">Select Payment Method:</label>
            <select name="payment_method" id="payment_method" required>
                <option value="credit_card">Credit Card</option>
                <option value="paypal">PayPal</option>
                <option value="cash_on_delivery">Cash on Delivery</option>
            </select>
        </div>

        <div>
            <button type="submit">Proceed to Pay</button>
        </div>
    </form>
</body>
</html>
