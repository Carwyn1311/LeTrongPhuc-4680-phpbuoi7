<?php
class HocPhanModel {
    private $conn;
    private $table = "HocPhan";

    public function __construct($db) {
        $this->conn = $db;
    }
    public function decrementSoLuong($MaHP)
    {
        $query = "UPDATE {$this->table} SET SoLuong = SoLuong - 1 WHERE MaHP = :MaHP";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':MaHP', $MaHP, PDO::PARAM_STR);
        return $stmt->execute();
    }
    
    // Thêm học phần (giữ lại phương thức này vì dễ mở rộng)
    public function insert($data) {
        $query = "INSERT INTO {$this->table} (MaHP, TenHP, SoTinChi, SoLuong)
                  VALUES (:MaHP, :TenHP, :SoTinChi, :SoLuong)";
        $stmt = $this->conn->prepare($query);
        
        // Bind parameters
        $stmt->bindParam(':MaHP', $data['MaHP'], PDO::PARAM_STR);
        $stmt->bindParam(':TenHP', $data['TenHP'], PDO::PARAM_STR);
        $stmt->bindParam(':SoTinChi', $data['SoTinChi'], PDO::PARAM_INT);
        $stmt->bindParam(':SoLuong', $data['SoLuong'], PDO::PARAM_INT);

        return $stmt->execute();
    }

    // Xóa học phần
    public function delete($MaHP) {
        $query = "DELETE FROM {$this->table} WHERE MaHP = :MaHP";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':MaHP', $MaHP, PDO::PARAM_STR);
        return $stmt->execute();
    }

    // Lấy danh sách học phần
    public function getAll() {
        $query = "SELECT MaHP, TenHP, SoTinChi, SoLuong FROM {$this->table}";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy thông tin học phần theo MaHP
    public function getByMaHP($MaHP) {
        $query = "SELECT * FROM {$this->table} WHERE MaHP = :MaHP";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':MaHP', $MaHP, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Cập nhật học phần
    public function update($data) {
        $query = "UPDATE {$this->table} 
                  SET TenHP = :TenHP, SoTinChi = :SoTinChi, SoLuong = :SoLuong 
                  WHERE MaHP = :MaHP";
        $stmt = $this->conn->prepare($query);
        
        // Bind parameters
        $stmt->bindParam(':TenHP', $data['TenHP'], PDO::PARAM_STR);
        $stmt->bindParam(':SoTinChi', $data['SoTinChi'], PDO::PARAM_INT);
        $stmt->bindParam(':SoLuong', $data['SoLuong'], PDO::PARAM_INT);
        $stmt->bindParam(':MaHP', $data['MaHP'], PDO::PARAM_STR);

        return $stmt->execute();
    }
}
?>
