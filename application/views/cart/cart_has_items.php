<!--section start-->
<form id="cartform" action="<?= base_url('cart/update') ?>" method="post">
    <div class="grid md:grid-cols-2 gap-[50px]">
        <!-- Column 1 -->
        <div class="grid gap-3 cart-items">
            <?php
            $i = 1;
            $j = 0;
            ?>
            <?php foreach ($this->cart->contents() as $items) : ?>

                <?php
                // var_dump($items);

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

                <!-- Card Product -->
                <div id-product="<?php echo $items['id'] ?>" id-product-attribute="<?php echo $items['options']['Size'] ?>" class="relative grid bg-white border-2 border-[#e9e9e9] rounded-[10px] shadow-md overflow-hidden">
                    <!-- Delete Column -->
                    <div class="absolute top-0 right-0 p-3">
                        <a href="<?= base_url('cart/del/' . $items['rowid']) ?>">
                            <div class="bg-[#ff4a47] aspect-square w-[40px] flex justify-center items-center text-white rounded-[10px]">
                                <i class="fa fa-trash-o fa-lg"></i>
                            </div>
                        </a>
                    </div>
                    <!-- Info -->
                    <div class="p-3">
                        <div class="flex gap-4">
                            <div>
                                <div class=" aspect-square w-[60px] md:w-[100px] relative border-[3px]  rounded-md overflow-hidden shadow-md">
                                    <a href="<?= base_url() ?>product/detail/<?= $barang->id_product ?>">
                                        <img src="<?= smn_baseurl() ?>uploads/product/<?= $barang->image_one ?>" class=" object-cover w-full h-full absolute">
                                    </a>
                                </div>
                            </div>
                            <div class="">
                                <!-- Product Name -->
                                <div class="text-[15px] font-bold">
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
                    <!-- Action -->

                    <div class="p-3 flex gap-4 max-w-full overflow-x-auto">
                        <?php if ($this->ion_auth->logged_in()) : ?>
                            <div class="flex items-center gap-2 w-full overflow-hidden">
                                <div class="text-[#a4a4a4]">Address: </div>

                                <select id="select_<?php echo $j; ?>" name="select_<?= $j ?>" class="select-alamat-pengiriman rounded-[10px] bg-[#e5e5e5] p-2 h-full w-full">
                                    <option value="">Pilih Alamat</option>
                                    <?php foreach ($items['available_store'] as $store) : ?>
                                        <option value="G-<?php echo $store['id_store'] ?>" <?php echo $items['id_alamat'] == ("G-" . $store['id_store']) ? "selected" : '' ?>>
                                            <?php echo $store['nama_store'] ?> : Self Pickup
                                        </option>
                                    <?php endforeach; ?>

                                    <?php foreach ($list_alamat as $address) : ?>

                                        <?php
                                        // Selected dropdown
                                        $selected = false;
                                        if (isset($items['id_alamat'])) {
                                            if ($items['id_alamat'] == $address->id) {
                                                $selected = true;
                                            } else {
                                                $selected = false;
                                            }
                                        }
                                        ?>
                                        <option value="<?= $address->id ?>" <?php echo $selected ? "selected" : "" ?>>
                                            <?= $address->label_alamat . ' - ' . $address->penerima . ' - ' . $address->alamat ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        <?php endif ?>
                        <!-- QTY & Select Address -->
                        <div class="flex items-center gap-2">
                            <?php
                            // Get Total Stock & Max Stock
                            $max_stock_htmlAttr = "";
                            if ($totalStok >= 1) {
                                $max_stock_htmlAttr = "max='$totalStok'";
                            } else if ($barang->indent == 1) {
                            } else {
                                $max_stock_htmlAttr = "max='$totalStok'";
                            }
                            ?>
                            <div class="text-[#a4a4a4]">Qty: </div>
                            <input type="number" name="<?= $i ?>[qty]" class="input-number inputqty rounded-[10px] bg-[#e5e5e5] p-2 text-center w-[70px]" min="1" value="<?php echo $items['qty'] ?>" <?php echo $max_stock_htmlAttr ?>>
                        </div>


                    </div>
                    <div class="trigger-info hidden">
                        <div class="message p-3 py-2">

                        </div>
                    </div>
                </div>

                <?php $i++; ?>

            <?php endforeach; ?>

            <?php if ($this->ion_auth->logged_in()) : ?>
                <div class="mt-3">
                    <span>
                        <?php echo empty($list_alamat) ? "You need to set the shipping address," : "You have registered the address," ?>
                    </span>
                    <span class=" underline text-blue-400 hover:text-blue-500 cursor-pointer" data-toggle="modal" data-target="#tambahAlamatModal">
                        Set-up shipping address
                    </span>
                </div>
            <?php endif; ?>
        </div>

        <!-- Column 2 -->
        <div>
            <div class="font-bold text-[24px]">Ringkasan Belanja</div>
            <div id="cart-summary" class="py-[20px]">
                <!-- Ringkasan Belanja -->
            </div>
            <div class=" flex md:flex-row md:items-center md:gap-[20px] flex-col items-end justify-end ">
                <div>
                    <!-- <?= lang('total_price_produk') ?> : -->
                </div>
                <div class="total_all text-[32px]  font-bold ">
                    IDR <?= number_format($this->cart->total(), 0, ',', '.') ?>
                </div>
            </div>
            <div class="flex justify-end mt-[20px]">
                <button type="button" class="btn-checkout py-[10px] px-[25px] capitalize font-bold bg-[#416A25] hover:bg-[#5dc75d] text-white rounded-full">
                    <?= lang('check_out_produk') ?>
                </button>
                <!-- <a href="#" class="btn btn-solid linknext">
                  <?= lang('check_out_produk') ?>
                </a> -->
            </div>
        </div>
    </div>

    <div class="mt-[30px] last:flex justify-between">
        <div>
            <div class="loadingupdate">Please Wait ... Update</div>
            <div class="ketersediaanstok" style="color: red;"></div>
        </div>
    </div>
