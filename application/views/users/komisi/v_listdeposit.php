    <!-- breadcrumb start -->
    <div class="breadcrumb-section">
      <div class="container">
        <div class="row">
          <div class="col-sm-6">
            <div class="page-title">
              <h2>Family Package</h2>
            </div>
          </div>
          <div class="col-sm-6">
            <nav aria-label="breadcrumb" class="theme-breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('/') ?>"><?= lang('beranda') ?></a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('/users') ?>"><?= lang('my_account') ?></a></li>
                <li class="breadcrumb-item active" aria-current="page">Family Package</li>
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
                  <div class="container">
                    <h2 class=" capitalize text-2xl font-bold mb-4 text-center">My Family & Single Package Information</h2>
                    <hr class=" mb-4">
                    <div class="row">

                      <!--div class="col-sm-6 col-lg-6">
    							<h4>Saldo tersedia: </h4>
    							<h4><span class="bg-success text-white">Rp.<!?= ($total_saldo == '' ? 0 : number_format($total_saldo, 0, ',', '.')); ?></span></h4>
    							<br/><a href="<!?= base_url('users/request') ?>" class="btn btn-info" id="mc-submit">Withdraw</a>
    						</div-->
                      <div class="col-sm-12 col-lg-12">
                        <h4 class=" my-2 font-bold py-2 text-lg">Saldo Family Package & Single Package: </h4>
                        <h4><span class=" bg-red-500 rounded-md px-2 font-bold py-1 text-white">Rp.<?= ($total_deposit == '' ? 0 : number_format($total_deposit, 0, ',', '.')); ?></span></h4>
                      </div>

                      <!--div class="col-sm-6 col-lg-6"-->
                      <?php if ($total_deposit > 0) {
                        $cek_sp = $this->db->where(['user_id' => $this->ion_auth->user()->row()->id])->where(['voucher_id' => 170])->get('voucher_used')->row();
                        if ($cek_sp) {
                          if ($cek_sp->is_used == 0 && $total_deposit > 3000000) { ?>
                            <div class="col-sm-6 col-lg-6">
                              <p><small class="text-danger">Copy kode voucher berikut pada saat Cekout, untuk menggunakan saldo </small><b>Family Package</b></p>
                              <div class="d-flex">
                                <input type="text" class="form-control" readonly value="<?= 'DPTFP-' . strtoupper($this->ion_auth->user()->row()->username) ?>" id="data">
                                <button type="button" class="btn btn-solid" id="copy">Copy</button>
                              </div>
                            </div>
                          <?php } else if ($cek_sp->is_used == 1) { ?>
                            <div class="col-sm-6 col-lg-6">
                              <p><small class="text-danger">Copy kode voucher berikut pada saat Cekout, untuk menggunakan saldo </small><b>Family Package</b></p>
                              <div class="d-flex">
                                <input type="text" class="form-control" readonly value="<?= 'DPTFP-' . strtoupper($this->ion_auth->user()->row()->username) ?>" id="data">
                                <button type="button" class="btn btn-solid" id="copy">Copy</button>
                              </div>
                            </div>
                          <?php }
                        } else { ?>
                          <div class="col-sm-6 col-lg-6">
                            <p><small class="text-danger">Copy kode voucher berikut pada saat Cekout, untuk menggunakan saldo </small><b>Family Package</b></p>
                            <div class="d-flex">
                              <input type="text" class="form-control" readonly value="<?= 'DPTFP-' . strtoupper($this->ion_auth->user()->row()->username) ?>" id="data">
                              <button type="button" class="btn btn-solid" id="copy">Copy</button>
                            </div>
                          </div>
                      <?php   }
                      }
                      ?>
                      <!--p><small class="text-danger">Copy kode voucher berikut pada saat Cekout, untuk menggunakan saldo </small><b>Family Package</b></p>
    							<div class="d-flex">
        							  <input type="text" class="form-control" readonly value="<!--?= 'DPTB1G1-'.strtoupper($this->ion_auth->user()->row()->username) ?>" id="data">
        							  <button type="button" class="btn btn-solid" id="copy">Copy</button>
        						</div-->

                      <!--/div-->
                      <div class="col-sm-6 col-lg-6">
                        <?php
                        $cek_sp = $this->db->where(['user_id' => $this->ion_auth->user()->row()->id])->where(['voucher_id' => 170])->where(['is_used' => 0])->get('voucher_used')->row();
                        if ($cek_sp) { ?>
                          <p><small class="text-danger">Copy kode voucher berikut pada saat Cekout, untuk menggunakan saldo </small><b>Single Package</b></p>
                          <div class="d-flex">
                            <input type="text" class="form-control" readonly value="<?= 'SPDPT-' . strtoupper($this->ion_auth->user()->row()->username) ?>" id="data_sp">
                            <button type="button" class="btn btn-solid" id="copy_sp">Copy</button>
                          </div>
                        <?php } ?>
                      </div>

                      <!--div class="row"-->
                      <div class="col-sm-12 col-lg-12">
                        <!--?php $this->load->view('users/purchasehistory/v_submenu') ?-->
                        <div class="tab-content nav-material" id="top-tabContent">
                          <div class="tab-pane fade show active" id="top-home" role="tabpanel" aria-labelledby="top-home-tab">
                            <br>
                            <hr class=" my-4">
                            <h3 class=" mb-2 mt-4">History Pemakaian Saldo Family Package & Single Package</h3>
                            <form name="form_adjustment_stok" id="form_adjustment_stok" action="<?= base_url('administrator/reseller/index'); ?>">
                              <!--?php if ($order_proses) { ?-->
                              <div class="table-responsive">
                                <table class="table cart-table table-responsive-xs">
                                  <thead>
                                    <tr class="table-head">
                                      <th>User ID</th>
                                      <th>Username</th>
                                      <th>Nama Order</th>
                                      <th>Kode Order</th>
                                      <th>Sub total</th>
                                      <th>Potongan disc</th>
                                      <th>Biaya admin</th>
                                      <th>Total bayar</th>
                                      <th>Keterangan</th>
                                      <th>Action</th>
                                    </tr>
                                  </thead>
                                  <tbody>

                                    <?php foreach ($deposit_data as $depo) { ?>
                                      <tr>
                                        <td> <?= $depo->user_id ?>
                                        </td>
                                        <td><?= $depo->nama_lengkap . ' (' . $depo->username . ')' ?></td>
                                        <td><!--?= 'Minggu '.$komisi->minggu.'<br/>'.$komisi->periode_start.' ke '.$komisi->periode_end ?-->
                                          <?= $depo->nama_order ?>
                                        </td>
                                        <td><?= $depo->kode_order ?>
                                        </td>
                                        <td>Rp <?= number_format($depo->subtotal, 0, ',', '.')  ?></td>
                                        <td>Rp <?= number_format($depo->diskon_voucher, 0, ',', '.')  ?></td>
                                        <td>Rp <?= ($depo->total_bayar == 0) ? "0" : number_format($depo->biaya_admin, 0, ',', '.') ?></td>
                                        <td>Rp <?= ($depo->total_bayar == 0) ? number_format($depo->subtotal - $depo->diskon_voucher, 0, ',', '.') : number_format($depo->total_bayar, 0, ',', '.')  ?></td>
                                        <td><?= ($depo->kode_voucher == '120') ? 'Family Package' : 'Single Package' ?></td>
                                        <td><a href="<?= base_url('KomisiController/orderdetail/' . $depo->id_order) ?>" class="label-default" id="mc-submit" target="_blank">Lihat pesanan</a>
                                        </td>
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
                      <!--/div-->
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

        $("#copy_sp").click(function() {
          $("#data_sp").select();
          document.execCommand("copy");
          alert("Copied On clipboard");
        });
      });
    </script>