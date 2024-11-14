<?php
session_start();

if (empty($_SESSION['cart'])) {
    echo "Your cart is empty. Please add items to your cart before checking out.";
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
</head>
<body>
    <h2>Checkout</h2>
    <p>Proceed with your order. Below are the items in your cart:</p>

    <ul>
        <?php foreach ($_SESSION['cart'] as $item) { ?>
            <li><?= htmlspecialchars($item['name']) ?> - $<?= number_format($item['price'], 0) ?></li>
        <?php } ?>
    </ul>

    <form method="POST" action="placeOrder.php">
        <button type="submit">Place Order</button>
    </form>
</body>
</html>
