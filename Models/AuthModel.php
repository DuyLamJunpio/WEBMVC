<?php
class AuthModel extends DB
{
    // Hàm đăng ký người dùng
    public function register($tendangnhap, $email, $matkhau, $hoten, $sodienthoai, $gioitinh)
    {
        //Mã hóa password
        $mahoa_matkhau = password_hash($matkhau, PASSWORD_DEFAULT);

        try {
            $stmt = $this->Connect()->prepare("INSERT INTO users (tendangnhap, email, matkhau, mucdotruycap, hoten, sodienthoai, gioitinh) VALUES (:tendangnhap, :email, :matkhau, 0, :hoten, :sodienthoai, :gioitinh)");

            $stmt->bindParam(":tendangnhap", $tendangnhap);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":matkhau", $mahoa_matkhau);
            $stmt->bindParam(":hoten", $hoten);
            $stmt->bindParam(":sodienthoai", $sodienthoai);
            $stmt->bindParam(":gioitinh", $gioitinh);

            if ($stmt->execute()) {
                return true; // Đăng ký thành công
            } else {
                return "Lỗi: " . implode(", ", $stmt->errorInfo()); // Trả về chi tiết lỗi
            }
        } catch (PDOException $e) {
            return "Lỗi: " . $e->getMessage(); // Bắt lỗi và trả về chi tiết
        }
    }

    // Hàm đăng nhập người dùng
    public function login($email, $matkhau)
    {
        try {
            // Chuẩn bị truy vấn để lấy tất cả các trường
            $stmt = $this->Connect()->prepare("SELECT * FROM users WHERE email = :email");
            $stmt->bindParam(":email", $email);

            // Thực thi truy vấn
            $stmt->execute();

            // Kiểm tra email tồn tại
            if ($stmt->rowCount() > 0) {
                // Lấy thông tin người dùng
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                $mahoa_matkhau = $result['matkhau'];

                // Kiểm tra mật khẩu
                if (password_verify($matkhau, $mahoa_matkhau)) {
                    unset($result['matkhau']); // Loại bỏ mật khẩu khỏi kết quả trả về
                    return $result; // Trả về toàn bộ thông tin người dùng
                } else {
                    return "Mật khẩu không đúng."; // Thông báo mật khẩu không đúng
                }
            } else {
                return "Email không tồn tại."; // Thông báo email không tồn tại
            }
        } catch (PDOException $e) {
            return "Lỗi: " . $e->getMessage(); // Bắt lỗi và trả về chi tiết
        }
    }

    public function updateUserAddress($userId, $newAddress)
    {
        try {
            $sql = "UPDATE users SET diachi = :newAddress WHERE id = :userId";
            $stmt = $this->Connect()->prepare($sql);
            $stmt->bindParam(':newAddress', $newAddress, PDO::PARAM_STR);
            $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
            $stmt->execute();

            // Kiểm tra xem có hàng nào được cập nhật không
            if ($stmt->rowCount() > 0) {
                return true; // Cập nhật thành công
            } else {
                return false; // Không có thay đổi nào
            }
        } catch (PDOException $e) {
            // Log lỗi nếu cần
            error_log("Error updating user address: " . $e->getMessage());
            return false; // Xử lý lỗi
        }
    }

    public function profile($id)
    {
        $data = "SELECT * FROM users WHERE id = :id";
        $stm = $this->Connect()->prepare($data);
        $stm->bindParam(':id', $id, PDO::PARAM_INT);
        $stm->execute();
        $user = $stm->fetch();
        return $user;
    }

    public function listUser()
    {
        $data = "SELECT * FROM users";
        $stm = $this->Connect()->prepare($data);
        $stm->execute();
        $users = $stm->fetchAll();
        return $users;
    }

    public function getCustomerDetails($userId)
    {
        $sql = "SELECT users.*, 
                       SUM(hoa_don.tong_thanh_toan) AS total_spent, 
                       MAX(hoa_don.created_at) AS last_purchase
                FROM users
                LEFT JOIN hoa_don ON users.id = hoa_don.ma_khach_hang
                WHERE users.id = :userId
                GROUP BY users.id";
        $stm = $this->Connect()->prepare($sql);
        $stm->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stm->execute();
        $customerDetails = $stm->fetch(PDO::FETCH_ASSOC);
        return $customerDetails;
    }

    public function deleteUser($userId)
    {
        $sql = "DELETE FROM users WHERE id = :userId";
        $stm = $this->Connect()->prepare($sql);
        $stm->bindParam(':userId', $userId, PDO::PARAM_INT);
        return $stm->execute();
    }

    public function hasOrders($userId) {
        $sql = "SELECT COUNT(*) as order_count FROM hoa_don WHERE ma_khach_hang = :userId";
        $stm = $this->Connect()->prepare($sql);
        $stm->bindParam(':userId', $userId, PDO::PARAM_INT);
        $stm->execute();
        $result = $stm->fetch(PDO::FETCH_ASSOC);
        return $result['order_count'] > 0;
    }

}
