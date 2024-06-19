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
$route['usersetting'] = 'user/C_User/usersetting';
$route['editPass'] = 'user/C_User/editPassword';

//auth
$route['login']     = 'auth/process';
$route['logout']   = 'auth/logout';
$route['dashboard'] = 'dashboard';

//suplier 
$route['suplier'] = 'Suplier/C_Suplier';
$route['add_suplier'] = 'purchaseorder/C_Order/addSuplier';

//PurchaseOrder
$route['purchase'] = 'purchaseorder/C_Order';
$route['purchase/sup/(:any)']  = 'purchaseorder/C_Order/purchaseSuplier/$1';
$route['purchase/listBarang/(:any)'] = 'purchaseorder/C_Order/listBarang/$1';
$route['addBarangSuplier'] = 'purchaseorder/C_Order/addBarang';
$route['editbarangsuplier'] = 'purchaseorder/C_Order/editBarangSuplier';
$route['editSuplier'] = 'purchaseorder/C_Order/editSuplier';
$route['editBarang'] = 'purchaseorder/C_Order/editBarang';
$route['tambahChart'] = 'purchaseorder/C_Order/addChart';
$route['addchart'] = 'purchase/C_Order/addChart';
$route['hapusBarang/(:any)/(:any)'] = 'purchaseorder/C_Order/hapusBarang/$1/$2';
$route['hapusChart/(:any)/(:any)'] = 'purchaseorder/C_Order/hapusChart/$1/$2';
$route['rekam_po'] = 'purchaseorder/C_Order/rekam_po';
$route['edit_barang_tmp'] = 'purchaseorder/C_Order/edit_barang_tmp';
$route['add_tax_tmp'] = 'purchaseorder/C_Order/add_tax_tmp';
$route['update_tax_tmp'] = 'purchaseorder/C_Order/update_tax_tmp';

//PurchaseOrderNonKomersil
$route['pononkomersil'] = 'purchaseorder/C_Order/pononkomersil';
$route['uploadfilegambaredit'] = 'purchaseorder/C_Order/uploadfilegambaredit';
$route['addtmpbarangnonkomersil'] = 'purchaseorder/C_Order/tmp_add_barang_komersil';
$route['edittmpbarangnonkomersil'] = 'purchaseorder/C_Order/tmp_edit_barang_komersil';
$route['hapustmpbarangnonkomersil'] = 'purchaseorder/C_Order/tmp_hapus_barang_komersil';
$route['addtmpdiskonnk'] = 'purchaseorder/C_Order/tmp_add_diskon_komersil';
$route['imgedit'] = 'purchaseorder/C_Order/imgedit';
$route['add_note_pembelian_tmp'] = 'purchaseorder/C_Order/add_note_pembelian_tmp';
$route['rekam_po_nk'] = 'purchaseorder/C_Order/rekam_po_nk';
$route['edit_note_pembelian_tmp'] = 'purchaseorder/C_Order/edit_note_pembelian_tmp';
$route['hapus_note_pembelian_tmp/(:any)'] = 'purchaseorder/C_Order/hapus_note_pembelian_tmp/$1';

