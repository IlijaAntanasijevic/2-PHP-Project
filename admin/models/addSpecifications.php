<?php
header("Content-type: application/json");

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        include "../../config/connection.php";
        include "../../models/functions.php";
        $name = $_POST["name"];
        $type = $_POST["type"];

        $insert = insertSpecification($name,$type);
        if($insert){
            echo json_encode("Success");
            http_response_code(200);
        }
        else {
            http_response_code(500);
        }
    }
    else {
        http_response_code(404);
    }
