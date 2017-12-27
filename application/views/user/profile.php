<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	$this->load->view('templates/_parts/public_master_user_profile_sidebar_view');
?>
		<div class="col-sm-9">
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
                        <i class="fa fa-times"></i>
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
            <?= $this->breadcrumbs->show(); ?>
			<div class="detail-info-lines border-box">
				<div class="share-box">
					<div class="title col-md-6">
						<h3>
							<b>
								<i class="fa fa-user fa-2x" aria-hidden="true"></i> &nbsp;&nbsp;&nbsp; Personal Details :
							</b>
						</h3>
					</div>
					<div class="text-right title pt10 col-md-6">
							<a href="javascript:;" id="profile_edit">Edit Profile</a>
					</div>
				</div>
			</div>
			<div class="detail-info-lines border-box">
				<?= form_open("user/profile", '', array('class' => 'm-t', 'id' => 'edit_form', 'role' => 'form')); ?>
					<div class="share-box">
						<div class="title">
							<label id="name"><b>Full Name : </b> <?= $user_data['fname']." ".$user_data['lname']; ?></label>
						</div>
						<div class="col-md-6" id="edit_fname" style="display:none">
							<label><b><span style="color:red;">*</span>Frist Name : </b></label>
							<?= form_input($fname, set_value('fname', $user_data['fname']), array('class' => 'simple-field size-1 required', 'placeholder' => 'First Name', 'required' => 'required')); ?>
						</div>
						<div class="col-md-6" id="edit_lname" style="display:none">
							<label><b><span style="color:red;">*</span>Last Name: </b></label>
							<?= form_input($lname, set_value('lname', $user_data['lname']),  array('class' => 'simple-field size-1 required', 'placeholder' => 'Last Name', 'required' => 'required' )); ?>
							<span style="color:red;"><?= form_error('last_name'); ?></span>
						</div>
					</div>
					<div class="share-box">
						<div class="title">
							<label id="dob"><b>Date of Birth : </b> <?= convert_date_format($user_data['dob']); ?></label>
						</div>
						<div class="col-md-6"  id="edit_dob" style="display:none">
							<label  class="required">
								<b><span style="color:red;">*</span>Date of Birth : </b>
								<?= form_input($dob, $user_data['dob'], array('class' => 'simple-field size-1  datepicker required', 'required' => 'required')); ?>
							</label>
						</div>
					</div>
					<div class="share-box">
						<div class="title">
							<label id="gender"><b>Gender : </b> <?= $user_data['gender']; ?></label>
						</div>
						<div class="col-md-6" id="edit_gender" style="display:none">
							<label class="required"><b><span style="color:red;">*</span>Gender :</b></label>
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
								<input class="simple-field size-1" name="bio" id="bio" placeholder="About Yourself" value="<?= $user_data['bio']; ?>" type="text">
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
				<?= form_close(); ?>
			</div>
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

					<div class="message-box message-success" id="msg_box" style="display: none;">
                        <div class="message-icon"><i class="fa fa-check"></i></div>
                        <div class="message-text" id="message"></div>
                        <div class="message-close"><i class="fa fa-times"></i></div>
                    </div>

                    <div class="text-right title pt10 p0 col-md-12">
						<a href="javascript:;" class="change_password" id="change_password">Change Password</a>
					</div>

					<!-- Update email address -->
					<div id="App1" ng-app="emailapp" ng-controller="emailcontroller">

						<div class="row">
							<!-- Change email form -->
							<form novalidate name="changeEmail" id="changeEmail">

								<!-- Update email address -->
								<div class="pt10" ng-show="old_email">
									<div class="col-md-10 col-xs-10" id="email_add">
										<label><b>Email Id: </b> <?= $user_data['email']; ?></label>
									</div>

									<div class="col-md-2 text-right col-xs-2 pt10">
										<a href="javascript:;" ng-click='email_edit()'>
											Edit
										</a>
									</div>
								</div>

								<div class="col-md-12" ng-show="hasError">
									<div class="col-md-12 alert alert-warning p10">
										{{ errorMessage }}
									</div>
								</div>

								<div class="row col-md-12 pr0 pt10" ng-show="new_email">
									<div class="col-md-6 pb10" id="email_id">

										<input type="email" ng-pattern="/^[a-z]+[a-z0-9._]+@[a-z]+\.[a-z.]{2,5}$/" required ng-model="email_address" class="simple-field size-1 required" ng-readonly="expression" placeholder="New Email Address">

									</div>

									<div class="col-md-4" ng-show="buttonVisible">
										<?= form_submit('submit', 'Update', array('class' => 'button style-10 btn btn-block', 'ng-disabled' => 'changeEmail.$invalid', 'ng-click' => 'updateEmail()'));?>
									</div>

									<div class="col-md-2 pr0 text-right pt10 text_right" ng-show="buttonVisible">
										<a href="javascript:;" ng-click='cancel_edit()'> Cancel </a>
									</div>
								</div>

							</form>

						</div>

						<!-- Fill OTP and password during change email address -->
						<div class="row pt10" ng-show="IsVisible">

							<!-- Validate otp for change email -->
							<form  novalidate name="validOTP" id="validOTP">
								<div class="title col-md-5" id="email_otp">
									<input type="text" placeholder="Enter 6 Digit OTP" ng-minlength="6" ng-maxlength="6" id="otp_email" ng-model="otp" required class="simple-field size-1 required" value="">
								</div>

								<div class="col-md-3">
									<?= form_submit('submit', 'Verify Email',array('class' =>
									'button style-10 btn btn-block', 'ng-disabled' => 'validOTP.$invalid', 'ng-click' => 'validateOTP()'));?>
								</div>

								<div class="col-md-3 text-right pt10">
									<a href="javascript:;" ng-click='resend_edit_email_otp()' class="">
										Resend OTP
									</a>
								</div>

								<div class="col-md-1 text-right pt10">
									<a href="javascript:;" ng-click='cancel_edit()' class="">
										Cancel
									</a>
								</div>

							</form>

						</div>

					</div>
					<!-- Update email address -->

				</div>

				<!-- Change mobile number -->
				<div class="share-box">

					<div class="row">

						<!-- Show error during update mobile number -->
						<div class="col-md-12">
							<div class="col-md-12 alert alert-warning display_none"
								id="mobile_update_errors">
							</div>
						</div>

						<!-- Show current mobile number -->
						<div class="col-md-10 pt10" id="phone">
							<b>Mobile Number : </b><?= $user_data['phone']; ?>
						</div>

						<!-- Show input box for submit new mobile number which will be updated -->
						<div class="col-md-6 pt10" id="p_no" style="display:none;">

							<input type="number" id="input_no" class="simple-field size-1 required" minlength="10" maxlength="10" required value="<?= $user_data['phone']; ?>" placeholder="New Mobile Number">

						</div>

						<!-- submit button -->
						<div class="col-md-4 pt10" id="edit_phone" style="display:none;">
							<?= form_submit('submit', 'Update', array('id' => 'update_phone', 'class' => 'button style-10 btn btn-block'));?>
						</div>

						<div class="col-md-2 text-right pt10" id="update_cancel_phone">
							<a href="javascript:;" id="phone_edit">Edit</a>
							<a href="javascript:;" style="display: none;" id="cancel_phone">Cancel</a>
						</div>

					</div>

					<!-- Verify mobile number with high secuirity OTP number -->
					<div class="row display_none" id="verify_section">

						<div class="col-md-4 pt10">
							<input type="text" placeholder="Enter OTP" id="otp" class="simple-field size-1 required" minlength="6" maxlength="6" required="required">
						</div>

						<div class="col-md-4 pt10 text-right">
							<?= form_submit('submit', 'Verify Mobile No.', array('id' => 'verify_phone', 'class' => 'button style-10 btn btn-block'));?>
						</div>

						<!-- Resend OTP Link -->
						<div class="col-md-3 text-right pt20">
							<a href="javascript:;" id="resend_mobile_otp">
								Resend OTP
							</a>
						</div>

						<div class="col-md-1 pt20 text-right">
							<a href="javascript:;" id="cancel_phone">Cancel</a>
						</div>

					</div>

				</div>

				<!-- Deactivate account -->
				<div id="App2" ng-app="deactivateapp" ng-controller="deactivatecontroller">
					<div class="share-box">

						<!-- Account deactivate botton -->
						<div class="col-md-12 p0 pt10 text-right" ng-show="deactiveAccButton">
							<a href="javascript:;" ng-click='deactivate_account()'>
								Deactivate Account
							</a>
						</div>

						<!-- Show messages -->
						<div class="col-md-12 p0" ng-show="deactiveAccError">
							<div class="alert alert-success">
								{{ errorMessage }}
							</div>
						</div>

						<!-- OTP and password box section -->
						<div class="row col-md-12 p0 pt10" ng-show="deactivate_otp_password">

							<form novalidate name="deactivate_acc_form" id="deactivate_acc_form">

								<div class="col-md-3">
									<input type="text" placeholder="Enter OTP" ng-minlength="6" ng-maxlength="6" ng-model="deactive_otp" required class="simple-field size-1 required">
								</div>

								<div class="col-md-3">
									<input type="password" placeholder="Enter Password" ng-minlength="8" ng-model="deactive_pass" required class="simple-field size-1 required">
								</div>

								<div class="col-md-4">
									<?= form_submit('submit', 'Confirm',array('class' =>
									'button style-10 btn btn-block', 'ng-disabled' => 'deactivate_acc_form.$invalid', 'ng-click' => 'confirmDeactiveAccount()'));?>
								</div>

								<div class="col-md-1 p0 pt10 text-right">
									<a href="javascript:;" ng-click='resend_deactive_otp()'>
										Resend
									</a>
								</div>

								<div class="col-md-1 p0 pt10 text-right">
									<a href="javascript:;" ng-click='cancel_deactive_account()'>
										Cancel
									</a>
								</div>

							</form>
						</div>

					</div>
				</div>
				<!-- Change Password pop up -->
				<div id="product-popup" class="modal fade" role="dialog">
				  <div class="modal-dialog modal-md">

				    <!-- Modal content-->
				    <div class="modal-content">
				      <div class="modal-header custom_modal_header">
				        <button type="button" class="close" data-dismiss="modal">&times;</button>
				        <h4 class="modal-title">Change Password</h4>
				      </div>
				      <div class="modal-body">
			            <div class="table-view">
			                <div class="cell-view">
			                    <div class="close-layer"></div>
			                    <div class="popup-container">
			                        <div class="row">
			                            <div class="col-sm-6 information-entry">
			                                <div class="product-preview-box">
			                                    <div class="product-title col-md-12 col-xs-6 pt68">
			                                        <i class="fa fa-refresh fa-stack-2x fa-spin" style="font-size: 80px; color: gray;"></i>
			                                        <i class="fa fa-lock fa-stack-1x" style="padding-top: 28px;font-size: 24px; color: gray;"></i>
			                                        <div style="padding-top: 100px;"></div>
			                                    </div>
			                                     <div class="product-title col-md-12 col-xs-6 t_space">
			                                        <ol>
			                                            <li>Your password has to be at least 8 characters long.</li>
			                                            <li>Spaces are not allowed at the beginning and end of passwords.</li>
			                                            <li>Your password has to be at least 8 characters long.</li>
			                                        </ol>
			                                    </div>
			                                </div>
			                            </div>
			                            <div class="col-sm-6 information-entry">
			                                <div class="product-detail-box col-xs-12 text-center pt10">
			                                    <h1 class="product-title"></h1>
			                                </div>
			                                <div class="col-md-12" style="display: none;" id="error_message"></div>
			                                <div class="product-detail-box col-xs-12 text-center">
			                                    <input type="password" placeholder="Old Password*" id="old_pass" class="simple-field size-1 required" required value="">
			                                    <input type="password" min = "8" max = "8" placeholder="New Password*" id="new_pass" class="simple-field size-1 required" required value=""  disabled>
			                                    <input type="password" required placeholder="Confirm New Password*" min = "8" max = "8" id="confirm_pass" class="simple-field size-1 required" value=""  disabled>
			                                    <a class="simple-field btn button custom_modal_header" id="chenge_user_password">Change Password</a>
			                                </div>
			                            </div>
			                        </div>
			                    </div>
			                </div>
			            </div>
				      </div>
				    </div>

				  </div>
				</div>
			</div>
		</div>
	</div>
</div>