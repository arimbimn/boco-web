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
          <h2><?= lang('edit_profile') ?> </h2>
        </div>
      </div>
      <div class="col-sm-6">
        <nav aria-label="breadcrumb" class="theme-breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?= base_url('/') ?>"><?= lang('beranda') ?> </a></li>
            <li class="breadcrumb-item"><a href="<?= base_url('/users') ?>"><?= lang('my_account') ?></a></li>
            <li class="breadcrumb-item active" aria-current="page"><?= lang('edit_profile') ?> </li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
</div>
<!-- breadcrumb End -->

<!-- personal deatail section start -->
<section class="contact-page register-page">
  <div class="container">
    <div class="row">
      <?php if ($message) { ?>
        <div class="alert alert-warning">
          <strong>warning!</strong> <?php echo $message; ?>
        </div>
      <?php } ?>
      <div class="mt-2 px-3 w-full">

        <img class="mx-auto h-10 w-18 justify-center items-center mb-4" src="<?= base_url('assets/images/icon/logo.png') ?>" alt="Bocorocco">
        <h2 class=" text-base font-bold leading-7 text-gray-900 text-center"><?= lang('edit_profile') ?></h2>
        <p class="mt-1 text-sm leading-6 text-gray-600 text-center mb-3">Harap masukkan data anda dengan benar.</p>
        <!-- <?php echo form_open(uri_string()); ?> -->

        <div class=" bg-white p-2 rounded-md shadow-sm w-full">
          <h2 class=" text-base font-bold leading-7 text-gray-900 text-left my-4">Profile Section</h2>

          <form class="space-y-6" action="#" method="POST">

            <!-- Profile Section Start -->

            <div class=" grid grid-cols-1 md:grid-cols-2 gap-x-2 mt-1">
              <div class="relative flex-1 mb-3 grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class=" col-12">
                  <img class="object-cover rounded-full" src="https://via.placeholder.com/100" alt="Current profile photo" />
                </div>
                <div class=" col-span-1 md:col-span-3 flex flex-col justify-center items-left">
                  <label class="block">
                    <span class="sr-only">Choose profile photo</span>
                    <input type="file" class="block w-full text-sm text-slate-500
      file:mr-4 file:py-2 file:px-4
      file:rounded-full file:border-0
      file:text-sm file:font-semibold
      file:bg-violet-50 file:text-violet-700
      hover:file:bg-violet-100
    " />
                  </label>
                </div>
              </div>
            </div>

            <!-- baris 1 -->
            <div class=" grid grid-cols-1 md:grid-cols-2 gap-x-2 pt-3">
              <div class="relative flex-1 mb-3">
                <input type="text" id="nik" name="nik" autocomplete="nik" value="<?= $this->ion_auth->user()->row()->nik ?>" maxlength="16" pattern=".{16,}" required title="(16 chars minimum)" required class=" text-sm block w-full px-4 py-2 border-b-2 text-gray-900 shadow-sm border-gray-300 rounded-md focus:outline-none focus:border-[#008C45] placeholder-transparent text-center">
                <label for="nik" class="absolute top-3 left-4 px-2 text-sm text-gray-600 transition-transform transform origin-top-left scale-75 pointer-events-none">
                  NIK
                </label>
              </div>
              <div class="relative flex-1 mb-3">
                <input type="text" id="npwp" name="npwp" autocomplete="npwp" value="<?= $this->ion_auth->user()->row()->npwp ?>" maxlength="16" required class=" text-sm block w-full px-4 py-2 border-b-2 text-gray-900 shadow-sm border-gray-300 rounded-md focus:outline-none focus:border-[#008C45] placeholder-transparent text-center">
                <label for="npwp" class="absolute top-3 left-4 px-2 text-sm text-gray-600 transition-transform transform origin-top-left scale-75 pointer-events-none">
                  NPWP
                </label>
              </div>
            </div>

            <!-- baris 2 -->
            <div class=" grid grid-cols-1 md:grid-cols-2 gap-x-2 mt-1">
              <div class="relative flex-1 mb-3">
                <input type="text" id="name" name="name" autocomplete="nik" value="<?= $this->ion_auth->user()->row()->first_name ?>" required class=" text-sm block w-full px-4 py-2 border-b-2 text-gray-900 shadow-sm border-gray-300 rounded-md focus:outline-none focus:border-[#008C45] placeholder-transparent text-center">
                <label for="name" class="absolute top-3 left-4 px-2 text-sm text-gray-600 transition-transform transform origin-top-left scale-75 pointer-events-none">
                  First Name
                </label>
              </div>
              <div class="relative flex-1 mb-3">
                <input type="text" id="last-name" name="last-name" autocomplete="last-name" value="<?= $this->ion_auth->user()->row()->last_name  ?>" maxlength="16" required class=" text-sm block w-full px-4 py-2 border-b-2 text-gray-900 shadow-sm border-gray-300 rounded-md focus:outline-none focus:border-[#008C45] placeholder-transparent text-center">
                <label for="last-name" class="absolute top-3 left-4 px-2 text-sm text-gray-600 transition-transform transform origin-top-left scale-75 pointer-events-none">
                  Last Name
                </label>
              </div>
            </div>

            <!-- baris 3 -->
            <div class=" grid grid-cols-1 md:grid-cols-2 gap-x-2 mt-1">
              <div class="relative flex-1 mb-3">
                <input type="text" id="review" name="phone" autocomplete="phone" value="<?= $this->ion_auth->user()->row()->phone ?>" required class=" text-sm block w-full px-4 py-2 border-b-2 text-gray-900 shadow-sm border-gray-300 rounded-md focus:outline-none focus:border-[#008C45] placeholder-transparent text-center">
                <label for="review" class="absolute top-3 left-4 px-2 text-sm text-gray-600 transition-transform transform origin-top-left scale-75 pointer-events-none">
                  Phone Number
                </label>
              </div>
              <div class="relative flex-1 mb-3">
                <input type="text" id="email" name="email" autocomplete="email" value="<?= $this->ion_auth->user()->row()->email ?>" required class=" text-sm block w-full px-4 py-2 border-b-2 text-gray-900 shadow-sm border-gray-300 rounded-md focus:outline-none focus:border-[#008C45] placeholder-transparent text-center">
                <label for="email" class="absolute top-3 left-4 px-2 text-sm text-gray-600 transition-transform transform origin-top-left scale-75 pointer-events-none">
                  Email
                </label>
              </div>
            </div>

            <!-- baris 4 -->
            <div class=" grid grid-cols-1 md:grid-cols-2 gap-x-2 mt-1">
              <div class="relative flex-1 mb-3">
                <select id="jns_kelamin" name="jns_kelamin" autocomplete="jns_kelamin" required class=" text-sm block w-full px-4 py-2 border-b-2 text-gray-900 shadow-sm border-gray-300 rounded-md focus:outline-none focus:border-[#008C45] placeholder-transparent text-center">
                  <option value="" disabled selected><?= lang('index_gender_th') ?></option>
                  <option value="pria" <?php if ($this->ion_auth->user()->row()->jns_kelamin == 'Pria') {
                                          echo "selected";
                                        } ?>><?= lang('userman') ?></option>
                  <option value="wanita" <?php if ($this->ion_auth->user()->row()->jns_kelamin == 'Wanita') {
                                            echo "selected";
                                          } ?>><?= lang('userwoman') ?></option>
                </select>
                <label for="jns_kelamin" class="absolute top-3 left-4 px-2 text-sm text-gray-600 transition-transform transform origin-top-left scale-75 pointer-events-none">
                  Jenis Kelamin
                </label>
              </div>
              <div class="relative flex-1 mb-3">
                <input type="text" disabled value="<?= date('d M, Y', strtotime($this->ion_auth->user()->row()->tgl_lhr)) ?>" required class=" text-sm block w-full px-4 py-2 border-b-2 text-gray-900 shadow-sm border-gray-300 rounded-md focus:outline-none focus:border-[#008C45] placeholder-transparent text-center">
                <label for="prov" class="absolute top-3 left-4 px-2 text-sm text-gray-600 transition-transform transform origin-top-left scale-75 pointer-events-none">
                  Birth Date
                </label>
              </div>
            </div>
        </div>
        <div class=" bg-white p-2 rounded-md shadow-sm w-full mt-3">
          <h2 class=" text-base font-bold leading-7 text-gray-900 text-left my-4">Address Section</h2>
          <!-- baris 5 -->
          <div class=" grid grid-cols-1 md:grid-cols-2 gap-x-2 mt-1">
            <div class="relative flex-1 mb-3">
              <select id="prov" name="prov" autocomplete="prov" required class=" text-sm block w-full px-4 py-2 border-b-2 text-gray-900 shadow-sm border-gray-300 rounded-md focus:outline-none focus:border-[#008C45] placeholder-transparent text-center">
                <option value="" disabled selected class=" placeholder:italic placeholder:text-gray-400">Pilih provinsi</option>
                <?php
                $provinsi = $this->db->order_by('name', 'ASC')->get('provinsi')->result();
                foreach ($provinsi as $prov) {
                ?>
                  <option value="<?= $prov->provinsi_id ?>" <?php if ($this->ion_auth->user()->row()->prov == $prov->provinsi_id) {
                                                              echo "selected";
                                                            } ?>><?= $prov->name ?></option>
                <?php } ?>
              </select>
              <label for="prov" class="absolute top-3 left-4 px-2 text-sm text-gray-600 transition-transform transform origin-top-left scale-75 pointer-events-none">
                Provinsi
              </label>
            </div>
            <div class="relative flex-1 mb-3">
              <select id="kab" name="kab" required class=" text-sm block w-full px-4 py-2 border-b-2 text-gray-900 shadow-sm border-gray-300 rounded-md focus:outline-none focus:border-[#008C45] placeholder-transparent text-center">
              </select>
              <label for="kab" class="absolute top-3 left-4 px-2 text-sm text-gray-600 transition-transform transform origin-top-left scale-75 pointer-events-none">
                Kabupaten/kota
              </label>
            </div>
          </div>

          <!-- baris 6 -->
          <div class=" grid grid-cols-1 md:grid-cols-2 gap-x-2 mt-1">
            <div class="relative flex-1 mb-3">
              <select id="kec" name="kec" required class=" text-sm block w-full px-4 py-2 border-b-2 text-gray-900 shadow-sm border-gray-300 rounded-md focus:outline-none focus:border-[#008C45] placeholder-transparent text-center">
              </select>
              <label for="kec" class="absolute top-3 left-4 px-2 text-sm text-gray-600 transition-transform transform origin-top-left scale-75 pointer-events-none">
                Kecamatan
              </label>
            </div>
            <div class="relative flex-1 mb-3">
              <textarea type="text" id="exampleFormControlTextarea1" name="address" rows="6" autocomplete="address" value="<?= $this->ion_auth->user()->row()->email ?>" required class=" text-sm block w-full px-4 py-2 border-b-2 text-gray-900 shadow-sm border-gray-300 rounded-md focus:outline-none focus:border-[#008C45] placeholder-transparent text-center">
              <?= $this->ion_auth->user()->row()->address ?>
            </textarea>
              <label for="address" class="absolute top-3 left-4 px-2 text-sm text-gray-600 transition-transform transform origin-top-left scale-75 pointer-events-none">
                Alamat
              </label>
            </div>
          </div>
        </div>

        <!-- button form -->
        <div class="mt-6 flex items-center justify-end gap-x-6">
          <button type="button" class="text-sm font-semibold leading-6 bg-transparent border border-[#008C45] hover:bg-[#008C45] hover:text-gray-400 focus:outline-none focus:border-[#00461C] transition-all px-4 py-2 rounded-full text-gray-900">
            Cancel
          </button>
          <button type="submit" class="rounded-full bg-[#008C45] px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-[#00461C] focus:outline-none focus:ring focus:border-[#00461C] focus-visible:ring-[#00461C]">
            Save Changes
          </button>
        </div>
        </form>
        <br>
        <br>
      </div>
      <br>
      <br>
      <!-- <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <h3><?= lang('reset_password_heading') ?> </h3>
            <div class="form-row">
              <div class="col-md-6">
                <label for="name"><?= lang('password') ?></label>
                <input type="password" name="password" class="form-control" id="home-ploat" placeholder="<?= lang('password') ?>">
              </div>
              <div class="col-md-6">
                <label for="name"><?= lang('confirm_password') ?></label>
                <input type="password" name="password_confirm" class="form-control" id="address-two" placeholder="<?= lang('confirm_password') ?>">
              </div>
              <?php echo form_hidden('id', $user->id); ?>
              <?php echo form_hidden($csrf); ?> -->

      <!-- <div class="col-md-12">
        <br>
        <button class="btn btn-sm btn-solid" type="submit"><?= lang('submit_button') ?></button>
      </div> -->
    </div>
  </div>
  </div>
  <br>
  <br>

  <!-- <?php echo form_close(); ?> -->
  <br>
  <br>
  </div>
  </div>
  </div>
  </div>
