  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<!-- breadcrumb start -->
<div class="breadcrumb-section">
  <div class="container">
    <div class="row">
      <div class="col-sm-6">
        <div class="page-title">
          <h2>Checkout <!--?php echo $this->session->userdata('metode_admin').' - '.$this->session->userdata('biaya_admin') ?--></h2>
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
		$sp_disable="";
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
                <div class="field-label"><small><?= lang('whatsapp_active') ?></small></div>
              </div>
              <div class="form-group col-md-6 col-sm-6 col-xs-12">
                <div class="field-label"><?= lang('email_address_order','email') ?> <span style="color: red;">*</span> </div>
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
                <div class="field-label"><?= lang('address_order','address') ?> <span style="color: red;">*</span> </div>
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
                <div class="field-label"><?= lang('postal_code_order','kode_pos') ?> <span style="color: red;">*</span> </div>
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
            <div class="form-group col-md-12 col-sm-6 col-xs-12">
                <div class="field-label">Metode Pembayaran <span style="color: red;">*</span> </div>
                <ul class="list-group">
                  <li class="list-group-item my-2">
                    <div style="font-weight: bold">                  
                      <input type="radio" name="pembayaran" value="bank_transfer" id="bank_transfer" required>
                      <img src="<?= base_url('/assets/images/icon-metode/bank.png')?>" width="10%" />  BANK TRANSFER
                    </div>
                  </li>
                  <li class="list-group-item my-2">
                    <div style="font-weight: bold">                    
                      <input type="radio" name="pembayaran" value="wallet" id="wallet" required>
                      <img src="<?= base_url('/assets/images/icon-metode/wallet.png')?>" width="10%" /> E-WALLET
                    </div>
                  </li> 
                  <li class="list-group-item my-2">
                    <input type="radio" name="pembayaran" value="credit_card" id="credit_card" required>
                    <img src="<?= base_url('/assets/images/icon-metode/visa.png')?>" width="10%" alt="">
                    <img src="<?= base_url('/assets/images/icon-metode/mastercard.png')?>" width="10%" alt="">
                    <img src="<?= base_url('/assets/images/icon-metode/jcb.png')?>" width="10%" alt="">
                  </li>
                </ul>
            </div>
              <!--ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                  <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Bank Transfer</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="wallet-tab" data-bs-toggle="tab" data-bs-target="#wallet" type="button" role="tab" aria-controls="wallet" aria-selected="false">E-Wallet</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="cc-tab" data-bs-toggle="tab" data-bs-target="#cc" type="button" role="tab" aria-controls="cc" aria-selected="false">Kartu Kredit</button>
                </li>
                <!-- <li class="nav-item" role="presentation">
                  <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false"></button>
                </li> -->
              <!--/ul>
              <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                  <ul class="list-group">
                    <li class="list-group-item my-2">
                      <input type="radio" name="pembayaran" value="bri" id="bri" required>
                      <img src="<?= base_url('/assets/images/icon-metode/bri-logo.png')?>" width="30%" alt="">
                    </li>
                    <li class="list-group-item mb-2">
                      <input type="radio" name="pembayaran" value="mandiri"  id="mandiri">
                      <img src="<?= base_url('/assets/images/icon-metode/mandiri-logo.png')?>" width="30%" alt="">
                    </li>
                    <li class="list-group-item mb-2">
                      <input type="radio" name="pembayaran" value="bni" id="bni" required>
                      <img src="<?= base_url('/assets/images/icon-metode/bni-logo.png')?>" width="30%" alt="">
                    </li>
                    <li class="list-group-item mb-2">
                      <input type="radio" name="pembayaran" value="permata"  id="permata">
                      <img src="<?= base_url('/assets/images/icon-metode/permata-logo.png')?>" width="30%" alt="">
                    </li>
                    <li class="list-group-item mb-2">
                      <input type="radio" name="pembayaran" value="bca"  id="bca">
                      <img src="<?= base_url('/assets/images/icon-metode/bca-logo.png')?>" width="30%" alt="">
                    </li>
                    <li class="list-group-item mb-2">
                      <input type="radio" name="pembayaran" value="sahabat_sampoerna"  id="sahabat_sampoerna">
                      <img class="img-reponsive" src="<?= base_url('/assets/images/icon-metode/bss-logo.png')?>" class="align-self-center img-fluid" width="250" alt="">
                    </li>
                    <li class="list-group-item mb-2">
                      <input type="radio" name="pembayaran" value="cimb"  id="cimb">
                      <img src="<?= base_url('/assets/images/icon-metode/cimb-logo.png')?>" class="align-self-center img-fluid" width="250" alt="">
                    </li>
                  </ul>
                </div>
                <div class="tab-pane fade" id="wallet" role="tabpanel" aria-labelledby="wallet-tab">
                  <ul class="list-group">
                    <li class="list-group-item my-2">
                      <input type="radio" name="pembayaran" value="ovo" id="ovo" required>
                      <img src="<?= base_url('/assets/images/icon-metode/ovo-logo.png')?>" width="20%" alt="">
                    </li>
                    <li class="list-group-item mb-2">
                      <input type="radio" name="pembayaran" value="dana" id="dana">
                      <img src="<?= base_url('/assets/images/icon-metode/dana-logo.png')?>" width="20%" alt="">
                    </li>
                    <li class="list-group-item mb-2">
                      <input type="radio" name="pembayaran" value="linkaja" id="linkaja" required>
                      <img src="<?= base_url('/assets/images/icon-metode/linkaja-logo.png')?>" width="12%" alt="">
                    </li>
                    <li class="list-group-item mb-2">
                      <input type="radio" name="pembayaran" value="shopeepay"  id="shopeepay">
                      <img src="<?= base_url('/assets/images/icon-metode/shopeepay-logo.png')?>" width="20%" alt="">
                    </li>
                  </ul>
                </div>
                <div class="tab-pane fade" id="cc" role="tabpanel" aria-labelledby="cc-tab">
                  <ul class="list-group">
                    <li class="list-group-item my-2">
                      <input type="radio" name="pembayaran" value="credit_card" id="credit_card" required>
                      <img src="<?= base_url('/assets/images/icon-metode/visa.png')?>" width="15%" alt="">
                      <img src="<?= base_url('/assets/images/icon-metode/mastercard.png')?>" width="15%" alt="">
                      <img src="<?= base_url('/assets/images/icon-metode/jcb.png')?>" width="15%" alt="">
                    </li>
                  </ul>
                </div>
                <!-- <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div> -->
              <!--/div-->

              <?php $refer = $this->db->where(['user_id' => $this->ion_auth->user()->row()->id])->get('users_refer')->row(); ?>
              <?php if ($refer == null) {  ?>
                <?php if ($this->session->userdata('refferemail')) { ?>
                  <input type="hidden" name="reffer" value="<?= $this->session->userdata('refferemail') ?>">
                  <div class="form-group col-md-12 col-sm-6 col-xs-12" style="display: none !important">
                    <div class="field-label"><?= lang('form_refer') ?></div>
                    <input type="text" name="reffer" disabled value="<?= $this->session->userdata('refferemail') ?>" placeholder="">
                  </div>
                <?php } else {  ?>
                  <div class="form-group col-md-12 col-sm-6 col-xs-12" style="<?= $this->session->userdata('reseller') == '1' ? "display: none !important" : "display: none !important" ?>">
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
                <ul class="total"><!--total-->

                  <?php if ($this->session->flashdata('isupgradediamond')) {  ?>
                    <li><?= lang('free_upgrade_diamond') ?></li>
                    <input type="hidden" name="isupgradediamond" value="<?= $this->session->flashdata('isupgradediamond') ?>" placeholder="" required>
                  <?php  } ?>

                  <?php if ($this->session->flashdata('val_multiples')) {  ?>
                    <input type="hidden" name="val_multiples" value="<?= $this->session->flashdata('val_multiples') ?>" placeholder="" required>
                  <?php  } ?>


                  <?php if ($this->session->flashdata('typePotongan')) {  ?>
                  <!--count-->
                    <li>Sub Total <span class="" style="font-size: 18px;line-height: 20px;color: #232323;font-weight: 400; width: 35%;">IDR <?= number_format($this->cart->total(), 0, ',', '.'); ?></span></li>

                    <li><?= $this->session->flashdata('typePotongan') ?></li>
                    <li style="max-width: 65%;"><?= $this->session->flashdata('voucherName') ?></li>

                    <?php if ($this->session->flashdata('totalBelanjaDiskon') <= 0) { ?>
                      <?php $totalBelanjaDiskon = 0; ?>
                    <?php } else { ?>
                      <?php $totalBelanjaDiskon = $this->session->flashdata('totalBelanjaDiskon'); ?>
                    <?php } ?>
                    <!--tambahan ebe-->
                    <?php if(!$this->session->flashdata('kode_voucher')){ ?>
                        <div id="biaya_admin" name="biaya_admin" value="<?= ($this->session->userdata('biaya_admin')) ? $this->session->userdata('biaya_admin')*$totalBelanjaDiskon : 0  ?>">
                          <?php if($this->session->userdata('metode_admin')){ ?>
                          <!--count-->
                            <li>Biaya Admin <span class="" style="font-size: 18px;line-height: 20px;color: #232323;font-weight: 400; width: 35%;">IDR <?php echo number_format($this->session->userdata('biaya_admin')*$totalBelanjaDiskon, 0, ',', '.') ?></span></li>
                          <?php } ?>
                        </div>
                        <div id="jumlah_total"></div>
                    <?php } ?>
                    <div id="div_total">
                    <?php
                        if($this->session->flashdata('kode_voucher')){
                            $adm=0;
                        }else{
                            $adm=($this->session->userdata('biaya_admin')) ? $this->session->userdata('biaya_admin')*$totalBelanjaDiskon : 0;
                        }
                    ?>
                    <!--end tambahan-->
                    <!--count-->
                    <li>Total <span class="" style="font-size: 18px;line-height: 20px;font-weight: 700; width: 35%;color: #160a6e;">IDR <?= number_format($totalBelanjaDiskon+$adm, 0, ',', '.'); ?></span></li>
                    </div>
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
				  
                  <input type="hidden" id="nilai_total" value="<?= $this->cart->total() ?>">
                  <div id="biaya_admin" name="biaya_admin" value="<?= ($this->session->userdata('biaya_admin')) ? $this->session->userdata('biaya_admin')*$this->cart->total() : 0  ?>">
                      <?php if($this->session->userdata('metode_admin')){ ?>
                      <!--count-->
                        <li>Biaya Admin <span class="" style="font-size: 18px;line-height: 20px;color: #232323;font-weight: 400; width: 35%;">IDR <?php echo number_format($this->session->userdata('biaya_admin')*$this->cart->total(), 0, ',', '.') ?></span></li>
                      <?php } ?>
                  </div>
                  <div id="jumlah_total"></div>
                  <div id="div_total">
                      <!--count-->
                    <li>Total<span class="" style="font-size: 18px;line-height: 20px;font-weight: 700; width: 35%;color: #160a6e;">
                      <!--ebe-->
                      <?php $adm=($this->session->userdata('biaya_admin')) ? $this->session->userdata('biaya_admin')*$this->cart->total() : 0 ?>
                      IDR <?= number_format($this->cart->total()+$adm , 0, ',', '.'); ?>
                      <!--?= ($this->session->userdata('reseller')=='1') ? number_format($jml_potongan, 0, ',', '.') : number_format($this->cart->total(), 0, ',', '.'); ?-->
                      </span>
                    </li>
                  </div>
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
                        
                    <?php if(!$this->session->flashdata('typePotongan')){?>
					<?php
                    $items_khusus="950201094";//SP 950201169, FP 950201094
                    $item_khusus_exclude_sepatu = explode(",", $items_khusus);
					
					$items_khusus_sp="950201169";//SP 950201169, FP 950201094
                    $item_khusus_exclude_sepatu_sp = explode(",", $items_khusus_sp);
					
                    $jika_ada_sp=0;
                    $sp_disable="";
                    foreach ($this->cart->contents() as $items) {
                        if (in_array($items['id'], $item_khusus_exclude_sepatu, TRUE)) {
                            $jika_ada_sp=1;
                            $sp_disable="disabled";
                        }
						if (in_array($items['id'], $item_khusus_exclude_sepatu_sp, TRUE)) {
                            $jika_ada_sp=1;
                            $sp_disable="";
                        }
                    }
                    ?>
                    <?php if($jika_ada_sp == 0){?>
                    <div class="text-right"><button type="button" class="btn-solid btn" data-toggle="modal" data-target="#exampleModalConfrim"><?= lang('order') ?></button></div>
                    <?php }else{ ?>
                    <div class="text-right"><button type="submit" class="btn-solid btn" onclick="this.form.submit(); this.disabled = true; this.value = 'Submitting the form';"><?= lang('order') ?></button></div>
                    <?php } ?>
                        <div class="modal fade" id="exampleModalConfrim" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
						  <div class="modal-dialog modal-dialog-centered">
						       <div class="modal-content">
							        <div class="modal-header">
    							        <h5 class="modal-title" id="exampleModalLabel">Informasi</h5>
    							        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
    								    <span aria-hidden="true">&times;</span>
    							        </button>
							        </div>
        							<div class="modal-body">
        							  Anda belum input Kode Promo, Klik Place Order jika ingin melanjutkan order ini.
        							</div>
        							<div class="modal-footer">
        							  <button type="submit" class="btn-solid btn" onclick="this.form.submit(); this.disabled = true; this.value = 'Submitting the form';"><?= lang('order') ?></button>
        							</div>
						       </div>
					    </div>
					  </div>
                    <?php }else{ ?>
                        <div class="text-right"><button type="submit" class="btn-solid btn" onclick="this.form.submit(); this.disabled = true; this.value = 'Submitting the form';"><?= lang('order') ?></button></div>
                    <?php } ?>
                <?php }else{ ?>
						<?php if(!$this->session->flashdata('typePotongan')){?>
						<div class="text-right"><button type="button" class="btn-solid btn" data-toggle="modal" data-target="#exampleModalConfrim"><?= lang('order') ?></button></div>
							<div class="modal fade" id="exampleModalConfrim" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
							  <div class="modal-dialog modal-dialog-centered">
								   <div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLabel">Informasi</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
										  Anda belum input Kode Promo, Klik Place Order jika ingin melanjutkan order ini.
										</div>
										<div class="modal-footer">
										  <button type="submit" class="btn-solid btn" onclick="this.form.submit(); this.disabled = true; this.value = 'Submitting the form';"><?= lang('order') ?></button>
										</div>
								   </div>
							</div>
						  </div>
						<?php }else{ ?>
							<div class="text-right"><button type="submit" class="btn-solid btn" onclick="this.form.submit(); this.disabled = true; this.value = 'Submitting the form';"><?= lang('order') ?></button></div>
						<?php } ?>
					  <!--div class="text-right"> <button type="button" class="btn-solid btn" data-toggle="modal" data-target="#exampleModalConfrim">
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
					  </div-->
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
                  <?php if ($this->session->userdata('refferemail')) { ?> 
                        value="<?= $this->session->userdata('refferemail') ?>" 
                    <?php }elseif($this->session->userdata('reselleruser')){  ?>
                        value="<?= $this->session->userdata('reselleruser') ?>"
                    <?php } ?>
                    id="kode_voucher" placeholder="<?= lang('code_voucher') ?>" required <?= $sp_disable ?>>
				  <?php if($this->session->userdata('reseller') != ""){
					  $sembunyi='hidden';
					?>
					  <input type="checkbox" id="clail-redemption" name="clail-redemption" value="0" hidden>
				  <?php }else{
					  $sembunyi='hidden'; ?>
					  <input type="checkbox" id="clail-redemption" name="clail-redemption" value="1" <?php if ($this->session->userdata('refferemail')) { ?> checked <?php } ?> hidden>
				  <?php } ?>
                  
                  <?php if($sembunyi == ''){?>
					<label for="vehicle1"><?= lang('claim_redemption') ?></label>
				  <?php } ?><p>
                  <div class="text-right"><button type="submit" class="btn-solid btn bvoucher" <?= $sp_disable ?>><?= lang('use_voucher') ?> <!--?php echo $this->session->userdata('refferemail') ?--></button></div>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
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
    $('.bvoucher').click(function(){
        //alert($(".form2 input[name=first_name]").val());
         $.ajax({
            type: "POST",
            url: "<?= base_url() ?>CekOutController/simpan_user",
            data: 'first_name=' + $(".form2 input[name=first_name]").val() + '&last_name=' + $(".form2 input[name=last_name]").val() + '&phone=' + $(".form2 input[name=phone]").val() + '&email=' + $(".form2 input[name=email]").val() + '&address=' + $(".form2 input[name=address]").val() + '&kode_pos=' + $(".form2 input[name=kode_pos]").val() + '&<?= $this->security->get_csrf_token_name() ?>=' + '<?= $this->security->get_csrf_hash() ?>',
            success: function(response) {
    
            }
          });
    });
    
    $(document).ready(function(){
        /*$('#home').removeClass('show active');
          $('#home-tab').removeClass('active');
          $('#wallet').removeClass('show active');
          $('#wallet-tab').removeClass('active');
          $('#cc').addClass('show active');
          $('#cc-tab').addClass('active');*/
        //$( "#myTabContent" ).tabs( {active:2});
        //$('#myTabContent div[id="#cc"]').tab('show')
        <?php if($this->session->userdata('metode_admin')){ ?>
        var selectedValue = <?= $this->session->userdata('metode_admin') ?>;
        $('input[id=<?= $this->session->userdata('metode_admin') ?>]').prop('checked', true);
        /*
        <!?php if($this->session->userdata('metode_admin') === "bank_transfer" || $this->session->userdata('metode_admin') === "bri" || $this->session->userdata('metode_admin') === "mandiri" || $this->session->userdata('metode_admin') === "bni" || $this->session->userdata('metode_admin') === "permata" || $this->session->userdata('metode_admin') === "bca" || $this->session->userdata('metode_admin') === "sahabat_sampoerna"){ ?>
          $('#home').addClass('show active');
          $('#home-tab').addClass('active');
          $('#wallet').removeClass('show active');
          $('#wallet-tab').removeClass('active');
          $('#cc').removeClass('show active');
          $('#cc-tab').removeClass('active');
        <!?php }
       
        if($this->session->userdata('metode_admin') === "ovo" || $this->session->userdata('metode_admin') === "dana" || $this->session->userdata('metode_admin') === "linkaja" || $this->session->userdata('metode_admin') === "shopeepay"){ ?>
          $('#home').removeClass('show active');
          $('#home-tab').removeClass('active');
          $('#wallet').addClass('show active');
          $('#wallet-tab').addClass('active');
          $('#cc').removeClass('show active');
          $('#cc-tab').removeClass('active');
        <!?php }

        if($this->session->userdata('metode_admin') === "credit_card"){ ?>
          $('#home').removeClass('show active');
          $('#home-tab').removeClass('active');
          $('#wallet').removeClass('show active');
          $('#wallet-tab').removeClass('active');
          $('#cc').addClass('show active');
          $('#cc-tab').addClass('active');*/
        <?php 
        //}
         } ?>
        //$('input[id=bri]').prop('checked', true);
      $('input[type=radio][name=pembayaran]').change(function () {
        debugger;
        //here i want to get the clicked id of the radio
        var selectedValue = $(this).attr('id');
        var admin=0;
        
        if(selectedValue === "bank_transfer" || selectedValue === "bri" || selectedValue === "mandiri" || selectedValue === "bni" || selectedValue === "permata" || selectedValue === "bca" || selectedValue === "sahabat_sampoerna"){
          admin = 0;
        }
        
        if(selectedValue === "wallet" || selectedValue === "ovo" || selectedValue === "dana" || selectedValue === "linkaja" || selectedValue === "shopeepay"){
          admin = 0.015;//1.5%
        }

        if(selectedValue === "credit_card"){
          admin = 0.029;//2.9%
        }
        
        //alert($('#biaya_admin').val());
        //var nilai_total = document.getElementById('nilai_total').value;
        var nilai_total = $("input[name=total_amount]").val();
        var potongan = Math.round(parseFloat(admin)*parseInt(nilai_total));
        jumlah = potongan+parseInt(nilai_total);
        //alert(parseFloat(admin)+"-"+parseInt(nilai_total)+"-"+jumlah);
        str_admin = potongan.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        jumlah = jumlah.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        document.getElementById('biaya_admin').innerHTML='';
        document.getElementById('jumlah_total').innerHTML ='';
        
        document.getElementById('biaya_admin').innerHTML ='<li>Biaya Admin <span class="" style="font-size: 18px;line-height: 20px;color: #232323;font-weight: 400; width: 35%;">IDR ' + str_admin + "</span></li>";//ini hanya utk tampilan saja
        document.getElementById('jumlah_total').innerHTML ='<li>Total <span class="" style="font-size: 18px;line-height: 20px;font-weight: 700; width: 35%;color: #160a6e;">IDR ' + jumlah + "</span></li>";//ini hanya utk tampilan saja
        //$("input[name=biaya_admin]").val(admin);
        $('#biaya_admin').val(admin);
        //alert($('#biaya_admin').val());
        $('#div_total').addClass('d-none');
        let text = selectedValue;
        var isinya = text.replace("_","+")+"-"+admin;
        //alert(isinya);
         $.get("<?php echo base_url('CekOutController/set_session/') ?>" + isinya, function (result) {
            console.log(result);
        });
        
      });




      // $("input:radio").each(function(){
      //     var $this = $(this);    
      //     if($this.is(":checked")){
      //         console.log($this.attr("id"));
      //     }
      // });

      $('#metode').change(function() {

        
        var metode = document.getElementById('metode').value;
        alert(metode);
        var nilai_total = document.getElementById('nilai_total').value;
        jumlah = parseInt(layanan)+parseInt(nilai_total);

        lay = layanan.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        jumlah = jumlah.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');

        document.getElementById('ongkir').innerHTML ='<li>Admin <span class="count">IDR ' + lay + "</span></li>";
        document.getElementById('jumlah_total').innerHTML ='<li>Total <span class="count">IDR ' + jumlah + "</span></li>";
        $('#div_total').addClass('d-none');
        
      });
    });


  });
</script>