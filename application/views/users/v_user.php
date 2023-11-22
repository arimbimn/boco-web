<style>
  /* tambahan count down */

  .count {
    background: #000000;
    color: #adafb2;
    padding: 20px;
    margin-bottom: 40px;
  }

  h4 {
    color: #ffffff;
    text-align: center;
    text-transform: uppercase;
    font-size: 1.5vw;
  }

  ul#countdown {
    position: relative;
    width: 35%;
    margin: 0 auto;
    color: #fff;
    /* border: 1px solid #adafb2; */
    /* border-width: 1px 0; */
    overflow: hidden;
    font-family: 'Arial Narrow', Arial, sans-serif;
    font-weight: bold;
    /* margin-bottom: 40px; */
    background-color: #000000;
  }

  ul#countdown li {
    margin: 0 -3px 0 0;
    padding: 0;
    display: inline-block;
    width: 20%;
    font-size: 72px;
    font-size: 2vw;
    text-align: center;
  }

  ul#countdown li .label {
    color: #ffffff;
    font-size: 18px;
    font-size: 1.5vw;
    text-transform: uppercase;
  }

  ul#countdown li .number {
    color: #d9534f;
  }

  @media (max-width: 768px) {
    .count {
      background: #000000;
      color: #adafb2;
      padding: 15px;
      margin-bottom: 40px;
    }

    h4 {
      color: #ffffff;
      text-align: center;
      text-transform: uppercase;
      font-size: 3vw;
    }

    ul#countdown {
      position: relative;
      width: 70%;
      margin: 0 auto;
      color: #fff;
      overflow: hidden;
      font-family: 'Arial Narrow', Arial, sans-serif;
      font-weight: bold;
      background-color: #000000;
    }

    ul#countdown li {
      margin: 0 -3px 0 0;
      padding: 0;
      display: inline-block;
      width: 20%;
      font-size: 72px;
      font-size: 7vw;
      text-align: center;
    }

    ul#countdown li .label {
      color: #ffffff;
      font-size: 18px;
      font-size: 2vw;
      text-transform: uppercase;
    }

    ul#countdown li .number {
      color: #d9534f;
    }
  }
</style>


<!-- breadcrumb start -->
<div class="breadcrumb-section">
  <div class="container">
    <div class="row">
      <div class="col-sm-6">
        <div class="page-title">
          <h2><?= lang('title_dashboard_user') ?> <?= ($this->session->userdata('reseller') == '1' ? 'ENTREPRENEURSHIP' : 'MEMBER') ?></h2>
        </div>
      </div>
      <div class="col-sm-6">
        <nav aria-label="breadcrumb" class="theme-breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('/') ?>"><?= lang('beranda') ?> </a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('/users') ?>"><?= lang('my_account') ?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= lang('title_dashboard_user') ?> <?= ($this->session->userdata('reseller') == '1' ? 'ENTREPRENEURSHIP' : 'MEMBER') ?></li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
</div>
<!-- breadcrumb End -->



