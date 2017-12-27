<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!-- FOOTER -->
            <div class="footer-wrapper style-1">
                <footer class="type-1">
                    <div class="footer-columns-entry">
                        <div class="row">
                            <div class="col-md-3">
                                <a href="<?= base_url(); ?>">
                                    <img class="footer-logo" src="<?= base_url(); ?>frontend_assets/img/logo-3.png" alt="" />
                                </a>
                                <div class="footer-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod.</div>
                                <div class="footer-address">30 South Avenue San Francisco<br/>
                                    Phone: +78 123 456 789<br/>
                                    Email: <a href="mailto:Support@blanco.com">info@itqwerty.com</a><br/>
                                    <a href="http://www.ITQwerty.com"><b>www.ITQwerty.com</b></a>
                                </div>
                                <div class="clear"></div>
                            </div>
                            <div class="col-md-2 col-sm-4">
                                <h3 class="column-title">Our Services</h3>
                                <ul class="column">
                                    <li><a href="javascript:;">About us</a></li>
                                    <li><a href="javascript:;">Order History</a></li>
                                    <li><a href="javascript:;">Returns</a></li>
                                    <li><a href="javascript:;">Custom Service</a></li>
                                    <li><a href="javascript:;">Terms &amp; Condition</a></li>
                                    <li><a href="javascript:;">Order History</a></li>
                                    <li><a href="javascript:;">Returns</a></li>
                                </ul>
                                <div class="clear"></div>
                            </div>
                            <div class="col-md-2 col-sm-4">
                                <h3 class="column-title">Our Services</h3>
                                <ul class="column">
                                    <li><a href="javascript:;">About us</a></li>
                                    <li><a href="javascript:;">Order History</a></li>
                                    <li><a href="javascript:;">Returns</a></li>
                                    <li><a href="javascript:;">Custom Service</a></li>
                                    <li><a href="javascript:;">Terms &amp; Condition</a></li>
                                    <li><a href="javascript:;">Order History</a></li>
                                    <li><a href="javascript:;">Returns</a></li>
                                </ul>
                                <div class="clear"></div>
                            </div>
                            <div class="col-md-2 col-sm-4">
                                <h3 class="column-title">Our Services</h3>
                                <ul class="column">
                                    <li><a href="javascript:;">About us</a></li>
                                    <li><a href="javascript:;">Order History</a></li>
                                    <li><a href="javascript:;">Returns</a></li>
                                    <li><a href="javascript:;">Custom Service</a></li>
                                    <li><a href="javascript:;">Terms &amp; Condition</a></li>
                                    <li><a href="javascript:;">Order History</a></li>
                                    <li><a href="javascript:;">Returns</a></li>
                                </ul>
                                <div class="clear"></div>
                            </div>
                            <div class="clearfix visible-sm-block"></div>
                            <div class="col-md-3">
                                <h3 class="column-title">Company working hours</h3>
                                <div class="footer-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod.</div>
                                <div class="footer-description">
                                    <b>Monday-Friday:</b> 8.30 a.m. - 5.30 p.m.<br/>
                                    <b>Saturday:</b> 9.00 a.m. - 2.00 p.m.<br/>
                                    <b>Sunday:</b> Closed
                                </div>
                                <div class="clear"></div>
                            </div>
                        </div>
                    </div>
                    <div class="footer-bottom-navigation text-center">
                        <div class="cell-view">
                            <div class="footer-links"><a href="<?= base_url('About'); ?>">About</a>
								<a href="<?= base_url('About/terms'); ?>">Terms & Condition</a>
								<a href="<?= base_url('About/faq'); ?>">Faq</a>
								<a href="<?= base_url('About/returns'); ?>">Returns</a>
								<a href="<?= base_url('About/service'); ?>">Customer Service</a>
								<a href="<?= base_url('About/policies'); ?>">Privacy & Policies</a>
								<a href="<?= base_url('Contact'); ?>">Contact Us</a>
                            </div>
                        </div>
                    </div>
                    <div class="footer-copyright-wrapper col-md-12">
                        <div class="copyright">
                            <a href="javascript:;"><?= $copyright; ?></a>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    </div>
    <div class="clear"></div>
</div>

