<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<script type="text/javascript">
    $(document).ready(function(){
        $('[data-toggle="delete_sub_category"]').confirmation({

            onConfirm: function(){
                    var sub_category_id = $(this).attr('data-id');
                    window.location.href = "<?= base_url();?>Sub_Categories/deleteSubCategory/"+sub_category_id;
            }, // Set event when click at confirm button

            onCancel: function(){
                    var sub_category_id = $(this).attr('data-id');
            }
        });
    });
</script>

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8">
        <h2>Sub Categories</h2>
        <?= $this->breadcrumbs->show(); ?>
    </div>
    <div class="col-lg-4 text-right">
        <h2>
            <a class="custom-btn btn-primary dim" href="<?= base_url();?>Sub_Categories/add_sub_category">
                Add Sub Category
            </a>
        </h2>

    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">

                <div class="ibox-title">
                    <h5>All Sub Categories</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>

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
                        <table id="users_dataTable" class="table table-striped table-bordered table-hover dataTables-example" >
                            <thead>
                                <tr>
                                    <th>Category</th>
                                    <th>Sub Category</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach($sub_categories as $sub_cat)
                            {
                                ?>
                                <tr class="gradeX">
                                    <td><?= $sub_cat['category']; ?></td>
                                    <td><?= $sub_cat['sub_category']; ?></td>
                                    <td class="center">
                                        <a class="custom-btn btn-danger dim delete_sub_category" data-id='<?= $sub_cat['id']; ?>' title="Are You Sure ?"
                                            data-toggle="delete_sub_category" data-singleton="true" data-placement="top" data-popout="true" data-btn-ok-label="Yes" data-btn-ok-icon="fa fa-check" data-btn-ok-class="custom-btn btn-success dim delete_sub_category confrm" data-btn-cancel-label="No" data-btn-cancel-icon="fa fa-times" data-btn-cancel-class="custom-btn btn-warning dim delete_sub_category confrm">

                                            <i class="fa fa-times" aria-hidden="true"></i>
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