<?php

    $totalProducts = countOfProducts();
    $totalPages = ceil($totalProducts / perPage);
    $allShoes = selectProducts();
    $gender = selectAll('gender');
    $category = selectAll('category');
    $brand = selectAll("brend");
    $color = selectAll("color");
    $productImagePath = "assets/img/product/";

    $userRegistered = false;
    $userID = null;
    if(isset($_SESSION["user"])){
        $userID = $_SESSION["user"]->user_id;
        $userRegistered = true;
    }


?>

	<!-- Start Banner Area -->
	<section class="banner-area organic-breadcrumb">
		<div class="container">
			<div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
				<div class="col-first">
					<h1>Shop Category page</h1>
					<nav class="d-flex align-items-center">
						<a href="index.php">Home<span class="lnr lnr-arrow-right"></span></a>
						<a href="#">Shop<span class="lnr lnr-arrow-right"></span></a>
						<p>Fashion Category</p>
					</nav>
				</div>
			</div>
		</div>
	</section>
	<!-- End Banner Area -->
	<div class="container">
		<div class="row">
			<div class="col-xl-3 col-lg-4 col-md-5">
				<div class="sidebar-categories">
                    <!-- Filter Gender - Type -->
					<div class="head">Browse Categories</div>
					<ul class="main-categories" id="categories">
                        <?php foreach ($gender as $g): ?>
                        <li class="main-nav-list">
                            <a data-toggle="collapse" href="#<?=$g->name."-".$g->gender_id?>" aria-expanded="false" aria-controls="fruitsVegetable">
                                <span class="lnr lnr-arrow-right"></span><?=$g->name?></a>
                                <ul class="collapse" id="<?=$g->name."-".$g->gender_id?>" data-toggle="collapse" aria-expanded="false" aria-controls="<?=$g->gender_id?>?>">
                                    <?php
                                    foreach ($category as $c):
                                        global $conn;
                                        $genderID = $g->gender_id;
                                        $categoryID = $c->category_id;
                                        $query = "SELECT COUNT(*) as number FROM product WHERE gender_id = $genderID AND category_id = $categoryID";
                                        $result = $conn->query($query);
                                        $numberOfCategory = $result->fetch();
                                        $numberOfCategory = $numberOfCategory->number;
                                    ?>
                                        <li class="main-nav-list child">
                                            <a href="#" class="gender" data-genderid="<?=$g->gender_id?>" data-categoryid="<?=$c->category_id?>"><?=$c->name?>
                                                <span class="number">(<?=$numberOfCategory?>)
                                                </span>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                        </li>


                        <?php endforeach; ?>
                    </ul>

				</div>
				<div class="sidebar-filter mt-50">
					<div class="top-filter-head">Product Filters</div>
					<div class="common-filter">
						<div class="head">Brands</div>
						<form action="#">
							<ul>
                                <?php
                                    foreach ($brand as $b):
                                        $id = $b->brend_id;
                                        $countBrand = countOfProducts("WHERE brend_id = $id");
                                ?>
                                    <li class="filter-list">
                                        <input class="pixel-radio brands" type="radio" value="<?=$b->brend_id?>" id="brand-<?=$b->brend_id?>" name="brand"/>
                                        <label for="brand-<?=$b->brend_id?>"><?=$b->name?><span>(<?= $countBrand ?>)</span></label>
                                    </li>
                                <?php endforeach; ?>
							</ul>
						</form>
					</div>
					<div class="common-filter">
						<div class="head">Color</div>
						<form action="#">
							<ul>
                                <?php
                                    foreach ($color as $c):
                                        $id = $c->color_id;
                                        $countColor = countOfProducts("WHERE color_id = $id");
                                ?>
                                    <li class="filter-list">
                                        <input class="pixel-radio colors" type="radio" id="color-<?=$c->color_id?>" value="<?=$c->color_id?>" name="color"/>
                                        <label for="color-<?=$c->color_id?>"><?=$c->name?><span>(<?= $countColor ?>)</span></label>
                                    </li>
                                <?php endforeach; ?>
							</ul>
						</form>
					</div>
					<div class="common-filter">
						<div class="head">Price</div>
						<div class="price-range-area">
							<div id="price-range"></div>
							<div class="value-wrapper d-flex">
								<div class="price">Price:</div>
								<span>$</span>
								<div id="lower-value"></div>
								<div class="to">to</div>
								<span>$</span>
								<div id="upper-value"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-9 col-lg-8 col-md-7">

				<!-- Start Filter Bar -->
				<div class="filter-bar d-flex flex-wrap justify-content-between align-items-center">
					<div class="sorting">
						<select id="ddlSort">
							<option value="new">Newest</option>
							<option value="old">Older</option>
                            <option value="price-asc">Price ASC</option>
                            <option value="price-desc">Price DESC</option>
						</select>
					</div>
					<div class="pagination" id="paginationTop" data-totalpages="<?=$totalPages?>">
						<a href="#" class="prev-arrow"><i class="fa fa-long-arrow-left" aria-hidden="true"></i></a>
                        <?php
                        for($i = 0 ; $i<$totalPages;$i++):
                            if($i < 2):
                        ?>
                            <a href="#"
                               class="ia-pagination
                               <?php if($i==0) echo 'active';?>"
                               data-limit="<?=$i?>"><?=$i+1?>
                            </a>

                            <?php else: ?>
                                <a href="#" class="dot-dot"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
                                <a href="#" class="ia-pagination"    data-limit="<?=$totalPages?>"><?=$totalPages?></a>
                            <?php break; endif; ?>
                        <?php endfor; ?>
						<!--
						<a href="#" class="active">1</a>
						<a href="#" class="dot-dot"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
						-->

						<a href="#" class="next-arrow"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
					</div>
				</div>
				<!-- End Filter Bar -->
				<!-- Start Best Seller -->
				<section class="lattest-product-area pb-40 category-list">
					<div class="row" id="showPrdoucts">
						<!-- single product -->
                        <?php foreach ($allShoes as $s): ?>
						<div class="col-lg-4 col-md-6">
							<div class="single-product">
								<img class="img-fluid" src="<?=$productImagePath.$s->main_img?>" alt="<?= $s->name ?>"/>
								<div class="product-details">
									<h6><?= $s->name ?></h6>
									<div class="price">


                                        <h6>$ <?= $s->newPrice ?></h6>
										<h6 class="l-through"><?= $s->oldPrice != "" ? "$ ".$s->oldPrice : "" ?></h6>
									</div>
									<div class="prd-bottom">
										<a href="" class="social-info">
											<span class="ti-bag ia-addBag"
                                                  data-user="<?=$userRegistered?>"
                                                  data-productid="<?=$s->product_id?>"
                                            ></span>
											<p class="hover-text">add to bag</p>
										</a>
										<a  href="index.php?page=singleProduct&id=<?=$s->product_id?>" class="social-info">
											<span class="lnr lnr-move"></span>
											<p class="hover-text">view more</p>
										</a>
									</div>
								</div>
							</div>
						</div>
                        <?php endforeach; ?>

					</div>
				</section>
				<!-- End Best Seller -->
				<!-- Start Filter Bar -->
				<div class="filter-bar d-flex flex-wrap justify-content-end align-items-center mb-5">
                    <div class="pagination" id="paginationBottom">
                        <a href="#" class="prev-arrow"><i class="fa fa-long-arrow-left" aria-hidden="true"></i></a>
                        <?php
                        for($i = 0 ; $i<$totalPages;$i++):
                            if($i < 3):
                                ?>
                                <a href="#"
                                   class="ia-pagination
                               <?php if($i==0) echo 'active';?>"
                                   data-limit="<?=$i?>"><?=$i+1?>
                                </a>

                            <?php else: ?>
                                <a href="#" class="dot-dot"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
                                <a href="#" class="ia-pagination"    data-limit="<?=$totalPages?>"><?=$totalPages?></a>
                                <?php break; endif; ?>
                        <?php endfor; ?>
                        <!--
                        <a href="#" class="active">1</a>
                        <a href="#" class="dot-dot"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></a>
                        -->

                        <a href="#" class="next-arrow"><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
                    </div>
				</div>
				<!-- End Filter Bar -->
			</div>

		</div>

	</div>
<input type="hidden" id="userID" value="<?= $userID ?>">
<input type="hidden" id="userRegistered" value="<?= $userRegistered ?>">

<div class="alert alert-success position-absolute " id="addToCartMsg"></div>
<div id="modalCart" class="modal" tabindex="-1">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark">Message</h5>
            </div>
            <div class="modal-body">
                <p class="text-dark h3 alert alert-success" id="cartMsg"></p>
            </div>

        </div>
    </div>
</div>
<div id="showModal"></div>
