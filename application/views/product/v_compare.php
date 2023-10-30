<!-- breadcrumb start -->
<div class="breadcrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class="page-title">
                    <h2><?= $title_page ?></h2>
                </div>
            </div>
            <div class="col-sm-6">
                <nav aria-label="breadcrumb" class="theme-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?= $title_page ?></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb End -->

<!-- section start -->
<section class="compare-padding">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="compare-page">
                    <div class="table-wrapper table-responsive">
                        <table class="table">
                            <thead>
                                <tr class="th-compare">
                                    <th width="15%">
                                        Product Image
                                    </th>
                                    <th width="30%">
                                        Product Name
                                    </th>
                                    <th width="30%">
                                        Product Description
                                    </th>
                                    <th width="15%">
                                        Availability
                                    </th>
                                    <th width="10%">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="table-compare">
                                <?php
                                $expl_compareproductid = explode(',', $list_compares);
                                if (!empty($list_compares) && !empty($expl_compareproductid)) {
                                    foreach ($expl_compareproductid as $compareproductid) {
                                        $product_info = $this->db->get_where('product', ['id_product' => $compareproductid])->row();
                                ?>
                                        <tr>
                                            <td class="item-row">
                                                <a href="<?= base_url() ?>product/detail/<?= $compareproductid ?>">
                                                    <img src="<?= smn_baseurl() ?>uploads/product/<?= $product_info->image_one ?>" alt="<?= $product_info->nama_barang ?>" width="100%">
                                                </a>
                                                <div class="product-price product_price text-center">
                                                    <span>
                                                        <?php $totalHarga = $product_info->harga;
                                                        $cekMember = $this->db->where(['user_id' => $this->ion_auth->user()->row()->id])->get('user_membership')->row(); ?>
                                                        <?php if ($cekMember) {  ?>
                                                            <?php if ($cekMember->peringkat_member == 'GOLD') { ?>
                                                                <p>Diskon Member Gold 10%</p>
                                                                <?php $totalDiskon = (10 / 100) * $totalHarga; ?>
                                                                <?php $totalHarga = $totalHarga  - $totalDiskon; ?>
                                                                <h5>IDR <?= number_format($totalHarga, 0, ',', '.')  ?></h5>
                                                            <?php } else if ($cekMember->peringkat_member == 'PLATINUM') {  ?>
                                                                <p>Diskon Member Platinum 15%</p>
                                                                <?php $totalDiskon = (15 / 100) * $totalHarga; ?>
                                                                <?php $totalHarga = $totalHarga  - $totalDiskon; ?>
                                                                <h5>IDR <?= number_format($totalHarga, 0, ',', '.')  ?></h5>
                                                            <?php } else if ($cekMember->peringkat_member == 'DIAMOND') {  ?>
                                                                <p>Diskon Member Diamond 20%</p>
                                                                <?php $totalDiskon = (20 / 100) * $totalHarga; ?>
                                                                <?php $totalHarga = $totalHarga  - $totalDiskon; ?>
                                                                <h5>IDR <?= number_format($totalHarga, 0, ',', '.')  ?></h5>
                                                            <?php } ?>
                                                            <h5 style="color:red; text-decoration: line-through;">IDR <?= number_format($product_info->harga, 0, ',', '.')  ?></h5>
                                                        <?php } else {  ?>
                                                            <h5>IDR <?= number_format($product_info->harga, 0, ',', '.')  ?></h5>
                                                        <?php } ?>
                                                    </span>
                                                </div>
                                            </td>
                                            <td class="align-middle"><a href="<?= base_url() ?>product/detail/<?= $compareproductid ?>"><?= $product_info->nama_barang ?></a></td>
                                            <td class="align-middle"><?= $product_info->description ?></td>
                                            <td class="align-middle">
                                                <?php
                                                $cek_stok_allattributestore = $this->db->select('SUM(jumlah_stok) as stok')->where('id_product', $compareproductid)->get('product_stok')->row();
                                                if ($cek_stok_allattributestore->stok > 0) {
                                                    echo "<p>Available In Stock</p>";
                                                } else {
                                                    echo "<p>Out Of Stock</p>";
                                                }
                                                ?>
                                            </td>
                                            <td class="align-middle"><a href="<?= base_url() ?>delete_compareproduct/<?= $compareproductid ?>" class="btn btn-default icon mr-3"><i class="ti-close"></i> </a></td>
                                        </tr>
                                    <?php } ?>
                                <?php } else { ?>
                                    <tr>
                                        <td colspan="5" class="text-center">Compare is empty</td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Section ends -->