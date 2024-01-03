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
    <section class="section-b-space bg-white">
      <div class="container">
        <div class="row">
          <div class="col-lg-3">
            <div class="account-sidebar w-50 rounded-full font-normal bg-[#cd212a] capitalize text-white text-center !text-xs"><a class="popup-btn"> <i class="fa fa-bars"></i> <?= lang('MyAccount') ?></a></div>
            <div class="dashboard-left rounded-md bg-white">
              <div class="collection-mobile-back"><span class="filter-back"><i class="fa fa-angle-left" aria-hidden="true"></i><?= lang('back') ?></span></div>
              <div class="block-content">
                <?php $this->load->view('users/v_menu_user') ?>
              </div>
            </div>
          </div>
          <div class="col-lg-9">
            <div class="dashboard-right">
              <div class="dashboard bg-white rounded-md">
                <!-- product-tab starts -->
                <section class="tab-product m-0">
                  <div class="container p-0">
                    <h2 class=" capitalize text-2xl font-bold mb-4 text-center">My Wallet Information</h2>
                    <?= form_open('users/request') ?>
                    <div class="grid border border-t-black grid-cols-1 md:grid-cols-2 p-3 rounded-md">
                      <div class="relative flex-1 mb-3 mt-1">
                        <div class=" ">
                          Bank code:
                          <span class=" font-bold"> <?= $this->ion_auth->user()->row()->bank ?> </span> <br>
                          <!--&nbsp;Account holder name: <!?= $this->ion_auth->user()->row()->first_name.' '.$this->ion_auth->user()->row()->last_name ?> <br/-->
                          <div class="  flex flex-col md:flex-row items-left">
                            Account number:
                            <h4>
                              <span class=" font-bold leading-5 ml-1">
                                <?= $this->ion_auth->user()->row()->norek ?>
                              </span>
                            </h4>
                          </div>
                        </div>
                      </div>
                      <div class="relative flex-1 mb-3 mt-1">
                        <div class="  flex flex-col md:flex-row items-start">
                          <h4 class=" mr-2 mb-3">Saldo tersedia: </h4>
                          <h4>
                            <span class=" border border-green-600 rounded-md text-sm p-2 font-bold text-green-600 mb-3">
                              Rp.<?= ($total_saldo == '' ? 0 : number_format($total_saldo, 0, ',', '.')); ?>
                            </span>
                          </h4>
                          <br class="hidden md:block" />
                          <!--a href="<!?= base_url('users/request') ?>" class="btn btn-info" id="mc-submit">Withdraw</a-->
                        </div>
                        <button class=" mt-4 rounded-full bg-[#008C45] px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-[#00461C] focus:outline-none focus:ring focus:border-[#00461C] focus-visible:ring-[#00461C]" type="submit">Withdraw</button>
                      </div>
                    </div>
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
                  <?= form_close() ?>

                  <div class="row">
                    <div class="col-sm-12 col-lg-12">
                      <!--?php $this->load->view('users/purchasehistory/v_submenu') ?-->
                      <div class="tab-content nav-material" id="top-tabContent">
                        <div class="tab-pane fade show active" id="top-home" role="tabpanel" aria-labelledby="top-home-tab">
                          <br>
                          <h3 class=" mb-2 mt-4">History Withdraw </h3>
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
                                  $CI = &get_instance();

                                  foreach ($komisi_data as $komisi) {
                                    $biaya_admin = 10000;
                                    $amountPPN = (5 / 100) * $komisi->saldo;
                                    //$jumlah_bayar=($komisi->saldo-$amountPPN)-$biaya_admin;
                                    $jumlah_bayar = $komisi->saldo - $biaya_admin;
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
                                      <td><?= $komisi->sts_bayar == '' ? '<span class="text-white bg-warning">Pending</span>' : '<span class="text-white bg-success">' . $komisi->sts_bayar . '</span>' ?>
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