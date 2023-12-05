<!-- breadcrumb start -->
<div class="breadcrumb-section">
  <div class="container">
    <div class="row">
      <div class="col-sm-6">
        <div class="page-title">
          <h2><?= lang('title_exchange_user') ?></h2>
        </div>
      </div>
      <div class="col-sm-6">
        <nav aria-label="breadcrumb" class="theme-breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('/') ?>"><?= lang('beranda') ?></a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('/users') ?>"><?= lang('my_account') ?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= lang('title_exchange_user') ?> </li>
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
            <div class="page-title">
              <h2><?= lang('title_exchange_user') ?></h2>
            </div>


            <!-- product-tab starts -->
            <section class="tab-product m-0">
              <div class="container">
                <div class="row">
                  <div class="col-sm-12 col-lg-12">
                    <ul class="nav nav-tabs nav-material" id="top-tab" role="tablist">
                      <li class="nav-item"><a class="nav-link " id="top-home-tab" href="<?= base_url('users/exchange') ?>" role="tab" aria-selected="true"><?= lang('new_exchange_exchange_user') ?></a>
                        <div class="material-border"></div>
                      </li>
                      <li class="nav-item"><a class="nav-link active" id="profile-top-tab" href="#" role="tab" aria-selected="false"><?= lang('history_exchange_user') ?></a>
                        <div class="material-border"></div>
                      </li>
                    </ul>
                    <div class="tab-content nav-material" id="top-tabContent">
                      <div class="tab-pane fade show active" id="top-home" role="tabpanel" aria-labelledby="top-home-tab">
                        <br>
                        <div class="table-responsive">
                          <table class="table">
                            <thead>
                              <tr>
                                <th scope="col"><?= lang('invoice_order') ?></th>
                                <th scope="col"><?= lang('item_code_exchange_user') ?></th>
                                <th scope="col"><?= lang('alasan_exchange_user') ?></th>
                                <th scope="col"><?= lang('status_exchange_user') ?></th>
                                <th scope="col"><?= lang('resi_number') ?></th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php if ($exchange) {  ?>

                                <?php foreach ($exchange as $item) {  ?>
                                  <tr>
                                    <td><?= $item->invoice_order ?></td>
                                    <td><?= $item->kode_barang ?></td>
                                    <td><?= $item->alasan ?></td>
                                    <td><?= $item->status ?></td>
                                    <td>

                                      <?php if ($item->status == 'approved' && empty($item->resi)) { ?>
                                        <?= form_open('users/exchangeresi/' . $item->id_request_exchange) ?>
                                        <input type="text" id='resi' name='resi' placeholder="contoh(JNE : 123/DDD)" required>
                                        <button type='submit'>Submit</button>
                                        <?= form_close() ?>
                                      <?php } else { ?>

                                        <?= $item->resi ?>
                                      <?php } ?>


                                    </td>
                                  </tr>
                                <?php } ?>
                              <?php } else {  ?>
                                <?= lang('tidak_adadata') ?>
                              <?php } ?>

                            </tbody>
                          </table>
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