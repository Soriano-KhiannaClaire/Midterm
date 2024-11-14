<?php
session_start();

if (!isset($_POST['order_id']) || !isset($_POST['payment_method'])) {
    echo "Invalid request.";
    exit;
}

$orderId = $_POST['order_id'];
$paymentMethod = $_POST['payment_method'];

// Process payment (for now just simulating it)
switch ($paymentMethod) {
    case 'credit_card':
        // Simulate credit card payment processing
        echo "Processing Credit Card Payment for Order ID: " . htmlspecialchars($orderId);
        break;

    case 'paypal':
        // Simulate PayPal payment processing
        echo "Redirecting to PayPal for Order ID: " . htmlspecialchars($orderId);
        break;

    case 'cash_on_delivery':
        // Simulate cash on delivery option
        echo "You selected Cash on Delivery for Order ID: " . htmlspecialchars($orderId);
        break;

    default:
        echo "Unknown payment method.";
        break;
}

// After processing payment, you can update the order status in the database and provide confirmation to the user.
?>
