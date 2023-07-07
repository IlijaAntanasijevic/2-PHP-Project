<?php
    include "utility.php";
    header("Content-type: application/json");
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        include "functions.php";
        include "../config/connection.php";
        global $reNameLastname;
        global $reMessage;


        $fullName = $_POST["fullName"];
        $email = $_POST["email"];
        $comment = $_POST["comment"];
        $userID = $_POST["userID"];
        $productID = $_POST["productID"];
        $replayID = $_POST["replayID"];

        $messageError = [];
        if(!preg_match($reNameLastname,$fullName)){
            $messageError["error"] = "Incorrect full name";
        }
        else if(!preg_match($reMessage,$comment)){
            $messageError["error"] = "Incorrect message";
        }
        else if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
            $messageError["error"] = "Email is not valid";
        }
        else if(!is_numeric($productID) || !is_numeric($userID) || (!is_numeric($replayID) && is_null($replayID))){
            $messageError["error"]  = "Incorrect data, try again";
        }

        if(!count($messageError)){
            $insertComment = insertComment($comment,$userID,$replayID,$productID);
            if($insertComment){
                echo json_encode("success");
                http_response_code(201);//204
            }
            else {
                echo json_encode("Server Error");
                http_response_code(500);
            }
        }
        else {
            echo json_encode($messageError);
            http_response_code(201);
        }
    }