<?php
require_once 'app/config/database.php';

class SinhVienModel {
    private $conn;
    public function __construct() {
        $this->conn = Database::getConnection();
    }

    public function getAll() {
        $stmt = $this->conn->query("SELECT * FROM SinhVien");
        return $stmt->fetchAll();
    }

    public function getByMaSV($MaSV) {
        $stmt = $this->conn->prepare("SELECT * FROM SinhVien WHERE MaSV=?");
        $stmt->execute([$MaSV]);
        return $stmt->fetch();
    }

    public function insert($data)
{
    // Kiểm tra xem MaSV đã tồn tại chưa
    $query = "SELECT COUNT(*) FROM SinhVien WHERE MaSV = :MaSV";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':MaSV', $data['MaSV']);
    $stmt->execute();
    $exists = $stmt->fetchColumn();

    if ($exists > 0) {
        // Nếu MaSV đã tồn tại, thông báo lỗi
        return "Mã sinh viên đã tồn tại!";
    }

    // Nếu MaSV chưa tồn tại, thực hiện thao tác INSERT
    $query = "INSERT INTO SinhVien (MaSV, HoTen, GioiTinh, NgaySinh, Hinh, MaNganh) 
              VALUES (:MaSV, :HoTen, :GioiTinh, :NgaySinh, :Hinh, :MaNganh)";
    $stmt = $this->conn->prepare($query);

    $stmt->bindParam(':MaSV', $data['MaSV']);
    $stmt->bindParam(':HoTen', $data['HoTen']);
    $stmt->bindParam(':GioiTinh', $data['GioiTinh']);
    $stmt->bindParam(':NgaySinh', $data['NgaySinh']);
    $stmt->bindParam(':Hinh', $data['Hinh']);
    $stmt->bindParam(':MaNganh', $data['MaNganh']);

    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}


    public function update($data) {
        $sql = "UPDATE SinhVien
                SET HoTen=:HoTen, GioiTinh=:GioiTinh, NgaySinh=:NgaySinh, Hinh=:Hinh, MaNganh=:MaNganh
                WHERE MaSV=:MaSV";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($data);
    }

    public function delete($MaSV) {
        $stmt = $this->conn->prepare("DELETE FROM SinhVien WHERE MaSV=?");
        return $stmt->execute([$MaSV]);
    }
}
