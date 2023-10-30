<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class LanguageSwitcher extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
  }

  function switchLang($language = "")
  {

    $language = ($language != "") ? $language : "english";
    $this->session->set_userdata('site_lang', $language);
    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
         '.lang('language_change').'
          </div>');
    redirect('/');
  }
}
