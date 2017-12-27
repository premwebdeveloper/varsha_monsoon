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
			<div class="col-sm-9 information-entry">
				<h3 class="cart-column-title size-1">Products</h3>
				<div class="traditional-cart-entry style-1">
					<a class="image" href="#"><img alt="" src="<?= base_url(); ?>frontend_assets/img/product-minimal-1.jpg"></a>
					<div class="content">
						<div class="cell-view">
							<a class="tag" href="#">woman clothing</a>
							<a class="title" href="#">Pullover Batwing Sleeve Zigzag</a>
							<div class="inline-description">S / Dirty Pink</div>
							<div class="inline-description">Zigzag Clothing</div>
							<div class="price">
								<div class="prev">$199,99</div>
								<div class="current">$119,99</div>
							</div>
							<div class="quantity-selector detail-info-entry">
								<div class="detail-info-entry-title">Quantity</div>
								<div class="entry number-minus">&nbsp;</div>
								<div class="entry number">10</div>
								<div class="entry number-plus">&nbsp;</div>
								<a class="button style-17">remove</a>
								<a class="button style-15">Update Cart</a>
							</div>
						</div>
					</div>
				</div>
				<div class="traditional-cart-entry style-1">
					<a class="image" href="#"><img alt="" src="<?= base_url(); ?>frontend_assets/img/product-minimal-1.jpg"></a>
					<div class="content">
						<div class="cell-view">
							<a class="tag" href="#">woman clothing</a>
							<a class="title" href="#">Pullover Batwing Sleeve Zigzag</a>
							<div class="inline-description">S / Dirty Pink</div>
							<div class="inline-description">Zigzag Clothing</div>
							<div class="price">
								<div class="prev">$199,99</div>
								<div class="current">$119,99</div>
							</div>
							<div class="quantity-selector detail-info-entry">
								<div class="detail-info-entry-title">Quantity</div>
								<div class="entry number-minus">&nbsp;</div>
								<div class="entry number">10</div>
								<div class="entry number-plus">&nbsp;</div>
								<a class="button style-17">remove</a>
								<a class="button style-15">Update Cart</a>
							</div>
						</div>
					</div>
				</div>
				<div class="traditional-cart-entry style-1">
					<a class="image" href="#"><img alt="" src="<?= base_url(); ?>frontend_assets/img/product-minimal-1.jpg"></a>
					<div class="content">
						<div class="cell-view">
							<a class="tag" href="#">woman clothing</a>
							<a class="title" href="#">Pullover Batwing Sleeve Zigzag</a>
							<div class="inline-description">S / Dirty Pink</div>
							<div class="inline-description">Zigzag Clothing</div>
							<div class="price">
								<div class="prev">$199,99</div>
								<div class="current">$119,99</div>
							</div>
							<div class="quantity-selector detail-info-entry">
								<div class="detail-info-entry-title">Quantity</div>
								<div class="entry number-minus">&nbsp;</div>
								<div class="entry number">10</div>
								<div class="entry number-plus">&nbsp;</div>
								<a class="button style-17">remove</a>
								<a class="button style-15">Update Cart</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-3 information-entry">
				<h3 class="cart-column-title size-1" style="text-align: center;">Subtotal</h3>
				<div class="sidebar-subtotal">
					<div class="price-data">
						<div class="main">$129.99</div>
						<div class="title">Excluding tax &amp; shipping</div>
						<div class="subtitle">ORDERS WILL BE PROCESSED IN USD</div>
					</div>
					<div class="additional-data">
						<div class="title"><span class="inline-label red">Promotion</span> Additional Notes</div>
						<textarea class="simple-field size-1"></textarea>
						<a class="button style-10">Checkout</a>
					</div>
				</div>
				<div class="block-title size-1">Get shipping estimates</div>
				<form>
					<label>Country</label>
					<div class="simple-drop-down simple-field size-1">
						<select>
							<option>United States</option>
							<option>Great Britain</option>
							<option>Canada</option>
						</select>
					</div>
					<label>State</label>
					<div class="simple-drop-down simple-field size-1">
						<select>
							<option>Alabama</option>
							<option>Alaska</option>
							<option>Idaho</option>
						</select>
					</div>
					<label>Zip Code</label>
					<input value="" placeholder="Zip Code" class="simple-field size-1" type="text">
					<div class="button style-16" style="display: block; margin-top: 10px;">calculate shipping<input type="submit"></div>
				</form>
			</div>
		</div>

	</div>
</div>
<div class="col-sm-12 information-blocks">
	<div class="row">
		<div class="information-entry col-md-6">
			<div class="sale-entry">
				<div class="hot-mark red">hot</div>
				<div class="sale-price"><span>-40%</span> winter Sale</div>
				<div class="sale-description">Lorem ipsum dolor sit amet, consectetur adipisc elit, sed do</div>
			</div>
		</div>
		<div class="information-entry col-md-6">
			<div class="sale-entry">
				<div class="hot-mark red">hot</div>
				<div class="sale-price"><span>FREE</span> UK delivery</div>
				<div class="sale-description">Lorem ipsum dolor sit amet, consectetur adipisc elit, sed do</div>
			</div>
		</div>
	</div>
</div>