<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	$this->load->view('templates/_parts/public_master_user_profile_sidebar_view');

    if(form_error('week_name') || set_value('availability') == 1)
    {
    ?>
        <style type="text/css">
            .week_error{display: block !important;}
        </style>
    <?php
    }
    if(form_error('date') || set_value('availability') == 2)
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
                    <h3 class="blue_color" >Add Your Food</h3>
                </div>
                <?= form_open_multipart("Food_Listings/add_listings", '', array('class' => 'm-t', 'role' => 'form'));?>
                    <div class="row">
                        <div class="col-sm-6 pt10">
                            <label>Type<span>*</span></label>
                            <div class="simple-drop-down simple-field">
                                 <?php
                                    $option = array(
                                            ''   => 'Select Category'
                                        );
                                    foreach($type as $food_type)
                                    {
                                        $data = $food_type['id'];
                                        $type_name = $food_type['type'];
                                        $option[$data] = $type_name;
                                    }
                                ?>
                                <?= form_dropdown('type', $option, set_value('type'), array('class' => 'simple-field size-1 required', 'required' => 'required', 'id' => 'type')); ?>
                                <span class="red"><?= form_error('type'); ?></span>
                            </div>
                        </div>

                        <div class="col-sm-6 pt10">
                            <span class="red col-md-12"><?= form_error('category'); ?></span>
                            <label>Category (Cuisine)</label>
                            <div class="simple-drop-down simple-field">
                                 <?php
                                    $option = array(
                                            ''   => 'Select Category'
                                        );
                                ?>
                                <?= form_dropdown('category', $option, set_value('category'), array('disabled'=>'disabled', 'class' => 'simple-field size-1', 'id' => 'food_category')); ?>
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
                                <?= form_dropdown('day_meal', $option, set_value('day_meal'), array('class' => 'simple-field size-1 required', 'id' => 'day_meal')); ?>
                                <span class="red"><?= form_error('day_meal'); ?></span>
                            </div>
                        </div>

                        <div class="col-sm-6 pt10">
                            <label>Other Category (optional)</label>
                            <?= form_input('other_category', set_value('other_category'), array('readonly'=>'true', 'id' => 'other_category', 'class' => 'simple-field', 'placeholder' => 'Other Category'));?>
                            <div class="clear"></div>
                        </div>

                        <div class="col-sm-6 pt10">
                            <label>Food Name <span>*</span></label>
                            <?= form_input('food_name', set_value('food_name'), array('class' => 'simple-field', 'required'=> "required", 'placeholder' => 'Food Name'));?>
                            <span class="red"><?= form_error('food_name'); ?></span>
                            <div class="clear"></div>
                        </div>

                        <div class="col-sm-6 pt10">
                            <label>Price(<i class="fa fa-inr" aria-hidden="true"></i>)<span>*</span></label>
                            <?= form_input('price', set_value('price'), array('class' => 'simple-field', 'required'=> "required", 'type' => 'number', 'placeholder' => 'Price'));?>
                            <span class="red"><?= form_error('price'); ?></span>
                            <div class="clear"></div>
                        </div>

                        <div class="col-sm-6 pt10">
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
                                <?= form_dropdown('availability', $option, set_value('availability'), array('class' => 'simple-field size-1 required', 'required' => 'required', 'id' => 'availability')); ?>
                                <div class="clear"></div>
                            </div>

                            <div class="col-md-12 pt10 p0 date_error" id="show_date" style="display:none ;">
                                <?= form_input('date', set_value('date'), array('class' => 'simple-field datepicker', 'type' => 'number', 'placeholder' => 'Date'));?>
                                <div class="clear"></div>
                                <span class="red"><?= form_error('date'); ?></span>
                            </div>
                            <div class="style_border col-md-12 pt10 p0 well week_error" id="show_weeks" style="padding-left: 8px; display: none;">
                                <?php
                                foreach($week_days as $days_name)
                                {
                                ?>
                                    <label class="col-md-3 p0">
                                        <?= form_checkbox('week_name[]', $days_name['id'], set_checkbox('week_name', $days_name['id']), array('class' => 'checked_weeks', 'id' => 'days_name'));?>
                                        <?= $days_name['day']; ?>
                                    </label>
                                <?php
                                }
                                ?>
                                <span class="red col-md-12 p0"><?= form_error('week_name'); ?></span>
                            </div>
                            <div class="clear"></div>
                        </div>

                        <div class="col-sm-6 pt10" id="settime" style="display: none;">
                            <label>Set Time<span>*</span></label>
                            <div class="col-md-6 col-xs-6 p0" style="width: 50%;">From</div>
                            <div class="col-md-6 col-xs-6 p0" style="width: 50%;">To</div>
                            <?= form_input('from_time', set_value('from_time'), array('class' => 'simple-field timepicker col-xs-12 col-md-6', 'placeholder' => 'From Time', 'style'=> 'width:50%;'));?>
                            <?= form_input('to_time', set_value('to_time'), array('class' => 'simple-field timepicker col-xs-12 col-md-6', 'placeholder' => 'To Time', 'style'=> 'width:50%;'));?>
                            <span class="red"><?= form_error('from_time'); ?></span>
                            <span class="red"><?= form_error('to_time'); ?></span>
                            <div class="clear"></div>
                        </div>

                        <div class="col-sm-6 pt10">
                            <label>Food Image <span>*</span></label>
                            <input type="file" class="simple-field required" required="required" id="user_image" name="userFiles[]" multiple/>
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

                        <div class="col-sm-12 pt10">
                            <label>Description<span>*</span></label>
                            <?= form_textarea('desc', set_value('desc'), array('class' => 'simple-field', 'required'=> "required", 'placeholder' => 'Description', 'style' => 'height:100px;'));?>
                            <span class="red"><?= form_error('desc'); ?></span>
                        </div>

                        <div class="col-sm-12">
                            <?= form_submit('submit', 'Add Food', array('class' => 'button style-12 btn btn-block'));?>
                        </div>
                    </div>
                <?= form_close();?>
            </div>
        </div>
	</div>
</div>