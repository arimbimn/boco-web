<style>
    .label-focus {
        top: -0.30rem;
        /* Adjust the value based on your preference */
        left: 0.5rem;
        /* Adjust the value based on your preference */
        font-size: 0.75rem;
        /* Adjust the value based on your preference */
        color: #008C45;
        /* Adjust the color based on your preference */
    }
</style>
<!-- breadcrumb start -->
<div class="breadcrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class="page-title">
                    <h2>Ubah Password </h2>
                </div>
            </div>
            <div class="col-sm-6">
                <nav aria-label="breadcrumb" class="theme-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url('/') ?>"><?= lang('beranda') ?> </a></li>
                        <li class="breadcrumb-item"><a href="<?= base_url('/users') ?>"><?= lang('my_account') ?></a></li>
                        <li class="breadcrumb-item active" aria-current="page"> Ubah Password </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb End -->

<!-- change password section start -->
<section class="contact-page register-page">
    <div class="container">
        <div class="row">
            <div class="mt-2 px-5 w-full">

                <img class="mx-auto h-10 w-18 justify-center items-center mb-4" src="<?= base_url('assets/images/icon/logo.png') ?>" alt="Bocorocco">
                <h2 class=" text-base font-bold leading-7 text-gray-900 text-center">Ubah Password</h2>
                <p class="mt-1 text-sm leading-6 text-gray-600 text-center mb-3">Harap masukkan password baru anda.</p>

                <form class="space-y-6" action="#" method="POST">
                    <div class=" grid grid-cols-1 md:grid-cols-2 gap-x-2 pt-3">
                        <div class="relative flex-1 mb-3">
                            <input type="password" id="password" name="password" autocomplete="password" required class=" text-sm block w-full px-4 py-2 border-b-2 text-gray-900 shadow-sm border-gray-300 rounded-md focus:outline-none focus:border-[#008C45] placeholder-transparent text-center">
                            <label for="password" class="absolute top-3 left-4 px-2 text-sm text-gray-600 transition-transform transform origin-top-left scale-75 pointer-events-none">
                                Password Baru
                            </label>
                        </div>
                        <div class="relative flex-1 mb-3">
                            <input type="password" id="confirmPassword" name="confirmPassword" autocomplete="password" required class=" text-sm block w-full px-4 py-2 border-b-2 text-gray-900 shadow-sm border-gray-300 rounded-md focus:outline-none focus:border-[#008C45] placeholder-transparent text-center">
                            <label for="confirmPassword" class="absolute top-3 left-4 px-2 text-sm text-gray-600 transition-transform transform origin-top-left scale-75 pointer-events-none">
                                Confirm Password
                            </label>
                        </div>
                    </div>
                    <div class="mt-6 flex items-center justify-start gap-x-6">
                        <button type="button" class="text-sm font-semibold leading-6 bg-transparent border border-[#008C45] hover:bg-[#008C45] hover:text-gray-400 focus:outline-none focus:border-[#00461C] transition-all px-4 py-2 rounded-full text-gray-900">
                            Cancel
                        </button>
                        <button type="submit" class="rounded-full bg-[#008C45] px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-[#00461C] focus:outline-none focus:ring focus:border-[#00461C] focus-visible:ring-[#00461C]">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<script>
    const passwordInput = document.getElementById('password');
    const passwordLabel = document.querySelector('label[for="password"]');


    const confirmPasswordInput = document.getElementById('confirmPassword');
    const confirmPasswordLabel = document.querySelector('label[for="confirmPassword"]');

    // input npassword baru
    passwordInput.addEventListener('focus', () => {
        passwordLabel.classList.add('label-focus');
    });

    passwordInput.addEventListener('blur', () => {
        if (!passwordInput.value) {
            passwordLabel.classList.remove('label-focus');
        }
    });

    passwordInput.addEventListener('input', () => {
        if (passwordInput.value) {
            passwordLabel.classList.add('label-focus');
        } else {
            passwordLabel.classList.remove('label-focus');
        }
    });

    // input confirm password
    confirmPasswordInput.addEventListener('focus', () => {
        confirmPasswordLabel.classList.add('label-focus');
    });

    confirmPasswordInput.addEventListener('blur', () => {
        if (!confirmPasswordInput.value) {
            confirmPasswordLabel.classList.remove('label-focus');
        }
    });

    confirmPasswordInput.addEventListener('input', () => {
        if (confirmPasswordInput.value) {
            confirmPasswordLabel.classList.add('label-focus');
        } else {
            confirmPasswordLabel.classList.remove('label-focus');
        }
    });
</script>