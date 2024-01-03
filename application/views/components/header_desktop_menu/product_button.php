<style>
    li>ul {
        transform: translatex(100%) scale(0)
    }

    li:hover>ul {
        transform: translatex(101%) scale(1)
    }

    li>a svg {
        transform: rotate(-90deg)
    }

    li:hover>a svg {
        transform: rotate(-270deg)
    }

    .group:hover .group-hover\:scale-100 {
        transform: scale(1)
    }

    .group:hover .group-hover\:-rotate-180 {
        transform: rotate(180deg)
    }

    .scale-0 {
        transform: scale(0)
    }

    .min-w-32 {
        min-width: 8rem
    }
</style>

<!-- product Category Button -->
<div class="flex items-center relative">
    <div class="group relative">
        <div class="flex gap-2 items-center hover:cursor-pointer">
            <?= lang('product') ?>
            <svg class="fill-current h-4 w-4 transform group-hover:-rotate-180 transition duration-150 ease-in-out" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
            </svg>
        </div>

        <!-- Dropdown Content-->

        <ul class="bg-white border rounded-md transform scale-0 group-hover:scale-100 absolute transition duration-150 ease-in-out origin-top min-w-32">
            <?php $category = $this->M_product->get_categoryproduct(); ?>
            <?php if ($category) { ?>
                <?php foreach ($category as $item_category) { ?>
                    <li class="rounded-sm relative px-3 py-1 hover:bg-gray-100">
                        <a href="<?= base_url('/product?category=' . $item_category->id_product_kategori) ?>" class="w-full text-left flex items-center outline-none focus:outline-none">
                            <span class="pr-1 flex-1"><?= $item_category->nama_kategori ?></span>
                            <span class="mr-auto">
                                <svg class="fill-current h-4 w-4 transition duration-150 ease-in-out" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                </svg>
                            </span>
                        </a>
                        <ul class="bg-white border rounded-md absolute top-0 right-0 hover:cursor-pointer transition duration-150 ease-in-out origin-top-left min-w-32">
                            <?php
                            $cek_subcategory = $this->db
                                ->where('kategori_id', $item_category->id_product_kategori)
                                ->where(['is_active' => 1])
                                ->order_by('subcategory_order', 'ASC')
                                ->get('product_subkategori')
                                ->result();
                            if (!empty($cek_subcategory)) {
                            ?>
                                <?php foreach ($cek_subcategory as $subcategory) { ?>
                                    <li class="px-3 py-1 hover:bg-gray-100">
                                        <a href="<?= base_url('product?subcategory=' . $subcategory->id) ?>"><?= $subcategory->nama_subkategori ?></a>
                                    </li>
                                <?php } ?>
                            <?php } ?>
                        </ul>
                    </li>
                <?php } ?>
            <?php } ?>
        </ul>
    </div>
</div>