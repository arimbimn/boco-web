    <!-- breadcrumb start -->
    <div class="breadcrumb-section">
      <div class="container">
        <div class="row">
          <div class="col-sm-6">
            <div class="page-title">
              <h2><?=lang('reset_password_heading')?></h2>
            </div>
          </div>
          <div class="col-sm-6">
            <nav aria-label="breadcrumb" class="theme-breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('/') ?>"><?=lang('beranda')?></a></li>
                <li class="breadcrumb-item active"><?=lang('reset_password_heading')?></li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div>
    <!-- breadcrumb End -->


    <!--section start-->
    <section class="pwd-page section-b-space">
      <div class="container">
        <?php if ($message) { ?>
          <div class="alert alert-warning">
            <strong>warning!</strong> <?php echo $message; ?>
          </div>
        <?php } ?>
        <div class="row">
          <div class="col-lg-6 offset-lg-3">
            <h2><?=lang('reset_password_heading')?></h2>
            <?php echo form_open('auth/reset_password/' . $code, ['class'   => 'theme-form',]); ?>

            <div class="form-row">
              <div class="col-md-12">
                <input type="password" class="form-control" name="new" id="email" placeholder="New Password" required>
              </div>
              <div class="col-md-12">
                <input type="password" class="form-control" name="new_confirm" id="email" placeholder="New Password Confirm" required>
              </div>
              <?php echo form_input($user_id); ?>
              <?php echo form_hidden($csrf); ?>
              <button type="submit" class="btn btn-solid"><?=lang('submit_button')?></button>
              <!-- <a href="#" class="btn btn-solid">Submit</a> -->

            </div>
            <?php echo form_close(); ?>
          </div>
        </div>
      </div>
    </section>
    <!--Section ends-->
