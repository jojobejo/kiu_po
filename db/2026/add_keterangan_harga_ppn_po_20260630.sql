SET @db_name = DATABASE();

SET @column_exists = (
    SELECT COUNT(*)
    FROM INFORMATION_SCHEMA.COLUMNS
    WHERE TABLE_SCHEMA = @db_name
      AND TABLE_NAME = 'tb_tmp_item'
      AND COLUMN_NAME = 'keterangan_harga_ppn'
);

SET @sql = IF(
    @column_exists = 0,
    'ALTER TABLE `tb_tmp_item` ADD COLUMN `keterangan_harga_ppn` VARCHAR(20) NOT NULL DEFAULT '''' AFTER `keterangan_bonus`',
    'SELECT "Column tb_tmp_item.keterangan_harga_ppn already exists"'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

SET @column_exists = (
    SELECT COUNT(*)
    FROM INFORMATION_SCHEMA.COLUMNS
    WHERE TABLE_SCHEMA = @db_name
      AND TABLE_NAME = 'tb_detail_po'
      AND COLUMN_NAME = 'keterangan_harga_ppn'
);

SET @sql = IF(
    @column_exists = 0,
    'ALTER TABLE `tb_detail_po` ADD COLUMN `keterangan_harga_ppn` VARCHAR(20) NOT NULL DEFAULT '''' AFTER `keterangan_bonus`',
    'SELECT "Column tb_detail_po.keterangan_harga_ppn already exists"'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;
