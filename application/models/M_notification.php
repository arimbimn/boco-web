<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_notification extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
  }

  public function get_notification()
  {
    $user = $this->ion_auth->user()->row()->id;
    $this->db->select('notification_user.*');
    $this->db->from('notification_user');
    $this->db->where(['user_id' => $user]);
    $this->db->where(['is_read' => 2]);
    $this->db->order_by('id_notification_user' , 'desc');
    return $this->db->get();
  }

  public function get_AllNotification()
  {
    $user = $this->ion_auth->user()->row()->id;
    $this->db->select('notification_user.*');
    $this->db->from('notification_user');
    $this->db->where(['user_id' => $user]);
    $this->db->order_by('id_notification_user' , 'desc');
    return $this->db->get();
  }
}
