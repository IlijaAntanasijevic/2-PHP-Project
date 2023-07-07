<?php
    header("Content-type: application/json");
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        include "functions.php";
        include "../config/connection.php";
        include "utility.php";
        global $reNameLastname;
        global $rePhone;
        global $reMessage;
        $reAddress = "/^([A-Z][a-z]{2,15}|[0-9]|[0-9][0-9])(\s([A-Z][a-z]{1,15}|[0-9]|[0-9][0-9]))*$/";
        $reCity = "/^[a-zA-z]{3,25}$/";
        $rePostcode = "/[\d]{5}/";
        $errors = [];

        $firstName = $_POST["firstName"];
        $lastName = $_POST["lastName"];
        $companyName = $_POST["companyName"];
        $phone = $_POST["phone"];
        $email= $_POST["email"];
        $address = $_POST["firstAddress"];
        $city = $_POST["city"];
        $postcode = $_POST["postcode"];
        $detailsMsg = $_POST["detailsMsg"];
        $cartID = $_POST["cartID"];

        if(!is_numeric($cartID)){
            http_response_code(500);
            die;
        }

        if(!preg_match($reNameLastname,$firstName)){
            $errors[] = "Invalid first name";
        }
        if(!preg_match($reNameLastname,$lastName)){
            $errors[] = "Invalid last name";
        }
        if(!preg_match($rePhone,$phone)){
            $errors[] = "Invalid phone: 060XXXXXXX";
        }
        if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
            $errors[] = "Invalid email";
        }
        if(!preg_match($reAddress,$address)){
            $errors[] = "Invalid address";
        }
        if(!preg_match($reCity,$city)){
            $errors[] = "Invalid City";
        }
        if(!preg_match($rePostcode,$postcode)){
            $errors[] = "Invalid postcode";
        }

        if($errors){
            echo json_encode($errors);
            http_response_code(400);
        }
        else {
            //INSERT
             insertOrder($firstName,$lastName,$companyName,$phone,$email,$address,$city,$postcode,$detailsMsg,$cartID);
            echo json_encode("success");
            http_response_code(200);
        }


    }
    else {
        http_response_code(404);
    }

?>