<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-12">
        <h2>View Blog</h2>
        <?= $this->breadcrumbs->show(); ?>
    </div>
</div>
<div class="wrapper wrapper-content  animated fadeInRight article">
<div class="row">
    <div class="col-lg-10 col-lg-offset-1">
        <div class="ibox">
            <div class="ibox-content">
                <!-- <div class="pull-right">
                    <button class="btn btn-white btn-xs" type="button">Model</button>
                    <button class="btn btn-white btn-xs" type="button">Publishing</button>
                    <button class="btn btn-white btn-xs" type="button">Modern</button>
                </div> -->
                <div class="text-center article-title">
                    <span class="text-muted">
                        <i class="fa fa-clock-o"></i>
                        <?= convert_date_format($blog['created_date']); ?>
                    </span>
                    <h1>
                        <?= $blog['title']; ?>
                    </h1>
                </div>
                <div style="display: block;margin-bottom: 15px;position: relative;overflow: hidden;">
                    <img style="width: 100%;height: auto;display: block;position: relative;" src="<?= base_url(); ?>uploads/blog/<?= $blog['image']; ?>" alt="" />
                </div>
                <p>
                   <?= $blog['description']; ?>
                </p>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                            <h5>Tags:</h5>
                            <button class="btn btn-primary btn-xs" type="button">Model</button>
                            <button class="btn btn-white btn-xs" type="button">Publishing</button>
                    </div>
                    <div class="col-md-6">
                        <div class="small text-right">
                            <h5>Stats:</h5>
                            <div> <i class="fa fa-comments-o"> </i> 56 comments </div>
                            <i class="fa fa-eye"> </i> 144 views
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">

                        <h2>Comments:</h2>
                        <div class="social-feed-box">
                            <div class="social-avatar">
                                <a href="#" class="pull-left">
                                    <img alt="image" src="img/a1.jpg">
                                </a>
                                <div class="media-body">
                                    <a href="#">
                                        Andrew Williams
                                    </a>
                                    <small class="text-muted">Today 4:21 pm - 12.06.2014</small>
                                </div>
                            </div>
                            <div class="social-body">
                                <p>
                                    Many desktop publishing packages and web page editors now use Lorem Ipsum as their
                                    default model text, and a search for 'lorem ipsum' will uncover many web sites still
                                    default model text.
                                </p>
                            </div>
                        </div>
                        <div class="social-feed-box">
                            <div class="social-avatar">
                                <a href="#" class="pull-left">
                                    <img alt="image" src="img/a2.jpg">
                                </a>
                                <div class="media-body">
                                    <a href="#">
                                        Michael Novek
                                    </a>
                                    <small class="text-muted">Today 4:21 pm - 12.06.2014</small>
                                </div>
                            </div>
                            <div class="social-body">
                                <p>
                                    Many desktop publishing packages and web page editors now use Lorem Ipsum as their
                                    default model text, and a search for 'lorem ipsum' will uncover many web sites still
                                    default model text, and a search for 'lorem ipsum' will uncover many web sites still
                                    in their infancy. Packages and web page editors now use Lorem Ipsum as their
                                    default model text.
                                </p>
                            </div>
                        </div>
                        <div class="social-feed-box">
                            <div class="social-avatar">
                                <a href="#" class="pull-left">
                                    <img alt="image" src="img/a3.jpg">
                                </a>
                                <div class="media-body">
                                    <a href="#">
                                        Alice Mediater
                                    </a>
                                    <small class="text-muted">Today 4:21 pm - 12.06.2014</small>
                                </div>
                            </div>
                            <div class="social-body">
                                <p>
                                    Many desktop publishing packages and web page editors now use Lorem Ipsum as their
                                    default model text, and a search for 'lorem ipsum' will uncover many web sites still
                                    in their infancy. Packages and web page editors now use Lorem Ipsum as their
                                    default model text.
                                </p>
                            </div>
                        </div>
                        <div class="social-feed-box">
                            <div class="social-avatar">
                                <a href="#" class="pull-left">
                                    <img alt="image" src="img/a5.jpg">
                                </a>
                                <div class="media-body">
                                    <a href="#">
                                        Monica Flex
                                    </a>
                                    <small class="text-muted">Today 4:21 pm - 12.06.2014</small>
                                </div>
                            </div>
                            <div class="social-body">
                                <p>
                                    Many desktop publishing packages and web page editors now use Lorem Ipsum as their
                                    default model text, and a search for 'lorem ipsum' will uncover many web sites still
                                    in their infancy. Packages and web page editors now use Lorem Ipsum as their
                                    default model text.
                                </p>
                            </div>
                        </div>


                    </div>
                </div>


            </div>
        </div>
    </div>
</div>
