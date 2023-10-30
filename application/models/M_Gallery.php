<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_Gallery extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
  }

  public function get_gallery()
  {

    $this->db->select('gallery.*, kategori_galeri.*');
    $this->db->from('gallery');
    $this->db->join('kategori_galeri', 'kategori_galeri.kategori_id = gallery.category_id');
    $this->db->order_by('gallery.gallery_id', 'DESC');
    $query = $this->db->get()->result();
    return $query;
  }

}

?>