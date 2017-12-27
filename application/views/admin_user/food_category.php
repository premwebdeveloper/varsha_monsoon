<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8">

        <h2>Food Categories</h2>
        <?= $this->breadcrumbs->show(); ?>
    </div>
    <div class="col-lg-4 p20 text-right">
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">

                <div class="ibox-title">
                    <h5>Foods Categories</h5>
                    <div class="ibox-tools pb10">
                        <a class="custom-btn btn-primary dim" href="<?= base_url('Admin/add_food_category'); ?>">
                            Add Food Category
                        </a>&nbsp;&nbsp;&nbsp;
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
                                    <th>Type</th>
                                    <th>Category</th>
                                    <th>Description</th>
                                    <th>Image</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach($food_category as $list)
                            {
                                ?>
                                <tr class="gradeX">
                                    <td><?php
                                        if($list['food_type'] == 1)
                                        {
                                            echo "Veg";
                                        }
                                        else
                                        {
                                            echo "Non Veg";
                                        }
                                        ?>
                                    </td>
                                    <td><?= $list['food_category']; ?></td>
                                    <td>
                                        <?php
                                            echo $string = preg_replace('/\s+?(\S+)?$/', '', substr($list['description'], 0, 60));
                                        ?>...
                                    </td>
                                    <td><img alt="image" style="height: 70px; width: 70px;" src="<?= base_url(); ?>uploads/food_category/<?= $list['image']; ?>"></td>
                                    <td><?= convert_date_format($list['created_on']); ?></td>
                                    <td class="center">
                                        <a class="custom-btn btn-primary dim" href="<?= site_url('Admin/edit_food_category/'.$list['id']); ?>" data-toggle="tooltip" title="Edit" data-placement="top">
                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                        </a>

                                        <a class="custom-btn btn-danger dim disable_user" data-id='<?= $list['id']; ?>' title="Delete"
                                            data-toggle="food_category_delete_confirmation" data-singleton="true" data-placement="top" data-popout="true" data-btn-ok-label="Yes" data-btn-ok-icon="fa fa-check" data-btn-ok-class="custom-btn btn-success dim disable_user confrm" data-btn-cancel-label="No" data-btn-cancel-icon="fa fa-times" data-btn-cancel-class="custom-btn btn-warning dim disable_user confrm">

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