<?php
/*if (!$this->ion_auth->logged_in()) {
     header("Cache-Control: private, max-age=10800, pre-check=10800");
     header("Pragma: private");
     header("Expires: " . date(DATE_RFC822,strtotime("+2 day")));
}*/
$CI = &get_instance();
?>
<!-- Home slider -->
<section class="p-0 banner-ganti">
  <div class="slide-1 home-slider desktop-version">
    <?php foreach ($banner as $v_baner) { ?>
      <?php if ($v_baner->slider_type == 'image') { ?>
        <div onclick="clickBanner('<?= $v_baner->url_link ?>');">
          <div class="home text-center">
            <!--img src="<!?= smn_baseurl() ?>uploads/banners/<!?= $v_baner->image_banner ?>" alt="" class="bg-img blur-up lazyload"-->
            <img data-src="<?= smn_baseurl() . 'uploads/banners/' . $v_baner->image_banner ?>" alt="" class=" image-lazyload !block">

            <!-- <div class="container">
              <div class="row">
                <div class="col">
                  <div class="slider-contain">
                    <div>
                      <h4><?= $v_baner->sub_title  ?></h4>
                      <h1><?= $v_baner->title  ?></h1>
                    </div>
                  </div>
                </div>
              </div>
            </div> -->
          </div>
        </div>
      <?php } else { ?>
        <div>
          <div class="home text-center">
            <iframe width="100%" height="100%" src="https://www.youtube.com/embed/<?= $v_baner->embed_code ?>?autoplay=0&controls=0&loop=1&mute=0&rel=0&origin=https://bocorocco-online.com&playlist=<?= $v_baner->embed_code ?>">
            </iframe>
          </div>
        </div>
      <?php } ?>
    <?php } ?>
  </div>
  <div class="slide-1 home-slider mobile-version">
    <?php foreach ($banner as $v_baner) { ?>
      <?php if ($v_baner->slider_type == 'image') { ?>
        <div onclick="clickBanner('<?= $v_baner->url_link ?>');">
          <div class="home text-center">
            <img data-src="<?= smn_baseurl() . 'uploads/banners/banner_mobile' . $v_baner->image_banner_mobile ?>" class=" bg-img image-lazyload !block">
            <!-- <img loading="lazy" data-src="<?= smn_baseurl() ?>uploads/banners/banner_mobile/<!?= $v_baner->image_banner_mobile ?>" alt="" class="bg-img blur-up lazyload"> -->
            <!-- <amp-img src="<?php //echo $CI->base64_encode_image(smn_baseurl() . 'uploads/banners/banner_mobile/' . $v_baner->image_banner_mobile) 
                                ?>" alt="" class="bg-img blur-up lazyload"></amp-img> -->
            <div class="container">
              <div class="row">
                <div class="col">
                  <div class="slider-contain">
                    <div>
                      <h4><?= $v_baner->sub_title  ?></h4>
                      <h1><?= $v_baner->title  ?></h1>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php } else { ?>
        <div>
          <div class="home text-center">
            <iframe width="100%" height="100%" src="https://www.youtube.com/embed/<?= $v_baner->embed_code ?>?autoplay=0&controls=0&loop=1&mute=0&rel=0&playlist=<?= $v_baner->embed_code ?>">
            </iframe>
          </div>
        </div>
      <?php } ?>
    <?php } ?>
  </div>
</section>
<!-- Home slider end -->


