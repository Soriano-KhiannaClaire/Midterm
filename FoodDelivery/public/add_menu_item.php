<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

include_once '../config/database.php';
include_once '../classes/MenuItem.php';
include_once '../classes/Restaurant.php';

$database = new Database();
$db = $database->getConnection();

$menuItem = new MenuItem($db);
$restaurant = new Restaurant($db);

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $restaurant_id = $_POST['restaurant_id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    // Add menu item
    if ($menuItem->addMenuItem($restaurant_id, $name, $price, $description)) {
        $message = "Menu item added successfully!";
    } else {
        $message = "Failed to add menu item.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Menu Item</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Add a New Menu Item</h2>
        
        <?php if ($message != ""): ?>
            <div class="alert alert-info"><?= $message ?></div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="form-group">
                <label for="restaurant_id">Restaurant</label>
                <select class="form-control" id="restaurant_id" name="restaurant_id" required>
                    <option value="">Select Restaurant</option>
                    <?php
                    // Fetch all restaurants and display them in the dropdown
                    $restaurants = $restaurant->getRestaurants();
                    foreach ($restaurants as $res) {
                        echo "<option value='" . $res['id'] . "'>" . $res['name'] . "</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="name">Menu Item Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" step="0.01" class="form-control" id="price" name="price" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Add Menu Item</button>
            <a href="menu.php" class="btn btn-secondary">Back to Menu</a>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
