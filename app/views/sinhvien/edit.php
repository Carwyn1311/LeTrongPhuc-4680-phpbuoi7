<?php include __DIR__ . '/../shares/header.php'; ?>
<h2>Sửa thông tin Sinh viên</h2>
<form method="POST" action="?controller=sinhvien&action=edit&MaSV=<?= urlencode($student['MaSV']) ?>" enctype="multipart/form-data">
    <div>
        <label>Mã SV: <?= htmlspecialchars($student['MaSV']) ?></label>
    </div>
    <br>
    <div>
        <label for="HoTen">Họ tên:</label><br>
        <input type="text" id="HoTen" name="HoTen" value="<?= htmlspecialchars($student['HoTen']) ?>" required>
    </div>
    <br>
    <div>
        <label for="GioiTinh">Giới tính:</label><br>
        <select id="GioiTinh" name="GioiTinh">
            <option value="Nam" <?= ($student['GioiTinh'] == 'Nam') ? 'selected' : '' ?>>Nam</option>
            <option value="Nữ" <?= ($student['GioiTinh'] == 'Nữ') ? 'selected' : '' ?>>Nữ</option>
        </select>
    </div>
    <br>
    <div>
        <label for="NgaySinh">Ngày sinh:</label><br>
        <input type="date" id="NgaySinh" name="NgaySinh" value="<?= htmlspecialchars($student['NgaySinh']) ?>">
    </div>
    <br>
    <div>
        <label for="Hinh">Hình ảnh hiện tại:</label><br>
        <?php if(!empty($student['Hinh'])): ?>
            <img src="<?= htmlspecialchars($student['Hinh']) ?>" alt="Hình của <?= htmlspecialchars($student['HoTen']) ?>" width="80"><br>
        <?php else: ?>
            <span>Không có hình</span><br>
        <?php endif; ?>
        <label for="Hinh">Chọn hình mới (nếu muốn thay đổi):</label><br>
        <input type="file" id="Hinh" name="Hinh">
    </div>
    <br>
    <div>
        <label for="MaNganh">Mã ngành (VD: CNTT, QTKD):</label><br>
        <input type="text" id="MaNganh" name="MaNganh" value="<?= htmlspecialchars($student['MaNganh']) ?>" required>
        <!-- Nếu bạn sử dụng dropdown với danh sách ngành:
        <select id="MaNganh" name="MaNganh" required>
            <?php foreach ($nganhHocs as $nganh): ?>
                <option value="<?= htmlspecialchars($nganh['MaNganh']) ?>" <?= ($student['MaNganh'] == $nganh['MaNganh']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($nganh['TenNganh']) ?>
                </option>
            <?php endforeach; ?>
        </select>
        -->
    </div>
    <br>
    <button type="submit">Cập nhật</button>
</form>
<br>
<a href="?controller=sinhvien&action=index">Về danh sách</a>
<?php include __DIR__ . '/../shares/footer.php'; ?>
