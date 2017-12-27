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
			<div class="col-sm-12">
				<div class="newsletter-join" style="padding: 18px 16px 6px;">
					<div class="button style-12">Order Id<input value="" type="submit"></div>
					<div class="button text-right">Track<input value="" type="submit"></div>
				</div>
				<div class="newsletter-join" style="padding: 18px 25px;">
					<div class="row">
						<div class="col-sm-6 information-entry-xs">
							<div class="cell-view">
								<h3 class="title">Join our newsletter</h3>
								<div class="description">Lorem ipsum dolor sit amet, consectetur adipisc eiusmod. Lorem ipsum dolor sit amet.</div>
							</div>
						</div>
						<div class="col-sm-6 information-entry-xs">
							<div class="cell-view">
								<div class="simple-search-form">
									<form>
										<input placeholder="Search for product" type="text">
										<div class="simple-submit">
											<i class="fa fa-plus"></i>
											<input type="submit">
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
					<div class="row"  style="padding: 18px 25px;">
						<div class="information-blocks categories-border-wrapper">

						</div>
                    </div>
				</div>
			</div>
		</div>
	</div>
</div>
