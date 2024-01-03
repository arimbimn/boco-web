<header class="fixed shadow-lg top-0 z-50 w-full bg-white transition-all duration-500 opacity-100">
    <!-- <div class="py-2 bg-[#ffe4c1]">
        <div class="container">
            Hi, you are login as Entrepreneur
        </div>
    </div> -->

    <div class="h-[65px] md:h-[90px] flex items-center">
        <div class="container gap-4 flex items-center md:justify-between justify-between">


            <!-- Mobile Menu Toggle -->
            <div class="toggle-mobile-menu block md:hidden cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5" />
                </svg>
            </div>

            <div class="flex gap-4 items-center">
                <div class="max-h-[70px] max-w-[250px]">
                    <a href="<?= base_url() ?>">
                        <img src="<?= base_url('assets/images/icon/logo1.png') ?>" class="max-h-[80px] md:max-h-[100px]">
                    </a>
                </div>
            </div>

            <div class=" flex md:hidden items-center mobile-search">
                <button id="search-icon-mobile" type="button" id="dropdownButton" class="inline-flex justify-center items-center p-2 hover:bg-gray-300 rounded-md">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                    </svg>
                </button>
                <?= form_open('product', ['method' => 'GET']); ?>
                <div id="search-box-mobile" class="hidden absolute top-full w-full left-0 p-2">
                    <input type="text" name="q" id="exampleInputPassword1" placeholder="Search..." class="border rounded-md px-3 py-2 w-full items-center">
                </div>
                <?= form_close() ?>
            </div>

            <!-- Desktop Menu -->
            <div class="gap-4 flex items-center ml-auto">
                <div class=" hidden md:flex items-center">
                    <?= form_open('product', ['method' => 'GET']); ?>
                    <div id="search-box" class="hidden p-2">
                        <input type="text" placeholder="Search..." class="border rounded px-2 py-1">
                    </div>
                    <?= form_close() ?>
                    <button id="search-icon" type="button" id="dropdownButton" class="inline-flex justify-center items-center p-2 hover:bg-gray-300 rounded-md">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                        </svg>
                    </button>
                </div>

                <?php if ($this->ion_auth->logged_in()) : ?>
                    <div class="block">
                        <?php $this->load->view('components/header_desktop_menu/notification_button') ?>
                    </div>
                <?php endif; ?>

                <div class="block">
                    <?php $this->load->view('components/header_desktop_menu/cart_button') ?>
                </div>

                <div class="hidden md:block">
                    <?php $this->load->view('components/header_desktop_menu/account_button') ?>
                </div>


            </div>
        </div>
    </div>

    <div class="border-t-2 border-[#e7e7e7] hidden md:block">
        <div class="container flex items-center mx-auto justify-center">
            <nav class=" uppercase">
                <ul class="flex gap-[25px] py-3">
                    <li>
                        <a href="<?= base_url('/') ?>"><?= lang('beranda') ?></a>
                    </li>
                    <li>
                        <!-- <a href="<?= base_url('/product') ?>" class="text-black flex items-center hover:text-gray-600 px-4 rounded-md transition-all duration-300"><?= lang('produk') ?></a> -->
                        <?php $this->load->view('components/header_desktop_menu/product_button') ?>
                    </li>
                    <li>
                        <a href="<?= base_url('/gallery') ?>"><?= lang('gallery') ?></a>
                    </li>
                    <li>
                        <a href="<?= base_url('/store') ?>" class="px-4"><?= lang('toko') ?></a>
                    </li>
                </ul>
            </nav>

            <div class="flex items-center">
                <div class="group relative">
                    <div class="flex gap-2 items-center hover:cursor-pointer font-bold ">
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

