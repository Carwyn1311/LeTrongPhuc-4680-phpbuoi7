<?php include __DIR__ . '/../shares/header.php'; ?>

<div class="home text-center">
    <h1 class="mt-4 text-primary">Trang Chủ</h1>
    <?php if (!empty($username)): ?>
        <p class="lead">Xin chào, <strong><?= htmlspecialchars($username) ?></strong> | 
            <a href="?controller=auth&action=logout" class="btn btn-outline-danger btn-sm">Đăng xuất</a>
        </p>
    <?php else: ?>
        <p class="lead">
            <a href="?controller=auth&action=login" class="btn btn-outline-primary btn-sm">Đăng nhập</a> 
            <a href="?controller=auth&action=register" class="btn btn-outline-success btn-sm">Đăng ký</a>
        </p>
    <?php endif; ?>

    <div class="mt-5">
        <a href="?controller=sinhvien&action=index" class="btn btn-success btn-lg me-3">
            Quản lý Sinh viên
        </a>
        <a href="?controller=hocphan&action=index" class="btn btn-warning btn-lg">
            Quản lý/Đăng ký Học phần
        </a>
    </div>
</div>

<?php include __DIR__ . '/../shares/footer.php'; ?>
