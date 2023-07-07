<?php
    include "../../config/connection.php";
    include "../../models/functions.php";
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $productID = $_POST["id"];
        if(!is_numeric($productID)){
            http_response_code(500);
            die;
        }
        global $conn;
        $conn->beginTransaction();
        try {
            $queryPrice = "DELETE FROM price WHERE product_id = $productID";
            $deletePrice = $conn->query($queryPrice);

            $queryProduct = "DELETE FROM product WHERE product_id = $productID";
            $deleteProduct = $conn->query($queryProduct);

            http_response_code(200);

        }
        catch (PDOException $exception){
            //log file
            echo json_encode($exception->getMessage());
            $conn->rollback();
            http_response_code(500);
        }
        $conn->commit();
    }
    else {
        http_response_code(404);
    }