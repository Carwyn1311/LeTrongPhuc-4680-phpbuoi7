<?php include __DIR__ . '/../shares/header.php'; ?>
<h2>Chi tiết Sinh viên</h2>
<p><strong>Mã SV:</strong> <?= htmlspecialchars($student['MaSV']) ?></p>
<p><strong>Họ tên:</strong> <?= htmlspecialchars($student['HoTen']) ?></p>
<p><strong>Giới tính:</strong> <?= htmlspecialchars($student['GioiTinh']) ?></p>
<p><strong>Ngày sinh:</strong> <?= htmlspecialchars($student['NgaySinh']) ?></p>
<p><strong>Hình ảnh:</strong><br>
<?php if (!empty($student['Hinh'])): ?>
        <img src="<?= $student['Hinh'] ?>" alt="Hình ảnh sinh viên" style="width: 150px; height: auto;">
    <?php else: ?>
        <p>Không có hình ảnh</p>
    <?php endif; ?>
</p>
<p><strong>Mã ngành:</strong> <?= htmlspecialchars($student['MaNganh']) ?></p>
<br>
<a href="?controller=sinhvien&action=index">Về danh sách</a>
<?php include __DIR__ . '/../shares/footer.php'; ?>
