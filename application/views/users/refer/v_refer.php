    <!-- breadcrumb start -->
    <div class="breadcrumb-section">
      <div class="container">
        <div class="row">
          <div class="col-sm-6">
            <div class="page-title">
              <h2><?= lang('title_referral_user') ?></h2>
            </div>
          </div>
          <div class="col-sm-6">
            <nav aria-label="breadcrumb" class="theme-breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('/') ?>"><?= lang('beranda') ?></a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('/users') ?>"><?= lang('my_account') ?></a></li>
                <li class="breadcrumb-item active" aria-current="page"><?= lang('title_referral_user') ?></li>
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
              <div class="collection-mobile-back"><span class="filter-back"><i class="fa fa-angle-left" aria-hidden="true"></i> <?= lang('back') ?></span></div>
              <div class="block-content">
                <?php $this->load->view('users/v_menu_user') ?>
              </div>
            </div>
          </div>
          <div class="col-lg-9">
            <div class="dashboard-right">
              <div class="dashboard">

                <div class="page-title">
                  <h2><?= lang('my_referrer_user') ?></h2>
                  <?php if ($user_refferer) { ?>
                    <p class="h2"><?= $user_refferer->username ?></p>
                  <?php } else { ?>
                    <h2><?= lang('empty_referrer_user') ?></h2>
                  <?php } ?>
                </div>
                <hr>
                <div class=" d-flex">
                  <input type="text" class="form-control" readonly value="<?= base_url('id/') . $this->ion_auth->user()->row()->username ?>" id="data">
                  <button type="button" class="btn btn-solid" id="copy">Copy</button>
                </div>
                <div class="page-title mt-3">
                  <h2><?= lang('my_referral_user') ?></h2>
                </div>


                <?php if ($user_refer) { ?>
                  <div class="table-responsive">

                    <table class="table cart-table table-responsive-xs">
                      <thead>
                        <tr class="table-head">
                          <th scope="col"><?= lang('user') ?></th>
                          <th scope="col"><?= lang('total_belanja_referral_user') ?></th>
                          <th scope="col"></th>
                        </tr>
                      </thead>
                      <?php foreach ($user_refer as $item_user) { ?>

                        <?php $peringkat = $this->db->where(['user_id' => $item_user->user_id])->get('user_membership')->row(); ?>

                        <tbody>
                          <tr>
                            <td>
                              <p><?= lang('name') ?> :<?= $item_user->first_name ?></p>
                              <p>email: <?= $item_user->email ?></p>
                              <p>Created: <?= date('d M, Y', strtotime($item_user->created_at)) ?></p>
                            </td>
                            <?php $order_item = $this->M_order->getReferTotalBelanja($item_user->user_refer)->row();
                            // var_dump($order_item);
                            ?>
                            <td>
                              <h4>IDR <?= number_format($order_item->total_bayar, 2, ',', '.')  ?></h4>
                              <?php if ($peringkat) { ?>
                                <p><?= $peringkat->peringkat_member ?></p>
                              <?php } ?>
                            </td>
                          </tr>
                        </tbody>
                      <?php } ?>
                    </table>
                  </div>
                <?php } else { ?>
                  <?= lang('empty_referral_user') ?>
                <?php   } ?>
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