
<?php
    $fullName = "";
    $email = "";
    $userRegistered = false;
    $userID = null;
    if(isset($_GET["id"])){
        global $conn;
        $productId = $_GET["id"];
        $product = selectProductSingle($productId);
        $price = selectAllPrices($productId);
        $newPrice = $price[0]->price;
        $oldPrice = "";
        if(isset($price[1]->price)){
            $oldPrice = $price[1]->price;
        }

        if(isset($_SESSION["user"])){
            $fullName = $_SESSION["user"]->name . " " . $_SESSION["user"]->last_name;
            $email = $_SESSION["user"]->email;
            $userRegistered = true;
            $userID = $_SESSION["user"]->user_id;
        }

        $addWhere = "WHERE product_id = $productId";
        $reviews = selectAll("rating",$addWhere);
        $comments = selectAll("comment",$addWhere . " AND answer_id IS NULL ORDER BY date DESC");
        if($reviews){
            $query = "SELECT COUNT(*) as totalReviews,SUM(rating) as sum FROM rating WHERE product_id = $productId";
            $select = $conn->query($query);
            $result = $select->fetch();

            $sum = (int)$result->sum;
            $totalReviews = $result->totalReviews;

            $total5 = getNumberOfStars(5,$productId);
            $total4 = getNumberOfStars(4,$productId);
            $total3 = getNumberOfStars(3,$productId);
            $total2 = getNumberOfStars(2,$productId);
            $total1 = getNumberOfStars(1,$productId);

            $allReviews = selectAll("rating",$addWhere . " ORDER BY date DESC");

        }

    }
    else {
        //404
        redirect("index.php");
    }




