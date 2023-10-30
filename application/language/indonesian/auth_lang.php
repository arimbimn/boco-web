<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Name:  Auth Lang - Indonesia
 *
 * Author: 	Daeng Muhammad Feisal
 *     http://daengdoang.wordpress.com
 *			daengdoang@gmail.com
 *			@daengdoang
 *
 *
 *
 * Location: https://github.com/benedmunds/CodeIgniter-Ion-Auth
 *
 * Created:  21.06.2013
 * Last-Edit: 21.06.2017
 *
 * Description:  Indonesia language file for Ion Auth example views
 *
 */

// Errors
$lang['error_csrf'] = 'Form yang dikirim tidak lulus pemeriksaan keamanan kami.';

// Login
$lang['login_heading']         = 'Login';
$lang['login_subheading']      = 'Silakan login dengan email/username dan password anda.';
$lang['login_identity_label']  = 'Email/Username:';
$lang['login_password_label']  = 'Kata Sandi:';
$lang['login_remember_label']  = 'Ingatkan Saya:';
$lang['login_submit_btn']      = 'Login';
$lang['login_forgot_password'] = 'Lupa Kata Sandi?';

// Index
$lang['index_heading']           = 'Pengguna';
$lang['index_subheading']        = 'Di bawah ini list dari para Pengguna.';
$lang['index_fname_th']          = 'Nama Awal';
$lang['index_lname_th']          = 'Nama Akhir';
$lang['index_email_th']          = 'Email';
$lang['index_gender_th']         = 'Jenis Kelamin';
$lang['index_groups_th']         = 'Grup';
$lang['index_status_th']         = 'Status';
$lang['index_action_th']         = 'Aksi';
$lang['index_active_link']       = 'Aktif';
$lang['index_inactive_link']     = 'Tidak Aktif';
$lang['index_create_user_link']  = 'Buat Pengguna baru';
$lang['index_create_group_link'] = 'Buat grup baru';

// Deactivate User
$lang['deactivate_heading']                  = 'Deaktivasi Pengguna';
$lang['deactivate_subheading']               = 'Anda yakin akan melakukan deaktivasi akun Pengguna \'%s\'';
$lang['deactivate_confirm_y_label']          = 'Ya:';
$lang['deactivate_confirm_n_label']          = 'Tidak:';
$lang['deactivate_submit_btn']               = 'Kirim';
$lang['deactivate_validation_confirm_label'] = 'konfirmasi';
$lang['deactivate_validation_user_id_label'] = 'ID Pengguna';

// Create User
$lang['create_user_heading']                           = 'Buat Pengguna';
$lang['create_user_subheading']                        = 'Silakan masukan informasi Pengguna di bawah ini.';
$lang['create_user_fname_label']                       = 'Nama Awal:';
$lang['create_user_lname_label']                       = 'Nama Akhir:';
$lang['create_user_company_label']                     = 'Nama Perusahaan:';
$lang['create_user_identity_label']                    = 'Identitas:';
$lang['create_user_email_label']                       = 'Surel:';
$lang['create_user_phone_label']                       = 'Telepon:';
$lang['create_user_password_label']                    = 'Kata Sandi:';
$lang['create_user_password_confirm_label']            = 'Konfirmasi Kata Sandi:';
$lang['create_user_submit_btn']                        = 'Buat Pengguna';
$lang['create_user_validation_fname_label']            = 'Nama Awal';
$lang['create_user_validation_lname_label']            = 'Nama Akhir';
$lang['create_user_validation_identity_label']         = 'Identitas';
$lang['create_user_validation_email_label']            = 'Alamat Surel';
$lang['create_user_validation_phone_label']            = 'Telepon';
$lang['create_user_validation_company_label']          = 'Nama Perusahaan';
$lang['create_user_validation_password_label']         = 'Kata Sandi';
$lang['create_user_validation_password_confirm_label'] = 'Konfirmasi Kata Sandi';
$lang['create_user_validation_tglahir_label']          = 'Tanggal Lahir';
$lang['create_user_validation_referer_label']          = 'Referer';

