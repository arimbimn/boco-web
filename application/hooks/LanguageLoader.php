<?php
class LanguageLoader
{
  function initialize()
  {
    $ci = &get_instance();
    $ci->load->helper('language');
    $siteLang = $ci->session->userdata('site_lang');
    if ($siteLang) {
      
      $ci->lang->load('nav', $siteLang);
      $ci->lang->load('auth_lang', $siteLang);
      $ci->lang->load('ion_auth_lang', $siteLang);
      $ci->lang->load('footer', $siteLang);
      $ci->lang->load('home', $siteLang);
      $ci->lang->load('produk', $siteLang);
      $ci->lang->load('message', $siteLang);
      $ci->lang->load('blog', $siteLang);
      $ci->lang->load('store', $siteLang);
      $ci->lang->load('user', $siteLang);
      $ci->lang->load('order', $siteLang);
	  $ci->lang->load('reseller_lang', $siteLang);
      
    } else {
      $ci->lang->load('ion_auth_lang', 'english');
      $ci->lang->load('auth_lang', 'english');
      $ci->lang->load('nav', 'english');
      $ci->lang->load('footer', 'english');
      $ci->lang->load('home', 'english');
      $ci->lang->load('produk', 'english');
      $ci->lang->load('message', 'english');
      $ci->lang->load('blog', 'english');
      $ci->lang->load('store', 'english');
      $ci->lang->load('user', 'english');
      $ci->lang->load('order', 'english');
	  $ci->lang->load('reseller_lang', 'english');
    }
  }
}
