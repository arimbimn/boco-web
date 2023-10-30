<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_komisi extends CI_Model
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

  public function count_all($q = null, $field = null)
  {
    $iterasi = 1;
    $num = count($this->field_search);
    $where = NULL;
    $q = $this->scurity($q);
    $field = $this->scurity($field);
    if (empty($field)) {

      // $where = '(' . $where . ')';
      $where = "(users.id LIKE '%" . $q . "%' OR sts_bayar LIKE '%" . $q . "%')";
    } else {
      // $where .= "(" . "adjustment_stok." . $field . " LIKE '%" . $q . "%' )";
      if ($field == 'sts_bayar') {
        $where = "(sts_bayar LIKE '%" . $q . "%')";
      }
    }

    $this->join_avaiable();
    /*if ($this->aauth->get_user()->store_id != 0) {
      $this->db->where(['adjustment_stok.store_id' => $this->aauth->get_user()->store_id]);
    }*/
	$this->db->where(['users.id' => $this->session->userdata('user_id')]);
    $this->db->where($where);
    $query = $this->db->get($this->table_name);

    return $query->num_rows();
  }
  public function count_all_history_deposit($q = null, $field = null)
  {
    //$iterasi = 1;
    //$num = count($this->field_search);
    $where = NULL;
    $q = $this->scurity($q);
    $field = $this->scurity($field);
    if (empty($field)) {

      // $where = '(' . $where . ')';
      $where = "(user_id LIKE '%" . $q . "%' OR kode_order LIKE '%" . $q . "%')";
    } else {
      if ($field == 'kode_order') {
        $where = "(kode_order LIKE '%" . $q . "%')";
      }else if ($field == 'user_id') {
        $where = "(user_id LIKE '%" . $q . "%')";
      }
    }

    //$this->join_avaiable();
    /*if ($this->aauth->get_user()->store_id != 0) {
      $this->db->where(['adjustment_stok.store_id' => $this->aauth->get_user()->store_id]);
    }*/
	$this->db->where(['id_reseller' => $this->session->userdata('user_id')]);
	$this->db->where(['status_bayar' => 'PAID']);
	$this->db->where('kode_voucher is NOT NULL', NULL, FALSE);
	$this->db->where('kode_voucher !=',0);
    $this->db->where($where);
    $this->db->or_where(['id_reseller' => $this->session->userdata('user_id')]);
	$this->db->where(['status_bayar' => 'SETTLED']);
	$this->db->where('kode_voucher is NOT NULL', NULL, FALSE);
	$this->db->where('kode_voucher !=',0);
    $this->db->where($where);
    $query = $this->db->get('order');

    return $query->num_rows();
  }
	public function scurity($input)
    {
        return mysqli_real_escape_string($this->db->conn_id, $input);
    }
  public function get($q = null, $field = null, $limit = 0, $offset = 0, $aksi = "", $select_field = [])
  {
	  //private $field_search   = ['id', 'first_name', 'last_name', 'username', 'phone', 'email', 'bank', 'norek'];
    $iterasi = 1;
    $num = count($this->field_search);
    $where = NULL;
    $q = $this->scurity($q);
    $field = $this->scurity($field);

    if (empty($field)) {

      // $where = '(' . $where . ')';
      $where = "(users.id LIKE '%" . $q . "%' OR sts_bayar LIKE '%" . $q . "%')";
    } else {
      // $where .= "(" . "adjustment_stok." . $field . " LIKE '%" . $q . "%' )";
      if ($field == 'sts_bayar') {
        $where = "(sts_bayar LIKE '%" . $q . "%')";
      }
    }
    if (is_array($select_field) and count($select_field)) {
      $this->db->select($select_field);
    }

    $this->join_avaiable();

    /*if ($this->aauth->get_user()->store_id != 0) {
      $this->db->where(['adjustment_stok.store_id' => $this->aauth->get_user()->store_id]);
    }*/
	$this->db->where(['users.id' => $this->session->userdata('user_id')]);
    $this->db->where($where);
    $this->db->limit($limit, $offset);
    $this->db->order_by('users.' . $this->primary_key, "DESC");
	$this->db->order_by('tb_komisi_reseller.created_at', "DESC");
    $query = $this->db->get($this->table_name);
	//echo $this->db->last_query();
	//exit();
    if ($aksi != "") {
      return $query->result_array();
    } else {
      return $query->result();
    }
  }
  public function get_history_deposit($q = null, $field = null, $limit = 0, $offset = 0, $aksi = "", $select_field = [])
  {
    //$iterasi = 1;
    //$num = count($this->field_search);
    $where = NULL;
    $q = $this->scurity($q);
    $field = $this->scurity($field);

    if (empty($field)) {

      // $where = '(' . $where . ')';
      $where = "(user_id LIKE '%" . $q . "%' OR kode_order LIKE '%" . $q . "%')";
    } else {
      if ($field == 'kode_order') {
        $where = "(kode_order LIKE '%" . $q . "%')";
      }else if ($field == 'user_id') {
        $where = "(user_id LIKE '%" . $q . "%')";
      }
    }
    if (is_array($select_field) and count($select_field)) {
      $this->db->select($select_field);
    }

    //$this->join_avaiable();

    /*if ($this->aauth->get_user()->store_id != 0) {
      $this->db->where(['adjustment_stok.store_id' => $this->aauth->get_user()->store_id]);
    }*/
	$this->db->select('order.user_id,order.nama_order,order.kode_order,order.subtotal,order.diskon_voucher,order.total_bayar,order.id_order,users.username,concat(first_name," ",last_name) as nama_lengkap,order.kode_voucher,order.biaya_admin');
	$this->db->join('users', 'order.user_id = users.id');
	$this->db->where(['id_reseller' => $this->session->userdata('user_id')]);
	$this->db->where(['status_bayar' => 'PAID']);
	$this->db->where('kode_voucher is NOT NULL', NULL, FALSE);
	$this->db->where('kode_voucher !=',0);
    $this->db->where($where);
    $this->db->or_where(['id_reseller' => $this->session->userdata('user_id')]);
	$this->db->where(['status_bayar' => 'SETTLED']);
	$this->db->where('kode_voucher is NOT NULL', NULL, FALSE);
	$this->db->where('kode_voucher !=',0);
    $this->db->where($where);
    $this->db->limit($limit, $offset);
    $this->db->order_by('created_at', "DESC");
	//$this->db->order_by('tb_komisi_reseller.created_at', "DESC");
    $query = $this->db->get('order');
	//echo $this->db->last_query();
	//exit();
    if ($aksi != "") {
      return $query->result_array();
    } else {
      return $query->result();
    }
  }
  public function get_komisi_periode()
  {
    $this->db->select('user_id,akumulasi_kp,akumulasi_kk,akumulasi_royalti,periode');
	$this->db->where(['user_id' => $this->session->userdata('user_id')]);
    //$this->db->limit($limit, $offset);
    $this->db->order_by('periode', "DESC");
    $query = $this->db->get('tb_omset');
	//echo $this->db->last_query();
	//exit();
    /*if ($aksi != "") {
      return $query->result_array();
    } else {
      return $query->result();
    }*/
	 if ($query->num_rows() > 0) {
        return $query->result();
     } else {
        return FALSE;
     }
  }
   public function get_komisi_detail_periode($id,$periode)
  {
    //$this->db->select('a.user_id,a.kp,a.kk,a.royalti,concat(e.username,"-",c.nama_peringkat) as komisi_dari,tgl_omset,a.periode,a.reference_no,a.sts_omset,d.id_order');
    $this->db->select('a.user_id,a.kp,a.kk,a.royalti,b.id_peringkat, concat(e.username,"-",c.nama_peringkat) as royalti_dari');
    $this->db->select('f.id_peringkat,concat(h.username,"-",g.nama_peringkat) as kk_dari');
    $this->db->select('tgl_omset,a.periode,a.reference_no,a.sts_omset,d.id_order,if(i.id_peringkat is null,k.username,concat(k.username,"-",j.nama_peringkat)) as kp_dari'); 
	$this->db->join('tb_reseller b', 'a.omset_from=b.user_id',"LEFT");
	$this->db->join('tb_peringkat c', 'b.id_peringkat=c.id_peringkat',"LEFT");
	$this->db->join('order d', 'a.reference_no=d.kode_order',"LEFT");
	$this->db->join('users e', 'a.omset_from=e.id',"LEFT");
	/*tambahan
	LEFT JOIN tb_reseller f on a.omset_from_kk=f.user_id
    LEFT JOIN `tb_peringkat` `g` ON `f`.`id_peringkat`=`g`.`id_peringkat`
    LEFT JOIN `users` `h` ON `a`.`omset_from_kk`=`h`.`id` */
    $this->db->join('tb_reseller f', 'a.omset_from_kk=f.user_id',"LEFT");
	$this->db->join('tb_peringkat g', 'f.id_peringkat=g.id_peringkat',"LEFT");
	$this->db->join('users h', 'a.omset_from_kk=h.id',"LEFT");
	
	$this->db->join('tb_reseller i', 'a.omset_from_kp=i.user_id',"LEFT");
	$this->db->join('tb_peringkat j', 'i.id_peringkat=j.id_peringkat',"LEFT");
	$this->db->join('users k', 'a.omset_from_kp=k.id',"LEFT");
	/*end tambahan*/
	$this->db->where(['a.user_id' => $this->session->userdata('user_id')]);
	$this->db->where(['a.sts_omset' => 'kp']);
	$this->db->where(['a.periode' => $periode]);
	$this->db->or_where(['a.user_id' => $this->session->userdata('user_id')]);
	$this->db->where(['a.sts_omset' => 'kk']);
	$this->db->where(['a.periode' => $periode]);
	$this->db->or_where(['a.user_id' => $this->session->userdata('user_id')]);
	$this->db->where(['a.sts_omset' => 'royalti']);
	$this->db->where(['a.periode' => $periode]);
	$this->db->or_where(['a.user_id' => $this->session->userdata('user_id')]);
	$this->db->where(['a.sts_omset' => 'royalti+kk']);
	$this->db->where(['a.periode' => $periode]);
    $this->db->order_by('a.id_detail_omset', "DESC");
    $query = $this->db->get('tb_detail_omset a');
	//echo $this->db->last_query();
	//exit();
    /*if ($aksi != "") {
      return $query->result_array();
    } else {
      return $query->result();
    }*/
	 if ($query->num_rows() > 0) {
        return $query->result();
     } else {
        return FALSE;
     }
  }
