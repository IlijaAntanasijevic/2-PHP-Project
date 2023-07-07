<!-- start banner Area -->
<?php
global $promotionBanner;
global $companyServices;
global $brendsImages;
$products = selectAll("product", "ORDER BY date DESC LIMIT 8");
$products = getLastTwoPrices($products);
$servicesName = array_keys($companyServices);
$productImagePath = "assets/img/product/";
$brendImagePath = "assets/img/brand";

    $productsOnDiscount = selectAll("product p"," INNER JOIN discount d ON p.product_id = d.product_id");
    $productsOnDiscount = getLastTwoPrices($productsOnDiscount);


?>
<section class="banner-area">
    <div class="container">
        <div class="row fullscreen align-items-center justify-content-start">
            <div class="col-lg-12">
                <div class=" owl-carousel">
                    <!-- single-slide -->
                    <div class="row align-items-center d-flex">
                        <div class="col-lg-5 col-md-6">
                            <div class="banner-content">
                                <h1><?= $promotionBanner["title"] ?></h1>
                                <p><?= $promotionBanner["description"] ?></p>
                                <div class="add-bag d-flex align-items-center">
                                    <a class="add-btn" href="index.php?page=shop"><span class="lnr lnr-cross"></span></a>
                                    <span class="add-text text-uppercase">View more</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="banner-img">
                                <img class="img-fluid" src="assets/img/banner/<?=$promotionBanner["img"]?>" alt="banner-img"/>
                            </div>
                        </div>
                    </div>
                    <!-- single-slide -->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End banner Area -->

<!-- start features Area -->
<section class="features-area section_gap">
    <div class="container">
        <div class="row features-inner">
            <!-- single features -->
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="single-features">
                    <div class="f-icon">
                        <img src="assets/img/features/f-icon1.png" alt="icon-delivery"/>
                    </div>
                    <h6><?= $servicesName[0] ?></h6>
                    <p><?= $companyServices["Free Delivery"] ?></p>
                </div>
            </div>
            <!-- single features -->
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="single-features">
                    <div class="f-icon">
                        <img src="assets/img/features/f-icon2.png" alt="icon-policy"/>
                    </div>
                    <h6><?= $servicesName[1] ?></h6>
                    <p><?= $companyServices["Return Policy"] ?></p>
                </div>
            </div>
            <!-- single features -->
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="single-features">
                    <div class="f-icon">
                        <img src="assets/img/features/f-icon3.png" alt="support-24/7"/>
                    </div>
                    <h6><?= $servicesName[2] ?></h6>
                    <p><?= $companyServices["24/7 Support"] ?></p>
                </div>
            </div>
            <!-- single features -->
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="single-features">
                    <div class="f-icon">
                        <img src="assets/img/features/f-icon4.png" alt="secure-payment"/>
                    </div>
                    <h6><?= $servicesName[3] ?></h6>
                    <p><?= $companyServices["Secure Payment"] ?></p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end features Area -->

<!-- start product Area -->
<section id="latestProduct">
    <!-- single product slide -->
    <div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 text-center">
                    <div class="section-title">
                        <h1>Latest Products</h1>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                            dolore
                            magna aliqua.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- single product -->
                <!-- single product -->
                <?php foreach ($products as $s): ?>
                    <div class="col-lg-3 col-md-6">
                        <div class="single-product">
                            <img class="img-fluid" src="<?=$productImagePath.$s->main_img?>" alt="<?= $s->name ?>"/>
                            <div class="product-details">
                                <h6><?= $s->name ?></h6>
                                <div class="price">


                                    <h6>$ <?= $s->newPrice ?></h6>
                                    <h6 class="l-through"><?= $s->oldPrice != "" ? "$ ".$s->oldPrice : "" ?></h6>
                                </div>
                                <div class="prd-bottom">
                                    <a href="" class="social-info">
											<span class="ti-bag ia-addBag"

                                            ></span>
                                        <p class="hover-text">add to bag</p>
                                    </a>
                                    <a  href="index.php?page=singleProduct&id=<?=$s->product_id?>" class="social-info">
                                        <span class="lnr lnr-move"></span>
                                        <p class="hover-text">view more</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <!-- single product slide -->
</section>
<!-- end product Area -->

<!-- Start exclusive deal Area -->
<section class="exclusive-deal-area">
    <div class="container-fluid">
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-6 no-padding exclusive-left">
                <div class="row clock_sec clockdiv" id="clockdiv">
                    <div class="col-lg-12">
                        <h1>Exclusive Hot Deal Ends Soon!</h1>
                        <p>Who are in extremely love with eco friendly system.</p>
                    </div>
                    <div class="col-lg-12">
                        <div class="row clock-wrap">
                            <div class="col clockinner1 clockinner">
                                <h1 class="days">150</h1>
                                <span class="smalltext">Days</span>
                            </div>
                            <div class="col clockinner clockinner1">
                                <h1 class="hours">23</h1>
                                <span class="smalltext">Hours</span>
                            </div>
                            <div class="col clockinner clockinner1">
                                <h1 class="minutes">47</h1>
                                <span class="smalltext">Mins</span>
                            </div>
                            <div class="col clockinner clockinner1">
                                <h1 class="seconds">59</h1>
                                <span class="smalltext">Secs</span>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="" class="primary-btn">Shop Now</a>
            </div>
            <div class="col-lg-6 no-padding exclusive-right">
                <div class="active-exclusive-product-slider">
                    <!-- single exclusive carousel -->
                    <?php foreach($productsOnDiscount as $p): ?>
                        <div class="single-exclusive-slider">
                            <img class="img-fluid" src="assets/img/product/<?= $p->main_img ?>" alt="<?= $p->name ?>">
                            <div class="product-details">
                                <div class="price mt-5">
                                    <h6>$<?= $p->newPrice ?></h6>
                                </div>
                                <h4><?= $p->name ?></h4>
                                <div class="add-bag d-flex align-items-center justify-content-center">
                                    <a class="add-btn" href="index.php?page=singleProduct&id=<?=$p->product_id?>"><i class="fa fa-arrows text-white" aria-hidden="true"></i></a>

                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <!-- single exclusive carousel -->

                </div>
            </div>
        </div>
    </div>
</section>
<!-- End exclusive deal Area -->

<!-- Start brand Area -->
<section class="brand-area section_gap">
    <div class="container">
        <div class="row">
                <a class="col single-img" href="#" disabled="disable">
                    <img class="img-fluid d-block mx-auto" src="<?= $brendImagePath ."/" . $brendsImages["firstBrend"]?>" alt="premium-brand-logo"/>
                </a>
                <a class="col single-img" href="#" disabled="disable">
                    <img class="img-fluid d-block mx-auto" src="<?= $brendImagePath ."/" . $brendsImages["secondBrend"]?>" alt="premium-brand-logo"/>
                </a>
                <a class="col single-img" href="#" disabled="disable">
                    <img class="img-fluid d-block mx-auto" src="<?= $brendImagePath ."/" . $brendsImages["ThirdBrend"]?>" alt="premium-brand-logo"/>
                </a>
                <a class="col single-img" href="#" disabled="disable">
                    <img class="img-fluid d-block mx-auto" src="<?= $brendImagePath ."/" . $brendsImages["FourthBrend"]?>" alt="premium-brand-logo"/>
                </a>
        </div>
    </div>
</section>
<!-- End brand Area -->

<div id="showModal"></div>
