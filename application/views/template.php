<!DOCTYPE html>
<html lang="en" translate="no">

<head>
  <meta name="google" content="notranslate" />
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <meta name="description" content="<?= $this->fungsi->webinformation()->name_web ?>">
  <meta name="keywords" content="<?= $this->fungsi->webinformation()->name_web ?>">
  <meta name="author" content="<?= $this->fungsi->webinformation()->name_web ?>">
  <link rel="icon" href="<?= base_url() ?>assets/images/1609746656-favicon.png" type="image/x-icon">
  <link rel="shortcut icon" href="<?= base_url() ?>assets/images/1609746656-favicon.png" type="image/x-icon">
  <title><?= $title ?></title>

  <!--Google font-->
  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/css_compress.css">
  <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/css_baru.css">
  
  <!-- Icons -->
  <!--link rel="stylesheet" type="text/css" href="<!?= base_url() ?>assets/css/fontawesome.css">
	
  <!--Slick slider css-->
  <!--link rel="stylesheet" type="text/css" href="<!?= base_url() ?>assets/css/slick.css">
  <link rel="stylesheet" type="text/css" href="<!?= base_url() ?>assets/css/slick-theme.css">

  <!-- Animate icon -->
  <!--link rel="stylesheet" type="text/css" href="<!?= base_url() ?>assets/css/animate.css">

  <!-- Size css -->
  <!--link rel="stylesheet" type="text/css" href="<!?= base_url() ?>assets/css/stylesize.css">

  <!-- Price range icon -->
  <!--link rel="stylesheet" type="text/css" href="<!?= base_url() ?>assets/css/price-range.css">

  <!-- Themify icon -->
  <!--link rel="stylesheet" type="text/css" href="<!?= base_url() ?>assets/css/themify-icons.css">

  <!-- Bootstrap css -->
  <!--link rel="stylesheet" type="text/css" href="<!?= base_url() ?>assets/css/bootstrap.css">

  <!--link rel="stylesheet" href="<!?= base_url() ?>assets/css/magnific-popup.css">

  <!-- Theme css -->
  <!--link rel="stylesheet" type="text/css" href="<!?= base_url() ?>assets/css/color1.css" media="screen" id="color">

  <link rel="stylesheet" type="text/css" href="<!?= base_url() ?>assets/css/chosen.css">

  <link rel="stylesheet" type="text/css" href="<!?= base_url() ?>assets/css/datepicker3.css">

  <!-- latest jquery-->
  <!--script src="<!?= base_url() ?>assets/js/jquery-3.3.1.min.js"></script-->
  <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js?ver=6.1.1' id='eget_js_jquery-js'></script>
  <style>
    /*set a border on the images to prevent shifting*/
    #gallery_01 img {
      border: 2px solid white;
    }
  </style>
  <!-- Google Tag Manager -->
  <script>
    (function(w, d, s, l, i) {
      w[l] = w[l] || [];
      w[l].push({
        'gtm.start': new Date().getTime(),
        event: 'gtm.js'
      });
      var f = d.getElementsByTagName(s)[0],
        j = d.createElement(s),
        dl = l != 'dataLayer' ? '&l=' + l : '';
      j.async = true;
      j.src =
        'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
      f.parentNode.insertBefore(j, f);
    })(window, document, 'script', 'dataLayer', 'GTM-MC364SQ');
  </script>
  <!-- End Google Tag Manager -->
</head>
<?php flush(); ?>

