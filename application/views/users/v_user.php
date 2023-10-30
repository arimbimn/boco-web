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
				  <?php if($this->session->userdata('reseller') !="1"){?>
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
					<?php if($this->session->userdata('reseller') =="1" && $this->ion_auth->user()->row()->sts_reseller == "1"){ ?>
					<div class="box">
                      <div class="box-head">
                        <h2>Copy & share link Entrepreneurship Anda</h2><br/>
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

                    <?php if($this->session->userdata('reseller') !="1"){
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
						}	?>
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
    </script>