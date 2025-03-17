<?php

class HocPhanModel
{
    private $conn;
    private $table = 'HocPhan';

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function insert($MaHP, $TenHP, $SoTinChi, $SoLuong)
    {
        $sql = "INSERT INTO {$this->table} (MaHP, TenHP, SoTinChi, SoLuong) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);

        // Truyền mảng tham số vào execute
        return $stmt->execute([$MaHP, $TenHP, $SoTinChi, $SoLuong]);
    }

    public function delete($MaHP)
    {
        $sql = "DELETE FROM {$this->table} WHERE MaHP = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$MaHP]);
    }

    public function getAll()
    {
        $sql = "SELECT MaHP, TenHP, SoTinChi, SoLuong FROM {$this->table}";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByMaHP($MaHP)
    {
        $sql = "SELECT * FROM {$this->table} WHERE MaHP = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$MaHP]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($MaHP, $TenHP, $SoTinChi, $SoLuong)
    {
        $sql = "UPDATE {$this->table} SET TenHP = ?, SoTinChi = ?, SoLuong = ? WHERE MaHP = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$TenHP, $SoTinChi, $SoLuong, $MaHP]);
    }
}
?>
