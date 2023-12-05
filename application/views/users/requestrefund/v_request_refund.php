<!-- breadcrumb start -->
<div class="breadcrumb-section">
  <div class="container">
    <div class="row">
      <div class="col-sm-6">
        <div class="page-title">
          <h2><?= lang('title_moneyback_user') ?></h2>
        </div>
      </div>
      <div class="col-sm-6">
        <nav aria-label="breadcrumb" class="theme-breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('/') ?>"><?= lang('beranda') ?></a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('/users') ?>"><?= lang('my_account') ?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= lang('title_moneyback_user') ?> </li>
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
          <div class="collection-mobile-back"><span class="filter-back"><i class="fa fa-angle-left" aria-hidden="true"></i> <?= lang('back') ?></span></div>
          <div class="block-content">
            <?php $this->load->view('users/v_menu_user') ?>
          </div>
        </div>
      </div>
      <div class="col-lg-9">
        <div class="dashboard-right">
          <div class="dashboard bg-white rounded-md">
            <div class="page-title">
              <h2><?= lang('title_moneyback_user') ?></h2>
            </div>


            <!-- product-tab starts -->
            <section class="tab-product m-0">
              <div class="container">
                <div class="row">
                  <div class="col-sm-12 col-lg-12">
                    <ul class="nav nav-tabs nav-material" id="top-tab" role="tablist">
                      <li class="nav-item"><a class="nav-link active" id="top-home-tab" href="<?= base_url('requestrefund') ?>" role="tab" aria-selected="true"><?= lang('new_moneyback_user') ?></a>
                        <div class="material-border"></div>
                      </li>
                      <li class="nav-item"><a class="nav-link" id="profile-top-tab" href="<?= base_url('requestrefund/history') ?>" role="tab" aria-selected="false"><?= lang('history_exchange_user') ?></a>
                        <div class="material-border"></div>
                      </li>
                    </ul>
                    <?= form_open('requestrefund/save') ?>
                    <div class="tab-content nav-material" id="top-tabContent">
                      <div class="tab-pane fade show active" id="top-home" role="tabpanel" aria-labelledby="top-home-tab">
                        <br>

                        <div class="form-row">
                          <div class="col-md-6">
                            <label for="name"><?= lang('invoice_order') ?></label>
                            <input type="text" class="form-control" name="invoice_order" id="name" value="<?= set_value('invoice_order') ?>" placeholder="<?= lang('example') ?> : ORD/20210118/8/BFQX" required="">
                            <?= form_error('invoice_order', '<small class="text-danger">', '</small>') ?>
                          </div>
                          <div class="col-md-6">
                            <label for="email"><?= lang('item_code_exchange_user') ?></label>
                            <input type="text" class="form-control" name="kode_barang" id="last-name" value="<?= set_value('kode_barang') ?>" placeholder="<?= lang('example') ?> : 10102117" required="">
                            <?= form_error('kode_barang', '<small class="text-danger">', '</small>') ?>
                          </div>

                          <div class="col-md-12">
                            <label for="review"><?= lang('alasan_exchange_user') ?></label>
                            <textarea class="form-control mb-0" name="alasan" id="exampleFormControlTextarea1" rows="6"><?= set_value('alasan') ?></textarea>
                            <?= form_error('alasan', '<small class="text-danger">', '</small>') ?>
                          </div>
                          <br>
                          <br>
                          <div class="col-md-12">
                            <br>
                            <button class="btn btn-sm btn-solid" type="submit"><?= lang('kirim') ?></button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?= form_close() ?>
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