<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Edit Category</h2>
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
            <?= form_open_multipart("Admin/edit_food_category", '', array('class' => 'wizard-big', 'role' => 'form'));?>
                <div class="ibox-content">
                    <?php   # If the session message is set then print message
                    if(!is_null($this->session->flashdata('message')))
                    {
                        ?>
                        <div class="alert alert-info alert-dismissable">
                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                            <?= $this->session->flashdata('message'); ?>
                        </div>
                        <?php
                    }
                    ?>
                    <fieldset>
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Type *</label>
                                    <?php
                                        $options = array(
                                            '' => 'Select Type',
                                            1 => 'Veg',
                                            2 => 'Non Veg',
                                        );
                                    ?>
                                    <?= form_dropdown('type', $options, $food_category['food_type'], array('class'=> 'form-control')); ?>
                                    <span class="red"><?= form_error('type'); ?></span>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <input type="hidden" id="food_category_id" name="food_category_id" value="<?= $food_category['id']; ?>">
                                <div class="form-group">
                                    <label>Category*</label>
                                    <input id="category" value="<?= $food_category['food_category']; ?>" name="category" type="text" required="required" class="form-control required">
                                    <span class="red"><?= form_error('category'); ?></span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Food Type Image *</label>
                                    <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                        <div class="form-control" data-trigger="fileinput">
                                            <i class="glyphicon glyphicon-file fileinput-exists"></i>
                                            <span class="fileinput-filename">
                                                <?= $food_category['image']; ?>
                                            </span>
                                        </div>
                                        <span class="input-group-addon btn btn-default btn-file">
                                            <span class="fileinput-new">Select file</span>
                                            <span class="fileinput-exists">Change</span>
                                            <input type="file" id="image" value="<?= $food_category['image']; ?>" name="image">
                                        </span>
                                        <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                    </div>
                                    <span class="red"><?= form_error('image'); ?></span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Description *</label>
                                    <?= form_textarea('desc', set_value('desc', $food_category['description']), array('class' => 'form-control required', 'style' => 'height:106px;', 'required'=> "required", 'placeholder' => 'Description'));?>
                                    <span class="red"><?= form_error('desc'); ?></span>
                                </div>
                            </div>
                            <div class="col-lg-6 p20">
                                <img style="height: 100px; width: 100px;" alt="" src="<?= base_url();?>uploads/food_category/<?= $food_category['image'] ;?>">
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="ibox-title pb30">
                    <div class="form-group">
                        <div class="col-sm-12 text-right">
                            <button class="btn btn-primary" type="submit">Update Food Type</button>
                        </div>
                    </div>
                </div>
            <?= form_close();?>
        </div>
    </div>
</div>