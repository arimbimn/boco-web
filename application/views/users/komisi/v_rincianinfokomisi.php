    <!-- breadcrumb start -->
    <div class="breadcrumb-section">
      <div class="container">
        <div class="row">
          <div class="col-sm-6">
            <div class="page-title">
              <h2>Detail</h2>
            </div>
          </div>
          <div class="col-sm-6">
            <nav aria-label="breadcrumb" class="theme-breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('/') ?>"><?= lang('beranda') ?></a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('/users') ?>"><?= lang('my_account') ?></a></li>
                <li class="breadcrumb-item active" aria-current="page">Detail</li>
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
                <!-- product-tab starts -->
                <section class="tab-product m-0">
                  <div class="container">
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
										<th>Periode</th>
										<th>Tgl</th>
										<th>Penjualan pribadi</th>
										<th>Komisi keagenan</th>
										<th>Komisi royalti</th>
										<th>Pembelian dari</th>
										<th>Royalti dari</th>
										<th>KK dari</th>
										<th>Jenis</th>
										<th>Aksi</th>
                                    </tr>
                                  </thead>
                                  <tbody>
								  
                                    <?php 
                                    if($komisi_data){
                                    foreach ($komisi_data as $komisi) {
                                        $var_pph=0.05;
                                        $var_kp=0;
                                        $var_kk=0;
                                        $var_royalti=0;
                                        if($komisi->kp > 0){
                                            $potongan=$komisi->kp*$var_pph;
                                            $var_kp=$komisi->kp-$potongan;
                                        }
                                         if($komisi->kk > 0){
                                            $potongan=$komisi->kk*$var_pph;
                                            $var_kk=$komisi->kk-$potongan;
                                        }
                                         if($komisi->royalti > 0){
                                            $potongan=$komisi->royalti*$var_pph;
                                            $var_royalti=$komisi->royalti-$potongan;
                                        }
                                    ?>
                                      <tr>
                                        <td><?= $komisi->periode ?></td>
										<td><?= $komisi->tgl_omset ?></td>
                                        <td>IDR <?= number_format($komisi->kp, 0, ',', '.') ?>
										<!--?= ($komisi->kp != "") ? number_format($komisi->kp, 0, ',', '.') : number_format($komisi->kk, 0, ',', '.')  ?-->
                                        </td>
                                        <td>IDR <?= number_format($komisi->kk, 0, ',', '.') ?></td>
                                        <td>IDR <?= number_format($komisi->royalti, 0, ',', '.') ?></td>
										<!--td><!?= $komisi->kp_dari ?></td>
										<td><!?= $komisi->royalti_dari ?></td>
										<td><!?= $komisi->kk_dari ?></td-->
										<td><?php $arrkp=explode("-",$komisi->kp_dari); echo $arrkp[0] ?></td>
										<td><?php $arrroyal=explode("-",$komisi->royalti_dari); echo $arrroyal[0] ?></td>
										<td><?php $arrkk=explode("-",$komisi->kk_dari); echo $arrkk[0] ?></td>
										<td>
										    <?= $komisi->sts_omset ?>
										<!--?= ($komisi->sts_omset == 'kp') ? 'Komisi Pribadi' : 'Komisi Keagenan' ?-->
                                        </td>
                                        <td>
										<?php if($komisi->id_order !=''){ ?>
										  <a href="<?= base_url('KomisiController/orderdetail/' . $komisi->id_order) ?>" class="label-default" id="mc-submit" target="_blank">Lihat pesanan</a>
										<?php } ?>
                                        </td>
                                      <?php }
                                      
                                      }?>
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