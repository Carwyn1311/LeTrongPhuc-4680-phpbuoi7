<form method="POST">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Chọn</th>
                <th>Mã Học phần</th>
                <th>Tên Học phần</th>
                <th>Số tín chỉ</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($courses as $course): ?>
                <tr>
                    <td><input type="checkbox" name="MaHP[]" value="<?= $course['MaHP'] ?>"></td>
                    <td><?= $course['MaHP'] ?></td>
                    <td><?= $course['TenHP'] ?></td>
                    <td><?= $course['SoTinChi'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <button type="submit" class="btn btn-primary">Đăng ký</button>
</form>
