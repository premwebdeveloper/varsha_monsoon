<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?= $this->breadcrumbs->show(); ?>
<div class="information-blocks">
    <div class="row">
        <div class="col-md-9 col-md-push-3 col-sm-8 col-sm-push-4">
            <div class="well article-container"><h3 class="blue_color"><?= urldecode($food_category_name); ?></h3></div>
            <div class="page-selector">
                <div class="pages-box hidden-xs">
                    <a href="#" class="square-button active">1</a>
                    <a href="#" class="square-button">2</a>
                    <a href="#" class="square-button">3</a>
                    <div class="divider">...</div>
                    <a href="#" class="square-button"><i class="fa fa-angle-right"></i></a>
                </div>
                <div class="shop-grid-controls">
                    <div class="entry">
                        <div class="inline-text">Sorty by</div>
                        <div class="simple-drop-down">
                            <select>
                                <option>Position</option>
                                <option>Price</option>
                                <option>Category</option>
                                <option>Rating</option>
                                <option>Color</option>
                            </select>
                        </div>
                        <div class="sort-button"></div>
                    </div>
                    <div class="entry">
                        <div class="view-button active grid"><i class="fa fa-th"></i></div>
                        <div class="view-button list"><i class="fa fa-list"></i></div>
                    </div>
                    <div class="entry">
                        <div class="inline-text">Show</div>
                        <div class="simple-drop-down" style="width: 75px;">
                            <select>
                                <option>10</option>
                                <option>20</option>
                                <option>30</option>
                                <option>40</option>
                                <option>all</option>
                            </select>
                        </div>
                        <div class="inline-text">per page</div>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="row shop-grid grid-view">
                <?php
                foreach($foods as $food)
                {
                ?>
                    <div class="col-md-3 col-sm-4 shop-grid-item">
                        <div class="product-slide-entry shift-image">
                            <div class="product-image">
                                <a href="<?= site_url('product/view'); ?>/<?= $food['id']; ?>">
                                    <img src="<?= base_url();?>/uploads/listingImage/<?= $food['user_id'];?>/<?= $food['image'];?>" alt="" />
                                    <img src="<?= base_url();?>/uploads/listingImage/<?= $food['user_id'];?>/<?= $food['image'];?>" alt="" />
                                </a>
                                <div class="bottom-line left-attached">
                                    <a class="bottom-line-a square" title="Add to Wishlist">
                                        <i class="fa fa-heart"></i>
                                    </a>
                                    <a class="bottom-line-a square open-product" href="javascript:;" id="view_<?= $food['id']; ?>" title="View">
                                        <i class="fa fa-expand"></i>
                                    </a>
                                </div>
                            </div>
                            <a class="tag" href="#"><?= $food['types']; ?></a>
                            <a class="title" href="<?= site_url('product/view'); ?>/<?= $food['id']; ?>"><?= $food['food_name']; ?></a>
                            <div class="rating-box">
                                <div class="star"><i class="fa fa-star"></i></div>
                                <div class="star"><i class="fa fa-star"></i></div>
                                <div class="star"><i class="fa fa-star"></i></div>
                                <div class="star"><i class="fa fa-star"></i></div>
                                <div class="star"><i class="fa fa-star"></i></div>
                                <div class="reviews-number">25 reviews</div>
                            </div>
                            <div class="article-container style-1">
                                <p>
                                <?php
                                    echo $string = preg_replace('/\s+?(\S+)?$/', '', substr($food['description'], 0, 65));
                                ?>...</p>
                            </div>
                            <div class="price">
                                <div class="prev"><i class="fa fa-inr" aria-hidden="true"></i>199,99</div>
                                <div class="current"><i class="fa fa-inr" aria-hidden="true"></i><?= $food['price']; ?></div>
                            </div>
                            <div class="list-buttons">
                                <a class="button style-10">Add to cart</a>
                                <a class="button style-11"><i class="fa fa-heart"></i> Add to Wishlist</a>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                <?php
                }
                ?>
            </div>
            <div class="page-selector">
                <div class="description">Showing: 1-3 of 16</div>
                <div class="pages-box">
                    <a href="#" class="square-button active">1</a>
                    <a href="#" class="square-button">2</a>
                    <a href="#" class="square-button">3</a>
                    <div class="divider">...</div>
                    <a href="#" class="square-button"><i class="fa fa-angle-right"></i></a>
                </div>
                <div class="clear"></div>
            </div>
        </div>
        <div class="col-md-3 col-md-pull-9 col-sm-4 col-sm-pull-8 blog-sidebar">
            <div class="information-blocks categories-border-wrapper">
                <div class="block-title size-3">Categories</div>
                <div class="accordeon">
                    <div class="accordeon-title">Bags &amp; Accessories</div>
                    <div class="accordeon-entry">
                        <div class="article-container style-1">
                            <ul>
                                <li><a href="#">Bags &amp; Accessories</a></li>
                                <li><a href="#">Man's Products</a></li>
                                <li><a href="#">Woman's Products</a></li>
                                <li><a href="#">Top Brands</a></li>
                                <li><a href="#">Special Offer</a></li>
                                <li><a href="#">Leather's Products</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="accordeon-title">Man's Products</div>
                    <div class="accordeon-entry">
                        <div class="article-container style-1">
                            <ul>
                                <li><a href="#">Bags &amp; Accessories</a></li>
                                <li><a href="#">Man's Products</a></li>
                                <li><a href="#">Woman's Products</a></li>
                                <li><a href="#">Top Brands</a></li>
                                <li><a href="#">Special Offer</a></li>
                                <li><a href="#">Leather's Products</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="accordeon-title">Woman's Products</div>
                    <div class="accordeon-entry">
                        <div class="article-container style-1">
                            <ul>
                                <li><a href="#">Bags &amp; Accessories</a></li>
                                <li><a href="#">Man's Products</a></li>
                                <li><a href="#">Woman's Products</a></li>
                                <li><a href="#">Top Brands</a></li>
                                <li><a href="#">Special Offer</a></li>
                                <li><a href="#">Leather's Products</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="accordeon-title">Top Brands</div>
                    <div class="accordeon-entry">
                        <div class="article-container style-1">
                            <ul>
                                <li><a href="#">Bags &amp; Accessories</a></li>
                                <li><a href="#">Man's Products</a></li>
                                <li><a href="#">Woman's Products</a></li>
                                <li><a href="#">Top Brands</a></li>
                                <li><a href="#">Special Offer</a></li>
                                <li><a href="#">Leather's Products</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="accordeon-title">Special Offer</div>
                    <div class="accordeon-entry">
                        <div class="article-container style-1">
                            <ul>
                                <li><a href="#">Bags &amp; Accessories</a></li>
                                <li><a href="#">Man's Products</a></li>
                                <li><a href="#">Woman's Products</a></li>
                                <li><a href="#">Top Brands</a></li>
                                <li><a href="#">Special Offer</a></li>
                                <li><a href="#">Leather's Products</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="accordeon-title">Leather's Products</div>
                    <div class="accordeon-entry">
                        <div class="article-container style-1">
                            <ul>
                                <li><a href="#">Bags &amp; Accessories</a></li>
                                <li><a href="#">Man's Products</a></li>
                                <li><a href="#">Woman's Products</a></li>
                                <li><a href="#">Top Brands</a></li>
                                <li><a href="#">Special Offer</a></li>
                                <li><a href="#">Leather's Products</a></li>
                            </ul>
                        </div>
                    </div>
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
    </div>
</div>