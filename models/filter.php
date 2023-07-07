<?php
header("Content-type: application/json");
include "utility.php";
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        include "../config/connection.php";
        include "functions.php";
        global $conn;
        $categoryID = $_POST["categoryID"];
        $genderID = $_POST["genderID"];
        $colorID = $_POST["colorID"];
        $brendID = $_POST["brendID"];
        $sort = $_POST["sort"];
        $maxPrice = $_POST["maxPrice"];
        $minPrice = $_POST["minPrice"];
        $limit = $_POST["limit"];
        $filtered = filterType($genderID,$categoryID,$colorID,$brendID,$sort,$maxPrice,$minPrice,$limit);
        echo json_encode($filtered);
    }
    else {
        //404
        redirect("index.php");
    }