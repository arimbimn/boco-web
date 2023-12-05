<a href="<?php echo $data['url'];  ?> ">
    <div class="col border p-2 group bg-white rounded-md h-full">
        <?php if (!$data['diskon']) :
        ?>
            <span class="absolute text-white ml-1 mt-1 px-2 py-1 bg-[#cd212a] rounded-md">
                <div class="px-1 font-bold text-xs"> 20% off</div>
            </span>
        <?php endif
        ?>
        <div class="aspect-square bg-[#00000020] rounded-lg overflow-hidden">
            <?php
            $url_gambar = $data['gambar_produk'];
            ?>
            <img src="<?php echo $url_gambar; ?>" alt="<?php echo $data['nama_produk']; ?>" class="w-full h-full object-cover object-center">
        </div>
        <hr>
        <h3 class=" font-bold text-black text-center text-sm py-1"><?php echo $data['nama_produk']  ?></h3>
        <?php
        $harga_item = $data['harga_produk'];
        ?>
        <?php if (!$data['diskon']) :
        ?>
            <?php
            $harga_item = $data['harga_produk'] - ($data['harga_produk'] * $data['diskon']);
            ?>
            <p class=" text-red-500 text-xs text-center">
                <span class="line-through text-[grey]"><?php echo $data['harga_produk']  ?> </span>
                <span class=""><?php echo $data['diskon']  ?>%</span>
            </p>
        <?php endif
        ?>
        <p class=" text-black text-center py-2">
            <?php echo  $harga_item ?>
        </p>


        <div class=" rounded-full overflow-hidden mx-2 my-2" style="display: flex; gap: 4px; justify-content: center;">
            <?php echo $data['color_variant_html']  ?>
        </div>

        <?php
        // var_dump($data);
        ?>
    </div>

</a>