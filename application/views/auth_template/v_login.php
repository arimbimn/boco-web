   <style>
.wrapper {
  height: 100vh;
}
.myColor {
  background-image: linear-gradient(to right, #f83600 50%, #f9d423 150%);
}
.myShadow {
  box-shadow: 0 10px 10px rgba(0, 0, 0, 0.5);
}
.myBtn {
  /*border-radius: 50px;*/
  font-weight: bold;
  /*font-size: 20px;*/
  background-image: linear-gradient(to right, #0acffe 0%, #495aff 100%);
  border: none;
}
.myBtn2 {
 /* border-radius: 50px;*/
  font-weight: bold;
  /*font-size: 20px;*/
  background-image: radial-gradient(circle at 50% -20.71%, #d7c35d 0, #deba54 8.33%, #e4b04d 16.67%, #e9a546 25%, #ed9841 33.33%, #f0893e 41.67%, #f2793c 50%, #f3673d 58.33%, #f35542 66.67%, #f34249 75%, #f22b52 83.33%, #f0065d 91.67%, #ec0069 100%);
  border: none;
}
.myBtn:hover {
  background-image: linear-gradient(to right, #495aff 0%, #0acffe 100%);
}
.myHr {
  height: 2px;
  border-radius: 100px;
}
.myLinkBtn {
  border-radius: 100px;
  width: 50%;
  border: 2px solid #fff;
}
@media (max-width: 720px) {
  .wrapper {
    margin: 2px;
  }
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
              <form class="theme-form" action="<?= base_url('auth/login') ?>" method="post">
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
                 <button type="submit" class="btn btn-solid myBtn2"><?= lang('login') ?></button>
                </div>
                <div class="form-group">
                 <a href="<?= base_url('forgotpassword') ?>" class="btn btn-solid myBtn"><?php echo lang('login_forgot_password'); ?></a>
                </div>
                <!--button type="submit" class="btn btn-solid myBtn2"><!?= lang('login') ?></button-->
                <!-- <a href="#" class="btn btn-solid">Login</a> -->
                
              </form>
              
            </div>
          </div>
          <div class="col-lg-6 right-login">
            <h3><?= lang('register') ?></h3>
            <div class="theme-card authentication-right">
              <p><?= lang('desc_login') ?></p><a href="<?php echo ($this->session->userdata('reselleruser')) ? base_url('reg/'.$this->session->userdata('reselleruser')) : base_url('register') ?>" class="btn btn-solid myBtn2"><?= lang('register') ?></a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--Section ends-->