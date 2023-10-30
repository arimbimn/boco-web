    <!-- breadcrumb start -->
    <div class="breadcrumb-section">
      <div class="container">
        <div class="row">
          <div class="col-sm-6">
            <div class="page-title">
              <h2><?= lang('title_pemberitahuan_user') ?></h2>
            </div>
          </div>
          <div class="col-sm-6">
            <nav aria-label="breadcrumb" class="theme-breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('/') ?>"><?= lang('beranda') ?></a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('/users') ?>"><?=lang('my_account')?></a></li>
                <li class="breadcrumb-item active" aria-current="page"><?= lang('title_pemberitahuan_user') ?> </li>
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
              <div class="collection-mobile-back"><span class="filter-back"><i class="fa fa-angle-left" aria-hidden="true"></i><?=lang('back')?></span></div>
              <div class="block-content">
                <?php $this->load->view('users/v_menu_user') ?>
              </div>
            </div>
          </div>
          <div class="col-lg-9">
            <div class="dashboard-right">
              <div class="dashboard">
                <div class="page-title">
                  <h2><?= lang('title_pemberitahuan_user') ?></h2>
                </div>

                <div class="box-account box-info">
                  <table class="table cart-table table-responsive-xs">
                    <thead>
                      <tr class="table-head">
                        <th scope="col"><?= lang('message_pemberitahuan_user') ?></th>
                        <th scope="col"><?= lang('send_pemberitahuan_user') ?></th>
                        <th scope="col"></th>
                      </tr>
                    </thead>

                    <?php if ($data_notif) { ?>
                      <?php foreach ($data_notif as $item_notif) { ?>
                        <tbody>
                          <tr>
                            <td>
                              <a href="<?= base_url('notifications/read/' . $item_notif->id_notification_user) ?>"><?= $item_notif->message ?></a>
                            </td>
                            <td>
                              <p><?= date('d M Y, h:i:s A', strtotime($item_notif->created_at));   ?></p>
                              <p><?= $item_notif->is_read == 1 ? 'read' : 'unread' ?></p>
                            </td>
                            <td><a href="<?= base_url('notifications/del/' . $item_notif->id_notification_user) ?>" class="icon"><i class="ti-close"></i></a></td>
                          </tr>
                        </tbody>
                      <?php } ?>
                    <?php   } ?>



                  </table>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      </div>
    </section>
    <!-- section end -->