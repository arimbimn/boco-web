<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_refer extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
  }

  public function get_referuser()
  {

    $user = $this->ion_auth->user()->row()->id;
    $this->db->select('users_refer.user_id as user_refer,  users2.first_name, users2.email, users2.id as user_id, users_refer.created_at');
    $this->db->from('users_refer');
    $this->db->where(['refertouser_id' => $user]);
    $this->db->join('users users2', 'users2.id = users_refer.user_id', 'LEFT');
    return $this->db->get();
  }

  public function getUserReffer()
  {
    $user = $this->ion_auth->user()->row()->id;
    $query = $this->db->select('users.username')->where(['user_id' => $user])
      ->join('users', 'users.id = users_refer.refertouser_id', 'LEFT')
      ->get('users_refer')->row();
    return $query;
  }


  public function get_referuserDiamond()
  {

    $user = $this->ion_auth->user()->row()->id;
    //var_dump();exit($this->ion_auth->user()->row()->id);
    $this->db->select("users_refer.user_id as user_refer,  users2.first_name, users2.email, users2.id as user_id,datediff(current_date(), from_unixtime(users2.created_on, '%Y-%m-%d')) as selisih");
    $this->db->from('users_refer');
    $this->db->where(['refertouser_id' => $user]);
    $this->db->join('users users2', 'users2.id = users_refer.user_id');
    $this->db->join('user_membership', 'user_membership.user_id = users2.id');
    $this->db->where(['user_membership.peringkat_member' => 'DIAMOND']);
    return $this->db->get();
  }

  public function get_referuserDiamondOneMount()
  {
    $user = $this->ion_auth->user()->row()->id;

    $getUsermember = $this->db->where(['user_id' => $user])->where(['peringkat_member' => 'DIAMOND'])->get('user_membership')->row();

    if ($getUsermember) {
      $from = date('Y-m-d', strtotime($getUsermember->created_at));
      $to = date('Y-m-d', strtotime($from . " +1 month"));

      // var_dump($from, $to);
      // die;


      $this->db->select('users_refer.user_id as user_refer,  users2.first_name, users2.email, users2.id as user_id')
        ->from('users_refer')
        ->where(['refertouser_id' => $user])
        ->join('users users2', 'users2.id = users_refer.user_id')
        ->join('user_membership', 'user_membership.user_id = users2.id')
        ->where(['user_membership.peringkat_member' => 'DIAMOND'])
        ->where("DATE_FORMAT(users_refer.created_at,'%Y-%m-%d') >='$from'")
        ->where("DATE_FORMAT(users_refer.created_at,'%Y-%m-%d') <='$to'");
      return $this->db->get()->num_rows();
    } else {
      return false;
    }
  }
}
