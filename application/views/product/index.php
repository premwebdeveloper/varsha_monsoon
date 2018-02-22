<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?= $this->breadcrumbs->show(); ?>
<div class="information-blocks">
    <div class="row">
        <div class="col-md-9 col-md-push-3 col-sm-8 col-sm-push-4">
            <div class="row shop-grid grid-view">
                <div id="all_product">
                    <?php
                    foreach ($products as $product)
                    {
                        // Get product images
                        $images = $this->Products_Model->getProductImages($product['id']);
                        /*echo "<pre>";
                        print_r($images);
                        die;*/
                    ?>
                        <div class="col-md-3 col-sm-4 shop-grid-item">
                            <div class="product-slide-entry shift-image style_border">
                                <div class="product-image">
                                    <img style="height: 200px;" src="<?= base_url(); ?>uploads/products/<?= $images[0]['image']; ?>" alt="" />
                                    <img style="height: 200px;" src="<?= base_url(); ?>uploads/products/<?= $images[1]['image']; ?>" alt="" />
                                    <!-- <div class="bottom-line left-attached">
                                        <a class="bottom-line-a square"><i class="fa fa-shopping-cart"></i></a>
                                        <a class="bottom-line-a square"><i class="fa fa-heart"></i></a>
                                        <a class="bottom-line-a square"><i class="fa fa-retweet"></i></a>
                                        <a class="bottom-line-a square"><i class="fa fa-expand"></i></a>
                                    </div> -->
                                </div>
                                <a class="tag" href="#"><?= $product['brand']; ?></a>
                                <a class="title" href="#"><?= $product['name']; ?></a>
                                <div class="price">
                                    <div class="prev"><?= $product['price2']; ?></div>
                                    <div class="current"><?= $product['price1']; ?></div>
                                </div>
                            </div>
                            <div class="clear"></div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
                <div id="selected_products" style="display: none;">
                </div>
                <div id="selected_products_empty" style="display: none;">
                    <h2>Sorry ! Product Not Available.</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-md-pull-9 col-sm-4 col-sm-pull-8 blog-sidebar">
            <div class="information-blocks categories-border-wrapper">
                <div class="block-title size-3">Brands</div>
                <div class="accordeon" style="margin-bottom: 10px;">
                    <div class="article-container style-1">
                        <ul>
                            <?php
                            foreach ($brands as $brand)
                            {
                            ?>
                                <h5 class="p10 pb0 pt0">
                                    <input type="checkbox" class="brands" name="brand[]" value="<?= $brand['id']; ?>">
                                    <a href="#">&nbsp;<?= $brand['brand']; ?></a>
                                </h5>
                            <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>
                <div class="block-title size-3">Categories</div>
                <div class="accordeon">
                    <div class="article-container style-1">
                        <ul>
                            <?php
                            foreach ($categories as $category)
                            {
                            ?>
                                <h5 class="p10 pb0 pt0">
                                    <input type="checkbox" class="categories" name="category[]" value="<?= $category['id']; ?>">
                                    <a href="#"><?= $category['category']; ?></a>
                                </h5>
                            <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $('input[type="checkbox"]').change(function() {
            /*var data = $('.categories:checkbox:checked').val();
            alert(data);*/
            var category = [];
            var brand = [];
            $('input.brands:checkbox:checked').each(function () {
                brand.push($(this).val());
            });
            $('input.categories:checkbox:checked').each(function () {
                category.push($(this).val());
            });

            $.ajax({
                url: "<?= base_url('Product/get_products'); ?>",
                type: "POST",
                data: { brand : brand,  category : category },
                success:function(data){
                    var result = $.parseJSON(data);
                    $("#selected_products").html(result);
                    if(result == 0 || data == 0)
                    {
                        if(brand != "" || category != "")
                        {
                            $("#selected_products_empty").show();
                            $("#all_product").hide();
                            $("#selected_products").hide();
                        }
                        else
                        {
                            $("#selected_products_empty").hide();
                            $("#all_product").show();
                            $("#selected_products").hide();
                        }
                    }
                    else
                    {
                        $("#selected_products").show();
                        $("#all_product").hide();
                        $("#selected_products_empty").hide();
                    }
                }
            });

        });


    });
</script>