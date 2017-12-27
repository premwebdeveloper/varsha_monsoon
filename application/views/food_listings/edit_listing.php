<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    $this->load->view('templates/_parts/public_master_user_profile_sidebar_view');

    if(form_error('week_name') || $product_availibility['available_on'] == 1)
    {
    ?>
        <style type="text/css">
            .week_error{display: block !important;}
        </style>
    <?php
    }
    if(form_error('date') || $product_availibility['available_on'] == 2)
    {
    ?>
        <style type="text/css">
            .date_error{display: block !important;}
        </style>
    <?php
    }
?>
        <div class="col-sm-9">
            <?= $this->breadcrumbs->show(); ?>
            <div class="style_border p20">
                <div class="article-container style-1 well">
                    <h3 class="blue_color">Edit Your Food</h3>
                </div>
                <?= form_open_multipart("Food_Listings/edit_listing/".$food_details['id'], '', array('class' => 'm-t', 'role' => 'form'));?>
                    <div class="row">
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
                        ?>
                        <input type="hidden" name="food_listings_id" id="food_listings_id" value="<?= $food_details["id"]; ?>">
                        <input type="hidden" name="category" id="category" value="<?= $food_details["food_category"]; ?>">
                        <input type="hidden" name="deleted_images" id="deleted_images" value="">

                        <div class="col-sm-6 pt10">
                            <label>Type<span>*</span></label>
                            <div class="simple-drop-down simple-field">
                                 <?php
                                    $option = array(
                                            ''   => 'Select Type'
                                        );
                                    foreach($type as $food_type)
                                    {
                                        $data = $food_type['id'];
                                        $type_name = $food_type['type'];
                                        $option[$data] = $type_name;
                                    }
                                ?>
                                <?= form_dropdown('type', $option, $food_details['food_type'], array('class' => 'simple-field size-1 required', 'required' => 'required', 'id' => 'type')); ?>
                                <span class="red"><?= form_error('type'); ?></span>
                            </div>
                        </div>

                        <div class="col-sm-6 pt10">
                            <span class="red"><?= form_error('category'); ?></span>
                            <label>Category (Cuisine)</label>
                            <div class="simple-drop-down simple-field">
                                 <?php
                                    $option = array(
                                            ''   => 'Select Category'
                                        );
                                    foreach($food_category as $category)
                                    {
                                        $data = $category['id'];
                                        $type_name = $category['food_category'];
                                        $option[$data] = $type_name;
                                    }
                                ?>
                                <?= form_dropdown('food_category', $option, $food_details['food_category'], array('disabled'=>'disabled','class' => 'simple-field size-1', 'id' => 'food_category')); ?>
                            </div>
                        </div>

                        <div class="col-sm-6 pt10">
                            <label>Day Meals</label>
                            <div class="simple-drop-down simple-field">
                                 <?php
                                    $option = array(
                                            ''   => 'Select Day Meal'
                                        );
                                    foreach($day_meals as $day_meal)
                                    {
                                        $data = $day_meal['id'];
                                        $meal_name = $day_meal['meal_name'];
                                        $option[$data] = $meal_name;
                                    }
                                ?>
                                <?= form_dropdown('day_meal', $option, $food_details['breakfast_lunch_dinner'], array('class' => 'simple-field size-1 required', 'id' => 'day_meal')); ?>
                                <span class="red"><?= form_error('day_meal'); ?></span>
                            </div>
                        </div>

                        <div class="col-sm-6 pt10">
                            <label>Other Category (optional)</label>
                            <?= form_input('other_category', set_value('other_category', $food_details['optional_category']), array('id' => 'other_category', 'class' => 'simple-field', 'placeholder' => 'Other Category'));?>
                            <div class="clear"></div>
                        </div>

                        <div class="col-sm-6 pt10">
                            <label>Food Name <span>*</span></label>
                            <?= form_input('food_name', set_value('food_name', $food_details['food_name']), array('class' => 'simple-field', 'id'=> "food_name", 'required'=> "required", 'placeholder' => 'Food Name'));?>
                            <span class="red"><?= form_error('food_name'); ?></span>
                            <div class="clear"></div>
                        </div>

                        <div class="col-sm-6 pt10">
                            <label>Food Image <span>*</span></label>
                            <input type="file" class="simple-field required" id="user_image" name="userFiles[]" multiple/>
                            <span class="red"><?= form_error('image'); ?></span>
                            <span style="color: red;">
                                <?php
                                    if(isset($_SESSION['error']))
                                    {
                                        echo $_SESSION['error'];
                                        unset($_SESSION['error']);
                                    }
                                ?>
                            </span>
                        </div>

                        <div class="col-sm-12 pt30">
                            <div class="col-sm-2 col-md-2 information-entry pb10 hide_div" style="border: 3px #e6e6e6 solid;" >
                                <input type="hidden" name="deleted_main_images" id="deleted_main_images" value="<?= $food_details['image']; ?>">
                                <a href="javascript:;"
                                id="delete_image" style="color: red; " class="delete_main_image" title="Delete" data-toggle="tooltip" data-placement="top" >
                                    <i class="fa fa-times-circle" aria-hidden="true"></i>
                                </a>
                                <div class="product-slide-entry">
                                    <img alt="" src="<?= base_url();?>uploads/listingImage/<?= $user_data['user_id']; ?>/<?= $food_details['image'] ;?>">
                                </div>
                            </div>
                            <?php
                                foreach($food_images as  $image)
                                {
                                ?>
                                   <div class="col-sm-2 col-md-2 information-entry pb30" id="house_img-<?= $image['id']; ?>">
                                        <a href="javascript:;"
                                        id="delete_image-<?= $image['id']; ?>-<?= $image['food_listing_id']; ?>-<?= $image['image']; ?>" style="color: red;" class="delete_image" title="Delete" data-toggle="tooltip" data-placement="top" >
                                            <i class="fa fa-times-circle" aria-hidden="true"></i>
                                        </a>
                                        <div class="product-slide-entry">
                                            <img alt="" src="<?= base_url();?>uploads/listingImage/<?= $user_data['user_id']; ?>/<?= $image['image'] ;?>">
                                        </div>
                                    </div>
                                <?php
                                }
                            ?>
                        </div>

                        <div class="col-sm-6">
                            <label>Price(<i class="fa fa-inr" aria-hidden="true"></i>)<span>*</span></label>
                            <?= form_input('price', set_value('price', $food_details['price']), array('class' => 'simple-field', 'id'=> "price", 'required'=> "required", 'type' => 'number','placeholder' => 'Price(₹)'));?>
                            <span class="red"><?= form_error('price'); ?></span>
                            <div class="clear"></div>
                        </div>

                        <div class="col-sm-6">
                            <label>Availability<span>*</span></label>
                            <div class="simple-drop-down simple-field">
                                <?php
                                    $option = array(
                                            ''   => 'Select Availability',
                                            '0' => 'Daily',
                                            '1' => 'Week Days',
                                            '2' => 'Date',
                                        );
                                ?>
                                <?= form_dropdown('availability', $option, $product_availibility['available_on'], array('class' => 'simple-field size-1 required', 'required' => 'required', 'id' => 'availability')); ?>
                                <div class="clear"></div>
                            </div>
                            <div class="clear"></div>
                        </div>
                        <div class="col-md-6 date_error" id="show_date" style="display:none ;">
                            <label>Choose Date<span>*</span></label>
                            <?= form_input('date', set_value('date'), array('class' => 'simple-field datepicker', 'type' => 'number', 'placeholder' => 'Date'));?>
                            <div class="clear"></div>
                            <span class="red"><?= form_error('date'); ?></span>
                        </div>
                        <div class="col-md-6 week_error  pt10" id="show_weeks" style="display: none;">
                            <div class="well p0 col-md-12 p10">
                                <?php
                                foreach($week_days as $days_name)
                                {
                                    if(!empty($week_id))
                                    {
                                        if(in_array($days_name['id'], $week_id))
                                        {
                                        ?>
                                            <label class="col-md-3 p0">
                                                <?= form_checkbox('week_name[]', $days_name['id'], $days_name['id'], array('class' => 'checked_weeks', 'id' => 'days_name'));?>
                                                <?= $days_name['day']; ?>
                                            </label>
                                        <?php
                                        }
                                        else
                                        {

                                        ?>
                                            <label class="col-md-3 p0">
                                                <?= form_checkbox('week_name[]', $days_name['id'], "", array('class' => 'checked_weeks', 'id' => 'days_name'));?>
                                                <?= $days_name['day']; ?>
                                            </label>
                                        <?php
                                        }
                                    }
                                    else
                                    {
                                    ?>
                                        <label class="col-md-3 p0">
                                            <?= form_checkbox('week_name[]', $days_name['id'], "", array('class' => 'checked_weeks', 'id' => 'days_name'));?>
                                            <?= $days_name['day']; ?>
                                        </label>
                                    <?php
                                    }
                                }

                                ?>
                                <span class="red col-md-12"><?= form_error('week_name'); ?></span>
                            </div>
                        </div>

                        <div class="col-sm-6" id="settime">
                            <label>Set Time<span>*</span></label>
                            <div class="col-md-6 col-xs-6 p0" style="width: 50%;">From</div>
                            <div class="col-md-6 col-xs-6 p0" style="width: 50%;">To</div>
                            <div class="bootstrap-timepicker">
                                <?= form_input('from_time', $product_availibility['available_from_time'], array('class' => 'simple-field timepicker col-xs-12 col-md-6', 'placeholder' => 'From Time', 'style'=> 'width:50%;'));?>
                            </div>
                            <div class="bootstrap-timepicker">
                                <?= form_input('to_time', $product_availibility['available_to_time'], array('class' => 'simple-field timepicker col-xs-12 col-md-6', 'placeholder' => 'To Time', 'style'=> 'width:50%;'));?>
                            </div>
                            <span class="red"><?= form_error('from_time'); ?></span>
                            <span class="red"><?= form_error('to_time'); ?></span>
                            <div class="clear"></div>
                        </div>

                        <div class="col-sm-6">
                            <label>Description<span>*</span></label>
                            <?= form_textarea('desc', set_value('desc', $food_details['description']), array('class' => 'simple-field', 'style' => 'height:100px;', 'required'=> "required", 'placeholder' => 'Description'));?>
                            <span class="red"><?= form_error('desc'); ?></span>
                        </div>

                        <div class="col-sm-12">
                            <?= form_submit('submit', 'Update', array('class' => 'button style-12 btn btn-block'));?>
                        </div>

                    </div>
                <?= form_close();?>
            </div>
        </div>
    </div>
</div>