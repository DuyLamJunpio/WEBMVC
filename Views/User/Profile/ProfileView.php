<section style="background-color: #eee;">
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-4">
                <div class="card mb-4 mb-lg-0">
                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush rounded-3">
                            <li id="btndropdown" class="list-group-item d-flex align-items-center p-3">
                                <i class='bx bx-user me-2 text-primary'></i>
                                <p class="mb-0 col">Tài khoản của tôi</p>
                                <button type="button" style="border: none;background: white;"
                                    class="dropdown-toggle dropdown-toggle-split">
                                </button>
                            </li>
                            <ul id="menudropdown" class="list-group-flush" style="display: none">
                                <li class="list-group-item d-flex align-items-center">
                                    <i class='bx bxs-user-rectangle text-info me-2'></i>
                                    <a href="<?php echo BASE_URL; ?>/AuthController/profile"
                                        style="text-decoration: none;">Hồ sơ</a>
                                </li>
                                <li class="list-group-item d-flex align-items-center">
                                    <i class='bx bx-lock text-warning-emphasis me-2'></i>
                                    <a href="" style="text-decoration: none;">Đổi mật
                                        khẩu</a>
                                </li>
                            </ul>
                            <li class="list-group-item d-flex align-items-center p-3">
                                <i class='bx bx-task text-success me-2'></i>
                                <a href="<?php echo BASE_URL; ?>/BillController/showBills/<?php echo $data['user']['id'] ?>" style="text-decoration: none;">Đơn mua</a>
                            </li>
                            <li class="list-group-item d-flex align-items-center p-3">
                                <i class='bx bx-log-out text-danger me-2'></i>
                                <a href="<?php echo BASE_URL; ?>/AuthController/logout"
                                    style="text-decoration: none;">Đăng xuất</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <?php
                require_once "./Views/User/Profile/" . $data["Profile"] . ".php";
                ?>
            </div>
        </div>
    </div>
</section>
</body>

<script>
    var contentElements = document.querySelectorAll('.content');
    var editElements = document.querySelectorAll('.edit');
    document.getElementById('editButton').addEventListener('click', function () {
        document.getElementById('save').style.display = 'block';
        document.getElementById('cancel').style.display = 'block';
        document.getElementById('chooseImage').style.display = 'block';
        document.getElementById('upImage').style.display = 'block';
        contentElements.forEach(function (element) {
            element.style.display = 'none';
        });
        editElements.forEach(function (element) {
            element.style.display = 'block';
        });
    });

    document.getElementById('cancel').addEventListener('click', function () {
        document.getElementById('save').style.display = 'none';
        document.getElementById('cancel').style.display = 'none';
        document.getElementById('chooseImage').style.display = 'none';
        document.getElementById('upImage').style.display = 'none';
        contentElements.forEach(function (element) {
            element.style.display = 'block';
        });
        editElements.forEach(function (element) {
            element.style.display = 'none';
        });
    });
</script>

<script>
    var element = document.getElementById('menudropdown');

    document.getElementById('btndropdown').addEventListener('click', function () {
        var display = window.getComputedStyle(element).getPropertyValue('display');
        if (display === 'none') {
            element.style.display = 'block'; // Hiển thị phần tử nếu nó đang ẩn
        } else {
            element.style.display = 'none'; // Ẩn phần tử nếu nó đang hiển thị
        }
    });
</script>

<script>
    function formatNumber(number) {
        return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    window.addEventListener('DOMContentLoaded', function () {
        var elements = document.querySelectorAll(
            '.priceDisplay'); // Lấy tất cả các phần tử có class là 'priceDisplay'

        elements.forEach(function (element) {
            var inputNumber = element.innerText; // Lấy giá trị nội dung của phần tử
            var formattedNumber = formatNumber(inputNumber); // Định dạng số
            element.textContent = formattedNumber; // Gán nội dung đã định dạng vào phần tử
        });
    });
</script>