<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_members extends CI_Model
{

  private $primary_key   = 'id';
  private $table_name   = 'users';
  private $field_search   = ['id', 'sts_bayar'];

  public function __construct()
  {
    $config = array(
      'primary_key'   => $this->primary_key,
      'table_name'   => $this->table_name,
      'field_search'   => $this->field_search,
    );

    parent::__construct($config);
  }
public function getUser($id)
  {
    $this->db->select('a.user_id,concat(c.first_name," ",c.last_name) as nama,a.refertouser_id as sponsor,a.id_peringkat,b.nama_peringkat,if(c.sts_reseller is not null, "AKTIF", "TIDAK AKTIF") as sts_reseller,if(left(phone,1)=0,concat(62,right(phone,length(phone)-1)),phone) as phone,email,c.username,a.tgl_peringkat');
    $this->db->join('tb_peringkat b', 'a.id_peringkat=b.id_peringkat');
	$this->db->join('users c', 'a.user_id=c.id');
    $this->db->where('a.user_id', $id);
	$this->db->order_by('a.id_peringkat', "DESC");
	//$this->db->limit(1);
    $query = $this->db->get('tb_reseller a');
	//echo $this->db->last_query();
	//exit();
    if ($query->num_rows() > 0) {
       return $query->row();
    } else {
       return FALSE;
    }
  }
 public function get_childDownline($network,$id)
  {
    $this->db->select('a.user_id,concat(c.first_name," ",c.last_name) as nama,a.refertouser_id as sponsor,a.id_peringkat,b.nama_peringkat,if(c.sts_reseller is not null, "AKTIF", "TIDAK AKTIF") as sts_reseller,if(left(phone,1)=0,concat(62,right(phone,length(phone)-1)),phone) as phone,email,c.username,a.tgl_peringkat');
    $this->db->join('tb_peringkat b', 'a.id_peringkat=b.id_peringkat');
	$this->db->join('users c', 'a.user_id=c.id');
	if($network == 'upline'){
		$this->db->where('a.user_id', $id);
	}else{
	$this->db->where('a.refertouser_id', $id);
	}
	$this->db->order_by('a.id_peringkat', "DESC");
	//$this->db->limit(1);
    $query = $this->db->get('tb_reseller a');
	//echo $this->db->last_query();
	//exit();
    if ($query->num_rows() > 0) {
		return $query->result();
       //return $query->row();
    } else {
       return FALSE;
    }
  } 
  public function get_op_og($id,$jns)
  {
	if($jns == 'op'){
		$this->db->select('ifnull(op_periode,0) as omset');
	}else{
		$this->db->select('ifnull(og_periode,0) as omset');
	}
	$thn=date('Y-m-d');
    $this->db->where('user_id', $id);
	$this->db->where('tgl_mulai <=', $thn);
	$this->db->where('tgl_akhir >=', $thn);
	//$this->db->where('tahun', date("Y"));
    $query = $this->db->get('tb_omset_periode');
	//echo $this->db->last_query();
	//exit();
    if ($query->num_rows() > 0) {
       return $query->row();
    } else {
       return FALSE;
    }
  }
}

/* End of file Model_adjustment_stok.php */
/* Location: ./application/models/Model_adjustment_stok.php */