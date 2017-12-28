<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<nav class="navbar-default navbar-static-side" role="navigation">
	<div class="sidebar-collapse">
		<ul class="nav metismenu" id="side-menu">
			<li class="nav-header" style="background-color: #1ab394;">
				<div class="dropdown profile-element"> <span>
					<img alt="image" class="img-circle" src="<?= base_url(); ?>assets/img/profile_small.png" />
					 </span>
					<a data-toggle="dropdown" class="dropdown-toggle" href="#">
					<span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">Administrator</strong>
					 </span> <span class="text-muted text-xs block">Menu<b class="caret"></b></span> </span> </a>
					<ul class="dropdown-menu animated fadeInRight m-t-xs">
						<!-- <li><a href="javascript:;">Profile</a></li>
						<li><a href="<?= site_url('Settings'); ?>">Settings</a></li> -->
						<li><a href="javascript:;"  data-toggle="modal" data-target="#myModal">Change Password</a></li>
						<li><a href="<?= site_url('auth/logout'); ?>">Logout</a></li>
					</ul>
				</div>
				<div class="logo-element">
					KhaoSAA
				</div>
			</li>

			<li>
				<a href="<?= site_url('Dashboard'); ?>"><i class="fa fa-diamond"></i>
					<span class="nav-label">Dashboard</span>
				</a>
			</li>

			<li>
				<a href="<?= site_url('User'); ?>"><i class="fa fa-group"></i>
					<span class="nav-label">Users</span>
				</a>
			</li>

			<li>
				<a href="<?= site_url('Brands'); ?>"><i class="fa fa-outdent"></i>
					<span class="nav-label">Brands</span>
				</a>
			</li>

			<li>
				<a href="<?= site_url('Categories'); ?>"><i class="fa fa-outdent"></i>
					<span class="nav-label">Categories</span>
				</a>
			</li>

			<li>
				<a href="<?= site_url('Sub_Categories'); ?>"><i class="fa fa-outdent"></i>
					<span class="nav-label">Sub Categories</span>
				</a>
			</li>

			<li>
				<a href="<?= site_url('Admin/food_category'); ?>"><i class="fa fa-outdent"></i>
					<span class="nav-label">Food Categories</span>
				</a>
			</li>

			<li>
				<a href="<?= site_url('Food_Listings'); ?>"><i class="fa fa-bars"></i>
					<span class="nav-label">Food Listings</span>
				</a>
			</li>

		</ul>

	</div>
</nav>