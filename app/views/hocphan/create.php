<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Học phần</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Thêm Học phần</h2>
    <form method="POST" action="?controller=hocphan&action=save">
        <div class="mb-3">
            <label for="MaHP" class="form-label">Mã học phần</label>
            <input type="text" class="form-control" name="MaHP" required>
        </div>
        <div class="mb-3">
            <label for="TenHP" class="form-label">Tên học phần</label>
            <input type="text" class="form-control" name="TenHP" required>
        </div>
        <div class="mb-3">
            <label for="SoTinChi" class="form-label">Số tín chỉ</label>
            <input type="number" class="form-control" name="SoTinChi" required>
        </div>
        <div class="mb-3">
            <label for="SoLuong" class="form-label">Số lượng</label>
            <input type="number" class="form-control" name="SoLuong" required>
        </div>
        <button type="submit" class="btn btn-success">Thêm học phần</button>
    </form>
</div>
</body>
</html>
