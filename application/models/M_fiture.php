<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_fiture extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
  }


  public function get_fiture()
  {
    $this->db->select('fiture.*');
    $this->db->from('fiture');
    $this->db->limit(3);
    return $this->db->get();
  }
}
