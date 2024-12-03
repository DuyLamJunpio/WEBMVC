<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['message'])) {
    echo "<script>
        window.onload = function() {
            alert('" . $_SESSION['message'] . "');
        };
    </script>";

    // Xóa thông báo sau khi hiển thị
    unset($_SESSION['message']);
    session_write_close();
}

?>

<div class="container d-flex justify-content-between align-items-center">
    <h5 class="ps-2">Quản lý sản phẩm</h5>
    <a class="btn btn-success" href="./insert">
        Thêm mới
    </a>
</div>
<table class="table mt-2">
    <thead>
        <tr>
            <th scope="col" class="text-center">
                Mã sản phẩm
            </th>
            <th scope="col" class="text-center">
                Mã loại sản phẩm
            </th>
            <th scope="col" class="text-center">
                Tên sản phẩm
            </th>
            <th scope="col" class="text-center">
                Hình ảnh
            </th>
            <th scope="col" class="text-center">
                Giá nhập
            </th>
            <th scope="col" class="text-center">
                Giá xuất
            </th>
            <th scope="col" class="text-center">
                Khuyến mãi
            </th>
            <th scope="col" class="text-center">
                Số lượng
            </th>
            <th scope="col" class="text-center">
                Mô tả
            </th>
            <th scope="col" class="text-center">
                Ngày tạo
            </th>
            <th colspan="2" scope="col" class="text-center">
                Chức năng
            </th>
        </tr>
    </thead>
    <tbody class="table-group-divider">
        <?php foreach ($data["products"] as $row) { ?>
            <tr>
                <td><?php echo $row['masp'] ?></td>
                <td><?php echo $row['ten_loaisp'] ?></td>
                <td><?php echo $row['tensp'] ?></td>
                <td><img src="<?php echo BASE_URL; ?>/public/images/<?php echo $row['hinhanh'] ?>" width="100px"></td>
                <td><?php echo number_format($row['gianhap'])?></td>
                <td><?php echo number_format($row['giaxuat']) ?></td>
                <td><?php echo $row['khuyenmai'] ?></td>
                <td><?php echo $row['soluong'] ?></td>
                <td><?php echo $row['mota_sp'] ?></td>
                <td><?php echo $row['created_at'] ?></td>
                <td>
                    <a class="btn btn-primary" style="width: 100;" href="./update/<?php echo $row['masp'] ?>">Cập nhật</a>
                </td>
                <td>
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalDeleteProduct"
                        data-id="<?php echo $row['masp'] ?>">
                        xóa
                    </button>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<!-- Modal Delete -->
<div class="modal fade" id="modalDeleteProduct" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Xóa loại sản phẩm</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Bạn có đồng ý xóa sản phẩm này không ?
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
    var exampleModal = document.getElementById('modalDeleteProduct');
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