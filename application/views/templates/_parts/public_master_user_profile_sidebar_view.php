<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="information-blocks">
	<div class="row">
		<div class="col-sm-3 blog-sidebar">
			<div class="information-blocks">
				<div class="categories-list account-links">
					<h6>Hello,</h6>
					<h3 class="block-title"><?= $user_data['fname'].' '.$user_data['lname']; ?></h3>
					<?php
					if($user_data['image'] == '')
					{
					?>
						<div class="text-center col-md-6" style="max-height:120px;">
							<img style="max-height:100px; min-height:100px; min-width:100px; max-width:100px; border-radius:50% ;" alt="" src="<?= site_url(); ?>uploads\users\profile.jpg" class="image">
						</div>
						<div class="text-widget text-center col-md-6" style="max-height:120px;">
							<?= form_open_multipart("user/change_profile", '', array('class' => 'pt10', 'role' => 'form'));?>
								<input class="filestyle " data-input="false" id="filestyle-0" name="update_image" style="position: absolute; clip: rect(0px, 0px, 0px, 0px);" tabindex="-1" type="file">
								<div class="bootstrap-filestyle pt20 pb10" style="display: inline-block;" tabindex="0">
									<label for="filestyle-0" class="btn btn-default">
										<i class="fa fa fa-user"></i> Upload
									</label>
								</div>
								<div class="bootstrap-filestyle " style="display: inline-block;" tabindex="0">
									<?= form_submit('submit', 'Change', array('class' => 'button style-10 btn btn-block'));?>
								</div>
							<?= form_close();?>
						</div>
					<?php
					}
					else
					{
					?>
						<div class="text-center col-md-6" style="max-height:150px;">
							<img style="max-height:100px; min-height:100px; min-width:100px; max-width:100px; border-radius:50% ;" alt="" src="<?= site_url(); ?>uploads\users\<?= $user_data['image']; ?>" class="image">
							<div class="clear"></div>
							<a class="" id="change_image">Change Profile</a>
						</div>
						<div class="text-widget text-center col-md-6" style="max-height:120px;">
							<div id='change_profile' style="display: none;">
								<?= form_open_multipart("user/change_profile", '', array('class' => 'pt10', 'role' => 'form'));?>
									<input class="filestyle " data-input="false" id="filestyle-0" name="update_image" style="position: absolute; clip: rect(0px, 0px, 0px, 0px);" tabindex="-1" type="file">
									<div class="bootstrap-filestyle pt20 pb10" style="display: inline-block;" tabindex="0">
										<label for="filestyle-0" class="btn btn-default">
											<i class="fa fa fa-user"></i> Upload
										</label>
									</div>
									<?= form_submit('submit', 'Change', array('class' => 'button style-10 btn btn-block'));?>
								<?= form_close();?>
							</div>
						</div>
					<?php
					}
					?>

					<div class="col-md-12 pt20" style="padding-left: 0px !important; padding-right: 0px !important;">
						<div class="sidebar-navigation active" style="border: 0px;">
		                   <div class="title">Account Details<i class="fa fa-angle-down"></i></div>
		                    <div class="list un_active">
		                    	<a href="<?= site_url('user/profile'); ?>" class="entry"><span><i class="fa fa-user" aria-hidden="true"></i> &nbsp;&nbsp;&nbsp;Profile Information</span></a>
		                    	<a href="<?= site_url('addresses'); ?>" class="entry"><span><i class="fa fa-map-marker" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp; Address Book</span></a>
		                    	<a href="<?= site_url('Food_Listings'); ?>" class="entry"><span><i class="fa fa-list" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp; My Listings </span></a>
		                    	<a href="<?= site_url('user/orders'); ?>" class="entry"><span><i class="fa fa-book" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp; My Order </span></a>
		                    	<a href="<?= site_url('user/wishlist'); ?>" class="entry"><span><i class="fa fa-heart-o"></i>&nbsp;&nbsp;&nbsp; My Wishlist</span></a>
		                        <a href="<?= site_url('user/reviews'); ?>" class="entry"><span><i class="fa fa-star-half-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp; My Reviews</span></a>
		                        <a href="<?= site_url('user/payments'); ?>" class="entry"><span><i class="fa fa-credit-card" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp; Payments</span></a>
		                    </div>
		                </div>
					</div>
				</div>
			</div>
		</div>