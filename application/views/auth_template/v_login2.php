<style>
    .label-focus {
        top: -0.5rem;
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
                    <h2>customer's <?php echo lang('login_heading'); ?></h2>
                </div>
            </div>
            <div class="col-sm-6">
                <nav aria-label="breadcrumb" class="theme-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url('/') ?>"><?= lang('beranda') ?></a></li>
                        <li class="breadcrumb-item active"><?php echo lang('login_heading'); ?></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb End -->

<!-- section login -->

<section class="login-page">
    <div class="container items-center justify-center px-6 py-12 lg:px-4 sm:px-2">

        <?php if ($message) { ?>
            <div class="alert alert-warning">
                <strong>warning!</strong> <?php echo $message; ?>
            </div>
        <?php } ?>

        <div class="flex justify-center">
            <div class=" bg-white p-4 rounded-md shadow-lg w-96">
                <div class=" sm:mx-auto sm:w-full sm:max-w-sm">
                    <img class="mx-auto h-10 w-18" src="<?= base_url('assets/images/icon/logo.png') ?>" alt="Bocorocco">
                    <h2 class="mt-4 text-center text-lg font-bold leading-9 tracking-tight text-gray-900 mb-10">
                        Sign in to your account
                    </h2>
                </div>
                <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
                    <form class="space-y-6" action="<?= base_url('auth/login') ?>" method="POST">
                        <div class="relative mb-6">
                            <input type="text" id="username" name="identity" autocomplete="username" required class="block w-full px-3 py-2 border-b-2 text-gray-900 shadow-sm text-xs border-gray-300 rounded-md focus:outline-none focus:border-[#008C45] placeholder-transparent text-center">
                            <label for="username" class="absolute top-2 left-2 px-1 text-xs text-gray-600 transition-transform transform origin-top-left scale-75 pointer-events-none">
                                Email/Username/Phone Number
                            </label>
                        </div>

                        <div class="relative mb-6">
                            <input type="password" id="password" name="password" autocomplete="current-password" required class="block w-full px-3 py-2 border-b-2 text-gray-900 shadow-sm text-xs border-gray-300 rounded-md focus:outline-none focus:border-[#008C45] placeholder-transparent text-center">
                            <label for="password" class="absolute top-2 left-2 px-1 text-xs text-gray-600 transition-transform transform origin-top-left scale-75 pointer-events-none">
                                Password
                            </label>
                            <div class="text-right text-xs mt-2">
                                <a href="<?= base_url('forgotpassword') ?>" class="text-blue-500 hover:underline">Forgot Password?</a>
                            </div>
                            <div class="absolute top-2 right-2">
                                <button type="button" onclick="togglePasswordVisibility()" class="text-gray-600 hover:text-gray-800 focus:outline-none">
                                    <i id="eyeIcon" class="fa fa-eye"></i>
                                </button>
                            </div>
                        </div>
                        <button type="submit" class=" btn bg-red-500 text-white py-2 px-4 rounded-full hover:bg-red-600 focus:outline-none focus:ring focus:border-red-300 w-full mb-1">
                            Login
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</section>

<script>
    const usernameInput = document.getElementById('username');
    const usernameLabel = document.querySelector('label[for="username"]');

    const passwordInput = document.getElementById('password');
    const passwordLabel = document.querySelector('label[for="password"]');

    const eyeIcon = document.getElementById('eyeIcon');

    function togglePasswordVisibility() {
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeIcon.classList.remove('far', 'fa-eye');
            eyeIcon.classList.add('far', 'fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            eyeIcon.classList.remove('far', 'fa-eye-slash');
            eyeIcon.classList.add('far', 'fa-eye');
        }
    }

    usernameInput.addEventListener('focus', () => {
        usernameLabel.classList.add('label-focus');
    });

    usernameInput.addEventListener('blur', () => {
        if (!usernameInput.value) {
            usernameLabel.classList.remove('label-focus');
        }
    });

    usernameInput.addEventListener('input', () => {
        if (usernameInput.value) {
            usernameLabel.classList.add('label-focus');
        } else {
            usernameLabel.classList.remove('label-focus');
        }
    });

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
</script>