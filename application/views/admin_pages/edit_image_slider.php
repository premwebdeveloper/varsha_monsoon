<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Edit Slider Iamge</h2>
        <?= $this->breadcrumbs->show(); ?>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-title">
                <h5>Fill all required Fields</h5>
            </div>
            <?= form_open_multipart("Admin_Pages/edit_slider_image", '', array('class' => 'wizard-big', 'role' => 'form'));?>
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
                    <input type="hidden" name="id" value="<?= $slider_image['id']; ?>">
                    <input type="hidden" name="slider_image" value="<?= $slider_image['image']; ?>">
                    <fieldset>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Title </label>
                                    <input id="title" name="title" value="<?= $slider_image['title']; ?>" placeholder="Title" type="text" class="form-control">
                                    <span class="red"><?= form_error('title'); ?></span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Slider Image <span style="color: red">*</span></label>
                                    <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                        <div class="form-control" data-trigger="fileinput">
                                            <i class="glyphicon glyphicon-file fileinput-exists"></i>
                                            <span class="fileinput-filename"></span>
                                        </div>
                                        <span class="input-group-addon btn btn-default btn-file">
                                            <span class="fileinput-new">Select Image</span>
                                            <span class="fileinput-exists">Change</span>
                                            <input type="file" id="image" name="image">
                                        </span>
                                        <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                    </div>
                                    <span>* (Max Upload Size Allowed 6 MB | File Types Allowed JPG, PNG, JPEG, BMP).</span>
                                    <span class="red"><?= form_error('image'); ?></span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea id="desc" placeholder="Description" style="height: 106px;" name="desc"  class="form-control"><?= $slider_image['description']; ?></textarea>
                                    <span class="red"><?= form_error('desc'); ?></span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <img style="height: 150px; width: 250px;" src="<?= base_url(); ?>/frontend_assets/img/<?= $slider_image['image']; ?>">
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="ibox-title pb30">
                    <div class="form-group">
                        <div class="col-sm-12 text-right">
                            <button class="btn btn-primary" type="submit">Update Slider Image</button>
                        </div>
                    </div>
                </div>
            <?= form_close();?>
        </div>
    </div>
</div>