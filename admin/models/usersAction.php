<?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        include "../../config/connection.php";
        include "../../models/functions.php";
        global $conn;
        $id = $_POST["id"];
        $action = $_POST["action"];
        $filePath = "../../data/blocked.txt";

        $query = "SELECT u.*,r.name as role FROM user u INNER JOIN role r ON u.role_id = r.role_id WHERE user_id = $id";
        $select = $conn->query($query);
        $user = $select->fetch();
        if($action == "block"){
            if($user->role == "Admin"){
                http_response_code(202);
                echo json_encode("You can't block admin");
                die;
            }
            $file = fopen($filePath,"a");
            $string = $id . "__" . $user->username . "__" . $user->email . "__" . $user->phone . "\n";

            if(fwrite($file,$string)){
                fclose($file);
                http_response_code(200);
            }
            else {
                http_response_code(501);
            }
        }

        if($action == "unblock"){
            $file = file($filePath);

            $newFile = [];
            foreach ($file as $f){
                $user = explode("__",$f);
                $userID = (int)$user[0];

                if($userID != $id){
                    $newFile[] = $f;
                }
            }
            $new = fopen($filePath,"w");
            fwrite($new,implode($newFile));
            if(fclose($new)){

                http_response_code(200);
            }
            else {
                http_response_code(501);
            }
        }

    }
    else {
        http_response_code(404);
    }