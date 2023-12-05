    <!-- breadcrumb start -->
    <div class="breadcrumb-section">
      <div class="container">
        <div class="row">
          <div class="col-sm-6">
            <div class="page-title">
              <h2>Rincian pesanan</h2>
            </div>
          </div>
          <div class="col-sm-6">
            <nav aria-label="breadcrumb" class="theme-breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('/') ?>"><?= lang('beranda') ?></a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('/users') ?>"><?= lang('my_account') ?></a></li>
                <li class="breadcrumb-item active" aria-current="page">Pesanan</li>
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
                                      <th>Kode order</th>
                                      <th>Order name</th>
                                      <th>Status bayar</th>
                                      <th>Total bayar</th>
                                      <th>Paid date</th>
                                      <th>Detail</th>
                                    </tr>
                                  </thead>
                                  <tbody>

                                    <?php foreach ($pesanan_data as $pesanan) { ?>
                                      <tr>
                                        <td> <?= $pesanan->kode_order ?>
                                        </td>
                                        <td><?= $pesanan->nama_order ?>
                                        </td>
                                        <td><?= $pesanan->status_bayar ?>
                                        </td>
                                        <td>IDR <?= number_format($pesanan->total_bayar, 0, ',', '.')  ?>
                                        </td>
                                        <td><?= $pesanan->paid_at ?>
                                        </td>
                                        <td>
                                          <a href="<?= base_url('KomisiController/orderdetail/' . $pesanan->id_order) ?>" class="btn btn-solid" id="mc-submit" target="_blank"><?= lang('detail') ?></a>
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