<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Edit Faq</h2>
        <?= $this->breadcrumbs->show(); ?>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="ibox">
            <div class="ibox-title">
                <h5>Fill all required Fields</h5>
            </div>
            <?= form_open_multipart("Admin_Pages/edit_faq", '', array('class' => 'wizard-big', 'role' => 'form'));?>
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
                    <input type="hidden" name="id" value="<?= $faq['id']; ?>">
                    <fieldset>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Question<span class="red">*</span></label>
                                    <input id="question" name="question" required="required" value="<?= $faq['question']; ?>" placeholder="Question" type="text" class="form-control required">
                                    <span class="red"><?= form_error('question'); ?></span>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Answer<span class="red">*</span></label>
                                    <textarea id="answer" placeholder="Answer" required="required" style="height: 106px;" name="answer"  class="form-control required"><?= $faq['answer']; ?></textarea>
                                    <span class="red"><?= form_error('desc'); ?></span>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="ibox-title pb30">
                    <div class="form-group">
                        <div class="col-sm-12 text-right">
                            <button class="btn btn-primary" type="submit">Update Faq</button>
                        </div>
                    </div>
                </div>
            <?= form_close();?>
        </div>
    </div>
</div>