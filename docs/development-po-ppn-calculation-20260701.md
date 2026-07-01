# Dokumentasi Development - Perubahan PO PPN 2026-07-01

## Ringkasan

Pekerjaan hari ini memperjelas alur harga Include PPN dan Exclude PPN pada modul Purchase Order. Fokusnya adalah menjaga harga input vendor tetap tersimpan apa adanya, sambil menyediakan nilai DPP atau harga exclude PPN untuk perhitungan diskon, tax, detail PO, dan tampilan pembanding.

Secara bisnis, perubahan ini mengurangi risiko salah tafsir harga antara purchasing, supplier, dan approval PO. Sistem sekarang membedakan:

- Harga input tersimpan: nilai yang diketik user sesuai dokumen atau penawaran vendor.
- Harga satuan exclude PPN: nilai dasar atau DPP yang dipakai untuk perhitungan internal.
- Keterangan harga PPN: penanda apakah item PO berasal dari harga Include PPN atau Exclude PPN.

## Status Pekerjaan Hari Ini

Perubahan yang sudah ada di commit hari ini:

- Commit `71ba769` (`updated_po`): perubahan awal tampilan PO, modal input/edit harga, dan migration `keterangan_harga_ppn`.
- Commit `04f4c32` (`updated`): perubahan awal controller purchase order.

Perubahan aktif yang masih ada di working tree:

- Penyimpanan nilai `harga_satuan_exclude` dan `harga_satuan_kecil_exclude`.
- Perbaikan flow finalisasi PO dari temporary item ke detail PO.
- Penyesuaian tampilan tab Include PPN dan Exclude PPN pada halaman input PO dan detail PO.
- Penambahan SQL migration untuk kolom kalkulasi harga PPN.

## File Development Yang Berubah

Controller:

- `application/controllers/purchaseorder/C_Order.php`
- `application/controllers/postatus/C_PoStatus.php`

Model:

- `application/models/PO/M_Postatus.php`

View dan helper:

- `application/views/content/po/_po_summary_helpers.php`
- `application/views/content/po/modal/modalList.php`
- `application/views/content/po/modalpo.php`
- `application/views/content/po/purchase.php`
- `application/views/content/postatus/detailpo.php`

## Aturan Bisnis PPN

1. Harga Include PPN
   - User mengisi harga yang sudah termasuk PPN.
   - Sistem tetap menyimpan harga input tersebut sebagai harga utama.
   - Sistem menghitung harga exclude atau DPP dengan rumus:

```text
harga_exclude = harga_include / (1 + tax_percent / 100)
```

2. Harga Exclude PPN
   - User mengisi harga sebelum PPN.
   - Harga exclude sama dengan harga input.
   - Tax tetap dihitung berdasarkan setting Tax PO.

3. Konsistensi satu PO
   - Jika list order sudah memakai Include PPN, item berikutnya diarahkan tetap Include PPN.
   - Jika list order sudah memakai Exclude PPN, item berikutnya diarahkan tetap Exclude PPN.
   - Validasi ini menjaga satu PO tidak mencampur basis harga yang berbeda.

4. Bonus
   - Item bonus tidak dihitung sebagai nilai harga utama.
   - Nilai kalkulasi harga PPN untuk bonus dibuat `0`.

## Detail Perubahan Development

### 1. Controller Purchase Order

File: `application/controllers/purchaseorder/C_Order.php`

Perubahan utama:

- Menambahkan helper perhitungan DPP dari harga Include PPN.
- Menyimpan `harga_satuan_exclude` dan `harga_satuan_kecil_exclude` pada `tb_tmp_item` jika kolom tersedia.
- Menambahkan `tax_tmp` ke data view agar modal mengetahui status Tax PO supplier aktif.
- Memperketat validasi keterangan harga agar satu list order tidak mencampur Include dan Exclude.
- Saat checkout/finalisasi ke `tb_detail_po`, sistem membawa:
  - `harga_satuan_exclude`
  - `harga_satuan_kecil_exclude`
  - `keterangan_harga_ppn`

### 2. Controller PO Status / Detail PO

File: `application/controllers/postatus/C_PoStatus.php`

Perubahan utama:

- Saat PO disetujui atau dipindahkan dari temporary/revisi ke detail, data PPN ikut dibawa ke `tb_detail_po`.
- Revisi item menjaga mode PPN lama dari item tersebut.
- Jika item Include PPN belum punya nilai exclude tersimpan, sistem menghitung ulang DPP menggunakan tax aktif atau fallback 11%.
- Perhitungan diskon dan total memakai basis exclude agar nilai DPP, diskon, tax, dan grand total tetap konsisten.

