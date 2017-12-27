<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?= $this->breadcrumbs->show(); ?>

<div ng-app="productApp" ng-controller="productController">
    <div class="information-blocks">
        <div class="row">

            <!-- Paroduct page sidebar start -->
            <div class="col-md-3">

                <div class="information-blocks categories-border-wrapper">

                    <!-- Quick Filter -->
                    <div class="block-title size-3">Quick Filter</div>
                    <div class="accordeon">
                        <div class="article-container style-1 p10">
                            <div class="form-group1" ng-repeat="foodType in foodTypes">

                                <input type="checkbox" id="{{foodType.id}}" value="{{foodType.id}}" ng-checked="selection.indexOf(foodType.id) > -1" ng-click="foodTypeChange(foodType.id)">
                                {{foodType.type}}

                            </div>
                        </div>
                    </div>

                    <!-- Day Meals -->
                    <div class="block-title size-3">Day Meals</div>
                    <div class="accordeon">
                        <div class="article-container style-1 p10">

                            <div class="form-group1" ng-repeat="dayMeal in dayMeals">

                                <input type="checkbox" id="{{dayMeal.id}}" value="{{dayMeal.id}}" ng-checked="selection.indexOf(dayMeal.id) > -1" ng-click="dayMealChange(dayMeal.id)">
                                {{dayMeal.meal_name}}

                            </div>

                        </div>
                    </div>

                    <!-- Cuisine -->
                    <div class="block-title size-3">Cuisine</div>
                    <div class="article-container style-1">
                        <ul>
                            <li ng-repeat="category in foodCategories">
                                <a href="javascript:;" ng-class="{category_highlight : selectedCat === category.id}" ng-click="selectProductCategory(category.id)" id="cat_{{category.id}}">{{category.food_category}}</a>
                            </li
                        </ul>
                    </div>
                </div>

                <div class="information-blocks">
                    <div class="block-title size-2">Sort by sizes</div>
                    <div class="range-wrapper">
                        <div id="prices-range"></div>
                        <div class="range-price">
                            Price:
                            <div class="min-price"><b>$<span>0</span></b></div>
                            <b>-</b>
                            <div class="max-price"><b>$<span>500</span></b></div>
                        </div>
                        <a class="button style-14">filter</a>
                    </div>
                </div>

            </div>

            <!-- Products section start -->
            <div class="col-md-9">

                <div class="page-selector" style="padding: 15px 0 15px 0;">
                    <div class="shop-grid-controls">

                        <div class="col-md-4">
                            <div class="inline-text pb10">Sort by :</div>
                            <select class="form-control" ng-model="orderBy">
                                <option value="" selected="selected">Sort By</option>
                                <option value="price-low-high">Price Low-High</option>
                                <option value="price-high-low">Price High-Low</option>
                                <option>Rating</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <div class="inline-text pb10">Per Page :</div>
                            <select ng-model="entryLimit" class="form-control">
                                <option>4</option>
                                <option>8</option>
                                <option>12</option>
                                <option>40</option>
                                <option>100</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <div class="inline-text pb10">Search :</div>
                            <input type="text" ng-model="search" ng-change="filter()" placeholder="Search" class="form-control" />
                        </div>

                    </div>
                    <div class="clear"></div>
                </div>

                <div class="row shop-grid grid-view">

                    <!-- Ng repeat -->
                    <div class="col-md-3 col-sm-4 shop-grid-item" ng-repeat="data in filtered = (list | filter:search | orderBy : orderByPrice : predicate :reverse : order) | startFrom:(currentPage-1)*entryLimit | limitTo:entryLimit">
                        <div class="product-slide-entry shift-image style_border products" id="">

                            <div class="product-image">
                                <a href="<?= site_url('product/view'); ?>/{{data.id}}">
                                    <img src="<?= base_url();?>uploads/listingImage/{{data.user_id}}/{{data.image}}" alt="{{data.image}}" />
                                    <img src="<?= base_url();?>uploads/listingImage/{{data.user_id}}/{{data.image}}" alt="{{data.image}}" />
                                </a>
                            </div>

                            <a class="title" href="<?= site_url('product/view'); ?>/{{data.id}}">{{data.food_name}}</a>

                            <div class="rating-box">
                                <div class="star"><i class="fa fa-star-o"></i></div>
                                <div class="star"><i class="fa fa-star-o"></i></div>
                                <div class="star"><i class="fa fa-star-o"></i></div>
                                <div class="star"><i class="fa fa-star-o"></i></div>
                                <div class="star"><i class="fa fa-star-o"></i></div>
                                <div class="reviews-number">25 reviews</div>
                            </div>

                            <div class="price">
                                <div class="prev"><i class="fa fa-inr" aria-hidden="true"></i>199,99</div>
                                <div class="current"><i class="fa fa-inr" aria-hidden="true"></i> {{data.price}} </div>
                            </div>

                        </div>
                        <div class="clear"></div>
                    </div>

                    <!-- If no products found -->
                    <div class="col-md-12" ng-show="filteredItems == 0">
                        <div class="col-md-12">
                            <h4>No products found</h4>
                        </div>
                    </div>

                    <!-- Pagination -->
                    <div class="col-md-12 text-right" ng-show="filteredItems > 0">
                        <div pagination="" page="currentPage" on-select-page="setPage(page)" boundary-links="true" total-items="filteredItems" items-per-page="entryLimit" class="pagination-small" previous-text="&laquo;" next-text="&raquo;">
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url(); ?>frontend_assets/js/ui-bootstrap-tpls-0.10.0.min.js"></script>