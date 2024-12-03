<?php
class AdProductType extends Controller
{
    public function getShow()
    {
        $obj = $this->model("AdProductTypeModel");
        $data = $obj->getShowAdProductType();

        // $this->view("AdProductTypeView",$data);
        $this->view(
            "Manager_View",
            ["page" => "AdProductTypeView", "ProductTypeList" => $data]
        );
    }
    public function delete($ma_loaisp)
    {
        $obj = $this->model("AdProductTypeModel");
        $obj->deleteAdProductType($ma_loaisp);
        header("location: ..");
    }
    public function insert()
    {
        $obj = $this->model("AdProductTypeModel");
        $txt_tenloaisp = isset($_POST["txt_tenloaisp"]) ? $_POST["txt_tenloaisp"] : "";
        $txt_motaloaisp = isset($_POST["txt_motaloaisp"]) ? $_POST["txt_motaloaisp"] : "";
        $obj->insertAdProductType($txt_tenloaisp, $txt_motaloaisp);
        $_SESSION['messageType'] = 'Thêm mới thành công.';
        header("Location: " . BASE_URL . "/AdProductType/getShow");
        exit();
    }
    public function update($ma_loaisp)
    {
        $obj = $this->model("AdProductTypeModel");
        $productTypeID = $obj->getProductTypeID($ma_loaisp);

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $txt_tenloaisp = isset($_POST["txt_tenloaisp"]) ? $_POST["txt_tenloaisp"] : $productTypeID["ten_loaisp"];
            $txt_motaloaisp = isset($_POST["txt_motaloaisp"]) ? $_POST["txt_motaloaisp"] : $productTypeID["mota_loaisp"];
            $obj->updateProductType($ma_loaisp, $txt_tenloaisp, $txt_motaloaisp);
            session_start();
            $_SESSION['messageType'] = 'Cập nhật thành công.';
            header("Location: ..");
            exit();
        }

        $this->view("Manager_View", [
            "page" => "AdProductTypeView_update",
            "ProductTypeID" => $productTypeID
        ]);
    }
}