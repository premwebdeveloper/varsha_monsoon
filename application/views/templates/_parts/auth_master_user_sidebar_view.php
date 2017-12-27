<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<nav class="navbar-default navbar-static-side" role="navigation">
	<div class="sidebar-collapse">
		<ul class="nav metismenu" id="side-menu">

			<li class="nav-header">
				<div class="dropdown profile-element"> <span>
					<img alt="image" class="img-circle" src="<?= base_url(); ?>assets/img/profile_small.jpg" />
					 </span>
					<a data-toggle="dropdown" class="dropdown-toggle" href="#">
					<span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">David Williams</strong>
					 </span> <span class="text-muted text-xs block">Art Director <b class="caret"></b></span> </span> </a>
					<ul class="dropdown-menu animated fadeInRight m-t-xs">
						<li><a href="profile.html">Profile</a></li>
						<li><a href="javascript:;" data-toggle="modal" data-target="#myModal">Change Password</a></li>
						<li><a href="mailbox.html">Mailbox</a></li>
						<li class="divider"></li>
						<li><a href="<?= site_url('auth/logout'); ?>">Logout</a></li>
					</ul>
				</div>
				<div class="logo-element">
					IN+
				</div>
			</li>

			<li>
				<a href="layouts.html"><i class="fa fa-diamond"></i> <span class="nav-label">Layouts1</span></a>
			</li>

			<li class="special_link">
				<a href="package.html"><i class="fa fa-database"></i> <span class="nav-label">Package</span></a>
			</li>

			<li>
				<a href="layouts.html"><i class="fa fa-diamond"></i> <span class="nav-label">Layouts3</span></a>
			</li>

			<li class="special_link">
				<a href="package.html"><i class="fa fa-database"></i> <span class="nav-label">Package</span></a>
			</li>

		</ul>

	</div>
</nav>
