<?php
    header("Content-type: application/json");
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        include "functions.php";
        include "../config/connection.php";
        global $conn;
        $msg = "";
        $userID = $_POST["userID"];
        $productID = $_POST["productID"];
        $quantity = $_POST["quantity"];
        $alredyInCart = false;
        if(!is_numeric($userID) || !is_numeric($productID) || !is_numeric($quantity)){
            http_response_code(500);
            die;
        }

         $cartID = getCartID($userID);


        if($cartID){
            $query = "SELECT * FROM cart c INNER JOIN cart_product cp ON c.cart_id = cp.cart_id
                  WHERE c.user_id = $userID AND product_id = $productID AND cp.cart_id = $cartID";
            $select = $conn->query($query);
            $alredyInCart = $select->rowCount();
        }


        if($alredyInCart){
            $msg = "Product is already in cart";
            echo json_encode($msg);
            http_response_code(200);
        }
        else{
            $addToCart = insertCart($userID,$productID,$quantity);
            if($addToCart){
                $msg = "Succeed added to cart";
                echo json_encode($msg);
                http_response_code(200);
            }
        }



    }
    else {
        http_response_code(404);
    }