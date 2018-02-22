<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Add Brand</h2>
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
            <?= form_open_multipart("Brands/add_brand", '', array('class' => 'wizard-big', 'role' => 'form'));?>
                <div class="ibox-content">
                    <fieldset>
                        <div class="row">
                            <div class="col-lg-5">
                                <div class="form-group">
                                    <label>Brand Name *</label>
                                    <input id="name" name="name" type="text" required="required" class="form-control required">
                                    <span class="red"><?= form_error('name'); ?></span>
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="form-group">
                                    <label>Brand Image <span style="color: red">*</span></label>
                                    <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                        <div class="form-control" data-trigger="fileinput">
                                            <i class="glyphicon glyphicon-file fileinput-exists"></i>
                                            <span class="fileinput-filename"></span>
                                        </div>
                                        <span class="input-group-addon btn btn-default btn-file">
                                            <span class="fileinput-new">Select Image</span>
                                            <span class="fileinput-exists">Change</span>
                                            <input type="file" id="image" name="image" required="required">
                                        </span>
                                        <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                    </div>
                                    <span>* (Max Upload Size Allowed 4 MB | File Types Allowed JPG, PNG, JPEG, BMP).</span>
                                    <span class="red"><?= form_error('image'); ?></span>
                                </div>
                            </div>
                            <div class="col-lg-2 text-left">
                                <div class="form-group">
                                    <label>&nbsp;</label>
                                    <div class="col-sm-12 text-right">
                                        <button class="btn btn-primary" type="submit">Add Brand</button>
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