?>
	<!-- Start Banner Area -->
	<section class="banner-area organic-breadcrumb">
		<div class="container">
			<div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
				<div class="col-first">
					<h1>Product Details Page</h1>
					<nav class="d-flex align-items-center">
						<a href="index.php?page=home">Home<span class="lnr lnr-arrow-right"></span></a>
						<a href="index.php?page=shop">Shop<span class="lnr lnr-arrow-right"></span></a>
						<p>Product-Details</p>
					</nav>
				</div>
			</div>
		</div>
	</section>
	<!-- End Banner Area -->

	<!--================Single Product Area =================-->
	<div class="product_image_area">
		<div class="container">
			<div class="row s_product_inner">
				<div class="col-lg-6">
					<div>
						<div>
							<img class="img-fluid" src="assets/img/product/<?=$product->main_img?>" alt="<?= $product->name ?>"/>
						</div>
					</div>
				</div>
				<div class="col-lg-5 offset-lg-1">
					<div class="s_product_text">
						<h3><?= $product->name ?></h3>
						<div class="d-flex">
                            <h2>$<?= $newPrice ?></h2>
                            <h6 class="l-through ml-3"><?= $oldPrice != "" ? "$ ".$oldPrice : "" ?></h6>
                        </div>
						<ul class="list">
							<li><span>Category</span> : <?= $product->category ?></li>
							<li><span>Availibility</span> : In Stock</li>
						</ul>
						<p><?= $product->description ?></p>
						<div class="product_count">
							<label for="qty">Quantity:</label>
							<input type="text" name="qty" id="sst" maxlength="12"
                                   value="1" title="Quantity:" class="input-text qty">
							<button class="increase items-count ia-increase" type="button">
                                <i class="lnr lnr-chevron-up"></i>
                            </button>
							<button class="reduced items-count ia-reduced" type="button">
                                <i class="lnr lnr-chevron-down"></i>
                            </button>
						</div>
						<div class="card_area d-flex align-items-center">
							<a class="primary-btn addToCart" href="#">Add to Cart</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--================End Single Product Area =================-->

	<!--================Product Description Area =================-->
	<section class="product_description_area">
		<div class="container">
			<ul class="nav nav-tabs" id="myTab" role="tablist">
				<li class="nav-item">
					<a class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Description</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact"
					 aria-selected="false">Comments</a>
				</li>
				<li class="nav-item">
					<a class="nav-link active" id="review-tab" data-toggle="tab" href="#review" role="tab" aria-controls="review"
					 aria-selected="false">Reviews</a>
				</li>
			</ul>
			<div class="tab-content" id="myTabContent">
				<div class="tab-pane fade" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <p><?php
                        $desc = "";
                        strlen($product->description) > 100 ? $desc = substr($product->description,99) : $desc = $product->description;
                        echo $desc;
                        ?>
                    </p>
				</div>

                <!--region Comments-->

				<div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
					<div class="row">
						<div class="col-lg-6">
							<div class="comment_list" id="commentList">
                                <?php if($comments){

                                    printComments($comments,$userID);
                                }

                                ?>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="review_box">
								<h4>Post a comment</h4>
								<form class="row contact_form" novalidate="novalidate">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input  disabled="disabled"
                                                    class="form-control"
                                                    id="commentFullName"
                                                    value="<?=$fullName?>"
                                                    name="commentFullName"
                                                    placeholder="Full name"/>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input
                                                    disabled="disabled"
                                                    class="form-control"
                                                    id="commentEmail"
                                                    value="<?=$email?>"
                                                    name="commentEmail"
                                                    placeholder="Email Address" />
                                        </div>
                                    </div>
									<div class="col-md-12">
										<div class="form-group">
											<textarea class="form-control" name="comment" id="comment" rows="1" placeholder="Message"></textarea>
                                            <span class="alert alert-danger error">Incorrect comment!</span>


										</div>

									</div>

                                    <div class="col-md-12 text-center">
                                        <?php if(!isset($_SESSION["user"])): ?>
                                            <p class="text-warning">Registered users only</p>
                                        <?php endif; ?>
                                    </div>
									<div class="col-md-12 text-right">
										<p id="btnComment" class="btn primary-btn">Submit Now</p>

									</div>
								</form>

							</div>
                            <p class="alert alert-danger error" id="commentError"></p>
                            <p class="alert alert-success error" id="successComment"></p>
						</div>

					</div>

				</div>

                <!-- endregion -->
				<div class="tab-pane fade show active" id="review" role="tabpanel" aria-labelledby="review-tab">

					<div class="row">
                        <!-- region Reviews-->

						<div class="col-lg-6">
                            <?php if(count($reviews)): ?>
							<div class="row total_rate">

								<div class="col-6">
									<div class="box_total">
										<h5>Overall</h5>
										<h4>
                                            <?php
                                            $overall = $sum / $totalReviews;
                                            echo round($overall,1);

                                            ?>

                                        </h4>
										<h6>(<?= $totalReviews ?> Reviews)</h6>
									</div>
								</div>
								<div class="col-6">
									<div class="rating_list">
										<h3>Based on <?= $totalReviews ?> Reviews</h3>
										<ul class="list">
											<li>
                                                <?php
                                                printStar(5,$total5);
                                                printStar(4,$total4);
                                                printStar(3,$total3);
                                                printStar(2,$total2);
                                                printStar(1,$total1);
                                                ?>

										</ul>
									</div>
								</div>


							</div>

                                <div class="review_list">
                                    <?php printReview($allReviews); ?>
                                </div>
                            <?php else:  ?>
                                <p class="alert primaryBackground text-center text-light h5 w-75 mx-auto">Currently no reviews</p>

                            <?php endif; ?>


						</div>
						<div class="col-lg-6">
							<div class="review_box">
								<h4>Add a Review</h4>
								<p>Your Rating:</p>
								<ul class="list" id="reviewList">
									<li><a href="#" class="reviewStars" id="1"><i class="fa fa-star"></i></a></li>
									<li><a href="#" class="reviewStars" id="2"><i class="fa fa-star"></i></a></li>
									<li><a href="#" class="reviewStars" id="3"><i class="fa fa-star"></i></a></li>
									<li><a href="#" class="reviewStars" id="4"><i class="fa fa-star"></i></a></li>
									<li><a href="#" class="reviewStars" id="5"><i class="fa fa-star"></i></a></li>
								</ul>
								<p>Outstanding</p>
								<form class="row contact_form" id="contactForm" novalidate="novalidate">
									<div class="col-md-12">
										<div class="form-group">
                                            <input  disabled="disabled"
                                                    class="form-control"
                                                    id="reviewFullName"
                                                    value="<?=$fullName?>"
                                                    name="reviewFullName"
                                                    placeholder="Full name"/>
                                        </div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<input
                                                    disabled="disabled"
                                                    class="form-control"
                                                    id="reviewEmail"
                                                    value="<?=$email?>"
                                                    name="reviewEmail"
                                                    placeholder="Email Address" />
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<textarea class="form-control" name="reviewMessage" id="reviewMessage" rows="1" placeholder="Review" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Review'"></textarea></textarea>
										    <span class="alert alert-danger error">Incorrect message!</span>

                                        </div>
									</div>
                                    <div class="col-md-12 text-center">
                                        <?php if(!isset($_SESSION["user"])): ?>
                                        <p class="text-warning">Registered users only</p>
                                        <?php endif; ?>
                                    </div>
									<div class="col-md-12 text-right">

										<p class="primary-btn" id="submitReview">Submit Now</p>
                                        <input type="hidden" id="userRegistered" value="<?= $userRegistered ?>">
                                        <input type="hidden" id="userID" value="<?= $userID ?>">
                                        <input type="hidden" id="productID" value="<?= $_GET["id"] ?>">
									</div>
								</form>
							</div>
                            <p class="alert alert-danger error" id="reviewError"></p>
                            <p class="alert alert-success error" id="success"></p>
						</div>
                        <!-- endregion -->
					</div>
				</div>

			</div>
		</div>
	</section>

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
	<!--================End Product Description Area =================-->
