<?php
class BillModel extends DB
{
    public function insertBill($ma_khach_hang, $tong_thanh_toan, $danh_sach_san_pham)
    {
        try {
            $db = $this->Connect();

            // Bắt đầu giao dịch
            $db->beginTransaction();

            // Thêm hóa đơn
            $sqlHoaDon = "INSERT INTO hoa_don (ma_khach_hang, tong_thanh_toan) 
                          VALUES (:ma_khach_hang, :tong_thanh_toan)";
            $stmHoaDon = $db->prepare($sqlHoaDon);
            $stmHoaDon->bindParam(':ma_khach_hang', $ma_khach_hang);
            $stmHoaDon->bindParam(':tong_thanh_toan', $tong_thanh_toan);
            $stmHoaDon->execute();

            // Lấy ID hóa đơn vừa thêm
            $ma_hoa_don = $db->lastInsertId();

            // Thêm chi tiết hóa đơn
            $sqlChiTiet = "INSERT INTO chi_tiet_hoa_don (ma_hoa_don, masp, so_luong, tong_tien) 
                           VALUES (:ma_hoa_don, :masp, :so_luong, :tong_tien)";
            $stmChiTiet = $db->prepare($sqlChiTiet);

            foreach ($danh_sach_san_pham as $san_pham) {
                $stmChiTiet->bindParam(':ma_hoa_don', $ma_hoa_don);
                $stmChiTiet->bindParam(':masp', $san_pham['masp']);
                $stmChiTiet->bindParam(':so_luong', $san_pham['so_luong']);
                $stmChiTiet->bindParam(':tong_tien', $san_pham['tong_tien']);
                $stmChiTiet->execute();
            }

            // Hoàn tất giao dịch
            $db->commit();
            return true;

        } catch (PDOException $e) {
            // Rollback nếu có lỗi và giao dịch đã bắt đầu
            if ($db->inTransaction()) {
                $db->rollBack();
            }
            echo "Lỗi thêm hóa đơn: " . $e->getMessage();
            return false;
        }
    }

    public function getDataPurchase($ma_khach_hang)
    {
        $sql = "SELECT hoa_don.*, chi_tiet_hoa_don.*, ad_product.*, ad_producttype.ten_loaisp 
                FROM hoa_don 
                JOIN chi_tiet_hoa_don ON hoa_don.ma_hoa_don = chi_tiet_hoa_don.ma_hoa_don
                JOIN ad_product ON chi_tiet_hoa_don.masp = ad_product.masp
                JOIN ad_producttype ON ad_product.ma_loaisp = ad_producttype.ma_loaisp
                WHERE hoa_don.ma_khach_hang = :ma_khach_hang";
        $stm = $this->Connect()->prepare($sql);
        $stm->bindParam(':ma_khach_hang', $ma_khach_hang);
        $stm->execute();
        $hoa_don = $stm->fetchAll();

        // Gộp các chi tiết hóa đơn có cùng ma_hoa_don
        $grouped_hoa_don = [];
        foreach ($hoa_don as $item) {
            $ma_hoa_don = $item['ma_hoa_don'];
            if (!isset($grouped_hoa_don[$ma_hoa_don])) {
                $grouped_hoa_don[$ma_hoa_don] = [
                    'hoa_don' => [
                        'ma_hoa_don' => $item['ma_hoa_don'],
                        'ma_khach_hang' => $item['ma_khach_hang'],
                        'tong_thanh_toan' => $item['tong_thanh_toan'],
                        // Thêm các thông tin khác của hóa đơn nếu cần
                    ],
                    'chi_tiet' => []
                ];
            }
            $grouped_hoa_don[$ma_hoa_don]['chi_tiet'][] = [
                'masp' => $item['masp'],
                'so_luong' => $item['so_luong'],
                'tong_tien' => $item['tong_tien'],
                'tensp' => $item['tensp'],
                'ten_loaisp' => $item['ten_loaisp'],
                'hinhanh' => $item['hinhanh'],
                // Thêm các thông tin khác của chi tiết hóa đơn nếu cần
            ];
        }

        return $grouped_hoa_don;
    }

