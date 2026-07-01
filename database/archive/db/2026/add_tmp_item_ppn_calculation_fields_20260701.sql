SET @database_name = DATABASE();

SET @sql = (
  SELECT IF(
    COUNT(*) = 0,
    'ALTER TABLE `tb_tmp_item` ADD COLUMN `harga_satuan_exclude` DECIMAL(18,4) NOT NULL DEFAULT 0 AFTER `harga_satuan`',
    'SELECT "Column tb_tmp_item.harga_satuan_exclude already exists"'
  )
  FROM INFORMATION_SCHEMA.COLUMNS
  WHERE TABLE_SCHEMA = @database_name
    AND TABLE_NAME = 'tb_tmp_item'
    AND COLUMN_NAME = 'harga_satuan_exclude'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

SET @sql = (
  SELECT IF(
    COUNT(*) = 0,
    'ALTER TABLE `tb_tmp_item` ADD COLUMN `harga_satuan_kecil_exclude` DECIMAL(18,4) NOT NULL DEFAULT 0 AFTER `harga_satuan_kecil`',
    'SELECT "Column tb_tmp_item.harga_satuan_kecil_exclude already exists"'
  )
  FROM INFORMATION_SCHEMA.COLUMNS
  WHERE TABLE_SCHEMA = @database_name
    AND TABLE_NAME = 'tb_tmp_item'
    AND COLUMN_NAME = 'harga_satuan_kecil_exclude'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

SET @sql = (
  SELECT IF(
    COUNT(*) = 0,
    'ALTER TABLE `tb_tmp_item` ADD COLUMN `keterangan_harga_ppn` VARCHAR(20) NOT NULL DEFAULT '''' AFTER `keterangan_bonus`',
    'SELECT "Column tb_tmp_item.keterangan_harga_ppn already exists"'
  )
  FROM INFORMATION_SCHEMA.COLUMNS
  WHERE TABLE_SCHEMA = @database_name
    AND TABLE_NAME = 'tb_tmp_item'
    AND COLUMN_NAME = 'keterangan_harga_ppn'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

UPDATE `tb_tmp_item`
SET `harga_satuan_exclude` = `harga_satuan`
WHERE `harga_satuan_exclude` = 0 AND `harga_satuan` <> 0;

UPDATE `tb_tmp_item`
SET `harga_satuan_kecil_exclude` = `harga_satuan_kecil`
WHERE `harga_satuan_kecil_exclude` = 0 AND `harga_satuan_kecil` <> 0;
