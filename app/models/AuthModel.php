<?php
class AuthModel {
    private $conn;
    private $table_name = "Users";

    public function __construct($db) {
        $this->conn = $db;
    }

    // Đăng ký user sử dụng MSSV, password và email
    public function registerUser($data) {
        $query = "INSERT INTO " . $this->table_name . " (mssv, password, email) 
                  VALUES (:mssv, :password, :email)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':mssv', $data['mssv']);
        $stmt->bindParam(':password', $data['password']);
        $stmt->bindParam(':email', $data['email']);
        return $stmt->execute();
    }

    // Lấy thông tin user theo MSSV
    public function getUserByMSSV($mssv) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE mssv = :mssv LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':mssv', $mssv);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
