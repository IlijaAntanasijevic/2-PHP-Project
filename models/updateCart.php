<?php
    header("Content-type: application/json");
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $cartProductID = $_POST["id"];
        include "../config/connection.php";
        global $conn;

        $query = "DELETE FROM cart_product WHERE cp_id = :id";
        $delete = $conn->prepare($query);
        $delete->bindParam(":id",$cartProductID);
        $res = $delete->execute();

        if($res){
            echo json_encode($res);
            http_response_code(200);
        }
        else {
            http_response_code(500);
        }
    }
    else {
        http_response_code(404);
    }
?>