</form>
<!--section end-->

<!-- Modal Alamat Pengiriman -->
<div class="modal fade" id="tambahAlamatModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Alamat Pengiriman</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- List Alamat -->
                <div class="onList" style="display: flex; gap: 10px; flex-direction: column;">

                    <?php
                    $i = 0;
                    ?>
                    <?php foreach ($list_alamat as $item) : ?>
                        <div class="card" data-card-id="<?= $item->id ?>">
                            <div class="p-3">
                                <!-- <span class="close-button" onclick="closeCard(this)">X</span> -->
                                <div class="mb-4">
                                    <div class="card-title">
                                        <span class="font-bold"><?= $item->label_alamat ?></span>
                                        <?php if ($item->main_address) : ?>
                                            <span>( Main Address )</span>
                                        <?php endif ?>
                                    </div>
                                    <div class="text-[12px] text-[grey]">
                                        <b>Address : </b><br>
                                        <span class="penerima"><?= $item->penerima ?></span><br>
                                        <span class="alamat"><?= $item->alamat ?></span>
                                    </div>
                                </div>
                                <!-- <div class="btn btn-outline-primary edit-card">Edit Alamat</div> -->
                                <div class="flex gap-4 items-center justify-end">
                                    <?php if (!$item->main_address) : ?>
                                        <a href="<?php echo base_url() . "ControllerAlamatPengiriman/set_default/$item->id" ?>">
                                            Set as Default
                                        </a>
                                    <?php else : ?>
                                        <a href="<?php echo base_url() . "ControllerAlamatPengiriman/unset_default/$item->id" ?>">
                                            Unset Default Address
                                        </a>
                                    <?php endif ?>
                                    <div class=" cursor-pointer aspect-square w-[30px] bg-[red] text-white flex items-center justify-center delete-card rounded-md"><i class="fa fa-trash-o fa-lg"></i></div>
                                </div>
                            </div>
                        </div>
                        <?php $i++; ?>
                    <?php endforeach; ?>

                    <?php if ($i < 3) : ?>
                        <div class="mt-3">
                            <button type="button" class="btn btn-outline-primary add-card">Tambah Alamat</button>
                        </div>
                    <?php endif; ?>
                </div>
                <!-- END - List Alamat -->

                <!-- Form Edit -->
                <div class="onEdit d-none" style="display:flex; flex-direction:column; gap:10px">
                    <form id="inputAlamat" method="post">
                        <div class="row" style="margin:0;gap:10px">
                            <input type="hidden" class="form-control" id="apID" name="id">
                            <div class="col p-0">
                                <label for="apLabel">Label</label>
                                <input type="text" class="form-control" id="apLabel" name="label">
                            </div>
                            <div>
                                <label for="apPenerima">Penerima</label>
                                <input type="text" class="form-control" id="apPenerima" name="receiver">
                            </div>
                        </div>
                        <div>
                            <label for="provinsiDropdown">Provinsi</label>
                            <select id="provinsiDropdown" class="form-control" name="province">
                                <option value="">Pilih Provinsi</option>
                            </select>
                        </div>
                        <div>
                            <label for="cityDropdown">Kab/Kota</label>
                            <select id="cityDropdown" class="form-control" name="city">
                                <option value="">Pilih Kab/Kota</option>
                            </select>
                        </div>
                        <div>
                            <label for="subdisctrictDropdown">Kecamatan</label>
                            <select id="subdisctrictDropdown" class="form-control" name="subdistrict">
                                <option value="">Pilih Kecamatan</option>
                            </select>
                        </div>
                        <div class="row" style="margin:0;">
                            <div style="width: 50%;">
                                <label for="apKodepos">Kode Pos</label>
                                <input type="text" class="form-control" id="apKodepos" name="postal_code">
                            </div>
                        </div>
                        <div>
                            <label for="apDetailAlamat">Detail Alamat</label>
                            <textarea class="form-control" id="apDetailAlamat" name="detail_address"></textarea>
                        </div>

                        <div>
                            <button type="submit" class="btn btn-outline-primary ">Simpan Alamat</button>
                            <div type="button" class="btn btn-outline-danger cancel-edit-card" data-toggle="modal" data-target="#editCardModal">Batal</div>
                        </div>
                    </form>


                </div>
                <!-- END - Form Edit -->
            </div>
        </div>
    </div>
