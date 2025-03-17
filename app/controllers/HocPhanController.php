<?php
require_once('app/config/database.php');
require_once('app/models/HocPhanModel.php');

class HocPhanController
{
    private $hocPhanModel;
    private $conn;

    public function __construct()
    {
        // Kiểm tra xem session đã được khởi tạo chưa, nếu chưa thì khởi tạo
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        $this->conn = (new Database())->getConnection();
        $this->hocPhanModel = new HocPhanModel($this->conn);
    }

    // Giảm số lượng học phần
    public function decrementSoLuong($MaHP)
    {
        $sql = "UPDATE HocPhan SET SoLuong = SoLuong - 1 WHERE MaHP = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$MaHP]);
    }

    // Hiển thị danh sách học phần
    public function index()
    {
        $courses = $this->hocPhanModel->getAll();
        include 'app/views/hocphan/list.php';
    }

    // Trang thêm học phần
    public function create()
    {
        include 'app/views/hocphan/create.php';
    }

    // Lưu học phần mới
    public function save()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $MaHP = filter_input(INPUT_POST, 'MaHP', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $TenHP = filter_input(INPUT_POST, 'TenHP', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $SoTinChi = filter_input(INPUT_POST, 'SoTinChi', FILTER_VALIDATE_INT);
        $SoLuong = filter_input(INPUT_POST, 'SoLuong', FILTER_VALIDATE_INT);

        if (!empty($MaHP) && !empty($TenHP) && $SoTinChi && $SoLuong) {
            // Chuẩn bị dữ liệu
            $data = [
                'MaHP'     => $MaHP,
                'TenHP'    => $TenHP,
                'SoTinChi' => $SoTinChi,
                'SoLuong'  => $SoLuong
            ];

            // Gọi phương thức insert() để thêm học phần
            $result = $this->hocPhanModel->insert($data);
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



    // Xóa học phần
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

    // Chỉnh sửa học phần
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

    // Cập nhật học phần
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

    // Đăng ký học phần cho sinh viên
    public function register()
{
    // Kiểm tra đăng nhập
    if (!isset($_SESSION['mssv'])) {
        die("Bạn phải đăng nhập trước!");
    }

    $MaSV = $_SESSION['mssv'];  // Lấy MaSV từ session

    // Bỏ qua kiểm tra MaSV trong bảng SinhVien
    // Thực tế, bạn có thể bỏ qua kiểm tra này nếu không muốn kiểm tra sự tồn tại của MaSV trong hệ thống.

    // Lấy danh sách học phần có sẵn
    $courses = $this->hocPhanModel->getAll();

    // Kiểm tra xem sinh viên đã chọn học phần nào chưa
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