<!-- Search on top for mobile screen -->
<div class="search-box popup">
    <form>
        <div class="search-button">
            <i class="fa fa-search"></i>
            <input type="submit" />
        </div><!--
        <div class="search-drop-down">
            <div class="title"><span>All categories</span><i class="fa fa-angle-down"></i></div>
            <div class="list">
                <div class="overflow">
                    <div class="category-entry">Category 1</div>
                </div>
            </div>
        </div> -->
        <div class="search-field">
            <input type="text" value="" placeholder="Search for product" />
        </div>
    </form>
</div>

<!-- Prosuct view in pop up view -->
<div id="product-popup" class="overlay-popup">
    <div class="overflow">
        <div class="table-view">
            <div class="cell-view">
                <div class="close-layer"></div>
                <div class="popup-container">

                    <div class="row">
                        <div class="col-sm-6 information-entry">
                            <div class="product-preview-box">
                                <div class="swiper-container product-preview-swiper" data-autoplay="0" data-loop="1" data-speed="500" data-center="0" data-slides-per-view="1">
                                    <div class="swiper-wrapper" id="main_image">
                                    </div>
                                    <div class="pagination"></div>
                                    <div class="product-zoom-container">
                                        <div class="move-box" id="move_image">
                                        </div>
                                        <div class="zoom-area"></div>
                                    </div>
                                </div>
                                <div class="swiper-hidden-edges">
                                    <div class="swiper-container product-thumbnails-swiper" data-autoplay="0" data-loop="0" data-speed="500" data-center="0" data-slides-per-view="responsive" data-xs-slides="3" data-int-slides="3" data-sm-slides="3" data-md-slides="4" data-lg-slides="4" data-add-slides="4">
                                        <div class="swiper-wrapper" id="sub_image">
                                        </div>
                                        <div class="pagination"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 information-entry">
                            <div class="product-detail-box">
                                <h1 class="product-title">T-shirt Basic Stampata</h1>
                                <h3 class="product-subtitle">Loremous Clothing</h3>
                                <div class="rating-box">
                                    <div class="star"><i class="fa fa-star"></i></div>
                                    <div class="star"><i class="fa fa-star"></i></div>
                                    <div class="star"><i class="fa fa-star"></i></div>
                                    <div class="star"><i class="fa fa-star-o"></i></div>
                                    <div class="star"><i class="fa fa-star-o"></i></div>
                                    <div class="rating-number">25 Reviews</div>
                                </div>
                                <div class="product-description detail-info-entry">Lorem ipsum dolor sit amet, consectetur adipiscing elit, eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur.</div>
                                <div class="price detail-info-entry">
                                    <div class="prev">$90,00</div>
                                    <div class="current">$70,00</div>
                                </div>
                                <div class="size-selector detail-info-entry">
                                    <div class="detail-info-entry-title">Size</div>
                                    <div class="entry active">xs</div>
                                    <div class="entry">s</div>
                                    <div class="entry">m</div>
                                    <div class="entry">l</div>
                                    <div class="entry">xl</div>
                                    <div class="spacer"></div>
                                </div>
                                <div class="color-selector detail-info-entry">
                                    <div class="detail-info-entry-title">Color</div>
                                    <div class="entry active" style="background-color: #d23118;">&nbsp;</div>
                                    <div class="entry" style="background-color: #2a84c9;">&nbsp;</div>
                                    <div class="entry" style="background-color: #000;">&nbsp;</div>
                                    <div class="entry" style="background-color: #d1d1d1;">&nbsp;</div>
                                    <div class="spacer"></div>
                                </div>
                                <div class="quantity-selector detail-info-entry">
                                    <div class="detail-info-entry-title">Quantity</div>
                                    <div class="entry number-minus">&nbsp;</div>
                                    <div class="entry number">10</div>
                                    <div class="entry number-plus">&nbsp;</div>
                                </div>
                                <div class="detail-info-entry">
                                    <a class="button style-10">Add to cart</a>
                                    <a class="button style-11"><i class="fa fa-heart"></i> Add to Wishlist</a>
                                    <div class="clear"></div>
                                </div>
                                <div class="tags-selector detail-info-entry">
                                    <div class="detail-info-entry-title">Tags:</div>
                                    <a href="#">bootstrap</a>/
                                    <a href="#">collections</a>/
                                    <a href="#">color/</a>
                                    <a href="#">responsive</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="close-popup"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Cart product view on top -->
