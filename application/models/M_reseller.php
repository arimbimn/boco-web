<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_reseller extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
  }


   public function data_penjualan($id)
  {
    $this->db->select('product_id,id_product_attribute,qty');
    $this->db->where('kode_order', $id);
	$this->db->where('is_indent !=', 1);
    $query = $this->db->get('order_items');
	//echo $this->db->last_query();
	//exit();
    if ($query->num_rows() > 0) {
       return $query->result();
    } else {
       return FALSE;
    }
  }
   public function data_get_stok($id_product,$id_product_attribute)
  {
    $this->db->select('id_stok,jumlah_stok,stok_inproses,tahun_produksi');
	$this->db->where('id_store', 100);
    $this->db->where('id_product', $id_product);
	$this->db->where('id_product_attribute', $id_product_attribute);
	//$this->db->limit(1);
	$this->db->order_by('tahun_produksi', "ASC");
    $query = $this->db->get('product_stok');
	//echo $this->db->last_query();
	//exit();
    if ($query->num_rows() > 0) {
       return $query->result();
    } else {
       return FALSE;
    }
  }
    public function data_get_stok_new($id_product,$id_product_attribute)
  {
    $this->db->select('id_stok,jumlah_stok,ifnull(stok_inproses,0) as stok_inproses,tahun_produksi');
	$this->db->where('id_store', 100);
    $this->db->where('id_product', $id_product);
	$this->db->where('id_product_attribute', $id_product_attribute);
	$this->db->where('jumlah_stok >', 0);
	//$this->db->limit(1);
	$this->db->order_by('tahun_produksi', "ASC");
    $query = $this->db->get('product_stok');
	//echo $this->db->last_query();
	//exit();
    if ($query->num_rows() > 0) {
       return $query->result();
    } else {
       return FALSE;
    }
  }
   public function change_stok_inproses($id = NULL, $data = array())
    {
        $this->db->where('id_stok', $id);
        $this->db->update('product_stok', $data);

        return $this->db->affected_rows();
    }
     public function get_banks_available()
  {
    $this->db->select('code_bank,name_bank');
	$this->db->where('type_bank', NULL);
	$this->db->order_by('name_bank', "ASC");
    $query = $this->db->get('tb_banks');
	//echo $this->db->last_query();
	//exit();
    if ($query->num_rows() > 0) {
       return $query->result();
    } else {
       return FALSE;
    }
  }
  public function cek_produk_sales_fp($iduser,$id_product){
      $this->db->select('a.kode_order');
      $this->db->join('order_items b', 'a.kode_order=b.kode_order');
      $this->db->where('a.user_id', $iduser);
      $this->db->where('b.product_id', $id_product);
      $this->db->where('a.status_bayar', 'PAID');
      $this->db->or_where('a.user_id', $iduser);
      $this->db->where('b.product_id', $id_product);
      $this->db->where('a.status_bayar', 'SETTLED');
      $this->db->limit(1);
      $query = $this->db->get('order a');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return FALSE;
        }
  }
}
