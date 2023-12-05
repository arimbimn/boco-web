<!-- breadcrumb start -->
<div class="breadcrumb-section">
  <div class="container">
    <div class="row">
      <div class="col-sm-6">
        <div class="page-title">
          <h2>Request Withdraw</h2>
        </div>
      </div>
      <div class="col-sm-6">
        <nav aria-label="breadcrumb" class="theme-breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('/') ?>"><?= lang('beranda') ?></a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('/users') ?>"><?= lang('my_account') ?></a></li>
            <li class="breadcrumb-item active" aria-current="page">Request Withdraw </li>
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
              <h2>Request Withdraw</h2>
            </div>


            <!-- product-tab starts -->
            <section class="tab-product m-0">
              <div class="container">
                <div class="row">
                  <div class="col-sm-12 col-lg-12 pb-5">
                    <ul class="nav nav-tabs nav-material" id="top-tab" role="tablist">
                      <li class="nav-item"><a class="nav-link active" id="top-home-tab" href="<?= base_url('users/request') ?>" role="tab" aria-selected="true"><?= lang('new_moneyback_user') ?></a>
                        <div class="material-border"></div>
                      </li>
                      <!--li class="nav-item"><a class="nav-link" id="profile-top-tab" href="<!?= base_url('requestrefund/history') ?>" role="tab" aria-selected="false"><!?= lang('history_exchange_user') ?></a>
                        <div class="material-border"></div>
                      </li-->
                    </ul>
                    <?= form_open('requestwithdraw/save') ?>
                    <div class="tab-content nav-material" id="top-tabContent">
                      <div class="tab-pane fade show active" id="top-home" role="tabpanel" aria-labelledby="top-home-tab">
                        <br>

                        <div class="form-row">
                          <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 pt-5">
                            <div class="relative flex-1 mb-3">
                              <label class=" mb-0 ml-2 font-bold" for="name">Saldo tersedia</label>
                              <p class=" text-xs text-[8] !text-red-500 py-2 px-1 italic">*Jumlah penarikan akan dipotong biaya admin Rp 10.000</p>
                              <input type='hidden' name="jml_saldo" id="jml_saldo" value="<?= $total_saldo; ?>"></input>
                              <input type="text" class="form-control rounded-full pb-1" name="vjml_saldo" id="vjml_saldo" value="<?php echo ($total_saldo == '' ? 0 : number_format($total_saldo, 0, ',', '.')); ?>" readonly>
                              <?= (isset($error) == '') ? '' : '<small class="text-danger">' . $error . '</small>'; ?>
                            </div>
                            <div class="relative flex-1 mb-3">
                              <label class=" mb-0 ml-2 font-bold" for="email">Jumlah penarikan</label>
                              <p class=" text-xs text-[8] !text-red-500 py-2 px-1 italic">*Min. penarikkan: Rp. 50.000</p>
                              <input type="number" class="form-control rounded-full" name="saldo_penarikan" id="saldo_penarikan" value="<?= set_value('saldo_penarikan') ?>" placeholder="<?= lang('example') ?> : 500000" required="">
                              <?= form_error('saldo_penarikan', '<small class="text-danger">', '</small>') ?>
                            </div>
                          </div>

                          <!--div class="col-md-12">
                            <label for="review"><!?= lang('alasan_exchange_user') ?></label>
                            <textarea class="form-control mb-0" name="alasan" id="exampleFormControlTextarea1" rows="6"><!?= set_value('alasan') ?></textarea>
                            <!?= form_error('alasan', '<small class="text-danger">', '</small>') ?>
                          </div-->
                          <br>
                          <br>
                          <div class="col-md-12">
                            <div class="notification is-danger">
                              <?php echo validation_errors(); ?>
                            </div>
                            <br>
                            <button class="btn btn-sm btn-solid" type="submit" onclick="this.form.submit(); this.disabled = true; this.value = 'Submitting the form';"><?= lang('kirim') ?></button>
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