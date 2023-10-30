<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_webInformations extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
  }

  public function get_informations()
  {
    $this->db->from('webinformations');
    $query = $this->db->get();
    return $query;
    // var_dump($query);
  }
}
