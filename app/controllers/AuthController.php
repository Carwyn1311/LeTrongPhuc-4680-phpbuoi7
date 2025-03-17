<?php 
require_once('app/config/database.php'); 
require_once('app/models/AuthModel.php'); 

class AuthController 
{ 
    private $model; 
    private $db; 

    public function __construct() 
    { 
        session_start(); 
        $this->db = (new Database())->getConnection(); 
        $this->model = new AuthModel($this->db); 
    } 

    // Trang đăng ký 
    public function register() 
    { 
        if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
            $username = $_POST['username']; 
            $password = $_POST['password']; 
            $email    = $_POST['email']; 

            // Mã hóa password (ví dụ MD5) 
            $hashPass = md5($password); 

            $data = [ 
                'username' => $username, 
                'password' => $hashPass, 
                'email'    => $email 
            ]; 
            $this->model->registerUser($data); 
            // Chuyển sang đăng nhập 
            header("Location: ?controller=auth&action=login"); 
            exit(); 
        } 

        include 'app/views/auth/register.php'; 
    } 

    // Trang đăng nhập 
    public function login() 
    { 
        if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
            $username = $_POST['username']; 
            $password = $_POST['password']; 
            $hashPass = md5($password); 

            $user = $this->model->getUserByUsername($username); 
            if ($user && $user['password'] == $hashPass) { 
                // Đăng nhập thành công 
                $_SESSION['username'] = $username; 
                header("Location: ?controller=default&action=index"); 
                exit(); 
            } else { 
                $error = "Sai username hoặc password!"; 
            } 
        } 

        include 'app/views/auth/login.php'; 
    } 

    // Đăng xuất 
    public function logout() 
    { 
        session_destroy(); 
        header("Location: ?controller=auth&action=login"); 
    } 
} 
?>
