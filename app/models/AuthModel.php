<?php

require_once 'app/config/database.php';

class AuthModel {
    private $conn;
    public function __construct() {
        $this->conn = Database::getConnection();
    }

    // Đăng ký tài khoản
    public function registerUser($data) {
        $sql = "INSERT INTO Users (username, password, email) 
                VALUES (:username, :password, :email)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($data);
    }

    // Tìm user theo username
    public function getUserByUsername($username) {
        $stmt = $this->conn->prepare("SELECT * FROM Users WHERE username=?");
        $stmt->execute([$username]);
        return $stmt->fetch();
    }
}
