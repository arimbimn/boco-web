<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CartController extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('M_product');
    $this->load->model('Model_alamatPengiriman');
    $this->load->helper('store_helper');
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
      'list_alamat' => $this->Model_alamatPengiriman->getAll(),

      'footer_script' => $this->load->view('cart/footer_script', '', true)
    ];

    $this->set_available_store();
    $this->set_default_address();

    $this->template->load('template', 'cart/v_cart', $data);
  }

  // Mendapatkan Ringkasan Belanja pada Halaman Cart
  public function getCartSummary()
  {
    $data = array();
    $data = [
      'cart' => $this->cart->contents()
    ];
    $this->load->view('cart/summary', $data);
  }

  // fungsi untuk memeriksa stok
  public function check_stock()
  {
    $i = 0;
    $arr_informasi_stock = [];
    foreach ($this->cart->contents() as $cart_item) {
      // var_dump($this->input->post('qty')[$i]);
      // echo "<br>";
      $in_store_founded = false;
      $stok = 0;
      $id_product = $cart_item['id'];
      $id_attribute_product = $cart_item['options']['Size'];
      $qty_request = isset($this->input->post('qty')[$i]) ? $this->input->post('qty')[$i] : $cart_item['qty'];
      $id_alamat = explode("-", $cart_item['id_alamat']);
      // var_dump($id_alamat[0] == 'G');
      if ($id_alamat[0] == 'G') {
        // jika user memilih self pickup / ambil sendiri
        $stok_product = $this->query_check_stock($id_alamat[1], $id_product, $id_attribute_product);
        if ($qty_request <= $stok_product) {
          $in_store_founded = true;
          //kondisi ketika barang ada / pas
          $arr_informasi_stock[] = [
            'id_product' => $cart_item['id'],
            'id_attribute_product' => $cart_item['options']['Size'],
            'stock_available' => true,
            'stock' => $stok_product,
            'from' => $id_alamat[1],
            'msg' => 'Menemukan stock pada gudang yang dipilih'
          ];

          $update_data_cart = array(
            'rowid' => $cart_item['rowid'],
            'qty'   => $qty_request,
          );
          $this->cart->update($update_data_cart);
        } else {
          $in_store_founded = true;
          $arr_informasi_stock[] = [
            'id_product' => $cart_item['id'],
            'id_attribute_product' => $cart_item['options']['Size'],
            'stock_available' => false,
            'stock' => $stok_product,
            'code' => $id_alamat[1],
            'msg' => "Stok tidak mencukupi, gudang hanya memiliki stok $stok_product"
          ];
        }
      } else {
        // Jika user memilih alamat pengiriman
        // periksa setiap gudang

        // echo "mencari stok bukan berdasarkan gudang";
        $store_checked = null;
        foreach (get_store() as $store) { // data list store di ambil dari helper
          // var_dump($store['id_store']);
          $stok_product = $this->query_check_stock($store['id_store'], $id_product, $id_attribute_product);
          $store_checked = $store['id_store'] + "," + $store_checked;
          if ($qty_request <= $stok_product) {
            $in_store_founded = true;
            //kondisi ketika barang ada / pas
            $arr_informasi_stock[] = [
              'id_product' => $cart_item['id'],
              'id_attribute_product' => $cart_item['options']['Size'],
              'stock_available' => true,
              'stock' => $stok_product,
              'from' => $store_checked,
              'msg' => 'Menemukan stock pada gudang',
            ];
            $update_data_cart = array(
              'rowid' => $cart_item['rowid'],
              'qty'   => $qty_request,
            );
            $this->cart->update($update_data_cart);
            break;
          } else if (isset($stok_product)) {
            $in_store_founded = true;
            // jika di temukan masih tidak ada stok ...
            $arr_informasi_stock[] = [
              'id_product' => $cart_item['id'],
              'id_attribute_product' => $cart_item['options']['Size'],
              'stock_available' => false,
              'stock' => $stok_product,
              'from' => $store_checked,
              'msg' => "Stok pada gudang tidak mencukupi, stok tersisa $stok_product",
            ];
          }
        }
        // tidak di temukan di gudang manapun
        if ($in_store_founded == false) {
          // echo $id_alamat[0];
          $stok_product = $this->query_check_stock($store['id_store'], $id_product, $id_attribute_product);
          $arr_informasi_stock[] = [
            'id_product' => $cart_item['id'],
            'id_attribute_product' => $cart_item['options']['Size'],
            'stock_available' => false,
            'stock' => 0,
            'from' => $store_checked,
            'msg' => "Tidak menemukan stock di gudang manapun"
          ];
        }
        // $stok_product = $this->query_check_stock($id_alamat[1], $id_product, $id_attribute_product);
      }
      $i++;
    }
    // echo "<pre>";
    // print_r(($arr_informasi_stock));
    // echo "</pre>";
    print_r(json_encode($arr_informasi_stock));
  }

  private function query_check_stock($id_store, $id_product, $id_attribute_product)
  {
    $results = $this->db->select_sum('jumlah_stok')
      ->where(['id_store' => $id_store])
      ->where(['id_product' => $id_product])
      ->where(['id_product_attribute' => $id_attribute_product])
      ->get('product_stok')
      ->row();
    return $results->jumlah_stok;
  }

  // set default alamat ke cart session
  public function set_default_address()
  {
    $user_id = isset($this->session->userdata['user_id']) ? $this->session->userdata['user_id'] : null;
    if ($user_id != null) {
      $query = $this->db->query("
          SELECT * 
          FROM tb_alamat_pengiriman
          WHERE user_id = '{$user_id}' AND main_address = 1
          ")->result();

      // Jika Ada alamat default maka set ke dalam session
      if (!empty($query)) {
        foreach ($this->cart->contents() as $cart_item) {
          if ($cart_item['id_alamat'] == null) {
            $data = array(
              'rowid' => $cart_item['rowid'],
              'id_alamat' => $query[0]->id,
            );
            $this->cart->update($data);
          }
        }
      }
    }
  }

  // set available store ke cart session
  public function set_available_store()
  {
    foreach ($this->cart->contents() as $cart_item) {
      $temp_store_avaiilable_stock = array();
      $id_product = $cart_item['id'];
      $id_attribute_product = $cart_item['options']['Size'];
      $qty_request = $cart_item['qty'];
      foreach (get_store() as $store) { // data list store di ambil dari helper
        $product_query = $this->db->select_sum('jumlah_stok')
          ->where(['id_store' => $store['id_store']])
          ->where(['id_product' => $id_product])
          ->where(['id_product_attribute' => $id_attribute_product])
          ->get('product_stok')
          ->row();
        $product_stock = $product_query->jumlah_stok;
        if ($qty_request <= $product_stock) {
          // tambah parameter jumlah stok pada setiap store
          $jumlah_stock = [
            'stock_item' => $product_stock,
          ];
          $temp_store_avaiilable_stock[] = array_merge($jumlah_stock, $store);
        }
      }
      $data = array(
        'rowid' => $cart_item['rowid'],
        'available_store' => $temp_store_avaiilable_stock,
      );
      // Bisa di fungsikan untuk mengecek stok dan store
      // Jika available storenya tidak ada bisa di pastikan stoknya tidak ada.
      $this->cart->update($data);
    }
  }
  // Fungsi menggantikan updateCart_address()
  public function update_address()
  {
    $i = 0;
    foreach ($this->cart->contents() as  $items) {
      $id_alamat = $this->input->post('id_alamat')[$i];
      // var_dump($id_alamat);
      // exit();
      $data = array(
        'rowid' => $items['rowid'],
        'id_alamat' => $id_alamat,
      );
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

  public function updateCart_address()
  {
    $i = 0;
    foreach ($this->cart->contents() as  $items) {
      $id_alamat = $this->input->post('id_alamat')[$i];
      // $full_address = $this->ModelAlamatPengiriman->getByID($id_alamat)[0];
      // exit();
      $data = array(
        'rowid' => $items['rowid'],
        'id_alamat' => $id_alamat,
      );
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
      'id_alamat' => '',
      'available_store' => null
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

      $list_store = [
        100, //gudang online
        23,
        200 //gudang online jakarta
      ];

      $is_store = explode("-", $items['id_alamat']);
      $selected_store = 100;
      if ($is_store[0] == "G") {
        switch ($is_store[1]) {
          case 0:
            $selected_store = $list_store[$is_store[1]];
            break;
          case 1:
            $selected_store = $list_store[$is_store[1]];
            break;
          default:
            // $selected_store = 100;
            break;
        }
      }

      $cekTotal = $this->db->select_sum('jumlah_stok')
        ->where(['id_store' => $selected_store])
        ->where(['id_product' => $items['id']])
        ->where(['id_product_attribute' => $items['options']['Size']])
        ->get('product_stok')
        ->row();

      // var_dump($cekTotal);

      // Periksa stiap gudang jika gudang yang di pilih stoknya habis
      if ($this->input->post('qty')[$i] > $cekTotal->jumlah_stok) {
        // cari berdasarkan list
        foreach ($list_store as $id_store) {
          $cekTotal = $this->db->select_sum('jumlah_stok')
            ->where(['id_store' => $id_store])
            ->where(['id_product' => $items['id']])
            ->where(['id_product_attribute' => $items['options']['Size']])
            ->get('product_stok')
            ->row();

          // Kondisi ketika menemukan stok pada store yang di cari
          if ($this->input->post('qty')[$i] <= $cekTotal->jumlah_stok) {
            $selected_store = $id_store;
            // var_dump($cekTotal->jumlah_stok);
            break;
          }
        }
      }

      // set id_store ke session cart
      $store_key = array_search($selected_store, $list_store);
      // echo $store_key;
      $item_data = array(
        'rowid' => $items['rowid'],
        'id_alamat' => "G-$store_key",
      );
      $this->cart->update($item_data);

      // echo "<pre>";
      // print_r($this->cart->contents());
      // echo "</pre>";

      // exit();

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
}
