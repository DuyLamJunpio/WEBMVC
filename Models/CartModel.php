<?php
class CartModel extends DB
{
    public function insertCart($masp, $ma_khach_hang, $so_luong)
    {
        $sql = "INSERT INTO gio_hang (masp,ma_khach_hang,so_luong) ";
        $sql .= "VALUE ('$masp', '$ma_khach_hang', '$so_luong')";
        $stm = $this->Connect()->prepare($sql);
        try {
            $stm->execute();
        } catch (PDOException $e) {
            echo "Thêm vào giỏ hàng không thành công" . $e->getMessage();
        }
    }

    public function checkProductInCart($masp)
    {
        $data = "SELECT * FROM gio_hang WHERE masp = :masp";
        $stm = $this->Connect()->prepare($data);
        $stm->bindParam(':masp', $masp, PDO::PARAM_INT);
        $stm->execute();
        $cart = $stm->fetch();
        return $cart;
    }

    public function getDataCart($ma_khach_hang)
    {
        $sql = "SELECT gio_hang.*, ad_product.* 
                FROM gio_hang 
                JOIN ad_product ON gio_hang.masp = ad_product.masp
                WHERE gio_hang.ma_khach_hang = :ma_khach_hang";
        $stm = $this->Connect()->prepare($sql);
        $stm->bindParam(':ma_khach_hang', $ma_khach_hang, PDO::PARAM_INT);
        $stm->execute();
        $carts = $stm->fetchAll();
        return $carts;
    }

    public function updateCart($id, $so_luong)
    {
        $sql = "UPDATE gio_hang SET so_luong = :so_luong WHERE id = :id";
        $stm = $this->Connect()->prepare($sql);
        try {
            $stm->bindParam(':so_luong', $so_luong, PDO::PARAM_INT);
            $stm->bindParam(':id', $id, PDO::PARAM_INT);
            $stm->execute();
        } catch (PDOException $e) {
            echo "Cập nhật không thành công: " . $e->getMessage();
        }
    }

    public function deleteAdInCart($id)
    {
        $sql = "DELETE FROM gio_hang WHERE id='$id'";
        $this->Connect()->exec($sql);
    }
}