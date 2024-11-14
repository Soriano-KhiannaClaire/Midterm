<?php
session_start();
include_once '../config/database.php';
include_once '../classes/MenuItem.php';

$database = new Database();
$db = $database->getConnection();
$menuItem = new MenuItem($db);

// Ensure cart session is initialized
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if (isset($_GET['action'])) {
    $action = $_GET['action'];

    if ($action == 'add' && isset($_GET['id'])) {
        $itemId = $_GET['id'];

        // Fetch menu item details by ID
        $menuItemDetails = $menuItem->getMenuItemById($itemId);

        if ($menuItemDetails) {
            // Add the item to the cart session with valid 'id', 'name', 'price'
            $_SESSION['cart'][] = [
                'id' => $menuItemDetails['id'],  // Ensure 'id' is set properly
                'name' => $menuItemDetails['name'],
                'price' => $menuItemDetails['price'],
                'quantity' => 1  // Default quantity is 1
            ];
        } else {
            echo "Item not found!";
        }
    } elseif ($action == 'remove' && isset($_GET['id'])) {
        $itemId = $_GET['id'];

        // Remove the item from the cart
        $_SESSION['cart'] = array_filter($_SESSION['cart'], function($item) use ($itemId) {
            return $item['id'] != $itemId;
        });

        // Re-index the array after filtering
        $_SESSION['cart'] = array_values($_SESSION['cart']);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2>Your Cart</h2>

    <?php if (empty($_SESSION['cart'])) { ?>
        <p>Your cart is empty.</p>
    <?php } else { ?>
        <ul class="list-group">
            <?php foreach ($_SESSION['cart'] as $item) { 
                if (is_array($item) && isset($item['id'], $item['name'], $item['price'])) { ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <?= htmlspecialchars($item['name']) ?> - $<?= number_format($item['price'], 2) ?>
                        <a href="cart.php?action=remove&id=<?= $item['id'] ?>" class="btn btn-danger btn-sm">Remove</a>
                    </li>
                <?php } else {
                    echo "Invalid item data";
                }
            } ?>
        </ul>
    <?php } ?>

    <div class="mt-4">
        <a href="menu.php" class="btn btn-secondary">Back to Menu</a>
        <a href="checkout.php" class="btn btn-primary">Proceed to Checkout</a>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
