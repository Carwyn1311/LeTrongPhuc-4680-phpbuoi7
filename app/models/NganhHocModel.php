<?php
// app/models/NganhHocModel.php

require_once __DIR__ . '/../config/database.php';

class NganhHocModel {
    private $conn;

    // Nếu $db được truyền vào từ controller, sử dụng nó; nếu không, lấy kết nối mặc định từ Database
    public function __construct($db = null) {
        if ($db === null) {
            $this->conn = Database::getConnection();
        } else {
            $this->conn = $db;
        }
    }

    // Lấy toàn bộ ngành học
    public function getAll() {
        $stmt = $this->conn->query("SELECT * FROM NganhHoc");
        return $stmt->fetchAll();
    }

    // Lấy ngành học theo MaNganh (sử dụng để kiểm tra trong quá trình thêm Sinh viên)
    public function getCategoryById($MaNganh) {
        $stmt = $this->conn->prepare("SELECT * FROM NganhHoc WHERE MaNganh = ?");
        $stmt->execute([$MaNganh]);
        return $stmt->fetch();
    }
}
?>
