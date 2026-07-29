# Database PO Jasa - 2026-07-28

## Tujuan database

Menambahkan tabel baru khusus PO Jasa agar data jasa tidak bercampur dengan PO barang, PONK barang, stok non-komersil, atau master `tb_suplier`.

## File SQL

- `db/MIGRASI/20260728_po_jasa.sql`

## Tabel baru

### `tb_pojasa_vendor`

Master vendor khusus jasa.

Field penting:

- `kd_vendor_jasa`: kode vendor jasa, unique.
- `nama_vendor`: nama vendor.
- `kategori_jasa`: kategori pekerjaan jasa.
- `status_vendor`: `AKTIF` atau `NONAKTIF`.
- `created_by`, `updated_by`: audit user.

### `tb_pojasa_generate`

Pencatat nomor PO Jasa yang sudah di-reserve.

Field penting:

- `kd_pojasa`: nomor PO Jasa yang sudah pernah diambil generator.
- `created_at`: waktu nomor di-reserve.

Tabel ini dipakai bersama MySQL named lock agar double-submit paralel tidak menghasilkan nomor PO Jasa yang sama.

### `tb_pojasa_request`

Header request/PO Jasa.

Field penting:

- `kd_pojasa`: nomor request PO Jasa, unique.
- `kd_user`, `nm_user`, `departemen`: identitas PIC pembuat request.
- `kd_vendor_jasa`: vendor dari `tb_pojasa_vendor`.
- `judul_jasa`, `lokasi_jasa`, `kegiatan_jasa`, `alasan_kebutuhan`: konteks pekerjaan.
- `tax_percent`, `tax_amount`, `total_estimasi`, `grand_total`: ringkasan biaya.
- `status_request`: status lifecycle modul.
- `approved_kadep_by`, `approved_direktur_by`, `closed_at`: titik kontrol approval/closing.

### `tb_pojasa_biaya`

Detail biaya per request.

Jenis biaya:

- `JASA`
- `OPERASIONAL`
- `BAHAN`
- `LAIN_LAIN`

Field penting:

- `kd_pojasa`: penghubung ke header.
- `nama_biaya`: nama komponen biaya.
- `qty`, `satuan`, `nominal`, `subtotal`: nilai biaya.

### `tb_pojasa_log`

Histori aktivitas PO Jasa.

Field penting:

- `kd_pojasa`: nomor PO Jasa.
- `aktivitas`: nama aktivitas.
- `status_dari`, `status_ke`: perubahan status.
- `catatan`: catatan user.
- `kd_user`, `nama_user`, `created_at`: audit pelaku dan waktu.

## Tidak ada perubahan tabel lama

Migration ini tidak mengubah:

- `tb_suplier`
- `tb_po`
- `tb_detail_po`
- `tb_po_nk`
- `tb_detail_po_nk`
- `tb_req_nk`
- `tb_detail_req`
- `tb_tmp_item_nk`
- `tb_transaksi`

## Index dan constraint

- `tb_pojasa_vendor.kd_vendor_jasa` unique.
- `tb_pojasa_generate.kd_pojasa` unique.
- `tb_pojasa_request.kd_pojasa` unique.
- Index status, tanggal, departemen, user, dan vendor disiapkan untuk list AJAX.
- Belum memakai foreign key fisik agar aman terhadap pola database legacy yang sudah berjalan.

## Cara import

Gunakan MySQL/XAMPP:

```sql
SOURCE C:/xampp/htdocs/kiu_po/db/MIGRASI/20260728_po_jasa.sql;
```

Atau import file SQL melalui phpMyAdmin ke database `kiucoid_po`.

## Query pemeriksaan

```sql
SHOW TABLES LIKE 'tb_pojasa_%';

SELECT COUNT(*) AS total_vendor
FROM tb_pojasa_vendor;

SELECT status_request, COUNT(*) AS total
FROM tb_pojasa_request
GROUP BY status_request;
```

## Verifikasi lokal

Pada environment lokal `kiucoid_po`, migration sudah berhasil di-import dan menghasilkan 5 tabel:

- `tb_pojasa_biaya`
- `tb_pojasa_generate`
- `tb_pojasa_log`
- `tb_pojasa_request`
- `tb_pojasa_vendor`
