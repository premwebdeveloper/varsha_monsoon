<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2><?= $user['fname']." ".$user['lname']; ?> - Profile</h2>
        <?= $this->breadcrumbs->show(); ?>
    </div>
</div>

<div class="wrapper wrapper-content">
    <div class="row animated fadeInRight">
        <div class="col-md-4">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Profile Detail</h5>
                </div>
                <div>
                    <div class="widget-head-color-box navy-bg p-lg text-center">
                        <img alt="image" class="img-circle circle-border" style="width: 65%;" src="<?= base_url(); ?>uploads/users/<?php
                        if(!empty($user['image']))
                        {
                            echo $user['image'];
                        }
                        else
                        {
                            echo "profile.jpg";
                        }
                        ?>
                        ">
                    </div>
                    <div class="ibox-content profile-content">
                        <h4><strong><?= $user['fname']." ".$user['lname']; ?></strong></h4>
                        <p>
                            <i class="fa fa-map-marker"></i>
                            <?= $user['address'].", ".$user['city'].", ".$user['state'].", ".$user['country']." - ".$user['zipcode']; ?>
                        </p>
                        <h5>
                            About me
                        </h5>
                        <p>
                            <?= $user['bio']; ?>
                        </p>
                        <div class="row m-t-lg">
                            <div class="col-md-4">
                                <span class="bar">5,3,9,6,5,9,7,3,5,2</span>
                                <h5><strong>169</strong> Posts</h5>
                            </div>
                            <div class="col-md-4">
                                <span class="line">5,3,9,6,5,9,7,3,5,2</span>
                                <h5><strong>28</strong> Following</h5>
                            </div>
                            <div class="col-md-4">
                                <span class="bar">5,3,2,-1,-3,-2,2,3,5,2</span>
                                <h5><strong>240</strong> Followers</h5>
                            </div>
                        </div>
                        <div class="user-button">
                            <div class="row">
                                <div class="col-md-6">
                                    <button type="button" class="btn btn-primary btn-sm btn-block"><i class="fa fa-envelope"></i> Send Message</button>
                                </div>
                                <div class="col-md-6">
                                    <button type="button" class="btn btn-default btn-sm btn-block"><i class="fa fa-coffee"></i> Buy a coffee</button>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
            </div>
        <div class="col-md-8">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Orders</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">

                    <div>
                        <div class="feed-activity-list">

                            <div class="feed-element">
                                <a href="#" class="pull-left">
                                    <img alt="image" class="img-circle" src="<?= base_url(); ?>assets/img/a1.jpg">
                                </a>
                                <div class="media-body ">
                                    <small class="pull-right text-navy">1m ago</small>
                                    <strong>Sandra Momot</strong> started following <strong>Monica Smith</strong>. <br>
                                    <small class="text-muted">Today 4:21 pm - 12.06.2014</small>
                                    <div class="actions">
                                        <a class="btn btn-xs btn-white"><i class="fa fa-thumbs-up"></i> Like </a>
                                        <a class="btn btn-xs btn-danger"><i class="fa fa-heart"></i> Love</a>
                                    </div>
                                </div>
                            </div>

                            <div class="feed-element">
                                <a href="#" class="pull-left">
                                    <img alt="image" class="img-circle" src="<?= base_url(); ?>assets/img/profile.jpg">
                                </a>
                                <div class="media-body ">
                                    <small class="pull-right">5m ago</small>
                                    <strong>Monica Smith</strong> posted a new blog. <br>
                                    <small class="text-muted">Today 5:60 pm - 12.06.2014</small>

                                </div>
                            </div>
                        </div>

                        <button class="btn btn-primary btn-block m"><i class="fa fa-arrow-down"></i> Show More</button>

                    </div>

                </div>
            </div>

        </div>
    </div>
</div>