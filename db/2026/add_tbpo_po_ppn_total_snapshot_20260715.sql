SET @db_name = DATABASE();

SET @column_exists = (
    SELECT COUNT(*)
    FROM INFORMATION_SCHEMA.COLUMNS
    WHERE TABLE_SCHEMA = @db_name
      AND TABLE_NAME = 'tbpo_po'
      AND COLUMN_NAME = 'keterangan_harga_ppn'
);

SET @sql = IF(
    @column_exists = 0,
    'ALTER TABLE `tbpo_po` ADD COLUMN `keterangan_harga_ppn` VARCHAR(20) NOT NULL DEFAULT '''' AFTER `total_harga_diskon`',
    'SELECT "Column tbpo_po.keterangan_harga_ppn already exists"'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

SET @column_exists = (
    SELECT COUNT(*)
    FROM INFORMATION_SCHEMA.COLUMNS
    WHERE TABLE_SCHEMA = @db_name
      AND TABLE_NAME = 'tbpo_po'
      AND COLUMN_NAME = 'total_harga_include'
);

SET @sql = IF(
    @column_exists = 0,
    'ALTER TABLE `tbpo_po` ADD COLUMN `total_harga_include` DOUBLE NOT NULL DEFAULT 0 AFTER `keterangan_harga_ppn`',
    'SELECT "Column tbpo_po.total_harga_include already exists"'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

SET @column_exists = (
    SELECT COUNT(*)
    FROM INFORMATION_SCHEMA.COLUMNS
    WHERE TABLE_SCHEMA = @db_name
      AND TABLE_NAME = 'tbpo_po'
      AND COLUMN_NAME = 'total_harga_exlude'
);

SET @sql = IF(
    @column_exists = 0,
    'ALTER TABLE `tbpo_po` ADD COLUMN `total_harga_exlude` DOUBLE NOT NULL DEFAULT 0 AFTER `total_harga_include`',
    'SELECT "Column tbpo_po.total_harga_exlude already exists"'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

SET @column_exists = (
    SELECT COUNT(*)
    FROM INFORMATION_SCHEMA.COLUMNS
    WHERE TABLE_SCHEMA = @db_name
      AND TABLE_NAME = 'tbpo_po'
      AND COLUMN_NAME = 'total_harga_diskon_include'
);

SET @sql = IF(
    @column_exists = 0,
    'ALTER TABLE `tbpo_po` ADD COLUMN `total_harga_diskon_include` DOUBLE NOT NULL DEFAULT 0 AFTER `total_harga_exlude`',
    'SELECT "Column tbpo_po.total_harga_diskon_include already exists"'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

SET @column_exists = (
    SELECT COUNT(*)
    FROM INFORMATION_SCHEMA.COLUMNS
    WHERE TABLE_SCHEMA = @db_name
      AND TABLE_NAME = 'tbpo_po'
      AND COLUMN_NAME = 'total_harga_diskon_exlude'
);

SET @sql = IF(
    @column_exists = 0,
    'ALTER TABLE `tbpo_po` ADD COLUMN `total_harga_diskon_exlude` DOUBLE NOT NULL DEFAULT 0 AFTER `total_harga_diskon_include`',
    'SELECT "Column tbpo_po.total_harga_diskon_exlude already exists"'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;
