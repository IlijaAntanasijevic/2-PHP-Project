<?php

    global $companyInfo;

?>

<!-- Start Banner Area -->
	<section class="banner-area organic-breadcrumb">
		<div class="container">
			<div class="breadcrumb-banner d-flex flex-wrap align-items-center justify-content-end">
				<div class="col-first">
					<h1>Contact Us</h1>
					<nav class="d-flex align-items-center">
						<a href="index.html">Home<span class="lnr lnr-arrow-right"></span></a>
						<a href="category.html">Contact</a>
					</nav>
				</div>
			</div>
		</div>
	</section>
	<!-- End Banner Area -->

	<!--================Contact Area =================-->
	<section class="contact_area section_gap_bottom">
		<div class="container">
			<div class="col-12">
                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d6558615.155923269!2d-109.38677811046794!3d36.615582137186124!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1ssr!2srs!4v1685291893924!5m2!1ssr!2srs"
                         height="250" style="border:0;" allowfullscreen=""
                        referrerpolicy="no-referrer-when-downgrade" class="w-100 my-5" ></iframe>
			</div>
			<div class="row">
				<div class="col-lg-3">
					<div class="contact_info">
						<div class="info_item">
							<i class="lnr lnr-home"></i>
							<h6><?=$companyInfo["city"]?></h6>
							<p><?=$companyInfo["address"]?></p>
						</div>
						<div class="info_item">
							<i class="lnr lnr-phone-handset"></i>
							<h6><a href="#" disabled><?=$companyInfo["phone"]?></a></h6>
							<p><?=$companyInfo["workTime"]?></p>
						</div>
						<div class="info_item">
							<i class="lnr lnr-envelope"></i>
							<h6><a href="#" disabled><?= $companyInfo["email"] ?></a></h6>
						</div>
					</div>
				</div>
				<div class="col-lg-9">
					<form class="row contact_form" id="contactForm">
						<div class="col-md-6">
							<div class="form-group">
								<input type="text" class="form-control" id="nameMessage" name="nameMessage" placeholder="Enter your name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your name'"/>
                                <p class="text-danger error text-center">Name is required</p>
							</div>
							<div class="form-group">
								<input type="email" class="form-control" id="emailMessage" name="emailMessage" placeholder="Enter email address" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter email address'"/>
                                <p class="text-danger error text-center"></p>
                            </div>
							<div class="form-group">
								<input type="text" class="form-control" id="subjectMessage" name="subjectMessage" placeholder="Enter Subject" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Subject'"/>
                                <p class="text-danger error text-center">Subject is required</p>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<textarea class="form-control" name="message" id="message" rows="1" placeholder="Enter Message" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Message'"></textarea>
                                <p class="text-danger error text-center">Message is required</p>
							</div>
						</div>
						<div class="col-md-12 text-right">
							<p class="primary-btn" id="btnSendMessage">Send Message</p>
                            <p class="alert alert-success text-center error " id="contactMsg">Message sent successfully!</p>
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>
	<!--================Contact Area =================-->

	<!-- start footer Area -->


    <!--================FOOTER JE BIO OVDE=================-->



	<!-- End footer Area -->

	<!--================Contact Success and Error message Area =================-->
	<div id="success" class="modal modal-message fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<i class="fa fa-close"></i>
					</button>
					<h2>Thank you</h2>
					<p>Your message is successfully sent...</p>
				</div>
			</div>
		</div>
	</div>

	<!-- Modals error -->

	<div id="error" class="modal modal-message fade" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<i class="fa fa-close"></i>
					</button>
					<h2>Sorry !</h2>
					<p> Something went wrong </p>
				</div>
			</div>
		</div>
	</div>
	<!--================End Contact Success and Error message Area =================-->


<!--================LINKOVI =================-->