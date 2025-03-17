<?php include __DIR__ . '/../shares/header.php'; ?>

<div class="container mt-5">
    <h2 class="text-center mb-4">Đăng ký</h2>

    <form method="POST" action="?controller=auth&action=register" class="border p-4 rounded shadow-sm bg-light">
        <div class="form-group mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>

        <div class="form-group mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>

        <div class="form-group mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>

        <div class="form-group mt-4">
            <button type="submit" class="btn btn-primary btn-lg btn-block w-100">Đăng ký</button>
        </div>
    </form>

    <p class="text-center mt-3">Đã có tài khoản? <a href="?controller=auth&action=login">Đăng nhập</a></p>
</div>

<?php include __DIR__ . '/../shares/footer.php'; ?>