// Edit User
$lang['edit_user_heading']                           = 'Ubah Pengguna';
$lang['edit_user_subheading']                        = 'Silakan masukan informasi Pengguna di bawah ini.';
$lang['edit_user_fname_label']                       = 'Nama Awal:';
$lang['edit_user_lname_label']                       = 'Nama Akhir:';
$lang['edit_user_company_label']                     = 'Nama Perusahaan:';
$lang['edit_user_email_label']                       = 'Surel:';
$lang['edit_user_phone_label']                       = 'Telepon:';
$lang['edit_user_password_label']                    = 'Kata Sandi: (jika mengubah sandi)';
$lang['edit_user_password_confirm_label']            = 'Konfirmasi Kata Sandi: (jika mengubah sandi)';
$lang['edit_user_groups_heading']                    = 'Anggota dari Grup';
$lang['edit_user_submit_btn']                        = 'Simpan Pengguna';
$lang['edit_user_validation_fname_label']            = 'Nama Awal';
$lang['edit_user_validation_lname_label']            = 'Nama Akhir';
$lang['edit_user_validation_email_label']            = 'Alamat Surel';
$lang['edit_user_validation_phone_label']            = 'Telepon';
$lang['edit_user_validation_company_label']          = 'Nama Perusahaan';
$lang['edit_user_validation_groups_label']           = 'Nama Grup';
$lang['edit_user_validation_password_label']         = 'Kata Sandi';
$lang['edit_user_validation_password_confirm_label'] = 'Konfirmasi Kata Sandi';

// Create Group
$lang['create_group_title']                  = 'Buat Grup';
$lang['create_group_heading']                = 'Buat Grupp';
$lang['create_group_subheading']             = 'Silakan masukan detail Grup di bawah ini.';
$lang['create_group_name_label']             = 'Nama Grup:';
$lang['create_group_desc_label']             = 'Deskripsi:';
$lang['create_group_submit_btn']             = 'Buat Grup';
$lang['create_group_validation_name_label']  = 'Nama Grup';
$lang['create_group_validation_desc_label']  = 'Deskripsi';

// Edit Group
$lang['edit_group_title']                    = 'Ubah Grup';
$lang['edit_group_saved']                    = 'Grup Tersimpan';
$lang['edit_group_heading']                  = 'Ubah Grup';
$lang['edit_group_subheading']               = 'Silakan masukan detail Grup di bawah ini.';
$lang['edit_group_name_label']               = 'Nama Grup:';
$lang['edit_group_desc_label']               = 'Deskripsi:';
$lang['edit_group_submit_btn']               = 'Simpan Grup';
$lang['edit_group_validation_name_label']    = 'Nama Grup';
$lang['edit_group_validation_desc_label']    = 'Deskripsi';

// Change Password
$lang['change_password_heading']                               = 'Ganti Kata Sandi';
$lang['change_password_old_password_label']                    = 'Kata Sandi Lama:';
$lang['change_password_new_password_label']                    = 'Kata Sandi Baru (paling sedikit %s karakter):';
$lang['change_password_new_password_confirm_label']            = 'Konfirmasi Kata Sandi:';
$lang['change_password_submit_btn']                            = 'Ubah';
$lang['change_password_validation_old_password_label']         = 'Kata Sandi Lama';
$lang['change_password_validation_new_password_label']         = 'Kata Sandi Baru';
$lang['change_password_validation_new_password_confirm_label'] = 'Konfirmasi Kata Sandi Baru';

// Forgot Password
$lang['forgot_password_heading']                 = 'Lupa Kata Sandi';
$lang['forgot_password_subheading']              = 'Silakan masukkan %s anda, agar kami dapat mengirim surel untuk mereset Kata Sandi Anda.';
$lang['forgot_password_email_label']             = '%s:';
$lang['forgot_password_submit_btn']              = 'Kirim';
$lang['forgot_password_validation_email_label']  = 'Alamat Surel';
$lang['forgot_password_identity_label']          = 'Nama Pengguna';
$lang['forgot_password_email_identity_label']    = 'Surel';
$lang['forgot_password_email_not_found']         = 'Tidak ada data dari surel tersebut.';
$lang['forgot_password_identity_not_found']      = 'Tidak ada data dari nama pengguna tersebut.';

// Reset Password
$lang['reset_password_heading']                               = 'Ganti Kata Sandi';
$lang['reset_password_new_password_label']                    = 'Kata Sandi Baru (paling sedikit %s karakter):';
$lang['reset_password_new_password_confirm_label']            = 'Konfirmasi Kata Sandi:';
$lang['reset_password_submit_btn']                            = 'Ubah';
$lang['reset_password_validation_new_password_label']         = 'Kata Sandi Baru';
$lang['reset_password_validation_new_password_confirm_label'] = 'Konfirmasi Kata Sandi Baru';


