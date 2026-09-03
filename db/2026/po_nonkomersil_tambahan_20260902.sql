-- Module tambahan PO Non Komersil
-- Tanggal: 2026-09-02

ALTER TABLE `tbpo_detail_po_nk`
  ADD COLUMN IF NOT EXISTS `harga_lifo` DECIMAL(18,2) NOT NULL DEFAULT 0 AFTER `hrg_satuan`,
  ADD COLUMN IF NOT EXISTS `kd_po_lifo_ref` VARCHAR(25) NULL AFTER `harga_lifo`;

CREATE TABLE IF NOT EXISTS `tbpo_arsip_evident_ponk` (
  `id_arsip_evident` INT(11) NOT NULL AUTO_INCREMENT,
  `kd_po_nk` VARCHAR(25) NOT NULL,
  `jenis_evident` VARCHAR(60) NOT NULL,
  `keterangan` TEXT NULL,
  `file_path` VARCHAR(255) NOT NULL,
  `file_name` VARCHAR(255) NOT NULL,
  `file_uploaded` VARCHAR(255) NOT NULL,
  `file_original` VARCHAR(255) NULL,
  `file_ext` VARCHAR(20) NULL,
  `file_size` DECIMAL(12,2) NOT NULL DEFAULT 0,
  `source_table` VARCHAR(60) NULL,
  `source_id` INT(11) NULL,
  `user_upload` VARCHAR(25) NOT NULL,
  `create_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_arsip_evident`),
  KEY `idx_arsip_evident_ponk_kd` (`kd_po_nk`),
  KEY `idx_arsip_evident_ponk_jenis` (`jenis_evident`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `tbpo_arsip_evident_ponk`
  (`kd_po_nk`, `jenis_evident`, `keterangan`, `file_path`, `file_name`, `file_uploaded`, `source_table`, `source_id`, `user_upload`, `create_at`)
SELECT
  f.`kd_po_nk`,
  'FILE PENDUKUNG PENGAJUAN',
  f.`keterangan`,
  CONCAT('images/filepndukung/', f.`file_uploaded`),
  f.`file_name`,
  f.`file_uploaded`,
  'tbpo_file_nk',
  f.`id_file_nk`,
  f.`user_upload`,
  f.`create_at`
FROM `tbpo_file_nk` f
LEFT JOIN `tbpo_arsip_evident_ponk` a
  ON a.`source_table` = 'tbpo_file_nk' AND a.`source_id` = f.`id_file_nk`
WHERE a.`id_arsip_evident` IS NULL;

INSERT INTO `tbpo_arsip_evident_ponk`
  (`kd_po_nk`, `jenis_evident`, `keterangan`, `file_path`, `file_name`, `file_uploaded`, `source_table`, `source_id`, `user_upload`, `create_at`)
SELECT
  b.`kd_po_nk`,
  'BUKTI PEMBELIAN BARANG',
  b.`keterangan`,
  CONCAT('images/upbukti/', b.`file_uploaded`),
  b.`file_name`,
  b.`file_uploaded`,
  'tbpo_file_bukti_beli',
  b.`id_fk_bukti`,
  b.`user_upload`,
  b.`create_at`
FROM `tbpo_file_bukti_beli` b
LEFT JOIN `tbpo_arsip_evident_ponk` a
  ON a.`source_table` = 'tbpo_file_bukti_beli' AND a.`source_id` = b.`id_fk_bukti`
WHERE a.`id_arsip_evident` IS NULL;

CREATE TABLE IF NOT EXISTS `tbpo_stock_opname_nk` (
  `id_stock_opname` INT(11) NOT NULL AUTO_INCREMENT,
  `tgl_opname` DATE NOT NULL,
  `catatan` TEXT NULL,
  `total_item` INT(11) NOT NULL DEFAULT 0,
  `total_selisih_plus` DECIMAL(18,2) NOT NULL DEFAULT 0,
  `total_selisih_minus` DECIMAL(18,2) NOT NULL DEFAULT 0,
  `created_by` VARCHAR(25) NOT NULL,
  `created_name` VARCHAR(255) NULL,
  `created_at` DATETIME NOT NULL,
  PRIMARY KEY (`id_stock_opname`),
  KEY `idx_stock_opname_nk_tgl` (`tgl_opname`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `tbpo_stock_opname_nk_detail` (
  `id_stock_opname_detail` INT(11) NOT NULL AUTO_INCREMENT,
  `id_stock_opname` INT(11) NOT NULL,
  `kode_barang` VARCHAR(25) NOT NULL,
  `kode_barangs` VARCHAR(25) NOT NULL,
  `nama_barang` VARCHAR(255) NOT NULL,
  `qty_sistem` DECIMAL(18,2) NOT NULL DEFAULT 0,
  `qty_fisik` DECIMAL(18,2) NOT NULL DEFAULT 0,
  `selisih` DECIMAL(18,2) NOT NULL DEFAULT 0,
  `satuan` VARCHAR(60) NULL,
  `keterangan` TEXT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_stock_opname_detail`),
  KEY `idx_stock_opname_nk_detail_header` (`id_stock_opname`),
  KEY `idx_stock_opname_nk_detail_barang` (`kode_barang`, `kode_barangs`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
