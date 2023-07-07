<?php
header("Content-type: application/json");
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        include "../../config/connection.php";
        include "../../models/functions.php";
        $type = $_POST["type"];
        $result = null;
        /*
          $result->id = $result->category_id;
            unset($result->category_id);
         */
        if($type == "brend"){
            $result = selectAll("brend");
            foreach ($result as $r){
                $r->id = $r->brend_id;
                $r->type = "brend";
                unset($r->brend_id);
            }
        }
        else if($type == "color"){
            $result = selectAll("color");
            foreach ($result as $r){
                $r->id = $r->color_id;
                $r->type = "color";

                unset($r->color_id);
            }
        }
        else if($type == "category"){
            $result = selectAll("category");
            foreach ($result as $r){
                $r->id = $r->category_id;
                $r->type = "category";
                unset($r->category_id);
            }
        }

        echo json_encode($result);
        http_response_code(200);

    }
    else {
        http_response_code(404);
    }