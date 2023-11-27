<style>
  /* Ini adalah CSS yang akan tampil di semua layar, termasuk desktop */

  @media (min-width: 768px) {
    .show-on-mobile {
      display: none;
      /* Menampilkan baris pada versi desktop */
    }

    .close-button {
      position: absolute;
      top: 10px;
      right: 20px;
      cursor: pointer;
      font-size: 18px;
      color: #ff0000;
    }
  }

  /* Ini adalah CSS yang hanya akan tampil pada layar dengan lebar kurang dari atau sama dengan 768 piksel (versi mobile) */
  @media (max-width: 768px) {
    .show-on-mobile {
      display: table-row;
      /* Menampilkan baris pada versi mobile */
    }

    .dropdown {
      display: block;
      visibility: visible;
    }

    .ukuran-besar {
      width: 300px;
      height: 40px;
      font-size: 18px;
    }

    .horizontal-container {
      display: flex;
      flex-direction: row;
      /* Mengatur arah menjadi horizontal */
      flex-wrap: nowrap;
      /* Jangan pindah ke baris berikutnya */
    }

    .horizontal-item {
      flex: 1;
      /* Membagi lebar secara rata */
      margin: 10px;
      /* Jarak antar item */
      border: 1px solid #ccc;
      /* Garis pembatas antar item */
      padding: 10px;
    }

    .close-button {
      position: absolute;
      top: 10px;
      right: 20px;
      cursor: pointer;
      font-size: 18px;
      color: #ff0000;
    }


    /* Anda juga dapat menambahkan CSS lainnya yang hanya berlaku di versi mobile di sini */

  }
