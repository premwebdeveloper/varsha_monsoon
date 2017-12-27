<script>

  ////////////////////////////////////////////////////////
 ////////////////// Update user email ///////////////////
////////////////////////////////////////////////////////

var emailapp = angular.module("emailapp",[]);
emailapp.controller("emailcontroller", function($scope, $http){

    // Global variable

    var email_address = '';

    // Hide OTP and password box
    $scope.IsVisible = false;
    $scope.buttonVisible = true;
    $scope.hasError = false;
    $scope.new_email = false;
    $scope.old_email = true;

    // Email edit
    $scope.email_edit = function()
    {
        $scope.old_email = false;
        $scope.new_email = true;
        $scope.buttonVisible = true;
    }

    // Cancel edit updation
    $scope.cancel_edit = function()
    {
        $scope.old_email = true;
        $scope.new_email = false;
        $scope.IsVisible = false;
        $scope.expression = false;
        $scope.hasError = false;
        $scope.email_address = null;
    }

    // Resend OTP for edit email
    $scope.resend_edit_email_otp = function()
    {
        email_address = $scope.email_address;

        $http.post(
            "<?= base_url(); ?>user/resend_edit_email_otp",
            {'email_address':email_address}
        ).then(function(response) {
            if(response.status == 200)
            {
                $scope.errorMessage = "Resend OTP to your Email. Please submit the OTP and verify your Email.";
                $scope.hasError = true;
            }
        });
    }

    // Send email
    $scope.updateEmail = function(){

        email_address = $scope.email_address;

        $http.post(
            "<?= base_url(); ?>user/changeEmail",
            {'email_address':email_address}
        ).then(function(response) {
            if(response.status == 200)
            {
                $scope.errorMessage = "OTP sent to your Email. Please submit the OTP and verify your Email.";
                $scope.hasError = true;

                // Show otp and password
                $scope.IsVisible = $scope.IsVisible ? false : true;
                $scope.buttonVisible = false;
                $scope.expression = true;
            }
        });
    }

    // validate OTP for change email
    $scope.validateOTP = function()
    {
        $http.post(
            "<?= base_url(); ?>user/verify_otp_change_Email",
            {'filled_otp' : $scope.otp, 'email_address' : email_address}
        ).then(function(response) {
            if(response.status == 200)
            {
                data = response.data;

                if(data != 0)
                {
                    $scope.hasError = false;
                    location.reload();
                }
                else
                {
                    $scope.hasError = true;
                    $scope.errorMessage = "OTP not matched !";
                }
            }
        });
    }
});


  /////////////////////////////////////////////////////////
 ////////////////// Deactivate user Account //////////////
/////////////////////////////////////////////////////////

var deactiveapp = angular.module('deactivateapp', []);

deactiveapp.controller('deactivatecontroller', function($scope, $http, $window)
{
    $scope.deactivate_otp_password = false;
    $scope.deactiveAccError = false;
    $scope.deactiveAccButton = true;

    // On click deactivate account send otp on email show otp and password box //
    // /////////////////////////////////////////////////////////////////////// //
    $scope.deactivate_account = function deactivate_account()
    {
        // Send High secuirity OTP code to user's email
        $http.post(
            "<?= base_url(); ?>user/deactivate_otp_send",
        ).then(function(response) {

            if(response.status == 200)
            {
                // Show otp and password box
                $scope.deactiveAccButton = false;
                $scope.deactivate_otp_password = true;
                $scope.deactiveAccError = true;
                $scope.errorMessage = "OTP sent to your email. Please fill OTP to deactive your account.";
            }
        });
    }

    // Cancel deactivate account process //
    // ///////////////////////////////// //
    $scope.cancel_deactive_account = function()
    {
        $scope.deactive_pass = null;
        $scope.deactive_otp = null;
        $scope.deactivate_otp_password = false;
        $scope.deactiveAccError = false;
        $scope.deactiveAccButton = true;
    }

    // Resend OTP for deactivate account
    $scope.resend_deactive_otp = function()
    {
        $http.post(
            "<?= base_url(); ?>user/resend_deactive_otp",
        ).then(function(response) {

            if(response.status == 200)
            {
                // Show otp and password box
                $scope.deactiveAccError = true;
                $scope.errorMessage = "Resend OTP to your email.";
            }

        });
    }

    // Confirm deactivate account after submit OTP and password //
    // //////////////////////////////////////////////////////// //
    $scope.confirmDeactiveAccount = function()
    {
        // Fimally deactivate account after submit OTP and account password
        $http.post(
            "<?= base_url(); ?>user/finally_deactivate_account",
             {'otp':$scope.deactive_otp, 'password':$scope.deactive_pass}
        ).then(function(response) {
            console.log(response);

            if(response.status == 200 && response.data == 1)
            {
                // Show success message after account deactivate
                $scope.deactive_pass = null;
                $scope.deactive_otp = null;
                $scope.deactivate_otp_password = false;
                $scope.deactiveAccError = true;
                $scope.errorMessage = "Account deactivate successfully.";

                // Auto Logout user after two seconds
                $window.location = '<?= base_url(); ?>/Auth/logout';
                //$timeout(callAtTimeout, 2000);

            }
            else if(response.data == 0)
            {
                $scope.deactiveAccError = true;
                $scope.errorMessage = "Something went wrong !";
            }
            else if(response.data == 2)
            {
                $scope.deactiveAccError = true;
                $scope.errorMessage = "OTP not matched !";
            }
            else if(response.data == 3)
            {
                $scope.deactiveAccError = true;
                $scope.errorMessage = "Password did not match ! Please fill your account password.";
            }
        });
    }
});

