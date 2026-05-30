SET @database_name = DATABASE();

SET @sql = (
  SELECT IF(
    COUNT(*) = 0,
    'ALTER TABLE `tb_tmp_item` ADD COLUMN `isi` DECIMAL(15,2) DEFAULT 0 AFTER `qty`',
    'SELECT "Column tb_tmp_item.isi already exists"'
  )
  FROM INFORMATION_SCHEMA.COLUMNS
  WHERE TABLE_SCHEMA = @database_name
    AND TABLE_NAME = 'tb_tmp_item'
    AND COLUMN_NAME = 'isi'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

SET @sql = (
  SELECT IF(
    COUNT(*) = 0,
    'ALTER TABLE `tb_tmp_item` ADD COLUMN `kemasan` DECIMAL(15,2) DEFAULT 0 AFTER `isi`',
    'SELECT "Column tb_tmp_item.kemasan already exists"'
  )
  FROM INFORMATION_SCHEMA.COLUMNS
  WHERE TABLE_SCHEMA = @database_name
    AND TABLE_NAME = 'tb_tmp_item'
    AND COLUMN_NAME = 'kemasan'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

SET @sql = (
  SELECT IF(
    COUNT(*) = 0,
    'ALTER TABLE `tb_tmp_item` ADD COLUMN `qty_kecil` DECIMAL(15,2) DEFAULT 0 AFTER `kemasan`',
    'SELECT "Column tb_tmp_item.qty_kecil already exists"'
  )
  FROM INFORMATION_SCHEMA.COLUMNS
  WHERE TABLE_SCHEMA = @database_name
    AND TABLE_NAME = 'tb_tmp_item'
    AND COLUMN_NAME = 'qty_kecil'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

SET @sql = (
  SELECT IF(
    COUNT(*) = 0,
    'ALTER TABLE `tb_tmp_item` ADD COLUMN `harga_satuan_kecil` DECIMAL(15,2) DEFAULT 0 AFTER `harga_satuan`',
    'SELECT "Column tb_tmp_item.harga_satuan_kecil already exists"'
  )
  FROM INFORMATION_SCHEMA.COLUMNS
  WHERE TABLE_SCHEMA = @database_name
    AND TABLE_NAME = 'tb_tmp_item'
    AND COLUMN_NAME = 'harga_satuan_kecil'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

SET @sql = (
  SELECT IF(
    COUNT(*) = 0,
    'ALTER TABLE `tb_detail_po` ADD COLUMN `isi` DECIMAL(15,2) DEFAULT 0 AFTER `qty`',
    'SELECT "Column tb_detail_po.isi already exists"'
  )
  FROM INFORMATION_SCHEMA.COLUMNS
  WHERE TABLE_SCHEMA = @database_name
    AND TABLE_NAME = 'tb_detail_po'
    AND COLUMN_NAME = 'isi'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

SET @sql = (
  SELECT IF(
    COUNT(*) = 0,
    'ALTER TABLE `tb_detail_po` ADD COLUMN `kemasan` DECIMAL(15,2) DEFAULT 0 AFTER `isi`',
    'SELECT "Column tb_detail_po.kemasan already exists"'
  )
  FROM INFORMATION_SCHEMA.COLUMNS
  WHERE TABLE_SCHEMA = @database_name
    AND TABLE_NAME = 'tb_detail_po'
    AND COLUMN_NAME = 'kemasan'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

SET @sql = (
  SELECT IF(
    COUNT(*) = 0,
    'ALTER TABLE `tb_detail_po` ADD COLUMN `qty_kecil` DECIMAL(15,2) DEFAULT 0 AFTER `kemasan`',
    'SELECT "Column tb_detail_po.qty_kecil already exists"'
  )
  FROM INFORMATION_SCHEMA.COLUMNS
  WHERE TABLE_SCHEMA = @database_name
    AND TABLE_NAME = 'tb_detail_po'
    AND COLUMN_NAME = 'qty_kecil'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

SET @sql = (
  SELECT IF(
    COUNT(*) = 0,
    'ALTER TABLE `tb_detail_po` ADD COLUMN `harga_satuan_kecil` DECIMAL(15,2) DEFAULT 0 AFTER `hrg_satuan`',
    'SELECT "Column tb_detail_po.harga_satuan_kecil already exists"'
  )
  FROM INFORMATION_SCHEMA.COLUMNS
  WHERE TABLE_SCHEMA = @database_name
    AND TABLE_NAME = 'tb_detail_po'
    AND COLUMN_NAME = 'harga_satuan_kecil'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;
