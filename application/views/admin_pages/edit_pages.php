<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Edit <?= $page['page_name']; ?> Page</h2>
        <?= $this->breadcrumbs->show(); ?>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-title">
                <h5>Fill all required Fields</h5>
                <div class="ibox-tools">
                    <a class="collapse-link">
                        <i class="fa fa-chevron-up"></i>
                    </a>
                </div>
            </div>
            <?= form_open_multipart("Admin_Pages/edit_pages/".$page['id'], '', array('class' => 'wizard-big', 'role' => 'form'));?>
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
                            <input type="hidden" id="page_id" name="page_id" value="<?= $page['id']; ?>">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Title </label>
                                    <input id="title" name="title" placeholder="Title" value="<?= $page['title']; ?>" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Description<span style="color: red">*</span></label>
                                    <div class="ibox-content no-padding">
                                        <textarea  name = "desc" required="required" class="editor required">
                                            <?= $page['description']; ?>
                                        </textarea >
                                        <span style="color: red"><?= form_error('desc'); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="ibox-title pb30">
                    <div class="form-group">
                        <div class="col-sm-12 text-right">
                            <button class="btn btn-primary" type="submit">Update Page</button>
                        </div>
                    </div>
                </div>
            <?= form_close();?>
        </div>
    </div>
</div>