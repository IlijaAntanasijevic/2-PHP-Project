<!-- Start Header Area -->
<?php
    global $conn;
    $nav = selectAll("navigation");
    $page = 'home';
    if(isset($_GET["page"])){
        $page = $_GET["page"];
    }
?>
<header class="header_area sticky-header">
    <div class="main_menu">
        <nav class="navbar navbar-expand-lg navbar-light main_box">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <img src="assets/img/fav.png" alt="logo"/>
                <h1 id="logo-title"><a href="index.php" >Sneakz</a></h1>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                    <ul class="nav navbar-nav menu_nav ml-auto py-4">
                        <?php foreach ($nav as $n): ?>
                            <?php
                                $active = "";
                                if($page == $n->path){
                                    $active = "active";
                                }
                                if($n->name == "Admin" && isset($_SESSION["user"]) && $_SESSION["user"]->role == "Admin"){
                                echo "<li class='nav-item $active'>
                                        <a class='nav-link' href='admin/$n->path'>$n->name</a>
                                      </li>";
                                }
                                else if($n->name == "Admin"){
                                    echo "<li></li>";
                                }
                                else if($n->name == "Login" && !isset($_SESSION["user"])){
                                    echo "<li class='nav-item $active'>
                                        <a class='nav-link' href='index.php?page=$n->path'>$n->name</a>
                                      </li>";
                                }
                                else if($n->name == "Login" && isset($_SESSION["user"])){
                                    echo "<li class='nav-item'>
                                        <a class='nav-link' href='models/logout.php'>Logout</a>
                                      </li>";
                                }
                                else if($n->path == "cart" && isset($_SESSION["user"])){
                                    echo "<li class='nav-item mt-2 $active'><a href='index.php?page=$n->path' class='cart text-dark'><span class='ti-bag'></span></a></li>";
                                }
                                else if($n->path == "cart"){
                                    echo "<li></li>";
                                }
                                else {
                                    echo "<li class='nav-item $active'><a class='nav-link' href='index.php?page=$n->path'>$n->name</a></li>";
                                }
                            ?>

                        <?php endforeach; ?>


                    </ul>
                    <ul class="nav navbar-nav navbar-right">

                    </ul>
                </div>
            </div>
        </nav>
    </div>
</header>