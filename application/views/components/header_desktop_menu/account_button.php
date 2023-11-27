<!-- Account Button -->
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