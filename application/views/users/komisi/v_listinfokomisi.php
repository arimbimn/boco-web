<!-- Tambahan Arimbi -->
<style>
  .text-white {
    font-size: 20px;
    /* Ganti dengan ukuran yang diinginkan */
    border-radius: 12px;
    padding: 8px;
  }

  .text-dark {
    font-size: 16px;
    /* Ganti dengan ukuran yang diinginkan */
    border-radius: 12px;
    padding: 5px;
  }

  .popup-btn {
    font-size: 12px;
    padding: 8px;
  }

  .account-sidebar {
    border-radius: 8px;
  }
</style>

<!-- breadcrumb start -->
<div class="breadcrumb-section">
  <div class="container">
    <div class="row">
      <div class="col-sm-6">
        <div class="page-title">
          <h2>Informasi</h2>
        </div>
      </div>
      <div class="col-sm-6">
        <nav aria-label="breadcrumb" class="theme-breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('/') ?>"><?= lang('beranda') ?></a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('/users') ?>"><?= lang('my_account') ?></a></li>
            <li class="breadcrumb-item active" aria-current="page">Informasi</li>
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
        <div class="account-sidebar">
          <a class="popup-btn">
            <i class="fa fa-bars"></i>
            <?= lang('MyAccount') ?>
          </a>
        </div>
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
            <!-- product-tab starts -->
            <section class="tab-product m-0">
              <div class="container">
                <div class="row">
                  <div class="col-lg-5 col-xs-5 mb-4">
                    <!--h4>Keagenan:--> <!--?= $peringkat ?--><!--/h4-->
                    <?php
                    $vsts_royalty = 'OFF';
                    $vexp = '';
                    $vclass = 'bg-danger text-white';
                    $vclass_2 = 'bg-danger text-white';
                    if ($data_royalti && $data_royalti->omset >= 27027027) {
                      $vsts_royalty = 'ON';
                      $vexp = $data_royalti->tgl_akhir;
                      $vclass = 'bg-success text-white';
                      $vclass_2 = 'bg-warning text-dark';
                      /*foreach ($data_royalti as $vroyalty) {
                                        $vsts_royalty='ON';
                                        $vexp=$vroyalty->tgl_akhir;
                                    }*/
                    }
                    ?>
                    <h4>Royalty: <span class='<?= $vclass ?>'><?= $vsts_royalty ?></span></h4>
                    <?php if ($vsts_royalty == 'ON') { ?>
                      <h4>Expired Royalty: <span class='<?= $vclass_2 ?>'><?= $vexp ?></span></h4>
                    <?php } ?>
                  </div>

                  <!-- Tambahan Arimbi -->
                  <div class="vertical-line"></div>
                  <div class="col-lg-5 col-xs-5">
                    <h2> Live Comition</h2>
                    <h3 class="bg-success text-white"> IDR 10.000.000, -
                      <span>
                        <strong>/ Day 1</strong>
                      </span>
                    </h3>
                  </div>


                </div>
                <div class="row">
                  <div class="col-sm-12 col-lg-12">
                    <!--?php $this->load->view('users/purchasehistory/v_submenu') ?-->
                    <div class="tab-content nav-material" id="top-tabContent">
                      <div class="tab-pane fade show active" id="top-home" role="tabpanel" aria-labelledby="top-home-tab">
                        <br>
                        <form name="form_adjustment_stok" id="form_adjustment_stok" action="<?= base_url('administrator/reseller/index'); ?>">
                          <!--?php if ($order_proses) { ?-->
                          <div class="table-responsive">
                            <table class="table cart-table table-responsive-xs">
                              <thead>
                                <tr class="table-head">
                                  <!--th>User ID</th-->
                                  <th>Periode validasi</th>
                                  <th>Penjualan pribadi</th>
                                  <th>Komisi keagenan</th>
                                  <th>Komisi royalti</th>
                                  <th>Total</th>
                                  <th>Aksi</th>
                                </tr>
                              </thead>
                              <tbody>

                                <?php
                                if ($komisi_data) {
                                  foreach ($komisi_data as $komisi) {
                                    if ($komisi->akumulasi_kp > 0 || $komisi->akumulasi_kk > 0 || $komisi->akumulasi_royalti > 0) {
                                      $var_pph = 0.05;
                                      $var_kp = 0;
                                      $var_kk = 0;
                                      $var_royalti = 0;
                                      if ($komisi->akumulasi_kp > 0) {
                                        $potongan = $komisi->akumulasi_kp * $var_pph;
                                        $var_kp = $komisi->akumulasi_kp - $potongan;
                                      }
                                      if ($komisi->akumulasi_kk > 0) {
                                        $potongan = $komisi->akumulasi_kk * $var_pph;
                                        $var_kk = $komisi->akumulasi_kk - $potongan;
                                      }
                                      if ($komisi->akumulasi_royalti > 0) {
                                        $potongan = $komisi->akumulasi_royalti * $var_pph;
                                        $var_royalti = $komisi->akumulasi_royalti - $potongan;
                                      }
                                ?>
                                      <tr>
                                        <!--td> <!?= $komisi->user_id ?-->
                                        </td>
                                        <td><!--?= 'Minggu '.$komisi->minggu.'<br/>'.$komisi->periode_start.' ke '.$komisi->periode_end ?-->
                                          <?= $komisi->periode ?>
                                        </td>
                                        <td>IDR <?= number_format($komisi->akumulasi_kp, 0, ',', '.')  ?>
                                        </td>
                                        <td>IDR <?= number_format($komisi->akumulasi_kk, 0, ',', '.')  ?>
                                        </td>
                                        <td>IDR <?= number_format($komisi->akumulasi_royalti, 0, ',', '.')  ?>
                                        </td>
                                        <td>IDR <?= number_format($komisi->akumulasi_kp + $komisi->akumulasi_kk + $komisi->akumulasi_royalti, 0, ',', '.')  ?>
                                        </td>
                                        <td>
                                          <a href="<?= base_url('KomisiController/rincianinfokomisi/?id=' . $komisi->user_id . '&periode=' . $komisi->periode) ?>" class="label-default" id="mc-submit">Lihat rincian</a>
                                        </td>
                                  <?php
                                    }
                                  }
                                } ?>
                                      </tr>
                              </tbody>

                            </table>
                          </div>
                          <!--?php } else { ?>
                              <!--?= lang('tidak_adadata') ?>
                            <!--?php } ?-->

                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </section>
            <!-- product-tab ends -->
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- section end -->