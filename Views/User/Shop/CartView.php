<!-- Modal -->
<div class="modal fade" id="modalDelete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete <span id="itemNameToDelete"></span>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger delete"><a id="btnDeleteModal"
                        style="color: white; text-decoration: none;">Delete</a></button>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <!-- HERO SECTION-->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
                <div class="col-lg-6">
                    <h1 class="h2 text-uppercase mb-0">Cart</h1>
                </div>
                <div class="col-lg-6 text-lg-end">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-lg-end mb-0 px-0 bg-light">
                            <li class="breadcrumb-item"><a class="text-dark" href="index.html">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Cart</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <section class="py-5">
        <h2 class="h5 text-uppercase mb-4">Shopping cart</h2>
        <div class="row">
            <form id="buyNowForm" method="POST" action="<?php echo BASE_URL; ?>/BillController/checkoutProduct">
                <div class="container">
                    <!-- CART TABLE-->
                    <div class="table-responsive mb-4">
                        <table class="table text-nowrap">
                            <thead class="bg-light">
                                <tr>
                                    <th class="border-0 p-3" scope="col">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="checkall">
                                        </div>
                                    </th>
                                    <th class="border-0 p-3" scope="col"> <strong
                                            class="text-sm text-uppercase">ID</strong></th>
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
                                <?php foreach ($data["cartData"] as $row) { ?>
                                    <tr>
                                        <th class="p-3 align-middle border-light">
                                            <div class="form-check">
                                                <input class="checkitem form-check-input item"
                                                    data-item-id="<?php echo $row['id'] ?>" type="checkbox"
                                                    value="<?php echo $row['id'] ?>" id="checkitem">
                                            </div>
                                        </th>
                                        <td class="p-3 align-middle border-light">
                                            <p class="mb-0 small"><?php echo $row['id'] ?></p>
                                        </td>
                                        <th class="ps-0 py-3 border-light" scope="row">
                                            <div class="d-flex align-items-center">
                                                <aside class="reset-anchor d-block animsition-link"
                                                    href="<?php echo BASE_URL; ?>/ShopController/detailProduct/<?php echo $row['masp'] ?>">
                                                    <img src="<?php echo BASE_URL; ?>/public/images/<?php echo $row['hinhanh'] ?>"
                                                        alt="..." width="70" />
                                                </aside>
                                                <div class="ms-3"><strong class="h6"><a class="reset-anchor animsition-link"
                                                            href="<?php echo BASE_URL; ?>/ShopController/detailProduct/<?php echo $row['masp'] ?>"><?php echo $row['tensp'] ?></a></strong>
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
                                            <div class="border d-flex align-items-center justify-content-center px-3">
                                                <div class="quantity col">
                                                    <input
                                                        class="so_luong col form-control form-control-sm border-0 shadow-0 p-0 item"
                                                        type="number" id="<?php echo $row['masp'] ?>"
                                                        data-item-id="<?php echo $row['id'] ?>" name="quantity"
                                                        value="<?php echo $row['so_luong'] ?>" min="1" aria-valuemin="1" />
                                                </div>
                                            </div>
                                        </td>
                                        <td class="p-3 align-middle border-light">
                                            <p class="thanhhao mb-0 small">
                                                <?php echo number_format(($row['giaxuat'] - ($row['giaxuat'] * $row['khuyenmai'] / 100)) * $row['so_luong']) ?>
                                                VNĐ
                                            </p>
                                        </td>
                                        <td class="p-3 align-middle border-light">
                                            <button type="button" class="deleteItemModal border border-0"
                                                data-bs-toggle="modal" data-bs-target="#modalDelete"
                                                data-item-id="<?php echo $row['id'] ?>">
                                                <i class="fas fa-trash-alt small text-muted"></i>
                                            </button>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- CART NAV-->
                    <div class="bg-light px-4 py-3">
                        <div class="row align-items-center text-center">
                            <div class="col-md-6 mb-3 mb-md-0 text-md-start"><a
                                    class="btn btn-link p-0 text-dark btn-sm"
                                    href="<?php echo BASE_URL; ?>/ShopController"><i
                                        class="fas fa-long-arrow-alt-left me-2">
                                    </i>Continue shopping</a>
                            </div>
                            <div class="card border-0 rounded-0 p-lg-4 bg-light">
                                <div class="card-body">
                                    <h5 class="text-uppercase mb-4">Cart total</h5>
                                    <ul class="list-unstyled mb-0">
                                        <li class="d-flex align-items-center justify-content-between"><strong
                                                class="text-uppercase small font-weight-bold">Total payment
                                                products</strong><span class="text-muted small"
                                                id="totalProduct">0</span>
                                        </li>
                                        <li class="border-bottom my-2"></li>
                                        <li class="d-flex align-items-center justify-content-between mb-4"><strong
                                                class="text-uppercase small font-weight-bold">Total</strong><span
                                                id="totalSum">0</span>
                                        </li>
                                        <li>
                                            <div class="input-group mb-0">
                                                <div class="col text-md-end d-flex justify-content-center">
                                                    <input type="hidden" name="masp[]" id="hiddenMaspInput">
                                                    <input type="hidden" name="so_luong[]" id="hiddenSoLuongInput">
                                                    <button id="btnCheckOut" type="submit"
                                                        class="btn btn-outline-dark btn-sm">
                                                        Procceed to checkout
                                                        <i class="fas fa-long-arrow-alt-right ms-2"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {

        function formatNumber(number) {
            return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") + " VNĐ";
        }

        // Đối với mỗi input số lượng
        $('.quantityInput').on('input', function () {
            // Lấy giá trị số lượng và chuyển đổi thành số
            var quantity = $(this).val() || 0;

            // Lấy giá trị giá của mặt hàng tương ứng và chuyển đổi thành số
            var disprice = $(this).closest('tr').find('.discounted-price').text().replace(/[^0-9]/g, '') ||
                0;
            var oriprice = $(this).closest('tr').find('.original-price').text().replace(/[^0-9]/g, '') || 0;

            // Chọn giá trị giá phù hợp
            let price = disprice > 0 ? disprice : oriprice;

            // Tính toán tổng tiền
            var totalPrice = quantity * price;

            // Kiểm tra nếu totalPrice là số hợp lệ trước khi hiển thị
            if (!isNaN(totalPrice)) {
                // Chuyển đổi totalPrice thành chuỗi và gán vào HTML
                $(this).closest('tr').find('.thanhhao').text(formatNumber(totalPrice));
            } else {
                $(this).closest('tr').find('.thanhhao').text('0');
            }
        });
    });
