<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	$this->load->view('templates/_parts/public_master_user_profile_sidebar_view');
?>
        <div class="col-sm-9">
            <div ng-app="addressApp" ng-controller="addressController">

                <div class="row style_border p10 well" ng-click="addNewAddress()">
                    <a href="javascript:;">

                        <div class="col-md-6 text_bold p10">
                             <h3>ADD A NEW ADDRESS</h3>
                        </div>

                         <div class="col-md-6 text_bold text-right">
                            <i class="fa fa-caret-up fa-2x" aria-hidden="true" ng-show="caret_up"></i>
                            <i class="fa fa-caret-down fa-2x" aria-hidden="true" ng-show="caret_down"></i>
                        </div>

                    </a>
                </div>

                <div class="row pb10" ng-show="add_address_section">
                    <div class="col-md-12 style_border pb10 p0">

                        <div class="col-md-12 pt10 red">Please fill all required field with *</div>

                        <form novalidate method="post" name="add_new_address" id="add_new_address" class="m-t" ng-submit="addAddress()">

                            <div class="col-sm-6 pt10">
                                <label class="required-label">Name</label>
                                <?= form_input('name', '', array('class' => 'simple-field', 'id' => 'name', 'ng-model' => 'newAdd.name', 'required' => 'required', 'placeholder' => 'Name'));?>
                                <span style="color:red;"><?= form_error('name'); ?></span>
                            </div>

                            <div class="col-sm-6 pt10">
                                <label class="required-label">Mobile</label>
                                <?= form_input('mobile', '', array('class' => 'simple-field', 'ng-pattern' => '/^[7-9][0-9]{9}$/', 'id' => 'mobile', 'ng-model' => 'newAdd.mobile', 'required' => 'required', 'placeholder' => '10 digit valid mobile number'));?>
                                <span style="color:red;"><?= form_error('mobile'); ?></span>
                            </div>

                            <div class="col-sm-6 pt10">
                                <label class="required-label">Address</label>
                                <?= form_input('address', '', array('class' => 'simple-field', 'ng-model' => 'newAdd.address', 'required' => 'required', 'id' => 'address', 'placeholder' => 'Address'));?>
                                <span style="color:red;"><?= form_error('address'); ?></span>
                            </div>

                            <div class="col-sm-6 pt10">
                                <label class="required-label">City</label>
                                <?= form_input('city', '', array('class' => 'simple-field', 'ng-model' => 'newAdd.city', 'required' => 'required', 'id' => 'city', 'placeholder' => 'City'));?>
                                <span style="color:red;"><?= form_error('city'); ?></span>
                            </div>

                            <div class="col-sm-6 pt10">
                                <label class="required-label">State</label>
                                <?= form_input('state', '', array('class' => 'simple-field', 'ng-model' => 'newAdd.state', 'required' => 'required', 'id' => 'state', 'placeholder' => 'State'));?>
                                <span style="color:red;"><?= form_error('state'); ?></span>
                            </div>

                            <div class="col-sm-6 pt10">
                                <label class="required-label">Country</label>
                                <?= form_input('country', '', array('class' => 'simple-field', 'ng-model' => 'newAdd.country', 'required' => 'required', 'id' => 'country', 'placeholder' => 'Country')); ?>
                                <span style="color:red;"><?= form_error('country'); ?></span>
                            </div>

                            <div class="col-sm-6 pt10">
                                <label class="required-label">Zip Code</label>
                                <?= form_input('zip', '', array('class' => 'simple-field', 'ng-model' => 'newAdd.zip', 'required' => 'required', 'id' => 'zip', 'placeholder' => 'Zip Code')); ?>
                                <span style="color:red;"><?= form_error('zip'); ?></span>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-12 pt10">
                                <?= form_submit('submit', 'Add Address', array('class' => 'button style-10 btn btn-block', 'ng-disabled' => 'add_new_address.$invalid'));?>
                            </div>

                        </form>

                    </div>
                </div>

                <!-- Show all addrsses -->
                <div class="row" ng-show="show_address_section" id="allAddresses"">

                    <?php
                    if(!empty($this->session->flashdata('address_msg')))
                    {
                        ?>
                        <div class="col-md-12 p0 pb10">

                            <div class="message-box message-success">
                                <div class="message-icon"><i class="fa fa-check"></i></div>
                                <div class="message-text" id="infoMessage">
                                    <b> <?= $this->session->flashdata('address_msg'); ?> </b>
                                </div>
                                <div class="message-close"><i class="fa fa-times"></i></div>
                            </div>

                        </div>
                        <?php
                    }
                    ?>

                    <div class="col-md-12 p0 pb10" ng-show="add_address_message">
                        <div class="message-box message-success">
                            <div class="message-icon"><i class="fa fa-check"></i></div>
                            <div class="message-text" id="infoMessage">
                                {{ successMessage }}
                            </div>
                            <div class="message-close"><i class="fa fa-times"></i></div>
                        </div>
                    </div>

                    <?php
                    foreach($addresses as $address)
                    {
                        $default_address = $address['default_address'];
                        ?>
            			<div class="col-md-12 style_border p0 pt10 mb20 ?>">

                            <div class="col-sm-12 p10 single_address" ng-show="single_address" id="single_address_<?= $address['id']; ?>">

                                <div class="col-sm-11 col-xs-11" id="actual_address_<?= $address['id']; ?>">
                                    <p>
                                        <?= $address['name']; ?> ( <?= $address['mobile']; ?> )
                                        <?php
                                        if($default_address == 1)
                                        {
                                            ?>
                                            <label class="text_bold custom_label">Default</label>
                                            <?php
                                        }
                                        ?>
                                    </p>
                                    <p class="pt10">
                                        <?= $address['address'].', '.$address['city'].', '.$address['state'].', '.$address['country'].' - '.$address['zip']; ?>
                                    </p>
                                </div>

                                <div class="col-sm-1 col-xs-1 p0">
                                    <div class="header-top-entry p0">
                                        <i class="fa fa-caret-down fa-2x" style="position:relative;left:30px;"></i>
                                        <div class="list" style="left: -80px;top: 25px;">

                                            <?php
                                            if($default_address == 0)
                                            {
                                                ?>
                                                <a class="list-entry set_default_address" id="set_default_<?= $address['id']; ?>" href="javascript:;">
                                                    Set as Default
                                                </a>
                                                <?php
                                            }
                                            ?>

                                            <a class="list-entry update_address" id="update_address_<?= $address['id']; ?>" ng-click="update_address($event)" href="javascript:;">
                                                Update Address
                                            </a>

                                            <a class="list-entry delete_address" id="delete_address_<?= $address['id']; ?>" href="javascript:;">
                                                Delete Address
                                            </a>

                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-12 for_update_address" ng-show="for_update_address" id="for_update_address_<?= $address['id']; ?>"> </div>

                        </div>
                        <?php
                    }
                    ?>
                </div>
    		</div><!-- end section col-md-9 -->
        </div>
	</div>
</div>

<!-- Delete and set as default Address pop up -->
<div id="address_delete_pop_up" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header custom_modal_header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" id="modal_title">Address Remove</h4>
      </div>
      <div class="modal-body">
        <p id="delete_confirmation"></p>
      </div>
    </div>

  </div>
</div>