<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách Học phần</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center">Danh sách Học phần</h2>
    <a href="?controller=hocphan&action=create" class="btn btn-success mb-3">Thêm học phần</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Mã Học phần</th>
                <th>Tên Học phần</th>
                <th>Số tín chỉ</th>
                <th>Số lượng</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($courses as $course): ?>
            <tr>
                <td><?php echo $course['MaHP']; ?></td>
                <td><?php echo $course['TenHP']; ?></td>
                <td><?php echo $course['SoTinChi']; ?></td>
                <td>
                    <?php echo isset($course['SoLuong']) ? $course['SoLuong'] : 'Chưa cập nhật'; ?>
                </td>
                <td>
                    <a href="?controller=hocphan&action=edit&MaHP=<?php echo $course['MaHP']; ?>" class="btn btn-warning">Sửa</a>
                    <a href="?controller=hocphan&action=delete&MaHP=<?php echo $course['MaHP']; ?>" class="btn btn-danger">Xóa</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>
