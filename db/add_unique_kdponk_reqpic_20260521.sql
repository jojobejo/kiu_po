-- Proteksi duplicate kdponk request PIC non komersil.
-- Format kode tetap pola lama:
-- NPONK{ddmmyy}{0001}
-- Khusus KARYAWAN4:
-- GANPONK{ddmmyy}{0001}
--
-- Jalankan pengecekan duplicate sebelum menambahkan UNIQUE KEY.

SELECT kd_po_nk, COUNT(*) AS total
FROM tbpo_req_nk
GROUP BY kd_po_nk
HAVING COUNT(*) > 1;

ALTER TABLE tbpo_req_nk
ADD UNIQUE KEY uk_tb_req_nk_kd_po_nk (kd_po_nk);
