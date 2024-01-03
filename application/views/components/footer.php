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
      <section class="section-b-space light-layout bg-[#008C45]">
          <div class="container">
              <div class="row footer-theme partition-f">
                  <div class="col-lg-4 col-md-6">
                      <div class="footer-title footer-mobile-title">
                          <h4 class="!text-white text-lg">about</h4>
                      </div>
                      <div class="footer-contant">
                          <div class="footer-logo w-100 h-50"><img src="<?= smn_baseurl() ?>uploads/webinformations/<?= $this->fungsi->webinformation()->image_logo ?>" alt=""></div>
                          <p class="!text-white"><?= $this->fungsi->webinformation()->description_web ?></p>
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
                              <h4 class="!text-white"><?= lang('MyAccount') ?></h4>
                          </div>
                          <div class="footer-contant">
                              <ul>
                                  <?php if ($this->ion_auth->logged_in()) { ?>
                                      <li><a class="!text-white" href="<?= base_url('users') ?>" data-lng="es"><?= lang('MyAccount') ?></a></li>
                                      <li><a class="!text-white" href="<?= base_url('auth/logout') ?>" data-lng="es"><?= lang('LogOut') ?></a></li>
                                  <?php } else { ?>
                                      <li><a class="!text-white" href="<?= base_url('login') ?>" data-lng="en"><?= lang('login') ?></a></li>
                                      <li><a class="!text-white" href="<?= base_url('register') ?>" data-lng="en"><?= lang('register') ?></a></li>
                                  <?php  } ?>
                              </ul>
                          </div>
                      </div>
                  </div>
                  <div class="col">
                      <div class="sub-title">
                          <div class="footer-title">
                              <h4 class="!text-white"><?= lang('why_shoosus_nav') ?></h4>
                          </div>
                          <div class="footer-contant">
                              <ul>
                                  <?php
                                    $all_pages = $this->db->where('active', 1)->order_by('order_number', 'ASC')->get('pages')->result();
                                    foreach ($all_pages as $pages) {
                                    ?>
                                      <li><a class="!text-white" href="<?= base_url() ?>pages/<?= $pages->slug ?>"><?= $pages->title ?></a></li>
                                  <?php } ?>
                              </ul>
                          </div>
                      </div>
                  </div>
                  <div class="col">
                      <div class="sub-title">
                          <div class="footer-title">
                              <h4 class="!text-white"><?= lang('store_information_nav') ?></h4>
                          </div>
                          <div class="footer-contant">
                              <ul class="contact-list !text-white">
                                  <li class="!text-white"><i class="fa fa-map-marker !text-white"></i><?= $this->fungsi->webinformation()->alamat ?>
                                  </li>
                                  <li class="!text-white"><i class="fa fa-phone !text-white"></i><?= lang('call_us_nav') ?>: <?= $this->fungsi->webinformation()->telephone ?></li>
                                  <li class="!text-white"><i class="fa fa-envelope-o !text-white"></i><?= lang('email_us_nav') ?>: <a class="!text-white" href="#"><?= $this->fungsi->webinformation()->email ?></a></li>
                                  <li class="!text-white"><i class="fa fa-fax !text-white"></i>Fax: <?= $this->fungsi->webinformation()->fax ?></li>
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