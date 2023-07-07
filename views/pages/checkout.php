<?php

    if(!isset($_SESSION["user"])){
        redirect("index.php");
        http_response_code(404);
    }
    global $conn;
    $user = $_SESSION["user"];
    $userID = $user->user_id;
    $query = "SELECT * FROM cart c INNER JOIN cart_product cp ON c.cart_id = cp.cart_id WHERE c.user_id = $userID
                AND c.cart_id NOT IN (SELECT cart_id FROM product_order)";
    $select = $conn->query($query);
    $order = $select->fetchAll();
    if(!count($order)){
        redirect("index.php");
        http_response_code(404);
        exit;
    }
    $subtotal = 0;
    $cartID = $order[0]->cart_id;
?>
<!-- Start Banner Area -->

    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Checkout</h1>
                    <nav class="d-flex align-items-center">
                        <a href="index.html">Home<span class="lnr lnr-arrow-right"></span></a>
                        <a href="single-product.html">Checkout</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner Area -->

    <!--================Checkout Area =================-->
<h3 class="title_confirmation error successOrder">Thank you. Your order has been received.</h3>
    <section class="checkout_area section_gap">
        <div class="container">
            <div class="billing_details">
                <div class="row">
                    <div class="col-lg-8">
                        <h3>Billing Details</h3>
                        <form class="row contact_form" action="#" method="post" novalidate="novalidate">
                            <div class="col-md-6 form-group p_star">
                                <input type="text" class="form-control" value="<?= $user->name ?>" id="firstNameOrder" name="firstNameOrder">
                                <p class="alert alert-danger error">Invalid Name</p>
                            </div>
                            <div class="col-md-6 form-group p_star">
                                <input type="text" class="form-control" value="<?= $user->last_name ?>" id="lastNameOrder" name="lastNameOrder">
                                <p class="alert alert-danger error">Invalid Lastname</p>
                            </div>
                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control" id="company" name="company" placeholder="Company name">
                                <p class="alert alert-danger error">Invalid Company name</p>
                            </div>
                            <div class="col-md-6 form-group p_star">
                                <input type="text" class="form-control" value="<?=$user->phone?>" id="phoneNumberOrder" name="phoneNumberOrder">
                                <p class="alert alert-danger error">Invalid phone: 060XXXXXXX</p>

                            </div>
                            <div class="col-md-6 form-group p_star">
                                <input type="text" class="form-control" id="emailOrder" value="<?= $user->email ?>" name="emailOrder">
                                <p class="alert alert-danger error">Invalid email</p>

                            </div>
                            <div class="col-md-12 form-group p_star">
                                <input type="text" class="form-control" id="add1" name="add1" placeholder="Address line *">
                                <p class="alert alert-danger error">Invalid address</p>
                            </div>
                            <div class="col-md-12 form-group p_star">
                                <input type="text" class="form-control" id="cityOrder" name="cityOrder" placeholder="Town/City">
                                <p class="alert alert-danger error">Invalid Town/City</p>


                            </div>
                            <div class="col-md-12 form-group">
                                <input type="text" class="form-control" id="zip" name="zip" placeholder="Postcode/ZIP">
                                <p class="alert alert-danger error">Invalid postcode</p>
                            </div>
                            <div class="col-md-12 form-group">
                                <div class="creat_account">
                                    <h3>Shipping Details</h3>
                                </div>
                                <textarea class="form-control" name="orderMessage" id="orderMessage" rows="1" placeholder="Order Notes"></textarea>
                            </div>
                            <input type="hidden" id="cartID" value="<?= $cartID ?>">
                        </form>
                    </div>
                    <div class="col-lg-4">
                        <div class="order_box">
                            <h2>Your Order</h2>
                            <ul class="list">
                                <li><a href="#">Product <span>Total</span></a></li>
                                <?php
                                foreach ($order as $o):
                                $productID = $o->product_id;
                                $quantity = $o->quantity;
                                    $queryProduct = "SELECT * FROM product pr INNER JOIN price p
                                                ON pr.product_id = p.product_id 
                                                WHERE pr.product_id = $productID 
                                                ORDER BY p.date DESC LIMIT 1 ";
                                $selectProduct = $conn->query($queryProduct);
                                $product = $selectProduct->fetch();
                                    $price = $product->price;
                                    $subtotal += ($price * $quantity) ;
                                $totalProduct = $quantity * $price;
                                ?>
                                <li>
                                    <a href="#"><?= $product->name ?>
                                        <span class="middle">x <?= $quantity?></span>
                                        <span class="last">$<?= $price * $quantity ?></span>
                                    </a>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                            <ul class="list list_2">
                                <li><a href="#">Total <span>$<?= $subtotal ?></span></a></li>
                            </ul>
                            <button class="primary-btn mt-5 w-100 border-0" id="checkoutOrder">Order</button>
                        </div>
                        <div class="alert alert-danger error" id="serverError"></div>
                        <h3 class="title_confirmation successOrder error">Thank you. Your order has been received.</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--================End Checkout Area =================-->
