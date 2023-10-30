    <!-- breadcrumb start -->
    <div class="breadcrumb-section">
      <div class="container">
        <div class="row">
          <div class="col-sm-6">
            <div class="page-title">
              <h2><?php echo lang('create_user_reseller_heading'); ?></h2>
            </div>
          </div>
          <div class="col-sm-6">
            <nav aria-label="breadcrumb" class="theme-breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= base_url('/') ?>"><?= lang('beranda') ?></a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo lang('create_user_reseller_heading'); ?></li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </div>
    <!-- breadcrumb End -->
    <!--section start-->
    <section class="register-page section-b-space">
      <div class="container">
        <?php if ($message) { ?>
          <div class="alert alert-warning">
            <strong>warning!</strong> <?php echo $message; ?>
          </div>
        <?php } ?>

        <div class="row">
          <div class="col-lg-12">
            <h3><?php echo lang('create_user_reseller_heading'); ?></h3>
            <div class="theme-card">
              <form class="theme-form" action="<?= base_url('reseller/register') ?>" method="POST">
				<div class="form-row">
                  <div class="col-md-6">
                    <label for="nik">NIK (KTP)</label>
                    <input type="text" class="form-control" name="nik" id="nik" value="<?= set_value('nik') ?>" placeholder="NIK" maxlength="16" pattern=".{16,}" required title="(16 chars minimum)">
                  </div>
				 <div class="col-md-4">
                    <label for="npwp">NPWP</label><span id="labelnpwp"></span>
                    <input type="text" class="form-control" name="npwp" value="<?= set_value('npwp') ?>" id="npwp" placeholder="NPWP" maxlength="16">
                  </div>
                  <div class="col-md-2">
                      <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" id="autoSizingCheck">
                        <label class="form-check-label" for="autoSizingCheck">
                          Kirim bukti potong ke email
                        </label>
                      </div>
                  </div>
                </div>
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
                    <input type="text" class="form-control" name="username" id="username" value="<?= set_value('username') ?>" placeholder="<?php echo lang('create_user_validation_username_label'); ?>" required="" >
                  </div>
                  <div class="col-md-6">
                    <label for="phone"><?php echo lang('create_user_phone_label'); ?></label>
                    <input type="number" class="form-control" name="phone" id="phone" placeholder="<?php echo lang('phone'); ?>" value="<?= set_value('phone') ?>" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="13" required="">
                  </div>
                </div>
				 <div class="form-row">
                  <div class="col-md-6">
                    <label for="bank">Bank</label>
					<!--select class="form-control" name="bank" id="bank" required="">
					  <option value="" selected></option>
					  <option value="BCA">BCA</option>
					  <option value="MANDIRI">MANDIRI</option>
					  <option value="BRI">BRI</option>
					</select-->
                    <!--input type="text" class="form-control" name="bank" id="bank" value="<?= set_value('bank') ?>" placeholder="Bank" required=""-->
                    <select class="form-control" name="bank" id="bank" data-placeholder="Select Bank" required="">
                      <option value="<?=  $codebank.'#'.$namabank ?>"><?= $namabank ?></option>
                      <?php
                      /*$banks = $this->db->select('code_bank,name_bank')->where('type_bank !=', '0')->get('tb_banks')->result();
                      var_dump($banks);exit();
                      echo $this->db->last_query();
		              exit();*/
		              //echo ($banks);exit();
		              if($banks){
                      foreach ($banks as $row) : ?>
                        <option value="<?= $row->code_bank ?>"><?= $row->name_bank ?></option>
                      <?php 
                      endforeach; 
		              }
                      ?>
                    </select>
                  </div>
                  <div class="col-md-6">
                    <label for="norek">No rekening</label>
                    <input type="text" class="form-control" name="norek" id="norek" placeholder="Norek" value="<?= set_value('norek') ?>" required="">
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
                      <input type="password" class="form-control" name="password" id="passfield" value="<?= set_value('password') ?>" placeholder="<?php echo lang('password'); ?>" required="">
                      <span toggle="#passfield" class="toggle-password fa fa-eye-slash form-control-feedback togglepassword"></span>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <label for="password"><?php echo lang('create_user_password_confirm_label', 'confirm_password'); ?></label>
                    <div class="form-group has-feedback">
                      <input type="password" class="form-control" name="confirm_password" id="confirm_passfield" value="<?= set_value('confirm_password') ?>" placeholder="<?php echo lang('confirm_password'); ?>" required="">
                      <span toggle_confirm="#confirm_passfield" class="toggle-confirmpassword fa fa-eye-slash form-control-feedback toggle_confirmpassword"></span>
                    </div>
                  </div>
				  <div class="col-md-6">
                    <label for="referer">Referer ( Isi username referer )</label>
					<p><small class="text-danger">*Harap perhatikan! isi ini dengan username Referer anda</small></p>
                    <input type="text" class="form-control" name="referer" id="referer" placeholder="Referer (Username referer)" value="<?php echo ($inireferer !='' && $inireferer != NULL ? $inireferer : 'PUSAT') ?>" readonly >
					 <!--?= ($this->session->userdata('reselleruser') ? 'readonly' : '') ?-->
					 <!--?php echo ($this->session->userdata('reselleruser') ? $this->session->userdata('reselleruser') : 'PUSAT') ?-->
                  </div>
                  <div class="col-md-12">
                    <button class="btn btn-solid" type="submit"><?= lang('create_user_reseller_heading') ?></button>
                  </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!--Section ends-->
	<script>
        document.querySelector("input#username").addEventListener("input", function(){
		  //const allowedCharacters="0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBNzáàâãéèêíïóôõöúçñÁÀÂÃÉÈÍÏÓÔÕÖÚÇÑ";
		  const allowedCharacters="0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
		  this.value = this.value.split('').filter(char => allowedCharacters.includes(char)).join('')
		});
		document.querySelector("input#nik").addEventListener("input", function(){
            const allowedCharacters="0123456789";
          this.value = this.value.split('').filter(char => allowedCharacters.includes(char)).join('')
        });
		document.querySelector("input#npwp").addEventListener("input", function(){
            const allowedCharacters="0123456789";
          this.value = this.value.split('').filter(char => allowedCharacters.includes(char)).join('')
        });
		$(document).ready(function() {           
            cekDataR();
            function cekDataR(){
				var referer  = $('#referer').val();
    			$.ajax({
    				url:'<?php echo base_url() ?>reseller/cekreseller', // URL of where AJAX should POST the data
    				type: 'POST', // Send a POST to server
    				data: {'referer': referer}, // Data to be POSTED to server. In PHP use echo $_POST['id']; to see what the AJAX passed in
    				dataType:'json',
    				success: function(data){
    				    if(data.status === false){
							$('#nik').attr('disabled' , true);
    				        $('#npwp').attr('disabled' , true);
    				        $('#fname').attr('disabled' , true);
    				        $('#lname').attr('disabled' , true);
    				        $('#username').attr('disabled' , true);
    				        $('#phone').attr('disabled' , true);
    				        $('#bank').attr('disabled' , true);
    				        $('#norek').attr('disabled' , true);
    				        $('#tgl_lhr').attr('disabled' , true);
    				        $('#email').attr('disabled' , true);
    				        $('#passfield').attr('disabled' , true);
    				        $('#confirm_passfield').attr('disabled' , true);
    				        $('#referer').attr('disabled' , true);
    				        $('button[type="submit"]').attr('disabled' , true);
    				    }
    				},
    				error: function (result) {
    					alert("Error");
    				}
    			});
    		};
        });
    </script>