<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_checkOngkir extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        // API RajaOngkir
        $this->rajaongkir_api_key = 'ff12c996461f51652eb12954d4be2e49';
        $this->rajaongkir_api_url = 'https://pro.rajaongkir.com/api/';
    }

    public function getOngkir($requestData)
    {
        $origin = 501;
        $originType = 'city';
        $destination = 501;
        $destinationType = 'city';
        $weight = 1000;
        $courier = 'jne';

        $requestData = [
            'origin' => $origin,
            'originType' => $originType,
            'destination' => $destination,
            'destinationType' => $destinationType,
            'weight' => $weight,
            'courier' => $courier
        ];

        return $this->fetchData("cost", $requestData, 'POST');
    }

    
    public function getDesiredCost($list_expedition_rajaongkir, $desired_expedition) {

        $desiredExpedition = explode(",", $desired_expedition);
        $desiredCode = $desiredExpedition[0]; //get expedition code
        $desiredService = $desiredExpedition[1]; //get service

        $result = array();

        foreach ($list_expedition_rajaongkir as $carrier) {
            if ($carrier['code'] === $desiredCode) {
                foreach ($carrier['costs'] as $cost) {
                    if ($cost['service'] === $desiredService) {
                        $result['costValue'] = $cost['cost'][0]['value'];
                        $result['etd'] = $cost['cost'][0]['etd'];
                        $result['note'] = $cost['cost'][0]['note'];
                        // Anda dapat menyimpan nilai ini dalam array atau kembalikan sebagai objek, sesuai kebutuhan aplikasi Anda
                        return $result;
                    }
                }
            }
        }
        // Jika tidak ditemukan cost sesuai kriteria
        return null;
    }

    public function getSubdistrict($cityId)
    {
        return $this->fetchData("subdistrict?city=$cityId");
    }

    public function getCity($provinceId)
    {
        return $this->fetchData("city?province=$provinceId");
    }

    public function getProvince()
    {
        return $this->fetchData("province");
    }


    private function fetchData($endpoint, $requestData = [], $method = 'GET')
    {
        $curl = curl_init();

        $method = strtoupper($method);
        $requestData = ($method === 'POST') ? http_build_query($requestData) : '';

        curl_setopt_array($curl, [
            CURLOPT_URL => $this->rajaongkir_api_url . $endpoint,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_POSTFIELDS => $requestData,
            CURLOPT_HTTPHEADER => [
                "key: " . $this->rajaongkir_api_key
            ],
        ]);

        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($curl);
        $error = curl_error($curl);

        curl_close($curl);

        if ($error) {
            return "cURL Error #: " . $error;
        } else {
            return json_decode($response, true);
        }
    }
}
