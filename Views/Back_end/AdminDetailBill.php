<div class="container mt-5 overflow-auto" style="max-height: 600px">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <h4>Chi tiết hóa đơn - ID: <?php echo $data['chi_tiet_hoa_don']['hoa_don']['ma_hoa_don']; ?></h4>
                    <h6>Ngày tạo: <?php echo $data['chi_tiet_hoa_don']['hoa_don']['created_at']; ?></h6>
                </div>
                <div class="col-md-6">
                    <div class="dropdown">
                        <select class="form-select float-end" id="orderStatusDropdown">
                            <option value="0" <?php echo $data['chi_tiet_hoa_don']['hoa_don']['trangthai'] == 0 ? 'selected' : ''; ?>>Chờ xét duyệt</option>
                            <option value="1" <?php echo $data['chi_tiet_hoa_don']['hoa_don']['trangthai'] == 1 ? 'selected' : ''; ?>>Đang giao hàng</option>
                            <option value="2" <?php echo $data['chi_tiet_hoa_don']['hoa_don']['trangthai'] == 2 ? 'selected' : ''; ?>>Đã giao hàng</option>
                            <option value="3" <?php echo $data['chi_tiet_hoa_don']['hoa_don']['trangthai'] == 3 ? 'selected' : ''; ?>>Đã thanh toán</option>
                            <option value="4" <?php echo $data['chi_tiet_hoa_don']['hoa_don']['trangthai'] == 4 ? 'selected' : ''; ?>>Chờ thanh toán</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <h2 class="my-3">Thông tin khách hàng</h5>
                                <h5 class="my-3">Họ tên:
                                    <?php echo $data['chi_tiet_hoa_don']['hoa_don']['user_info']['hoten']; ?>
                                </h5>
                                <h5 class="my-3">Email:
                                    <?php echo $data['chi_tiet_hoa_don']['hoa_don']['user_info']['email']; ?>
                                </h5>
                                <h5 class="my-3">SĐT:
                                    <?php echo $data['chi_tiet_hoa_don']['hoa_don']['user_info']['sodienthoai']; ?>
                                </h5>
                                <h5 class="my-3">Địa chỉ:
                                    <?php echo $data['chi_tiet_hoa_don']['hoa_don']['user_info']['diachi']; ?>
                                </h5>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="table-responsive mb-4">
                        <table class="table text-nowrap">
                            <thead class="bg-light">
                                <tr>
                                    <th class="border-0 p-3" scope="col"> <strong
                                            class="text-sm text-uppercase">Product</strong></th>
                                    <th class="border-0 p-3" scope="col"> <strong
                                            class="text-sm text-uppercase">Price</strong></th>
                                    <th class="border-0 p-3" scope="col"> <strong
                                            class="text-sm text-uppercase">Quantity</strong></th>
                                    <th class="border-0 p-3" scope="col"> <strong
                                            class="text-sm text-uppercase">Total</strong></th>
                                    <th class="border-0 p-3" scope="col"> <strong
                                            class="text-sm text-uppercase"></strong></th>
                                </tr>
                            </thead>
                            <tbody class="border-0">
                                <?php foreach ($data["chi_tiet_hoa_don"]["chi_tiet"] as $row) { ?>
                                    <tr>
                                        <th class="ps-0 py-3 border-light" scope="row">
                                            <div class="d-flex align-items-center">
                                                <aside class="reset-anchor d-block animsition-link" href="">
                                                    <img src="<?php echo BASE_URL; ?>/public/images/<?php echo $row['hinhanh'] ?>"
                                                        alt="..." width="70" />
                                                </aside>
                                                <div class="ms-3"><strong class="h6"><a class="reset-anchor animsition-link"
                                                            href=""><?php echo $row['tensp'] ?></a></strong>
                                                </div>
                                            </div>
                                        </th>
                                        <td class="masp" style="display: none;"> <?php echo $row['masp'] ?> </td>
                                        <td class="p-3 align-middle border-light">
                                            <p class="mb-0">
                                                <?php if (!empty($row['khuyenmai']) && $row['khuyenmai'] > 0): ?>
                                                    <span
                                                        class="original-price text-muted text-decoration-line-through me-2 small">
                                                        <?php echo number_format($row['giaxuat']); ?> VND
                                                    </span>
                                                    <span class="discounted-price text-danger fw-bold fs-5">
                                                        <?php echo number_format($row['giaxuat'] - ($row['giaxuat'] * $row['khuyenmai'] / 100)); ?>
                                                        VND
                                                    </span>
                                                <?php else: ?>
                                                    <span class="original-price text-dark fw-bold">
                                                        <?php echo number_format($row['giaxuat']); ?> VND
                                                    </span>
                                                <?php endif; ?>
                                            </p>

                                        </td>
                                        <td class="p-3 align-middle border-light">
                                            <div class="d-flex align-items-center justify-content-center px-3">
                                                <div class="quantity col">
                                                    </span><?php echo $row['so_luong'] ?>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="p-3 align-middle border-light">
                                            <p class="thanhhao mb-0 small">
                                                <?php echo number_format($row['tong_tien']) ?>
                                                VNĐ
                                            </p>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('#orderStatusDropdown').change(function () {
            var selectedStatus = $(this).val();
            var orderId = <?php echo $data['chi_tiet_hoa_don']['hoa_don']['ma_hoa_don']; ?>; // Lấy mã hóa đơn

            $.ajax({
                url: '<?php echo BASE_URL; ?>/BillController/updateOrderStatus', // Đường dẫn đến API cập nhật trạng thái
                method: 'POST',
                data: {
                    ma_hoa_don: orderId,
                    trangthai: selectedStatus
                },
                success: function (response) {
                    alert('Trạng thái đơn hàng đã được cập nhật thành công!');
                },
                error: function (xhr, status, error) {
                    alert('Có lỗi xảy ra khi cập nhật trạng thái đơn hàng.');
                }
            });
        });
    });
</script>