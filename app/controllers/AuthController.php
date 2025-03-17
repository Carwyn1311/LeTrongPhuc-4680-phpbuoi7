<?php 
require_once 'app/config/database.php'; 
require_once __DIR__ . '/../models/AuthModel.php'; 

class AuthController 
{ 
    private $model; 
    private $db; 

    public function __construct() 
    { 
        // Chỉ gọi session_start() nếu chưa có session
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start(); 
        }
        $this->db = (new Database())->getConnection(); 
        $this->model = new AuthModel($this->db); 
    } 

    // Trang đăng ký 
    public function register() 
    { 
        if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
            // Lấy MSSV thay vì username
            $mssv = trim($_POST['mssv'] ?? '');
            $password = trim($_POST['password'] ?? '');
            $email = trim($_POST['email'] ?? '');

            // Kiểm tra dữ liệu đầu vào (bạn có thể mở rộng kiểm tra thêm)
            if (empty($mssv) || empty($password) || empty($email)) {
                $error = "Vui lòng nhập đầy đủ thông tin!";
            } else {
                // Mã hóa password (ví dụ MD5 - nhưng nên dùng bcrypt hoặc password_hash() trong thực tế)
                $hashPass = md5($password); 
                $data = [ 
                    'mssv'     => $mssv, 
                    'password' => $hashPass, 
                    'email'    => $email 
                ]; 
                // Đăng ký user
                if ($this->model->registerUser($data)) {
                    // Chuyển sang trang đăng nhập
                    header("Location: ?controller=auth&action=login"); 
                    exit(); 
                } else {
                    $error = "Lỗi khi đăng ký. Vui lòng thử lại.";
                }
            }
        } 
        include 'app/views/auth/register.php'; 
    } 

    // Trang đăng nhập 
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $mssv = trim($_POST['mssv'] ?? '');
            $password = trim($_POST['password'] ?? '');
            $user = $this->model->getUserByMSSV($mssv);
            if ($user && $user['password'] == md5($password)) {
                $_SESSION['mssv'] = $mssv;  // Lưu MSSV vào session
                header("Location: ?controller=default&action=index");
                exit();
            } else {
                $error = "Sai MSSV hoặc mật khẩu!";
            }
        }
        require 'app/views/auth/login.php';
    }

    // Đăng xuất 
    public function logout() 
    { 
        session_destroy(); 
        header("Location: ?controller=auth&action=login");
    } 
}
?>
