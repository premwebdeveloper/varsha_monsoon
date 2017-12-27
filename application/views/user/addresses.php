<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	$this->load->view('templates/_parts/public_master_user_profile_sidebar_view');
?>
        <div class="col-sm-9">
            <div ng-app="addressApp" ng-controller="addressController">

                <div class="row pb10">
                     <div class="col-md-12 p20 pb20 style_border text_bold">
                        <a href="javascript:;" ng-click="addNewAddress()"><i class="fa fa-plus" aria-hidden="true"></i> ADD NEW ADDRESS</a>
                    </div>
                </div>

                <div class="row pb10">
                    <div class="col-md-12 style_border pb10">

                        <div class="col-md-12 pt10">
                            <div class="article-container style-1 well">
                                <h3>Add New Address</h3>
                            </div>
                        </div>

                        <?= form_open("addresses/add_new_address", '', array('class' => 'm-t', 'role' => 'form'));?>

                            <div class="col-sm-6 pt10">
                                <label>Date of Birth</label>
                                <?= form_input('name', '', array('class' => 'simple-field', 'placeholder' => 'Name'));?>
                                <span style="color:red;"><?= form_error('name'); ?></span>
                            </div>

                            <div class="col-sm-6 pt10">
                                <label>Mobile</label>
                                <?= form_input('mobile', '', array('class' => 'simple-field', 'placeholder' => 'Mobile'));?>
                                <span style="color:red;"><?= form_error('mobile'); ?></span>
                            </div>

                            <div class="col-sm-6 pt10">
                                <label>Address</label>
                                <?= form_input('address', '', array('class' => 'simple-field datepicker', 'id' => 'dob', 'placeholder' => 'Address'));?>
                                <span style="color:red;"><?= form_error('address'); ?></span>
                            </div>

                            <div class="col-sm-6 pt10">
                                <label>City</label>
                                <?= form_input('city', '', array('class' => 'simple-field', 'placeholder' => 'City'));?>
                                <span style="color:red;"><?= form_error('city'); ?></span>
                            </div>

                            <div class="col-sm-6 pt10">
                                <label>State</label>
                                <?= form_input('state', '', array('class' => 'simple-field', 'placeholder' => 'State'));?>
                                <span style="color:red;"><?= form_error('state'); ?></span>
                            </div>

                            <div class="col-sm-6 pt10">
                                <label>Country</label>
                                <?= form_input('country', '', array('class' => 'simple-field', 'placeholder' => 'Country')); ?>
                                <span style="color:red;"><?= form_error('password'); ?></span>
                            </div>

                            <div class="col-sm-6 pt10">
                                <label>Zip Code</label>
                                <?= form_password('zip', '', array('class' => 'simple-field', 'placeholder' => 'Zip Code')); ?>
                                <span style="color:red;"><?= form_error('zip'); ?></span>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-12 pt10">
                                <?= form_submit('submit', 'Add Address', array('class' => 'button style-10 btn btn-block '));?>
                            </div>

                        <?= form_close();?>

                    </div>
                </div>

                <div class="row">
        			<div class="col-md-12 style_border">

                        <div class="col-sm-11 pt20 text_bold">
                            <h4><?= $user_data['fname']."".$user_data['lname']; ?></h4>
                        </div>

                        <div class="col-sm-1 text-right">
                            <div class="header-top-entry">
                                <i class="fa fa-caret-down  fa-2x"></i>
                                <div class="list">
                                        <a class="list-entry" href="http://[::1]/food_management/trunk/user/profile">Set as Default </a>
                                        <a class="list-entry" href="http://[::1]/food_management/trunk/user/orders">Edit</a>
                                        <a class="list-entry" href="http://[::1]/food_management/trunk/Food_Listings/listing">Delete</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

    		</div><!-- end section col-md-9 -->
        </div>

	</div>
</div>