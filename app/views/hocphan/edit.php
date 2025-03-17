<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Học phần</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Sửa Học phần</h2>
    <form method="POST" action="?controller=hocphan&action=update&MaHP=<?php echo $course['MaHP']; ?>">
        <div class="mb-3">
            <label for="TenHP" class="form-label">Tên học phần</label>
            <input type="text" class="form-control" name="TenHP" value="<?php echo $course['TenHP']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="SoTinChi" class="form-label">Số tín chỉ</label>
            <input type="number" class="form-control" name="SoTinChi" value="<?php echo $course['SoTinChi']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="SoLuong" class="form-label">Số lượng</label>
            <input type="number" class="form-control" name="SoLuong" value="<?php echo $course['SoLuong']; ?>" required>
        </div>
        <button type="submit" class="btn btn-warning">Cập nhật</button>
    </form>
</div>
</body>
</html>

