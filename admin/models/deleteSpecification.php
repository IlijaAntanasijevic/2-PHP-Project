<?php
header("Content-type: application/json");
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        global $conn;
        include "../../config/connection.php";
        include "../../models/functions.php";
        $id = $_POST["id"];
        $type = $_POST["type"];
        $result = checkSpecification($id,$type);

        if($result){
            http_response_code(202);
            //echo json_encode('The brend is in use.Cannot delete!');
            echo json_encode("in use");
        }
        else {
            $delete = deleteSpecification($id,$type);
            http_response_code(200);
            echo json_encode("success");

        }
    }
    else {
        http_response_code(404);
    }