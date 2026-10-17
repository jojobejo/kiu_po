-- Migrasi data kiupos (struktur lama) ke kiuponkomersil (struktur baru)
-- Sumber: C:\Users\bram\Downloads\u676129830_kiupos.sql
-- Target: C:\Users\bram\Downloads\u676129830_kiuponkomersil.sql
-- Mode: INSERT IGNORE; data target dengan primary key sama dipertahankan.
-- Jalankan setelah backup dan setelah kedua database tersedia pada server MySQL yang sama.

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;
START TRANSACTION;

-- tbq_module -> tbq_module
INSERT IGNORE INTO `kiuponkomersil`.`tbq_module` (`id_qmodule`, `kd_module`, `type_m`, `nm_module`, `m_status`, `create_at`, `update_at`, `lastupdated`)
SELECT `id_qmodule`, `kd_module`, `type_m`, `nm_module`, `m_status`, `create_at`, `update_at`, `lastupdated`
FROM `kiupos`.`tbq_module`;

-- tbq_nilaim -> tbq_nilaim
INSERT IGNORE INTO `kiuponkomersil`.`tbq_nilaim` (`id`, `kd_reviewq`, `kd_module`, `nilai`, `inputer`, `create_at`, `update_at`)
SELECT `id`, `kd_reviewq`, `kd_module`, `nilai`, `inputer`, `create_at`, `update_at`
FROM `kiupos`.`tbq_nilaim`;

-- tbq_review_pic -> tbq_review_pic
INSERT IGNORE INTO `kiuponkomersil`.`tbq_review_pic` (`id_review`, `kd_module`, `kd_reviewq`, `isi_review`, `nilai`, `inputer`, `create_at`, `update_at`)
SELECT `id_review`, `kd_module`, `kd_reviewq`, `isi_review`, `nilai`, `inputer`, `create_at`, `update_at`
FROM `kiupos`.`tbq_review_pic`;

-- tbq_review_q -> tbq_review_q
INSERT IGNORE INTO `kiuponkomersil`.`tbq_review_q` (`id_reviewq`, `kd_reviewq`, `kd_module`, `question`, `inputer`, `create_at`, `update_at`)
SELECT `id_reviewq`, `kd_reviewq`, `kd_module`, `question`, `inputer`, `create_at`, `update_at`
FROM `kiupos`.`tbq_review_q`;

-- tb_akun_tr -> tbpo_akun_tr
INSERT IGNORE INTO `kiuponkomersil`.`tbpo_akun_tr` (`id_akun`, `kd_akun`, `ket_akun`, `input_by`, `create_at`, `update_by`, `update_at`)
SELECT `id_akun`, `kd_akun`, `ket_akun`, `input_by`, `create_at`, `update_by`, `update_at`
FROM `kiupos`.`tb_akun_tr`;

-- tb_barang -> tbpo_barang
INSERT IGNORE INTO `kiuponkomersil`.`tbpo_barang` (`id_barang`, `kode_barang`, `kd_suplier`, `nama_barang`)
SELECT `id_barang`, `kode_barang`, `kd_suplier`, `nama_barang`
FROM `kiupos`.`tb_barang`;

-- tb_barang_nk -> tbpo_barang_nk
INSERT IGNORE INTO `kiuponkomersil`.`tbpo_barang_nk` (`id_brg_nk`, `kd_barang`, `kd_br_adm`, `kat_barang`, `nama_barang`, `descnk`, `satuan`, `minimum_stock`, `gbr_barang`, `qrcode_path`, `qrcode_data`, `inputer`, `create_at`, `last_updated`, `update_at`, `kd_lokasi`)
SELECT `id_brg_nk`, `kd_barang`, `kd_br_adm`, `kat_barang`, `nama_barang`, `descnk`, `satuan`, `minimum_stock`, `gbr_barang`, `qrcode_path`, `qrcode_data`, `inputer`, `create_at`, `last_updated`, `update_at`, `kd_lokasi`
FROM `kiupos`.`tb_barang_nk`;

