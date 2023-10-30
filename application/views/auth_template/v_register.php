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
    <!--section start-->
    <section class="register-page section-b-space" style="background-color: #ADD8E6;">
      <div class="container">
        <?php if ($message) { ?>
          <div class="alert alert-warning">
            <strong>warning!</strong> <?php echo $message; ?>
          </div>
        <?php } ?>

        <div class="row">
          <div class="col-lg-12">
            <h3><?php echo lang('create_user_heading'); ?></h3>
            <div class="theme-card">
              <form class="theme-form" action="<?= base_url('auth/register') ?>" method="POST">
                <div class="form-row">
                  <div class="col-md-6">
                    <label for="email"><?php echo lang('create_user_fname_label'); ?></label>
                    <input type="text" class="form-control" name="first_name" id="fname" value="<?= set_value('first_name') ?>" placeholder="<?php echo lang('first_name'); ?>" required="">
                  </div>
                  <div class="col-md-6">
                    <label for="review"> <?php echo lang('create_user_lname_label'); ?></label>
                    <input type="text" class="form-control" name="last_name" id="lname" placeholder="<?php echo lang('last_name'); ?>" value="<?= set_value('last_name') ?>" required="">
                  </div>
                </div>
                <div class="form-row">
                  <div class="col-md-6">
                    <label for="username"><?php echo lang('create_user_validation_username_label'); ?></label>
                    <input type="text" class="form-control" name="username" id="username" value="<?= set_value('username') ?>" placeholder="<?php echo lang('create_user_validation_username_label'); ?>" required="">
                  </div>
                  <div class="col-md-6">
                    <label for="phone"><?php echo lang('create_user_phone_label'); ?></label>
                    <input type="number" class="form-control" name="phone" id="phone" placeholder="<?php echo lang('phone'); ?>" value="<?= set_value('phone') ?>" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="13" required="">
                  </div>
                </div>
                <div class="form-row">
                  <div class="col-md-6">
                    <label for="tgl_lhr"><?= lang('birth_date') ?></label>
                    <input type="text" class="form-control datepicker" name="tgl_lhr" id="tgl_lhr" value="<?= set_value('tgl_lhr') ?>" placeholder="<?= lang('birth_date') ?>" required="">
                  </div>
                  <div class="col-md-6">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="<?= set_value('email') ?>" required="">
                  </div>
                  <div class="col-md-6">
                    <label for="password"><?php echo lang('create_user_password_label', 'password'); ?></label>
                    <div class="form-group has-feedback">
                      <input type="password" class="form-control" name="password" id="passfield" placeholder="<?php echo lang('password'); ?>" required="">
                      <span toggle="#passfield" class="toggle-password fa fa-eye-slash form-control-feedback togglepassword"></span>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <label for="password"><?php echo lang('create_user_password_confirm_label', 'confirm_password'); ?></label>
                    <div class="form-group has-feedback">
                      <input type="password" class="form-control" name="confirm_password" id="confirm_passfield" placeholder="<?php echo lang('confirm_password'); ?>" required="">
                      <span toggle_confirm="#confirm_passfield" class="toggle-confirmpassword fa fa-eye-slash form-control-feedback toggle_confirmpassword"></span>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <button class="btn btn-solid" type="submit"><?= lang('create_user_submit_btn') ?></button>
                  </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--Section ends-->