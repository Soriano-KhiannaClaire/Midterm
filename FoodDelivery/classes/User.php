<?php
class User {
    private $conn;
    private $table = 'customers';  

    public function __construct($db) {
        $this->conn = $db;
    }
    public function checkLogin($username, $password) {
        $query = "SELECT * FROM " . $this->table . " WHERE username = :username AND password = :password";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return true;
        }

        return false;
    }
}
?>