public function get_pesanan($id,$periode,$kode_order){
	$this->db->select('id_order,kode_order,nama_order,status_bayar,total_bayar,paid_at,created_at');
	if($periode != ''){
		$this->db->where('id_reseller', $id);
		$this->db->where("DATE_FORMAT(paid_at, '%Y%m') =", $periode);
	}else{
		//$this->db->where('id_reseller', $id);
		$this->db->where('kode_order', $kode_order);
	}
	/*$this->db->where('paid_at >=', $start);
	$this->db->where('paid_at <=', $end);*/
	$this->db->order_by('paid_at', "ASC");
    $query = $this->db->get('order');
	//echo $this->db->last_query();
	//exit();
	return $query->result();
    /*if ($aksi != "") {
      return $query->result_array();
    } else {
      return $query->result();
    }*/
}
  public function join_avaiable()
  {
    $this->db->select('users.id,bank,norek,periode_start,periode_end,periode,harian,minggu,tahun,saldo,sts_bayar,created_at,updated_at,jns_komisi,kode_order,failure_code');
    $this->db->join('tb_komisi_reseller', 'users.id  = tb_komisi_reseller.user_id');
    /*$this->db->join('aauth_users', 'aauth_users.id = adjustment_stok.user_id', 'LEFT');
    $this->db->join('aauth_users aauth_users1', 'aauth_users1.id = adjustment_stok.approved_by', 'LEFT');*/

    return $this;
  }

  public function change_peringkat($id = NULL, $data = array())
    {
        $this->db->where('user_id', $id);
        $this->db->update('tb_reseller', $data);

        return $this->db->affected_rows();
    }
	public function change_username($id = NULL, $data = array())
    {
        $this->db->where('id', $id);
        $this->db->update('users', $data);

        return $this->db->affected_rows();
    }
