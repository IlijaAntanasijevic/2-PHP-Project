<?php
const envPath = __DIR__ . "/.env";

define("SERVER",env("SERVER"));
define("DATABASE",env("DATABASE"));
define("USERNAME",env("USERNAME"));
define("PASSWORD",env("PASSWORD"));

function env($marker){
    $arr = file(envPath);
    $define = "";

    foreach ($arr as $val){
        $row = trim($val);
        list($id,$value) = explode(":",$row);
        if($id == $marker){
            $define = $value;
            break;
        }
    }
    return $define;
}

$promotionBanner = [
    "title" => "Nike New <br> Collection!",
    "description" => "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.",
    "img" => "banner-img.png"
];

$socialLinks = [
    "twitter" => "https://twitter.com/",
    "facebook" => "https://www.facebook.com/",
    "linkedin" => "https://www.linkedin.com/",
    "instagram" => "https://www.instagram.com/",
];

$aboutUsFooter = "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore dolore magna aliqua.";


$brendsImages = [
    "firstBrend" => "1.png",
    "secondBrend" => "2.png",
    "ThirdBrend" => "3.png",
    "FourthBrend" => "4.png"
];

$companyInfo = [
    "city" => "California, United States",
    "address" => "123 Street, New York, USA",
    "phone" => "+012 345 67890",
    "email" => "info@example.com",
    "workTime" => "Mon to Fri 9am to 6 pm"
];

$companyServices = [
    "Free Delivery" => "Free Shipping on all order",
    "Return Policy" => "Free Shipping on all order",
    "24/7 Support" => "Free Shipping on all order",
    "Secure Payment" => "Free Shipping on all order"
];

$instagramFeed = ["i1.jpg","i2.jpg","i3.jpg","i4.jpg","i5.jpg","i6.jpg","i7.jpg","i8.jpg"];