$lang['birth_date'] = 'Tanggal Lahir';
$lang['email_refer_user'] = 'DIREFERENSIKAN OLEH (USERNAME/EMAIL)';
$lang['lewatkan'] = 'Lewatkan';
$lang['desc_login'] = 'Daftar untuk mendapatkan akun gratis di toko kami. Pendaftaran cepat dan mudah. Ini memungkinkan Anda untuk dapat memesan dari toko kami. Untuk mulai berbelanja klik daftar.';
$lang['first_name'] = 'Nama Awal';
$lang['last_name'] = 'Nama Akhir';
$lang['phone'] = 'Telepon';
$lang['password'] = 'Kata Sandi';
$lang['confirm_password'] = 'Konfirmasi Kata Sandi';
$lang['referrer_user'] = 'referrer user';
$lang['placeholder_refferrer_email_username'] = 'Masukkan email atau username';
$lang['submit_button'] = 'Kirim';
$lang['skip_button'] = 'Lewati';

$lang['comment_sent_success'] = 'Berhasil mengirim momentar';
$lang['error_occured'] = 'Maaf, terjadi kesalahan. Silakan coba kembali';
$lang['quantity_more_than_0'] = 'Jumlah produk harus lebih dari 0';
$lang['cart_added'] = 'Berhasil menambahkan produk ke keranjang';
$lang['cart_deleted'] = 'Berhasil menghapus produk dari keranjang';
$lang['cart_updated'] = 'Berhasil memperbaharui keranjang';
$lang['no_product_cart'] = 'Tidak ada product di keranjang';
$lang['no_referr_to_self'] = 'Anda tidak bisa melakukan referral ke username/email anda sendiri.';
$lang['referral_email_not_found'] = 'Email/username referral tidak ditemukan';
$lang['success_exchange'] = 'Berhasil mengirim permintaan penukaran produk anda';
$lang['invalid_email_newsletter'] = 'Alamat email tidak valid!';
$lang['success_newsletter'] = 'Berhasil menambahkan alamat email anda!';
$lang['registered_newsletter'] = 'Alamat email sudah terdaftar!';
$lang['language_change'] = 'Berhasil mengubah bahasa';
$lang['compare_product_existed'] = 'Produk ini sudah tersedia di daftar compare';
$lang['compare_product_removed'] = 'Berhasil menghapus produk dari daftar compare';
$lang['review_added'] = 'Berhasil menambahkan ulasan';
$lang['already_put_referral'] = 'Kamu sudah memasukan user sebagai referral';
$lang['referr_sucess'] = 'Berhasil mengatur link referrer, lanjutkan belanja';
$lang['referr_not_found'] = 'Link referrer tidak tersedia';
$lang['request_refund_success'] = 'Berhasil mengirim permintaan refund';
$lang['success_referr'] = 'Berhasil menambahkan user referral';

$lang['exist_product_wishlist'] = 'Produk ini sudah tersedia di wishlist';

$lang['success_add_wishlist'] = 'Berhasil menambahkan produk ke wishlist';
$lang['success_deleted_wishlist'] = 'Berhasil menghapus produk dari wishlist';
$lang['failed_deleted_wishlist'] = 'Gagal menghapus produk dari wishlist';

$lang['not_allowed_delete_notification'] = 'Tidak boleh menghapus pemberitahuan';
$lang['notification_deleted'] = 'Berhasil menghapus pemberitahuan';

$lang['voucher_not_available'] = 'Voucher tidak tersedia';

$lang['minimum_purchase_1'] = 'Minimal item pembelian untuk menggunakan voucher ini : ';

$lang['referrer_voucher'] = 'Voucher ini dapat digunakan ketika lebih dari 1 user yang telah mereferrer anda';

$lang['birthday_voucher_message'] = 'Voucher ini dapat digunakan di bulan kelahiran anda';

$lang['birthday_voucher_message_2'] = 'Anda sudah menggunakan voucher ulang tahun untuk tahun ini';

$lang['voucher_code_not_available'] = 'Kode voucher tidak tersedia';

$lang['vip_voucher_not_avail'] = 'User Dengan Username Vip Voucher Tidak Tersedia';

$lang['cant_use_vip_voucher'] = 'Tidak Dapat Mengunakan VIP Voucher karna anda telah melakukan user referral';

$lang['user_redemption_404'] = 'User dengan username/email redemption voucher tidak tersedia';

$lang['user_redemption_cant'] = 'Voucher sudah digunakan atau username yang merekomendasikan anda tidak ditemukan';

$lang['voucher_already_used'] = 'Anda sudah memakai kode voucher ini';

$lang['member_not_valid'] = 'Member tidak valid';

$lang['success_use_voucher'] = 'Berhasil menambahkan voucher ';

$lang['voucher_invalid_for_product'] = 'Voucher tidak dapat digunakan untuk produk ini ';

$lang['renewal_voucher'] = ' Untuk renewal voucher ini Anda Harus memiliki total belanja yang sudah selesai adalah Rp 20.000.000 ,-';

$lang['desc_formreffer'] = "tuliskan username yang mereferensikan program ini kepada Anda";