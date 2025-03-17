<?php
class DefaultController {
    public function index() {
        // Nếu có session['username'], hiển thị tên user. Nếu không, hiển thị link đăng nhập/đăng ký.
        $username = $_SESSION['username'] ?? null;
        // Gọi view cho trang chủ (đặt tại app/views/default/index.php)
        require __DIR__ . '/../views/default/index.php';
    }
}
?>
