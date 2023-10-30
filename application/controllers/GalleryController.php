<?php
defined('BASEPATH') or exit('No direct script access allowed');

class GalleryController extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('M_Gallery');
  }

  public function index()
  {
    $data = [
      'title' => 'Gallery | Bocorocco Pillow Concept',
      'title_page' => 'Gallery',
      'gallery_cat' => $this->db->order_by('category_order', 'ASC')->get('kategori_galeri')->result(),
      'galleries' => $this->M_Gallery->get_gallery(),
    ];

    $this->template->load('template', 'gallery/v_gallery', $data);
  }
}
