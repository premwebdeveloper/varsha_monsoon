<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<script type="text/javascript">
    $(document).ready(function(){
        $('[data-toggle="delete_product"]').confirmation({

            onConfirm: function(){
                    var product_id = $(this).attr('data-id');
                    window.location.href = "<?= base_url();?>Products/deleteProduct/"+product_id;
            }, // Set event when click at confirm button

            onCancel: function(){
                    var product_id = $(this).attr('data-id');
            }
        });
    });
</script>

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8">
        <h2>Products</h2>
        <?= $this->breadcrumbs->show(); ?>
    </div>
    <div class="col-lg-4 text-right">
        <h2>
            <a class="custom-btn btn-primary dim" href="<?= base_url();?>Products/add_product">
                Add Product
            </a>
        </h2>

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
                                    <th>Sku Code</th>
                                    <th>Product Name</th>
                                    <th>Brand</th>
                                    <th>Category</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach($products as $product)
                            {
                                ?>
                                <tr class="gradeX">
                                    <td><?= $product['sku_code']; ?></td>
                                    <td><?= $product['name']; ?></td>
                                    <td><?= $product['brand']; ?></td>
                                    <td><?= $product['category']; ?></td>
                                    <td class="center">

                                        <a href="<?= site_url('Products/view/'.$product['id']); ?>" class="custom-btn btn-success dim delete_product" data-toggle="tooltip" title="View" data-placement="top">
                                            <i class="fa fa-eye" aria-hidden="true"></i>
                                        </a>

                                        <a href="<?= site_url('Products/edit/'.$product['id']); ?>" class="custom-btn btn-warning dim delete_product" data-toggle="tooltip" title="Edit" data-placement="top">
                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                        </a>

                                        <a class="custom-btn btn-danger dim delete_product" data-id='<?= $product['id']; ?>' title="Are You Sure ?"
                                            data-toggle="delete_product" data-singleton="true" data-placement="top" data-popout="true" data-btn-ok-label="Yes" data-btn-ok-icon="fa fa-check" data-btn-ok-class="custom-btn btn-success dim delete_product confrm" data-btn-cancel-label="No" data-btn-cancel-icon="fa fa-times" data-btn-cancel-class="custom-btn btn-warning dim delete_product confrm">

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