</section>
<!-- Section ends -->
<script>
  document.querySelector("input#nik").addEventListener("input", function() {
    const allowedCharacters = "0123456789";
    this.value = this.value.split('').filter(char => allowedCharacters.includes(char)).join('')
  });
  document.querySelector("input#npwp").addEventListener("input", function() {
    const allowedCharacters = "0123456789";
    this.value = this.value.split('').filter(char => allowedCharacters.includes(char)).join('')
  });

  // baris 1
  const nikInput = document.getElementById('nik');
  const nikLabel = document.querySelector('label[for="nik"]');


  const npwpInput = document.getElementById('npwp');
  const npwpLabel = document.querySelector('label[for="npwp"]');

  //baris 2
  const nameInput = document.getElementById('name');
  const nameLabel = document.querySelector('label[for="name"]');


  const lastnameInput = document.getElementById('last-name');
  const lastnameLabel = document.querySelector('label[for="last-name"]');

  //baris 3
  const phoneInput = document.getElementById('review');
  const phoneLabel = document.querySelector('label[for="review"]');

  const emailInput = document.getElementById('email');
  const emailLabel = document.querySelector('label[for="email"]');

  //baris 4
  const jnskelaminInput = document.getElementById('jns_kelamin');
  const jnskelaminLabel = document.querySelector('label[for="jns_kelamin"]');

  const birthdateInput = document.getElementById('prov');
  const birthdateLabel = document.querySelector('label[for="prov"]');

  //baris 5
  const provinsiInput = document.getElementById('prov');
  const provinsiLabel = document.querySelector('label[for="prov"]');

  const kabupatenInput = document.getElementById('kab');
  const kabupatenLabel = document.querySelector('label[for="kab"]');

  //baris 6
  const kecamatanInput = document.getElementById('kec');
  const kecamatanLabel = document.querySelector('label[for="kec"]');

  const alamatInput = document.getElementById('exampleFormControlTextarea1');
  const alamatLabel = document.querySelector('label[for="address"]');


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
    if (!nameInput.value) {
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

  // input Firstname
  nameInput.addEventListener('focus', () => {
    nameLabel.classList.add('label-focus');
  });

  nameInput.addEventListener('blur', () => {
    if (!nameInput.value) {
      nameLabel.classList.remove('label-focus');
    }
  });

  nameInput.addEventListener('input', () => {
    if (nameInput.value) {
      nameLabel.classList.add('label-focus');
    } else {
      nameLabel.classList.remove('label-focus');
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

  // input phone
  phoneInput.addEventListener('focus', () => {
    phoneLabel.classList.add('label-focus');
  });

  phoneInput.addEventListener('blur', () => {
    if (!phoneInput.value) {
      phoneLabel.classList.remove('label-focus');
    }
  });

  phoneInput.addEventListener('input', () => {
    if (phoneInput.value) {
      phoneLabel.classList.add('label-focus');
    } else {
      phoneLabel.classList.remove('label-focus');
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

  // input jenis kelamin
  jnskelaminInput.addEventListener('focus', () => {
    jnskelaminLabel.classList.add('label-focus');
  });

  jnskelaminInput.addEventListener('blur', () => {
    if (!jnskelaminInput.value) {
      jnskelaminLabel.classList.remove('label-focus');
    }
  });

  jnskelaminInput.addEventListener('input', () => {
    if (jnskelaminInput.value) {
      jnskelaminLabel.classList.add('label-focus');
    } else {
      jnskelaminLabel.classList.remove('label-focus');
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

  // input provinsi

  provinsiInput.addEventListener('focus', () => {
    provinsiLabel.classList.add('label-focus');
  });

  provinsiInput.addEventListener('blur', () => {
    if (!provinsiInput.value) {
      provinsiLabel.classList.remove('label-focus');
    }
  });

  provinsiInput.addEventListener('input', () => {
    if (provinsiInput.value) {
      provinsiLabel.classList.add('label-focus');
    } else {
      provinsiLabel.classList.remove('label-focus');
    }
  });

  // input kabupaten/kota

  kabupatenInput.addEventListener('focus', () => {
    kabupatenLabel.classList.add('label-focus');
  });

  kabupatenInput.addEventListener('blur', () => {
    if (!kabupatenInput.value) {
      kabupatenLabel.classList.remove('label-focus');
    }
  });

  kabupatenInput.addEventListener('input', () => {
    if (kabupatenInput.value) {
      kabupatenLabel.classList.add('label-focus');
    } else {
      kabupatenLabel.classList.remove('label-focus');
    }
  });

  // input kecamatan
  kecamatanInput.addEventListener('focus', () => {
    kecamatanLabel.classList.add('label-focus');
  });

  kecamatanInput.addEventListener('blur', () => {
    if (!kecamatanInput.value) {
      kecamatanLabel.classList.remove('label-focus');
    }
  });

  kecamatanInput.addEventListener('input', () => {
    if (kecamatanInput.value) {
      kecamatanLabel.classList.add('label-focus');
    } else {
      kecamatanLabel.classList.remove('label-focus');
    }
  });

  // input alamat
  alamatInput.addEventListener('focus', () => {
    alamatLabel.classList.add('label-focus');
  });

  alamatInput.addEventListener('blur', () => {
    if (!alamatInput.value) {
      alamatLabel.classList.remove('label-focus');
    }
  });

  alamatInput.addEventListener('input', () => {
    if (alamatInput.value) {
      alamatLabel.classList.add('label-focus');
    } else {
      alamatLabel.classList.remove('label-focus');
    }
  });
</script>