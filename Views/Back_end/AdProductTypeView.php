<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['messageType'])) {
    echo "<script>
        window.onload = function() {
            alert('" . $_SESSION['messageType'] . "');
        };
    </script>";

    // Xóa thông báo sau khi hiển thị
    unset($_SESSION['messageType']);
    session_write_close();
}

$obj = new AdProductType;
$txt_maloaisp = "";
$txt_tenloaisp = "";
$txt_motaloaisp = "";
?>

<h5 class="ps-2">Quản lý danh mục loại sản phẩm</h5>
<form method="post">
    <div class="container text-center bg-white py-2 px-2">
        <div class="row">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Tên loại sản phẩm" required name="txt_tenloaisp"
                    value="<?php echo $txt_tenloaisp; ?>">
                <input type="text" class="form-control" placeholder="Mô tả" name="txt_motaloaisp"
                    value="<?php echo $txt_motaloaisp; ?>">
                <button type="submit" class="btn btn-outline-primary" name="insert" value="insert"
                    formaction="./insert">Thêm mới</button>
            </div>
        </div>
    </div>
</form>
<table class="table">
    <thead>
        <tr>
            <th scope="col" class="text-center">Mã loại sản phẩm</th>
            <th scope="col" class="text-center">Tên loại sản phẩm</th>
            <th scope="col" class="text-center">Mô tả loại sản phẩm</th>
            <th scope="col" colspan="2" class="text-center">Chức năng</th>
        </tr>
    </thead>
    <tbody class="table-group-divider">
        <?php foreach ($data["ProductTypeList"] as $k => $v) { ?>
            <tr>
                <td><?php echo $v["ma_loaisp"] ?></td>
                <td><?php echo $v["ten_loaisp"] ?></td>
                <td><?php echo $v["mota_loaisp"] ?></td>
                <td>
                    <a class="btn btn-primary" href="./update/<?php echo $v["ma_loaisp"] ?>">Cập nhật</a>
                </td>
                <td>
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal"
                        data-id="<?php echo $v["ma_loaisp"] ?>">
                        xóa
                    </button>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<!-- Modal Delete -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Xóa loại sản phẩm</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Bạn có đồng ý xóa loại sản phẩm này không ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                <a class="btn btn-danger" id="confirmDelete" href="#">Xóa</a>
            </div>
        </div>
    </div>
</div>

<script>
    // Lắng nghe sự kiện khi modal được hiển thị
    var exampleModal = document.getElementById('exampleModal');
    exampleModal.addEventListener('show.bs.modal', function (event) {
        // Nút kích hoạt modal
        var button = event.relatedTarget;
        // Lấy giá trị từ thuộc tính data-id
        var maLoaiSP = button.getAttribute('data-id');
        // Cập nhật liên kết xóa trong modal
        var confirmDelete = document.getElementById('confirmDelete');
        confirmDelete.href = './delete/' + maLoaiSP;
    });
</script>