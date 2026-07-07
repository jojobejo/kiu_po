# Database - Auto Nomor PO Supplier

Tanggal: 2026-07-07

## Ringkasan

Perubahan ini tidak menambahkan tabel atau kolom baru.

## Tabel Yang Digunakan

```text
tb_po
```

Field yang digunakan:

```text
kd_suplier
no_po
```

## Logika Data

Nomor urut PO supplier dihitung dari data existing pada `tb_po`:

```text
MAX(CAST(SUBSTRING_INDEX(no_po, '/', 1) AS UNSIGNED))
```

Filter:

- `kd_suplier` sama dengan supplier aktif.
- `no_po` mengandung pola `/KIU/`.

Nomor berikutnya adalah nilai maksimum tersebut ditambah 1. Jika belum ada PO untuk supplier tersebut, nomor dimulai dari `001`.

## Catatan Validasi

Duplikasi dicek terhadap `tb_po.no_po`. Jika nomor PO sudah ada, sistem menolak penyimpanan melalui validasi frontend dan backend.

## Perubahan Skema

Tidak ada perubahan skema database.

