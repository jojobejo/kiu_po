SET @database_name = DATABASE();

SET @sql = (
  SELECT IF(
    COUNT(*) = 0,
    'ALTER TABLE `tbpo_detail_po` ADD COLUMN `harga_satuan_exclude` DECIMAL(18,4) NOT NULL DEFAULT 0 AFTER `hrg_satuan`',
    'SELECT "Column tbpo_detail_po.harga_satuan_exclude already exists"'
  )
  FROM INFORMATION_SCHEMA.COLUMNS
  WHERE TABLE_SCHEMA = @database_name
    AND TABLE_NAME = 'tbpo_detail_po'
    AND COLUMN_NAME = 'harga_satuan_exclude'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

SET @sql = (
  SELECT IF(
    COUNT(*) = 0,
    'ALTER TABLE `tbpo_detail_po` ADD COLUMN `harga_satuan_kecil_exclude` DECIMAL(18,4) NOT NULL DEFAULT 0 AFTER `harga_satuan_kecil`',
    'SELECT "Column tbpo_detail_po.harga_satuan_kecil_exclude already exists"'
  )
  FROM INFORMATION_SCHEMA.COLUMNS
  WHERE TABLE_SCHEMA = @database_name
    AND TABLE_NAME = 'tbpo_detail_po'
    AND COLUMN_NAME = 'harga_satuan_kecil_exclude'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

SET @sql = (
  SELECT IF(
    COUNT(*) = 0,
    'ALTER TABLE `tbpo_detail_po` ADD COLUMN `keterangan_harga_ppn` VARCHAR(20) NOT NULL DEFAULT '''' AFTER `keterangan_bonus`',
    'SELECT "Column tbpo_detail_po.keterangan_harga_ppn already exists"'
  )
  FROM INFORMATION_SCHEMA.COLUMNS
  WHERE TABLE_SCHEMA = @database_name
    AND TABLE_NAME = 'tbpo_detail_po'
    AND COLUMN_NAME = 'keterangan_harga_ppn'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

UPDATE `tbpo_detail_po`
SET `harga_satuan_exclude` = `hrg_satuan`
WHERE `harga_satuan_exclude` = 0 AND `hrg_satuan` <> 0;

UPDATE `tbpo_detail_po`
SET `harga_satuan_kecil_exclude` = `harga_satuan_kecil`
WHERE `harga_satuan_kecil_exclude` = 0 AND `harga_satuan_kecil` <> 0;
