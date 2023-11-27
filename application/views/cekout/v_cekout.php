 
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
          $sp_disable = "";
          $kode_order = 'ORD/' . date('Ymd') . '/' . $this->ion_auth->user()->row()->id . '/' . strtoupper(random_string('alnum', 4));
          // echo $kode_order;
          ?>
          <input type="hidden" name="kode_order" value="<?= $kode_order ?>" placeholder="" required>


          <div>
            <div class="text-[32px] font-bold mb-3">
              Billing Details
            </div>
            <div class="grid md:grid-cols-2 gap-[20px]">
              <div>
                <!-- Order Items -->
                <div>
                  <?php foreach ($this->cart->contents() as $items) : ?>
                    <?php
                    $barang = $this->M_product->get_detailproduct($items['id']);
                    $totalStok = 0;
                    $cekTotal = $this->db->select_sum('jumlah_stok')
                      ->where(['id_store' => 100])
                      ->where(['id_product' => $items['id']])
                      ->where(['id_product_attribute' => $items['options']['Size']])
                      ->get('product_stok')
                      ->row();
                    if ($cekTotal->jumlah_stok >= 1) {
                      $totalStok = $cekTotal->jumlah_stok;
                    }
                    ?>

                    <div class="relative grid gap-3 bg-white border-2 border-[#e9e9e9] rounded-[10px] shadow-md overflow-hidden">


                      <div class="p-3">
                        <div class="flex gap-4">
                          <div>
                            <div class=" aspect-square w-[60px] md:w-[100px] relative">
                              <a href="<?= base_url() ?>product/detail/<?= $barang->id_product ?>">
                                <img src="<?= smn_baseurl() ?>uploads/product/<?= $barang->image_one ?>" class=" object-cover w-full h-full absolute">
                              </a>
                            </div>
                          </div>
                          <div class="">
                            <!-- Product Name -->
                            <div class="text-[22px] font-bold">
                              <a href="<?= base_url('product/detail/' . $items['id']) ?>">
                                <?= $items['name'] ?>
                              </a>
                            </div>
                            <!-- Detail -->
                            <div class="text-[13px]">
                              <?php if ($this->cart->has_options($items['rowid']) == TRUE) : ?>
                                <p>
                                  <?php foreach ($this->cart->product_options($items['rowid']) as $option_name => $option_value) : ?>
                                    <?php if ($option_name != 'Diskon') { ?>
                                      <?php if ($option_name == 'Size') { ?>
                                        <?php $size = $this->db->where(['id_product_attribute' => $option_value])->get('product_attribute')->row(); ?>
                                        <?php if ($size) { ?>
                                          <strong><?php echo $option_name; ?>:</strong> <?php echo $size->size ?><br />
                                        <?php } else { ?>
                                          <strong><?php echo $option_name; ?>:</strong> N/A<br />
                                        <?php } ?>
                                      <?php } else if ($option_name == 'Color') { ?>
                                        <strong><?php echo $option_name; ?>:</strong> <?php echo $option_value; ?><br />
                                      <?php } ?>
                                    <?php } ?>
                                  <?php endforeach; ?>
                                </p>
                              <?php endif; ?>
                              <?php if ($items['options']['Indent'] != 0) {  ?>
                                <p style="color:red;">item Indent <?= $barang->hari_indent ?> Days </p>
                              <?php } ?>
                            </div>

                            <!-- Price Column -->
                            <div class="pt-2 mt-2">
                              <div class="font-bold text-[18px]">
                                <?php if ($items['options']['Diskon'] != 0) {  ?>
                                  <p style="color:red;"> Diskon : <?= $items['options']['Diskon'] ?> % </p>
                                  <p>Price Item : IDR <?= number_format($barang->harga, 0, ',', '.') ?></p>
                                <?php } ?>
                                <div class="td-color subtotal-<?= $items['id'] ?>">
                                  IDR <?= number_format($items['subtotal'], 0, ',', '.') ?>
                                </div>
                              </div>
                            </div>

                          </div>
                        </div>
                      </div>

                      <div class="p-3 bg-grey gap-4 text-[#979797]">

                        <div>
                          <b>Dikirim ke</b> <br>
                          <span>
                            <?php echo $items['options']['alamat']['alamat_pengiriman'] ?>
                          </span>
                        </div>

                        <?php if ($items['options']['jasa_kirim']) : ?>
                          <div class="mt-2">
                            <b>Jasa Pengiriman</b> <br>
                            <select class="select-ekspedisi-pengiriman form-control" style="width: 200px;text-transform: uppercase;">
                              <?php foreach ($items['options']['jasa_kirim'] as $expedisi) : ?>
                                <?php foreach ($expedisi['costs'] as $cost) : ?>
                                  <?php
                                  // Selected dropdown
                                  $selected = false;

                                  $desiredCode = $expedisi['code'];
                                  $desiredService = $cost['service'];
                                  $desiredCost = $cost['cost'][0]['value'];

                                  if ($items['options']['pengiriman'] == "$desiredCode,$desiredService,$desiredCost") {
                                    $selected = true;
                                  } else {
                                    $selected = false;
                                  }


                                  ?>

                                  <option value="<?php echo $expedisi['code'] ?>,<?php echo $cost['service'] ?>,<?php echo $cost['cost'][0]['value'] ?>" <?php echo $selected ? "selected" : "" ?>>
                                    <?php echo $expedisi['code'] ?> <?php echo $cost['service'] ?> | <?php echo $cost['cost'][0]['value'] ?>
                                  </option>
                                <?php endforeach ?>
                              <?php endforeach ?>
                            </select>
                          </div>
                        <?php endif ?>


                      </div>
                    </div>

                  <?php endforeach; ?>
                </div>
                <!-- Metode Pembayaran -->
                <div>
                  <div class="my-4">
                    <div class="font-bold">
                      Metode Pembayaran <span class="text-red">*</span>
                    </div>
                  </div>
                  <div class="bg-white border-2 border-[#e9e9e9] rounded-[10px] shadow-md overflow-hidden">
                    <div class="px-3 p-2 dynamic-input-parent-payment-method hover:bg-[#f4f4f4]" data-input-id="bank_transfer">
                      <div class="font-bold flex items-center">
                        <input type="radio" name="pembayaran" value="bank_transfer" id="bank_transfer" required class="mr-2">
                        <img src="<?= base_url('/assets/images/icon-metode/bank.png') ?>" width="10%" alt="Bank Transfer" class="mr-2"> BANK TRANSFER
                      </div>
                    </div>
                    <div class="px-3 p-2 dynamic-input-parent-payment-method hover:bg-[#f4f4f4]" data-input-id="wallet">
                      <div class="font-bold flex items-center">
                        <input type="radio" name="pembayaran" value="wallet" id="wallet" required class="mr-2">
                        <img src="<?= base_url('/assets/images/icon-metode/wallet.png') ?>" width="10%" alt="E-Wallet" class="mr-2"> E-WALLET
                      </div>
                    </div>
                    <div class="px-3 p-2 dynamic-input-parent-payment-method hover:bg-[#f4f4f4]" data-input-id="credit_card">
                      <div class="font-bold flex items-center">
                        <input type="radio" name="pembayaran" value="credit_card" id="credit_card" required class="mr-2">
                        <img src="<?= base_url('/assets/images/icon-metode/visa.png') ?>" width="10%" alt="Visa" class="mr-2">
                        <img src="<?= base_url('/assets/images/icon-metode/mastercard.png') ?>" width="10%" alt="Mastercard" class="mr-2">
                        <img src="<?= base_url('/assets/images/icon-metode/jcb.png') ?>" width="10%" alt="JCB">
                      </div>
                    </div>


                    <script>
                      <?php if (!$this->session->userdata('metode_admin')) : ?>
                        // jQuery script to dynamically click the input when the parent is clicked
                        document.getElementById("bank_transfer").checked = true;
                        var selectedValue = $("input[name='pembayaran']:checked").val();

                        var admin = 0;
                        if (selectedValue === "bank_transfer" || selectedValue === "bri" || selectedValue === "mandiri" || selectedValue === "bni" || selectedValue === "permata" || selectedValue === "bca" || selectedValue === "sahabat_sampoerna") {
                          admin = 0;
                        }
                        if (selectedValue === "wallet" || selectedValue === "ovo" || selectedValue === "dana" || selectedValue === "linkaja" || selectedValue === "shopeepay") {
                          admin = 0.015; //1.5%
                        }
                        if (selectedValue === "credit_card") {
                          admin = 0.029; //2.9%
                        }

                        let text = selectedValue;
                        var isinya = text.replace("_", "+") + "-" + admin;
                        $.get("<?php echo base_url('CekOutController/set_session/') ?>" + isinya, function(result) {
                          window.location.reload();
                        });
                      <?php endif ?>


                      $(".dynamic-input-parent-payment-method").click(function() {
                        var inputId = $(this).data("input-id");
                        var radioButton = $("#" + inputId);
                        if (!radioButton.prop("checked")) {
                          radioButton.prop("checked", true).click();
                          var selectedValue = inputId;
                          var admin = 0;
                          if (selectedValue === "bank_transfer" || selectedValue === "bri" || selectedValue === "mandiri" || selectedValue === "bni" || selectedValue === "permata" || selectedValue === "bca" || selectedValue === "sahabat_sampoerna") {
                            admin = 0;
                          }
                          if (selectedValue === "wallet" || selectedValue === "ovo" || selectedValue === "dana" || selectedValue === "linkaja" || selectedValue === "shopeepay") {
                            admin = 0.015; //1.5%
                          }
                          if (selectedValue === "credit_card") {
                            admin = 0.029; //2.9%
                          }

                          let text = selectedValue;
                          var isinya = text.replace("_", "+") + "-" + admin;
                          //alert(isinya);
                          $.get("<?php echo base_url('CekOutController/set_session/') ?>" + isinya, function(result) {
                            // console.log(result);
                            window.location.reload();
                          });
                        }
                      });
                    </script>
                    </script>
                  </div>
                </div>

              </div>
              <div>
                <div class="p-[10px]">
                  <!-- Ringkasan Belanja -->
                  <div class="">
                    <ul class="qty">
                      <?php
                      $i = 1;
                      $qty = 0;
                      $jml_potongan = 0; //ebe
                      $jml_disc = 0;
                      $total_ongkir = 0;
                      // var_dump($this->cart->contents());
                      foreach ($this->cart->contents() as $items) :
                        $barang = $this->M_product->get_detailproduct($items['id']);
                        //===ebe reseller
                        $vnilai = (20 / 100) * $barang->harga;
                        $setelah_disc = $barang->harga - $vnilai;
                        $hrg_setelah_disc = $setelah_disc * $items['qty'];
                        $jml_disc += $vnilai * $items['qty'];
                        $jml_potongan = $jml_potongan + $hrg_setelah_disc;
                        //===end ebe
                      ?>

                        <?php
                        $size = $this->db
                          ->where(['id_product_attribute' => $items['options']['Size']])
                          ->get('product_attribute')
                          ->row();
                        ?>

                        <div>
                          <div class="flex justify-between">
                            <!-- Product Order -->
                            <div>
                              <span>
                                <?= $items['name'] ?> ( ×<?= $items['qty'] ?> )
                              </span>
                              <?php if ($items['options']['Indent'] != 0) {  ?>
                                <span style="color:red;"> item indent </span>
                              <?php } ?>
                            </div>

                            <span class="font-bold">
                              IDR <?= number_format($items['subtotal'], 0, ',', '.') ?>
                            </span>
                          </div>
                          <!-- Product Info -->
                          <div class="text-[12px] text-[#bdbdbd] capitalize">
                            <?= lang('size_produk') ?> : <?= $size->size ?>,
                            Price Item : IDR <?= number_format($barang->harga, 0, ',', '.') ?>
                            <?php if ($items['options']['Diskon'] != 0) {  ?>
                              ,<?= lang('discount') ?> : <?= $items['options']['Diskon'] ?> % Per Item
                            <?php } ?>
                          </div>
                          <!-- Ongkir -->
                          <?php if (isset($items['options']['pengiriman']) && $items['options']['pengiriman']) : ?>
                            <?php
                            $pengiriman = explode(',', $items['options']['pengiriman']);
                            $pengiriman_ekspedisi = $pengiriman[0];
                            $pengiriman_service = $pengiriman[1];
                            $pengiriman_ongkir = $pengiriman[2];
                            $total_ongkir = $total_ongkir +  $pengiriman_ongkir;
                            ?>
                            <div class="flex justify-between text-[12px]">
                              <span>
                                Tarif Pengiriman (
                                <span class="uppercase">
                                  <?php echo $pengiriman_ekspedisi ?>
                                </span>
                                /
                                <?php echo $pengiriman_service ?>
                                )
                              </span>
                              <span class="font-bold">
                                IDR <?php echo number_format($pengiriman_ongkir, 0, ',', '.') ?>
                              </span>
                            </div>
                            <?= form_hidden('pengiriman' . $i, $items['options']['pengiriman']) ?>
                          <?php endif; ?>

                        </div>

                        <?= form_hidden('diskon' . $i, $items['options']['Diskon']) ?>
                        <?= form_hidden('qty' . $i, $items['qty']) ?>
                        <?= form_hidden('price_item' . $i, $barang->harga) ?>
                        <?= form_hidden('sub_total' . $i, $items['subtotal']) ?>

                        <?= form_hidden('indent' . $i, $items['options']['Indent']) ?>
                        <?= form_hidden('id_product_attribute' . $i, $items['options']['Size']) ?>
                        <?= form_hidden('product_id' . $i, $items['id']) ?>


                        <?php $i++ ?>
                        <?php $qty = $qty + $items['qty'];  ?>

                      <?php endforeach; ?>

                    </ul>
                    <ul class="sub-total">
                    </ul>
                    <ul class="total">
                      <!--total-->
                      <?php if ($this->session->flashdata('isupgradediamond')) {  ?>
                        <li><?= lang('free_upgrade_diamond') ?></li>
                        <input type="hidden" name="isupgradediamond" value="<?= $this->session->flashdata('isupgradediamond') ?>" placeholder="" required>
                      <?php  } ?>

                      <?php if ($this->session->flashdata('val_multiples')) {  ?>
                        <input type="hidden" name="val_multiples" value="<?= $this->session->flashdata('val_multiples') ?>" placeholder="" required>
                      <?php  } ?>


                      <?php if ($this->session->flashdata('typePotongan')) {  ?>
                        <!--count-->
                        <div class="flex justify-between">
                          Sub Total
                          <span class="font-bold">
                            IDR <?= number_format($this->cart->total(), 0, ',', '.'); ?>
                          </span>
                        </div>

                        <div class="text-[12px] text-[#bdbdbd] ">
                          <?= $this->session->flashdata('typePotongan') ?>
                          |
                          <?= $this->session->flashdata('voucherName') ?>
                        </div>

                        <?php
                        if ($this->session->flashdata('totalBelanjaDiskon') <= 0) {
                          $totalBelanjaDiskon = 0;
                        } else {
                          $totalBelanjaDiskon = $this->session->flashdata('totalBelanjaDiskon');
                        }
                        ?>

                        <!--tambahan ebe-->
                        <?php if (!$this->session->flashdata('kode_voucher')) { ?>
                          <div id="biaya_admin" name="biaya_admin" value="<?= ($this->session->userdata('biaya_admin')) ? $this->session->userdata('biaya_admin') * $totalBelanjaDiskon : 0  ?>">
                            <?php if ($this->session->userdata('metode_admin')) { ?>
                              <!--count-->
                              <div class="flex justify-between">
                                Biaya Admin
                                <span class="font-bold">
                                  IDR <?php echo number_format($this->session->userdata('biaya_admin') * $totalBelanjaDiskon, 0, ',', '.') ?>
                                </span>
                              </div>
                            <?php } ?>
                          </div>
                          <div id="jumlah_total"></div>
                        <?php } ?>

                        <div id="div_total">
                          <?php
                          if ($this->session->flashdata('kode_voucher')) {
                            $adm = 0;
                          } else {
                            $adm = ($this->session->userdata('biaya_admin')) ? $this->session->userdata('biaya_admin') * $totalBelanjaDiskon : 0;
                          }
                          ?>
                          <!--end tambahan-->
                          <!--count-->
                          <div class="flex justify-between">
                            Total
                            <span class="font-bold ">
                              IDR <?= number_format($totalBelanjaDiskon + $adm + +$total_ongkir, 0, ',', '.'); ?>
                            </span>
                          </div>

                        </div>
                        <?php if ($this->session->flashdata('kode_voucher')) { ?>
                          <li><small class="text-danger">Pembayaran akan menggunakan saldo deposit</small></li>
                          <input type="hidden" name="total_amount" value="0" placeholder="" required>
                        <?php } else if ($this->session->flashdata('sisa_deposit')) { ?>
                          <li><small class="text-danger">Pembayaran akan menggunakan saldo deposit</small></li>
                          <input type="hidden" name="total_amount" value="<?= $totalBelanjaDiskon + $total_ongkir - $this->session->flashdata('sisa_deposit') ?>" placeholder="" required>
                        <?php } else { ?>
                          <input type="hidden" name="total_amount" value="<?= $totalBelanjaDiskon + $total_ongkir ?>" placeholder="" required>
                        <?php } ?>
                        <?= form_hidden('id_voucher', $this->session->flashdata('id_voucher')) ?>
                      <?php } else {  ?>

                        <input type="hidden" id="nilai_total" value="<?= $this->cart->total() ?>">
                        <div id="biaya_admin" name="biaya_admin" value="<?= ($this->session->userdata('biaya_admin')) ? $this->session->userdata('biaya_admin') * $this->cart->total() : 0  ?>">
                          <?php if ($this->session->userdata('metode_admin')) { ?>
                            <!--count-->
                            <div class="flex justify-between ">
                              <div>
                                Biaya Admin
                              </div>
                              <span class=" font-bold">
                                IDR <?php echo number_format($this->session->userdata('biaya_admin') * $this->cart->total(), 0, ',', '.') ?>
                              </span>
                            </div>
                          <?php } ?>
                        </div>
                        <div id="jumlah_total"></div>

                        <div id="div_total" class="flex justify-between font-bold ">
                          <!--count-->
                          <?php
                          $adm = ($this->session->userdata('biaya_admin'))
                            ? $this->session->userdata('biaya_admin') * $this->cart->total()
                            : 0;
                          ?>
                          <div>
                            TOTAL
                          </div>
                          <div>
                            <span class="">
                              IDR <?= number_format($this->cart->total() + $adm + $total_ongkir, 0, ',', '.'); ?>
                            </span>
                          </div>
                        </div>

                        <input type="hidden" name="biaya_admin" value="<?= $adm  ?>" placeholder="" required>
                        <input type="hidden" name="total_ongkir" value="<?= $total_ongkir  ?>" placeholder="" required>
                        <input type="hidden" name="total_amount" value="<?= $this->cart->total() + $total_ongkir + $adm   ?>" placeholder="" required>


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
                      <div class="text-right">
                        <button type="submit" class="btn-solid btn" onclick="this.form.submit(); this.disabled = true; this.value = 'Submitting the form';">
                          <?= lang('order') ?>
                        </button>
                      </div>
                    <?php } else if (!$cekMember) { ?>
                      <?php if ($this->session->userdata('reseller') == '1') { ?>

                        <?php if (!$this->session->flashdata('typePotongan')) { ?>
                          <?php
                          $items_khusus = "950201094"; //SP 950201169, FP 950201094
                          $item_khusus_exclude_sepatu = explode(",", $items_khusus);

                          $items_khusus_sp = "950201169"; //SP 950201169, FP 950201094
                          $item_khusus_exclude_sepatu_sp = explode(",", $items_khusus_sp);

                          $jika_ada_sp = 0;
                          $sp_disable = "";
                          foreach ($this->cart->contents() as $items) {
                            if (in_array($items['id'], $item_khusus_exclude_sepatu, TRUE)) {
                              $jika_ada_sp = 1;
                              $sp_disable = "disabled";
                            }
                            if (in_array($items['id'], $item_khusus_exclude_sepatu_sp, TRUE)) {
                              $jika_ada_sp = 1;
                              $sp_disable = "";
                            }
                          }
                          ?>
                          <?php if ($jika_ada_sp == 0) { ?>
                            <div class="text-right"><button type="button" class="btn-solid btn" data-toggle="modal" data-target="#exampleModalConfrim"><?= lang('order') ?></button></div>
                          <?php } else { ?>
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
                        <?php } else { ?>
                          <div class="text-right"><button type="submit" class="btn-solid btn" onclick="this.form.submit(); this.disabled = true; this.value = 'Submitting the form';"><?= lang('order') ?></button></div>
                        <?php } ?>
                      <?php } else { ?>
                        <?php if (!$this->session->flashdata('typePotongan')) { ?>
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
                        <?php } else { ?>
                          <div class="text-right"><button type="submit" class="btn-solid btn" onclick="this.form.submit(); this.disabled = true; this.value = 'Submitting the form';"><?= lang('order') ?></button></div>
                        <?php } ?>

                      <?php } ?>
                    <?php } else { ?>
                      <div class="text-right"><button type="submit" class="btn-solid btn" onclick="this.form.submit(); this.disabled = true; this.value = 'Submitting the form';"><?= lang('order') ?></button></div>
                    <?php } ?>
                  </div>
                </div>
                <br>
                <div class="row">
                  <?php if ($this->session->userdata('reseller') != "") { ?>
                    <?php if ($this->ion_auth->user()->row()->sts_reseller == "") { ?>
                      <div class="text-left col-md-12">
                        (<span class="field-label" style="color: red;">*</span>) <small>Isi dengan Username pengundang anda atau Kode Family Package atau Kode Single Package</small>
                      </div>
                    <?php } else { ?>
                      <div class="text-right col-md-12">
                        (<span class="field-label" style="color: red;">*</span>) <small>Yakinkan bahwa ini adalah pembelanjaan pribadi anda</small>
                      </div>
                    <?php } ?>
                  <?php } ?>
                  <div class="col-md-7">
                    <?php if ($this->session->userdata('reseller') == "") { ?>
                      <button type="button" class="btn-solid btn pull-left" data-toggle="modal" data-target="#exampleModalCenter"><?= lang('get_more_discount') ?></button>
                    <?php } ?>

                  </div>
                  <?= form_close() ?>

                  <div class="col-md-5 col-sm-5 col-xs-12">
                    <?= form_open('add/kodevoucher', array("class" => "form_voucher")) ?>
                    <div class="form-group">
                      <!-- <div class="field-label">Kode Voucher </div> -->

                      <input type="hidden" name="kode_voucher" <?php if ($this->session->userdata('refferemail')) { ?> value="<?= $this->session->userdata('refferemail') ?>" <?php } elseif ($this->session->userdata('reselleruser')) {  ?> value="<?= $this->session->userdata('reselleruser') ?>" <?php } ?> id="kode_voucher" placeholder="<?= lang('code_voucher') ?>" required <?= $sp_disable ?>>
                      <?php if ($this->session->userdata('reseller') != "") {
                        $sembunyi = 'hidden';
                      ?>
                        <input type="checkbox" id="clail-redemption" name="clail-redemption" value="0" hidden>
                      <?php } else {
                        $sembunyi = 'hidden'; ?>
                        <input type="checkbox" id="clail-redemption" name="clail-redemption" value="1" <?php if ($this->session->userdata('refferemail')) { ?> checked <?php } ?> hidden>
                      <?php } ?>

                      <?php if ($sembunyi == '') { ?>
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


          <div class="row check-out">

            <?php $refer = $this->db->where(['user_id' => $this->ion_auth->user()->row()->id])->get('users_refer')->row(); ?>
            <?php if ($refer == null) {  ?>
              <?php if ($this->session->userdata('refferemail')) { ?>
                <input type="hidden" name="reffer" value="<?= $this->session->userdata('refferemail') ?>">
                <div class="form-group col-md-12 col-sm-6 col-xs-12" style="display: none !important">
                  <div class="field-label"><?= lang('form_refer') ?></div>
                  <input type="hidden" name="reffer" disabled value="<?= $this->session->userdata('refferemail') ?>" placeholder="">
                </div>
              <?php } else {  ?>
                <div class="form-group col-md-12 col-sm-6 col-xs-12" style="<?= $this->session->userdata('reseller') == '1' ? "display: none !important" : "display: none !important" ?>">
                  <div class="field-label"><?= lang('form_refer') ?></div>
                  <input type="hidden" name="reffer" value="" placeholder="" <?php echo ($this->session->userdata('reseller') != "") ? 'disabled' : ''; ?>>
                </div>

              <?php  } ?>
            <?php } ?>

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
            $tgl_jadi_member = $dt->format('Y-m-d');
          ?>
            <?php foreach ($voucherRefer as $v_voucher_refer) { ?>
              <?php $user_refer = $this->M_refer->get_referuserDiamond()->result(); ?>

              <?php if ($user_refer) { ?>
                <?php $totalByrRefer = 0;
                $totalOrder = 0;
                $totalUser = 0;
                $totalQtyUser = 0;
                $filter1Bulan = 0;
                $filter1Tahun = 0;
                $filter3Bulan = 0;
                ?>
                <?php foreach ($user_refer as $item_user) { ?>

                  <?php $orderItemTotal = $this->M_order->getReferTotalBelanja($item_user->user_refer)->row();
                  $totalByrRefer += $orderItemTotal->total_bayar;
                  if ($item_user->selisih <= 30) {
                    $filter1Bulan++;
                  }
                  if ($item_user->selisih <= 360) {
                    $filter1Tahun++;
                  }
                  if ($item_user->selisih <= 90) {
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
                      <?php if ($m == 2 && $tgl_jadi_member >= '2022-10-18' && $tgl_jadi_member <= '2025-07-09') {
                        if ($filter1Bulan > 1) { ?>
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
                      } else if ($m == 2 && $tgl_jadi_member < '2022-10-18') {
                        if ($filter1Tahun > 1) { ?>
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
                      } else if ($m == 2 && $tgl_jadi_member >= '2025-07-10') {
                        if ($filter3Bulan > 1) { ?>
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
                      } else {
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
    $(".select-ekspedisi-pengiriman").on("change", function() {
      var selectedValues;
      if ($("select").hasClass("select-ekspedisi-pengiriman")) {
        selectedValues = $('.select-ekspedisi-pengiriman').map(function() {
          return this.value
        }).get();
      }
      updateOngkirOnCart(selectedValues);
    });

    function updateOngkirOnCart(data) {
      $(".loadingupdate").show();
      $.ajax({
        url: "<?= base_url('CekOutController/ongkir_on_cart') ?>",
        type: "post",
        data: {
          pengiriman: data,
        },
        success: function(res, status) {
          var result = JSON.parse(res);

        },
        error: function(xhr) {
          $(".loadingupdate").hide();
        },
        complete: function(xhr, status) {
          window.location.reload();
        }
      })
    }

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
      $('.bvoucher').click(function() {
        //alert($(".form2 input[name=first_name]").val());
        $.ajax({
          type: "POST",
          url: "<?= base_url() ?>CekOutController/simpan_user",
          data: 'first_name=' + $(".form2 input[name=first_name]").val() + '&last_name=' + $(".form2 input[name=last_name]").val() + '&phone=' + $(".form2 input[name=phone]").val() + '&email=' + $(".form2 input[name=email]").val() + '&address=' + $(".form2 input[name=address]").val() + '&kode_pos=' + $(".form2 input[name=kode_pos]").val() + '&<?= $this->security->get_csrf_token_name() ?>=' + '<?= $this->security->get_csrf_hash() ?>',
          success: function(response) {

          }
        });
      });

      $(document).ready(function() {
        <?php if ($this->session->userdata('metode_admin')) { ?>
          var selectedValue = <?= $this->session->userdata('metode_admin') ?>;
          $('input[id=<?= $this->session->userdata('metode_admin') ?>]').prop('checked', true);
        <?php } ?>

        $('#metode').change(function() {
          var metode = document.getElementById('metode').value;
          alert(metode);
          var nilai_total = document.getElementById('nilai_total').value;
          jumlah = parseInt(layanan) + parseInt(nilai_total);

          lay = layanan.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');
          jumlah = jumlah.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.');

          document.getElementById('ongkir').innerHTML = '<li>Admin <span class="count">IDR ' + lay + "</span></li>";
          document.getElementById('jumlah_total').innerHTML = '<li>Total <span class="count">IDR ' + jumlah + "</span></li>";
          $('#div_total').addClass('d-none');

        });
      });


    });
  </script>