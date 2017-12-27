<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html><meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="format-detection" content="telephone=no" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no, minimal-ui"/>

    <script src="<?= base_url(); ?>frontend_assets/js/jquery-2.1.3.min.js"></script>
    <script src="<?= base_url(); ?>frontend_assets/js/bootstrap.min.js"></script>

    <!-- Angular js script -->
	<script src="<?= base_url(); ?>frontend_assets/js/angular.min.js"></script>

    <link href="<?= base_url(); ?>frontend_assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url(); ?>frontend_assets/css/idangerous.swiper.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url(); ?>frontend_assets/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url(); ?>frontend_assets/css/font_family.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url(); ?>frontend_assets/css/style.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url(); ?>frontend_assets/css/custom.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url(); ?>frontend_assets/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
    <link href="<?= base_url(); ?>frontend_assets/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />

	<!-- Jquery Validation Engine css -->
	<link rel="stylesheet" href="<?= base_url(); ?>frontend_assets/js/jquery_validation_engine/validationEngine.jquery.css">

    <link rel="shortcut icon" href="<?= base_url(); ?>frontend_assets/img/favicon-2.ico" />

  	<title>Food Management</title>
</head>
<body class="style-1">

    <!-- LOADER -->
    <div id="loader-wrapper">
        <div class="bubbles">
            <div class="title">loading</div>
            <span></span>
            <span id="bubble2"></span>
            <span id="bubble3"></span>
        </div>
    </div>
    <div id="content-block">
        <div class="content-center fixed-header-margin">
            <!-- HEADER -->
            <div class="header-wrapper style-1">
                <header class="type-1">
                    <div class="header-top">
                        <div class="header-top-entry">
                            <div class="title"><b>Currency:</b> $ USD<i class="fa fa-caret-down"></i></div>
                            <div class="list">
                                <a href="#" class="list-entry">$ CAD</a>
                                <a href="#" class="list-entry">₹ INR</a>
                            </div>
                        </div>
                        <div class="header-top-entry hidden-xs">
                            <div class="title"><i class="fa fa-phone"></i>Any question? Call Us <a href="tel:+987123654"><b>+987 123 654</b></a></div>
                        </div>

						<?php
						if(isset($_SESSION['user_group']))
						{
							?>
								<div class="header-top-entry">
									<div class="title">
                                        <i class="fa fa-user" aria-hidden="true"></i> Hey!
                                        <?= $_SESSION['user_full_name']; ?>
                                        <i class="fa fa-caret-down"></i>
                                    </div>
									<div class="list">
                                        <?php
                                        // If logged in user is not admin
                                        if(!$this->ion_auth->is_admin())
                                        {
                                            ?>
                                            <a class="list-entry" href="<?= site_url('user/profile'); ?>"> My Profile </a>
                                            <a class="list-entry" href="<?= site_url('user/orders'); ?>">My Order</a>
                                            <a class="list-entry" href="<?= site_url('Food_Listings'); ?>">My Listings</a>
                                            <a class="list-entry" href="#">Wallet</a>
                                            <a class="list-entry" href="#">My Rewards</a>
                                            <a class="list-entry" href="<?= site_url('user/wishlist'); ?>">Wishlist</a>
                                            <a class="list-entry" href="<?= site_url('user/reviews'); ?>">Review & Ratings</a>
                                            <?php
                                        }
                                        else    // If logged in user is admin
                                        {
                                            ?>
                                            <a class="list-entry" href="<?= site_url('Dashboard'); ?>"> Admin Console </a>
                                            <?php
                                        }
                                        ?>

										<a class="list-entry" href="<?= site_url('auth/logout'); ?>">Logout</a>
									</div>
								</div>
							<?php
						}
						else
						{
							?>
							<div class="header-top-entry">
								<div class="title"><i class="fa fa-sign-in" aria-hidden="true"></i>
									<a href="<?= site_url('auth/login'); ?>"><b>SignIn / SignUp</b></a>
								</div>
							</div>
							<?php
						}
						?>
                        <div class="socials-box">
                            <a href="javascript:;"><i class="fa fa-facebook"></i></a>
                            <a href="javascript:;"><i class="fa fa-twitter"></i></a>
                            <a href="javascript:;"><i class="fa fa-google-plus"></i></a>
                            <a href="javascript:;"><i class="fa fa-youtube"></i></a>
                            <a href="javascript:;"><i class="fa fa-linkedin"></i></a>
                            <a href="javascript:;"><i class="fa fa-instagram"></i></a>
                            <a href="javascript:;"><i class="fa fa-pinterest-p"></i></a>
                        </div>

                        <div class="menu-button responsive-menu-toggle-class"><i class="fa fa-reorder"></i></div>

                        <div class="clear"></div>
                    </div>

                    <div class="header-middle">
                        <div class="logo-wrapper">
                            <a id="logo" href="<?= base_url(); ?>"><img src="<?= base_url(); ?>frontend_assets/img/logo-3.png" alt="" /></a>
                        </div>

                        <div class="middle-entry">
                            <div class="search-box">
                                <form>
                                    <div class="search-button">
                                        <i class="fa fa-search"></i>
                                        <input type="submit" />
                                    </div>
                                    <div class="search-field">
                                        <input type="text" value="" placeholder="Search for product" />
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="right-entries">
                            <a class="header-functionality-entry open-search-popup" href="#">
								<i class="fa fa-search"></i><span>Search</span>
							</a>
                            <a class="header-functionality-entry" href="javascript:;"><i class="fa fa-copy"></i><span>Compare</span></a>
                            <?php
                            if($this->ion_auth->logged_in())
                            {
                                ?>
                                <a class="header-functionality-entry" href="javascript:;"><i class="fa fa-heart-o"></i>
    								<span>Wishlist</span>
    							</a>
                                <?php
                            }
                            ?>

                            <!-- My cart section -->
                            <a class="header-functionality-entry open-cart-popup" href="<?= site_url('Cart'); ?>">
                                <i class="fa fa-shopping-cart"></i>
                                <span>My Cart</span>

                                <?php
                                if($this->ion_auth->logged_in())
                                {
                                    echo "[ ".$cart_item_count." ]";
                                }
                                elseif(isset($_SESSION['cart_value']))
                                {
                                    if(!empty($_SESSION['cart_value']))
                                    {
                                        echo "[ ".count($_SESSION['cart_value'])." ]";
                                    }
                                }
                                ?>

                            </a>
                        </div>
                    </div>

                    <div class="close-header-layer"></div>
                    <div class="navigation">
                        <div class="navigation-header responsive-menu-toggle-class">
                            <div class="title">Navigation</div>
                            <div class="close-menu"></div>
                        </div>
                        <div class="nav-overflow">
                            <nav>
                                <ul>
                                    <li class="full-width">
                                        <a href="<?= base_url(); ?>" class="active">Home</a>
                                    </li>

                                    <li class="full-width">
                                        <a href="<?= base_url('Blog'); ?>">Blog</a>
                                    </li>

                                    <li class="full-width">
                                        <a href="<?= base_url('Product'); ?>">Product</a>
                                    </li>

                                    <li class="full-width">
                                        <a href="<?= base_url('Contact'); ?>">Contact</a>
                                    </li>

                                    <li class="simple-list">
                                        <a>More</a><i class="fa fa-chevron-down"></i>
                                        <div class="submenu">
                                            <ul class="simple-menu-list-column">
                                                <li><a href="<?= base_url('About'); ?>"><i class="fa fa-angle-right"></i>About</a></li>
                                                <li><a href="<?= base_url('About/terms'); ?>"><i class="fa fa-angle-right"></i>How It Works</a></li>
												<li><a href="<?= base_url('About/terms'); ?>"><i class="fa fa-angle-right"></i>Terms & Condition</a></li>
                                                <li><a href="<?= base_url('About/faq'); ?>"><i class="fa fa-angle-right"></i>Faq</a></li>
                                                <li><a href="<?= base_url('About/returns'); ?>"><i class="fa fa-angle-right"></i>Returns</a></li>
                                                <li><a href="<?= base_url('About/service'); ?>"><i class="fa fa-angle-right"></i>Customer Service</a></li>
                                                <li><a href="<?= base_url('About/sitemap'); ?>"><i class="fa fa-angle-right"></i>Site Map</a></li>
                                                <li><a href="<?= base_url('About/policies'); ?>"><i class="fa fa-angle-right"></i>Privacy & Policies</a></li>
                                            </ul>
                                        </div>
                                    </li>

                                </ul>

                                <div class="clear"></div>

                                <a class="fixed-header-visible additional-header-logo" href="<?= base_url(); ?>">
                                    <img src="<?= base_url(); ?>frontend_assets/img/logo-3.png" alt=""/>
                                </a>
                            </nav>
                            <div class="navigation-footer responsive-menu-toggle-class">
                                <div class="socials-box">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-google-plus"></i></a>
                                    <a href="#"><i class="fa fa-youtube"></i></a>
                                    <a href="#"><i class="fa fa-linkedin"></i></a>
                                    <a href="#"><i class="fa fa-instagram"></i></a>
                                    <a href="#"><i class="fa fa-pinterest-p"></i></a>
                                    <div class="clear"></div>
                                </div>
                                <div class="navigation-copyright">Created by <a href="#">8theme</a>. All rights reserved</div>
                            </div>
                        </div>
                    </div>
                </header>
                <div class="clear"></div>
            </div>