<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_Banner extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
  }

  public function get_banners($type)
  {
    if ($type == 1) {
      return $this->db->where(['is_active' => 1])->where(['type_baner' => $type])->get('banners');
    } else if ($type == 2) {
      return $this->db->where(['is_active' => 1])->where(['type_baner' => $type])->limit(2)->get('banners');
    } else if ($type == 3) {
      return $this->db->where(['is_active' => 1])->where(['type_baner' => $type])->get('banners');
    }
  }
public function get_banners_baru($type)
  {
    if ($type == 1) {
      return $this->db->select('slider_type,url_link,image_banner,sub_title,title,embed_code,image_banner_mobile')->where(['is_active' => 1])->where(['type_baner' => $type])->get('banners');
    } else if ($type == 2) {
      return $this->db->select('slider_type,url_link,image_banner,sub_title,title,embed_code,image_banner_mobile')->where(['is_active' => 1])->where(['is_active' => 1])->where(['type_baner' => $type])->limit(2)->get('banners');
    } else if ($type == 3) {
      return $this->db->select('slider_type,url_link,image_banner,sub_title,title,embed_code,image_banner_mobile')->where(['is_active' => 1])->where(['is_active' => 1])->where(['type_baner' => $type])->get('banners');
    }
  }
  public function get_popupbanner()
  {
    return $this->db->where(['is_active' => 1])->get('popupbanner');
  }
}
