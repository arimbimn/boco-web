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
                    <h2><?php echo lang('create_user_heading'); ?></h2>
                </div>
            </div>
            <div class="col-sm-6">
                <nav aria-label="breadcrumb" class="theme-breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url('/') ?>"><?= lang('beranda') ?></a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?php echo lang('create_user_heading'); ?></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- breadcrumb End -->

<section class="register-page">
    <div class="container">
        <div class="row">
            <div class="mt-2 px-5 w-full">
                <!-- <img class="mx-auto h-10 w-18 justify-center items-center mb-4" src="<?= base_url('assets/images/icon/logo.png') ?>" alt="Bocorocco"> -->
                <h2 class="text-base font-bold leading-7 text-gray-900 text-center">Registration Form</h2>
                <p class="mt-1 text-sm leading-6 text-gray-600 text-center">Harap lengkapi data dibawah ini untuk membuat akun.</p>

                <!-- form start -->
                <form class="space-y-6" action="#" method="POST">

                    <!-- baris 1 -->
                    <div class=" grid grid-cols-1 md:grid-cols-2 gap-x-2 pt-5">
                        <div class="relative flex-1 mb-3">
                            <input type="text" id="firstname" name="firstname" autocomplete="firstname" required class=" text-sm block w-full px-4 py-2 border-b-2 text-gray-900 shadow-sm border-gray-300 rounded-md focus:outline-none focus:border-[#008C45] placeholder-transparent text-center">
                            <label for="firstname" class="absolute top-3 left-4 px-2 text-sm text-gray-600 transition-transform transform origin-top-left scale-75 pointer-events-none">
                                First Name
                            </label>
                        </div>
                        <div class="relative flex-1 mb-3 mt-1">
                            <input type="text" id="lastname" name="lastname" autocomplete="lastname" required class=" text-sm block w-full px-4 py-2 border-b-2 text-gray-900 shadow-sm border-gray-300 rounded-md focus:outline-none focus:border-[#008C45] placeholder-transparent text-center">
                            <label for="lastname" class="absolute top-3 left-4 px-2 text-sm text-gray-600 transition-transform transform origin-top-left scale-75 pointer-events-none">
                                Last Name
                            </label>
                        </div>
                    </div>

                    <!-- baris 2 -->
                    <div class=" grid grid-cols-1 md:grid-cols-2 gap-x-2 mt-1">
                        <div class="relative flex-1 mb-3">
                            <input type="text" id="username" name="username" autocomplete="username" required class=" text-sm block w-full px-4 py-2 border-b-2 text-gray-900 shadow-sm border-gray-300 rounded-md focus:outline-none focus:border-[#008C45] placeholder-transparent text-center">
                            <label for="username" class="absolute top-3 left-4 px-2 text-sm text-gray-600 transition-transform transform origin-top-left scale-75 pointer-events-none">
                                Username
                            </label>
                        </div>
                        <div class="relative flex-1 mb-3">
                            <input type="number" id="phonenumber" name="phonenumber" autocomplete="phonenumber" required class=" text-sm block w-full px-4 py-2 border-b-2 text-gray-900 shadow-sm border-gray-300 rounded-md focus:outline-none focus:border-[#008C45] placeholder-transparent text-center">
                            <label for="phonenumber" class="absolute top-3 left-4 px-2 text-sm text-gray-600 transition-transform transform origin-top-left scale-75 pointer-events-none">
                                Phone Number
                            </label>
                        </div>
                    </div>

                    <!-- baris 3 -->
                    <div class=" grid grid-cols-1 md:grid-cols-2 gap-x-2 mt-1">
                        <div class="relative flex-1 mb-3">
                            <input type="number" id="nik" name="nik" autocomplete="nik" required class=" text-sm block w-full px-4 py-2 border-b-2 text-gray-900 shadow-sm border-gray-300 rounded-md focus:outline-none focus:border-[#008C45] placeholder-transparent text-center">
                            <label for="nik" class="absolute top-3 left-4 px-2 text-sm text-gray-600 transition-transform transform origin-top-left scale-75 pointer-events-none">
                                NIK (Nomor Induk Kependudukan)
                            </label>
                        </div>
                        <div class="relative flex-1 mb-3">
                            <input type="number" id="npwp" name="npwp" autocomplete="npwp" required class=" text-sm block w-full px-4 py-2 border-b-2 text-gray-900 shadow-sm border-gray-300 rounded-md focus:outline-none focus:border-[#008C45] placeholder-transparent text-center">
                            <label for="npwp" class="absolute top-3 left-4 px-2 text-sm text-gray-600 transition-transform transform origin-top-left scale-75 pointer-events-none">
                                NPWP
                            </label>
                        </div>
                    </div>


                    <!-- baris 4 -->
                    <div class=" grid grid-cols-1 md:grid-cols-2 gap-x-2 mt-1">
                        <div class="relative flex-1 mb-3">
                            <select id="bank" name="bank" autocomplete="bank" required class=" text-sm block w-full px-4 py-2 border-b-2 text-gray-900 shadow-sm border-gray-300 rounded-md focus:outline-none focus:border-[#008C45] placeholder-transparent text-center">
                                <option value="" disabled selected>Select Bank</option>
                                <option value="bank1">Bank 1</option>
                                <option value="bank2">Bank 2</option>
                                <option value="bank3">Bank 3</option>
                            </select>
                            <label for="bank" class="absolute top-3 left-4 px-2 text-sm text-gray-600 transition-transform transform origin-top-left scale-75 pointer-events-none">
                                Nama Bank
                            </label>
                        </div>
                        <div class="relative flex-1 mb-3">
                            <input type="number" id="rekening" name="rekening" autocomplete="rekening" required class=" text-sm block w-full px-4 py-2 border-b-2 text-gray-900 shadow-sm border-gray-300 rounded-md focus:outline-none focus:border-[#008C45] placeholder-transparent text-center">
                            <label for="rekening" class="absolute top-3 left-4 px-2 text-sm text-gray-600 transition-transform transform origin-top-left scale-75 pointer-events-none">
                                Nomor Rekening
                            </label>
                        </div>
                    </div>

                    <!-- baris 5 -->
                    <div class=" grid grid-cols-1 md:grid-cols-2 gap-x-2 mt-1">
                        <div class="relative flex-1 mb-3">
                            <input type="date" id="birthdate" name="birthdate" autocomplete="birthdate" required class=" text-sm block w-full px-4 py-2 border-b-2 text-gray-900 shadow-sm border-gray-300 rounded-md focus:outline-none focus:border-[#008C45] placeholder-transparent text-center">
                            <label for="birthdate" class="absolute top-3 left-4 px-2 text-sm text-gray-600 transition-transform transform origin-top-left scale-75 pointer-events-none">
                                Birth Date
                            </label>
                        </div>
                        <div class="relative flex-1 mb-3">
                            <input type="email" id="email" name="email" autocomplete="email" required class=" text-sm block w-full px-4 py-2 border-b-2 text-gray-900 shadow-sm border-gray-300 rounded-md focus:outline-none focus:border-[#008C45] placeholder-transparent text-center">
                            <label for="email" class="absolute top-3 left-4 px-2 text-sm text-gray-600 transition-transform transform origin-top-left scale-75 pointer-events-none">
                                Email
                            </label>
                        </div>
                    </div>

                    <!-- baris 6 -->
                    <div class=" grid grid-cols-1 md:grid-cols-2 gap-x-2 mt-1">
                        <div class="relative flex-1 mb-3">
                            <input type="password" id="password" name="password" autocomplete="current-password" required class="block w-full px-3 py-2 border-b-2 text-gray-900 shadow-sm text-xs border-gray-300 rounded-md focus:outline-none focus:border-[#008C45] placeholder-transparent text-center">
                            <label for="password" class="absolute top-2 left-2 px-1 text-sm text-gray-600 transition-transform transform origin-top-left scale-75 pointer-events-none">
                                Password
                            </label>
                            <div class="absolute top-2 right-2">
                                <button type="button" onclick="togglePasswordVisibility()" class="text-gray-600 hover:text-gray-800 focus:outline-none">
                                    <i id="eyeIcon" class="fa fa-eye"></i>
                                </button>
                            </div>
                        </div>
                        <div class="relative flex-1 mb-3">
                            <input type="password" id="confirmpassword" name="confirmpassword" autocomplete="phonenumber" required class=" text-sm block w-full px-4 py-2 border-b-2 text-gray-900 shadow-sm border-gray-300 rounded-md focus:outline-none focus:border-[#008C45] placeholder-transparent text-center">
                            <label for="confirmpassword" class="absolute top-3 left-4 px-2 text-sm text-gray-600 transition-transform transform origin-top-left scale-75 pointer-events-none">
                                Confirm Password
                            </label>
                            <div class="absolute top-2 right-2">
                                <button type="button" onclick="toggleConfirmPasswordVisibility()" class="text-gray-600 hover:text-gray-800 focus:outline-none">
                                    <i id="confirmEyeIcon" class="fa fa-eye"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- button form -->
                    <div class="mt-6 flex items-center justify-end gap-x-6">
                        <button type="button" class="text-sm font-semibold leading-6 bg-transparent border border-[#008C45] hover:bg-[#008C45] hover:text-gray-400 focus:outline-none focus:border-[#00461C] transition-all px-4 py-2 rounded-full text-gray-900">
                            Cancel
                        </button>
                        <button type="submit" class="rounded-full bg-[#008C45] px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-[#00461C] focus:outline-none focus:ring focus:border-[#00461C] focus-visible:ring-[#00461C]">
                            Create Account
                        </button>
                    </div>
                </form>

                <!-- form end -->
            </div>
        </div>
    </div>
    </div>
