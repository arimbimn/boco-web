<?php
defined('BASEPATH') or exit('No direct script access allowed');


/**
 *| --------------------------------------------------------------------------
 *| Adjustment Stok Controller
 *| --------------------------------------------------------------------------
 *| Adjustment Stok site
 *|
 */
class KomisiController extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
	$options['secret_api_key'] = 'xnd_development_1an8oyLYD1MEvtDVXnl5PDx8qSsPk6bsxsgKimP5PJ9sV73FqSNm95pNJ5jr8Fe';
    $this->server_domain = 'https://api.xendit.co';
    $this->secret_api_key = $options['secret_api_key'];
    date_default_timezone_set('Asia/Jakarta');
	
    $this->load->model('M_komisi');
	$this->load->model('M_order');
	
	if (!$this->ion_auth->logged_in()) {
      // redirect them to the login page
      redirect('auth/logout', 'refresh');
    }
  }

  /**
   * show all Adjustment Stoks
   *
   * @var $offset String
   */
  public function index($offset = 0)
  {
    //$this->is_allowed('adjustment_stok_list');
	//$this->load->library('pagination');
    $filter = $this->input->get('q');
    $field   = $this->input->get('f');
	$cek=$this->M_komisi->total_saldo();
	if($cek){
		$saldo=$cek;
	}else{
		$saldo=0;
	}
	$this->data['total_saldo'] = $saldo;
    $this->data['komisi_data'] = $this->M_komisi->get($filter, $field, 10, $offset);
    $this->data['komisi_counts'] = $this->M_komisi->count_all($filter, $field);
    $this->data['export_data'] = json_encode($this->M_komisi->get($filter, $field, "", "", "array"));

    $config = [
      'base_url'     => 'users/komisi',
      'total_rows'   => $this->M_komisi->count_all($filter, $field),
      'per_page'     => 10,
      'uri_segment'  => 4,
    ];
	
    //$this->data['pagination'] = $this->pagination($config);
	$this->data['title'] ='Komisi | Bocorocco Pillow Concept';
    //$this->template->title('Komisi List');
	$this->template->load('template', 'users/komisi/v_listkomisi', $this->data);
    //$this->render('backend/standart/administrator/reseller/reseller_list', $this->data);
  }
  public function withdraw($offset = 0)
  {
    $filter = $this->input->get('q');
    $field   = $this->input->get('f');
	$cek=$this->M_komisi->total_saldo();
	if($cek){
		$saldo=$cek->saldo;
	//	$deposit=$cek->deposit;
	}else{
		$saldo=0;
	//	$deposit=0;
	}
	$this->data['total_saldo'] = $saldo;
	//$this->data['total_deposit'] = $deposit;
    $this->data['komisi_data'] = $this->M_komisi->get($filter, $field, 10, $offset);
    $this->data['komisi_counts'] = $this->M_komisi->count_all($filter, $field);
    $this->data['export_data'] = json_encode($this->M_komisi->get($filter, $field, "", "", "array"));

    $config = [
      'base_url'     => 'users/komisi',
      'total_rows'   => $this->M_komisi->count_all($filter, $field),
      'per_page'     => 10,
      'uri_segment'  => 4,
    ];
	
    //$this->data['pagination'] = $this->pagination($config);
	$this->data['title'] ='Withdraw | Bocorocco Pillow Concept';
    //$this->template->title('Komisi List');
	$this->template->load('template', 'users/komisi/v_listwithdraw', $this->data);
    //$this->render('backend/standart/administrator/reseller/reseller_list', $this->data);
  }
  public function deposit($offset = 0)
  {
    $filter = $this->input->get('q');
    $field   = $this->input->get('f');
	$cek=$this->M_komisi->total_saldo();
	if($cek){
		//$saldo=$cek->saldo;
		$deposit=$cek->deposit;
	}else{
		//$saldo=0;
		$deposit=0;
	}
	//$this->data['total_saldo'] = $saldo;
	$this->data['total_deposit'] = $deposit;
    $this->data['deposit_data'] = $this->M_komisi->get_history_deposit($filter, $field, 10, $offset);
    $this->data['deposit_counts'] = $this->M_komisi->count_all_history_deposit($filter, $field);
    $this->data['export_data'] = json_encode($this->M_komisi->get_history_deposit($filter, $field, "", "", "array"));

    $config = [
      'base_url'     => 'users/deposit',
      'total_rows'   => $this->M_komisi->count_all_history_deposit($filter, $field),
      'per_page'     => 10,
      'uri_segment'  => 4,
    ];
	
    //$this->data['pagination'] = $this->pagination($config);
	$this->data['title'] ='Family Package | Bocorocco Pillow Concept';
    //$this->template->title('Komisi List');
	$this->template->load('template', 'users/komisi/v_listdeposit', $this->data);
    //$this->render('backend/standart/administrator/reseller/reseller_list', $this->data);
  }
  public function info_komisi($offset = 0)
  {
    $filter = $this->input->get('q');
    $field   = $this->input->get('f');
    $this->data['peringkat'] = $this->M_komisi->get_peringkat();
    $this->data['komisi_data'] = $this->M_komisi->get_komisi_periode();//$this->M_komisi->get($filter, $field, 10, $offset);
	$this->data['data_royalti'] = $this->M_komisi->GetOmsetPribadiGroup($this->session->userdata('user_id'),'op_periode',date('Y-m-d'));
    /*$this->data['komisi_counts'] = $this->M_komisi->count_all($filter, $field);
	$this->data['total_saldo'] = $this->M_komisi->total_saldo();
    $this->data['export_data'] = json_encode($this->M_komisi->get($filter, $field, "", "", "array"));

    $config = [
      'base_url'     => 'users/komisi',
      'total_rows'   => $this->M_komisi->count_all($filter, $field),
      'per_page'     => 10,
      'uri_segment'  => 4,
    ];*/
	
    //$this->data['pagination'] = $this->pagination($config);
	$this->data['title'] ='Info Komisi | Bocorocco Pillow Concept';
    //$this->template->title('Komisi List');
	$this->template->load('template', 'users/komisi/v_listinfokomisi', $this->data);
    //$this->render('backend/standart/administrator/reseller/reseller_list', $this->data);
  }
    public function rincianinfokomisi()
  {
    //$this->is_allowed('adjustment_stok_view');

    $this->data['title'] ='Rincian Info Komisi | Bocorocco Pillow Concept';
	$id =$this->input->get('id', TRUE);
	$periode =$this->input->get('periode', TRUE);
	$this->data['komisi_data'] = $this->M_komisi->get_komisi_detail_periode($id,$periode);
    //$this->template->title('Komisi List');
	$this->template->load('template', 'users/komisi/v_rincianinfokomisi', $this->data);

    //$this->template->title('Adjustment Stok Detail');
    //$this->render('backend/standart/administrator/adjustment_stok/adjustment_stok_view', $this->data);
  }
  public function request_withdraw()
  {
	$cek=$this->M_komisi->total_saldo();
	if($cek){
		$saldo=$cek->saldo;
	}else{
		$saldo=0;
	}
	$this->data['total_saldo'] = $saldo;
	$this->data['title'] ='Request Withdraw | Bocorocco Pillow Concept';
	$this->template->load('template', 'users/komisi/v_requestwithdraw', $this->data);
    //$this->render('backend/standart/administrator/reseller/reseller_list', $this->data);
  }
   public function save_withdraw()
  {
    $this->form_validation->set_rules('jml_saldo', 'jml_saldo', 'required|trim');
    $this->form_validation->set_rules('saldo_penarikan', 'saldo_penarikan', 'required|trim');
    //$this->form_validation->set_rules('alasan', 'alasan', 'required|trim');
	$vjml=$this->input->post('jml_saldo', true);
	$vpenarikan=$this->input->post('saldo_penarikan', true);
	//var_dump($vjml.'-'.$vpenarikan);exit();
	if($vpenarikan > $vjml || $vjml < 50000){
		$data = [
        'error' => 'Saldo tidak mencukupi',
        'title' => 'Request Withdraw | Bocorocco Pillow Concept',
		'total_saldo' => $this->input->post('jml_saldo', true),
      ];
      $this->template->load('template', 'users/komisi/v_requestwithdraw', $data);
	}else if($vpenarikan < 50000){
		$data = [
        'error' => 'Penarikan saldo harus lebih besar dari Rp. 50.000',
        'title' => 'Request Withdraw | Bocorocco Pillow Concept',
		'total_saldo' => $this->input->post('jml_saldo', true),
      ];
      $this->template->load('template', 'users/komisi/v_requestwithdraw', $data);
	}else{
		if ($this->form_validation->run() == false) {

		  $data = [
			'error' => (validation_errors() ? validation_errors() : $this->session->flashdata('error')),
			'title' => 'Request Withdraw | Bocorocco Pillow Concept',
		  ];
		 
		  $this->template->load('template', 'users/komisi/v_requestwithdraw', $data);
		} else {
		  /*Tf langsung komisi*/
			date_default_timezone_set('Asia/Jakarta');
			$harian = date("Y-m-d"); //harian
			$external_id = date("YmdHis");//date("Ymd");
			$id=$this->ion_auth->user()->row()->id;
			$komisi_langsung=$this->input->post('saldo_penarikan', true);
			$sisa_saldo=$vjml-$komisi_langsung;
			$save_data_komisi = [
				'user_id' => $id,
				'harian' => $harian,
				'tahun' => $this->left($harian,4),
				'saldo' => $komisi_langsung,
				'external_id' => $external_id.$id.$komisi_langsung,
				'jns_komisi' => 'Withdraw'
			];
			$this->M_komisi->save_komisi_reseller($save_data_komisi);
			$exs_id=$external_id.$id.$komisi_langsung;
			$this->kirim_disbursement_xendit($id,$komisi_langsung,$exs_id,'Withdraw '.$komisi_langsung,$sisa_saldo);
			/*end komisi langsung*/
		  $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
		 Request Withdraw Berhasil</div>');
		  redirect(base_url() . 'users/withdraw');
		}
	}
  }
  function left($str, $length) {
     return substr($str, 0, $length);
}
 
