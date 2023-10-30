<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_Indent extends CI_Model
{

  public function getIndentItems()
  {
    $user = $this->ion_auth->user()->row()->id;

    $this->db->select('order_items.*, order.status_order, order.kode_order, product.nama_barang, order.id_order, product.hari_indent');
    $this->db->where(['order_items.user_id' => $user]);
    $this->db->where(['is_indent' => 1]);
    $this->db->join('order', 'order.id_order = order_items.order_id');
    $this->db->join('product', 'product.id_product = order_items.product_id');
    $query = $this->db->get('order_items')->result();

    return $query;
  }
}