<!-- section start -->
<section class="section-b-space">
  <div class="count">
    <div class="container-countdown">
      <h4 id="headline">Voucher Family Package akan segera berakhir!</h4>
      <!-- tambahan countdown -->
      <ul id="countdown">
        <li id="days">
          <div class="number">00</div>
          <div class="label">Hari</div>
        </li>
        <li id="hours">
          <div class="number">00</div>
          <div class="label">Jam</div>
        </li>
        <li id="minutes">
          <div class="number">00</div>
          <div class="label">Menit</div>
        </li>
        <li id="seconds">
          <div class="number">00</div>
          <div class="label">Detik</div>
        </li>
        <li id="milseconds">
          <div class="number">00</div>
          <div class="label">Milidetik</div>
        </li>
      </ul>
    </div>
  </div>

  <div class="container">
    <div class="row">
      <div class="col-lg-3">
        <div class="account-sidebar"><a class="popup-btn"> <i class="fa fa-bars"></i> <?= lang('MyAccount') ?> <?= ($this->session->userdata('reseller') == '1' ? 'ENTREPRENEURSHIP' : 'MEMBER') ?></a></div>
        <div class="dashboard-left">
          <div class="collection-mobile-back"><span class="filter-back"><i class="fa fa-angle-left" aria-hidden="true"></i><?= lang('back') ?></span></div>
          <div class="block-content">
            <?php $this->load->view('users/v_menu_user') ?>
          </div>
        </div>
      </div>
      <div class="col-lg-9">
        <div class="dashboard-right">
          <div class="dashboard">
            <div class="page-title">
              <h2><?= lang('title_dashboard_user') ?> <?= ($this->session->userdata('reseller') == '1' ? 'ENTREPRENEURSHIP' : 'MEMBER') ?></h2>
            </div>
            <div class="welcome-msg">
              <p>Hello, <?= $this->ion_auth->user()->row()->first_name ?> !</p>
              <p><?= lang('desc_dashboard_user') ?></p>
              <?php if ($this->session->userdata('reseller') != "1") { ?>
                <?php $cekMember = $this->db->where(['user_id' => $this->ion_auth->user()->row()->id])->where('masaberlaku >=', date('Y-m-d'))->get('user_membership')->row(); ?>

                <?php if ($cekMember) { ?>
                  <?php $descMember = $this->db->where(['type' => $cekMember->peringkat_member])->get('user_membership_achievement')->row(); ?>
                  <?php if ($cekMember->peringkat_member == 'GOLD') {  ?>
                    <h4 style="color: red;"><?= lang('member_status') ?> = <?= $cekMember->peringkat_member ?></h4>
                    <h4 style="color: red;">member validity period = <?= date('d M, Y', strtotime($cekMember->masaberlaku)) ?></h4>
                    <?= $descMember->desc ?>
                    <p style="color: red;"><?= lang('next_achievement') ?> PLATINUM</p>
                  <?php } else if ($cekMember->peringkat_member == 'PLATINUM') { ?>
                    <h4 style="color: red;"><?= lang('member_status') ?> = <?= $cekMember->peringkat_member ?></h4>
                    <h4 style="color: red;">member validity period = <?= date('d M, Y', strtotime($cekMember->masaberlaku)) ?></h4>
                    <?= $descMember->desc ?>
                    <p style="color: red;"><?= lang('next_achievement') ?> DIAMOND</p>
                  <?php } else if ($cekMember->peringkat_member == 'DIAMOND') { ?>
                    <?= $descMember->desc ?>
                    <h4 style="color: red;"><?= lang('member_status') ?> = <?= $cekMember->peringkat_member ?></h4>
                    <h4 style="color: red;">member validity period = <?= date('d M, Y', strtotime($cekMember->masaberlaku)) ?></h4>
                  <?php } ?>
                <?php } else {  ?>
                  <p style="color: red;"><?= lang('member_gold_message') ?></p>
                  <p style="color: red;"><?= lang('next_achievement') ?> GOLD</p>
                <?php } ?>
              <?php } ?>
            </div>
            <div class="box-account box-info">
              <div class="box-head">
                <h2><?= lang('account_information') ?></h2>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <div class="box">
                    <div class="box-title">
                      <h3><?= lang('contact_information') ?></h3><a href="<?= base_url('usersedit/' . $this->ion_auth->user()->row()->id) ?>">Edit</a>
                    </div>
                    <div class="box-content">
                      <h6><?= $this->ion_auth->user()->row()->first_name ?> <?= $this->ion_auth->user()->row()->last_name ?></h6>
                      <h6><?= $this->ion_auth->user()->row()->email ?></h6>
                      <h6><a href="#"><?php echo lang('reset_password_heading'); ?></a></h6>
                    </div>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="box">
                    <!-- <div class="box-title">
                          <h3><?= lang('newsletters_user') ?></h3><a href="#">Edit</a>
                        </div> -->
                    <!-- <div class="box-content">
                          <p><?= lang('not_newsletters_user') ?>.</p>
                        </div> -->
                  </div>
                </div>
              </div>
              <div>
                <div class="box">
                  <div class="box-title">
                    <h3><?= lang('address_book_user') ?></h3>
                  </div>
                  <div class="row">
                    <div class="col-sm-6">
                      <h6><?= lang('address_default_user') ?> </h6>
                      <?php if ($this->ion_auth->user()->row()->address == null) { ?>
                        <address><?= lang('not_set_address') ?><br><a href="<?= base_url('usersedit/' . $this->ion_auth->user()->row()->id) ?>">Edit
                            <?= lang('address_user') ?></a></address>
                      <?php  } else { ?>
                        <address><?= $this->ion_auth->user()->row()->address  ?><br><a href="<?= base_url('usersedit/' . $this->ion_auth->user()->row()->id) ?>">Edit
                            <?= lang('address_user') ?></a></address>
                      <?php } ?>

                    </div>
                  </div>
                </div>
                <!--pastikan refferal user mau dipakai ngga ebe-->
                <?php if ($this->session->userdata('reseller') == "1" && $this->ion_auth->user()->row()->sts_reseller == "1") { ?>
                  <div class="box">
                    <div class="box-head">
                      <h2>Copy & share link Entrepreneurship Anda</h2><br />
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="d-flex">
                          <input type="text" class="form-control" readonly value="<?= base_url('reg/') . $this->ion_auth->user()->row()->username ?>" id="data">
                          <button type="button" class="btn btn-solid" id="copy">Copy</button>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php } ?>
                <br><br>

                <?php if ($this->session->userdata('reseller') != "1") {
                  if ($cekMember) { ?>
                    <?php $descMember = $this->db->where(['type' => $cekMember->peringkat_member])->get('user_membership_achievement')->row(); ?>
                    <?php if ($cekMember->peringkat_member == 'GOLD') {  ?>
                      <img src="<?= base_url('/assets/images/CARDS/') . str_replace(' ', '_', $this->ion_auth->user()->row()->username) ?>-GOLD.png" width="50%" alt="">
                    <?php } else if ($cekMember->peringkat_member == 'PLATINUM') { ?>
                      <img src="<?= base_url('/assets/images/CARDS/') . str_replace(' ', '_', $this->ion_auth->user()->row()->username)  ?>-PLATINUM.png" width="50%" alt="">
                    <?php } else if ($cekMember->peringkat_member == 'DIAMOND') { ?>
                      <img src="<?= base_url('/assets/images/CARDS/') . str_replace(' ', '_', $this->ion_auth->user()->row()->username) ?>-DIAMOND.png" width="50%" alt="">
                    <?php } ?>
                  <?php } else {  ?>
                    <!-- <p style="color: red;">Cukup Belanja 1 Item Product Anda Mendapatkan Member GOLD</p>
                            <p style="color: red;">Next achievement GOLD</p> -->
                <?php }
                }  ?>
              </div>
            </div>
          </div>

          <div id="canvas"></div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- section end -->
