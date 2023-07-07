<?php
    header("Content-type: application/json");
    if($_SERVER["REQUEST_METHOD"] == "POST"){

        $limit = $_POST["limit"];
        if(!is_numeric($limit)){
            die("Error");
        }
        include "../config/connection.php";
        include "functions.php";

        try {
            $products = selectProducts($limit);
            echo json_encode($products);

            http_response_code(200);
        }
        catch (PDOException $exception){
            http_response_code(500);
        }
    }