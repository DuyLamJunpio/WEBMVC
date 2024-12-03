<div class="container d-flex justify-content-between align-items-center">
    <h5 class="ps-2">Quản lý hóa đơn</h5>
</div>
<table class="table mt-2">
    <thead>
        <tr>
            <th scope="col" class="text-center">
                Mã hóa đơn
            </th>
            <th scope="col" class="text-center">
                Tên khách hàng
            </th>
            <th scope="col" class="text-center">
                Tổng thanh toán
            </th>
            <th scope="col" class="text-center">
                Trạng thái
            </th>
            <th scope="col" class="text-center">
                Ngày tạo
            </th>
            <th scope="col" class="text-center">
                Chức năng
            </th>
        </tr>
    </thead>
    <tbody class="table-group-divider">
        <?php foreach ($data["hoa_don"] as $row) { ?>
            <tr>
                <td class="text-center fw-bold"><?php echo $row["hoa_don"]['ma_hoa_don'] ?></td>
                <td class="text-center"><?php echo $row["hoa_don"]['user_info']['hoten'] ?></td>
                <td class="text-center"><?php echo number_format($row["hoa_don"]['tong_thanh_toan']) ?></td>
                <td class="text-center"><?php echo $row["hoa_don"]['trangthai'] ?></td>
                <td class="text-center"><?php echo $row["hoa_don"]['created_at'] ?></td>
                <td class="text-center">
                    <a class="btn btn-primary" style="width: 100;" href="<?php echo BASE_URL; ?>/BillController/showDetailBillAdmin/<?php echo $row['hoa_don']['ma_hoa_don'] ?>">Chi tiết</a>
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