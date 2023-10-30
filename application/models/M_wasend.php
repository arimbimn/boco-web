<?php

defined('BASEPATH') or exit('No direct script access allowed');

class M_wasend extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
  }


  public function sendWa($number, $message)
  {
	$number = cekPhoneNumber($number);
    /*$apisetting = $this->db->order_by('id_set_api', 'desc')->get('sendwa_set_api')->row();
    $curl = curl_init();
    $dataSend = [
      'phone' => $number,
      'body' => $message,
    ];
    $dataSend = json_encode($dataSend);
    curl_setopt_array($curl, array(
      CURLOPT_URL => "$apisetting->api_url/sendMessage?token=$apisetting->token",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => $dataSend,
      CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json'
      ),
    ));
    $response = curl_exec($curl);
    $testponResult = json_decode($response, true);
    curl_close($curl);*/
    // echo $response;
    // die;
	$token='nvDEcmbVuuJJqZg6JyxieJigKyD3mH1PrmkgZ493XENgwifJ3p';
	$curl = curl_init();
	curl_setopt_array($curl, array(
		CURLOPT_URL => 'https://app.ruangwa.id/api/send_express',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_SSL_VERIFYPEER => false,
		CURLOPT_SSL_VERIFYHOST => false,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'POST',
		CURLOPT_POSTFIELDS => 'token='.$token.'&number='.$number.'&message='.$message,
		CURLOPT_HTTPHEADER => array('Content-Type:application/x-www-form-urlencoded'),
	));
	$response = curl_exec($curl);
	curl_close($curl);
	$testponResult = json_decode($response, true);
    $is_success = 0;

    if (isset($testponResult['id'])) {
      $status = $testponResult['status'];
	  $id_log = $testponResult['id'];
      if ($status === 'sent' && $id_log != '') {
        $is_success = 1;
      } else {
        $is_success = 0;
      }
    }

    $responsenya = $response;

    if (isset($testponResult['message'])) {
      $responsenya = $testponResult['message'];
    }

    $dataSave = [
      'no_hp' => $number,
      'message' => $message,
      'payload' => $responsenya,
      'is_success' => $is_success
    ];

    $this->db->insert('sendwa_logs', $dataSave);
    return null;
  }


  public function sendWaMedia($number, $caption, $file_url)
  {
	  //$file_url='https://bocorocco-online.com/assets/images/CARDS/Lamoour1960-DIAMOND.png';
	  $number = cekPhoneNumber($number);
    /*$apisetting = $this->db->order_by('id_set_api', 'desc')->get('sendwa_set_api')->row();
    $dataSend = [
      'phone' => $number,
      'caption' => $caption,
      'body' => $file_url,
      'filename' => 'card.png'
    ];
    $dataSend = json_encode($dataSend);
	$curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL =>  "$apisetting->api_url/sendFile?token=$apisetting->token",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS =>  $dataSend,
      CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json'
      ),
    ));
    $response = curl_exec($curl);
    curl_close($curl);
    // echo $response;
    $testponResult = json_decode($response, true);
	*/
	$tgl=date("Y-m-d");
	$jam=date("H:i:s");
	$token='nvDEcmbVuuJJqZg6JyxieJigKyD3mH1PrmkgZ493XENgwifJ3p';
	$curl = curl_init();
	curl_setopt_array($curl, array(
	  CURLOPT_URL => 'https://app.ruangwa.id/api/send_image',
	  CURLOPT_RETURNTRANSFER => true,
	  CURLOPT_SSL_VERIFYPEER => false,
	  CURLOPT_SSL_VERIFYHOST => false,
	  CURLOPT_ENCODING => '',
	  CURLOPT_MAXREDIRS => 10,
	  CURLOPT_TIMEOUT => 0,
	  CURLOPT_FOLLOWLOCATION => true,
	  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	  CURLOPT_CUSTOMREQUEST => 'POST',
	  CURLOPT_POSTFIELDS => "token=$token&number=$number&file=$file_url&caption=$caption&date=$tgl&time=$jam",
	  CURLOPT_HTTPHEADER => array('Content-Type:application/x-www-form-urlencoded'),
	));
	$response = curl_exec($curl);
	curl_close($curl);
	$testponResult = json_decode($response, true);
    $is_success = 0;

    if (isset($testponResult['id'])) {
      $status = $testponResult['status'];
	  $id_log = $testponResult['id'];
      if ($status === 'sent' && $id_log != '') {
        $is_success = 1;
      } else {
        $is_success = 0;
      }
    }

    $responsenya = $response;

    if (isset($testponResult['message'])) {
      $responsenya = $testponResult['message'];
    }

    $dataSave = [
      'no_hp' => $number,
      'message' => $caption,
      'payload' => $responsenya,
      'is_success' => $is_success,
      'is_media' => 1,
      'url_media' => $file_url
    ];
    
    /*$dataSave = [
      'no_hp' => $number,
      'message' => $caption,
      'payload' => "Belum dikirim",
      'is_success' => 0,
      'is_media' => 1,
      'url_media' => $file_url
    ];*/

    $this->db->insert('sendwa_logs', $dataSave);
    // echo $response;
    return null;
  }
}


// $curl = curl_init();

    // curl_setopt_array($curl, array(
    //   CURLOPT_URL => 'https://wa-ridwanganteng.herokuapp.com/send-media',
    //   CURLOPT_RETURNTRANSFER => true,
    //   CURLOPT_ENCODING => '',
    //   CURLOPT_MAXREDIRS => 10,
    //   CURLOPT_TIMEOUT => 0,
    //   CURLOPT_FOLLOWLOCATION => true,
    //   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //   CURLOPT_CUSTOMREQUEST => 'POST',
    //   CURLOPT_POSTFIELDS => "number=$number&caption=$caption&file_url=$file_url",
    //   CURLOPT_HTTPHEADER => array(
    //     'Content-Type: application/x-www-form-urlencoded'
    //   ),
    // ));

    // $response = curl_exec($curl);

    // curl_close($curl);
    // $testponResult = json_decode($response, true);
    
    
      // $curl = curl_init();

    // curl_setopt_array($curl, array(
    //   CURLOPT_URL => 'https://wa-ridwanganteng.herokuapp.com/send-message',
    //   CURLOPT_RETURNTRANSFER => true,
    //   CURLOPT_ENCODING => '',
    //   CURLOPT_MAXREDIRS => 10,
    //   CURLOPT_TIMEOUT => 0,
    //   CURLOPT_FOLLOWLOCATION => true,
    //   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //   CURLOPT_CUSTOMREQUEST => 'POST',
    //   CURLOPT_POSTFIELDS => "number=$number&message=$message",
    //   CURLOPT_HTTPHEADER => array(
    //     'Content-Type: application/x-www-form-urlencoded'
    //   ),
    // ));

    // $response = curl_exec($curl);

    // curl_close($curl);
    // $testponResult = json_decode($response, true);

    // $is_success = 0;

    // if (isset($testponResult['status'])) {
    //   $status = $testponResult['status'];
    //   if ($status == true) {
    //     $is_success = 1;
    //   } else {
    //     $is_success = 0;
    //   }
    // }

    // $responsenya = $response;

    // if (isset($testponResult['message'])) {
    //   $responsenya = $testponResult['message'];
    // }
