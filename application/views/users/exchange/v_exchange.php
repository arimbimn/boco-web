<!-- breadcrumb start -->
<div class="breadcrumb-section">
  <div class="container">
    <div class="row">
      <div class="col-sm-6">
        <div class="page-title">
          <h2><?= lang('title_exchange_user') ?></h2>
        </div>
      </div>
      <div class="col-sm-6">
        <nav aria-label="breadcrumb" class="theme-breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('/') ?>"><?= lang('beranda') ?> </a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('/users') ?>"><?= lang('my_account') ?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= lang('title_exchange_user') ?> </li>
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
    <div class="row">
      <div class="col-lg-3">
        <div class="account-sidebar"><a class="popup-btn"> <i class="fa fa-bars"></i> <?= lang('MyAccount') ?></a></div>
        <div class="dashboard-left">
          <div class="collection-mobile-back"><span class="filter-back"><i class="fa fa-angle-left" aria-hidden="true"></i><?= lang('back') ?></span></div>
          <div class="block-content">
            <?php $this->load->view('users/v_menu_user') ?>
          </div>
        </div>
      </div>
      <div class="col-lg-9">
        <div class="dashboard-right">
          <div class="dashboard">
            <div class="page-title">
              <h2><?= lang('title_exchange_user') ?></h2>
            </div>


            <!-- product-tab starts -->
            <section class="tab-product m-0">
              <div class="container">
                <div class="row">
                  <div class="col-sm-12 col-lg-12">
                    <ul class="nav nav-tabs nav-material" id="top-tab" role="tablist">
                      <li class="nav-item"><a class="nav-link active" id="top-home-tab" href="#" role="tab" aria-selected="true"><?= lang('new_exchange_exchange_user') ?></a>
                        <div class="material-border"></div>
                      </li>
                      <li class="nav-item"><a class="nav-link" id="profile-top-tab" href="<?= base_url('users/exchangehistory') ?>" role="tab" aria-selected="false"><?= lang('history_exchange_user') ?></a>
                        <div class="material-border"></div>
                      </li>
                    </ul>
                    <?= form_open('users/exchangesave') ?>
                    <div class="tab-content nav-material" id="top-tabContent">
                      <div class="tab-pane fade show active" id="top-home" role="tabpanel" aria-labelledby="top-home-tab">
                        <br>

                        <div class="form-row">
                          <div class="col-md-6">
                            <label for="name"><?= lang('invoice_order') ?></label>
                            <!-- <input type="text" class="form-control" name="invoice_order" id="name" value="<?= set_value('invoice_order') ?>" placeholder="<?= lang('example') ?> : ORD/20210118/8/BFQX" required=""> -->
                            <select class="form-control" name="invoice_order" id="invoice_order" data-placeholder="Select No Invoice" required="">
                              <option value=""></option>
                              <?php if ($invoice) { ?>
                                <?php foreach ($invoice as $item_v) { ?>
                                  <option kav="<?= $item_v->id_order ?>" value="<?= $item_v->kode_order ?>"><?= $item_v->kode_order ?></option>
                                <?php } ?>
                              <?php } ?>
                            </select>
                            <?= form_error('invoice_order', '<small class="text-danger">', '</small>') ?>
                          </div>
                          <div class="col-md-6">
                            <label for="email"><?= lang('item_code_exchange_user') ?></label>
                            <select class="form-control" name="kode_barang" id="kode_barang" data-placeholder="Select kode barang" required="">
                              <option value=""></option>
                            </select>

                            <?= form_error('kode_barang', '<small class="text-danger">', '</small>') ?>
                          </div>

                          <div class="col-md-12">
                            <label for="review"><?= lang('alasan_exchange_user') ?></label>
                            <textarea class="form-control mb-0" name="alasan" id="exampleFormControlTextarea1" placeholder="<?= lang('alasan_excange') ?>" rows="6"><?= set_value('alasan') ?></textarea>
                            <?= form_error('alasan', '<small class="text-danger">', '</small>') ?>
                          </div>
                          <br>
                          <br>
                          <div class="col-md-12">
                            <br>
                            <button class="btn btn-sm btn-solid" type="submit"><?= lang('kirim') ?></button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <?= form_close() ?>
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
  $(document).ready(function() {

    $("#invoice_order").change(function() {
      // var aid = $("#external_id").val();
      var kav = $("#invoice_order option:selected").attr("kav");
      console.log(kav);

      $.ajax({
        url: "<?= base_url() ?>/OrderController/getItemOrder/" + kav,
        method: 'get',
      }).done(function(books) {
        console.log(books);
        books = JSON.parse(books);
        $('#kode_barang').empty();
        books.forEach(function(book) {
         // $('#kode_barang').append('<option  value="' + book.barcode + '" >' + book.barcode + ' | ' + book.nama_barang + '</option>');
         $('#kode_barang').append('<option  value="' + book.product_id+'-'+book.id_product_attribute+ '" >' + book.product_id + ' | ' + book.nama_barang + ' | ' + book.size +'</option>');
        })
      })
    })

  })
</script>