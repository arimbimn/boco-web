<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ReferUserController extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    if (!$this->ion_auth->logged_in()) {
      $this->session->set_flashdata('message', 'Login Terlebih Dahulu');
      redirect('login', 'refresh');
    }
    $this->load->model('M_refer');
  }


  public function index()
  {

    $userout = $this->M_refer->get_referuserDiamondOneMount();

    // var_dump($userout);
    // die;
    $data = [
      'title' => 'Refer User | Bocorocco Pillow Concept',
      'user_refer' => $this->M_refer->get_referuser()->result(),
      'user_refferer' => $this->M_refer->getUserReffer(),
    ];

    // var_dump($data);

    $this->template->load('template', 'users/refer/v_refer', $data);
  }
}
