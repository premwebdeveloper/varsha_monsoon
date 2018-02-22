<?= $this->breadcrumbs->show(); ?>
<div class="information-blocks">
    <div class="row">
        <div class="col-sm-6 information-entry">
            <div class="product-preview-box">
                <div class="swiper-container product-preview-swiper" data-autoplay="0" data-loop="1" data-speed="500" data-center="0" data-slides-per-view="1">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="product-zoom-image">
                                <img src="<?= base_url(); ?>uploads/products/<?= $product_image[1]['image']; ?>" alt="" data-zoom="img/product-main-1-zoom.jpg" />
                            </div>
                        </div>
                        <?php
                        foreach($product_image as $img)
                        {
                        ?>
                            <div class="swiper-slide">
                                <div class="product-zoom-image">
                                    <img src="<?= base_url(); ?>uploads/products/<?= $img['image']; ?>" alt="" data-zoom="<?= base_url(); ?>uploads/products/<?= $img['image']; ?>" />
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="pagination"></div>
                    <div class="product-zoom-container">
                        <div class="move-box">
                            <img class="default-image" src="<?= base_url(); ?>uploads/products/<?= $product_image[0]['image']; ?>" alt="" />
                            <img class="zoomed-image" src="<?= base_url(); ?>uploads/products/<?= $product_image[0]['image']; ?>" alt="" />
                        </div>
                        <div class="zoom-area"></div>
                    </div>
                </div>
                <div class="swiper-hidden-edges">
                    <div class="swiper-container product-thumbnails-swiper" data-autoplay="0" data-loop="0" data-speed="500" data-center="0" data-slides-per-view="responsive" data-xs-slides="3" data-int-slides="3" data-sm-slides="3" data-md-slides="4" data-lg-slides="4" data-add-slides="4">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide selected">
                                <div class="paddings-container">
                                    <img src="<?= base_url(); ?>uploads/products/<?= $product_image[0]['image']; ?>" alt="" />
                                </div>
                            </div>
                            <?php
                            foreach($product_image as $img)
                            {
                            ?>
                                <div class="swiper-slide">
                                    <div class="paddings-container">
                                        <img src="<?= base_url(); ?>uploads/products/<?= $img['image']; ?>" alt="" />
                                    </div>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                        <div class="pagination"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 information-entry">
            <div class="product-detail-box">
                <h1 class="product-title"><?= $product['name']; ?></h1>
                <h3 class="product-subtitle">
                    <?php
                    foreach ($brand as $value)
                    {
                        if($product['brand_id'] === $value['id'])
                        {
                            echo $value['brand'];
                        }
                    }
                    ?>
                </h3>
                <div class="rating-box">
                    <div class="star"><i class="fa fa-star-o"></i></div>
                    <div class="star"><i class="fa fa-star-o"></i></div>
                    <div class="star"><i class="fa fa-star-o"></i></div>
                    <div class="star"><i class="fa fa-star-o"></i></div>
                    <div class="star"><i class="fa fa-star-o"></i></div>
                    <div class="rating-number">25 Reviews</div>
                </div>
                <div class="product-description detail-info-entry">Lorem ipsum dolor sit amet, consectetur adipiscing elit, eiusmod tempor incididunt ut labore et dolore magna aliqua. Lorem ipsum dolor sit amet, consectetur adipiscing elit, eiusmod tempor incididunt ut labore et dolore magna aliqua.</div>
                <div class="price detail-info-entry col-md-12">
                    <div class="prev"><i class="fa fa-inr" aria-hidden="true"></i><?= $product['price2']; ?></div>
                    <div class="current"><i class="fa fa-inr" aria-hidden="true"></i><?= $product['price1']; ?></div>
                </div>

                <?= form_open('Cart/add_cart/'.$product['id'], ''); ?>

                    <div class="quantity-selector detail-info-entry col-md-3 col-xs-12">
                        <div class="detail-info-entry-title">Quantity</div>
                        <div class="entry number-minus">&nbsp;</div>
                        <div class="entry number">1</div>
                        <input type="hidden" name="quantity" class="quantity" value="1">
                        <div class="entry number-plus">&nbsp;</div>
                    </div>

                    <div class="pt25 col-md-3 col-xs-6 pb10">

                        <button type="submit" class="button btn-yellow">
                            <i class="fa fa-shopping-cart"></i> Add to cart
                        </button>

                        <div class="clear"></div>

                    </div>

                <?= form_close(); ?>
                <div class="col-md-6 pt25 col-xs-6 pb10">
                    <button type="submit" class="button btn-blue">
                        <i class="fa fa-heart"></i> Add to Wishlist
                    </button>
                </div>
                <div class="rating-box col-md-12 pb10">
                    <div class="rating-number">Category :-</div>
                    <div class="star">
                        <?php
                            foreach($categories as $cate)
                            {
                                if($product['category_id'] == $cate['id'])
                                {
                                    echo $cate['category'];
                                }
                            }
                        ?>
                    </div>
                </div>

                <div class="share-box detail-info-entry col-md-12">
                    <div class="title">Share in social media</div>
                    <div class="socials-box">
                        <a href="javascript:;"><i class="fa fa-facebook"></i></a>
                        <a href="javascript:;"><i class="fa fa-twitter"></i></a>
                        <a href="javascript:;"><i class="fa fa-google-plus"></i></a>
                        <a href="javascript:;"><i class="fa fa-youtube"></i></a>
                        <a href="javascript:;"><i class="fa fa-linkedin"></i></a>
                        <a href="javascript:;"><i class="fa fa-instagram"></i></a>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
            <div class="accordeon col-md-12">
                <div class="accordeon-title active">Product description</div>
                <div class="accordeon-entry" style="display: block;">
                    <div class="article-container style-1">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit.</p>
                        <ul>
                            <li>Any Product types that You want - Simple, Configurable</li>
                            <li>Downloadable/Digital Products, Virtual Products</li>
                            <li>Inventory Management with Backordered items</li>
                            <li>Customer Personal Products - upload text for embroidery, monogramming</li>
                            <li>Create Store-specific attributes on the fly</li>
                        </ul>
                    </div>
                </div>
                <div class="accordeon-title">shipping &amp; Returns</div>
                <div class="accordeon-entry">
                    <div class="article-container style-1">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit.</p>
                        <ul>
                            <li>Any Product types that You want - Simple, Configurable</li>
                            <li>Downloadable/Digital Products, Virtual Products</li>
                            <li>Inventory Management with Backordered items</li>
                            <li>Customer Personal Products - upload text for embroidery, monogramming</li>
                            <li>Create Store-specific attributes on the fly</li>
                        </ul>
                    </div>
                </div>
                <div class="accordeon-title">RETURNS POLICY</div>
                <div class="accordeon-entry">
                    <div class="article-container style-1">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit.</p>
                        <ul>
                            <li>Any Product types that You want - Simple, Configurable</li>
                            <li>Downloadable/Digital Products, Virtual Products</li>
                            <li>Inventory Management with Backordered items</li>
                            <li>Customer Personal Products - upload text for embroidery, monogramming</li>
                            <li>Create Store-specific attributes on the fly</li>
                        </ul>
                    </div>
                </div>
                <div class="accordeon-title">Product reviews (25)</div>
                <div class="accordeon-entry">
                    <div class="article-container style-1">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit.</p>
                        <ul>
                            <li>Any Product types that You want - Simple, Configurable</li>
                            <li>Downloadable/Digital Products, Virtual Products</li>
                            <li>Inventory Management with Backordered items</li>
                            <li>Customer Personal Products - upload text for embroidery, monogramming</li>
                            <li>Create Store-specific attributes on the fly</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
