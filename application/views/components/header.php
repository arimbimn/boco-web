<header class="fixed shadow-lg top-0 z-50 w-full bg-white">
    <!-- <div class="py-2 bg-[#ffe4c1]">
        <div class="container">
            Hi, you are login as Entrepreneur
        </div>
    </div> -->

    <div class="h-[65px] md:h-[90px] flex items-center">
        <div class="container gap-4 flex items-center justify-between">
            <div class="flex gap-4 items-center">
                <div class="max-h-[70px]">
                    <a href="<?= base_url() ?>">
                        <img src="<?= base_url('assets/images/icon/logo.png') ?>" class="max-h-[35px] md:max-h-[55px]">
                    </a>
                </div>
            </div>

            <!-- Desktop Menu -->
            <div class="gap-4 hidden md:flex">
                <div class="">
                    <div>
                        <button type="button" id="dropdownButton" class="inline-flex justify-center items-center p-2 hover:bg-gray-300 rounded-md">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                            </svg>
                        </button>
                    </div>
                </div>

                <div class="relative inline-block text-left">
                    <div class="relative">
                        <button type="button" id="dropdownButton" class="inline-flex justify-center items-center p-2  rounded-full  fill-[red]">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" class="bi bi-bell" viewBox="0 0 16 16">
                                <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2M8 1.918l-.797.161A4.002 4.002 0 0 0 4 6c0 .628-.134 2.197-.459 3.742-.16.767-.376 1.566-.663 2.258h10.244c-.287-.692-.502-1.49-.663-2.258C12.134 8.197 12 6.628 12 6a4.002 4.002 0 0 0-3.203-3.92L8 1.917zM14.22 12c.223.447.481.801.78 1H1c.299-.199.557-.553.78-1C2.68 10.2 3 6.88 3 6c0-2.42 1.72-4.44 4.005-4.901a1 1 0 1 1 1.99 0A5.002 5.002 0 0 1 13 6c0 .88.32 4.2 1.22 6" />
                            </svg>
                        </button>
                        <!-- Badge -->
                        <div>
                            <div class="bg-[red] w-[10px] aspect-square absolute top-0 right-0 rounded-full">
                            </div>
                        </div>
                    </div>

                    <div id="dropdownContent" class="hidden absolute right-0 z-50 mt-2 space-y-2 shadow-lg bg-white rounded-md">

                        <div class="block w-[500px] p-3">
                            <div class="font-bold mb-2">
                                Notification
                            </div>
                            <!-- Nantinya jadi tab notifikasi -->
                            <div class="flex gap-3">
                                <div class="py-1 px-3 rounded-full bg-[#006D18] text-white text-[13px] font-bold">
                                    Order
                                </div>
                                <div class="py-1 px-3 rounded-full bg-[#cdded3] text-[#006D18] text-[13px] font-bold">
                                    Komisi
                                </div>
                            </div>
                            <hr class="border-t border-[#d9d9d9] my-3">
                            <!-- Dropdown content goes here -->
                            <a href="#" class="block">
                                <div class="border-2 rounded-md p-4">
                                    <div class="mb-2">
                                        <div class="font-bold">
                                            Invoice ORD/20231120/5/QZF8
                                        </div>
                                        <div>
                                            Telah Selesai
                                        </div>
                                    </div>
                                    <div class="text-[grey]">
                                        20 November 2023 , 03:51 PM
                                    </div>
                                </div>
                                <div class="flex justify-center mt-3">
                                    <button class="px-3 py-2 rounded-full font-bold border-2 border-[#006D18] text-[#006D18]">
                                        Tampilkan Lebih Banyak
                                    </button>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="relative inline-block text-left group">

                    <!-- barang -->
                    <?php
                    $keranjang = $this->cart->contents();
                    $jml_item = count($keranjang);

                    $is_minimum_items = $jml_item > 0 ? true : false;
                    ?>

                    <div class="relative">
                        <button type="button" class="inline-flex justify-center items-center p-2 hover:bg-gray-300 rounded-md <?php echo $is_minimum_items ? "fill-[red]" : "" ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" class="bi bi-bag" viewBox="0 0 16 16">
                                <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z" />
                            </svg>
                        </button>

                        <?php if ($is_minimum_items) : ?>
                            <div>
                                <div class="bg-[red] w-[10px] aspect-square absolute top-0 right-0 rounded-full">
                                </div>
                            </div>
                        <?php endif ?>
                    </div>

                    <div class="hidden absolute right-0 z-50 group-hover:block">
                        <div class="mt-2 space-y-2 bg-white border border-gray-300 rounded-md">
                            <div class="block w-[300px] p-3">

                                <?php if ($keranjang) { ?>
                                    <?php foreach ($keranjang as $item_keranjang) { ?>
                                        <?php $barang = $this->M_product->get_detailproduct($item_keranjang['id']) ?>
                                        <div class="flex gap-3">
                                            <div class="aspect-square w-[50px] relative rounded-md shadow-md overflow-hidden border-2 border-[grey]">
                                                <img class="w-full h-full absolute object-cover" src="<?= smn_baseurl() ?>uploads/product/<?= $barang->image_one ?>">
                                            </div>
                                            <div class="flex items-center">
                                                <div class="">
                                                    <div class="font-bold"><?= $item_keranjang['name'] ?></div>
                                                    <div class="text-[12px] text-[#c1c1c1]">
                                                        <span><?= $item_keranjang['qty'] ?> x IDR <?= number_format($item_keranjang['price'], 2, ',', '.') ?> </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- <div class="close-circle"><a href="#"><i class="fa fa-times" aria-hidden="true"></i></a></div> -->
                                        </div>
                                    <?php } ?>
                                <?php } else { ?>
                                    <div class="font-bold">
                                        <?= lang('cek_keranjang_nav') ?>
                                    </div>
                                <?php } ?>

                                <div class="font-bold mt-3">
                                    <h5>
                                        <?= lang('sub_total_nav') ?> : <span>
                                            IDR <?php echo $this->cart->format_number($this->cart->total()); ?></span>
                                    </h5>
                                </div>

                                <hr class="border-t-2 border-[#d0d0d0] my-3">

                                <div class="mt-3 flex justify-end">
                                    <a href="<?= base_url('cart') ?>" class="view-cart">
                                        <button class="btn btn-solid">
                                            <?= lang('cart_nav') ?>
                                        </button>
                                    </a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex items-center">

                    <?php if ($this->ion_auth->logged_in()) { ?>
                        <div class="group relative">
                            <div class="flex gap-2 items-center hover:cursor-pointer">
                                <?= lang('MyAccount') ?>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="ml-2 w-4 h-4">
                                    <path d="M5 8l5 5 5-5z" />
                                </svg>
                            </div>

                            <!-- Dropdown Content -->
                            <div class="absolute z-10 hidden right-0 group-hover:block">
                                <div class=" bg-white  mt-4 w-48 rounded-md shadow-lg overflow-hidden">
                                    <a href="<?= base_url('users') ?>">
                                        <div class="p-3 hover:bg-[#0db83e0f]">
                                            Dashboard
                                        </div>
                                    </a>
                                    <!-- <li><a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Dropdown Item 1</a></li>
                                    <li><a href="#" class="block px-4 py-2 text-gray-800 hover:bg-gray-200">Dropdown Item 2</a></li> -->
                                    <?php if ($this->session->userdata('reseller') == '1') { ?>
                                        <a href="<?= base_url('reseller/logout') ?>">
                                            <div class="p-3 hover:bg-[red] hover:font-bold hover:text-white">
                                                <?= lang('LogOut') ?>
                                            </div>
                                        </a>
                                    <?php } else { ?>
                                        <a href="<?= base_url('auth/logout') ?>" data-lng="es">
                                            <div class="p-3 hover:bg-[#0db83e0f]">
                                                <?= lang('LogOut') ?>
                                            </div>
                                        </a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>

                    <?php } else { ?>
                        <a href="<?= base_url('login') ?>" class="px-4 py-2 bg-[#416A25] font-bold text-white rounded-full">
                            Masuk / Daftar
                        </a>
                        <!-- <li><a href="<?= base_url('login') ?>" data-lng="en"><?= lang('login') ?></a></li> -->
                        <!-- <li><a href="<?= base_url('register') ?>" data-lng="en"><?= lang('register') ?></a></li> -->
                    <?php  } ?>

                </div>
            </div>

            <!-- Mobile Menu Toggle -->
            <div class="block md:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5" />
                </svg>
            </div>

        </div>
    </div>

    <div class="border-t-2 border-[#e7e7e7] hidden md:block">
        <div class="container flex justify-between">
            <nav class=" uppercase">
                <ul class="flex gap-[20px] py-3">
                    <li>
                        <a href="<?= base_url('/') ?>"><?= lang('beranda') ?></a>
                    </li>
                    <li>
                        <a href="<?= base_url('/product') ?>"><?= lang('produk') ?></a>
                    </li>
                    <li>
                        <a href="<?= base_url('/gallery') ?>"><?= lang('gallery') ?></a>
                    </li>
                    <li>
                        <a href="<?= base_url('/store') ?>"><?= lang('toko') ?></a>
                    </li>
                </ul>
            </nav>
            <div class="flex items-center">
                <div class="group relative">
                    <div class="flex gap-2 items-center hover:cursor-pointer font-bold">
                        <?= $this->session->userdata('site_lang') == "indonesian" ? 'ID' :  'EN' ?>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="ml-2 w-4 h-4">
                            <path d="M5 8l5 5 5-5z" />
                        </svg>
                    </div>

                    <!-- Dropdown Content -->
                    <div class="absolute z-10 hidden right-0 group-hover:block">
                        <div class=" bg-white  mt-4 w-48 rounded-md shadow-lg overflow-hidden">
                            <a href="<?= base_url('LanguageSwitcher/switchLang/indonesian') ?>">
                                <div class="p-3 hover:bg-[#0db83e0f]">
                                    ID
                                </div>
                            </a>

                            <a href="<?= base_url('LanguageSwitcher/switchLang/english') ?>">
                                <div class="p-3 hover:bg-[#0db83e0f]">
                                    EN
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<script>
    // Hitung tinggi header
    const headerHeight = document.querySelector('header').offsetHeight;
    // Atur margin top pada elemen <body> sesuai dengan tinggi header
    document.body.style.paddingTop = `${headerHeight}px`;
</script>

<script>
    $(document).ready(function() {
        $("#dropdownButton").click(function() {
            $("#dropdownContent").toggle();
        });

        $(document).on("click", function(event) {
            if (!$(event.target).closest("#dropdownButton").length && !$(event.target).closest("#dropdownContent").length) {
                $("#dropdownContent").hide();
            }
        });
    });
</script>