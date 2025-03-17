<?php
require_once('app/config/database.php');
require_once('app/models/HocPhanModel.php');

class HocPhanController
{
    private $hocPhanModel;
    private $conn;

    public function __construct()
    {
        $this->conn = (new Database())->getConnection();
        $this->hocPhanModel = new HocPhanModel($this->conn);
    }

    public function index()
    {
        $courses = $this->hocPhanModel->getAll();
        include 'app/views/hocphan/list.php';
    }

    public function create()
    {
        include 'app/views/hocphan/create.php';
    }

    public function save()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $MaHP = filter_input(INPUT_POST, 'MaHP', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $TenHP = filter_input(INPUT_POST, 'TenHP', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $SoTinChi = filter_input(INPUT_POST, 'SoTinChi', FILTER_VALIDATE_INT);
            $SoLuong = filter_input(INPUT_POST, 'SoLuong', FILTER_VALIDATE_INT);

            if (!empty($MaHP) && !empty($TenHP) && $SoTinChi && $SoLuong) {
                $result = $this->hocPhanModel->insert($MaHP, $TenHP, $SoTinChi, $SoLuong);
                if ($result) {
                    header('Location: ?controller=hocphan&action=index');
                    exit();
                } else {
                    echo "Lỗi khi thêm học phần.";
                }
            } else {
                echo "Vui lòng nhập đầy đủ thông tin!";
            }
        }
    }

    public function delete()
    {
        $MaHP = filter_input(INPUT_GET, 'MaHP', FILTER_SANITIZE_STRING);
        if (!$MaHP) {
            echo "Mã học phần không hợp lệ!";
            return;
        }

        if ($this->hocPhanModel->delete($MaHP)) {
            header('Location: ?controller=hocphan&action=index');
            exit();
        } else {
            echo "Lỗi khi xóa học phần.";
        }
    }

    public function edit()
    {
        $MaHP = filter_input(INPUT_GET, 'MaHP', FILTER_SANITIZE_STRING);
        if (!$MaHP) {
            echo "Mã học phần không hợp lệ!";
            return;
        }

        $course = $this->hocPhanModel->getByMaHP($MaHP);
        if (!$course) {
            echo "Học phần không tồn tại!";
            return;
        }

        include 'app/views/hocphan/edit.php';
    }

    public function update()
    {
        $MaHP = filter_input(INPUT_GET, 'MaHP', FILTER_SANITIZE_STRING);
        if (!$MaHP) {
            echo "Mã học phần không hợp lệ!";
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $TenHP = filter_input(INPUT_POST, 'TenHP', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $SoTinChi = filter_input(INPUT_POST, 'SoTinChi', FILTER_VALIDATE_INT);
            $SoLuong = filter_input(INPUT_POST, 'SoLuong', FILTER_VALIDATE_INT);

            if (!empty($TenHP) && $SoTinChi && $SoLuong) {
                $result = $this->hocPhanModel->update($MaHP, $TenHP, $SoTinChi, $SoLuong);
                if ($result) {
                    header('Location: ?controller=hocphan&action=index');
                    exit();
                } else {
                    echo "Lỗi khi cập nhật học phần.";
                }
            } else {
                echo "Vui lòng nhập đầy đủ thông tin!";
            }
        }
    }
    public function register()
{
    // Kiểm tra đăng nhập
    if (!isset($_SESSION['username'])) {
        die("Bạn phải đăng nhập trước!");
    }

    // Lấy danh sách học phần có sẵn
    $courses = $this->hocPhanModel->getAll();

    // Kiểm tra xem sinh viên đã chọn học phần nào chưa
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $MaSV = $_SESSION['username'];  // hoặc map sang MaSV

        if (!empty($_POST['MaHP'])) {
            // Lấy danh sách các mã học phần mà sinh viên đã chọn
            $selectedCourses = $_POST['MaHP'];

            // Tạo 1 record trong DangKy
            $stmt = $this->conn->prepare("INSERT INTO DangKy (NgayDK, MaSV) VALUES (CURDATE(), ?)");
            $stmt->execute([$MaSV]);
            $MaDK = $this->conn->lastInsertId();

            // Thêm các học phần vào ChiTietDangKy
            foreach ($selectedCourses as $MaHP) {
                $stmt2 = $this->conn->prepare("INSERT INTO ChiTietDangKy (MaDK, MaHP) VALUES (?, ?)");
                $stmt2->execute([$MaDK, $MaHP]);

                // Giảm số lượng học phần
                $this->hocPhanModel->decrementSoLuong($MaHP);
            }

            $message = "Đăng ký học phần thành công!";
        } else {
            $message = "Bạn chưa chọn học phần nào!";
        }

        // Hiển thị lại danh sách học phần
        include 'app/views/hocphan/register.php';
    } else {
        // Hiển thị danh sách học phần
        include 'app/views/hocphan/register.php';
    }
}
}
?>
