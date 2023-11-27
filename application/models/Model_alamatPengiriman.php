<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Model_alamatPengiriman extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        // Variabel validasi untuk CRUD berdasarkan user
        // $this->userId = ($this->session->userdata['user_id']);
    }
    
    public function getAll()
    {
        // $this->db->where('user_id', $this->userId);
        $this->db->limit(3); // Batasan jumlah hasil menjadi maksimal 3
        $query = $this->db->get('tb_alamat_pengiriman');
        return $query->result();
    }

    public function getByID($id)
    {
        // $this->db->where('user_id', $this->userId);
        $query = $this->db->get_where('tb_alamat_pengiriman', array('id' => $id));
        return $query->result();
    }

    public function delete($id)
    {
        // $this->db->where('user_id', $this->userId);
        $this->db->where('id', $id);
        $this->db->delete('tb_alamat_pengiriman');
        return $this->db->affected_rows();
    }

    public function add($data = array())
    {
        $this->db->insert('tb_alamat_pengiriman', $data);
    }

    public function ambil_data_alamat()
    {
        $this->db->select('id, label_alamat, penerima, alamat');
        $query = $this->db->get('tb_alamat_pengiriman');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return FALSE;
        }
    }

    public function update_data_alamat($id = NULL, $data = array())
    {
        $this->db->where('id', $id);
        $this->db->update('tb_alamat_pengiriman', $data);

        return $this->db->affected_rows();
    }

    public function hapus_data_alamat($id = NULL)
    {
        $this->db->where('id', $id);
        $this->db->delete('tb_alamat_pengiriman');

        return $this->db->affected_rows();
    }
}
