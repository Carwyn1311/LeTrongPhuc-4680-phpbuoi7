<?php include __DIR__ . '/../shares/header.php'; ?>
<h2>Chi tiết Sinh viên</h2>
<p><strong>Mã SV:</strong> <?= htmlspecialchars($student['MaSV']) ?></p>
<p><strong>Họ tên:</strong> <?= htmlspecialchars($student['HoTen']) ?></p>
<p><strong>Giới tính:</strong> <?= htmlspecialchars($student['GioiTinh']) ?></p>
<p><strong>Ngày sinh:</strong> <?= htmlspecialchars($student['NgaySinh']) ?></p>
<p><strong>Hình ảnh:</strong><br>
    <?php if (!empty($student['Hinh'])): ?>
        <img src="<?= htmlspecialchars($student['Hinh']) ?>" alt="Hình của <?= htmlspecialchars($student['HoTen']) ?>" width="200">
    <?php else: ?>
        <span>Không có hình</span>
    <?php endif; ?>
</p>
<p><strong>Mã ngành:</strong> <?= htmlspecialchars($student['MaNganh']) ?></p>
<br>
<a href="?controller=sinhvien&action=index">Về danh sách</a>
<?php include __DIR__ . '/../shares/footer.php'; ?>
