SET @database_name = DATABASE();

SET @sql = (
  SELECT IF(
    COUNT(*) = 0,
    'ALTER TABLE `tbpo_barang` ADD COLUMN `isi` DECIMAL(18,4) NOT NULL DEFAULT 1 AFTER `nama_barang`',
    'SELECT "Column tbpo_barang.isi already exists"'
  )
  FROM INFORMATION_SCHEMA.COLUMNS
  WHERE TABLE_SCHEMA = @database_name
    AND TABLE_NAME = 'tbpo_barang'
    AND COLUMN_NAME = 'isi'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

SET @sql = (
  SELECT IF(
    COUNT(*) = 0,
    'ALTER TABLE `tbpo_barang` ADD COLUMN `kemasan` DECIMAL(18,4) NOT NULL DEFAULT 0 AFTER `isi`',
    'SELECT "Column tbpo_barang.kemasan already exists"'
  )
  FROM INFORMATION_SCHEMA.COLUMNS
  WHERE TABLE_SCHEMA = @database_name
    AND TABLE_NAME = 'tbpo_barang'
    AND COLUMN_NAME = 'kemasan'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

SET @sql = (
  SELECT IF(
    COUNT(*) = 0,
    'ALTER TABLE `tbpo_tmp_item` ADD COLUMN `qty_kecil` DECIMAL(18,4) NOT NULL DEFAULT 0 AFTER `qty`',
    'SELECT "Column tbpo_tmp_item.qty_kecil already exists"'
  )
  FROM INFORMATION_SCHEMA.COLUMNS
  WHERE TABLE_SCHEMA = @database_name
    AND TABLE_NAME = 'tbpo_tmp_item'
    AND COLUMN_NAME = 'qty_kecil'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

SET @sql = (
  SELECT IF(
    COUNT(*) = 0,
    'ALTER TABLE `tbpo_tmp_item` ADD COLUMN `harga_satuan_kecil` DECIMAL(18,4) NOT NULL DEFAULT 0 AFTER `harga_satuan`',
    'SELECT "Column tbpo_tmp_item.harga_satuan_kecil already exists"'
  )
  FROM INFORMATION_SCHEMA.COLUMNS
  WHERE TABLE_SCHEMA = @database_name
    AND TABLE_NAME = 'tbpo_tmp_item'
    AND COLUMN_NAME = 'harga_satuan_kecil'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

SET @sql = (
  SELECT IF(
    COUNT(*) = 0,
    'ALTER TABLE `tbpo_detail_po` ADD COLUMN `qty_kecil` DECIMAL(18,4) NOT NULL DEFAULT 0 AFTER `qty`',
    'SELECT "Column tbpo_detail_po.qty_kecil already exists"'
  )
  FROM INFORMATION_SCHEMA.COLUMNS
  WHERE TABLE_SCHEMA = @database_name
    AND TABLE_NAME = 'tbpo_detail_po'
    AND COLUMN_NAME = 'qty_kecil'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

SET @sql = (
  SELECT IF(
    COUNT(*) = 0,
    'ALTER TABLE `tbpo_detail_po` ADD COLUMN `harga_satuan_kecil` DECIMAL(18,4) NOT NULL DEFAULT 0 AFTER `hrg_satuan`',
    'SELECT "Column tbpo_detail_po.harga_satuan_kecil already exists"'
  )
  FROM INFORMATION_SCHEMA.COLUMNS
  WHERE TABLE_SCHEMA = @database_name
    AND TABLE_NAME = 'tbpo_detail_po'
    AND COLUMN_NAME = 'harga_satuan_kecil'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

UPDATE `tbpo_tmp_item`
SET `qty_kecil` = `qty`
WHERE `qty_kecil` = 0 AND `qty` <> 0;

UPDATE `tbpo_tmp_item`
SET `harga_satuan_kecil` = `harga_satuan`
WHERE `harga_satuan_kecil` = 0 AND `harga_satuan` <> 0;

UPDATE `tbpo_detail_po`
SET `qty_kecil` = `qty`
WHERE `qty_kecil` = 0 AND `qty` <> 0;

UPDATE `tbpo_detail_po`
SET `harga_satuan_kecil` = `hrg_satuan`
WHERE `harga_satuan_kecil` = 0 AND `hrg_satuan` <> 0;
