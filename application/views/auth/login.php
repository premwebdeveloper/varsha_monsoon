<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="content-push">
<?= $this->breadcrumbs->show(); ?>
<div class="information-blocks">
	<div class="row">
		<div class="col-sm-6 information-entry">
			<div class="login-box" style="min-height: 480px;">
				<div class="article-container style-1">
					<h3><?= lang('login_heading');?></h3>
					<p><?= lang('login_subheading');?></p>
				</div>

				<div class="col-lg-12 col-md-12 col-sm-12">
					<?php
					if(isset($message))
					{
						?>
						<div class="message-box message-info">
		                    <div class="message-icon"><i class="fa fa-exclamation"></i></div>
		                    <div class="message-text" id="infoMessage"><b><?= $message;?></b></div>
		                    <div class="message-close"><i class="fa fa-times"></i></div>
		                </div>
						<?php
					}
					?>
				</div>

				<?= form_open("auth/login", '', array('class' => 'm-t', 'role' => 'form'));?>
					<div class="col-sm-12">
						<label><?= lang('login_identity_label');?></label>
						<?= form_input($identity, 'identity', array('class' => 'simple-field', 'placeholder' => 'Enter Email Address', 'required' => 'required'));?>
					</div>
					<div class="col-sm-12 pt10">
						<label><?= lang('login_password_label'); ?></label>
						<?= form_input($password, 'password', array('class' => 'simple-field', 'placeholder' => '******', 'required' => 'required')); ?>
					</div>
					<div class="col-sm-12 pt10">
						<?= lang('login_remember_label', 'remember');?>
						<?= form_checkbox('remember', '1', FALSE, 'id="remember"');?>
					</div>
					<div class="col-sm-12 pt10">
						<?= form_submit('submit', 'Login', array('class' => 'button style-10 btn-block'));?>
					</div>

				<?= form_close();?>

				<div class="col-sm-12 pt20 text-center">
					<a href="forgot_password"><?= lang('login_forgot_password');?></a>
				</div>

			</div>

		</div>
		<div class="col-sm-6 information-entry">
			<div class="login-box">
				<div class="article-container style-1">
					<h3>New Customers</h3>
					<p>By creating an account with our store, you will be able to move through the checkout process faster, store multiple shipping addresses, view and track your orders in your account and more.</p>
				</div>
				<a class="button style-10" href="<?= site_url('auth/create_user'); ?>">Register Account</a>
			</div>
		</div>
	</div>
</div>

<hr>