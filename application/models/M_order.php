<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_order extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
  }

  public function get_orderDetail($id)
  {
    $this->db->select('order.*,users.username,concat(first_name," ",last_name) as nama_lengkap');
    $this->db->from('order');
    $this->db->join('users', 'order.user_id = users.id');
    $this->db->where(['id_order' => $id]);
    $query = $this->db->get();
    return $query;
  }

  public function get_itemOrder($id)
  {
    $this->db->select('order_items.* , product.nama_barang, product.image_one, product.harga, product.barcode, product.colour,product_attribute.size');
    $this->db->from('order_items');
    $this->db->where(['order_id' => $id]);
    $this->db->join('product', 'product.id_product = order_items.product_id', 'left');
    $this->db->join('product_attribute', 'order_items.id_product_attribute = product_attribute.id_product_attribute', 'left');
    $query = $this->db->get();
    return $query;
  }

  public function get_OrderTerima()
  {
    $user = $this->ion_auth->user()->row()->id;
	$reseller = $this->ion_auth->user()->row()->reseller;
	
    $this->db->select('order.*');
    $this->db->from('order');
    $this->db->where(['user_id' => $user]);
	$this->db->where(['offline' => 0]);
	if($reseller == 1){
        $this->db->join('users', 'order.user_id = users.id');
        $this->db->where(['users.reseller' => '1']);
        //$this->db->where(['id_reseller !=' => '']);
    }
    $this->db->where(['status_order' => 'DITERIMA'])->order_by('id_order', 'DESC');
    $query = $this->db->get();
    return $query;
  }

  public function get_OrderBatal()
  {
    $user = $this->ion_auth->user()->row()->id;
	$reseller = $this->ion_auth->user()->row()->reseller;
	
    $this->db->select('order.*');
    $this->db->from('order');
    $this->db->where(['user_id' => $user]);
	$this->db->where(['offline' => 0]);
	if($reseller == 1){
        $this->db->join('users', 'order.user_id = users.id');
        $this->db->where(['users.reseller' => '1']);
        //$this->db->where(['id_reseller !=' => '']);
    }
	$this->db->where(['status_order' => 'BATAL']);
    $this->db->or_where(['status_order' => 'PROSES BATAL']);
    $this->db->where(['user_id' => $user]);
    $this->db->where(['offline' => 0]);
    if($reseller == 1){
        $this->db->where(['users.reseller' => '1']);
    }
	$this->db->order_by('id_order', 'DESC');
    //$this->db->where(['status_order' => 'BATAL'])->order_by('id_order', 'DESC');
    $query = $this->db->get();
    return $query;
  }

  public function get_OrderProccess()
  {
    $user = $this->ion_auth->user()->row()->id;
	$reseller = $this->ion_auth->user()->row()->reseller;
	
    $this->db->select('order.*');
    $this->db->from('order');
    $this->db->where(['user_id' => $user]);
	$this->db->where(['offline' => 0]);
	if($reseller == 1){
        $this->db->join('users', 'order.user_id = users.id');
        $this->db->where(['users.reseller' => '1']);
        //$this->db->where(['id_reseller !=' => '']);
    }
    $this->db->where(['status_order' => 'PROSES'])->order_by('id_order', 'DESC');
    $query = $this->db->get();
    return $query;
  }


  public function get_OrderDiKirim()
  {
    $user = $this->ion_auth->user()->row()->id;
	$reseller = $this->ion_auth->user()->row()->reseller;
	
    $this->db->select('order.*');
    $this->db->from('order');
    $this->db->where(['user_id' => $user]);
	$this->db->where(['offline' => 0]);
	if($reseller == 1){
        $this->db->join('users', 'order.user_id = users.id');
        $this->db->where(['users.reseller' => '1']);
        //$this->db->where(['id_reseller !=' => '']);
    }
    $this->db->where(['status_order' => 'DIKIRIM'])->order_by('id_order', 'DESC');
    $query = $this->db->get();
    return $query;
  }

  public function get_OrderSelesai()
  {
    $user = $this->ion_auth->user()->row()->id;
	$reseller = $this->ion_auth->user()->row()->reseller;
	
    $this->db->select('order.*');
    $this->db->from('order');
    $this->db->where(['user_id' => $user]);
	$this->db->where(['offline' => 0]);
	if($reseller == 1){
        $this->db->join('users', 'order.user_id = users.id');
        $this->db->where(['users.reseller' => '1']);
        //$this->db->where(['id_reseller !=' => '']);
    }
    $this->db->where(['status_order' => 'SELESAI'])->order_by('id_order', 'DESC');
    $query = $this->db->get();
    return $query;
  }


  public function getTotalSumOrder()
  {
    $user = $this->ion_auth->user()->row()->id;
    $this->db->select_sum('order.total_bayar');
    $this->db->where(['order.user_id' => $user]);
    $this->db->group_start();
    $this->db->where(['status_bayar' => 'PAID']);
    $this->db->or_where(['status_bayar' => 'SETTLED']);
    $this->db->group_end();
    // $this->db->where(['status_order' => 'SELESAI']);
    $query = $this->db->get('order')->row();
    return $query;
  }


  public function getReferTotalBelanja($user_id)
  {
    $this->db->select_sum('order.total_bayar');
    $this->db->select('COUNT(order.id_order) as count_row, order.id_order');
    $this->db->from('order');
    $this->db->where(['order.user_id' => $user_id]);
    $this->db->group_start();
    $this->db->where(['status_bayar' => 'PAID']);
    $this->db->or_where(['status_bayar' => 'SETTLED']);
    $this->db->group_end();
    // $this->db->where(['status_order' => 'SELESAI']);
    $query = $this->db->get();
    return $query;
  }

  public function getReferQtyBelanja($user_id)
  {
    $this->db->select_sum('order_items.qty');
    $this->db->from('order_items');
    $this->db->where(['order_items.user_id' => $user_id]);
    $this->db->join('order', 'order.id_order = order_items.order_id');
    $this->db->group_start();
    $this->db->where(['status_bayar' => 'PAID']);
    $this->db->or_where(['status_bayar' => 'SETTLED']);
    $this->db->group_end();
    // $this->db->where(['status_order' => 'SELESAI']);
    $query = $this->db->get();
    return $query;
  }
}