public function find_reseller($id = NULL, $select_field = [])
    {
        if (is_array($select_field) and count($select_field)) {
            $this->db->select($select_field);
        }

        $this->db->where('user_id', $id);
        $query = $this->db->get('tb_reseller');

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return FALSE;
        }
    }
	public function find_username($id = NULL,$vuser= NULL, $select_field = [])
    {
        if (is_array($select_field) and count($select_field)) {
            $this->db->select($select_field);
        }

        $this->db->where('id !=', $id);
		$this->db->where('username', $vuser);
        $query = $this->db->get('users');

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return FALSE;
        }
    }
 public function save_reseller($data = array())
    {
        $this->db->insert('tb_reseller', $data);
        return $this->db->insert_id();
    }
public function total_saldo()
    {
        $this->db->select('ifnull(saldo,0) as saldo,deposit');
        $this->db->where('user_id', $this->session->userdata('user_id'));
        $query = $this->db->get('tb_wallet');
        //return $query->row()->saldo;
        //echo $this->db->last_query();
	    //exit();
		if ($query->num_rows() > 0) {
            //return $query->row()->saldo;
            return $query->row();
        } else {
            return FALSE;
        }
    }
   public function save_komisi_reseller($data = array())
    {
        $this->db->insert('tb_komisi_reseller', $data);
        return $this->db->insert_id();
    }
    public function get_peringkat()
    {
        $this->db->select('nama_peringkat');
        $this->db->join('tb_peringkat b', 'a.id_peringkat  = b.id_peringkat');
        $this->db->where('user_id', $this->session->userdata('user_id'));
        $query = $this->db->get('tb_reseller a');
        //return $query->row()->saldo;
		if ($query->num_rows() > 0) {
            return $query->row()->nama_peringkat;
        } else {
            return FALSE;
        }
    }
public function GetOmsetPribadiGroup($id,$jns_omset,$thn)
  {
    $this->db->select('ifnull('.$jns_omset.',0) as omset,tgl_akhir');
    $this->db->where('user_id', $id);
	//$this->db->where('tahun', $thn);
	$this->db->where('tgl_mulai <=', $thn);
	$this->db->where('tgl_akhir >=', $thn);
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