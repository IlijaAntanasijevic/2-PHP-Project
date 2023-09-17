<?php
$page = "home";
$id = null;
$ilija = null;
if(isset($_GET["page"])){
    $page = $_GET["page"];
    if($page == "singleProduct"){
        $id = $_GET["id"];
    }
}
$ip = $_SERVER["REMOTE_ADDR"];
$date = date("Y-m-d H:i:s",$_SERVER["REQUEST_TIME"]);

    session_start();
    include "config/connection.php";
    include "models/functions.php";
    include "models/utility.php";
    include "views/fixed/head.php";
trackVisitors($ip,$date,$page,$id);


     if(isset($_GET["page"])){
        switch ($_GET["page"]){
            case 'shop' :
                include "views/pages/shop.php";
                include "views/fixed/nav.php";
                break;
            case 'checkout' :
                include "views/pages/checkout.php";
                include "views/fixed/nav.php";
                break;
            case 'cart' :
                include "views/pages/cart.php";
                include "views/fixed/nav.php";
                break;
            case 'contact' :
                include "views/pages/contact.php";
                include "views/fixed/nav.php";
                break;
            case 'login' :
                include "views/pages/login.php";
                include "views/fixed/nav.php";
                break;
            case 'registration' :
                include "views/pages/registration.php";
                include "views/fixed/nav.php";
                break;
            case 'author' :
                include "views/pages/author.php";
                include "views/fixed/nav.php";
                break;
            case 'singleProduct' :
                if(isset($_GET["id"])){
                    include "views/pages/single-product.php";
                    include "views/fixed/nav.php";
                }
                else {
                    include "views/pages/home.php";
                    include "views/fixed/nav.php";
                }
                break;
            default :
                include "views/pages/home.php";
                include "views/fixed/nav.php";
                break;
        }
    }
    else {
      include "views/pages/home.php";
        include "views/fixed/nav.php";
    }

    include "views/fixed/footer.php";
    include "views/fixed/footer-links.php";


