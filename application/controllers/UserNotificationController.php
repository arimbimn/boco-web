<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UserNotificationController extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    if (!$this->ion_auth->logged_in()) {
      $this->session->set_flashdata('message', 'Login Terlebih Dahulu');
      redirect('login', 'refresh');
    }
    $this->load->model('M_notification');
  }



  public function index()
  {
    $data = [
      'title' => 'Notification Users | Bocorocco Pillow Concept',
      'data_notif' => $this->M_notification->get_AllNotification()->result(),
    ];

    $this->template->load('template', 'users/notification/v_notification', $data);
  }


  public function readNotification($id)
  {
    $itemNotif = $this->db->get_where('notification_user', ['id_notification_user' => $id])->row();

    if ($itemNotif) {
      $url = $itemNotif->url;
      $is_notif = $itemNotif->id_notification_user;
      $this->db->query("UPDATE `notification_user` SET `is_read` = '1' WHERE `notification_user`.`id_notification_user` = '$is_notif'");

      redirect($url);
    } else {
      $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
     '.lang('no_notification').'
      </div>');
      redirect("notifications");
    }
  }


  public function delNotification($id)
  {
    $itemNotif = $this->db->get_where('notification_user', ['id_notification_user' => $id])->row();
    if ($itemNotif) {
      if ($this->ion_auth->user()->row()->id != $itemNotif->user_id) {
        $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
        '.lang('not_allowed_delete_notification').'
        </div>');
        redirect("notifications");
      } else {
        $this->db->delete('notification_user', array('id_notification_user' => $id));
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        '.lang('notification_deleted').'
        </div>');
        redirect("notifications");
      }
    } else {
      $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
      '.lang('no_notification').'
    </div>');
      redirect("notifications");
    }
  }
}
