<div class="row">
    <div class="col-lg">
        <div class="column d-flex justify-content-between">
            <h3 class="mb-3 col-8"></i>Đơn Mua Của Tôi</h3>
            <select class="form-select" aria-label="Default select example">
                <option value="all" selected>Tất cả</option>
                <option value="0">Chờ xác nhận</option>
                <option value="1">Đang chuẩn bị hàng</option>
                <option value="2">Đang giao hàng</option>
                <option value="3">Giao hàng thành công</option>
                <option value="4">Đã hủy</option>
            </select>
        </div>
        <hr>
        <div id="billsContainer">
            <?php foreach ($data["hoa_don"] as $key) { ?>
                <a href="<?php echo BASE_URL; ?>/BillController/showDetailBill/<?php echo $key['hoa_don']['ma_hoa_don'] ?>">
                    <section class="billsContainer mb-2" style="background-color: #eee;">
                        <div class="container py-2" style="background-color: white">
                            <div class="column d-flex justify-content-between align-items-center">
                                <div>
                                    <h5>Danh sách sản phẩm</h5>
                                </div>
                                <div class="column d-flex">
                                    <strong class="text-info-emphasis"></strong>
                                </div>
                            </div>
                            <div class="row d-flex justify-content-center align-items-center h-100">
                                <div class="col-12">
                                    <div class="card rounded-3 mb-0">
                                        <?php foreach ($key["chi_tiet"] as $row) { ?>
                                            <div class="card-body p-4">
                                                <div class="row d-flex justify-content-between align-items-center">
                                                    <div class="col-md-2 col-lg-2 col-xl-3">
                                                        <img src="<?php echo BASE_URL; ?>/public/images/<?php echo $row['hinhanh'] ?>"
                                                            class="img-fluid rounded-3" alt="Cotton T-shirt">
                                                    </div>
                                                    <div class="col-md-3 col-lg-3 col-xl-6">
                                                        <p class="lead fw-normal mb-2"><?php echo $row['tensp'] ?></p>
                                                        <div class="column"><span class="text-muted">Loại sản phẩm: </span>
                                                            <?php echo $row['ten_loaisp'] ?></div>
                                                    </div>
                                                    <div class="row col-md-3 col-lg-3 col-xl-3 d-flex">
                                                        <p><span class="text-muted">Quantity:
                                                            </span><?php echo $row['so_luong'] ?>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <div class="column d-flex justify-content-end align-items-center col mt-2 me-5">
                                <div class="column d-flex">
                                    <span class="text-dark me-2 fw-bold ">Thành tiền: </span>
                                    <p class="priceDisplay text-danger fw-bold">
                                        <?php echo $key['hoa_don']['tong_thanh_toan'] ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </section>
                </a>
            <?php } ?>
        </div>
    </div>
</div>
<script>
    function formatNumber(number) {
        return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }
    window.addEventListener('DOMContentLoaded', function () {
        var inputNumber = document.getElementById('priceDisplay').innerText; // Số bạn muốn hiển thị
        console.log(inputNumber);
        var formattedNumber = formatNumber(inputNumber);
        document.getElementById('priceDisplay').textContent = formattedNumber;
    });
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        $('.destroy').change(function () {
            var selectedValue = $(this).find('option:selected').val();
            var url = '/user_purchase/' + selectedValue;

            $.ajax({
                url: url,
                method: 'GET',
                success: function (response) {
                    console.log(response);
                    // Update the content of the page with the new bills
                    $('#billsContainer').html(response);
                },
                error: function (xhr, status, error) {
                    // Handle the error here
                }
            });
        });
    });
</script>