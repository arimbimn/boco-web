<?php

function smn_baseurl()
{
  $ci = &get_instance();
  return 'http://localhost/adm/';
}
function script_baseurl()
{
  $ci = &get_instance();
  return 'https://script.bocorocco-shoes.com/';
}
function cekPhoneNumber($phone)
{
  $nohp = $phone;

  // kadang ada penulisan no hp 0811 239 345
  $nohp = str_replace(" ", "", $nohp);
  // kadang ada penulisan no hp (0274) 778787
  $nohp = str_replace("(", "", $nohp);
  // kadang ada penulisan no hp (0274) 778787
  $nohp = str_replace(")", "", $nohp);
  // kadang ada penulisan no hp 0811.239.345
  $nohp = str_replace(".", "", $nohp);

  // cek apakah no hp mengandung karakter + dan 0-9
  if (!preg_match('/[^+0-9]/', trim($nohp))) {
    // cek apakah no hp karakter 1-3 adalah +62
    if (substr(trim($nohp), 0, 3) == '+62') {
      $hp = '62' . substr(trim($nohp), 1);
    }
    // cek apakah no hp karakter 1 adalah 0
    elseif (substr(trim($nohp), 0, 1) == '0') {
      $hp = '62' . substr(trim($nohp), 1);
    } else {
      $hp = $nohp;
    }
  }
  return $hp;
}