//PurchaseOrderNonKomersil - STATUS
$route['postatusnk'] = 'postatus/C_PoStatus/postatusnk';
$route['postatusallnk'] = 'postatus/C_PoStatus/postatusallnk';
$route['detailponk/(:any)'] = 'postatus/C_PoStatus/detailponk/$1';
$route['add_faktur_item_nk'] = 'postatus/C_PoStatus/add_item_faktur_nk';
$route['noteupdatenk'] = 'postatus/C_PoStatus/addnotenk';
$route['noteupdatenk_pembelian'] = 'postatus/C_PoStatus/notepembelian';
$route['konfirm_penerimaan'] = 'postatus/C_PoStatus/konfirm_penerimaan';
$route['edit_harganyata'] = 'postatus/C_PoStatus/edit_harganyata';
$route['hrgnyataoff/(:any)'] = 'postatus/C_PoStatus/hrgnyataoff/$1';
$route['hrgnyataon/(:any)'] = 'postatus/C_PoStatus/hrgnyataon/$1';
$route['add_tax_nk'] = 'postatus/C_PoStatus/add_tax_fk_nk';
$route['add_diskon_nk'] = 'postatus/C_PoStatus/add_diskon_nk';
$route['editedponk'] = 'postatus/C_PoStatus/edited_fk_nk';
$route['add_note_pembelian_nk'] = 'postatus/C_PoStatus/add_note_pembelian_nk';
$route['edit_note_pembelian_nk'] = 'postatus/C_PoStatus/edit_note_pembelian_nk';
$route['hapus_note_pembelian_nk'] = 'postatus/C_PoStatus/hapus_note_pembelian_nk';
$route['gbruploadpic'] = 'postatus/C_PoStatus/gbruploadpic';
$route['edit_gbr_pndukung'] = 'postatus/C_PoStatus/edit_gbr_pndukung';
$route['delete_gbr_pendukung'] = 'postatus/C_PoStatus/delete_gbr_pendukung';

$route['addnopo'] = 'postatus/C_PoStatus/addnopo';

$route['edit_faktur_item_nk'] = 'postatus/C_PoStatus/edit_faktur_item_nk';
$route['hapus_faktur_item_nk'] = 'postatus/C_PoStatus/hapus_faktur_item_nk';
$route['addnotebarangsupliertmp'] = 'purchaseorder/C_Order/addnotebarangsupliertmp';
$route['edit_note_tmp_barang'] = 'purchaseorder/C_Order/edit_note_tmp_barang';
$route['hapus_note_tmp_barang'] = 'purchaseorder/C_Order/hapus_note_tmp_barang';
$route['add_diskon_po'] = 'purchaseorder/C_Order/add_diskon_po';
$route['edit_diskon_po'] = 'purchaseorder/C_Order/edit_diskon_po';
$route['hapus_diskon_po'] = 'purchaseorder/C_Order/hapus_diskon_po';
$route['add_diskon_barang_tmp'] = 'purchaseorder/C_Order/add_diskon_barang_tmp';
$route['add_diskon_barangs_tmp'] = 'purchaseorder/C_Order/add_diskon_barangs_tmp';
$route['unpostponk/(:any)']  = 'postatus/C_PoStatus/unpostponk/$1';
$route['hapusponk/(:any)']  = 'postatus/C_PoStatus/hapusponk/$1';

//postatus
$route['postatus'] = 'postatus/C_PoStatus/postatus';
$route['postatus/today'] = 'postatus/C_PoStatus';
$route['postatusall'] = 'postatus/C_PoStatus/postatus';
$route['postatus/postatusall/done'] = 'postatus/C_PoStatus/getDone';
$route['postatus/postatusall/onprogress'] = 'postatus/C_PoStatus/getOnProgress';
$route['postatus/postatusall/reject'] = 'postatus/C_PoStatus/getReject';
$route['postatus/onprogress'] = 'postatus/C_PoStatus/getOnProgres';
$route['postatus/done'] = 'postatus/C_PoStatus/getDone';
$route['postatus/reject'] = 'postatus/C_PoStatus/getReject';
$route['postatus/today/done'] = 'postatus/C_PoStatus/getDoneToday';
$route['postatus/today/onprogress'] = 'postatus/C_PoStatus/getOnProgresToday';
$route['postatus/today/reject'] = 'postatus/C_PoStatus/getRejectToday';
$route['konfirmasiOrderNK/(:any)/(:any)'] = 'postatus/C_PoStatus/konfirmasiOrderNK/$1/$2';
$route['konfirmasiOrderdirNK/(:any)/(:any)'] = 'postatus/C_PoStatus/konfirmasiOrderdirNK/$1/$2';
$route['tolakOrderNK/(:any)/(:any)'] = 'postatus/C_PoStatus/tolakOrderNK/$1/$2';
$route['pendingordernk'] = 'postatus/C_PoStatus/pendingordernk';
$route['porevisi'] = 'postatus/C_PoStatus/porevisi';
$route['uploadfileponk'] = 'postatus/C_PoStatus/uploadfileponk';
$route['repostponk/(:any)'] = 'postatus/C_PoStatus/repostponk/$1';