function right($str, $length) {
     return substr($str, -$length);
}
  function kirim_disbursement_xendit($id,$saldo,$external_id,$jns_komisi,$sisa_saldo){
	$m=$external_id;
	$reference= 'DIST/'.date('Ymd').'/'.$m.'/'.strtoupper(random_string('alnum', 4));
	$this->db->select('bank,norek,first_name,last_name,email');
	$this->db->where('id',$id);
	$this->db->where('norek is not null');
	//$this->db->order_by('id_detail');
	$v_komisi = $this->db->get('users')->result();
		
	  if($v_komisi){
           $data = array();  
           foreach($v_komisi as $r)  
           {
			$biaya_admin=10000;
			$amountPPN=(5/100)*$saldo;
			//$jumlah_bayar=($saldo-$amountPPN)-$biaya_admin;
			$jumlah_bayar=$saldo-$biaya_admin;
			$data_detail=array(
				'amount' => (int)$jumlah_bayar,
				'bank_code' => $r->bank,
				'account_holder_name' => $r->first_name.' '.$r->last_name,
				'account_number' => $r->norek,
				'description' => $jns_komisi.', Potongan biaya admin Rp 10.000',
				'external_id' => $external_id,
				'X-IDEMPOTENCY-KEY' => $external_id,
				'email_to' => array($r->email),
				'email_cc' => array('it@bocorocco-italia.com')
			);
                //array_push($data,$data_detail);
			$headers = array();
			$headers[] = 'Content-Type: application/json';
			//$end_point = $this->server_domain . '/v2/invoices/' . $invoice_id;
			$end_point = $this->server_domain . '/disbursements';			
			$payload = json_encode($data_detail);
			//var_dump($payload);exit();
			$curl = curl_init();
			curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($curl, CURLOPT_USERPWD, $this->secret_api_key . ":");
			curl_setopt($curl, CURLOPT_URL, $end_point);
			curl_setopt($curl, CURLOPT_POST, true);
			curl_setopt($curl, CURLOPT_POSTFIELDS, $payload);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			$response = curl_exec($curl);
			curl_close($curl);
			$responseObject = json_decode($response, true); 
			//var_dump($responseObject);
			$savests = [
				'id_item_disbursement' => $responseObject['id'],
				'reference' => $reference,
				'sts_bayar' => $responseObject['status']
			  ];
			  $this->change_sts_komisi($responseObject['external_id'], $savests);
			  
			$change_saldo = [
				'saldo' => $sisa_saldo,
			  ];
			  $this->change_saldo($id, $change_saldo);
           }
			/*$batch=array(
				'reference' => $reference,
				'disbursements' => $data,
				
			);*/
			//echo(json_encode($batch));
		  echo 'ada';
	  }else{
		  echo 'tidak ada';
	  }
	  //var_dump($v_komisi);
	  //exit();
}
public function get_banks_available(){
         //array_push($data,$data_detail);
			$headers = array();
			$headers[] = 'Content-Type: application/json';
			//$end_point = $this->server_domain . '/v2/invoices/' . $invoice_id;
			$end_point = $this->server_domain . '/available_disbursements_banks';			
			//$payload = json_encode($data_detail);
			//var_dump($payload);exit();
			$curl = curl_init();
			curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($curl, CURLOPT_USERPWD, $this->secret_api_key . ":");
			curl_setopt($curl, CURLOPT_URL, $end_point);
			curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET' );
			//curl_setopt($curl, CURLOPT_POST, true);
			//curl_setopt($curl, CURLOPT_POSTFIELDS, $payload);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			$response = curl_exec($curl);
			curl_close($curl);
			$responseObject = json_decode($response, true); 
			if(count($responseObject) > 0){
			    foreach($responseObject as $data) {
			     //var_dump($data['code']."#".$data['name']);exit();
			      $insertItem[] = [
                    'code_bank' => $data['code'],
                    'name_bank' => $data['name']
                  ];
			    }
			    $this->db->insert_batch('tb_banks', $insertItem);
			}
			var_dump($responseObject);exit();
}
  public function change_saldo($id = NULL, $data = array())
    {
        $this->db->where('user_id', $id);
        $this->db->update('tb_wallet', $data);

        return $this->db->affected_rows();
    }
  public function change_sts_komisi($id = NULL, $data = array())
    {
        $this->db->where('external_id', $id);
        $this->db->update('tb_komisi_reseller', $data);

        return $this->db->affected_rows();
    }
  public function rincianpesanan()
  {
	$id=$this->input->get('id', TRUE);
	$periode=$this->input->get('periode', TRUE);
	$kode_order=$this->input->get('kode_order', TRUE);
	/*$start=$this->input->get('start', TRUE);
	$end=$this->input->get('end', TRUE);*/
	
    //$this->data['pesanan_data'] = $this->M_komisi->get_pesanan($id,$start,$end);
	$this->data['pesanan_data'] = $this->M_komisi->get_pesanan($id,$periode,$kode_order);
	$this->data['title'] ='Pesanan | Bocorocco Pillow Concept';
    //$this->template->title('Komisi List');
	$this->template->load('template', 'users/komisi/v_listpesanan', $this->data);
    //$this->render('backend/standart/administrator/reseller/reseller_list', $this->data);
  }
  public function orderDetail($id)
  {
    $data_order =  $this->M_order->get_orderDetail($id)->row_array();
    if ($data_order) {
      /*if ($data_order['user_id'] != $this->ion_auth->user()->row()->id) {
        redirect('/404_override');
      } else {
        $order = $data_order;
      }*/
	  $order = $data_order;
    } else {
      redirect('/404_override');
    }
    $data = [
      'title' => 'Detail Order | Bocorocco Pillow Concept',
      'order' => $order,
      'item_order' => $this->M_order->get_itemOrder($id)->result()
    ];
    // var_dump($data);
    $this->template->load('template', 'order/v_order', $data);
  }
