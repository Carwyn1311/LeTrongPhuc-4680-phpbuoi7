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

    public function insert($data) {
        $sql = "INSERT INTO SinhVien(MaSV,HoTen,GioiTinh,NgaySinh,Hinh,MaNganh)
                VALUES(:MaSV,:HoTen,:GioiTinh,:NgaySinh,:Hinh,:MaNganh)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute($data);
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
