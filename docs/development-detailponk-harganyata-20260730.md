# Development Detail PONK Harga Nyata

Tanggal: 2026-07-30

## Ringkasan

Route `detailponk/(:any)` menampilkan detail PO Non Komersil melalui `postatus/C_PoStatus/detailponk/$1`.
Pada status `ACC-KADEP`, user level `2` dapat mengaktifkan switch Harga Nyata.

Perubahan development:

- Mengaktifkan kolom `Harga Nyata` dan `Total Harga Nyata` di tabel detail PONK.
- Kolom tersebut hanya tampil ketika:
  - user login memiliki `lv = 2`,
  - status PO adalah `ACC-KADEP`,
  - `status_hrg_nyata = 1`.
- Modal `Add Harganyata` tetap berada pada kolom aksi per baris data dan tetap memakai route existing `edit_harganyata`.
- Colspan baris total, diskon, note pembelian, file pendukung, dan grand total disesuaikan dengan jumlah kolom saat Harga Nyata ON.

## File Terdampak

- `application/views/content/postatus/detailponk.php`

## Alur Penggunaan

1. Buka menu detail PONK melalui route `detailponk/{kd_po_nk}`.
2. Pastikan status data adalah `ACC-KADEP` dan user berada pada level admin pembelian (`lv = 2`).
3. Klik switch `Harga Nyata OFF` agar berubah menjadi `Harga Nyata ON`.
4. Pada baris item, klik tombol `Add Harganyata`.
5. Isi nilai `Harga Nyata`, lalu simpan.
6. Tabel akan menampilkan kolom `Harga Nyata` dan `Total Harga Nyata` selama switch berada pada posisi ON.

## Catatan Teknis

- Perubahan tidak mengubah flow simpan harga nyata.
- Nilai `Total Harga Nyata` tetap dihitung oleh controller existing `edit_harganyata()` dari `qty * hrg_nyata`.
- Perubahan hanya membuka tampilan kolom yang sebelumnya sudah ada tetapi masih dikomentari di view.
