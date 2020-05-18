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
$route['default_controller'] = 'P_Home';
$route['kontak'] = 'P_Home/kontak';
$route['cek_pesanan'] = 'P_Home/cek_pesanan';
$route['admin'] = 'Login';
$route['admin/404_override'] = '';
$route['admin/translate_uri_dashes'] = FALSE;

/*
 * ============ Routes dari Master DATA =============*
 * ===== URL == ( if:num == id) =	== Controller == *
 */
$route['admin/Beranda']					=	'Admin';
$route['admin/Pegawai']					=	'Control_Pegawai';
$route['admin/DetailPegawai/(:num)']	=	'Control_Pegawai/index/$1';
$route['admin/Pelanggan']				=	'Control_Pelanggan';
$route['admin/DetailPelanggan/(:num)']	=	'Control_Pelanggan/index/$1';
$route['admin/Domba']					=	'Control_Domba';

/*
 * ============ Routes dari Transaksi ============= *
 */

$route['admin/Transaksi'] 					=	'T_Transaksi';
$route['admin/Transaksi/print/(:any)']		=	'T_Transaksi/print_nota/$1';
$route['admin/DetailTransaksi/(:num)']		=	'T_Transaksi/index/$1';
$route['admin/addTransaksi'] 			    =	'T_TambahTransaksi';
$route['admin/Pembayaran'] 			        =	'T_Pembayaran';
$route['admin/Pengiriman'] 			        =	'T_Pengiriman';

/*
 * ============ Routes dari Laporan ============= *
 */
$route['admin/LapTransaksi'] 		=	'L_Transaksi';
$route['admin/LapPengiriman'] 		=	'L_Pengiriman';
$route['admin/403-Forbidden']  		=	'S_Forbidden';
