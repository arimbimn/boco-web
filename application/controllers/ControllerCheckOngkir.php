<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ControllerCheckOngkir extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_checkOngkir');
    }

    public function getOngkir()
    {
        // list jasa kirim
        $origin = $this->input->get('origin');
        $originType = $this->input->get('originType');
        $destination = $this->input->get('destination');
        $destinationType = $this->input->get('destinationType');
        $weight = $this->input->get('weight');
        $courier = $this->input->get('courier');

        $response = $this->Model_checkOngkir->getOngkir($origin, $originType, $destination, $destinationType, $weight, $courier);
        $this->outputResponse($response);
    }

    public function getSubdistrict()
    {
        $cityId = $this->input->get('city');
        $response = $this->Model_checkOngkir->getSubdistrict($cityId);
        $this->outputResponse($response);
    }

    public function getCity()
    {
        $provinceId = $this->input->get('province');
        $response = $this->Model_checkOngkir->getCity($provinceId);
        $this->outputResponse($response);
    }

    public function getProvince()
    {
        $response = $this->Model_checkOngkir->getProvince();
        $this->outputResponse($response);
    }

    private function outputResponse($response)
    {
        echo json_encode($response['rajaongkir']);
    }
}
