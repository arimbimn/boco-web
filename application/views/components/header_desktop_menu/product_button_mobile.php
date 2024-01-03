<!-- product Category Button -->
<div class="flex items-center relative">
    <div class="group relative">

        <!-- Accordion Content-->
        <div class="accordion">
            <div class="accordion-item">
                <input type="checkbox" id="section2" class="accordion-item-input">
                <label for="section2" class="accordion-item-header pl-0"><?= lang('product') ?></label>
                <div class="accordion-item-content">
                    <div class="sub-accordion">
                        <?php for ($j = 1; $j <= 5; $j++) : ?>
                            <div class="accordion-item">
                                <input type="checkbox" id="subSection<?= $j ?>" class="accordion-item-input">
                                <label for="subSection<?= $j ?>" class="accordion-item-header">Section<?= $j ?></label>
                                <div class="accordion-item-content">
                                    <p>Content for Sub Section <?= $j ?></p>
                                </div>
                            </div>
                        <?php endfor; ?>
                    </div>
                </div>
            </div>
        </div>




        <!-- <ul id="main-menu" class="sm pixelstrap sm-horizontal">
            <li>
                <a class=" !font-normal" href="<?= base_url('/') ?>"><?= lang('beranda') ?></a>
            </li>
            <li>
                <a class=" !font-normal" href="<?= base_url('/product') ?>"><?= lang('produk') ?></a>
                <ul>
                    <?php $category = $this->M_product->get_categoryproduct();
                    // var_dump($category);
                    ?>
                    <?php if ($category) { ?>
                        <?php foreach ($category as $item_category) { ?>
                            <li>
                                <a class=" !font-normal" href="<?= base_url('/product?category=' . $item_category->id_product_kategori) ?>"><?= $item_category->nama_kategori ?></a>
                                <?php
                                $cek_subcategory = $this->db->where('kategori_id', $item_category->id_product_kategori)->where(['is_active' => 1])->order_by('subcategory_order', 'ASC')->get('product_subkategori')->result();
                                if (!empty($cek_subcategory)) {
                                ?>
                                    <ul>
                                        <?php foreach ($cek_subcategory as $subcategory) { ?>
                                            <li><a class=" !font-normal" href="<?= base_url() ?>product?subcategory=<?= $subcategory->id ?>"><?= $subcategory->nama_subkategori ?></a></li>
                                        <?php } ?>
                                    </ul>
                                <?php } ?>
                            </li>
                        <?php } ?>
                    <?php } ?>
                </ul>
            </li>
            <li>
                <a class=" !font-normal" href="<?= base_url('/gallery') ?>"><?= lang('gallery') ?></a>
            </li>
            <li>
                <a class=" !font-normal" href="<?= base_url('/store') ?>"><?= lang('toko') ?></a>
            </li>
        </ul> -->
    </div>
</div>

<!-- <script>
    var productAccordion = document.getElementById('section1');
    var subcategoryAccordion = document.getElementById('subSection1');
    var subcategory2Accordion = document.getElementById('subSection2')
    var productAccordionIcon = document.getElementById('productAccordionIcon');
    var subSection1Icon = document.getElementById('subSection1Icon');
    var subSection2Icon = document.getElementById('subSection2Icon');

    productAccordion.addEventListener('input', function() {
        if (productAccordion.checked) {
            productAccordionIcon.classList.add('rotate-180');
        } else {
            productAccordionIcon.classList.remove('rotate-180');
        }
    });

    subcategoryAccordion.addEventListener('input', function() {
        if (subcategoryAccordion.checked) {
            subSection1Icon.classList.add('rotate-180');
        } else {
            subSection1Icon.classList.remove('rotate-180');
        }
    });

    subcategory2Accordion.addEventListener('input', function() {
        if (subcategory2Accordion.checked) {
            subSection2Icon.classList.add('rotate-180');
        } else {
            subSection2Icon.classList.remove('rotate-180');
        }
    });
</script> -->