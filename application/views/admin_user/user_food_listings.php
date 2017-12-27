<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8">

        <h2><?= $user['fname']." ".$user['lname'];?> - Products</h2>
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
                    <h5>All Products</h5>
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
                                    <th>Type</th>
                                    <th>Category</th>
                                    <th>Days Meal</th>
                                    <th>Name</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach($my_listings as $list)
                            {
                                ?>
                                <tr class="gradeX">
                                    <td><?php
                                        foreach ($type as $value)
                                        {
                                            if($list['food_type'] === $value['id'])
                                            {
                                                echo $value['type'];
                                            }
                                        }
                                        ?></td>
                                    <td>
                                        <?php
                                            if($list['food_category'] == 0)
                                            {
                                                echo $list['optional_category'];
                                            }
                                            else
                                            {
                                                foreach($category as $cate)
                                                {
                                                    if($list['food_category'] == $cate['id'])
                                                    {
                                                        echo $cate['food_category'];
                                                    }
                                                }
                                            }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                            if($list['breakfast_lunch_dinner'] == NULL || $list['breakfast_lunch_dinner'] == 0)
                                            {
                                                echo "-";
                                            }
                                            else
                                            {
                                                foreach($day_meals as $meals)
                                                {
                                                    if($list['breakfast_lunch_dinner'] == $meals['id'])
                                                    {
                                                        echo $meals['meal_name'];
                                                    }
                                                }
                                            }
                                        ?>
                                    </td>
                                    <td><?= $list['food_name']; ?></td>
                                    <td><?= convert_date_format($list['created_on']); ?></td>
                                    <td class="center">
                                        <a class="custom-btn btn-primary dim" href="<?= site_url('Food_Listings/view_listing/'.$list['id']); ?>" data-toggle="tooltip" title="View" data-placement="top">
                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                        </a>

                                        <a class="custom-btn btn-danger dim disable_user" data-id='<?= $list['id']; ?>' title="Delete Product"
                                            data-toggle="food_delete_confirmation" data-singleton="true" data-placement="top" data-popout="true" data-btn-ok-label="Yes" data-btn-ok-icon="fa fa-check" data-btn-ok-class="custom-btn btn-success dim disable_user confrm" data-btn-cancel-label="No" data-btn-cancel-icon="fa fa-times" data-btn-cancel-class="custom-btn btn-warning dim disable_user confrm">

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