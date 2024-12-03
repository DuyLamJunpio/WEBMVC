<?php
class AdProduct extends Controller
{
    public function getShow()
    {
        $obj2 = $this->model("AdProductModel");
        $products = $obj2->getshow();
        $this->view(
            "Manager_View",
            ["page" => "AdProductView_List", "products" => $products]
        );
    }
    public function insert()
    {
        $obj1 = $this->model("AdProductTypeModel");
        $objProduct = $this->model("AdProductModel");
        if(isset($_FILES["uploadfile"])){
            $hinhanh= isset($_FILES["uploadfile"]) ? $_FILES["uploadfile"]["name"]:"";
            $target_dir = "./public/images/";
            $target_file = $target_dir . basename($_FILES["uploadfile"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            $check = getimagesize($_FILES["uploadfile"]["tmp_name"]);
            if($check !== false && in_array($imageFileType, ['jpg', 'png', 'gif'])) {
                if ($_FILES["uploadfile"]["size"] < 1000000) { // Check file size, size > 10MB
                    if (move_uploaded_file($_FILES["uploadfile"]["tmp_name"], $target_file)) {
                        $uploadOk = 1;
                    } else {
                        $uploadOk = 0;
                        echo 'Lỗi khi di chuyển tệp.';
                    }
                } else {
                    $uploadOk = 0;
                    echo 'Tệp quá lớn.';
                }
            } else {
                $uploadOk = 0;
                echo 'Tệp không phải là hình ảnh hoặc định dạng không được hỗ trợ.';
            }
            if($uploadOk == 1){
                $txt_maloaisp = isset($_POST['txt_maloaisp']) ? $_POST['txt_maloaisp'] : "";
                $txt_tensp = isset($_POST['txt_tensp']) ? $_POST['txt_tensp'] : "";
                $txt_gianhap = isset($_POST['txt_gianhap']) ? $_POST['txt_gianhap'] : "";
                $txt_giaxuat = isset($_POST['txt_giaxuat']) ? $_POST['txt_giaxuat'] : "";
                $txt_soluong = isset($_POST['txt_soluong']) ? $_POST['txt_soluong'] : "";
                $txt_khuyenmai = isset($_POST['txt_khuyenmai']) ? $_POST['txt_khuyenmai'] : "";
                $txt_mota = isset($_POST['txt_mota']) ? $_POST['txt_mota'] : "";
                $create_date = isset($_POST['create_date']) ? $_POST['create_date'] : "";
                $result = $objProduct->insertProduct($txt_maloaisp,$txt_tensp,$hinhanh,$txt_soluong,$txt_gianhap,$txt_giaxuat,$txt_khuyenmai
                ,$txt_mota,$create_date);
            }else{
                echo 'upload file không thành công';
            }
            
        }
        $productType = $obj1->getShowAdProductType();
        $this->view("Manager_View", ["page" => "AdProductView_Add", "productType" => $productType]);
    }
    public function delete($masp)
    {
        $obj = $this->model("AdProductModel");
    
        // Lấy thông tin sản phẩm để biết tên file ảnh
        $product = $obj->getProductByID($masp);
        if ($product) {
            $imagePath = "./public/images/" . $product['hinhanh'];
    
            // Xóa ảnh nếu tồn tại
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
    
            // Xóa sản phẩm khỏi cơ sở dữ liệu
            $obj->deleteProduct($masp);
    
            session_start();
            $_SESSION['message'] = 'Xóa sản phẩm thành công.';
        } else {
            session_start();
            $_SESSION['message'] = 'Sản phẩm không tồn tại.';
        }
    
        header("Location: ..");
        exit();
    }

    public function update($masp)
    {
        $obj = $this->model("AdProductModel");

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $product = $obj->getProductByID($masp);
            $currentImage = $product['hinhanh'];

            $hinhanh = $currentImage; // Giữ nguyên ảnh cũ nếu không có ảnh mới
            $target_dir = "./public/images/";

            if (isset($_FILES["uploadfile"]) && $_FILES["uploadfile"]["error"] == 0) {
                $target_file = $target_dir . basename($_FILES["uploadfile"]["name"]);
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                $check = getimagesize($_FILES["uploadfile"]["tmp_name"]);

                if ($check !== false && in_array($imageFileType, ['jpg', 'png', 'jpeg', 'gif'])) {
                    if ($_FILES["uploadfile"]["size"] < 500000) { // Check file size
                        if (move_uploaded_file($_FILES["uploadfile"]["tmp_name"], $target_file)) {
                            // Xóa ảnh cũ nếu có ảnh mới
                            if ($currentImage && file_exists($target_dir . $currentImage)) {
                                unlink($target_dir . $currentImage);
                            }
                            $hinhanh = $_FILES["uploadfile"]["name"];
                        } else {
                            echo 'Lỗi khi di chuyển tệp.';
                        }
                    } else {
                        echo 'Tệp quá lớn.';
                    }
                } else {
                    echo 'Tệp không phải là hình ảnh hoặc định dạng không được hỗ trợ.';
                }
            }

            $tensp = isset($_POST["tensp"]) ? $_POST["tensp"] : '';
            $gianhap = isset($_POST["gianhap"]) ? $_POST["gianhap"] : 0;
            $giaxuat = isset($_POST["giaxuat"]) ? $_POST["giaxuat"] : 0;
            $khuyenmai = isset($_POST["khuyenmai"]) ? $_POST["khuyenmai"] : 0;
            $soluong = isset($_POST["soluong"]) ? $_POST["soluong"] : 0;
            $mota_sp = isset($_POST["mota_sp"]) ? $_POST["mota_sp"] : '';

            $obj->update($masp, $tensp, $hinhanh, $gianhap, $giaxuat, $khuyenmai, $soluong, $mota_sp);

            session_start();
            $_SESSION['message'] = 'Cập nhật thành công.';
            header("Location: ..");
            exit();
        }

        $product = $obj->getProductByID($masp);
        $this->view("Manager_View", [
            "page" => "AdProductView_update",
            "product" => $product
        ]);
    }
}