// Two ng-app are available on single page so bootstrap calling for secong ng-app
angular.bootstrap($("#App2"), ['deactivateapp']);

/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////// Address section /////////////////////////////////
// //////////////////////////////////////////////////////////////////////////////////

var addressapp = angular.module('addressApp', []);
addressapp.controller('addressController', function($scope, $http, $element){

    // By default properties
    //$scope.for_update_address = false;
    $scope.single_address = true;
    $scope.add_address_section = false;
    $scope.caret_up = false;
    $scope.caret_down = true;
    $scope.add_address_message = false;

    $scope.show_address_section = true;

    // Add new address
    $scope.addNewAddress = function()
    {
        $scope.add_address_section = $scope.add_address_section ? false : true;
        $scope.caret_up = $scope.caret_up ? false : true;
        $scope.caret_down = $scope.caret_down ? false : true;
    }

    $scope.addAddress = function()
    {
        // Add new address
        $http.post(
            "<?= base_url(); ?>addresses/add_address",
            {'name' : $scope.newAdd.name, 'mobile' : $scope.newAdd.mobile, 'address' : $scope.newAdd.address, 'city' : $scope.newAdd.city, 'state' : $scope.newAdd.state, 'country' : $scope.newAdd.country, 'zip' : $scope.newAdd.zip}
        ).then(function(response)
        {
            console.log(response);

            if(response.status == 200)
            {
                // Null all form fields
                $scope.newAdd = null;

                var data = response.data;

                var temp = data.split('|');

                if(temp[0] > 0)
                {
                    // Add address form hide
                    $scope.add_address_section = $scope.add_address_section ? false : true;

                    // Append new address
                    $element.find("#allAddresses").append('<div class="col-md-12 style_border p0 pt10 mb20 ?>"><div class="col-sm-12 p10"><div class="col-sm-11 col-xs-11"> '+temp[1]+' ( '+temp[2]+' ) </p><p class="pt10"> '+temp[3]+', '+temp[4]+', '+temp[5]+', '+temp[6]+' - '+temp[7]+'</p></div> <div class="col-sm-1 col-xs-1 p0"><div class="header-top-entry p0"><i class="fa fa-caret-down fa-2x" style="position:relative;left:30px;"></i><div class="list" style="left: -80px;top: 25px;"> <a class="list-entry set_default_address" id="set_default_'+temp[0]+'" href="javascript:;">Set as Default</a> <a class="list-entry" href="javascript:;">Update Address</a><a class="list-entry delete_address" id="delete_address_'+temp[0]+'" href="javascript:;">Delete Address</a> </div> </div></div></div></div>');

                    $scope.successMessage = "Add new address successfully.";
                    $scope.add_address_message = $scope.add_address_message ? false : true;
                }
                else
                {
                    $scope.successMessage = "Something went wrong !";
                    $scope.add_address_message = $scope.add_address_message ? false : true;
                }
            }
        });
    }

    // Update address
    $scope.update_address = function(obj)
    {
        var id = obj.target.attributes.id.value;
        var temp = id.split('_');

        var address_id = temp[2];

        $http.post(
            "<?= base_url(); ?>addresses/get_edit_address_form",
            {'address_id' : address_id}
        ).then(function(response)
        {
            var data = response.data;

            // First blank all edit form
            $element.find('.for_update_address').html('');

            // Show if clicked address is hide
            $('.single_address').show('');

            $('#single_address_'+address_id).hide('');

            $element.find('#for_update_address_'+address_id).append(data);

            $('#for_update_address_'+address_id).removeClass('ng-hide');
        });
    }
});


