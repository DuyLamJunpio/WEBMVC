<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Login</title>
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/8.1.0/mdb.min.css" rel="stylesheet" />
</head>

<body class="bg-info bg-gradient">
    <!-- Section: Design Block -->
    <section class="background-radial-gradient overflow-hidden">
        <style>
            .background-radial-gradient {
                background-color: hsl(218, 41%, 15%);
                background-image: radial-gradient(650px circle at 0% 0%,
                        hsl(218, 41%, 35%) 15%,
                        hsl(218, 41%, 30%) 35%,
                        hsl(218, 41%, 20%) 75%,
                        hsl(218, 41%, 19%) 80%,
                        transparent 100%),
                    radial-gradient(1250px circle at 100% 100%,
                        hsl(218, 41%, 45%) 15%,
                        hsl(218, 41%, 30%) 35%,
                        hsl(218, 41%, 20%) 75%,
                        hsl(218, 41%, 19%) 80%,
                        transparent 100%);
            }

            #radius-shape-1 {
                height: 220px;
                width: 220px;
                top: -60px;
                left: -130px;
                background: radial-gradient(#44006b, #ad1fff);
                overflow: hidden;
            }

            #radius-shape-2 {
                border-radius: 38% 62% 63% 37% / 70% 33% 67% 30%;
                bottom: -60px;
                right: -110px;
                width: 300px;
                height: 300px;
                background: radial-gradient(#44006b, #ad1fff);
                overflow: hidden;
            }

            .bg-glass {
                background-color: hsla(0, 0%, 100%, 0.9) !important;
                backdrop-filter: saturate(200%) blur(25px);
            }
        </style>

        <div class="container px-4 py-5 px-md-5 text-center text-lg-start my-5">
            <div class="row gx-lg-5 align-items-center mb-5">
                <div class="col-lg-6 mb-5 mb-lg-0" style="z-index: 10">
                    <h1 class="my-5 display-5 fw-bold ls-tight" style="color: hsl(218, 81%, 95%)">
                        HEY GUY<br />
                        <span style="color: hsl(218, 81%, 75%)">REGISTER HERE</span>
                    </h1>
                    <p class="mb-4 opacity-70" style="color: hsl(218, 81%, 85%)">
                        Welcome to Thanh Hao store.
                        Have a good day!
                    </p>
                </div>

                <div class="col-lg-6 mb-5 mb-lg-0 position-relative">
                    <div id="radius-shape-1" class="position-absolute rounded-circle shadow-5-strong"></div>
                    <div id="radius-shape-2" class="position-absolute shadow-5-strong"></div>

                    <div class="card bg-glass">
                        <d class="card-body px-4 py-5 px-md-5">
                        <h3>Tạo tài khoản mới</h3>
                            <form action="./register" method="post">
                                <!-- 2 column grid layout with text inputs for the first and last names -->
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <div data-mdb-input-init class="form-outline">
                                            <input type="text" id="form3Example1" name="ho" required
                                                class="form-control" />
                                            <label class="form-label" for="form3Example1">Họ</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div data-mdb-input-init class="form-outline">
                                            <input type="text" id="form3Example2" name="ten" required
                                                class="form-control" />
                                            <label class="form-label" for="form3Example2">Tên</label>
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <div data-mdb-input-init class="form-outline">
                                            <input type="text" id="form3Example1" name="sodienthoai" required
                                                class="form-control" />
                                            <label class="form-label" for="form3Example1">Số điện thoại</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4 d-flex align-items-center justify-content-center">

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="gioitinh"
                                                id="femaleGender" value="0" checked />
                                            <label class="form-check-label" for="femaleGender">Nam</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="gioitinh"
                                                id="maleGender" value="1" />
                                            <label class="form-check-label" for="maleGender">Nữ</label>
                                        </div>

                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="gioitinh"
                                                id="otherGender" value="2" />
                                            <label class="form-check-label" for="otherGender">Khác</label>
                                        </div>


                                    </div>
                                </div>

                                <div data-mdb-input-init class="form-outline mb-4">
                                    <input type="text" id="form3Example3" name="tendangnhap" required class="form-control" />
                                    <label class="form-label" for="form3Example3">Tên đăng nhập</label>
                                </div>

                                <!-- Email input -->
                                <div data-mdb-input-init class="form-outline mb-4">
                                    <input type="email" id="form3Example3" name="email" required class="form-control" />
                                    <label class="form-label" for="form3Example3">Địa chỉ email</label>
                                </div>

                                <!-- Password input -->
                                <div data-mdb-input-init class="form-outline mb-4">
                                    <input type="password" id="form3Example4" required name="matkhau"
                                        class="form-control" />
                                    <label class="form-label" for="form3Example4">Mật khẩu</label>
                                </div>

                                <div data-mdb-input-init class="form-outline mb-4">
                                    <input type="password" id="form3Example5" required name="xacnhanmatkhau"
                                        class="form-control" />
                                    <label class="form-label" for="form3Example5">Xác nhận mật khẩu</label>
                                </div>

                                <!-- Submit button -->
                                <button type="submit" class="btn btn-primary btn-block mb-4">
                                    Đăng ký
                                </button>

                                <!-- Register buttons -->
                                <div class="text-center">
                                    <p>Bạn đã có tài khoản? <a
                                            href="<?php echo BASE_URL; ?>/AuthController/showLoginForm"" class="
                                            link-primary">Đăng nhập</a></p>
                                </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>

        </div>
    </section>
    <!-- Section: Design Block -->


    <!-- MDB -->
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/8.1.0/mdb.umd.min.js"></script>
</body>

</html>