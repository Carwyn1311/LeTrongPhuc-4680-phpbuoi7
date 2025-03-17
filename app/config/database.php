<?php

class Database {
    private static $host = 'localhost';
    private static $dbname = 'Test1';   // DB name trùng với script
    private static $username = 'root';  // Tài khoản MySQL
    private static $password = '';      // Mật khẩu MySQL (nếu có)
    private static $charset = 'utf8mb4';

    public static function getConnection() {
        static $conn = null;
        if ($conn === null) {
            $dsn = 'mysql:host='.self::$host.';dbname='.self::$dbname.';charset='.self::$charset;
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ];
            try {
                $conn = new PDO($dsn, self::$username, self::$password, $options);
            } catch (PDOException $e) {
                die("Kết nối DB thất bại: " . $e->getMessage());
            }
        }
        return $conn;
    }
}
