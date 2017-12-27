<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?= $this->breadcrumbs->show(); ?>
<div class="information-blocks">
    <div class="row">
        <div class="col-md-3 information-entry blog-sidebar">
            <div class="information-blocks">
                <div class="categories-list">
                    <div class="block-title size-3">Blog Categories</div>
                    <ul>
                        <li><a href="#">All about clothing<span>(5)</span></a></li>
                        <li><a href="#">Make-up &amp; beauty<span>(2)</span></a></li>
                        <li><a href="#">Accessories <span>(0)</span></a></li>
                        <li><a href="#">Fashion trends<span>(11)</span></a></li>
                        <li><a href="#">Haircuts &amp; hairstyles<span>(7)</span></a></li>
                    </ul>
                </div>
            </div>
            <div class="information-blocks">
                <h3 class="block-title inline-product-column-title">Recent Posts</h3>
                <div class="inline-product-entry">
                    <a class="image" href="#"><img src="<?= base_url(); ?>frontend_assets/img/product-image-inline-4.jpg" alt=""></a>
                    <div class="content">
                        <div class="cell-view">
                            <a class="title" href="#">New collection from Armiani 2013</a>
                            <div class="description">Posted 04 November 2014</div>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="inline-product-entry">
                    <a class="image" href="#"><img src="<?= base_url(); ?>frontend_assets/img/product-image-inline-5.jpg" alt=""></a>
                    <div class="content">
                        <div class="cell-view">
                            <a class="title" href="#">New collection from Armiani 2013</a>
                            <div class="description">Posted 04 November 2014</div>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="inline-product-entry">
                    <a class="image" href="#"><img src="<?= base_url(); ?>frontend_assets/img/product-image-inline-6.jpg" alt=""></a>
                    <div class="content">
                        <div class="cell-view">
                            <a class="title" href="#">New collection from Armiani 2013</a>
                            <div class="description">Posted 04 November 2014</div>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
            <div class="information-blocks">
                <h3 class="block-title inline-product-column-title">Popular Tags</h3>
                <div class="tags-box">
                    <a href="#">Fashion</a>
                    <a href="#">Clothing</a>
                    <a href="#">Trends</a>
                    <a href="#">2015</a>
                    <a href="#">Summer</a>
                    <a href="#">New</a>
                </div>
            </div>

        </div>
        <div class="col-md-9 information-entry">
            <div class="blog-landing-box type-3">
                <?php
                foreach ($blogs as $blog)
                {
                ?>
                <div class="blog-entry">
                    <a class="image hover-class-1" href="<?= base_url('Blog/view'); ?>/<?= $blog['id']; ?>"><img src="<?= base_url(); ?>uploads/blog/<?= $blog['image']; ?>" alt=""><span class="hover-label">Read More</span></a>
                    <div class="date">
                        <?php
                            $timestamp = strtotime(convert_date_format($blog['updated_date']));
                            echo date("d", $timestamp);
                         ?>
                        <span>
                            <?= date('M ', $timestamp); ?>
                        </span>
                    </div>
                    <div class="content">
                        <a class="title" href="<?= base_url('Blog/view'); ?>/<?= $blog['id']; ?>"><?= $blog['title']; ?></a>
                        <div class="subtitle">Posted <?= date('H:i:s jS M, Y', strtotime($blog['created_date'])); ?> by <a href="#"><b><?= $blog['create_by'];?></b></a>  /  Category: <a href="javascript:;"><?= $blog['category']; ?></a></div>
                        <div class="description"><?php
                                    echo $string = preg_replace('/\s+?(\S+)?$/', '', substr($blog['description'], 0, 150));
                                ?>...</div>
                        <a class="readmore" href="#">read more</a>
                    </div>
                </div>
                <?php
                }
                ?>
            </div>
            <div class="page-selector">
                <div class="description">Showing: 1-3 of 16</div>
                <div class="pages-box">
                    <a class="square-button active" href="#">1</a>
                    <a class="square-button" href="#">2</a>
                    <a class="square-button" href="#">3</a>
                    <div class="divider">...</div>
                    <a class="square-button" href="#"><i class="fa fa-angle-right"></i></a>
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </div>
</div>