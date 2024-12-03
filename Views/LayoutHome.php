<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$user_hoten = $_SESSION['user_hoten'] ?? null;
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Thanh Hao</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- gLightbox gallery-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" />
    <!-- Choices CSS-->
    <link rel=" stylesheet " href=" https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
    <!-- Swiper slider-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <!-- Google fonts-->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Libre+Franklin:wght@300;400;700&amp;display=swap">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Martel+Sans:wght@300;400;800&amp;display=swap">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="http://localhost/PHPNC/WEBMVC/public/styledefault.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="<?php echo BASE_URL; ?>/public/images/favicon.png">
</head>

<body>

    <div class="page-holder">

        <header class="header bg-white">
            <div class="container px-lg-3">
                <nav class="navbar navbar-expand-lg navbar-light py-3 px-lg-0"><a class="navbar-brand"
                        href="./HomeController"><span class="fw-bold text-uppercase text-dark">ThanhHao</span></a>
                    <button class="navbar-toggler navbar-toggler-end" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation"><span
                            class="navbar-toggler-icon"></span></button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav me-auto">
                            <li class="nav-item">
                                <a class="nav-link active" href="<?php echo BASE_URL; ?>/HomeController">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo BASE_URL; ?>/ShopController">Shop</a>
                            </li>
                        </ul>
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item"><a class="nav-link" href="<?php echo BASE_URL; ?>/ShopController/cart">
                                    <i class="fas fa-dolly-flatbed me-1 text-gray"></i>Cart<small
                                        class="text-gray fw-normal"></small></a></li>
                            <li class="nav-item"><a class="nav-link"
                                    href="<?php echo BASE_URL; ?><?php echo $user_hoten ? '/AuthController/profile' : '/AuthController/showLoginForm'?>"> <i
                                        class="fas fa-user me-1 text-gray fw-normal"></i><?php echo $user_hoten ? htmlspecialchars($user_hoten) : 'Login'; ?></a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </header>

        <!-- BODYYYYYYYYYY -->
        <?php
        require_once "./Views/User/" . $data["User"] . ".php";
        ?>

        <footer class="bg-dark text-white">
            <div class="container py-4">
                <div class="row py-5">
                    <div class="col-md-4 mb-3 mb-md-0">
                        <h6 class="text-uppercase mb-3">Customer services</h6>
                        <ul class="list-unstyled mb-0">
                            <li><a class="footer-link" href="#!">Help &amp; Contact Us</a></li>
                            <li><a class="footer-link" href="#!">Returns &amp; Refunds</a></li>
                            <li><a class="footer-link" href="#!">Online Stores</a></li>
                            <li><a class="footer-link" href="#!">Terms &amp; Conditions</a></li>
                        </ul>
                    </div>
                    <div class="col-md-4 mb-3 mb-md-0">
                        <h6 class="text-uppercase mb-3">Company</h6>
                        <ul class="list-unstyled mb-0">
                            <li><a class="footer-link" href="#!">What We Do</a></li>
                            <li><a class="footer-link" href="#!">Available Services</a></li>
                            <li><a class="footer-link" href="#!">Latest Posts</a></li>
                            <li><a class="footer-link" href="#!">FAQs</a></li>
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <h6 class="text-uppercase mb-3">Social media</h6>
                        <ul class="list-unstyled mb-0">
                            <li><a class="footer-link" href="#!">Twitter</a></li>
                            <li><a class="footer-link" href="#!">Instagram</a></li>
                            <li><a class="footer-link" href="#!">Tumblr</a></li>
                            <li><a class="footer-link" href="#!">Pinterest</a></li>
                        </ul>
                    </div>
                </div>
                <div class="border-top pt-4" style="border-color: #1d1d1d !important">
                    <div class="row">
                        <div class="col-md-6 text-center text-md-start">
                            <p class="small text-muted mb-0">&copy; 2024 All rights reserved.</p>
                        </div>
                        <div class="col-md-6 text-center text-md-end">
                            <p class="small text-muted mb-0">Thiết kế bởi <a class="text-white reset-anchor"
                                    href="https://bootstrapious.com/p/boutique-bootstrap-e-commerce-template">Thanh
                                    Hảo</a>
                            </p>

                        </div>
                    </div>
                </div>
            </div>
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
            </script>
        <script src="https://cdn.jsdelivr.net/gh/mcstudios/glightbox/dist/js/glightbox.min.js"></script>
        <script type="text/javascript">
            const lightbox = GLightbox({
                ...options
            });
        </script>
        <script src=" https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js "></script>
        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
        <script src="<?php echo BASE_URL; ?>/public/front.js"></script>
        <script>

            function injectSvgSprite(path) {

                var ajax = new XMLHttpRequest();
                ajax.open("GET", path, true);
                ajax.send();
                ajax.onload = function (e) {
                    var div = document.createElement("div");
                    div.className = 'd-none';
                    div.innerHTML = ajax.responseText;
                    document.body.insertBefore(div, document.body.childNodes[0]);
                }
            }

            injectSvgSprite('https://bootstraptemple.com/files/icons/orion-svg-sprite.svg');
        </script>
    </div>

</body>

</html>