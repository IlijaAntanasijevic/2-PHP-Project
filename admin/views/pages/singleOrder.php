<?php

     if(!isset($_SESSION['user']) || $_SESSION['user']->role != 'Admin' || !isset($_GET["id"])){
        header("Location: ../404.php");
        die;
    }
    global $conn;
     $orderID = $_GET["id"];

     $order = selectAll("product_order","WHERE order_id = $orderID")[0];
     $cartID = $order->cart_id;
     $orderDate = date("Y-m-d",strtotime($order->date));
     $query = "SELECT *,cp.quantity as qty FROM cart_product cp INNER JOIN product p ON cp.product_id = p.product_id WHERE cp.cart_id = $cartID";
     $select = $conn->query($query);
     $products = $select->fetchAll();
?>

<div class="container">
    <table class="table table-light mt-5">
        <thead>
            <th>ID</th>
            <th>Full Name</th>
            <th>Phone</th>
            <th>City</th>
            <th>Email</th>
            <th>Address</th>
            <th>Postcode</th>
        </thead>
        <tbody>
            <tr>
                <td><?= $order->order_id ?></td>
                <td><?= $order->name . " " . $order->last_name ?></td>
                <td><?= $order->phone ?></td>
                <td><?= $order->email ?></td>
                <td><?= $order->city ?></td>
                <td><?= $order->address ?></td>
                <td><?= $order->postcode ?></td>
            </tr>
        </tbody>
    </table>
    <table class="table table-light text-center" style="margin-top: -16px">
        <thead>
            <th>Company</th>
            <th>Description</th>
            <th>Total</th>
            <th>Date</th>
        </thead>
        <tbody>
            <tr>
                <td><?= $order->company ? $order->company : "/" ?></td>
                <td><?= $order->description ? $order->description : "/" ?></td>
                <td><?= $order->total ?>$</td>
                <td><?= date("Y.m.d", strtotime($order->date)) ?></td>
            </tr>
        </tbody>
    </table>
        <h4>Order Products: </h4>
            <ol>
            <?php
                foreach ($products as $p):
                 $priceQuery = "SELECT * FROM price
             WHERE product_id = $p->product_id AND date <= '$orderDate' ORDER BY date DESC LIMIT 1";#AND date <= $orderDate
                $selectPrice = $conn->query($priceQuery);
                $price = $selectPrice->fetch()->price;//->price
                $string = "Product: &nbsp;&nbsp; <a href='admin.php?page=updateProduct&id=$p->product_id'>$p->name</a> - $$price, $p->qty qty "
            ?>

                    <li class="fs-5 text-white my-2"><?= $string?></li>

            <?php endforeach; ?>
            </ol>
</div>
<a href="admin.php?page=admin-home" id="adminBtn">Dashboard <i class="fa fa-home me-2"></i></a>