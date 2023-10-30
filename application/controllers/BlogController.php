<?php
defined('BASEPATH') or exit('No direct script access allowed');

class BlogController extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('M_Blog');
  }

  public function index()
  {
    $data = [
      'title' => 'Blog | Bocorocco Pillow Concept',
      'blogs' => $this->M_Blog->get_blog()->result(),
      'recent_blog' => $this->M_Blog->get_recentblog(),
      'popular_blog' => $this->M_Blog->get_popularblog(),
    ];

    $this->template->load('template', 'blog/v_blog', $data);
  }

  public function detailBlog($slug = null)
  {

    $blog =  $this->M_Blog->get_detailblog($slug)->row_array();
    if ($blog) {
      $data_blog = $blog;
    } else {
      redirect('/404_override');
    }
    $data = [
      'title' => 'Detail Blog | Bocorocco Pillow Concept',
      'blogs' => $data_blog,
      'comments' => $this->db->where('blog_id', $data_blog['id_blog'])->get('blogs_comment')->result(),

    ];
    // Update read_count
    $update_readcount = array(
      'read_count' => $data_blog['read_count'] + 1
    );
    $this->db->where('id_blog', $data_blog['id_blog']);
    $this->db->update('blogs', $update_readcount);
    $this->template->load('template', 'blog/v_blogdetail', $data);
  }


  public function submit_comment($id_blog)
  {
    $blog_info = $this->db->get_where('blogs', ['id_blog' => $id_blog])->row();
    if (empty($blog_info) || empty($id_blog)) {
      redirect('blog', 'refresh');
    }
    $this->form_validation->set_rules('name', 'Name', 'required');
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
    $this->form_validation->set_rules('comment', 'Comment', 'required');
    if ($this->form_validation->run() == TRUE) {
      $insert_comment = array(
        'blog_id' => $id_blog,
        'name' => $this->input->post('name'),
        'email' => $this->input->post('email'),
        'comment' => $this->input->post('comment'),
      );
      if ($this->db->insert('blogs_comment', $insert_comment)) {
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
           '.lang('comment_sent_success').'
            </div>');
        redirect('blog/detail/' . $blog_info->slug, 'refresh');
      } else {
        $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
           '.lang('error_occured').'
            </div>');
        redirect('blog/detail/' . $blog_info->slug, 'refresh');
      }
    } else {
      $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
            '.lang('error_occured').'
            </div>');
      redirect('blog/detail/' . $blog_info->slug, 'refresh');
    }
  }
}