-- tb_barang_nk_lokasi -> tbpo_barang_nk_lokasi
INSERT IGNORE INTO `kiuponkomersil`.`tbpo_barang_nk_lokasi` (`id_lokasi`, `nama_lokasi`)
SELECT `id_lokasi`, `nama_lokasi`
FROM `kiupos`.`tb_barang_nk_lokasi`;

-- tb_detail_po -> tbpo_detail_po
INSERT IGNORE INTO `kiuponkomersil`.`tbpo_detail_po` (`id_det_po`, `kd_po`, `no_po`, `tgl_transaksi`, `kd_suplier`, `kd_barang`, `nama_barang`, `satuan`, `qty`, `hrg_satuan`, `hrg_total`, `kd_user`, `create_at`)
SELECT `id_det_po`, `kd_po`, `no_po`, `tgl_transaksi`, `kd_suplier`, `kd_barang`, `nama_barang`, `satuan`, `qty`, `hrg_satuan`, `hrg_total`, `kd_user`, `create_at`
FROM `kiupos`.`tb_detail_po`;

-- tb_detail_po_nk -> tbpo_detail_po_nk
INSERT IGNORE INTO `kiuponkomersil`.`tbpo_detail_po_nk` (`id_det_po_nk`, `kd_po_nk`, `kd_po_req`, `kd_user`, `tgl_transaksi`, `kd_bsys`, `kd_barang`, `nama_barang`, `deskripsi`, `keterangan`, `qty`, `satuan`, `kat_barang`, `hrg_satuan`, `hrg_nyata`, `total_harga`, `total_nyata`, `gbr_produk`, `create_at`)
SELECT `id_det_po_nk`, `kd_po_nk`, `kd_po_req`, `kd_user`, `tgl_transaksi`, `kd_bsys`, `kd_barang`, `nama_barang`, `deskripsi`, `keterangan`, `qty`, `satuan`, `kat_barang`, `hrg_satuan`, `hrg_nyata`, `total_harga`, `total_nyata`, `gbr_produk`, `create_at`
FROM `kiupos`.`tb_detail_po_nk`;

-- tb_detail_req -> tbpo_detail_req
INSERT IGNORE INTO `kiuponkomersil`.`tbpo_detail_req` (`id_det_po_nk`, `kd_po_nk`, `kd_user`, `tgl_transaksi`, `kd_bsys`, `kd_barang`, `nama_barang`, `deskripsi`, `keterangan`, `qty`, `satuan`, `kat_barang`, `status`, `sts_done`, `create_at`)
SELECT `id_det_po_nk`, `kd_po_nk`, `kd_user`, `tgl_transaksi`, `kd_bsys`, `kd_barang`, `nama_barang`, `deskripsi`, `keterangan`, `qty`, `satuan`, `kat_barang`, `status`, `sts_done`, `create_at`
FROM `kiupos`.`tb_detail_req`;

-- tb_diskon -> tbpo_diskon
INSERT IGNORE INTO `kiuponkomersil`.`tbpo_diskon` (`id_diskon`, `kd_po`, `kd_suplier`, `keterangan`, `nominal`)
SELECT `id_diskon`, `kd_po`, `kd_suplier`, `keterangan`, `nominal`
FROM `kiupos`.`tb_diskon`;

-- tb_file_bukti_beli -> tbpo_file_bukti_beli
INSERT IGNORE INTO `kiuponkomersil`.`tbpo_file_bukti_beli` (`id_fk_bukti`, `kd_po_nk`, `keterangan`, `user_upload`, `file_name`, `file_uploaded`, `create_at`)
SELECT `id_fk_bukti`, `kd_po_nk`, `keterangan`, `user_upload`, `file_name`, `file_uploaded`, `create_at`
FROM `kiupos`.`tb_file_bukti_beli`;

