<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<script type="text/javascript">
    $(document).ready(function(){
        $('[data-toggle="slider_confirmation"]').confirmation({

            onConfirm: function(){
                    var slider_id = $(this).attr('data-id');
                    window.location.href = "<?= base_url();?>Admin_Pages/delete_slider_image/"+slider_id;
            }, // Set event when click at confirm button

            onCancel: function(){
                    var slider_id = $(this).attr('data-id');
            }
        });
    });
</script>

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8">
        <h2>All Orders</h2>
        <?= $this->breadcrumbs->show(); ?>
    </div>
    <!--<div class="col-lg-4 p20 text-right">
        <a class="custom-btn btn-primary dim" href="<?= site_url('Admin_Pages/add_slider_image'); ?>" data-toggle="tooltip" data-placement="top">
            Add Slider Image
        </a>
    </div>-->
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
                        <table id="users_dataTable" class="table table-striped table-bordered table-hover dataTables-example" >
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Sku Code</th>
                                    <th>Quantity</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach($orders as $order)
                            {
                                ?>
                                <tr class="gradeX">
                                    <td class="center"><?= $order['product_name']; ?></td>
                                    <td class="center"><?= $order['sku_code']; ?></td>
                                    <td class="center"><?= $order['quantity']; ?></td>
                                    <td class="center"><?= $order['name']; ?></td>
                                    <td class="center"><?= $order['email']; ?></td>
                                    <td class="center"><?= $order['phone']; ?></td>
                                    <td class="center"><?= $order['address'].', '.$order['city'].', '.$order['state'].', '.$order['country'].' - '.$order['zipcode']; ?></td>
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