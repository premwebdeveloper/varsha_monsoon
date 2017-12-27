<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	$this->load->view('templates/_parts/public_master_user_profile_sidebar_view');
?>
		<div class="col-sm-9">
			<?= $this->breadcrumbs->show(); ?>
			<?php
			if(isset($_SESSION['success']))
            {
                ?>
                <div class="message-box message-success">
                    <div class="message-icon">
                        <i class="fa fa-check"></i>
                    </div>
                    <div class="message-text">
                        <b><?= $_SESSION['success']; ?></b>
                    </div>
                    <div class="message-close">
                        <i class="fa fa-times"></i>
                    </div>
                </div>

                <?php
            }
            if(isset($_SESSION['error']))
            {
                ?>
                <div class="message-box message-danger">
                    <div class="message-icon">
                        <i class="fa fa-check"></i>
                    </div>
                    <div class="message-text">
                        <b><?= $_SESSION['error']; ?></b>
                    </div>
                    <div class="message-close">
                        <i class="fa fa-times"></i>
                    </div>
                </div>

                <?php
                unset($_SESSION['error']);
            }
            ?>
			<div class="detail-info-lines border-box">
				<div class="share-box">
					<div class="title">
						<h3><b><i class="fa fa-user fa-2x" aria-hidden="true"></i> &nbsp;&nbsp;&nbsp; Personal Details :</b>
						</h3>
					</div>
					<div class="text-right pt10">
							<a href="javascript:;" id="profile_edit">Edit Profile</a>
					</div>
				</div>
			</div>
			<div class="detail-info-lines border-box">
				<?= form_open("user/edit_user", '', array('class' => 'm-t', 'id' => 'edit_form', 'role' => 'form')); ?>
					<div class="share-box">
						<div class="title">
							<label id="name"><b>Full Name : </b> <?= $user_data['fname']." ".$user_data['lname']; ?></label>
						</div>
						<div class="col-md-6" id="edit_fname" style="display:none">
							<label><b>Frist Name : </b></label>
							<?= form_input($fname, $user_data['fname'], array('class' => 'simple-field size-1 required', 'placeholder' => 'First Name', 'required' => 'required')); ?>
						</div>
						<div class="col-md-6" id="edit_lname" style="display:none">
							<label><b>Last Name: </b></label>
							<?= form_input($lname, $user_data['lname'], array('class' => 'simple-field size-1 required', 'placeholder' => 'Last Name', 'required' => 'required' )); ?>
							<span style="color:red;"><?= form_error('last_name'); ?></span>
						</div>
					</div>
					<div class="share-box">
						<div class="title">
							<label id="dob"><b>Date of Birth : </b> <?= $user_data['dob']; ?></label>
						</div>
						<div class="col-md-6"  id="edit_dob" style="display:none">
							<label  class="required">
								<b>Date of Birth : </b>
								<?= form_input($dob, $user_data['dob'], array('class' => 'simple-field size-1  datepicker required', 'required' => 'required')); ?>
							</label>
						</div>
					</div>
					<div class="share-box">
						<div class="title">
							<label id="gender"><b>Gender : </b> <?= $user_data['gender']; ?></label>
						</div>
						<div class="col-md-6" id="edit_gender" style="display:none">
							<label class="required"><b>Gender :</b></label>
							<?php
								$options = array(
									'' => 'Gender',
									'Male' => 'Male',
									'Female' => 'Female',
								);
							?>
							<?= form_dropdown($gender, $options, $user_data['gender'], array('class' => 'simple-field size-1 required', 'required' => 'required')); ?>
						</div>
					</div>
					<div class="share-box">
						<div class="title">
							<label id="bio"><b>About Yourself : </b> <?= $user_data['bio']; ?></label>
						</div>
						<div class="col-md-6"  id="edit_bio" style="display:none">
							<label>
								<b>About Yourself</b>
								<input class="simple-field size-1" placeholder="About Yourself" value="<?= $user_data['bio']; ?>" type="text">
							</label>
						</div>
						<div class="col-md-3" id="edit_btn" style="display:none">
							<label></label>
							<?= form_submit('submit', 'Update', array('class' => 'button style-10 btn btn-block'));?>
						</div>
						<div class="col-md-3"  id="cancel_bio" style="display:none">
							<label></label>
							<?= form_label('Cancel', 'cancel', array('id' => 'cancel', 'class' => 'button style-10 btn btn-block'));?>
						</div>
					</div>
				</div>
			<?= form_close();?>

			<div class="detail-info-lines border-box">
				<div class="share-box">
					<div class="title">
						<h3>
							<b><i class="fa fa-phone fa-2x" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Contact Details :</b>
						</h3>
					</div>
				</div>
			</div>
			<div class="detail-info-lines border-box">
				<div class="share-box">
					<div class="title">
						<label id="phone"><b>Alternate Number : </b> <?= $user_data['phone']; ?></label>
					</div>
				</div>
				<div class="share-box">
					<div class="title">
						<b>Your Email : </b> <?= $user_data['email']; ?>
					</div>
				</div>
				<div class="share-box text-right">
					<a href="javascript:;">Deactivate Account</a>
				</div>
			</div>
		</div>
	</div>
</div>
