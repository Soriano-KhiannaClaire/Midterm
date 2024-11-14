<?php
include_once '../config/database.php';
include_once '../classes/Restaurant.php';
include_once '../classes/MenuItem.php';

session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$database = new Database();
$db = $database->getConnection();

$restaurant = new Restaurant($db);
$menuItem = new MenuItem($db);

$restaurants = $restaurant->getRestaurants();

$menuItems = [];
$restaurant_name = "";
if (isset($_GET['restaurant_id'])) {
    $restaurant_id = $_GET['restaurant_id'];

    // Fetch restaurant name for display purposes
    $restaurant_name = $restaurant->getRestaurantNameById($restaurant_id);

    // Fetch the menu items for the selected restaurant
    $menuItems = $menuItem->getMenuItems($restaurant_id);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2 class="my-4">Select a Restaurant</h2>
        <div class="row mb-4">
            <?php foreach ($restaurants as $restaurant) { ?>
                <div class="col-md-4">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($restaurant['name']) ?></h5>
                            <p class="card-text"><?= htmlspecialchars($restaurant['description']) ?></p>
                            <a href="menu.php?restaurant_id=<?= $restaurant['id'] ?>" class="btn btn-primary">View Menu</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>

        <?php if (!empty($menuItems)) { ?>
            <h2 class="my-4">Menu Items for <?= htmlspecialchars($restaurant_name) ?></h2>
            <div class="row">
                <?php foreach ($menuItems as $item) { ?>
                    <div class="col-md-4">
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($item['name']) ?></h5>
                                <p class="card-text">Price: $<?= number_format($item['price'], 2) ?></p>
                                <a href="cart.php?action=add&id=<?= $item['id'] ?>" class="btn btn-success btn-sm">Add to Cart</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        <?php } else { ?>
            <p>No menu items found for this restaurant. <a href="add_menu_item.php">Add a Menu Item</a></p>
        <?php } ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