<div class="mobile-menu fixed top-0 left-0 w-full h-screen z-30 backdrop-blur-sm bg-[#00000034]">
    <div class="bg-white w-full max-w-[300px] h-full p-4 overflow-y-scroll">

        <?php if ($this->ion_auth->logged_in()) { ?>
            <a href="<?= base_url('users') ?>">
                <div class="flex gap-3">
                    <div>
                        <img src="https://via.placeholder.com/50" alt="Gambar 1" class="mb-4 rounded-full pl-1">
                    </div>
                    <div>
                        <p class=" mb-2"><?= $this->ion_auth->user()->row()->first_name ?> <?= $this->ion_auth->user()->row()->last_name ?></p>
                    </div>

                </div>

            </a>

        <?php } else { ?>
            <a href="<?= base_url('login') ?>" class="px-4 py-2 bg-[#416A25] font-bold text-white rounded-full">
                Masuk / Daftar
            </a>
            <!-- <li><a href="<?= base_url('login') ?>" data-lng="en"><?= lang('login') ?></a></li> -->
            <!-- <li><a href="<?= base_url('register') ?>" data-lng="en"><?= lang('register') ?></a></li> -->
        <?php  } ?>

        <hr class="my-4">

        <!-- <nav class=" uppercase">
            <ul class="flex flex-col gap-[20px] py-3">
                <li>
                    <a href="<?= base_url('/') ?>"><?= lang('beranda') ?></a>
                </li>
                <li>
                    <a href="<--?= base_url('/product') ?>"><?= lang('produk') ?></a>
                    <--?php $this->load->view('components/header_desktop_menu/product_button_mobile') ?>
                <li>
                    <a href="<?= base_url('/gallery') ?>"><?= lang('gallery') ?></a>
                </li>
                <li>
                    <a href="<?= base_url('/store') ?>"><?= lang('toko') ?></a>
                </li>
            </ul>
        </nav> -->

        <!-- tambahan arimbi -->

        <nav class="uppercase" id="main-nav">
            <ul class="flex flex-col gap-[20px] py-3 pixelstrap sm" id="main-menu">
                <li>
                    <a href="<?= base_url('/') ?>"><?= lang('beranda') ?></a>
                </li>
                <li class=" relative">
                    <a href="javascript:void(0);" class="toggle"><?= lang('produk') ?></a>
                    <ul class="submenu hidden">
                        <?php $category = $this->M_product->get_categoryproduct(); ?>
                        <?php if ($category) { ?>
                            <?php foreach ($category as $item_category) { ?>
                                <li class=" relative">
                                    <a class="!font-normal toggle-category" href="<?= base_url('/product?category=' . $item_category->id_product_kategori) ?>"><?= $item_category->nama_kategori ?></a>
                                    <?php
                                    $cek_subcategory = $this->db
                                        ->where('kategori_id', $item_category->id_product_kategori)
                                        ->where(['is_active' => 1])
                                        ->order_by('subcategory_order', 'ASC')
                                        ->get('product_subkategori')
                                        ->result();
                                    if (!empty($cek_subcategory)) {
                                    ?>
                                        <ul>
                                            <?php foreach ($cek_subcategory as $subcategory) { ?>
                                                <li><a class="!font-normal" href="<?= base_url() ?>product?subcategory=<?= $subcategory->id ?>"><?= $subcategory->nama_subkategori ?></a></li>
                                            <?php } ?>
                                        </ul>
                                    <?php } ?>
                                </li>
                            <?php } ?>
                        <?php } ?>
                    </ul>
                </li>
                <li>
                    <a href="<?= base_url('/gallery') ?>"><?= lang('gallery') ?></a>
                </li>
                <li>
                    <a href="<?= base_url('/store') ?>"><?= lang('toko') ?></a>
                </li>
            </ul>
        </nav>
    </div>
</div>

<script>
    // Hitung tinggi header
    const headerHeight = document.querySelector('header').offsetHeight;
    // Atur margin top pada elemen <body> sesuai dengan tinggi header
    document.body.style.paddingTop = `${headerHeight}px`;

    $('.mobile-menu').css('padding-top', headerHeight);

    $('.mobile-menu').toggleClass('hidden');
    // Mobile menu toggle button click event
    $('.toggle-mobile-menu').click(function() {
        // Toggle the 'hidden' class on the mobile menu
        $('.mobile-menu').toggleClass('hidden');
    });


    document.addEventListener('DOMContentLoaded', function() {
        const categories = document.querySelectorAll('.category');

        categories.forEach(category => {
            const subcategories = category.querySelector('.subcategories');

            category.addEventListener('mouseover', function() {
                subcategories.style.display = 'block';
            });

            category.addEventListener('mouseout', function() {
                subcategories.style.display = 'none';
            });
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        var searchIcon = document.getElementById('search-icon');
        var searchBox = document.getElementById('search-box');

        searchIcon.addEventListener('click', function() {
            searchBox.classList.toggle('hidden');
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        var searchIcon = document.getElementById('search-icon-mobile');
        var searchBox = document.getElementById('search-box-mobile');

        searchIcon.addEventListener('click', function() {
            searchBox.classList.toggle('hidden');
        });
    });


    let prevScrollPos = window.pageYOffset;
    const header = document.querySelector('header');

    window.onscroll = function() {
        let currentScrollPos = window.pageYOffset;

        if (prevScrollPos > currentScrollPos) {
            // Scroll up
            header.style.top = "0";
        } else {
            // Scroll down
            header.style.top = `-${header.offsetHeight}px`;
        }

        prevScrollPos = currentScrollPos;
    };
</script>