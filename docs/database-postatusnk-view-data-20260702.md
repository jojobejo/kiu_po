# Dokumentasi Database - PO Status Non Komersil

Tanggal: 2026-07-02

## Modul

- Route: `postatusnk/`
- Tabel utama: `tb_po_nk`
- Tabel referensi user: `tb_user`

## Sumber Data

Halaman `postatusnk/` mengambil data dari:

```sql
FROM tb_po_nk a
JOIN tb_user b ON b.kode_user = a.kd_user
```

## Perubahan Query

Perubahan dilakukan pada sisi query aplikasi, bukan pada struktur database.

Filter berdasarkan pembuat PO dihapus dari query berikut:

- `ponkgetAllNK_keu_purchasing($kd)`
- `getAllNK_kar($kduser)`

Sebelumnya data dapat dibatasi oleh:

```sql
a.kd_user = ...
```

Setelah perubahan, pembatasan data menggunakan status aktif:

```sql
a.status != 'DONE'
AND a.status != 'REJECT'
```

## Perubahan Struktur Database

Tidak ada perubahan struktur database.

Tidak ada tabel baru, kolom baru, index baru, atau migrasi SQL yang diperlukan untuk perubahan ini.

## Catatan Operasional

Kolom `nama_user` dari `tb_user` tetap ditampilkan sebagai informasi pembuat PO, tetapi tidak lagi menjadi dasar filter data pada halaman `postatusnk/`.
