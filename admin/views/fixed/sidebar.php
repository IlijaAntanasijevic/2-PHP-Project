<body>
<div class="container-fluid position-relative d-flex p-0">
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->


    <!-- Sidebar Start -->
    <div class="sidebar pe-4 pb-3" >
        <nav class="navbar bg-secondary navbar-dark">
            <a href="admin.php" class="navbar-brand mx-4 mb-3">
                <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>Sneakz</h3>
            </a>
            <div class="d-flex align-items-center ms-4 mb-4">
                <div class="ms-3">
                    <h6 class="mb-0"><?= $_SESSION["user"]->username?></h6>
                    <span><?= $_SESSION["user"]->role?></span>
                </div>
            </div>
            <div class="navbar-nav w-100">
                <a href="admin.php?page=admin-home" class="nav-item nav-link"><i class="fa fa-home me-2"></i>Dashboard</a>
                <a href="admin.php?page=products" class="nav-link"><i class="fa fa-table me-2"></i>Sneakers</a>
                <a href="admin.php?page=discount" class="nav-link"><i class="fa fa-percent me-2"></i>Discount</a>
                <!--<a href="admin.php?page=comment" class="nav-link"><i class="fa fa-comments me-2"></i>Comments</a>-->
                <a href="admin.php?page=rating" class="nav-link"><i class="fa fa-star me-2"></i>Ratings</a>
                <a href="admin.php?page=user" class="nav-link"><i class="fa fa-users me-2"></i>Users</a>
                <a href="admin.php?page=specification" class="nav-link"><i class="fa fa-random me-2"></i>Specification</a>
                <a href="admin.php?page=activity" class="nav-item nav-link"><i class="fa fa-hashtag me-2"></i>Activity</a>

            </div>
        </nav>
    </div>
    <!-- Sidebar End -->