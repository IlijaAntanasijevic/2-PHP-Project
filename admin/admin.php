<?php
session_start();
include "../config/connection.php";
include "../models/functions.php";
include_once "views/fixed/header.php";
include "views/fixed/sidebar.php";
global $conn;

if(!isset($_SESSION['user']) || $_SESSION['user']->role != 'Admin'){
    header("Location: ../404.php");
    exit;
}

?>
        <div class="content">
            <?php
            include "views/fixed/navbar.php";
            if(isset($_GET["page"])) {
                switch ($_GET["page"]) {
                    case 'products':
                        include "views/pages/products.php";
                        break;
                    case 'discount':
                        include "views/pages/discount.php";
                        break;
                    case 'comment':
                        include "views/pages/comment.php";
                        break;
                    case 'rating':
                        include "views/pages/rating.php";
                        break;
                    case 'user':
                        include "views/pages/user.php";
                        break;
                    case 'specification':
                        include "views/pages/specification.php";
                        break;
                    case 'singleOrder':
                        include "views/pages/singleOrder.php";
                        break;
                    case 'addProduct':
                        include "views/pages/addNewProduct.php";
                        break;
                    case 'updateProduct':
                        include "views/pages/updateProduct.php";
                        break;
                    case 'activity':
                        include "views/pages/activity.php";
                        break;
                    default :
                        include "views/pages/admin-home.php";
                        break;
                }
            }

            else {
                include "views/pages/admin-home.php";
            }
            echo "</div>";
            include "views/fixed/footer.php";
            ?>