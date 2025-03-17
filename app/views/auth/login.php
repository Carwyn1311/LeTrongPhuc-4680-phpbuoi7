<?php include __DIR__ . '/../shares/header.php'; ?>
<div class="container mt-5">
    <h2 class="text-center mb-4">Đăng nhập</h2>
    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>
    <form method="POST" action="?controller=auth&action=login">
        <div class="mb-3">
            <label for="mssv" class="form-label">Mã số sinh viên (MSSV)</label>
            <input type="text" class="form-control" id="mssv" name="mssv" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Mật khẩu</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Đăng nhập</button>
    </form>
    <p class="text-center mt-3">Chưa có tài khoản? <a href="?controller=auth&action=register">Đăng ký</a></p>
</div>
<?php include __DIR__ . '/../shares/footer.php'; ?>
