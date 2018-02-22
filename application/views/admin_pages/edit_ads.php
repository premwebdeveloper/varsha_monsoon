<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Edit Ads</h2>
        <?= $this->breadcrumbs->show(); ?>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-title">
                <h5>Fill all required Fields</h5>
            </div>
            <?= form_open_multipart("Admin_Pages/edit_ads", '', array('class' => 'wizard-big', 'role' => 'form'));?>
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
                    <input type="hidden" name="id" value="<?= $ads['id']; ?>">
                    <input type="hidden" name="slider_image" value="<?= $ads['image']; ?>">
                    <fieldset>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Title <span class="red">*</span></label>
                                    <input id="title" name="title" value="<?= $ads['title']; ?>" placeholder="Title" type="text" class="form-control required" required="required">
                                    <span class="red"><?= form_error('title'); ?></span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Price(₹)</label>
                                    <input id="price" name="price" value="<?= $ads['price']; ?>" placeholder="Price" type="number" class="form-control required" required="required">
                                    <span class="red"><?= form_error('price'); ?></span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Ads/Offer Image </label>
                                    <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                        <div class="form-control" data-trigger="fileinput">
                                            <i class="glyphicon glyphicon-file fileinput-exists"></i>
                                            <span class="fileinput-filename"><?= $ads['image']; ?></span>
                                        </div>
                                        <span class="input-group-addon btn btn-default btn-file">
                                            <span class="fileinput-new">Select Image</span>
                                            <span class="fileinput-exists">Change</span>
                                            <input type="file" id="image" name="image">
                                        </span>
                                        <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                    </div>
                                    <span>* (Max Upload Size Allowed 2 MB | File Types Allowed JPG, PNG, JPEG, BMP).</span>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea id="description" placeholder="Description" style="height: 106px;" name="description"  class="form-control"><?= $ads['description']; ?></textarea>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <img style="height: 150px; width: 250px; border: 1px solid" src="<?= base_url(); ?>/frontend_assets/img/<?= $ads['image']; ?>">
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="ibox-title pb30">
                    <div class="form-group">
                        <div class="col-sm-12 text-right">
                            <button class="btn btn-primary" type="submit">Update Ads</button>
                        </div>
                    </div>
                </div>
            <?= form_close();?>
        </div>
    </div>
</div>