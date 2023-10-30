  <!-- breadcrumb start -->
  <div class="breadcrumb-section">
    <div class="container">
      <div class="row">
        <div class="col-sm-6">
          <div class="page-title">
            <h2><?= lang('referrer_user') ?></h2>
          </div>
        </div>
        <div class="col-sm-6">
          <nav aria-label="breadcrumb" class="theme-breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="<?= base_url('/') ?>"><?= lang('beranda') ?></a></li>
              <li class="breadcrumb-item active" aria-current="page"><?= lang('referrer_user') ?></li>
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


      <div class="row">
        <div class="col-lg-6 offset-lg-3">
          <h2><?= lang('email_refer_user') ?> <?php echo $this->session->userdata('refferemail') ?></h2>
          <p><?= lang('desc_formreffer') ?></p>
          <form class="theme-form" action="<?= base_url('users/refer/save') ?>" method="post">
            <div class="form-row">
              <?php if ($this->session->userdata('refferemail') || $this->session->userdata('reselleremail')) { ?>
                <input type="hidden" name="email_refer" value="<?= ($this->session->userdata('refferemail')) ? $this->session->userdata('refferemail') : $this->session->userdata('reselleremail') ?>">
                <div class="col-md-12">
                  <input type="email" disabled class="form-control" name="email_refer" id="email" value="<?= ($this->session->userdata('refferemail')) ? $this->session->userdata('refferemail') : $this->session->userdata('reselleremail') ?>" placeholder="Enter Email userRefer" required>

                </div>
              <?php } else { ?>
                <div class="col-md-12">
                  <input type="text" class="form-control" name="email_refer" id="email" value="<?= set_value('email_refer') ?>" placeholder="<?= lang('placeholder_refferrer_email_username') ?>" required>
                  <?= form_error('email_refer', '<small class="text-danger">', '</small>') ?>
                </div>
              <?php } ?>
              <button type="submit" class="btn btn-solid"><?= lang('submit_button') ?></button>
              <!-- <a href="#" class="btn btn-solid">Submit</a> -->
            </div>



          </form>
          <br>
          <?php
          if ($this->cart->total_items()) {
            $link = base_url('cart');
          } else {
            $link = base_url('users');
          }
          ?>
          <a href="<?= $link ?>" class="btn btn-solid"><?= lang('skip_button') ?></a>

        </div>
      </div>
    </div>
  </section>
  <!--Section ends-->