public function pagination($config = [])
  {
	//  var_dump(site_url($config['base_url']));exit();
    $this->load->library('pagination');

    $config = [
      'suffix'           => isset($_GET) ? '?' . http_build_query($_GET) : '',
      'base_url'         => site_url($config['base_url']),
      'total_rows'       => $config['total_rows'],
      'per_page'         => $config['per_page'],
      'uri_segment'      => $config['uri_segment'],
      'num_links'        => 1,
      'num_tag_open'     => '<li>',
      'num_tag_close'    => '</li>',
      'full_tag_open'    => '<ul class="pagination">',
      'full_tag_close'   => '</ul>',
      'first_link'       => 'First',
      'first_tag_open'   => '<li>',
      'first_tag_close'  => '</li>',
      'last_link'        => 'Last',
      'last_tag_open'    => '<li>',
      'last_tag_close'   => '</li>',
      'next_link'        => 'Next',
      'next_tag_open'    => '<li>',
      'next_tag_close'   => '</li>',
      'prev_link'        => 'Prev',
      'prev_tag_open'    => '<li>',
      'prev_tag_close'   => '</li>',
      'cur_tag_open'     => '<li class="active"><a href="#">',
      'cur_tag_close'    => '</a></li>',
    ];

    $this->pagination->initialize($config);

    return  '<center>' . $this->pagination->create_links() . '</center>';
  }
  /**
   * Add new adjustment_stoks
   *
   */
  public function add()
  {
    $this->is_allowed('adjustment_stok_add');

    $this->data['products'] = $this->db->order_by('nama_barang', 'ASC')->get('product')->result();


    $this->template->title('Adjustment Stok New');
    $this->render('backend/standart/administrator/adjustment_stok/adjustment_stok_add', $this->data);
  }

  /**
   * Add New Adjustment Stoks
   *
   * @return JSON
   */
  public function add_save()
  {
    if (!$this->is_allowed('adjustment_stok_add', false)) {
      echo json_encode([
        'success' => false,
        'message' => cclang('sorry_you_do_not_have_permission_to_access')
      ]);
      exit;
    }

    $this->form_validation->set_rules('store_id', 'store ', 'trim|required|max_length[11]');
    // $this->form_validation->set_rules('no_ref', 'no ref', 'trim|required|max_length[11]');
    $this->form_validation->set_rules('keterangan', 'keterangan', 'trim|required');
    $this->form_validation->set_rules('type', 'type', 'trim|required');
    $this->form_validation->set_rules('product[]', 'Product', 'trim|required');
    $this->form_validation->set_rules('actual_stok[]', 'Actual stok', 'trim|required');
    $this->form_validation->set_rules('product_attribute[]', 'Size', 'trim|required');


    if ($this->form_validation->run()) {

      $ref = 'ADJ/' . $this->input->post('store_id') . '/' . time();

      $save_data = [
        'store_id' => $this->input->post('store_id'),
        'no_ref' => $ref,
        'type' => $this->input->post('type'),
        'keterangan' => $this->input->post('keterangan'),
        'user_id' => $this->aauth->get_user()->id,
      ];


      $save_adjustment_stok = $this->model_adjustment_stok->store($save_data);

      if ($save_adjustment_stok) {
        $save_adjustment_stok_id = $this->db->insert_id();

        $product_id = $this->input->post('product');
        foreach ($product_id as $key_product => $product) {
          $id_product_attribute = $this->input->post('product_attribute')[$key_product];
          $attributeAdd = $this->db->where(['id_stok' => $id_product_attribute])->get('product_stok')->row();
          $insertItem[] = [
            'actual_stok' => $this->input->post('actual_stok')[$key_product],
            'stok_id' => $id_product_attribute,
            'in_stok' =>  $attributeAdd->jumlah_stok,
            'adjustment_id' =>  $save_adjustment_stok_id
          ];
        }

        $this->db->insert_batch('adjustment_stok_item', $insertItem);


        if ($this->input->post('save_type') == 'stay') {
          $this->data['success'] = true;
          $this->data['id']      = $save_adjustment_stok;
          $this->data['message'] = cclang('success_save_data_stay', [
            anchor('administrator/adjustment_stok/edit/' . $save_adjustment_stok, 'Edit Adjustment Stok'),
            anchor('administrator/adjustment_stok', ' Go back to list')
          ]);
        } else {
          set_message(
            cclang('success_save_data_redirect', [
              anchor('administrator/adjustment_stok/edit/' . $save_adjustment_stok, 'Edit Adjustment Stok')
            ]),
            'success'
          );

          $this->data['success'] = true;
          $this->data['redirect'] = base_url('administrator/adjustment_stok');
        }
      } else {
        if ($this->input->post('save_type') == 'stay') {
          $this->data['success'] = false;
          $this->data['message'] = cclang('data_not_change');
        } else {
          $this->data['success'] = false;
          $this->data['message'] = cclang('data_not_change');
          $this->data['redirect'] = base_url('administrator/adjustment_stok');
        }
      }
    } else {
      $this->data['success'] = false;
      $this->data['message'] = validation_errors();
    }

    echo json_encode($this->data);
  }

  /**
   * Update view Adjustment Stoks
   *
   * @var $id String
   */
  public function edit($id)
  {
    //$this->is_allowed('adjustment_stok_update');

    $this->data['reseller_user'] = $this->model_reseller->find($id);
    $this->data['reseller_data'] = $this->db->where(['user_id' => $id])->select('user_id,id_peringkat,refertouser_id')
      ->get('tb_reseller')->result();
   // $this->data['products'] = $this->db->order_by('nama_barang', 'ASC')->get('product')->result();
//var_dump($this->data['reseller_data']);die;
    $this->template->title('Reseller Update');
    $this->render('backend/standart/administrator/reseller/reseller_approve', $this->data);
  }

  /**
   * Update Adjustment Stoks
   *
   * @var $id String
   */
  public function edit_save($id)
  {
    /*if (!$this->is_allowed('adjustment_stok_update', false)) {
      echo json_encode([
        'success' => false,
        'message' => cclang('sorry_you_do_not_have_permission_to_access')
      ]);
      exit;
    }*/

    // $this->form_validation->set_rules('stok_id', 'Stok Id', 'trim|required|max_length[11]');
    // $this->form_validation->set_rules('in_stok', 'In Stok', 'trim|required|max_length[11]');
    // $this->form_validation->set_rules('actual_stock', 'Actual Stock', 'trim|required|max_length[11]');
    // $this->form_validation->set_rules('status_adjustment', 'Status Adjustment', 'trim|required|max_length[50]');

    $this->form_validation->set_rules('peringkat', 'peringkat ', 'trim|required|max_length[11]');
    // $this->form_validation->set_rules('no_ref', 'no ref', 'trim|required|max_length[11]');
    //$this->form_validation->set_rules('toreffer', 'toreffer', 'trim|required');
    $this->form_validation->set_rules('username', 'username', 'trim|required');
    /*if (count($this->input->post('product')) <= 0) {

      $this->form_validation->set_rules('product[]', 'Product', 'trim|required');
    }
    if (count($this->input->post('actual_stok')) <= 0) {

      $this->form_validation->set_rules('actual_stok[]', 'actual stok', 'trim|required');
    }
    if (count($this->input->post('product_attribute')) <= 0) {
      $this->form_validation->set_rules('product_attribute[]', 'product attribute', 'trim|required');
    }*/

    if ($this->form_validation->run()) {
     // $ref = 'ADJ/' . $this->input->post('store_id') . '/' . time();
	 
	  $cek=$this->model_reseller->find_reseller($id);
	  if($cek){
		$updatedata = [
				'username' => $this->input->post('username')
			  ];
		$updateuser = $this->model_reseller->change_username($id, $updatedata);
		
		  $save_data = [
			'id_peringkat' => $this->input->post('peringkat'),
			'refertouser_id' => $this->input->post('toreffer'),
		  ];
		$save_adjustment_stok = $this->model_reseller->change_peringkat($id, $save_data);
	  }else{
		  $valid_username=$this->model_reseller->find_username($id,$this->input->post('username'));
			//var_dump($valid_username);exit();
		  if($valid_username){
			 $this->data['success'] = false;
			 $this->data['message'] = 'Username harus unik';
			 $this->data['redirect'] = base_url('administrator/reseller');
			 echo json_encode($this->data);die;
		 }else{
			 $updatedata = [
				'username' => $this->input->post('username')
			  ];
			$updateuser = $this->model_reseller->change_username($id, $updatedata);
		 }
		 $dataUpdate = [
			'sts_reseller' => '1'
		  ];
		  $this->model_reseller->change($id, $dataUpdate);
		  
		  $save_data = [
			'user_id' => $id,
			'tgl_peringkat' => date('Y-m-d'),
			'id_peringkat' => $this->input->post('peringkat'),
			'refertouser_id' => $this->input->post('toreffer'),
		  ];
		$save_adjustment_stok = $this->model_reseller->save_reseller($save_data);
	  }
      

      if ($save_adjustment_stok) {
		 //$this->send_email('teaebe@gmail.com');
		 
        /*$adjustment_info = $this->db->get_where('adjustment_stok', ['id_adjustment_stok' => $id])->row();
        foreach (array_filter($this->input->post('product')) as $key_product => $product) {
          $stok_id = $this->input->post('product_attribute')[$key_product];
          $cek_ajusment_items = $this->db->get_where('adjustment_stok_item', ['adjustment_id' => $id, 'stok_id' => $stok_id])->row();
          if (!empty($cek_ajusment_items)) {
            $update_productstok = array(
              'actual_stok' => $this->input->post('actual_stok')[$key_product],
            );
            $this->db->where('id_adjustment_stok_item', $cek_ajusment_items->id_adjustment_stok_item);
            $this->db->update('adjustment_stok_item', $update_productstok);
          } else {
            $attributeAdd = $this->db->where(['id_stok' => $stok_id])->get('product_stok')->row();

            $daveDataIte = [
              'actual_stok' => $this->input->post('actual_stok')[$key_product],
              'stok_id' => $attributeAdd->id_stok,
              'in_stok' =>  $attributeAdd->jumlah_stok,
              'adjustment_id' =>  $id
            ];

            $this->db->insert('adjustment_stok_item', $daveDataIte);
          }
        }*/



        if ($this->input->post('save_type') == 'stay') {
          $this->data['success'] = true;
          $this->data['id']      = $id;
          $this->data['message'] = cclang('success_update_data_stay', [
            anchor('administrator/reseller', ' Go back to list')
          ]);
        } else {
          set_message(
            cclang('success_update_data_redirect', []),
            'success'
          );

          $this->data['success'] = true;
          $this->data['redirect'] = base_url('administrator/reseller');
        }
      } else {
        if ($this->input->post('save_type') == 'stay') {
          $this->data['success'] = false;
          $this->data['message'] = cclang('data_not_change');
        } else {
          $this->data['success'] = false;
          $this->data['message'] = cclang('data_not_change');
          $this->data['redirect'] = base_url('administrator/reseller');
        }
      }
    } else {
      $this->data['success'] = false;
      $this->data['message'] = validation_errors();
    }

    echo json_encode($this->data);
  }

  /**
   * delete Adjustment Stoks
   *
   * @var $id String
   */
  public function delete($id = null)
  {
    $this->is_allowed('adjustment_stok_delete');

    $this->load->helper('file');

    $arr_id = $this->input->get('id');
    $remove = false;

    if (!empty($id)) {
      $remove = $this->_remove($id);
    } elseif (count($arr_id) > 0) {
      foreach ($arr_id as $id) {
        $remove = $this->_remove($id);
      }
    }

    if ($remove) {
      set_message(cclang('has_been_deleted', 'adjustment_stok'), 'success');
    } else {
      set_message(cclang('error_delete', 'adjustment_stok'), 'error');
    }

    // redirect_back();
    return redirect('administrator/adjustment_stok');
  }

  /**
   * View view Adjustment Stoks
   *
   * @var $id String
   */
  public function rinciankomisi()
  {
    //$this->is_allowed('adjustment_stok_view');

    $this->data['title'] ='Rincian Komisi | Bocorocco Pillow Concept';
	$this->data['id'] =$this->input->get('id', TRUE);
	$this->data['periode'] =$this->input->get('periode', TRUE);
	/*$this->data['start'] =$this->input->get('start', TRUE);
	$this->data['end'] =$this->input->get('end', TRUE);*/
	$this->data['saldo'] =$this->input->get('saldo', TRUE);
	/*$this->data['minggu'] =$this->input->get('minggu', TRUE);*/
	$this->data['sts'] =$this->input->get('sts', TRUE);
	$this->data['kode_order'] =$this->input->get('kode_order', TRUE);
    //$this->template->title('Komisi List');
	$this->template->load('template', 'users/komisi/v_rinciankomisi', $this->data);

    //$this->template->title('Adjustment Stok Detail');
    //$this->render('backend/standart/administrator/adjustment_stok/adjustment_stok_view', $this->data);
  }

  /**
   * delete Adjustment Stoks
   *
   * @var $id String
   */
  private function _remove($id)
  {
    $adjustment_stok = $this->model_adjustment_stok->find($id);



    return $this->model_adjustment_stok->remove($id);
  }


  /**
   * Export to excel
   *
   * @return Files Excel .xls
   */
  public function export()
  {
    $this->is_allowed('adjustment_stok_export');

    $data = $this->input->post("data_export");

    $this->model_adjustment_stok->export('adjustment_stok', 'adjustment_stok', $data);
  }

  /**
   * Export to PDF
   *
   * @return Files PDF .pdf
   */
  public function export_pdf()
  {
    $this->is_allowed('adjustment_stok_export');

    $this->model_adjustment_stok->pdf('adjustment_stok', 'adjustment_stok');
  }


  public function approvereseller($id)
  {
	$this->send_email('teaebe@gmail.com');
    //$this->is_allowed('approve_adjustment');

    /*$cekData = $this->db->where(['id' => $id])->get('users')->row(); //ada

    if (!$cekData) {
      echo json_encode([
        'success' => false,
        'message' => 'Data Tidak Tersedia'
      ]);
      exit;
    } else {

      $dataUpdate = [
        'sts_reseller' => '1',
        //'approved_at' => date('Y-m-d H:i:s'),
        //'approved_by' => $this->aauth->get_user()->id,
      ];
      $this->db->where('id', $id);
      $this->db->update('users', $dataUpdate);*/

      /*$dataItem = $this->db->where(['adjustment_id' => $id])->get('adjustment_stok_item')->result();

      foreach ($dataItem as $item) {
        $dataStock = $this->db->where('id_stok', $item->stok_id)->get('product_stok')->row();

        $dataUpdate = $item->actual_stok + $dataStock->jumlah_stok;

        $updateStok = [
          'jumlah_stok' => $dataUpdate,
        ];

        $this->db->where('id_stok', $item->stok_id);
        $this->db->update('product_stok', $updateStok);


        $saveLog = [
          'product_stok_id' => $item->stok_id,
          'qty_order_item' => $item->actual_stok,
          'before_stok' => $item->in_stok,
          'after_stok' => $dataUpdate,
          'type' => 'ADJUSTMENT STOK',
          'updated_by' =>  $this->aauth->get_user()->id,
          'ref' => $cekData->no_ref
        ];

        $this->db->insert('order_log_stok', $saveLog);
      }*/
	  
	  
      /*set_message( //ada
        cclang('success_update_data_redirect', []),
        'success'
      );

      $this->data['success'] = true;
      return redirect('administrator/reseller');
    }*/
  }