-- tb_file_nk -> tbpo_file_nk
INSERT IGNORE INTO `kiuponkomersil`.`tbpo_file_nk` (`id_file_nk`, `kd_po_nk`, `keterangan`, `user_upload`, `file_name`, `file_uploaded`, `create_at`)
SELECT `id_file_nk`, `kd_po_nk`, `keterangan`, `user_upload`, `file_name`, `file_uploaded`, `create_at`
FROM `kiupos`.`tb_file_nk`;

-- tb_generateqrcode -> tbpo_generateqrcode
INSERT IGNORE INTO `kiuponkomersil`.`tbpo_generateqrcode` (`id_gqrcode`, `kd_qrcode`, `create_at`)
SELECT `id_gqrcode`, `kd_qrcode`, `create_at`
FROM `kiupos`.`tb_generateqrcode`;

-- tb_generate_kd -> tbpo_generate_kd
INSERT IGNORE INTO `kiuponkomersil`.`tbpo_generate_kd` (`id`, `kd_barang`, `create_at`)
SELECT `id`, `kd_barang`, `create_at`
FROM `kiupos`.`tb_generate_kd`;

-- tb_generate_kd_ponk -> tbpo_generate_kd_ponk
INSERT IGNORE INTO `kiuponkomersil`.`tbpo_generate_kd_ponk` (`id`, `kd_barang`, `create_at`)
SELECT `id`, `kd_barang`, `create_at`
FROM `kiupos`.`tb_generate_kd_ponk`;

-- tb_kat_br -> tbpo_kat_br
INSERT IGNORE INTO `kiuponkomersil`.`tbpo_kat_br` (`id_kat_br`, `kd_kat`, `nama_kategori`, `keterangan`)
SELECT `id_kat_br`, `kd_kat`, `nama_kategori`, `keterangan`
FROM `kiupos`.`tb_kat_br`;

-- tb_notetemplate -> tbpo_notetemplate
INSERT IGNORE INTO `kiuponkomersil`.`tbpo_notetemplate` (`id_nt_template`, `kd_nt_template`, `nama_note`, `shipment_to`, `alamat_ship`, `cp_shipment`, `no_cp`, `ket_1`, `ket_2`, `create_at`)
SELECT `id_nt_template`, `kd_nt_template`, `nama_note`, `shipment_to`, `alamat_ship`, `cp_shipment`, `no_cp`, `ket_1`, `ket_2`, `create_at`
FROM `kiupos`.`tb_notetemplate`;

-- tb_note_barang -> tbpo_note_barang
INSERT IGNORE INTO `kiuponkomersil`.`tbpo_note_barang` (`id_nt_barang`, `kd_po`, `kd_suplier`, `isi_note`, `color_box`, `create_at`)
SELECT `id_nt_barang`, `kd_po`, `kd_suplier`, `isi_note`, `color_box`, `create_at`
FROM `kiupos`.`tb_note_barang`;

-- tb_note_direktur -> tbpo_note_direktur
INSERT IGNORE INTO `kiuponkomersil`.`tbpo_note_direktur` (`id_note`, `kd_po`, `isi_note`, `kd_user`, `nama_user`, `note_for`, `update_status`, `create_at`, `log_create`)
SELECT `id_note`, `kd_po`, `isi_note`, `kd_user`, `nama_user`, `note_for`, `update_status`, `create_at`, `log_create`
FROM `kiupos`.`tb_note_direktur`;

-- tb_note_pembelian -> tbpo_note_pembelian
INSERT IGNORE INTO `kiuponkomersil`.`tbpo_note_pembelian` (`id_nt_pembelian`, `kd_po`, `keterangan`, `kd_user`, `create_at`)
SELECT `id_nt_pembelian`, `kd_po`, `keterangan`, `kd_user`, `create_at`
FROM `kiupos`.`tb_note_pembelian`;

