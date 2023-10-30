    <!-- breadcrumb start -->
    <div class="breadcrumb-section">
      <div class="container">
        <div class="row">
          <div class="col-sm-6">
            <div class="page-title">
              <h2><?php echo lang('login_heading_reseller'); ?></h2>
            </div>
          </div>
          <div class="col-sm-6">
            <nav aria-label="breadcrumb" class="theme-breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('/') ?>"><?= lang('beranda') ?></a></li>
                <li class="breadcrumb-item active"><?php echo lang('login_heading_reseller'); ?></li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div>
    <!-- breadcrumb End -->




    <!--section start-->
    <section class="login-page section-b-space">
      <div class="container">
        <?php if ($message) { ?>
          <div class="alert alert-warning">
            <strong>warning!</strong> <?php echo $message; ?>
          </div>
        <?php } ?>

        <div class="row"> 
          <div class="col-lg-6">
            <h3><?= lang('login') ?></h3>
            <div class="theme-card">
              <form class="theme-form" action="<?= base_url('reseller/login') ?>" method="post">
                <div class="form-group">
                  <label for="email">Email/Username/Phone Number</label>
                  <input type="text" class="form-control" name="identity" id="email" placeholder="Email/Username/Phone Number" required="">
                </div>
                <!--div class="form-group">
                  <label for="review"> <!?php echo lang('login_password_label', 'password'); ?></label>
                  <input type="password" class="form-control" name="password" id="review" placeholder="Enter your password" required="">
                </div-->
				 <div class="form-group">
                    <label for="review"><?php echo lang('login_password_label', 'password'); ?></label>
                    <div class="form-group has-feedback">
                      <input type="password" class="form-control" name="password" id="review" placeholder="Enter your password" required="">
                      <span toggle="#review" class="toggle-password fa fa-eye-slash form-control-feedback togglepassword"></span>
                    </div>
                 </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-solid"><?= lang('login') ?></button>
                </div>
                <div class="form-group">
                  <a href="<?= base_url('forgotpassword') ?>" class="btn btn-solid"><?php echo lang('login_forgot_password'); ?></a>
                </div>
                <!-- <a href="#" class="btn btn-solid">Login</a> -->
                
              </form>
              
            </div>
          </div>
          <div class="col-lg-6 right-login">
            <h3><?= lang('register') ?> Entrepreneurship</h3>
            <div class="theme-card authentication-right">
              <p><?= lang('desc_login') ?></p><!--a href="<!?= base_url('reg_reseller') ?>" class="btn btn-solid"><!?= lang('register') ?></a-->
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--Section ends-->