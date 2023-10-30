<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_Exchange extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
  }
  
  
  public function getHistory()
  {
       $user = $this->ion_auth->user()->row()->id;
    
    return  $this->db->where(['user_id' => $user])->get('request_exchange')->result();
  }
  
  
}