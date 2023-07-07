<?php
header("Content-type: application/json");
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include "../../config/connection.php";
    include "../../models/functions.php";
    $name = $_POST["name"];
    $genderID = $_POST["genderID"];
    $quantity = $_POST["quantity"];
    $price = $_POST["price"];
    $description = $_POST["description"];
    $brendID = $_POST["brendID"];
    $categoryID = $_POST["categoryID"];
    $colorID = $_POST["colorID"];
    $mainImg = $_FILES["image"];

    $errors = [];
    $imgPath = "../../assets/img/product/";

    $imgName = $mainImg["name"];
    if(!$name){
        $errors["nameErr"] = "Name is required";
    }
    if(!$description){
        $errors["descErr"] = "Description is required";
    }
    if(!$imgName){
        $errors["imgErr"] = "Image is required";
    }
    else{
        $checkImage = checkImage($mainImg,$imgPath);
        if($checkImage["err"]){
            $errors["imgErr"] = $checkImage["err"];
        }
        else {
            $fileName = $checkImage["fileName"];
        }
    }
    if($genderID == 0){
        $errors["genderErr"] = "Gender is required";
    }
    else if(!is_numeric($genderID)){
        $errors["genderErr"] = "Invalid gender";
    }
    if(!is_numeric($quantity)){
        $errors["quantityErr"] = "Invalid quantity";
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
        global $fileName;
        $insert = insertProduct($name,$genderID,$quantity,$price,$description,$brendID,$categoryID,$colorID,$fileName);
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