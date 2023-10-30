<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ExchangeController extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('M_Exchange');
    if (!$this->ion_auth->logged_in()) {
      $this->session->set_flashdata('message', 'Login Terlebih Dahulu');
      redirect('login', 'refresh');
    }
  }

  public function index()
  {
    
    
    $invoice = $this->db->where(['user_id' => $this->ion_auth->user()->row()->id])->get('order')->result();
    
    $data = [
      'title' => 'Exchange | Bocorocco Pillow Concept',
      'invoice' => $invoice
    ];

    
    $this->template->load('template', 'users/exchange/v_exchange', $data);
  }



  public function saveExchange()
  {
    $this->form_validation->set_rules('invoice_order', 'invoice_order', 'required|trim');
    $this->form_validation->set_rules('kode_barang', 'kode_barang', 'required|trim');
    $this->form_validation->set_rules('alasan', 'alasan', 'required|trim');


    if ($this->form_validation->run() == false) {

      $data = [
        'error' => (validation_errors() ? validation_errors() : $this->session->flashdata('error')),
        'title' => 'Exchange | Bocorocco Pillow Concept',
      ];
      // $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
      // ' . validation_errors() . '
      // </div>');

      $this->template->load('template', 'users/exchange/v_exchange', $data);
    } else {
        $data_arr=explode("-",$this->input->post('kode_barang', true));
        $id_product=$data_arr[0];
        $id_product_attribute=$data_arr[1];
      /*$data = [
        'invoice_order' => htmlspecialchars($this->input->post('invoice_order', true)),
        'kode_barang' => htmlspecialchars($this->input->post('kode_barang', true)),
        'alasan' => htmlspecialchars($this->input->post('alasan', true)),
        'user_id' => $this->ion_auth->user()->row()->id,
      ];*/
       $data = [
        'invoice_order' => htmlspecialchars($this->input->post('invoice_order', true)),
        'kode_barang' => htmlspecialchars($id_product),
        'id_product_attribute' => htmlspecialchars($id_product_attribute),
        'alasan' => htmlspecialchars($this->input->post('alasan', true)),
        'user_id' => $this->ion_auth->user()->row()->id,
      ];

      $this->db->insert('request_exchange', $data);
      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
     '.lang('success_exchange').'
      </div>');
      redirect('users/exchange');
    }
  }
  
  
  public function historyExchange()
  {
      $data = [
      'title' => 'Exchange | Bocorocco Pillow Concept',
      'exchange' => $this->M_Exchange->getHistory(),
    ];
    
    
    $this->template->load('template', 'users/exchange/v_exchange_history', $data);
  }

  public function add_resi($id){
      $data['resi']=$this->input->post('resi');

      $this->db->where('id_request_exchange',$id);

      $this->db->update('request_exchange',$data);

      redirect('users/exchangehistory','/');
  }
  
  
}
