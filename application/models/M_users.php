<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_users extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
  }


  public function getAllUser()
  {
    $query = $this->db->join('user_membership', 'user_membership.user_id = users.id', 'left')
      ->where(['user_membership.peringkat_member' => NULL])->get('users')->result();
    return $query;
    // return $this->db->get('users')->result();
  }


  public function getGoldMember()
  {
    $query = $this->db->join('user_membership', 'user_membership.user_id = users.id')
      ->where(['user_membership.peringkat_member' => 'GOLD'])->get('users')->result();
    return $query;
  }
  public function getPlatinumMember()
  {
    $query = $this->db->join('user_membership', 'user_membership.user_id = users.id')
      ->where(['user_membership.peringkat_member' => 'PLATINUM'])->get('users')->result();
    return $query;
  }
}
