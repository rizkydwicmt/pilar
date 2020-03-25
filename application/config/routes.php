<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['admin/default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['admin/404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['admin/translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
// $route['admin/Supir'] 				=	'Control_Supir';
// $route['admin/DetailSupir/(:num)'] = 	'Control_Supir/index/$1';
//front
$route['default_controller'] = 'P_Home';
$route['kontak'] = 'P_Kontak';
$route['login'] = 'P_Login';
$route['register'] = 'P_Register';
$route['lostpassword'] = 'P_Password';
$route['keranjang'] = 'P_Keranjang';
$route['checkout'] = 'P_Checkout';
$route['kurir'] = 'P_Kurir';
$route['profil'] = 'P_Profil';
$route['pengaturan'] = 'P_Profil/settingprofil';
$route['ubahpassword'] = 'P_Profil/ubahpassword';
$route['riwayatbelanja'] = 'P_Profil/riwayatbelanja';
$route['invoice'] = 'P_Invoice';
$route['logout'] = 'P_Kontak/logout';
//$route['belanja'] = 'welcome/shop';
//$route['upload'] = 'welcome/upload';
//$route['keranjang'] = 'welcome/keranjang';
//$route['checkout'] = 'welcome/checkout';
//$route['kurir'] = 'welcome/kurir';
//$route['invoice'] = 'welcome/invoice';
//$route['ongkir'] = 'welcome/ongkir';
//$route['prosesco'] = 'welcome/prosesco';
//$route['ujicoba'] = 'welcome/ujicoba';

//$route['kontak'] = 'welcome/kontak';
//$route['coba'] = 'welcome/coba';
//$route['proseskeranjang'] = 'welcome/proseskeranjang';
//$route['produk'] = 'welcome/detailshop';
//$route['masuk'] = 'welcome/login';
//$route['daftar'] = 'welcome/register';
//$route['lostpassword'] = 'welcome/lupapass';
$route['404_override'] = '';

//back

$route['admin'] = 'Login';
$route['admin/404_override'] = '';
$route['admin/translate_uri_dashes'] = FALSE;


/*
 * ============ Routes dari Master DATA =============*
 * ===== URL == ( if:num == id) =	== Controller == *
 */
$route['admin/Beranda']					=	'Admin';
$route['admin/Pegawai']					=	'Control_Pegawai';
$route['admin/DetailPegawai/(:num)']		=	'Control_Pegawai/index/$1';
$route['admin/Pelanggan']					=	'Control_Pelanggan';
$route['admin/DetailPelanggan/(:num)']	=	'Control_Pelanggan/index/$1';
$route['admin/Domba']					=	'Control_Domba';

/*
 * ============ Routes dari Transaksi ============= *
 */

$route['admin/Transaksi'] 					=	'T_Transaksi';
$route['admin/Transaksi/print'] 			=	'T_Transaksi/print_tagihan';
$route['admin/Transaksi/print/(:any)']		=	'T_Transaksi/print_tagihan/$1';
$route['admin/Transaksi/print_invoice/(:any)'] = 'T_Transaksi/invoice/$1';
$route['admin/DetailTransaksi/(:num)']		=	'T_Transaksi/index/$1';
$route['admin/addTransaksi'] 			=	'T_TambahTransaksi';
$route['admin/addTransaksi/(:num)']		=	'T_TambahTransaksi/index/$1';
$route['admin/Pembayaran'] 			=	'T_Pembayaran';
$route['admin/Pengiriman'] 			=	'T_Pengiriman';

/*
 * ============ Routes dari Laporan ============= *
 */
$route['admin/LapTransaksi'] 		=	'L_Transaksi';
$route['admin/403-Forbidden']  		=	 'S_Forbidden';
