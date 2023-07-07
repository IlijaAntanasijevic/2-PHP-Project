<?php
session_start();
    include "utility.php";
    include "functions.php";
    header("Content-type: application/json");
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        include "../config/connection.php";
        global $conn;
        $username = $_POST["username"];
        $password = $_POST["password"];

        $hashPassword = md5($password);
        $hashPassword .= "psw";
        $loginError = [];

        $file = file("../data/blocked.txt");
        $blockedUsersId = [];
        $blockedUserNames = [];
        foreach ($file as $f){
            $blockedUsersId[] = (int)explode("__",$f)[0];
            $blockedUserNames[] = explode("__",$f)[1];
        }

        $validUsername = checkIfExist("user","username",$username);
        $validPassword = checkIfExist("user","password",$hashPassword);
        if(!$validUsername){
            $loginError["usernameError"] = "Username doesn't exists";
            //404
        }
        else if(userIsBlocked($username,$blockedUserNames)){
            $loginError["blockedUser"] = "The user is blocked";
            echo json_encode($loginError);
            die;
        }
        if(!$validPassword){
            $loginError["passwordError"] = "Incorrect password";
        }

        if(isset($loginError["passwordError"]) && $validUsername){
            if(isset($_SESSION["attempts"]) && isset($_SESSION["attemptsTime"])){
                $userTime = $_SESSION["attemptsTime"];
                $check5Min = round(time() - $userTime) / 60;

                if($_SESSION["attempts"] >= 3 && $check5Min <= 5){
                    blockUserAndSendEmail($username);
                    $loginError["blockedUser"] = "The user has been blocked, please contact the administrator";
                    echo json_encode($loginError);
                    unset($_SESSION["attempts"]);
                    unset($_SESSION["attemptsTime"]);
                    die;
                }
                $_SESSION["attempts"] += 1;
            }
            else {
                $_SESSION["attemptsTime"] = time();
                $_SESSION["attempts"] = 1;
            }
        }

        if(count($loginError)){
            echo json_encode($loginError);
            die;
        }
        else {
            unset($_SESSION["attempts"]);
            unset($_SESSION["attemptsTime"]);
            $user = loginUser($username,$hashPassword);
            if($user){
                if(userIsBlocked($user->user_id,$blockedUsersId)){
                    $loginError["blockedUser"] = "The user is blocked";
                    echo json_encode($loginError);
                    die;
                }
                $_SESSION['user'] = $user;
                echo json_encode("success");
                http_response_code(200);
            }
        }
    }
    else {
        //404
        redirect("index.php");
    }