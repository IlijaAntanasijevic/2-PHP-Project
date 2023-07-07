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
        $message = $_POST["message"];
        $stars = $_POST["starsNumber"];
        $userID = $_POST["userID"];
        $productID = $_POST["productID"];

        $messageError = [];

        if(!preg_match($reNameLastname,$fullName)){
            $messageError["error"] = "Incorrect full name";
        }
        else if(!preg_match($reMessage,$message)){
            $messageError["error"] = "Incorrect message";
        }
        else if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
            $messageError["error"] = "Email is not valid";
        }
        else if(!is_numeric($productID) || !is_numeric($userID)){
            $messageError["error"]  = "Incorrect data, try again";
        }
        else if(!is_numeric($stars) || ($stars <= 0 || $stars > 5)){
            $messageError["error"] = "Incorrect type of stars";
        }
         else if(!checkPurchased($userID,$productID)){
            $messageError ["error"]= "In order to leave a rating, you must purchase an item";
        }

        else if(checkIfExistReview($userID,$productID)){
            $messageError ["error"]= "You can leave only one rating";
        }


        if(!count($messageError)){
            $insertReview = insertReview($message,$stars,$userID,$productID);
            if($insertReview){
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