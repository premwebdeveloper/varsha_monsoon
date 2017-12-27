<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="content-push">

<div class="breadcrumb-box">
	<a href="#">Home</a>
	<a href="#">Change Password</a>
</div>

<div class="information-blocks">
	<div class="row">
		<div class="col-sm-12 information-entry">
			<div class="login-box" style="min-height: 420px;">
				<div class="article-container style-1 text-center">
					<h1><?php echo lang('reset_password_heading');?></h1>
				</div>

				<div class="col-lg-offset-3 col-lg-6 col-md-offset-3 col-md-6 col-sm-offset-3 col-sm-6">
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

				<?= form_open('auth/reset_password/' . $code, '', array('class' => 'm-t', 'role' => 'form'));?>

					<div class="col-sm-offset-3 col-sm-6">
						<label for="new_password"">
							<?= sprintf(lang('reset_password_new_password_label'), $min_password_length);?>
						</label>
						<?= form_input($new_password, '', array('class' => 'simple-field', 'placeholder' => 'New Password'));?>
					</div>

					<div class="col-sm-offset-3 col-sm-6 pt10">
						<label for="new_password">
							<?= lang('reset_password_new_password_confirm_label', 'new_password_confirm');?>
						</label>
						<?= form_input($new_password_confirm, '', array('class' => 'simple-field', 'placeholder' => 'Confirm Password'));?>
					</div>

					<?php echo form_input($user_id);?>
					<?php echo form_hidden($csrf); ?>

					<div class="col-sm-offset-3 col-sm-6 pt10">
						<?= form_submit('submit', lang('reset_password_submit_btn'), array('class' => 'button style-10 btn-block'));?>
					</div>

				<?= form_close();?>

			</div>

		</div>
	</div>
</div>

<hr>