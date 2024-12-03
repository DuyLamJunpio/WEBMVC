<?php

class BillController extends Controller
{
    public function insertBill()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $user_id = $_SESSION['user_id'] ?? null;

        if ($user_id == null) {
            header("Location: " . BASE_URL . "/AuthController/showLoginForm");
            exit();
        }

        $objAuth = $this->model("AuthModel");
        $user = $objAuth->profile($user_id);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy giá trị từ form
            $ma_khach_hang = $user_id;
            $tong_thanh_toan = $_POST['tong_thanh_toan'];
            $danh_sach_san_pham_json = $_POST['product_list']; // Chuỗi JSON chứa các sản phẩm

            if ($user['diachi'] == null) {
                $newAddress = $_POST['diachi'];

                // Kiểm tra dữ liệu
                if (empty($newAddress)) {
                    echo "Địa chỉ không được để trống.";
                    return;
                }
                // Gọi model để cập nhật địa chỉ
                $result = $objAuth->updateUserAddress($user_id, $newAddress);
                // Xử lý kết quả
                if ($result) {
                    echo "Cập nhật địa chỉ thành công!";
                    header("Location: " . BASE_URL . "/HomeController/index");
                    exit();
                } else {
                    echo "Không thể cập nhật địa chỉ.";
                }
            }


            // Giải mã chuỗi JSON thành mảng
            $danh_sach_san_pham = json_decode($danh_sach_san_pham_json, true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                echo "Lỗi khi giải mã JSON: " . json_last_error_msg();
                return;
            }

            // Gọi model để thêm hóa đơn
            $obj = $this->model("BillModel");
            $result = $obj->insertBill($ma_khach_hang, $tong_thanh_toan, $danh_sach_san_pham);

            if ($result) {
                echo "Thêm hóa đơn thành công!";
            } else {
                echo "Thêm hóa đơn thất bại!";
            }
        }
    }

    public function checkoutProduct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $user_id = $_SESSION['user_id'] ?? null;

        if ($user_id == null) {
            header("Location: " . BASE_URL . "/AuthController/showLoginForm");
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy danh sách mã sản phẩm và số lượng từ form
            $masp_list = explode(",", $_POST['masp'][0]); // Danh sách mã sản phẩm từ form
            $so_luong_list = explode(",", $_POST['so_luong'][0]); // Danh sách số lượng từ form

            $danhsachsanpham = []; // Mảng để chứa danh sách sản phẩm

            $obj2 = $this->model('AdProductModel'); // Model xử lý dữ liệu sản phẩm

            // Duyệt qua danh sách mã sản phẩm và số lượng
            foreach ($masp_list as $index => $masp) {
                $so_luong = $so_luong_list[$index] ?? 0; // Lấy số lượng tương ứng, mặc định là 0 nếu không có

                // Lấy thông tin chi tiết sản phẩm từ database
                $sanpham = $obj2->getProductByID($masp);

                // Xây dựng mảng sản phẩm
                $danhsachsanpham[] = [
                    'sanpham' => $sanpham,
                    'so_luong' => $so_luong
                ];
            }

            // Lấy thông tin người dùng
            $obj = $this->model('AuthModel');
            $user = $obj->profile($user_id);

            // Trả dữ liệu về view
            $this->view("LayoutHome", [
                "User" => "Shop/CheckOutView",
                "danhsachsanpham" => $danhsachsanpham,
                "user" => $user
            ]);
        }
    }


    public function showBills($ma_khach_hang)
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
        // Lấy dữ liệu từ model
        $hoa_don = $this->model('BillModel')->getDataPurchase($ma_khach_hang);
        $this->view("LayoutHome", [
            "User" => "Profile/ProfileView", // Gọi ProfileView trong LayoutHome
            "Profile" => "PurchaseView",        // Gọi FileView trong ProfileView
            "hoa_don" => $hoa_don,
            "user" => $user               // Dữ liệu người dùng
        ]);
    }

    public function showDetailBill($ma_hoa_don)
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
        // Lấy dữ liệu từ model
        $chi_tiet_hoa_don = $this->model('BillModel')->getBillDetails($ma_hoa_don);
        $this->view("LayoutHome", [
            "User" => "Profile/ProfileView", // Gọi ProfileView trong LayoutHome
            "Profile" => "DetailBillView",        // Gọi FileView trong ProfileView
            "chi_tiet_hoa_don" => $chi_tiet_hoa_don,
            "user" => $user               // Dữ liệu người dùng
        ]);
    }

    public function showDetailBillAdmin($ma_hoa_don)
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
        // Lấy dữ liệu từ model
        $chi_tiet_hoa_don = $this->model('BillModel')->getBillDetails($ma_hoa_don);
        $this->view(
            "Manager_View",
            [
                "page" => "AdminDetailBill",
                "hoa_don" => $chi_tiet_hoa_don,
                "chi_tiet_hoa_don" => $chi_tiet_hoa_don,
                "user" => $user
            ]
        );
    }

    public function showAllBill()
    {
        // Lấy dữ liệu từ model
        $hoa_don = $this->model('BillModel')->getAllBill();
        $this->view(
            "Manager_View",
            ["page" => "AdminBillView", "hoa_don" => $hoa_don]
        );
    }

    public function updateOrderStatus()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $ma_hoa_don = $_POST['ma_hoa_don'];
            $trangthai = $_POST['trangthai'];

            if ($this->model('BillModel')->updateOrderStatus($ma_hoa_don, $trangthai)) {
                echo json_encode(['success' => true, 'message' => 'Trạng thái đơn hàng đã được cập nhật thành công!']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Có lỗi xảy ra khi cập nhật trạng thái đơn hàng.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Yêu cầu không hợp lệ.']);
        }
    }

}