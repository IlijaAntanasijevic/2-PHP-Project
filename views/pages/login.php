<?php
#password: adminTest1
#username: ilija0125

#password: testTest1

?>
	<!-- Start Banner Area -->
	<section class="banner-area organic-breadcrumb">
		<div class="container">
			<div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
				<div class="col-first">
					<h1>Login/Register</h1>
					<nav class="d-flex align-items-center">
						<a href="index.php">Home<span class="lnr lnr-arrow-right"></span></a>
						<p>Login/Register</p>
					</nav>
				</div>
			</div>
		</div>
	</section>
	<!-- End Banner Area -->

	<!--================Login Box Area =================-->
	<section class="login_box_area section_gap">
        <?php
        if(isset($_GET["register"])):
        ?>
        <div class="row">
            <div class="col-6 mx-auto mb-5 text-center h4">
                <p class="alert alert-success">You have successfully registered, please login</p>
            </div>
        </div>
        <?php endif; ?>
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<div class="login_box_img">
						<img class="img-fluid" src="assets/img/login.jpg" alt="loginImage"/>
						<div class="hover">
							<h4>New to our website?</h4>
							<p>There are advances being made in science and technology every day, and a good example of this is the</p>
							<a class="primary-btn" href="index.php?page=registration">Create an Account</a>
						</div>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="login_form_inner">
						<h3>Log in to enter</h3>
						<form class="row login_form" id="contactForm" novalidate="novalidate">
							<div class="col-md-12 form-group">
								<input type="text" class="form-control" id="loginUsername" name="loginUsername"  placeholder="Username" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Username'">
							    <p class="alert alert-danger error"></p>
                            </div>
							<div class="col-md-12 form-group">
								<input type="password" class="form-control" id="loginPassword" name="loginPassword" placeholder="Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'">
                                <p class="alert alert-danger error"></p>

							</div>
							<div class="col-md-12 form-group mt-5">
								<p class="primary-btn" id="btnLogin">Log In</p>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--================End Login Box Area =================-->