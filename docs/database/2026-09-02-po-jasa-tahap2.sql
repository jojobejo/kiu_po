ALTER TABLE `tbpo_jasa_request`
  ADD COLUMN IF NOT EXISTS `completed_at` datetime DEFAULT NULL AFTER `generated_at`;

CREATE TABLE IF NOT EXISTS `tbpo_jasa_progress` (
  `id_progress_jasa` int(11) NOT NULL AUTO_INCREMENT,
  `kd_po_jasa` varchar(30) NOT NULL,
  `tgl_progress` date NOT NULL,
  `milestone` varchar(180) NOT NULL,
  `progress_persen` decimal(5,2) NOT NULL DEFAULT 0.00,
  `status_progress` varchar(50) NOT NULL,
  `catatan` text DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `created_name` varchar(120) DEFAULT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_progress_jasa`),
  KEY `idx_tbpo_jasa_progress_kd_po` (`kd_po_jasa`),
  KEY `idx_tbpo_jasa_progress_tgl` (`tgl_progress`),
  CONSTRAINT `fk_tbpo_jasa_progress_request` FOREIGN KEY (`kd_po_jasa`) REFERENCES `tbpo_jasa_request` (`kd_po_jasa`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `tbpo_jasa_file` (
  `id_file_jasa` int(11) NOT NULL AUTO_INCREMENT,
  `kd_po_jasa` varchar(30) NOT NULL,
  `jenis_dokumen` varchar(60) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `file_name` varchar(180) NOT NULL,
  `file_original` varchar(180) DEFAULT NULL,
  `file_ext` varchar(20) DEFAULT NULL,
  `file_size` decimal(10,2) DEFAULT NULL,
  `uploaded_by` varchar(50) DEFAULT NULL,
  `uploaded_name` varchar(120) DEFAULT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_file_jasa`),
  KEY `idx_tbpo_jasa_file_kd_po` (`kd_po_jasa`),
  KEY `idx_tbpo_jasa_file_jenis` (`jenis_dokumen`),
  CONSTRAINT `fk_tbpo_jasa_file_request` FOREIGN KEY (`kd_po_jasa`) REFERENCES `tbpo_jasa_request` (`kd_po_jasa`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `tbpo_jasa_biaya` (
  `id_biaya_jasa` int(11) NOT NULL AUTO_INCREMENT,
  `kd_po_jasa` varchar(30) NOT NULL,
  `tgl_biaya` date NOT NULL,
  `jenis_biaya` varchar(100) NOT NULL,
  `deskripsi_biaya` text NOT NULL,
  `nominal_estimasi` decimal(18,2) NOT NULL DEFAULT 0.00,
  `nominal_realisasi` decimal(18,2) NOT NULL DEFAULT 0.00,
  `selisih` decimal(18,2) NOT NULL DEFAULT 0.00,
  `no_invoice_vendor` varchar(100) DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `created_name` varchar(120) DEFAULT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_biaya_jasa`),
  KEY `idx_tbpo_jasa_biaya_kd_po` (`kd_po_jasa`),
  KEY `idx_tbpo_jasa_biaya_tgl` (`tgl_biaya`),
  CONSTRAINT `fk_tbpo_jasa_biaya_request` FOREIGN KEY (`kd_po_jasa`) REFERENCES `tbpo_jasa_request` (`kd_po_jasa`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE IF NOT EXISTS `tbpo_jasa_bast` (
  `id_bast_jasa` int(11) NOT NULL AUTO_INCREMENT,
  `kd_po_jasa` varchar(30) NOT NULL,
  `no_bast` varchar(80) NOT NULL,
  `tgl_bast` date NOT NULL,
  `penerima_pekerjaan` varchar(120) NOT NULL,
  `catatan_bast` text DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `created_name` varchar(120) DEFAULT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_bast_jasa`),
  UNIQUE KEY `uk_tbpo_jasa_bast_kd_po` (`kd_po_jasa`),
  KEY `idx_tbpo_jasa_bast_no` (`no_bast`),
  CONSTRAINT `fk_tbpo_jasa_bast_request` FOREIGN KEY (`kd_po_jasa`) REFERENCES `tbpo_jasa_request` (`kd_po_jasa`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