/////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////// Product searching , sorting, filteraion /////////////////////////////////
// //////////////////////////////////////////////////////////////////////////////////////////////////////////

var productapp = angular.module('productApp', ['ui.bootstrap']);

    productapp.filter('startFrom', function() {
        return function(input, start) {
            if(input) {
                start = +start; //parse to int
                return input.slice(start);
            }
            return [];
        }
    });

    productapp.controller('productController', function($scope, $http, $filter, $element){

        // Get all day meals breakfast / lunch / dinner
        $http.get('<?= base_url(); ?>product/getDayMeals').success(function(data){
            $scope.dayMeals = data;
        });

        // Get all food types
        $http.get('<?= base_url(); ?>product/getFoodTypes').success(function(data){
            $scope.foodTypes = data;
        });

        // Get all Product categories
        $http.get('<?= base_url(); ?>product/getFoodCategory').success(function(data){
            $scope.foodCategories = data;
        });

        // Onclick product category
        $scope.selectedCat = 0;

        $scope.selectProductCategory = function(catID, dayMealId, foodTypeId)
        {
            // Get selected day meals ////////////////////////////
                var idx = $scope.selectedDayMeals.indexOf(dayMealId);

                if (idx > -1) {
                  $scope.selectedDayMeals.splice(idx, 1);
                }

                // is newly selected day meal
                else {
                  $scope.selectedDayMeals.push(dayMealId);
                }
            //////////////////////////////////////////////////////


            // Get selected Food Types////////////////////////////
                var idxx = $scope.selectedFoodTypes.indexOf(foodTypeId);

                if (idxx > -1) {
                  $scope.selectedFoodTypes.splice(idxx, 1);
                }

                else {
                  $scope.selectedFoodTypes.push(foodTypeId);
                }
            ///////////////////////////////////////////////////

            // First check product category selected or not // If not then select else deselect
            var myElement = $element.find('.category_highlight');

            if (myElement.length == 0)
            {
                // Set active class on clicked category
                $scope.selectedCat = catID;
            }
            else
            {
                if($scope.selectedCat == catID)
                {
                    // inactive class on clicked category
                    $scope.selectedCat = 0;
                }
                else
                {
                    // Set active class on clicked category
                    $scope.selectedCat = catID;
                }

            }

            // Search products onclick product category //
            $http.post(
                "<?= base_url(); ?>product/getProducts",
                {'category' : $scope.selectedCat, 'selectedDayMeals' : $scope.selectedDayMeals, 'selectedFoodTypes' : $scope.selectedFoodTypes}
            ).then(function(response) {

                console.log(response);

                $scope.list = response.data;

                $scope.currentPage = 1;
                $scope.entryLimit = 4; //max no of items to display in a page
                $scope.filteredItems = $scope.list.length; //Initially for no filter
                $scope.totalItems = $scope.list.length;
            });
        }

        // Define an array for selected food types
        $scope.selectedFoodTypes = [];

        // Define an array for selected day meals
        $scope.selectedDayMeals = [];

        $scope.selectedType = {};

        // On channge day meals filter products
        $scope.dayMealChange = function dayMealChange(dayMealId, foodTypeId) {

            // Get selected product category/////////////////////////////////
            var catID = angular.element('.category_highlight').attr('id');
            if(angular.isUndefined(catID) || catID === null )
            {
                cat_id = 0;
            }
            else
            {
                var temp = catID.split('_');
                var cat_id = temp[1];
            }

            $scope.cat_id = cat_id;
            //////////////////////////////////////////////////////

            // is currently selected day meals///////////////////////
            var idx = $scope.selectedDayMeals.indexOf(dayMealId);

            if (idx > -1) {
              $scope.selectedDayMeals.splice(idx, 1);
            }

            // is newly selected day meal
            else {
              $scope.selectedDayMeals.push(dayMealId);
            }
            /////////////////////////////////////////////////

            // Get selected Food Types//////////////////////////////////
           var idxx = $scope.selectedFoodTypes.indexOf(foodTypeId);

            if (idxx > -1) {
              $scope.selectedFoodTypes.splice(idxx, 1);
            }

            else {
              $scope.selectedFoodTypes.push(foodTypeId);
            }
            /////////////////////////////////////////////////

            $http.post(
                "<?= base_url(); ?>product/getProducts",
                {'category' : $scope.cat_id, 'selectedDayMeals' : $scope.selectedDayMeals, 'selectedFoodTypes' : $scope.selectedFoodTypes}
            ).then(function(response) {

                console.log(response);

                $scope.list = response.data;

                $scope.currentPage = 1;
                $scope.entryLimit = 4; //max no of items to display in a page
                $scope.filteredItems = $scope.list.length; //Initially for no filter
                $scope.totalItems = $scope.list.length;
            });
        };

        // Get all food types Pure Veg / Nonveg ///////////////////////////////////
        // ////////////////////////////////////////////////////////////////////////

        $scope.foodTypeChange = function foodTypeChange(foodTypeId, dayMealId) {

            // Get selected product category/////////////////////////////
            var catID = angular.element('.category_highlight').attr('id');
            if(angular.isUndefined(catID) || catID === null )
            {
                cat_id = 0;
            }
            else
            {
                var temp = catID.split('_');
                var cat_id = temp[1];
            }

            $scope.cat_id = cat_id;
            ///////////////////////////////////////

            ///////////////////////////////////////
            var idx = $scope.selectedFoodTypes.indexOf(foodTypeId);

            // is currently selected
            if (idx > -1) {
              $scope.selectedFoodTypes.splice(idx, 1);
            }

            // is newly selected
            else {
              $scope.selectedFoodTypes.push(foodTypeId);
            }
            //////////////////////////////////////////////

            ///////////////////////////////////////////////////////
            var idxxx = $scope.selectedDayMeals.indexOf(dayMealId);

            // is currently selected day meals
            if (idxxx > -1) {
              $scope.selectedDayMeals.splice(idxxx, 1);
            }

            else {
              $scope.selectedDayMeals.push(dayMealId);
            }
            ////////////////////////////////////////////////////

            $http.post(
                "<?= base_url(); ?>product/getProducts",
                {'category' : $scope.cat_id, 'selectedFoodTypes' : $scope.selectedFoodTypes, 'selectedDayMeals' : $scope.selectedDayMeals}
            ).then(function(response) {

                $scope.list = response.data;

                $scope.currentPage = 1;
                $scope.entryLimit = 4; //max no of items to display in a page
                $scope.filteredItems = $scope.list.length; //Initially for no filter
                $scope.totalItems = $scope.list.length;
            });
        };

        // Get all products //////////////////////////////////////////////////////
        // ///////////////////////////////////////////////////////////////////////
        $http.get('<?= base_url(); ?>product/getProducts').success(function(data){

            $scope.list = data;
            $scope.currentPage = 1; //current page
            $scope.entryLimit = 4; //max no of items to display in a page
            $scope.filteredItems = $scope.list.length; //Initially for no filter
            $scope.totalItems = $scope.list.length;
        });

        // Order by Price  ( High to low  || Low to high ) //
        // //////////////////////////////////////////////////
        $scope.orderByPrice = function (list) {

            if ($scope.orderBy == 'price-low-high') {
                return parseFloat(list.price);
            }
            if ($scope.orderBy == 'price-high-low') {
                return -parseFloat(list.price);
            }
            else return parseFloat(list.price);
        };

        // on click page number show data and go on clicked page number //
        // ////////////////////////////////
        $scope.setPage = function(pageNo) {
           $scope.currentPage = pageNo;
        };

        $scope.filter = function() {
            $timeout(function() {
                $scope.filteredItems = $scope.filtered.length;
            }, 20);
        };

        /*$scope.sort_by = function(predicate) {
            alert('3');
            $scope.predicate = predicate;
            $scope.reverse = !$scope.reverse;
        };*/

    });

