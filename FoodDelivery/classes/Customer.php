<?php
class Customer {
    private $conn;
    private $table = 'customers';

    public $id;
    public $username;
    public $password;
    public $email;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function signup() {
        $query = "INSERT INTO " . $this->table . " (username, password, email) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$this->username, password_hash($this->password, PASSWORD_BCRYPT), $this->email]);
    }

    public function login() {
        $query = "SELECT * FROM " . $this->table . " WHERE username = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$this->username]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row && password_verify($this->password, $row['password'])) {
            return true;
        }
        return false;
    }
}
?>
