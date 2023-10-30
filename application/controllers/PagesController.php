<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PagesController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index($slug)
    {
        if (empty($slug)) {
            redirect(base_url());
        }
        $pages_info = $this->db->get_where('pages', ['slug' => $slug])->row();
        if (!empty($pages_info)) {
            $data = [
                'title' => $pages_info->title . ' | Bocorocco Pillow Concept',
                'title_page' => $pages_info->title,
                'content' => $pages_info->content,
            ];
        } else {
            redirect(base_url());
        }
        $this->template->load('template', 'pages/v_pages', $data);
    }


    public function faq()
    {
        $data = [
            'title' => 'FAQ | Bocorocco Pillow Concept',
            'title_page' => 'FAQ',
            'list_faq' => $this->db->order_by('faq_id', 'DESC')->get('faq')->result(),
        ];

        $this->template->load('template', 'pages/v_faq', $data);
    }
}
