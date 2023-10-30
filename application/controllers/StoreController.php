<?php
defined('BASEPATH') or exit('No direct script access allowed');

class StoreController extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
  }

  public function index()
  {
    $data = [
      'title' => 'Store | Bocorocco Pillow Concept',
      'title_page' => 'Store',
      'stores' => $this->db->order_by('id_store', 'DESC')->where(['is_active' => 1])->get('store')->result(),
    ];

    $this->template->load('template', 'store/v_store', $data);
  }
}
