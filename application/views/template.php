<!DOCTYPE html>
<html lang="en" translate="no">


<head>
  <!-- Meta tags -->
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Stylesheets -->
  <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/css_compress.css">
  <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/css_baru.css">
  <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/style-tw.css">

  <!-- Include Glide.js CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@glidejs/glide/dist/css/glide.core.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@glidejs/glide/dist/css/glide.theme.min.css">

  <!-- Include Glide.js JavaScript -->
  <script src="https://cdn.jsdelivr.net/npm/@glidejs/glide"></script>


  <!-- Icons -->
  <!-- link rel="stylesheet" type="text/css" href="<!?= base_url() ?>assets/css/fontawesome.css"> -->

  <!--Slick slider css-->
  <!-- <link rel="stylesheet" type="text/css" href="<!?= base_url() ?>assets/css/slick.css"> -->
  <!-- <link rel="stylesheet" type="text/css" href="<!?= base_url() ?>assets/css/slick-theme.css"> -->

  <!-- Uncomment or remove stylesheets as needed -->
  <!-- <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/fontawesome.css"> -->
  <!-- <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/slick.css"> -->
  <!-- <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/slick-theme.css"> -->
  <!-- <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/animate.css"> -->
  <!-- <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/stylesize.css"> -->
  <!-- <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/price-range.css"> -->
  <!-- <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/themify-icons.css"> -->
  <!-- <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/bootstrap.css"> -->
  <!-- <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/magnific-popup.css"> -->
  <!-- <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/color1.css" media="screen" id="color"> -->
  <!-- <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/chosen.css"> -->
  <!-- <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/datepicker3.css"> -->
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->

  <!-- Latest jQuery -->
  <!-- <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js?ver=6.1.1' id='eget_js_jquery-js'></script> -->
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <!-- from node_modules -->
  <script src="node_modules/@material-tailwind/html/scripts/collapse.js"></script>

  <!-- from cdn -->
  <script src="https://unpkg.com/@material-tailwind/html@latest/scripts/collapse.js"></script>



  <!-- Custom Styles or Scripts -->
  <style>
    /* Custom styles here */
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
<?php flush();
?>

<body>
  <a href="https://wa.me/<?= $this->fungsi->webinformation()->whatsapp ?>" class="wa-float" target="_blank"><i class="fa fa-whatsapp my-float"></i></a>

  <?php
  $this->load->view('components/header');
  ?>


  <?= $contens ?>

  <?php
  $this->load->view('components/footer');
  ?>

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

  <?php print_r(isset($footer_script) ? $footer_script : '')  ?>


  <script>
    window.addEventListener("DOMContentLoaded", (event) => {
      fadeEntryContent()
      $(window).scroll(function() {
        fadeEntryContent()
      });

      $("noscript").remove();
    });

    function fadeEntryContent() {
      $('.background-lazyload').each(function(i) {

        // if ($(this).attr('data-src') && $(this).offset().top < ($(window).scrollTop() + $(window).height() + 100)) {
        if ($(this).attr('data-src') && $(this).offset().top < ($(window).scrollTop() + $(window).height() + 100)) {

          var imageUrl = $(this).attr('data-src');
          $(this).css('background-image', 'url(' + imageUrl + ')');
          $(this).animate({
            'opacity': '1'
          }, 900);
          $(this).removeAttr('data-src');
        }
      })
      $('img.image-lazyload').each(function(i) {
        // $.each($('img.image-lazyload'), function() {
        // if ($(this).attr('data-src') && $(this).offset().top < ($(window).scrollTop() + $(window).height() + 100)) {
        if ($(this).attr('data-src') && $(this).offset().top < ($(window).scrollTop() + $(window).height() + 100)) {

          var imageUrl = $(this).attr('data-src');
          $(this).attr("src", imageUrl);
          $(this).animate({
            'opacity': '1'
          }, 900);
          $(this).removeAttr('data-src');
        }
      })
    }
  </script>

</body>

</html>