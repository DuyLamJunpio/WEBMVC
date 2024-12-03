<?php

class AuthController extends Controller
{
    private $model;

    public function __construct()
    {
        // Sử dụng phương thức model() để khởi tạo UserModel
        $this->model = $this->model("AuthModel");
    }

    // Hiển thị trang đăng ký
    public function showRegisterForm()
    {
        $this->view("Auth/register");
    }

    // Xử lý đăng ký người dùng
    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy giá trị từ form
            $ho = $_POST['ho'] ?? '';
            $ten = $_POST['ten'] ?? '';
            $email = $_POST['email'] ?? '';
            $matkhau = $_POST['matkhau'] ?? '';
            $xacnhanmatkhau = $_POST['xacnhanmatkhau'] ?? '';
            $tendangnhap = $_POST['tendangnhap'] ?? '';
            $sodienthoai = $_POST['sodienthoai'] ?? '';
            $gioitinh = $_POST['gioitinh'] ?? 2;

            // Kết hợp họ và tên
            $hoten = trim($ho) . " " . trim($ten);

            // Kiểm tra các điều kiện cơ bản
            if (empty($tendangnhap) || empty($email) || empty($matkhau) || empty($xacnhanmatkhau)) {
                echo "Vui lòng nhập đầy đủ thông tin.";
                return;
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo "Email không hợp lệ!";
                return;
            }

            if (strlen($matkhau) < 6) {
                echo "Mật khẩu phải có ít nhất 6 ký tự.";
                return;
            }

            if ($matkhau !== $xacnhanmatkhau) {
                echo "Mật khẩu không trùng khớp!";
                return;
            }

            // Gọi model để lưu dữ liệu
            $result = $this->model->register($tendangnhap, $email, $matkhau, $hoten, $sodienthoai, $gioitinh);

            if ($result === true) {
                echo "Đăng ký thành công!";
                // Chuyển hướng tới trang đăng nhập
                header("Location: ./showLoginForm");
                exit;
            } else {
                // Hiển thị thông báo lỗi từ model
                echo "Đăng ký thất bại: " . $result;
            }
        } else {
            // Hiển thị form đăng ký nếu không phải POST
            $this->showRegisterForm();
        }
    }


    // Hiển thị trang đăng nhập
    public function showLoginForm()
    {
        $this->view("Auth/login");
    }

    // Xử lý đăng nhập người dùng
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'] ?? '';
            $matkhau = $_POST['matkhau'] ?? '';
            // Gọi model để kiểm tra thông tin đăng nhập
            $user = $this->model->login($email, $matkhau);

            // echo "<pre>";
            // print_r($user);
            // echo "</pre>";

            if ($user && is_array($user)) {
                // Lưu thông tin vào session
                if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_hoten'] = $user['hoten']; // Lưu tên người dùng
                $_SESSION['user_email'] = $user['email'];

                echo "Đăng nhập thành công!";
                if ($user["mucdotruycap"] == 1) {
                    header("Location: " . BASE_URL . "/Admin/getShow"); // Admin
                } else {
                    header("Location: " . BASE_URL . "/HomeController/index"); // User
                }
                exit();
            } else {
                // Hiển thị thông báo lỗi
                echo "Đăng nhập thất bại: " . $user;
            }
        } else {
            $this->showLoginForm();
        }
    }

    public function profile()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $user_id = $_SESSION['user_id'] ?? null;

        if ($user_id == null) {
            header("Location: " . BASE_URL . "/AuthController/showLoginForm");
            exit();
        }

        $obj = $this->model('AuthModel');
        $user = $obj->profile($user_id);

        // Truyền cả ProfileView và FileView vào $data
        $this->view("LayoutHome", [
            "User" => "Profile/ProfileView", // Gọi ProfileView trong LayoutHome
            "Profile" => "FileView",        // Gọi FileView trong ProfileView
            "user" => $user                 // Dữ liệu người dùng
        ]);
    }

    public function profileAdmin()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $user_id = $_SESSION['user_id'] ?? null;

        if ($user_id == null) {
            header("Location: " . BASE_URL . "/AuthController/showLoginForm");
            exit();
        }

        $obj = $this->model('AuthModel');
        $user = $obj->profile($user_id);

        // Truyền cả ProfileView và FileView vào $data

        $this->view(
            "Manager_View",
            ["page" => "AdminProfile", "user" => $user]
        );
    }

    public function getListUser()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $obj = $this->model('AuthModel');
        $users = $obj->listUser();

        $this->view(
            "Manager_View",
            ["page" => "AdminListUser", "users" => $users]
        );
    }

    public function getCustomerDetails($userId)
    {
        // Gọi model để lấy thông tin chi tiết khách hàng
        $customerDetails = $this->model->getCustomerDetails($userId);

        // Truyền dữ liệu vào view
        $this->view(
            "Manager_View",
            ["page" => "AdminDetailUser", "customerDetails" => $customerDetails]
        );
    }

    public function deleteUser($userId)
    {

        // Kiểm tra xem khách hàng có đơn hàng nào không
        if ($this->model->hasOrders($userId)) {
            echo "Khách hàng đã phát sinh đơn mua, không thể xóa.";
            return;
        }

        // Thực hiện xóa khách hàng
        if ($this->model->deleteUser($userId)) {
            echo "Xóa khách hàng thành công.";
        } else {
            echo "Có lỗi xảy ra khi xóa khách hàng.";
        }
    }


    // Đăng xuất người dùng
    public function logout()
    {
        session_start();
        session_destroy();
        header("Location: " . BASE_URL . "/HomeController/index");
        exit;
    }

    // Tải view (hàm helper)
    public function view($viewName, $data = [])
    {
        require_once "views/" . $viewName . ".php";
    }
}