public function send_email($tujuan)
  {
    if (empty($this->session->userdata('id'))) {
      redirect('administrator/reseller');
    }

    $this->load->library('parser');

    $config = array();

    $config['protocol'] = 'smtp';

    $config['smtp_host'] = 'ssl://smtp.gmail.com';//'ssl://mail.graphie.co.id';

    $config['smtp_user'] = 'it@bocorocco-italia.com';//'info@graphie.co.id';

    $config['smtp_pass'] = 'yeni1986';//'ZMqE25htnE';

    $config['smtp_port'] = 465;//4465;

    $config['mailtype'] = 'html';

    $config['charset'] = 'utf-8';

    $config['wordwrap'] = TRUE;

    $this->load->library('email', $config);

    $this->email->initialize($config);

    $this->email->set_newline("\r\n");

    $web_name = $this->db->get_where('webinformations', ['id_webinformations' => 1])->row()->name_web;

    /*$order_info = $this->db->get_where('order', ['id_order' => $order_id])->row();

    $orderitems_info = $this->model_offline_sales->get_detailorder_info_ByOrderID($order_id);

    $spg_info = $this->db->get_where('aauth_users', ['id' => $order_info->created_by])->row();

    $store_info = $this->db->get_where('store', ['id_store' => $spg_info->store_id])->row();

    if (!empty($order_info->alaman_order) && $order_info->alaman_order != '-') {
      $alamat = $order_info->alaman_order . '<br>';
    } else {
      $alamat = $store_info->alamat . ' ' . $store_info->kota . '<br>';
    }

    if (!empty($order_info->kode_pos)) {
      $kode_pos = $order_info->kode_pos . '<br>';
    } else {
      $kode_pos = '';
    }

    if (!empty($order_info->email_order) && $order_info->email_order != '-') {
      $email = 'Email : ' . $order_info->email_order . '<br>';
    } else {
      $email = '';
    }

    if (!empty($order_info->phone_order) && $order_info->phone_order != 0) {
      $phone = 'Phone : ' . $order_info->phone_order;
    } else {
      $phone = 'Phone : ' . $store_info->telepon;
    }

    if (!empty($store_info->alamat)) {
      $alamat_store = $store_info->alamat . ' ';
    } else {
      $alamat_store = '';
    }

    if (!empty($store_info->kota)) {
      $kota_store = $store_info->kota . '<br>';
    } else {
      $kota_store = '';
    }

    if (!empty($store_info->email)) {
      $email_store = 'Email : ' . $store_info->email . '<br>';
    } else {
      $email_store = '';
    }

    if (!empty($store_info->telepon)) {
      $phone_store = 'Phone : ' . $store_info->telepon;
    } else {
      $phone_store = '';
    }

    $num = 1;
    $order_itemnya = '';
    if (!empty($orderitems_info)) {
      foreach ($orderitems_info as $order_items) {
        $order_itemnya .= '<tr>
                <td class="text-center">' . $num++ . '</td>
                <td class="text-center">' . $order_items->nama_barang . '</td>
                <td class="text-center">' . $order_items->qty . '</td>
                <td class="text-center">' . $order_items->diskon . '</td>
                <td class="text-right">' . number_format($order_items->harga, 2) . '</td>
                <td class="text-right">' . number_format($order_items->sub_total, 2) . '</td>
                </tr>';
      }
      $order_itemnya .= '<tr>
                <td colspan="5" class="text-right">Subtotal (Rp.)</td>
                <td class="text-right">Rp. ' . number_format($order_info->subtotal, 2) . '</td>
            </tr>
            <tr>
                <td colspan="5" class="text-right">Tax Amount (Rp.)</td>
                <td class="text-right">Rp. ' . number_format($order_info->tax_amount, 2) . '</td>
            </tr>
            <tr>
                <td colspan="5" class="text-right">Voucher (Rp.)</td>
                <td class="text-right">Rp. ' . number_format($order_info->diskon_voucher, 2) . '</td>
            </tr>
            <tr>
                <td colspan="5" class="text-right"><strong>Total (Rp.)</strong></td>
                <td class="text-right"><strong>Rp. ' . number_format($order_info->total_bayar, 2) . '</strong></td>
            </tr>';
    }

    $data = array(
      'date' => date('d F Y H:i', strtotime($order_info->created_at)),
      'order_code' => $order_info->kode_order,
      'status_order' => $order_info->status_order,
      'nama_order' => $order_info->nama_order,
      'alamat' => $alamat,
      'kode_pos' => $kode_pos,
      'email' => $email,
      'phone' => $phone,
      'nama_store' => $store_info->nama_store,
      'alamat_store' => $alamat_store,
      'kota_store' => $kota_store,
      'email_store' => $email_store,
      'phone_store' => $phone_store,
      'order_items' => $order_itemnya,
      'site_name' => $web_name,
      'logo' => '<img src="' . BASE_ASSET . 'logo/1609746639-logos.png" alt="' . $web_name . '" width="200px"/>',
    );
*/
	$data = array(
		'tes' => 'testing',
		'logo' => '<img src="' . BASE_ASSET . 'logo/1609746639-logos.png" alt="' . $web_name . '" width="200px"/>',
	);
    $html = $this->parser->parse('backend/standart/administrator/reseller/approve.html', $data);

    // $recipients = 'myolandh@gmail.com';

    $recipients = $tujuan;//$order_info->email_order;

    $this->email->from('it@bocorocco-italia.com', 'Administrator Bocorocco');

    $this->email->to($recipients);

    $this->email->subject('New email from Bocorocco');

    $this->email->message($html);

    if ($this->email->send()) {
      redirect('administrator/reseller');
    } else {
      echo $this->email->print_debugger();
      exit();
    }
  }
  public function option_stok()
  {
    $cekStok = [];
    if (!empty($this->input->get("key"))) {
      if ($this->aauth->get_user()->store_id) {
        $cekStok = $this->db->where(['product_stok.id_store' => $this->aauth->get_user()->store_id])
          ->join('product', 'product.id_product = product_stok.id_product')
          ->join('store', 'store.id_store = product_stok.id_store')
          ->join('product_attribute', 'product_attribute.id_product_attribute = product_stok.id_product_attribute')
          ->where('product.nama_barang LIKE "%' . $this->input->get("key") . '%" OR product_stok.tahun_produksi LIKE "%' . $this->input->get("key") . '%" OR store.nama_store LIKE "%' . $this->input->get("key") . '%"')
          ->get('product_stok')->result();
      } else {
        $cekStok = $this->db->join('product', 'product.id_product = product_stok.id_product')
          ->join('store', 'store.id_store = product_stok.id_store')
          ->join('product_attribute', 'product_attribute.id_product_attribute = product_stok.id_product_attribute')
          ->where('product.nama_barang LIKE "%' . $this->input->get("key") . '%" OR product_stok.tahun_produksi LIKE "%' . $this->input->get("key") . '%" OR store.nama_store LIKE "%' . $this->input->get("key") . '%"')
          ->get('product_stok')->result();
      }
    }
    echo json_encode($cekStok);
  }

  public function input_instok()
  {
    $stok_id = $this->input->post('stok_id');
    if ($this->aauth->get_user()->store_id) {
      $product_stok = $this->db->where(['product_stok.id_store' => $this->aauth->get_user()->store_id])
        ->join('product', 'product.id_product = product_stok.id_product')
        ->join('store', 'store.id_store = product_stok.id_store')
        ->where('product_stok.id_stok', $stok_id)
        ->get('product_stok')->row();
    } else {
      $product_stok = $this->db->join('product', 'product.id_product = product_stok.id_product')
        ->join('store', 'store.id_store = product_stok.id_store')
        ->where('product_stok.id_stok', $stok_id)
        ->get('product_stok')->row();
    }
    $stok = '';
    if (!empty($product_stok)) {
      $stok = $product_stok->jumlah_stok;
    }
    echo json_encode($stok);
  }
  function convert_date_utc($date, $format = 'Y-m-d H:i:s'){
    $tz1 = 'UTC';
    $tz2 = 'Asia/Jakarta'; // UTC +7

    $d = new DateTime($date, new DateTimeZone($tz1));
    $d->setTimeZone(new DateTimeZone($tz2));

    return $d->format($format);
  }
}


/* End of file adjustment_stok.php */
/* Location: ./application/controllers/administrator/Adjustment Stok.php */