<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/SinhVienModel.php';
require_once __DIR__ . '/../models/NganhHocModel.php';

class SinhVienController {
    private $model;
    private $nganhHocModel;
    private $db;

    public function __construct() {
        $this->db = (new Database())->getConnection();
        $this->model = new SinhVienModel($this->db);
        $this->nganhHocModel = new NganhHocModel($this->db);
    }

    // Hiển thị danh sách sinh viên
    public function index() {
        $students = $this->model->getAll();
        include 'app/views/sinhvien/index.php';
    }

    // Hiển thị form thêm sinh viên
    public function add() {
        // Lấy danh sách ngành học để hiển thị dropdown (nếu muốn)
        $nganhHocs = $this->nganhHocModel->getAll();
        include 'app/views/sinhvien/create.php';
    }

    // Xử lý lưu thông tin sinh viên
    public function save() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Lấy dữ liệu từ form
            $MaSV     = trim($_POST['MaSV'] ?? '');
            $HoTen    = trim($_POST['HoTen'] ?? '');
            $GioiTinh = trim($_POST['GioiTinh'] ?? '');
            $NgaySinh = trim($_POST['NgaySinh'] ?? '');
            $MaNganh  = trim($_POST['MaNganh'] ?? '');

            $errors = [];
            if (empty($MaSV)) $errors[] = "Mã SV không được để trống";
            if (empty($HoTen)) $errors[] = "Họ tên không được để trống";
            if (empty($MaNganh)) $errors[] = "Mã ngành không được để trống";

            // Xử lý file upload nếu có
            $uploadedFilePath = '';
            if (isset($_FILES['Hinh']) && $_FILES['Hinh']['error'] == UPLOAD_ERR_OK) {
                // Sử dụng đường dẫn tuyệt đối tới thư mục uploads ở gốc dự án
                $uploadDir = __DIR__ . '/../../uploads/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
                $fileTmpPath = $_FILES['Hinh']['tmp_name'];
                $fileName = $_FILES['Hinh']['name'];
                // Tạo tên file mới để tránh trùng lặp (kết hợp MaSV và timestamp)
                $newFileName = $MaSV . '_' . time() . '_' . $fileName;
                $destPath = $uploadDir . $newFileName;
                
                if (move_uploaded_file($fileTmpPath, $destPath)) {
                    // Lưu đường dẫn file tương đối (với dấu "/" đầu tiên, từ gốc dự án)
                    $uploadedFilePath = '/uploads/' . $newFileName;
                } else {
                    $errors[] = "Có lỗi khi tải file lên!";
                }
            }

            // Kiểm tra mã ngành tồn tại (sử dụng phương thức getCategoryById của NganhHocModel)
            $nganh = $this->nganhHocModel->getCategoryById($MaNganh);
            if (!$nganh) {
                $errors[] = "Mã ngành không tồn tại! Vui lòng nhập mã ngành hợp lệ (VD: CNTT, QTKD).";
            }

            if (!empty($errors)) {
                // Nếu có lỗi, lấy lại danh sách ngành và hiển thị form với thông báo lỗi
                $nganhHocs = $this->nganhHocModel->getAll();
                include 'app/views/sinhvien/create.php';
                return;
            }

            // Chuẩn bị dữ liệu để lưu
            $data = [
                'MaSV'     => $MaSV,
                'HoTen'    => $HoTen,
                'GioiTinh' => $GioiTinh,
                'NgaySinh' => $NgaySinh,
                'Hinh'     => $uploadedFilePath,
                'MaNganh'  => $MaNganh
            ];

            $this->model->insert($data);
            header("Location: ?controller=sinhvien&action=index");
            exit;
        }
    }

    public function edit() {
        $MaSV = $_GET['MaSV'] ?? null;
        if (!$MaSV) {
            die("Thiếu MaSV!");
        }
        $student = $this->model->getByMaSV($MaSV);
        if (!$student) {
            die("Không tìm thấy SV!");
        }
        // Lấy danh sách ngành học để hiển thị trong form chỉnh sửa
        $nganhHocs = $this->nganhHocModel->getAll();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Nếu có file upload mới, bạn có thể xử lý tương tự như ở phương thức save()
            // Ở đây, để đơn giản, ta giữ nguyên giá trị Hinh cũ
            $data = [
                'MaSV'     => $MaSV,
                'HoTen'    => $_POST['HoTen'],
                'GioiTinh' => $_POST['GioiTinh'],
                'NgaySinh' => $_POST['NgaySinh'],
                'Hinh'     => $_POST['Hinh'],
                'MaNganh'  => $_POST['MaNganh']
            ];
            $this->model->update($data);
            header("Location: ?controller=sinhvien&action=index");
            exit;
        }
        include 'app/views/sinhvien/edit.php';
    }

    public function delete() {
        $MaSV = $_GET['MaSV'] ?? null;
        if (!$MaSV) {
            die("Thiếu MaSV!");
        }
        $this->model->delete($MaSV);
        header("Location: ?controller=sinhvien&action=index");
    }


    public function detail() {
        $MaSV = $_GET['MaSV'] ?? null;
        if (!$MaSV) {
            die("Thiếu MaSV!");
        }
        $student = $this->model->getByMaSV($MaSV);
        if (!$student) {
            die("Không tìm thấy SV!");
        }
        include 'app/views/sinhvien/detail.php';
    }
}
?>
