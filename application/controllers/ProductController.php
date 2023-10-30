<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ProductController extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('M_product');
    $this->load->model('M_fiture');
  }

  public function index()
  {
    $keyword = '';
    if (!empty($this->input->get('q'))) {
      $keyword = $this->input->get('q');
    }

    $kategori = '';
    if (!empty($this->input->get('category'))) {
      $kategori = $this->input->get('category');
    }

    $subkategori = '';
    if (!empty($this->input->get('subcategory'))) {
      $subkategori = $this->input->get('subcategory');
    }

    $data = [
      'kategori' => $kategori,
      'subkategori' => $subkategori,
      'keyword' => $keyword,
      'title' => 'Product | Bocorocco Pillow Concept',
      'new_products' => $this->M_product->get_newproduct(),
      'category_products' => $this->M_product->get_categoryproduct(),
      'size' => $this->M_product->getAllSize(),

    ];
    // var_dump($data);
    $this->template->load('template', 'product/v_product', $data);
  }


  public function get_product($page)
  {
    /*$filter_category = $_POST['category'];
    $filter_size = $_POST['size'];
    $filter_from_price = $_POST['from_price'];
    $filter_to_price = $_POST['to_price'];
    $filter_subcategory = $_POST['subcategory'];
    $keyword = $_POST['keyword'];*/
	$filter_category = isset($_POST['category']) ? $_POST['category'] : "";
    $filter_size = isset($_POST['size']) ? $_POST['size'] : "";
    $filter_from_price = isset($_POST['from_price']) ? $_POST['from_price'] : "";
    $filter_to_price = isset($_POST['to_price']) ? $_POST['to_price'] : "";
    $filter_subcategory = isset($_POST['subcategory']) ? $_POST['subcategory'] : "";
    $keyword = isset($_POST['keyword']) ? $_POST['keyword'] : "";

    // $config['base_url'] =  'https://bocorocco.graphie.co.id/web/product';
    $config['base_url'] =  base_url('product');
    $config['total_rows'] = $this->M_product->make_query("", "", $filter_category, $filter_subcategory, $filter_size, $filter_from_price, $filter_to_price, $keyword);
    $config['per_page'] = 12;
    $config['uri_segment'] = 3;
    $config['use_page_numbers'] = TRUE;

    $config['num_links'] = 3;
    $this->pagination->initialize($config);
    $page = $this->uri->segment(3);
    $start = ($page - 1) * $config['per_page'];
    $output = array(
      'pagination_link'  => $this->pagination->create_links(),
      'product_list'   => $this->M_product->make_query($config['per_page'], $start, $filter_category, $filter_subcategory, $filter_size, $filter_from_price, $filter_to_price, $keyword),
      'total_data' => $config['total_rows']
    );
    echo json_encode($output);
  }

  public function detailProduct($id)
  {

    $dataproduct =  $this->M_product->get_detailproduct($id);
    if ($dataproduct) {
      $data_product = $dataproduct;
    } else {
      redirect('/404_override');
    }

    $data = [
      'detail_product' => $data_product,
      'title' => 'Detail Product | Bocorocco Pillow Concept',
      'new_products' => $this->M_product->get_newproduct_adastok(),//$this->M_product->get_newproduct(),
      'fiture' => $this->M_fiture->get_fiture()->result(),
      'productSize' => $this->M_product->getSizeProduct($id),
      'cek_wishlist' => $this->M_product->getWishlist_ByUserIDProductID($id, $this->session->userdata('user_id')),
      'cek_order' => $this->M_product->get_OrderlistItem_ByProductID($id, $this->session->userdata('user_id')),
      'cek_review' => $this->M_product->get_Review_ByUserProductID($id, $this->session->userdata('user_id')),
      'avgreview' => $this->M_product->get_avgReviewProductID($id),
      'avgreview5' => $this->M_product->get_avgReview5ProductID($id),
      'avgreview4' => $this->M_product->get_avgReview4ProductID($id),
      'avgreview3' => $this->M_product->get_avgReview3ProductID($id),
      'avgreview2' => $this->M_product->get_avgReview2ProductID($id),
      'avgreview1' => $this->M_product->get_avgReview1ProductID($id),
      'relate' => $this->M_product->getRelateProduct($id),
    ];

    $this->template->load('template', 'product/v_detailproduct', $data);
  }


  public function produkKategori($kategori_id, $subkategori_id = NULL)
  {
    $data = $this->M_product->get_productkategori($kategori_id, $subkategori_id)->result();
    $data_ptoduct = $data;
    // if ($data) {
    //   $data_ptoduct = $data;
    // } else {
    //   redirect('/404_override');
    // }
    $data = [
      'title' => 'Product | Bocorocco Pillow Concept',
      'products' => $data_ptoduct,
      'new_products' => $this->M_product->get_newproduct(),
      'category_products' => $this->M_product->get_categoryproduct(),
      'totalData' => count($data_ptoduct),
    ];
    // var_dump($data);
    $this->template->load('template', 'product/v_product', $data);
  }


  public function compare()
  {
    if (!$this->ion_auth->logged_in()) {
      $this->session->set_flashdata('message', 'Login Terlebih Dahulu');
      redirect('login', 'refresh');
    }
    $data = [
      'title' => 'Compare | Bocorocco Pillow Concept',
      'title_page' => 'Compare',
      'list_compares' => $this->session->userdata('compare_productid'),
    ];
    $this->template->load('template', 'product/v_compare', $data);
  }

  public function add_to_compare($id_product)
  {
    if (!$this->ion_auth->logged_in()) {
      $this->session->set_flashdata('message', 'Login Terlebih Dahulu');
      redirect('login', 'refresh');
    }
    $cek_product = $this->db->get_where('product', ['id_product' => $id_product])->row();
    if (!empty($cek_product)) {
      $sess_compare_productid = $this->session->userdata('compare_productid');
      $search_productid = strpos($sess_compare_productid, $id_product);
      if ($search_productid !== false) {
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        ' . lang('compare_product_existed') . '
        </div>');
        redirect('compare', 'refresh');
      }
      if (empty($sess_compare_productid)) {
        $format_sess_compareproduct = $id_product;
      } else if (!empty($sess_compare_productid)) {
        $format_sess_compareproduct = $sess_compare_productid . ',' . $id_product;
      }
      $this->session->set_userdata('compare_productid', $format_sess_compareproduct);
      redirect('compare', 'refresh');
    } else {
      redirect(base_url(), 'refresh');
    }
  }


  public function delete_compareproduct($product_id)
  {
    if (!$this->ion_auth->logged_in()) {
      $this->session->set_flashdata('message', 'Login Terlebih Dahulu');
      redirect('login', 'refresh');
    }
    $list_compare = explode(',', $this->session->userdata('compare_productid'));
    $cek_product = $this->db->get_where('product', ['id_product' => $product_id])->row();
    if (!empty($cek_product)) {
      if (($key = array_search($product_id, $list_compare)) !== false) {
        unset($list_compare[$key]);
      }
      $impl_listcompare = implode(',', $list_compare);
      $this->session->set_userdata('compare_productid', $impl_listcompare);
      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
      ' . lang('compare_product_removed') . '
      </div>');
      redirect('compare', 'refresh');
    } else {
      redirect('compare', 'refresh');
    }
  }


  public function submit_review($id_product)
  {
    if (!$this->ion_auth->logged_in()) {
      $this->session->set_flashdata('message', 'Login Terlebih Dahulu');
      redirect('login', 'refresh');
    }

    $this->form_validation->set_rules('title', 'Title', 'required');
    $this->form_validation->set_rules('content', 'Review', 'required');
    $this->form_validation->set_rules('rating', 'Rating', 'required');
    if ($this->form_validation->run() == TRUE) {
      $title = $this->input->post('title');
      $content = $this->input->post('content');
      $rating = $this->input->post('rating');
      $insert_review = array(
        'title' => $title,
        'content' => $content,
        'rating' => $rating,
        'product_id' => $id_product,
        'user_id' => $this->session->userdata('user_id'),
      );
      if ($this->db->insert('product_reviews', $insert_review)) {
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
          ' . lang('review_added') . '
          </div>');
        redirect(base_url() . 'product/detail/' . $id_product, 'refresh');
      } else {
        $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
         ' . lang('error_occured') . '
          </div>');
        redirect(base_url() . 'product/detail/' . $id_product, 'refresh');
      }
    } else {
      $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
      ' . lang('error_occured') . '
          </div>');
      redirect(base_url() . 'product/detail/' . $id_product, 'refresh');
    }
  }
}
