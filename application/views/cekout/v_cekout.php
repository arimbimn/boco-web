<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<style>
    .btn {
        text-transform: capitalize;
    }

    .btn-order {
        width: 100%;
    }
</style>

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
        <div class="row">
            <div class="col-lg-6 col-xs-6 p-1">
                <h4> Detail Pengiriman </h4>
                <?php
                $i = 1;
                $qty = 0;
                $jml_potongan = 0; //ebe
                $jml_disc = 0;
                // // var_dump($this->cart->contents());
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
                    <?php $size = $this->db->where(['id_product_attribute' => $items['options']['Size']])->get('product_attribute')->row(); ?>
                    <div class="card box-shadow border-danger mb-2 qty">
                        <div class="card-body">
                            <strong><?= $items['name'] ?></strong> | <span> <?= $size->size ?> </span> | <span> color </span>
                            <hr>
                            <strong> nama penerima </strong>
                            <br>
                            <p> alamat tujuan </p>
                            <button class="btn btn-danger" type="button" data-toggle="collapse" data-target="#itemList" aria-expanded="false" aria-controls="itemList">
                                Pilih Jasa Ekspedisi
                            </button>

                            <div class="collapse" id="itemList">
                                <ul class="list-group">
                                    <li class="list-group-item">JNE</li>
                                    <li class="list-group-item">JNT</li>
                                    <li class="list-group-item">TIKI</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="card box-shadow border-danger">
                        <div class="col-lg-12 col-xs-12">
                            <strong> Metode Pembayaran </strong>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                                <img src="<?= base_url('/assets/images/icon-metode/bank.png') ?>" width="10%" />
                                <label class="form-check-label" for="flexSwitchCheckDefault"> Bank Transfer</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                                <img src="<?= base_url('/assets/images/icon-metode/wallet.png') ?>" width="10%" />
                                <label class="form-check-label" for="flexSwitchCheckDefault"> E-Wallet</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                                <img src="<?= base_url('/assets/images/icon-metode/visa.png') ?>" width="10%" alt="">
                                <img src="<?= base_url('/assets/images/icon-metode/mastercard.png') ?>" width="10%" alt="">
                                <img src="<?= base_url('/assets/images/icon-metode/jcb.png') ?>" width="10%" alt="">
                                <label class="form-check-label" for="flexSwitchCheckDefault"></label>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="col-lg-6 col-xs-6 p-1">
                <h4> Ringkasan </h4>
                <div class="card box-shadow border-danger mb-2">
                    <div class="card-body">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td><strong> <?= $items['name'] ?> </strong> <br> <small> Ongkir : </small></td>
                                    <td><?= $items['qty'] ?></td>
                                    <td> IDR <?= number_format($barang->harga, 0, ',', '.') ?></td>
                                </tr>
                        </table>
                    <?php endforeach; ?>
                    <dl class="row">
                        <dt class="col-sm-5">Subtotal :</dt>
                        <dd class="col-sm-7"> IDR <?= number_format($this->cart->total(), 0, ',', '.'); ?></dd>

                        <dt class="col-sm-5">Biaya Admin :</dt>
                        <dd class="col-sm-7"> <?php if ($this->session->userdata('metode_admin')) { ?>
                                IDR <?php echo number_format($this->session->userdata('biaya_admin') * $this->cart->total(), 0, ',', '.') ?>
                            <?php } ?></dd>
                        </dd>

                        <dt class="col-sm-5">Diskon :</dt>
                        <dd class="col-sm-7"> </dd>

                        <dt class="col-sm-5">Total Pembayaran :</dt>
                        <dd class="col-sm-7"> <?php $adm = ($this->session->userdata('biaya_admin')) ? $this->session->userdata('biaya_admin') * $this->cart->total() : 0 ?>
                            IDR <?= number_format($this->cart->total() + $adm, 0, ',', '.'); ?></dd>
                    </dl>
                    <div class="row mb-2">
                        <div class="col-lg-7 col-sm-7 col-xs-7">
                            <form>
                                <div class="mb-3">
                                    <input type="text" class="form-control" id="voucher" placeholder=" masukkan voucher disini">
                                </div>
                        </div>
                        <div class="col-lg-5 col-sm-5 col-xs-5">
                            <button type="submit" class="btn btn-danger">Gunakan Voucher</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-xs-6 float-right">
                            <button type="submit" class="btn btn-outline-danger">Voucher Lainnya </button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8 mt-2">
                            <button type="submit" class="btn btn-danger btn-order">Buat Pesanan</button>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>