-- tb_nt_tmp_pembelian -> tbpo_nt_tmp_pembelian
INSERT IGNORE INTO `kiuponkomersil`.`tbpo_nt_tmp_pembelian` (`id_tmp_nt_pembelian`, `keterangan`, `kd_user`, `create_at`)
SELECT `id_tmp_nt_pembelian`, `keterangan`, `kd_user`, `create_at`
FROM `kiupos`.`tb_nt_tmp_pembelian`;

-- tb_po -> tbpo_po
INSERT IGNORE INTO `kiuponkomersil`.`tbpo_po` (`id_po`, `kd_po`, `no_po`, `tgl_transaksi`, `kd_suplier`, `jml_item`, `total_harga`, `status`, `tax`, `hrg_pajak`, `tmpo_pembayaran`, `gdg_pengiriman`, `acc_with`, `kd_printout_note`, `create_at`)
SELECT `id_po`, `kd_po`, `no_po`, `tgl_transaksi`, `kd_suplier`, `jml_item`, `total_harga`, `status`, `tax`, `hrg_pajak`, `tmpo_pembayaran`, `gdg_pengiriman`, `acc_with`, `kd_printout_note`, `create_at`
FROM `kiupos`.`tb_po`;

-- tb_po_nk -> tbpo_po_nk
INSERT IGNORE INTO `kiuponkomersil`.`tbpo_po_nk` (`id_po_nk`, `jns_po`, `kd_po_nk`, `kd_po_req`, `nopo`, `kd_user`, `nm_user`, `tgl_transaksi`, `jml_item`, `total_harga`, `status`, `departemen`, `tj_pembelian`, `tax`, `hrg_pajak`, `hrg_nyata`, `status_hrg_nyata`, `acc_with`, `acc_with_kadep`, `create_at`)
SELECT `id_po_nk`, `jns_po`, `kd_po_nk`, `kd_po_req`, `nopo`, `kd_user`, `nm_user`, `tgl_transaksi`, `jml_item`, `total_harga`, `status`, `departemen`, `tj_pembelian`, `tax`, `hrg_pajak`, `hrg_nyata`, `status_hrg_nyata`, `acc_with`, `acc_with_kadep`, `create_at`
FROM `kiupos`.`tb_po_nk`;

-- tb_ratings -> tbpo_ratings
INSERT IGNORE INTO `kiuponkomersil`.`tbpo_ratings` (`id_rating`, `kd_user`, `kdq_rate`, `u_rate`, `inpt_by`, `create_at`, `update_by`, `update_at`)
SELECT `id_rating`, `kd_user`, `kdq_rate`, `u_rate`, `inpt_by`, `create_at`, `update_by`, `update_at`
FROM `kiupos`.`tb_ratings`;

-- tb_req_masterbarang -> tbpo_req_masterbarang
INSERT IGNORE INTO `kiuponkomersil`.`tbpo_req_masterbarang` (`id_reqmbarang`, `nama_barang`, `deskripsi`, `satuan`, `req_by`)
SELECT `id_reqmbarang`, `nama_barang`, `deskripsi`, `satuan`, `req_by`
FROM `kiupos`.`tb_req_masterbarang`;

-- tb_req_nk -> tbpo_req_nk
INSERT IGNORE INTO `kiuponkomersil`.`tbpo_req_nk` (`id_po_nk`, `jns_po`, `kd_po_nk`, `kd_user`, `nm_user`, `tgl_transaksi`, `tgl_ambil`, `jml_item`, `status`, `departemen`, `tj_pembelian`, `acc_with`, `create_at`)
SELECT `id_po_nk`, `jns_po`, `kd_po_nk`, `kd_user`, `nm_user`, `tgl_transaksi`, `tgl_ambil`, `jml_item`, `status`, `departemen`, `tj_pembelian`, `acc_with`, `create_at`
FROM `kiupos`.`tb_req_nk`;

