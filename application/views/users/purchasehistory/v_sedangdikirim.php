    <!-- breadcrumb start -->
    <div class="breadcrumb-section">
      <div class="container">
        <div class="row">
          <div class="col-sm-6">
            <div class="page-title">
              <h2>Purchase history</h2>
            </div>
          </div>
          <div class="col-sm-6">
            <nav aria-label="breadcrumb" class="theme-breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('/') ?>"><?= lang('beranda') ?></a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('/users') ?>"><?= lang('my_account') ?></a></li>
                <li class="breadcrumb-item active" aria-current="page"><?= lang('purchase_user') ?></li>
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
                    <div class="row">
                      <div class="col-sm-12 col-lg-12">
                        <?php $this->load->view('users/purchasehistory/v_submenu') ?>
                        <div class="tab-content nav-material" id="top-tabContent">
                          <div class="tab-pane fade show active" id="top-home" role="tabpanel" aria-labelledby="top-home-tab">
                            <br>
                            <?php if ($order_dikirm) { ?>

                              <table class="table-responsive-md table mb-0">
                                <thead>
                                  <tr>
                                    <th scope="col"><?= lang('order_id') ?></th>
                                    <th scope="col"><?= lang('price_produk') ?></th>
                                    <th scope="col"><?= lang('purchase_statuspayment_user') ?></th>
                                    <th scope="col"></th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php foreach ($order_dikirm as $item_order) { ?>
                                    <tr>
                                      <td><?= $item_order->kode_order ?></td>
                                      <td>IDR <?= number_format($item_order->total_bayar, 0, ',', '.')  ?></td>
                                      <td><?= $item_order->status_bayar ?></td>
                                      <td> <a href="<?= base_url('order/detail/' . $item_order->id_order) ?>" class="btn btn-solid" id="mc-submit"><?= lang('detail') ?></a>
                                        <br><br>
                                        <a href="<?= base_url() ?>users/orderselesai/<?= $item_order->id_order ?>" class="btn btn-solid order_received" data-id=""><?= lang('receive_order') ?></a>
                                      </td>
                                    </tr>
                                  <?php } ?>

                                </tbody>
                              </table>
                            <?php } else { ?>
                              Tidak Ada Data
                            <?php  } ?>


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