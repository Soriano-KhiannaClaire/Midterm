<?php


class Restaurant {
    private $conn;
    private $table_name = "restaurants"; 

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getRestaurants() {
        $query = "SELECT id, name, description FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getRestaurantNameById($restaurant_id) {
        $query = "SELECT name FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $restaurant_id);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['name'] : ''; 
    }
}


?>