<?php
defined('BASEPATH') or exit('No direct script access allowed');

class NotFondController extends CI_Controller
{
  public function index()
  {
    $data = [
      'title' => 'Maaf Page Tidak Tersedia | Bocorocco Pillow Concept',
    ];
    // $this->output->set_error_handler('404');

    $this->template->load('template', '404notfond', $data);

    // echo 'oke';
  }
}
