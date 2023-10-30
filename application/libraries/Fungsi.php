<?php

class Fungsi
{
  protected $ci;

  public function __construct()
  {
    $this->ci = &get_instance();
    // $this->load->model('M_notifications');
  }

  function webinformation()
  {
    $this->ci->load->model('M_webInformations');
    $informations =   $this->ci->M_webInformations->get_informations()->row();
    return $informations;
  }
}
