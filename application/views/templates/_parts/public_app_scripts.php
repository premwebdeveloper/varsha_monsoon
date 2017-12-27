<script language="javascript">

	$(document).ready(function(){

		// Date Picker for registration form
		$('.datepicker').datepicker({
			autoclose: true,
			todayHighlight: true,
			format: 'yyyy-mm-dd'
		});

		//Time Picker
		$('.timepicker').timepicker({
            showMeridian : false
        });

		// Tool tip script
		$('[data-toggle="tooltip"]').tooltip();

	});

	// Script for get Price Range(In Between)
	$(document).ready(function(){
        var minVal = parseInt($('.min-price span').text());
        var maxVal = parseInt($('.max-price span').text());
        $( "#prices-range" ).slider({
            range: true,
            min: minVal,
            max: maxVal,
            step: 5,
            values: [ minVal, maxVal ],
            slide: function( event, ui ) {
                $('.min-price span').text(ui.values[ 0 ]);
                $('.max-price span').text(ui.values[ 1 ]);
            }
        });
    });

	// Script for user profile updation
	$(document).ready(function(){

		$(document).on("click", "#profile_edit", function(){
			// binds form submission and fields to the validation engine
			$("#edit_form").validationEngine({promptPosition : "topLeft"});
			$("#name").hide();
			$("#dob").hide();
			$("#gender").hide();
			$("#bio").hide();
			$("#edit_fname").show("");
			$("#edit_lname").show("");
			$("#edit_dob").show("");
			$("#edit_gender").show("");
			$("#edit_bio").show("");
			$("#edit_btn").show("");
			$("#cancel_bio").show("");
		});

		// Cancel Button Code Edit Personal Detail
		$(document).on("click", "#cancel", function(){
			$("#name").show("");
			$("#dob").show("");
			$("#gender").show("");
			$("#bio").show("");
			$("#edit_fname").hide();
			$("#edit_lname").hide();
			$("#edit_dob").hide();
			$("#edit_gender").hide();
			$("#edit_bio").hide();
			$("#edit_btn").hide();
			$("#cancel_bio").hide();
		});

		// Show Message for Mobile OTP and Password Input Box
		$(document).on("click", "#update_phone", function(){

			var new_mobile = $("#input_no").val();

			if(new_mobile.length == 10)
			{
				$("#mobile_update_errors").html('');
				$("#mobile_update_errors").hide('');

				$.ajax({
					url : "<?= base_url(); ?>User/send_mobile_otp",
					type : "POST",
					data : {new_mobile : new_mobile},
					success : function(data)
					{
						if(data == 0)
						{
							$("#mobile_update_errors").html('Something went wrong ! Please try again.');
							$("#mobile_update_errors").show('');
						}
						else if(data == 2)
						{
							$("#mobile_update_errors").html('');
							$("#mobile_update_errors").html('Please provide new mobile number !');
							$("#mobile_update_errors").show('');
						}
						else if(data == 1)
						{
							$("#edit_phone").hide();
							$("#input_no").attr('disabled','disabled');
							$("#update_cancel_phone").hide("");

							$("#verify_section").show("");


							$("#mobile_update_errors").html('');
							$("#mobile_update_errors").html('OTP sent to your mobile number. Please fill OTP and verify your mobile.');
							$("#mobile_update_errors").show('');
						}
					}
				});
			}
			else
			{
				$("#mobile_update_errors").html('Please fill 10 digit mobile number !');
				$("#mobile_update_errors").show('');
			}
		});

		// Verify new mobile number with OTP sent on mobile number
		$(document).on("click", "#verify_phone", function(){

			var filled_otp = $("#otp").val();
			var new_mobile = $("#input_no").val();

			$.ajax({
				url : "<?= base_url(); ?>user/verify_otp_mobile_update",
				type : "POST",
				data : {filled_otp : filled_otp, new_mobile : new_mobile},
				success : function(data)
				{
					if(data == 0)
					{
						$("#mobile_update_errors").html('');
						$("#mobile_update_errors").html('OTP did not match !');
						$("#mobile_update_errors").show('');
					}
					else
					{
						$("#mobile_update_errors").html('');
						$("#mobile_update_errors").html('Mobile number updated successfully.');
						$("#mobile_update_errors").show('');

						setTimeout(function(){
							location.reload();
						}, 2000);
					}
				}
			});
		});

		// Add and Remove Border on Listing View on Home
		$(".listed").on("click", function(){
            $(".products").removeClass("style_border");
        });
        $(".grids").on("click", function(){
            $(".products").addClass("style_border");
        });

		// Show Message for User Email Id Updatation
		/*$(document).on("click", "#email_edit", function(){
			$("#email_id").show("");
			$("#edit_email").show("");
			$("#cancel_email").show("");
			$("#email_add").hide();
			$("#email_edit").hide();
		});*/

		// Sent Email OTP to User Email Id
		/*$(document).on("click", "#update_email", function(){

			$(".validation").html("");

			var email_id = $("#email").val();

			$.ajax({
				url: "<?= base_url(); ?>user/sent_otp",
				type: "POST",
				data: {email_id : email_id},
				success: function(data){
					var result = $.parseJSON(data);
					if(result === 1)
					{
						$(".validation").html("");
						$("#email").parent().after("<div class='validation' style='color:red;margin-bottom: 20px;'>Email alredy taken.</div>");
					}
					else if(result === -1)
					{
						$(".validation").html("");
						$("#email").parent().after("<div class='validation' style='color:red;margin-bottom: 20px;'>This field is required.</div>");
					}
					else if(result === 0)
					{
						$(".validation").html("");
						$("#email").parent().after("<div class='validation' style='color:red;margin-bottom: 20px;'>Something Went Wrong</div>");
					}
					else if(result === 2)
					{
						$(".validation").html("");
						$("#email").parent().after("<div class='validation' style='color:red;margin-bottom: 20px;'>Please enter valid email address</div>");
					}
					else
					{
						$(".validation").html("");

						generatedOTP = result;
						$("#email").prop( "disabled", true );
						$(".validation").html("");
						$("#edit_email").hide();
						$("#email_hide").show("");
						$("#verify_email").show("");
						$("#old_password").show("");
						$("#email_otp").show("");
					}
				}
			});
		});*/

		// verify Email OTP
		/*$(document).on("click", "#email_verify",function(){

			var otp = $("#otp_email").val();

			var email = $("#email").val();

			if(otp)
			{
				$(".validation").html("");

				var password = $("#input_pass").val();

				if(password)
				{
					$(".validation").html("");

					if(generatedOTP == otp)
					{
						$(".validation").html("");

						//check password is correct or not
						$.ajax({
							url:"<?= base_url(); ?>user/check_password",
							type:"POST",
							data: {password : password, email : email},
							success: function(data){
								var result = $.parseJSON(data);

								if(result == 1)
								{
									$("#email_id").hide();
									$("#edit_email").hide();
									$("#cancel_email").hide();
									$("#email_add").show("");
									$("#email_edit").show("");
									$("#verify_email").hide();
									$("#old_password").hide();
									$("#email_otp").hide();
									$("#msg_box").show("");
									$("#message").html("<span>Email id updated Sucessfully.</span>");
									setTimeout(location.reload.bind(location), 3000);
								}
								else
								{
									$(".validation").html("");
									$("#input_pass").parent().after("<div class='validation' style='color:red;margin-bottom: 20px;'>Please enter a correct  Account Password.</div>");
								}
							}
						});
					}
					else
					{
						$(".validation").html("");
						$("#otp_email").parent().after("<div class='validation' style='color:red;margin-bottom: 20px;'>OTP can not match.</div>");
					}
				}
				else
				{
					$(".validation").html("");
					$("#input_pass").parent().after("<div class='validation' style='color:red;margin-bottom: 20px;'>Enter your account Password.</div>");
				}
			}
			else
			{
				$(".validation").html("");
				$("#otp_email").parent().after("<div class='validation' style='color:red;margin-bottom: 20px;'>Please enter OTP.</div>");
			}
		});*/

		//Hide User Email Updation Message Box
		/*$(document).on("click", "#cancel_email", function(){
			$("#update_email").show();

			$("#email_id").hide();
			$("#edit_email").hide();
			$("#cancel_email").hide();
			$("#email_add").show("");
			$("#email_edit").show("");
			$("#verify_email").hide();
			$("#old_password").hide();
			$("#email_otp").hide();
		});*/


		// Show Message for Edit User Phone Number Updatation
		$(document).on("click", "#phone_edit", function(){
			$("#phone").hide();
			$("#phone_edit").hide();
			$("#edit_space").hide();
			$("#p_no").show("");
			$("#edit_phone").show("");
			$("#cancel_phone").show("");
			$("#update_no").show("");
		});

		// Resend OTP to update mobile number
		$(document).on("click", "#resend_mobile_otp", function(){

			var new_mobile = $("#input_no").val();

			if(new_mobile.length == 10)
			{
				$("#mobile_update_errors").html('');
				$("#mobile_update_errors").hide('');

				$.ajax({
					url : "<?= base_url(); ?>User/resend_mobile_otp",
					type : "POST",
					data : {new_mobile : new_mobile},
					success : function(data)
					{
						if(data == 0)
						{
							$("#mobile_update_errors").html('Something went wrong ! Please try again.');
							$("#mobile_update_errors").show('');
						}
						else if(data == 2)
						{
							$("#mobile_update_errors").html('');
							$("#mobile_update_errors").html('Please provide new mobile number !');
							$("#mobile_update_errors").show('');
						}
						else if(data == 1)
						{
							$("#input_no").attr('disabled','disabled');
							$("#update_cancel_phone").hide("");
							$("#verify_section").show("");

							$("#mobile_update_errors").html('');
							$("#mobile_update_errors").html('Resend OTP to your mobile number. Please fill OTP and verify your mobile.');
							$("#mobile_update_errors").show('');
						}
					}
				});
			}
		});

		// Hide User Phone Number Updation Button
		$(document).on("click", "#cancel_phone", function(){

			$("#mobile_update_errors").hide();

			$("#p_no").hide();
			$("#phone").show("");
			$("#edit_phone").hide();
			$("#cancel_phone").hide();
			$("#verify_section").hide();
			$("#input_no").prop( "disabled", false);
			$("#update_cancel_phone").show("");
			$("#phone_edit").show();
		});

		// Match Old Password
		$(document).on("blur", "#old_pass", function(){
			var old_password = $("#old_pass").val();
			$.ajax({

				url:"<?= base_url(); ?>user/match_old_password",
				type:"POST",
				data:{ old_password : old_password},
				success: function(data){
					if(data == 1)
					{
						$("#error_message").hide();
						$('#new_pass').prop('disabled', false);
						$('#confirm_pass').prop('disabled', false);
					}
					else
					{
						$('#new_pass').prop('disabled', true);
						$('#confirm_pass').prop('disabled', true);
						$("#error_message").html("<span style='color:red;''>Old Password is can not matched.</span>");
						$("#error_message").show("");
					}
				}
			});
		});

		//Show Password Pop-up
		$(document).on("click", "#change_password", function(){
			$('#product-popup').modal('show');
		});

		// Change User Password
		$(document).on("click", "#chenge_user_password", function(){
			var old_pass = $("#old_pass").val();
			var new_pass = $("#new_pass").val();
			var con_pass = $("#confirm_pass").val();

			//check input box is empty or not
			if(old_pass != '' && new_pass != '' && con_pass != '')
			{
				$("#error_message").html("");
				$("#error_message").hide();
				if(new_pass === con_pass)
				{
					if(new_pass.length >= 8)
					{
						$.ajax({

							url:"<?= base_url(); ?>auth/change_password",
							type:"POST",
							data:{ old_pass : old_pass, new_pass : new_pass},
							success: function(data){
								if(data == 1)
								{
									$("#error_message").html("<span style='color:green;''>Password changed Sucessfully.</span>");
									$("#error_message").show("");
									setTimeout(function(){
							        	$("#error_message").hide("");
							        	$("#old_pass").val("");
										$("#new_pass").val("");
										$("#confirm_pass").val("");
										$('#new_pass').prop('disabled', true);
										$('#confirm_pass').prop('disabled', true);
										$('#product-popup').modal('hide');
							    }, 3000);
								}
								else if(data == 2)
								{
									$("#error_message").html("<span style='color:red;''>Your password is not less than 8 characters long.</span>");
									$("#error_message").show("");
								}
								else
								{
									$("#error_message").html("<span style='color:red;''>Old Password is Wrong.</span>");
									$("#error_message").show("");
								}
							}
						});
					}
					else
					{
						$("#error_message").html("<span style='color:red;''>Your password is not less than 8 characters long.</span>");
						$("#error_message").show("");
					}
				}
				else
				{
					$("#error_message").html("<span style='color:red;''>New Password can not match with Confrim Password.</span>");
					$("#error_message").show("");
				}
			}
			else
			{
				$("#error_message").html("<span style='color:red;''>Please fill all required fields.</span>");
				$("#error_message").show("");
			}
		});

		// Delete Food Listing Image
        $(".delete_image").click(function(){
            var id = $(this).attr("id");
            var temp = id.split("-");
            var image_id = temp[1];
            var food_listing_id = temp[2];
            var image_name = temp[3];

            var temp = $("#deleted_images").val();
            var append = temp + image_id + "|";
            $("#deleted_images").val(append);
            $("#house_img-"+image_id).hide("");
        });

        $(".delete_main_image").click(function(){
            $("#deleted_main_images").val("");
            $(".hide_div").hide("");
        });

	    //Hide Delete Food Listing Popup
        $(document).on("click", "#no_delete", function(){
            $('#delete_food').modal('hide');
        });


		//Show Delete Food Listing Pop-up
		$(document).on("click", ".delete_list", function(){
			var id = $(this).attr("id");
            var temp = id.split("_");
            var food_id = temp[1];
            $("#food_id").val(food_id);
			$('#delete_food').modal('show');
		});

		// View Listing by Different different types
        $(document).on("click", ".view_list", function(){
            var id = $(this).attr("id");
            var temp = id.split('_');
            var type_id = temp[1];
            var user_id = temp[2];
            $.ajax({
                url:"<?= base_url('Food_Listings/get_food_category'); ?>",
                type:"POST",
                data:{type_id : type_id},
                success:function(data){
                    var toAppend = '';
                    var result =  $.parseJSON(data);
                    $.each(result, function(key, value){
                        toAppend += '<div class="col-sm-3 portfolio-entry mouse_over filter-1"><div class="image"><img alt="" src="<?= base_url(); ?>uploads/listingImage/'+user_id+'/'+value.image+'"><div class="hover-layer"><div class="info"><div class="actions"><a class="action-button" href="<?= base_url('Food_Listings/view_listing'); ?>/'+value.id+'"><i class="fa fa-eye"></i></a><a class="action-button" href="<?= base_url('Food_Listings/edit_listing'); ?>/'+value.id+'"><i class="fa fa-pencil-square-o"></i></a><a class="action-button open-subscribe delete_list" data-toggle="tooltip" data-placement="top" title="Delete" id="delete_'+value.id+'" href="javascript:;"><i class="fa fa-eraser"></i></a></div></div></div></div><a class="title" href="<?= base_url('Food_Listings/view_listing'); ?>/'+value.id+'">'+value.food_name+'</a><div class="rating-box"><div class="star"><i class="fa fa-star-o"></i></div><div class="star"><i class="fa fa-star-o"></i></div><div class="star"><i class="fa fa-star-o"></i></div><div class="star"><i class="fa fa-star-o"></i></div><div class="star"><i class="fa fa-star-o"></i></div></div><div class="price"><div class="prev"><i class="fa fa-inr" aria-hidden="true"></i>250</div><div class="current ng-binding"><i class="fa fa-inr" aria-hidden="true"></i>'+value.price+'</div></div></div>';
                    });

                    toAppend += '<script> $(document).ready(function(){ $(document).on("mouseover", ".portfolio-entry", function(){ $(this).addClass("active"); }); $(document).on("mouseleave", ".portfolio-entry", function(){  $(this).removeClass("active"); }) ; });  </scr'+'ipt>';
                    $("#food_category").html("");
                    $("#food_category").html(toAppend);
                    $("#all_food_listing").hide("");
                    $("#food_category").show("");
                }
            });
        });

        $(document).on("click", "#all_types", function(){

            $("#food_category").html("");
            $("#food_category").hide("");
            $("#all_food_listing").show("");

        });

	    // User address delete confirmation
	    $(document).on("click", ".delete_address", function(){

	     	var id = $(this).attr('id');
	     	var temp = id.split('_');
	     	var address_id = temp[2];

	     	var url = '<?= base_url(); ?>addresses/delete_address/'+address_id;

	     	var delete_confirm = 'Are you sure? You want to remove this address then click <a href="'+url+'" class="btn btn-yellow">YES</a> else <a  class="btn btn-yellow" href="">NO</a>';

	     	$('#modal_title').html('Remove Address');

	     	$('#delete_confirmation').html(delete_confirm);

	     	$("#address_delete_pop_up").modal('show');
	    });

	    // User address set as default address
	    $(document).on("click", ".set_default_address", function(){
	    	var id = $(this).attr('id');
	     	var temp = id.split('_');
	     	var address_id = temp[2];

	     	var url = '<?= base_url(); ?>addresses/set_default_address/'+address_id;

	     	var delete_confirm = 'Are you sure? You want to set this address as default then click <a href="'+url+'" class="btn btn-yellow">YES</a> else <a  class="btn btn-yellow" href="">NO</a>';

	     	$('#modal_title').html('Set address as default.');

	     	$('#delete_confirmation').html(delete_confirm);

	     	$("#address_delete_pop_up").modal('show');
	    });

        //Change Profile Pic
        $(document).on("click", "#change_image", function(){
			$("#change_profile").show("");
		});


        //Get Food Category
        $(document).on("mousedown", "#type", function(){
            var id = $(this).val();
            $.ajax({
                url:"<?= site_url('Food_Listings/get_category'); ?>",
                type: "POST",
                data:{ id : id },
                success: function(data){
                    var toAppend = '<option value="">Select Category</option>';
                    var result = $.parseJSON(data);
                    $.each(result, function(key, value){
                        toAppend += '<option value="'+value.id+'">'+value.food_category+'</option>';
                    });

                    console.log(data);
                    $("#food_category").removeAttr("disabled");
                    $("#other_category").removeAttr("readonly");
                    $("#food_category").html(toAppend);
                }
            });
        });

        //Disable Other Categoty when user select main category
        $("#other_category").on("keyup", function(){
        	$('#food_category').val("");
        });
        $("#other_category").on("mousedown", function(){
        	$('#food_category').val("");
        });

        //Select Food Category
        $("#food_category").on("change", function(){
        	$('#other_category').val("");
        });

	});

	  ////////////////////////////////////////////////////////////////////////////////////////////
	 ///////////////////////////////////// Address section jquery ///////////////////////////////
	////////////////////////////////////////////////////////////////////////////////////////////

	$(document).ready(function(){

        // Cancel address updation
        $(document).on('click', '.cancel_edit_address', function(){
            var id = $(this).attr('id');
            var temp = id.split('_');

            var address_id = temp[3];

            $('#for_update_address_'+address_id).html('');
            $('#for_update_address_'+address_id).addClass('ng-hide');

            $('#single_address_'+address_id).show('');
        });

        // Update address finally
        $(document).on('click', '.editAddressFinally', function(){

            if (validation()) // Calling Validation Function
            {
                var id = $(this).attr('id');
                var temp = id.split('_');

                var address_id = temp[1];

                var form_data = $('#edit_address').serialize();

                form_data += '&address_id='+address_id;

                $.ajax({
                    url : "<?= base_url(); ?>addresses/update_address",
                    type : "POST",
                    data : form_data,
                    success : function(data)
                    {
                        if(data == 3)
                        {
                            $('.finally_edit_errors').html('');
                            $('.finally_edit_errors').html('Something went wrong ! Please try again.');
                            $('.finally_edit_errors').show('');
                        }
                        else if(data == 2)
                        {
                            $('.finally_edit_errors').html('');
                            $('.finally_edit_errors').html('Please fill 10 digit mobile number !');
                            $('.finally_edit_errors').show('');
                        }
                        else if(data == 0)
                        {
                            $('.finally_edit_errors').html('');
                            $('.finally_edit_errors').html('Please fill all required field !');
                            $('.finally_edit_errors').show('');
                        }
                        else
                        {
                            $('.finally_edit_errors').html('');
                            $('.finally_edit_errors').removeClass('alert-warning');
                            $('.finally_edit_errors').addClass('alert-success');
                            $('.finally_edit_errors').html('Address updated successsully.');
                            $('.finally_edit_errors').show('');

                            //$('#edit_address').reset();

                            $('#for_update_address_'+address_id).html('');
                            $('#for_update_address_'+address_id).addClass('ng-hide');

                            $('#single_address_'+address_id).show('');

                            var temp_add = data.split('|');

                            console.log(data);

                            if(temp_add[8] == 1)
                            {
                                var is_default = '<label class="text_bold custom_label">Default</label>';
                            }
                            else
                            {
                                var is_default = '';
                            }

                            var actual_address = '<p>'+temp_add[1]+' ( '+temp_add[2]+' ) '+is_default+' </p><p class="pt10">'+temp_add[3]+', '+temp_add[4]+', '+temp_add[5]+', '+temp_add[6]+' - '+temp_add[7]+' </p>';

                            $('#actual_address_'+address_id).html('');
                            $('#actual_address_'+address_id).html(actual_address);
                        }
                    }
                });
            }
        });

    });

	/*Get Current Location for Address Book*/
    $(document).ready(function(){
        $(document).on("click", "#get_address", function(){
            var latitudeAndLongitude=document.getElementById("latitudeAndLongitude"),
            location={
                latitude:'',
                longitude:''
            };

            if (navigator.geolocation){
              navigator.geolocation.getCurrentPosition(showPosition);
            }
            else{
              latitudeAndLongitude.innerHTML="Geolocation is not supported by this browser.";
            }

            function showPosition(position){
                location.latitude=position.coords.latitude;
                location.longitude=position.coords.longitude;
                latitudeAndLongitude.innerHTML="Latitude: " + position.coords.latitude +
                "<br>Longitude: " + position.coords.longitude;
                var geocoder = new google.maps.Geocoder();
                var latLng = new google.maps.LatLng(location.latitude, location.longitude);

             if (geocoder)
             {
                geocoder.geocode({ 'latLng': latLng}, function (results, status) {
                   if (status == google.maps.GeocoderStatus.OK) {
                     console.log(results[0].formatted_address);
                     $('#address').html('Address:'+results[0].formatted_address);
                    var myLocation;
                    for (var i = 0; i < results[0].address_components.length; i++) {
                        var addr = results[0].address_components[i];
                        var getCountry;
                        var getLocality;
                        var add;
                        var address;
                        var getDistic;
                        var getState;

                        if (addr.types[0] == 'neighborhood') {
                            if(addr.long_name != 'undefined')
                            {
                                var getneighborhood = addr.long_name;
                                myLocation = getneighborhood + ', ';
                            }
                        }
                        if (addr.types[0] == 'political') {
                            if(addr.long_name != 'undefined')
                            {
                                var getpolitical = addr.long_name;
                                myLocation += getpolitical + ', ';
                            }
                        }
                        if (addr.types[0] == 'sublocality') {
                            if(addr.long_name != 'undefined')
                            {
                                var getsublocality = addr.long_name;
                                myLocation += getsublocality;
                            }
                        }

                        if (addr.types[0] == 'locality') {
                            getLocality = addr.long_name;
                        }

                        if (addr.types[0] == 'administrative_area_level_2') {
                            getDistic = addr.long_name;
                        }


                        if (addr.types[0] == 'administrative_area_level_1') {
                            getState = addr.long_name;
                        }

                        if (addr.types[0] == 'country') {
                            getCountry = addr.long_name;
                        }

                        if (addr.types[0] == 'postal_code') {
                            getZip = addr.long_name;
                        }
                    }
                    $("#address").val(myLocation);
                    $("#city").val(getLocality);
                    $("#state").val(getState);
                    $("#country").val(getCountry);
                    $("#zip").val(getZip);

                   }
                }); //geocoder.geocode()
              }
            }
        });
    });

    // Name And Email Validation Function
    function validation() {
        var editName    = $('#editName').val();
        var editMobile  = $('#editMobile').val();
        var editAddress = $('#editAddress').val();
        var editCity    = $('#editCity').val();
        var editState   = $('#editState').val();
        var editCountry = $('#editCountry').val();
        var editZip     = $('#editZip').val();

        if (editName === '' || editMobile === '' || editAddress === '' || editCity === '' || editState === '' || editCountry === '' || editZip === '')
        {
            $('.finally_edit_errors').html('Please fill allrequired fields !');
            $('.finally_edit_errors').show('');
            return false;
        }
        else
        {
            var NumberRegex = /^[0-9]*$/;

            if(editMobile.length == 10){
                if(NumberRegex.test(editMobile)){
                    $('.finally_edit_errors').html('');
                    $('.finally_edit_errors').hide('');
                    return true;
                }
                else
                {
                    $('.finally_edit_errors').html('Invalid mobile number !');
                    $('.finally_edit_errors').show('');
                    return false;
                }
            }
            else
            {
                $('.finally_edit_errors').html('Please fill 10 digit mobile number !');
                $('.finally_edit_errors').show('');
                return false;
            }
        }
    }

      //////////////////////////////////////////////////////////////////////////////////////
     //////////////////////////// User Listing Page Script ////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////

    //Function For Change Delivery Status
    function delivery(data)
    {
        if(data == 1)
        {
            data = 0;
            $("#deliver").val("0");
            htm = "<i class='fa fa-toggle-off fa-2x' aria-hidden='true' style='top: 5px; position: relative;'></i>";
        }
        else if(data == 0)
        {
            data = 1;
            $("#deliver").val("1");
            htm = "<i class='fa fa-toggle-on fa-2x' aria-hidden='true' style='top: 5px; position: relative;'></i>";
        }

        $.ajax({

            url : "<?= base_url(); ?>Product/delivery",
            type : "POST",
            data : { data : data },
            success : function(data){
                if(data == true)
                {
                }
            }
        });

        return htm;
    }

    //Function for Disable or Enable Button
    function availibility(data)
    {
        if(data == 1)
        {
            htm = "<i class='fa fa-toggle-off' style='top: 3px; position: relative;'' aria-hidden='true'></i>";
        }
        else if(data == 3)
        {
            htm = "<i class='fa fa-toggle-on' style='top: 3px; position: relative;' aria-hidden='true'></i>";
        }
        return htm;
    }

    $(document).ready(function(){

        //Show Confirm Box for Not Delivery
        $(document).on("click", "#delivery_on", function(){
            var confirm = $("#deliver").val();
            if(confirm == 1)
            {
                $("#title_modal").html("Not Deliver Today");

                $("#not_deliver").html("Are you sure? You do not want to Deliver Today ?");

                $("#confirm_yes").val(confirm);
            }
            else if(confirm == 0)
            {
                $("#title_modal").html("Not Deliver Today");

                $("#not_deliver").html("Are you sure? You do not want to Deliver Today ?");

                $("#confirm_yes").val(confirm);
            }
            $(".ChangeStatus").hide();
            $("#disable_all").hide();
            $("#deliver_confirm").show();
            $("#delivery_on_off").modal("show");
        });

        //Show Confirm Box for Today Delivery
        $(document).on("click", "#delivery_off", function(){
            var confirm = $("#deliver").val();
            if(confirm == 0)
            {
                $("#title_modal").html("Not Deliver Today");

                $("#not_deliver").html("Are you sure? You do not want to Deliver Today ?");

                $("#confirm_yes").val(confirm);
            }
            else if(confirm == 1)
            {
                $("#title_modal").html("Not Deliver Today");

                $("#not_deliver").html("Are you sure? You do not want to Deliver Today ?");

                $("#confirm_yes").val(confirm);
            }
            $(".ChangeStatus").hide();
            $("#disable_all").hide();
            $("#deliver_confirm").show();
            $("#delivery_on_off").modal("show");

        });

        //Change Delivery Status
        $(document).on("click", "#deliver_confirm", function(){
            var result = $("#confirm_yes").val();

            var show_html = delivery(result);

            $("#delivery_on_off").modal("hide");

            if($("#delivery_off").attr('alt') == 0)
            {
                $("#delivery_off").html("");

                $("#delivery_off").html(show_html);
            }
            else if($("#delivery_on").attr('alt') == 1)
            {
                $("#delivery_on").html("");

                $("#delivery_on").html(show_html);
            }
        });

        // Show Enable or Disable Single Product Model
        $(document).on("click",".status", function(){
            var data = $(this).attr("id");
            var temp = data.split("_");
            var id = temp[1];
            var status = temp[2];
            $("#title_modal").html("Enable / Disable Product");
            $("#not_deliver").html("Are you sure? you want to Enable/ Disable this product.");
            $("#delivery_on_off").modal("show");
            $("#deliver_confirm").hide();
            $("#disable_all").hide();
            $(".ChangeStatus").show();
            $(".ChangeStatus").attr("id", "status_"+id+"_"+status);
        });

        //Change status for disable or enable
        $(document).on("click", ".ChangeStatus", function(){
            var data = $(this).attr("id");
            var temp = data.split("_");
            var id = temp[1];
            var status = temp[2];

            //change status
            $.ajax({
                url:"<?= site_url('Food_Listings/enableDisableProducts'); ?>",
                type:"POST",
                data: {id : id, status:status},
                success:function(data){
                    if(data == 1)
                    {
                    }
                }
            });

            if(status == 1)
            {
                var new_html = availibility(status);

                var new_id = "status_"+id+"_"+3;
                var old_id = "status_"+id+"_"+1;

                $("#"+old_id).html("");
                $("#"+old_id).html(new_html);
                $("#"+old_id).attr('id', new_id);
                //alert(new_html);
            }

            if(status == 3)
            {
                var new_html = availibility(status);

                var new_id = "status_"+id+"_"+1;
                var old_id = "status_"+id+"_"+3;
                $("#"+old_id).html("");
                $("#"+old_id).html(new_html);
                $("#"+old_id).attr('id', new_id);
                //alert(new_html);
            }
            $("#delivery_on_off").modal("hide");

        });

        //Show Disable All Product Pop-up
        $(document).on("click", ".disable_product", function(){
            var value = $(this).attr('id');
            if(value <= 0)
            {
                $("#title_modal").html("Disable all Product");
                $("#not_deliver").html("Are you sure? you want to Disable all product.");
                $("#delivery_on_off").modal("show");
                $("#deliver_confirm").hide();
                $("#disable_all").show();
                $(".ChangeStatus").hide();
            }
            else
            {
                $("#title_modal").html("Enable all Product");
                $("#not_deliver").html("Are you sure? you want to Enable all product.");
                $("#delivery_on_off").modal("show");
                $("#deliver_confirm").hide();
                $("#disable_all").show();
                $(".ChangeStatus").hide();
            }
        });

        //Change status for disable or enable
        $(document).on("click", "#disable_all", function(){

            var status = $('.disable_product').attr('id');
            if(status <= 0)
            {
                status = 1;
            }
            else
            {
                status = 2;
            }
            //change status
            $.ajax({
                url:"<?= site_url('Food_Listings/enableDisableProducts'); ?>",
                type:"POST",
                data: {status:status},
                success:function(data){
                    if(data == 1)
                    {
                        window.location.reload();
                    }
                }
            });
        });

        //Hide and show Availability Weeks / Date Box in Add Product and Edit Product Page
        $(document).on("change","#availability", function(){
            if($("#availability").val() == 0)
            {
                $('#show_weeks').removeClass('week_error');
                $('#show_date').removeClass('date_error');
                $('#settime').show();
                $('#show_weeks').hide();
                $('#show_date').hide();
            }
            if($("#availability").val() == 1)
            {
                $('#show_date').removeClass('date_error');
                $('#show_weeks').show();
                $('#settime').show();
                $('#show_date').hide();
            }
            if($("#availability").val() == 2)
            {
                $('#show_weeks').removeClass('week_error');
                $('#settime').show();
                $('#show_date').show();
                $('#show_weeks').hide();
            }
            if($("#availability").val() == "")
            {
                $('#show_weeks').removeClass('week_error');
                $('#show_date').removeClass('date_error');
                $('#show_date').hide();
                $('#show_weeks').hide();
                $('#settime').hide();
            }
        });

    });

</script>