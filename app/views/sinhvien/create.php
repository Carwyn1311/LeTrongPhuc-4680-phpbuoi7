<?php include __DIR__ . '/../shares/header.php'; ?>
<h2>Thêm Sinh viên</h2>
<?php 
if (!empty($errors)) {
    echo '<ul style="color:red;">';
    foreach ($errors as $err) {
        echo '<li>' . $err . '</li>';
    }
    echo '</ul>';
}
?>
<form method="POST" action="?controller=sinhvien&action=save" enctype="multipart/form-data">
    <div>
        <label for="MaSV">Mã SV:</label><br>
        <input type="text" id="MaSV" name="MaSV" value="<?= $_POST['MaSV'] ?? '' ?>" required>
    </div>
    <br>
    <div>
        <label for="HoTen">Họ tên:</label><br>
        <input type="text" id="HoTen" name="HoTen" value="<?= $_POST['HoTen'] ?? '' ?>" required>
    </div>
    <br>
    <div>
        <label for="GioiTinh">Giới tính:</label><br>
        <select id="GioiTinh" name="GioiTinh">
            <option value="Nam" <?= (($_POST['GioiTinh'] ?? '')=='Nam')?'selected':'' ?>>Nam</option>
            <option value="Nữ" <?= (($_POST['GioiTinh'] ?? '')=='Nữ')?'selected':'' ?>>Nữ</option>
        </select>
    </div>
    <br>
    <div>
        <label for="NgaySinh">Ngày sinh:</label><br>
        <input type="date" id="NgaySinh" name="NgaySinh" value="<?= $_POST['NgaySinh'] ?? '' ?>">
    </div>
    <br>
    <div>
        <label for="Hinh">Chọn hình ảnh:</label><br>
        <input type="file" id="Hinh" name="Hinh">
    </div>
    <br>
    <div>
        <label for="MaNganh">Mã ngành (VD: CNTT, QTKD):</label><br>
        <input type="text" id="MaNganh" name="MaNganh" value="<?= $_POST['MaNganh'] ?? '' ?>" required>
        <!-- Nếu muốn dropdown, bạn có thể thay thế input text bằng select -->
        <!--
        <select id="MaNganh" name="MaNganh" required>
            <option value="">-- Chọn ngành học --</option>
            <?php foreach ($nganhHocs as $nganh): ?>
                <option value="<?= $nganh['MaNganh'] ?>" <?= (($_POST['MaNganh'] ?? '')==$nganh['MaNganh'])?'selected':'' ?>>
                    <?= $nganh['TenNganh'] ?>
                </option>
            <?php endforeach; ?>
        </select>
        -->
    </div>
    <br>
    <button type="submit">Lưu</button>
</form>
<br>
<a href="?controller=sinhvien&action=index">Về danh sách</a>
<?php include __DIR__ . '/../shares/footer.php'; ?>
