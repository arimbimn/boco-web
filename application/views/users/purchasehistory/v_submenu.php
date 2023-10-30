<ul class="nav nav-tabs nav-material" id="top-tab" role="tablist">
  <li class="nav-item"><a class="nav-link <?= $subtitle == 'Terima' ? 'active' : '' ?>" id="top-home-tab" href="<?= base_url('users/purchasehistory') ?>" role="tab" aria-selected="true"><?= lang('purchase_diterima_user') ?></a>
    <div class="material-border"></div>
  </li>
  <li class="nav-item"><a class="nav-link  <?= $subtitle == 'Proses' ? 'active' : '' ?>" id="top-home-tab" href="<?= base_url('users/purchaseproses') ?>" role="tab" aria-selected="true"><?= lang('purchase_diproses_user') ?></a>
    <div class="material-border"></div>
  </li>
  <li class="nav-item"><a class="nav-link <?= $subtitle == 'Kirim' ? 'active' : '' ?> " id="profile-top-tab" href="<?= base_url('users/sedangdikirim') ?>" role="tab" aria-selected="false"><?= lang('purchase_dikirim_user') ?></a>
    <div class="material-border"></div>
  </li>
  <li class="nav-item"><a class="nav-link <?= $subtitle == 'Tujuan' ? 'active' : '' ?> " id="contact-top-tab" href="<?= base_url('users/sampaitujuan') ?>" role="tab" aria-selected="false"><?= lang('purchase_tujuan_user') ?></a>
    <div class="material-border"></div>
  </li>
  <li class="nav-item"><a class="nav-link <?= $subtitle == 'Batal' ? 'active' : '' ?> " id="contact-top-tab" href="<?= base_url('users/purchasebatal') ?>" role="tab" aria-selected="false"><?= lang('purchase_batal_user') ?></a>
    <div class="material-border"></div>
  </li>
</ul>