### 3. Model PO Status

File: `application/models/PO/M_Postatus.php`

Perubahan utama:

- Insert/update `tb_detail_po` sekarang memfilter field berdasarkan kolom yang benar-benar tersedia di database.
- Tujuannya agar aplikasi tetap berjalan pada database yang belum semua migration-nya diterapkan.
- Area yang dibuat defensif:
  - `addRevisiChart()`
  - `revisiPO()`
  - `inputDetailPO()`

### 4. Helper Summary PO

File: `application/views/content/po/_po_summary_helpers.php`

Perubahan utama:

- Helper `po_exclude_ppn()` memakai fallback tax 11% jika tax belum tersedia.
- Builder item row sekarang membaca nilai tersimpan:
  - `harga_satuan_exclude`
  - `harga_satuan_kecil_exclude`
  - `keterangan_harga_ppn`
- Untuk item Include PPN, summary internal memakai nilai exclude/DPP.

### 5. Modal Tambah Item

File: `application/views/content/po/modal/modalList.php`

Perubahan utama:

- Modal menampilkan pilihan keterangan harga Include PPN / Exclude PPN.
- Modal menampilkan `Harga Satuan Exclude PPN` sebagai hasil kalkulasi.
- Jika user memilih Include PPN, nilai exclude dihitung dari harga input dibagi tax.
- Menampilkan peringatan jika user mencoba mencampur mode harga dalam satu list order.
- Menampilkan peringatan jika Tax PO belum disetting saat memilih Exclude PPN.

### 6. Modal Edit Item

File: `application/views/content/po/modalpo.php`

Perubahan utama:

- Edit item menampilkan nilai exclude tersimpan jika tersedia.
- Perhitungan Include PPN memakai pembagian ke DPP, bukan mengalikan harga input.
- Tampilan angka dibatasi sampai 3 digit desimal agar lebih mudah dibaca user.

### 7. Halaman Input PO

File: `application/views/content/po/purchase.php`

Perubahan utama:

- Menambahkan status Tax PO: sudah dipilih atau belum dipilih.
- Mengganti switch Include/Exclude menjadi tab Include PPN dan Exclude PPN.
- Tab utama mengikuti mode harga yang dipakai PO.
- Menampilkan kolom baru:
  - Keterangan Harga
  - Harga Input Tersimpan
  - Harga Satuan
  - Harga Satuan Kecil
  - Harga Setelah Diskon
  - Total Harga
  - Total Harga Setelah Diskon
- Summary dihitung ulang per tab agar user bisa melihat nilai Include dan Exclude secara eksplisit.

### 8. Halaman Detail PO

File: `application/views/content/postatus/detailpo.php`

Perubahan utama:

- Tampilan detail PO disamakan dengan halaman input PO.
- Menggunakan tab Include PPN dan Exclude PPN.
- Menampilkan badge mode harga per item.
- Summary detail dihitung per tab.
- Aksi edit, hapus, dan diskon tetap dipertahankan sesuai hak akses halaman.

## Dampak Ke User

- User dapat melihat dengan jelas apakah PO memakai harga Include PPN atau Exclude PPN.
- Harga vendor yang diinput tidak hilang atau berubah makna.
- Nilai DPP/exclude tersedia untuk dasar diskon dan tax.
- Risiko salah total akibat harga include yang dihitung ulang sebagai exclude menjadi lebih kecil.
- Tim purchasing dan approval memiliki tampilan pembanding Include/Exclude tanpa perlu hitung manual.

## Catatan Validasi

Validasi yang perlu dilakukan setelah deploy:

1. Buat PO baru dengan Tax PO 11% dan item Exclude PPN.
2. Buat PO baru dengan item Include PPN.
3. Pastikan satu PO tidak bisa mencampur item Include dan Exclude.
4. Pastikan harga input tetap sama dengan nilai yang diketik user.
5. Pastikan `harga_satuan_exclude` berisi DPP untuk item Include PPN.
6. Pastikan halaman `purchase/listBarang`, `detailPO`, revisi item, dan approval PO menampilkan total yang konsisten.
7. Pastikan item bonus tetap bernilai 0 pada kalkulasi harga.

## Catatan Risiko

- Jika migration database belum dijalankan, sebagian field PPN baru tidak akan tersimpan. Model sudah dibuat defensif, tetapi hasil bisnis penuh baru benar setelah kolom database tersedia.
- Data lama yang belum memiliki `keterangan_harga_ppn` akan dianggap Exclude PPN pada beberapa tampilan fallback.
- Jika Tax PO kosong, sistem memakai fallback 11% untuk kebutuhan konversi Include ke Exclude.