</style>
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

      <div class="col-lg-12 col-sm-12 col-xs-12">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-danger float-right" data-toggle="modal" data-target="#myModal">
          Tambah Alamat
        </button>
      </div>

      <?php if ($option1) { ?>
        <div class="card-group">
          <div class="card">
            <div class="card-body">
              <div class="container">
                <div class="row card-data">
                  <?php foreach ($option1 as $option2) : ?>
                    <div class="card-group">
                      <div class="card" data-card-id="<?= $option2->id ?>">
                        <div class="card-body">
                          <span class="close-button" onclick="closeCard(this)">X</span>
                          <h5 class="card-title"><?= $option2->label_alamat ?></h5>
                          <p class="card-text">
                            <strong>Penerima:</strong> <span class="penerima"><?= $option2->penerima ?></span><br>
                            <strong>Alamat:</strong> <span class="alamat"><?= $option2->alamat ?></span>
                          </p>
                          <button class="btn btn-outline-danger edit-card" data-toggle="modal" data-target="#editCardModal">Edit Alamat</button>
                        </div>
                      </div>
                    </div>
                  <?php endforeach; ?>
                </div>
              </div>

              <div class="modal fade" id="editCardModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Edit Card Details</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form id="editCardForm">
                        <div class="form-group">
                          <label for="editLabelAlamat">Label Alamat Pengiriman</label>
                          <input type="text" class="form-control" id="editLabelAlamat" name="label_alamat">
                        </div>
                        <div class="form-group">
                          <label for="editPenerima">Nama Penerima</label>
                          <input type="text" class="form-control" id="editPenerima" name="penerima">
                        </div>
                        <div class="form-group">
                          <label for="editAlamat">Alamat Tujuan</label>
                          <input type="text" class="form-control" id="editAlamat" name="alamat">
                        </div>
                      </form>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                      <button type="button" class="btn btn-danger" id="updatealamat">Simpan Perubahan</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php } ?>
      <div class="col-sm-12">
        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Masukkan Alamat Anda</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form>
                  <div class="form-group">
                    <label for="labelalamat">Label Alamat Pengiriman</label>
                    <input type="text" class="form-control" id="labelalamat" placeholder="Masukkan Jenis Alamat">
                  </div>
                  <div class="form-group">
                    <label for="namapenerima">Nama Penerima</label>
                    <input type="text" class="form-control" id="namapenerima" placeholder="Masukkan Nama Penerima">
                  </div>
                  <div class="form-group">
                    <label for="alamatpenerima">Alamat Tujuan</label>
                    <input type="text" class="form-control" id="alamatpenerima" placeholder="Masukkan Alamat Tujuan">
                  </div>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-danger" id="simpanData">Simpan</button>
              </div>
            </div>
          </div>
        </div>

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

              <?php $i = 1;
              $ii = 0; ?>

              <?php foreach ($this->cart->contents() as $items) : ?>

                <?php $i++; ?>

                <?php $barang = $this->M_product->get_detailproduct($items['id']) ?>
                <?php $totalStok = 0; ?>
                <?php $cekTotal = $this->db->select_sum('jumlah_stok')->where(['id_store' => 100])->where(['id_product' => $items['id']])->where(['id_product_attribute' => $items['options']['Size']])->get('product_stok')->row(); ?>
                <?php if ($cekTotal->jumlah_stok >= 1) {  ?>
                  <?php $totalStok = $cekTotal->jumlah_stok ?>
                <?php } ?>
                <tbody>
                  <tr style="height: 1px;">
                    <td class="" style="height: inherit;">
                      <!--div style="background-color: red; height: 100%;position: relative;"-->
                      <div style="height: 100%;position: relative;">
                        <a href="<?= base_url() ?>product/detail/<?= $barang->id_product ?>"><img src="<?= smn_baseurl() ?>uploads/product/<?= $barang->image_one ?>" alt="" style="object-fit: cover;"></a>
                        <!--div class="mobile-cart-content" style="background-color: green;position: absolute;bottom: 0;width:100%;"-->
                        <div class="mobile-cart-content" style="position: absolute;bottom: 0;width:100%">
                          <b>Alamat pengiriman</b>
                        </div>
                      </div>
                    </td>

                    <td class="">
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
                          <h2 class="td-color"><a href="<?= base_url('cart/del/' . $items['rowid']) ?>" class="icon"><i class="fa fa-trash-o fa-lg"></i></a>
                          </h2>
                        </div>
                        <div class="col-xs-3">
                          <h5 class="td-color subtotal-<?= $items['id'] ?>">IDR <?= number_format($items['subtotal'], 0, ',', '.') ?></h5>
                        </div>
                      </div>
                      <div class="mobile-cart-content">
                        <select id="select_<?php echo $ii; ?>" class="form-select col-12 form-control select-update" aria-label="Default select example" name="alamat">
                          <option selected>Pilih alamat disini... </option>
                          <option value="gudang 1"> Gudang 1 </option>
                          <option value="gudang 2"> Gudang 2 </option>
                          <?php foreach ($option1 as $option2) : ?>
                            <option value="<?= $option2->label_alamat . ' - ' . $option2->penerima . ' - ' . $option2->alamat ?>"><?= $option2->label_alamat . ' - ' . $option2->penerima . ' - ' . $option2->alamat ?></option>
                          <?php endforeach; ?>
                        </select>
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
                    <td><a href="<?= base_url('cart/del/' . $items['rowid']) ?>" class="icon"><i class="fa fa-trash-o fa-lg"></i></a></td>

                    <td>
                      <h2 class="td-color subtotal-<?= $items['id'] ?>">IDR <?= number_format($items['subtotal'], 0, ',', '.') ?></h2>
                    </td>
                  </tr>
                  <!--tr><td colspan="6"><b>Alamat pengiriman</b></td></tr-->
                  <tr class="bg-light">
                    <td colspan="6">
                      <div>
                        <h5>Alamat pengiriman <?= $items['name'] ?></h5>
                      </div>
                      <div>
                        <select id="select_<?php echo $ii; ?>" class="form-select col-12 form-control select-update dropdown-divider" aria-label="Default select example" name="alamat">
                          <option selected>Pilih alamat disini </option>
                          <option value="gudang 1"> Gudang 1 </option>
                          <option value="gudang 2"> Gudang 2 </option>
                          <?php foreach ($option1 as $option2) : ?>
                            <option value="<?= $option2->label_alamat . ' - ' . $option2->penerima . ' - ' . $option2->alamat ?>"><?= $option2->label_alamat . ' - ' . $option2->penerima . ' - ' . $option2->alamat ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
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
      <!-- <div class="col-3"><a href="<?= base_url('product') ?>" class="btn btn-solid">continue shopping</a></div> -->
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
    //alert(arr);
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


  $('#simpanData').click(function() {
    var lbl_alamat = $('#labelalamat').val();
    var penerima = $('#namapenerima').val();
    var alamat_penerima = $('#alamatpenerima').val();
    $.ajax({
      url: '<?php echo base_url() ?>CartController/save_alamat_pengiriman',
      type: 'POST',
      data: {
        'lbl_alamat': lbl_alamat,
        'penerima': penerima,
        'alamat_penerima': alamat_penerima
      },
      dataType: 'json',
      cache: false,
      success: function(result) {
        if (result) {
          //$('#resultContainer').text('Data Baru: ' + result.label_alamat + ' - ' + result.penerima + "-" + result.alamat);
          var selectElements = $(".select-update");

          selectElements.each(function() {
            var select = $(this);
            select.empty();
            select.append($('<option>').text("Pilih data"));
            $.each(result, function(key, value) {
              select.append($('<option>').text(value.label_alamat + "-" + value.penerima + "-" + value.alamat).val(value.id));
            });
          });
          alert('berhasil tersimpan');
        } else {
          alert('gagal tersimpan');
        }
      },
      error: function(result) {
        alert("Error");
      }
    });
    tampil_alamat();
    $('#myModal').modal('hide');

  });

  function tampil_alamat() {
    $.ajax({
      url: '<?php echo base_url() ?>CartController/get_alamat_div',
      type: 'POST',
      dataType: 'json',
      cache: false,
      success: function(result) {
        if (result) {
          //$('#resultContainer').text('Data Baru: ' + result.label_alamat + ' - ' + result.penerima + "-" + result.alamat);
          var selectElements = $(".card-data");

          selectElements.each(function() {
            var div = $(this);
            div.empty();
            $.each(result, function(key, value) {
              var cardHTML = '<div class="card-group">' +
                '<div class="card" data-card-id="' + value.id + '">' +
                '<div class="card-body">' +
                '<h5 class="card-title">' + value.label_alamat + '</h5>' +
                '<p class="card-text">' +
                '<strong>Penerima:</strong> <span class="penerima">' + value.penerima + '</span><br>' +
                '<strong>Alamat:</strong> <span class="alamat">' + value.alamat + '</span>' +
                '</p>' +
                '<button class="btn btn-outline-danger edit-card" data-toggle="modal" data-target="#editCardModal">Edit Alamat</button>' +
                '</div>' +
                '</div>' +
                '</div>';

              div.append(cardHTML);
            });
          });
          //alert('berhasil tersimpan');
        } else {
          //alert('gagal tersimpan');
        }
      },
      error: function(result) {
        alert("Error");
      }
    });
  }

  // mengedit alamat yang tersimpan

  $('.edit-card').click(function() {
    //mencari card terdekan dengan tombol untuk update
    var card = $(this).closest('.card-group');

    // mengambil data dari elemen card
    var lbl_alamat = card.find('.card-title').text();
    var penerima = card.find('.penerima').text();
    var alamat_penerima = card.find('.alamat').text();

    // Set the values di bagian input form dalam modal
    $('#editLabelAlamat').val(lbl_alamat);
    $('#editPenerima').val(penerima);
    $('#editAlamat').val(alamat_penerima);

    // menyimpan elemen card dalam variabel
    var cardToUpdate = card.data('card-id');
    $('#editCardModal').data('cardToUpdate', cardToUpdate);

    // menampilkan modal
    $('#editCardModal').modal('show');
  });

  // mengambil data terbaru yang disimpan pada saat input untuk edit alamat
  $('#updatealamat').click(function() {

    // mengambil elemen card yang simpan pada saat klik tombol edit alamat
    var cardToUpdate = $('#editCardModal').data('cardToUpdate');

    // mengambil data terbaru dari modal yang diinput
    var lbl_alamat = $('#editLabelAlamat').val();
    var penerima = $('#editPenerima').val();
    var alamat_penerima = $('#editAlamat').val();

    $.ajax({
      url: '<?php echo base_url() ?>CartController/update_alamat_pengiriman',
      type: 'POST',
      data: {
        'row_id': cardToUpdate,
        'lbl_alamat': lbl_alamat,
        'penerima': penerima,
        'alamat_penerima': alamat_penerima
      },
      dataType: 'json',
      cache: false,
      success: function(result) {
        if (result) {
          // update isi hanya pada card yang di klik
          var updatedCard = $('.card[data-card-id="' + cardToUpdate + '"]');
          updatedCard.find('.card-title').text(lbl_alamat);
          updatedCard.find('.penerima').text(penerima);
          updatedCard.find('.alamat').text(alamat_penerima);

          alert('Alamat berhasil diubah');
        } else {
          alert('Alamat gagal diubah');
        }
      },
      error: function(result) {
        alert('Error');
      }
    });

    $('#editCardModal').modal('hide');
  });

  function closeCard(button) {
    const card = button.parentElement.parentElement;
    card.style.display = 'none';
  }
</script>