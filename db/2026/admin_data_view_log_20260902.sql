-- Log aktivitas untuk module Admin View Data.

CREATE TABLE IF NOT EXISTS `tbpo_admin_activity_log` (
  `id_log` int(11) NOT NULL AUTO_INCREMENT,
  `table_name` varchar(100) NOT NULL,
  `table_label` varchar(150) NOT NULL,
  `primary_key` varchar(100) NOT NULL,
  `primary_value` varchar(255) NOT NULL,
  `action` varchar(50) NOT NULL,
  `old_data` longtext NULL,
  `new_data` longtext NULL,
  `kode_user` varchar(25) NULL,
  `username` varchar(255) NULL,
  `nama_user` varchar(255) NULL,
  `ip_address` varchar(45) NULL,
  `user_agent` varchar(255) NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id_log`),
  KEY `idx_admin_activity_table` (`table_name`),
  KEY `idx_admin_activity_pk` (`primary_key`, `primary_value`),
  KEY `idx_admin_activity_user` (`kode_user`),
  KEY `idx_admin_activity_created` (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
