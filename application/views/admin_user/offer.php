<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<script type="text/javascript">
    $(document).ready(function(){
        $('[data-toggle="remove_offer"]').confirmation({

            onConfirm: function(){
                    var offer_id = $(this).attr('data-id');
                    window.location.href = "<?= base_url();?>Admin/removeOffer/"+offer_id;
            }, // Set event when click at confirm button

            onCancel: function(){
                    var offer_id = $(this).attr('data-id');
            }
        });
    });
</script>

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8">

        <h2>Offers</h2>
        <?= $this->breadcrumbs->show(); ?>
    </div>
    <div class="col-lg-4 p20 text-right">
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">

                <div class="ibox-title">
                    <h5>Offers</h5>
                    <div class="ibox-tools pb10">
                        <a class="custom-btn btn-primary dim" href="<?= base_url('Admin/addOffer'); ?>">
                            Add Offer
                        </a>&nbsp;&nbsp;&nbsp;
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>

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
                        <table id="users_dataTable" class="table table-striped table-bordered table-hover dataTables-example" >
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Price</th>
                                    <th>Desription</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach($offers as $offer)
                            {
                                ?>
                                <tr class="gradeX">
                                    <td><?= $offer['title']; ?></td>
                                    <td><?= $offer['price']; ?></td>
                                    <td><?= $offer['description']; ?></td>
                                    <td>
                                        <img alt="image" style="height: 70px; width: 70px;" src="<?= base_url(); ?>uploads/offer/<?= $offer['image']; ?>">
                                    </td>
                                    <td class="center">
                                        <!-- <a class="custom-btn btn-primary dim" href="<?= site_url('Admin/editOffer/'.$offer['id']); ?>" data-toggle="tooltip" title="Edit" data-placement="top">
                                            <i class="fa fa-pencil" aria-hidden="true"></i>
                                        </a> -->

                                        <a class="custom-btn btn-danger dim remove_offer" data-id='<?= $offer['id']; ?>' title="Delete"
                                            data-toggle="remove_offer" data-singleton="true" data-placement="top" data-popout="true" data-btn-ok-label="Yes" data-btn-ok-icon="fa fa-check" data-btn-ok-class="custom-btn btn-success dim remove_offer confrm" data-btn-cancel-label="No" data-btn-cancel-icon="fa fa-times" data-btn-cancel-class="custom-btn btn-warning dim remove_offer confrm">

                                            <i class="fa fa-times" aria-hidden="true"></i>
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