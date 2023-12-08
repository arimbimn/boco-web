<?php
defined('BASEPATH') or exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS");
class Home extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('M_Banner');
    $this->load->model('M_productbrand');
    $this->load->model('M_Blog');
    $this->load->model('M_product');
    $this->load->model('M_fiture');
  }

  public function index()
  {
    // $data = [
    //   'title' => 'Home | Bocorocco Pillow Concept',
    //   'banner' => $this->M_Banner->get_banners_baru(1)->result(),
    //   'banner_secondary' => $this->M_Banner->get_banners_baru(2)->result(),
    //   'banner_popup' => $this->M_Banner->get_popupbanner()->row(),
    //   'banner_paralax' => $this->M_Banner->get_banners_baru(3)->row(),
    //   'brands' => $this->M_productbrand->get_brand()->result(),
    //   'user' => $this->ion_auth->user()->row(),
    //   'blogs' => $this->M_Blog->get_blog_baru()->result(), //get_blog
    //   'products' => $this->M_product->get_newproduct_baru(), //get_newproduct
    //   'popup_notification' => $this->db->get_where('popup_notification', ['active' => 1])->result(),
    //   'recommended' => $this->db->select('id_product,image_one,image_two,nama_barang,harga,colour_picker')->where('is_recommended', 1)->order_by('id_product', 'DESC')->limit(4)->get('product')->result(),
    //   'fiture' => $this->M_fiture->get_fiture()->result(),
    // ];

    $data = [
      'title' => 'Home | Bocorocco Pillow Concept',
      'banner' => $this->M_Banner->get_banners_baru(1)->result(),
      'banner_secondary' => $this->M_Banner->get_banners_baru(2)->result(),
      'banner_popup' => $this->M_Banner->get_popupbanner()->row(),
      'banner_paralax' => $this->M_Banner->get_banners_baru(3)->row(),
      'brands' => $this->M_productbrand->get_brand()->result(),
      'user' => $this->ion_auth->user()->row(),
      'blogs' => $this->M_Blog->get_blog_baru()->result(), //get_blog
      'products' => $this->M_product->get_newproduct_baru(), //get_newproduct
      'popup_notification' => $this->db->get_where('popup_notification', ['active' => 1])->result(),
      'recommended' => $this->db->select('id_product,image_one,image_two,nama_barang,harga,colour_picker')->where('is_recommended', 1)->order_by('id_product', 'DESC')->limit(4)->get('product')->result(),
      'fiture' => $this->M_fiture->get_fiture()->result(),
    ];

    // $this->load->view('home/v_home');
    /*$data = [
		'title' => 'Home | Bocorocco Pillow Concept',
		'banner_popup' => $this->M_Banner->get_popupbanner()->row()
	];*/
    $this->template->load('template', 'home/v_home', $data);
  }
  function test()
  {
    header('Location: https://web.bocorocco.website');
  }
  function base64_encode_image2($var)
  {
    //$vurl=smn_baseurl().'uploads/banners/'. $var;
    $url = $var;
    $image = file_get_contents($url);
    if ($image !== false) {
      return 'data:image/webp;base64,' . base64_encode($image);
    }
  }
  function base64_encode_image($file)
  {
    $arrContextOptions = array(
      "ssl" => array(
        "verify_peer" => false,
        "verify_peer_name" => false,
      ),
    );
    /*get name*/
    //basename($file);
    /*get extension*/
    $extension = pathinfo(parse_url($file, PHP_URL_PATH), PATHINFO_EXTENSION);
    $nama_file = str_replace('.' . $extension, '', basename($file)) . '.webp';
    $path = APPPATH . 'convert/' . $nama_file;
    if (!file_exists($path)) {
      $image = imagecreatefromstring(file_get_contents($file, false, stream_context_create($arrContextOptions)));
      if ($image !== false) {
        ob_start();
        imagejpeg($image, NULL, 100);
        $cont = ob_get_contents();
        ob_end_clean();
        imagedestroy($image);
        $content = imagecreatefromstring($cont);
        $output = 'convert/' . $nama_file;
        imagewebp($content, $output);
        imagedestroy($content);
      } else {
        return base_url('/convert/noimage.webp');
        //return str_replace(array('https://' , 'http://') , 'https://i0.wp.com/',base_url('/convert/noimage.webp'));
      }
    }
    // Read the WebP image file into a string
    //$image_data = file_get_contents(base_url('/convert/'.$nama_file));
    //$base64_string = base64_encode(base_url('/convert/'.$nama_file));
    //return 'data:image/webp;base64,'.$base64_string;
    return base_url('/convert/' . $nama_file);
    //return str_replace(array('https://' , 'http://') , 'https://i1.wp.com/',base_url('/convert/'.$nama_file)).'?resize=185';
    //echo base_url('/convert/'.$nama_file);
    //var_dump(base_url('/convert/'.$nama_file));exit();
    //echo '<h4>Output Image Saved as '.$output.'</h4>';
  }
  function base64_encode_image_header($file)
  {
    $arrContextOptions = array(
      "ssl" => array(
        "verify_peer" => false,
        "verify_peer_name" => false,
      ),
    );
    /*get name*/
    //basename($file);
    /*get extension*/
    $extension = pathinfo(parse_url($file, PHP_URL_PATH), PATHINFO_EXTENSION);
    $nama_file = str_replace('.' . $extension, '', basename($file)) . '.webp';
    $path = APPPATH . 'convert/' . $nama_file;
    if (!file_exists($path)) {
      $image = imagecreatefromstring(file_get_contents($file, false, stream_context_create($arrContextOptions)));
      if ($image !== false) {
        ob_start();
        imagejpeg($image, NULL, 100);
        $cont = ob_get_contents();
        ob_end_clean();
        imagedestroy($image);
        $content = imagecreatefromstring($cont);
        $output = 'convert/' . $nama_file;
        imagewebp($content, $output);
        imagedestroy($content);
      } else {
        return base_url('/convert/noimage.webp');
        //return str_replace(array('https://' , 'http://') , 'https://i0.wp.com/',base_url('/convert/noimage.webp'));
      }
    }
    // Read the WebP image file into a string
    //$image_data = file_get_contents(base_url('/convert/'.$nama_file));
    //$base64_string = base64_encode(base_url('/convert/'.$nama_file));
    //return 'data:image/webp;base64,'.$base64_string;
    return base_url('/convert/' . $nama_file);
    //return str_replace(array('https://' , 'http://') , 'https://i1.wp.com/',base_url('/convert/'.$nama_file));
    //echo base_url('/convert/'.$nama_file);
    //var_dump(base_url('/convert/'.$nama_file));exit();
    //echo '<h4>Output Image Saved as '.$output.'</h4>';
  }
  function add_newsletter()
  {
    $email = $this->input->post('email', true);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $this->session->set_flashdata('newsletter_error', lang('invalid_email_newsletter'));
    } else {
      if ($email) {
        $cek_newsletter = $this->db->get_where('newsletter', ['email' => $email])->row();
        if (empty($cek_newsletter)) {
          $insert_newsletter = array('email' => $email);
          if ($this->db->insert('newsletter', $insert_newsletter)) {
            $this->session->set_flashdata('newsletter_success', lang('success_newsletter'));
          }
        } else {
          $this->session->set_flashdata('newsletter_error', lang('registered_newsletter'));
        }
      }
    }

    redirect(base_url());
  }


  public function cekEmailTemplate()
  {
    return $this->load->view('email/emailmember');
  }

  public function underConstruction()
  {
    return $this->load->view('under-construction');
  }
}
