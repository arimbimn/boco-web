    <!-- breadcrumb start -->
    <div class="breadcrumb-section">
      <div class="container">
        <div class="row">
          <div class="col-sm-6">
            <div class="page-title">
              <h2>Rincian Komisi</h2>
            </div>
          </div>
          <div class="col-sm-6">
            <nav aria-label="breadcrumb" class="theme-breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('/') ?>"><?= lang('beranda') ?></a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('/users') ?>"><?= lang('my_account') ?></a></li>
                <li class="breadcrumb-item active" aria-current="page">Rincian Komisi</li>
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
			  <div class="page-title">
                  <h2>Detail pembayaran</h2>
				  <hr>
				  Periode <?= $periode ?><!--Minggu <!?= $minggu.' | '.$start.' ke '.$end ?-->
                </div>
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
                                      <th colspan='2'>Rincian Komisi <?= $sts == '' ? '<span class="text-white bg-warning">Belum dibayar</span>' : '<span class="text-white bg-success">Sudah dibayar</span>' ?></th>
                                    </tr>
                                  </thead>
                                  <tbody>
								  <tr>
									<td>Total Komisi yang Dihasilkan</td>
									<td>IDR <?= number_format($saldo, 0, ',', '.') ?></td>
								  </tr>
								  <tr>
									<td>PPN 10%</td>
									<td><span class="text-danger">-
										<?php
										$potongan=(10/100)*$saldo;
										echo 'IDR '.number_format((int)$potongan, 0, ',', '.');
										?>
										</span>
									</td>
								  </tr>
								  <tr>
									<td>Komisi yang Dibayarkan</td>
									<td>IDR <?= number_format($saldo-$potongan, 0, ',', '.') ?></td>
								  </tr>
                                  </tbody>
								  <tfoot>
                                    <tr class="table-head">
                                      <th>Rincian Pesanan</th>
									  <th>
										  <!--a href="<!?= base_url('komisicontroller/rincianpesanan/?id='.$id.'&start='.$start.'&end='.$end) ?>" class="label-default" id="mc-submit">Lihat pesanan</a-->
										  <a href="<?= base_url('KomisiController/rincianpesanan/?id='.$id.'&periode='.$periode) ?>" class="label-default" id="mc-submit">Lihat pesanan</a>
										  </th>
                                    </tr>
                                  </tfoot>
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