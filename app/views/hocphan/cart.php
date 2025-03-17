<!-- views/hocphan/cart.php -->
<?php include 'views/shares/header.php'; ?>
<h2>Học phần đã đăng ký</h2>
<table border="1" cellpadding="5">
    <tr>
        <th>Mã HP</th>
        <th>Tên HP</th>
        <th>Số tín chỉ</th>
        <th>Hành động</th>
    </tr>
    <?php foreach($cartItems as $item): ?>
    <tr>
        <td><?= $item['MaHP'] ?></td>
        <td><?= $item['TenHP'] ?></td>
        <td><?= $item['SoTinChi'] ?></td>
        <td>
            <a href="?controller=hocphan&action=removeItem&MaHP=<?= $item['MaHP'] ?>"
               onclick="return confirm('Xóa học phần này?');">Xóa</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<br>
<a href="?controller=hocphan&action=clearCart" onclick="return confirm('Xóa hết học phần đã đăng ký?');">Xóa đăng ký</a>
<br><br>
<a href="?controller=hocphan&action=index">Đăng ký thêm</a>
<?php include 'views/shares/footer.php'; ?>
<?php include __DIR__ . '/../shares/footer.php'; ?>