-- tb_satuan -> tbpo_satuan
INSERT IGNORE INTO `kiuponkomersil`.`tbpo_satuan` (`id_satuan`, `nm_satuan`)
SELECT `id_satuan`, `nm_satuan`
FROM `kiupos`.`tb_satuan`;

-- tb_set_note -> tbpo_set_note
INSERT IGNORE INTO `kiuponkomersil`.`tbpo_set_note` (`id_set_note`, `note`)
SELECT `id_set_note`, `note`
FROM `kiupos`.`tb_set_note`;

-- tb_set_tax -> tbpo_set_tax
INSERT IGNORE INTO `kiuponkomersil`.`tbpo_set_tax` (`id_tax`, `nm_tax`)
SELECT `id_tax`, `nm_tax`
FROM `kiupos`.`tb_set_tax`;

-- tb_sosialisasi -> tbpo_sosialisasi
INSERT IGNORE INTO `kiuponkomersil`.`tbpo_sosialisasi` (`id`, `module`, `kd_user`, `status_nkomersil`, `create_at`, `done_at`)
SELECT `id`, `module`, `kd_user`, `status_nkomersil`, `create_at`, `done_at`
FROM `kiupos`.`tb_sosialisasi`;

-- tb_suplier -> tbpo_suplier
INSERT IGNORE INTO `kiuponkomersil`.`tbpo_suplier` (`id_suplier`, `kd_suplier`, `nama_suplier`, `alamat_suplier`, `no_telpon`, `no_fax`, `email`, `gbr_logo`)
SELECT `id_suplier`, `kd_suplier`, `nama_suplier`, `alamat_suplier`, `no_telpon`, `no_fax`, `email`, `gbr_logo`
FROM `kiupos`.`tb_suplier`;

-- tb_tmp_diskon -> tbpo_tmp_diskon
INSERT IGNORE INTO `kiuponkomersil`.`tbpo_tmp_diskon` (`id_tmp_diskon`, `kd_suplier`, `nama_diskon`, `nominal`, `create_at`)
SELECT `id_tmp_diskon`, `kd_suplier`, `nama_diskon`, `nominal`, `create_at`
FROM `kiupos`.`tb_tmp_diskon`;

-- tb_tmp_item -> tbpo_tmp_item
INSERT IGNORE INTO `kiuponkomersil`.`tbpo_tmp_item` (`id_tmp`, `kode_barang`, `kd_user`, `nama_barang`, `kode_suplier`, `satuan`, `qty`, `harga_satuan`, `total_harga`)
SELECT `id_tmp`, `kode_barang`, `kd_user`, `nama_barang`, `kode_suplier`, `satuan`, `qty`, `harga_satuan`, `total_harga`
FROM `kiupos`.`tb_tmp_item`;

-- tb_tmp_item_nk -> tbpo_tmp_item_nk
INSERT IGNORE INTO `kiuponkomersil`.`tbpo_tmp_item_nk` (`id_tmp_nk`, `jnis_po`, `nama_barang`, `deskripsi`, `keterangan`, `qty`, `satuan`, `hrg_satuan`, `total_harga`, `kd_bsys`, `kd_barang`, `kat_barang`, `kd_user`, `create_at`)
SELECT `id_tmp_nk`, `jnis_po`, `nama_barang`, `deskripsi`, `keterangan`, `qty`, `satuan`, `hrg_satuan`, `total_harga`, `kd_bsys`, `kd_barang`, `kat_barang`, `kd_user`, `create_at`
FROM `kiupos`.`tb_tmp_item_nk`;

-- tb_tmp_note_barang -> tbpo_tmp_note_barang
INSERT IGNORE INTO `kiuponkomersil`.`tbpo_tmp_note_barang` (`id_nt_tmp_barang`, `kd_suplier`, `isi_note`, `create_at`)
SELECT `id_nt_tmp_barang`, `kd_suplier`, `isi_note`, `create_at`
FROM `kiupos`.`tb_tmp_note_barang`;

