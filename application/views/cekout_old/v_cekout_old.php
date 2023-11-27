<!-- breadcrumb start -->
<div class="breadcrumb-section">
  <div class="container">
    <div class="row">
      <div class="col-sm-6">
        <div class="page-title">
          <h2>Checkout</h2>
        </div>
      </div>
      <div class="col-sm-6">
        <nav aria-label="breadcrumb" class="theme-breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('') ?>"><?= lang('beranda') ?></a></li>
            <li class="breadcrumb-item active" aria-current="page">Checkout</li>
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
    <div class="checkout-page">
      <div class="checkout-form">
        <?= form_open('cekout/save', array("class" => "form2")) ?>
        <?php
        $kode_order = 'ORD/' . date('Ymd') . '/' . $this->ion_auth->user()->row()->id . '/' . strtoupper(random_string('alnum', 4));
        // echo $kode_order;
        ?>
        <div class="row">
          <div class="col-lg-6 col-sm-12 col-xs-12">
            <div class="checkout-title">
              <h3><?= lang('billing_details_order') ?></h3>
            </div>
            <div class="row check-out">
              <div class="form-group col-md-6 col-sm-6 col-xs-12">
                <div class="field-label"><?php echo lang('create_user_fname_label', 'first_name'); ?> <span style="color: red;">*</span> </div>
                <input type="hidden" name="kode_order" value="<?= $kode_order ?>" placeholder="" required>
                <input type="text" name="first_name" <?php if (isset($_SESSION["first_name_checkout"])) {
                                                        if (!empty($_SESSION["first_name_checkout"])) {
                                                          echo "value='" . $_SESSION["first_name_checkout"] . "'";
                                                        } else {
                                                          echo "value='" . $this->ion_auth->user()->row()->first_name . "'";
                                                        }
                                                      } else {
                                                        echo "value='" . $this->ion_auth->user()->row()->first_name . "'";
                                                      } ?> placeholder="" required>
              </div>
              <div class="form-group col-md-6 col-sm-6 col-xs-12">
                <div class="field-label"><?php echo lang('create_user_lname_label', 'last_name'); ?> <span style="color: red;">*</span> </div>
                <input type="text" name="last_name" <?php if (isset($_SESSION["last_name_checkout"])) {
                                                      if (!empty($_SESSION["last_name_checkout"])) {
                                                        echo "value='" . $_SESSION["last_name_checkout"] . "'";
                                                      } else {
                                                        echo "value='" . $this->ion_auth->user()->row()->last_name . "'";
                                                      }
                                                    } else {
                                                      echo "value='" . $this->ion_auth->user()->row()->last_name . "'";
                                                    } ?> placeholder="" required>
              </div>
              <div class="form-group col-md-6 col-sm-6 col-xs-12">
                <div class="field-label"><?php echo lang('create_user_phone_label', 'phone'); ?> <span style="color: red;">*</span> </div>
                <input type="number" name="phone" <?php if (isset($_SESSION["phone_checkout"])) {
                                                    if (!empty($_SESSION["phone_checkout"])) {
                                                      echo "value='" . $_SESSION["phone_checkout"] . "'";
                                                    } else {
                                                      echo "value='" . $this->ion_auth->user()->row()->phone . "'";
                                                    }
                                                  } else {
                                                    echo "value='" . $this->ion_auth->user()->row()->phone . "'";
                                                  } ?> placeholder="" required>
                <div class="field-label"><?= lang('whatsapp_active') ?></div>
              </div>
              <div class="form-group col-md-6 col-sm-6 col-xs-12">
                <div class="field-label"><?= lang('email_address_order') ?> <span style="color: red;">*</span> </div>
                <input type="text" name="email" <?php if (isset($_SESSION["email_checkout"])) {
                                                  if (!empty($_SESSION["email_checkout"])) {
                                                    echo "value='" . $_SESSION["email_checkout"] . "'";
                                                  } else {
                                                    echo "value='" . $this->ion_auth->user()->row()->email . "'";
                                                  }
                                                } else {
                                                  echo "value='" . $this->ion_auth->user()->row()->email . "'";
                                                } ?> placeholder="" required>
              </div>

              <div class="form-group col-md-12 col-sm-12 col-xs-12">
                <div class="field-label"><?= lang('address_order') ?> <span style="color: red;">*</span> </div>
                <input type="text" name="address" <?php if (isset($_SESSION["address_checkout"])) {
                                                    if (!empty($_SESSION["address_checkout"])) {
                                                      echo "value='" . $_SESSION["address_checkout"] . "'";
                                                    } else {
                                                      echo "value='" . $this->ion_auth->user()->row()->address . "'";
                                                    }
                                                  } else {
                                                    echo "value='" . $this->ion_auth->user()->row()->address . "'";
                                                  } ?> placeholder="Street address" required>
              </div>
              <div class="form-group col-md-12 col-sm-6 col-xs-12">
                <div class="field-label"><?= lang('postal_code_order') ?> <span style="color: red;">*</span> </div>
                <input type="text" name="kode_pos" placeholder="" required <?php if (isset($_SESSION["kode_pos_checkout"])) {
                                                                              if (!empty($_SESSION["kode_pos_checkout"])) {
                                                                                echo "value='" . $_SESSION["kode_pos_checkout"] . "'";
                                                                              } else {
                                                                                echo "value='" . $this->ion_auth->user()->row()->kd_pos . "'";
                                                                              }
                                                                            } else {
                                                                              echo "value='" . $this->ion_auth->user()->row()->kd_pos . "'";
                                                                            } ?>>
              </div>
              <?php $refer = $this->db->where(['user_id' => $this->ion_auth->user()->row()->id])->get('users_refer')->row(); ?>
              <?php if ($refer == null) {  ?>
                <?php if ($this->session->userdata('refferemail')) { ?>
                  <input type="hidden" name="reffer" value="<?= $this->session->userdata('refferemail') ?>">
                  <div class="form-group col-md-12 col-sm-6 col-xs-12">
                    <div class="field-label"><?= lang('form_refer') ?></div>
                    <input type="text" name="reffer" disabled value="<?= $this->session->userdata('refferemail') ?>" placeholder="">
                  </div>
                <?php } else {  ?>
                  <div class="form-group col-md-12 col-sm-6 col-xs-12" style="<?= $this->session->userdata('reseller') == '1' ? "display: none !important" : "" ?>">
                    <div class="field-label"><?= lang('form_refer') ?></div>
                    <input type="text" name="reffer" value="" placeholder="" <?php echo ($this->session->userdata('reseller') != "") ? 'disabled':''; ?>>
                  </div>

                <?php  } ?>
              <?php } ?>

            </div>
          </div>
          <div class="col-lg-6 col-sm-12 col-xs-12">
            <div class="checkout-details">
              <div class="order-box">
                <div class="title-box">
                  <?= $this->session->flashdata('message') ?>
                  <div><?= lang('product') ?> <span>Total</span></div>
                </div>
                <ul class="qty">
                  <?php
                  $i = 1;
                  $qty = 0;
				  $jml_potongan=0; //ebe
				  $jml_disc=0;
                  // var_dump($this->cart->contents());
                  foreach ($this->cart->contents() as $items) :
                    $barang = $this->M_product->get_detailproduct($items['id']);
					//===ebe reseller
					$vnilai=(20/100)*$barang->harga;
					$setelah_disc=$barang->harga-$vnilai;
					$hrg_setelah_disc=$setelah_disc*$items['qty'];
					$jml_disc += $vnilai*$items['qty'];
					$jml_potongan=$jml_potongan+$hrg_setelah_disc;
					//===end ebe
                  ?>

                    <li><?= $items['name'] ?> × <?= $items['qty'] ?> <span>IDR <?= number_format($items['subtotal'], 0, ',', '.') ?></span>
                      , <?php if ($items['options']['Indent'] != 0) {  ?>
                        <span style="color:red;">item indent </span>
                      <?php } ?>

                    </li>
                    <?php $size = $this->db->where(['id_product_attribute' => $items['options']['Size']])->get('product_attribute')->row(); ?>


                    <p><?= lang('size_produk') ?> : <?= $size->size ?>,
                      Price Item : IDR <?= number_format($barang->harga, 0, ',', '.') ?>

                      <?php if ($items['options']['Diskon'] != 0) {  ?>
                        ,<?= lang('discount') ?> : <?= $items['options']['Diskon'] ?> % Per Item
                      <?php } ?>
                    </p>
                    <?= form_hidden('qty' . $i, $items['qty']) ?>
                    <?= form_hidden('price_item' . $i, $barang->harga) ?>

                    <?= form_hidden('diskon' . $i, $items['options']['Diskon']) ?>
                    <?= form_hidden('indent' . $i, $items['options']['Indent']) ?>
                    <?= form_hidden('id_product_attribute' . $i, $items['options']['Size']) ?>
                    <?= form_hidden('product_id' . $i, $items['id']) ?>
                    <?= form_hidden('sub_total' . $i, $items['subtotal']) ?>
                    <?php $i++ ?>
                    <?php $qty = $qty + $items['qty'];  ?>

                  <?php endforeach; ?>

                </ul>
                <ul class="sub-total">
                </ul>
                <ul class="total">

                  <?php if ($this->session->flashdata('isupgradediamond')) {  ?>
                    <li><?= lang('free_upgrade_diamond') ?></li>
                    <input type="hidden" name="isupgradediamond" value="<?= $this->session->flashdata('isupgradediamond') ?>" placeholder="" required>
                  <?php  } ?>

                  <?php if ($this->session->flashdata('val_multiples')) {  ?>
                    <input type="hidden" name="val_multiples" value="<?= $this->session->flashdata('val_multiples') ?>" placeholder="" required>
                  <?php  } ?>


                  <?php if ($this->session->flashdata('typePotongan')) {  ?>
                    <li>Sub Total <span class="count">IDR <?= number_format($this->cart->total(), 0, ',', '.'); ?></span></li>

                    <li><?= $this->session->flashdata('typePotongan') ?> </li>
                    <li style="max-width: 65%;"><?= $this->session->flashdata('voucherName') ?> </li>

                    <?php if ($this->session->flashdata('totalBelanjaDiskon') <= 0) { ?>
                      <?php $totalBelanjaDiskon = 0; ?>
                    <?php } else { ?>
                      <?php $totalBelanjaDiskon = $this->session->flashdata('totalBelanjaDiskon'); ?>
                    <?php } ?>
                    <li>Total <span class="count">IDR <?= number_format($totalBelanjaDiskon, 0, ',', '.'); ?></span></li>
                    <?php if($this->session->flashdata('kode_voucher')){?>
                        <li><small class="text-danger">Pembayaran akan menggunakan saldo deposit</small></li>
                        <input type="hidden" name="total_amount" value="0" placeholder="" required>
                    <?php }else if($this->session->flashdata('sisa_deposit')){ ?>
                        <li><small class="text-danger">Pembayaran akan menggunakan saldo deposit</small></li>
                        <input type="hidden" name="total_amount" value="<?= $totalBelanjaDiskon - $this->session->flashdata('sisa_deposit') ?>" placeholder="" required>
                    <?php }else{ ?>
                        <input type="hidden" name="total_amount" value="<?= $totalBelanjaDiskon ?>" placeholder="" required>
                    <?php } ?>
                    <?= form_hidden('id_voucher', $this->session->flashdata('id_voucher')) ?>
                  <?php } else {  ?>
				  
				  <!--?php if($this->session->userdata('reseller')=='1'){?>
				  <li>Sub Total <span class="count">IDR <!--?= number_format($this->cart->total(), 0, ',', '.'); ?></span></li>
				  <li>Diskon Reseller 20% dari setiap item<span>IDR <!--?= number_format($jml_disc, 0, ',', '.'); ?></span></li>
				  <!--?php } ?-->
                    <li>Total<span class="count">
					<!--ebe-->
					IDR <?= number_format($this->cart->total(), 0, ',', '.'); ?>
					<!--?= ($this->session->userdata('reseller')=='1') ? number_format($jml_potongan, 0, ',', '.') : number_format($this->cart->total(), 0, ',', '.'); ?-->
					</span></li>

                    <!--input type="hidden" name="total_amount" value="<!--?= ($this->session->userdata('reseller')=='1') ? $jml_potongan : $this->cart->total();  ?>" placeholder="" required-->
					<input type="hidden" name="total_amount" value="<?= $this->cart->total()  ?>" placeholder="" required>


                  <?php } ?>

                  <input type="hidden" name="sub_total" value="<?= $this->cart->total()  ?>" placeholder="" required>
                  <input type="hidden" name="diskon_voucher" value="<?= $this->session->flashdata('diskonVoucher')  ?>" placeholder="" required>
                </ul>
              </div>
              <div class="payment-box">
                <div class="upper-box">
                  <div class="payment-options">
                    <ul>
                      <li>
                        <div class="radio-option">
                          <label for="payment-1"><?= lang('pembayaran_xendit_order') ?><span class="small-text"></span></label>
                        </div>
                      </li>


                    </ul>
                  </div>
                </div>
                <?php
                $cekMember = $this->db->where(['user_id' => $this->ion_auth->user()->row()->id])->get('user_membership')->row();
                if ($cekMember || $this->session->flashdata('id_voucher') == 45 || $this->session->flashdata('id_voucher') == 32) { ?>
                  <div class="text-right"><button type="submit" class="btn-solid btn" onclick="this.form.submit(); this.disabled = true; this.value = 'Submitting the form';"><?= lang('order') ?></button></div>
                <?php } else if (!$cekMember) { ?>
				<?php if($this->session->userdata('reseller') == '1'){?>
                        <div class="text-right"><button type="submit" class="btn-solid btn" onclick="this.form.submit(); this.disabled = true; this.value = 'Submitting the form';"><?= lang('order') ?></button></div>
                <?php }else{ ?>
					  <div class="text-right"> <button type="button" class="btn-solid btn" data-toggle="modal" data-target="#exampleModalConfrim">
						  <?= lang('order') ?>
						</button></div>
					  <div class="modal fade" id="exampleModalConfrim" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered">
						  <div class="modal-content">
							<div class="modal-header">
							  <h5 class="modal-title" id="exampleModalLabel"><?= lang('confrim_redem_title') ?></h5>
							  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							  </button>
							</div>
							<div class="modal-body">

							  <?= lang('confrim_redem') ?>
							</div>
							<div class="modal-footer">
							  <button type="submit" class="btn-solid btn" onclick="this.form.submit(); this.disabled = true; this.value = 'Submitting the form';"><?= lang('order') ?></button>
							</div>
						  </div>
						</div>
					  </div>
				<?php } ?>
                <?php } else { ?>
                  <div class="text-right"><button type="submit" class="btn-solid btn" onclick="this.form.submit(); this.disabled = true; this.value = 'Submitting the form';"><?= lang('order') ?></button></div>
                <?php } ?>
              </div>
            </div>
            <br>
            <div class="row">
				<?php if($this->session->userdata('reseller') != ""){ ?>
                <?php if($this->ion_auth->user()->row()->sts_reseller == ""){ ?>
                    <div class="text-left col-md-12">
                    (<span class="field-label" style="color: red;">*</span>) <small>Isi dengan Username pengundang anda atau Kode Family Package atau Kode Single Package</small>
                    </div>
                <?php }else{ ?>
                    <div class="text-right col-md-12">
                    (<span class="field-label" style="color: red;">*</span>) <small>Yakinkan bahwa ini adalah pembelanjaan pribadi anda</small>
                    </div>
                <?php } ?>
                <?php } ?>
              <div class="col-md-7">
				<?php if($this->session->userdata('reseller') == ""){?>
                <button type="button" class="btn-solid btn pull-left" data-toggle="modal" data-target="#exampleModalCenter"><?= lang('get_more_discount') ?></button>
				<?php } ?>

              </div>
              <?= form_close() ?>
              <div class="col-md-5 col-sm-5 col-xs-12">
                <?= form_open('add/kodevoucher', array("class" => "form_voucher")) ?>
                <div class="form-group">
                  <!-- <div class="field-label">Kode Voucher </div> -->
                  <input type="text" name="kode_voucher" 
                  <?php 
                    if ($this->session->userdata('refferemail')) { ?> 
                        value="<?= $this->session->userdata('refferemail') ?>" 
                    <?php }elseif($this->session->userdata('reselleruser')){  ?>
                        value="<?= $this->session->userdata('reselleruser') ?>"
                    <?php } ?>
                    id="kode_voucher" placeholder="<?= lang('code_voucher') ?>" required>
				  <?php if($this->session->userdata('reseller') != ""){
					  $sembunyi='hidden';
					?>
					  <input type="checkbox" id="clail-redemption" name="clail-redemption" value="0" hidden>
				  <?php }else{
					  $sembunyi=''; ?>
					  <input type="checkbox" id="clail-redemption" name="clail-redemption" value="1" <?php if ($this->session->userdata('refferemail')) { ?> checked <?php } ?>>
				  <?php } ?>
                  
                  <?php if($sembunyi == ''){?>
					<label for="vehicle1"><?= lang('claim_redemption') ?></label>
				  <?php } ?><p>
                  <div class="text-right"><button type="submit" class="btn-solid btn bvoucher"><?= lang('use_voucher') ?> <!--?php echo $this->session->userdata('refferemail') ?--></button></div>
                </div>
                <?= form_close() ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- section end -->
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"><?= lang('voucher_list') ?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p><?= lang('general_voucher') ?></p>
        <?php if ($voucher) { ?>
          <?php foreach ($voucher as $v_voucher) { ?>
            <?php if ($v_voucher->voucher_default == 1) { ?>
              <?php $isused = $this->db->where(['user_id' => $this->ion_auth->user()->row()->id])->where(['voucher_id' => $v_voucher->id_voucher])->get('voucher_used')->row(); ?>

              <?= form_open('add/voucher', array("class" => "form_voucher")) ?>
              <?= form_hidden('id_voucher', $v_voucher->id_voucher) ?>
              <div class="card mb-2">
                <h5 class="card-header"><?= $v_voucher->nama_voucher ?></h5>
                <div class="card-body">
                  <img src="<?= smn_baseurl() ?>/uploads/voucher/<?= $v_voucher->images ?>" width="60%" alt="">
                  <p class="card-text"><?= $v_voucher->desc ?></p>
                  <button type="submit" class="btn btn-solid"><?= lang('use_voucher') ?></button>
                </div>

              </div>
              <?= form_close() ?>
            <?php } else { ?>
              <?php $isused = $this->db->where(['user_id' => $this->ion_auth->user()->row()->id])->where(['voucher_id' => $v_voucher->id_voucher])->get('voucher_used')->row(); ?>

              <?php if ($isused == null || $isused->is_used == 0) { ?>
                <?php if ($v_voucher->id_voucher == 41 || $v_voucher->id_voucher == 42) { ?>
                  <?php $isused_redemtion = $this->db->where(['user_id' => $this->ion_auth->user()->row()->id])->where(['voucher_id' => 32])->where(['is_used' => 1])->get('voucher_used')->row(); ?>
                  <?php if ($isused_redemtion) { ?>
                    <?= form_open('add/voucher', array("class" => "form_voucher")) ?>
                    <?= form_hidden('id_voucher', $v_voucher->id_voucher) ?>
                    <div class="card mb-2">
                      <h5 class="card-header"><?= $v_voucher->nama_voucher ?></h5>
                      <div class="card-body">
                        <img src="<?= smn_baseurl() ?>/uploads/voucher/<?= $v_voucher->images ?>" width="60%" alt="">
                        <p class="card-text"><?= $v_voucher->desc ?></p>
                        <button type="submit" class="btn btn-solid"><?= lang('use_voucher') ?></button>
                      </div>
                    </div>
                    <?= form_close() ?>
                  <?php } ?>

                <?php } else if ($v_voucher->id_voucher == 47) {
                  $isused_bgs = $this->db->where(['user_id' => $this->ion_auth->user()->row()->id])->where(['voucher_id' => 45])->where(['is_used' => 1])->get('voucher_used')->row(); ?>
                  <?php if ($isused_bgs) { ?>
                    <?= form_open('add/voucher', array("class" => "form_voucher")) ?>
                    <?= form_hidden('id_voucher', $v_voucher->id_voucher) ?>
                    <div class="card mb-2">
                      <h5 class="card-header"><?= $v_voucher->nama_voucher ?></h5>
                      <div class="card-body">
                        <img src="<?= smn_baseurl() ?>/uploads/voucher/<?= $v_voucher->images ?>" width="60%" alt="">
                        <p class="card-text"><?= $v_voucher->desc ?></p>
                        <button type="submit" class="btn btn-solid"><?= lang('use_voucher') ?></button>
                      </div>
                    </div>
                    <?= form_close() ?>
                  <?php } ?>
                <?php } else { ?>
                  <?= form_open('add/voucher', array("class" => "form_voucher")) ?>
                  <?= form_hidden('id_voucher', $v_voucher->id_voucher) ?>
                  <div class="card mb-2">
                    <h5 class="card-header"><?= $v_voucher->nama_voucher ?></h5>
                    <div class="card-body">
                      <img src="<?= smn_baseurl() ?>/uploads/voucher/<?= $v_voucher->images ?>" width="60%" alt="">
                      <p class="card-text"><?= $v_voucher->desc ?></p>
                      <button type="submit" class="btn btn-solid"><?= lang('use_voucher') ?></button>
                    </div>

                  </div>
                  <?= form_close() ?>
                <?php } ?>


              <?php } ?>


            <?php } ?>


          <?php } ?>
        <?php } ?>

        <p><?= lang('referrer_voucher') ?></p>

        <?php if ($voucherRefer) { 
            $vmem = isset($cekMember->created_at) ? $cekMember->created_at : '0000-00-00';
            $dt = new DateTime($vmem);
            $tgl_jadi_member=$dt->format('Y-m-d');
        ?>
          <?php foreach ($voucherRefer as $v_voucher_refer) { ?>
            <?php $user_refer = $this->M_refer->get_referuserDiamond()->result(); ?>

            <?php if ($user_refer) { ?>
              <?php $totalByrRefer = 0;
              $totalOrder = 0;
              $totalUser = 0;
              $totalQtyUser = 0;
              $filter1Bulan=0;
              $filter1Tahun=0;
              $filter3Bulan=0;
              ?>
              <?php foreach ($user_refer as $item_user) { ?>

                <?php $orderItemTotal = $this->M_order->getReferTotalBelanja($item_user->user_refer)->row();
                $totalByrRefer += $orderItemTotal->total_bayar;
                if($item_user->selisih <= 30){
                    $filter1Bulan++;
                }
                if($item_user->selisih <= 360){
                    $filter1Tahun++;
                }
                if($item_user->selisih <= 90){
                  $filter3Bulan++;
                }
                $totalUser++;
                ?>

                <?php
                $orderQtyTotal = $this->M_order->getReferQtyBelanja($item_user->user_refer)->row();
                // var_dump($orderQtyTotal);
                $totalQtyUser += $orderQtyTotal->qty;
                ?>

              <?php } ?>

              <?php for ($m = 1; $m <= $totalUser; $m++) { ?>
                <?php $cekUsageMulti = $this->db->where(['user_id' => $this->ion_auth->user()->row()->id])->where(['voucher_id' => $v_voucher_refer->id_voucher])->where(['val_multiples' => $m])->get('voucher_used')->row(); ?>
                <?php if (!$cekUsageMulti) { ?>
                  <?php if (($m % $v_voucher_refer->total_refer_diamond) == 0) { ?>
                    <?= form_open('add/voucher', array("class" => "form_voucher")) ?>
                    <?= form_hidden('id_voucher', $v_voucher_refer->id_voucher) ?>
                    <?= form_hidden('val_multiples', $m) ?>
                        <?php if($m==2 && $tgl_jadi_member >='2022-10-18' && $tgl_jadi_member <='2025-07-09'){
                                if($filter1Bulan > 1){ ?>
                                    <div class="card mb-2">
                                      <h5 class="card-header"><?= $v_voucher_refer->nama_voucher ?></h5>
                                      <div class="card-body">
                                        <img src="<?= smn_baseurl() ?>/uploads/voucher/<?= $v_voucher_refer->images ?>" width="60%" alt="">
                                        <p class="card-text"><?= $v_voucher_refer->desc ?></p>
                                        <button type="submit" class="btn btn-solid"><?= lang('use_voucher') ?></button>
                                      </div>
                                    </div>
                        <?php 
                                }
                              }else if($m==2 && $tgl_jadi_member < '2022-10-18'){
                                  if($filter1Tahun > 1){ ?> 
                                        <div class="card mb-2">
                                          <h5 class="card-header"><?= $v_voucher_refer->nama_voucher ?></h5>
                                          <div class="card-body">
                                            <img src="<?= smn_baseurl() ?>/uploads/voucher/<?= $v_voucher_refer->images ?>" width="60%" alt="">
                                            <p class="card-text"><?= $v_voucher_refer->desc ?></p>
                                            <button type="submit" class="btn btn-solid"><?= lang('use_voucher') ?></button>
                                          </div>
                                        </div>
                        <?php 
                                    }
                              }else if($m==2 && $tgl_jadi_member >= '2025-07-10'){
                                  if($filter3Bulan > 1){ ?> 
                                        <div class="card mb-2">
                                          <h5 class="card-header"><?= $v_voucher_refer->nama_voucher ?></h5>
                                          <div class="card-body">
                                            <img src="<?= smn_baseurl() ?>/uploads/voucher/<?= $v_voucher_refer->images ?>" width="60%" alt="">
                                            <p class="card-text"><?= $v_voucher_refer->desc ?></p>
                                            <button type="submit" class="btn btn-solid"><?= lang('use_voucher') ?></button>
                                          </div>
                                        </div>
                        <?php 
                                    }
                              }else{ 
                                    if ($v_voucher_refer->total_refer_diamond > 2 && ($m % $v_voucher_refer->total_refer_diamond) == 0) { ?>
                                        <div class="card mb-2">
                                          <h5 class="card-header"><?= $v_voucher_refer->nama_voucher ?></h5>
                                          <div class="card-body">
                                            <img src="<?= smn_baseurl() ?>/uploads/voucher/<?= $v_voucher_refer->images ?>" width="60%" alt="">
                                            <p class="card-text"><?= $v_voucher_refer->desc ?></p>
                                            <button type="submit" class="btn btn-solid"><?= lang('use_voucher') ?></button>
                                          </div>
                                          <!-- <p>oke 1</p> -->
                                        </div>
                        <?php 
                                    }
                                } 
                        ?>
                    <?= form_close() ?>
                  <?php } ?>

                <?php } ?>

              <?php } ?>

            <?php } ?>

          <?php } ?>

        <?php } ?>

        <p><?= lang('general_voucher') ?></p>

        <?php if ($voucherUmum) { ?>
          <?php foreach ($voucherUmum as $v_vouUmum) { ?>
            <?= form_open('add/voucher', array("class" => "form_voucher")) ?>
            <?= form_hidden('id_voucher', $v_vouUmum->id_voucher) ?>
            <?php $isusedUmum = $this->db->where(['user_id' => $this->ion_auth->user()->row()->id])->where(['voucher_id' => $v_vouUmum->id_voucher])->get('voucher_used')->row(); ?>
            <?php if ($isusedUmum == null || $isusedUmum->is_used == 0 || $v_vouUmum->type == 1) { ?>
              <?php if ($v_vouUmum->isupgradediamond == 1) { ?>
                <?php if ($qty >= 2 || $this->cart->total() >= 20000000) { ?>
                  <div class="card mb-2">
                    <h5 class="card-header"><?= $v_vouUmum->nama_voucher ?></h5>
                    <div class="card-body">
                      <img src="<?= smn_baseurl() ?>/uploads/voucher/<?= $v_vouUmum->images ?>" width="60%" alt="">
                      <p class="card-text"><?= $v_vouUmum->desc ?></p>
                      <button type="submit" class="btn btn-solid">Gunakan Voucher</button>
                    </div>
                  </div>
                  <?= form_close() ?>
                <?php } ?>
              <?php } else { ?>
                <div class="card mb-2">
                  <h5 class="card-header"><?= $v_vouUmum->nama_voucher ?></h5>
                  <div class="card-body">
                    <img src="<?= smn_baseurl() ?>/uploads/voucher/<?= $v_vouUmum->images ?>" width="60%" alt="">
                    <p class="card-text"><?= $v_vouUmum->desc ?></p>
                    <button type="submit" class="btn btn-solid"><?= lang('use_voucher') ?></button>
                  </div>
                </div>
                <?= form_close() ?>
              <?php } ?>
            <?php } ?>
          <?php } ?>
        <?php } ?>
        <p><?= lang('upgrade_diamond_voucher') ?></p>
        <?php if ($voucherUpgrade) { ?>
          <?php if ($qty >= 2 || $this->cart->total() >= 20000000) { ?>
            <?php foreach ($voucherUpgrade as $itemUpgrade) { ?>
              <?= form_open('add/voucher', array("class" => "form_voucher")) ?>
              <?= form_hidden('id_voucher', $itemUpgrade->id_voucher) ?>
              <?= form_hidden('is_Upgrade', 1) ?>
              <div class="card mb-2">
                <h5 class="card-header"><?= $itemUpgrade->nama_voucher ?></h5>
                <div class="card-body">
                  <img src="<?= smn_baseurl() ?>/uploads/voucher/<?= $itemUpgrade->images ?>" width="60%" alt="">
                  <p class="card-text"><?= $itemUpgrade->desc ?></p>
                  <button href="#" class="btn btn-solid"><?= lang('use_voucher') ?></button>
                </div>
              </div>
              <?= form_close() ?>
            <?php } ?>
          <?php } ?>
        <?php }  ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= lang('close') ?></button>
      </div>
    </div>
  </div>
</div>
<?= form_close() ?>

<script>
  $(document).ready(function() {
    $('input[type="checkbox"]').click(function() {
      let val = $(this).is(":checked");
      if (val === true) {
        document.getElementById("kode_voucher").placeholder = "<?= lang('placehloder_username_redemption') ?>";
      } else {
        document.getElementById("kode_voucher").placeholder = "<?= lang('code_voucher') ?>";
      }
    });

    //$(document).on("submit", ".form_voucher", function(e) {
	/*$('.bvoucher').click(function(){
      $.ajax({
        type: "POST",
        url: "<?= base_url() ?>CekOutController/simpan_user",
        data: 'first_name=' + $(".form2 input[name=first_name]").val() + '&last_name=' + $(".form2 input[name=last_name]").val() + '&phone=' + $(".form2 input[name=phone]").val() + '&email=' + $(".form2 input[name=email]").val() + '&address=' + $(".form2 input[name=address]").val() + '&kode_pos=' + $(".form2 input[name=kode_pos]").val() + '&<?= $this->security->get_csrf_token_name() ?>=' + '<?= $this->security->get_csrf_hash() ?>',
        success: function(response) {

        }
      });
    });*/


  });
</script>