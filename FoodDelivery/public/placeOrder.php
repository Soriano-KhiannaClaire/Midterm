<?php
session_start();
include_once '../config/database.php';
include_once '../classes/Order.php';

$database = new Database();
$db = $database->getConnection();

if (empty($_SESSION['cart'])) {
    echo "Your cart is empty. Please add items to your cart before proceeding.";
    exit;
}

$customer_id = $_SESSION['customer_id'];
$totalPrice = 0;

foreach ($_SESSION['cart'] as $key => $item) {
    if (!isset($item['id']) || empty($item['id'])) {
        echo "Error: Missing menu_item_id for item " . ($key + 1) . ".";
        exit; 
    }

    if (!isset($item['quantity']) || $item['quantity'] <= 0) {
        $item['quantity'] = 1;
    }

    $totalPrice += $item['price'] * $item['quantity'];  
}

try {
    $query = "INSERT INTO orders (customer_id, total_price) VALUES (:customer_id, :total_price)";
    $stmt = $db->prepare($query);

    $stmt->bindParam(':customer_id', $customer_id, PDO::PARAM_INT);
    $stmt->bindValue(':total_price', $totalPrice, PDO::PARAM_STR); 

    if ($stmt->execute()) {
        $orderId = $db->lastInsertId();

        foreach ($_SESSION['cart'] as $item) {
            if (!isset($item['quantity']) || $item['quantity'] <= 0) {
                $item['quantity'] = 1; 
            }

            if (!isset($item['id']) || empty($item['id'])) {
                echo "Error: Missing menu_item_id.";
                exit; 
            }

            $queryItem = "INSERT INTO order_items (order_id, menu_item_id, quantity, price) VALUES (:order_id, :menu_item_id, :quantity, :price)";
            $stmtItem = $db->prepare($queryItem);

            $stmtItem->bindParam(':order_id', $orderId, PDO::PARAM_INT);
            $stmtItem->bindParam(':menu_item_id', $item['id'], PDO::PARAM_INT);  
            $stmtItem->bindParam(':quantity', $item['quantity'], PDO::PARAM_INT);  
            $stmtItem->bindParam(':price', $item['price'], PDO::PARAM_STR);  

            $stmtItem->execute();
        }

        unset($_SESSION['cart']);

        header("Location: payment.php?order_id=" . $orderId); 
        exit;

    } else {
        echo "Error placing the order.";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
