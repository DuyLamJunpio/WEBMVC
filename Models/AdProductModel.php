<?php
class AdProductModel extends DB
{
    public function insertProduct($ma_loaisp, $tensp, $hinhanh, $soluong, $gianhap, $giaxuat, $khuyenmai, $mota_sp)
    {
        $check = "SELECT COUNT(*) FROM ad_product WHERE masp=:masp";
        $stm = $this->Connect()->prepare($check);
        $count = $stm->fetchColumn();
        if ($count > 0) {
            echo "Đã tồn tại mã sản phẩm model";
        } else {
            $sql = "INSERT INTO ad_product(ma_loaisp,tensp,hinhanh,soluong,gianhap,giaxuat,khuyenmai,mota_sp)";
            $sql .= " VALUES(:ma_loaisp,:tensp,:hinhanh,:soluong,:gianhap,:giaxuat,:khuyenmai,:mota_sp)";
            try {
                $stm = $this->Connect()->prepare($sql);
                $stm->bindParam(":ma_loaisp", $ma_loaisp);
                $stm->bindParam(":tensp", $tensp);
                $stm->bindParam(":hinhanh", $hinhanh);
                $stm->bindParam(":soluong", $soluong);
                $stm->bindParam(":gianhap", $gianhap);
                $stm->bindParam(":giaxuat", $giaxuat);
                $stm->bindParam(":khuyenmai", $khuyenmai);
                $stm->bindParam(":mota_sp", $mota_sp);
                $stm->execute();
                $_SESSION['message'] = 'Thêm mới thành công.';
            } catch (PDOException $e) {
                $_SESSION['message'] = 'Thêm mới không thành công.' . $e->getMessage();
            }
        }
    }
    public function deleteProduct($masp)
    {
        $check = "SELECT COUNT(*) FROM ad_product WHERE masp=:masp";
        $stm = $this->Connect()->prepare($check);
        $stm->bindParam(':masp', $masp);
        $stm->execute();
        $count = $stm->fetchColumn();

        if ($count > 0) {
            $sql = "DELETE FROM ad_product WHERE masp=:masp";
            try {
                $stm = $this->Connect()->prepare($sql);
                $stm->bindParam(':masp', $masp);
                $stm->execute();
                return "Xóa thành công";
            } catch (PDOException $e) {
                return "Xóa không thành công: " . $e->getMessage();
            }
        } else {
            return "Không tồn tại mã sản phẩm";
        }
    }
    public function getshow()
    {
        $check = "
            SELECT 
                ad_product.*, 
                ad_producttype.ten_loaisp
            FROM 
                ad_product 
            JOIN 
                ad_producttype 
            ON 
                ad_product.ma_loaisp = ad_producttype.ma_loaisp
        ";
        $stm = $this->Connect()->prepare($check);
        $stm->execute();
        $productList = $stm->fetchAll();
        return $productList;
    }

    public function update($masp, $tensp, $hinhanh, $gianhap, $giaxuat, $khuyenmai, $soluong, $mota_sp)
    {
        $sql = "UPDATE ad_product SET ";
        $sql .= "tensp = '$tensp', ";
        $sql .= "hinhanh = '$hinhanh', ";
        $sql .= "gianhap = $gianhap, ";
        $sql .= "giaxuat = $giaxuat, ";
        $sql .= "khuyenmai = $khuyenmai, ";
        $sql .= "soluong = $soluong, ";
        $sql .= "mota_sp = '$mota_sp' ";
        $sql .= "WHERE masp = '$masp'";
        try {
            $this->Connect()->exec($sql);
        } catch (PDOException $e) {
            echo "bạn cập nhật không thành công: " . $e->getMessage();
        }
    }

    public function getProduct()
    {
        $sql = "SELECT * FROM ad_product";
        $stm = $this->Connect()->prepare($sql);
        $stm->execute();
        $productList = $stm->fetchAll();
        return $productList;


    }
    public function getProductByID($masp)
    {
        $check = "
        SELECT 
            ad_product.*, 
            ad_producttype.ten_loaisp
        FROM 
            ad_product 
        JOIN 
            ad_producttype 
        ON 
            ad_product.ma_loaisp = ad_producttype.ma_loaisp
        WHERE 
            ad_product.masp = :masp
        ";
        $stm = $this->Connect()->prepare($check);
        $stm->bindParam(':masp', $masp, PDO::PARAM_STR);
        $stm->execute();
        $product = $stm->fetch();
        return $product;
    }




}