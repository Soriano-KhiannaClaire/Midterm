<?php

class MenuItem {
    private $conn;
    private $table_name = "menu_items"; 
    private $table = 'menu_items';

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getMenuItems($restaurant_id) {
        $query = "SELECT id, name, price, description FROM " . $this->table_name . " WHERE restaurant_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $restaurant_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addMenuItem($restaurant_id, $name, $price, $description) {
        $query = "INSERT INTO " . $this->table_name . " (restaurant_id, name, price, description) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $restaurant_id);
        $stmt->bindParam(2, $name);
        $stmt->bindParam(3, $price);
        $stmt->bindParam(4, $description);

        return $stmt->execute();
    }

    public function getMenuItemById($itemId) {
        $query = "SELECT id, name, price FROM " . $this->table_name . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $itemId);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}

?>