    public function getBillDetails($ma_hoa_don)
    {
        $sql = "SELECT hoa_don.*, chi_tiet_hoa_don.*, ad_product.*, ad_producttype.ten_loaisp, users.* 
                FROM hoa_don 
                JOIN chi_tiet_hoa_don ON hoa_don.ma_hoa_don = chi_tiet_hoa_don.ma_hoa_don
                JOIN ad_product ON chi_tiet_hoa_don.masp = ad_product.masp
                JOIN ad_producttype ON ad_product.ma_loaisp = ad_producttype.ma_loaisp
                JOIN users ON hoa_don.ma_khach_hang = users.id
                WHERE hoa_don.ma_hoa_don = :ma_hoa_don";
        $stm = $this->Connect()->prepare($sql);
        $stm->bindParam(':ma_hoa_don', $ma_hoa_don);
        $stm->execute();
        $chi_tiet_hoa_don = $stm->fetchAll();

        // Gộp các chi tiết hóa đơn
        $grouped_chi_tiet = [
            'hoa_don' => [],
            'chi_tiet' => []
        ];
        foreach ($chi_tiet_hoa_don as $item) {
            if (empty($grouped_chi_tiet['hoa_don'])) {
                $grouped_chi_tiet['hoa_don'] = [
                    'ma_hoa_don' => $item['ma_hoa_don'],
                    'ma_khach_hang' => $item['ma_khach_hang'],
                    'tong_thanh_toan' => $item['tong_thanh_toan'],
                    'trangthai' => $item['trangthai'],
                    'created_at' => $item['created_at'],
                    // Thêm tất cả thông tin người dùng
                    'user_info' => [
                        'hoten' => $item['hoten'],
                        'email' => $item['email'],
                        // Thêm các trường khác từ bảng users nếu cần
                        'diachi' => $item['diachi'], // ví dụ
                        'sodienthoai' => $item['sodienthoai'] // ví dụ
                    ]
                ];
            }
            $grouped_chi_tiet['chi_tiet'][] = [
                'masp' => $item['masp'],
                'so_luong' => $item['so_luong'],
                'tong_tien' => $item['tong_tien'],
                'tensp' => $item['tensp'],
                'ten_loaisp' => $item['ten_loaisp'],
                'hinhanh' => $item['hinhanh'],
                'giaxuat' => $item['giaxuat'],
                'khuyenmai' => $item['khuyenmai']
            ];
        }

        return $grouped_chi_tiet;
    }

    public function getAllBill()
    {
        $sql = "SELECT hoa_don.*, chi_tiet_hoa_don.*, ad_product.*, ad_producttype.ten_loaisp, users.* 
                FROM hoa_don 
                JOIN chi_tiet_hoa_don ON hoa_don.ma_hoa_don = chi_tiet_hoa_don.ma_hoa_don
                JOIN ad_product ON chi_tiet_hoa_don.masp = ad_product.masp
                JOIN ad_producttype ON ad_product.ma_loaisp = ad_producttype.ma_loaisp
                JOIN users ON hoa_don.ma_khach_hang = users.id";
        $stm = $this->Connect()->prepare($sql);
        $stm->execute();
        $chi_tiet_hoa_don = $stm->fetchAll();

        // Gộp các chi tiết hóa đơn
        $grouped_chi_tiet = [];
        foreach ($chi_tiet_hoa_don as $item) {
            $ma_hoa_don = $item['ma_hoa_don'];
            if (!isset($grouped_chi_tiet[$ma_hoa_don])) {
                $grouped_chi_tiet[$ma_hoa_don] = [
                    'hoa_don' => [
                        'ma_hoa_don' => $item['ma_hoa_don'],
                        'ma_khach_hang' => $item['ma_khach_hang'],
                        'tong_thanh_toan' => $item['tong_thanh_toan'],
                        'trangthai' => $item['trangthai'],
                        'created_at' => $item['created_at'],
                        // Thêm tất cả thông tin người dùng
                        'user_info' => [
                            'hoten' => $item['hoten'],
                            'email' => $item['email'],
                            // Thêm các trường khác từ bảng users nếu cần
                            'diachi' => $item['diachi'], // ví dụ
                            'sodienthoai' => $item['sodienthoai'] // ví dụ
                        ]
                    ],
                    'chi_tiet' => []
                ];
            }
            $grouped_chi_tiet[$ma_hoa_don]['chi_tiet'][] = [
                'masp' => $item['masp'],
                'so_luong' => $item['so_luong'],
                'tong_tien' => $item['tong_tien'],
                'tensp' => $item['tensp'],
                'ten_loaisp' => $item['ten_loaisp'],
                'hinhanh' => $item['hinhanh'],
                'giaxuat' => $item['giaxuat'],
                'khuyenmai' => $item['khuyenmai']
            ];
        }

        return $grouped_chi_tiet;
    }

    public function updateOrderStatus($ma_hoa_don, $trangthai)
    {
        $sql = "UPDATE hoa_don SET trangthai = :trangthai WHERE ma_hoa_don = :ma_hoa_don";
        $stm = $this->Connect()->prepare($sql);
        try {
            $stm->bindParam(':trangthai', $trangthai, PDO::PARAM_INT);
            $stm->bindParam(':ma_hoa_don', $ma_hoa_don, PDO::PARAM_INT);
            $stm->execute();
            return true;
        } catch (PDOException $e) {
            echo "Cập nhật trạng thái không thành công: " . $e->getMessage();
            return false;
        }
    }

}