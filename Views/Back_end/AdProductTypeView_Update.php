<?php

if (is_array($data["ProductTypeID"])) {
    $txt_maloaisp = isset($_POST["txt_maloaisp"]) ? $_POST["txt_maloaisp"] : $data["ProductTypeID"]["ma_loaisp"];
    $txt_tenloaisp = isset($_POST["txt_tenloaisp"]) ? $_POST["txt_tenloaisp"] : $data["ProductTypeID"]["ten_loaisp"];
    $txt_motaloaisp = isset($_POST["txt_motaloaisp"]) ? $_POST["txt_motaloaisp"] : $data["ProductTypeID"]["mota_loaisp"];
} else {
    echo "Không tìm thấy loại sản phẩm.";
    exit();
}

?>

<form method="post" class="row g-3">
    <div class="col-md-6">
        <label for="txt_maloaisp" class="form-label">Mã loại sản phẩm</label>
        <input type="text" class="form-control" id="txt_maloaisp" name="txt_maloaisp" readonly
            value="<?php echo $txt_maloaisp; ?>" placeholder="Nhập mã loại sản phẩm">
    </div>
    <div class="col-md-6">
        <label for="txt_tenloaisp" class="form-label">Nhập tên loại sản phẩm</label>
        <input type="text" class="form-control" id="txt_tenloaisp" name="txt_tenloaisp"
            value="<?php echo $txt_tenloaisp; ?>" required placeholder="Nhập tên loại sản phẩm">
    </div>
    <div class="col-12">
        <label for="txt_motaloaisp">Mô tả loại sản phẩm</label>
        <textarea class="form-control" placeholder="Nhập mô tả" id="txt_motaloaisp" name="txt_motaloaisp"><?php echo $txt_motaloaisp; ?></textarea>
    </div>
    <div class="col-12">
        <button type="submit" name="btn_submit" class="btn btn-primary">Cập nhật</button>
    </div>
</form>