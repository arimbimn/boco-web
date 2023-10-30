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
      <div class="col-sm-12">

        <h3><?= lang('edit_profile') ?></h3>
        <?php echo form_open(uri_string()); ?>
        <div class="form-row">
		  <div class="col-md-6">
            <label for="nik">NIK (KTP)</label>
            <input type="text" class="form-control" name="nik" value="<?= $this->ion_auth->user()->row()->nik ?>" id="nik" placeholder="NIK" maxlength="16" pattern=".{16,}" required title="(16 chars minimum)">
          </div>
          <div class="col-md-6">
            <label for="npwp">NPWP</label>
            <input type="text" class="form-control" name="npwp" value="<?= $this->ion_auth->user()->row()->npwp ?>" id="npwp" placeholder="NPWP" maxlength="16">
          </div>
          <div class="col-md-6">
            <label for="name"><?= lang('index_fname_th') ?></label>
            <input type="text" class="form-control" name="first_name" value="<?= $this->ion_auth->user()->row()->first_name ?>" id="name" placeholder="<?= lang('index_fname_th') ?>" required="">
          </div>
          <div class="col-md-6">
            <label for="last-name"><?= lang('index_lname_th') ?></label>
            <input type="text" class="form-control" name="last_name" value="<?= $this->ion_auth->user()->row()->last_name  ?>" id="last-name" placeholder="<?= lang('index_lname_th') ?>" required="">
          </div>
          <div class="col-md-6">
            <label for="review"><?= lang('create_user_phone_label') ?></label>
            <input type="text" class="form-control" name="phone" value="<?= $this->ion_auth->user()->row()->phone ?>" id="review" placeholder="<?= lang('create_user_phone_label') ?>" required="">
          </div>
          <div class="col-md-6">
            <label for="email">Email</label>
            <input type="text" class="form-control" name="email" value="<?= $this->ion_auth->user()->row()->email ?>" id="email" placeholder="Email" required="">
          </div>
          <div class="col-md-6">
            <label for="jns_kelamin"><?= lang('index_gender_th') ?></label>
            <select class="form-control" name="jns_kelamin" id="jns_kelamin" required="">
              <option value=""><?= lang('index_gender_th') ?></option>
              <option value="Pria" <?php if ($this->ion_auth->user()->row()->jns_kelamin == 'Pria') {
                                      echo "selected";
                                    } ?>><?= lang('userman') ?></option>
              <option value="Wanita" <?php if ($this->ion_auth->user()->row()->jns_kelamin == 'Wanita') {
                                        echo "selected";
                                      } ?>><?= lang('userwoman') ?></option>
            </select>
          </div>

          <div class="col-md-6">
            <label for="prov"><?= lang('birth_date') ?></label>
            <input type="text" class="form-control" disabled value="<?= date('d M, Y', strtotime($this->ion_auth->user()->row()->tgl_lhr)) ?>" placeholder="<?= lang('birth_date') ?>" required="">
          </div>

          <div class="col-md-6">
            <label for="prov"><?= lang('user_province') ?></label>
            <select class="form-control option-select" name="prov" id="prov" data-placeholder="<?= lang('user_province') ?>">
              <option value=""></option>
              <?php
              $provinsi = $this->db->order_by('name', 'ASC')->get('provinsi')->result();
              foreach ($provinsi as $prov) {
              ?>
                <option value="<?= $prov->provinsi_id ?>" <?php if ($this->ion_auth->user()->row()->prov == $prov->provinsi_id) {
                                                            echo "selected";
                                                          } ?>><?= $prov->name ?></option>
              <?php } ?>
            </select>
          </div>
          <div class="col-md-6">
            <label for="kab"><?= lang('user_district') ?></label>
            <select class="form-control option-select" name="kab" id="kab" data-placeholder="<?= lang('user_district') ?>">
            </select>
          </div>
          <div class="col-md-6">
            <label for="kec"><?= lang('user_subdistrict') ?></label>
            <select class="form-control option-select" name="kec" id="kec" data-placeholder="<?= lang('user_subdistrict') ?>">
            </select>
          </div>

          <div class="col-md-12">
            <label for="review"><?= lang('user_address') ?></label>
            <textarea class="form-control mb-0" name="address" placeholder="<?= lang('user_address') ?>" id="exampleFormControlTextarea1" rows="6"><?= $this->ion_auth->user()->row()->address ?></textarea>
          </div>
          <br>
          <br>
        </div>
        <br>
        <br>
        <div class="container">
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
                <?php echo form_hidden($csrf); ?>

                <div class="col-md-12">
                  <br>
                  <button class="btn btn-sm btn-solid" type="submit"><?= lang('submit_button') ?></button>
                </div>
              </div>
            </div>
          </div>
          <br>
          <br>

          <?php echo form_close(); ?>
          <br>
          <br>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- Section ends -->
<script>
document.querySelector("input#nik").addEventListener("input", function(){
            const allowedCharacters="0123456789";
          this.value = this.value.split('').filter(char => allowedCharacters.includes(char)).join('')
        });
document.querySelector("input#npwp").addEventListener("input", function(){
            const allowedCharacters="0123456789";
          this.value = this.value.split('').filter(char => allowedCharacters.includes(char)).join('')
        });
</script>