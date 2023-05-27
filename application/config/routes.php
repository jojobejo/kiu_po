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
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
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
$route['default_controller'] = 'auth';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//user
$route['user'] = 'User/C_User';
$route['adduser'] = 'user/C_User/AddUser';

//auth
$route['login']     = 'auth/process';
$route['logout']   = 'auth/logout';
$route['dashboard'] = 'dashboard';

//suplier 
$route['suplier'] = 'Suplier/C_Suplier';

//PurchaseOrder
$route['purchase'] = 'purchaseorder/C_Order';
$route['purchase/sup/(:any)']  = 'purchaseorder/C_Order/purchaseSuplier/$1';
$route['purchase/listBarang/(:any)'] = 'purchaseorder/C_Order/listBarang/$1';
$route['addBarangSuplier'] = 'purchaseorder/C_Order/addBarang';
$route['editSuplier'] = 'purchaseorder/C_Order/editSuplier';
$route['editBarang'] = 'purchaseorder/C_Order/editBarang';
$route['tambahChart'] = 'purchaseorder/C_Order/addChart';
$route['addchart'] = 'purchase/C_Order/addChart';
$route['hapusBarang/(:any)/(:any)'] = 'purchaseorder/C_Order/hapusBarang/$1/$2';
$route['hapusChart/(:any)/(:any)'] = 'purchaseorder/C_Order/hapusChart/$1/$2';
$route['rekam_po'] = 'purchaseorder/C_Order/rekam_po';

//postatus
$route['postatus'] = 'postatus/C_PoStatus';
$route['detailPO/(:any)'] = 'postatus/C_PoStatus/detailPO/$1';
$route['printOrder/(:any)'] = 'postatus/C_PoStatus/printOrder/$1';
$route['konfirmasiOrder/(:any)'] = 'postatus/C_PoStatus/konfirmasiOrder/$1';
$route['tolakOrder/(:any)'] = 'postatus/C_PoStatus/tolakOrder/$1';
$route['postatus/onprogress'] = 'postatus/C_PoStatus/getOnProgress';
$route['postatus/done'] = 'postatus/C_PoStatus/getDone';
$route['postatus/reject'] = 'postatus/C_PoStatus/getReject';
$route['NoteDirektur'] = 'postatus/C_PoStatus/addNote';
$route['addBarangRevisi/(:any)/(:any)'] = 'postatus/C_PoStatus/listBarangRevisi/$1/$2';
$route['tambahBarangRevisi'] = 'postatus/C_PoStatus/tambahBarangRevisi';
$route['revisiPO'] = 'postatus/C_PoStatus/revisiPO';
$route['hapusBarangPO/(:any)/(:any)'] = 'postatus/C_PoStatus/hapusBarangPO/$1/$2';

$route['NoteUpdateKeuangan'] = 'postatus/C_PoStatus/NoteUpdateKeuangan';
$route['tambahTax'] = 'postatus/C_PoStatus/tambahTax';
$route['tempoPembayaran'] = 'postatus/C_PoStatus/tempoPembayaran';
$route['frankoPengiriman'] = 'postatus/C_PoStatus/frankoPengiriman';
$route['addDiskon'] = 'postatus/C_PoStatus/tambahDiskon';
$route['diskonEdit'] = 'postatus/C_PoStatus/editDiskon';
$route['hapusDiskon/(:any)/(:any)'] = 'postatus/C_PoStatus/hapusDiskon/$1/$2';



//settings-tax
$route['taxseting'] = 'settings/C_TaxSetting';
$route['addSatuanPajak'] = 'settings/C_TaxSetting/addPajak';
$route['editSatuanPajak'] = 'settings/C_TaxSetting/editTax';
$route['hapusPajak/(:num)'] = 'settings/C_TaxSetting/hapusPajak/$1';

//setting-satuan
$route['satuansetting'] = 'settings/C_SatuanSetting';
$route['addSatuanBarang'] = 'settings/C_SatuanSetting/addSatuanBarang';
$route['editSatuanBarang'] = 'settings/C_SatuanSetting/editSatuan';
$route['hapusSatuan/(:num)'] = 'settings/C_SatuanSetting/hapusSatuan/$1';

//setting-template
$route['notetemplate'] = 'settings/C_NoteSetting';
