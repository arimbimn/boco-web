<?php
defined('BASEPATH') or exit('No direct script access allowed');

class OrderController extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('M_order');
    if (!$this->ion_auth->logged_in()) {
      $this->session->set_flashdata('message', 'Login Terlebih Dahulu');
      redirect('login', 'refresh');
    }
  }

  public function orderDetail($id)
  {
    $data_order =  $this->M_order->get_orderDetail($id)->row_array();
    if ($data_order) {
      if ($data_order['user_id'] != $this->ion_auth->user()->row()->id) {
        redirect('/404_override');
      } else {
        $order = $data_order;
      }
    } else {
      redirect('/404_override');
    }
    $cek_deposit=$this->db->select('ifnull(deposit,0) as saldo_deposit')->where(['user_id' => $this->session->userdata('resellerid')])
			->get('tb_wallet')->row();
	$saldo_deposit=0;
	if($cek_deposit){
        $saldo_deposit=$cek_deposit->saldo_deposit;
	}
    $data = [
      'title' => 'Detail Order | Bocorocco Pillow Concept',
      'order' => $order,
      'item_order' => $this->M_order->get_itemOrder($id)->result(),
      'saldo_deposit' => $saldo_deposit
    ];
    // var_dump($data);
    $this->template->load('template', 'order/v_order', $data);
  }
  
  
  public function getItemOrder($id)
  {
    $data = $this->M_order->get_itemOrder($id)->result();

    echo json_encode($data);
  }
  
  
}
