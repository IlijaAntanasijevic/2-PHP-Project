<?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        include "../../config/connection.php";
        include "../../models/functions.php";
        global $conn;
        $name = $_POST["name"];
        $genderID = $_POST["genderID"];
        $price = $_POST["price"];
        $description = $_POST["description"];
        $brendID = $_POST["brendID"];
        $categoryID = $_POST["categoryID"];
        $colorID = $_POST["colorID"];

        $productID = $_POST["productID"];


        $errors = [];
        $imgPath = "../../assets/img/product/";

        if(!$name){
            $errors["nameErr"] = "Name is required";
        }
        if(!$description){
            $errors["descErr"] = "Description is required";
        }
        if(!isset($_FILES["image"])){
            $query = "SELECT main_img FROM product WHERE product_id = $productID";
            $select = $conn->query($query);
            $image = $select->fetch()->main_img;

        }
        else{
            $image = $_FILES["image"];
            $checkImage = checkImage($image,$imgPath);
            if($checkImage["err"]){
                $errors["imgErr"] = $checkImage["err"];
            }
            else {
                $image = $checkImage["fileName"];
            }
        }
        if($genderID == 0){
            $errors["genderErr"] = "Gender is required";
        }
        else if(!is_numeric($genderID)){
            $errors["genderErr"] = "Invalid gender";
        }
        if(!is_numeric($price)){
            $errors["priceErr"] = "Invalid price";
        }
        if($brendID == 0){
            $errors["brendErr"] = "Brend is required";
        }
        else if(!is_numeric($brendID)){
            $errors["brendErr"] = "Invalid brend";
        }
        if($categoryID == 0){
            $errors["categoryErr"] = "Category is required";
        }
        else if(!is_numeric($categoryID)){
            $errors["categoryErr"] = "Invalid category";
        }
        if($colorID == 0){
            $errors["colorErr"] = "Color is required";
        }
        else if(!is_numeric($colorID)){
            $errors["colorErr"] = "Invalid color";
        }

        if(!count($errors)){
            global $image;
            $insert = updateProduct($productID,$name,$genderID,$price,$description,$brendID,$categoryID,$colorID,$image);
            if($insert){
                echo json_encode("Success");
                http_response_code(200);
            }
            else {
                http_response_code(500);
            }
        }
        else {
            echo json_encode($errors);
            http_response_code(400);
        }
    }
    else {
        http_response_code(404);
    }
