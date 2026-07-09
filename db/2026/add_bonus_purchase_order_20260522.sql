ALTER TABLE `tbpo_tmp_item`
  ADD COLUMN `is_bonus` tinyint(1) NOT NULL DEFAULT 0 AFTER `total_harga`,
  ADD COLUMN `keterangan_bonus` text DEFAULT NULL AFTER `is_bonus`;

ALTER TABLE `tbpo_detail_po`
  ADD COLUMN `is_bonus` tinyint(1) NOT NULL DEFAULT 0 AFTER `hrg_total_diskon`,
  ADD COLUMN `keterangan_bonus` text DEFAULT NULL AFTER `is_bonus`;

ALTER TABLE `tbpo_tracking_po`
  ADD COLUMN `user_log` varchar(255) DEFAULT NULL AFTER `status`,
  ADD COLUMN `kode_user` varchar(100) DEFAULT NULL AFTER `user_log`,
  ADD COLUMN `data_lama` longtext DEFAULT NULL AFTER `kode_user`,
  ADD COLUMN `data_baru` longtext DEFAULT NULL AFTER `data_lama`;
