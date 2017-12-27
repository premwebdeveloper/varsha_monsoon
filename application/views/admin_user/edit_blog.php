<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Edit Blog</h2>
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
            <?= form_open_multipart("Admin/edit_blog", '', array('class' => 'wizard-big', 'role' => 'form'));?>
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
                            <input type="hidden" id="blog_id" name="blog_id" value="<?= $blog['id']; ?>">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Title *</label>
                                    <input id="title" name="title" placeholder="Title" value="<?= $blog['title']; ?>" type="text" required="required" class="form-control required">
                                    <span class="red"><?= form_error('title'); ?></span>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Category *</label>
                                    <input id="category" name="category" value="<?= $blog['category']; ?>" placeholder="Category" type="text" required="required" class="form-control required">
                                    <span class="red"><?= form_error('category'); ?></span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Blog Image *</label>
                                    <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                        <div class="form-control" data-trigger="fileinput">
                                            <i class="glyphicon glyphicon-file fileinput-exists"></i>
                                            <span class="fileinput-filename"><?= $blog['image']; ?></span>
                                        </div>
                                        <span class="input-group-addon btn btn-default btn-file">
                                            <span class="fileinput-new">Select file</span>
                                            <span class="fileinput-exists">Change</span>
                                            <input type="file" id="image" name="image">
                                        </span>
                                        <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                                    </div>
                                    <span class="red"><?= form_error('image'); ?></span>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Description *</label>
                                    <?= form_textarea('desc', set_value('desc', $blog['description']), array('class' => 'form-control required', 'style' => 'height:106px;', 'required'=> "required", 'placeholder' => 'Description'));?>
                                    <span class="red"><?= form_error('desc'); ?></span>
                                </div>
                            </div>
                            <div class="col-lg-6 pt25">
                                <div class="form-group">
                                    <img style="height: 100px; width: 200px;" alt="" src="<?= base_url();?>uploads/blog/<?= $blog['image'] ;?>">
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="ibox-title pb30">
                    <div class="form-group">
                        <div class="col-sm-12 text-right">
                            <button class="btn btn-primary" type="submit">Update Blog</button>
                        </div>
                    </div>
                </div>
            <?= form_close();?>
        </div>
    </div>
</div>