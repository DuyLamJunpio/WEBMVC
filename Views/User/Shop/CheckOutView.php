<?php

// echo "<pre>";
// print_r($data['danhsachsanpham']);
// echo "</pre>";



?>
<div class="container">
    <!-- HERO SECTION-->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
                <div class="col-lg-6">
                    <h1 class="h2 text-uppercase mb-0">Checkout</h1>
                </div>
                <div class="col-lg-6 text-lg-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-lg-end mb-0 px-0 bg-light">
                            <li class="breadcrumb-item"><a class="text-dark" href="index.html">Home</a></li>
                            <li class="breadcrumb-item"><a class="text-dark" href="cart.html">Cart</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <section class="py-5">
        <h2 class="h5 text-uppercase mb-4">Checkout</h2>
        <div class="row">
            <div class="col-lg-8 mb-4 mb-lg-0">
                <!-- CART TABLE-->
                <div class="table-responsive mb-4">
                    <table class="table text-nowrap">
                        <thead class="bg-light">
                            <tr>
                                <th class="border-0 p-3 text-center" scope="col"> <strong
                                        class="text-sm text-uppercase">Product</strong></th>
                                <th class="border-0 p-3 text-center" scope="col"> <strong
                                        class="text-sm text-uppercase">Price</strong></th>
                                <th class="border-0 p-3 text-center" scope="col"> <strong
                                        class="text-sm text-uppercase">Quantity</strong></th>
                                <th class="border-0 p-3 text-center" scope="col"> <strong
                                        class="text-sm text-uppercase">Total</strong></th>
                            </tr>
                        </thead>
                        <tbody class="border-0">
                            <?php foreach ($data["danhsachsanpham"] as $row) { ?>

                                <tr class="data">
                                    <th class="ps-0 py-3 border-0" scope="row">
                                        <div class="d-flex align-items-center"><a
                                                class="reset-anchor d-block animsition-link" href="detail.html"><img
                                                    src="<?php echo BASE_URL; ?>/public/images/<?php echo $row['sanpham']['hinhanh'] ?>"
                                                    alt="..." width="70" /></a>
                                            <div class="ms-3">
                                                <strong class="h6">
                                                    <a class="reset-anchor animsition-link" href="detail.html">
                                                        <?php echo $row['sanpham']['tensp'] ?>
                                                    </a>
                                                </strong>
                                                <p class="text-muted"><?php echo $row['sanpham']['ten_loaisp'] ?></span>
                                                </p>
                                            </div>
                                        </div>
                                    </th>
                                    <td class="masp" style="display: none;"><?php echo $row['sanpham']['masp'] ?></td>
                                    <td class="p-3 align-middle border-0 text-center">
                                        <p class="mb-0">
                                            <?php if (!empty($row['sanpham']['khuyenmai']) && $row['sanpham']['khuyenmai'] > 0): ?>
                                                <span class="original-price text-muted text-decoration-line-through me-2 small">
                                                    <?php echo number_format($row['sanpham']['giaxuat']); ?> VND
                                                </span>
                                                <span class="discounted-price text-danger fw-bold fs-5">
                                                    <?php echo number_format($row['sanpham']['giaxuat'] - ($row['sanpham']['giaxuat'] * $row['sanpham']['khuyenmai'] / 100)); ?>
                                                    VND
                                                </span>
                                            <?php else: ?>
                                                <span class="original-price text-dark fw-bold">
                                                    <?php echo number_format($row['sanpham']['giaxuat']); ?> VND
                                                </span>
                                            <?php endif; ?>
                                        </p>
                                    </td>
                                    <td class="p-3 align-middle border-0 text-center">
                                        <p class="quantityText  mb-0 small"><?php echo $row['so_luong'] ?></p>
                                    </td>
                                    <td class="p-3 align-middle border-0 text-center">
                                        <p class="price_total priceDisplay mb-0 small"></p>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <!-- CART NAV-->
                <div class="bg-light px-4 py-3">
                    <div class="row align-items-center text-center">
                        <div class="col-md-6 mb-3 mb-md-0 text-md-start"><a class="btn btn-link p-0 text-dark btn-sm"
                                href="shop.html"><i class="fas fa-long-arrow-alt-left me-2"> </i>Continue shopping</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ORDER TOTAL-->
            <div class="col-lg-4">
                <form id="checkoutForm" action="<?php echo BASE_URL; ?>/BillController/insertBill" method="POST">
                    <div class="card border-0 rounded-0 p-lg-4 bg-light">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <h5 class="text-uppercase mb-4">Delivery Address</h5>
                                    <div class="row">
                                        <div class="col-sm-3 d-flex align-items-center">
                                            <p class="mb-0">Name</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0 content">
                                                <?php echo $data['user']['hoten'] ?>
                                            </p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3 d-flex align-items-center">
                                            <p class="mb-0">Email</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0 content"><?php echo $data['user']['email'] ?>
                                            </p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3 d-flex align-items-center">
                                            <p class="mb-0">Phone</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0 content">
                                                <?php echo $data['user']['sodienthoai'] ?>
                                            </p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3 d-flex align-items-center">
                                            <p class="mb-0">Address</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <?php if ($data['user']['diachi'] == null): ?>
                                                <textarea
                                                    style="display: <?php echo $data['user']['diachi'] == null ?? 'none' ?? 'block' ?>;"
                                                    name="diachi" required
                                                    id="addressTextarea"><?php echo $data['user']['diachi'] ?></textarea>
                                            <?php else: ?>
                                                <p style="display: <?php echo $data['user']['diachi'] == null ?? 'none' ?? 'block' ?>;"
                                                    class="text-muted mb-0 content">
                                                    <?php echo $data['user']['diachi'] ?>
                                                </p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                            </div>

                            <h5 class="text-uppercase mb-4">Cart total</h5>
                            <ul class="list-unstyled mb-0">
                                <li class="d-flex align-items-center justify-content-between"><strong
                                        class="text-uppercase small font-weight-bold">Total payment
                                        products</strong><span class="text-muted small"
                                        id="total_prod"><?php echo count($data['danhsachsanpham']) ?></span></li>
                                <li class="border-bottom my-2"></li>
                                <li class="d-flex align-items-center justify-content-between mb-4"><strong
                                        class="text-uppercase small font-weight-bold">Total</strong><span
                                        class="priceDisplay text-danger" id="totalPaymentDisplay"></span>
                                </li>
                                <li>
                                    <input type="hidden" name="tong_thanh_toan" id="totalPaymentInput" value="">
                                    <div class="input-group mb-0">
                                        <button id="btnCheckOut" class="btn btn-warning btn-sm w-100 text-white fw-bold"
                                            type="submit ">
                                            <i class="fas fa-gift me-2 text-white"></i>Place
                                            Order</button>
                                    </div>
                                </li>
                            </ul>
                        </div>
                </form>
            </div>
        </div>
</div>
</section>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {

        function formatNumber(number) {
            return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") + " VNĐ";
        }

        var totalPayment = 0;

        // Đối với mỗi hàng sản phẩm
        $('.data').each(function () {
            // Lấy giá trị số lượng và chuyển đổi thành số
            var quantity = parseInt($(this).find('.quantityText').text()) || 0;

            // Lấy giá trị giá của mặt hàng tương ứng và chuyển đổi thành số
            var disprice = parseInt($(this).find('.discounted-price').text().replace(/[^0-9]/g, '')) || 0;
            var oriprice = parseInt($(this).find('.original-price').text().replace(/[^0-9]/g, '')) || 0;

            // Chọn giá trị giá phù hợp
            let price = disprice > 0 ? disprice : oriprice;

            // Tính toán tổng tiền cho sản phẩm hiện tại
            var totalPrice = quantity * price;

            // Cộng dồn vào tổng thanh toán
            totalPayment += totalPrice;

            // Hiển thị tổng tiền cho sản phẩm hiện tại
            if (!isNaN(totalPrice)) {
                $(this).find('.price_total').text(formatNumber(totalPrice));
            } else {
                $(this).find('.price_total').text('0');
            }
        });

        // Bạn có thể hiển thị tổng thanh toán trên trang bằng cách thêm một phần tử HTML và gán giá trị này vào đó
        $('#totalPaymentDisplay').text(formatNumber(totalPayment));
    });
