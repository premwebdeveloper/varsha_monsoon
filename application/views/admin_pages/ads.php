<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>All Ads</h2>
        <?= $this->breadcrumbs->show(); ?>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
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

                    <div class="table-responsive">
                        <table id="dataTable" class="table table-striped table-bordered table-hover dataTables-example" >
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Price(₹)</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach($ads as $ad)
                            {
                                ?>
                                <tr class="gradeX">
                                    <td class="center"><?= $ad['title']; ?></td>
                                    <td class="center"><?= $answer = preg_replace('/\s+?(\S+)?$/', '', substr($ad['description'], 0, 40)); ?> ...</td>
                                    <td class="center"><?= $ad['price']; ?></td>
                                    <td class="center"><?= $ad['image']; ?></td>
                                    <td class="center">
                                    <?php
                                        if($ad['status'] == 1)
                                        {
                                            echo "Ads";
                                        }
                                        else
                                        {
                                            echo "Offer";
                                        }
                                    ?></td>
                                    <td class="center">
                                        <a class="custom-btn btn-primary dim" href="<?= site_url(); ?>Admin_Pages/edit_ads/<?= $ad['id'];?>" data-toggle="tooltip" title="Edit" data-placement="top">
                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>