</section>

<script>
    // baris 1
    const firstnameInput = document.getElementById('firstname');
    const firstnameLabel = document.querySelector('label[for="firstname"]');


    const lastnameInput = document.getElementById('lastname');
    const lastnameLabel = document.querySelector('label[for="lastname"]');

    //baris 2
    const usernameInput = document.getElementById('username');
    const usernameLabel = document.querySelector('label[for="username"]');


    const phonenumberInput = document.getElementById('phonenumber');
    const phonenumberLabel = document.querySelector('label[for="phonenumber"]');

    //baris 3
    const nikInput = document.getElementById('nik');
    const nikLabel = document.querySelector('label[for="nik"]');

    const npwpInput = document.getElementById('npwp');
    const npwpLabel = document.querySelector('label[for="npwp"]');

    //baris 4
    const bankInput = document.getElementById('bank');
    const bankLabel = document.querySelector('label[for="bank"]');

    const rekeningInput = document.getElementById('rekening');
    const rekeningLabel = document.querySelector('label[for="rekening"]');

    //baris 5
    const birthdateInput = document.getElementById('birthdate');
    const birthdateLabel = document.querySelector('label[for="birthdate"]');

    const emailInput = document.getElementById('email');
    const emailLabel = document.querySelector('label[for="email"]');

    //baris 6
    const passwordInput = document.getElementById('password');
    const passwordLabel = document.querySelector('label[for="password"]');

    const confirmpasswordInput = document.getElementById('confirmpassword');
    const confirmpasswordLabel = document.querySelector('label[for="confirmpassword"]');


    const eyeIcon = document.getElementById('eyeIcon');
    const confirmpasswordEyeIcon = document.getElementById('confirmEyeIcon');

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

    function toggleConfirmPasswordVisibility() {
        if (confirmpasswordInput.type === 'password') {
            confirmpasswordInput.type = 'text';
            confirmpasswordEyeIcon.classList.remove('far', 'fa-eye');
            confirmpasswordEyeIcon.classList.add('far', 'fa-eye-slash');
        } else {
            confirmpasswordInput.type = 'password';
            confirmpasswordEyeIcon.classList.remove('far', 'fa-eye-slash');
            confirmpasswordEyeIcon.classList.add('far', 'fa-eye');
        }
    }

    function validateForm() {

        if (passwordInput.value !== confirmPasswordInput.value) {
            alert('Password and Confirm Password must match');
            return false;
        }

        return true;
    }

    // input firstname
    firstnameInput.addEventListener('focus', () => {
        firstnameLabel.classList.add('label-focus');
    });

    firstnameInput.addEventListener('blur', () => {
        if (!firstnameInput.value) {
            firstnameLabel.classList.remove('label-focus');
        }
    });

    firstnameInput.addEventListener('input', () => {
        if (firstnameInput.value) {
            firstnameLabel.classList.add('label-focus');
        } else {
            firstnameLabel.classList.remove('label-focus');
        }
    });

    // input lastname
    lastnameInput.addEventListener('focus', () => {
        lastnameLabel.classList.add('label-focus');
    });

    lastnameInput.addEventListener('blur', () => {
        if (!lastnameInput.value) {
            lastnameLabel.classList.remove('label-focus');
        }
    });

    lastnameInput.addEventListener('input', () => {
        if (lastnameInput.value) {
            lastnameLabel.classList.add('label-focus');
        } else {
            lastnameLabel.classList.remove('label-focus');
        }
    });

    // input username
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

    // input phone number
    phonenumberInput.addEventListener('focus', () => {
        phonenumberLabel.classList.add('label-focus');
    });

    phonenumberInput.addEventListener('blur', () => {
        if (!phonenumberInput.value) {
            phonenumberLabel.classList.remove('label-focus');
        }
    });

    phonenumberInput.addEventListener('input', () => {
        if (phonenumberInput.value) {
            phonenumberLabel.classList.add('label-focus');
        } else {
            phonenumberLabel.classList.remove('label-focus');
        }
    });

    // input nik
    nikInput.addEventListener('focus', () => {
        nikLabel.classList.add('label-focus');
    });

    nikInput.addEventListener('blur', () => {
        if (!nikInput.value) {
            nikLabel.classList.remove('label-focus');
        }
    });

    nikInput.addEventListener('input', () => {
        if (nikInput.value) {
            nikLabel.classList.add('label-focus');
        } else {
            nikLabel.classList.remove('label-focus');
        }
    });

    // input npwp
    npwpInput.addEventListener('focus', () => {
        npwpLabel.classList.add('label-focus');
    });

    npwpInput.addEventListener('blur', () => {
        if (!npwpInput.value) {
            npwpLabel.classList.remove('label-focus');
        }
    });

    npwpInput.addEventListener('input', () => {
        if (npwpInput.value) {
            npwpLabel.classList.add('label-focus');
        } else {
            npwpLabel.classList.remove('label-focus');
        }
    });

    // input bank
    bankInput.addEventListener('focus', () => {
        bankLabel.classList.add('label-focus');
    });

    bankInput.addEventListener('blur', () => {
        if (!bankInput.value) {
            bankLabel.classList.remove('label-focus');
        }
    });

    bankInput.addEventListener('input', () => {
        if (bankInput.value) {
            bankLabel.classList.add('label-focus');
        } else {
            bankLabel.classList.remove('label-focus');
        }
    });

    // input rekening
    rekeningInput.addEventListener('focus', () => {
        rekeningLabel.classList.add('label-focus');
    });

    rekeningInput.addEventListener('blur', () => {
        if (!rekeningInput.value) {
            rekeningLabel.classList.remove('label-focus');
        }
    });

    rekeningInput.addEventListener('input', () => {
        if (rekeningInput.value) {
            rekeningLabel.classList.add('label-focus');
        } else {
            rekeningLabel.classList.remove('label-focus');
        }
    });

    // input birthdate

    birthdateInput.addEventListener('focus', () => {
        birthdateLabel.classList.add('label-focus');
    });

    birthdateInput.addEventListener('blur', () => {
        if (!birthdateInput.value) {
            birthdateLabel.classList.remove('label-focus');
        }
    });

    birthdateInput.addEventListener('input', () => {
        if (birthdateInput.value) {
            birthdateLabel.classList.add('label-focus');
        } else {
            birthdateLabel.classList.remove('label-focus');
        }
    });

    // input email

    emailInput.addEventListener('focus', () => {
        emailLabel.classList.add('label-focus');
    });

    emailInput.addEventListener('blur', () => {
        if (!emailInput.value) {
            emailLabel.classList.remove('label-focus');
        }
    });

    emailInput.addEventListener('input', () => {
        if (emailInput.value) {
            emailLabel.classList.add('label-focus');
        } else {
            emailLabel.classList.remove('label-focus');
        }
    });

    // input password
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

    confirmpasswordInput.addEventListener('focus', () => {
        confirmpasswordLabel.classList.add('label-focus');
    });

    confirmpasswordInput.addEventListener('blur', () => {
        if (!confirmpasswordInput.value) {
            confirmpasswordLabel.classList.remove('label-focus');
        }
    });

    confirmpasswordInput.addEventListener('input', () => {
        if (confirmpasswordInput.value) {
            confirmpasswordLabel.classList.add('label-focus');
        } else {
            confirmpasswordLabel.classList.remove('label-focus');
        }
    });
</script>