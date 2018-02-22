<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?= $this->breadcrumbs->show(); ?>
<script>
  function initMap() {
    var uluru = {lat: 26.959856, lng: 75.778368};
    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 16,
      center: uluru
    });
    var marker = new google.maps.Marker({
      position: uluru,
      map: map
    });
  }
</script>
<div class="information-blocks">
	<div class="map-box type-2">
		<div id="map-canvas" data-lat="48.8579353" data-lng="2.2953856" data-zoom="17" style="overflow: hidden;">
			<div style="height: 100%; width: 100%; position: absolute; top: 0px; left: 0px; background-color: rgb(229, 227, 223);">
				<div class="gm-err-container">
					<div class="gm-err-content">
						<div id="map" style="height: 501px;"></div>
					</div>
				</div>
			</div>
		</div>
		<div class="addresses-block">
			<a data-lat="48.8579353" data-lng="2.2953856" data-string="1. Here is some address or email or phone or something else..."></a>
			<a data-lat="48.8583694" data-lng="2.2960132" data-string="2. Here is some address or email or phone or something else..."></a>
		</div>
	</div>
	<div class="map-overlay-info">
		<div class="article-container style-1">
			<div class="cell-view">
				<h5>Company address</h5>
				<p>8808 Ave Dermentum, Onsectetur Adipiscing<br>
				Tortor Sagittis, CA 880986,<br>
				United States<br>
				CA 90896<br>
				United States<br></p>
				<h5>Contact Informations</h5>
				<p>Email: stores@domain.com<br>
				Toll-free: (1800) 000 8808</p>
			</div>
		</div>
	</div>
	<div class="clear"></div>
	<div class="row">
		<div class="col-md-8 information-entry">
			<h3 class="block-title main-heading">Drop Us A Line</h3>
			<?php   # If the session message is set then print message
            if(!is_null($this->session->flashdata('message')))
            {
                ?>
                <div class="alert alert-info alert-dismissable">
                    <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                    <?= $this->session->flashdata('message'); ?>
                </div>
                <?php
            }
            ?>
			<?= form_open_multipart("Contact", '', array('role' => 'from', )); ?>
				<div class="row">
					<div class="col-sm-6">
						<label>Your Name <span>*</span></label>
						<input class="simple-field" name="name" placeholder="Your name (required)" required="required" value="" type="text">
						<span class="red"><?= form_error('name'); ?></span>
						<div class="clear"></div>
					</div>
					<div class="col-sm-6">
						<label>Your Phone Number <span>*</span></label>
						<input class="simple-field" name="phone" minlength="10" maxlength="10" required="required" placeholder="Your phone number (required)" value="" type="number">
						<span class="red"><?= form_error('phone'); ?></span>
						<div class="clear"></div>
					</div>
					<div class="col-sm-12">
						<label>Your Email <span>*</span></label>
						<input class="simple-field" name="email" placeholder="Your valid email address (required)" required="required" value="" type="email">
						<span class="red"><?= form_error('email'); ?></span>

						<label>Your Message <span>*</span></label>
						<textarea class="simple-field" name="message" placeholder="Your message content (required)" required="required"></textarea>
						<span class="red"><?= form_error('message'); ?></span>
						<div class="button style-10">Send Message<input value="" type="submit"></div>
					</div>
				</div>
			<?= form_close(); ?>
		</div>
		<div class="col-md-4 information-entry">
			<h3 class="block-title main-heading">Let's Stay In Touch</h3>
			<div class="article-container style-1">
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, eiusmod tempor incididunt ut labore et dolore magna aliqua. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae.</p>
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

