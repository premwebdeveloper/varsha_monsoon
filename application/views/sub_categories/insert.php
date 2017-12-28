<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Add Sub Category</h2>
        <?= $this->breadcrumbs->show(); ?>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-title">
                <h5>Fill all reuired Fields</h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                </div>
            </div>
            <?= form_open_multipart("Sub_Categories/add_sub_category", '', array('class' => 'wizard-big', 'role' => 'form'));?>
                <div class="ibox-content">
                    <fieldset>
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="form-group">
                                    <label>Category</label>

                                    <select class="form-control m-b" id="category" name="category" required="required">
                                        <option value="">Select Category</option>
                                        <?php
                                        foreach($categories as $cat)
                                        {
                                            ?>
                                            <option value="<?= $cat['id']; ?>"><?= $cat['category']; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>

                                    <span class="red"><?= form_error('category'); ?></span>
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="form-group">
                                    <label>Sub Category Name *</label>
                                    <input id="name" name="name" type="text" required="required" class="form-control required">
                                    <span class="red"><?= form_error('name'); ?></span>
                                </div>
                            </div>
                            <div class="col-lg-2 text-left">
                                <div class="form-group">
                                    <label>&nbsp;</label>
                                    <div class="col-sm-12 text-right">
                                        <button class="btn btn-primary" type="submit">Add Sub Category</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </div>
            <?= form_close();?>
        </div>
    </div>
</div>