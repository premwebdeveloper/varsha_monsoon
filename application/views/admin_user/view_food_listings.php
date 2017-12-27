<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8">

        <h2>Food Listing</h2>
        <?= $this->breadcrumbs->show(); ?>
    </div>
    <div class="col-lg-4 p20 text-right">
    </div>
</div>
    <div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
                <div class="col-lg-12">

                    <div class="ibox product-detail">
                        <div class="ibox-content">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="product-images">
                                        <div>
                                            <div class="image-imitation" style="padding: 0px;">
                                                <img style="height: 400px; width:418px;" src="<?= base_url(); ?>uploads/listingImage/<?= $food_details['user_id']; ?>/<?=  $food_details['image']; ?>">
                                            </div>
                                        </div>
                                        <?php
                                        foreach($food_images as $image)
                                        {
                                        ?>
                                            <div>
                                                <div class="image-imitation" style="padding: 0px;">
                                                    <img style="height: 400px; width:418px;" src="<?= base_url(); ?>uploads/listingImage/<?= $food_details['user_id']; ?>/<?=  $image['image']; ?>">
                                                </div>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-6">

                                    <h2 class="font-bold m-b-xs">
                                        <?= $food_details['food_name']; ?>
                                    </h2>
                                    <small>
                                        <?php
                                            foreach ($type as $value)
                                            {
                                                if($food_details['food_type'] === $value['id'])
                                                {
                                                    echo $value['type'];
                                                }
                                            }
                                        ?>
                                    </small>
                                    <div class="m-t-md">
                                        <h2 class="product-main-price"><i class="fa fa-rupee"></i><?= $food_details['price']; ?> / <s class="small text-muted"><i class="fa fa-rupee"></i>300</s></h2>
                                    </div>
                                    <hr>

                                    <h4>Product Description</h4>

                                    <div class="small text-muted">
                                        <?= $food_details['description']; ?>
                                    </div>
                                    <dl class="small m-t-md">
                                        <dt>Ratting</dt>
                                        <dd>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                            <i class="fa fa-star-o"></i>
                                        </dd>
                                        <dt>Category: -</dt>
                                        <dd>
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

                                                echo " / Day Meal ";

                                                if($food_details['breakfast_lunch_dinner'] == 0 || $food_details['breakfast_lunch_dinner'] == NULL)
                                                {
                                                    echo "( - )";
                                                }
                                                else
                                                {
                                                    foreach($day_meals as $meal)
                                                    {
                                                        if($food_details['breakfast_lunch_dinner'] == $meal['id'])
                                                        {
                                                            echo "(".$meal['meal_name'].")";
                                                        }
                                                    }
                                                }
                                            ?>
                                        </dd>
                                        <!-- <dd>Donec id elit non mi porta gravida at eget metus.</dd>
                                        <dt>Malesuada porta</dt>
                                        <dd>Etiam porta sem malesuada magna mollis euismod.</dd> -->
                                    </dl>
                                    <hr>

                                    <div>
                                        <div class="btn-group">
                                            <!-- <button class="btn btn-primary btn-sm"><i class="fa fa-cart-plus"></i> Add to cart</button>
                                            <button class="btn btn-white btn-sm"><i class="fa fa-star"></i> Add to wishlist </button>
                                            <button class="btn btn-white btn-sm"><i class="fa fa-envelope"></i> Contact with author </button> -->
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="ibox-footer">
                            <span class="pull-right">
                                Date - <i class="fa fa-clock-o"></i> <?= convert_date_format($food_details['updated_on']); ?>
                            </span>
                            The generated this product on this date
                        </div>
                    </div>

                </div>
            </div>
</div>
