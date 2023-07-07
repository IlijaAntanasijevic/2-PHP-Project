<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include "../../config/connection.php";
    include "../../models/functions.php";
    global $conn;
    $date = $_POST["date"];
    $value = $_POST["value"];
    $productID = $_POST["productID"];
    //PROVERA

    try {
        $query = "INSERT INTO discount(value,date_to,product_id) VALUES(:valueDisc, :dateTo, :productID)";
        $insert = $conn->prepare($query);
        $insert->bindParam(":valueDisc",$value);
        $insert->bindParam(":dateTo",$date);
        $insert->bindParam(":productID",$productID);
        $insert->execute();
        http_response_code(200);
        echo json_encode("Success");
    }
    catch (PDOException $ex){
        echo $ex->getMessage();
    }
}
else {
    http_response_code(404);
}