<!-- collection banner -->
<?php if ($banner_secondary) { ?>
  <section class="pb-0 ratio2_1 banner-ganti1">
    <div class="desktop-version">
      <div class="container pl-0">
        <div class="row partition2">
          <?php foreach ($banner_secondary as $v_baner_secondary) { ?>
            <div class="col-md-6">
              <a href="<?= $v_baner_secondary->url_link ?>">
                <div class="collection-banner p-right text-center">
                  <div class="img-part">
                    <img data-src="<?= smn_baseurl() . 'uploads/banners/' . $v_baner_secondary->image_banner ?>" class="image-lazyload !block">

                    <!-- <img src="<?= $CI->base64_encode_image(smn_baseurl() . 'uploads/banners/' . $v_baner_secondary->image_banner) ?>" class="img-fluid blur-up lazyload bg-img" alt=""> -->
                  </div>
                  <div class="contain-banner">
                    <div>
                      <h4><?= $v_baner_secondary->sub_title  ?></h4>
                      <h2><?= $v_baner_secondary->title  ?></h2>
                    </div>
                  </div>
                </div>
              </a>
            </div>
          <?php } ?>
        </div>
      </div>
    </div>
    <div class="mobile-version">
      <div class="container pl-0">
        <div class="row partition2">
          <div class="col-12">
            <?php foreach ($banner_secondary as $v_baner_secondary) { ?>
              <div class="col-md-6">
                <a href="<?= $v_baner_secondary->url_link ?>">
                  <div class="collection-banner p-right text-center">
                    <div class="img-part">
                      <img data-src="<?= smn_baseurl() . 'uploads/banners/banner_mobile/' . $v_baner_secondary->image_banner_mobile ?>" class="image-lazyload !block">

                      <!-- <amp-img src="<?= $CI->base64_encode_image(smn_baseurl() . 'uploads/banners/banner_mobile/' . $v_baner_secondary->image_banner_mobile) ?>" class="img-fluid blur-up lazyload bg-img" alt=""></amp-img> -->
                    </div>
                    <div class="contain-banner">
                      <div>
                        <h4><?= $v_baner_secondary->sub_title  ?></h4>
                        <h2><?= $v_baner_secondary->title  ?></h2>
                      </div>
                    </div>
                  </div>
                </a>
              </div>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
  </section>
<?php } ?>
<!-- collection banner end -->


<!-- Paragraph-->
<?php $top_colectiontitle = $this->db->select('primary_title,secondary_title,desc')->where(['id_home_title' => 1])->get('home_title')->row(); ?>
<div class="title1 section-t-space">
  <h4><?= $top_colectiontitle->primary_title ?></h4>
  <h2 class="title-inner1"><?= $top_colectiontitle->secondary_title ?></h2>
</div>
<div class="container">
  <div class="row">
    <div class="col-lg-6 offset-lg-3">
      <div class="product-para">
        <p class="text-center"><?= $top_colectiontitle->desc ?></p>
      </div>
    </div>
  </div>
</div>
<!-- Paragraph end -->

<div class="recomended-product mb-20">
  <div class="container">
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
      <?php foreach ($recommended as $recomen) { ?>
        <?php
        $data = [
          'data' => $recomen
        ];

        $this->load->view("components/product/product_card_home", $data);
        ?>
      <?php } ?>
    </div>
  </div>
</div>

<!-- Product slider -->
<!-- <section class="section-b-space p-t-0 ratio_asos">
  <div class="container">
    <div class="row">
      <div class="col">
        <div class="product-4 product-m no-arrow">
          <?php foreach ($recommended as $recomen) { ?>
            <div class="product-box">
              <div class="img-wrapper">
                <div class="front">
                  <a href="<?= base_url() ?>product/detail/<?= $recomen->id_product ?>"><amp-img src="<?= smn_baseurl() ?>uploads/product/<?= $recomen->image_one ?>" class="img-fluid blur-up lazyload bg-img" alt=""></amp-img></a>
                </div>
                <div class="back">
                  <a href="<?= base_url() ?>product/detail/<?= $recomen->id_product ?>"><amp-img src="<?= smn_baseurl() ?>uploads/product/<?= $recomen->image_two ?>" class="img-fluid blur-up lazyload bg-img" alt=""></amp-img></a>
                </div>
                <div class="cart-info cart-wrap"> -->
<!-- <a href="javascript:void(0)" title="Add to Wishlist">
                     <i class="ti-heart" aria-hidden="true"></i>
                   </a> -->

<!-- <a href="<?= base_url() ?>add_to_compare/<?= $recomen->id_product ?>" title="Compare"><i class="ti-reload" aria-hidden="true"></i></a>
                </div>
              </div>
              <div class="product-detail">
                <div class="rating three-star">
                  <?php
                  $recomen_rating = $this->db->select('AVG(rating) as avg_rating')->where('product_id', $recomen->id_product)->get('product_reviews')->row()->avg_rating;
                  for ($usrating = 1; $usrating <= 5; $usrating++) { ?>
                    <i class="fa fa-star <?php if ($usrating <= $recomen_rating) {
                                            echo "active";
                                          } ?>"></i>
                  <?php } ?>
                </div>
                <a href="<?= base_url() ?>product/detail/<?= $recomen->id_product ?>">
                  <h6><?= $recomen->nama_barang ?></h6>
                </a>
                <h4>Rp. <?= number_format($recomen->harga, 0) ?></h4>
                <ul class="color-variant">
                  <li class="bg-light0" style="background-color:<?= $recomen->colour_picker ?>;"></li>
                </ul>
              </div>
            </div>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
</section> -->
<!-- Product slider end -->


<!-- Parallax banner -->
<?php if ($banner_paralax) {  ?>
  <section class="p-0">
    <div class="full-banner parallax text-center p-left desktop-version">
      <img src="<?= smn_baseurl() ?>/uploads/banners/<?= $banner_paralax->image_banner ?>" alt="" class="bg-img blur-up lazyload">
      <div class="container">
        <div class="row">
          <div class="col">
            <div class="banner-contain">
              <h2><?= $banner_paralax->title ?></h2>
              <h3><?= $banner_paralax->sub_title ?></h3>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="full-banner parallax text-center p-left mobile-version">
      <amp-img src="<?= smn_baseurl() ?>/uploads/banners/banner_mobile/<?= $banner_paralax->image_banner_mobile ?>" alt="" class="bg-img blur-up lazyload"></amp-img>
      <div class="container">
        <div class="row">
          <div class="col">
            <div class="banner-contain">
              <h2><?= $banner_paralax->title ?></h2>
              <h3><?= $banner_paralax->sub_title ?></h3>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
<?php } ?>

<!-- Parallax banner end -->

<?php if ($fiture) { ?>
  <!-- service layout -->
  <div class="container bg-[#cd212a]">
    <section class="service border-section small-section">
      <div class="row">
        <?php foreach ($fiture as $item_fiture) { ?>
          <div class="col-md-4 service-block">
            <div class="media">
              <img src="<?= smn_baseurl() ?>uploads/fiture/<?= $item_fiture->image ?>" alt="" width="20%">
              <div class="media-body">
                <h4><?= $item_fiture->title ?></h4>
                <p><?= $item_fiture->sub_title ?></p>
              </div>
            </div>
          </div>
        <?php } ?>
      </div>
    </section>
  </div>
  <!-- service layout  end -->
<?php } ?>


<!-- Tab product -->
<?php $productstitle = $this->db->select('primary_title,secondary_title,desc')->where(['id_home_title' => 2])->get('home_title')->row(); ?>

<div class="title1 section-t-space">
  <h4><?= $productstitle->primary_title ?></h4>
  <h2 class="title-inner1"><?= $productstitle->secondary_title ?></h2>
</div>
<div class="container">
  <div class="row">
    <div class="col-lg-6 offset-lg-3">
      <div class="product-para">
        <p class="text-center"><?= $productstitle->desc ?></p>
      </div>
    </div>
  </div>
</div>


<section class="section-b-space p-0 ratio_asos ">
  <div class="container bg-white mb-20">
    <div class="row">
      <div class="col">
        <div class="theme-tab">
          <ul class="tabs tab-title">
            <li class="current"><a href="tab-4"><?= lang('new_products_home') ?></a></li>
            <li class=""><a href="tab-5"><?= lang('featured_products_home') ?></a></li>
            <li class=""><a href="tab-6"><?= lang('best_sellers_home') ?></a></li>
          </ul>
          <div class="tab-content-cls">
            <div id="tab-4" class="tab-content active default">
              <div class="no-slider row">
                <div class="container">
                  <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <?php if ($products) { ?>
                      <?php foreach ($products as $item_product) { ?>
                        <?php
                        $data = [
                          'data' => $item_product
                        ];

                        $this->load->view("components/product/product_card_home", $data);
                        ?>
                      <?php } ?>
                    <?php } ?>
                  </div>
                </div>

                <?php if (!$products) { ?>
                  <?php foreach ($products as $item_product) { ?>
                    <div class="product-box">
                      <div class="img-wrapper">
                        <div class="front">
                          <a href="<?= base_url('product/detail/' . $item_product->id_product) ?>"><img src="<?= smn_baseurl() ?>/uploads/product/<?= $item_product->image_one ?>" class="img-fluid blur-up lazyload bg-img" alt=""></a>
                        </div>
                        <div class="back">
                          <a href="<?= base_url('product/detail/' . $item_product->id_product) ?>"><img src="<?= smn_baseurl() ?>/uploads/product/<?= $item_product->image_two ?>" class="img-fluid blur-up lazyload bg-img" alt=""></a>
                        </div>
                        <div class="cart-info cart-wrap">

                          <?php //echo form_open('cart/add');
                          // echo form_hidden('id',  $item_product->id_product);
                          // echo form_hidden('qty',  1);
                          // echo form_hidden('price',  $item_product->harga);
                          // echo form_hidden('name',  $item_product->nama_barang);
                          // echo form_hidden('redirect_page', str_replace('', '', current_url()));
                          ?>
                          <!-- <button data-toggle="modal" type="submit" data-target="#addtocart" title="Add to cart"><i class="ti-shopping-cart"></i></button> -->
                          <?php //echo form_close() 
                          ?>
                          <!-- <a href="javascript:void(0)" title="Add to Wishlist"><i class="ti-heart" aria-hidden="true"></i></a>  -->
                          <a href="<?= base_url() ?>add_to_compare/<?= $item_product->id_product ?>" title="Compare"><i class="ti-reload" aria-hidden="true"></i></a>
                        </div>
                      </div>
                      <div class="product-detail">
                        <div>
                          <div class="rating three-star">
                            <?php
                            $item_rating = $this->db->select('AVG(rating) as avg_rating')->where('product_id', $item_product->id_product)->get('product_reviews')->row()->avg_rating;
                            for ($usrating = 1; $usrating <= 5; $usrating++) { ?>
                              <i class="fa fa-star <?php if ($usrating <= $item_rating) {
                                                      echo "active";
                                                    } ?>"></i>
                            <?php } ?>
                          </div>
                          <a href="<?= base_url('product/detail/' . $item_product->id_product) ?>">
                            <h6><?= $item_product->nama_barang ?></h6>
                          </a>
                          <!-- <p><!? //= $item_product->description 
                                    ?> -->
                          <!-- </p> -->
                          <h4>Rp <?= number_format($item_product->harga, 0)  ?></h4>
                          <ul class="color-variant">
                            <li class="bg-light0" style="background-color:<?= $item_product->colour_picker ?>;"></li>
                          </ul>
                          <?php
                          // echo form_open('cart/add');
                          // echo form_hidden('id',  $item_product->id_product);
                          // echo form_hidden('qty',  1);
                          // echo form_hidden('price',  $item_product->harga);
                          // echo form_hidden('name',  $item_product->nama_barang);
                          // echo form_hidden('redirect_page', str_replace('', '', current_url()));
                          ?>
                          <!-- <div class="product-buttons mt-30">
                             <button data-toggle="modal" class="btn_save btn btn-solid" type="submit" data-target="#addtocart" title="Add to cart">Add To Cart</button>
                           </div> -->
                          <?php //echo form_close() 
                          ?>
                        </div>
                      </div>
                    </div>
                  <?php } ?>
                <?php } ?>

              </div>
            </div>
            <div id="tab-5" class="tab-content">
              <div class="no-slider row">
                <div class="container">
                  <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <?php
                    $featured = $this->db->select('id_product,image_one,image_two,image_three,nama_barang,harga,colour_picker')->where('is_featured', 1)->order_by('id_product', 'DESC')->limit(8)->get('product')->result();
                    foreach ($featured as $feature) {
                    ?>
                      <?php
                      $data = [
                        'data' => $feature
                      ];

                      $this->load->view("components/product/product_card_home", $data);
                      ?>
                    <?php } ?>
                  </div>
                </div>
                <?php
                // Biar ga jalan
                if (false) {

                  $featured = $this->db->select('id_product,image_one,image_two,image_three,nama_barang,harga,colour_picker')->where('is_featured', 1)->order_by('id_product', 'DESC')->limit(8)->get('product')->result();
                  foreach ($featured as $feature) {
                ?>
                    <div class="product-box">
                      <div class="img-wrapper">
                        <div class="front">
                          <a href="<?= base_url() ?>product/detail/<?= $feature->id_product ?>"><img src="<?= smn_baseurl() ?>uploads/product/<?= $feature->image_one ?>" class="img-fluid blur-up lazyload bg-img" alt=""></a>
                        </div>
                        <div class="back">
                          <a href="<?= base_url() ?>product/detail/<?= $feature->id_product ?>"><img src="<?= smn_baseurl() ?>uploads/product/<?= $feature->image_two ?>" class="img-fluid blur-up lazyload bg-img" alt=""></a>
                        </div>
                        <div class="cart-info cart-wrap">
                          <!-- <button data-toggle="modal" data-target="#addtocart" title="Add to cart"><i class="ti-shopping-cart"></i></button> <a href="javascript:void(0)" title="Add to Wishlist"><i class="ti-heart" aria-hidden="true"></i></a>  -->
                          <a href="<?= base_url() ?>add_to_compare/<?= $feature->id_product ?>" title="Compare"><i class="ti-reload" aria-hidden="true"></i></a>
                          <a href="#" data-toggle="modal" data-target="#quick-view" title="Quick View"><i class="ti-search" aria-hidden="true"></i></a>
                        </div>
                      </div>
                      <div class="product-detail">
                        <div class="rating three-star">
                          <?php
                          $feature_rating = $this->db->select('AVG(rating) as avg_rating')->where('product_id', $feature->id_product)->get('product_reviews')->row()->avg_rating;
                          for ($usrating = 1; $usrating <= 5; $usrating++) { ?>
                            <i class="fa fa-star <?php if ($usrating <= $feature_rating) {
                                                    echo "active";
                                                  } ?>"></i>
                          <?php } ?>
                        </div>
                        <a href="<?= base_url() ?>product/detail/<?= $feature->id_product ?>">
                          <h6><?= $feature->nama_barang ?></h6>
                        </a>
                        <h4>Rp. <?= number_format($feature->harga, 0) ?></h4>
                        <ul class="color-variant">
                          <li class="bg-light0" style="background-color:<?= $feature->colour_picker ?>;"></li>
                        </ul>
                        <?php
                        // echo form_open('cart/add');
                        // echo form_hidden('id',  $feature->id_product);
                        // echo form_hidden('qty',  1);
                        // echo form_hidden('price',  $feature->harga);
                        // echo form_hidden('name',  $feature->nama_barang);
                        // echo form_hidden('redirect_page', str_replace('', '', current_url()));
                        ?>
                        <!-- <div class="product-buttons mt-30">
                         <button data-toggle="modal" class="btn_save btn btn-solid" type="submit" data-target="#addtocart" title="Add to cart">Add To Cart</button>
                       </div> -->
                        <?php //echo form_close() 
                        ?>
                      </div>
                    </div>
                <?php }
                } ?>
              </div>
            </div>
            <div id="tab-6" class="tab-content">
              <div class="no-slider row">
                <?php
                $best_sellers = $this->M_product->BestSellerProduct();
                foreach ($best_sellers as $best_seller) {
                ?>
                  <div class="product-box">
                    <div class="img-wrapper">
                      <div class="front">
                        <a href="<?= base_url() ?>product/detail/<?= $best_seller->id_product ?>"><img src="<?= smn_baseurl() ?>uploads/product/<?= $best_seller->image_one ?>" class="img-fluid blur-up lazyload bg-img" alt=""></a>
                      </div>
                      <div class="back">
                        <a href="<?= base_url() ?>product/detail/<?= $best_seller->id_product ?>"><img src="<?= smn_baseurl() ?>uploads/product/<?= $best_seller->image_two ?>" class="img-fluid blur-up lazyload bg-img" alt=""></a>
                      </div>
                      <div class="cart-info cart-wrap">
                        <!-- <button data-toggle="modal" data-target="#addtocart" title="Add to cart"><i class="ti-shopping-cart"></i></button> <a href="javascript:void(0)" title="Add to Wishlist"><i class="ti-heart" aria-hidden="true"></i></a> -->
                        <a href="<?= base_url() ?>add_to_compare/<?= $best_seller->id_product ?>" title="Compare"><i class="ti-reload" aria-hidden="true"></i></a>
                        <a href="#" data-toggle="modal" data-target="#quick-view" title="Quick View"><i class="ti-search" aria-hidden="true"></i></a>
                      </div>
                    </div>
                    <div class="product-detail">
                      <div class="rating three-star">
                        <?php
                        $best_seller_rating = $this->db->select('AVG(rating) as avg_rating')->where('product_id', $best_seller->id_product)->get('product_reviews')->row()->avg_rating;
                        for ($usrating = 1; $usrating <= 5; $usrating++) { ?>
                          <i class="fa fa-star <?php if ($usrating <= $best_seller_rating) {
                                                  echo "active";
                                                } ?>"></i>
                        <?php } ?>
                      </div>
                      <a href="<?= base_url() ?>product/detail/<?= $best_seller->id_product ?>">
                        <h6><?= $best_seller->nama_barang ?></h6>
                        <p>Total Pembelian <?= $best_seller->ttl_qty ?></p>
                      </a>
                      <h4>Rp. <?= number_format($best_seller->harga, 0) ?></h4>
                      <ul class="color-variant">
                        <li class="bg-light0" style="background-color:<?= $best_seller->colour_picker ?>;"></li>
                      </ul>
                      <?php
                      // echo form_open('cart/add');
                      // echo form_hidden('id',  $best_seller->id_product);
                      // echo form_hidden('qty',  1);
                      // echo form_hidden('price',  $best_seller->harga);
                      // echo form_hidden('name',  $best_seller->nama_barang);
                      // echo form_hidden('redirect_page', str_replace('', '', current_url()));
                      ?>
                      <!-- <div class="product-buttons mt-30">
                         <button data-toggle="modal" class="btn_save btn btn-solid" type="submit" data-target="#addtocart" title="Add to cart">Add To Cart</button>
                       </div> -->
                      <?php //echo form_close() 
                      ?>
                    </div>
                  </div>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Tab product end -->




