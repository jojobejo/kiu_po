CREATE TABLE IF NOT EXISTS `tbpo_realisasi_po_nk` (
  `id_realisasi_po` int(11) NOT NULL AUTO_INCREMENT,
  `kd_po_nk` varchar(25) NOT NULL,
  `status_realisasi` varchar(30) NOT NULL DEFAULT 'DRAFT',
  `created_by` varchar(25) NOT NULL DEFAULT '',
  `updated_by` varchar(25) NOT NULL DEFAULT '',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_realisasi_po`),
  UNIQUE KEY `uq_realisasi_po_nk` (`kd_po_nk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `tbpo_realisasi_detail_po_nk` (
  `id_realisasi_detail` int(11) NOT NULL AUTO_INCREMENT,
  `kd_po_nk` varchar(25) NOT NULL,
  `id_det_po_nk` int(11) NOT NULL,
  `qty_pengajuan` decimal(15,2) NOT NULL DEFAULT 0.00,
  `harga_pengajuan` decimal(18,2) NOT NULL DEFAULT 0.00,
  `total_pengajuan` decimal(18,2) NOT NULL DEFAULT 0.00,
  `qty_nyata` decimal(15,2) NOT NULL DEFAULT 0.00,
  `harga_nyata` decimal(18,2) NOT NULL DEFAULT 0.00,
  `total_nyata` decimal(18,2) NOT NULL DEFAULT 0.00,
  `selisih_harga` decimal(18,2) NOT NULL DEFAULT 0.00,
  `status_approval_harga` varchar(30) NOT NULL DEFAULT 'BELUM_INPUT',
  `alasan_realisasi` text NULL,
  `created_by` varchar(25) NOT NULL DEFAULT '',
  `updated_by` varchar(25) NOT NULL DEFAULT '',
  `approved_by` varchar(25) NOT NULL DEFAULT '',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `approved_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_realisasi_detail`),
  UNIQUE KEY `uq_realisasi_detail_po_nk` (`id_det_po_nk`),
  KEY `idx_realisasi_detail_kd_po_nk` (`kd_po_nk`),
  KEY `idx_realisasi_detail_status_approval` (`status_approval_harga`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE IF NOT EXISTS `tbpo_realisasi_harganyata_log` (
  `id_log` int(11) NOT NULL AUTO_INCREMENT,
  `kd_po_nk` varchar(25) NOT NULL,
  `id_det_po_nk` int(11) NOT NULL DEFAULT 0,
  `aksi` varchar(40) NOT NULL,
  `keterangan` text NULL,
  `kd_user` varchar(25) NOT NULL DEFAULT '',
  `nama_user` varchar(100) NOT NULL DEFAULT '',
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id_log`),
  KEY `idx_log_realisasi_po_nk` (`kd_po_nk`),
  KEY `idx_log_realisasi_detail` (`id_det_po_nk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
