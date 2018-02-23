<?= $this->breadcrumbs->show(); ?>

<?php   # If the session message is set then print message
if(!is_null($this->session->flashdata('order_success')))
{
	?>
	<div class="alert alert-success alert-dismissable">
		<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
	<?= $this->session->flashdata('order_success'); ?>
	</div>
	<?php
}
if(isset($order_error))
{
	?>
	<script>
	$(document).ready(function(){
		$("#orderNowModal").modal('show');
	});
	</script>
	<?php
}
?>
					
<div class="information-blocks">
    <div class="row">
        <div class="col-sm-6 information-entry">
            <div class="product-preview-box">
                <div class="swiper-container product-preview-swiper" data-autoplay="0" data-loop="1" data-speed="500" data-center="0" data-slides-per-view="1">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="product-zoom-image">
                                <img src="<?= base_url(); ?>uploads/products/<?= $product_image[0]['image']; ?>" alt="" data-zoom="img/product-main-1-zoom.jpg" />
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
                <div class="rating-box col-md-12 p0">
                    <div class="rating-number">Brand :-</div>
                    <div class="star">
                        <?php
                        foreach ($brand as $value)
                        {
                            if($product['brand_id'] === $value['id'])
                            {
                                echo $value['brand'];
                            }
                        }
                        ?>
                    </div>
                </div>
                <div class="rating-box col-md-12">
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
                <div class="rating-box">
                    <div class="star"><i class="fa fa-star-o"></i></div>
                    <div class="star"><i class="fa fa-star-o"></i></div>
                    <div class="star"><i class="fa fa-star-o"></i></div>
                    <div class="star"><i class="fa fa-star-o"></i></div>
                    <div class="star"><i class="fa fa-star-o"></i></div>
                    <div class="rating-number">25 Reviews</div>
                </div>
                <div class="product-description detail-info-entry"><?= $product['description']; ?></div>
                <div class="price detail-info-entry col-md-12">
                    <div class="prev"><i class="fa fa-inr" aria-hidden="true"></i><?= $product['price2']; ?></div>
                    <div class="current"><i class="fa fa-inr" aria-hidden="true"></i><?= $product['price1']; ?></div>
                </div>

                <div class="col-md-6 col-xs-6 pb10">
                    <button type="button" class="button btn-yellow" data-toggle="modal" data-target="#orderNowModal">
                        <i class="fa fa-shopping-cart"></i> Order Now
                    </button>
                </div>               
<!-- 
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
                </div> -->
            </div><!-- 
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
            </div> -->
            <hr>
        </div>
    </div>
</div>

<!-- Order now Modal -->
<div id="orderNowModal" class="modal fade" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Order Product</h4>
			</div>
			<div class="modal-body">
				<p>
					<?= form_open('Product/view/'.$product['id'].'', array('class'=>'', 'role'=>'form')); ?>
					
						<input type="hidden" name="product_id" value="<?= $product['id']; ?>">
						
						<div class="row">
							<div class="col-md-6 mb10">
								<div class="form-group">
									<?= form_input('name', set_value('name'), array('class' => 'form-control', 'placeholder' => 'Full Name', 'required' => 'required', 'id' => 'order_name')); ?>
									<span class="red"><?= form_error('name'); ?></span>
								</div>
							</div>
							<div class="col-md-6 mb10"> 
								<div class="form-group">
									<?= form_input('email', set_value('email'), array('class' => 'form-control',  'placeholder' => 'Email', 'required' => 'required', 'id' => 'order_email')); ?>
									<span class="red"><?= form_error('email'); ?></span>
								</div>
							</div>
							<div class="col-md-6 mb10"> 
								<div class="form-group">
									<?= form_input('phone', set_value('phone'), array('class' => 'form-control', 'placeholder' => 'Phone', 'required' => 'required', 'id' => 'order_phone')); ?>
									<span class="red"><?= form_error('phone'); ?></span>
								</div>
							</div>
							<div class="col-md-6 mb10"> 
								<div class="form-group">
									<?= form_input('address', set_value('address'), array('class' => 'form-control', 'placeholder' => 'Address', 'required' => 'required', 'id' => 'order_address')); ?>
									<span class="red"><?= form_error('address'); ?></span>
								</div>
							</div>
							<div class="col-md-6 mb10"> 
								<div class="form-group">
									<?= form_input('city', set_value('city'), array('class' => 'form-control', 'placeholder' => 'City', 'required' => 'required', 'id' => 'order_city')); ?>
									<span class="red"><?= form_error('city'); ?></span>
								</div>
							</div>
							<div class="col-md-6 mb10"> 
								<div class="form-group">
									<?= form_input('state', set_value('state'), array('class' => 'form-control', 'placeholder' => 'State', 'required' => 'required', 'id' => 'order_state')); ?>
									<span class="red"><?= form_error('state'); ?></span>
								</div>
							</div>
							<div class="col-md-6 mb10"> 
								<div class="form-group">
									<?= form_input('country', set_value('country'), array('class' => 'form-control', 'placeholder' => 'Country', 'required' => 'required', 'id' => 'order_country')); ?>
									<span class="red"><?= form_error('country'); ?></span>
								</div>
							</div>
							<div class="col-md-6 mb10"> 
								<div class="form-group">
									<?= form_input('zipcode', set_value('zipcode'), array('class' => 'form-control', 'placeholder' => 'Zipcode', 'required' => 'required', 'id' => 'order_zipcode')); ?>
									<span class="red"><?= form_error('zipcode'); ?></span>
								</div>
							</div>
							<div class="col-md-6 mb10"> 
								<div class="form-group">
									<?= form_input('quantity', set_value('quantity'), array('class' => 'form-control', 'placeholder' => 'Quantity', 'required' => 'required', 'id' => 'order_quantity')); ?>
									<span class="red"><?= form_error('quantity'); ?></span>
								</div>
							</div>
							<div class="col-md-12 text-right"> 
								<div class="form-group">
									<?php
									$button = array(
										'type' => 'submit',
										'name' => 'order_now',
										'id' => 'order_now',
										'class' => 'btn btn-info',
										'value' => 'Order',
									);
									
									echo form_submit($button);
									?>
								</div>
							</div>
													
						<?= form_close(); ?>
					</div>
				</p>
			</div>
			<div class="modal-footer">
				&nbsp;
			</div>
		</div>

	</div>
</div>
