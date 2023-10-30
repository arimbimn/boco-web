    <!-- breadcrumb start -->
    <div class="breadcrumb-section">
      <div class="container">
        <div class="row">
          <div class="col-sm-6">
            <div class="page-title">
              <h2>Withdraw</h2>
            </div>
          </div>
          <div class="col-sm-6">
            <nav aria-label="breadcrumb" class="theme-breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('/') ?>"><?= lang('beranda') ?></a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('/users') ?>"><?= lang('my_account') ?></a></li>
                <li class="breadcrumb-item active" aria-current="page">Withdraw</li>
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
				  <?= form_open('users/request') ?>
					<div class="row">
						<div class="col-sm-6 col-lg-6">
							<h4>Saldo tersedia: </h4>
							<h4><span class="bg-success text-white">Rp.<?= ($total_saldo == '' ? 0 : number_format($total_saldo, 0, ',', '.')); ?></span></h4><br/>
							<div style="background-color: #FFD700;color:black" class="border border-danger rounded">
							    &nbsp;Bank code: <?= $this->ion_auth->user()->row()->bank ?> <br/>
							    <!--&nbsp;Account holder name: <!?= $this->ion_auth->user()->row()->first_name.' '.$this->ion_auth->user()->row()->last_name ?> <br/-->
							    &nbsp;Account number: <?= $this->ion_auth->user()->row()->norek ?> <br/>
							</div>
							<br/><!--a href="<!?= base_url('users/request') ?>" class="btn btn-info" id="mc-submit">Withdraw</a-->
							<button class="btn btn-info" type="submit">Withdraw</button>
						</div>
						<!--div class="col-sm-6 col-lg-6">
							<h4>Deposit: </h4>
							<h4><span class="bg-info text-white">Rp.<!?= ($total_deposit == '' ? 0 : number_format($total_deposit, 0, ',', '.')); ?></span></h4>
							<!?php if($total_deposit > 0){?>
							<p><small class="text-danger">Copy kode voucher berikut pada saat Cekout, untuk menggunakan saldo deposit</small></p>
							<div class="d-flex">
							  <input type="text" class="form-control" readonly value="<!?= 'DPTB1G1-'.strtoupper($this->ion_auth->user()->row()->username) ?>" id="data">
							  <button type="button" class="btn btn-solid" id="copy">Copy</button>
						    <!?php } ?>
						  </div>
						</div-->
					</div>
					<?= form_close() ?>
					
                    <div class="row">
                      <div class="col-sm-12 col-lg-12">
                        <!--?php $this->load->view('users/purchasehistory/v_submenu') ?-->
                        <div class="tab-content nav-material" id="top-tabContent">
                          <div class="tab-pane fade show active" id="top-home" role="tabpanel" aria-labelledby="top-home-tab">
                            <br>
							<h3>History Withdraw </h3>
							 <form name="form_adjustment_stok" id="form_adjustment_stok" action="<?= base_url('administrator/reseller/index'); ?>">
                            <!--?php if ($order_proses) { ?-->
                              <div class="table-responsive">
                                <table class="table cart-table table-responsive-xs">
                                  <thead>
                                    <tr class="table-head">
                                      <th>User ID</th>
										<th>Periode validasi</th>
										<th>Jumlah</th>
										<th>Biaya admin</th>
										<th>Total diterima</th>
										<th>Status</th>
										<th>Failure code</th>
										<th>Created_at</th>
										<th>Updated_at</th>
                                    </tr>
                                  </thead>
                                  <tbody>
								  
                                    <?php 
									$CI =& get_instance();
									
									foreach ($komisi_data as $komisi) {
									$biaya_admin=10000;
									$amountPPN=(5/100)*$komisi->saldo;
									//$jumlah_bayar=($komisi->saldo-$amountPPN)-$biaya_admin;
									$jumlah_bayar=$komisi->saldo-$biaya_admin;	
									?>
                                      <tr>
                                        <td> <?= $komisi->id ?>
                                        </td>
                                        <td><!--?= 'Minggu '.$komisi->minggu.'<br/>'.$komisi->periode_start.' ke '.$komisi->periode_end ?-->
										<?= $komisi->harian ?>
                                        </td>
                                        <td>Rp <?= number_format($komisi->saldo, 0, ',', '.')  ?>
                                        </td>
										<td>Rp <?= number_format($biaya_admin, 0, ',', '.')  ?></td>
										<!--td>Rp <!?= number_format($amountPPN, 0, ',', '.')  ?></td-->
										<td>Rp <?= number_format($jumlah_bayar, 0, ',', '.')  ?></td>
										<td><?= $komisi->sts_bayar == '' ? '<span class="text-white bg-warning">Pending</span>' : '<span class="text-white bg-success">'.$komisi->sts_bayar.'</span>' ?>
										</td>
										<td><?= $komisi->failure_code ?></td>
										<td><?= $CI->convert_date_utc($komisi->created_at) ?></td>
										<td><?= $CI->convert_date_utc($komisi->updated_at) ?></td>
                                      <?php } ?>
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
    <script>
      $(document).ready(function() {
        $("#copy").click(function() {
          $("#data").select();
          document.execCommand("copy");
          alert("Copied On clipboard");
        });
      });
    </script>