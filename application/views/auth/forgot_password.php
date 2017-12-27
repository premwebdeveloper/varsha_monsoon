<div class="content-push">
<?= $this->breadcrumbs->show(); ?>

<div class="information-blocks">
	<div class="row">
		<div class="col-sm-12 information-entry">
			<div class="login-box" style="min-height:350px;">

				<div class="article-container style-1 text-center">
					<h3><?= lang('forgot_password_heading');?></h3>
					<p><?= lang(('forgot_password_subheading'), $identity_label);?></p>
				</div>

				<?php
				if(isset($message))
				{
					?>
					<div class="col-lg-offset-3 col-lg-6 col-md-offset-3 col-md-6 col-sm-offset-3 col-sm-6 p0 pb10">
						<div class="message-box message-info">
			                <div class="message-icon"><i class="fa fa-exclamation"></i></div>
			                <div class="message-text" id="infoMessage"><b><p><?= $message;?></p></b></div>
			                <div class="message-close"><i class="fa fa-times"></i></div>
			            </div>
					</div>
					<?php
				}
				?>

				<?= form_open("auth/forgot_password", '', array('class' => 'm-t', 'role' => 'form'));?>

					<div class="col-sm-offset-3 col-sm-6 p0">
						<label for="identity">
							<?= (($type=='email') ? sprintf(lang('forgot_password_email_label'), $identity_label) : sprintf(lang('forgot_password_identity_label'), $identity_label));?>

								<p>&nbsp;</p>

							<?= form_input($identity, '', array('class' => 'simple-field','required' => 'required', 'placeholder' => 'Enter Email'));?>
						</label>
					</div>

					<div class="col-sm-offset-3 col-sm-6 pt20 p0">
						<?= form_submit('submit', lang('forgot_password_submit_btn'), array('class' => 'button style-12'));?>
					</div>

				<?= form_close();?>

			</div>
		</div>
	</div>
</div>
<hr>