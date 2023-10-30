<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_productbrand extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
  }

  public function get_brand()
  {
    return $this->db->get('product_brand');
  }
}
