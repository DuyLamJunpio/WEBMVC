<?php
class AdProductTypeModel extends DB{
    // phương thức hiển thị trang quản lý loại sản phẩm
    public function getShowAdProductType(){
        $sql="SELECT * FROM ad_producttype";
        $stm=$this->Connect()->prepare($sql);
        $stm->execute();
        $productType=$stm->fetchAll();
        return  $productType;
    }
    public function deleteAdProductType($ma_loaisp){
        $sql ="DELETE FROM ad_producttype WHERE ma_loaisp='$ma_loaisp'";
        $this->Connect()->exec($sql);
        //$stm->execute();
    }
    public function insertAdProductType($ten_loaisp, $mota_loaisp){
        $sql ="INSERT INTO ad_producttype (ten_loaisp,mota_loaisp) ";
        $sql.="VALUE ('$ten_loaisp', '$mota_loaisp')";
        $stm= $this->Connect()->prepare($sql);
        try{
            $stm->execute();
        }
        catch (PDOException $e){
            echo "bạn lưu không thành công". $e->getMessage();
        }
    }
    public function getProductTypeID($ma_loaisp){
        $sql ="SELECT * FROM ad_producttype WHERE ma_loaisp='$ma_loaisp'";
        $stm= $this->Connect()->prepare($sql);
        $stm->execute();
        $productTypeID=$stm->fetch();
        return  $productTypeID;
    }
    public function updateProductType($ma_loaisp,$ten_loaisp,$mota_loaisp){
        $sql ="UPDATE ad_producttype SET";
        $sql.=" ten_loaisp='$ten_loaisp',mota_loaisp='$mota_loaisp' ";
        $sql.= "WHERE ma_loaisp='$ma_loaisp'";
        try{
            $this->Connect()->exec($sql);
        }
        catch(PDOException $e){
            echo "bạn cập nhật không thành công".$e->getMessage();
        }
    }
}