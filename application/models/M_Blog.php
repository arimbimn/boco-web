<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_Blog extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
  }

  public function get_blog()
  {

    $this->db->select('*');
    $this->db->from('blogs');
    $this->db->join('aauth_users', 'aauth_users.id = blogs.created_by', 'left');
    $this->db->where((['is_active' => 1]));
    $this->db->order_by('created_at', 'DESC');
    $query = $this->db->limit(6)->get();
    return $query;
    // return $this->db->where(['is_active' => 1])->limit(3)->get('blogs');
  }
 public function get_blog_baru()
  {
	$this->db->select('slug,image_blog,created_at,title,id_blog,full_name');
    $this->db->from('blogs');
    $this->db->join('aauth_users', 'aauth_users.id = blogs.created_by', 'left');
    $this->db->where((['is_active' => 1]));
    $this->db->order_by('created_at', 'DESC');
    $query = $this->db->limit(3)->get();
    return $query;
    // return $this->db->where(['is_active' => 1])->limit(3)->get('blogs');
  }
  public function get_blogall()
  {
    $this->db->select('*');
    $this->db->from('blogs');
    $this->db->join('aauth_users', 'aauth_users.id = blogs.created_by', 'left');
    $this->db->where((['is_active' => 1]));
    $query = $this->db->limit(6)->get();
    return $query;
  }

  public function get_detailblog($slug)
  {
    $this->db->select('blogs.* , aauth_users.full_name');
    $this->db->from('blogs');
    $this->db->join('aauth_users', 'aauth_users.id = blogs.created_by', 'left');
    $this->db->where(['slug' => $slug]);
    $query = $this->db->get();
    return $query;
  }


  public function get_recentblog()
  {
    $this->db->where('is_active', 1);
    $this->db->order_by('created_at', 'DESC');
    $this->db->where((['is_active' => 1]));
    $this->db->limit(5);
    return $this->db->get('blogs')->result();
  }


  public function get_popularblog()
  {
    $this->db->where('is_active', 1);
    $this->db->order_by('read_count', 'DESC');
    $this->db->where((['is_active' => 1]));
    $this->db->limit(5);
    return $this->db->get('blogs')->result();
  }


  public function get_countcomment_ByBlogID($blog_id)
  {
    $this->db->select('COUNT(comment_id) as count_comment');
    $this->db->where('blog_id', $blog_id);
    return $this->db->get('blogs_comment')->row();
  }
}
