<!-- breadcrumb start -->
<div class="breadcrumb-section">
  <div class="container">
    <div class="row">
      <div class="col-sm-6">
        <div class="page-title">
          <h2><?= lang('cart_produk') ?></h2>
        </div>
      </div>
      <div class="col-sm-6">
        <nav aria-label="breadcrumb" class="theme-breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('') ?>"><?= lang('beranda') ?></a></li>
            <li class="breadcrumb-item active"><?= lang('cart_produk') ?></li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
</div>
<!-- breadcrumb End -->





<!--section start-->
<section class="cart-section section-b-space">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <form id="cartform" action="<?= base_url('cart/update') ?>" method="post">
          <div class="table-responsive">
            <table class="table cart-table table-responsive-xs">
              <thead>
                <tr class="table-head">
                  <th scope="col"><?= lang('image_produk') ?></th>
                  <th scope="col"><?= lang('product_name_produk') ?></th>
                  <th scope="col"><?= lang('price_produk') ?></th>
                  <th scope="col"><?= lang('quantity_produk') ?></th>
                  <th scope="col"><?= lang('delete_produk') ?></th>
                  <th scope="col">total</th>
                </tr>

              </thead>

              <?php $i = 1; ?>

              <?php foreach ($this->cart->contents() as $items) : ?>

                <?php $barang = $this->M_product->get_detailproduct($items['id']) ?>
                <?php $totalStok = 0; ?>
                <?php $cekTotal = $this->db->select_sum('jumlah_stok')->where(['id_store' => 100])->where(['id_product' => $items['id']])->where(['id_product_attribute' => $items['options']['Size']])->get('product_stok')->row(); ?>
                <?php if ($cekTotal->jumlah_stok >= 1) {  ?>
                  <?php $totalStok = $cekTotal->jumlah_stok ?>
                <?php } ?>
                <tbody>
                  <tr>
                    <td>
                      <a href="<?= base_url() ?>product/detail/<?= $barang->id_product ?>"><img src="<?= smn_baseurl() ?>uploads/product/<?= $barang->image_one ?>" alt="" style="object-fit: cover;"></a>
                    </td>
                    <td>
                      <a href="<?= base_url('product/detail/' . $items['id']) ?>"><?= $items['name'] ?></a>
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
                      <div class="mobile-cart-content row">
                        <div class="col-xs-3">
                          <div class="qty-box">
                            <div class="input-group">
                              <input type="number" <?php if ($totalStok >= 1) {  ?> max="<?= $totalStok ?>" <?php } else if ($barang->indent == 1) { ?> <?php } else {  ?> max="<?= $totalStok ?>" <?php } ?> name="<?= $i ?>[qty]" class="form-control input-number inputqtymobile" min="1" value="<?= $items['qty'] ?>">

                            </div>
                          </div>
                        </div>
                        <div class="col-xs-3">
                          <h2 class="td-color"><a href="<?= base_url('cart/del/' . $items['rowid']) ?>" class="icon"><i class="fa fa-trash-o fa-lg"></i><!--i class="ti-close"></i--></a>
                          </h2>
                        </div>
                        <div class="col-xs-3">
                          <h5 class="td-color subtotal-<?= $items['id'] ?>">IDR <?= number_format($items['subtotal'], 0, ',', '.') ?></h5>
                        </div>

                        <div class="mobile-cart-content">
                          <select id="dropdown" class="form-select col-12 form-control" aria-label="Default select example" name="alamat">
                            <option selected>Pilih alamat disini... </option>
                            <option value="gudang 1"> Gudang 1 </option>
                            <option value="gudang 2"> Gudang 2 </option>
                          </select>
                        </div>

                      </div>
                    </td>
                    <td>
                      <h2>IDR <?= number_format($items['price'], 0, ',', '.') ?></h2>
                      <?php if ($items['options']['Diskon'] != 0) {  ?>
                        <p style="color:red;"> Diskon : <?= $items['options']['Diskon'] ?> % </p>
                        <p>Price Item : IDR <?= number_format($barang->harga, 0, ',', '.') ?></p>
                      <?php } ?>
                    </td>
                    <td>

                      <div class="qty-box">
                        <div class="input-group">
                          <input type="number" <?php if ($totalStok >= 1) {  ?> max="<?= $totalStok ?>" <?php } else if ($barang->indent == 1) { ?> <?php } else {  ?> max="<?= $totalStok ?>" <?php } ?> name="<?= $i ?>[qty]" class="form-control input-number inputqty" min="1" value="<?= $items['qty'] ?>">
                        </div>
                      </div>
                    </td>
                    <td><a href="<?= base_url('cart/del/' . $items['rowid']) ?>" class="icon"><i class="fa fa-trash-o fa-lg"></i><!--i class="ti-close"></i--></a></td>

                    <td>
                      <h2 class="td-color subtotal-<?= $items['id'] ?>">IDR <?= number_format($items['subtotal'], 0, ',', '.') ?></h2>
                    </td>
                  </tr>

                </tbody>
                <?php $i++; ?>
              <?php endforeach; ?>

            </table>
          </div>
          <table class="table cart-table table-responsive-md">
            <tfoot>
              <tr>
                <td><?= lang('total_price_produk') ?> :</td>
                <td>
                  <h2 class="total_all">IDR <?= number_format($this->cart->total(), 0, ',', '.') ?></h2>
                </td>
              </tr>
            </tfoot>
          </table>
      </div>
    </div>
    <div class="row cart-buttons">
      <div class="col-6">

        <h3 class="loadingupdate">Please Wait ... Update</h3>
        <h3 class="ketersediaanstok" style="color: red;"></h3>
      </div>
      <?php echo form_close() ?>
      <!-- <div class="col-3"><a href="<!?= base_url('product') ?>" class="btn btn-solid">continue shopping</a></div> -->
      <div class="col-6"><a href="#" class="btn btn-solid linknext"><?= lang('check_out_produk') ?></a></div>
      <!--?= base_url('cekout') ?-->
    </div>
  </div>
