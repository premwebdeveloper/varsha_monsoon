<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?= $this->breadcrumbs->show(); ?>
<div class="information-blocks">
    <div class="row">
        <div class="col-md-12 col-sm-12">

            <?php
            if(!empty($products))
            {
                ?>
                <p  style="font-size: larger;font-weight: bold;">Showing <?= count($products); ?> results for "<?= $search_for; ?>"</p>
                <hr />
                <?php
            }
            ?>

            <div class="row shop-grid grid-view">
                <?php
                if(!empty($products))
                {
                    foreach ($products as $product)
                    {
                        ?>
                        <div class="col-md-3 col-sm-4 shop-grid-item p0">
                            <div class="product-slide-entry shift-image style_border">
                                <div class="product-image">
                                    <a href="<?= base_url(); ?>product/view/<?= $product['id']; ?>">
                                        <img src="<?= base_url();?>/uploads/products/<?= $product['image']; ?>" alt="" />
                                        <img src="<?= base_url();?>/uploads/products/<?= $product['image']; ?>" alt="" />
                                    </a>
                                </div>
                                <a class="title ng-binding" href="<?= base_url(); ?>product/view/<?= $product['id']; ?>"><?= $product['name']; ?></a>
                                
                                <div class="price">
                                    <div class="prev"><i class="fa fa-inr" aria-hidden="true"></i><?= $product['price1']; ?></div>
                                    <div class="current"><i class="fa fa-inr" aria-hidden="true"></i><?= $product['price2']; ?></div>
                                </div>
                                <div class="list-buttons">
                                    <a class="button style-10">Add to cart</a>
                                    <a class="button style-11"><i class="fa fa-heart"></i> Add to Wishlist</a>
                                </div>
                            </div>
                            <div class="clear"></div>
                        </div>
                        <?php
                    }
                }
                else
                {
                    ?>
                    <div class="col-md-6 col-md-offset-3 text-center" style="font-size: large;font-weight: bold;">
                        <div class="alert alert-info"> Sorry, no results found! </div>
                        <p>Please check the spelling or try searching for something else</p>
                    </div>

                    <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>
<hr />