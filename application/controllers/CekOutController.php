<?php
// use Dotenv\Dotenv;
// use Xendit\Xendit;

// require 'vendor/autoload.php';

defined('BASEPATH') or exit('No direct script access allowed');

class CekOutController extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    if (!$this->ion_auth->logged_in()) {
      $this->session->set_flashdata('message', 'Login Terlebih Dahulu');
      redirect('login', 'refresh');
    }
    /*
	if(!$this->cart->contents()) {
      $this->session->set_flashdata('message', 'Login Terlebih Dahulu');
      redirect('logout', 'refresh');
    }
	*/
    $options['secret_api_key'] = 'xnd_development_1an8oyLYD1MEvtDVXnl5PDx8qSsPk6bsxsgKimP5PJ9sV73FqSNm95pNJ5jr8Fe';
    $this->server_domain = 'https://api.xendit.co';
    $this->secret_api_key = $options['secret_api_key'];
    $this->load->model('M_voucher');
    $this->load->model('M_product');
    $this->load->model('M_reseller');

    $this->load->model('Model_checkOngkir');
    $this->load->model('Model_alamatPengiriman');

    $this->load->helper('store_helper');

    date_default_timezone_set('Asia/Jakarta');
  }

  public function index()
  {


    $date = date('Y-m-d');
    $data = [
      'title' => 'Checkout | Bocorocco Pillow Concept',
      'voucher' => $this->M_voucher->getVoucherUser(),
      'voucherUpgrade' => $this->M_voucher->getFreeUpgrade(),
      'voucherUmum' => $this->M_voucher->getVoucherUmum(),
      'voucherRefer' => $this->M_voucher->voucherRefer(),
      'cekMember' => $this->db->where(['user_id' => $this->ion_auth->user()->row()->id])->where("DATE_FORMAT(masaberlaku,'%Y-%m-%d') >=", $date)->get('user_membership')->row(),
    ];

    // var_dump($this->ion_auth->user()->row()->first_name . ' ' . $this->ion_auth->user()->row()->last_name);

    if (empty($this->cart->contents())) {
      redirect(base_url('cart') . "?msg=Tidak Dapat Melakukan Checkout, Keranjang Kamu Masih Kosong !");
    } else {
      // $cekMember = $this->db->where(['user_id' => $this->ion_auth->user()->row()->id])->where("DATE_FORMAT(masaberlaku,'%Y-%m-%d') >=", date('Y-m-d'))->get('user_membership')->row();
      // if ($cekMember) {
      //   foreach ($this->cart->contents() as $items) {
      //     $barang = $this->M_product->get_detailproduct($items['id']);
      //     if ($items['options']['Diskon'] != 0) {
      //       if ($cekMember->peringkat_member == 'GOLD') {
      //         $diskon = 10;
      //         $totalDiskon = ($diskon / 100) * $barang->harga;
      //         $totalHarga = $barang->harga  - $totalDiskon;
      //       } else if ($cekMember->peringkat_member == 'PLATINUM') {
      //         $diskon = 15;
      //         $totalDiskon = ($diskon / 100) * $barang->harga;
      //         $totalHarga = $barang->harga  - $totalDiskon;
      //       } else if ($cekMember->peringkat_member == 'DIAMOND') {
      //         $diskon = 20;
      //         $totalDiskon = ($diskon / 100) * $barang->harga;
      //         $totalHarga = $barang->harga  - $totalDiskon;
      //       }
      //     } else {
      //       $diskon = 0;
      //       $totalHarga = $barang->harga;
      //     }
      //     $data = array(
      //       'rowid' => $items['rowid'],
      //       'price' => $totalHarga,
      //       'options' => [
      //         'Size' => $items['options']['Size'],
      //         'Color' => $items['options']['Color'],
      //         'Diskon' => $diskon,
      //         'Indent' => $items['options']['Indent'],
      //       ],
      //     );
      //     $this->cart->update($data);
      //   }
      // }

      $diskonMember = 0;
      if ($this->ion_auth->logged_in()) {
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

        // Jika alamat belum di pilih kembali ke halaman cart
        if ($items['id_alamat'] == null) {
          redirect(base_url('cart') . "?msg=Kamu Belum Memilih Alamat Pengiriman !");
        }

        $is_store = explode("-", $items['id_alamat']);

        if ($is_store[0] == "G") {
          $penerima_pengiriman = $this->ion_auth->user()->row()->first_name . ' ' . $this->ion_auth->user()->row()->last_name;
          $pilihan_jasakirim = '';
          $pengiriman_default = '';
          foreach (get_store() as $store) {
            if ($store['id_store'] == $is_store[1]) {
              $alamat_pengiriman = $store['nama_store'];
              break;
            }
            // Kalo ga ketemu storenya bakal apa ?
          }
        } else {
          // var_dump($this->Model_checkOngkir->getOngkir(''));
          $dataAlamatPengiriman = $this->Model_alamatPengiriman->getById($items['id_alamat'])[0];
          $id_subdistrict = $dataAlamatPengiriman->subdistrictId;
          $penerima_pengiriman = $dataAlamatPengiriman->penerima;
          $alamat_pengiriman = $dataAlamatPengiriman->alamat;
          $pilihan_jasakirim = $this->Model_checkOngkir->getOngkir('')['rajaongkir']['results'];
          $desiredCode = $pilihan_jasakirim[0]['code'];
          $desiredService = $pilihan_jasakirim[0]['costs'][0]['service'];
          $desiredCost = $pilihan_jasakirim[0]['costs'][0]['cost'][0]['value'];
          $pengiriman_default = "$desiredCode,$desiredService,$desiredCost";
        }

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

        // if ($items['options']['Diskon'] != 0) {
        // selalu update 

        // $pengiriman = $items['options']['pengiriman'];

        $update_data_cart = array(
          'rowid' => $items['rowid'],
          'price' => $hargaReal,
          'id_alamat' => $items['id_alamat'],
          'options' => [
            'Size' => $items['options']['Size'],
            'Color' => $items['options']['Color'],
            'Diskon' => $diskon,
            'Indent' => $items['options']['Indent'],
            'alamat' => [
              'alamat_pengiriman' => $alamat_pengiriman,
              'penerima' => $penerima_pengiriman
            ],
            'pengiriman' => isset($items['options']['pengiriman']) ? $items['options']['pengiriman'] : $pengiriman_default,
            'jasa_kirim' => $pilihan_jasakirim
          ],
        );
        $this->cart->update($update_data_cart);
        // }
      }
    }

    $this->template->load('template', 'cekout/v_cekout', $data);
  }

  function ongkir_on_cart()
  {
    $i = 0;
    $cart = $this->cart->contents();

    foreach ($cart as $item) {
      $item['options']['pengiriman'] = $this->input->post('pengiriman')[$i];

      // echo "<pre>";
      // var_dump($item['options']['pengiriman']);
      // echo "</pre>";

      $data = array(
        'rowid' => $item['rowid'],
        'options' =>  $item['options']
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

  function cek_stok()
  {
    $hasil = "";
    $i = 1;
    foreach ($this->cart->contents() as  $items) {
      $qty_order = $this->input->post('qty' . $i);
      $cekstok = $this->M_product->get_stokproduct($items['id'], $this->input->post('id_product_attribute' . $i));
      if ($qty_order > $cekstok->jml_stok) {
        $hasil = 'Maaf artikel ' . $cekstok->nama_barang . ' ' . $cekstok->size . ', Stok tidak mencukupi';
        break;
      }
      /*$data_item = array(
        'order_id' =>  $is_id,
        'kode_order' => $this->input->post('kode_order'),
        'product_id' => $items['id'],
        'is_indent' => $this->input->post('indent' . $i),
        'qty' => $this->input->post('qty' . $i),
        'price_item' => $this->input->post('price_item' . $i),
        'sub_total' => $this->input->post('sub_total' . $i),
        'diskon' => $this->input->post('diskon' . $i),
        'id_product_attribute' => $this->input->post('id_product_attribute' . $i),
        'user_id' => $this->ion_auth->user()->row()->id,
      );
      $this->db->insert('order_items', $data_item);*/
      $i++;
    };
    return $hasil;
  }
  public function cekoutCek()
  {
    //ini aktifkan validasi payment method
    if ($this->input->post('total_amount') > 0) {
      if (!$this->session->userdata('metode_admin')) {
        $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">Silahkan pilih metode pembayaran.</div>');
        redirect('cekout');
      }
    }
    /*start validasi SP hanya bisa dibeli 1x saja*/
    $items_khusus = "950201169"; //FP:950201094,SP:950201169. ini aktifkan
    $item_khusus_exclude_sepatu = explode(",", $items_khusus);
    foreach ($this->cart->contents() as $items) {
      if (in_array($items['id'], $item_khusus_exclude_sepatu, TRUE)) {
        $cekUsage = $this->db->where(['user_id' => $this->ion_auth->user()->row()->id])->where(['voucher_id' => 170])->get('voucher_used')->row();
        if ($cekUsage) {
          $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
                    Product ' . $items['name'] . ' Hanya bisa dibeli 1X Saja
                    </div>');
          return  redirect('cekout');
        }
      }
    }
    $items_khusus_fp = "950201094"; //FP:950201094
    $item_khusus_exclude_sepatu = explode(",", $items_khusus_fp);
    foreach ($this->cart->contents() as $items) {
      if (in_array($items['id'], $item_khusus_exclude_sepatu, TRUE)) {
        $cekUsage = $this->M_reseller->cek_produk_sales_fp($this->session->userdata('user_id'), $items['id']);
        if ($cekUsage) {
          $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
                    Product ' . $items['name'] . ' Hanya bisa dibeli 1X Saja
                    </div>');
          return  redirect('cekout');
        }
      }
    }
    /*end validasi SP & FP hanya bisa dibeli 1x saja*/

    $validasi_stok = $this->cek_stok();
    if ($validasi_stok != '') {
      $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">' . $validasi_stok . '</div>');
      redirect('cekout');
    } else {
      $cekAmount = $this->input->post('total_amount');
      $reffer = $this->input->post('reffer');
      if ($reffer) {
        if ($reffer == $this->ion_auth->user()->row()->email || $reffer == $this->ion_auth->user()->row()->username) {
          $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">Reffer Tidak Bisa dengan Email Atau Username Account Anda</div>');
          return redirect('users/refer', 'refresh');
        }
        $cekRefer = $this->db->where(['email' => $reffer])->or_where(['username' => $reffer])->get('users')->row();
        if ($cekRefer) {
          $dataReferSave = [
            'user_id' =>  $this->ion_auth->user()->row()->id,
            'refertouser_id' => $cekRefer->id,
            'refertouser_email' => $reffer,
          ];

          $this->db->insert('users_refer', $dataReferSave);

          if ($cekAmount == 0) {
            $this->gratisPembelian();
          } else {
            $this->saveCekoutXendit();
          }
        } else {
          $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">Email Referrer Tidak Tersedia</div>');
          redirect('cekout');
        }
      } else {
        if ($cekAmount == 0) {
          $this->gratisPembelian();
        } else {
          $this->saveCekoutXendit();
        }
      }
    }
  }

  public function gratisPembelian()
  {
    $cek_order = $this->db->select('kode_order')->where(['kode_order' => $this->input->post('kode_order')])->get('order')->row();
    if (!$cek_order) {
      if ($this->input->post('isupgradediamond')) {
        $upgrade =  $this->input->post('isupgradediamond');
      } else {
        $upgrade = 0;
      }

      $reseller = '';
      if ($this->session->userdata('resellerid')) {
        $reseller = $this->session->userdata('resellerid');
      }
      $method = '';
      if ($this->input->post('id_voucher') == 120) { //voucher deposit
        $method = 'DEPOSIT';
        if (!$this->send_email($this->ion_auth->user()->row()->id)) {
          // Handle the failure 
          echo "Email sending failed!";
        } else {
          // The email was sent successfully
          echo "Email sent successfully!";
        }
      }
      if ($this->input->post('id_voucher') == 170) { //voucher singlepackage
        $method = 'DEPOSIT';
      }
      $save_data = [
        'user_id' => $this->ion_auth->user()->row()->id,
        'kode_order' => $this->input->post('kode_order'),
        'nama_order' => $this->input->post('first_name') . ' ' . $this->input->post('last_name'),
        'phone_order' => '',
        'email_order' => '',
        'alaman_order' => '',
        'kode_pos' => '',
        'status_bayar' => 'SETTLED',
        'status_order' => 'DITERIMA',
        'total_bayar' => $this->input->post('total_amount'),
        'total_ongkir' => $this->input->post('total_ongkir'),
        'invoice_url' => '',
        'id_xendit' => '',
        'expiry_date' => '',
        'isupgrademember' => $upgrade,
        'subtotal' => $this->input->post('sub_total'),
        'diskon_voucher' => $this->input->post('diskon_voucher'),
        'id_reseller' => $reseller,
        'kode_voucher' => $this->input->post('id_voucher'),
        'payment_method' => $method,
        'sts_read' => 1,
      ];
      $this->db->trans_start();

      $this->db->insert('order', $save_data);
      $is_id = $this->db->insert_id();
      $inputStatus = [
        'order_id' => $is_id
      ];
      $this->db->insert('order_status', $inputStatus);

      $id_voucher = $this->input->post('id_voucher');

      if ($id_voucher) {
        $thNow = date('Y');
        $cekUsage = $this->db->where(['user_id' => $this->ion_auth->user()->row()->id])->where(['voucher_id' => $id_voucher])->where("DATE_FORMAT(created_at,'%Y')", $thNow)->get('voucher_used')->row();

        if ($cekUsage) {
          $this->db->where('id_voucher_used', $cekUsage->id_voucher_used);
          if ($this->input->post('val_multiples') != null) {
            $this->db->update('voucher_used', ['is_used' => 1, 'order_id' => $is_id, 'val_multiples' => $this->input->post('val_multiples'), 'created_at' => date('Y-m-d')]);
          } else {
            $this->db->update('voucher_used', ['is_used' => 1, 'order_id' => $is_id, 'created_at' => date('Y-m-d')]);
          }
        } else {
          $createdUsage = [
            'user_id' => $this->ion_auth->user()->row()->id,
            'voucher_id' => $id_voucher,
            'is_used' => 1,
            'order_id' => $is_id,
            'val_multiples' => $this->input->post('val_multiples'),
            'created_at' => date('Y-m-d')
          ];
          $this->db->insert('voucher_used', $createdUsage);
        }
      }
      /*Insert kode voucher SP ke voucher_used jika membeli SP dengan voucher FP*/
      if ($this->input->post('id_voucher') == 120) { //voucher deposit FP
        $items_khusus = "950201169"; //FP:950201094,SP:950201169. ini aktifkan
        $item_khusus_exclude_sepatu = explode(",", $items_khusus);
        $sts_vc = 0;
        foreach ($this->cart->contents() as $items) {
          if (in_array($items['id'], $item_khusus_exclude_sepatu, TRUE)) {
            $createdUsage = [
              'user_id' => $this->ion_auth->user()->row()->id,
              'voucher_id' => 170, //id voucher SP
              'is_used' => 0,
              'order_id' => $is_id,
              'created_at' => date('Y-m-d')
            ];
            $this->db->insert('voucher_used', $createdUsage);
            $sts_vc = 1;
          }
        }
        if ($sts_vc == 1) {
          $cek = $this->db->select('user_id,ifnull(deposit,0) as jml_depo')->where(['user_id' => $this->session->userdata('user_id')])->get('tb_wallet')->row();
          if ($cek) {
            $this->db->where('user_id', $cek->user_id);
            $this->db->update('tb_wallet', ['deposit' => 3000000 + $cek->jml_depo]);
          } else {
            $createdUsage = [
              'user_id' => $this->ion_auth->user()->row()->id,
              'saldo' => 0,
              'deposit' => 3000000
            ];
            $this->db->insert('tb_wallet', $createdUsage);
          }
        }
      }
      /*end Insert kode voucher SP ke voucher_used*/



      $store = $this->check_stock();

      $i = 1;


      foreach ($this->cart->contents() as  $items) {

        // echo "<pre>";
        // var_dump($items);
        // echo "</pre>";

        $selected_store = $store[$i - 1]['from'];

        $pengiriman = explode(',', $items['options']['pengiriman']);

        $arrayAttribute =
          [
            'penerima' => $items['options']['alamat']['penerima'],
            'alamat' => $items['options']['alamat']['alamat_pengiriman'],
            'jasa_pengiriman' => $pengiriman[0] . "," . $pengiriman[1],
            'tarif_pengiriman' => $pengiriman[2],
          ];

        $query = $this->db->query("
          SELECT id_stok 
          FROM product_stok 
          WHERE id_store = $selected_store 
            AND id_product = '" . $items['id'] . "'
            AND id_product_attribute = '" . $items['options']['Size'] . "'
        ");
        $get_stock_id = $query->row();

        $data_item = array(
          'order_id' =>  $is_id,
          'kode_order' => $this->input->post('kode_order'),
          'stok_id' => $get_stock_id->id_stok,
          'product_id' => $items['id'],
          'qty' => $this->input->post('qty' . $i),
          'price_item' => $this->input->post('price_item' . $i),
          'is_indent' => $this->input->post('indent' . $i),
          'sub_total' => $this->input->post('sub_total' . $i),
          'diskon' => $this->input->post('diskon' . $i),
          'id_product_attribute' => $this->input->post('id_product_attribute' . $i),
          'user_id' => $this->ion_auth->user()->row()->id,
          'array_attribute' => json_encode($arrayAttribute),
          'id_store' =>  $selected_store
        );
        $this->db->insert('order_items', $data_item);
        $i++;
      };
      $this->db->trans_complete();

      $this->cart->destroy();
      /*unset session metode pembayaran, ini aktifkan*/
      $array_items = array('metode_admin', 'biaya_admin');
      $this->session->unset_userdata($array_items);

      /*kurangi stok*/
      $this->kurangi_stok($this->input->post('kode_order'));
    } else {
      $is_id = $cek_order->kode_order;
    }
    return redirect('order/detail/' . $is_id);
  }

  public function kurangi_stok($reference)
  {
    //$data_arr=array();
    //$reference='ORD/20230113/14653/IP1S';
    $cek = $this->M_reseller->data_penjualan($reference);
    //var_dump($cek);exit();
    if ($cek) {
      foreach ($cek as $row) {
        $qty_order = $row->qty;
        $cek_stok = $this->M_reseller->data_get_stok_new($row->product_id, $row->id_product_attribute);

        if ($cek_stok) {
          $sisa = 0;
          $no = 0;
          foreach ($cek_stok as $row_stok) {
            $id_stok = $row_stok->id_stok;
            $stok_real = $row_stok->jumlah_stok;
            $stok_inproses = $row_stok->stok_inproses;
            $thn_prod = $row_stok->tahun_produksi;
            //var_dump($stok_real.'#'.$qty_order);exit();
            if ($no == 0) {
              if ($qty_order <= $stok_real) {
                $sisa = $stok_real - $qty_order;
                //var_dump($sisa);exit();
                $this->M_reseller->change_stok_inproses($id_stok, array('jumlah_stok' => $sisa, 'stok_inproses' => $qty_order + $stok_inproses));
                break;
              } else {
                $sisa = $qty_order - $stok_real;
                //var_dump($sisa);exit();
                $this->M_reseller->change_stok_inproses($id_stok, array('jumlah_stok' => 0, 'stok_inproses' => $stok_real + $stok_inproses));
              }
            } else {
              if ($sisa < 1) {
                break;
              }
              if ($sisa <= $stok_real) {
                $vsisa = $sisa;
                $sisa = $stok_real - $sisa;
                $this->M_reseller->change_stok_inproses($id_stok, array('jumlah_stok' => $sisa, 'stok_inproses' => $vsisa + $stok_inproses));
                break;
              } else {
                $vsisa = $sisa;
                $sisa = $sisa - $stok_real;
                $this->M_reseller->change_stok_inproses($id_stok, array('jumlah_stok' => 0, 'stok_inproses' => $stok_real + $stok_inproses));
              }
            }

            if ($sisa < 1) {
              break;
            }
            $no++;
          }
        }
        /*$data_arr[]=array(
				"id" => $row->user_id,
				"name" => $row->nama,
				"sponsor" => $row->sponsor,
				"peringkat" => $row->nama_peringkat,
				"id_peringkat" => $row->id_peringkat,
				//"omset" => $this->getOmset($row->user_id)
			);*/
      }
    }
    echo 'oke';
    //return $data_arr;
  }

  public function saveCekoutXendit()
  {

    //ini aktifkan
    $adm_method = $this->session->userdata('metode_admin'); //strtoupper($this->session->userdata('metode_admin'));
    if ($adm_method === 'bank_transfer') {
      $admin_method = ["BCA", "BRI", "MANDIRI", "BNI", "PERMATA", "CIMB"];
    } else if ($adm_method === 'wallet') {
      $admin_method = ["OVO", "DANA", "LINKAJA", "SHOPEEPAY"];
    } else if ($adm_method === 'credit_card') {
      $admin_method = ["CREDIT_CARD"];
    } else {
      $admin_method = ["XXXXXXXXXXXXX"];
    }
    $adm = ($this->input->post('sub_total') - $this->input->post('diskon_voucher')) * $this->session->userdata('biaya_admin');

    $curl = curl_init();
    $headers = array();
    $headers[] = 'Content-Type: application/json';

    $end_point = $this->server_domain . '/v2/invoices';

    $data['external_id'] = $this->input->post('kode_order');
    //$data['amount'] = (int)$this->input->post('total_amount'); //+(int)$adm,ini aktifkan
    $data['amount'] = (int)$this->input->post('total_amount');
    $data['payer_email'] = 'dzarrzoy@gmail.com';
    $data['description'] = 'Pesanan ' . $this->ion_auth->user()->row()->username . ' - ' . $this->ion_auth->user()->row()->first_name . ' ' . $this->ion_auth->user()->row()->last_name; //'Pesanan bocorocco';
    $data['payment_methods'] = $admin_method; //ini aktifkan
    // $data['invoice_duration'] = 86400;
    // $data['payment_methods'] = ["BCA", "BRI", "MANDIRI", "BNI", "PERMATA", "ALFAMART", "INDOMARET"];

    $invoice_options = null;
    if (is_array($invoice_options)) {
      foreach ($invoice_options as $key => $value) {
        $data[$key] = $value;
      }
    }

    $payload = json_encode($data);

    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_USERPWD, $this->secret_api_key . ":");
    curl_setopt($curl, CURLOPT_URL, $end_point);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $payload);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($curl);
    curl_close($curl);

    $responseObject = json_decode($response, true);

    if (isset($responseObject['invoice_url'])) {
      $invoice_url = $responseObject['invoice_url'];
    } else {
      $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
       Maaf Pembayaran Xendit Sedang bermasalah , Harap coba beberapa menit lagi, 
        </div>');
      return  redirect('/cekout');
    }

    // var_dump($responseObject);
    $id_ex = $responseObject['id'];
    $tgl1 = date('Y-m-d H:i'); // pendefinisian tanggal awal
    $tgl2 = date('Y-m-d H:i', strtotime('+1 days', strtotime($tgl1)));

    if ($this->input->post('isupgradediamond')) {
      $upgrade =  $this->input->post('isupgradediamond');
    } else {
      $upgrade = 0;
    }
    //==ebe
    $reseller = '';
    //   /*if($this->session->userdata('reseller') != ""){
    // 	if($this->session->userdata('reseller') == "1"){
    // 		$reseller=$this->session->userdata('user_id');
    // 	}else{
    // 		$reseller=$this->session->userdata('resellerid');
    // 	}
    // }*/
    //   /*if($this->session->userdata('reseller') == "1"){
    // 	$reseller=$this->session->userdata('user_id');
    // }else{
    // 	$reseller=$this->session->userdata('resellerid');
    // }*/
    if ($this->session->userdata('resellerid')) {
      $reseller = $this->session->userdata('resellerid');
    }
    $cek_deposit = $this->get_voucher_deposit();
    if ($cek_deposit == 1) {
      $reseller = $this->ion_auth->user()->row()->id;
    }
    $cek_deposit_singlepackage = $this->get_voucher_singlepackage();
    if ($cek_deposit_singlepackage == 1) {
      $getID = $this->db->where(['user_id' => $this->ion_auth->user()->row()->id])->get('tb_reseller')->row();
      if ($getID) {
        $reseller = $getID->refertouser_id;
      }
      //$reseller=$this->session->userdata('resellerid');
    }

    $kode_voucher_deposit = '';
    if ($this->input->post('id_voucher') == 120 || $this->input->post('id_voucher') == 170) { //voucher deposit atau voucher singlepackage
      $kode_voucher_deposit = $this->input->post('id_voucher');
    }
    //==end ebe
    /*$save_data = [
      'user_id' => $this->ion_auth->user()->row()->id,
      'kode_order' => $this->input->post('kode_order'),
      'nama_order' => $this->input->post('first_name') . ' ' . $this->input->post('last_name'),
      'phone_order' => $this->input->post('phone'),
      'email_order' => $this->input->post('email'),
      'alaman_order' => $this->input->post('address'),
      'kode_pos' => $this->input->post('kode_pos'),
      'status_bayar' => $responseObject['status'],
      'status_order' => 'DITERIMA',
      'total_bayar' => $responseObject['amount'],
      'invoice_url' => $invoice_url,
      'id_xendit' => $id_ex,
      'expiry_date' => $tgl2,
      'isupgrademember' => $upgrade,
      'subtotal' => $this->input->post('sub_total'),
      'diskon_voucher' => $this->input->post('diskon_voucher'),
	  'id_reseller' => $reseller,
	  'kode_voucher' => $kode_voucher_deposit,
    ];*/
    //penambahan biaya admin,admin_method,ini aktifkan
    $save_data = [
      'user_id' => $this->ion_auth->user()->row()->id,
      'kode_order' => $this->input->post('kode_order'),
      'nama_order' => $this->input->post('first_name') . ' ' . $this->input->post('last_name'),
      'phone_order' => '',
      'email_order' => '',
      'alaman_order' => '',
      'kode_pos' => '',
      'status_bayar' => $responseObject['status'],
      'status_order' => 'DITERIMA',
      'total_bayar' => $responseObject['amount'],
      'total_ongkir' => $this->input->post('total_ongkir'),
      'biaya_admin' => $adm,
      'admin_method' => $this->session->userdata('metode_admin'),
      'invoice_url' => $invoice_url,
      'id_xendit' => $id_ex,
      'expiry_date' => $tgl2,
      'isupgrademember' => $upgrade,
      'subtotal' => $this->input->post('sub_total'),
      'diskon_voucher' => $this->input->post('diskon_voucher'),
      'id_reseller' => $reseller,
      'kode_voucher' => $kode_voucher_deposit,
    ];
    $this->db->trans_start();
    $this->db->insert('order', $save_data);
    $is_id = $this->db->insert_id();

    $inputStatus = [
      'order_id' => $is_id
    ];
    $this->db->insert('order_status', $inputStatus);

    $id_voucher = $this->input->post('id_voucher');


    if ($id_voucher) {
      // $cekUsage = $this->db->where(['user_id' => $this->ion_auth->user()->row()->id])->where(['voucher_id' => $id_voucher])->get('voucher_used')->row();
      $thNow = date('Y');
      $cekUsage = $this->db->where(['user_id' => $this->ion_auth->user()->row()->id])->where(['voucher_id' => $id_voucher])->where("DATE_FORMAT(created_at,'%Y')", $thNow)->order_by('created_at', 'desc')->get('voucher_used')->row();

      if ($cekUsage) {

        $this->db->where('id_voucher_used', $cekUsage->id_voucher_used);
        if ($this->input->post('val_multiples') != null) {
          $this->db->update('voucher_used', ['is_used' => 1, 'order_id' => $is_id, 'val_multiples' => $this->input->post('val_multiples'), 'created_at' => date('Y-m-d')]);
        } else {
          $this->db->update('voucher_used', ['is_used' => 1, 'order_id' => $is_id, 'created_at' => date('Y-m-d')]);
        }
      } else {
        $createdUsage = [
          'user_id' => $this->ion_auth->user()->row()->id,
          'voucher_id' => $id_voucher,
          'is_used' => 1,
          'order_id' => $is_id,
          'val_multiples' => $this->input->post('val_multiples'),
          'created_at' => date('Y-m-d')
        ];
        $this->db->insert('voucher_used', $createdUsage);
      }
    }



    $store = $this->check_stock();

    $i = 1;
    foreach ($this->cart->contents() as  $items) {

      $selected_store = $store[$i - 1]['from'];

      $pengiriman = explode(',', $items['options']['pengiriman']);

      $arrayAttribute =
        [
          'penerima' => $items['options']['alamat']['penerima'],
          'alamat' => $items['options']['alamat']['alamat_pengiriman'],
          'jasa_pengiriman' => $pengiriman[0] . "," . $pengiriman[1],
          'tarif_pengiriman' => $pengiriman[2],
        ];

      $query = $this->db->query("
        SELECT id_stok 
        FROM product_stok 
        WHERE id_store = $selected_store 
          AND id_product = '" . $items['id'] . "'
          AND id_product_attribute = '" . $this->input->post('id_product_attribute' . $i) . "'
      ");
      $get_stock_id = $query->row();
      // echo "<pre>";
      // var_dump($selected_store );
      // echo "</pre>";
      // exit();

      $data_item = array(
        'order_id' =>  $is_id,
        'kode_order' => $this->input->post('kode_order'),
        'stok_id' => $get_stock_id->id_stok,
        'product_id' => $items['id'],
        'is_indent' => $this->input->post('indent' . $i),
        'qty' => $this->input->post('qty' . $i),
        'price_item' => $this->input->post('price_item' . $i),
        'sub_total' => $this->input->post('sub_total' . $i),
        'diskon' => $this->input->post('diskon' . $i),
        'id_product_attribute' => $this->input->post('id_product_attribute' . $i),
        'user_id' => $this->ion_auth->user()->row()->id,
        'array_attribute' => json_encode($arrayAttribute),
        'id_store' => $selected_store
      );

      $this->db->insert('order_items', $data_item);
      $i++;
    };

    $this->db->trans_complete();

    $this->cart->destroy();
    /*unset session metode pembayaran, ini aktifkan*/
    $array_items = array('metode_admin', 'biaya_admin');
    $this->session->unset_userdata($array_items);

    /*kurangi stok*/
    $this->kurangi_stok($this->input->post('kode_order'));

    return redirect('order/detail/' . $is_id);
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
          $store_checked = $store['id_store'];
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
            var_dump($store_checked);
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
    return ($arr_informasi_stock);
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

  public function get_voucher_deposit()
  {
    $sts = 0;
    $i = 1;
    foreach ($this->cart->contents() as  $items) {
      /*$data_item = array(
        'order_id' =>  $is_id,
        'kode_order' => $this->input->post('kode_order'),
        'product_id' => $items['id'],
        'is_indent' => $this->input->post('indent' . $i),
        'qty' => $this->input->post('qty' . $i),
        'price_item' => $this->input->post('price_item' . $i),
        'sub_total' => $this->input->post('sub_total' . $i),
        'diskon' => $this->input->post('diskon' . $i),
        'id_product_attribute' => $this->input->post('id_product_attribute' . $i),
        'user_id' => $this->ion_auth->user()->row()->id,
      );*/
      if ($items['id'] == 950201094) { //ini id_product FP deposit 30jt //950201029
        $sts = 1;
      }
      $i++;
    };
    return $sts;
  }
  public function get_voucher_singlepackage()
  {
    $sts = 0;
    $i = 1;
    foreach ($this->cart->contents() as  $items) {
      if ($items['id'] == 950201169) { //ini id_product singlepackage
        $sts = 1;
      }
      $i++;
    };
    return $sts;
  }
  public function simpan_data_customer()
  {

    $_SESSION["first_name_checkout"] = $_POST["first_name"];

    $_SESSION["last_name_checkout"] = $_POST["last_name"];

    $_SESSION["phone_checkout"] = $_POST["phone"];

    $_SESSION["email_checkout"] = $_POST["email"];

    $_SESSION["address_checkout"] = $_POST["address"];

    $_SESSION["kode_pos_checkout"] = $_POST["kode_pos"];
  }
  public function send_email($user_id)
  {
    $userInfo =  $this->db->where(['id' => $user_id])->get('users')->row();
    $tujuan = $userInfo->email;
    $voucher = $userInfo->username;

    $this->load->library('parser');

    $config = array();

    $config['protocol'] = 'smtp';

    $config['smtp_host'] = 'ssl://smtp.gmail.com'; //'ssl://mail.graphie.co.id';

    $config['smtp_user'] = 'noreplyinfo@bocorocco-italia.com'; //'info@graphie.co.id';

    $config['smtp_pass'] = 'sfsrzqlhuucabiyt'; //'ZMqE25htnE';

    $config['smtp_port'] = 465; //4465;

    $config['mailtype'] = 'html';

    $config['charset'] = 'utf-8';

    $config['wordwrap'] = TRUE;

    $this->load->library('email', $config);

    $this->email->initialize($config);

    $this->email->set_newline("\r\n");

    $web_name = $this->db->get_where('webinformations', ['id_webinformations' => 1])->row()->name_web;
    //var_dump($web_name);exit();
    $data = array(
      'voucher' => strtoupper($voucher),
      'logo' => '<img src="https://adm.bocorocco-online.com/asset/logo/1609746639-logos.png" alt="' . $web_name . '" width="200px"/>',
    );
    //$html = $this->parser->parse('users/approve.html', $data);
    $html = $this->parser->parse('cekout/approve.html', $data);

    // $recipients = 'myolandh@gmail.com';

    $recipients = $tujuan; //$order_info->email_order;

    $this->email->from('noreplyinfo@bocorocco-italia.com', 'Admin Bocorocco');

    $this->email->to($recipients);

    $this->email->subject('Status Keanggotaan #' . strtoupper($voucher) . ' Entrepreneurship Bocorocco');

    $this->email->message($html);
    //$this->email->send();
    if ($this->email->send()) {
      echo 'ok';
      //return 'ok';
      //redirect('administrator/reseller');
    } else {
      //return 'gagal';
      //echo $this->email->print_debugger();
      //exit();
    }
  }
  public function set_session($isi)
  {
    //var_dump($isi);exit();
    $varr = explode("-", $isi);
    //var_dump(count($varr).' - '.$isi);exit();
    if (count($varr) > 1) {
      $session_data = [
        'metode_admin' => str_replace("+", "_", $varr[0]),
        'biaya_admin' => $varr[1],
      ];
      //$this->session->set_userdata($var, $isi);
      $this->session->set_userdata($session_data);
      echo 'Session set!';
    } else {
      echo 'Session not set!';
    }
    return;
  }
  public function set_session_voucher()
  {
    //var_dump($isi);exit();
    //$varr=explode("-",$isi);
    //var_dump(count($varr).' - '.$isi);exit();
    $cekMember = $this->db->where(['id' => $this->ion_auth->user()->row()->id])->where("reseller", 1)->where("sts_reseller", 1)->get('users')->row();
    if ($cekMember) {
      $session_data = [
        'reselleruser' => $cekMember->username
      ];
      //$this->session->set_userdata($var, $isi);
      $this->session->set_userdata($session_data);
      echo 'Session set! ' . $cekMember->username;
    } else {
      echo 'Session not set!';
    }
    return;
  }
  public function simpan_user()
  {
    /*if($this->input->post('first_name') !="" && $this->input->post('last_name') !="" && $this->input->post('phone') !="" && $this->input->post('email') !="" && $this->input->post('address') !="" && $this->input->post('kode_pos') !=""){*/
    if ($this->input->post('first_name') != "" && $this->input->post('last_name') != "" && $this->input->post('phone') != "" && $this->input->post('email') != "" && $this->input->post('address') != "") {
      $alamat = strlen($this->ion_auth->user()->row()->address);
      if ($alamat < 1) {
        $data_alamat = [
          /*'first_name' => $this->input->post('first_name'),
                    'last_name' => $this->input->post('last_name'),
                    'phone' => $this->input->post('phone'),
                    'email' => $this->input->post('email'),*/
          'address' => $this->input->post('address'),
          'kd_pos' => $this->input->post('kode_pos')
        ];
        $this->ion_auth->update($this->ion_auth->user()->row()->id, $data_alamat);
      }
      $session_data = [
        'first_name_checkout'   => $this->input->post('first_name'),
        'last_name_checkout'    => $this->input->post('last_name'),
        'phone_checkout'        => $this->input->post('phone'),
        'email_checkout'        => $this->input->post('email'),
        'address_checkout'      => $this->input->post('address'),
        'kode_pos_checkout'     => $this->input->post('kode_pos')
      ];
      $this->session->set_userdata($session_data);
      echo 'Session set!';
    }
  }
}


// Xendit::setApiKey('xnd_development_gltq0yHYCvEqHya5ENrr1pduMTaWtVWAOXmQOcIbNuGfXiKuQ0oeOsxR7h');

//     $params = [
//       'external_id' => $this->input->post('kode_order'),
//       'payer_email' => $this->input->post('email'),
//       'description' => 'Pesanan bocorocco',
//       'amount' => $this->input->post('total_amount'),
//     ];

//     $createInvoice = \Xendit\Invoice::create($params);
//     var_dump($createInvoice);
