<!-- breadcrumb start -->
<div class="breadcrumb-section">
  <div class="container">
    <div class="row">
      <div class="col-sm-6">
        <div class="page-title">
          <h2><?= lang('wishlist_user') ?></h2>
        </div>
      </div>
      <div class="col-sm-6">
        <nav aria-label="breadcrumb" class="theme-breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('/') ?>"><?= lang('beranda') ?> </a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('/users') ?>"><?= lang('my_account') ?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= lang('wishlist_user') ?> </li>
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
              <h2><?= lang('wishlist_user') ?></h2>
            </div>
            <div class="row">
              <div class="col-sm-12">
                <div class="table-responsive">

                  <table class="table cart-table table-responsive-xs">
                    <thead>
                      <tr class="table-head">
                        <th width="20%"><?= lang('image_produk') ?></th>
                        <th width="30%"><?= lang('product_name_produk') ?></th>
                        <th width="20%"><?= lang('price_produk') ?></th>
                        <th width="20%"><?= lang('availability_wishlist_user') ?></th>
                        <th width="10%"><?= lang('action_user') ?></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if (!empty($wishlist)) { ?>
                        <?php foreach ($wishlist as $wishlist_row) { ?>
                          <tr>
                            <td>
                              <a href="<?= base_url() ?>product/detail/<?= $wishlist_row->product_id ?>"><img src="<?= smn_baseurl() ?>uploads/product/<?= $wishlist_row->image_one ?>" width="100%" alt="<?= $wishlist_row->nama_barang ?>"></a>
                            </td>
                            <td class="align-middle"><a href="<?= base_url() ?>product/detail/<?= $wishlist_row->product_id ?>"><?= $wishlist_row->nama_barang ?></a></td>
                            <td class="align-middle">
                              <?php $totalHarga = $wishlist_row->harga;
                              $cekMember = $this->db->where(['user_id' => $this->ion_auth->user()->row()->id])->get('user_membership')->row(); ?>
                              <?php if ($cekMember) {  ?>
                                <?php if ($cekMember->peringkat_member == 'GOLD') { ?>
                                  <p><?= lang('discount') ?> Member Gold 10%</p>
                                  <?php $totalDiskon = (10 / 100) * $totalHarga; ?>
                                  <?php $totalHarga = $totalHarga  - $totalDiskon; ?>
                                  <h5>IDR <?= number_format($totalHarga, 0, ',', '.')  ?></h5>
                                <?php } else if ($cekMember->peringkat_member == 'PLATINUM') {  ?>
                                  <p><?= lang('discount') ?> Member Platinum 15%</p>
                                  <?php $totalDiskon = (15 / 100) * $totalHarga; ?>
                                  <?php $totalHarga = $totalHarga  - $totalDiskon; ?>
                                  <h5>IDR <?= number_format($totalHarga, 0, ',', '.')  ?></h5>
                                <?php } else if ($cekMember->peringkat_member == 'DIAMOND') {  ?>
                                  <p><?= lang('discount') ?> Member Diamond 20%</p>
                                  <?php $totalDiskon = (20 / 100) * $totalHarga; ?>
                                  <?php $totalHarga = $totalHarga  - $totalDiskon; ?>
                                  <h5>IDR <?= number_format($totalHarga, 0, ',', '.')  ?></h5>
                                <?php } ?>
                                <h5 style="color:red; text-decoration: line-through;">IDR <?= number_format($wishlist_row->harga, 0, ',', '.')  ?></h5>
                              <?php } else {  ?>
                                <h5>IDR <?= number_format($wishlist_row->harga, 0, ',', '.')  ?></h5>
                              <?php } ?>
                            </td>
                            <td class="align-middle">
                              <?php
                              $cek_stok_allattributestore = $this->db->select('SUM(jumlah_stok) as stok')->where('id_product', $wishlist_row->product_id)->get('product_stok')->row();
                              if ($cek_stok_allattributestore->stok > 0) { ?>
                                <p><?= lang('available_wishlist_stok_user') ?></p>
                              <?php } else { ?>
                                <p><?= lang('empty_wishlist_stok_user') ?></p>
                              <?php } ?>
                            </td>
                            <td class="align-middle"><a href="<?= base_url() ?>delete_wishlist/<?= $wishlist_row->wishlist_id ?>" class="icon mr-3"><i class="ti-close"></i> </a></td>
                          </tr>
                        <?php } ?>
                      <?php } else { ?>
                        <tr>
                          <td colspan="5" class="text-center"><?= lang('wishlist_empty_user') ?></td>
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="row wishlist-buttons">
              <div class="col-12"><a href="<?= base_url() ?>product" class="btn btn-solid"><?= lang('empty_wishlist_stok_user') ?></a></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>