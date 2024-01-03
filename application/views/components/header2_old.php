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
                                      <!--li><a href="<!?= base_url('register') ?>" data-lng="en"><!?= lang('register') ?></a></li-->
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