<div class="information-blocks">
    <div class="row">

        <div class="col-md-9 col-md-push-3 information-entry">
            <div class="blog-landing-box type-1 detail-post">
                <div class="blog-entry pt30">
                    <span class="image"><img style="height: 370px; width:870px;" src="<?= base_url(); ?>uploads/blog/<?= $blog['image']; ?>" alt="" /></span>
                    <div class="content">
                        <h1 class="title"><?= $blog['title']; ?></h1>
                        <div class="subtitle">Posted <?= date('H:i:s jS M, Y', strtotime($blog['created_date'])); ?> by <b class="blue_color text_bold"><?= $blog['create_by'];?></b>  /  Category:  <a href="javascript:;"><?= $blog['category']; ?></a></div>
                        <div class="article-container style-1">
                            <p><?= $blog['description']; ?></p>
                        </div>
                        <div class="detail-post-tags">
                            <b>Tags:</b>  <a href="#">apparel</a>, <a href="#">celebrity</a>, <a href="#">clothings</a>, <a href="#">cool t-shirts</a>, <a href="#">fashion</a>, <a href="#">halothemes</a>, <a href="#">jackets</a>, <a href="#">shoes</a>
                        </div>
                    </div>
                </div>
                <div class="blog-entry">
                    <h3 class="additional-blog-title">Comments Posted (2)</h3>
                    <div class="comment">
                        <a class="comment-image" href="#"><img src="img/comment-1.jpg" alt="" /></a>
                        <div class="comment-content">
                            <div class="comment-title"><span>Christopher</span>  Posted 06:12PM, 25 December 2015</div>
                            <div class="comment-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, eiusmod tempor incididunt ut labore. Lorem ipsum dolor sit amet, consectetur adipiscing elit, eiusmod tempor incididunt ut labore et dolore magna aliqua.</div>
                        </div>
                    </div>
                    <div class="comment">
                        <a class="comment-image" href="#"><img src="img/comment-2.jpg" alt="" /></a>
                        <div class="comment-content">
                            <div class="comment-title"><span>Helen</span>  Posted 06:12PM, 25 December 2015</div>
                            <div class="comment-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, eiusmod tempor incididunt ut labore. Lorem ipsum dolor sit amet, consectetur adipiscing elit, eiusmod tempor incididunt ut labore et dolore magna aliqua.</div>
                        </div>
                    </div>
                </div>
                <div class="blog-entry">
                    <h3 class="additional-blog-title">Leave a comment</h3>
                    <form>
                        <div class="row">
                            <div class="col-sm-6">
                                <label>Your Name <span>*</span></label>
                                <input class="simple-field" type="text" placeholder="Your Name" value="" />
                            </div>
                            <div class="col-sm-6">
                                <label>Your Email <span>*</span></label>
                                <input class="simple-field" type="text" placeholder="Your Valid Email Address" value="" />
                                <div class="clear"></div>
                            </div>
                            <div class="col-sm-12">
                                <label>Your Message <span>*</span></label>
                                <textarea class="simple-field" placeholder="Message"></textarea>
                                <div class="button style-10">Send Message<input type="submit" value="" /></div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>

        <div class="col-md-3 col-md-pull-9 information-entry blog-sidebar">
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
                    <a class="image" href="#"><img src="img/product-image-inline-4.jpg" alt=""></a>
                    <div class="content">
                        <div class="cell-view">
                            <a class="title" href="#">New collection from Armiani 2013</a>
                            <div class="description">Posted 04 November 2014</div>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="inline-product-entry">
                    <a class="image" href="#"><img src="img/product-image-inline-5.jpg" alt=""></a>
                    <div class="content">
                        <div class="cell-view">
                            <a class="title" href="#">New collection from Armiani 2013</a>
                            <div class="description">Posted 04 November 2014</div>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>

                <div class="inline-product-entry">
                    <a class="image" href="#"><img src="img/product-image-inline-6.jpg" alt=""></a>
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

    </div>
</div>