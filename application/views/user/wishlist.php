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
                unset($_SESSION['error']);
            }
            ?>
			<div class="wishlist-header hidden-xs">
				<div class="title-1">Product Name</div>
				<div class="title-2">Purchase Product</div>
			</div>
			<div class="wishlist-box">
				<div class="wishlist-entry">
					<div class="column-1">
						<div class="traditional-cart-entry">
							<a class="image" href="#"><img alt="" src="<?= base_url(); ?>frontend_assets/img/product-minimal-1.jpg"></a>
							<div class="content">
								<div class="cell-view">
									<a class="tag" href="#">woman clothing</a>
									<a class="title" href="#">Pullover Batwing Sleeve Zigzag</a>
									<div class="inline-description">S / Dirty Pink</div>
									<div class="inline-description">Zigzag Clothing</div>
								</div>
							</div>
						</div>
					</div>
					<div class="column-2">
						<a class="button style-14">add to cart</a>
						<a class="remove-button"><i class="fa fa-times"></i></a>
					</div>
				</div>
				<div class="wishlist-entry">
					<div class="column-1">
						<div class="traditional-cart-entry">
							<a class="image" href="#"><img alt="" src="<?= base_url(); ?>frontend_assets/img/product-minimal-1.jpg"></a>
							<div class="content">
								<div class="cell-view">
									<a class="tag" href="#">woman clothing</a>
									<a class="title" href="#">Pullover Batwing Sleeve Zigzag</a>
									<div class="inline-description">S / Dirty Pink</div>
									<div class="inline-description">Zigzag Clothing</div>
								</div>
							</div>
						</div>
					</div>
					<div class="column-2">
						<a class="button style-14">add to cart</a>
						<a class="remove-button"><i class="fa fa-times"></i></a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>