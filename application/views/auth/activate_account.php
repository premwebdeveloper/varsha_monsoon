<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="content-push">

<div class="breadcrumb-box">
    <a href="#">Home</a>
    <a href="#">Activate Account</a>
</div>

<div class="information-blocks">
    <div class="row">
        <div class="col-sm-12 information-entry">
            <div class="login-box" style="min-height: 420px;">
                <div class="article-container style-1 text-center">
                    <h1>Activate Account</h1>
                </div>

                <div class="col-lg-offset-3 col-lg-6 col-md-offset-3 col-md-6 col-sm-offset-3 col-sm-6">
                    <?php
                    if($this->session->flashdata('message'))
                    {
                        ?>
                        <div class="message-box message-info">
                            <div class="message-icon"><i class="fa fa-exclamation"></i></div>
                            <div class="message-text" id="infoMessage"><b><?= $this->session->flashdata('message'); ?></b></div>
                            <div class="message-close"><i class="fa fa-times"></i></div>
                        </div>
                        <?php
                    }
                    ?>
                </div>

                <?= form_open('auth/activate_account/', '', array('class' => 'm-t', 'role' => 'form'));?>

                    <div class="col-sm-offset-3 col-sm-6">
                        <?= form_label('Registered Email', 'email'); ?>
                        <?= form_input('registered_email', '', array('required' => 'required', 'class' => 'simple-field', 'placeholder' => 'Registered Email Address'));?>

                        <?php
                        if(!empty(form_error('registered_email')))
                        {
                            ?>
                            <div class="col-md-12 alert alert-warning"><?= form_error('registered_email'); ?></div>
                            <?php
                        }
                        ?>

                    </div>

                    <?php echo form_hidden($csrf); ?>

                    <div class="col-sm-offset-3 col-sm-6 pt10">
                        <?= form_submit('submit', 'Submit', array('class' => 'button style-10 btn-block'));?>
                    </div>

                <?= form_close();?>

            </div>
        </div>
    </div>
</div>

<hr>