<div class="cart-box popup">
    <div class="popup-container">
        <?php
        $totalAmount = 0;
        // If the user logged in then show their cart
        if(!empty($cart_items))
        {
            ?>
            <div class="scrollbar">
                <?php
                foreach ($cart_items as $key => $item)
                {
                    ?>
                    <div class="cart-entry">
                        <a class="image" href="<?= site_url('product/view'); ?>/<?= $item['product_id']; ?>">
                            <img src="<?= site_url();?>uploads/listingImage/<?= $item['user']; ?>/<?= $item['image']; ?>" alt="<?= $item['image']; ?>" />
                        </a>
                        <div class="content">
                            <a class="title" href="<?= site_url('product/view'); ?>/<?= $item['product_id']; ?>">
                                <?= $item['food_name']; ?>
                            </a>
                            <div class="quantity">Quantity: <?= $item['quantity']; ?></div>
                            <div class="price">$<?= $item['price']; ?></div>
                        </div>

                        <div class="button-x">
                            <a class="style-17" href="<?= site_url('Cart/remove_cart/'.$item['id']); ?>">
                                <i class="fa fa-close"></i>
                            </a>
                        </div>
                    </div>
                    <?php
                    $totalAmount += $item['price'] * $item['quantity'];
                }
                ?>
            </div>
            <div class="summary">
                <div class="subtotal">Subtotal: $<?= $totalAmount; ?></div>
                <div class="grandtotal">Grand Total <span>$<?= $totalAmount; ?></span></div>
            </div>

            <div class="cart-buttons">
                <div class="column">
                    <a class="button style-3" href="<?= site_url('Cart'); ?>">view cart</a>
                    <div class="clear"></div>
                </div>
                <div class="column">
                    <a class="button style-4" href="<?= base_url('Cart/checkout'); ?>">Place order</a>
                    <div class="clear"></div>
                </div>
                <div class="clear"></div>
            </div>
        <?php
        }

        // If the user is not logged in then show their cart
        elseif(isset($_SESSION['cart_value']))
        {
            if(!empty($_SESSION['cart_value']))
            {
                ?>
                <div class="scrollbar">
                <?php
                foreach($_SESSION['cart_value'] as $item)
                {
                    $product = $this->Food_Listing_Model->Food_Details($item['product_id']);

                    ?>
                    <div class="cart-entry">
                        <a class="image" href="<?= site_url('product/view'); ?>/<?= $item['product_id']; ?>">
                            <img src="<?= site_url();?>uploads/listingImage/<?= $product['user_id']; ?>/<?= $product['image']; ?>" alt="<?= $product['image']; ?>" />
                        </a>
                        <div class="content">
                            <a class="title" href="<?= site_url('product/view'); ?>/<?= $item['product_id']; ?>">
                                <?= $product['food_name']; ?>
                            </a>
                            <div class="quantity">Quantity: <?= $item['quantity']; ?></div>
                            <div class="price">$<?= $product['price']; ?></div>
                        </div>

                        <div class="button-x">
                            <a class="style-17" href="<?= site_url('Cart/remove_cart/'.$item['product_id']); ?>">
                                <i class="fa fa-close"></i>
                            </a>
                        </div>
                    </div>
                    <?php
                    $totalAmount += $product['price'] * $item['quantity'];
                }
                ?>
                </div>
                <div class="summary">
                    <div class="subtotal">Subtotal: $<?= $totalAmount; ?></div>
                    <div class="grandtotal">Grand Total <span>$<?= $totalAmount; ?></span></div>
                </div>

                <div class="cart-buttons">
                    <div class="column">
                        <a class="button style-3" href="<?= site_url('Cart'); ?>">view cart</a>
                        <div class="clear"></div>
                    </div>
                    <div class="column">
                        <a class="button style-4" href="<?= base_url('Cart/checkout'); ?>">Place order</a>
                        <div class="clear"></div>
                    </div>
                    <div class="clear"></div>
                </div>
                <?php
            }
        }
        else
        {
            ?>
            There is no product in cart !
            <?php
        }
        ?>
    </div>
</div>