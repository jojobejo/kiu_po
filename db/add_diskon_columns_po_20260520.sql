ALTER TABLE `tb_detail_po`
  ADD COLUMN `hrg_diskon` double NOT NULL DEFAULT 0 AFTER `hrg_satuan`,
  ADD COLUMN `hrg_total_diskon` double NOT NULL DEFAULT 0 AFTER `hrg_total`;

ALTER TABLE `tb_po`
  ADD COLUMN `total_harga_diskon` double NOT NULL DEFAULT 0 AFTER `total_harga`;

UPDATE `tb_detail_po`
SET `hrg_diskon` = `hrg_satuan`
WHERE `hrg_diskon` = 0;

UPDATE `tb_detail_po`
SET `hrg_total_diskon` = `hrg_total`
WHERE `hrg_total_diskon` = 0;

UPDATE `tb_po`
SET `total_harga_diskon` = `total_harga`
WHERE `total_harga_diskon` = 0;
