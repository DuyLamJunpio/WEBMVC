<table class="table mt-2">
    <thead>
        <tr>
            <th scope="col" class="text-center">
                ID
            </th>
            <th scope="col" class="text-center">
                Họ và tên
            </th>
            <th scope="col" class="text-center">
                Tên đăng nhập
            </th>
            <th scope="col" class="text-center">
                Email
            </th>
            <th scope="col" class="text-center">
                Số điện thoại
            </th>
            <th scope="col" class="text-center">
                Giới tính
            </th>
            <th scope="col" class="text-center">
                Địa chỉ
            </th>
            <th scope="col" class="text-center">
                Mức độ truy cập
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
        <?php foreach ($data["users"] as $row) { ?>
            <tr>
                <td><?php echo $row['id'] ?></td>
                <td><?php echo $row['hoten'] ?></td>
                <td><?php echo $row['tendangnhap'] ?></td>
                <td><?php echo $row['email'] ?></td>
                <td><?php echo $row['sodienthoai'] ?></td>
                <td> <?php
                if ($row['gioitinh'] == 0) {
                    echo 'Nam';
                } elseif ($row['gioitinh'] == 1) {
                    echo 'Nữ';
                } else {
                    echo 'Khác';
                }
                ?></td>
                <td><?php echo $row['diachi'] ?></td>
                <td><?php
                if ($row['mucdotruycap'] == 0) {
                    echo 'Người dùng';
                } elseif ($row['mucdotruycap'] == 1) {
                    echo 'Admin';
                }
                ?></td>
                <td><?php echo $row['created_at'] ?></td>
                <?php if ($row['mucdotruycap'] != 1): ?>
                    <td>
                        <a class="btn btn-primary" style="width: 100;"
                            href="<?php echo BASE_URL; ?>/AuthController/getCustomerDetails/<?php echo $row['id'] ?>">Chi
                            tiết</a>
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalDeleteProduct"
                            data-id="<?php echo $row['id'] ?>">
                            xóa
                        </button>
                    </td>
                <?php endif; ?>
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
                Bạn có đồng ý xóa người dùng này không ?
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
        var idUser = button.getAttribute('data-id');
        // Cập nhật liên kết xóa trong modal
        var confirmDelete = document.getElementById('confirmDelete');
        confirmDelete.href = '<?php echo BASE_URL; ?>/AuthController/deleteUser/' + idUser;
    });
</script>