<?php if ($blogs) { ?>
  <?php $blogtitle = $this->db->select('primary_title,secondary_title,desc')->where(['id_home_title' => 3])->get('home_title')->row(); ?>

  <!-- blog section -->
  <div class="container">
    <div class="row">
      <div class="col">
        <div class="title1 section-t-space">
          <h4><?= $blogtitle->primary_title ?></h4>
          <h2 class="title-inner1"><?= $blogtitle->secondary_title ?></h2>
        </div>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-lg-6 offset-lg-3">
        <div class="product-para">
          <p class="text-center"><?= $blogtitle->desc ?></p>
        </div>
      </div>
    </div>
  </div>
  <!-- Paragraph end -->


  <section class="blog p-t-0 ratio2_3">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="slide-3 no-arrow">

            <?php foreach ($blogs as $item_blog) { ?>
              <div class="col-md-12">
                <a href="<?= base_url('blog/detail/' . $item_blog->slug) ?>">
                  <div class="classic-effect">
                    <div>
                      <img src="<?= smn_baseurl() ?>uploads/blogs/<?= $item_blog->image_blog ?>" class="img-fluid blur-up lazyload bg-img" alt="">
                    </div>
                    <span></span>
                  </div>
                </a>
                <div class="blog-details">
                  <h4><?= date('d F Y', strtotime($item_blog->created_at)) ?></h4>
                  <a href="<?= base_url('blog/detail/' . $item_blog->slug) ?>">
                    <p><?= $item_blog->title ?></p>
                  </a>
                  <hr class="style1">
                  <?php
                  $count_comments = $this->M_Blog->get_countcomment_ByBlogID($item_blog->id_blog);
                  ?>
                  <h6><?= lang('post_by') ?> : <?= $item_blog->full_name ?> , <?= $count_comments->count_comment; ?> <?= lang('comment_blog') ?></h6>
                </div>
              </div>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- blog section end -->
<?php } ?>



<!-- instagram section -->
<?php $igtitle = $this->db->select('primary_title,secondary_title,desc')->where(['id_home_title' => 4])->get('home_title')->row(); ?>
<!-- blog section -->
<div class="container">
  <div class="row">
    <div class="col">
      <div class="title1 section-t-space">
        <a href="<?= $this->fungsi->webinformation()->instagram ?>" target="_blank">
          <h4><?= $igtitle->primary_title ?></h4>
        </a>
        <a href="<?= $this->fungsi->webinformation()->instagram ?>" target="_blank">
          <h2 class="title-inner1"><?= $igtitle->secondary_title ?></h2>
        </a>
      </div>
    </div>
  </div>
</div>
<div class="container">
  <div class="row">
    <div class="col-lg-6 offset-lg-3">
      <div class="product-para">
        <p class="text-center"><?= $igtitle->desc ?></p>
      </div>
    </div>
    <!-- default -->
    <div id="instagram" class="text-center"></div>
    <br>
  </div>
</div>
<!-- Paragraph end -->
<!-- instagram section end -->

<script>
  function clickBanner(val) {
    console.log(val);
    window.location.replace(val);
  }
</script>