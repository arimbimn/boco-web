 <style>
   .loader {
     border: 16px solid #f3f3f3;
     /* Light grey */
     border-top: 16px solid #ff4c3b;
     /* Blue */
     border-radius: 50%;
     width: 120px;
     height: 120px;
     animation: spin 2s linear infinite;
   }

   @keyframes spin {
     0% {
       transform: rotate(0deg);
     }

     100% {
       transform: rotate(360deg);
     }
   }
 </style>


 <!-- breadcrumb start -->
 <div class="breadcrumb-section">
   <div class="container">
     <div class="row">
       <div class="col-sm-6">
         <div class="page-title">
           <h2 class=" !font-bold"><?= lang('title_produk') ?></h2>
         </div>
       </div>
       <div class="col-sm-6">
         <nav aria-label="breadcrumb" class="theme-breadcrumb">
           <ol class="breadcrumb">
             <li class="breadcrumb-item"><a href="<?= base_url('/') ?>"><?= lang('beranda') ?></a></li>
             <li class="breadcrumb-item"><a href="<?= base_url('/product') ?>"><?= lang('title_produk') ?></a></li>
           </ol>
         </nav>
       </div>
     </div>
   </div>
 </div>
 <!-- breadcrumb end -->


 <!-- section start -->
 <section class="section-b-space ratio_asos">
   <div class="collection-wrapper">
     <div class="container">
       <div class="row">
         <div class="col-xl-12">
           <div class="filter-main-btn"><span class="filter-btn btn btn-theme"><i class="fa fa-filter" aria-hidden="true"></i> Filter</span></div>
         </div>
       </div>
       <div class="row">

         <div class="col-sm-3 collection-filter " id="divfilter">
           <!-- side-bar colleps block stat -->
           <div class="collection-filter-block rounded-md">
             <!-- brand filter start -->
             <div class="collection-mobile-back"><span class="filter-back !capitalize"><i class="fa fa-angle-left" aria-hidden="true"></i> back</span></div>
             <div class="collection-collapse-block open">
               <br>
               <input type="text" name='search' class="form-control search mt-1 p-1 border border-gray-300 rounded-md w-full focus:outline-none focus:ring focus:ring-[#cd212a] outline-0 text-center" placeholder="Search" <?php if (!empty($keyword)) { ?>value="<?= $keyword ?>" <?php } ?>>
               <br>
               <button id='button_search' class="btn btn-outline-danger hover: outline-[#cd212a] py-1 text-[8] capitalize rounded-md">Search</button>

               <h3 class="collapse-block-title !capitalize"><?= lang('kategory_produk') ?></h3>
               <div class="collection-collapse-block-content">
                 <div class="collection-brand-filter">
                   <?php
                    foreach ($category_products as $category) {


                      $category_slug = str_replace(" ", '-', strtolower($category->nama_kategori));

                      $skip = [",", '.', '+', '/', "$", '#', '!', '(', ')', '~', '`', '@', '^', '*', '=', '_', '{', '}', '[', ']', '"', '<', '>', '?', '&', "'"];

                      foreach ($skip as $s) {

                        $category_slug = str_replace($s, '', $category_slug);
                      }


                    ?>
                     <div class="custom-control custom-checkbox collection-filter-checkbox">
                       <input type="checkbox" class="custom-control-input filter category parent_<?= $category_slug ?>" name="category_id" id="<?= $category_slug ?>" value="<?= $category->id_product_kategori ?>" <?php if (!empty($kategori)) {
                                                                                                                                                                                                                      if ($kategori == $category->id_product_kategori) {
                                                                                                                                                                                                                        echo " checked";
                                                                                                                                                                                                                      }
                                                                                                                                                                                                                    } ?>>
                       <label class="custom-control-label" for="<?= $category_slug ?>"><?= $category->nama_kategori ?></label>
                       <?php
                        $cek_subcategory = $this->db->where('kategori_id', $category->id_product_kategori)->where(['is_active' => 1])->order_by('subcategory_order', 'ASC')->get('product_subkategori')->result();

                        if (!empty($cek_subcategory)) {

                          foreach ($cek_subcategory as $sub) {
                            $subcategory_slug = str_replace(" ", '-', strtolower($sub->nama_subkategori));


                            foreach ($skip as $l) {

                              $subcategory_slug = str_replace($l, '', $subcategory_slug);
                            }


                            $subcategory_slug = $category_slug . "-" . $subcategory_slug;


                        ?>

                           <div class="custom-control custom-checkbox collection-filter-checkbox">
                             <input type="checkbox" class="custom-control-input filter subcategory child_<?= $category_slug ?>" name="subcategory_id" id="<?= $subcategory_slug ?>" value="<?= $sub->id ?>" <?php if (!empty($subkategori)) {
                                                                                                                                                                                                              if ($subkategori == $sub->id) {
                                                                                                                                                                                                                echo " checked";
                                                                                                                                                                                                              }
                                                                                                                                                                                                            } ?> <?php if (!empty($kategori)) {
                                                                                                                                                                                                                    if ($kategori == $category->id_product_kategori) {
                                                                                                                                                                                                                      echo " checked";
                                                                                                                                                                                                                    }
                                                                                                                                                                                                                  } ?>>
                             <label class="custom-control-label" for="<?= $subcategory_slug ?>"><?= $sub->nama_subkategori ?></label>
                           </div>

                       <?php }
                        } ?>

                     </div>
                   <?php } ?>



                   <!-- <div class="custom-control custom-checkbox collection-filter-checkbox">
                    <input type="checkbox" class="custom-control-input" id="vera-moda">
                    <label class="custom-control-label" for="vera-moda">vera-moda</label>
                  </div> -->
                 </div>
               </div>
             </div>
             <!-- color filter start here -->
             <!-- <div class="collection-collapse-block open">
              <h3 class="collapse-block-title">colors</h3>
              <div class="collection-collapse-block-content">
                <div class="color-selector">
                  <ul>
                    <li class="color-1 active"></li>
                    <li class="color-2"></li>
                    <li class="color-3"></li>
                    <li class="color-4"></li>
                    <li class="color-5"></li>
                    <li class="color-6"></li>
                    <li class="color-7"></li>
                  </ul>
                </div>
              </div>
            </div> -->
             <!-- size filter start here -->
             <div class="collection-collapse-block border-0 open">
               <h3 class="collapse-block-title"><?= lang('size_produk') ?></h3>
               <div class="collection-collapse-block-content" style="display: none;">
                 <div class="collection-brand-filter">
                   <?php foreach ($size as $itemsize) {
                      if (strpos($itemsize->size, ',') == false && strpos($itemsize->size, '.') == false && strpos($itemsize->size, 'T') == false) {
                    ?>
                       <div class="custom-control custom-checkbox collection-filter-checkbox">
                         <input type="checkbox" class="custom-control-input filter size font-thin font-sans capitalize font-[12]  py-1" name="size" id="size_<?= $itemsize->size ?>" value="<?= $itemsize->size ?>">
                         <label class="custom-control-label" for="size_<?= $itemsize->size ?>"><?= $itemsize->size ?></label>
                       </div>
                   <?php }
                    } ?>
                   <!-- <div class="custom-control custom-checkbox collection-filter-checkbox">
                     <input type="checkbox" class="custom-control-input filter size" name="size" id="size_two" value="39">
                     <label class="custom-control-label" for="size_two">39</label>
                   </div>
                   <div class="custom-control custom-checkbox collection-filter-checkbox">
                     <input type="checkbox" class="custom-control-input filter size" name="size" id="size_three" value="40">
                     <label class="custom-control-label" for="size_three">40</label>
                   </div>
                   <div class="custom-control custom-checkbox collection-filter-checkbox">
                     <input type="checkbox" class="custom-control-input filter size" name="size" id="size_four" value="41">
                     <label class="custom-control-label" for="size_four">41</label>
                   </div>
                   <div class="custom-control custom-checkbox collection-filter-checkbox">
                     <input type="checkbox" class="custom-control-input filter size" name="size" id="size_five" value="42">
                     <label class="custom-control-label" for="size_five">42</label>
                   </div>
                   <div class="custom-control custom-checkbox collection-filter-checkbox">
                     <input type="checkbox" class="custom-control-input filter size" name="size" id="size_six" value="43">
                     <label class="custom-control-label" for="size_six">43</label>
                   </div> -->


                 </div>
               </div>
             </div>
             <!-- price filter start here -->
             <div class="collection-collapse-block border-0 open">
               <h3 class="collapse-block-title"><?= lang('price_produk') ?></h3>
               <div class="collection-collapse-block-content">
                 <div class="wrapper mt-3">
                   <div class="range-slider">
                     <!-- <input type="text" class="js-range-slider filter price" value="" /> -->

                     <input type="number" class="js-input-from filter input_from mt-1 p-1 border border-gray-300 rounded-md w-full focus: outline-[#cd212a] text-center" placeholder="Min">
                     <p class=" text-center font-bold text-lg"> - </p>
                     <input type="number" class="js-input-to filter input_to mt-1 p-1 border border-gray-300 rounded-md w-full focus: outline-[#cd212a] text-center" placeholder="Max">
                   </div>
                 </div>
               </div>
             </div>
           </div>
           <!-- silde-bar colleps block end here -->
           <!-- side-bar single product slider start -->
           <div class="theme-card">
             <h5 class="title-border"><?= lang('new_products_home') ?></h5>
             <div class="offer-slider slide-1">
               <?php foreach (array_chunk($new_products, 4) as $new_even) { ?>
                 <div>
                   <?php foreach ($new_even as $item) { ?>
                     <div class="media">
                       <a href="<?= base_url('product/detail/' . $item->id_product) ?>">
                         <img class="img-fluid blur-up lazyload" src="<?= smn_baseurl() ?>/uploads/product/<?= $item->image_one ?>" alt=""></a>
                       <div class="media-body align-self-center">
                         <div class="rating three-star">
                           <?php
                            $even_rating = $this->db->select('AVG(rating) as avg_rating')->where('product_id', $item->id_product)->get('product_reviews')->row()->avg_rating;
                            for ($usrating = 1; $usrating <= 5; $usrating++) { ?>
                             <i class="fa fa-star <?php if ($usrating <= $even_rating) {
                                                    echo "active";
                                                  } ?>"></i>
                           <?php } ?>
                         </div>
                         <a href="<?= base_url('product/detail/' . $item->id_product) ?>">
                           <h6><?= $item->nama_barang ?></h6>
                         </a>
                         <h4>Rp <?= number_format($item->harga, 0) ?></h4>
                       </div>
                     </div>
                   <?php } ?>
                 </div>
               <?php } ?>
             </div>
           </div>
           <!-- side-bar single product slider end -->
           <!-- side-bar banner start here -->
           <div class="collection-sidebar-banner" style="display: none;">
             <a href="#"><img src="<?= base_url() ?>/assets/images/side-banner.png" class="img-fluid blur-up lazyload" alt=""></a>
           </div>
           <!-- side-bar banner end here -->
         </div>




         <div class="collection-content col" id="jangan-tampil">
           <div class="page-main-content">
             <div class="row">
               <div class="col-sm-12">

                 <div class="collection-product-wrapper">

                   <div class="product-wrapper-grid">
                     <div class="row margin-res" id="tampilkan">
                     </div>
                   </div>

                   <div class="product-pagination">
                     <div class="theme-paggination-block">
                       <div class="row">
                         <div class="col-xl-6 col-md-6 col-sm-12" id='pagination'>

                           <!--<!--?php echo $this->pagination->create_links(); ?>-->
                         </div>
                         <div class="col-xl-6 col-md-6 col-sm-12">
                           <div class="product-search-count-bottom" id='totalData'>
                             <!--<h5>Total Product <!--?= $totalData ?></h5>-->
                           </div>
                         </div>
                       </div>
                     </div>
                   </div>
                   <!-- </div> -->
                 </div>
               </div>
             </div>
           </div>
         </div>


         <div class="collection-content col" id="tampilkan_loading" style="display:none;" align="center">
           <div class="page-main-content">
             <div class="loader"></div>
           </div>
         </div>




       </div>
     </div>
 </section>
 <!-- section End -->


 <!-- trial section start -->

 <section class="discount-badge-trial">
   <div class=" container pt-4 pb-4 bg-[#f4f2f2]">
     <div class="row">
       <div class="col-12">
         ini trial discount badge
         <div class="row">
           <div class="col-12">
             <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
               <div class="col border p-2 group">
                 <span class="absolute text-white ml-1 mt-1 px-2 py-1 bg-[#cd212a] rounded-md">
                   <!-- <div class="px-1" style="font-weight: bold; text-align: center; font-size: xx-small;"> Mega</div>
                   <div class="bg-white rounded text-red-500 px-1 mr-0" style="color: red; text-align: center; font-weight: bold; font-size: xx-small;">Sale</div> -->
                   <div class="px-1 font-bold text-xs"> 20% off</div>
                 </span>
                 <img src="https://via.placeholder.com/300" alt="Gambar 1" class="mb-4 !w-full">
                 <h3 class=" font-bold text-black text-center text-sm py-1">D. FIRENZE 14 NERO</h3>
                 <p class=" text-red-500 text-xs text-center">
                   <span class="line-through text-[grey]">IDR 4,990,000 </span>
                   <span class="">20%</span>
                 </p>
                 <p class=" text-black text-center py-2">
                   IDR 3,992,000
                 </p>
               </div>
               <div class="col border p-2 group">
                 <span class="absolute px-0 py-0">
                   <img src="assets/diskon-label.png" alt="discount label" class="ml-1 w-8">
                 </span>
                 <img src="https://via.placeholder.com/300" alt="Gambar 2" class="mb-4 w-full">
                 <h3 class=" font-bold text-black text-center text-sm py-1">D. TORINO 03 NERO SCURO</h3>
                 <p class=" text-red-500 text-xs text-center">
                   <span class="line-through text-[grey]">IDR 3,990,000 </span>
                   <span class="">70%</span>
                 </p>
                 <p class=" text-black text-center py-2">
                   IDR 1,197,000
                 </p>
               </div>
               <div class="col border p-2 group">
                 <img src="https://via.placeholder.com/300" alt="Gambar 3" class="mb-4 w-full">
                 <p class="text-center">Deskripsi Gambar 3</p>
               </div>
               <div class="col border p-2 group">
                 <img src="https://via.placeholder.com/300" alt="Gambar 4" class="mb-4 w-full">
                 <p class="text-center">Deskripsi Gambar 1</p>
               </div>
             </div>
           </div>
         </div>
       </div>
     </div>
   </div>
 </section>
 <!-- trial section end -->



 <script>
   $(document).ready(function() {



     filter_data(1);



     function filter_data(page) {
       var category = get_filter('category');

       console.log(category);

       var subcategory = get_filter('subcategory');

       console.log(subcategory);



       var size = get_filter('size');

       var from_price = $(".input_from").val();

       var to_price = $(".input_to").val();

       var keyword = $(".search").val();

       $("#jangan-tampil").css("display", "none");

       $("#tampilkan_loading").css("display", "");




       $.ajax({
         type: "POST",
         url: "<?= base_url() ?>product/kategori/" + page,
         data: 'category=' + category + '&subcategory=' + subcategory + '&size=' + size + '&from_price=' + from_price + '&to_price=' + to_price + '&keyword=' + keyword + '&<?= $this->security->get_csrf_token_name() ?>=' + '<?= $this->security->get_csrf_hash() ?>',
         cache: false,
         success: function(response) {

           var data = JSON.parse(response);


           $("#tampilkan").html(data.product_list);
           $("#pagination").html(data.pagination_link);
           $("#totalData").html('<h5>Total Product ' + data.total_data + ' </h5>');

           $("#tampilkan_loading").css("display", "none");

           $("#jangan-tampil").css("display", "");

         }

       });

       var isMobileVersion = ".collection-mobile-back";
       if ($(isMobileVersion).is(":visible")) {
         mydivfilter(); //tambah ebe buat geser div filter
         //alert("The paragraph  is visible.");
       } else {
         //alert("The paragraph  is hidden.");
       }
     }

     function get_filter(class_name) {
       var filter = [];
       $('.' + class_name + ':checked').each(function() {
         filter.push($(this).val());
       });
       return filter;
     }

     $(document).on('click', '.pagination li a', function(event) {
       event.preventDefault();
       var page = $(this).data('ci-pagination-page');
       filter_data(page);
     });



     $(document).on('click', '.category', function() {

       var value_id = $(this).attr("id");

       console.log(value_id);

       var clas_id = $(this).attr("class");


       if ($(this).prop('checked') == true) {

         console.log("checked");

         get_child(value_id, 'checked');
         /*get_parent(clas_id, 'checked');*/
       } else {

         console.log("tidak");
         get_child(value_id, 'unchecked');
         get_parent(clas_id, 'unchecked');
       }

       filter_data(1);
     })

     $(document).on('click', '.subcategory', function() {

       var value_id = $(this).attr("id");

       var clas_id = $(this).attr("class");

       console.log(clas_id);

       if ($(this).prop('checked') == true) {
         get_child(value_id, 'checked');
         get_parent(clas_id, 'checked');
       } else {
         get_child(value_id, 'unchecked');
         get_parent(clas_id, 'unchecked');
       }

       //filter_data(1);
     })

     $(document).on('click', '#button_search', function() {
       filter_data(1);
     })

     $(document).on('click', '.size', function() {
       //filter_data(1);
     })

     $(document).on('mouseup', '.from', function() {
       setTimeout(function() {
         filter_data(1);
       }, 1000);
     })
     $(document).on('mouseup', '.to', function() {
       setTimeout(function() {
         filter_data(1);
       }, 1000);
     })


     function get_parent(clas_name, status) {


       var res_clas = clas_name.split(" ");

       var parentnya = res_clas[3];

       console.log(parentnya);



       var pecah_parent = parentnya.split("_");

       var parent_id = pecah_parent[1];

       console.log(parent_id);

       var idx = 0;

       var panjang = 0;
       $(".child_" + parent_id).each(function() {
         panjang = panjang + 1;

         if ($(this).prop('checked') == true) {

           idx = idx + 1;

         }

       });




       if (panjang > 0) {



         if (status == 'checked') {
           if (idx == panjang) {

             $(".parent_" + parent_id).each(function() {
               $(".parent_" + parent_id).prop('checked', true);


             })


           } else {

             $(".parent_" + parent_id).each(function() {
               $(this).prop('checked', false);

             })
           }
         } else {

           $(".parent_" + parent_id).each(function() {
             $(this).prop('checked', false);

           })
         }

       }


     }




     function get_child(val_id, status) {

       $(".child_" + val_id).each(function() {
         if (status == 'checked') {
           $(this).prop('checked', true);
         } else {
           $(this).prop('checked', false);
         }

       })

     }

     function mydivfilter() {
       var x = document.getElementById("divfilter");
       x.style.left = "-365px";
       /*if (x.style.left === "none") {
         x.style.display = "block";
       } else {
         x.style.display = "none";
       }*/
     }
   });
 </script>