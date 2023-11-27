<div>
    <?php
    // var_dump($keranjang);
    $total = 0;
    ?>
    <?php foreach ($cart as $item) : ?>
        <div style="display: flex;justify-content:space-between">
            <div>
                <?php echo $item['name'] ?> ( x<?php echo $item['qty'] ?> )
            </div>
            <div>
                <?php
                $total = $total + ($item['price'] * $item['qty']);
                $hargaBarang = $item['price'] * $item['qty'];
                ?>
                IDR <?php echo number_format($hargaBarang, 0, ',', '.') ?>
            </div>
        </div>
    <?php endforeach ?>
</div>