</div>


<script>
    // Cart Update
    $(".loadingupdate").hide();

    // Ketika Select Alamat
    $(".select-alamat-pengiriman").on("change", function() {
        var arrayIdAlamat;
        if ($("select").hasClass("select-alamat-pengiriman")) {
            arrayIdAlamat = $('.select-alamat-pengiriman').map(function() {
                return this.value
            }).get();
        }
        update_alamat(arrayIdAlamat);
    });

    function update_alamat(data) {
        // dipush tanpa id, diupdate sesuai urutan
        $.ajax({
            url: "<?= base_url('CartController/update_address') ?>",
            type: "post",
            data: {
                id_alamat: data,
            },
            success: function(res, status) {
                var result = JSON.parse(res);
                console.log(result)
            },
            error: function(xhr) {},
            complete: function() {
                // window.location.reload()
            }
        })
    }

    // Alamat Pengiriman
    getProvince()

    $('#provinsiDropdown').change(function() {
        var selectedProvinceId = $(this).val();
        if (selectedProvinceId) {
            getCity(selectedProvinceId);
        } else {
            $('#cityDropdown').empty();
            $('#subdisctrictDropdown').empty();
        }
    });
    $('#cityDropdown').change(function() {
        var selectedCityId = $(this).val();
        if (selectedCityId) {
            getSubDistrict(selectedCityId);
        } else {
            $('#subdisctrictDropdown').empty();
        }
    });

    $('.onList .add-card').on('click', function() {
        $('.onList').addClass('d-none');
        $('.onEdit').removeClass('d-none');
    });

    $('.onList .edit-card').on('click', function() {
        let card = event.target.closest('.card');
        if (card) {
            let cardId = card.getAttribute('data-card-id');
            $('.onList').addClass('d-none');
            $('.onEdit').removeClass('d-none');
            getAlamatPengirimanByID(cardId)
        }
    });

    $('.onList .delete-card').on('click', function() {
        let card = event.target.closest('.card');
        if (card) {
            let cardId = card.getAttribute('data-card-id');
            // $('.onList').addClass('d-none');
            // $('.onEdit').removeClass('d-none');
            deleteAlamatPengirimanByID(cardId);
            // window.location.reload();
        }
    });

    $('.cancel-edit-card').on('click', function() {
        $('.onList').removeClass('d-none');
        $('.onEdit').addClass('d-none');
    });

    $('#inputAlamat').submit(function(e) {
        e.preventDefault(); // Mencegah perilaku default dari form submit

        var $form = $(this);
        var $submitButton = $form.find('button[type="submit"]');
        $submitButton.prop('disabled', true); // Menonaktifkan tombol submit

        var formData = $(this).serialize(); // Mengambil data form     

        var extraData = {
            'province_name': $form.find('#provinsiDropdown').find(':selected').text(),
            'city_name': $form.find('#provinsiDropdown').find(':selected').text(),
            'subdistrict_name': $form.find('#provinsiDropdown').find(':selected').text(),
        };

        $.ajax({
            type: 'POST',
            url: 'ControllerAlamatPengiriman/add',
            data: formData + '&' + $.param(extraData),
            success: function(response) {
                console.log(response);
                alert('Berhasil menambahkan alamat.')
                window.location.reload();

            },
            error: function() {
                console.log('Error submitting form');
            },
            complete: function() {
                $submitButton.prop('disabled', false); // Mengaktifkan kembali tombol submit

            }
        });
    });

    function getAlamatPengirimanByID(id) {
        $.ajax({
            type: 'GET',
            url: `<?php echo base_url() ?>ControllerAlamatPengiriman/get?id=${id}`,
            dataType: 'json',
            success: function(response) {
                response = (response)[0]
                $('#apLabel').val(response.label_alamat)
                $('#apPenerima').val(response.penerima)
                // $('#apProvinsi').val(response.id)
                // $('#apKabKota').val(response.id)
                // $('#apKec').val(response.id)
                // $('#apKodepos').val(response.id)
            },
        });
    }

    function deleteAlamatPengirimanByID(id) {
        $.ajax({
            url: `<?php echo base_url() ?>ControllerAlamatPengiriman/delete`,
            dataType: 'json',
            type: 'POST',
            data: {
                'id': id,
            },
            success: function(response) {
                // console.log(response);
                alert('Berhasil menghapus alamat.')
            },
        });
    }

    function getProvince() {
        $.ajax({
            url: `<?php echo base_url() ?>ControllerCheckOngkir/getProvince`,
            type: 'GET',
            dataType: 'json',
            cache: true,
            success: function(response) {
                response = response.results
                var dropdown = $('#provinsiDropdown');
                dropdown.empty();
                dropdown.append($('<option>').val('').text('Pilih Provinsi'));
                $.each(response, function(key, item) {
                    dropdown.append($('<option>').val(item.province_id).text(item.province));
                });
            },
            error: function() {
                // console.log('Error fetching data');
            }
        });
    }

    function getCity(provinceId) {
        $.ajax({
            url: `<?php echo base_url() ?>ControllerCheckOngkir/getCity?province=${provinceId}`,
            type: 'GET',
            dataType: 'json',
            cache: true,
            success: function(response) {
                response = response.results
                var dropdown = $('#cityDropdown');
                dropdown.empty();
                dropdown.append($('<option>').val('').text('Pilih Kab/Kota'));
                $.each(response, function(key, item) {
                    dropdown.append($('<option>').val(item.city_id).text(`${item.type} ${item.city_name}`));
                });
            },
            error: function() {
                // console.log('Error fetching data');
            }
        });
    }

    function getSubDistrict(cityId) {
        $.ajax({
            url: `<?php echo base_url() ?>ControllerCheckOngkir/getSubdistrict?city=${cityId}`,
            type: 'GET',
            dataType: 'json',
            cache: true,
            success: function(response) {
                response = response.results
                var dropdown = $('#subdisctrictDropdown');
                dropdown.empty();
                dropdown.append($('<option>').val('').text('Pilih Kecamatan'));
                $.each(response, function(key, item) {
                    dropdown.append($('<option>').val(item.subdistrict_id).text(item.subdistrict_name));
                });
            },
            error: function() {
                // console.log('Error fetching data');
            }
        });
    }

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

        $(".loadingupdate").show();
        //alert(arr);
        postCart(arr);
    });

    function format1(n, currency) {
        return currency + n.toFixed(2).replace(/./g, function(c, i, a) {
            return i > 0 && c !== "." && (a.length - i) % 3 === 0 ? "," + c : c;
        });
    }
    $.get("<?php echo base_url('CekOutController/set_session_voucher') ?>", function(result) {
        console.log(result);
    });
</script>