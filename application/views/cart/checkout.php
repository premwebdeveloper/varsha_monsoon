<style type="text/css">
.accordeon.size-1 .checkout-accordeon-title {
    font-size: 16px;
    line-height: 40px;
    text-transform: none;
    padding: 13px 0;
    border-bottom: 1px #ebebeb solid;
    margin-top: -1px;
}
.checkout-accordeon-title {
    color: #262626;
    font-weight: 600;
    border-top: 1px #ebebeb solid;
    cursor: pointer;
    padding-right: 15px;
    position: relative;
}
.checkout-accordeon-title .number {
    display: inline-block;
    width: 40px;
    line-height: 40px;
    background: #f2f2f2;
    text-align: center;
    font-size: 18px;
    color: #262626;
    font-weight: 600;
    margin-right: 18px;
}
</style>

<div class="information-blocks" ng-app="checkoutApp" ng-controller="checkoutController">
    <div class="row">
        <div class="col-sm-9 information-entry">
            <div class="accordeon size-1">

                <?php
                if($this->ion_auth->logged_in())
                {
                    $display_login = 'style="display : none;"';
                    $display_billing = 'style="display : block;padding-bottom:20px;"';
                }
                else
                {
                    $display_login = 'style="display : block;"';
                    $display_billing = 'style="display : none;padding-bottom:20px;"';
                }
                ?>

                <div class="checkout-accordeon-title"><span class="number">1</span>Checkout Method</div>

                <div class="accordeon-entry" <?= $display_login; ?>>
                    <div class="row">

                        <div class="col-md-6 information-entry">
                            <div class="article-container style-1">

                                <p>
                                    <label class="checkbox-entry radio">
                                        <input type="radio" name="login_register" id="checkbox_login" ng-click="login_register(1)" value="1" checked> <span class="check"></span> <b>Login</b>
                                    </label>
                                    <label class="checkbox-entry radio">
                                        <input type="radio" name="login_register" id="checkbox_register" ng-click="login_register(2)" value="2"> <span class="check"></span> <b>Register</b>
                                    </label>
                                </p>

                                <p>Register with us for future convenience:</p>

                                <ul>
                                    <li>Fast and easy check out</li>
                                    <li>Easy access to your order history and status</li>
                                </ul>

                                <div class="afterLogin" ng-show="afterLogin"> </div>

                            </div>
                        </div>

                        <!-- Login section -->
                        <div class="col-md-6 information-entry" ng-show="login_section">
                            <div class="article-container style-1">
                                <h3>Registered Customers</h3>
                                <p>Lorem ipsum dolor amet, conse adipiscing, eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>

                                <form novalidate method="post" name="user_login" id="user_login" class="m-t" ng-submit="userLogin()">
                                    <div class="col-sm-12 p0">
                                        <label class="required-label">Email / Mobile</label>
                                        <?= form_input('identity', '', array('class' => 'simple-field', 'id' => 'identity', 'placeholder' => 'Email / Mobile', 'required' => 'required', 'ng-model' => 'login.identity'));?>
                                        <span style="color:red;"><?= form_error('email'); ?></span>
                                    </div>
                                    <div class="col-sm-12 pt10 p0">
                                        <label class="required-label">Password ( Password length should be minimum 8 characters ! )</label>
                                        <?= form_password('password', '', array('class' => 'simple-field', 'id' => 'password', 'placeholder' => '******', 'required' => 'required', 'ng-model' => 'login.password', 'ng-minlength' => '8')); ?>
                                    </div>
                                    <div class="col-sm-12 pt10 p0">
                                        <?= form_submit('submit', 'Login', array('class' => 'button style-10 btn-block', 'ng-disabled' => 'user_login.$invalid'));?>
                                    </div>
                                </form/>

                            </div>
                        </div>

                        <!-- Registration section -->
                        <div class="col-md-6 information-entry" ng-show="registration_section">
                            <div class="article-container style-1">
                                <h3>New Customers</h3>
                                <p>Lorem ipsum dolor amet, conse adipiscing, eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>

                                <div class="col-md-12 p0 pb10" ng-show="register_error_message">
                                    <div class="message-box message-success">
                                        <div class="message-icon"><i class="fa fa-check"></i></div>
                                            <div class="message-text" id="infoMessage1">
                                                {{ successMessage }}
                                            </div>
                                        <div class="message-close"><i class="fa fa-times"></i></div>
                                    </div>
                                </div>

                                <form novalidate method="post" name="user_registration" id="user_registration" class="m-t" ng-submit="userRegistration()">
                                    <div class="col-sm-12 p0">
                                        <label class="required-label">Email</label>
                                        <?= form_input('email', '', array('class' => 'simple-field', 'id' => 'email', 'placeholder' => 'Email', 'required' => 'required', 'ng-model' => 'register.email')); ?>
                                    </div>
                                    <div class="col-sm-12 p0">
                                        <label class="required-label">Mobile ( Please fill your 10 digit mobile number )</label>
                                        <?= form_input('mobile', '', array('class' => 'simple-field', 'id' => 'mobile', 'placeholder' => 'Mobile', 'required' => 'required', 'ng-model' => 'register.mobile', 'ng-minlength' => '10', 'ng-maxlength' => '10'));?>
                                    </div>
                                    <div class="col-sm-12 pt10 p0">
                                        <label class="required-label">Password ( Password length should be minimum 8 characters ! )</label>
                                        <?= form_password('password', '', array('class' => 'simple-field', 'id' => 'password', 'placeholder' => '******', 'required' => 'required', 'ng-model' => 'register.password', 'ng-minlength' => '8')); ?>

                                    </div>
                                    <div class="col-sm-12 pt10 p0">
                                        <?= form_submit('submit', 'Registration', array('class' => 'button style-10 btn-block', 'ng-disabled' => 'user_registration.$invalid'));?>
                                    </div>
                                </form>

                            </div>
                        </div>

                         <!-- Mobile verification section -->
                        <div class="col-md-6 information-entry" ng-show="mobile_veify_section">
                            <div class="article-container style-1">
                                <h3>Fill OTP Code sent on your mobile number.</h3>
                                <p>Lorem ipsum dolor amet, conse adipiscing, eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>

                                <div class="col-md-12 p0 pb10" ng-show="mobile_verify_message">
                                    <div class="message-box message-success">
                                        <div class="message-icon"><i class="fa fa-check"></i></div>
                                            <div class="message-text" id="infoMessage1">
                                                {{ successMessage }}
                                            </div>
                                        <div class="message-close"><i class="fa fa-times"></i></div>
                                    </div>
                                </div>

                                <form novalidate method="post" name="mobile_verify" id="mobile_verify" class="m-t" ng-submit="mobileVerify()">

                                    <input type="hidden" ng-model="verify.registered_mobile">

                                    <div class="col-sm-12 pt10 p0">
                                        <label class="required-label">OTP ( 6 digit OTP code )</label>
                                        <?= form_password('mobile_otp', '', array('class' => 'simple-field', 'id' => 'mobile_otp', 'placeholder' => '******', 'required' => 'required', 'ng-model' => 'verify.mobile_otp', 'ng-minlength' => '6', 'ng-maxlength' => '6')); ?>
                                    </div>
                                    <div class="col-sm-12 pt10 p0">
                                        <?= form_submit('submit', 'Mobile Verify', array('class' => 'button style-10 btn-block', 'ng-disabled' => 'mobile_verify.$invalid'));?>
                                    </div>
                                </form>

                            </div>
                        </div>

                    </div>
                </div>

                <div class="checkout-accordeon-title"><span class="number">2</span>Billing / Shipping Information</div>

                <div class="accordeon-entry" <?= $display_billing; ?>>
                    <div class="article-container style-1">
                        <div class="row">
                            <div class="col-md-12 mt8">

                                <!-- User exist address -->
                                <div class="style_border col-md-12 p10" id="allAddresses" ng-show="allAddresses">
                                    <h4 class="blue_color">Delivery Address</h4>
                                    <div class="col-md-12 well p0" ng-repeat="address in addresses">
                                        <table id="addressTable_{{ address.id }}">
                                            <tr>
                                                <td class="p10">
                                                    <input type="radio" name="select_address" id="select_address_{{ address.id }}" ng-click="selectedAddress(address.id)">
                                                </td>
                                                <td> <b> {{ address.name }}  {{ address.mobile }} </b> </td>
                                            </tr>
                                            <tr>
                                                <td>&nbsp;</td>
                                                <td>{{ address.address }}, {{ address.city }}, {{ address.state }},
                                                    {{ address.country }} -
                                                    <b> {{ address.zip }} </b>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>

                                <div class="col-md-12">&nbsp;</div>

                                <div class="col-md-12 style_border p10 well" ng-click="addNewAddress()">
                                    <a href="javascript:;">

                                        <div class="col-md-6 text_bold p0" style="padding-top: 5px;">
                                             <h4>ADD A NEW ADDRESS</h4>
                                        </div>

                                         <div class="col-md-6 text_bold text-right p0">
                                            <i class="fa fa-caret-up fa-2x" aria-hidden="true" ng-show="caret_up"></i>
                                            <i class="fa fa-caret-down fa-2x" aria-hidden="true" ng-show="caret_down"></i>
                                        </div>

                                    </a>
                                </div>

                                <div class="col-md-12 p0 pb10" ng-show="add_address_message">
                                    <div class="message-box message-success">
                                        <div class="message-icon"><i class="fa fa-check"></i></div>
                                            <div class="message-text" id="infoMessage">
                                                {{ successMessage }}
                                            </div>
                                        <div class="message-close"><i class="fa fa-times"></i></div>
                                    </div>
                                </div>

                                <div class="style_border col-md-12 p10" ng-show="addBlock">

                                    <div class="col-md-12 pt10 red">Please fill all required field with *</div>

                                    <form novalidate method="post" name="add_new_address" id="add_new_address" class="m-t" ng-submit="addAddress()">

                                        <div class="col-sm-6 pt10">
                                            <label class="required-label">Name</label>
                                            <?= form_input('name', '', array('class' => 'simple-field', 'id' => 'name', 'ng-model' => 'newAdd.name', 'required' => 'required', 'placeholder' => 'Name'));?>
                                            <span style="color:red;"><?= form_error('name'); ?></span>
                                        </div>

                                        <div class="col-sm-6 pt10">
                                            <label class="required-label">Mobile</label>
                                            <?= form_input('mobile', '', array('class' => 'simple-field', 'ng-pattern' => '/^[7-9][0-9]{9}$/', 'id' => 'mobile', 'ng-model' => 'newAdd.mobile', 'required' => 'required', 'placeholder' => '10 digit valid mobile number'));?>
                                            <span style="color:red;"><?= form_error('mobile'); ?></span>
                                        </div>

                                        <div class="col-sm-12 pt10">
                                            <label class="required-label">Address</label>
                                            <?= form_input('address', '', array('class' => 'simple-field', 'ng-model' => 'newAdd.address', 'required' => 'required', 'id' => 'address', 'placeholder' => 'Address'));?>
                                            <span style="color:red;"><?= form_error('address'); ?></span>
                                        </div>

                                        <div class="col-sm-6 pt10">
                                            <label class="required-label">City</label>
                                            <?= form_input('city', '', array('class' => 'simple-field', 'ng-model' => 'newAdd.city', 'required' => 'required', 'id' => 'city', 'placeholder' => 'City'));?>
                                            <span style="color:red;"><?= form_error('city'); ?></span>
                                        </div>

                                        <div class="col-sm-6 pt10">
                                            <label class="required-label">State</label>
                                            <?= form_input('state', '', array('class' => 'simple-field', 'ng-model' => 'newAdd.state', 'required' => 'required', 'id' => 'state', 'placeholder' => 'State'));?>
                                            <span style="color:red;"><?= form_error('state'); ?></span>
                                        </div>

                                        <div class="col-sm-6 pt10">
                                            <label class="required-label">Country</label>
                                            <?= form_input('country', '', array('class' => 'simple-field', 'ng-model' => 'newAdd.country', 'required' => 'required', 'id' => 'country', 'placeholder' => 'Country')); ?>
                                            <span style="color:red;"><?= form_error('country'); ?></span>
                                        </div>

                                        <div class="col-sm-6 pt10">
                                            <label class="required-label">Zip Code</label>
                                            <?= form_input('zip', '', array('class' => 'simple-field', 'ng-model' => 'newAdd.zip', 'required' => 'required', 'id' => 'zip', 'placeholder' => 'Zip Code')); ?>
                                            <span style="color:red;"><?= form_error('zip'); ?></span>
                                        </div>

                                        <div class="col-md-offset-6 col-lg-6 col-md-12 col-sm-12 pt10 text-right">

                                            <?= form_submit('submit', 'Add Address', array('class' => 'button btn-yellow', 'ng-disabled' => 'add_new_address.$invalid'));?>

                                            <a class="button btn-yellow" ng-click="addNewAddressCancel()"> Cancel </a>
                                        </div>

                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="checkout-accordeon-title"><span class="number">3</span>Order Review</div>

                <div class="accordeon-entry">
                    <div class="article-container style-1" ng-show="cartProducts">
                        <div class="traditional-cart-entry style-1 style_border pt10" style="padding-bottom: 10px;">
                            <div class="col-md-6 pb10" ng-repeat="product in cartProducts">
                                <div class="col-md-12 p0 style_border">
                                    <div class="col-md-6 p0">
                                        <a class="image" href="javascript:;" style="width:100%;">
                                            <img alt="{{ product.image }}" src="<?= base_url(); ?>uploads/listingImage/{{ product.user }}/{{ product.image }}">
                                        </a>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="cell-view">
                                            <a class="title" href="javascript:;"> {{ product.food_name }} </a>
                                            <div> {{ product.type }} ( {{ product.food_category }} ) </div>
                                            <div class="price">
                                                <div class="prev">$999</div>
                                                <div class="current">$ {{ product.price }}</div>
                                            </div>
                                            <div> Quantity : {{ product.quantity }} </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12" ng-show="!cartProducts.length">No Products</div>

                            <div class="col-md-12">
                                <div class="col-md-12 well p10">
                                    <div class="col-md-9 p0 pt10">
                                        <b>Product Order confirmation email will be sent to your registered email.</b>
                                    </div>
                                    <div class="col-md-3 text-right p0">
                                        <button class="btn btn-block btn-yellow p10">Continue</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="checkout-accordeon-title"><span class="number">4</span>Payment Information</div>

                <div class="accordeon-entry">
                    <div class="article-container style-1">
                        <p>By creating an account with our store, you will be able to move through the checkout process faster, store multiple shipping addresses, view and track your orders in your account and more.Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
                    </div>
                </div>

                <div class="checkout-accordeon-title"><span class="number">5</span>Order Summery</div>

                <div class="accordeon-entry">
                    <div class="article-container style-1">
                        <p>By creating an account with our store, you will be able to move through the checkout process faster, store multiple shipping addresses, view and track your orders in your account and more.Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
                    </div>
                </div>

            </div>
        </div>

        <!-- Sidebar start -->
        <div class="col-sm-3 information-entry">
            <h3 class="cart-column-title size-2">Your Checkout Progress</h3>
            <div class="checkout-progress-widget">
                <div class="step-entry">1. Billing Address</div>
                <div class="step-entry">2. Shipping Address</div>
                <div class="step-entry">3. Shipping Method</div>
                <div class="step-entry">4. Payment Method</div>
            </div>
            <div class="article-container style-1">
                <p>Custom CMS block displayed below the one page checkout progress block. Put your own content here.</p>
            </div>
            <div class="information-blocks">
                <a class="sale-entry vertical" href="#">
                    <span class="hot-mark yellow">hot</span>
                    <span class="sale-price"><span>-40%</span> Valentine <br/> Underwear Sale</span>
                    <span class="sale-description">Lorem ipsum dolor sitamet, conse adipisc sed do eiusmod tempor.</span>
                    <img style="" class="sale-image" src="img/text-widget-image-3.jpg" alt="" />
                </a>
            </div>
        </div>

    </div>
</div>

<script type="text/javascript">
    $('.accordeon-active').on('click', function(){
        $(this).toggleClass('active');
        $(this).next().slideToggle();
    });
</script>