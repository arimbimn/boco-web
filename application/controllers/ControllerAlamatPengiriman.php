<?php

defined('BASEPATH') or exit('No direct script access allowed');

class ControllerAlamatPengiriman extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->ion_auth->logged_in()) {
            $this->session->set_flashdata('message', 'Login Terlebih Dahulu');
            redirect('login', 'refresh');
        } else {
            $this->load->model('Model_alamatPengiriman');
        }
    }

    public function get()
    {
        $alamatId = $this->input->get('id');

        $DataAlamat = $this->Model_alamatPengiriman->getByID($alamatId);
        echo json_encode($DataAlamat);
    }

    function add()
    {
        $user_id = ($this->session->userdata['user_id']);
        $query = $this->db->query("
        SELECT * 
        FROM tb_alamat_pengiriman
        WHERE user_id = '{$user_id}'
        ")->result();
        // Tambah Ke Database jika datanya kurang dari 3
        if (count($query) < 3) {
            $data_detail = array(
                'user_id' => $user_id,
                'label_alamat' => $_POST['label'],
                'penerima' => $_POST['receiver'],
                'provinsi_id' => $_POST['province'],
                'kota_id' => $_POST['city'],
                'kecamatan_id' => $_POST['subdistrict'],
                'detailAlamat' => $_POST['detail_address'],
                'kode_pos' => $_POST['postal_code'],
                'alamat' => $_POST['detail_address'] . ', Kec.' . $_POST['subdistrict_name'] . ', ' . $_POST['city_name'] . ', ' . $_POST['province_name'],
            );
            if (count($query) == 0) {
                $data_detail['main_address'] = "1";
            }
            $this->M_product->insert_data($data_detail);
            echo true;
        }
        echo false;
    }

    function edit()
    {
        $user_id = ($this->session->userdata['user_id']);
        $alamatId = $this->input->post('id');
        $data_detail = array(
            'user_id' => $user_id,
            'label_alamat' => $_POST['labelEdit'],
            'penerima' => $_POST['receiverEdit'],
            'provinsi_id' => $_POST['provinceEdit'],
            'kota_id' => $_POST['cityEdit'],
            'kecamatan_id' => $_POST['subdistrictEdit'],
            'detailAlamat' => $_POST['detail_addressEdit'],
            'kode_pos' => $_POST['postal_codeEdit'],
            'alamat' => $_POST['detail_addressEdit'] . ', Kec.' . $_POST['subdistrict_name'] . ', ' . $_POST['city_name'] . ', ' . $_POST['province_name'],
        );
        $this->M_product->update_data_alamat($alamatId, $data_detail);
    }

    function delete()
    {
        $id = $this->input->post('id');
        $this->Model_alamatPengiriman->delete($id);
        $data = $this->M_product->ambil_data_alamat();
        echo json_encode($data);
    }

    function set_default($id)
    {
        $user_id = $this->session->userdata('user_id');
        // var_dump($user_id);
        // exit();
        if (isset($user_id)) {
            $query1 = $this->db->query("
                UPDATE tb_alamat_pengiriman
                SET main_address = 0
                WHERE user_id = '{$user_id}'
            ");
            $query2 = $this->db->query("
                UPDATE tb_alamat_pengiriman
                SET main_address = 1
                WHERE id = '{$id}'
            ");
            // Check for errors in each query
            if ($query1 && $query2) {
                redirect(base_url('cart') . "?msg=Successfully set the default address!");
            }
        }
        redirect(base_url('cart') . "?msg=Failed to set the default address!");
    }

    function unset_default($id)
    {
        $user_id = $this->session->userdata('user_id');
        if (isset($user_id)) {
            $query1 = $this->db->query("
                UPDATE tb_alamat_pengiriman
                SET main_address = 0
                WHERE user_id = '{$user_id}' AND id = '{$id}'
            ");
            // Check for errors in each query
            if ($query1 ) {
                redirect(base_url('cart') . "?msg=Successfully set the default address!");
            }
        }
        redirect(base_url('cart') . "?msg=Failed to set the default address!");
    }


}
