<div class="page-holder bg-light">
    <section class="py-5">
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-6">
                    <!-- PRODUCT SLIDER-->
                    <div class="row m-sm-0">
                        <div class="col-sm-10 order-1 order-sm-2">
                            <div class="swiper product-slider">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide h-auto"><img class="img-fluid"
                                            src="<?php echo BASE_URL; ?>/public/images/<?php echo $data["detail_product"]['hinhanh'] ?>"
                                            alt="..."></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- PRODUCT DETAILS-->
                <div class="col-lg-6">
                    <h1><?php echo $data["detail_product"]['tensp'] ?></h1>
                    <li class="px-3 py-2 mb-1 bg-white text-muted mb-2"><strong
                            class="text-uppercase text-dark">Category:</strong><a class="reset-anchor ms-2"
                            href="#!"><?php echo $data["detail_product"]['ten_loaisp'] ?></a></li>
                    <li class="px-3 py-2 mb-1 bg-white text-muted mb-2"><strong
                            class="text-uppercase text-dark">Price:</strong><a class="reset-anchor ms-2 text-danger"
                            id="priceDisplay">
                            <?php if (!empty($data["detail_product"]['khuyenmai']) && $data["detail_product"]['khuyenmai'] > 0): ?>
                                <span class="original-price text-muted text-decoration-line-through me-2 small">
                                    <?php echo number_format($data["detail_product"]['giaxuat']); ?> VND
                                </span>
                                <span class="discounted-price text-danger fw-bold fs-5">
                                    <?php echo number_format($data["detail_product"]['giaxuat'] - ($data["detail_product"]['giaxuat'] * $data["detail_product"]['khuyenmai'] / 100)); ?>
                                    VND
                                </span>
                            <?php else: ?>
                                <span class="original-price text-dark fw-bold">
                                    <?php echo number_format($data["detail_product"]['giaxuat']); ?> VND
                                </span>
                            <?php endif; ?>
                        </a>
                    </li>

                    <div class="row align-items-stretch mb-4 mt-4">
                        <div class="col-sm-5 pr-sm-0">
                            <div
                                class="border d-flex align-items-center justify-content-between py-1 px-3 bg-white border-white">
                                <span class="small text-uppercase text-gray mr-4 no-select">Quantity</span>
                                <div class="quantity">

                                    <input class="form-control border-0 shadow-0 p-0" id="myInput" type="number"
                                        value="1" name="so_luong" min="1">

                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3 pl-sm-0">
                            <form id="addToCartForm" method="POST"
                                action="<?php echo BASE_URL; ?>/ShopController/addProductToCart/<?php echo $data["detail_product"]['masp']; ?>">
                                <input type="hidden" name="so_luong" id="soLuongAddToCart">
                                <button type="button" onclick="submitForm('addToCartForm')"
                                    class="btn btn-dark btn-sm btn-block h-100 d-flex align-items-center justify-content-center px-0 col-12">
                                    Add to cart
                                </button>
                            </form>
                        </div>
                        <div class="col-sm-3 pl-sm-0">
                            <form id="buyNowForm" method="POST"
                                action="<?php echo BASE_URL; ?>/BillController/checkoutProduct">
                                <input type="hidden" name="so_luong[]" id="soLuongBuyNow">
                                <input type="hidden" name="masp[]" value="<?php echo $data["detail_product"]['masp']; ?>">
                                <button type="button" onclick="submitForm('buyNowForm')"
                                    class="btn btn-danger btn-sm btn-block h-100 d-flex align-items-center justify-content-center px-0 col-12">
                                    Buy now
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- DETAILS TABS-->
            <ul class="nav nav-tabs border-0" id="myTab" role="tablist">
                <li class="nav-item"><a class="nav-link text-uppercase active" id="description-tab" data-bs-toggle="tab"
                        href="#description" role="tab" aria-controls="description" aria-selected="true">Description</a>
                </li>
                <li class="nav-item"><a class="nav-link text-uppercase" id="reviews-tab" data-bs-toggle="tab"
                        href="#reviews" role="tab" aria-controls="reviews" aria-selected="false">Reviews</a>
                </li>
            </ul>
            <div class="tab-content mb-5" id="myTabContent">
                <div class="tab-pane fade show active" id="description" role="tabpanel"
                    aria-labelledby="description-tab">
                    <div class="p-4 p-lg-5 bg-white">
                        <h6 class="text-uppercase">Product description </h6>
                        <p class="text-muted text-sm mb-0"><?php echo $data["detail_product"]['mota_sp'] ?></p>
                    </div>
                </div>
                <div class="tab-pane fade" id="reviews" role="tabpanel" aria-labelledby="reviews-tab">
                    <div class="p-4 p-lg-5 bg-white">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="d-flex mb-3">
                                    <div class="flex-shrink-0"><img class="rounded-circle" src="img/customer-1.png"
                                            alt="" width="50" /></div>
                                    <div class="ms-3 flex-shrink-1">
                                        <h6 class="mb-0 text-uppercase">Jason Doe</h6>
                                        <p class="small text-muted mb-0 text-uppercase">20 May 2020</p>
                                        <ul class="list-inline mb-1 text-xs">
                                            <li class="list-inline-item m-0"><i class="fas fa-star text-warning"></i>
                                            </li>
                                            <li class="list-inline-item m-0"><i class="fas fa-star text-warning"></i>
                                            </li>
                                            <li class="list-inline-item m-0"><i class="fas fa-star text-warning"></i>
                                            </li>
                                            <li class="list-inline-item m-0"><i class="fas fa-star text-warning"></i>
                                            </li>
                                            <li class="list-inline-item m-0"><i
                                                    class="fas fa-star-half-alt text-warning"></i></li>
                                        </ul>
                                        <p class="text-sm mb-0 text-muted">Lorem ipsum dolor sit amet, consectetur
                                            adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore
                                            magna
                                            aliqua.</p>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <div class="flex-shrink-0"><img class="rounded-circle" src="img/customer-2.png"
                                            alt="" width="50" /></div>
                                    <div class="ms-3 flex-shrink-1">
                                        <h6 class="mb-0 text-uppercase">Jane Doe</h6>
                                        <p class="small text-muted mb-0 text-uppercase">20 May 2020</p>
                                        <ul class="list-inline mb-1 text-xs">
                                            <li class="list-inline-item m-0"><i class="fas fa-star text-warning"></i>
                                            </li>
                                            <li class="list-inline-item m-0"><i class="fas fa-star text-warning"></i>
                                            </li>
                                            <li class="list-inline-item m-0"><i class="fas fa-star text-warning"></i>
                                            </li>
                                            <li class="list-inline-item m-0"><i class="fas fa-star text-warning"></i>
                                            </li>
                                            <li class="list-inline-item m-0"><i
                                                    class="fas fa-star-half-alt text-warning"></i></li>
                                        </ul>
                                        <p class="text-sm mb-0 text-muted">Lorem ipsum dolor sit amet, consectetur
                                            adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore
                                            magna
                                            aliqua.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
    function submitForm(formId) {
        var quantity = document.getElementById('myInput').value;
        if (formId === 'addToCartForm') {
            document.getElementById('soLuongAddToCart').value = quantity;
        } else if (formId === 'buyNowForm') {
            document.getElementById('soLuongBuyNow').value = quantity;
        }
        document.getElementById(formId).submit();
    }
</script>