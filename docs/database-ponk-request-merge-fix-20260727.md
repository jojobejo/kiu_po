# Database Notes - Fix Merge Akun Draft Request PONK

Tanggal: 2026-07-27

## Status Database

Perubahan code sudah mengurangi risiko duplicate nomor lewat MySQL named lock. Namun database historis masih memiliki duplicate `kd_po_nk` dan duplicate generator, sehingga unique constraint belum boleh langsung dipasang sebelum cleanup data lama.

Tidak ada ALTER TABLE yang dieksekusi otomatis oleh development ini. Migration berikut disiapkan sebagai panduan database setelah data duplicate dibereskan.

## Tabel Terkait

- `tb_tmp_item_nk`: draft item request per user.
- `tb_generate_kd_ponk`: pencatat nomor PONK yang sudah di-reserve.
- `tb_req_nk`: header request barang non komersil.
- `tb_detail_req`: detail request barang non komersil.
- `tb_note_direktur`: note/log proses request.

## Bukti Duplicate Yang Ditemukan

Query read-only lokal menemukan duplicate pada generator:

```sql
SELECT kd_barang, COUNT(*) cnt, GROUP_CONCAT(id ORDER BY id) ids,
       MIN(create_at) first_at, MAX(create_at) last_at
FROM tb_generate_kd_ponk
GROUP BY kd_barang
HAVING COUNT(*) > 1
ORDER BY last_at DESC;
```

Contoh hasil:

- `NPONK2507260004` muncul 2 kali pada 2026-07-25.
- `NPONK2707260002` muncul 2 kali pada 2026-07-27.

Query read-only juga menemukan beberapa `kd_po_nk` lama yang pernah dipakai lebih dari satu akun:

```sql
SELECT r.kd_po_nk,
       COUNT(DISTINCT r.kd_user) header_users,
       COUNT(DISTINCT d.kd_user) detail_users,
       GROUP_CONCAT(DISTINCT CONCAT(r.kd_user, ':', r.nm_user) ORDER BY r.kd_user) req_users,
       GROUP_CONCAT(DISTINCT CONCAT(d.kd_user, ':', u.nama_user) ORDER BY d.kd_user) detail_user_names,
       COUNT(d.id_det_po_nk) detail_rows,
       MAX(r.create_at) last_update
FROM tb_req_nk r
LEFT JOIN tb_detail_req d ON d.kd_po_nk = r.kd_po_nk
LEFT JOIN tb_user u ON u.kode_user = d.kd_user
GROUP BY r.kd_po_nk
HAVING COUNT(DISTINCT r.kd_user) > 1
    OR COUNT(DISTINCT d.kd_user) > 1
ORDER BY last_update DESC;
```

## Migration Yang Direkomendasikan Setelah Cleanup

Jalankan query audit sampai hasil duplicate kosong. Setelah itu pasang constraint dan index berikut:

```sql
ALTER TABLE tb_generate_kd_ponk
  ADD UNIQUE KEY uk_generate_kd_ponk_kd_barang (kd_barang);

ALTER TABLE tb_req_nk
  ADD UNIQUE KEY uk_req_nk_kd_po_nk (kd_po_nk);

ALTER TABLE tb_detail_req
  ADD INDEX idx_detail_req_po_user (kd_po_nk, kd_user);

ALTER TABLE tb_tmp_item_nk
  ADD INDEX idx_tmp_item_nk_user_po (kd_user, jnis_po);

ALTER TABLE tb_note_direktur
  ADD INDEX idx_note_direktur_po_for (kd_po, note_for);
```

## Catatan Cleanup Data Lama

Untuk data duplicate lama, jangan hapus massal tanpa validasi dokumen fisik dan status bisnis. Cleanup harus diputuskan per `kd_po_nk`:

1. Cek header `tb_req_nk`.
2. Cek detail `tb_detail_req`.
3. Cek note `tb_note_direktur`.
4. Cek transaksi/pemakaian stock jika request sudah `DONE`.
5. Jika memang dua request berbeda, salah satu harus diberi nomor baru lalu seluruh relasi terkait disinkronkan.
6. Setelah tidak ada duplicate, baru jalankan unique constraint.

## Query Validasi Setelah Development

Pastikan request baru tidak lagi duplicate:

```sql
SELECT kd_barang, COUNT(*) cnt
FROM tb_generate_kd_ponk
WHERE DATE(create_at) = CURDATE()
GROUP BY kd_barang
HAVING COUNT(*) > 1;

SELECT kd_po_nk, COUNT(DISTINCT kd_user) user_count
FROM tb_req_nk
WHERE tgl_transaksi = CURDATE()
GROUP BY kd_po_nk
HAVING COUNT(DISTINCT kd_user) > 1;
```

Kedua query tersebut harus kosong untuk data baru.

