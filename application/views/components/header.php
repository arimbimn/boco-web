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

                <?php $this->load->view('components/header_desktop_menu/notification_button') ?>
                <?php $this->load->view('components/header_desktop_menu/cart_button') ?>
                <?php $this->load->view('components/header_desktop_menu/account_button') ?>
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