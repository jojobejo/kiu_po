# Database - Auto Nomor PO Supplier

Tanggal: 2026-07-07

## Ringkasan

Perubahan ini tidak menambahkan tabel atau kolom baru.

## Tabel Yang Digunakan

```text
tbpo_po
```

Field yang digunakan:

```text
kd_suplier
no_po
```

## Logika Data

Nomor urut PO supplier dihitung dari data existing pada `tbpo_po`:

```text
MAX(CAST(SUBSTRING(SUBSTRING_INDEX(no_po, '/', 1), 2) AS UNSIGNED))
```

Filter:

- `kd_suplier` sama dengan supplier aktif.
- `no_po` diawali kode PO yang dipilih, yaitu `Q` atau `A`.
- `no_po` mengandung pola `/KIU/`.

Nomor berikutnya adalah nilai maksimum tersebut ditambah 1. Jika belum ada PO untuk supplier tersebut, nomor dimulai dari `001`.

Untuk nomor dasar yang sama pada bulan dan tahun yang sama:

- Supplier yang sama wajib memakai nomor urut berikutnya.
- Supplier berbeda dapat memakai suffix alfabet `A` sampai `Z` di belakang tahun, contoh `Q001/KIU/VII/2026A`.
- Pencarian suffix memakai pola `no_po REGEXP '^Q001/KIU/VII/2026[A-Z]?$'`.

## Catatan Validasi

Duplikasi exact dicek terhadap `tbpo_po.no_po`. Benturan nomor dasar untuk supplier yang sama dicek terhadap kombinasi `kd_suplier` dan pola nomor dasar. Jika bentrok, sistem menolak penyimpanan melalui validasi frontend dan backend.

## Perubahan Skema

Tidak ada perubahan skema database.
