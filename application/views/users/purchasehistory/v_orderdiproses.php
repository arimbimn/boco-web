   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
   <script type='text/javascript' src='<?= base_url() ?>assets/js/sweetalert2.min.js'></script>
   <link rel="stylesheet" type="text/css" href="<?= base_url('/assets/css/sweetalert2.min.css') ?>">
   <!-- breadcrumb start -->
   <div class="breadcrumb-section">
     <div class="container">
       <div class="row">
         <div class="col-sm-6">
           <div class="page-title">
             <h2>Purchase history</h2>
           </div>
         </div>
         <div class="col-sm-6">
           <nav aria-label="breadcrumb" class="theme-breadcrumb">
             <ol class="breadcrumb">
               <li class="breadcrumb-item"><a href="<?= base_url('/') ?>"><?= lang('beranda') ?></a></li>
               <li class="breadcrumb-item"><a href="<?= base_url('/users') ?>"><?= lang('my_account') ?></a></li>
               <li class="breadcrumb-item active" aria-current="page"><?= lang('purchase_user') ?></li>
             </ol>
           </nav>
         </div>
       </div>
     </div>
   </div>
   <!-- breadcrumb End -->




   <!-- section start -->
   <section class="section-b-space bg-white">
     <div class="container">
       <div class="row">
         <div class="col-lg-3">
           <div class="account-sidebar w-50 rounded-full font-normal bg-[#cd212a] capitalize text-white text-center !text-xs"><a class="popup-btn"> <i class="fa fa-bars"></i> <?= lang('MyAccount') ?></a></div>
           <div class="dashboard-left  rounded-md bg-white">
             <div class="collection-mobile-back"><span class="filter-back"><i class="fa fa-angle-left" aria-hidden="true"></i><?= lang('back') ?></span></div>
             <div class="block-content rounded-md">
               <?php $this->load->view('users/v_menu_user') ?>
             </div>
           </div>
         </div>
         <div class="col-lg-9">
           <div class="dashboard-right">
             <div class="dashboard bg-white rounded-md">
               <!-- product-tab starts -->
               <section class="tab-product m-0">
                 <div class="container">
                   <div class="row">
                     <div class="col-sm-12 col-lg-12">
                       <?php $this->load->view('users/purchasehistory/v_submenu') ?>
                       <div class="tab-content nav-material" id="top-tabContent">
                         <div class="tab-pane fade show active" id="top-home" role="tabpanel" aria-labelledby="top-home-tab">
                           <br>
                           <?php if ($order_proses) { ?>
                             <div class="table-responsive">
                               <table class="table cart-table table-responsive-xs">
                                 <thead>
                                   <tr class="table-head">
                                     <th scope="col"><?= lang('order_id') ?></th>
                                     <th scope="col"><?= lang('price_produk') ?></th>
                                     <th scope="col"><?= lang('purchase_statuspayment_user') ?></th>
                                     <th scope="col"><?= lang('detail') ?></th>
                                   </tr>
                                 </thead>
                                 <tbody>
                                   <?php foreach ($order_proses as $item_order) { ?>
                                     <tr>
                                       <td> <?= $item_order->kode_order ?>
                                       </td>
                                       <td>IDR <?= number_format($item_order->total_bayar, 0, ',', '.')  ?>
                                       </td>
                                       <td><?= $item_order->status_bayar ?>
                                       </td>
                                       <td>
                                         <!--a href="<!?= base_url('order/detail/' . $item_order->id_order) ?>" class="btn btn-solid" id="mc-submit"><!?= lang('detail') ?></a-->
                                         <?php if ($item_order->id_xendit != '') { ?>
                                           <a href="<?= base_url('order/detail/' . $item_order->id_order) ?>" class="btn btn-danger" id="mc-submit"><?= lang('detail') ?></a>
                                         <?php } ?>

                                         <?php if ($item_order->status_bayar == 'PENDING') { ?>
                                           <a href="#" class="btn btn-warning" onclick="batalorder(<?= $item_order->id_order ?>)">Cancel</a>
                                         <?php } ?>
                                       </td>
                                     <?php } ?>
                                     </tr>
                                 </tbody>

                               </table>
                             </div>
                           <?php } else { ?>
                             <?= lang('tidak_adadata') ?>
                           <?php } ?>



                         </div>
                       </div>
                     </div>
                   </div>
                 </div>
               </section>
               <!-- product-tab ends -->
             </div>
           </div>
         </div>
       </div>
     </div>
   </section>
   <!-- section end -->
   <script type="text/javascript">
     function batalorder(id) {
       Swal.fire({
         title: 'Apa kamu yakin membatalkan orderan ini?',
         text: "Anda tidak akan dapat memproses orderan ini lagi!",
         icon: 'warning',
         showCancelButton: true,
         confirmButtonColor: '#3085d6',
         cancelButtonColor: '#d33',
         confirmButtonText: 'Yes'
       }).then((result) => {
         if (result.isConfirmed) {
           /*Swal.fire(
             'Deleted!',
             'Your file has been deleted.',
             'success'
           )*/
           $.ajax({
             url: '<?php echo base_url() ?>PurchasehistoryController/orderUpdateBatal/' + id,
             type: 'DELETE',
             error: function() {
               alert('Something is wrong');
             },
             success: function(data) {
               //swal("Canceled!", "Orderan anda sudah dibatalkan.", "success");
               window.location.href = '<?php echo base_url() ?>users/purchasebatal';
             }
           });
         }
       });
     }
   </script>