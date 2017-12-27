<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="information-blocks">
	<div class="row">
		<div class="col-sm-9 col-sm-push-3">
			<div class="detail-info-lines border-box">
				<div class="share-box">
					<div class="title"><h3><b><i class="fa fa-user fa-2x" aria-hidden="true"></i> &nbsp;&nbsp;&nbsp; Personal Details :</b></h3></div>
				</div>
			</div>
			<div class="detail-info-lines border-box">
				<div class="share-box">
					<div class="title"><b>Full Name : </b> <?= $user_data['fname']." ".$user_data['lname']; ?></div>
				</div>
				<div class="share-box">
					<div class="title"><b>Date of Birth : </b> <?= $user_data['dob']; ?></div>
				</div>
				<div class="share-box">
					<div class="title"><b>Gender : </b> <?= $user_data['gender']; ?></div>
				</div>
				<div class="share-box">
					<div class="title"><b>About Yourself : </b> <?= $user_data['bio']; ?></div>
				</div>
			</div>
			
			<div class="detail-info-lines border-box">
				<div class="share-box">
					<div class="title"><h3><b><i class="fa fa-phone fa-2x" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Contact Details :</b></h3></div>
				</div>
			</div>
			<div class="detail-info-lines border-box">
				<div class="share-box">
					<div class="title"><b>Alternate Number : </b> <?= $user_data['phone']; ?></div>
				</div>
				<div class="share-box">
					<div class="title"><b>Your Email : </b> <?= $user_data['email']; ?></div>
				</div>
				<div class="share-box text-right">
					<a href="#">Deactivate Account</a>
				</div>
			</div>
		</div>
		<div class="col-sm-3 col-sm-pull-9 blog-sidebar">
			<div class="information-blocks">
				<div class="categories-list account-links">
					<div class="information-blocks">
						<h6>Hello,</h6>
						<h3 class="block-title"><?= $_SESSION['user_full_name']; ?></h3>
						<div class="text-widget text-center" style="max-height:95px;">
							<img style="max-height:120px; max-width:120px;" alt="" src="<?= site_url(); ?>uploads\users\<?= $user_data['image']; ?>" class="image">	
							<div class="clear"></div>
						</div>
					</div>
					<ul>
						<li><a href="#"><i class="fa fa-user" aria-hidden="true"></i> &nbsp;&nbsp;&nbsp;Account Setting</a></li>
						<li><a href="#"><i class="fa fa-book" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp; My Order </a></li>
						<li><a href="#"><i class="fa fa-address-book" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp; Address Book</a></li>
						<li><a href="#"><i class="fa fa-credit-card" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp; Payments</a></li>
						<li><a href="#">Order History</a></li>
						<li><a href="#">My Wishlist</a></li>
						<li><a href="#">My Reviews</a></li>
						<li><a href="#">My Tags</a></li>
					</ul>
				</div>
				<div class="article-container">
					<br/>Custom CMS block displayed below the one page account panel block. Put your own content here.
				</div>
			</div>
		</div>
	</div>
</div>