</section>
<!--section end-->


<script>
  $(document).ready(function() {
    $(".loadingupdate").hide();
  });
  $('.linknext').click(function() {
    var arr;
    if ($("input").hasClass("inputqty")) {
      arr = $('.inputqty').map(function() {
        return this.value
      }).get();
    }
    if ($("input").hasClass("inputqtymobile")) {
      arr = $('.inputqtymobile').map(function() {
        return this.value
      }).get();
    }
    $(".loadingupdate").show();
    //alert(arr);
    postCart(arr);
  });

  $('.inputqty').on('keyup change', function() {
    var arr = $('.inputqty').map(function() {
      return this.value
    }).get();
    $(".loadingupdate").show();
    postCart(arr);
  });

  $('.inputqtymobile').on('keyup change', function() {
    var arrmobile = $('.inputqtymobile').map(function() {
      return this.value
    }).get();
    $(".loadingupdate").show();
    postCart(arrmobile);
  });

  function postCart(arr) {
    console.log(arr);
    $.ajax({
      url: "<?= base_url('CartController/updateCartNew') ?>",
      type: "post",
      data: {
        qty: arr,
      },
      success: function(res, status) {
        var result = JSON.parse(res);
        if (result.success == false) {
          $(".loadingupdate").hide();
          var stock = result.stock;
          // alert("stok Hanya Tersedia" + stock)
          $(".ketersediaanstok").show();

          $('.ketersediaanstok').text("Stock is not enough, available stock :  " + stock);
          $(".linknext").attr('href', '#');
        } else {
          var entries = Object.entries(result.data);
          $(".total_all").text(format1(result.total, 'IDR '));
          entries.forEach(function(message) {
            $(".subtotal-" + message[1].id).text(format1(message[1].subtotal, 'IDR '));
          });
          var link = "<?= base_url('cekout') ?>";
          $(".linknext").attr('href', link);
          $(".loadingupdate").hide();
          $(".ketersediaanstok").hide();
        }


      },
      error: function(xhr) {

      }
    })

    // console.log(arr);
  }

  function format1(n, currency) {
    return currency + n.toFixed(2).replace(/./g, function(c, i, a) {
      return i > 0 && c !== "." && (a.length - i) % 3 === 0 ? "," + c : c;
    });
  }
  $.get("<?php echo base_url('CekOutController/set_session_voucher') ?>", function(result) {
    console.log(result);
  });
</script>