<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?= $this->breadcrumbs->show(); ?>
<div class="information-blocks">
	<div class="map-box type-2">
		<div id="map-canvas" data-lat="48.8579353" data-lng="2.2953856" data-zoom="17" style="overflow: hidden;"><div style="height: 100%; width: 100%; position: absolute; top: 0px; left: 0px; background-color: rgb(229, 227, 223);"><div class="gm-err-container"><div class="gm-err-content"><div class="gm-err-icon"><img src="http://maps.gstatic.com/mapfiles/api-3/images/icon_error.png" draggable="false" style="-moz-user-select: none;"></div><div class="gm-err-title">Oops! Something went wrong.</div><div class="gm-err-message">This page didn't load Google Maps correctly. See the JavaScript console for technical details.</div></div></div></div></div>
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
			<form>
				<div class="row">
					<div class="col-sm-6">
						<label>Your Name <span>*</span></label>
						<input class="simple-field" placeholder="Your name (required)" required="" value="" type="text">
						<div class="clear"></div>
					</div>
					<div class="col-sm-6">
						<label>Your Surname</label>
						<input class="simple-field" placeholder="Your surname" value="" type="text">
						<div class="clear"></div>
					</div>
					<div class="col-sm-12">
						<label>Your Email <span>*</span></label>
						<input class="simple-field" placeholder="Your email address (required)" required="" value="" type="email">
						<label>Your Message <span>*</span></label>
						<textarea class="simple-field" placeholder="Your message content (required)" required=""></textarea>
						<div class="button style-10">Send Message<input value="" type="submit"></div>
					</div>
				</div>
			</form>
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

