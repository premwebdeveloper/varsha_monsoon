<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
?>
		<div class="col-sm-9">
            <?= $this->breadcrumbs->show(); ?>
            <?php
            if($this->session->flashdata('success'))
            {
             ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="message-box message-success">
                            <div class="message-icon">
                                <i class="fa fa-check"></i>
                            </div>
                            <div class="message-text">
                                <b><?= $this->session->flashdata('success'); ?></b>
                            </div>
                            <div class="message-close">
                                <i class="fa fa-times"></i>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }
            if(isset($_SESSION['error']))
            {
            ?>
                <div class="row">
                    <div class="col-md-12">
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
                    </div>
                </div>
             <?php
            }

            if(!empty($my_listings))
            {
            ?>
                 <div class="row">
                    <div class="text-right pb10 pt10 col-xs-12">
                        <div class="list">
                            <div class="col-md-4"></div>
                            <div class="col-md-3 style_border pb10" style="border-radius: 20px;">
                                Disable All Product&nbsp;
                                <a href="javascript:;" alt="1" id="<?= $disable; ?>" title="Disable/Enable Products" data-toggle="tooltip" data-placement="top" class="color-blue disable_product">
                                    <?php
                                    if($disable == 0)
                                    {
                                    ?>
                                        <i class="fa fa-toggle-off fa-2x" id="disable" style="top: 5px; position: relative;" aria-hidden="true"></i>
                                    <?php
                                    }
                                    else
                                    {
                                    ?>
                                        <i class="fa fa-toggle-on fa-2x" id="enable" style="top: 5px; position: relative;" aria-hidden="true"></i>
                                    <?php
                                    }
                                    ?>
                                </a>&nbsp;&nbsp;
                            </div>
                            <input type="hidden" id="deliver" value="<?= $my_listings[0]['today_delivery_by_seller']; ?>">
                            <?php
                            if($my_listings[0]['today_delivery_by_seller'] == 1)
                            {
                            ?>
                                <div class="col-md-3 style_border pb10" style="border-radius: 20px;">
                                    Delivery Status &nbsp;&nbsp;
                                    <a href="javascript:;" alt="1" id="delivery_on" title="Today Delivery" data-toggle="tooltip" data-placement="top" class="yellow">
                                        <i class="fa fa-toggle-on fa-2x" style="top: 5px; position: relative;" aria-hidden="true"></i>
                                    </a>&nbsp;&nbsp;
                                </div>

                            <?php
                            }
                            else
                            {
                            ?>
                                <a href="javascript:;" alt="0" title="Not Deliver" id="delivery_off" data-toggle="tooltip" data-placement="top" class="yellow">
                                    <i class="fa fa-toggle-off fa-2x" aria-hidden="true"></i>
                                </a>&nbsp;&nbsp;
                            <?php
                            }
                            ?>
                            <div class="col-md-2">
                                <a href="<?= site_url('Food_Listings/add_listings'); ?>" class="button btn-blue">
                                    Add Listing
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

            <?php
            }
			if(!empty($my_listings))
			{
                ?>
                <div class="portfolio-container type-1">
                    <div class="portfolio-navigation">
                        <div class="links-drop-down">
                            <div class="title">Select Food Type</div>
                            <div class="list" style="display: none;">
                                <a class="active" id="all_types" href="javascript:;">All</a>
                                <?php
                                // Get Food Type Id
                                $food_category = array();

                                $other_category = array();

                                $food_name = '';

                                $other = '';

                                $j = 0;

                                $i = 0;

                                foreach($my_listings as $list)
                                {
                                    foreach($category as $cate)
                                    {
                                        if($cate['id'] === $list['food_category'])
                                        {
                                            $food_name = $cate['food_category'];
                                            if (!in_array($food_name, $food_category))
                                            {
                                                ?>
                                                    <a class="view_list" id="food_<?= $list['food_category']; ?>_<?= $list['user_id']; ?>" href="javascript:;"><?= $cate['food_category']; ?></a>
                                                <?php
                                                $food_category[$i] = $cate['food_category'];
                                                $i++;
                                            }
                                        }
                                        else
                                        {
                                            if($list['food_category'] == 0)
                                            {
                                                if($list['optional_category'])
                                                {
                                                    $other = $list['optional_category'];
                                                    if (!in_array($other, $other_category))
                                                    {
                                                        ?>
                                                        <a class="view_list" id="food_<?= $list['food_category']; ?>_<?= $list['user_id']; ?>" href="javascript:;"><?= $list['optional_category']; ?></a>
                                                        <?php
                                                        $other_category[$j] = $list['optional_category'];
                                                        $j++;
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- Show Food Listing by listing types -->
                        <div id="food_category" style="display: none;"></div>

                        <div id="all_food_listing">
                            <?php
                            foreach($my_listings as $food_listing)
                            {

                            ?>
                                <!-- Show all Food Listings -->
                                <div class="col-sm-3 portfolio-entry filter-1 pb20">
                                    <div class="image">
                                        <img alt="" src="<?= base_url(); ?>uploads/listingImage/<?= $user_data['user_id']; ?>/<?= $food_listing['image']; ?>">
                                        <div class="hover-layer">
                                            <div class="info">
                                                <div class="actions">
                                                    <a class="action-button" data-toggle="tooltip" data-placement="top" title="View" href="<?= base_url('Food_Listings/view_listing')."/".$food_listing['id']; ?>">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                    <a class="action-button" data-toggle="tooltip" data-placement="top" title="Edit" href="<?= base_url('Food_Listings/edit_listing')."/".$food_listing['id']; ?>">
                                                        <i class="fa fa-pencil-square-o"></i>
                                                    </a>
                                                    <a class="action-button delete_list" data-toggle="tooltip" data-placement="top" title="Delete" id="delete_<?= $food_listing['id']; ?>" href="javascript:;">
                                                        <i class="fa fa-eraser"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-10" style="padding: 0px;">
                                        <a class="title" href="<?= base_url('Food_Listings/view_listing')."/".$food_listing['id']; ?>"><?= $food_listing['food_name']; ?></a>
                                    </div>
                                    <div class="col-md-2 pt10">
                                        <?php
                                        if($disable == 0)
                                        {
                                            if($food_listing['status'] == 1)
                                            {
                                            ?>
                                                <a href="javascript:;" class="status" id="status_<?= $food_listing['id']; ?>_<?= $food_listing['status']; ?>" title="Enable" data-toggle="tooltip" data-placement="top">
                                                    <i class="fa fa-toggle-on" style="top: 3px; position: relative;" aria-hidden="true"></i>
                                                </a>
                                            <?php
                                            }
                                            elseif($food_listing['status'] == 3)
                                            {
                                            ?>
                                                <a href="javascript:;" class="status" id="status_<?= $food_listing['id']; ?>_<?= $food_listing['status']; ?>" title="Disable" data-toggle="tooltip" data-placement="top">
                                                    <i class="fa fa-toggle-off" style="top: 3px; position: relative;" aria-hidden="true"></i>
                                                </a>
                                            <?php
                                            }
                                        }
                                        ?>
                                    </div>
                                    <div class="col-md-12" style="padding: 0px;">
                                        <div class="rating-box">
                                            <div class="star"><i class="fa fa-star-o"></i></div>
                                            <div class="star"><i class="fa fa-star-o"></i></div>
                                            <div class="star"><i class="fa fa-star-o"></i></div>
                                            <div class="star"><i class="fa fa-star-o"></i></div>
                                            <div class="star"><i class="fa fa-star-o"></i></div>
                                        </div>
                                    </div>
                                    <div class="col-md-12" style="padding: 0px;">
                                        <div class="price">
                                            <div class="prev"><i class="fa fa-inr" aria-hidden="true"></i>250</div>
                                            <div class="current ng-binding"><i class="fa fa-inr" aria-hidden="true"></i><?= $food_listing['price']; ?></div>
                                        </div>
                                    </div>
                                </div>

                             <?php
                            }
                            if($links)
                            {
                            ?>
                                <div class="col-md-12 page-selector">
                                    <div class="description">Showing: <?= $this->pagination->cur_page ?> - <?= $this->pagination->per_page ;?> of <?= $total_rows; ?></div>
                                    <div class="pages-box">
                                        <?= $links; ?>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <?php
            }
            else
            {
            ?>
        	<div class="col-md-12 categories-border-wrapper" align="center">
	            <div class="cell-view">
	                <div class="teaser-content">
	                    <div class="center">
	                        <h1 class="teaser-title">Coming Soon</h1>
	                        <div class="teaser-description">
	                        	<a href="<?= site_url('Food_Listings/add_listings'); ?>" class="button style-12">
	                        		Add Listing
	                        	</a>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
            <?php
			}
            ?>
		</div>

        <!-- Delete Address pop up -->
        <div id="delete_food" class="modal fade" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header custom_modal_header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="modal_title">Delete Food</h4>
              </div>
              <div class="modal-body">
                <p>
                    <?= form_open("Food_Listings/delete_listing", '', array('class' => 'm-t', 'id' => 'edit_form', 'role' => 'form')); ?>
                    <input type="hidden" id="food_id" name="food_id" value="">
                    <div class="newsletter-text">
                        Are you sure you want to delete this item.if yes Click
                        <?= form_submit('submit', 'Yes', array('class' => 'button style-17 btn', 'style' => 'margin-top: 12px;' ));?>
                            else
                        <?= form_label('No', '', array('class' => 'button style-17 btn', 'id' => 'no_delete'));?>
                            .
                    </div>
                </p>
              </div>
            </div>

          </div>
        </div>

        <!-- Style For Delete Pop-up -->
        <style type="text/css">
            .newsletter-text{
                margin-bottom: 0px !important;
            }
            #subscribe-popup .popup-container{
                padding: 10px 10px 10px 27px !important ;
            }
        </style>
	</div>
</div>

<!-- Confirmation Model For Delivery Option -->
<div id="delivery_on_off" class="modal fade in" role="dialog">
    <div class="modal-dialog modal-sm">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header custom_modal_header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h4 class="modal-title" id="title_modal"></h4>
            </div>
            <div class="modal-body">
                <p id="not_deliver"></p>
            </div>
            <div class="modal-body text-center">
                <p id="delete_confirmation">
                    <input type="hidden" id="confirm_yes" value="">
                    <a href="javascript:;" id="disable_all" class="btn btn-yellow">YES</a>
                    <a href="javascript:;" id="deliver_confirm" class="btn btn-yellow">YES</a>
                    <a href="javascript:;" id="" class="btn btn-yellow ChangeStatus">YES</a>&nbsp;&nbsp;
                    <a class="btn btn-yellow" data-dismiss="modal" href="javascript:;">NO</a>
                </p>
            </div>
        </div>

    </div>
</div>
