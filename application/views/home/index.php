<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="content-push">

	<div class="information-blocks">
		<div class="mozaic-banners-wrapper">
			<div class="row">
				<div class="banner-column col-md-6">

					<div class="mozaic-swiper">
						<div class="swiper-container" data-autoplay="3000" data-loop="1" data-speed="500" data-center="0" data-slides-per-view="1">
							<div class="swiper-wrapper">
								<?php
								foreach ($slider as $value)
								{
								?>
									<div class="swiper-slide">
										<div class="mozaic-banner-entry type-1" style="background-image: url(<?= base_url(); ?>frontend_assets/img/<?= $value['image']; ?>);">
											<div class="mozaic-banner-content">
												<h3 class="subtitle">Only Here</h3>
												<h2 class="title"><?= $value['title']; ?></h2>
												<div class="description"><?= $value['description']; ?></div>
												<a class="button style-2" href="#">shop now</a>
											</div>
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
				<?php
				foreach ($ads as $ad)
				{
					if($ad['status'] == 1)
					{
					?>
					<div class="banner-column col-md-3 col-sm-6">
						<div class="mozaic-banner-entry type-1" style="background-image: url(<?= base_url(); ?>frontend_assets/img/<?= $ad['image']; ?>);">
							<div class="mozaic-banner-content">
								<h3 class="subtitle"><?= $ad['title']; ?></h3>
								<h2 class="title">₹<?= $ad['price']; ?></h2>
								<div class="description"><?= $ad['description']; ?></div>
								<a class="button style-2" href="#">shop now</a>
							</div>
						</div>
					</div>
					<?php
					}
				}
				?>
			</div>
		</div>
	</div>

	<div class="information-blocks">
        <div class="row">
            <?php
			foreach ($ads as $ad)
			{
				if($ad['status'] == 2)
				{
				?>
            	<div class="information-entry col-md-6">
	                <div class="sale-entry">
	                    <div class="hot-mark red">hot</div>
	                    <div class="sale-price">
	                    	<img src="<?= base_url(); ?>frontend_assets/img/<?= $ad['image']; ?>" alt="" style="height:115px;" />
	                    </div>
	                    <div class="sale-description">
	                    	<h4 class="blue_color text_bold" style="font-size: 22px;"><?= $ad['title']; ?></h4>
	                    	<?= $ad['description']; ?></div>
	                </div>
	            </div>
	            <?php
				}
			}
			?>
        </div>
    </div>
	<div class="information-blocks">
		<div class="tabs-container">
			<div class="swiper-tabs tabs-switch">
				<div class="title">Products</div>
				<div class="list">
					<a class="block-title tab-switcher active">New Arrivals</a>
					<div class="clear"></div>
				</div>
			</div>
			<div>
				<div class="tabs-entry">
					<div class="products-swiper">
						<div class="swiper-container" data-autoplay="0" data-loop="0" data-speed="500" data-center="0" data-slides-per-view="responsive" data-xs-slides="2" data-int-slides="2" data-sm-slides="3" data-md-slides="4" data-lg-slides="5" data-add-slides="5">
							<div class="swiper-wrapper">
								<?php
								$i = 0;
								foreach($products as $list)
								{
									// Get product images
									$images = $this->Products_Model->getProductImages($list['id']);
									if($i > 10)
									{
										break;
									}
								?>
								<div class="swiper-slide">
									<div class="paddings-container">
										<div class="product-slide-entry style_border">
											<div class="product-image">
												<a href="<?= site_url('product/view'); ?>/<?= $list['id']; ?>">
													<img src="<?= base_url(); ?>uploads/products/<?= $images[0]['image']; ?>" alt="" style="height:225px;" />
												</a>
											</div>
											<a class="title" href="<?= site_url('product/view'); ?>/<?= $list['id']; ?>">
												<?= $list['name']; ?>
											</a>
											<p class="tag"><?= $list['brand']; ?></p>
											<div class="price">
												<div class="prev">
													<i class="fa fa-inr" aria-hidden="true"></i><?= $list['price2']; ?>
												</div>
												<div class="current">
													<i class="fa fa-inr" aria-hidden="true"></i>
													<?= $list['price1']; ?>
												</div>
											</div>
										</div>
									</div>
								</div>
								<?php
								$i++;
								}
								?>
							</div>
							<div class="pagination"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="information-blocks">
		<div class="tabs-container pt20">
			<div>
				<div class="tabs-entry">
					<div class="products-swiper">
						<div class="swiper-container" data-autoplay="0" data-loop="0" data-speed="500" data-center="0" data-slides-per-view="responsive" data-xs-slides="2" data-int-slides="2" data-sm-slides="3" data-md-slides="3" data-lg-slides="4" data-add-slides="4">
							<div class="swiper-wrapper">
								<?php
								$i = 0;
								foreach($brands as $brand)
								{
									if($i > 10)
									{
										break;
									}
								?>
								<div class="swiper-slide">
									<div class="product-column-entry product-slide-entry pt0" style="max-width: 250px;">
										<div class="product-image"><img src="<?= base_url(); ?>uploads/brand_image/<?= $brand['image']; ?>" alt="" /></div>
										<h3 class="title"><?= $brand['brand']; ?></h3>
										<div class="hot-mark">Brand</div>
									</div>
								</div>

								<?php
								$i++;
								}
								?>
							</div>
							<div class="pagination"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<hr>