    <!-- breadcrumb start -->
    <div class="breadcrumb-section">
      <div class="container">
        <div class="row">
          <div class="col-sm-6">
            <div class="page-title">
              <h2><?= lang('my_voucher') ?></h2>
            </div>
          </div>
          <div class="col-sm-6">
            <nav aria-label="breadcrumb" class="theme-breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('/') ?>"><?= lang('beranda') ?> </a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('/users') ?>"><?= lang('my_account') ?></a></li>
                <li class="breadcrumb-item active" aria-current="page"><?= lang('my_voucher') ?></li>
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
          <div class="account-sidebar"><a class="popup-btn"> <i class="fa fa-bars"></i> <?= lang('MyAccount') ?></a></div>
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
                <?php if ($voucher) {  ?>
                  <?php foreach ($voucher as $v_voc) {  ?>
                    <?php $cekUsed = $this->db->where(['user_id' => $this->ion_auth->user()->row()->id])->where(['voucher_id' => $v_voc->id_voucher])->get('voucher_used')->row(); ?>
                    <?php if ($cekUsed) { ?>
                      <?php if ($cekUsed->is_used == 1) {  ?>

                      <?php } else { ?>
                        <div class="card mb-3">
                          <h5 class="card-header"><?= $v_voc->nama_voucher ?></h5>
                          <div class="card-body">
                            <img src="<?= smn_baseurl() ?>/uploads/voucher/<?= $v_voc->images ?>" width="60%" alt="">
                            <p><?= $v_voc->desc ?></p>
                            <a href="#" class="btn btn-primary"><?= lang('voucher_available') ?></a>
                          </div>
                        </div>
                      <?php } ?>
                    <?php } else { ?>
                      <?php if ($v_voc->id_voucher == 41 || $v_voc->id_voucher == 42) { ?>
                        <?php $isused_redemtion = $this->db->where(['user_id' => $this->ion_auth->user()->row()->id])->where(['voucher_id' => 32])->where(['is_used' => 1])->get('voucher_used')->row(); ?>
                        <?php if ($isused_redemtion) { ?>
                          <div class="card mb-3">
                            <h5 class="card-header"><?= $v_voc->nama_voucher ?></h5>
                            <div class="card-body">
                              <img src="<?= smn_baseurl() ?>/uploads/voucher/<?= $v_voc->images ?>" width="60%" alt="">
                              <p><?= $v_voc->desc ?></p>
                              <a href="#" class="btn btn-primary"><?= lang('voucher_available') ?></a>
                            </div>
                          </div>
                        <?php } ?>
                      <?php } else if ($v_voc->id_voucher == 47) {
                        $isused_bgs = $this->db->where(['user_id' => $this->ion_auth->user()->row()->id])->where(['voucher_id' => 45])->where(['is_used' => 1])->get('voucher_used')->row();
                      ?>
                        <?php if ($isused_bgs) { ?>
                          <div class="card mb-3">
                            <h5 class="card-header"><?= $v_voc->nama_voucher ?></h5>
                            <div class="card-body">
                              <img src="<?= smn_baseurl() ?>/uploads/voucher/<?= $v_voc->images ?>" width="60%" alt="">
                              <p><?= $v_voc->desc ?></p>
                              <a href="#" class="btn btn-primary"><?= lang('voucher_available') ?></a>
                            </div>
                          </div>
                        <?php } ?>

                      <?php } else { ?>
                        <div class="card mb-3">
                          <h5 class="card-header"><?= $v_voc->nama_voucher ?></h5>
                          <div class="card-body">
                            <img src="<?= smn_baseurl() ?>/uploads/voucher/<?= $v_voc->images ?>" width="60%" alt="">
                            <p><?= $v_voc->desc ?></p>
                            <a href="#" class="btn btn-primary"><?= lang('voucher_available') ?></a>
                          </div>
                        </div>
                      <?php } ?>
                    <?php } ?>
                  <?php } ?>
                <?php } ?>

                <?php if ($voucher_referer) {  ?>
                  <?php foreach ($voucher_referer as $v_voucher_refer) {  ?>

                    <?php $user_refer = $this->M_refer->get_referuserDiamond()->result(); ?>

                    <?php if ($user_refer) { ?>
                      <?php $totalByrRefer = 0;
                      $totalOrder = 0;
                      $totalUser = 0;
                      $totalQtyUser = 0;
                      ?>
                      <?php foreach ($user_refer as $item_user) { ?>

                        <?php $orderItemTotal = $this->M_order->getReferTotalBelanja($item_user->user_refer)->row();
                        $totalByrRefer += $orderItemTotal->total_bayar;
                        $totalUser++;
                        ?>

                        <?php
                        $orderQtyTotal = $this->M_order->getReferQtyBelanja($item_user->user_refer)->row();
                        // var_dump($orderQtyTotal);
                        $totalQtyUser += $orderQtyTotal->qty;
                        ?>

                      <?php } ?>


                      <?php $cekUsed = $this->db->where(['user_id' => $this->ion_auth->user()->row()->id])->where(['voucher_id' => $v_voucher_refer->id_voucher])->get('voucher_used')->row(); ?>


                      <?php for ($m = 1; $m <= $totalUser; $m++) { ?>
                        <?php $cekUsageMulti = $this->db->where(['user_id' => $this->ion_auth->user()->row()->id])->where(['voucher_id' => $v_voucher_refer->id_voucher])->where(['val_multiples' => $m])->get('voucher_used')->row(); ?>
                        <?php if (!$cekUsageMulti) { ?>
                          <?php if (($m % $v_voucher_refer->total_refer_diamond) == 0) { ?>
                            <div class="card mb-3">
                              <h5 class="card-header"><?= $v_voucher_refer->nama_voucher ?></h5>
                              <div class="card-body">
                                <img src="<?= smn_baseurl() ?>/uploads/voucher/<?= $v_voucher_refer->images ?>" width="60%" alt="">
                                <p><?= $v_voucher_refer->desc ?></p>
                                <a href="#" class="btn btn-primary"><?= lang('voucher_available') ?></a>
                              </div>
                            </div>
                          <?php } ?>
                        <?php } else { ?>

                        <?php } ?>

                      <?php } ?>


                  <?php
                    }
                  } ?>
                <?php } ?>

                <?php if (empty($voucher) && empty($voucher_referer)) { ?>
                  <h4><?= lang('tidak_adadata') ?></h4>
                <?php } ?>

              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- section end -->