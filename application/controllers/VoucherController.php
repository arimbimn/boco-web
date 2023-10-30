<?php
defined('BASEPATH') or exit('No direct script access allowed');

class VoucherController extends CI_Controller
{
	var $kode_voucher_reseller;
  public function __construct()
  {
    parent::__construct();
    $this->load->model('M_voucher');
    $this->load->model('M_product');
    $this->load->model('M_order');
    $this->load->model('M_refer');
    if (!$this->ion_auth->logged_in()) {
      $this->session->set_flashdata('message', 'Login Terlebih Dahulu');
      redirect('login', 'refresh');
    }
	$this->kode_voucher_reseller='VCRESELLER';
  }


  public function listVoucher()
  {
     $date = date('Y-m-d');
    $data = [
      'title' => 'Voucher User | Bocorocco Pillow Concept',
      'voucher' => $this->M_voucher->getVoucherUser(),
      'voucher_referer' => $this->M_voucher->voucherRefer(),
      'cekMember' => $this->db->where(['user_id' => $this->ion_auth->user()->row()->id])->where("DATE_FORMAT(masaberlaku,'%Y-%m-%d') >=", $date)->get('user_membership')->row(),
    ];

    $this->template->load('template', 'users/voucher/v_voucher', $data);
  }




  public function addVoucherCekout()
  {

    $id_voucher = $this->input->post('id_voucher');
    $is_Upgrade = $this->input->post('is_Upgrade');
    $voucher = $this->db->where(['id_voucher' => $id_voucher])->where(['to_date >=' => date('Y-m-d')])
      ->where(['from_date <=' => date('Y-m-d')])->get('voucher')->row();



    // var_dump($voucher);
    if (!$voucher) {
      $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
       ' . lang('voucher_not_available') . '
        </div>');
      return  redirect('/cekout');
    };

    foreach ($this->cart->contents() as $items) {
      $item_barang_exclude_sepatu = explode(",", $voucher->exclude_sepatu_tag);
      if (in_array($items['id'], $item_barang_exclude_sepatu, TRUE)) {
        $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
           Product ' . $items['name'] . ' not allowed to use this voucher
            </div>');
        return  redirect('/cekout');
      }
    }

    // var_dump($voucher);
    // die;


    if ($voucher->voucher_vip == 1 ||  $voucher->voucher_getone == 1) {
      $qty  = 0;
      foreach ($this->cart->contents() as $items) {
        $qty = $qty + $items['qty'];
      }

      if ($voucher->voucher_getone == 1) {
        if ($qty < $voucher->min_getone) {
          $this->session->set_flashdata('message', "<div class='alert alert-warning' role='alert'>
        " . lang('minimum_purchase_1') . "  " . $voucher->min_getone . "</div>");
          return  redirect('/cekout');
        }
      } else if ($qty < 2) {
        $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
       ' . lang('minimum_purchase_1') . ' 2 </div>');
        return  redirect('/cekout');
      }
    }

    if ($voucher->voucher_redemption == 1) {
      $qty  = 0;
      foreach ($this->cart->contents() as $items) {
        $qty = $qty + $items['qty'];
      }

      if ($qty < 2) {
        $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
        ' . lang('minimum_purchase_1') . ' 2
        </div>');
        return  redirect('/cekout');
      }

      $user_refer = $this->M_refer->get_referuserDiamond()->result();

      if (!$user_refer) {
        $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
          ' . lang('referrer_voucher_message') . '
        </div>');
        return  redirect('/cekout');
      }
    }

    if ($voucher->is_benefit_ulangtahun == 1) {
      if (date('m') != date('m', strtotime($this->ion_auth->user()->row()->tgl_lhr))) {
        $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
          ' . lang('birthday_voucher_message') . '
        </div>');
        return  redirect('/cekout');
      }
    }

    // voucher gratis walet harus memakai voucher redemption
    if ($voucher->id_voucher == 41 || $voucher->id_voucher == 42) {
      $isused_redemtion = $this->db->where(['user_id' => $this->ion_auth->user()->row()->id])->where(['voucher_id' => 32])->where(['is_used' => 1])->get('voucher_used')->row();
      if (!$isused_redemtion) {
        $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
          Voucher ini hanya bisa di gunakan setelah anda memakai redemption
        </div>');
        return  redirect('/cekout');
      }
    }

    // Voucher Gratis Walet Setelah Memakai B2GS1
    if ($voucher->id_voucher == 47) {
      $isused_bgs = $this->db->where(['user_id' => $this->ion_auth->user()->row()->id])->where(['voucher_id' => 45])->where(['is_used' => 1])->get('voucher_used')->row();
      if (!$isused_bgs) {
        $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
          Voucher ini hanya bisa di gunakan setelah anda memakai Voucher B2GS
        </div>');
        return  redirect('/cekout');
      }
    }

    // Voucher Default
    if ($voucher->voucher_default == 1) {
      $isused = $this->db->where(['user_id' => $this->ion_auth->user()->row()->id])->where(['voucher_id' => $voucher->id_voucher])->where(['is_used' => 1])->order_by('created_at', 'desc')->get('voucher_used')->row();

      if ($isused) {
        $thNow = date('Y');
        $createdVoucher = date('Y', strtotime($isused->created_at));
        if ($createdVoucher == $thNow) {
          $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
          ' . lang('birthday_voucher_message_2') . '
        </div>');
          return  redirect('/cekout');
        } else {
          $cekTotalBelanja = $this->M_order->getTotalSumOrder();

          // var_dump($cekTotalBelanja->total_bayar);
          // die;
          if ($cekTotalBelanja) {
            if ($cekTotalBelanja->total_bayar > 20000000) {
            } else {
              $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
          ' . lang('renewal_voucher') . '
        </div>');
              return  redirect('/cekout');
            }
          } else {
            $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
            ' . lang('renewal_voucher') . '
        </div>');
            return  redirect('/cekout');
          }
        }
      } else {
      }
    } else {
      if ($voucher->voucher_refer == 1) {

        if ($voucher->total_refer_diamond == 10) {
          //Cek dalam 1 bulan
          $jumlahOneMount = $this->M_refer->get_referuserDiamondOneMount();
          if ($jumlahOneMount < 10) {
            $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
              Referrer Ada Kurang Dari 10 Diamond Dalam Waktu 1 Bulan
              </div>');
            return  redirect('/cekout');
          }
        }
      }
    }


    // Voucher End Default



    if ($voucher->isupgradediamond == 1) {

      if ($voucher->diskonupgrade == 1) {
        $this->session->set_flashdata('isupgradediamond', 1);
        $this->hitungVoucher($voucher, $voucher->id_voucher);
      } else {
        $this->session->set_flashdata('isupgradediamond', 1);
      }
    } else {
      $this->hitungVoucher($voucher, $id_voucher);
    }


    return redirect('/cekout');
  }

function left($str, $length) {
     return substr($str, 0, $length);
}
function left_custome($str,$awal, $length) {
     return substr($str, $awal, $length);
} 
function right($str, $length) {
     return substr($str, -$length);
}
  public function addKodeVoucher()
  {
	  //==kode voucher tanpa user_id
	  /*$str_voucher=explode("-",strtolower($this->input->post('kode_voucher')));
	  //var_dump($str_voucher);exit();
		if(count($str_voucher)>1) {
			 //echo "explodable";
			 $getID = $this->db->where(['username' => trim($str_voucher[0])])
			->where(['reseller' => '1'])->where(['sts_reseller' => '1'])->get('users')->row();
			if($getID) {
				$kode_voucher = trim($str_voucher[1]);
				//var_dump($kode_voucher.'#'.$getID->id);exit();
			  //==buat set session
					$session_data = [
						'resellerid'    => $getID->id,
					];
					$this->session->set_userdata($session_data);
				//==end session
			}else{
				$this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
				 ' . lang('voucher_code_not_available') . '
				</div>');
			  return redirect('/cekout');
			}
		}*/
		$str_voucher_arr=explode("-",strtolower($this->input->post('kode_voucher')));
		$voucher_punya='';
		$kode_voucher='salah';
		$getID = $this->db->where(['username' => trim(strtolower($this->input->post('kode_voucher')))])
			->where(['reseller' => '1'])->where(['sts_reseller' => '1'])->get('users')->row();
		/*if($getID) {
			<!--if(trim(strtolower($this->input->post('kode_voucher'))) == 'Yilufa88' && $this->ion_auth->user()->row()->id == '21623'){
				$kode_voucher = 'B1G11X';
			}else{
				$kode_voucher = $this->kode_voucher_reseller;
			}-->
			$kode_voucher = $this->kode_voucher_reseller;
			$session_data = [
						'resellerid'    => $getID->id,
					];
			$this->session->set_userdata($session_data);
		}else if(count($str_voucher_arr)>1) {
		    $getID = $this->db->select('a.id')->join('tb_wallet b','a.id = b.user_id')->where(['username' => trim(strtolower($str_voucher_arr[1]))])
			->where(['reseller' => '1'])->where(['sts_reseller' => '1'])->get('users a')->row();
		    if($getID) {
		        $kode_voucher = $str_voucher_arr[0];
		        $voucher_punya=$getID->id;
		        $session_data = [
						'resellerid'    => $getID->id,
					];
			    $this->session->set_userdata($session_data);
		    }else{
		        $kode_voucher ="VOUCHER INI RAHASIA";
		    }
		}else {
			$session_data = [
					'resellerid'    => '',
				];
			$this->session->set_userdata($session_data);
			$kode_voucher = strtolower($this->input->post('kode_voucher'));
		}*/
		if($getID) {
			if(trim(strtolower($this->input->post('kode_voucher'))) == 'Yilufa88' && $this->ion_auth->user()->row()->id == '21623'){
				$kode_voucher = 'B1G11X';
			}else{
				$kode_voucher = $this->kode_voucher_reseller;
			}
			//$kode_voucher = $this->kode_voucher_reseller; //ini pemakaian voucher pada saat customer isi kode voucher dengan username upline
			$session_data = [
						'resellerid'    => $getID->id,
					];
			$this->session->set_userdata($session_data);
		}else{
		    if(count($str_voucher_arr)>1){
		        $getID = $this->db->select('a.id')->join('tb_wallet b','a.id = b.user_id')->where(['username' => trim(strtolower($str_voucher_arr[1]))])
    			->where(['reseller' => '1'])->where(['sts_reseller' => '1'])->get('users a')->row();
    		    if($getID) {
    		        $kode_voucher = $str_voucher_arr[0];
    		        $voucher_punya=$getID->id;
    		        $session_data = [
    						'resellerid'    => $getID->id,
    					];
    			    $this->session->set_userdata($session_data);
    		    }else{
    		        $session_data = [
    					'resellerid'    => '',
    				];
        			$this->session->set_userdata($session_data);
        			$kode_voucher = strtolower($this->input->post('kode_voucher'));
    		    }
		    }else{
    		        $session_data = [
    					'resellerid'    => '',
    				];
        			$this->session->set_userdata($session_data);
        			$kode_voucher = strtolower($this->input->post('kode_voucher'));
		    }
		}
		//echo $this->db->last_query();
		//exit();
		//var_dump($getID);exit();
	  //==end kode voucher tanpa user_id
	  ///==ini baru jika mau dipakai ebe
	  /*$vv=$this->left($this->input->post('kode_voucher'),1);
	  if($vv == 'v'){
		  $vv1=$this->left($this->input->post('kode_voucher'),strlen($this->input->post('kode_voucher'))-4);
		  $vkode_reseller=$this->left_custome($vv1,1,strlen($vv1)-1);
		  
		  $kode_voucher = $this->right($this->input->post('kode_voucher'),4);
		  $cek_reseller = $this->db->where(['id' => $vkode_reseller])
        ->where(['reseller' => '1'])->get('users')->row();
		if (!$cek_reseller) {
		  $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
			 ' . lang('voucher_code_not_available') . '
			</div>');
		  return redirect('/cekout');
		}else{
			//==buat set session
			//if($cek_email->reseller == '1'){
				$session_data = [
					'resellerid'    => $vkode_reseller,
				];
				$this->session->set_userdata($session_data);
			//}
			//==end session
		}
	  }else{
		  $session_data = [
					'resellerid'    => '',
				];
			$this->session->set_userdata($session_data);
		  $kode_voucher = $this->input->post('kode_voucher');
	  }*/
	  //var_dump($vv1);
      //die;
	 //==end baru jika dipakai
	/*if($this->session->userdata('reseller') =="1" || $this->session->userdata('reseller') =="2"){
		$vk = $this->right($this->input->post('kode_voucher'),4);
		//if(strlen($vk))
		$kode_voucher =$vk;
	}else{
		$kode_voucher = $this->input->post('kode_voucher');
	}*/

    $this->db->where('email', $kode_voucher);

    $check_user = $this->db->get('users')->row();

    if (!empty($check_user)) {
      $kode_voucher = $check_user->username;
    }

    $clailRedemption = $this->input->post('clail-redemption');
    if ($clailRedemption == 1) {
      $voucher = $this->db->where(['voucher_redemption' => 1])
        ->where(['to_date >=' => date('Y-m-d')])
        ->where(['from_date <=' => date('Y-m-d')])
        ->get('voucher')->row();

      if ($kode_voucher == $this->ion_auth->user()->row()->username) {
        $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
        ' . lang('no_referr_to_self') . '
        </div>');
        return  redirect('/cekout');
      }
    } else {

      $voucher = $this->db->where(['code_voucher' => $kode_voucher])->where(['iscodevoucher' => 1])->where(['to_date >=' => date('Y-m-d')])
        ->where(['from_date <=' => date('Y-m-d')])->get('voucher')->row();
    }

    if (!$voucher) {
      $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
         ' . lang('voucher_code_not_available') . '
        </div>');
      return redirect('/cekout');
    } else {
		/*start validasi utk item khusus*/
		$items_khusus="950201094";//FP:950201094,SP:950201169. ebe id product SP hilangkan (aktifkan)
        $item_khusus_exclude_sepatu = explode(",", $items_khusus);
        foreach ($this->cart->contents() as $items) {
            if (in_array($items['id'], $item_khusus_exclude_sepatu, TRUE)) {
                $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
                   Product ' . $items['name'] . ' not allowed to use this voucher
                    </div>');
                  return  redirect('/cekout');
            }
        }
		/*end validasi utk item khusus*/
		$qty_b=0;
		if($this->session->userdata('reseller') == '1'){
			$cek_sts=($this->ion_auth->user()->row()->sts_reseller == '') ? 0 : $this->ion_auth->user()->row()->sts_reseller;
			if($cek_sts == 0){
			   foreach ($this->cart->contents() as $items) {
				$qty_b = $qty_b + $items['qty'];
				$item_barang_exclude_sepatu = explode(",", $voucher->exclude_sepatu_tag);
				if (in_array($items['id'], $item_barang_exclude_sepatu, TRUE)) {
				  $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
				   Product ' . $items['name'] . ' not allowed to use this voucher
					</div>');
				  return  redirect('/cekout');
				}
			  } 
			}
		}else{
		  foreach ($this->cart->contents() as $items) {
			$qty_b = $qty_b + $items['qty'];
			$item_barang_exclude_sepatu = explode(",", $voucher->exclude_sepatu_tag);
			if (in_array($items['id'], $item_barang_exclude_sepatu, TRUE)) {
			  $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
			   Product ' . $items['name'] . ' not allowed to use this voucher
				</div>');
			  return  redirect('/cekout');
			}
		  }
		}
	/*$qty_b=0;
      foreach ($this->cart->contents() as $items) {
		$qty_b = $qty_b + $items['qty'];
        $item_barang_exclude_sepatu = explode(",", $voucher->exclude_sepatu_tag);
        if (in_array($items['id'], $item_barang_exclude_sepatu, TRUE)) {
          $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
           Product ' . $items['name'] . ' not allowed to use this voucher
            </div>');
          return  redirect('/cekout');
        }
      }*/
	//cek b1g1	
	//if ($voucher->voucher_vip == 1 ||  $voucher->voucher_getone == 1) {
      if ($voucher->voucher_getone == 1) {
        if ($qty_b < $voucher->min_getone) {
          $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
          ' . lang('minimum_purchase_1') .' '.$voucher->min_getone.'
        </div>');
          return  redirect('/cekout');
        }
      }/* else if ($qty < 2) {
        $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
          ' . lang('minimum_purchase_1') . ' '.$voucher_info->min_getone.'
        </div>');
          return  redirect('/cekout');
      }*/
    //}
	//==end b1g1
	
      // Voucher Vip
      if ($voucher->voucher_vip == 1) {
        $qty  = 0;
        foreach ($this->cart->contents() as $items) {
          $qty = $qty + $items['qty'];
        }
       if ($qty < 2) {
          $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
          ' . lang('minimum_purchase_1') . ' 2
        </div>');
          return  redirect('/cekout');
        }

        $cekRefer = $this->M_refer->getUserReffer();

        if ($cekRefer == null || $cekRefer->username == $kode_voucher) {
          $cekUserVip = $this->db->where(['username' => $kode_voucher])->get('users')->row();
          if ($cekUserVip) {
            $this->session->set_userdata('refferemail', $cekUserVip->email);
          } else {
            $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
          ' . lang('vip_voucher_not_avail') . '
        </div>');
            return  redirect('/cekout');
          }
        } else {
          $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
          ' . lang('cant_use_vip_voucher') . '
        </div>');
          return  redirect('/cekout');
        }
      }

      // End Voucher Vip


      // Voucher redemption
      if ($voucher->voucher_redemption == 1) {
        $qty  = 0;
        foreach ($this->cart->contents() as $items) {
          $qty = $qty + $items['qty'];
        }

        if ($qty < 2) {
          $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
          ' . lang('minimum_purchase_1') . ' 2
        </div>');
          return  redirect('/cekout');
        }

        $cekRefer = $this->M_refer->getUserReffer();
        $upercaseRefer = strtoupper($cekRefer->username);
        $upercaseKodevoucher = strtoupper($kode_voucher);



        if ($cekRefer == null || $upercaseRefer == $upercaseKodevoucher) {
          $cekUserVip = $this->db->where(['username' => $kode_voucher])->get('users')->row();

          if ($kode_voucher == 'BOCOHO') {
            $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
          User Referrer BOCOHO Tidak Bisa Claim Redemption Voucher
        </div>');
            return  redirect('/cekout');
          }

          if ($cekUserVip) {
            $this->session->set_userdata('refferemail', $cekUserVip->email);
          } else {
            $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
          ' . lang('user_redemption_404') . '
        </div>');
            return  redirect('/cekout');
          }
        } else {
          $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
          ' . lang('user_redemption_cant') . '
        </div>');
          return  redirect('/cekout');
        }
      }

      // Voucher  End redemption



      $isused = $this->db->where(['user_id' => $this->ion_auth->user()->row()->id])->where(['voucher_id' => $voucher->id_voucher])->where(['is_used' => 1])->get('voucher_used')->row();


      if ($isused && $voucher->pakai_berulang !='1') {
        $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
      ' . ($this->session->userdata('reseller') !='1' ? lang('voucher_already_used') : "Voucher sudah pernah digunakan") . '
        </div>');
        return redirect('/cekout');
      } else {

        if ($voucher->to_member == 'UMUM') {
          if ($voucher->isupgradediamond == 1) {
            if ($voucher->diskonupgrade == 1) {
              $this->session->set_flashdata('isupgradediamond', 1);
              $this->hitungVoucher($voucher, $voucher->id_voucher);
            } else {
              $this->session->set_flashdata('isupgradediamond', 1);
            }
          } else {
            $this->hitungVoucher($voucher, $voucher->id_voucher);
          }

          return redirect('/cekout');
        } else {
          $cekMember = $this->db->where(['user_id' => $this->ion_auth->user()->row()->id])->get('user_membership')->row();

          if ($cekMember) {
            if ($voucher->to_member == $cekMember->peringkat_member) {

              if ($voucher->isupgradediamond == 1) {
                if ($voucher->diskonupgrade == 1) {
                  $this->session->set_flashdata('isupgradediamond', 1);
                  $this->hitungVoucher($voucher, $voucher->id_voucher);
                } else {
                  $this->session->set_flashdata('isupgradediamond', 1);
                }
              } else {
                $this->hitungVoucher($voucher, $voucher->id_voucher);
              }
              return redirect('/cekout');
            } else {
              $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
              ' . lang('member_not_valid') . '
              </div>');
              return redirect('/cekout');
            }
          } else {
            $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
            ' . lang('member_not_valid') . '
          </div>');
            return redirect('/cekout');
          }
        }
      }
    }
  }


  private function hitungVoucher($voucher, $id_voucher)
  {

    if ($voucher->usewith_discitem != 1) {

      foreach ($this->cart->contents() as $items) {

        $barang = $this->M_product->get_detailproduct($items['id']);

        $data = array(
          'rowid' => $items['rowid'],
          'price' => $barang->harga,
          'options' => [
            'Size' => $items['options']['Size'],
            'Color' => $items['options']['Color'],
            'Diskon' => 0,
            'Indent' => $items['options']['Indent'],
          ],
        );

        $this->cart->update($data);
      }
      // echo $voucher->usewith_discitem;
      // die;
    }

    if ($voucher->type == 1) {
      if ($voucher->sepatu_tag) {
        $item_barang = explode(",", $voucher->sepatu_tag);
        $isRequ = 0;
        $totalDisc = 0;
        $qty = 0;
        foreach ($this->cart->contents() as $items) {
          if (in_array($items['id'], $item_barang, TRUE)) {
            $totalBelanja = $items['subtotal'];
            $qty += $items['qty'];
            if ($voucher->is_benefit_ulangtahun == 1) {
              $totalPerItemDiskon = ($voucher->jumlah / 100) * $totalBelanja;
              $totalDisc =  $totalPerItemDiskon;
              $isRequ = 1;
            } else {
              $totalPerItemDiskon = ($voucher->jumlah / 100) * $totalBelanja;
              $totalDisc +=  $totalPerItemDiskon;
              $isRequ = 1;
            }

            // } else {
            //   $totalBelanja = $this->cart->total();
            //   $itemIfo = '';
            // }
            // $totalPerItemDiskon = ($voucher->jumlah / 100) * $totalBelanja;
            // $totalDisc +=  $totalPerItemDiskon;
            // $isRequ = 1;
          }
        }
        $itemIfo = "$qty Item ";
        $totalBelanjaDiskon = $this->cart->total()  - $totalDisc;
        $this->session->set_flashdata('diskonVoucher', $totalDisc);
        $typePotongan = "Diskon $itemIfo  $voucher->jumlah % <span style='color: #ff4c3b;'> IDR " . number_format($totalDisc, 0, ',', '.') . "</span>";
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
           ' . lang('success_use_voucher') . '
            </div>');

        if ($isRequ == 0) {
          return $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
           ' . lang('voucher_invalid_for_product') . '
            </div>');
        }
		//aktifkan utk fp & sp
		/*start voucher Familypackage*/
        if($voucher->code_voucher == 'DPTFP'){
			/*start validasi voucher FP hanya untuk level 1*/
            $uplinenya="";
            $datauplinenya=$this->db->select('refertouser_id')->where(['user_id' => $this->session->userdata('user_id')])->get('tb_reseller')->row();
            if($datauplinenya){
                $uplinenya=$datauplinenya->refertouser_id;
            }
            if($this->session->userdata('resellerid') != $uplinenya && $this->session->userdata('user_id') != $this->session->userdata('resellerid')){
                $nama_punya_voucher="";
                $arrupline=$this->db->select('username,first_name,last_name')->where(['id' => $this->session->userdata('resellerid')])->get('users')->row();
                if($arrupline){
                    $nama_punya_voucher=$arrupline->first_name.' '.$arrupline->last_name;
                }
                return $this->session->set_flashdata("message", "<div class='alert alert-warning' role='alert'>1 Voucher ini hanya bisa digunakan di level 1 ".$nama_punya_voucher."</div>");
            }
			/*end validasi voucher FP hanya untuk level 1*/
			
            $cek_deposit=$this->db->select('ifnull(deposit,0) as saldo_deposit')->where(['user_id' => $this->session->userdata('resellerid'),'deposit >' => 0])
			->get('tb_wallet')->row();
			if($cek_deposit){
			   $cek_sp = $this->db->where(['user_id' => $this->ion_auth->user()->row()->id])->where(['voucher_id' => 170])->where(['is_used' => 0])->get('voucher_used')->row();
			    if($cek_sp){
			        $saldo_tersedia=$cek_deposit->saldo_deposit-3000000;
			        //$cek_sisanya=$cek_deposit->saldo_deposit-$totalBelanjaDiskon;
			        if($totalBelanjaDiskon > $saldo_tersedia){
			            $this->session->set_flashdata('sisa_deposit',$saldo_tersedia);
			        }else{
			            $this->session->set_flashdata('kode_voucher','DPTFP');
			        }
			    }else{
    			    if($totalBelanjaDiskon > $cek_deposit->saldo_deposit){
    			        $this->session->set_flashdata('sisa_deposit',$cek_deposit->saldo_deposit);
    			    }else{
    			        $this->session->set_flashdata('kode_voucher','DPTFP');
    			    }
			    }
			}else{
			    return $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
			        Saldo Family Package tidak ada
                        </div>');
			}
        }
        /*End voucher Familypackage*/
        
        /*start voucher singlepackage*/
        if($voucher->code_voucher == 'SPDPT'){
			/*start validasi produk khusus*/
            $items_khusus="950201094,950201169";//FP:950201094,SP:950201169. ini aktifkan
            $item_khusus_exclude_sepatu = explode(",", $items_khusus);
            foreach ($this->cart->contents() as $items) {
                if (in_array($items['id'], $item_khusus_exclude_sepatu, TRUE)) {
                    $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
                       Product ' . $items['name'] . ' not allowed to use this voucher
                        </div>');
                      return  redirect('/cekout');
                }
            }
            /*end validasi produk khusus*/
			
            /*start validasi SP*/
            if($this->session->userdata('user_id') != $this->session->userdata('resellerid')){
                return $this->session->set_flashdata("message", "<div class='alert alert-warning' role='alert'>Maaf anda bukan pemilik voucher ini</div>");
            }
            $cek_sp = $this->db->where(['user_id' => $this->session->userdata('user_id')])->where(['voucher_id' => 170])->where(['is_used' => 0])->get('voucher_used')->row();
            if($cek_sp){
                if($this->session->userdata('user_id') != $this->session->userdata('resellerid')){
                    return $this->session->set_flashdata("message", "<div class='alert alert-warning' role='alert'>Maaf anda bukan pemilik voucher ini</div>");
                }
            }else{
                return $this->session->set_flashdata("message", "<div class='alert alert-warning' role='alert'>Maaf anda tidak memiliki voucher SP</div>");
            }
            /*end validasi SP*/
			
            $cek_deposit=$this->db->select('ifnull(deposit,0) as saldo_deposit')->where(['user_id' => $this->session->userdata('resellerid'),'deposit >' => 0])
			->get('tb_wallet')->row();
			
			if($cek_deposit){
			    if($totalBelanjaDiskon > $cek_deposit->saldo_deposit){
			        $this->session->set_flashdata('sisa_deposit',$cek_deposit->saldo_deposit);
			    }else{
			        $this->session->set_flashdata('kode_voucher','SPDPT');
			    }
			}else{
			    return $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
			        Saldo Single Package tidak ada
                        </div>');
			}
        }
        /*end voucher singlepackage*/
      } else {

        $totalBelanja = $this->cart->total();
        $totalDiskon = ($voucher->jumlah / 100) * $totalBelanja;
        $totalBelanjaDiskon = $totalBelanja  - $totalDiskon;
        $this->session->set_flashdata('diskonVoucher', $totalDiskon);
        $typePotongan = "Diskon  $voucher->jumlah % <span style='color: #ff4c3b;'> IDR " . number_format($totalDiskon, 0, ',', '.') . "</span>";
		
		/*start item khusus yg tidak dapat diskon*/
		$items_khusus="950201169";//FP:950201094,SP:950201169. ini aktifkan
        $item_khusus_exclude_sepatu = explode(",", $items_khusus);
        $jika_ada_sp=0;
        foreach ($this->cart->contents() as $items) {
            if (in_array($items['id'], $item_khusus_exclude_sepatu, TRUE)) {
                $totalDiskon=0;
                $totalBelanjaDiskon=$totalBelanja;
                $this->session->set_flashdata('diskonVoucher', $totalDiskon);
                $typePotongan = "Diskon  0 % <span> IDR " . number_format($totalDiskon, 0, ',', '.') . "</span>";
            }
        }
		/*end item khusus yg tidak dapat diskon*/
		
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        ' . lang('success_use_voucher') . '
        </div>');
		//AKTIFKAN UTK sp & fp
		/*start voucher Familypackage*/
        if($voucher->code_voucher == 'DPTFP'){
             //start validasi voucher FP hanya untuk level 1
            $uplinenya="";
            $datauplinenya=$this->db->select('refertouser_id')->where(['user_id' => $this->session->userdata('user_id')])->get('tb_reseller')->row();
            if($datauplinenya){
                $uplinenya=$datauplinenya->refertouser_id;
            }
            if($this->session->userdata('resellerid') != $uplinenya && $this->session->userdata('user_id') != $this->session->userdata('resellerid')){
                $nama_punya_voucher="";
                $arrupline=$this->db->select('username,first_name,last_name')->where(['id' => $this->session->userdata('resellerid')])->get('users')->row();
                if($arrupline){
                    $nama_punya_voucher=$arrupline->first_name.' '.$arrupline->last_name;
                }
                return $this->session->set_flashdata("message", "<div class='alert alert-warning' role='alert'>2 Voucher ini hanya bisa digunakan di level 1 ".$nama_punya_voucher."</div>");
            }
            //end validasi voucher FP hanya untuk level 1
            
            $cek_deposit=$this->db->select('ifnull(deposit,0) as saldo_deposit')->where(['user_id' => $this->session->userdata('resellerid'),'deposit >' => 0])
			->get('tb_wallet')->row();
			if($cek_deposit){
			    //start validasi saldo SP
			   $cek_sp = $this->db->where(['user_id' => $this->ion_auth->user()->row()->id])->where(['voucher_id' => 170])->where(['is_used' => 0])->get('voucher_used')->row();
			    if($cek_sp){
			        $saldo_tersedia=$cek_deposit->saldo_deposit-3000000;
			        //$cek_sisanya=$cek_deposit->saldo_deposit-$totalBelanjaDiskon;
			        if($totalBelanjaDiskon > $saldo_tersedia){
			            $this->session->set_flashdata('sisa_deposit',$saldo_tersedia);
			        }else{
			            $this->session->set_flashdata('kode_voucher','DPTFP');
			        }
			    }else{
			    //End validasi saldo SP
    			    if($totalBelanjaDiskon > $cek_deposit->saldo_deposit){
    			        $this->session->set_flashdata('sisa_deposit',$cek_deposit->saldo_deposit);
    			    }else{
    			        $this->session->set_flashdata('kode_voucher','DPTFP');
    			    }
			    }
			}else{
			    return $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
			        Saldo Familypackage tidak ada
                        </div>');
			}
        }
        //End voucher Familypackage
        
        //start voucher singlepackage
        if($voucher->code_voucher == 'SPDPT'){
			/*start validasi produk khusus*/
            $items_khusus="950201094,950201169";//FP:950201094,SP:950201169. ini aktifkan
            $item_khusus_exclude_sepatu = explode(",", $items_khusus);
            foreach ($this->cart->contents() as $items) {
                if (in_array($items['id'], $item_khusus_exclude_sepatu, TRUE)) {
                    $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
                       Product ' . $items['name'] . ' not allowed to use this voucher
                        </div>');
                      return  redirect('/cekout');
                }
            }
            /*end validasi produk khusus*/
			
			/*start validasi SP*/
            if($this->session->userdata('user_id') != $this->session->userdata('resellerid')){
                return $this->session->set_flashdata("message", "<div class='alert alert-warning' role='alert'>Maaf anda bukan pemilik voucher ini</div>");
            }
            $cek_sp = $this->db->where(['user_id' => $this->session->userdata('user_id')])->where(['voucher_id' => 170])->where(['is_used' => 0])->get('voucher_used')->row();
            if($cek_sp){
                if($this->session->userdata('user_id') != $this->session->userdata('resellerid')){
                    return $this->session->set_flashdata("message", "<div class='alert alert-warning' role='alert'>Maaf anda bukan pemilik voucher ini</div>");
                }
            }else{
                return $this->session->set_flashdata("message", "<div class='alert alert-warning' role='alert'>Maaf anda tidak memiliki voucher SP</div>");
            }
            /*end validasi SP*/
			
            $cek_deposit=$this->db->select('ifnull(deposit,0) as saldo_deposit')->where(['user_id' => $this->session->userdata('resellerid'),'deposit >' => 0])
			->get('tb_wallet')->row();
			//var_dump($totalBelanjaDiskon);exit();
			if($cek_deposit){
			    if($totalBelanjaDiskon > $cek_deposit->saldo_deposit){
			        $this->session->set_flashdata('sisa_deposit',$cek_deposit->saldo_deposit);
			    }else{
			        $this->session->set_flashdata('kode_voucher','SPDPT');
			    }
			}else{
			    return $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
			        Saldo Singlepackage tidak ada
                        </div>');
			}
        }
        //end voucher singlepackage
      }
    } else if ($voucher->type == 2) {

      if ($voucher->sepatu_tag) {
        $item_barang = explode(",", $voucher->sepatu_tag);
        $isRequ = 0;
        foreach ($this->cart->contents() as $items) {
          if (in_array($items['id'], $item_barang, TRUE)) {
            $totalBelanja = $this->cart->total();
            $totalBelanjaDiskon = $totalBelanja - $voucher->jumlah;
            if ($totalBelanjaDiskon <= 0) {
              $totalpotongan = $totalBelanja;
            } else {
              $totalpotongan = $voucher->jumlah;
            }
            $this->session->set_flashdata('diskonVoucher', $totalpotongan);

            $typePotongan = "Potongan Harga <span> IDR " . number_format($totalpotongan, 0, ',', '.') . "</span>";
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            ' . lang('success_use_voucher') . '
            </div>');
            $isRequ = 1;
          }
        }

        if ($isRequ == 0) {
          return $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
          ' . lang('voucher_invalid_for_product') . '
            </div>');
        }
      } else {
        $totalBelanja = $this->cart->total();
        $totalBelanjaDiskon = $totalBelanja - $voucher->jumlah;
        if ($totalBelanjaDiskon <= 0) {
          $totalpotongan = $totalBelanja;
        } else {
          $totalpotongan = $voucher->jumlah;
        }
        $this->session->set_flashdata('diskonVoucher', $totalpotongan);

        $typePotongan = "Potongan Harga <span> IDR " . number_format($totalpotongan, 0, ',', '.') . "</span>";
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        ' . lang('success_use_voucher') . '
        </div>');
      }
    } else if ($voucher->type == 3) {
      $cart = $this->cart->contents();
      // $cart = array_column($cart, 'price');
      usort($cart, function ($a, $b) {
        return $b['price'] - $a['price'];
      });
      // var_dump($cart);
      // die;
      if ($voucher->sepatu_tag) {
        $item_barang = explode(",", $voucher->sepatu_tag);
        $isRequ = 0;

        foreach ($cart as $items) {
          if (in_array($items['id'], $item_barang, TRUE)) {
            $totalBelanja = $this->cart->total();
            $totalBelanjaDiskon = $totalBelanja - $items['price'];
            $this->session->set_flashdata('diskonVoucher', $items['price']);
            $typePotongan = "Potongan Free Item  <span> IDR " . number_format($items['price'], 0, ',', '.') . "</span>";
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            ' . lang('success_use_voucher') . '
            </div>');
            $isRequ = 1;
          }
        }

        if ($isRequ == 0) {
          return $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
          ' . lang('voucher_invalid_for_product') . '
            </div>');
        }
        
        /*start voucher Familypackage*/
        if($voucher->code_voucher == 'DPTFP'){
            /*start validasi voucher FP hanya untuk level 1*/
            $uplinenya="";
            $datauplinenya=$this->db->select('refertouser_id')->where(['user_id' => $this->session->userdata('user_id')])->get('tb_reseller')->row();
            if($datauplinenya){
                $uplinenya=$datauplinenya->refertouser_id;
            }
            if($this->session->userdata('resellerid') != $uplinenya  && $this->session->userdata('user_id') != $this->session->userdata('resellerid')){
                $nama_punya_voucher="";
                $arrupline=$this->db->select('username,first_name,last_name')->where(['id' => $this->session->userdata('resellerid')])->get('users')->row();
                if($arrupline){
                    $nama_punya_voucher=$arrupline->first_name.' '.$arrupline->last_name;
                }
                return $this->session->set_flashdata("message", "<div class='alert alert-warning' role='alert'>3 Voucher ini hanya bisa digunakan di level 1 ".$nama_punya_voucher."</div>");
            }
            /*end validasi voucher FP hanya untuk level 1*/
            
            $cek_deposit=$this->db->select('ifnull(deposit,0) as saldo_deposit')->where(['user_id' => $this->session->userdata('resellerid'),'deposit >' => 0])
			->get('tb_wallet')->row();
			if($cek_deposit){
			    /*start validasi saldo SP*/
			    $cek_sp = $this->db->where(['user_id' => $this->ion_auth->user()->row()->id])->where(['voucher_id' => 170])->where(['is_used' => 0])->get('voucher_used')->row();
			    if($cek_sp){
			        $saldo_tersedia=$cek_deposit->saldo_deposit-3000000;
			        //$cek_sisanya=$cek_deposit->saldo_deposit-$totalBelanjaDiskon;
			        if($totalBelanjaDiskon > $saldo_tersedia){
			            $this->session->set_flashdata('sisa_deposit',$saldo_tersedia);
			        }else{
			            $this->session->set_flashdata('kode_voucher','DPTFP');
			        }
			    }else{
			    /*End validasi saldo SP*/
    			    if($totalBelanjaDiskon > $cek_deposit->saldo_deposit){
    			        $this->session->set_flashdata('sisa_deposit',$cek_deposit->saldo_deposit);
    			    }else{
    			        $this->session->set_flashdata('kode_voucher','DPTFP');
    			    }
			    }
			}else{
			    return $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
			        Saldo Family package tidak ada
                        </div>');
			}
        }
        /*End voucher Familypackage*/
        
        /*start voucher singlepackage*/
        if($voucher->code_voucher == 'SPDPT'){
			/*start validasi produk khusus*/
            $items_khusus="950201094,950201169";//FP:950201094,SP:950201169
            $item_khusus_exclude_sepatu = explode(",", $items_khusus);
            foreach ($this->cart->contents() as $items) {
                if (in_array($items['id'], $item_khusus_exclude_sepatu, TRUE)) {
                    $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
                       Product ' . $items['name'] . ' not allowed to use this voucher
                        </div>');
                      return  redirect('/cekout');
                }
            }
            /*end validasi produk khusus*/
			
            /*start validasi SP*/
            if($this->session->userdata('user_id') != $this->session->userdata('resellerid')){
                return $this->session->set_flashdata("message", "<div class='alert alert-warning' role='alert'>Maaf anda bukan pemilik voucher ini</div>");
            }
            $cek_sp = $this->db->where(['user_id' => $this->session->userdata('user_id')])->where(['voucher_id' => 170])->where(['is_used' => 0])->get('voucher_used')->row();
            if($cek_sp){
                if($this->session->userdata('user_id') != $this->session->userdata('resellerid')){
                    return $this->session->set_flashdata("message", "<div class='alert alert-warning' role='alert'>Maaf anda bukan pemilik voucher ini</div>");
                }
            }else{
                return $this->session->set_flashdata("message", "<div class='alert alert-warning' role='alert'>Maaf anda tidak memiliki voucher SP</div>");
            }
            /*end validasi SP*/
			
            $cek_deposit=$this->db->select('ifnull(deposit,0) as saldo_deposit')->where(['user_id' => $this->session->userdata('resellerid'),'deposit >' => 0])
			->get('tb_wallet')->row();
			
			if($cek_deposit){
			    if($totalBelanjaDiskon > $cek_deposit->saldo_deposit){
			        $this->session->set_flashdata('sisa_deposit',$cek_deposit->saldo_deposit);
			    }else{
			        $this->session->set_flashdata('kode_voucher','SPDPT');
			    }
			}else{
			    return $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
			        Saldo Single Package tidak ada
                        </div>');
			}
        }
        /*end voucher singlepackage*/
      } else {
        foreach ($cart  as $items) {
          $totalBelanja = $this->cart->total();
          $totalBelanjaDiskon = $totalBelanja - $items['price'];
          $this->session->set_flashdata('diskonVoucher', $items['price']);
          $typePotongan = "Potongan Free Item <span> IDR " . number_format($items['price'], 0, ',', '.') . "</span>";
          $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
          ' . lang('success_use_voucher') . '
            </div>');
        }
		//aktifkan utk sp & fp
        /*start voucher Familypackage*/
        if($voucher->code_voucher == 'DPTFP'){
             /*start validasi voucher FP hanya untuk level 1*/
            $uplinenya="";
            $datauplinenya=$this->db->select('refertouser_id')->where(['user_id' => $this->session->userdata('user_id')])->get('tb_reseller')->row();
            if($datauplinenya){
                $uplinenya=$datauplinenya->refertouser_id;
            }
            if($this->session->userdata('resellerid') != $uplinenya  && $this->session->userdata('user_id') != $this->session->userdata('resellerid')){
                $nama_punya_voucher="";
                $arrupline=$this->db->select('username,first_name,last_name')->where(['id' => $this->session->userdata('resellerid')])->get('users')->row();
                if($arrupline){
                    $nama_punya_voucher=$arrupline->first_name.' '.$arrupline->last_name;
                }
                return $this->session->set_flashdata("message", "<div class='alert alert-warning' role='alert'>4 Voucher ini hanya bisa digunakan di level 1 ".$nama_punya_voucher."</div>");
            }
            /*end validasi voucher FP hanya untuk level 1*/
            
            $cek_deposit=$this->db->select('ifnull(deposit,0) as saldo_deposit')->where(['user_id' => $this->session->userdata('resellerid'),'deposit >' => 0])
			->get('tb_wallet')->row();
			if($cek_deposit){
			    /*start validasi saldo SP*/
			    $cek_sp = $this->db->where(['user_id' => $this->ion_auth->user()->row()->id])->where(['voucher_id' => 170])->where(['is_used' => 0])->get('voucher_used')->row();
			    if($cek_sp){
			        $saldo_tersedia=$cek_deposit->saldo_deposit-3000000;
			        //$cek_sisanya=$cek_deposit->saldo_deposit-$totalBelanjaDiskon;
			        if($totalBelanjaDiskon > $saldo_tersedia){
			            $this->session->set_flashdata('sisa_deposit',$saldo_tersedia);
			        }else{
			            $this->session->set_flashdata('kode_voucher','DPTFP');
			        }
			    }else{
			    /*End validasi saldo SP*/
    			    if($totalBelanjaDiskon > $cek_deposit->saldo_deposit){
    			        $this->session->set_flashdata('sisa_deposit',$cek_deposit->saldo_deposit);
    			    }else{
    			        $this->session->set_flashdata('kode_voucher','DPTFP');
    			    }
			    }
			}else{
			    return $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
			        Saldo Familypackage tidak ada
                        </div>');
			}
        }
        /*End voucher Familypackage*/
        
        /*start voucher singlepackage*/
        if($voucher->code_voucher == 'SPDPT'){
			 /*start validasi produk khusus*/
            $items_khusus="950201094,950201169";//FP:950201094,SP:950201169
            $item_khusus_exclude_sepatu = explode(",", $items_khusus);
            foreach ($this->cart->contents() as $items) {
                if (in_array($items['id'], $item_khusus_exclude_sepatu, TRUE)) {
                    $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
                       Product ' . $items['name'] . ' not allowed to use this voucher
                        </div>');
                      return  redirect('/cekout');
                }
            }
            /*end validasi produk khusus*/
			
			/*start validasi SP*/
            if($this->session->userdata('user_id') != $this->session->userdata('resellerid')){
                return $this->session->set_flashdata("message", "<div class='alert alert-warning' role='alert'>Maaf anda bukan pemilik voucher ini</div>");
            }
            $cek_sp = $this->db->where(['user_id' => $this->session->userdata('user_id')])->where(['voucher_id' => 170])->where(['is_used' => 0])->get('voucher_used')->row();
            if($cek_sp){
                if($this->session->userdata('user_id') != $this->session->userdata('resellerid')){
                    return $this->session->set_flashdata("message", "<div class='alert alert-warning' role='alert'>Maaf anda bukan pemilik voucher ini</div>");
                }
            }else{
                return $this->session->set_flashdata("message", "<div class='alert alert-warning' role='alert'>Maaf anda tidak memiliki voucher SP</div>");
            }
            /*end validasi SP*/
			
            $cek_deposit=$this->db->select('ifnull(deposit,0) as saldo_deposit')->where(['user_id' => $this->session->userdata('resellerid'),'deposit >' => 0])
			->get('tb_wallet')->row();
			//var_dump($totalBelanjaDiskon);exit();
			if($cek_deposit){
			    if($totalBelanjaDiskon > $cek_deposit->saldo_deposit){
			        $this->session->set_flashdata('sisa_deposit',$cek_deposit->saldo_deposit);
			    }else{
			        $this->session->set_flashdata('kode_voucher','SPDPT');
			    }
			}else{
			    return $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
			        Saldo Singlepackage tidak ada
                        </div>');
			}
        }
        /*end voucher singlepackage*/
      }
    }

    if ($voucher->voucher_refer == 1) {
      $this->session->set_flashdata('val_multiples', $this->input->post('val_multiples'));
    }


    $this->session->set_flashdata('totalBelanjaDiskon', $totalBelanjaDiskon);
    $this->session->set_flashdata('typePotongan', $typePotongan);
    $this->session->set_flashdata('voucherName', $voucher->nama_voucher);
    $this->session->set_flashdata('id_voucher', $id_voucher);
  }
}
