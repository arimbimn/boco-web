
<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UserMemberCekController extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model('M_users');
    $this->load->model('M_wasend');
  }

  public function cekUserGold()
  {
    $user = $this->M_users->getAllUser();

    foreach ($user as $v_user) {
      echo $v_user->first_name . '<br>';

      $cekUser = $this->db->where(['user_id' => $v_user->id])->get('user_membership')->row();

      if (!$cekUser) {
        $cekOrder = $this->db->where(['user_id' => $v_user->id])
          ->group_start()
          ->where(['status_bayar' => 'PAID'])->or_where(['status_bayar' => 'SETTLED'])
          ->group_end()
          ->get('order')->row();
        $random = 'MBR/' . date('Ymd') . '/' . strtoupper(random_string('alnum', 4));
        $masaberlaku = date('Y-m-d', strtotime('+1 year', strtotime(date('Y-m-d'))));
        echo $v_user->first_name . '<br>';
        if ($cekOrder) {

          $cekGold = $this->db->where(['user_id' => $v_user->id])->get('user_membership')->row();
          if ($cekGold) {
            echo 'Sudah Member Platimun atau Diamond ';
          } else {
            $createdMember = [
              'user_id' => $v_user->id,
              'peringkat_member' => 'GOLD',
              'qrcode' => $random,
              'masaberlaku' => $masaberlaku,

            ];

            $this->db->insert('user_membership', $createdMember);

            $tanggal_member = date("Y-m-d");

            $userName = "$v_user->username";
            $userName = str_replace(' ', '_', $userName);

            $this->generate_qr($userName, 'GOLD', $tanggal_member);

            $cekReffer = $this->db->where(['user_id' => $v_user->id])->get('users_refer')->row();

            if (!$cekReffer) {

              $dataSaveReffer = [
                'user_id' => $v_user->id,
                'refertouser_id' => 52,
                'refertouser_email' => 'hovip@mail.com',
              ];

              $this->db->insert('users_refer', $dataSaveReffer);
            }

            // $urlImage = base_url() . '/assets/images/CARDS/' . $v_user->username . '.png';

            // $this->M_wasend->sendWaMedia($v_user->phone, "Selamat Anda Menjadi Member *GOLD*

            // Setelah Anda membeli sebanyak 1 kali 

            // pesan otomatis dari Admin *Bocorocco*
            // cek status Member Anda web bocorocco
            // ", $urlImage);
            $userName = "$v_user->username";
            $userName = str_replace(' ', '_', $userName);

            $this->sendEmail($v_user->email, $userName, 'DIAMOND');

            $this->sendWhatsapp($v_user, 'GOLD');

            echo 'Created Member';
            echo 'Masa Berlaku:' . $masaberlaku;
          }
        } else {
          echo 'Tidak Mencapai Gold' . '<br>';
        }
      }


      echo  '<br>';
    }

    // $saveDataCron = [
    //   'message' => 'Cek Gold',
    // ];

    // $this->db->insert('cronjobs_log', $saveDataCron);
  }


  public function cekUserPlatinum()
  {
    $user = $this->M_users->getGoldMember();

    foreach ($user as $v_user) {
      echo $v_user->first_name . '<br>';
      $hitungSatuTahun = date('Y-m-d', strtotime('+1 year', $v_user->created_on));
      // if(date('y-m-d') <= )
      if (date('Y-m-d') <= $hitungSatuTahun) {
        $cekOrder = $this->db->select_sum('total_bayar')
          ->where(['user_id' => $v_user->id])
          ->group_start()
          ->where(['status_bayar' => 'PAID'])
          ->or_where(['status_bayar' => 'SETTLED'])
          ->group_end()
          ->get('order')->row();
        echo $v_user->email . '<br>';
        echo  'Total belanja:' . $cekOrder->total_bayar . '<br>';
        echo  'Kurang DariSatu Tahun <br>';

        if ($cekOrder->total_bayar >= 5000000) {
          $cekMember = $this->db->where(['user_id' => $v_user->id])->where(['peringkat_member' => 'GOLD'])->get('user_membership')->row();
          if ($cekMember) {
            $masaberlaku = date('Y-m-d', strtotime('+1 year', strtotime($cekMember->masaberlaku)));
            $dataUpdate = array(
              'peringkat_member' => 'PLATINUM',
              'masaberlaku' => $masaberlaku,
            );
            $this->db->where('id_membership', $cekMember->id_membership);
            $this->db->update('user_membership', $dataUpdate);

            $cekReffer = $this->db->where(['user_id' => $v_user->id])->get('users_refer')->row();

            if (!$cekReffer) {

              $dataSaveReffer = [
                'user_id' => $v_user->id,
                'refertouser_id' => 52,
                'refertouser_email' => 'hovip@mail.com',
              ];

              $this->db->insert('users_refer', $dataSaveReffer);
            }

            $tanggal_member = date("Y-m-d", strtotime($cekMember->created_at));
            $userName = str_replace(' ', '_', $v_user->username);

            $this->generate_qr($userName, 'PLATINUM', $tanggal_member);




            $voucherMember = $this->db->where(['to_member' => 'PLATINUM'])->where(['voucher_default' => 1])->get('voucher')->result();

            foreach ($voucherMember as $v_voc) {
              $saveData = [
                'user_id' => $v_user->id,
                'voucher_id' => $v_voc->id_voucher,
                'exp_date' => $masaberlaku,
              ];

              $this->db->insert('voucher_used', $saveData);
            }


            $userName = str_replace(' ', '_', $v_user->username);

            $this->sendEmail($v_user->email, $userName, 'DIAMOND');

            $this->sendWhatsapp($v_user, 'PLATINUM');
            // $urlImage = base_url() . '/assets/images/CARDS/' . $v_user->username . '.png';

            //             $this->M_wasend->sendWaMedia($v_user->phone, 'Selamat Anda Menjadi Member *PLATINUM*

            // Setelah Anda membeli lebih dari Rp 5.000.000 

            // pesan otomatis dari Admin *Bocorocco*
            // cek status Member Anda di boccoroco
            // ', $urlImage);


            echo 'Dapat Member Platinum <br>';
          } else {
            echo 'Sudah User Diamond atau Gold';
          }
        }
      } else {
        echo  'Lebih Dari Satu Tahun <br>';
      }
      echo  '<br>';
      echo  '<br>';
    }

    // $saveDataCron = [
    //   'message' => 'Cek PLATINUM',
    // ];

    // $this->db->insert('cronjobs_log', $saveDataCron);
  }


  public function cekUserDiamond()
  {
    $user = $this->M_users->getPlatinumMember();

    foreach ($user as $v_user) {
      echo $v_user->first_name . '<br>';
      $hitungSatuTahun = date('Y-m-d', strtotime('+1 year', $v_user->created_on));
      // if(date('y-m-d') <= )
      if (date('Y-m-d') <= $hitungSatuTahun) {
        $cekOrder = $this->db->select_sum('total_bayar')->where(['user_id' => $v_user->id])
          ->group_start()
          ->where(['status_bayar' => 'PAID'])->or_where(['status_bayar' => 'SETTLED'])
          ->group_end()
          ->get('order')->row();
        echo $v_user->first_name . '<br>';
        echo  'Total belanja:' . $cekOrder->total_bayar . '<br>';
        echo  'Kurang DariSatu Tahun <br>';

        if ($cekOrder->total_bayar >= 20000000) {
          $cekMember = $this->db->where(['user_id' => $v_user->id])->where(['peringkat_member' => 'PLATINUM'])->get('user_membership')->row();
          if ($cekMember) {
            $masaberlaku = date('Y-m-d', strtotime('+1 year', strtotime($cekMember->masaberlaku)));
            $dataUpdate = array(
              'peringkat_member' => 'DIAMOND',
              'masaberlaku' => $masaberlaku,
            );
            $this->db->where('id_membership', $cekMember->id_membership);
            $this->db->update('user_membership', $dataUpdate);

            $tanggal_member = date("Y-m-d", strtotime($cekMember->created_at));
            $userName = str_replace(' ', '_', $v_user->username);

            $this->generate_qr($userName, 'DIAMOND', $tanggal_member);





            $voucherMember = $this->db->where(['to_member' => 'DIAMOND'])->where(['voucher_default' => 1])->get('voucher')->result();

            foreach ($voucherMember as $v_voc) {
              $saveData = [
                'user_id' => $v_user->id,
                'voucher_id' => $v_voc->id_voucher,
                'exp_date' => $masaberlaku,
              ];

              $this->db->insert('voucher_used', $saveData);
            }

            $cekReffer = $this->db->where(['user_id' => $v_user->id])->get('users_refer')->row();

            if (!$cekReffer) {

              $dataSaveReffer = [
                'user_id' => $v_user->id,
                'refertouser_id' => 52,
                'refertouser_email' => 'hovip@mail.com',
              ];

              $this->db->insert('users_refer', $dataSaveReffer);
            }

            $fullname = "$v_user->first_name $v_user->last_name";
            $userName = str_replace(' ', '_', $v_user->username);

            $this->generateRedemtionImage($userName, $fullname);

            $voucherRedemption = $this->db->where(['voucher_redemption' => 1])->get('voucher')->row();

            if ($voucherRedemption) {
              $userName = str_replace(' ', '_', $v_user->username);

              $urlimgVoucher = base_url() . "assets/images/Redemtion/$userName.png";

              $this->M_wasend->sendWaMedia($v_user->phone, "Kepada Bapak/Ibu $v_user->first_name $v_user->last_name

*SELAMAT!* Telah menjadi Diamond Member Bocorocco, Anda berhak mendapatkan *VOUCHER REDEMPTION*, yang bisa Anda pergunakan untuk mendapatkan *GRATIS SEPATU SEKELUARGA!*

Berikut adalah *Redemption Voucher Anda* yang terdapat KODE UNIK milik Anda

*Benefit Redemption Voucher untuk Anda:*
- *Setiap 2 orang menggunakan REDEMPTION VOUCHER ANDA* dan telah menjadi Diamond Membership, maka Anda berhak mendapatkan *REFFERAL VOUCHER TOTAL 1 pasang sepatu GRATIS seharga Rp 3.490.000,-*

- *Setiap 4 orang telah menggunakan REDEMPTION VOUCHER ANDA* dan telah menjadi Diamond Membership, maka Anda berhak mendapatkan *TOTAL 2 pasang sepatu dan 1 koper seharga Rp 3.890.000,- TOTAL SENILAI Rp 10.870.000,-*

- *Setiap 10 orang menggunakan REDEMPTION VOUCHER ANDA* telah menjadi Diamond Membership dalam *1 bulan pertama, *maka Anda berhak mendapatkan *TOTAL 5 pasang sepatu + 2 koper + voucher belanja sebesar Rp 20.000.000,- TOTAL SENILAI Rp 45.230.0000,-*

*Program belaku kelipatan dan tak terhingga.*

Setiap orang yg menggunakan Redemption Voucher yang Anda bagikan, berhak mendapatkan *VOUCHER GRATIS 1 pasang sepatu senilai 3,190,000!*

Syarat dan ketentuan tentang Program Beli 2 GRATIS Sekeluarga klik di sini


Salam Sehat,
Bocorocco
              ", $urlimgVoucher);
            }
            $userName = str_replace(' ', '_', $v_user->username);

            $this->sendEmail($v_user->email, $userName, 'REDEMTION');

            // $urlImage = base_url() . '/assets/images/CARDS/' . $v_user->username . '.png';
            // $this->M_wasend->sendWaMedia($v_user->phone, 'Selamat Anda Menjadi Member *DIAMOND*

            // Setelah Anda membeli Lebih Rp 20.000.000 Dalam Waktu 1 tahun 

            // pesan otomatis dari Admin *Bocorocco*
            // cek status Member Anda di boccoroco
            // ', $urlImage);
            $this->sendEmail($v_user->email, $userName, 'DIAMOND');

            $this->sendWhatsapp($v_user, 'DIAMOND');




            echo 'Dapat Member Diaimond <br>';
          } else {
            echo 'Sudah Platimum atau Gold';
          }
        } else {
          echo  'Belum Mencapai 20 juta <br>';
        }
      } else {
        echo  'Lebih Dari Satu Tahun <br>';
      }
      echo  '<br>';
      echo  '<br>';
    }
    // $saveDataCron = [
    //   'message' => 'Cek Diamond',
    // ];

    // $this->db->insert('cronjobs_log', $saveDataCron);
  }


  public function callWa()
  {

    $phone = $this->input->post('phone');
    $message = $this->input->post('message');
    $imageUrl = $this->input->post('image_url');

    $this->M_wasend->sendWaMedia($phone, $message, $imageUrl);

    $data = [
      'phone' => $phone,
      'message' => $message,
      'imageUrl' => $imageUrl,
    ];

    echo json_encode($data);
    return;
  }


  public function sendWhatsapp($v_user, $member)
  {
    $userName = str_replace(' ', '_', $v_user->username);

    $urlImage = base_url() . '/assets/images/CARDS/' . $userName . '-' . $member . '.png';

    $text = '';
	//$v_user->username
    if ($member == 'DIAMOND') {
      $text .= "Kepada Bapak/Ibu $v_user->first_name $v_user->last_name

SELAMAT! Anda telah mendapatkan FREE UPGRADE membership Bocorocco menjadi DIAMOND MEMBERSHIP senilai Rp. 20,000,000!

Berikut adalah BENEFIT DAHSYAT yang Anda dapatkan sebagai pemegang Diamond Membership:
•	DISCOUNT 20% ALL ITEMS
Dapatkan discount 20% untuk normal items, ketika sedang tidak ada promo apapun di boutique/online. Discount ini tidak bisa digabungkan dengan promo lainnya.
•	BENEFIT ULANG TAHUN
Discount 50% untuk 2 pasang sepatu di bulan ulang tahun Anda. Discount ini tidak bisa digabungkan dengan promo lainnya.
•	BENEFIT LOVE YOUR PARENTS
DISCOUNT SESUAI DENGAN UMUR orangtua Anda sebanyak 2 pasang bisa diklaim bersamaan saat pengambilan benefit ulang tahun. Contoh, orangtua Anda berusia 80 tahun, maka discount yang akan Anda dapatkan sebesar 80%. Benefit ini BERLAKU 1 TAHUN, perpanjang benefit dengan program atau minimal belanja Rp 20.000.000,- dan tidak bisa digabungkan dengan promo lainnya. 

Hubungi Customer Care kami via Whatsapp 0811-188-2468 untuk klaim Benefit Ulang Tahun dan juga Love Your Parents. 

Masa keanggotaan berlaku selama 1 tahun, cek selalu status Anda melalui website kami di bocorocco-online.com

Salam Sehat,
Bocorocco ";
    } else if ($member == 'PLATINUM') {
		//$v_user->username
      $text .= "Kepada Bapak/Ibu $v_user->first_name $v_user->last_name

SELAMAT! Anda mendapatkan FREE UPGRADE menjadi Platinum Membership karena telah berhasil melakukan transaksi sebesar Rp 5.000.000,- !

Berikut BENEFIT LUAR BIASA yang akan Anda dapatkan sebagai pemegang Platinum Membership:
- DISCOUNT 15% ALL ITEMS
-Dapatkan discount 15% untuk normal items, ketika sedang tidak ada promo apapun di boutique/online. Discount ini tidak bisa digabungkan dengan promo lainnya. Berlaku untuk pembelian ALL ITEMS termasuk Boots.
- BENEFIT ULANG TAHUN
Pada bulan ulang tahun, member dapat membeli 1 pasang sepatu dengan mendapat discount 50% untuk pilihan all item sepatu / sandal. Discount ini tidak bisa digabungkan dengan promo lainnya.

Masa keanggotaan berlaku selama 1 tahun, UPGRADE Membership Anda menjadi DIAMOND MEMBERSHIP hanya dengan membeli 2 pasang sepatu!

Cek selalu status keanggotaan Anda melalui website kami di bocorocco-online.com.

Salam Sehat, 
Bocorocco";
    } else if ($member == 'GOLD') {
		//$v_user->username
      $text .= "Kepada Bapak Ibu $v_user->first_name $v_user->last_name

SELAMAT! Telah berhasil mendapatkan Gold Membership Bocorocco karena melakukan transaksi sebesar Rp 1.000.000,-!

Anda akan mendapatkan DISCOUNT 10% All Items saat tidak sedang ada promo selama setahun. Discount berlaku untuk pembelian all items termasuk Boots. 

Masa keanggotaan berlaku selama 1 tahun, UPGRADE Membership Anda menjadi DIAMOND MEMBERSHIP hanya dengan membeli 2 pasang sepatu!

Cek selalu status keanggotaan Anda melalui website kami di bocorocco-online.com.

Salam Sehat, 
Bocorocco";
    }


    $this->M_wasend->sendWaMedia($v_user->phone, $text, $urlImage);
  }



/*  public function generate_qr($kode, $member, $created_at)
  {
    $this->load->library('image_lib');

    $nim = $kode;
    $this->load->library('ciqrcode'); //pemanggilan library QR CODE

    $config['cacheable']  = true; //boolean, the default is true
    $config['cachedir']    = './assets/'; //string, the default is application/cache/
    $config['errorlog']    = './assets/'; //string, the default is application/logs/
    if ($member == 'GOLD') {
      $background        = './assets/bg_gold.png';
    } elseif ($member == 'PLATINUM') {
      $background        = './assets/bg_platinum.png';
    } else {
      $background        = './assets/bg_diamond.png';
    }
    $config['imagedir']    = './assets/images/QR/'; //direktori penyimpanan qr code
    $path_kartu        = './assets/images/CARDS/';

    $config['quality']    = true; //boolean, the default is true
    $config['size']      = '1024'; //interger, the default is 1024
    $config['black']    = array(224, 255, 255); // array, default is array(255,255,255)
    $config['white']    = array(70, 130, 180); // array, default is array(0,0,0)
    $this->ciqrcode->initialize($config);

    $image_name = $nim . '-' . $member . '.png'; //buat name dari qr code sesuai dengan nim

    $params['data'] = $nim; //data yang akan di jadikan QR CODE
    $params['level'] = 'L'; //H=High
    $params['size'] = 3;
    $params['savename'] = FCPATH . $config['imagedir'] . $image_name; //simpan image QR CODE ke folder assets/images/

    $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE

    // //$this->mahasiswa_model->simpan_mahasiswa($nim,$nama,$prodi,$image_name); //simpan ke database
    // $iamgepath = $config['imagedir'];
    $config = array(
      'image_library' => 'GD2',
      'source_image' => $background, //background image
      'new_image' => $path_kartu . $image_name, //'./assets/'.$image_name,
      'wm_overlay_path' => $config['imagedir'] . $image_name, //'./assets/images/'.$image_name,//image number 1
      'wm_type' => 'overlay',
      'wm_opacity' => '100',
      'wm_vrt_alignment' => 'bottom',
      'wm_hor_alignment' => 'center',
      'wm_padding' => '20',
      'wm_hor_offset' => -300,
      'wm_vrt_offset' => 120,
    );
    $nama_file = $image_name;
    // unset($config);
    $this->image_lib->initialize($config);

    if (!$this->image_lib->watermark()) {
      echo $this->image_lib->display_errors();
    }
    $this->addText($path_kartu, $image_name, $kode);
    $this->addText1($path_kartu, $image_name, $created_at);
    $this->addText2($path_kartu, $image_name, $kode);
    unset($config);
    $this->load->library('image_lib');
    $this->image_lib->clear();
    echo 'qr generated';
    return;
  }

  public function addText($path, $imagename, $kode)
  {
    $kode = str_replace('_', ' ', $kode);

    $this->load->library('image_lib');
    $config['source_image'] = $path . $imagename;
    $config['wm_text'] = "$kode";
    $config['wm_type'] = 'text';
    $config['wm_font_size'] = '25';
    $config['wm_font_color'] = '000';
    $config['wm_vrt_alignment'] = 'bottom';
    $config['wm_hor_alignment'] = 'center';
    $config['wm_padding'] = '20';
    $config['wm_hor_offset'] = -300;
    $config['wm_vrt_offset'] = -100;

    $this->image_lib->initialize($config);

    $this->image_lib->watermark();
    unset($config);
    $this->load->library('image_lib');
    $this->image_lib->clear();
  }

  public function addText1($path, $imagename, $kode)
  {
    $kode = str_replace('_', ' ', $kode);

    $this->load->library('image_lib');
    $config['source_image'] = $path . $imagename;
    $config['wm_text'] = "Member Date : " . $kode;
    $config['wm_type'] = 'text';
    $config['wm_font_size'] = '30';
    $config['wm_font_color'] = '#696969';
    // $config['wm_shadow_color'] = '#DAA520';
    $config['wm_vrt_alignment'] = 'bottom';
    $config['wm_hor_alignment'] = 'center';
    $config['wm_padding'] = '20';
    $config['wm_hor_offset'] = 100;
    $config['wm_vrt_offset'] = -100;

    $this->image_lib->initialize($config);

    $this->image_lib->watermark();
    unset($config);
    $this->load->library('image_lib');
    $this->image_lib->clear();
  }

  public function addText2($path, $imagename, $kode)
  {
    $kode = str_replace('_', ' ', $kode);

    $this->load->library('image_lib');
    $config['source_image'] = $path . $imagename;
    $config['wm_text'] = "Member Name : " . $kode;
    $config['wm_type'] = 'text';
    $config['wm_font_size'] = '30';
    $config['wm_font_color'] = '#696969';
    // $config['wm_shadow_color'] = '#DAA520';
    $config['wm_vrt_alignment'] = 'bottom';
    // $config['wm_hor_alignment'] = 'center';
    $config['wm_padding'] = '20';
    $config['wm_hor_offset'] = 100;
    $config['wm_vrt_offset'] = -150;

    $this->image_lib->initialize($config);

    $this->image_lib->watermark();
    unset($config);
    $this->load->library('image_lib');
    $this->image_lib->clear();
  }*/

public function generate_qr($vkode, $member, $created_at)
  {
   $name_arr=explode('-',$vkode);
    $kode=$name_arr[0];
    $name_a=str_replace('_', ' ', $name_arr[1]);
    //var_dump($kode);exit();
    $this->load->library('image_lib');

    //$nim = $kode;
    $nim = $kode;
    $this->load->library('ciqrcode'); //pemanggilan library QR CODE

    $config['cacheable']  = true; //boolean, the default is true
    $config['cachedir']    = './assets/'; //string, the default is application/cache/
    $config['errorlog']    = './assets/'; //string, the default is application/logs/
    if ($member == 'GOLD') {
      $background        = './assets/bg_gold.png';
    } elseif ($member == 'PLATINUM') {
      $background        = './assets/bg_platinum.png';
    } else {
      $background        = './assets/bg_diamond.png';
    }
    $config['imagedir']    = './assets/images/QR/'; //direktori penyimpanan qr code
    $path_kartu        = './assets/images/CARDS/';

    $config['quality']    = true; //boolean, the default is true
    $config['size']      = '1024'; //interger, the default is 1024
    $config['black']    = array(224, 255, 255); // array, default is array(255,255,255)
    $config['white']    = array(70, 130, 180); // array, default is array(0,0,0)
    $this->ciqrcode->initialize($config);

    $image_name = $nim . '-' . $member . '.png'; //buat name dari qr code sesuai dengan nim

    $params['data'] = $nim; //data yang akan di jadikan QR CODE
    $params['level'] = 'L'; //H=High
    $params['size'] = 3;
    $params['savename'] = FCPATH . $config['imagedir'] . $image_name; //simpan image QR CODE ke folder assets/images/

    $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE

    // //$this->mahasiswa_model->simpan_mahasiswa($nim,$nama,$prodi,$image_name); //simpan ke database
    // $iamgepath = $config['imagedir'];
    $config = array(
      'image_library' => 'GD2',
      'source_image' => $background, //background image
      'new_image' => $path_kartu . $image_name, //'./assets/'.$image_name,
      'wm_overlay_path' => $config['imagedir'] . $image_name, //'./assets/images/'.$image_name,//image number 1
      'wm_type' => 'overlay',
      'wm_opacity' => '100',
      'wm_vrt_alignment' => 'bottom',
      'wm_hor_alignment' => 'center',
      'wm_padding' => '20',
      'wm_hor_offset' => -300,
      'wm_vrt_offset' => 120,
    );
    $nama_file = $image_name;
    // unset($config);
    $this->image_lib->initialize($config);

    if (!$this->image_lib->watermark()) {
      echo $this->image_lib->display_errors();
    }
    $this->addText($path_kartu, $image_name, $kode);
    $this->addText1($path_kartu, $image_name, $created_at);
    $this->addText1A($path_kartu, $image_name, $created_at);
    //$this->addText2($path_kartu, $image_name, $kode);
    $this->addText2($path_kartu, $image_name, ucwords($name_a));
    $this->addText2A($path_kartu, $image_name, ucwords($name_a));
    $this->addText3($path_kartu, $image_name, $kode);
    $this->addText3A($path_kartu, $image_name, $kode);
    unset($config);
    $this->load->library('image_lib');
    $this->image_lib->clear();
    echo 'qr generated';
    return;
  }

  public function addText($path, $imagename, $kode)
  {
    $kode = str_replace('_', ' ', $kode);

    $this->load->library('image_lib');
    $config['source_image'] = $path . $imagename;
    $config['wm_text'] = "$kode";
    $config['wm_type'] = 'text';
    $config['wm_font_size'] = '25';
    $config['wm_font_color'] = '000';
    $config['wm_vrt_alignment'] = 'bottom';
    $config['wm_hor_alignment'] = 'center';
    $config['wm_padding'] = '20';
    $config['wm_hor_offset'] = -300;
    $config['wm_vrt_offset'] = -100;

    $this->image_lib->initialize($config);

    $this->image_lib->watermark();
    unset($config);
    $this->load->library('image_lib');
    $this->image_lib->clear();
  }

  public function addText1($path, $imagename, $kode)
  {
    $kode = str_replace('_', ' ', $kode);

    $this->load->library('image_lib');
    $config['source_image'] = $path . $imagename;
    $config['wm_text'] = "Member Date : ";// . $kode;
    $config['wm_type'] = 'text';
    $config['wm_font_size'] = '30';
    $config['wm_font_color'] = '#696969';
    // $config['wm_shadow_color'] = '#DAA520';
    $config['wm_vrt_alignment'] = 'bottom';
    $config['wm_hor_alignment'] = 'right'; //center
    $config['wm_padding'] = '20';
    $config['wm_hor_offset'] = -300; //100
    $config['wm_vrt_offset'] = -100;

    $this->image_lib->initialize($config);

    $this->image_lib->watermark();
    unset($config);
    $this->load->library('image_lib');
    $this->image_lib->clear();
  }
  public function addText1A($path, $imagename, $kode)
  {
    $kode = str_replace('_', ' ', $kode);

    $this->load->library('image_lib');
    $config['source_image'] = $path . $imagename;
    $config['wm_text'] = $kode;
    $config['wm_type'] = 'text';
    $config['wm_font_size'] = '30';
    $config['wm_font_color'] = '#696969';
    // $config['wm_shadow_color'] = '#DAA520';
    $config['wm_vrt_alignment'] = 'bottom';
    $config['wm_hor_alignment'] = 'left'; //center
    $config['wm_padding'] = '20';
    $config['wm_hor_offset'] = 500; //100
    $config['wm_vrt_offset'] = -100;

    $this->image_lib->initialize($config);

    $this->image_lib->watermark();
    unset($config);
    $this->load->library('image_lib');
    $this->image_lib->clear();
  }

  public function addText2($path, $imagename, $kode)
  {
    $kode = str_replace('_', ' ', $kode);

    $this->load->library('image_lib');
    $config['source_image'] = $path . $imagename;
    $config['wm_text'] = "Member Name : ";// . $kode;
    $config['wm_type'] = 'text';
    $config['wm_font_size'] = '30';
    $config['wm_font_color'] = '#696969';
    // $config['wm_shadow_color'] = '#DAA520';
    $config['wm_vrt_alignment'] = 'bottom';
    $config['wm_hor_alignment'] = 'right'; //tidk ada
    $config['wm_padding'] = '20';
    $config['wm_hor_offset'] = -300; //400
    $config['wm_vrt_offset'] = -150;

    $this->image_lib->initialize($config);

    $this->image_lib->watermark();
    unset($config);
    $this->load->library('image_lib');
    $this->image_lib->clear();
  }
   public function addText2A($path, $imagename, $kode)
  {
    $kode = str_replace('_', ' ', $kode);

    $this->load->library('image_lib');
    $config['source_image'] = $path . $imagename;
    $config['wm_text'] = $kode;
    $config['wm_type'] = 'text';
    $config['wm_font_size'] = '30';
    $config['wm_font_color'] = '#696969';
    // $config['wm_shadow_color'] = '#DAA520';
    $config['wm_vrt_alignment'] = 'bottom';
    $config['wm_hor_alignment'] = 'left'; //tidk ada
    $config['wm_padding'] = '20';
    $config['wm_hor_offset'] = 500; //400
    $config['wm_vrt_offset'] = -150;

    $this->image_lib->initialize($config);

    $this->image_lib->watermark();
    unset($config);
    $this->load->library('image_lib');
    $this->image_lib->clear();
  }
  
   public function addText3($path, $imagename, $kode)
  {
    $kode = str_replace('_', ' ', $kode);

    $this->load->library('image_lib');
    $config['source_image'] = $path . $imagename;
    $config['wm_text'] = "Kode refferal : ";// . $kode;
    $config['wm_type'] = 'text';
    $config['wm_font_size'] = '30';
    $config['wm_font_color'] = '#696969';
    // $config['wm_shadow_color'] = '#DAA520';
    $config['wm_vrt_alignment'] = 'bottom';
    $config['wm_hor_alignment'] = 'right';//tdk ada
    $config['wm_padding'] = '20';
    $config['wm_hor_offset'] = -300; //100
    $config['wm_vrt_offset'] = -125;

    $this->image_lib->initialize($config);

    $this->image_lib->watermark();
    unset($config);
    $this->load->library('image_lib');
    $this->image_lib->clear();
  }
   public function addText3A($path, $imagename, $kode)
  {
    $kode = str_replace('_', ' ', $kode);

    $this->load->library('image_lib');
    $config['source_image'] = $path . $imagename;
    $config['wm_text'] = $kode;
    $config['wm_type'] = 'text';
    $config['wm_font_size'] = '30';
    $config['wm_font_color'] = '#696969';
    // $config['wm_shadow_color'] = '#DAA520';
    $config['wm_vrt_alignment'] = 'bottom';
    $config['wm_hor_alignment'] = 'left';//tdk ada
    $config['wm_padding'] = '20';
    $config['wm_hor_offset'] = 500; //100
    $config['wm_vrt_offset'] = -125;

    $this->image_lib->initialize($config);

    $this->image_lib->watermark();
    unset($config);
    $this->load->library('image_lib');
    $this->image_lib->clear();
  }

  public function generateRedemtionImage($username, $fullname)
  {
    $this->load->library('image_lib');
    $background        = './assets/redemtion.png';

    $path_kartu        = './assets/images/Redemtion/';
    $image_name = $username . '.png';
    $config = array(
      'image_library' => 'gd',
      'source_image' => $background, //background image
      'new_image' => $path_kartu . $image_name, //'./assets/'.$image_name,

    );

    $this->load->library('image_lib');
    $this->image_lib->initialize($config);
    $this->image_lib->watermark();
    unset($config);
    $this->load->library('image_lib');
    $this->image_lib->clear();

    $fullname = urldecode($fullname);
    $image = $this->addTextRedemtionName($path_kartu,  $image_name, $fullname);
    $image_one = $this->addTextRedemtionUsername($path_kartu,  $image_name, $username);
  }

  public function addTextRedemtionName($path, $imagename, $fullname)
  {
    $fullname = str_replace('_', ' ', $fullname);

    $config = [
      'image_library' => 'gd',
      'source_image' => $path . $imagename,
      'wm_text' => "Name : $fullname",
      'wm_font_path' => realpath('./system/fonts/Montserrat-SemiBold.ttf'),
      'wm_type' => 'text',
      'wm_font_size' => 15,
      'wm_font_color' => 'FFF',
      'wm_vrt_alignment' => 'bottom',
      'wm_hor_alignment' => 'left',
      'wm_padding' => '20',
      'wm_hor_offset' => 30,
      'wm_vrt_offset' => -90,
    ];


    $this->load->library('image_lib');
    $this->image_lib->initialize($config);
    $this->image_lib->watermark();
    unset($config);
    $this->load->library('image_lib');
    $this->image_lib->clear();
  }

  public function addTextRedemtionUsername($path, $imagename, $username)
  {
    $username = str_replace('_', ' ', $username);

    $config = [
      'image_library' => 'gd',
      'source_image' => $path . $imagename,
      'wm_text' => "Username : $username",
      'wm_font_path' => realpath('./system/fonts/Montserrat-SemiBold.ttf'),
      'wm_type' => 'text',
      'wm_font_size' => 15,
      'wm_font_color' => 'FFF',
      'wm_vrt_alignment' => 'bottom',
      'wm_hor_alignment' => 'left',
      'wm_padding' => '20',
      'wm_hor_offset' => 30,
      'wm_vrt_offset' => -130,
    ];

    $this->load->library('image_lib');
    $this->image_lib->initialize($config);
    $this->image_lib->watermark();
    unset($config);
    $this->load->library('image_lib');
    $this->image_lib->clear();
  }


  public function sendEmail($mail, $username, $member)
  {


    $config = [
      'protocol' => 'smtp',
      'smtp_host' => 'ssl://mail.graphie.co.id',
      'smtp_user' => 'info@graphie.co.id',
      'smtp_pass' => 'ZMqE25htnE',
      'smtp_port' => 4465,
      'smtp_crypto' => 'tsl',
      'mailtype'  => 'html',
      'charset' => 'utf-8',
      'crlf'    => "\r\n",
      'newline' => "\r\n"
    ];

    $text = '';
    if ($member == 'DIAMOND') {
      $text .= '<div class="txtTinyMce-wrapper" style="font-size: 12px; line-height: 1.5; font-family: "Lato", Tahoma, Verdana, Segoe, sans-serif; color: #222222; mso-line-height-alt: 18px;">
                          <p style="margin: 0; font-size: 16px; line-height: 1.5; word-break: break-word; mso-line-height-alt: 24px; margin-top: 0; margin-bottom: 0;"><span style="font-size: 16px;">Kepada Bapak/Ibu ' . $username . ' </span></p>
                          <br>
                          <br>
                          <p style="margin: 0; font-size: 16px; line-height: 1.5; word-break: break-word; mso-line-height-alt: 24px; margin-top: 0; margin-bottom: 0;"><span style="font-size: 16px;"> <b>SELAMAT! Anda telah mendapatkan FREE UPGRADE membership Bocorocco menjadi DIAMOND MEMBERSHIP senilai Rp. 20,000,000!</b> </span></p>
                          <br>
                          <br>


                          <p style="margin: 0; font-size: 16px; line-height: 1.5; word-break: break-word; mso-line-height-alt: 24px; margin-top: 0; margin-bottom: 0;"><span style="font-size: 16px;">Berikut adalah BENEFIT DAHSYAT yang Anda dapatkan sebagai pemegang Diamond Membership:
                            </span></p>
                          <br>
                          <p style="margin: 0; font-size: 16px; line-height: 1.5; word-break: break-word; mso-line-height-alt: 24px; margin-top: 0; margin-bottom: 0;"><span style="font-size: 16px;">
                              DISCOUNT 20% ALL ITEMS
                              Dapatkan discount 20% untuk normal items, ketika sedang tidak ada promo apapun di boutique/online. Discount ini tidak bisa digabungkan dengan promo lainnya.
                            </span></p>
                          <br>
                          <p style="margin: 0; font-size: 16px; line-height: 1.5; word-break: break-word; mso-line-height-alt: 24px; margin-top: 0; margin-bottom: 0;"><span style="font-size: 16px;">
                              BENEFIT ULANG TAHUN
                              Discount 50% untuk 2 pasang sepatu di bulan ulang tahun Anda. Discount ini tidak bisa digabungkan dengan promo lainnya.
                            </span></p>
                          <br>
                          <p style="margin: 0; font-size: 16px; line-height: 1.5; word-break: break-word; mso-line-height-alt: 24px; margin-top: 0; margin-bottom: 0;"><span style="font-size: 16px;">
                              BENEFIT LOVE YOUR PARENTS
                              DISCOUNT SESUAI DENGAN UMUR orangtua Anda sebanyak 2 pasang bisa diklaim bersamaan saat pengambilan benefit ulang tahun. Contoh, orangtua Anda berusia 80 tahun, maka discount yang akan Anda dapatkan sebesar 80%. Benefit ini BERLAKU 1 TAHUN, perpanjang benefit dengan program atau minimal belanja Rp 20.000.000,- dan tidak bisa digabungkan dengan promo lainnya.
                            </span></p>
                          <br>
                          <p style="margin: 0; font-size: 16px; line-height: 1.5; word-break: break-word; mso-line-height-alt: 24px; margin-top: 0; margin-bottom: 0;"><span style="font-size: 16px;">Salam sehat,
                              Hubungi Customer Care kami via Whatsapp 0811-188-2468 untuk klaim Benefit Ulang Tahun dan juga Love Your Parents.
                            </span></p>
                          <p style="margin: 0; font-size: 16px; line-height: 1.5; word-break: break-word; mso-line-height-alt: 24px; margin-top: 0; margin-bottom: 0;"><span style="font-size: 16px;">Salam sehat,
                              Masa keanggotaan berlaku selama 1 tahun, cek selalu status Anda melalui website kami di bocorocco-online.com
                            </span></p>
                        </div>';
    } else if ($member == 'PLATINUM') {
      $text .= '<div class="txtTinyMce-wrapper" style="font-size: 12px; line-height: 1.5; font-family: "Lato", Tahoma, Verdana, Segoe, sans-serif; color: #222222; mso-line-height-alt: 18px;">
                          <p style="margin: 0; font-size: 16px; line-height: 1.5; word-break: break-word; mso-line-height-alt: 24px; margin-top: 0; margin-bottom: 0;"><span style="font-size: 16px;">Kepada Bapak/Ibu ' . $username . ' </span></p>
                          <br>
                          <br>
                          <p style="margin: 0; font-size: 16px; line-height: 1.5; word-break: break-word; mso-line-height-alt: 24px; margin-top: 0; margin-bottom: 0;"><span style="font-size: 16px;"> <b>SELAMAT! Anda mendapatkan FREE UPGRADE menjadi Platinum Membership karena telah berhasil melakukan transaksi sebesar Rp 5.000.000,- !</b> </span></p>
                          <br>
                          <br>


                          <p style="margin: 0; font-size: 16px; line-height: 1.5; word-break: break-word; mso-line-height-alt: 24px; margin-top: 0; margin-bottom: 0;"><span style="font-size: 16px;">Berikut adalah BENEFIT DAHSYAT yang Anda dapatkan sebagai pemegang PLATINUM Membership:
                            </span></p>
                          <br>
                          <p style="margin: 0; font-size: 16px; line-height: 1.5; word-break: break-word; mso-line-height-alt: 24px; margin-top: 0; margin-bottom: 0;"><span style="font-size: 16px;">
                             DISCOUNT 15% ALL ITEMS
                            </span></p>
                          <br>
                          <p style="margin: 0; font-size: 16px; line-height: 1.5; word-break: break-word; mso-line-height-alt: 24px; margin-top: 0; margin-bottom: 0;"><span style="font-size: 16px;">
                              Dapatkan discount 15% untuk normal items, ketika sedang tidak ada promo apapun di boutique/online. Discount ini tidak bisa digabungkan dengan promo lainnya. Berlaku untuk pembelian ALL ITEMS termasuk Boots.
                            </span></p>
                          <br>
                          <p style="margin: 0; font-size: 16px; line-height: 1.5; word-break: break-word; mso-line-height-alt: 24px; margin-top: 0; margin-bottom: 0;"><span style="font-size: 16px;">
                             BENEFIT ULANG TAHUN
Pada bulan ulang tahun, member dapat membeli 1 pasang sepatu dengan mendapat discount 50% untuk pilihan all item sepatu / sandal. Discount ini tidak bisa digabungkan dengan promo lainnya.
                            </span></p>
                          <br>
                       
                          <p style="margin: 0; font-size: 16px; line-height: 1.5; word-break: break-word; mso-line-height-alt: 24px; margin-top: 0; margin-bottom: 0;"><span style="font-size: 16px;">
                          Masa keanggotaan berlaku selama 1 tahun, UPGRADE Membership Anda menjadi DIAMOND MEMBERSHIP hanya dengan membeli 2 pasang sepatu! <br>
                          Salam sehat,
                              Masa keanggotaan berlaku selama 1 tahun, cek selalu status Anda melalui website kami di bocorocco-online.com
                            </span></p>
                        </div>';
    } else if ($member == 'GOLD') {
      $text .= '<div class="txtTinyMce-wrapper" style="font-size: 12px; line-height: 1.5; font-family: "Lato", Tahoma, Verdana, Segoe, sans-serif; color: #222222; mso-line-height-alt: 18px;">
                          <p style="margin: 0; font-size: 16px; line-height: 1.5; word-break: break-word; mso-line-height-alt: 24px; margin-top: 0; margin-bottom: 0;"><span style="font-size: 16px;">Kepada Bapak/Ibu ' . $username . ' </span></p>
                          <br>
                          <br>
                          <p style="margin: 0; font-size: 16px; line-height: 1.5; word-break: break-word; mso-line-height-alt: 24px; margin-top: 0; margin-bottom: 0;"><span style="font-size: 16px;"> <b>SELAMAT! Telah berhasil mendapatkan Gold Membership Bocorocco karena melakukan transaksi sebesar Rp 1.000.000,-!</b> </span></p>
                          <br>
                          <br>


                          <p style="margin: 0; font-size: 16px; line-height: 1.5; word-break: break-word; mso-line-height-alt: 24px; margin-top: 0; margin-bottom: 0;"><span style="font-size: 16px;">Berikut adalah BENEFIT DAHSYAT yang Anda dapatkan sebagai pemegang Gold Membership:
                            </span></p>
                          <br>
                          <p style="margin: 0; font-size: 16px; line-height: 1.5; word-break: break-word; mso-line-height-alt: 24px; margin-top: 0; margin-bottom: 0;"><span style="font-size: 16px;">
                            Anda akan mendapatkan DISCOUNT 10% All Items saat tidak sedang ada promo selama setahun. Discount berlaku untuk pembelian all items termasuk Boots. 

Masa keanggotaan berlaku selama 1 tahun, UPGRADE Membership Anda menjadi DIAMOND MEMBERSHIP hanya dengan membeli 2 pasang sepatu!

Cek selalu status keanggotaan Anda melalui website kami di bocorocco-online.com.
                            </span></p>
                          
                       
                          <p style="margin: 0; font-size: 16px; line-height: 1.5; word-break: break-word; mso-line-height-alt: 24px; margin-top: 0; margin-bottom: 0;"><span style="font-size: 16px;">
                          Masa keanggotaan berlaku selama 1 tahun, UPGRADE Membership Anda menjadi DIAMOND MEMBERSHIP hanya dengan membeli 2 pasang sepatu! <br>
                          Salam sehat,
                              Masa keanggotaan berlaku selama 1 tahun, cek selalu status Anda melalui website kami di bocorocco-online.com
                            </span></p>
                        </div>';
    } else if ($member == 'REDEMTION') {
      $text .= '<div class="txtTinyMce-wrapper" style="font-size: 12px; line-height: 1.5; font-family: "Lato", Tahoma, Verdana, Segoe, sans-serif; color: #222222; mso-line-height-alt: 18px;">
                          <p style="margin: 0; font-size: 16px; line-height: 1.5; word-break: break-word; mso-line-height-alt: 24px; margin-top: 0; margin-bottom: 0;"><span style="font-size: 16px;">Kepada Bapak/Ibu ' . $username . ' </span></p>
                          <br>
                          <br>
                          <p style="margin: 0; font-size: 16px; line-height: 1.5; word-break: break-word; mso-line-height-alt: 24px; margin-top: 0; margin-bottom: 0;"><span style="font-size: 16px;"> <b>*SELAMAT!* Telah menjadi Diamond Member Bocorocco, Anda berhak mendapatkan VOUCHER REDEMPTION, yang bisa Anda pergunakan untuk mendapatkan GRATIS SEPATU SEKELUARGA!</b> </span></p>
                          <br>
                          <br>


                          <p style="margin: 0; font-size: 16px; line-height: 1.5; word-break: break-word; mso-line-height-alt: 24px; margin-top: 0; margin-bottom: 0;"><span style="font-size: 16px;">Berikut adalah Redemption Voucher Anda yang terdapat KODE UNIK milik Anda, Benefit Redemption Voucher untuk Anda:
                            </span></p>
                          <br>
                           <p style="margin: 0; font-size: 16px; line-height: 1.5; word-break: break-word; mso-line-height-alt: 24px; margin-top: 0; margin-bottom: 0;"><span style="font-size: 16px;">Setiap 2 orang menggunakan REDEMPTION VOUCHER ANDA dan telah menjadi Diamond Membership, maka Anda berhak mendapatkan REFFERAL VOUCHER TOTAL 1 pasang sepatu GRATIS seharga Rp 3.490.000,-
                            </span></p>
                          <br>
                           <p style="margin: 0; font-size: 16px; line-height: 1.5; word-break: break-word; mso-line-height-alt: 24px; margin-top: 0; margin-bottom: 0;"><span style="font-size: 16px;">Setiap 4 orang telah menggunakan REDEMPTION VOUCHER ANDA dan telah menjadi Diamond Membership, maka Anda berhak mendapatkan TOTAL 2 pasang sepatu dan 1 koper seharga Rp 3.890.000,- TOTAL SENILAI Rp 10.870.000,-
                            </span></p>
                          <br>
                           <p style="margin: 0; font-size: 16px; line-height: 1.5; word-break: break-word; mso-line-height-alt: 24px; margin-top: 0; margin-bottom: 0;"><span style="font-size: 16px;">Setiap 10 orang menggunakan REDEMPTION VOUCHER ANDA telah menjadi Diamond Membership dalam 1 bulan pertama, *maka Anda berhak mendapatkan *TOTAL 5 pasang sepatu   2 koper   voucher belanja sebesar Rp 20.000.000,- TOTAL SENILAI Rp 45.230.0000,-
                            </span></p>
                          <br>
                          
                           <p style="margin: 0; font-size: 16px; line-height: 1.5; word-break: break-word; mso-line-height-alt: 24px; margin-top: 0; margin-bottom: 0;"><span style="font-size: 16px;">
                           Program belaku kelipatan dan tak terhingga. <br>

Setiap orang yg menggunakan Redemption Voucher yang Anda bagikan, berhak mendapatkan VOUCHER GRATIS 1 pasang sepatu senilai 3,190,000!

                            </span></p>
                          <br>
                          <p style="margin: 0; font-size: 16px; line-height: 1.5; word-break: break-word; mso-line-height-alt: 24px; margin-top: 0; margin-bottom: 0;"><span style="font-size: 16px;">
                            Anda akan mendapatkan DISCOUNT 10% All Items saat tidak sedang ada promo selama setahun. Discount berlaku untuk pembelian all items termasuk Boots. 

Masa keanggotaan berlaku selama 1 tahun, UPGRADE Membership Anda menjadi DIAMOND MEMBERSHIP hanya dengan membeli 2 pasang sepatu!

Cek selalu status keanggotaan Anda melalui website kami di bocorocco-online.com.
                            </span></p>
                          
                       
                          <p style="margin: 0; font-size: 16px; line-height: 1.5; word-break: break-word; mso-line-height-alt: 24px; margin-top: 0; margin-bottom: 0;"><span style="font-size: 16px;">
                          Masa keanggotaan berlaku selama 1 tahun, UPGRADE Membership Anda menjadi DIAMOND MEMBERSHIP hanya dengan membeli 2 pasang sepatu! <br>
                          Salam sehat,
                              Masa keanggotaan berlaku selama 1 tahun, cek selalu status Anda melalui website kami di bocorocco-online.com
                            </span></p>
                        </div>';
    }
    $statusRedemtion = '';
    if ($member == 'REDEMTION') {
      $imageurl = base_url() . "/assets/images/Redemtion/$username.png";
      $statusRedemtion .= 'Admin Bocorocco, Redemtion Card';
    } else {
      $imageurl = base_url() . "/assets/images/CARDS/$username-$member.png";
      $statusRedemtion .= 'Admin Bocorocco, Status Member';
    }


    $data = [
      'imageurl' => $imageurl,
      'text' => $text,
    ];



    // $html = $this->load->view('backend/standart/administrator/order/templateemail', $data);
    // $html = $this->load->view('')
    $html = $this->parser->parse('email/emailmember', $data);

    $this->load->library('email', $config);

    $this->email->from('info@graphie.co.id', 'Admin Bocorocco');
    $this->email->to($mail);
    // $this->email->subject('Testing');
    $this->email->subject($statusRedemtion);
    // $this->email->message('Testing Mail');
    $this->email->message($html);

    $this->email->send();
  }




  public function percobaan()
  {


    $this->db->select("users.username,user_membership.user_id,user_membership.peringkat_member,user_membership.created_at");

    $this->db->join("users", "users.id = user_membership.user_id");

    $result = $this->db->get("user_membership")->result();


    foreach ($result as $res) {

      $tanggal_member = date("Y-m-d", strtotime($res->created_at));

      $this->generate_qr($res->username, $res->peringkat_member, $tanggal_member);
    }
  }
}