/////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////// Checkout products ///////////////////////////////////////////////////////
// //////////////////////////////////////////////////////////////////////////////////////////////////////////

var checkoutapp = angular.module("checkoutApp", []);

checkoutapp.controller("checkoutController", function($scope, $http, $element, $compile){

    // Hide Top header on check out page
    $(".header-top").hide();
    $(".header-middle").hide();

    // Login / Registration Section /////
    // /////////////////////////////////

    $scope.login_section = true;
    $scope.register_error_message = false;
    $scope.registration_section = false;
    $scope.mobile_veify_section = false;
    $scope.afterLogin = false;

    $scope.cartProducts = false;

    // Select User registration form
    $scope.login_register = function(id)
    {
        if(id == 2)
        {
            $scope.login_section = false;
            $scope.mobile_veify_section = false;
            $scope.afterLogin = false;
            $scope.register_error_message = false;
            $scope.registration_section = true;
        }
        if(id == 1)
        {
            $scope.registration_section = false;
            $scope.mobile_veify_section = false;
            $scope.afterLogin = false;
            $scope.register_error_message = false;
            $scope.login_section = true;
        }
    }

    // User Registration
    $scope.userRegistration = function()
    {
        $http.post(
            "<?= base_url(); ?>auth/user_registration",
            {'email' : $scope.register.email, 'mobile' : $scope.register.mobile, 'password' : $scope.register.password}
        ).then(function(response)
        {
            if(response.data == 1)
            {
                $scope.verify = {
                    registered_mobile : $scope.register.mobile
                }
                $scope.register = null;
                $scope.registration_section = false;
                $scope.mobile_veify_section = true;
            }
            else if(response.data == 2)
            {
                // invalid password
                $scope.successMessage = "Password must be 8 characters length !";
                $scope.register_error_message = true;
            }
            else if(response.data == 3)
            {
                // invalid mobile
                $scope.successMessage = "Invalid mobile number !";
                $scope.register_error_message = true;
            }
            else if(response.data == 4)
            {
                // invalid email
                $scope.successMessage = "Invalid email !";
                $scope.register_error_message = true;
            }
            else if(response.data == 5)
            {
                // Exist email
                $scope.successMessage = "Email already Exist !";
                $scope.register_error_message = true;
            }
            else if(response.data == 6)
            {
                // Exist email
                $scope.successMessage = "Mobile number already exist !";
                $scope.register_error_message = true;
            }
            else
            {
                // Something went wrong
                $scope.successMessage = "Something went wrong !";
                $scope.register_error_message = true;
            }
        });
    }

    // Mobile verification
    $scope.mobileVerify = function()
    {
        $http.post(
            "<?= base_url(); ?>auth/mobile_verification",
            {'mobile_otp' : $scope.verify.mobile_otp, 'registered_mobile' : $scope.verify.registered_mobile}
        ).then(function(response){

            console.log(response);

            if(response.data == 1)
            {
                $scope.verify = null;
                $scope.mobile_veify_section = false;
                $scope.mobile_verify_message = false;
                $scope.login_section = true;

                var login_success = '<h3>Registration Successful. <i class="fa fa-check" aria-hidden="true"></i></h3>';

                $element.find(".afterLogin").html($compile(login_success)($scope));

                $scope.afterLogin = true;

                $element.find("#checkbox_register").attr('checked', 'checked');

                $("#checkbox_login").prop("checked", true);
                $("#checkbox_register").prop("checked", false);

            }
            else if(response.data == 0)
            {
                $scope.successMessage = "Something went wrong !";
                $scope.mobile_verify_message = true;
            }
            else if(response.data == 2)
            {
                $scope.successMessage = "OTP not matched !";
                $scope.mobile_verify_message = true;
            }
        });
    }

    // Login first if user not logged in
    $scope.userLogin = function()
    {
        $http.post(
            "<?= base_url(); ?>auth/user_login",
            {'identity' : $scope.login.identity, 'password' : $scope.login.password}
        ).then(function(response)
        {
            console.log(response);
            if(response.status == 200)
            {
                if(response.data == 0)
                {
                    var login_failure = '<h3> Invalid Credentials !</h3>';

                    $element.find(".afterLogin").html($compile(login_failure)($scope));

                    $scope.afterLogin = true;
                }
                else
                {
                    var user_id = response.data.user_id;
                    var user_full_name = response.data.user_full_name;
                    var user_group = response.data.user_group;

                    $scope.login = null;

                    var login_success = '<h3>Login <i class="fa fa-check" aria-hidden="true"></i></h3> <h4>'+user_full_name+'</h4><a class="button btn-yellow"> Continue </a>';

                    $element.find(".afterLogin").html($compile(login_success)($scope));

                    $scope.afterLogin = true;

                    // Show Exist Addresses
                    $http.get('<?= base_url(); ?>Addresses/getAllAddresses').success(function(data){
                        $scope.addresses = data;
                    });

                    $scope.cartProducts = true;

                    // Show Booked Orders
                    $http.get('<?= base_url(); ?>Cart/getCartProducts').success(function(data){
                        $scope.cartProducts = data;
                    });
                }
            }
            else
            {
                var login_failure = '<h3> Invalid Credentials !</h3>';

                $element.find(".afterLogin").html($compile(login_failure)($scope));

                $scope.afterLogin = true;
            }

        });
    }


    // Billing / Shipping information //
    // /////////////////////////////////

    // Get user's exist addresses
    $http.get('<?= base_url(); ?>Addresses/getAllAddresses').success(function(data){
        $scope.addresses = data;
        if($scope.addresses.length > 0)
        {
            $scope.allAddresses = true;
        }
    });

    // By default hide ad new address section
    $scope.add_address_message = false;
    $scope.addBlock = false;
    $scope.caret_up = false;
    $scope.caret_down = true;

    // Add New Address button
    $scope.addNewAddress = function(){
        $scope.addBlock = $scope.addBlock ? false : true;
        $scope.caret_up = $scope.caret_up ? false : true;
        $scope.caret_down = $scope.caret_down ? false : true;
    }

    // Cancel Add Ne Address button
    $scope.addNewAddressCancel = function(){
        $scope.addBlock = $scope.addBlock ? false : true;
        $scope.caret_up = $scope.caret_up ? false : true;
        $scope.caret_down = $scope.caret_down ? false : true;
    }

    // Add New Address
    $scope.addAddress = function()
    {
        $http.post(
            "<?= base_url(); ?>addresses/add_address",
            {'name' : $scope.newAdd.name, 'mobile' : $scope.newAdd.mobile, 'address' : $scope.newAdd.address, 'city' : $scope.newAdd.city, 'state' : $scope.newAdd.state, 'country' : $scope.newAdd.country, 'zip' : $scope.newAdd.zip}
        ).then(function(response)
        {
            console.log(response);

            if(response.status == 200)
            {
                // Null all form fields
                $scope.newAdd = null;

                var data = response.data;

                var temp = data.split('|');

                if(temp[0] > 0)
                {
                    // Add address form hide
                    $scope.addBlock = $scope.addBlock ? false : true;

                    // Show all addresses
                    $scope.allAddresses = true;

                    // Append new address
                    $element.find("#allAddresses").append('<div class="col-md-12 well p0" ng-repeat="address in addresses"><table><tr><td class="p10"><input type="radio" name="select_address" id="select_address_'+temp[0]+'" ng-click="selectedAddress('+temp[0]+')"></td><td> <b> '+temp[1]+'  '+temp[2]+' </b> </td></tr><tr><td>&nbsp;</td><td> '+temp[3]+', '+temp[4]+', '+temp[5]+', '+temp[6]+' - <b> '+temp[7]+' </b></td></tr></table></div>');

                    $scope.successMessage = "Add new address successfully.";
                    $scope.add_address_message = $scope.add_address_message ? false : true;
                }
                else
                {
                    $scope.successMessage = "Something went wrong !";
                    $scope.add_address_message = $scope.add_address_message ? false : true;
                }
            }
        });
    }

    // Show Deliver Here button after select any address
    $scope.selectedAddress = function(addresss_id)
    {
        // First find alredy exist deliver here button and remove
        var myEl = angular.element( document.querySelector( '.deliver_here' ) );
        myEl.remove();

        var html = '<tr class="deliver_here" id="deliver_here_'+addresss_id+'"><td>&nbsp;</td><td style="padding-bottom:5px;"><button class="btn btn-blue" ng-click="deliverHere()">Deliver Here</button></td></tr>';

        $element.find("#addressTable_"+addresss_id).append($compile(html)($scope));
    }

    // Click on deliver here button
    $scope.deliverHere = function()
    {
        alert('hi');
    }

    // Order review section //
    // //////////////////////

    // Get all booked products / exist in cart
    $http.get('<?= base_url(); ?>Cart/getCartProducts').success(function(data){
        $scope.cartProducts = data;
    });


});

</script>