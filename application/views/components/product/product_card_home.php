<?php
// var_dump($data);
?>


<a href=" ">
    <div class="col border p-2 group bg-white rounded-md h-full">
        <div class="aspect-square bg-[#00000020] rounded-lg overflow-hidden">
            <?php
            $url_gambar = smn_baseurl() . "uploads/product/" . $data->image_one;
            ?>
            <img src="<?php echo $url_gambar; ?>" alt="<?php echo $data->nama_barang; ?>" class="w-full h-full object-cover object-center">
        </div>

        <hr class=" mt-2">
        <h3 class=" font-bold text-black text-center text-sm py-1"><?= $data->nama_barang ?></h3>
        <p class=" text-red-500 text-xs text-center">
            <span class=" text-[grey]">Rp. <?= number_format($data->harga, 0) ?></span>
        </p>

        <div class=" rounded-full overflow-hidden mx-2 my-2" style="display: flex; gap: 4px; justify-content: center;">
            <ul class="color-variant">
                <li class="bg-light0" style="background-color:<?= $data->colour_picker ?>;"></li>
            </ul>
        </div>
        <?php
        // var_dump($data);
        ?>
    </div>
</a>