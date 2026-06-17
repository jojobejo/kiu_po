SET @database_name = DATABASE();

SET @sql = (
  SELECT IF(
    COUNT(*) = 0,
    'ALTER TABLE `tb_barang_nk` ADD COLUMN `minimum_stock` DECIMAL(18,2) NOT NULL DEFAULT 0 AFTER `satuan`',
    'SELECT "Column tb_barang_nk.minimum_stock already exists"'
  )
  FROM INFORMATION_SCHEMA.COLUMNS
  WHERE TABLE_SCHEMA = @database_name
    AND TABLE_NAME = 'tb_barang_nk'
    AND COLUMN_NAME = 'minimum_stock'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;