</script>
<script>
    $(document).ready(function () {
        function formatNumber(number) {
            return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") + " VNĐ";
        }

        var totalPayment = 0;
        var productList = [];

        $('.data').each(function () {
            var masp = $(this).find('.masp').text();
            var quantity = parseInt($(this).find('.quantityText').text()) || 0;
            var disprice = parseInt($(this).find('.discounted-price').text().replace(/[^0-9]/g, '')) || 0;
            var oriprice = parseInt($(this).find('.original-price').text().replace(/[^0-9]/g, '')) || 0;
            let price = disprice > 0 ? disprice : oriprice;
            var totalPrice = quantity * price;
            totalPayment += totalPrice;

            if (!isNaN(totalPrice)) {
                $(this).find('.price_total').text(formatNumber(totalPrice));
                productList.push({
                    masp: masp,
                    so_luong: quantity,
                    tong_tien: totalPrice
                });
            }
        });

        $('#totalPaymentInput').val(totalPayment); // Cập nhật tổng thanh toán

        $('#checkoutForm').on('submit', function (event) {
            event.preventDefault(); // Ngăn chặn hành động mặc định của form

            // Chuyển đổi danh sách sản phẩm thành chuỗi JSON
            var productListJson = JSON.stringify(productList);

            // Tạo input ẩn để gửi dữ liệu JSON
            $('<input>').attr({
                type: 'hidden',
                name: 'product_list',
                value: productListJson
            }).appendTo('#checkoutForm');

            // Log dữ liệu ra console
            console.log("Danh sách sản phẩm:", productList);
            console.log("Tổng thanh toán:", $('#totalPaymentInput').val());

            // Gửi form
            this.submit();
        });
    });
</script>