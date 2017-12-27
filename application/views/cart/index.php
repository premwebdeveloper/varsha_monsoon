<?php
echo $this->breadcrumbs->show();

// Logged in user can see their cart products
if(!empty($cart_products))
{
    ?>
    <div class="information-blocks">
        <div class="row">
            <div class="col-sm-9 information-entry">
                <h3 class="cart-column-title size-1">Products</h3>

                <?php

                $totalPrice = 0;

                foreach($cart_products as $product)
                {
                    if(!empty($product))
                    {
                        ?>
                        <div class="traditional-cart-entry style-1">

                            <a class="image" href="<?= site_url('product/view'); ?>/<?= $product['product_id']; ?>">
                                <img alt="<?= $product['image']; ?>" src="<?= site_url();?>uploads/listingImage/<?= $product['user']; ?>/<?= $product['image']; ?>">
                            </a>

                            <div class="content">
                                <div class="cell-view">

                                    <a class="title" href="<?= site_url('product/view'); ?>/<?= $product['product_id']; ?>">
                                        <?= $product['food_name']; ?>
                                    </a>

                                    <div>
                                        <?= $product['type']; ?> ( <?= $product['food_category']; ?> )
                                    </div>

                                    <div class="price">
                                        <div class="prev">$999</div>
                                        <div class="current">$<?= $product['price']; ?></div>
                                    </div>

                                    <div class="quantity-selector detail-info-entry">

                                    <?= form_open('Cart/updateCart/'.$product['id'], ''); ?>

                                        <div class="detail-info-entry-title">Quantity</div>
                                        <div class="entry number-minus">&nbsp;</div>
                                        <div class="entry number"><?= $product['quantity']; ?></div>
                                        <input type="hidden" name="quantity" class="quantity" value="<?= $product['quantity']; ?>">
                                        <div class="entry number-plus">&nbsp;</div>

                                        <!-- Update cart product quantity -->
                                        <button type="submit" class="button btn-yellow" style="min-width: 90px;padding: 10px;"> Update </button>

                                        <!-- Delete cart product -->
                                        <a class="button style-17" href="<?= site_url('Cart/remove_cart/'.$product['id']); ?>">
                                            Remove
                                        </a>

                                    <?= form_close(); ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        $totalPrice += $product['price'] * $product['quantity'];
                    }
                }
                ?>

            </div>

            <div class="col-sm-3 information-entry">
                <h3 class="cart-column-title size-1" style="text-align: center;">Subtotal</h3>
                <div class="sidebar-subtotal">
                    <div class="price-data">
                        <div class="main">$<?= $totalPrice; ?></div>
                        <div class="title">Excluding tax &amp; shipping</div>
                    </div>
                    <div class="additional-data">
                        <a class="button style-10" href="<?= base_url('Cart/checkout'); ?>">Place Order</a>
                        <a class="button style-10" href="<?= base_url('/'); ?>">Continue Shopping</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <?php
}
elseif(isset($_SESSION['cart_value']))  // If user is not logged in then view cart products
{
    ?>
    <div class="information-blocks">
        <div class="row">
            <div class="col-sm-9 information-entry">
                <h3 class="cart-column-title size-1">Products</h3>

                <?php
                $totalPrice = 0;

                foreach($_SESSION['cart_value'] as $item)
                {
                    $product = $this->Food_Listing_Model->Food_Details($item['product_id']);

                    $type = $this->Product_Model->getFoodType($product['food_type']);

                    $category = $this->Product_Model->getFoodCategory($product['food_category']);

                    ?>
                    <div class="traditional-cart-entry style-1">

                        <a class="image" href="<?= site_url('product/view'); ?>/<?= $item['product_id']; ?>">
                            <img alt="" src="<?= site_url();?>uploads/listingImage/<?= $product['user_id']; ?>/<?= $product['image']; ?>">
                        </a>

                        <div class="content">
                            <div class="cell-view">

                                <a class="title" href="<?= site_url('product/view'); ?>/<?= $item['product_id']; ?>">
                                    <?= $product['food_name']; ?>
                                </a>

                                <div>
                                    <?= $type['type']; ?> ( <?= $category['food_category']; ?> )
                                </div>

                                <div class="price">
                                    <div class="prev">$999</div>
                                    <div class="current">$<?= $product['price']; ?></div>
                                </div>

                                <div class="quantity-selector detail-info-entry">

                                    <?= form_open('Cart/updateCart/'.$item['product_id'], ''); ?>

                                        <div class="detail-info-entry-title">Quantity</div>
                                        <div class="entry number-minus">&nbsp;</div>
                                        <div class="entry number"><?= $item['quantity']; ?></div>
                                        <input type="hidden" name="quantity" class="quantity" value="<?= $item['quantity']; ?>">
                                        <div class="entry number-plus">&nbsp;</div>

                                        <!-- Update cart product quantity -->
                                        <button type="submit" class="button btn-yellow" style="min-width: 90px;padding: 10px;"> Update </button>

                                        <!-- Delete cart product -->
                                        <a class="button style-17" href="<?= site_url('Cart/remove_cart/'.$item['product_id']); ?>">
                                            Remove
                                        </a>

                                    <?= form_close(); ?>

                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    $totalPrice += $product['price'] * $item['quantity'];
                }
                ?>
            </div>

            <div class="col-sm-3 information-entry">
                <h3 class="cart-column-title size-1" style="text-align: center;">Subtotal</h3>
                <div class="sidebar-subtotal">
                    <div class="price-data">
                        <div class="main">$<?= $totalPrice; ?></div>
                        <div class="title">Excluding tax &amp; shipping</div>
                    </div>
                    <div class="additional-data">
                        <a class="button style-10" href="<?= base_url('Cart/checkout'); ?>">Place Order</a>
                        <a class="button style-10" href="<?= base_url('/'); ?>">Continue Shopping</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <?php
}
else    // If there is no cart products of any one
{
    ?>
    <div class="teaser-container  table-view" style="height: 500px;">
        <h4 class="text-left p20">MY CART (0)</h4>
        <div class="row-view">
            <div class="cell-view">
                <div class="teaser-content">

                    <div class="center">
                        <div class="teaser-date text-center">
                            <div class="text-center">
                                <i class="fa fa-arrow-right yellow fa-4x" style="position: relative;top: -54px;" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;&nbsp;
                                <i class="fa fa-laptop blue_color" style="font-size: 180px;" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;&nbsp;
                                <i class="fa fa-arrow-left fa-4x yellow" style="position: relative;top: -54px;" aria-hidden="true"></i>
                            </div>
                            <div class="text-center">
                                <i class="fa fa-cart-arrow-down fa-4x yellow" style="position: relative;top: -130px;" aria-hidden="true"></i>
                            </div>
                            <h4 class="block-title">Your Cart is empty</h4>
                            <div class="clear"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
}
?>