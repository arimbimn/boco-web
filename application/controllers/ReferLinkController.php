<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ReferLinkController extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
  }

  public function linkReffer($id)
  {
    $cekData = $this->db->where(['username' => $id])->get('users')->row();

    if ($cekData) {
      if ($this->ion_auth->logged_in()) {
        $userid = $this->ion_auth->user()->row()->id;
        $cekRefer = $this->db->where(['user_id' => $userid])->get('users_refer')->row();

        if ($cekRefer) {
          $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
          ' . lang('already_put_referral') . '
          </div>');
          return redirect('/');
        } else {
          $this->session->set_userdata('refferemail', $cekData->username);
          $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
         ' . lang('referr_sucess') . '
          </div>');
          return redirect('/');
        }
      } else {
        $this->session->set_userdata('refferemail', $cekData->username);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        ' . lang('referr_sucess') . '
          </div>');
        return redirect('/');
      }
    } else {
      $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
      ' . lang('referr_not_found') . '
          </div>');
      return redirect('/');
    }
  }
}
