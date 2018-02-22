<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8">
        <h2>All Faq's</h2>
        <?= $this->breadcrumbs->show(); ?>
    </div>
    <div class="col-lg-4 p20 text-right">
        <a class="custom-btn btn-primary dim" href="<?= site_url('Admin_Pages/add_faq'); ?>" data-toggle="tooltip" data-placement="top">
            Add Faq's
        </a>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
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

                    <div class="table-responsive">
                        <table id="dataTable" class="table table-striped table-bordered table-hover dataTables-example" >
                            <thead>
                                <tr>
                                    <th>Question</th>
                                    <th>Answer</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach($faqs as $faq)
                            {
                                ?>
                                <tr class="gradeX">
                                    <td class="center"><?= $question = preg_replace('/\s+?(\S+)?$/', '', substr($faq['question'], 0, 40)); ?>....</td>
                                    <td class="center"><?= $answer = preg_replace('/\s+?(\S+)?$/', '', substr($faq['answer'], 0, 40)); ?> ...</td>
                                    <td class="center">
                                        <a class="custom-btn btn-primary dim" href="<?= site_url(); ?>Admin_Pages/edit_faq/<?= $faq['id'];?>" data-toggle="tooltip" title="Edit" data-placement="top">
                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                        </a>
                                        <a class="custom-btn btn-danger dim disable_user" data-id='<?= $faq['id']; ?>' title="Delete Faq"
                                            data-toggle="faq_delete_confirmation" data-singleton="true" data-placement="top" data-popout="true" data-btn-ok-label="Yes" data-btn-ok-icon="fa fa-check" data-btn-ok-class="custom-btn btn-success dim disable_user confrm" data-btn-cancel-label="No" data-btn-cancel-icon="fa fa-times" data-btn-cancel-class="custom-btn btn-warning dim disable_user confrm">

                                            <i class="fa fa-ban" aria-hidden="true"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>