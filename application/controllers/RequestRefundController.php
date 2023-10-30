<?php
defined('BASEPATH') or exit('No direct script access allowed');

class RequestRefundController extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('M_productbrand');
    $this->load->model('M_Refund');
    if (!$this->ion_auth->logged_in()) {
      $this->session->set_flashdata('message', 'Login Terlebih Dahulu');
      redirect('login', 'refresh');
    }
  }


  public function index()
  {
    $data = [
      'title' => 'Request Refund | Bocorocco Pillow Concept',
    ];
    $this->template->load('template', 'users/requestrefund/v_request_refund', $data);
  }


  public function saveRefund()
  {
    $this->form_validation->set_rules('invoice_order', 'invoice_order', 'required|trim');
    $this->form_validation->set_rules('kode_barang', 'kode_barang', 'required|trim');
    $this->form_validation->set_rules('alasan', 'alasan', 'required|trim');


    if ($this->form_validation->run() == false) {

      $data = [
        'error' => (validation_errors() ? validation_errors() : $this->session->flashdata('error')),
        'title' => 'Request Refund | Bocorocco Pillow Concept',
      ];
     

      $this->template->load('template', 'users/requestrefund/v_request_refund', $data);
    } else {



      $data = [
        'invoice_order' => htmlspecialchars($this->input->post('invoice_order', true)),
        'kode_barang' => htmlspecialchars($this->input->post('kode_barang', true)),
        'alasan' => htmlspecialchars($this->input->post('alasan', true)),
        'user_id' => $this->ion_auth->user()->row()->id,
      ];

      $this->db->insert('request_refund', $data);
      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
     '.lang('request_refund_success').'
      </div>');
      redirect(base_url() . 'requestrefund');
    }
  }
  
  
  public function historyRefund()
  {
    
    
    $data = [
      'title' => 'Request Refund | Bocorocco Pillow Concept',
      'refund' => $this->M_Refund->get_Refund(),
    ];
    
    
    $this->template->load('template', 'users/requestrefund/v_request_history', $data);
  }
  
}