-- tb_tmp_tax -> tbpo_tmp_tax
INSERT IGNORE INTO `kiuponkomersil`.`tbpo_tmp_tax` (`id_tmp_tax`, `kd_suplier`, `tax`)
SELECT `id_tmp_tax`, `kd_suplier`, `tax`
FROM `kiupos`.`tb_tmp_tax`;

-- tb_tracking_po -> tbpo_tracking_po
INSERT IGNORE INTO `kiuponkomersil`.`tbpo_tracking_po` (`id_po_tracking`, `kd_po`, `status`, `createat`)
SELECT `id_po_tracking`, `kd_po`, `status`, `createat`
FROM `kiupos`.`tb_tracking_po`;

-- tb_transaksi -> tbpo_transaksi
INSERT IGNORE INTO `kiuponkomersil`.`tbpo_transaksi` (`id_transnk`, `kd_akun`, `kd_po_nk`, `kd_barang`, `kd_barangsys`, `keterangan`, `kat_barang`, `tr_qty`, `satuan`, `inputer`, `req_by`, `tgl_transaksi`, `create_at`, `last_updated_by`, `update_at`)
SELECT `id_transnk`, `kd_akun`, `kd_po_nk`, `kd_barang`, `kd_barangsys`, `keterangan`, `kat_barang`, `tr_qty`, `satuan`, `inputer`, `req_by`, `tgl_transaksi`, `create_at`, `last_updated_by`, `update_at`
FROM `kiupos`.`tb_transaksi`;

-- tb_transaksi_tmp -> tbpo_transaksi_tmp
INSERT IGNORE INTO `kiuponkomersil`.`tbpo_transaksi_tmp` (`id_transnk`, `kd_akun`, `kd_po_nk`, `kd_barang`, `kd_barangsys`, `kat_barang`, `tr_qty`, `satuan`, `hrg_satuan`, `status`, `keterangan`, `inputer`, `create_at`, `last_updated_by`, `update_at`)
SELECT `id_transnk`, `kd_akun`, `kd_po_nk`, `kd_barang`, `kd_barangsys`, `kat_barang`, `tr_qty`, `satuan`, `hrg_satuan`, `status`, `keterangan`, `inputer`, `create_at`, `last_updated_by`, `update_at`
FROM `kiupos`.`tb_transaksi_tmp`;

-- tb_transaksi_trashbin -> tbpo_transaksi_trashbin
INSERT IGNORE INTO `kiuponkomersil`.`tbpo_transaksi_trashbin` (`id_trashbin`, `kd_akun`, `kd_po_nk`, `kd_barang`, `kd_barangsys`, `keterangan`, `kat_barang`, `tr_qty`, `satuan`, `inputer`, `req_by`, `tgl_transaksi`, `create_at`, `last_updated_by`)
SELECT `id_trashbin`, `kd_akun`, `kd_po_nk`, `kd_barang`, `kd_barangsys`, `keterangan`, `kat_barang`, `tr_qty`, `satuan`, `inputer`, `req_by`, `tgl_transaksi`, `create_at`, `last_updated_by`
FROM `kiupos`.`tb_transaksi_trashbin`;

-- tb_user -> tbpo_user
INSERT IGNORE INTO `kiuponkomersil`.`tbpo_user` (`id_user`, `kode_user`, `nama_user`, `username`, `password`, `aksess_lv`, `departement`)
SELECT `id_user`, `kode_user`, `nama_user`, `username`, `password`, `aksess_lv`, `departement`
FROM `kiupos`.`tb_user`;

COMMIT;
SET FOREIGN_KEY_CHECKS = 1;

-- Validasi ringkas:
-- SELECT COUNT(*) AS rows_old FROM `kiupos`.`tb_po`;
-- SELECT COUNT(*) AS rows_new FROM `kiuponkomersil`.`tbpo_po`;
-- Ulangi validasi untuk tabel transaksi/detail/master yang relevan.

