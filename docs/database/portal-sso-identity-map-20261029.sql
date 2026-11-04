-- Migration pemetaan identitas SSO Portal untuk POERP.
-- Tinjau dan buat cadangan database tujuan sebelum menerapkan perubahan.
CREATE TABLE IF NOT EXISTS `tb_portal_sso_identity_map` (
  `identity_hash` char(64) CHARACTER SET ascii COLLATE ascii_bin NOT NULL,
  `auth_source` varchar(100) NOT NULL,
  `sub` varchar(191) NOT NULL,
  `id_user` int(12) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`identity_hash`),
  KEY `idx_portal_sso_identity_map_user` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
