-- Migrasi Stock Non Komersil - default minimum stock dan index performa.
-- Aman dijalankan berulang pada database production.

SET @database_name = DATABASE();

SET @sql = (
  SELECT IF(
    COUNT(*) = 0,
    'ALTER TABLE `tbpo_barang_nk` ADD COLUMN `minimum_stock` DECIMAL(18,2) NOT NULL DEFAULT 0 AFTER `satuan`',
    'ALTER TABLE `tbpo_barang_nk` MODIFY COLUMN `minimum_stock` DECIMAL(18,2) NOT NULL DEFAULT 0'
  )
  FROM INFORMATION_SCHEMA.COLUMNS
  WHERE TABLE_SCHEMA = @database_name
    AND TABLE_NAME = 'tbpo_barang_nk'
    AND COLUMN_NAME = 'minimum_stock'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

UPDATE `tbpo_barang_nk`
SET `minimum_stock` = 0
WHERE `minimum_stock` IS NULL;

SET @sql = (
  SELECT IF(
    COUNT(*) = 0,
    'ALTER TABLE `tbpo_barang_nk` ADD INDEX `idx_barang_nk_kd_barang` (`kd_barang`)',
    'SELECT "Index idx_barang_nk_kd_barang already exists"'
  )
  FROM INFORMATION_SCHEMA.STATISTICS
  WHERE TABLE_SCHEMA = @database_name
    AND TABLE_NAME = 'tbpo_barang_nk'
    AND INDEX_NAME = 'idx_barang_nk_kd_barang'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

SET @sql = (
  SELECT IF(
    COUNT(*) = 0,
    'ALTER TABLE `tbpo_barang_nk` ADD INDEX `idx_barang_nk_kd_lokasi` (`kd_lokasi`)',
    'SELECT "Index idx_barang_nk_kd_lokasi already exists"'
  )
  FROM INFORMATION_SCHEMA.STATISTICS
  WHERE TABLE_SCHEMA = @database_name
    AND TABLE_NAME = 'tbpo_barang_nk'
    AND INDEX_NAME = 'idx_barang_nk_kd_lokasi'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

SET @sql = (
  SELECT IF(
    COUNT(*) = 0,
    'ALTER TABLE `tbpo_transaksi` ADD INDEX `idx_transaksi_barang_akun` (`kd_barang`, `kd_akun`)',
    'SELECT "Index idx_transaksi_barang_akun already exists"'
  )
  FROM INFORMATION_SCHEMA.STATISTICS
  WHERE TABLE_SCHEMA = @database_name
    AND TABLE_NAME = 'tbpo_transaksi'
    AND INDEX_NAME = 'idx_transaksi_barang_akun'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

SET @sql = (
  SELECT IF(
    COUNT(*) = 0,
    'ALTER TABLE `tbpo_transaksi` ADD INDEX `idx_transaksi_barang_tanggal` (`kd_barang`, `tgl_transaksi`(10))',
    'SELECT "Index idx_transaksi_barang_tanggal already exists"'
  )
  FROM INFORMATION_SCHEMA.STATISTICS
  WHERE TABLE_SCHEMA = @database_name
    AND TABLE_NAME = 'tbpo_transaksi'
    AND INDEX_NAME = 'idx_transaksi_barang_tanggal'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;
