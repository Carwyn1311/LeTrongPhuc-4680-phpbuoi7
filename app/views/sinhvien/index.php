<?php include __DIR__ . '/../shares/header.php'; ?>
<h2>Danh sách Sinh viên</h2>
<a href="?controller=sinhvien&action=add">Thêm Sinh viên</a>
<table border="1" cellpadding="5" cellspacing="0" style="width:100%; margin-top:10px;">
    <tr>
        <th>Mã SV</th>
        <th>Họ tên</th>
        <th>Giới tính</th>
        <th>Ngày sinh</th>
        <th>Hình ảnh</th>
        <th>Mã ngành</th>
        <th>Hành động</th>
    </tr>
    <?php foreach ($students as $sv): ?>
    <tr>
        <td><?= htmlspecialchars($sv['MaSV']) ?></td>
        <td><?= htmlspecialchars($sv['HoTen']) ?></td>
        <td><?= htmlspecialchars($sv['GioiTinh']) ?></td>
        <td><?= htmlspecialchars($sv['NgaySinh']) ?></td>
        <td>
            <?php if (!empty($sv['Hinh'])): ?>
                <img src="<?= $sv['Hinh'] ?>" alt="Hình ảnh sinh viên" style="width: 100px; height: auto;">
            <?php else: ?>
                <p>Không có hình ảnh</p>
            <?php endif; ?>
        </td>
        <td><?= htmlspecialchars($sv['MaNganh']) ?></td>
        <td>
            <a href="?controller=sinhvien&action=detail&MaSV=<?= urlencode($sv['MaSV']) ?>">Chi tiết</a> |
            <a href="?controller=sinhvien&action=edit&MaSV=<?= urlencode($sv['MaSV']) ?>">Sửa</a> |
            <a href="?controller=sinhvien&action=delete&MaSV=<?= urlencode($sv['MaSV']) ?>" onclick="return confirm('Xóa sinh viên này?');">Xóa</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<?php include __DIR__ . '/../shares/footer.php'; ?>
