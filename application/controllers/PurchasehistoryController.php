<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PurchasehistoryController extends CI_Controller
{


  public function __construct()
  {
    parent::__construct();
    if (!$this->ion_auth->logged_in()) {
      $this->session->set_flashdata('message', 'Login Terlebih Dahulu');
      redirect('login', 'refresh');
    }
	$options['secret_api_key'] = 'xnd_development_1an8oyLYD1MEvtDVXnl5PDx8qSsPk6bsxsgKimP5PJ9sV73FqSNm95pNJ5jr8Fe';
    $this->server_domain = 'https://api.xendit.co';
    $this->secret_api_key = $options['secret_api_key'];
    $this->load->model('M_order');
    $this->load->model('M_wasend');
	date_default_timezone_set('Asia/Jakarta');
  }

  public function orderTerima()
  {
    $data = [
      'order_proses' =>  $this->M_order->get_OrderTerima()->result(),
      'title' => 'Purchase History | Bocorocco Pillow Concept',
      'subtitle' => 'Terima',
    ];
    // var_dump($data);
    $this->template->load('template', 'users/purchasehistory/v_orderdiproses', $data);
  }

  public function orderBatal()
  {
    $data = [
      'order_proses' =>  $this->M_order->get_OrderBatal()->result(),
      'title' => 'Purchase History | Bocorocco Pillow Concept',
      'subtitle' => 'Batal',
    ];
    // var_dump($data);
    $this->template->load('template', 'users/purchasehistory/v_orderdiproses', $data);
  }

  public function orderProses()
  {
    $data = [
      'order_proses' =>  $this->M_order->get_OrderProccess()->result(),
      'title' => 'Purchase History | Bocorocco Pillow Concept',
      'subtitle' => 'Proses',
    ];
    // var_dump($data);
    $this->template->load('template', 'users/purchasehistory/v_orderdiproses', $data);
  }

  public function sedangDikirim()
  {
    $data = [
      'order_dikirm' =>  $this->M_order->get_OrderDiKirim()->result(),
      'title' => 'Purchase History | Bocorocco Pillow Concept',
      'subtitle' => 'Kirim',
    ];
    $this->template->load('template', 'users/purchasehistory/v_sedangdikirim', $data);
  }

  public function sampaiTujuan()
  {
    $data = [
      'order_selesi' =>  $this->M_order->get_OrderSelesai()->result(),
      'title' => 'Purchase History | Bocorocco Pillow Concept',
      'subtitle' => 'Tujuan',
    ];
    $this->template->load('template', 'users/purchasehistory/v_sampaitujuan', $data);
  }

  public function orderUpdateSelesai($id_order)
  {

    $cekData = $this->db->where(['id_order' => $id_order])->get('order')->row();

    if (!$cekData) {
      $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
          ' . lang('tidak_adadata') . '
          </div>');
      return redirect('users/sedangdikirim');
    }


    $this->db->where('id_order', $id_order);
    $this->db->update('order', ['status_order' => 'SELESAI']);

    // $this->M_wasend->sendWa($cekData->phone_order, "Trimakasih Telah Berbelanja di Bocorocco 

    // Pesanan Anda dengan Order Invoice $cekData->kode_order Telah Selesai

    // pesan otomatis dari Admin *Bocorocco*
    // cek status Member Anda di https://bocorocco.graphie.co.id/web/
    // ");


    $addStatus = [
      'order_id' => $id_order,
      'status_order' =>  'SELESAI',
    ];

    $this->db->insert('order_status', $addStatus);

    return redirect('/order/detail/' . $id_order);
  }
  public function orderUpdateBatal($id_order)
  {

    $cekData = $this->db->where(['order_id' => $id_order])->get('order_items')->result();
    if (!$cekData) {
      $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
          ' . lang('tidak_adadata') . '
          </div>');
      return redirect('users/purchasehistory');
    }else{
        /*foreach ($cekData as $dataproduct) {
            //var_dump($dataproduct->product_id);exit();
            $inidataproduct = $this->db->where(['id_product' => $dataproduct->product_id,'id_product_attribute' => $dataproduct->id_product_attribute,
            'id_store' => '100','stok_inproses >' => 0])->limit(1)->get('product_stok')->row();
           
            if($inidataproduct){
                $updatedata = [
                  'jumlah_stok' => $inidataproduct->jumlah_stok+$dataproduct->qty,
                  'stok_inproses' =>  $inidataproduct->stok_inproses-$dataproduct->qty,
                ];
                $this->db->where('id_stok', $inidataproduct->id_stok);
                $this->db->update('product_stok', $updatedata);
            }
        }*/
		 $getIDXendit = $this->db->where(['id_order' => $id_order])->get('order')->row();
        //var_dump($getIDXendit->id_xendit);exit();
        if($getIDXendit){
           $cek_invoice=$this->request_cancel_invoice_xendit($getIDXendit->id_xendit);
           if($cek_invoice == 'EXPIRED'){
                foreach ($cekData as $dataproduct) {
                    //var_dump($dataproduct->product_id);exit();
                    $inidataproduct = $this->db->where(['id_product' => $dataproduct->product_id,'id_product_attribute' => $dataproduct->id_product_attribute,
                    'id_store' => '100','stok_inproses >' => 0])->limit(1)->get('product_stok')->row();
                   
                    if($inidataproduct){
                        $updatedata = [
                          'jumlah_stok' => $inidataproduct->jumlah_stok+$dataproduct->qty,
                          'stok_inproses' =>  $inidataproduct->stok_inproses-$dataproduct->qty,
                        ];
                        $this->db->where('id_stok', $inidataproduct->id_stok);
                        $this->db->update('product_stok', $updatedata);
                    }
                }

                $addStatus = [
                  'order_id' => $id_order,
                  'status_order' =>  'BATAL',
                ];
            
                $this->db->insert('order_status', $addStatus);
                $this->db->where('id_order', $id_order);
                $this->db->update('order', ['status_order' => 'PROSES BATAL','status_bayar' => 'EXPIRED','sts_batal' => 1]);
                echo 'Update successfully.';
           }else{
               $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">Cancel Order Gagal</div>');
                return redirect('users/purchasehistory');
           }
        }else{
            $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">Cancel Order Gagal</div>');
            return redirect('users/purchasehistory');
        }
    }
    /*$this->db->where('id_order', $id_order);
    $this->db->update('order', ['status_order' => 'BATAL','status_bayar' => 'EXPIRED','id_xendit' => '']);

    $addStatus = [
      'order_id' => $id_order,
      'status_order' =>  'BATAL',
    ];

    $this->db->insert('order_status', $addStatus);
    echo 'Update successfully.';*/
    //return redirect('users/purchasebatal');
  }
  public function request_cancel_invoice_xendit($id_xendit)
  {
    $curl = curl_init();
    $headers = array();
    $headers[] = 'Content-Type: application/json';

    $end_point = $this->server_domain . "/invoices/$id_xendit/expire!";
    //var_dump($end_point);exit();
    $invoice_options = null;
    $invoice_sts="GAGAL";
    /*$payload = json_encode($data);*/

    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_USERPWD, $this->secret_api_key . ":");
    curl_setopt($curl, CURLOPT_URL, $end_point);
    curl_setopt($curl, CURLOPT_POST, true);
    //curl_setopt($curl, CURLOPT_POSTFIELDS, $payload);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($curl);
    curl_close($curl);

    $responseObject = json_decode($response, true);
    //var_dump($responseObject);exit();
    if (isset($responseObject['status'])) {
      $invoice_url = $responseObject['invoice_url'];
      $invoice_sts=$responseObject['status'];
    } else {
      $invoice_sts="GAGAL";
    }

    return $invoice_sts;
  }
}
