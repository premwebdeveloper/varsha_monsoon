				<div class="footer">
                    <div class="pull-right">
                        &nbsp;
                    </div>
                    <div>
                        <strong><?= $copyright; ?></strong>
                    </div>
                </div>
            </div>
        </div>

        </div>

    </div>

<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header btn-primary">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Change Password</h4>
        </div>
        <div class="modal-body">
          <fieldset id="form-p-0" role="tabpanel" aria-labelledby="form-h-0" class="body current" aria-hidden="false">
                <h2>Change Password</h2>
                <div class="alert alert-danger alert-dismissable" id="all_field_required" style="display:none">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                </div>
                <div class="row">
                    <?= form_open('', array('id' => 'change_pass_form')); ?>
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label>Old Password *</label>
                                <?= form_password('old_password', '', array('class' => 'form-control', 'id' => 'old_password', 'placeholder' => 'Old Password')); ?>
                            </div>
                            <div class="form-group">
                                <label>New Password *</label>
                                <?= form_password('new_password', '', array('class' => 'form-control', 'id' => 'new_password', 'disabled' => 'disabled', 'placeholder' => 'New Password')); ?>
                            </div>
                            <div class="form-group">
                                <label>Confirm Password *</label>
                                <?= form_password('c_password', '', array('class' => 'form-control', 'id' => 'confirm_password', 'disabled' => 'disabled', 'placeholder' => 'Confirm Password')); ?>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="text-center">
                                <div style="margin-top: 20px">
                                    <i class="fa fa-undo fa-stack-3x"  style="font-size: 180px;color: #e5e5e5"></i>
                                    <i class="fa fa-lock fa-stack-1x"  style="font-size: 65px;color: #e5e5e5; padding-top:44px;"></i>
                                </div>
                            </div>
                        </div>
                    <?= form_close(); ?>
                </div>

            </fieldset>
        </div>
        <div class="modal-footer ">
            <?php
                $submit_btn = array(
                    'name' => 'update_password',
                    'id' => 'update_password',
                    //'value' => 'true',
                    'type' => 'button',
                    'class'=> 'btn btn-primary text-left dim',
                    'content' => 'Update Password'
                );
                echo form_button($submit_btn);
            ?>
          <button type="button" class="btn btn-primary dim" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
</div>