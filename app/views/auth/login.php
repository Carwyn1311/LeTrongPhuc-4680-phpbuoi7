<?php include __DIR__ . '/../shares/header.php'; ?>
<h2>Đăng nhập</h2>
<?php if (!empty($error)): ?>
    <p style="color:red;"><?= $error ?></p>
<?php endif; ?>
<form method="POST" action="?controller=auth&action=login">
    <label>Username:</label><br>
    <input type="text" name="username" required><br>
    <label>Password:</label><br>
    <input type="password" name="password" required><br><br>
    <button type="submit">Đăng nhập</button>
</form>
<p>Chưa có tài khoản? <a href="?controller=auth&action=register">Đăng ký</a></p>
<?php include __DIR__ . '/../shares/footer.php'; ?>
