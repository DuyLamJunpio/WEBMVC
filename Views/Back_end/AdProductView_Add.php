<?php
require_once("./Models/AdProductModel.php");

$model = new AdProductModel();

$txt_maloaisp = "";
$txt_masp = "";
$txt_tensp = "";
$txt_gianhap = "";
$txt_giaxuat = "";
$txt_khuyenmai = "";
$txt_soluong = "";
$txt_mota = "";
?>

<form method="post" enctype="multipart/form-data" class="row g-3">
    <div class="col-md-6">
        <label for="hinhanh_sp" class="form-label">Ảnh sản phẩm</label>
        <input class="form-control" type="file" id="hinhanh_sp" name="uploadfile">
        <img id="preview" src="https://t4.ftcdn.net/jpg/05/65/22/41/360_F_565224180_QNRiRQkf9Fw0dKRoZGwUknmmfk51SuSS.jpg"
            class="img-thumbnail mt-2">
    </div>
    <div class="col-md-6">
        <div class="col-12">
            <label for="txt_maloaisp" class="form-label">Mã loại sản phẩm</label>
            <select class="form-select" id="txt_maloaisp" name="txt_maloaisp">
                <?php
                foreach ($data["productType"] as $k => $v) {
                    ?>
                    <option value="<?php echo $v["ma_loaisp"] ?>">
                        <?php echo $v["ten_loaisp"] ?>
                    </option>
                <?php } ?>
            </select>
        </div>
        <div class="col-12">
            <label for="tensp" class="form-label">Tên sản phẩm</label>
            <input type="text" name="txt_tensp" class="form-control" id="tensp" placeholder="Nhập tên sản phẩm"
                value="<?php echo $txt_tensp; ?>" required />
        </div>
        <div class="col-12">
            <label for="gianhap" class="form-label">Giá nhập</label>
                <input type="number" name="txt_gianhap" class="form-control" id="gianhap" placeholder="Giá nhập" value="0"/>
        </div>
        <div class="col-12">
            <label for="giaxuat" class="form-label">Giá xuất</label>
                <input type="number" name="txt_giaxuat" class="form-control" id="giaxuat" value="0"/>
        </div>
        <div class="col-12">
            <label for="khuyenmai" class="form-label">Khuyến mại</label>
                <input type="number" name="txt_khuyenmai" class="form-control" id="khuyenmai" value="0"/>
        </div>
        <div class="col-12">
            <label for="soluong" class="form-label">Số lượng</label>
                <input type="number" name="txt_soluong" class="form-control" id="soluong" value="0"
                required />
        </div>
        <div class="col-12">
            <label for="mota_sp" class="form-label">Mô tả sản phẩm</label>
            <textarea class="form-control" placeholder="Nhập mô tả" id="mota_sp"
                name="txt_mota"></textarea>
        </div>
        <div class="col-12 mt-3">
            <button type="submit" class="btn btn-primary">Thêm mới</button>
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