$route['detailPO/(:any)'] = 'postatus/C_PoStatus/detailPO/$1';
$route['update_printout_po'] = 'postatus/C_PoStatus/update_printout_po';

$route['printOrder/(:any)'] = 'postatus/C_PoStatus/printOrder/$1';
$route['printOrdernk/(:any)'] = 'postatus/C_PoStatus/printOrdernk/$1';
$route['konfirmasiOrder/(:any)/(:any)'] = 'postatus/C_PoStatus/konfirmasiOrder/$1/$2';
$route['tolakOrder/(:any)/(:any)'] = 'postatus/C_PoStatus/tolakOrder/$1/$2';
$route['cancel_po'] = 'postatus/C_PoStatus/cancel_po';
$route['NoteDirektur'] = 'postatus/C_PoStatus/addNote';
$route['addBarangRevisi/(:any)/(:any)'] = 'postatus/C_PoStatus/listBarangRevisi/$1/$2';
$route['tambahBarangRevisi'] = 'postatus/C_PoStatus/tambahBarangRevisi';
$route['revisiPO'] = 'postatus/C_PoStatus/revisiPO';
$route['hapusBarangPO/(:any)/(:any)'] = 'postatus/C_PoStatus/hapusBarangPO/$1/$2';
$route['note_barang_suplier']   = 'postatus/C_PoStatus/note_barang_suplier';
$route['note_barang_suplier_edit']   = 'postatus/C_PoStatus/note_barang_suplier_edit';
$route['note_barang_suplier_hapus']   = 'postatus/C_PoStatus/note_barang_suplier_hapus';
$route['searchPOdate']  = 'postatus/C_PoStatus/searchdatepo';
$route['repost_po']  = 'postatus/C_PoStatus/repostpo';
$route['edit_no_po']  = 'postatus/C_PoStatus/edit_no_po';
$route['unpostpo/(:any)']  = 'postatus/C_PoStatus/unpostpo/$1';
$route['hapuspo/(:any)']  = 'postatus/C_PoStatus/hapuspo/$1';
$route['insert_note_setting']  = 'postatus/C_PoStatus/insert_note_setting';

$route['NoteUpdateKeuangan'] = 'postatus/C_PoStatus/addNote';
$route['tambahTax'] = 'postatus/C_PoStatus/tambahTax';
$route['tempoPembayaran'] = 'postatus/C_PoStatus/tempoPembayaran';
$route['frankoPengiriman'] = 'postatus/C_PoStatus/frankoPengiriman';
$route['addDiskon'] = 'postatus/C_PoStatus/tambahDiskon';
$route['diskonEdit'] = 'postatus/C_PoStatus/editDiskon';
$route['hapusDiskon/(:any)/(:any)'] = 'postatus/C_PoStatus/hapusDiskon/$1/$2';
$route['hapusDiskonNk/(:any)/(:any)'] = 'postatus/C_PoStatus/hapusDiskonNK/$1/$2';
$route['add_diskon_barang'] = 'postatus/C_PoStatus/add_diskon_barang';
$route['add_diskon_barangs'] = 'postatus/C_PoStatus/add_diskon_barangs';

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
$route['addnotetemplate'] = 'settings/C_NoteSetting/add_note_template';
$route['notetemplate/(:any)'] = 'settings/C_NoteSetting/detail_note_template/$1';
$route['updateisinote'] = 'settings/C_NoteSetting/update_note_template';