<body>
  <a href="https://wa.me/<?= $this->fungsi->webinformation()->whatsapp ?>" class="wa-float" target="_blank"><i class="fa fa-whatsapp my-float"></i></a>
  <!-- header start -->
  <header>
    <div class="mobile-fix-option"></div>
    <div class="top-header">
      <div class="container">
        <div class="row">
          <div class="col-lg-6">
            <div class="header-contact">
              <ul>
                <li><?= lang('welcome_nav') ?> <?= $this->fungsi->webinformation()->name_web ?> <?= lang('online_store') ?></li>
                <li><i class="fa fa-phone" aria-hidden="true"></i><?= lang('call_us_nav') ?>: <?= $this->fungsi->webinformation()->telephone ?></li>
              </ul>
            </div>
          </div>
          <div class="col-lg-6 text-right">

            <ul class="header-dropdown">
              <li class="mobile-wishlist">
                <!-- a href="#"><i class="fa fa-heart" aria-hidden="true"></i></a> -->
                <?php if ($this->ion_auth->logged_in()) { ?>
                  <?= $this->ion_auth->user()->row()->email ?>
                <?php } ?>
              </li>
              <li class="onhover-dropdown mobile-account"> <i class="fa fa-user" style="color:#fff" aria-hidden="true"></i>
                <ul class="onhover-show-div">
                  <?php if ($this->ion_auth->logged_in()) { ?>
                    <li><a href="<?= base_url('users') ?>" data-lng="es"><?= lang('MyAccount') ?></a></li>
                    <?php if ($this->session->userdata('reseller') == '1') { ?>
                      <li><a href="<?= base_url('reseller/logout') ?>" data-lng="es"><?= lang('LogOut') ?></a></li>
                    <?php } else { ?>
                      <li><a href="<?= base_url('auth/logout') ?>" data-lng="es"><?= lang('LogOut') ?></a></li>
                    <?php } ?>
                  <?php } else { ?>
                    Register
                    <li><a href="<?= base_url('login') ?>" data-lng="en"><?= lang('login') ?></a></li>
                    <li><a href="<?= base_url('register') ?>" data-lng="en"><?= lang('register') ?></a></li>
                  <?php  } ?>
                  <p class="mt-2">Change language</p>
                  <li class="langswitch"><a href="<?= base_url('LanguageSwitcher/switchLang/indonesian') ?>">ID</a></li>
                  <li class="langswitch"><a href="<?= base_url('LanguageSwitcher/switchLang/english') ?>">EN</a></li>
                </ul>
              </li>
              <li class=" mobile-account"> <?= $this->session->userdata('site_lang') == "indonesian" ? 'ID' :  'EN' ?>

              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <div class="main-menu">
            <div class="menu-left">
              <div class="brand-logo">
                <a href="<?= base_url() ?>"><img src="<?= base_url('assets/images/icon/logo.png') ?>" class="img-fluid blur-up lazyload" alt=""></a>
              </div>
            </div>
            <div class="menu-right pull-right">
              <div>
                <nav id="main-nav">
                  <div class="toggle-nav"><i class="fa fa-bars sidebar-bar"></i></div>
                  <ul id="main-menu" class="sm pixelstrap sm-horizontal">
                    <li>
                      <div class="mobile-back text-right"><?= lang('back') ?><i class="fa fa-angle-right pl-2" aria-hidden="true"></i></div>
                    </li>
                    <li>
                      <a href="<?= base_url('/') ?>"><?= lang('beranda') ?></a>
                    </li>
                    <li>
                      <a href="<?= base_url('/product') ?>"><?= lang('produk') ?></a>
                      <ul>
                        <?php $category = $this->M_product->get_categoryproduct();
                        // var_dump($category);
                        ?>
                        <?php if ($category) { ?>
                          <?php foreach ($category as $item_category) { ?>
                            <li>
                              <a href="<?= base_url('/product?category=' . $item_category->id_product_kategori) ?>"><?= $item_category->nama_kategori ?></a>
                              <?php
                              $cek_subcategory = $this->db->where('kategori_id', $item_category->id_product_kategori)->where(['is_active' => 1])->order_by('subcategory_order', 'ASC')->get('product_subkategori')->result();
                              if (!empty($cek_subcategory)) {
                              ?>
                                <ul>
                                  <?php foreach ($cek_subcategory as $subcategory) { ?>
                                    <li><a href="<?= base_url() ?>product?subcategory=<?= $subcategory->id ?>"><?= $subcategory->nama_subkategori ?></a></li>
                                  <?php } ?>
                                </ul>
                              <?php } ?>
                            </li>
                          <?php } ?>
                        <?php } ?>
                      </ul>
                    </li>
                    <!--li>
                      <a href="<!?= base_url('/blog') ?>">Blog</a>
                    </li-->
                    <li>
                      <a href="<?= base_url('/gallery') ?>"><?= lang('gallery') ?></a>
                    </li>
                    <li>
                      <a href="<?= base_url('/store') ?>"><?= lang('toko') ?></a>
                    </li>
                    <?php if ($this->session->userdata('user_id') == '') { ?>
                      <li>
                        <a href="<?= base_url('/reseller') ?>">Entrepreneurship</a>
                        <ul>
                          <li>
                            <a href="<?= base_url('/login_reseller') ?>">Login Entrepreneurship</a>
                          </li>
                          <!--li>
								<a href="<!?= base_url('/reg_reseller') ?>">Daftar Entrepreneurship</a>
							 </li-->
                        </ul>
                      </li>
                    <?php } ?>
                    <?php if ($this->ion_auth->logged_in()) { ?>
                      <li>
                        <a href="#"><small style="color: red;">Already login as <?= $this->session->userdata('username_nya') ?></small></a>
                      </li>
                    <?php } ?>
                  </ul>
                </nav>
              </div>
              <div>
                <div class="icon-nav">
                  <ul>
                    <li class="onhover-div mobile-search">
                      <div><img src="<?= str_replace(array('https://', 'http://'), 'https://i1.wp.com/', base_url() . 'assets/images/icon/search.png') ?>" onclick="openSearch()" class="img-fluid blur-up lazyload" alt=""> <i class="ti-search" style="color:#fff" onclick="openSearch()"></i></div>
                      <div id="search-overlay" class="search-overlay">
                        <div> <span class="closebtn" onclick="closeSearch()" title="Close Overlay">×</span>
                          <div class="overlay-content">
                            <div class="container">
                              <div class="row">
                                <div class="col-xl-12">
                                  <?= form_open('product', ['method' => 'GET']); ?>
                                  <div class="form-group">
                                    <input type="text" name="q" class="form-control" id="exampleInputPassword1" placeholder="Search a Product">
                                  </div>
                                  <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                                  <?= form_close() ?>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </li>
                    <li class="onhover-div mobile-setting">
                      <?php if ($this->ion_auth->logged_in()) { ?>
                        <?php $notif = $this->M_notification->get_notification()->result();
                        $notifCount = $this->M_notification->get_notification()->num_rows();
                        ?>
                        <?php if ($notif) { ?>
                          <div><img src="<?= base_url() ?>assets/images/icon/bell.png" class="img-fluid blur-up lazyload" alt="">

                            <?php if ($notifCount) { ?>
                              <span class="badge_icon"><?= $notifCount ?></span>
                            <?php } ?>

                            <i class="ti-bell" style="color:#fff"></i>
                          </div>
                        <?php  } else { ?>
                          <div><img src="<?= base_url() ?>assets/images/icon/bell.png" class="img-fluid blur-up lazyload" alt=""> <i class="ti-bell" style="color:#fff"></i></div>
                        <?php  } ?>
                      <?php  } else { ?>
                        <div><img src="<?= base_url() ?>assets/images/icon/bell.png" class="img-fluid blur-up lazyload" alt=""> <i class="ti-bell" style="color:#fff"></i></div>
                      <?php   } ?>
                      <div class="show-div setting" style="max-width: 550px; height: 500px; overflow: auto;">
                        <h6><?= lang('pemberitahuan_nav') ?></h6>
                        <?php if ($this->ion_auth->logged_in()) { ?>
                          <ul class="list-inline">
                            <?php $notif = $this->M_notification->get_notification()->result(); ?>
                            <?php if ($notif) { ?>
                              <?php foreach ($notif as $v_notif) { ?>
                                <li>
                                  <div class="media">
                                    <div class="media-body">
                                      <a href="<?= base_url('notifications/read/' . $v_notif->id_notification_user) ?>">
                                        <h6><?= $v_notif->message ?></h6>
                                        <p><?= date('d F Y , h:i A', strtotime($v_notif->created_at)) ?></p>
                                      </a>
                                    </div>
                                  </div>
                                </li>
                              <?php  }  ?>
                            <?php } else { ?>
                              <p><?= lang('no_notification') ?> </p>
                            <?php  }  ?>
                          </ul>
                        <?php } else {  ?>
                          <p><?= lang('pemberitahuan_desc_nav') ?> </p>
                        <?php  } ?>

                      </div>
                    </li>
                    <li class="onhover-div mobile-cart">
                      <div>
                        <?php if (!empty($this->cart->contents())) { ?>
                          <img src="<?= base_url() ?>assets/images/icon/cart.png" class="img-fluid blur-up lazyload" alt="">
                        <?php } else { ?>
                          <img src="<?= base_url() ?>assets/images/icon/cart.png" class="img-fluid blur-up lazyload" alt="">
                        <?php } ?>
                        <?php if ($this->cart->total_items()) { ?>
                          <span class="badge_icon"><?= $this->cart->total_items() ?></span>

                        <?php } ?>

                        <i class="ti-shopping-cart" style="color:#fff"></i>
                      </div>
                      <ul class="show-div shopping-cart">
                        <!-- barang -->
                        <?php $keranjang = $this->cart->contents();
                        $jml_item = 0;
                        ?>
                        <?php if ($keranjang) { ?>
                          <?php foreach ($keranjang as $item_keranjang) { ?>
                            <?php $barang = $this->M_product->get_detailproduct($item_keranjang['id']) ?>
                            <li>
                              <div class="media">
                                <img alt="" class="mr-3" src="<?= smn_baseurl() ?>uploads/product/<?= $barang->image_one ?>" width="50%" style="object-fit: cover;">
                                <div class="media-body">
                                  <a href="#">
                                    <h4><?= $item_keranjang['name'] ?></h4>
                                  </a>
                                  <h4><span><?= $item_keranjang['qty'] ?> x IDR <?= number_format($item_keranjang['price'], 2, ',', '.') ?> </span></h4>
                                </div>
                              </div>
                              <!-- <div class="close-circle"><a href="#"><i class="fa fa-times" aria-hidden="true"></i></a></div> -->
                            </li>
                          <?php } ?>
                        <?php } else { ?>
                          <h5><?= lang('cek_keranjang_nav') ?></h5>
                        <?php } ?>
                        <li>
                          <div class="total">
                            <h5><?= lang('sub_total_nav') ?> : <span>IDR <?php echo $this->cart->format_number($this->cart->total()); ?></span></h5>
                          </div>
                        </li>
                        <li>
                          <div class="buttons"><a href="<?= base_url('cart') ?>" class="view-cart"><button class="btn btn-solid">
                                <?= lang('cart_nav') ?></button></a>
                            <!-- <a href="<?= base_url('cekout') ?>" class="checkout">checkout</a> -->
                          </div>
                        </li>
                      </ul>
                    </li>

                  </ul>
                </div>
              </div>
            </div>
          </div>
          <?= $this->session->flashdata('message') ?>
        </div>
      </div>

    </div>

  </header>
  <!-- header end -->


  <?= $contens ?>

  <!-- footer -->
  <footer class="footer-light">
    <div class="light-layout">
      <div class="container">
        <section class="small-section border-section border-top-0">
          <div class="row">
            <!--div class="col-lg-6">
              <div class="subscribe">
                <div>
                  <h4><?= lang('title_news_footer') ?>!</h4>
                  <p><?= lang('desc_news_footer') ?></p>
                </div>
              </div>
            </div-->
            <!--div class="col-lg-6">
              <?= form_open(base_url() . 'home/add_newsletter', 'class="form-inline subscribe-form auth-form needs-validation" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form"') ?>
              <div class="form-group mx-sm-3">
                <input type="email" class="form-control" name="email" id="mce-EMAIL" placeholder="<?= lang('placeholder_subscribe_footer') ?>" required="required">
              </div>
              <button type="submit" class="btn btn-solid" id="mc-submit"><?= lang('subscribe_footer') ?></button>
              <?= form_close() ?>
            </div>
          </div-->
        </section>
      </div>
    </div>
    <section class="section-b-space light-layout">
      <div class="container">
        <div class="row footer-theme partition-f">
          <div class="col-lg-4 col-md-6">
            <div class="footer-title footer-mobile-title">
              <h4>about</h4>
            </div>
            <div class="footer-contant">
              <div class="footer-logo"><img src="<?= smn_baseurl() ?>uploads/webinformations/<?= $this->fungsi->webinformation()->image_logo ?>" alt=""></div>
              <p><?= $this->fungsi->webinformation()->description_web ?></p>
              <div class="footer-social">
                <ul>
                  <li><a href="<?= $this->fungsi->webinformation()->facebook ?>"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                  <li><a href="<?= $this->fungsi->webinformation()->google_plus ?>"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                  <li><a href="<?= $this->fungsi->webinformation()->twitter ?>"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                  <li><a href="<?= $this->fungsi->webinformation()->instagram ?>"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                  <li><a href="<?= $this->fungsi->webinformation()->web ?>"><i class="fa fa-rss" aria-hidden="true"></i></a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col offset-xl-1">
            <div class="sub-title">
              <div class="footer-title">
                <h4><?= lang('MyAccount') ?></h4>
              </div>
              <div class="footer-contant">
                <ul>
                  <?php if ($this->ion_auth->logged_in()) { ?>
                    <li><a href="<?= base_url('users') ?>" data-lng="es"><?= lang('MyAccount') ?></a></li>
                    <li><a href="<?= base_url('auth/logout') ?>" data-lng="es"><?= lang('LogOut') ?></a></li>
                  <?php } else { ?>
                    <li><a href="<?= base_url('login') ?>" data-lng="en"><?= lang('login') ?></a></li>
                    <li><a href="<?= base_url('register') ?>" data-lng="en"><?= lang('register') ?></a></li>
                  <?php  } ?>

                </ul>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="sub-title">
              <div class="footer-title">
                <h4><?= lang('why_shoosus_nav') ?></h4>
              </div>
              <div class="footer-contant">
                <ul>
                  <?php
                  $all_pages = $this->db->where('active', 1)->order_by('order_number', 'ASC')->get('pages')->result();
                  foreach ($all_pages as $pages) {
                  ?>
                    <li><a href="<?= base_url() ?>pages/<?= $pages->slug ?>"><?= $pages->title ?></a></li>
                  <?php } ?>
                </ul>
              </div>
            </div>
          </div>
          <div class="col">
            <div class="sub-title">
              <div class="footer-title">
                <h4><?= lang('store_information_nav') ?></h4>
              </div>
              <div class="footer-contant">
                <ul class="contact-list">
                  <li><i class="fa fa-map-marker"></i><?= $this->fungsi->webinformation()->alamat ?>
                  </li>
                  <li><i class="fa fa-phone"></i><?= lang('call_us_nav') ?>: <?= $this->fungsi->webinformation()->telephone ?></li>
                  <li><i class="fa fa-envelope-o"></i><?= lang('email_us_nav') ?>: <a href="#"><?= $this->fungsi->webinformation()->email ?></a></li>
                  <li><i class="fa fa-fax"></i>Fax: <?= $this->fungsi->webinformation()->fax ?></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <div class="sub-footer">
      <div class="container">
        <div class="row">
          <div class="col-xl-3 col-md-3 col-sm-12">
            <div class="footer-end">
              <p><i class="fa fa-copyright" aria-hidden="true"></i> <?= date('Y') ?> <?= $this->fungsi->webinformation()->name_web ?></p>
            </div>
          </div>
          <div class="col-xl-5 col-md-5 col-sm-12">
            <div class="footer-end">
              <p>CV BOCOROCCO ENTREPRENEUR <br>
                <i class="fa fa-map-marker" aria-hidden="true"></i>
                Ruko Galeri Niaga Mediterania II Blok M Nomor 8R-8Q, Desa/Kelurahan Kapuk Muara, Kec. Penjaringan, Kota Adm. Jakarta Utara, Provinsi DKI Jakarta <br>
              </p>
            </div>
          </div>
          <div class="col-xl-4 col-md-4 col-sm-12">
            <div class="payment-card-bottom">
              <ul>
                <li class="mt-4 mb-1">
                  <a><img src="<?= base_url() ?>assets/images/icon/visa.png" alt="" style="height: 15px"></a>
                </li>
                <li class="mt-4 mb-1">
                  <a><img src="<?= base_url() ?>assets/images/icon/mastercard.png" alt="" style="height: 15px"></a>
                </li>
                <li class="mt-4 mb-1">
                  <a><img src="<?= base_url() ?>assets/images/icon/logo-jcb.png" alt="" style="height: 15px"></a>
                </li>
                <li class="mt-4 mb-1">
                  <a><img src="<?= base_url() ?>assets/images/icon/logo-bca.png" alt="" style="height: 15px"></a>
                </li>
                <li class="mt-4 mb-1">
                  <a><img src="<?= base_url() ?>assets/images/icon/logo-bni.png" alt="" style="height: 15px"></a>
                </li>
                <li class="mt-4 mb-1">
                  <a><img src="<?= base_url() ?>assets/images/icon/logo-mandiri.png" alt="" style="height: 15px"></a>
                </li>
                <li class="mt-4 mb-1">
                  <a><img src="<?= base_url() ?>assets/images/icon/logo-bri.png" alt="" style="height: 15px"></a>
                </li>
                <li class="mt-4 mb-1">
                  <a><img src="<?= base_url() ?>assets/images/icon/logo-permata.png" alt="" style="height: 15px"></a>
                </li>
                <li class="mt-4 mb-1">
                  <a><img src="<?= base_url() ?>assets/images/icon/logo-ovo.png" alt="" style="height: 15px"></a>
                </li>
                <li class="mt-4 mb-1">
                  <a><img src="<?= base_url() ?>assets/images/icon/logo-dana.png" alt="" style="height: 15px"></a>
                </li>
                <li class="mt-4 mb-1">
                  <a><img src="<?= base_url() ?>assets/images/icon/logo-shopeepay.png" alt="" style="height: 15px"></a>
                </li>
                <li class="mt-4 mb-1">
                  <a><img src="<?= base_url() ?>assets/images/icon/logo-linkaja.png" alt="" style="height: 15px"></a>
                </li>
                <li class="mt-4 mb-1">
                  <a><img src="<?= base_url() ?>assets/images/icon/logo-qris.png" alt="" style="height: 15px"></a>
                </li>
                <li class="mt-4 mb-1">
                  <a><img src="<?= base_url() ?>assets/images/icon/logo-alfamart.png" alt="" style="height: 15px"></a>
                </li>
                <li class="mt-4 mb-1">
                  <a><img src="<?= base_url() ?>assets/images/icon/logo-indomaret.png" alt="" style="height: 15px"></a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <!-- footer end -->

  <?php if ($title == 'Home | Bocorocco Pillow Concept') { ?>
    <?php if ($banner_popup) { ?>
      <!--modal popup start-->
      <div class="modal fade bd-example-modal-lg theme-modal" id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
          <div class="modal-content border-radius-25">
            <div class="modal-body modal1 modal-bg-none">
              <div class="container-fluid p-0">
                <div class="row">
                  <div class="col-12">
                    <div class="modal-bg pad-10">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <div class="offer-content text-center">
                        <img src="<?= smn_baseurl() ?>uploads/popupbanner/<?= $banner_popup->image_banner ?>" class="img-fluid mb-0 blur-up lazyload" width="90%" alt="">
                        <h4><strong><?= strtoupper($banner_popup->title_popup) ?></strong></h4>
                        <?= form_open(base_url() . 'home/add_newsletter', 'class="auth-form needs-validation" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form"') ?>
                        <div class="form-group mx-sm-3">
                          <div class="col-xs-12">
                            <input type="email" class="form-control" name="email" id="mce-EMAIL" placeholder="<?= lang('placeholder_subscribe_footer') ?>" required="required">
                          </div>
                          <button type="submit" class="btn btn-solid btn-sm" id="mc-submit"><?= lang('subscribe_footer') ?></button>
                        </div>
                        <?= form_close() ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--modal popup end-->
    <?php } ?>

    <?php
    $all_popupnotif = $this->db->where('active', 1)->order_by('popup_id', 'DESC')->get('popup_notification')->result();
    if (!empty($all_popupnotif)) {
    ?>
      <!-- exit modal popup start-->
      <div class="modal fade bd-example-modal-lg theme-modal exit-modal" id="exampleModal2" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-body modal1">
              <div class="container-fluid p-0">
                <div class="row">
                  <div class="col-12">
                    <div class="modal-bg">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      <div class="media">
                        <img src="" class="stop img-fluid blur-up lazyload mr-3" alt="">
                        <?php foreach ($all_popupnotif as $popupnotif) { ?>
                          <div class="media-body text-left align-self-center">
                            <div>
                              <?= $popupnotif->content ?>
                            </div>
                          </div>
                          <hr>
                        <?php } ?>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php } ?>
    <!-- Add to cart modal popup end-->


    <!-- Quick-view modal popup start-->
    <!-- <div class="modal fade bd-example-modal-lg theme-modal" id="quick-view" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content quick-view-modal">
        <div class="modal-body">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <div class="row">
            <div class="col-lg-6 col-xs-12">
              <div class="quick-view-img"><img src="assets/images/pro3/1.jpg" alt="" class="img-fluid blur-up lazyload"></div>
            </div>
            <div class="col-lg-6 rtl-text">
              <div class="product-right">
                <h2>Women Pink Shirt</h2>
                <h3>$32.96</h3>
                <ul class="color-variant">
                  <li class="bg-light0"></li>
                  <li class="bg-light1"></li>
                  <li class="bg-light2"></li>
                </ul>
                <div class="border-product">
                  <h6 class="product-title">product details</h6>
                  <p>Sed ut perspiciatis, unde omnis iste natus error sit voluptatem accusantium
                    doloremque laudantium</p>
                </div>
                <div class="product-description border-product">
                  <div class="size-box">
                    <ul>
                      <li class="active"><a href="#">s</a></li>
                      <li><a href="#">m</a></li>
                      <li><a href="#">l</a></li>
                      <li><a href="#">xl</a></li>
                    </ul>
                  </div>
                  <h6 class="product-title">quantity</h6>
                  <div class="qty-box">
                    <div class="input-group"><span class="input-group-prepend"><button type="button" class="btn quantity-left-minus" data-type="minus" data-field=""><i class="ti-angle-left"></i></button> </span>
                      <input type="text" name="quantity" class="form-control input-number" value="1"> <span class="input-group-prepend"><button type="button" class="btn quantity-right-plus" data-type="plus" data-field=""><i class="ti-angle-right"></i></button></span>
                    </div>
                  </div>
                </div>
                <div class="product-buttons"><a href="#" class="btn btn-solid">add to cart</a> <a href="#" class="btn btn-solid">view detail</a></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div> -->
    <!-- Quick-view modal popup end-->

  <?php } ?>






  <!-- facebook chat section start -->
  <div id="fb-root"></div>
  <!--script>
    (function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s);
      js.id = id;
      js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js#xfbml=1&version=v2.12&autoLogAppEvents=1';
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
  </script-->
  <!-- Your customer chat code -->
  <div class="fb-customerchat" attribution=setup_tool page_id="2123438804574660" theme_color="#0084ff" logged_in_greeting="Hi! Welcome to PixelStrap Themes  How can we help you?" logged_out_greeting="Hi! Welcome to PixelStrap Themes  How can we help you?">
  </div>
  <!-- facebook chat section end -->

  <!-- tap to top -->
  <div class="tap-top top-cls">
    <div>
      <i class="fa fa-angle-double-up"></i>
    </div>
  </div>
  <!-- tap to top end -->

  <script src="<?= base_url() ?>assets/js/scripts_compress.js"></script>
  <!-- Size jquery-->
  <!--script src="<!?= base_url() ?>assets/js/scriptsize.js"></script>

  <!-- fly cart ui jquery-->
  <!--script src="<!?= base_url() ?>assets/js/jquery-ui.min.js"></script>

  <!-- exitintent jquery-->
  <!--script src="<!?= base_url() ?>assets/js/jquery.exitintent.js"></script>

  <!-- <script src="<!?= base_url() ?>assets/js/exit.js"></script> ngga ada-->

  <!-- popper js-->
  <!--script src="<!?= base_url() ?>assets/js/popper.min.js"></script>

  <!-- slick js-->
  <!--script src="<!?= base_url() ?>assets/js/slick.js"></script>

  <script src="<!?= base_url() ?>assets/js/jquery.magnific-popup.js"></script>

  <script src="<!?= base_url() ?>assets/js/zoom-gallery.js"></script>

  <!-- menu js-->
  <!--script src="<!?= base_url() ?>assets/js/menu.js"></script>

  <!-- lazyload js-->
  <!--script src="<!?= base_url() ?>assets/js/lazysizes.min.js"></script>

  <!-- price range js -->
  <!--script src="<!?= base_url() ?>assets/js/price-range.js"></script>

  <!-- Bootstrap js-->
  <!--script src="<!?= base_url() ?>assets/js/bootstrap.js"></script>

  <!-- Bootstrap Notification js-->
  <!--script src="<!?= base_url() ?>assets/js/bootstrap-notify.min.js"></script>


  <!-- <script src="<!?= base_url() ?>assets/js/jquery.elevatezoom.js"></script> ngga ada-->


  <!-- Fly cart js-->
  <!--script src="<!?= base_url() ?>assets/js/fly-cart.js"></script>



  <!-- Theme js-->
  <!--script src="<!?= base_url() ?>assets/js/script.js"></script>

  <script src="<!?= base_url() ?>assets/js/chosen.jquery.min.js"></script>

  <!-- <script src="<!? //= base_url() 
                    ?>assets/js/jquery.datetimepicker.full.js"></script> ngga ada-->

  <!--script src="<!?= base_url() ?>assets/js/bootstrap-datepicker.js"></script-->

  <?php if ($title != 'Cekout | Bocorocco Pillow Concept') { ?>
    <script src="<?= base_url() ?>assets/js/additional.js"></script>
  <?php } ?>

  <script>
    var baseurl = '<?= base_url() ?>';
    var islogin = '<?= $this->ion_auth->logged_in() ?>';
    var kabupatenid = '';
    var current_date = '<?= date('Y-m-d') ?>';
    <?php if ($this->ion_auth->logged_in()) { ?>
      var kabupatenid = '<?= $this->ion_auth->user()->row()->kab ?>';
    <?php } ?>
  </script>
  <script>
    $(window).on('load', function() {
      $('#exampleModal').modal('show');
      var showOne = localStorage.getItem("show-1");

      if (!showOne) {
        setTimeout(function() {
          $('#exampleModal').modal('show');
          localStorage.setItem("show-1", '1');
        }, 2500);
      }
    });

    $(window).on('load', function() {
      var showTow = localStorage.getItem("show-2");
      if (!showTow) {
        setTimeout(function() {
          $('#exampleModal2').modal('show');
          localStorage.setItem("show-2", '1');
        }, 6500);
      }
    });


    function openSearch() {
      document.getElementById("search-overlay").style.display = "block";
    }

    function closeSearch() {
      document.getElementById("search-overlay").style.display = "none";
    }
    <?php
    if ($this->session->userdata('user_id')) { ?>
      var id = "<?= ($this->session->userdata('user_id')) ? $this->session->userdata('user_id') : '' ?>";
      var tgl = "<?= date('Y-m-d') ?>";
      var naikP = cek_naik(tgl, id);
    <?php
    }
    ?>

    function cek_naik(tgl, id) {
      var data = 'tgl=' + tgl + '&id=' + id;
      var mem = $.ajax({
        type: "POST",
        url: "<?= smn_baseurl() ?>administrator/HeandelPayment/hitungNaikperingkat_ajax", ///"+kd_area
        async: false,
        data: data
      }).responseText;

      return mem;
    }
  </script>

  <?php
  if ($title == 'Home | Bocorocco Pillow Concept') {
  ?>
    <!--script src="<!?= base_url() ?>assets/js/jquery.instagramFeed.p.min.js"></script-->

    <!-- <script>
      $.instagramFeed({
        'proxy_image_url': "<!?= base_url() ?>assets/instamedia/instamedia.php",
        'username': 'bocorocco',
        'container': "#instagram",
        'display_profile': false,
        'display_biography': false,
        'display_gallery': true,
        'get_raw_json': false,
        'callback': null,
        'styling': true,
        'items': 8,
        'items_per_row': 8,
        'margin': 1
      });
    </script> -->

    <!--script>
      (function($) {
        $(window).on('load', function() {
          jQuery.instagramFeed({
            'proxy_image_url': "<!?= base_url() ?>assets/instamedia/instamedia.php",
            'username': 'bocorocco',
            'container': "#instagram",
            'display_profile': false,
            'display_biography': false,
            'display_gallery': true,
            'get_raw_json': false,
            'callback': function(data) {
              console.log(data);
              $(".instagram-sidecar img, .instagram-image img, .instagram-video img").on("error", function() {
                $(this).hide();
                $(this).parent('a').hide();
              });
            },
            'styling': true,
            'items': 12,
            'items_per_row': 8,
            'margin': 1,
            'lazy_load': true,
          });
        });
      })(jQuery);
    </script-->
  <?php } ?>
  <!-- Google Tag Manager (noscript) -->
  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MC364SQ" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
  <!-- End Google Tag Manager (noscript) -->
</body>

</html>