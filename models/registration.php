<?php
    include "utility.php";
    header("Content-type: application/json");
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        include "functions.php";
        include "../config/connection.php";
        global $conn;

        $name = $_POST["name"];
        $lastName = $_POST["lastName"];
        $username = $_POST["username"];
        $phone = $_POST["phone"];
        $email = $_POST["email"];
        $password = $_POST["password"];

        global $reNameLastname;
        global $reUsername;
        global $rePassword;
        global $rePhone;


        $errors = 0;
        $existsErrors = [];

        if(!preg_match($reNameLastname,$name)){
            $errors++;
        }
        if(!preg_match($reNameLastname,$lastName)){
            $errors++;
        }
        if(!preg_match($reUsername,$username)){
            $errors++;
        }
        if(!preg_match($rePassword,$password)){
            $errors++;
        }
        else {
            $usernameExists = checkIfExist("user","username",$username);

            if($usernameExists){
                $existsErrors["usernameError"] = "Username already exists";
            }
        }
        if(!preg_match($rePhone,$phone)){
            $errors++;
        }
        else {
            $phoneExists = checkIfExist("user","phone",$phone);
            if($phoneExists){
                $existsErrors["phoneError"] = "Phone already exists";
            }
        }
        if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
            $errors++;
        }
        else {
            $emailExists = checkIfExist("user","email",$email);
            if($emailExists){
                $existsErrors["emailError"] = "Email already exists";
            }
        }
        if(count($existsErrors)){
            echo json_encode($existsErrors);
            http_response_code(208);
            die;
        }

        if(!$errors){
            $hashPassword = md5($password);
            $hashPassword .= "psw";
            $register = registerUser($name,$lastName,$username,$phone,$email,$hashPassword);
            if($register){
                http_response_code(200);
            }
            else {
                echo json_encode("Server Error");
                http_response_code(500);
            }
        }
    }
    else {
        redirect("index.php");
    }