<!--?php if ($cekMember) { ?-->
<!-- <script type="text/javascript" src="https://unpkg.com/qr-code-styling/lib/qr-code-styling.js"></script>
      <script type="text/javascript">
        const qrCode = new QRCodeStyling({
          width: 300,
          height: 300,
          data: "",
          image: "https://bocorocco.graphie.co.id/web/assets/images/1609746656-favicon.png",
          dotsOptions: {
            color: "#000",
            type: "square"
          },
          backgroundOptions: {
            color: "#FFFFFF",
          }
        });
        qrCode.append(document.getElementById("canvas"));
      </script> -->
<!--?php } ?-->

<script>
  $(document).ready(function() {
    $("#copy").click(function() {
      $("#data").select();
      document.execCommand("copy");
      alert("Copied On clipboard");
    });
  });

  // tambahan coundown
  var targetDate = new Date('2023-11-13 15:26:00:00');

  var voucherFamilyPackageDibeli = true;

  if (voucherFamilyPackageDibeli) {
    targetDate.setDate(targetDate.getDate());
  } else {
    $("#countdown").hide();
  }

  var days;
  var hrs;
  var min;
  var sec;
  var milsec;

  $(function() {
    timeToLaunch();
    numberTransition('#days .number', days, 1000, 'easeOutQuad');
    numberTransition('#hours .number', hrs, 1000, 'easeOutQuad');
    numberTransition('#minutes .number', min, 1000, 'easeOutQuad');
    numberTransition('#seconds .number', sec, 1000, 'easeOutQuad');
    numberTransition('#milseconds .number', milsec, 1000, 'easeOutQuad');
    setTimeout(countDownTimer, 1);
  });

  function timeToLaunch() {
    var currentDate = new Date();

    // console.log(currentDate - targetDate)

    if ((targetDate - currentDate) <= 0) {
      days = 0
      hrs = 0
      min = 0
      sec = 0
      milsec = 0
      $("#countdown").hide();
    } else {

      var diff = targetDate - currentDate;
      days = Math.floor(diff / (1000 * 60 * 60 * 24));
      diff -= days * (1000 * 60 * 60 * 24);

      hrs = Math.floor(diff / (1000 * 60 * 60));
      diff -= hrs * (1000 * 60 * 60);

      min = Math.floor(diff / (1000 * 60));
      diff -= min * (1000 * 60);

      sec = Math.floor(diff / 1000);
      diff -= sec * 1000;

      milsec = diff;

    }
  }

  function countDownTimer() {

    timeToLaunch();

    $("#days .number").text(days);
    $("#hours .number").text(hrs);
    $("#minutes .number").text(min);
    $("#seconds .number").text(sec);
    $("#milseconds .number").text(milsec);

    setTimeout(countDownTimer, 1);
  }

  function numberTransition(id, endPoint, transitionDuration, transitionEase) {
    $({
      numberCount: $(id).text()
    }).animate({
      numberCount: endPoint
    }, {
      duration: transitionDuration,
      easing: transitionEase,
      step: function() {
        $(id).text(Math.floor(this.numberCount));
      },
      complete: function() {
        $(id).text(this.numberCount);
      }
    });
  };
</script>