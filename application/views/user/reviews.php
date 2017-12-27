<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	$this->load->view('templates/_parts/public_master_user_profile_sidebar_view');
?>
		<div class="col-sm-9">
            <?= $this->breadcrumbs->show(); ?>
			<?php
			if(isset($_SESSION['success']))
            {
                ?>
                <div class="message-box message-success">
                    <div class="message-icon">
                        <i class="fa fa-check"></i>
                    </div>
                    <div class="message-text">
                        <b><?= $_SESSION['success']; ?></b>
                    </div>
                    <div class="message-close">
                        <i class="fa fa-times"></i>
                    </div>
                </div>

                <?php
            }
            if(isset($_SESSION['error']))
            {
                ?>
                <div class="message-box message-danger">
                    <div class="message-icon">
                        <i class="fa fa-check"></i>
                    </div>
                    <div class="message-text">
                        <b><?= $_SESSION['error']; ?></b>
                    </div>
                    <div class="message-close">
                        <i class="fa fa-times"></i>
                    </div>
                </div>

                <?php
            }
            ?>
			<div class="wishlist-header hidden-xs">
				<div class="title-1">Product Name</div>
				<div class="title-2">Reviews & Ratings</div>
			</div>
			<div class="wishlist-box">
				<div class="wishlist-entry">
					<div class="column-1">
						<div class="traditional-cart-entry">
							<a class="image" href="#"><img alt="" src="<?= base_url(); ?>frontend_assets/img/product-minimal-1.jpg"></a>
							<div class="content">
								<div class="cell-view">
									<a class="title" href="#">Pullover Batwing Sleeve Zigzag</a>
									<div class="inline-description">Comment</div>
									<a href="#"><span class="inline-label red">Write a Review</span></a>
								</div>
							</div>
						</div>
					</div>
					<div class="column-2 text-center">
						<i class="fa fa-star" aria-hidden="true"></i>
						<i class="fa fa-star" aria-hidden="true"></i>
						<i class="fa fa-star" aria-hidden="true"></i>
						<i class="fa fa-star" aria-hidden="true"></i>
						<i class="fa fa-star" aria-hidden="true"></i>
					</div>
				</div>
				<div class="wishlist-entry">
					<div class="column-1">
						<div class="traditional-cart-entry">
							<a class="image" href="#"><img alt="" src="<?= base_url(); ?>frontend_assets/img/product-minimal-1.jpg"></a>
							<div class="content">
								<div class="cell-view">
									<a class="title" href="#">Pullover Batwing Sleeve Zigzag</a>
									<div class="inline-description">Comment</div>
									<a href="#"><span class="inline-label red">Write a Review</span></a>
								</div>
							</div>
						</div>
					</div>
					<div class="column-2">
						<i class="fa fa-star" aria-hidden="true"></i>
						<i class="fa fa-star" aria-hidden="true"></i>
						<i class="fa fa-star" aria-hidden="true"></i>
						<i class="fa fa-star" aria-hidden="true"></i>
						<i class="fa fa-star" aria-hidden="true"></i>
					</div>
				</div>
				<div class="wishlist-entry">
					<div class="column-1">
						<div class="traditional-cart-entry">
							<a class="image" href="#"><img alt="" src="<?= base_url(); ?>frontend_assets/img/product-minimal-1.jpg"></a>
							<div class="content">
								<div class="cell-view">
									<a class="title" href="#">Pullover Batwing Sleeve Zigzag</a>
									<div class="inline-description">Comment</div>
									<a href="#"><span class="inline-label red">Write a Review</span></a>
								</div>
							</div>
						</div>
					</div>
					<div class="column-2 text-center">
						<i class="fa fa-star" aria-hidden="true"></i>
						<i class="fa fa-star" aria-hidden="true"></i>
						<i class="fa fa-star" aria-hidden="true"></i>
						<i class="fa fa-star" aria-hidden="true"></i>
						<i class="fa fa-star" aria-hidden="true"></i>
					</div>
				</div>
				<div class="wishlist-entry">
					<div class="column-1">
						<div class="traditional-cart-entry">
							<a class="image" href="#"><img alt="" src="<?= base_url(); ?>frontend_assets/img/product-minimal-1.jpg"></a>
							<div class="content">
								<div class="cell-view">
									<a class="title" href="#">Pullover Batwing Sleeve Zigzag</a>
									<div class="inline-description">Comment</div>
									<a href="#"><span class="inline-label red">Write a Review</span></a>
								</div>
							</div>
						</div>
					</div>
					<div class="column-2 text-center">
						<i class="fa fa-star" aria-hidden="true"></i>
						<i class="fa fa-star" aria-hidden="true"></i>
						<i class="fa fa-star" aria-hidden="true"></i>
						<i class="fa fa-star" aria-hidden="true"></i>
						<i class="fa fa-star" aria-hidden="true"></i>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>