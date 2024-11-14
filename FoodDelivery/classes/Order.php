<?php
class Order {
    private $conn;
    private $table = 'orders';

    public function __construct($db) {
        $this->conn = $db;
    }

    private function isValidCustomer($customerId) {
        $query = "SELECT id FROM customers WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$customerId]);

        return $stmt->rowCount() > 0;
    }

    public function placeOrder($customerId, $total, $paymentMethod, $deliveryOption) {
    
        if (!$this->isValidCustomer($customerId)) {
            throw new Exception("Invalid customer ID.");
        }

        $query = "INSERT INTO " . $this->table . " (customer_id, total, payment_method, delivery_option, status)
                  VALUES (?, ?, ?, ?, 'Pending')";

        $stmt = $this->conn->prepare($query);

        if ($stmt->execute([$customerId, $total, $paymentMethod, $deliveryOption])) {
            return true; 
        }

        return false;
    }
}
?>
