<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="content-push">

	<div class="information-blocks">
		<div class="mozaic-banners-wrapper">
			<div class="row">
				<div class="banner-column col-md-6">

					<div class="mozaic-swiper">
						<div class="swiper-container" data-autoplay="0" data-loop="1" data-speed="500" data-center="0" data-slides-per-view="1">
							<div class="swiper-wrapper">
								<div class="swiper-slide">
									<div class="mozaic-banner-entry type-1" style="background-image: url(<?= base_url(); ?>frontend_assets/img/banner1.jpg);">
										<div class="mozaic-banner-content">
											<h3 class="subtitle">Vegetables</h3>
											<h2 class="title">Big Sales</h2>
											<div class="description">Lorem ipsum dolor sit amet, consectetur elit, sed do eiusmod tempor.</div>
											<a class="button style-2" href="#">shop now</a>
										</div>
									</div>
								</div>
								<div class="swiper-slide">
									<div class="mozaic-banner-entry type-1" style="background-image: url(<?= base_url(); ?>frontend_assets/img/banner2.jpg);">
										<div class="mozaic-banner-content">
											<h3 class="subtitle">French fries</h3>
											<h2 class="title">Big Sales</h2>
											<div class="description">Lorem ipsum dolor sit amet, consectetur elit, sed do eiusmod tempor.</div>
											<a class="button style-2" href="#">shop now</a>
										</div>
									</div>
								</div>
								<div class="swiper-slide">
									<div class="mozaic-banner-entry type-1" style="background-image: url(<?= base_url(); ?>frontend_assets/img/banner3.jpg);">
										<div class="mozaic-banner-content">
											<h3 class="subtitle">Egzocit Fruits</h3>
											<h2 class="title">Big Sales</h2>
											<div class="description">Lorem ipsum dolor sit amet, consectetur elit, sed do eiusmod tempor.</div>
											<a class="button style-2" href="#">shop now</a>
										</div>
									</div>
								</div>
							</div>
							<div class="pagination"></div>
						</div>
					</div>
				</div>
				<div class="banner-column col-md-3 col-sm-6">
					<div class="mozaic-banner-entry type-1" style="background-image: url(<?= base_url(); ?>frontend_assets/img/mozaic-banner-2.jpg);">
						<div class="mozaic-banner-content">
							<h3 class="subtitle">Nutts from</h3>
							<h2 class="title">$19,99</h2>
							<div class="description">Lorem ipsum dolor sit amet, elit, sed do eiusmod.</div>
							<a class="button style-2" href="#">shop now</a>
						</div>
					</div>
				</div>
				<div class="banner-column col-md-3 col-sm-6">
					<div class="mozaic-banner-entry type-1" style="background-image: url(<?= base_url(); ?>frontend_assets/img/mozaic-banner-2.jpg);">
						<div class="mozaic-banner-content">
							<h3 class="subtitle">Meat from</h3>
							<h2 class="title">$12,59</h2>
							<div class="description">Lorem ipsum dolor sit amet, elit, sed do eiusmod.</div>
							<a class="button style-2" href="#">shop now</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="information-blocks">
        <div class="row">
            <div class="information-entry col-md-6">
                <div class="sale-entry">
                    <div class="hot-mark red">hot</div>
                    <div class="sale-price"><span class="blue_color">50% </span><span class="yellow">Cash Back</span>Via Paytm</div>
                    <div class="sale-description">Lorem ipsum dolor sit amet, consectetur adipisc elit, sed do eiusmod tempor incididunt ut labore consectetur adipisc.</div>
                </div>
            </div>
            <div class="information-entry col-md-6">
                <div class="sale-entry">
                    <div class="hot-mark red">hot</div>
                    <div class="sale-price"><span class="blue_color">-20%</span> FREE UK DELIVERY</div>
                    <div class="sale-description">Lorem ipsum dolor sit amet, consectetur adipisc elit, sed do eiusmod tempor incididunt ut labore consectetur adipisc.</div>
                </div>
            </div>
        </div>
    </div>
	<div class="information-blocks">
		<div class="tabs-container">
			<div class="swiper-tabs tabs-switch">
				<div class="title">Products</div>
				<div class="list">
					<a class="block-title tab-switcher active">Popular Products</a>
					<a class="block-title tab-switcher">New Arrivals</a>
					<div class="clear"></div>
				</div>
			</div>
			<div>
				<div class="tabs-entry">
					<div class="products-swiper">
						<div class="swiper-container" data-autoplay="0" data-loop="0" data-speed="500" data-center="0" data-slides-per-view="responsive" data-xs-slides="2" data-int-slides="2" data-sm-slides="3" data-md-slides="4" data-lg-slides="5" data-add-slides="5">
							<div class="swiper-wrapper">
								<?php
								foreach($listing as $list)
								{
								?>
								<div class="swiper-slide">
									<div class="paddings-container">
										<div class="product-slide-entry style_border">
											<div class="product-image">
												<a href="<?= site_url('product/view'); ?>/<?= $list['id']; ?>">
													<img src="<?= base_url(); ?>uploads/listingImage/<?= $list['user_id']; ?>/<?= $list['image']; ?>" alt="" />
												</a>
											</div>
											<a class="title" href="<?= site_url('product/view'); ?>/<?= $list['id']; ?>"><?= $list['food_name']; ?></a>
											<p class="tag"><?= $list['types']; ?></p>
											<div class="rating-box">
												<div class="star"><i class="fa fa-star-o"></i></div>
												<div class="star"><i class="fa fa-star-o"></i></div>
												<div class="star"><i class="fa fa-star-o"></i></div>
												<div class="star"><i class="fa fa-star-o"></i></div>
												<div class="star"><i class="fa fa-star-o"></i></div>
											</div>
											<div class="price">
												<div class="prev">$199,99</div>
												<div class="current"><i class="fa fa-inr" aria-hidden="true"></i><?= $list['price']; ?></div>
											</div>
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
				<div class="tabs-entry">
					<div class="products-swiper">
						<div class="swiper-container" data-autoplay="0" data-loop="0" data-speed="500" data-center="0" data-slides-per-view="responsive" data-xs-slides="2" data-int-slides="2" data-sm-slides="3" data-md-slides="4" data-lg-slides="5" data-add-slides="5">
							<div class="swiper-wrapper">
								<?php
								foreach($listing as $list)
								{
								?>
								<div class="swiper-slide">
									<div class="paddings-container">
										<div class="product-slide-entry style_border">
											<div class="product-image">
												<a href="<?= site_url('product/view'); ?>/<?= $list['id']; ?>">
													<img src="<?= base_url(); ?>uploads/listingImage/<?= $list['user_id']; ?>/<?= $list['image']; ?>" alt="" />
												</a>
											</div>
											<a class="title" href="<?= site_url('product/view'); ?>/<?= $list['id']; ?>"><?= $list['food_name']; ?></a>
											<p class="tag"><?= $list['types']; ?></p>							<div class="rating-box">
												<div class="star"><i class="fa fa-star-o"></i></div>
												<div class="star"><i class="fa fa-star-o"></i></div>
												<div class="star"><i class="fa fa-star-o"></i></div>
												<div class="star"><i class="fa fa-star-o"></i></div>
												<div class="star"><i class="fa fa-star-o"></i></div>
											</div>
											<div class="price">
												<div class="prev">$199,99</div>
												<div class="current"><i class="fa fa-inr" aria-hidden="true"></i><?= $list['price']; ?></div>
											</div>
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
			</div>
		</div>
	</div>

	<div class="information-blocks">
		<div class="row">
			<div class="col-sm-6 col-md-3 information-entry food-category">
				<div class="product-column-entry">
					<div class="image"><img src="<?= base_url(); ?>frontend_assets/img/product-food-6.jpg" alt="" /></div>
					<h3 class="title">Vegetables category</h3>
					<div class="description">
						<ul class="list-type-1">
							<li><a href="#"><i class="fa fa-angle-right"></i>Evening dresses</a></li>
							<li><a href="#"><i class="fa fa-angle-right"></i>Jackets and coats</a></li>
							<li><a href="#"><i class="fa fa-angle-right"></i>Tops and Sweatshirts</a></li>
							<li><a href="#"><i class="fa fa-angle-right"></i>Blouses and shirts</a></li>
							<li><a href="#"><i class="fa fa-angle-right"></i>Trousers and Shorts</a></li>
						</ul>
					</div>
					<div class="hot-mark">hot</div>
				</div>
			</div>
			<div class="col-sm-6 col-md-3 information-entry food-category">
				<div class="product-column-entry">
					<div class="image"><img src="<?= base_url(); ?>frontend_assets/img/product-food-7.jpg" alt="" /></div>
					<h3 class="title">Small agd category</h3>
					<div class="description">
						<ul class="list-type-1">
							<li><a href="#"><i class="fa fa-angle-right"></i>Evening dresses</a></li>
							<li><a href="#"><i class="fa fa-angle-right"></i>Jackets and coats</a></li>
							<li><a href="#"><i class="fa fa-angle-right"></i>Tops and Sweatshirts</a></li>
							<li><a href="#"><i class="fa fa-angle-right"></i>Blouses and shirts</a></li>
							<li><a href="#"><i class="fa fa-angle-right"></i>Trousers and Shorts</a></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="clear hidden-lg hidden-md"></div>
			<div class="col-sm-6 col-md-3 information-entry food-category">
				<div class="product-column-entry">
					<div class="image"><img src="<?= base_url(); ?>frontend_assets/img/product-food-8.jpg" alt="" /></div>
					<h3 class="title">Vegetables category</h3>
					<div class="description">
						<ul class="list-type-1">
							<li><a href="#"><i class="fa fa-angle-right"></i>Evening dresses</a></li>
							<li><a href="#"><i class="fa fa-angle-right"></i>Jackets and coats</a></li>
							<li><a href="#"><i class="fa fa-angle-right"></i>Tops and Sweatshirts</a></li>
							<li><a href="#"><i class="fa fa-angle-right"></i>Blouses and shirts</a></li>
							<li><a href="#"><i class="fa fa-angle-right"></i>Trousers and Shorts</a></li>
						</ul>
					</div>
					<div class="hot-mark yellow">sale</div>
				</div>
			</div>
			<div class="col-sm-6 col-md-3 information-entry food-category">
				<div class="product-column-entry">
					<div class="image"><img src="<?= base_url(); ?>frontend_assets/img/product-food-9.jpg" alt="" /></div>
					<h3 class="title">Phones category</h3>
					<div class="description">
						<ul class="list-type-1">
							<li><a href="#"><i class="fa fa-angle-right"></i>Evening dresses</a></li>
							<li><a href="#"><i class="fa fa-angle-right"></i>Jackets and coats</a></li>
							<li><a href="#"><i class="fa fa-angle-right"></i>Tops and Sweatshirts</a></li>
							<li><a href="#"><i class="fa fa-angle-right"></i>Blouses and shirts</a></li>
							<li><a href="#"><i class="fa fa-angle-right"></i>Trousers and Shorts</a></li>
						</ul>
					</div>
					<div class="hot-mark">hot</div>
				</div>
			</div>
		</div>
	</div>

	<div class="information-blocks">
		<div class="row">
			<div class="col-md-4 information-entry">
				<h3 class="block-title">From The Blog</h3>
				<div class="from-the-blog-entry">
					<a href="#" class="image hover-class-1"><img src="<?= base_url(); ?>frontend_assets/img/from-the-blog-thumbnail.jpg" alt=""><span class="hover-label">Read More</span></a>
					<div class="description">Lorem ipsum dolor sit amet, consectetur adipiscing elit, eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit.</div>
					<div class="clear"></div>
				</div>
			</div>
			<div class="col-md-4 information-entry">
				<h3 class="block-title">Company Services</h3>
				<ol class="list-type-2">
					<li>Lorem ipsum dolor sit amet, consectetur adipiscing elit, eiusmod tempor incididunt ut labore et dolore.</li>
					<li>Ut enim ad minim veniam, nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</li>
					<li>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</li>
				</ol>
			</div>
			<div class="col-md-4 information-entry">
				<h3 class="block-title">Latest Reviews</h3>
				<div class="swiper-container blockquote-slider" data-autoplay="0" data-loop="0" data-speed="500" data-center="0" data-slides-per-view="1">
					<div class="swiper-wrapper">
						<div class="swiper-slide">
							<blockquote class="latest-review">
								<div class="text">"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation"</div>
								<footer><cite>Helen Smith</cite>, 25 minutes ago</footer>
							</blockquote>
						</div>
						<div class="swiper-slide">
							<blockquote class="latest-review">
								<div class="text">"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation"</div>
								<footer><cite>Helen Smith</cite>, 25 minutes ago</footer>
							</blockquote>
						</div>
						<div class="swiper-slide">
							<blockquote class="latest-review">
								<div class="text">"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation"</div>
								<footer><cite>Helen Smith</cite>, 25 minutes ago</footer>
							</blockquote>
						</div>
					</div>
					<div class="pagination"></div>
				</div>
			</div>
		</div>
	</div>

	<div class="information-blocks">
		<div class="row">
			<div class="col-sm-4 information-entry">
				<h3 class="block-title inline-product-column-title">Featured products</h3>
				<div class="inline-product-entry">
					<a class="image" href="#"><img src="<?= base_url(); ?>frontend_assets/img/product-image-inline-16.jpg" alt="" /></a>
					<div class="content">
						<div class="cell-view">
							<a class="title" href="#">Ladies Pullover Batwing Sleeve Zigzag</a>
							<div class="price">
								<div class="prev">$199,99</div>
								<div class="current">$119,99</div>
							</div>
						</div>
					</div>
					<div class="clear"></div>
				</div>

				<div class="inline-product-entry">
					<a class="image" href="#"><img src="<?= base_url(); ?>frontend_assets/img/product-image-inline-17.jpg" alt="" /></a>
					<div class="content">
						<div class="cell-view">
							<a class="title" href="#">Ladies Pullover Batwing Sleeve Zigzag</a>
							<div class="price">
								<div class="prev">$199,99</div>
								<div class="current">$119,99</div>
							</div>
						</div>
					</div>
					<div class="clear"></div>
				</div>

				<div class="inline-product-entry">
					<a class="image" href="#"><img src="<?= base_url(); ?>frontend_assets/img/product-image-inline-18.jpg" alt="" /></a>
					<div class="content">
						<div class="cell-view">
							<a class="title" href="#">Ladies Pullover Batwing Sleeve Zigzag</a>
							<div class="price">
								<div class="prev">$199,99</div>
								<div class="current">$119,99</div>
							</div>
						</div>
					</div>
					<div class="clear"></div>
				</div>
			</div>
			<div class="col-sm-4 information-entry">
				<h3 class="block-title inline-product-column-title">Featured products</h3>
				<div class="inline-product-entry">
					<a class="image" href="#"><img src="<?= base_url(); ?>frontend_assets/img/product-image-inline-19.jpg" alt="" /></a>
					<div class="content">
						<div class="cell-view">
							<a class="title" href="#">Ladies Pullover Batwing Sleeve Zigzag</a>
							<div class="price">
								<div class="prev">$199,99</div>
								<div class="current">$119,99</div>
							</div>
						</div>
					</div>
					<div class="clear"></div>
				</div>

				<div class="inline-product-entry">
					<a class="image" href="#"><img src="<?= base_url(); ?>frontend_assets/img/product-image-inline-20.jpg" alt="" /></a>
					<div class="content">
						<div class="cell-view">
							<a class="title" href="#">Ladies Pullover Batwing Sleeve Zigzag</a>
							<div class="price">
								<div class="prev">$199,99</div>
								<div class="current">$119,99</div>
							</div>
						</div>
					</div>
					<div class="clear"></div>
				</div>

				<div class="inline-product-entry">
					<a class="image" href="#"><img src="<?= base_url(); ?>frontend_assets/img/product-image-inline-21.jpg" alt="" /></a>
					<div class="content">
						<div class="cell-view">
							<a class="title" href="#">Ladies Pullover Batwing Sleeve Zigzag</a>
							<div class="price">
								<div class="prev">$199,99</div>
								<div class="current">$119,99</div>
							</div>
						</div>
					</div>
					<div class="clear"></div>
				</div>
			</div>
			<div class="col-sm-4 information-entry">
				<h3 class="block-title inline-product-column-title">Featured products</h3>
				<div class="inline-product-entry">
					<a class="image" href="#"><img src="<?= base_url(); ?>frontend_assets/img/product-image-inline-22.jpg" alt="" /></a>
					<div class="content">
						<div class="cell-view">
							<a class="title" href="#">Ladies Pullover Batwing Sleeve Zigzag</a>
							<div class="price">
								<div class="prev">$199,99</div>
								<div class="current">$119,99</div>
							</div>
						</div>
					</div>
					<div class="clear"></div>
				</div>

				<div class="inline-product-entry">
					<a class="image" href="#"><img src="<?= base_url(); ?>frontend_assets/img/product-image-inline-23.jpg" alt="" /></a>
					<div class="content">
						<div class="cell-view">
							<a class="title" href="#">Ladies Pullover Batwing Sleeve Zigzag</a>
							<div class="price">
								<div class="prev">$199,99</div>
								<div class="current">$119,99</div>
							</div>
						</div>
					</div>
					<div class="clear"></div>
				</div>

				<div class="inline-product-entry">
					<a class="image" href="#"><img src="<?= base_url(); ?>frontend_assets/img/product-image-inline-24.jpg" alt="" /></a>
					<div class="content">
						<div class="cell-view">
							<a class="title" href="#">Ladies Pullover Batwing Sleeve Zigzag</a>
							<div class="price">
								<div class="prev">$199,99</div>
								<div class="current">$119,99</div>
							</div>
						</div>
					</div>
					<div class="clear"></div>
				</div>
			</div>
		</div>
	</div>