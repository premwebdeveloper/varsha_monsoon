<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<script type="text/javascript">
    $(document).ready(function(){
        $('[data-toggle="delete_image"]').confirmation({

            onConfirm: function(){
                    var image_id = $(this).attr('data-id');
                    window.location.href = "<?= base_url();?>Products/deleteImage/"+image_id;
            }, // Set event when click at confirm button

            onCancel: function(){
                    var image_id = $(this).attr('data-id');
            }
        });
    });
</script>

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Edit Product</h2>
        <?= $this->breadcrumbs->show(); ?>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>Fill all reuired Fields</h5>
                </div>

                <?= form_open_multipart("Products/edit", '', array('class' => 'wizard-big', 'role' => 'form'));?>
                    <div class="ibox-content">
                        <fieldset>
                            <div class="row">

                                <?php   # If the session error is set then print error
                                if(!is_null($this->session->flashdata('error')))
                                {
                                    ?>
                                    <div class="col-md-12">
                                        <div class="alert alert-info alert-dismissable">
                                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                            <?= $this->session->flashdata('error'); ?>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>

                                <input type="hidden" name="product_id" id="product_id" value="<?= $product['id']; ?>">

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label>Brand</label>
                                        <select class="form-control m-b" id="brand" name="brand" required="required">
                                        <option value="">Select Brand</option>
                                        <?php
                                        foreach($brands as $brand)
                                        {
                                            if($brand['id'] == $product['brand_id'])
                                            {
                                                $selected = "selected";
                                            }
                                            else
                                            {
                                                $selected = "";
                                            }
                                            ?>
                                            <option value="<?= $brand['id']; ?>" <?= $selected; ?>>
                                                <?= $brand['brand']; ?>
                                            </option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                        <span class="red"><?= form_error('brand'); ?></span>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label>Category</label>
                                        <select class="form-control m-b" id="category" name="category" required="required">
                                        <option value="">Select Category</option>
                                        <?php
                                        foreach($categories as $category)
                                        {
                                            if($category['id'] == $product['category_id'])
                                            {
                                                $selected = "selected";
                                            }

                                            else
                                            {
                                                $selected = "";
                                            }
                                            ?>
                                            <option value="<?= $category['id']; ?>" <?= $selected; ?>>
                                                <?= $category['category']; ?>
                                            </option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                        <span class="red"><?= form_error('category'); ?></span>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label>Product Name</label>
                                        <input id="name" name="name" type="text" required="required" class="form-control required" placeholder="Product Name" value="<?= $product['name']; ?>">
                                        <span class="red"><?= form_error('name'); ?></span>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label>SKU Code</label>
                                        <input id="sku_code" name="sku_code" type="text" required="required" class="form-control required" placeholder="SKU Code" value="<?= $product['sku_code']; ?>">
                                        <span class="red"><?= form_error('sku_code'); ?></span>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label>Price 1</label>
                                        <input id="price1" name="price1" type="number" required="required" class="form-control required" placeholder="Price 1" value="<?= $product['price1']; ?>">
                                        <span class="red"><?= form_error('price1'); ?></span>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label>Price 2</label>
                                        <input id="price2" name="price2" type="number" required="required" class="form-control required" placeholder="Price 2" value="<?= $product['price2']; ?>">
                                        <span class="red"><?= form_error('price2'); ?></span>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label>Product Images</label>
                                        <input type="file" class="simple-field required" id="images" name="images[]" multiple style="border: 1px solid #e4e3e3;padding: 4px;" />
                                        <span class="red"><?= form_error('price2'); ?></span>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea id="description" name="description" class="form-control required" placeholder="Description"><?= $product['description']; ?></textarea>
                                        <span class="red"><?= form_error('sku_code'); ?></span>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Product Images</label>
                                        <div class="col-md-12 p0">
                                        <?php
                                        foreach ($productImages as $image)
                                        {
                                            ?>
                                            <span>
                                                <img src="<?= base_url(); ?>uploads/products/<?= $image['image']; ?>" width="120" height="120">

                                                <a class="custom-btn delete_image" data-id='<?= $image['id'].'/'.$product['id']; ?>' title="Are You Sure ?"
                                                    data-toggle="delete_image" data-singleton="true" data-placement="top" data-popout="true" data-btn-ok-label="Yes" data-btn-ok-icon="fa fa-check" data-btn-ok-class="custom-btn btn-success dim delete_image confrm" data-btn-cancel-label="No" data-btn-cancel-icon="fa fa-times" data-btn-cancel-class="custom-btn btn-warning dim delete_image confrm" style="vertical-align: top;padding: 0px;">

                                                    <span class="badge">
                                                        <i class="fa fa-times" aria-hidden="true"></i>
                                                    </span>
                                                </a>
                                            </span>
                                            <?php
                                        }
                                        ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12 text-right">
                                    <div class="form-group">
                                        <label>&nbsp;</label>
                                        <button class="btn btn-primary" type="submit">Edit Product</button>
                                    </div>
                                </div>

                            </div>
                        </fieldset>
                    </div>
                <?= form_close();?>
            </div>
        </div>
    </div>
</div>