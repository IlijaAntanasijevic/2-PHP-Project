<?php
    $reNameLastname = "/^[A-Z][a-z]{2,15}(\s[A-Z][a-z]{2,15})?$/";
    $reUsername = "/^[a-zA-Z0-9_-]{3,16}$/";
    $rePhone = "/^[\d]{7,10}$/";
    $rePassword = "/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/";
    $reMessage = "/^[a-zA-Z0-9'.,\s]{1,}$/";
    function redirect($location){
        header("Location: $location");
    }