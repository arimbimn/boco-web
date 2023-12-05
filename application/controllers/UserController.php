<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UserController extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('M_productbrand');
    $this->load->model('M_product');
    if (!$this->ion_auth->logged_in()) {
      $this->session->set_flashdata('message', 'Login Terlebih Dahulu');
      redirect('login', 'refresh');
    }
  }

  public function index()
  {
    $data = [
      'title' => 'Users | Bocorocco Pillow Concept',
    ];

    $this->template->load('template', 'users/v_user', $data);
  }


  public function editUser()
  {
    $data = [
      'title' => 'Users Edit | Bocorocco Pillow Concept',
    ];

    $this->template->load('template', 'users/v_edit_user', $data);
  }

  public function userRefer()
  {
    $data = [
      'title' => 'Users Refer | Bocorocco Pillow Concept',
      'error' => (validation_errors() ? validation_errors() : $this->session->flashdata('error')),

    ];
    $this->template->load('template', 'auth_template/v_refer_user', $data);
  }


  public function saveReferUser()
  {

    $this->form_validation->set_rules('email_refer', 'Input refer', 'required|trim');

    if ($this->form_validation->run() == false) {
      $data = [
        'title' => 'Users Refer | Bocorocco Pillow Concept',
        'error' => (validation_errors() ? validation_errors() : $this->session->flashdata('error')),

      ];
      $this->template->load('template', 'auth_template/v_refer_user', $data);
    } else {

      $email = htmlspecialchars($this->input->post('email_refer', true));

      if ($email == $this->ion_auth->user()->row()->email || $email == $this->ion_auth->user()->row()->username) {
        $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
       ' . lang('no_referr_to_self') . '
        </div>');
        redirect('users/refer', 'refresh');
      } else {

        $cek_email = $this->db->where(['email' => $email])->or_where(['username' => $email])->get('users')->row();

        if ($cek_email) {
          //==add ebe
          /*if($cek_email->reseller == '1'){
				$this->db->where('id',$this->ion_auth->user()->row()->id);
				$this->db->update('users', ['reseller' => $cek_email->id]);
				$session_data = [
					'reselleremail' => $cek_email->email,
					'resellerid'    => $cek_email->id,
					'reselleruser'  => $cek_email->username,
					'reseller'    	=> $cek_email->id,
				];
				$this->session->set_userdata($session_data);
			}*/
          //==end ebe
          $dataSave = [
            'user_id' => $this->ion_auth->user()->row()->id,
            'refertouser_id' => $cek_email->id,
            'refertouser_email' => $cek_email->email,
          ];

          $this->db->insert('users_refer', $dataSave);
          $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
         ' . lang('success_referr') . '
          </div>');

          if ($this->cart->total_items()) {
            return  redirect('cart', 'refresh');
          }
          redirect('/users', 'refresh');
          // redirect('users', 'refresh');

        } else {
          $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
          ' . lang('referral_email_not_found') . '
          </div>');
          redirect('users/refer', 'refresh');
        }



        echo 'oke';
      }
    }
  }

  public function add_to_wishlist($id_product)
  {
    $cek_product = $this->db->get_where('product', ['id_product' => $id_product])->row();
    if (!empty($cek_product)) {
      $cek_wishlist = $this->db->get_where('wishlist', ['product_id' => $id_product, 'user_id' => $this->session->userdata('user_id')])->row();
      if (!empty($cek_wishlist)) {
        $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
         ' . lang('exist_product_wishlist') . '
          </div>');
        redirect(base_url() . 'product/detail/' . $id_product, 'refresh');
      }
      $insert_wishlist = array(
        'user_id' => $this->session->userdata('user_id'),
        'product_id' => $id_product,
      );
      $this->db->insert('wishlist', $insert_wishlist);
      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
          ' . lang('success_added_wishlist') . '
          </div>');
      redirect(base_url() . 'product/detail/' . $id_product, 'refresh');
    } else {
      redirect(base_url() . 'product', 'refresh');
    }
  }


  public function wishlist()
  {
    $data = [
      'title' => 'Wishlist | Bocorocco Pillow Concept',
      'wishlist' => $this->M_product->get_allwishlist_ByUserID($this->session->userdata('user_id')),
    ];
    $this->template->load('template', 'users/v_wishlist', $data);
  }


  public function delete_wishlist($wishlist_id)
  {
    $cek_wishlist = $this->db->get_where('wishlist', ['wishlist_id' => $wishlist_id])->row();
    if (!empty($cek_wishlist)) {
      $this->db->where('wishlist_id', $wishlist_id);
      if ($this->db->delete('wishlist')) {
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        ' . lang('success_deleted_wishlist') . '
          </div>');
        redirect(base_url() . 'wishlist', 'refresh');
      } else {
        $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
        ' . lang('failed_deleted_wishlist') . '
          </div>');
        redirect(base_url() . 'wishlist', 'refresh');
      }
    } else {
      redirect(base_url() . 'wishlist', 'refresh');
    }
  }

  // View ubah password tambahan arimbi
  public function ubah_password()
  {
    $data = [
      'title' => 'Ubah Password | Bocorocco Pillow Concept',
    ];

    $this->template->load('template', 'users/v_ubah_password', $data);
  }
}
