  <!-- breadcrumb start -->
  <div class="breadcrumb-section">
    <div class="container">
      <div class="row">
        <div class="col-sm-6">
          <div class="page-title">
            <h2><?php echo lang('forgot_password_heading'); ?></h2>
          </div>
        </div>
        <div class="col-sm-6">
          <nav aria-label="breadcrumb" class="theme-breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?= base_url('/') ?>"><?= lang('beranda') ?></a></li>
              <li class="breadcrumb-item"><a href="<?= base_url('login') ?>"><?= lang('login') ?></a></li>
              <li class="breadcrumb-item active" aria-current="page"><?php echo lang('forgot_password_heading'); ?></li>
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
          <h2><?php echo lang('forgot_password_heading'); ?></h2>
          <form class="theme-form" action="<?= base_url('forgotpassword') ?>" method="post">
            <div class="form-row">
              <div class="col-md-12">
                <input type="email" class="form-control rounded-full" name="identity" id="email" placeholder="Enter Your Email" required>
              </div>
              <button type="submit" class="btn btn-solid"><?= lang('forgot_password_submit_btn') ?></button>
              <!-- <a href="#" class="btn btn-solid">Submit</a> -->
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
  <!--Section ends-->