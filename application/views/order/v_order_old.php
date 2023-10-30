   <!-- thank-you section start -->
   <section class="section-b-space light-layout">
     <div class="container">
       <div class="row">
         <div class="col-md-12">
           <div class="success-text"><i class="fa fa-check-circle" aria-hidden="true"></i>
             <h2><?= lang('thank_you_order') ?></h2>
             <p><?= lang('invoice_order') ?> : <?= $order['kode_order'] ?></p>
             <p><?= lang('payment_status') ?> : <?= $order['status_bayar'] ?> || <?= lang('order_status') ?> : <?= $order['status_order'] ?></p>
             <p><?= lang('desc_order') ?>
               <?php if ($order['status_bayar'] == 'PENDING') { ?>
                 <?= lang('pay_now') ?>
               <?php } ?>
             </p>
           </div>
         </div>
       </div>
     </div>
   </section>
   <!-- Section ends -->




   <!-- order-detail section start -->
   <section class="section-b-space">
     <div class="container">
       <div class="row">
         <div class="col-lg-6">
           <div class="row order-success-sec">
             <div class="col-sm-6">
               <h4><?= lang('summary_order') ?></h4>
               <ul class="order-detail">
                 <li>order ID: <?= $order['kode_order'] ?></li>
				 <li>Username: <?= $order['nama_lengkap'].' ('.$order['username'].')' ?></li>
                 <li><?= lang('date_order') ?>: <?= date('d F Y', strtotime($order['created_at'])) ?></li>
                 <li><?= lang('total_order') ?>: IDR <?= number_format($order['total_bayar'], 0, ',', '.')  ?></li>
                 <?php if ($order['status_bayar'] == 'PENDING') { ?>
                   <li><?= lang('expired_order') ?>: <?= date('d F Y H:i', strtotime($order['expiry_date'])) ?></li>
                 <?php } ?>
               </ul>
             </div>
             <div class="col-sm-6">
               <h4><?= lang('shipping_order') ?></h4>
               <ul class="order-detail">
				 <li>Order name: <?= $order['nama_order'] ?></li>
                 <li><?= $order['alaman_order'] ?></li>
                 <li><?= lang('postal_code_order') ?> : <?= $order['kode_pos'] ?></li>
               </ul>
             </div>
             <div class="col-sm-12 payment-mode">
               <h4><?= lang('payment_method_order') ?></h4>
             </div>
             <?php if ($order['status_order'] != 'BATAL' || $order['total_bayar'] != 0) {  ?>

               <div class="col-md-12">
                 <div class="delivery-sec">
                   <iframe id="inlineFrameExample" title="Inline Frame Example" width="100%" height="600" src="<?= $order['invoice_url'] ?>"></iframe>
                 </div>
               </div>
             <?php  } ?>

           </div>
         </div>
         <div class="col-lg-6">
           <div class="product-order">
             <h3>order details</h3>

             <div class="table-responsive">
               <table class="table cart-table table-responsive-xs">
                 <thead>
                   <tr class="table-head">
                     <th scope="col">Image</th>
                     <th scope="col"><?= lang('product_name_produk') ?></th>
                     <th scope="col"><?= lang('quantity_produk') ?></th>
                     <th scope="col"><?= lang('kode_barang_order') ?></th>
                     <th scope="col"><?= lang('price_produk') ?></th>
                   </tr>
                 </thead>
                 <?php if ($item_order) { ?>
                   <tbody>
                     <?php foreach ($item_order as $v_item) { ?>
                       <?php $cekSize = $this->db->where(['id_product_attribute' => $v_item->id_product_attribute])->get('product_attribute')->row(); ?>

                       <tr>
                         <td>
                           <img src="<?= smn_baseurl() ?>uploads/product/<?= $v_item->image_one ?>" alt="" class="blur-up lazyload" width="100px">

                         </td>
                         <td>
                           <?php if ($order['status_order'] == 'SELESAI') { ?>
                             <a href="<?= base_url('/product/detail/') . $v_item->product_id ?>">Review Product</a>
                           <?php } ?>
                           <h5><?= $v_item->nama_barang ?></h5>
                           <p><?php if ($cekSize) { ?>
                               <?= lang('product_size') ?> : <?= $cekSize->size ?>
                               <?= lang('product_color') ?> : <?= $v_item->colour ?>
                               <?php if ($v_item->is_indent == 1) { ?>
                                 <span style="color:red;">Item Indent</span>
                               <?php } ?>
                             <?php } ?>
                           </p>
                         </td>
                         <td>
                           <?= $v_item->qty ?>
                           <p>Price Item <?= number_format($v_item->harga, 0, ',', '.') ?></p>
                         </td>
                         <td>
                           <?= $v_item->barcode ?>
                         </td>
                         <td>
                           IDR <?= number_format($v_item->sub_total, 0, ',', '.')  ?> <br>
                           <?= lang('discount') ?> : <?= $v_item->diskon ?> %
                         </td>
                       </tr>
                     <?php } ?>
                   </tbody>
                 <?php } ?>
               </table>
             </div>

             <div class="total-sec">
               <?php $cekVoucher = $this->db->where(['order_id' => $order['id_order']])->join('voucher', 'voucher.id_voucher = voucher_used.voucher_id')->get('voucher_used')->row();
                //  var_dump($cekVoucher);
                ?>
               <?php if ($cekVoucher) {  ?>
                 Menggunakan Voucher : <?= $cekVoucher->nama_voucher ?> ,
                 <?php if ($cekVoucher->type == 1) {
                    echo "$cekVoucher->jumlah (%) Diskon";
                  } else if ($cekVoucher->type == 2) {
                    echo " $cekVoucher->jumlah Potongan Harga";
                  } else if ($cekVoucher->type == 3) {
                    echo 'Free Item';
                  } ?>

               <?php } ?>
               <h5>Sub Total <span> IDR <?= number_format($order['subtotal'], 0, ',', '.')  ?> ( Include Ppn )</span></h5>
               <h5>Discount <span> IDR <?= number_format($order['diskon_voucher'], 0, ',', '.')  ?></span></h5>
               <?php if($order['kode_voucher'] == 120){ ?>
                    <h5>Total <span> IDR <?= number_format($order['subtotal']-$order['diskon_voucher'], 0, ',', '.')  ?></span></h5>
                    <p><small class="text-danger">Pembayaran menggunakan saldo Family Package</small></p>
                    <h5>Voucher Family Package <span> IDR <?= ($order['total_bayar'] == 0) ? number_format($order['subtotal']-$order['diskon_voucher'], 0, ',', '.') : number_format(($order['subtotal']-$order['diskon_voucher'])-$order['total_bayar'], 0, ',', '.')  ?></span></h5>
               <?php } ?>
             </div>
             <div class="final-total">

               <h3>total <span> IDR <?= number_format($order['total_bayar'], 0, ',', '.')  ?></span></h3>
             </div>

             <?php $selecetDikirim = $this->db->where(['order_id' => $order['id_order']])->where(['status_order' => 'DIKIRIM'])->get('order_status')->row() ?>

             <?php if ($selecetDikirim) { ?>
               <ul>

                 <li> <?= lang('shipping_service') ?> : <?= $selecetDikirim->pengiriman_via ?> </li> <br>
                 <li> <?= lang('resi_number') ?> : <?= $selecetDikirim->resi_pengiriman ?> </li>

               </ul>
             <?php } ?>

           </div>
         </div>

       </div>
     </div>
   </section>
   <!-- Section ends -->