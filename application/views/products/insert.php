<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>Add Product</h2>
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

                <?= form_open_multipart("Products/add_product", '', array('class' => 'wizard-big', 'role' => 'form'));?>
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

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label>Brand</label>
                                        <select class="form-control m-b" id="brand" name="brand" required="required">
                                        <option value="">Select Brand</option>
                                        <?php
                                        foreach($brands as $brand)
                                        {
                                            ?>
                                            <option value="<?= $brand['id']; ?>"><?= $brand['brand']; ?></option>
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
                                            ?>
                                            <option value="<?= $category['id']; ?>"><?= $category['category']; ?></option>
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
                                        <input id="name" name="name" type="text" required="required" class="form-control required" placeholder="Product Name">
                                        <span class="red"><?= form_error('name'); ?></span>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label>SKU Code</label>
                                        <input id="sku_code" name="sku_code" type="text" required="required" class="form-control required" placeholder="SKU Code">
                                        <span class="red"><?= form_error('sku_code'); ?></span>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label>Price 1</label>
                                        <input id="price1" name="price1" type="number" required="required" class="form-control required" placeholder="Price 1">
                                        <span class="red"><?= form_error('price1'); ?></span>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label>Price 2</label>
                                        <input id="price2" name="price2" type="number" required="required" class="form-control required" placeholder="Price 2">
                                        <span class="red"><?= form_error('price2'); ?></span>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label>Product Images</label>
                                        <input type="file" class="simple-field required" required="required" id="images" name="images[]" multiple style="border: 1px solid #e4e3e3;padding: 4px;" />
                                        <span class="red"><?= form_error('price2'); ?></span>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea id="description" name="description" class="form-control required" placeholder="Description"></textarea>
                                        <span class="red"><?= form_error('sku_code'); ?></span>
                                    </div>
                                </div>

                                <div class="col-lg-12 text-right">
                                    <div class="form-group">
                                        <label>&nbsp;</label>
                                        <button class="btn btn-primary" type="submit">Add Product</button>
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