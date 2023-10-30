<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CartController extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('M_product');
  }

  public function index()
  {
    /*unset session metode pembayaran*/
    if ($this->session->userdata('metode_admin')) {
      $array_items = array('metode_admin', 'biaya_admin');
      $this->session->unset_userdata($array_items);
    }

    $diskonMember = 0;
    if ($this->ion_auth->logged_in() && $this->session->userdata('reseller') != '1') {
      $cekMember = $this->db->where(['user_id' => $this->ion_auth->user()->row()->id])->where("DATE_FORMAT(masaberlaku,'%Y-%m-%d') >=", date('Y-m-d'))->get('user_membership')->row();
      if ($cekMember) {
        if ($cekMember->peringkat_member == 'GOLD') {
          $diskonMember = 10;
        } else if ($cekMember->peringkat_member == 'PLATINUM') {
          $diskonMember = 15;
        } else if ($cekMember->peringkat_member == 'DIAMOND') {
          $diskonMember = 20;
        }
      }
    }
    foreach ($this->cart->contents() as $items) {
      $diskonItems = 0;

      $barang = $this->M_product->get_detailproduct($items['id']);
      $cekDiskonItem = $this->db->where(['product_id' => $barang->id_product])->where(['exp_date >=' => date('Y-m-d')])
        ->where(['start_date <=' => date('Y-m-d')])->get('discount_items')->row();
      if ($cekDiskonItem) {
        $diskonItems = $cekDiskonItem->jumlah;
      }

      if ($diskonMember < $diskonItems) {
        $diskon = $diskonItems;
        $totalDiskonPerbandingan = ($diskonItems / 100) * $barang->harga;
        $hargaReal = $barang->harga - $totalDiskonPerbandingan;
      } else {
        $diskon = $diskonMember;
        $totalDiskonPerbandingan = ($diskonMember / 100) *  $barang->harga;
        $hargaReal = $barang->harga - $totalDiskonPerbandingan;
      }

      $data = array(
        'rowid' => $items['rowid'],
        'price' => $hargaReal,
        'options' => [
          'Size' => $items['options']['Size'],
          'Color' => $items['options']['Color'],
          'Diskon' => $diskon,
          'Indent' => $items['options']['Indent'],
        ],
      );

      $this->cart->update($data);
    }

    // die;

    // if ($this->ion_auth->logged_in()) {
    //   $cekMember = $this->db->where(['user_id' => $this->ion_auth->user()->row()->id])->where("DATE_FORMAT(masaberlaku,'%Y-%m-%d') >=", date('Y-m-d'))->get('user_membership')->row();

    //   if ($cekMember) {
    //     foreach ($this->cart->contents() as $items) {
    //       $barang = $this->M_product->get_detailproduct($items['id']);

    //       if ($items['options']['Diskon'] == 0) {
    //         if ($cekMember->peringkat_member == 'GOLD') {
    //           $diskon = 10;
    //           // $totalDiskon = ($diskon / 100) * $barang->harga;
    //           // $totalHarga = $barang->harga  - $totalDiskon;
    //         } else if ($cekMember->peringkat_member == 'PLATINUM') {
    //           $diskon = 15;
    //           // $totalDiskon = ($diskon / 100) * $barang->harga;
    //           // $totalHarga = $barang->harga  - $totalDiskon;
    //         } else if ($cekMember->peringkat_member == 'DIAMOND') {
    //           $diskon = 20;
    //           // $totalDiskon = ($diskon / 100) * $barang->harga;
    //           // $totalHarga = $barang->harga  - $totalDiskon;
    //         }
    //       }
    //     }
    //   }
    // }


    // $diskonItems = 0;
    // $cekDiskonItem = $this->db->where(['product_id' => $detail_product->id_product])->where("DATE_FORMAT(exp_date,'%Y-%m-%d') >=", date('Y-m-d'))->get('discount_items')->row();
    // if ($cekDiskonItem) {
    //   $diskonItems = $cekDiskonItem->jumlah;
    // }



    $data = [
      'title' => 'Cart | Bocorocco Pillow Concept',
    ];
    $data['option1'] = $this->M_product->ambil_data_alamat();


    $this->template->load('template', 'cart/v_cart', $data);
  }


  public function addChart()
  {
    $redirect = $this->input->post('redirect_page');

    if ($this->input->post('qty') == 0 || $this->input->post('qty') == null) {
      $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
    ' . lang('quantity_more_than_0') . '
    </div>');
      return redirect($redirect, 'refresh');
    }

    $data = array(
      'id'      => $this->input->post('id'),
      'qty'     => $this->input->post('qty'),
      'price'   => $this->input->post('price'),
      'name'    => $this->input->post('name'),
      'options' => [
        'Size' => $this->input->post('size'),
        'Color' => $this->input->post('color'),
        'Diskon' => $this->input->post('diskon'),
        'Indent' => $this->input->post('indent'),
      ],
      'alamat'    => '',
    );

    $this->cart->insert($data);
    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
    ' . lang('cart_added') . '
    </div>');
    redirect($redirect, 'refresh');
  }


  public function delChart($rowid)
  {
    $this->cart->remove($rowid);
    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
    ' . lang('cart_deleted') . '
    </div>');
    redirect('cart');
  }


  public function updateCart()
  {
    $i = 1;
    foreach ($this->cart->contents() as  $items) {
      $data = array(
        'rowid' => $items['rowid'],
        'qty'   => $this->input->post($i . '[qty]')
      );

      $this->cart->update($data);
      $i++;
    }
    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
    ' . lang('cart_updated') . '
        </div>');
    redirect('cart');
  }

  public function updateCartNew()
  {
    // $qty  = $this->input->post('qty')[0];
    $i = 0;
    foreach ($this->cart->contents() as $items) {


      $barang = $this->M_product->get_detailproduct($items['id']);
      $productSize = $this->M_product->getSizeProduct($items['id']);

      $totalStok = 0;
      $cekTotal = $this->db->select_sum('jumlah_stok')->where(['id_store' => 100])->where(['id_product' => $items['id']])->where(['id_product_attribute' => $items['options']['Size']])->get('product_stok')->row();
      if ($cekTotal->jumlah_stok >= 1) {
        $totalStok = $cekTotal->jumlah_stok;
      }
      if ($this->input->post('qty')[$i] > $totalStok) {

        if ($items['options']['Indent'] == 1) {
        } else {
          $result = [
            'success' => false,
            'stock' => $totalStok,
          ];
          echo json_encode($result);
          return;
        }
      }



      // return false;


      if ($this->input->post('qty')[$i] >= 1) {

        $data = array(
          'rowid' => $items['rowid'],
          'qty'   => $this->input->post('qty')[$i],
        );

        $this->cart->update($data);
        $i++;
      } else {
        $result = [
          'success' => false,
          'stock' => $totalStok . lang('quantity_more_than_0'),
        ];
        echo json_encode($result);
        return;
      }
    }

    $result = [
      'success' => true,
      'total' => $this->cart->total(),
      'data' => $this->cart->contents()
    ];

    echo json_encode($result);
  }
  public function updateCart_address()
  {
    $i = 0;
    foreach ($this->cart->contents() as  $items) {
      //var_dump($this->input->post('alamat')[$i]);exit();
      $data = array(
        'rowid' => $items['rowid'],
        'alamat'   => $this->input->post('alamat')[$i]
      );
      //var_dump($data);exit();
      $this->cart->update($data);
      $i++;
    }

    $result = [
      'success' => true,
      'total' => $this->cart->total(),
      'data' => $this->cart->contents()
    ];

    echo json_encode($result);
  }
  function save_alamat_pengiriman()
  {
    $lbl_alamat = $this->input->post('lbl_alamat');
    $penerima = $this->input->post('penerima');
    $alamat_penerima = $this->input->post('alamat_penerima');
    $data_detail = array(
      'label_alamat' => $lbl_alamat,
      'penerima' => $penerima,
      'alamat' => $alamat_penerima,
    );
    $this->M_product->insert_data($data_detail);
    $data = $this->M_product->ambil_data_alamat();
    echo json_encode($data);

    // $new_data = $this->db->get_where('tb_alamat_pengiriman', array('id' => $this->db->insert_id()))->row();
    // echo json_encode($new_data);
  }
  public function get_alamat_div()
  {
    $data = $this->M_product->ambil_data_alamat();
    echo json_encode($data);
  }
  public function ambil_alamat()
  {
    $this->load->model('M_product');
    $data['option1'] = $this->M_product->get_data();
    $this->load->view('v_cart', $data);
  }

  // public function horizontal()
  // {
  //   $data['cards'] = $this->M_product->get_cards();
  //   $this->load->view('horizontal_cards', $data);
  // }

  function update_alamat_pengiriman()
  {
    $lbl_alamat = $this->input->post('lbl_alamat');
    $id = $this->input->post('row_id');
    $penerima = $this->input->post('penerima');
    $alamat_penerima = $this->input->post('alamat_penerima');
    $data_detail = array(
      'label_alamat' => $lbl_alamat,
      'penerima' => $penerima,
      'alamat' => $alamat_penerima,
    );
    //$this->M_product->insert_data($data_detail);
    $this->M_product->update_data_alamat($id, $data_detail);
    $data = $this->M_product->ambil_data_alamat();
    echo json_encode($data);
  }
  function hapus_alamat_pengiriman()
  {
    $id = $this->input->post('row_id');
    //$this->M_product->insert_data($data_detail);
    $this->M_product->hapus_data_alamat($id);
    $data = $this->M_product->ambil_data_alamat();
    echo json_encode($data);
  }
}
