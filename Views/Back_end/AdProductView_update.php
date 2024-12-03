<?php

if (is_array($data["product"])) {
    $txt_maloaisp = isset($_POST["txt_maloaisp"]) ? $_POST["txt_maloaisp"] : $data["product"]["ma_loaisp"];
    $masp = isset($_POST["masp"]) ? $_POST["masp"] : $data["product"]["masp"];
    $tensp = isset($_POST["tensp"]) ? $_POST["tensp"] : $data["product"]["tensp"];
    $hinhanh = isset($_POST["hinhanh"]) ? $_POST["hinhanh"] : $data["product"]["hinhanh"];
    $gianhap = isset($_POST["gianhap"]) ? $_POST["gianhap"] : $data["product"]["gianhap"];
    $giaxuat = isset($_POST["giaxuat"]) ? $_POST["giaxuat"] : $data["product"]["giaxuat"];
    $khuyenmai = isset($_POST["khuyenmai"]) ? $_POST["khuyenmai"] : $data["product"]["khuyenmai"];
    $soluong = isset($_POST["soluong"]) ? $_POST["soluong"] : $data["product"]["soluong"];
    $mota_sp = isset($_POST["mota_sp"]) ? $_POST["mota_sp"] : $data["product"]["mota_sp"];
    $create_date = isset($_POST["created_at"]) ? $_POST["created_at"] : $data["product"]["created_at"];
} else {
    echo "Không tìm thấy sản phẩm.";
    exit();
}

?>

<form method="post" enctype="multipart/form-data" class="row g-3">
    <div class="col-md-6">
        <label for="hinhanh_sp" class="form-label">Ảnh sản phẩm</label>
        <input class="form-control" type="file" id="hinhanh_sp" name="uploadfile">
        <img id="preview" src="<?php echo BASE_URL; ?>/public/images/<?php echo $hinhanh ?>" class="img-thumbnail mt-2">
    </div>
    <div class="col-md-6">
        <div class="col-12">
            <label for="create_date" class="form-label">Ngày tạo</label>
            <input type="text" class="form-control" id="create_date" name="created_at" readonly
                value="<?php echo $create_date; ?>">
        </div>
        <div class="col-12">
            <label for="masp" class="form-label">Mã sản phẩm</label>
            <input type="text" class="form-control" id="masp" name="masp" readonly value="<?php echo $masp; ?>"
                placeholder="Nhập mã sản phẩm">
        </div>
        <div class="col-12">
            <label for="txt_maloaisp" class="form-label">Mã loại sản phẩm</label>
            <input type="text" class="form-control" id="txt_maloaisp" name="txt_maloaisp" readonly
                value="<?php echo $txt_maloaisp; ?>" required placeholder="Mã loại sản phẩm">
        </div>
        <div class="col-12">
            <label for="tensp" class="form-label">Tên sản phẩm</label>
            <input type="text" class="form-control" id="tensp" name="tensp" value="<?php echo $tensp; ?>" required
                placeholder="Tên sản phẩm">
        </div>
        <div class="col-12">
            <label for="gianhap" class="form-label">Giá nhập</label>
            <input type="number" class="form-control" id="gianhap" name="gianhap" value="<?php echo $gianhap; ?>"
                required>
        </div>
        <div class="col-12">
            <label for="giaxuat" class="form-label">Giá xuất</label>
            <input type="number" class="form-control" id="giaxuat" name="giaxuat" value="<?php echo $giaxuat; ?>"
                required>
        </div>
        <div class="col-12">
            <label for="khuyenmai" class="form-label">Khuyến mại</label>
            <input type="number" class="form-control" id="khuyenmai" name="khuyenmai" value="<?php echo $khuyenmai; ?>"
                required>
        </div>
        <div class="col-12">
            <label for="soluong" class="form-label">Số lượng</label>
            <input type="number" class="form-control" id="soluong" name="soluong" value="<?php echo $soluong; ?>"
                required>
        </div>
        <div class="col-12">
            <label for="mota_sp" class="form-label">Mô tả sản phẩm</label>
            <textarea class="form-control" placeholder="Nhập mô tả" id="mota_sp"
                name="mota_sp"><?php echo $mota_sp; ?></textarea>
        </div>
        <div class="col-12 mt-3">
            <button type="submit" name="btn_submit" class="btn btn-primary">Cập nhật</button>
        </div>
    </div>
</form>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
        $(document).ready(function() {
            // Lấy các phần tử DOM cần thiết
            var imageInput = $("#hinhanh_sp");
            var previewImage = $("#preview");

            // Sự kiện click cho button "Choose image"
            previewImage.on("click", function() {
                imageInput.click(); // Kích hoạt sự kiện click trên input type=file
            });

            // Sự kiện khi có thay đổi trong input type=file
            imageInput.on("change", function() {
                var file = this.files[0]; // Lấy file đầu tiên từ danh sách các file được chọn
                if (file) {
                    // Đọc file hình ảnh dưới dạng URL
                    var reader = new FileReader();
                    reader.onload = function(event) {
                        // Hiển thị hình ảnh đã chọn lên thẻ <img>
                        previewImage.attr("src", event.target.result);
                    };
                    reader.readAsDataURL(file); // Đọc file dưới dạng URL Data
                }
            });
        });
</script>