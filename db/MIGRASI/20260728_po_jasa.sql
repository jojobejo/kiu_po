-- Migration: PO Jasa module
-- Date: 2026-07-28
-- Scope: New standalone service-purchase tables. This script does not alter existing PO, PONK, stock, or supplier tables.

CREATE TABLE IF NOT EXISTS `tb_pojasa_vendor` (
  `id_vendor_jasa` int(11) NOT NULL AUTO_INCREMENT,
  `kd_vendor_jasa` varchar(25) NOT NULL,
  `nama_vendor` varchar(180) NOT NULL,
  `kategori_jasa` varchar(120) NOT NULL,
  `alamat_vendor` text NOT NULL,
  `kontak_person` varchar(120) NOT NULL,
  `no_telpon` varchar(60) NOT NULL,
  `email` varchar(180) NOT NULL,
  `npwp` varchar(80) NOT NULL,
  `status_vendor` enum('AKTIF','NONAKTIF') NOT NULL DEFAULT 'AKTIF',
  `created_by` varchar(25) NOT NULL,
  `updated_by` varchar(25) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_vendor_jasa`),
  UNIQUE KEY `uk_tb_pojasa_vendor_kd` (`kd_vendor_jasa`),
  KEY `idx_tb_pojasa_vendor_status` (`status_vendor`),
  KEY `idx_tb_pojasa_vendor_kategori` (`kategori_jasa`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `tb_pojasa_generate` (
  `id_generate_jasa` int(11) NOT NULL AUTO_INCREMENT,
  `kd_pojasa` varchar(25) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_generate_jasa`),
  UNIQUE KEY `uk_tb_pojasa_generate_kd` (`kd_pojasa`),
  KEY `idx_tb_pojasa_generate_created` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `tb_pojasa_request` (
  `id_pojasa` int(11) NOT NULL AUTO_INCREMENT,
  `kd_pojasa` varchar(25) NOT NULL,
  `tgl_request` date NOT NULL,
  `tgl_kebutuhan` date NOT NULL,
  `kd_user` varchar(25) NOT NULL,
  `nm_user` varchar(180) NOT NULL,
  `departemen` varchar(120) NOT NULL,
  `kd_vendor_jasa` varchar(25) NOT NULL,
  `judul_jasa` varchar(220) NOT NULL,
  `lokasi_jasa` varchar(220) NOT NULL,
  `kegiatan_jasa` text NOT NULL,
  `alasan_kebutuhan` text NOT NULL,
  `catatan_pengajuan` text NOT NULL,
  `prioritas` enum('RENDAH','NORMAL','URGENT') NOT NULL DEFAULT 'NORMAL',
  `tax_percent` decimal(8,2) NOT NULL DEFAULT 0.00,
  `tax_amount` decimal(18,2) NOT NULL DEFAULT 0.00,
  `total_estimasi` decimal(18,2) NOT NULL DEFAULT 0.00,
  `grand_total` decimal(18,2) NOT NULL DEFAULT 0.00,
  `status_request` varchar(40) NOT NULL DEFAULT 'DRAFT',
  `approved_kadep_by` varchar(25) NOT NULL DEFAULT '',
  `approved_kadep_at` datetime DEFAULT NULL,
  `approved_direktur_by` varchar(25) NOT NULL DEFAULT '',
  `approved_direktur_at` datetime DEFAULT NULL,
  `closed_at` datetime DEFAULT NULL,
  `created_by` varchar(25) NOT NULL,
  `updated_by` varchar(25) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id_pojasa`),
  UNIQUE KEY `uk_tb_pojasa_request_kd` (`kd_pojasa`),
  KEY `idx_tb_pojasa_request_vendor` (`kd_vendor_jasa`),
  KEY `idx_tb_pojasa_request_user` (`kd_user`),
  KEY `idx_tb_pojasa_request_departemen` (`departemen`),
  KEY `idx_tb_pojasa_request_status` (`status_request`),
  KEY `idx_tb_pojasa_request_tanggal` (`tgl_request`, `tgl_kebutuhan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `tb_pojasa_biaya` (
  `id_biaya_jasa` int(11) NOT NULL AUTO_INCREMENT,
  `kd_pojasa` varchar(25) NOT NULL,
  `jenis_biaya` enum('JASA','OPERASIONAL','BAHAN','LAIN_LAIN') NOT NULL,
  `nama_biaya` varchar(180) NOT NULL,
  `keterangan_biaya` text NOT NULL,
  `qty` decimal(18,2) NOT NULL DEFAULT 1.00,
  `satuan` varchar(40) NOT NULL,
  `nominal` decimal(18,2) NOT NULL DEFAULT 0.00,
  `subtotal` decimal(18,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_biaya_jasa`),
  KEY `idx_tb_pojasa_biaya_kd` (`kd_pojasa`),
  KEY `idx_tb_pojasa_biaya_jenis` (`jenis_biaya`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `tb_pojasa_log` (
  `id_log_jasa` int(11) NOT NULL AUTO_INCREMENT,
  `kd_pojasa` varchar(25) NOT NULL,
  `aktivitas` varchar(180) NOT NULL,
  `status_dari` varchar(40) NOT NULL,
  `status_ke` varchar(40) NOT NULL,
  `catatan` text NOT NULL,
  `kd_user` varchar(25) NOT NULL,
  `nama_user` varchar(180) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_log_jasa`),
  KEY `idx_tb_pojasa_log_kd` (`kd_pojasa`),
  KEY `idx_tb_pojasa_log_user` (`kd_user`),
  KEY `idx_tb_pojasa_log_created` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
