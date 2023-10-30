<?php
defined('BASEPATH') or exit('No direct script access allowed');


/**
 *| --------------------------------------------------------------------------
 *| Adjustment Stok Controller
 *| --------------------------------------------------------------------------
 *| Adjustment Stok site
 *|
 */
class MembersController extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();

    $this->load->model('M_members');
	
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
  public function index($id = 0)
  {
    //$this->getDownline($id);
	$this->data['data_id'] = $id;
	$this->data['title'] ='Keanggotaan | Bocorocco Pillow Concept';
	$this->template->load('template', 'users/members/tree', $this->data);
  }
  public function get_view_tree(){
      $id=$this->input->post('id',true);
      //$id=null !== $vid ? $vid : 0;
      print_r(json_encode($this->getDownline($id)));
  }
  public function get_view_select(){
      $id=$this->session->userdata('user_id');
      print_r(json_encode($this->getDownline($id)));
  }
 /*function ini bisa untuk mendapatkan omsetgroup dan bisa juga mendapatkan data downline*/
  public function getDownline($id){
	$data_arr=array();
	$id_nya=$id;
	$total=0;
	  $cek=$this->M_members->getUser($id);
	  if($cek){
		$id=$cek->user_id;
		$name=$cek->nama;
		$sponsor=$cek->sponsor;
		$peringkat=$cek->nama_peringkat;
		//$total = $total+$this->getOmset($id);
		//var_dump($total);exit();
		$data_arr[]=array(
			"id" => $id,
			"name" => ucwords($name),
			"sponsor" => null,//$sponsor,
			"peringkat" => ucwords($peringkat),
			"op" => number_format($this->get_op_og($id,'op'), 0),
			"op_asli" =>$this->get_op_og($id,'op'),
			"og" => number_format($this->get_op_og($id,'og'), 0),
			"sts" => $cek->sts_reseller,
			"phone" => $cek->phone,
			"email" => $cek->email,
			"level" => 0,
			"username" => $cek->username,
			"tgl_peringkat" => $cek->tgl_peringkat
		);
		$data_utama=array($data_arr[0]['id']);
		$sts=0;
		$lvl=0;
		while (true) {
			if (count($data_arr) < 1) {
				break;
			}
			if($sts < 1){
				$jml=count($data_utama);
				$lvl=$lvl+1;
			}else{
				$jml=count($data_utama[0]);
				$lvl=$lvl+1;
			}
			if($jml > 0){
				$data_1=array();
				for($x=0; $x <= $jml;$x++){
					if($x >= $jml){
						$data_utama=array();
						array_push($data_utama,$data_1);
						break;
					}else{
						if($sts < 1){
							$arr=explode("#",$data_utama[$x]);
						}else{
							$arr=explode("#",$data_utama[0][$x]);
						}
						$id=trim($arr[0]);
						$data=$this->get_child('downline',$id);
						//var_dump($data);exit();
						if(count($data) > 0){
							for($i=0; $i < count($data);$i++){
							//ucwords($data[$i]["name"])
								$data_ar=array(
									"id" => $data[$i]["id"],
									"name" => ucwords($data[$i]["name"]),
									"sponsor" => $data[$i]["sponsor"],
									"peringkat" => ucwords($data[$i]["peringkat"]),
									"op" => number_format($this->get_op_og($data[$i]["id"],'op'), 0),
									"op_asli" =>$this->get_op_og($data[$i]["id"],'op'),
									"og" => number_format($this->get_op_og($data[$i]["id"],'og'), 0),
									"sts" => $data[$i]["sts"],
									"phone" => $data[$i]["phone"],
			                        "email" => $data[$i]["email"],
									"level" => $lvl,
									"username" => $data[$i]["username"],
									"tgl_peringkat" => $data[$i]["tgl_peringkat"]
								);
								//$total = $total+$data[$i]["omset"];
								array_push($data_arr,$data_ar);
								array_push($data_1,$data[$i]["id"]."#".$data[$i]["sponsor"]);
								
							}
						}
					}
					
				}
			}else{
				break;
			}
			$sts++;	
		}
	  }
	//  var_dump(json_encode($data_arr));exit();
	//var_dump($data_arr);exit();
	/*$this->data['data_downline'] = $data_arr;
	$this->data['data_id'] = $id_nya;
	$this->data['title'] ='Keanggotaan | Bocorocco Pillow Concept';
	$this->template->load('template', 'users/members/tree', $this->data);*/
	  //echo($total);
	  //var_dump(json_encode($data_arr));
	  return $data_arr;
	}
 public function detail_members($id){
	$data_arr=array();
	$id_nya=$id;
	$total=0;
	  $cek=$this->M_members->getUser($id);
	  if($cek){
		$id=$cek->user_id;
		$name=$cek->nama;
		$sponsor=$cek->sponsor;
		$peringkat=$cek->nama_peringkat;
		//$total = $total+$this->getOmset($id);
		//var_dump($total);exit();
		$data_arr[]=array(
			"id" => $id,
			"name" => ucwords($name),
			"sponsor" => null,//$sponsor,
			"peringkat" => ucwords($peringkat),
			"op" => number_format($this->get_op_og($id,'op'), 0),
			"op_asli" =>$this->get_op_og($id,'op'),
			"og" => number_format($this->get_op_og($id,'og'), 0),
			"sts" => $cek->sts_reseller,
			"phone" => $cek->phone,
			"email" => $cek->email,
			"level" => 0,
			"username" => $cek->username,
			"tgl_peringkat" => $cek->tgl_peringkat
		);
		$data_utama=array($data_arr[0]['id']);
		$sts=0;
		$lvl=0;
		while (true) {
			if (count($data_arr) < 1) {
				break;
			}
			if($sts < 1){
				$jml=count($data_utama);
				$lvl=$lvl+1;
			}else{
				$jml=count($data_utama[0]);
				$lvl=$lvl+1;
			}
			if($jml > 0){
				$data_1=array();
				for($x=0; $x <= $jml;$x++){
					if($x >= $jml){
						$data_utama=array();
						array_push($data_utama,$data_1);
						break;
					}else{
						if($sts < 1){
							$arr=explode("#",$data_utama[$x]);
						}else{
							$arr=explode("#",$data_utama[0][$x]);
						}
						$id=trim($arr[0]);
						$data=$this->get_child('downline',$id);
						//var_dump($data);exit();
						if(count($data) > 0){
							for($i=0; $i < count($data);$i++){
							//ucwords($data[$i]["name"])
								$data_ar=array(
									"id" => $data[$i]["id"],
									"name" => ucwords($data[$i]["name"]),
									"sponsor" => $data[$i]["sponsor"],
									"peringkat" => ucwords($data[$i]["peringkat"]),
									"op" => number_format($this->get_op_og($data[$i]["id"],'op'), 0),
									"op_asli" =>$this->get_op_og($data[$i]["id"],'op'),
									"og" => number_format($this->get_op_og($data[$i]["id"],'og'), 0),
									"sts" => $data[$i]["sts"],
									"phone" => $data[$i]["phone"],
			                        "email" => $data[$i]["email"],
									"level" => $lvl,
									"username" => $data[$i]["username"],
									"tgl_peringkat" => $data[$i]["tgl_peringkat"]
								);
								//$total = $total+$data[$i]["omset"];
								array_push($data_arr,$data_ar);
								array_push($data_1,$data[$i]["id"]."#".$data[$i]["sponsor"]);
								
							}
						}
					}
					
				}
			}else{
				break;
			}
			$sts++;	
		}
	  }
	//  var_dump(json_encode($data_arr));exit();
	$this->data['data_downline'] = $data_arr;
	$this->data['data_id'] = $id_nya;
	$this->data['title'] ='Keanggotaan | Bocorocco Pillow Concept';
    //$this->template->title('Komisi List');
	$this->load->view('users/members/tree_full', $this->data);
	  //echo($total);
	  //var_dump(json_encode($data_arr));
	}
 public function download_manual($id){
    // $id=$this->ion_auth->user()->row()->id;
     //var_dump($id);exit();
	$data_arr=array();
	$total=0;
	  $cek=$this->M_members->getUser($id);
	  if($cek){
		$id=$cek->user_id;
		$name=$cek->nama;
		$sponsor=$cek->sponsor;
		$peringkat=$cek->nama_peringkat;
		//$total = $total+$this->getOmset($id);
		//var_dump($total);exit();
		$data_arr[]=array(
			"id" => $id,
			"level" => "lvl-0",
			"name" => ucwords($name),
			"sponsor" => null,//$sponsor,
			"peringkat" => ucwords($peringkat),
			"op" => number_format($this->get_op_og($id,'op'), 0),
			"og" => number_format($this->get_op_og($id,'og'), 0)
		);
		$data_utama=array($data_arr[0]['id']);
		$sts=0;
		$lvl=0;
		while (true) {
			if (count($data_arr) < 1) {
				break;
			}
			if($sts < 1){
				$jml=count($data_utama);
				$lvl=$lvl+1;
			}else{
				$jml=count($data_utama[0]);
				$lvl=$lvl+1;
			}
			if($jml > 0){
				$data_1=array();
				for($x=0; $x <= $jml;$x++){
					if($x >= $jml){
						$data_utama=array();
						array_push($data_utama,$data_1);
						
						break;
					}else{
						if($sts < 1){
							$arr=explode("#",$data_utama[$x]);
							//$lvl=$lvl+1;
						}else{
							$arr=explode("#",$data_utama[0][$x]);
							//$lvl=$lvl+1;
						}
						$id=trim($arr[0]);
						$data=$this->get_child('downline',$id);
						//var_dump($data);exit();
						if(count($data) > 0){
							for($i=0; $i < count($data);$i++){
							//ucwords($data[$i]["name"])
								$data_ar=array(
									"id" => $data[$i]["id"],
									"level" => "lvl-".$lvl,
									"name" => ucwords($data[$i]["name"]),
									"sponsor" => $data[$i]["sponsor"],
									"peringkat" => ucwords($data[$i]["peringkat"]),
									"op" => number_format($this->get_op_og($data[$i]["id"],'op'), 0),
									"og" => number_format($this->get_op_og($data[$i]["id"],'og'), 0)
								);
								//$total = $total+$data[$i]["omset"];
								array_push($data_arr,$data_ar);
								array_push($data_1,$data[$i]["id"]."#".$data[$i]["sponsor"]);
								
							}
						}
					}
					
				}
			}else{
				break;
			}
			$sts++;	
		}
	  }
	  /*foreach ($data_arr as $result) {
	      var_dump($result['name']);exit();
            //if(is_array($result)){
                foreach ($result as $car) {
                    var_dump($car['name']);exit();
                }
           // }
        }*/
	//  var_dump(json_encode($data_arr));exit();
	/*$this->data['data_downline'] = $data_arr;
	$this->data['title'] ='Keanggotaan | Bocorocco Pillow Concept';
    //$this->template->title('Komisi List');
	$this->template->load('template', 'users/members/tree', $this->data);
	  //echo($total);
	  //var_dump(json_encode($data_arr));*/
	  $key_header = ["Membership"];
	  $vkolom=array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
    ob_start();
    date_default_timezone_set('Asia/Jakarta');
    $tgl=date('d-m-Y H:i:s');
    $idx = 0;
    $objWorkSheet =  $this->excel->createSheet($idx);
    foreach (range('A', $vkolom[count($key_header)-1]) as $columnID) {
        $objWorkSheet->getColumnDimension($columnID)->setAutoSize(true);
    }
    $styleTitle = array(
                    'font'  => array(
                        'bold'  => true,
                        'color' => array('rgb' => '000000'),
                        'size'  => 13,
                    ),
                    'alignment' => array(
                        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                    )
                );
    $merge="A1:${vkolom[count($key_header)-1]}1";
    $objWorkSheet->mergeCells($merge);
    $objWorkSheet->getCell('A1')->setValue('REPORT MEMBERSHIP');
    $objWorkSheet->getStyle('A1')->applyFromArray($styleTitle);
    $merge2="A2:${vkolom[count($key_header)-1]}2";
    $objWorkSheet->mergeCells($merge2);
    $objWorkSheet->getCell('A2')->setValue('Tgl Cetak: '.$tgl);
    $objWorkSheet->setTitle("keagenan"); //nama sheet
    $col=0;
    
    foreach ($key_header as $field) {
       $objWorkSheet->setCellValueByColumnAndRow($col, 3, $field);
        $objWorkSheet->getCellByColumnAndRow($col, 3)->getStyle()->applyFromArray(
            array(
                'font' => [
                            'bold'  =>  true,
                        ],
                            'fill' => array(
                                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                                'color' => array('rgb' => '#FFEA00')
                            ),
                            'alignment' => array(
                                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                            ),
                            'borders' => array(
                                'allborders' => array(
                                    'style' => PHPExcel_Style_Border::BORDER_THIN
                                )
                            )
                        )
                    );

                    $col++; 
    }
    $row_body = 4;
    //$daftar_record = $this->model_report_products->data_horizontal($area,$kat,urldecode($st));
    if(count($data_arr) > 0){
        foreach ($data_arr as $result) {
            $col_body=0;
            foreach ($key_header as $field1) {
                $value_record = "";
                 $value_record = $result['level'].' # '.$result['name'].' # '.$result['peringkat'].' # OP:'.$result['op'].' # OG:'.$result['og'];
                 $objWorkSheet->setCellValueByColumnAndRow($col_body, $row_body, $value_record);
                $objWorkSheet->getCellByColumnAndRow($col_body, $row_body)->getStyle()->applyFromArray(
                    array(
                        'borders' => array(
                            'allborders' => array(
                                'style' => PHPExcel_Style_Border::BORDER_THIN
                                    )
                                )
                        )
                    );
                $col_body++;
            }
            $row_body++;
        }
        ob_end_clean();
         header("Pragma: public");
            header("Expires: 0");
            header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
            header("Content-Type: application/force-download");
            header("Content-Type: application/octet-stream");
            header("Content-Type: application/download");
            header('Content-Disposition: attachment;filename=' . 'Membership.xls');
            //header("Content-Disposition: attachment;filename=$filename");
    /*header('Content-type: application/vnd.ms-excel; charset=UTF-8');
    header('Content-Disposition: attachment;filename=' . 'Report Stok.xls');
    header('Cache-Control: max-age=0');
    header('Cache-Control: max-age=1');
    header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
    header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
    header('Cache-Control: cache, must-revalidate');
    header('Pragma: public');*/
    ob_end_clean();
    $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
    $objWriter->save('php://output');
    ini_set('memory_limit', '44M');
    set_time_limit(30);
    exit;
    }
}
 public function download(){
     $id=$this->ion_auth->user()->row()->id;
     //var_dump($id);exit();
	$data_arr=array();
	$total=0;
	  $cek=$this->M_members->getUser($id);
	  if($cek){
		$id=$cek->user_id;
		$name=$cek->nama;
		$sponsor=$cek->sponsor;
		$peringkat=$cek->nama_peringkat;
		//$total = $total+$this->getOmset($id);
		//var_dump($total);exit();
		$data_arr[]=array(
			"id" => $id,
			"level" => "lvl-0",
			"name" => ucwords($name),
			"sponsor" => null,//$sponsor,
			"peringkat" => ucwords($peringkat),
			"op" => number_format($this->get_op_og($id,'op'), 0),
			"og" => number_format($this->get_op_og($id,'og'), 0),
			"sts" => $cek->sts_reseller
		);
		$data_utama=array($data_arr[0]['id']);
		$sts=0;
		$lvl=0;
		while (true) {
			if (count($data_arr) < 1) {
				break;
			}
			if($sts < 1){
				$jml=count($data_utama);
				$lvl=$lvl+1;
			}else{
				$jml=count($data_utama[0]);
				$lvl=$lvl+1;
			}
			if($jml > 0){
				$data_1=array();
				for($x=0; $x <= $jml;$x++){
					if($x >= $jml){
						$data_utama=array();
						array_push($data_utama,$data_1);
						
						break;
					}else{
						if($sts < 1){
							$arr=explode("#",$data_utama[$x]);
							//$lvl=$lvl+1;
						}else{
							$arr=explode("#",$data_utama[0][$x]);
							//$lvl=$lvl+1;
						}
						$id=trim($arr[0]);
						$data=$this->get_child('downline',$id);
						//var_dump($data);exit();
						if(count($data) > 0){
							for($i=0; $i < count($data);$i++){
							//ucwords($data[$i]["name"])
								$data_ar=array(
									"id" => $data[$i]["id"],
									"level" => "lvl-".$lvl,
									"name" => ucwords($data[$i]["name"]),
									"sponsor" => $data[$i]["sponsor"],
									"peringkat" => ucwords($data[$i]["peringkat"]),
									"op" => number_format($this->get_op_og($data[$i]["id"],'op'), 0),
									"og" => number_format($this->get_op_og($data[$i]["id"],'og'), 0),
									"sts" => $data[$i]["sts"]
								);
								//$total = $total+$data[$i]["omset"];
								array_push($data_arr,$data_ar);
								array_push($data_1,$data[$i]["id"]."#".$data[$i]["sponsor"]);
								
							}
						}
					}
					
				}
			}else{
				break;
			}
			$sts++;	
		}
	  }
	  /*foreach ($data_arr as $result) {
	      var_dump($result['name']);exit();
            //if(is_array($result)){
                foreach ($result as $car) {
                    var_dump($car['name']);exit();
                }
           // }
        }*/
	//  var_dump(json_encode($data_arr));exit();
	/*$this->data['data_downline'] = $data_arr;
	$this->data['title'] ='Keanggotaan | Bocorocco Pillow Concept';
    //$this->template->title('Komisi List');
	$this->template->load('template', 'users/members/tree', $this->data);
	  //echo($total);
	  //var_dump(json_encode($data_arr));*/
	  $key_header = ["Membership"];
	  $vkolom=array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","T","U","V","W","X","Y","Z");
    ob_start();
    date_default_timezone_set('Asia/Jakarta');
    $tgl=date('d-m-Y H:i:s');
    $idx = 0;
    $objWorkSheet =  $this->excel->createSheet($idx);
    foreach (range('A', $vkolom[count($key_header)-1]) as $columnID) {
        $objWorkSheet->getColumnDimension($columnID)->setAutoSize(true);
    }
    $styleTitle = array(
                    'font'  => array(
                        'bold'  => true,
                        'color' => array('rgb' => '000000'),
                        'size'  => 13,
                    ),
                    'alignment' => array(
                        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                    )
                );
    $merge="A1:${vkolom[count($key_header)-1]}1";
    $objWorkSheet->mergeCells($merge);
    $objWorkSheet->getCell('A1')->setValue('REPORT MEMBERSHIP');
    $objWorkSheet->getStyle('A1')->applyFromArray($styleTitle);
    $merge2="A2:${vkolom[count($key_header)-1]}2";
    $objWorkSheet->mergeCells($merge2);
    $objWorkSheet->getCell('A2')->setValue('Tgl Cetak: '.$tgl);
    $objWorkSheet->setTitle("keagenan"); //nama sheet
    $col=0;
    
    foreach ($key_header as $field) {
       $objWorkSheet->setCellValueByColumnAndRow($col, 3, $field);
        $objWorkSheet->getCellByColumnAndRow($col, 3)->getStyle()->applyFromArray(
            array(
                'font' => [
                            'bold'  =>  true,
                        ],
                            'fill' => array(
                                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                                'color' => array('rgb' => '#FFEA00')
                            ),
                            'alignment' => array(
                                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                            ),
                            'borders' => array(
                                'allborders' => array(
                                    'style' => PHPExcel_Style_Border::BORDER_THIN
                                )
                            )
                        )
                    );

                    $col++; 
    }
    $row_body = 4;
    //$daftar_record = $this->model_report_products->data_horizontal($area,$kat,urldecode($st));
    if(count($data_arr) > 0){
        foreach ($data_arr as $result) {
            $col_body=0;
            foreach ($key_header as $field1) {
                $value_record = "";
                 $value_record = $result['level'].' # '.$result['name'].' # '.$result['peringkat'].' # OP:'.$result['op'].' # OG:'.$result['og'].' # STS:'.$result['sts'];
                 $objWorkSheet->setCellValueByColumnAndRow($col_body, $row_body, $value_record);
                $objWorkSheet->getCellByColumnAndRow($col_body, $row_body)->getStyle()->applyFromArray(
                    array(
                        'borders' => array(
                            'allborders' => array(
                                'style' => PHPExcel_Style_Border::BORDER_THIN
                                    )
                                )
                        )
                    );
                $col_body++;
            }
            $row_body++;
        }
        ob_end_clean();
         header("Pragma: public");
            header("Expires: 0");
            header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
            header("Content-Type: application/force-download");
            header("Content-Type: application/octet-stream");
            header("Content-Type: application/download");
            header('Content-Disposition: attachment;filename=' . 'Membership.xls');
            //header("Content-Disposition: attachment;filename=$filename");
    /*header('Content-type: application/vnd.ms-excel; charset=UTF-8');
    header('Content-Disposition: attachment;filename=' . 'Report Stok.xls');
    header('Cache-Control: max-age=0');
    header('Cache-Control: max-age=1');
    header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
    header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
    header('Cache-Control: cache, must-revalidate');
    header('Pragma: public');*/
    ob_end_clean();
    $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
    $objWriter->save('php://output');
    ini_set('memory_limit', '44M');
    set_time_limit(30);
    exit;
    }
}
function get_op_og($id,$jns){
	$cek=$this->M_members->get_op_og($id,$jns);
	$val=0;
	if($cek){
		$val=$cek->omset;
	}
	return $val;
} 
function get_child($network,$sponsorId){
	$data_arr=array();
	$cek=$this->M_members->get_childDownline($network,$sponsorId);
	if($cek){
		foreach($cek as $row) {
		  $data_arr[]=array(
				"id" => $row->user_id,
				"name" => $row->nama,
				"sponsor" => $row->sponsor,
				"peringkat" => $row->nama_peringkat,
				"id_peringkat" => $row->id_peringkat,
				"sts" => $row->sts_reseller,
				"phone" => $row->phone,
				"email" => $row->email,
				"username" => $row->username,
				"tgl_peringkat" => $row->tgl_peringkat
				//"omset" => $this->getOmset($row->user_id)
			);
		}
	}
	return $data_arr;
}
}


/* End of file adjustment_stok.php */
/* Location: ./application/controllers/administrator/Adjustment Stok.php */