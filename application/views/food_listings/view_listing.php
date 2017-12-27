<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    $this->load->view('templates/_parts/public_master_user_profile_sidebar_view');
?>
        <div class="col-sm-9">
            <?php
            if(isset($_SESSION['success']))
            {
                ?>
                <div class="message-box message-success">
                    <div class="message-icon"><i class="fa fa-check"></i></div>
                    <div class="message-text"><b><?= $_SESSION['success']; ?></div>
                    <div class="message-close"><i class="fa fa-times"></i></div>
                </div>

                <?php
            }
            ?>
            <?= $this->breadcrumbs->show(); ?>
            <div class="information-blocks">
                <div class="row">
                    <div class="col-sm-7 information-entry">
                        <div class="product-preview-box">
                            <div class="swiper-container product-preview-swiper" data-autoplay="0" data-loop="1" data-speed="500" data-center="0" data-slides-per-view="1">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <div class="product-zoom-image">
                                            <img src="<?= base_url(); ?>uploads/listingImage/<?= $food_details['user_id']; ?>/<?=  $food_details['image']; ?>" alt="" data-zoom="<?= base_url(); ?>uploads/listingImage/<?= $food_details['user_id']; ?>/<?=  $food_details['image']; ?>" />
                                        </div>
                                    </div>
                                    <?php
                                    foreach($food_images as $img)
                                    {
                                    ?>
                                        <div class="swiper-slide">
                                            <div class="product-zoom-image">
                                                <img src="<?= base_url(); ?>uploads/listingImage/<?= $food_details['user_id']; ?>/<?=  $img['image']; ?>" alt="" data-zoom="<?= base_url(); ?>uploads/listingImage/<?= $food_details['user_id']; ?>/<?=  $img['image']; ?>" />
                                            </div>
                                        </div>
                                    <?php
                                    }
                                    ?>

                                </div>
                                <div class="pagination"></div>
                                <div class="product-zoom-container">
                                    <div class="move-box">
                                        <img class="default-image" src=""<?= base_url(); ?>uploads/listingImage/<?= $food_details['user_id']; ?>/<?=  $food_details['image']; ?>" alt="" />
                                        <img class="zoomed-image" src=""<?= base_url(); ?>uploads/listingImage/<?= $food_details['user_id']; ?>/<?=  $food_details['image']; ?>" alt="" />
                                    </div>
                                    <div class="zoom-area"></div>
                                </div>
                            </div>
                            <div class="swiper-hidden-edges">
                                <div class="swiper-container product-thumbnails-swiper" data-autoplay="0" data-loop="0" data-speed="500" data-center="0" data-slides-per-view="responsive" data-xs-slides="3" data-int-slides="3" data-sm-slides="3" data-md-slides="4" data-lg-slides="4" data-add-slides="4">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide selected">
                                            <div class="paddings-container">
                                                <img src="<?= base_url(); ?>uploads/listingImage/<?= $food_details['user_id']; ?>/<?=  $food_details['image']; ?>" alt="" />
                                            </div>
                                        </div>
                                        <?php
                                        foreach($food_images as $img)
                                        {
                                        ?>
                                            <div class="swiper-slide">
                                                <div class="paddings-container">
                                                    <img src="<?= base_url(); ?>uploads/listingImage/<?= $food_details['user_id']; ?>/<?=  $img['image']; ?>" alt="" />
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
                    <div class="col-sm-5 information-entry">
                        <div class="product-detail-box">
                            <h1 class="product-title"><?= $food_details['food_name']; ?></h1>
                            <h3 class="product-subtitle">
                                <?php
                                    if($food_details['food_category'] == 0)
                                    {
                                        echo $food_details['optional_category'];
                                    }
                                    else
                                    {
                                        foreach($food_category as $category)
                                        {
                                            if($food_details['food_category'] == $category['id'])
                                            {
                                                echo $category['food_category'];
                                            }
                                        }
                                    }
                                ?>
                             </h3>
                            <div class="rating-box">
                                <div class="star"><i class="fa fa-star"></i></div>
                                <div class="star"><i class="fa fa-star"></i></div>
                                <div class="star"><i class="fa fa-star"></i></div>
                                <div class="star"><i class="fa fa-star-o"></i></div>
                                <div class="star"><i class="fa fa-star-o"></i></div>
                                <div class="rating-number">25 Reviews</div>
                            </div>
                            <div class="product-description detail-info-entry">
                                <?= $food_details['description']; ?>
                            </div>
                            <div class="price detail-info-entry">
                                <div class="prev">$90,00</div>
                                <div class="current">$70,00</div>
                            </div>
                            <div class="column-title">
                                <label>Availibility:</label>

                                <?php
                                if($product_availibility['available_on'] == 1)
                                {
                                    foreach ($week_id as $id)
                                    {
                                        ?><p class="col-md-6 col-xs-6 p10">
                                        <i class="fa fa-check" aria-hidden="true"></i>&nbsp;
                                        <?php
                                        if($id == 1)
                                        {
                                            echo 'Monday';
                                        }
                                        if($id == 2)
                                        {
                                            echo 'Tuesday';
                                        }
                                        if($id == 3)
                                        {
                                            echo 'Wednesday';
                                        }
                                        if($id == 4)
                                        {
                                            echo 'Thursday';
                                        }
                                        if($id == 5)
                                        {
                                            echo 'Friday';
                                        }
                                        if($id == 6)
                                        {
                                            echo 'Saturday';
                                        }
                                        if($id == 7)
                                        {
                                            echo 'Sunday';
                                        }
                                        ?>
                                        </p>
                                        <?php
                                    }
                                }
                                else if($product_availibility['available_on'] == 0)
                                {
                                ?>
                                    <p><i class="fa fa-check" aria-hidden="true"></i>&nbsp;Daily</p>
                                <?php
                                }
                                else if($product_availibility['available_on'] == 2)
                                {
                                ?>
                                    <label>On: </label><?= convert_date_format($product_availibility['available_on_date']); ?>
                                <?php
                                }
                                ?>
                            </div>
                            <div class="p10">
                                <label>From:  <?= $product_availibility['available_from_time']; ?> To <?= $product_availibility['available_to_time']; ?></label>
                            </div>
                            <div class="share-box detail-info-entry">
                                <div class="title">Share in social media</div>
                                <div class="socials-box">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-google-plus"></i></a>
                                    <a href="#"><i class="fa fa-youtube"></i></a>
                                    <a href="#"><i class="fa fa-linkedin"></i></a>
                                    <a href="#"><i class="fa fa-instagram"></i></a>
                                </div>
                                <div class="clear"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>