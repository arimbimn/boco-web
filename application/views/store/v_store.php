<!-- breadcrumb start -->

<div class="breadcrumb-section">

  <div class="container">

    <div class="row">

        <div class="col-sm-6">

            <div class="page-title">

              <h2><?= lang('title_store') ?></h2>

            </div>

        </div>

        <div class="col-sm-6">

          <nav aria-label="breadcrumb" class="theme-breadcrumb">

            <ol class="breadcrumb">

              <li class="breadcrumb-item"><a href="<?=base_url()?>"><?= lang('beranda') ?></a></li>

              <li class="breadcrumb-item active"><?= lang('title_store') ?></li>

            </ol>

          </nav>

        </div>

    </div>

  </div>

</div>

<!-- breadcrumb End -->

<!-- section start -->

<section class="section-b-space blog-page ratio2_3">

    <div class="container">

        <div class="row">

            <div class="col-12">

              <?php foreach($stores as $store) { ?>

                <div class="row blog-media">

                    <div class="col-xl-6">

                      <div class="blog-left">

                        <a ><img src="<?=smn_baseurl()?>/uploads/store/<?=$store->image?>" class="img-fluid blur-up lazyload bg-img" alt=""></a>

                      </div>

                    </div>

                    <div class="col-xl-6">

                      <div class="blog-right">

                        <div> 

                          <a >

                            <h4 style="max-width:300px;"><?=$store->nama_store?></h4>

                          </a>

                          <?php if(!empty($store->kota)) { ?>

                            <p style="max-width:300px;">

                            <?=$store->alamat?> Kota <span style="font-size: 120%"><b><?php echo ucwords(strtolower($store->kota)) ?></b></span>

                            </p>

                          <?php } ?>

                          <?php if(!empty($store->telepon)) { ?>

                            <p style="max-width:300px;">

                              <i class="fa fa-phone"></i> <?=$store->telepon?>

                            </p>

                          <?php } ?>

                          <?php if(!empty($store->latitude) && !empty($store->longitude)) { ?>

                            <p style="max-width:300px;">

                              <a href="https://www.google.com/maps/place/<?=$store->latitude?>,<?=$store->longitude?>" target="_blank">

                                <i class="fa fa-map-marker"></i> Google Maps

                              </a>

                            </p>

                          <?php } ?>

                        </div>

                      </div>

                    </div>

                </div>

              <?php } ?>

            </div>

        </div>

    </div>

</section>

<!-- Section ends -->