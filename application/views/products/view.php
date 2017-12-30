<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2> Product Detail </h2>
        <?= $this->breadcrumbs->show(); ?>
    </div>
</div>

<div class="wrapper wrapper-content">
    <div class="row animated fadeInRight">

        <div class="col-md-4">
            <div class="ibox float-e-margins">
                <div class="widget-head-color-box navy-bg p-lg" style="padding: 20px;margin-top: 0px;">
                    <h3><strong> <?= $product['name']; ?> </strong></h3>
                </div>
                <div class="ibox-content profile-content">
                    <h4><strong> SKU Code : <?= $product['sku_code']; ?></strong></h4>
                    <h4><strong> Price 1 ( <i class="fa fa-inr" aria-hidden="true"></i> ) : <?= $product['price1']; ?></strong></h4>
                    <h4><strong> Price 2 ( <i class="fa fa-inr" aria-hidden="true"></i> ) : <?= $product['price2']; ?></strong></h4>
                    <h4><strong> Brand : <?= $product['brand']; ?></strong></h4>
                    <h4><strong> Category : <?= $product['category']; ?></strong></h4>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Product Description</h5>
                </div>
                <div class="ibox-content">

                    <div class="feed-activity-list">

                        <div class="feed-element">
                            <div class="media-body ">
                                <?= $product['description']; ?>
                            </div>
                        </div>

                        <div class="feed-element">
                            <div class="lightBoxGallery">
                                <?php
                                foreach ($productImages as $image) {
                                    ?>
                                        <a href="<?= base_url(); ?>uploads/products/<?= $image['image']; ?>" title="" data-gallery="">
                                            <img src="<?= base_url(); ?>uploads/products/<?= $image['image']; ?>" width="150" height="150">
                                        </a>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>