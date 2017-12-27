<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>				
				
<div class="content-push">

<div class="breadcrumb-box">
	<a href="#">Home</a>
	<a href="#">Registration Form</a>
</div>

<div class="information-blocks">
	<div class="row">
		<div class="col-sm-12 information-entry">
			<div class="login-box" style="min-height:570px;">
				<div class="article-container style-1">
					<h3><?= lang('create_user_heading');?></h3>
					<p><?= lang('create_user_subheading');?></p>
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
				<?= form_open("auth/create_user", '', array('class' => 'm-t', 'role' => 'form'));?>
					<div class="col-sm-6 pt10">
						<?= lang('create_user_fname_label', 'first_name');?>
						<?= form_input($first_name, '', array('class' => 'simple-field', 'placeholder' => 'First Name'));?>
						<span style="color:red;"><?= form_error('first_name'); ?></span>
					</div>
					<div class="col-sm-6 pt10">
						<?= lang('create_user_lname_label', 'last_name');?>
						<?= form_input($last_name, '', array('class' => 'simple-field', 'placeholder' => 'Last Name'));?>
						<span style="color:red;"><?= form_error('last_name'); ?></span>
					</div>
					<div class="col-sm-6 pt10">
						<label>Gender</label>
						<?php
							$options = array(
								'' => 'Gender',
								'Male' => 'Male',
								'Female' => 'Female',
							);
						?>
						<?= form_dropdown($gender, $options, "", array('class' => 'simple-field')); ?>
						<span style="color:red;"><?= form_error('gender'); ?></span>
					</div>
					<div class="col-sm-6 pt10">
						<label>Date of Birth</label>
						<?= form_input($dob, '', array('class' => 'simple-field datepicker', 'id' => '', 'placeholder' => 'Date of Birth'));?>
						<span style="color:red;"><?= form_error('dob'); ?></span>
					</div>
					<div class="col-sm-6 pt10">
						<?= lang('create_user_phone_label', 'phone');?>
						<?= form_input($phone, '', array('class' => 'simple-field', 'placeholder' => 'Phone'));?>
						<span style="color:red;"><?= form_error('phone'); ?></span>
					</div>
					<?php
						 if($identity_column!=='email') 
						 {
							 echo '<p>';
							 echo lang('create_user_identity_label', 'identity');
							 echo '<br />';
							 echo form_error('identity');
							 echo form_input($identity);
							 echo '</p>';
						 }
					 ?>
					<div class="col-sm-6 pt10">
						<?= lang('create_user_email_label', 'email');?>				
						<?= form_input($email, '', array('class' => 'simple-field', 'placeholder' => 'Email'));?>
						<span style="color:red;"><?= form_error('email'); ?></span>
					</div>
					<div class="col-sm-6 pt10">
						<?= lang('create_user_password_label', 'password');?>
						<?= form_input($password, 'password', array('class' => 'simple-field', 'placeholder' => '******', 'required' => 'required')); ?>
						<span style="color:red;"><?= form_error('password'); ?></span>
					</div>
					<div class="col-sm-6 pt10">
						<?= lang('create_user_password_confirm_label', 'password_confirm');?>
						<?= form_password($password_confirm, 'password_confirm', array('class' => 'simple-field', 'placeholder' => '******')); ?>
						<span style="color:red;"><?= form_error('password'); ?></span>
					</div>
					<div class="col-lg-12 col-md-12 col-sm-12 pt10">
						<?= form_submit('submit', 'Register Account', array('class' => 'button style-10 btn btn-block'));?>
					</div>
				<?= form_close();?>
				<div class="col-lg-12 col-md-12 col-sm-12 pt20 text-center">
					Alredy have an account ? 
					<a class="forgot_password" href="<?= site_url('auth/login'); ?>">Login</a>
				</div>
			</div>
		</div>
	</div>
</div>   
<hr>