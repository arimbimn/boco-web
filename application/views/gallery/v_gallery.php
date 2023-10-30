<!-- breadcrumb start -->

    <div class="breadcrumb-section">

        <div class="container">

            <div class="row">

                <div class="col-sm-6">

                    <div class="page-title">

                        <h2><?=$title_page?></h2>

                    </div>

                </div>

                <div class="col-sm-6">

                    <nav aria-label="breadcrumb" class="theme-breadcrumb">

                        <ol class="breadcrumb">

                            <li class="breadcrumb-item"><a href="<?=base_url()?>"><?=lang('beranda')?></a></li>

                            <li class="breadcrumb-item active" aria-current="page"><?=$title_page?></li>

                        </ol>

                    </nav>

                </div>

            </div>

        </div>

    </div>

    <!-- breadcrumb End -->


    <!-- Our Project Start -->

    <section class="portfolio-section portfolio-padding ratio2_3">

        <div class="container">

            <div align="center" id="form1">

                <button class="filter-button project_button active" data-filter="all">All</button>

                <?php 
                    foreach($gallery_cat as $cat) 
                    { 
                        $cat_slug = str_replace(' ', '-', strtolower($cat->nama));
                ?>

                    <button class="filter-button project_button" data-filter="<?=$cat_slug?>"><?=$cat->nama?></button>

                <?php } ?>

            </div>

            <div class="row zoom-gallery">

                <?php 
                    foreach($galleries as $gallery) 
                    { 
                        $gallery_catslug = str_replace(' ', '-', strtolower($gallery->nama));
                ?>

                    <div class="isotopeSelector filter <?=$gallery_catslug?> col-lg-4 col-sm-6">

                        <div class="overlay">

                            <div class="border-portfolio">

                                <a href="<?=smn_baseurl()?>uploads/gallery/<?=$gallery->image?>">

                                    <div class="overlay-background">

                                        <i class="fa fa-plus" aria-hidden="true"></i>

                                    </div>

                                    <img src="<?=smn_baseurl()?>uploads/gallery/<?=$gallery->image?>"

                                        class="img-fluid blur-up lazyload bg-img">

                                </a>

                            </div>

                        </div>

                    </div>

                <?php } ?>

            </div>

        </div>

    </section>

    <!-- Our Project End -->