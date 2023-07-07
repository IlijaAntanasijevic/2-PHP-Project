<?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        include "utility.php";
        include "functions.php";
        include "../config/connection.php";
        global $reMessage;
        $commentID = $_POST["commentID"];
        $userID = $_POST["userID"];
        $productID = $_POST["productID"];
        $fullName = $_POST["fullName"];
        $message = $_POST["message"];
        $errors = 0;

        if(!preg_match($reMessage,$message)){
            $errors++;
        }
        if(!is_numeric($userID) || !is_numeric($productID) || !is_numeric($commentID)){
            $errors++;
        }
        if(!$errors){
            $insertAnswer = insertComment($message,$userID,$commentID,$productID);
            if($insertAnswer){
                http_response_code(200);
                die;
            }
            http_response_code(500);
        }
        else {
            http_response_code(500);
        }
    }
    else {
        http_response_code(404);
    }
