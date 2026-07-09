# Dokumentasi Database - Edit Tujuan Pembelian PO Non Komersil

Tanggal: 2026-07-03

## Modul

- Route utama: `postatusnk`
- Route aksi: `postatusnk/update-tujuan-pembelian`
- Tabel utama: `tbpo_po_nk`
- Kolom yang diperbarui: `tj_pembelian`

## Perubahan Struktur Database

Tidak ada perubahan struktur database.

Tidak ada tabel baru, kolom baru, index baru, constraint baru, atau migrasi SQL yang diperlukan.

## Operasi Data

Saat user menyimpan modal edit tujuan pembelian, aplikasi menjalankan update pada tabel existing `tbpo_po_nk` berdasarkan `kd_po_req`.

Representasi operasi:

```sql
UPDATE tbpo_po_nk
SET tj_pembelian = :tujuan_pembelian
WHERE kd_po_req = :kd_po_req;
```

## Validasi Sebelum Update

Controller melakukan validasi sebelum update:

- Session login harus valid.
- `kd_po_req` wajib dikirim.
- Data PO NK harus ditemukan.
- Status PO NK harus masih berada pada status yang diperbolehkan untuk diproses.
- `tujuan_pembelian` tidak boleh kosong.

## Audit Note

Setelah update berhasil, aplikasi menambahkan catatan proses dengan isi:

```text
EDIT DATA TUJUAN PEMBELIAN
```

Catatan ini tetap memakai mekanisme note existing melalui `M_Postatus::addNote()`.

## Dampak Data

Perubahan hanya memperbarui nilai tujuan pembelian pada baris PO NK yang dipilih. Data PO, item, supplier, status, dan struktur approval tidak berubah.
