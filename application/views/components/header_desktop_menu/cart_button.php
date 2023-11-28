 <!-- Cart Button -->
 <div class="relative inline-block text-left group">
     <!-- barang -->
     <?php
        $keranjang = $this->cart->contents();
        $jml_item = count($keranjang);

        $is_minimum_items = $jml_item > 0 ? true : false;
        ?>

     <div class="relative">
         <button type="button" class="inline-flex justify-center items-center p-2 hover:bg-gray-300 rounded-md <?php echo $is_minimum_items ? "fill-[red]" : "" ?>">
             <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" class="bi bi-bag" viewBox="0 0 16 16">
                 <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z" />
             </svg>
         </button>

         <?php if ($is_minimum_items) : ?>
             <div>
                 <div class="bg-[red] w-[10px] aspect-square absolute top-0 right-0 rounded-full">
                 </div>
             </div>
         <?php endif ?>
     </div>

     <div class="hidden absolute right-0 z-50 group-hover:block">
         <div class="mt-2 space-y-2 bg-white shadow-lg rounded-md">
             <div class="flex flex-col gap-3 w-[300px] p-3">

                 <?php if ($keranjang) { ?>
                     <?php foreach ($keranjang as $item_keranjang) { ?>
                         <?php $barang = $this->M_product->get_detailproduct($item_keranjang['id']) ?>
                         <div class="flex gap-3">
                             <div class="aspect-square w-[50px] relative rounded-md shadow-md overflow-hidden border-2 border-[grey]">
                                 <img class="w-full h-full absolute object-cover" src="<?= smn_baseurl() ?>uploads/product/<?= $barang->image_one ?>">
                             </div>
                             <div class="flex items-center">
                                 <div class="">
                                     <div class="font-bold"><?= $item_keranjang['name'] ?></div>
                                     <div class="text-[12px] text-[#c1c1c1]">
                                         <span><?= $item_keranjang['qty'] ?> x IDR <?= number_format($item_keranjang['price'], 2, ',', '.') ?> </span>
                                     </div>
                                 </div>
                             </div>
                             <!-- <div class="close-circle"><a href="#"><i class="fa fa-times" aria-hidden="true"></i></a></div> -->
                         </div>
                     <?php } ?>
                 <?php } else { ?>
                     <div class="font-bold">
                         <?= lang('cek_keranjang_nav') ?>
                     </div>
                 <?php } ?>

                 <div class="font-bold mt-3">
                     <h5>
                         <?= lang('sub_total_nav') ?> : <span>
                             IDR <?php echo $this->cart->format_number($this->cart->total()); ?></span>
                     </h5>
                 </div>

                 <hr class="border-t-2 border-[#d0d0d0] my-3">

                 <div class="mt-3 flex justify-end">
                     <a href="<?= base_url('cart') ?>" class="view-cart">
                         <button class="btn btn-solid">
                             <?= lang('cart_nav') ?>
                         </button>
                     </a>
                 </div>

             </div>
         </div>
     </div>
 </div>