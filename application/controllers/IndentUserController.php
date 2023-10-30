<?php
defined('BASEPATH') or exit('No direct script access allowed');

class IndentUserController extends CI_Controller
{
   public function __construct()
  {
    parent::__construct();
    $this->load->model('M_Indent');
    if (!$this->ion_auth->logged_in()) {
      $this->session->set_flashdata('message', 'Login Terlebih Dahulu');
      redirect('login', 'refresh');
    }
  }
  
  
  public function index(){
    $data = [
      'title' => 'Indent | Bocorocco Pillow Concept',
      'indent' => $this->M_Indent->getIndentItems(),
    ];
    
    $this->template->load('template', 'users/indent/v_indent', $data);
  }
  
}

