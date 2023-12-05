<ul>
	<li class="<?= $title == 'Users | Bocorocco Pillow Concept' ? 'active' : '' ?>"><a href="<?= base_url('users') ?>"><?= lang('account_information') ?></a></li>
	<li class="<?= $title == 'Purchase History | Bocorocco Pillow Concept' ? 'active' : '' ?>"><a href="<?= base_url('users/purchasehistory') ?>"><?= lang('purchase_user') ?></a></li>
	<?php if ($this->session->userdata('reseller') == '1') { ?>
		<!--li class="<!?= $title == 'Komisi | Bocorocco Pillow Concept' ? 'active' : '' ?>"><a href="<!?= base_url('users/komisi') ?>">Komisi</a></li-->
		<li class="<?= $title == 'Informasi | Bocorocco Pillow Concept' ? 'active' : '' ?>"><a href="<?= base_url('users/infokomisi') ?>">Info Komisi</a></li>
		<li class="<?= $title == 'Withdraw | Bocorocco Pillow Concept' ? 'active' : '' ?>"><a href="<?= base_url('users/withdraw') ?>">Withdraw</a></li>
		<li class="<?= $title == 'Family Package | Bocorocco Pillow Concept' ? 'active' : '' ?>"><a href="<?= base_url('users/deposit') ?>">Family Package</a></li>
		<li class="<?= $title == 'Keanggotaan | Bocorocco Pillow Concept' ? 'active' : '' ?>"><a href="<?= base_url('users/members/' . $this->session->userdata('user_id')) ?>">Bocorocco Entrepreneurs</a></li>
		<li class="last"><a href="<?= base_url('reseller/logout') ?>"><?= lang('LogOut') ?></a></li>
	<?php } ?>
	<?php if ($this->session->userdata('reseller') == '') { ?>
		<li class="<?= $title == 'Voucher User | Bocorocco Pillow Concept' ? 'active' : '' ?>"><a href="<?= base_url('users/voucher') ?>"><?= lang('voucher_user') ?></a></li>
		<li class="<?= $title == 'Indent | Bocorocco Pillow Concept' ? 'active' : '' ?>"><a href="<?= base_url('users/indent') ?>"><?= lang('indent_user') ?></a></li>
		<li class="<?= $title == 'Wishlist | Bocorocco Pillow Concept' ? 'active' : '' ?>"><a href=" <?= base_url('wishlist') ?>"><?= lang('wishlist_user') ?></a></li>
		<li class="<?= $title == 'Refer User | Bocorocco Pillow Concept' ? 'active' : '' ?>"><a href="<?= base_url('refer') ?>"><?= lang('title_referral_user') ?></a></li>
		<li class="<?= $title == 'Exchange | Bocorocco Pillow Concept' ? 'active' : '' ?>"><a href="<?= base_url('users/exchange') ?>"><?= lang('title_exchange_user') ?></a></li>
		<li class="<?= $title == 'Request Refund | Bocorocco Pillow Concept' ? 'active' : '' ?>"><a href="<?= base_url('requestrefund') ?>"><?= lang('title_moneyback_user') ?></a></li>
		<li class="<?= $title == 'Notification Users | Bocorocco Pillow Concept' ? 'active' : '' ?>"><a href="<?= base_url('notifications') ?>"><?= lang('title_pemberitahuan_user') ?></a></li>
		<li class="last"><a href="<?= base_url('auth/logout') ?>"><?= lang('LogOut') ?></a></li>
	<?php } ?>
</ul>