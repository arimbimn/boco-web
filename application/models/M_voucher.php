<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_voucher extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
  }


  public function getVoucherUser()
  {
    $date = date('Y-m-d');

    $cekMember = $this->db->where(['user_id' => $this->ion_auth->user()->row()->id])->where("DATE_FORMAT(masaberlaku,'%Y-%m-%d') >=", $date)->get('user_membership')->row();

    // $query = $this->db->where(['user_id' => $this->ion_auth->user()->row()->id])
    //           ->join('voucher', 'voucher.id_voucher = voucher_used.voucher_id')
    //           ->where(['is_active' => 1])
    //           ->where(['isupgradediamond' => 0])
    //           ->where(['to_member' => $cekMember->peringkat_member])
    //           ->where(['exp_date >=' => date('Y-m-d')])
    //           ->where(['is_used' => 0])
    //           ->get('voucher_used')->result();

    if ($cekMember) {
      $query = $this->db->where(['to_member' => $cekMember->peringkat_member])
        ->where(['isupgradediamond' => 0])
        ->where(['voucher_refer' => 0])
        ->where(['iscodevoucher' => 0])
        ->where(['to_date >=' => date('Y-m-d')])
        ->where(['from_date <=' => date('Y-m-d')])
        ->where(['is_active' => 1])
        ->order_by('bobot', 'desc')
        ->get('voucher')->result();
    } else {
      $query = null;
    }


    return $query;
  }

  public function getVoucherUmum()
  {
    $query = $this->db->where(['to_member' => 'UMUM'])
      ->where(['is_active' => 1])
      ->where(['iscodevoucher' => 0])
      // ->where(['isupgradediamond' => 0])
      ->where(['to_date >=' => date('Y-m-d')])
      ->where(['from_date <=' => date('Y-m-d')])
      ->get('voucher')->result();
    return $query;
  }

  public function getFreeUpgrade()
  {
    $date = date('Y-m-d');
    $cekMember = $this->db->where(['user_id' => $this->ion_auth->user()->row()->id])->where("DATE_FORMAT(masaberlaku,'%Y-%m-%d') >=", $date)->get('user_membership')->row();
    if ($cekMember) {
      $query = $this->db->where(['to_member' => $cekMember->peringkat_member])->where(['isupgradediamond' => 1])->where(['to_date >=' => date('Y-m-d')])
        ->where(['from_date <=' => date('Y-m-d')])->where(['is_active' => 1])->get('voucher')->result();
    } else {
      $query = null;
    }
    return $query;
  }

  public function voucherRefer()
  {
    $date = date('Y-m-d');
    $cekMember = $this->db->where(['user_id' => $this->ion_auth->user()->row()->id])->where("DATE_FORMAT(masaberlaku,'%Y-%m-%d') >=", $date)->get('user_membership')->row();

    if ($cekMember) {
      if ($cekMember->peringkat_member == "DIAMOND") {

        $query = $this->db->where(['to_member' => 'DIAMOND'])
          ->where(['voucher_refer' => 1])
          ->where(['iscodevoucher' => 0])
          ->where(['to_date >=' => date('Y-m-d')])
          ->where(['from_date <=' => date('Y-m-d')])
          ->where(['is_active' => 1])
          ->order_by('bobot', 'desc')
          ->get('voucher')->result();
        return $query;
      } else {
        return null;
      }
    } else {
      return null;
    }
  }
}
