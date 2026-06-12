SET @database_name = DATABASE();

SET @sql = (
  SELECT IF(
    COUNT(*) = 0,
    'ALTER TABLE `tb_detail_po` ADD COLUMN `harga_satuan_kecil_exclude` DECIMAL(18,4) NOT NULL DEFAULT 0.0000 AFTER `harga_satuan_kecil`',
    'SELECT "Column tb_detail_po.harga_satuan_kecil_exclude already exists"'
  )
  FROM INFORMATION_SCHEMA.COLUMNS
  WHERE TABLE_SCHEMA = @database_name
    AND TABLE_NAME = 'tb_detail_po'
    AND COLUMN_NAME = 'harga_satuan_kecil_exclude'
);
PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;

UPDATE `tb_detail_po` d
LEFT JOIN `tb_po` p ON p.`kd_po` = d.`kd_po`
SET d.`harga_satuan_kecil_exclude` = CASE
  WHEN COALESCE(p.`tax`, 0) > 0 THEN COALESCE(d.`harga_satuan_kecil`, 0) / (1 + (p.`tax` / 100))
  ELSE COALESCE(d.`harga_satuan_kecil`, 0)
END
WHERE COALESCE(d.`harga_satuan_kecil_exclude`, 0) = 0;
