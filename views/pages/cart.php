<?php

    if(!isset($_SESSION["user"])){
        redirect("index.php");
        die;
    }
    $userID = $_SESSION["user"]->user_id;
    global $conn;
    $query = "SELECT * FROM cart c INNER JOIN cart_product cp ON c.cart_id = cp.cart_id WHERE c.user_id = $userID
            AND c.cart_id NOT IN (SELECT cart_id FROM product_order)";
    $select = $conn->query($query);
    $cart = $select->fetchAll();
    $subtotal = 0;

?>
<!-- Start Banner Area -->
    <section class="banner-area organic-breadcrumb">
        <div class="container">
            <div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
                <div class="col-first">
                    <h1>Shopping Cart</h1>
                    <nav class="d-flex align-items-center">
                        <a href="index.php">Home<span class="lnr lnr-arrow-right"></span></a>
                        <a href="category.html">Cart</a>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- End Banner Area -->

    <!--================Cart Area =================-->
    <section class="cart_area">
        <div class="container">
            <div class="cart_inner">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Product</th>
                                <th scope="col">Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Total</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($cart as $c):
                                $productID = $c->product_id;
                                $quantity = $c->quantity;


                                $queryProduct = "SELECT * FROM product pr INNER JOIN price p
                                                ON pr.product_id = p.product_id 
                                                WHERE pr.product_id = $productID 
                                                ORDER BY p.date DESC LIMIT 1 ";
                                $selectProduct = $conn->query($queryProduct);
                                $product = $selectProduct->fetch();
                                $price = $product->price;
                                $subtotal += ($price * $quantity) ;
                            ?>
                                <tr>
                                    <td>
                                        <div class="media">
                                            <div class="d-flex">
                                                <img height="100" src="assets/img/product/<?=$product->main_img?>" alt="<?=$product->name?>"/>
                                            </div>
                                            <div class="media-body">
                                                <p><?=$product->name ?></p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <h5><?=$price?>$</h5>
                                    </td>
                                    <td>
                                        <div class="product_count">
                                            <input type="text"
                                                   name="qty"
                                                   id="sst"
                                                   maxlength="12"
                                                   value="<?=$quantity?>"
                                                   title="Quantity:"
                                                   class="input-text qty cart-qty"
                                                   disabled = 'disabled'>
                                        </div>
                                    </td>
                                    <td>
                                        <h5><?=$price * $quantity?> $</h5>
                                    </td>
                                    <td>
                                        <i class="fa fa-trash-o ia-trash" data-id="<?=$c->cp_id?>" aria-hidden="true"></i>
                                    </td>
                                </tr>

                            <?php endforeach; ?>
                            </tbody>
                        </table>

                    <div class="d-flex justify-content-between mt-5">
                        <div>
                            <h5 class="h4">Subtotal: <?= $subtotal ?>$</h5>
                        </div>
                        <div class="checkout_btn_inner d-flex align-items-center">
                            <a class="gray_btn" href="index.php?page=shop" style="padding: 0px 20px">Continue Shopping</a>
                            <a class="primary-btn rounded-0" href="index.php?page=checkout" style="line-height: 40px;">Proceed to checkout</a>
                        </div>

                    </div>


                </div>
            </div>
        </div>
    </section>
    <!--================End Cart Area =================-->

    <!-- start footer Area -->