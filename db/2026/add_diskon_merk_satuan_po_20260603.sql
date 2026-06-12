SET @database_name = DATABASE();

CREATE TABLE IF NOT EXISTS `tbpo_diskon_merk` (
  `id_diskon` INT(11) NOT NULL AUTO_INCREMENT,
  `no_po` VARCHAR(50) DEFAULT NULL,
  `merk_barang` VARCHAR(255) NOT NULL,
  `satuan_diskon` ENUM('BOX','PCS','LTR','KG') NOT NULL,
  `nominal_diskon` DECIMAL(15,2) NOT NULL DEFAULT 0,
  `created_by` VARCHAR(100) DEFAULT NULL,
  `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` DATETIME DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_diskon`),
  KEY `idx_no_po` (`no_po`),
  KEY `idx_merk_barang` (`merk_barang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

SET @sql = (
  SELECT IF(
    COUNT(*) = 0,
    'ALTER TABLE `tb_detail_po` ADD COLUMN `id_diskon_merk` INT(11) DEFAULT NULL AFTER `hrg_total_diskon`',
    'SELECT "Column tb_detail_po.id_diskon_merk already exists"'
  )
  FROM INFORMATION_SCHEMA.COLUMNS
  WHERE TABLE_SCHEMA = @database_name
    AND TABLE_NAME = 'tb_detail_po'
    AND COLUMN_NAME = 'id_diskon_merk'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

SET @sql = (
  SELECT IF(
    COUNT(*) = 0,
    'ALTER TABLE `tb_detail_po` ADD COLUMN `satuan_diskon` VARCHAR(10) DEFAULT NULL AFTER `id_diskon_merk`',
    'SELECT "Column tb_detail_po.satuan_diskon already exists"'
  )
  FROM INFORMATION_SCHEMA.COLUMNS
  WHERE TABLE_SCHEMA = @database_name
    AND TABLE_NAME = 'tb_detail_po'
    AND COLUMN_NAME = 'satuan_diskon'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

SET @sql = (
  SELECT IF(
    COUNT(*) = 0,
    'ALTER TABLE `tb_detail_po` ADD COLUMN `nominal_diskon` DECIMAL(15,2) NOT NULL DEFAULT 0 AFTER `satuan_diskon`',
    'SELECT "Column tb_detail_po.nominal_diskon already exists"'
  )
  FROM INFORMATION_SCHEMA.COLUMNS
  WHERE TABLE_SCHEMA = @database_name
    AND TABLE_NAME = 'tb_detail_po'
    AND COLUMN_NAME = 'nominal_diskon'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

SET @sql = (
  SELECT IF(
    COUNT(*) = 0,
    'ALTER TABLE `tb_detail_po` ADD COLUMN `diskon_satuan_kecil` DECIMAL(15,2) NOT NULL DEFAULT 0 AFTER `nominal_diskon`',
    'SELECT "Column tb_detail_po.diskon_satuan_kecil already exists"'
  )
  FROM INFORMATION_SCHEMA.COLUMNS
  WHERE TABLE_SCHEMA = @database_name
    AND TABLE_NAME = 'tb_detail_po'
    AND COLUMN_NAME = 'diskon_satuan_kecil'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

SET @sql = (
  SELECT IF(
    COUNT(*) = 0,
    'ALTER TABLE `tb_detail_po` ADD COLUMN `harga_satuan_kecil_setelah_diskon` DECIMAL(15,2) NOT NULL DEFAULT 0 AFTER `diskon_satuan_kecil`',
    'SELECT "Column tb_detail_po.harga_satuan_kecil_setelah_diskon already exists"'
  )
  FROM INFORMATION_SCHEMA.COLUMNS
  WHERE TABLE_SCHEMA = @database_name
    AND TABLE_NAME = 'tb_detail_po'
    AND COLUMN_NAME = 'harga_satuan_kecil_setelah_diskon'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

SET @sql = (
  SELECT IF(
    COUNT(*) = 0,
    'ALTER TABLE `tb_detail_po` ADD COLUMN `total_harga_setelah_diskon` DECIMAL(15,2) NOT NULL DEFAULT 0 AFTER `harga_satuan_kecil_setelah_diskon`',
    'SELECT "Column tb_detail_po.total_harga_setelah_diskon already exists"'
  )
  FROM INFORMATION_SCHEMA.COLUMNS
  WHERE TABLE_SCHEMA = @database_name
    AND TABLE_NAME = 'tb_detail_po'
    AND COLUMN_NAME = 'total_harga_setelah_diskon'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;
