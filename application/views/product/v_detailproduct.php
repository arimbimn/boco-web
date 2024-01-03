  <style>
    .radio-voucher:after {
      content: "VCR";
      position: absolute;
      width: 70px;
    }
  </style>
  <!-- breadcrumb start -->
  <div class="breadcrumb-section">
    <div class="container">
      <div class="row">
        <div class="col-sm-6">
          <div class="page-title">
            <h2><?= lang('title_produk') ?></h2>
          </div>
        </div>
        <div class="col-sm-6">
          <nav aria-label="breadcrumb" class="theme-breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?= base_url('/') ?>"><?= lang('beranda') ?></a></li>
              <li class="breadcrumb-item"><a href="<?= base_url('/product?all=1') ?>"><?= lang('title_produk') ?></a></li>
              <li class="breadcrumb-item active" aria-current="page">detail <?= $detail_product->nama_barang  ?> </li>
            </ol>
          </nav>
        </div>
      </div>
    </div>
  </div>
  <!-- breadcrumb End -->

  <!-- section start -->
  <section class="section-b-space bg-white">
    <div class="collection-wrapper">
      <div class="container">
        <div class="row">
          <div class="col-lg-12 col-sm-12 col-xs-12">
            <div class="container-fluid">
              <div class="row">
                <div class="col-xl-12">
                  <!-- <div class="filter-main-btn mb-2"><span class="filter-btn"><i class="fa fa-filter" aria-hidden="true"></i> filter</span></div> -->
                </div>
              </div>
              <div class="row">
                <div class="col-lg-8">
                  <div class="product-slick">
                    <div>
                      <img class="zoom-img img-fluid blur-up lazyload image_zoom_cls-0 aspect-square rounded-lg object-cover" src="<?= smn_baseurl() ?>uploads/product/<?= $detail_product->image_one ?>" data-zoom-image="<?= smn_baseurl() ?>uploads/product/<?= $detail_product->image_one ?>" width="500" />
                    </div>
                    <div>
                      <img class="zoom-img img-fluid blur-up lazyload image_zoom_cls-1 aspect-square rounded-lg object-cover" src="<?= smn_baseurl() ?>uploads/product/<?= $detail_product->image_two ?>" data-zoom-image="<?= smn_baseurl() ?>uploads/product/<?= $detail_product->image_two ?>" width="500" />
                    </div>
                    <div>
                      <img class="zoom-img img-fluid blur-up lazyload image_zoom_cls-2 aspect-square rounded-lg object-cover" src="<?= smn_baseurl() ?>uploads/product/<?= $detail_product->image_three ?>" data-zoom-image="<?= smn_baseurl() ?>uploads/product/<?= $detail_product->image_three ?>" width="500" />
                    </div>
                    <?php if ($detail_product->image_four) { ?>
                      <div>
                        <img class="zoom-img img-fluid blur-up lazyload image_zoom_cls-3 aspect-square rounded-lg object-cover" src="<?= smn_baseurl() ?>uploads/product/<?= $detail_product->image_four ?>" data-zoom-image="<?= smn_baseurl() ?>uploads/product/<?= $detail_product->image_four ?>" width="500" />
                      </div>
                    <?php } ?>
                    <?php if ($detail_product->image_five) { ?>
                      <div>
                        <img class="zoom-img img-fluid blur-up lazyload image_zoom_cls-4 aspect-square rounded-lg object-cover" src="<?= smn_baseurl() ?>uploads/product/<?= $detail_product->image_five ?>" data-zoom-image="<?= smn_baseurl() ?>uploads/product/<?= $detail_product->image_five ?>" width="500" />
                      </div>
                    <?php } ?>
                    <?php if ($detail_product->image_six) { ?>
                      <div>
                        <img class="zoom-img img-fluid blur-up lazyload image_zoom_cls-5 aspect-square rounded-lg object-cover" src="<?= smn_baseurl() ?>uploads/product/<?= $detail_product->image_six ?>" data-zoom-image="<?= smn_baseurl() ?>uploads/product/<?= $detail_product->image_six ?>" width="500" />
                      </div>
                    <?php } ?>
                    <?php if ($detail_product->image_seven) { ?>
                      <div>
                        <img class="zoom-img img-fluid blur-up lazyload image_zoom_cls-6 aspect-square rounded-lg object-cover" src="<?= smn_baseurl() ?>uploads/product/<?= $detail_product->image_seven ?>" data-zoom-image="<?= smn_baseurl() ?>uploads/product/<?= $detail_product->image_seven ?>" width="500" />
                      </div>
                    <?php } ?>

                  </div>
                  <div class="row">
                    <div class="col-12 p-0">
                      <div class="slider-nav" id="gallery_01">
                        <div>
                          <a href="#" class="elevatezoom-gallery" data-update="" data-image="<?= smn_baseurl() ?>uploads/product/<?= $detail_product->image_one ?>" data-zoom-image="<?= smn_baseurl() ?>uploads/product/<?= $detail_product->image_one ?>">
                            <img src="<?= smn_baseurl() ?>uploads/product/<?= $detail_product->image_one ?>" class="img-fluid blur-up lazyload rounded-lg object-cover aspect-square" />
                          </a>
                        </div>
                        <div>
                          <a href="#" class="elevatezoom-gallery" data-image="<?= smn_baseurl() ?>uploads/product/<?= $detail_product->image_two ?>" data-zoom-image="<?= smn_baseurl() ?>uploads/product/<?= $detail_product->image_two ?>">
                            <img src="<?= smn_baseurl() ?>uploads/product/<?= $detail_product->image_two ?>" class="img-fluid blur-up lazyload rounded-lg object-cover aspect-square" />
                          </a>
                        </div>
                        <div>
                          <a href="#" class="elevatezoom-gallery" data-image="<?= smn_baseurl() ?>uploads/product/<?= $detail_product->image_three ?>" data-zoom-image="<?= smn_baseurl() ?>uploads/product/<?= $detail_product->image_three ?>">
                            <img src="<?= smn_baseurl() ?>uploads/product/<?= $detail_product->image_three ?>" class="img-fluid blur-up lazyload rounded-lg object-cover aspect-square" />
                          </a>
                        </div>

                        <?php if ($detail_product->image_four) { ?>
                          <div>
                            <a href="#" class="elevatezoom-gallery" data-image="<?= smn_baseurl() ?>uploads/product/<?= $detail_product->image_four ?>" data-zoom-image="<?= smn_baseurl() ?>uploads/product/<?= $detail_product->image_four ?>">
                              <img src="<?= smn_baseurl() ?>uploads/product/<?= $detail_product->image_four ?>" class="img-fluid blur-up lazyload rounded-lg object-cover aspect-square" />
                            </a>
                          </div>
                        <?php } ?>
                        <?php if ($detail_product->image_five) { ?>
                          <div>
                            <a href="#" class="elevatezoom-gallery" data-image="<?= smn_baseurl() ?>uploads/product/<?= $detail_product->image_five ?>" data-zoom-image="<?= smn_baseurl() ?>uploads/product/<?= $detail_product->image_five ?>">
                              <img src="<?= smn_baseurl() ?>uploads/product/<?= $detail_product->image_five ?>" class="img-fluid blur-up lazyload rounded-lg object-cover aspect-square" />
                            </a>
                          </div>
                        <?php } ?>
                        <?php if ($detail_product->image_six) { ?>
                          <div>
                            <a href="#" class="elevatezoom-gallery" data-image="<?= smn_baseurl() ?>uploads/product/<?= $detail_product->image_six ?>" data-zoom-image="<?= smn_baseurl() ?>uploads/product/<?= $detail_product->image_six ?>">
                              <img src="<?= smn_baseurl() ?>uploads/product/<?= $detail_product->image_six ?>" class="img-fluid blur-up lazyload rounded-lg object-cover aspect-square" />
                            </a>
                          </div>
                        <?php } ?>
                        <?php if ($detail_product->image_seven) { ?>
                          <div>
                            <a href="#" class="elevatezoom-gallery" data-image="<?= smn_baseurl() ?>uploads/product/<?= $detail_product->image_seven ?>" data-zoom-image="<?= smn_baseurl() ?>uploads/product/<?= $detail_product->image_seven ?>">
                              <img src="<?= smn_baseurl() ?>uploads/product/<?= $detail_product->image_seven ?>" class="img-fluid blur-up lazyload rounded-lg object-cover aspect-square" />
                            </a>
                          </div>
                        <?php } ?>

                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-4 rtl-text">
                  <?php echo form_open('cart/add'); ?>
                  <div class="product-right">
                    <h2 class=" font-bold mb-2"><?= $detail_product->nama_barang ?></h2>
                    <?php $totalHarga = $detail_product->harga;
                    $diskonMember = 0;
                    $memberPeringkat = 'Non Member';
                    ?>

                    <?php if ($this->ion_auth->logged_in() && $this->session->userdata('reseller') != '1') {  ?>
                      <?php $cekMember = $this->db->where(['user_id' => $this->ion_auth->user()->row()->id])->where("DATE_FORMAT(masaberlaku,'%Y-%m-%d') >=", date('Y-m-d'))->get('user_membership')->row(); ?>
                      <!-- <h4><del>$459.00</del><span>55% off</span></h4> -->
                      <?php
                      if ($cekMember) {  ?>
                        <?php if ($cekMember->peringkat_member == 'GOLD') {
                          $diskonMember = 10;
                          $memberPeringkat = 'GOLD';
                        ?>
                        <?php } else if ($cekMember->peringkat_member == 'PLATINUM') {
                          $diskonMember = 15;
                          $memberPeringkat = 'PLATINUM';
                        ?>
                        <?php } else if ($cekMember->peringkat_member == 'DIAMOND') {
                          $diskonMember = 20;
                          $memberPeringkat = 'DIAMOND';
                        ?>
                        <?php } ?>
                      <?php } ?>
                    <?php } ?>
                    <?php
                    $diskonItems = 0;
                    $cekDiskonItem = $this->db->where(['product_id' => $detail_product->id_product])
                      ->where(['exp_date >=' => date('Y-m-d')])
                      ->where(['start_date <=' => date('Y-m-d')])
                      ->get('discount_items')->row();
                    if ($cekDiskonItem) {
                      $diskonItems = $cekDiskonItem->jumlah;
                    }
                    if ($this->ion_auth->logged_in() && $this->session->userdata('reseller') != '1') {
                      if ($diskonMember < $diskonItems) {
                        $totalDiskonPerbandingan = ($diskonItems / 100) * $detail_product->harga;
                        $hargaReal = $detail_product->harga - $totalDiskonPerbandingan;
                        form_hidden('diskon',  $diskonItems);
                        echo ' <h3 style="color:red; text-decoration: line-through;">IDR ' . number_format($detail_product->harga, 0)  . '</h3>';
                        echo '<p>Diskon Items ' . $diskonItems . '%</p>';
                        echo '<h3>IDR ' . number_format($hargaReal, 0)  . ' </h3>';
                      } else {
                        $totalDiskonPerbandingan = ($diskonMember / 100) *  $detail_product->harga;
                        $hargaReal = $detail_product->harga - $totalDiskonPerbandingan;
                        form_hidden('diskon',  $diskonMember);
                        echo ' <h3 style="color:red; text-decoration: line-through;">IDR ' . number_format($detail_product->harga, 0)  . '</h3>';
                        echo '<p>Diskon Member ' . $memberPeringkat . ' ' . $diskonMember . '%</p>';
                        echo '<h3>IDR ' . number_format($hargaReal, 0)  . ' </h3>';
                      }
                    } else {
                      if ($cekDiskonItem) {
                        $totalDiskonPerbandingan = ($diskonItems / 100) * $detail_product->harga;
                        $hargaReal = $detail_product->harga - $totalDiskonPerbandingan;
                        form_hidden('diskon',  $diskonItems);
                        echo ' <h3 style="color:red; text-decoration: line-through;">IDR ' . number_format($detail_product->harga, 0)  . '</h3>';
                        echo '<p>Diskon Items ' . $diskonItems . '%</p>';
                        echo '<h3>IDR ' . number_format($hargaReal, 0)  . ' </h3>';
                      } else {
                        echo '<h3 class=" font-light text-md text-black mb-4">IDR ' . number_format($detail_product->harga, 0)  . ' </h3>';
                        $hargaReal = $detail_product->harga;
                      }
                    }
                    ?>




                    <?php
                    //$colorRelate = $this->db->select('product.id_product as idcolor, product.colour, product.colour_picker')->where(['identity_product' => $detail_product->identity_product])->where(['is_active' => 1])->get('product')->result();
                    $colorRelate = $this->db->select('a.id_product as idcolor, b.colour, b.colour_picker')->join('product b', 'a.id_product=b.id_product')->where(['a.id_store' => '100'])->where('a.jumlah_stok >', 0)->where(['identity_product' => $detail_product->identity_product])->where(['is_active' => 1])->group_by('a.id_product')->get('product_stok a')->result();
                    ?>

                    <ul class="color-variant">
                      <?php foreach ($colorRelate as $itemColor) { ?>
                        <a href="<?php base_url('/product/detail/') ?><?= $itemColor->idcolor ?>">
                          <li class="bg-light0" style="background-color: <?= $itemColor->colour_picker ?>  "></li>
                        </a>
                        <?= $itemColor->colour == $detail_product->colour ? 'selected' : '' ?>
                      <?php } ?>
                    </ul>
                    <div class="product-description border-product">
                      <?php
                      $totalStok = 0;
                      if ($productSize) {  ?>
                        <h6 class="product-title size-text"><?= lang('available_size_produk') ?> <span><a href="" style="display:none" data-toggle="modal" data-target="#sizemodal">size
                              chart</a></span></h6>
                        <br>

                        <div class="container-outer">
                          <div class="container-inner">

                            <!-- tambahan arimbi start -->
                            <div class="flex flex-wrap">
                              <?php
                              foreach ($productSize as $key => $size) {  ?>
                                <?php
                                $this->db->select('sum(jumlah_stok) as jumlah_stok');
                                $this->db->from('product_stok');
                                $this->db->join('store', 'product_stok.id_store = store.id_store');
                                $this->db->where(['store.act !=' => 0]);
                                $this->db->where(['product_stok.id_store' => 100]);
                                $this->db->where(['id_product' => $detail_product->id_product]);
                                $this->db->where(['id_product_attribute' => $size->id_product_attribute]);
                                $cekTotal = $this->db->get()->row();
                                //echo $this->db->last_query();
                                //exit();
                                ?>
                                <?php
                                //  var_dump($cekTotal)
                                ?>

                                <div class="flex flex-row items-center mr-1 mb-1">
                                  <input type="radio" name="size" value="<?= $size->id_product_attribute ?>" <?php if ($detail_product->indent == 2) {  ?> <?php } else if ($cekTotal->jumlah_stok < 1) { ?> disabled <?php  } ?> class=" !hidden">
                                  <label for="radioButton" class="cursor-pointer border border-gray-400 p-2 rounded-md flex items-center">
                                    <span data-id="<?= $size->id_product_attribute ?>" data-indent="<?= $detail_product->indent ?>" class="<?php if ($detail_product->indent == 2) {  ?> custom-radio-button <?php } else if ($cekTotal->jumlah_stok < 1) { ?> custom-radio-button-no-stock <?php  } else { ?>  custom-radio-button <?php } ?> radio-<?= str_replace(['.', ' '], '-', $size->size)  ?> w-4 h-4 border border-gray-400 rounded-md mr-2 hidden"></span>
                                    <span class="text-gray-700 my-0 mx-3 text-lg"><?= str_replace(['.', ' '], '-', $size->size)  ?></span>
                                  </label>
                                </div>

                                <?php if ($cekTotal->jumlah_stok >= 1) {  ?>
                                  <?php $totalStok = $totalStok + $cekTotal->jumlah_stok ?>
                                  <input type="hidden" value='<?= $cekTotal->jumlah_stok ?>' class='stok-<?= $size->id_product_attribute ?>'>
                                <?php } elseif ($detail_product->indent == 2) {  ?>
                                  <input type="hidden" value='0' class='stok-<?= $size->id_product_attribute ?>'>

                                <?php } ?>
                              <?php  } ?>
                            </div>
                            <!-- tambahan arimbi end -->

                            <?php
                            foreach ($productSize as $key => $size) {  ?>
                              <?php
                              $this->db->select('sum(jumlah_stok) as jumlah_stok');
                              $this->db->from('product_stok');
                              $this->db->join('store', 'product_stok.id_store = store.id_store');
                              $this->db->where(['store.act !=' => 0]);
                              $this->db->where(['product_stok.id_store' => 100]);
                              $this->db->where(['id_product' => $detail_product->id_product]);
                              $this->db->where(['id_product_attribute' => $size->id_product_attribute]);
                              $cekTotal = $this->db->get()->row();
                              //echo $this->db->last_query();
                              //exit();
                              ?>
                              <?php
                              //  var_dump($cekTotal)
                              ?>
                              <label class="custom-radio-button-container" style="margin-left:0px;margin-right:8px;">
                                <input type="radio" name="size" value="<?= $size->id_product_attribute ?>" <?php if ($detail_product->indent == 2) {  ?> <?php } else if ($cekTotal->jumlah_stok < 1) { ?> disabled <?php  } ?>>
                                <span data-id="<?= $size->id_product_attribute ?>" data-indent="<?= $detail_product->indent ?>" class="<?php if ($detail_product->indent == 2) {  ?> custom-radio-button <?php } else if ($cekTotal->jumlah_stok < 1) { ?> custom-radio-button-no-stock <?php  } else { ?>  custom-radio-button <?php } ?> radio-<?= str_replace(['.', ' '], '-', $size->size)  ?> h-10 w-12 text-center"></span>
                              </label>
                              <?php if ($cekTotal->jumlah_stok >= 1) {  ?>
                                <?php $totalStok = $totalStok + $cekTotal->jumlah_stok ?>
                                <input type="hidden" value='<?= $cekTotal->jumlah_stok ?>' class='stok-<?= $size->id_product_attribute ?>'>
                              <?php } elseif ($detail_product->indent == 2) {  ?>
                                <input type="hidden" value='0' class='stok-<?= $size->id_product_attribute ?>'>

                              <?php } ?>
                            <?php  } ?>
                          </div> <!-- .container-inner -->

                          <label class="custom-radio-button-container">
                            <input type="radio" name="size" required>
                          </label>
                        </div> <!-- .container-outer -->

                      <?php } ?>
                      <h6 class="product-title" id='tampil_stock' style="display:none;"></h6>
                      <h6 class="product-title" style="display:none;"><?= lang('quantity_produk') ?></h6>
                      <div class="qty-box">
                        <?php
                        echo form_hidden('id',  $detail_product->id_product);
                        // echo form_hidden('qty',  1);
                        echo form_hidden('price',  $hargaReal);
                        echo form_hidden('name',  $detail_product->nama_barang);
                        echo form_hidden('color',  $detail_product->colour);
                        echo form_hidden('redirect_page', str_replace('', '', current_url()));
                        ?>

                        <!-- <div class="input-group">
                          <span class="input-group-prepend">
                            <button type="button" class="btn quantity-left-minus" data-type="minus" data-field="">
                              <i class="ti-angle-left"></i>
                            </button>
                          </span>
                          <input type="number" name="qty" id="input-number" min="1" class="form-control input-number" <?php if ($totalStok >= 1) {  ?> <?php } else if ($detail_product->indent == 1) { ?> <?php } else {  ?> max="<?= $totalStok ?>" <?php } ?> required value="1">
                          <span class="input-group-prepend">
                            <button type="button" class="btn quantity-right-plus" data-type="plus" data-field="">
                              <i class="ti-angle-right"></i>
                            </button>
                          </span>
                        </div> -->

                        <div class="flex w-full">
                          <span class="flex items-center border">
                            <button type="button" class="btn quantity-left-minus" data-type="minus" data-field="">
                              <i class="ti-angle-left"></i>
                            </button>
                          </span>
                          <input type="number" name="qty" id="input-number" min="1" class="form-control input-number !text-center" <?php if ($totalStok >= 1) {  ?> <?php } else if ($detail_product->indent == 1) { ?> <?php } else {  ?> max="<?= $totalStok ?>" <?php } ?> required value="1">
                          <span class="flex items-center border">
                            <button type="button" class="btn quantity-right-plus" data-type="plus" data-field="">
                              <i class="ti-angle-right"></i>
                            </button>
                          </span>
                        </div>


                      </div>
                      <br>
                      <h6 class="product-title" style='color:red;' id='check-stock'></h6>
                    </div>

                    <input type="hidden" value='0' name="indent" class="indenitem">
                    <p id="indent-notif"><?= lang('indent_produk') ?> <b style="color: red;">Estimated <?= $detail_product->hari_indent ?> days</b> </p>

                    <?php if ($totalStok >= 1) {
                      $isdisabled = '';
                    ?>
                    <?php } else {
                      $isdisabled = 'disabled' ?>
                    <?php } ?>

                    <div>
                      <button type="submit" id='button-addtocart' <?= $isdisabled ?> data-toggle="modal" data-target="#addtocart" class="btn btn-solid w-full mb-4"><?= lang('add_to_cart_produk') ?></button>
                    </div>
                    <?php echo form_close() ?>
                    <div class="border-product">
                      <h6 class="product-title">product details</h6>
                      <p><?= $detail_product->description ?></p>
                    </div>
                    <div class="border-product">
                      <h6 class="product-title">share it</h6>
                      <div class="product-icon">
                        <ul class="product-social">
                          <li><a href="javascript:void(0)" onclick="window.open('https://www.facebook.com/sharer/sharer.php?u=<?= base_url(); ?>product/detail/<?= $detail_product->id_product; ?>', 'Share This Item', 'width=640,height=450');return false"><i class="fa fa-facebook"></i></a></li>
                          <li><a href="javascript:void(0)" onclick="window.open('https://plus.google.com/share?url=<?= base_url(); ?>product/detail/<?= $detail_product->id_product; ?>', 'Share This Item', 'width=640,height=450');return false"><i class="fa fa-google-plus"></i></a></li>
                          <li><a href="javascript:void(0)" onclick="window.open('https://twitter.com/share?url=<?= base_url(); ?>product/detail/<?= $detail_product->id_product; ?>&amp;text=<?= $detail_product->nama_barang; ?>', 'Share This Item', 'width=640,height=450');return false"><i class=" fa fa-twitter"></i></a></li>
                          <li><a href="https://api.whatsapp.com/send?text=<?= $detail_product->nama_barang; ?> - <?= base_url(); ?>product/detail/<?= $detail_product->id_product; ?>" target="_blank"><i class="fa fa-whatsapp"></i></a></li>
                        </ul>
                        <?= form_open(base_url() . 'add_to_wishlist/' . $detail_product->id_product, ['class' => 'd-inline-block']); ?>
                        <?php
                        $active = '';
                        if (!empty($cek_wishlist)) {
                          $active = 'active';
                        }
                        ?>
                        <button class="wishlist-btn <?= $active ?>"><i class="fa fa-heart"></i><span class="title-font"><?= lang('wishList_produk') ?></span></button>
                        <?= form_close() ?>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>
            <section class="tab-product m-0">
              <div class="row">
                <div class="col-sm-12 col-lg-12">
                  <ul class="nav nav-tabs nav-material" id="top-tab" role="tablist">
                    <li class="nav-item"><a class="nav-link active" id="top-home-tab" data-toggle="tab" href="#top-home" role="tab" aria-selected="true"><i class="icofont icofont-ui-home"></i><?= lang('description_produk') ?></a>
                      <div class="material-border"></div>
                    </li>
                    <li class="nav-item"><a class="nav-link" id="profile-top-tab" data-toggle="tab" href="#top-profile" role="tab" aria-selected="false"><i class="icofont icofont-man-in-glasses"></i>Details</a>
                      <div class="material-border"></div>
                    </li>
                    <li class="nav-item"><a class="nav-link" id="contact-top-tab" data-toggle="tab" href="#top-contact" role="tab" aria-selected="false"><i class="icofont icofont-contacts"></i>Video</a>
                      <div class="material-border"></div>
                    </li>
                    <li class="nav-item"><a class="nav-link" id="review-top-tab" data-toggle="tab" href="#top-review" role="tab" aria-selected="false"><i class="icofont icofont-contacts"></i><?= lang('write_review_produk') ?></a>
                      <div class="material-border"></div>
                    </li>
                  </ul>
                  <div class="tab-content nav-material" id="top-tabContent">
                    <div class="tab-pane fade show active" id="top-home" role="tabpanel" aria-labelledby="top-home-tab">
                      <p><?= $detail_product->desc_detail ?></p>
                    </div>

                    <div class="tab-pane fade" id="top-contact" role="tabpanel" aria-labelledby="contact-top-tab">
                      <div class="mt-3 text-center">
                        <?php if (preg_match('/^.*\.(mp4|mov)$/i', $detail_product->video)) { ?>
                          <video width="50%" controls>
                            <source src="<?= smn_baseurl() ?>uploads/product/<?= $detail_product->video ?>" type="video/mp4">
                          </video>
                        <?php } else { ?>
                          <p>Tidak Ada Video</p>
                        <?php } ?>
                      </div>
                    </div>
                    <div class="tab-pane fade" id="top-review" role="tabpanel" aria-labelledby="review-top-tab">
                      <div class="mt-20">
                        <div class="collection-filter-block pad-0-20">
                          <div class="product-service">
                            <table width="100%">
                              <tbody>
                                <tr>
                                  <td width="70%">
                                    <h4>Average User Rating</h4>
                                    <h2><strong><?= number_format($avgreview->rating, 2) ?></strong><span> / 5</span></h2>
                                    <div class="rating three-star">
                                      <?php for ($usrating = 1; $usrating <= 5; $usrating++) { ?>
                                        <i class="fa fa-star <?php if ($usrating <= $avgreview->rating) {
                                                                echo "active";
                                                              } ?>"></i>
                                      <?php } ?>
                                    </div>
                                  </td>
                                  <td width="30%">
                                    <h4>Rating Breakdown</h4>
                                    <div class="rating three-star">
                                      5 <i class="fa fa-star"></i>
                                      <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: <?= $avgreview5->avg_rating ?>%" aria-valuenow="<?= $avgreview5->avg_rating ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                      </div>
                                      <?= $avgreview5->count_rating ?>
                                      <br>
                                      4 <i class="fa fa-star"></i>
                                      <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: <?= $avgreview4->avg_rating ?>%" aria-valuenow="<?= $avgreview4->avg_rating ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                      </div>
                                      <?= $avgreview4->count_rating ?>
                                      <br>
                                      3 <i class="fa fa-star"></i>
                                      <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: <?= $avgreview3->avg_rating ?>%" aria-valuenow="<?= $avgreview3->avg_rating ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                      </div>
                                      <?= $avgreview3->count_rating ?>
                                      <br>
                                      2 <i class="fa fa-star"></i>
                                      <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: <?= $avgreview2->avg_rating ?>%" aria-valuenow="<?= $avgreview2->avg_rating ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                      </div>
                                      <?= $avgreview2->count_rating ?>
                                      <br>
                                      1 <i class="fa fa-star"></i>
                                      <div class="progress">
                                        <div class="progress-bar" role="progressbar" style="width: <?= $avgreview1->avg_rating ?>%" aria-valuenow="<?= $avgreview1->avg_rating ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                      </div>
                                      <?= $avgreview1->count_rating ?>
                                    </div>
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                      <hr>
                      <?php
                      $product_reviews = $this->M_product->get_product_reviews($detail_product->id_product);
                      if (!empty($product_reviews)) {
                      ?>
                        <div class=" mt-20">
                          <div class="collection-filter-block pad-0-20">
                            <table width="100%">
                              <?php foreach ($product_reviews as $reviews) { ?>
                                <tr class="borderbottom">
                                  <td class="pad-20-0" width="40%">
                                    <?= $reviews->first_name . ' ' . $reviews->last_name ?>
                                    <br>
                                    <br>
                                    <span><?= date('d F Y H:i', strtotime($reviews->created_at)) ?></span>
                                  </td>
                                  <td class="pad-20-0" width="80%">
                                    <div class="rating three-star">
                                      <?php for ($usrating = 1; $usrating <= 5; $usrating++) { ?>
                                        <i class="fa fa-star <?php if ($usrating <= $reviews->rating) {
                                                                echo "active";
                                                              } ?>"></i>
                                      <?php } ?>
                                    </div>
                                    <p class="text-justify pad-15">
                                      <strong><?= $reviews->title ?></strong>
                                      <br>
                                      <?= $reviews->content ?>
                                    </p>
                                  </td>
                                </tr>
                                <!-- <hr> -->
                              <?php } ?>
                            </table>
                          </div>
                        </div>
                      <?php } ?>
                      <?php if ($this->ion_auth->logged_in() && !empty($cek_order) && empty($cek_review)) {  ?>
                        <?= form_open(base_url() . 'submit_review/' . $detail_product->id_product, ['class' => 'theme-form']) ?>
                        <div class="mt-20">
                          <h3><?= lang('write_review_produk') ?></h3>
                          <br>
                          <div>
                            <label for="review">Title</label>
                            <input type="text" class="form-control" name="title" id="review" placeholder="Enter your Review Subjects" required>
                            <label for="review">Review</label>
                            <textarea class="form-control" name="content" placeholder="Write Your Review Here" rows="6"></textarea>
                            <label for="review">Rating</label>
                            <div class="rating-group">
                              <input disabled checked class="rating__input rating__input--none" name="rating" id="rating3-none" value="0" type="radio">
                              <?php for ($str = 1; $str <= 5; $str++) { ?>
                                <label aria-label="<?= $str ?> star" class="rating__label" for="rating3-<?= $str ?>"><i class="rating__icon rating__icon--star fa fa-star"></i></label>
                                <input class="rating__input" name="rating" id="rating3-<?= $str ?>" value="<?= $str ?>" type="radio">
                              <?php } ?>
                            </div>
                            <button class="btn btn-solid" type="submit"><?= lang('submit_review_produk') ?></button>
                          </div>
                        </div>
                        <?= form_close() ?>
                      <?php } ?>
                    </div>
                  </div>
                </div>
              </div>
            </section>
          </div>
          <!--<div class="col-sm-3 collection-filter">
             <div class="collection-filter-block">
               <?php if ($fiture) { ?>
                 <div class="product-service">
                   <?php foreach ($fiture as $item_fiture) { ?>
                     <div class="media">
                       <img src="<?= smn_baseurl() ?>/uploads/fiture/<?= $item_fiture->image ?>" alt="" width="20%">

                       <div class="media-body">
                         <h4><?= $item_fiture->title ?></h4>
                         <p><?= $item_fiture->sub_title ?></p>
                       </div>
                     </div>
                   <?php } ?>
                 </div>
               <?php } ?>
             </div>-->
          <!-- side-bar single product slider start -->
          <!--  <div class="theme-card">
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
            side-bar single product slider end -->
        </div>
      </div>


      <br>

      <!-- Paragraph-->
      <div class="title1 section-t-space">
        <h2 class="title-inner1"><?= lang('new_products_home') ?></h2>
      </div>

      <!-- Paragraph end -->

      <!-- Product slider -->
      <section class="section-b-space p-t-0 ratio_asos">
        <div class="container">

          <!-- tambahan arimbi start -->
          <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <?php if ($new_products) {  ?>
              <?php foreach ($new_products as $new) { ?>
                <?php
                $data = [
                  'data' => $new
                ];
                $this->load->view("components/product/product_card_detail", $data);
                ?>
              <?php } ?>
            <?php } ?>
          </div>
        </div>
      </section>
      <!-- tambahan arimbi end -->

      <!-- <div class="row">
              <div class="col">
                <div class="product-4 product-m no-arrow">
                <?php foreach ($new_products as $new) { ?>
                    <div class="product-box">
                      <div class="img-wrapper">
                        <div class="front">
                          <a href="<?= base_url() ?>product/detail/<?= $new->id_product ?>"><img src="<?= smn_baseurl() ?>uploads/product/<?= $new->image_one ?>" class="img-fluid blur-up lazyload bg-img" alt=""></a>
                        </div>
                        <div class="back">
                          <a href="<?= base_url() ?>product/detail/<?= $new->id_product ?>"><img src="<?= smn_baseurl() ?>uploads/product/<?= $new->image_two ?>" class="img-fluid blur-up lazyload bg-img" alt=""></a>
                        </div>
                        <div class="cart-info cart-wrap"> -->
      <!-- <a href="javascript:void(0)" title="Add to Wishlist">
                     <i class="ti-heart" aria-hidden="true"></i>
                   </a> -->
      <!-- <a href="<?= base_url() ?>add_to_compare/<?= $new->id_product ?>" title="Compare"><i class="ti-reload" aria-hidden="true"></i></a>
                        </div>
                      </div>
                      <div class="product-detail">
                        <div class="rating three-star">
                          <?php
                          $recomen_rating = $this->db->select('AVG(rating) as avg_rating')->where('product_id', $new->id_product)->get('product_reviews')->row()->avg_rating;
                          for ($usrating = 1; $usrating <= 5; $usrating++) { ?>
                            <i class="fa fa-star <?php if ($usrating <= $recomen_rating) {
                                                    echo "active";
                                                  } ?>"></i>
                          <?php } ?>
                        </div>
                        <a href="<?= base_url() ?>product/detail/<?= $new->id_product ?>">
                          <h6><?= $new->nama_barang ?></h6>
                        </a>
                        <h4>Rp. <?= number_format($new->harga, 0) ?></h4>
                      </div>
                    </div> -->
      <!-- <?php } ?> -->

      <!-- </div>
      </section> -->
      <!-- Product slider end -->






      <br>



      <!-- Paragraph-->
      <div class="title1 section-t-space">
        <h2 class="title-inner1"><?= lang('relate_product_produk') ?></h2>
      </div>

      <!-- Paragraph end -->

      <?php if ($relate) {  ?>
        <!-- Product slider -->
        <section class="section-b-space p-t-0 ratio_asos">
          <div class="container">
            <!-- tambahan arimbi start -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
              <?php foreach ($relate as $item_relate) { ?>
                <?php
                $data = [
                  'data' => $item_relate
                ];
                $this->load->view("components/product/product_card_detail", $data);
                ?>
              <?php } ?>
            </div>
            <!-- tambahan arimbi end-->

            <!-- <div class="row">
              <div class="col">
                <div class="product-4 product-m no-arrow">
                  <?php foreach ($relate as $item_relate) { ?>
                    <div class="product-box">
                      <div class="img-wrapper">
                        <div class="front">
                          <a href="<?= base_url() ?>product/detail/<?= $item_relate->id_product ?>"><img src="<?= smn_baseurl() ?>uploads/product/<?= $item_relate->image_one ?>" class="img-fluid blur-up lazyload bg-img" alt=""></a>
                        </div>
                        <div class="back">
                          <a href="<?= base_url() ?>product/detail/<?= $item_relate->id_product ?>"><img src="<?= smn_baseurl() ?>uploads/product/<?= $item_relate->image_two ?>" class="img-fluid blur-up lazyload bg-img" alt=""></a>
                        </div>
                        <div class="cart-info cart-wrap"> -->
            <!-- <a href="javascript:void(0)" title="Add to Wishlist">
                     <i class="ti-heart" aria-hidden="true"></i>
                   </a> -->
            <!-- <a href="<?= base_url() ?>add_to_compare/<?= $item_relate->id_product ?>" title="Compare"><i class="ti-reload" aria-hidden="true"></i></a>
                        </div>
                      </div>
                      <div class="product-detail">
                        <div class="rating three-star">
                          <?php
                          $recomen_rating = $this->db->select('AVG(rating) as avg_rating')->where('product_id', $item_relate->id_product)->get('product_reviews')->row()->avg_rating;
                          for ($usrating = 1; $usrating <= 5; $usrating++) { ?>
                            <i class="fa fa-star <?php if ($usrating <= $recomen_rating) {
                                                    echo "active";
                                                  } ?>"></i>
                          <?php } ?>
                        </div>
                        <a href="<?= base_url() ?>product/detail/<?= $item_relate->id_product ?>">
                          <h6><?= $item_relate->nama_barang ?></h6>
                        </a>
                        <h4>Rp. <?= number_format($item_relate->harga, 0) ?></h4>
                      </div>
                    </div>
                  <?php } ?>
                </div>
              </div>
            </div> -->
          </div>
        </section>
        <!-- Product slider end -->

      <?php } ?>

    </div>

    </div>
  </section>
  <!-- Section ends -->
  <!-- Zoom js-->

  <!--script type="text/javascript" src="https://cdn.rawgit.com/igorlino/elevatezoom-plus/1.1.6/src/jquery.ez-plus.js"></script-->

  <script src="https://cdn.jsdelivr.net/gh/igorlino/elevatezoom-plus@1.2.3/src/jquery.ez-plus.js"></script>
  <script>
    $(document).ready(function() {

      $("#indent-notif").css("display", "none");
      //  $("#zoom_03").ezPlus({
      //    gallery: 'gallery_01',
      //    galleryActiveClass: "active",
      //    imageCrossfade: true,
      //    scrollZoom: true,
      //    zoomType: 'inner',
      //    cursor: 'crosshair'
      //  });
      function showimg(img) {
        $('.zoomWindowContainer,.zoomContainer').remove();
        $(img).ezPlus({
          gallery: 'gallery_01',
          galleryActiveClass: "active",
          //  imageCrossfade: true,
          scrollZoom: true,
          zoomType: 'inner',
          cursor: 'crosshair'
        });
      }
      $('.product-slick').on('beforeChange', function(event, slick, currentSlide, nextSlide) {
        img = $(slick.$slides[nextSlide]).find("img");
        showimg(img);
      });
      var indenitem = parseInt($('.indenitem').val());
      $(document).on('click', '.custom-radio-button', function() {
        var idnya = $(this).attr('data-id');
        let dataIndent = $(this).attr('data-indent');
        console.log(dataIndent);
        var stoknya = parseInt($('.stok-' + idnya).val());

        $("#tampil_stock").html('Stock : ' + stoknya);

        var stok_beli = parseInt($('.input-number').val());

        if (dataIndent != 1) {
          $("#input-number").attr('max', stoknya);
        }

        if (stok_beli > stoknya) {
          if (dataIndent == 1) {
            $("#check-stock").html('Stock is not enough');
            $('.indenitem').val(1);
            $("#indent-notif").fadeIn('slow');
            $('#button-addtocart').removeAttr("disabled");
          } else {
            $("#check-stock").html('Stock is not enough');
            $('.indenitem').val(0);
            $("#button-addtocart").attr('disabled', true);
            $("#indent-notif").fadeOut('slow');
          }

        } else if (stok_beli <= stoknya) {
          $('.indenitem').val(0);

          $("#check-stock").html("");

          $('#button-addtocart').removeAttr("disabled");
          $("#indent-notif").fadeOut('slow');

        }
        //  if (indenitem === 1) {
        //    $('#button-addtocart').removeAttr("disabled");
        //    console.log('custom-radio-button');
        //  }
      })

      $(document).on('change', '.input-number', function() {

        var idnya = $("input[name='size']:checked").val();

        var stoknya = parseInt($('.stok-' + idnya).val());

        var stok_beli = parseInt($('.input-number').val());

        let dataIndent = $('.indenitem').val();

        if (stok_beli > stoknya) {


          if (dataIndent == 1) {
            $("#check-stock").html('Stock is not enough');
            $('.indenitem').val(1);
            $("#indent-notif").fadeIn('slow');
            $('#button-addtocart').removeAttr("disabled");
          } else {
            $("#check-stock").html('Stock is not enough');
            $('.indenitem').val(0);
            $("#button-addtocart").attr('disabled', true);
            $("#indent-notif").fadeOut('slow');

          }


        } else if (stok_beli <= stoknya) {

          $("#check-stock").html("");
          $('.indenitem').val(0);

          $('#button-addtocart').removeAttr("disabled");
          $("#indent-notif").fadeOut('slow');

        }
        //  if (indenitem === 1) {
        //    $('#button-addtocart').removeAttr("disabled");
        //    console.log('custom-radio-button');
        //  }

      })

      $(document).on('click', '.ti-angle-left', function() {

        var idnya = $("input[name='size']:checked").val();

        var stoknya = parseInt($('.stok-' + idnya).val());
        var stoknya = parseInt($('.stok-' + idnya).val());

        let dataIndent = $('.indenitem').val();
        var stok_beli = parseInt($('.input-number').val());

        if (stok_beli > stoknya) {
          if (dataIndent == 1) {
            $("#check-stock").html('Stock is not enough');
            $('.indenitem').val(1);
            $("#indent-notif").fadeIn('slow');
            $('#button-addtocart').removeAttr("disabled");
          } else {
            $("#indent-notif").fadeOut('slow');
            $("#check-stock").html('Stock is not enough');
            $('.indenitem').val(0);
            $("#button-addtocart").attr('disabled', true);
          }


        } else if (stok_beli <= stoknya) {

          $("#check-stock").html("");
          $('.indenitem').val(0);
          $("#indent-notif").fadeOut('slow');
          $('#button-addtocart').removeAttr("disabled");

        }

        console.log(stoknya);

        console.log(stok_beli);
        //  if (indenitem === 1) {
        //    $('#button-addtocart').removeAttr("disabled");
        //    console.log('custom-radio-button');
        //  }
      })

      $(document).on('click', '.ti-angle-right', function() {

        var idnya = $("input[name='size']:checked").val();

        var stoknya = parseInt($('.stok-' + idnya).val());
        let dataIndent = $('.indenitem').val();

        var stok_beli = parseInt($('.input-number').val());

        if (stok_beli > stoknya) {
          if (dataIndent == 1) {
            $("#check-stock").html('Stock is not enough');
            $('.indenitem').val(1);
            $("#indent-notif").fadeIn('slow');
            $('#button-addtocart').removeAttr("disabled");
          } else {
            $("#indent-notif").fadeOut('slow');
            $("#check-stock").html('Stock is not enough');
            $('.indenitem').val(0);
            $("#button-addtocart").attr('disabled', true);
          }


        } else if (stok_beli <= stoknya) {

          $("#check-stock").html("");
          $('.indenitem').val(0);
          $("#indent-notif").fadeOut('slow');
          $('#button-addtocart').removeAttr("disabled");

        }

        console.log(stoknya);

        console.log(stok_beli);

        //  if (indenitem === 1) {
        //    $('#button-addtocart').removeAttr("disabled");
        //    console.log('custom-radio-button');
        //  }
      })

      $(document).on('click', '.quantity-right-plus', function() {

        var idnya = $("input[name='size']:checked").val();

        var stoknya = parseInt($('.stok-' + idnya).val());

        let dataIndent = $('.indenitem').val();
        var stok_beli = parseInt($('.input-number').val());

        if (stok_beli > stoknya) {
          if (dataIndent == 1) {
            $("#check-stock").html('Stock is not enough');
            $('.indenitem').val(1);
            $("#indent-notif").fadeIn('slow');
            $('#button-addtocart').removeAttr("disabled");
          } else {
            $("#indent-notif").fadeOut('slow');
            $("#check-stock").html('Stock is not enough');
            $('.indenitem').val(0);
            $("#button-addtocart").attr('disabled', true);
          }


        } else if (stok_beli <= stoknya) {

          $("#check-stock").html("");
          $('.indenitem').val(0);
          $("#indent-notif").fadeOut('slow');
          $('#button-addtocart').removeAttr("disabled");

        }

        console.log(stoknya);

        console.log(stok_beli);
        //  if (indenitem === 1) {
        //    $('#button-addtocart').removeAttr("disabled");
        //    console.log('custom-radio-button');
        //  }
      })

      $(document).on('click', '.quantity-left-minus', function() {

        var idnya = $("input[name='size']:checked").val();

        var stoknya = parseInt($('.stok-' + idnya).val());

        let dataIndent = $('.indenitem').val();
        var stok_beli = parseInt($('.input-number').val());

        if (stok_beli > stoknya) {
          if (dataIndent == 1) {
            $("#check-stock").html('Stock is not enough');
            $('.indenitem').val(1);
            $("#indent-notif").fadeIn('slow');
            $('#button-addtocart').removeAttr("disabled");
          } else {
            $("#indent-notif").fadeOut('slow');
            $("#check-stock").html('Stock is not enough');
            $('.indenitem').val(0);
            $("#button-addtocart").attr('disabled', true);
          }


        } else if (stok_beli <= stoknya) {

          $("#check-stock").html("");
          $('.indenitem').val(0);
          $("#indent-notif").fadeOut('slow');
          $('#button-addtocart').removeAttr("disabled");

        }

        console.log(stoknya);

        console.log(stok_beli);
        //  if (indenitem === 1) {
        //    $('#button-addtocart').removeAttr("disabled");
        //    console.log('custom-radio-button');
        //  }
      })


    });
  </script>