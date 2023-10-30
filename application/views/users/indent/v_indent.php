    <!-- breadcrumb start -->
    <div class="breadcrumb-section">
      <div class="container">
        <div class="row">
          <div class="col-sm-6">
            <div class="page-title">
              <h2><?= lang('indent_user') ?></h2>
            </div>
          </div>
          <div class="col-sm-6">
            <nav aria-label="breadcrumb" class="theme-breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('/') ?>"><?= lang('beranda') ?></a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('/users') ?>"><?= lang('my_account') ?></a></li>
                <li class="breadcrumb-item active" aria-current="page"><?= lang('indent_user') ?></li>
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
                  <h2><?= lang('indent_user') ?></h2>
                </div>

                <div class="box-account box-info">
                  <div class="table-responsive">
                    <table class="table cart-table table-responsive-xs">
                      <thead>
                        <tr class="table-head">
                          <th scope="col"><?= lang('item') ?></th>
                          <th scope="col"><?= lang('invoice_order') ?></th>
                          <th scope="col"><?= lang('order_status') ?></th>
                          <th scope="col"><?= lang('detail') ?></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php if ($indent) {  ?>
                          <?php foreach ($indent as $v_item) {  ?>
                            <tr>
                              <td> <?= $v_item->nama_barang ?> <span style="color:red;">indent <?= $v_item->hari_indent ?> days </span>
                              </td>
                              <td><?= $v_item->kode_order ?>
                              </td>
                              <td><?= $v_item->status_order ?>
                              </td>
                              <td>
                                <a href="<?= base_url('order/detail/' . $v_item->id_order) ?>" class="btn btn-solid" id="mc-submit"><?= lang('detail') ?></a>
                              </td>
                            </tr>
                          <?php } ?>
                        <?php  } else { ?>
                          <h4> <?= lang('tidak_adadata') ?></h4>
                        <?php } ?>
                      </tbody>

                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      </div>
    </section>
    <!-- section end -->