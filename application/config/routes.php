<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|  example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|  https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|  $route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|  $route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|  $route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:  my-controller/index  -> my_controller/index
|    my-controller/my-method  -> my_controller/my_method
*/

// $route['default_controller'] = 'home';
$route['default_controller'] = 'home';
$route['404_override'] = 'NotFondController';
$route['translate_uri_dashes'] = FALSE;


// Autentikasi 
$route['login'] = 'auth/login';
$route['logout'] = 'auth/logout';
$route['register'] = 'auth/register';
//$route['reg/(:any)'] = 'auth/reg/$1'; //ebe
$route['usersedit/(:num)'] = 'auth/edit_user_byuser/$1';
$route['forgotpassword'] = 'auth/forgot_password';

//Reseller
$route['reg_reseller/(:any)'] = 'reseller/register/$1';
$route['login_reseller'] = 'reseller/login';
$route['cekreseller'] = 'reseller/cekReseller';
$route['reg/(:any)'] = 'reseller/reg/$1'; //ebe

// Menu Product
$route['product'] = 'ProductController/index';
$route['product/(:num)'] = 'ProductController/index/$1';
//$route['product/kategori/(:num)/(:num)'] = 'ProductController/produkKategori/$1/$2';
//$route['product/kategori/(:num)'] = 'ProductController/produkKategori/$1';
$route['product/kategori/(:num)'] = 'ProductController/get_product/$1';
$route['product/detail/(:any)'] = 'ProductController/detailProduct/$1';


// Menu User ======================================================= 
$route['users'] = 'UserController/index';

// Add Refer User
$route['users/refer'] = 'UserController/userRefer';
$route['users/refer/save'] = 'UserController/saveReferUser';

// view Refer User
$route['refer'] = 'ReferUserController/index';


// user Refund
$route['requestrefund'] = 'RequestRefundController/index';
$route['requestrefund/save'] = 'RequestRefundController/saveRefund';
$route['requestrefund/history'] = 'RequestRefundController/historyRefund';

// User Exchange

$route['users/exchange'] = 'ExchangeController/index';
$route['users/exchangesave'] = 'ExchangeController/saveExchange';
$route['users/exchangehistory'] = 'ExchangeController/historyExchange';
$route['users/exchangeresi/(:num)'] = 'ExchangeController/add_resi/$1';


// user Notifications
$route['notifications'] = 'UserNotificationController/index';
$route['notifications/read/(:num)'] = 'UserNotificationController/readNotification/$1';
$route['notifications/del/(:num)'] = 'UserNotificationController/delNotification/$1';

// komisi
$route['users/komisi'] = 'KomisiController/index';
$route['users/infokomisi'] = 'KomisiController/info_komisi';
$route['users/withdraw'] = 'KomisiController/withdraw';
$route['users/deposit'] = 'KomisiController/deposit';
$route['users/request'] = 'KomisiController/request_withdraw';
$route['requestwithdraw/save'] = 'KomisiController/save_withdraw';
$route['users/members/(:any)'] = 'MembersController/index/$1';
$route['users/membersfulltree/(:any)'] = 'MembersController/detail_members/$1';
$route['users/download'] = 'MembersController/download';
//$route['users/rinciankomisi/(:any)'] = 'KomisiController/rincian_komisi/$1';

// Purchase history
$route['users/purchasehistory'] = 'PurchasehistoryController/orderTerima';
$route['users/purchaseproses'] = 'PurchasehistoryController/orderProses';
$route['users/sedangdikirim'] = 'PurchasehistoryController/sedangDikirim';
$route['users/sampaitujuan'] = 'PurchasehistoryController/sampaiTujuan';
$route['users/purchasebatal'] = 'PurchasehistoryController/orderBatal';
$route['users/orderselesai/(:num)'] = 'PurchasehistoryController/orderUpdateSelesai/$1';

// User Voucher
$route['users/voucher'] = 'VoucherController/listVoucher';
$route['add/voucher'] = 'VoucherController/addVoucherCekout';
$route['add/kodevoucher'] = 'VoucherController/addKodeVoucher';

// User Indent
$route['users/indent'] = 'IndentUserController/index';

// Cart
$route['cart'] = 'CartController/index';
$route['cart/add'] = 'CartController/addChart';
$route['cart/del/(:any)'] = 'CartController/delChart/$1';
$route['cart/update'] = 'CartController/updateCart';


// Order

$route['cekout'] = 'CekOutController/index';
$route['cekout/save'] = 'CekOutController/cekoutCek';

$route['order/detail/(:num)'] = 'OrderController/orderDetail/$1';


// Bloh
$route['blog'] = 'BlogController/index';
$route['blog/detail/(:any)'] = 'BlogController/detailBlog/$1';

// Store
$route['store'] = 'StoreController/index';

// Gallery
$route['gallery'] = 'GalleryController/index';

// Pages
$route['pages/(:any)'] = 'PagesController/index/$1';



// wishlist
$route['add_to_wishlist/(:num)'] = 'UserController/add_to_wishlist/$1';
$route['wishlist'] = 'UserController/wishlist';
$route['delete_wishlist/(:num)'] = 'UserController/delete_wishlist/$1';

// faq
$route['faq'] = 'PagesController/faq';

// Compares
$route['compare'] = 'ProductController/compare';
$route['add_to_compare/(:num)'] = 'ProductController/add_to_compare/$1';
$route['delete_compareproduct/(:num)'] = 'ProductController/delete_compareproduct/$1';


$route['submit_review/(:num)'] = 'ProductController/submit_review/$1';

$route['submit_comment/(:num)'] = 'BlogController/submit_comment/$1';


// CronJobs

$route['cekusergold'] = 'UserMemberCekController/cekUserGold';
$route['cekuserplatinum'] = 'UserMemberCekController/cekUserPlatinum';
$route['cekuserdiamond'] = 'UserMemberCekController/cekUserDiamond';

// Untuk Link Reffer

$route['id/(:any)'] = 'ReferLinkController/linkReffer/$1';


$route['percobaan'] = 'UserMemberCekController/percobaan';