</script>
<script>
    $(document).ready(function () {

        function formatNumber(number) {
            return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") + " VNĐ";
        }

        // Hàm tính tổng
        function calculateTotalSum() {
            var total = 0;
            // Lặp qua tất cả các ô checkbox được chọn
            $('.checkitem:checked').each(function () {
                // Lấy giá trị totalPrice của mỗi ô được chọn và cộng vào tổng
                var totalPrice = parseFloat($(this).closest('tr').find('.thanhhao').text().replace(/[^0-9]/g, ''));
                total += totalPrice;
            });
            // Cập nhật tổng vào phần tử có id là "totalSum"
            $('#totalSum').text(formatNumber(total));
        }

        // Lắng nghe sự kiện change trên checkbox "checkall"
        $('#checkall').change(function () {
            // Lấy giá trị (checked hoặc không checked) của checkbox "checkall"
            var isChecked = $(this).prop('checked');

            // Set giá trị của tất cả các checkbox khác thành giá trị của checkbox "checkall"
            $('.checkitem').prop('checked', isChecked);
            var checkedCount = $('.checkitem:checked').length;

            // Đặt số lượng ô được chọn vào phần tử có id "totalProduct"
            $('#totalProduct').text(checkedCount);
            calculateTotalSum();
        });

        // Lắng nghe sự kiện thay đổi trên tất cả các ô checkbox
        $('.checkitem').change(function () {
            // Đếm số lượng ô checkbox được chọn
            var checkedCount = $('.checkitem:checked').length;

            // Đặt số lượng ô được chọn vào phần tử có id "totalProduct"
            $('#totalProduct').text(checkedCount);
            // Khi checkbox thay đổi, tính toán lại tổng
            calculateTotalSum();
        });

        // Lắng nghe sự kiện thay đổi trên tất cả các ô quantity
        $('.quantityInput').on('input', function () {
            // Khi quantity thay đổi, tính toán lại totalPrice của ô
            var quantity = parseFloat($(this).val());
            // Lấy giá trị giá của mặt hàng tương ứng và chuyển đổi thành số
            var disprice = $(this).closest('tr').find('.discounted-price').text().replace(/[^0-9]/g, '') ||
                0;
            var oriprice = $(this).closest('tr').find('.original-price').text().replace(/[^0-9]/g, '') || 0;

            // Chọn giá trị giá phù hợp
            let price = disprice > 0 ? disprice : oriprice;
            var totalPrice = quantity * price;
            if (!isNaN(totalPrice)) {
                // Chuyển đổi totalPrice thành chuỗi và gán vào HTML
                $(this).closest('tr').find('.thanhhao').text(formatNumber(totalPrice));
            } else {
                $(this).closest('tr').find('.thanhhao').text('0');
            }

            // Sau đó tính toán lại tổng
            calculateTotalSum();
        });
    });
</script>
<script>
    $('.deleteItemModal').click(function () {
        var itemId = $(this).data('item-id');
        // Tạo đường dẫn sử dụng itemId
        var deleteUrl = "<?php echo BASE_URL; ?>/ShopController/delete/" + itemId;
        deleteUrl = deleteUrl.replace(':itemId', itemId);

        // Đặt thuộc tính href cho button
        $('#btnDeleteModal').attr('href', deleteUrl);
    });
</script>
<script>
    function collectDataAndSubmit(event) {
        // Tạo mảng để lưu trữ giá trị
        var maspArray = [];
        var soLuongArray = [];

        // Duyệt qua các phần tử checkbox được chọn
        $('.checkitem:checked').each(function () {
            // Lấy giá trị masp và so_luong từ các phần tử liên quan
            var masp = $(this).closest('tr').find('.masp').text().trim();
            var soLuong = $(this).closest('tr').find('.so_luong').val();

            maspArray.push(masp);
            soLuongArray.push(soLuong);
        });

        // Gán giá trị mảng trực tiếp vào input ẩn
        $('#hiddenMaspInput').val(maspArray); // Gán trực tiếp mảng
        $('#hiddenSoLuongInput').val(soLuongArray);
    }

    // Gọi hàm collectDataAndSubmit khi người dùng nhấn nút
    $('#btnCheckOut').on('click', function (event) {
        collectDataAndSubmit(event); // Truyền event vào để chặn submit
    });
</script>