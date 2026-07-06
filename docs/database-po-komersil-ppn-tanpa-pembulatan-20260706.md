# Database PO Komersil PPN Tanpa Pembulatan - 2026-07-06

## Dampak Database

Tidak ada perubahan struktur database.

Perubahan hanya menghapus pembulatan pada query pembacaan data API komersil di `application/models/Api/M_Api.php`.

## Field Terkait

Tabel sumber utama:

- `tb_detail_po`
  - `hrg_total`
  - `hrg_total_diskon`

- `tb_po`
  - `tax`

Field output API yang terdampak:

- `tax_diskon`
- `grand_total`
- `grand_total_diskon`

## Perubahan Query

Sebelumnya API menggunakan `ROUND(..., 0)` sehingga nilai pajak dan grand total berbasis pajak menjadi bilangan bulat.

Sekarang kalkulasi dikembalikan sebagai hasil asli:

- `tax_diskon = tax / 100 * hrg_total_diskon`
- `grand_total = hrg_total + tax`
- `grand_total_diskon = hrg_total_diskon + tax_diskon`

## Migrasi

Tidak ada file migrasi yang perlu dijalankan di production.

## Validasi Data

Gunakan contoh PO komersil yang memiliki diskon dan PPN 11%. Bandingkan hasil:

- `hrg_total_diskon`
- `tax_diskon`
- `grand_total_diskon`

Nilai pajak harus mengikuti angka desimal hasil kalkulasi, bukan pembulatan integer.
