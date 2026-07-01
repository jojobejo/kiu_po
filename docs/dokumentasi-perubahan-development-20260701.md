# Dokumentasi Perubahan Development Hari Ini

Tanggal development: 1 Juli 2026

## Ringkasan

Development hari ini berfokus pada perbaikan alur harga PO agar sistem bisa membedakan:

- harga yang diinput user,
- harga dasar sebelum PPN,
- hasil tampilan untuk kebutuhan internal dan supplier.

Perubahan ini terutama menyentuh modul:

- `purchase/listBarang`
- `purchase/sup`
- `detailPO`

## Fungsi Baru Dan Perubahan Utama

### 1. Pemilihan mode harga per item

Sekarang setiap item bisa ditandai sebagai:

- `Include PPN`
- `Exclude PPN`

Tujuan perubahan:

- menjaga arti harga dari supplier tetap jelas,
- menghindari salah hitung saat diskon dan total,
- mempermudah tim saat membaca PO.

### 2. Perhitungan harga exclude otomatis

Jika user memilih `Include PPN`, sistem akan menghitung nilai dasar atau harga exclude secara otomatis.

Manfaat:

- user tidak perlu hitung manual,
- nilai dasar untuk diskon dan summary tetap tersedia,
- harga asli dari supplier tetap tersimpan.

### 3. Validasi agar satu PO tidak mencampur mode harga

Sistem sekarang mengecek isi list order dan detail PO.

Perilaku baru:

- jika item pertama memakai `Include PPN`, item berikutnya wajib `Include PPN`,
- jika item pertama memakai `Exclude PPN`, item berikutnya wajib `Exclude PPN`,
- aturan ini berlaku juga saat revisi item di detail PO.

### 4. Tax temporary disinkronkan otomatis

Sebelumnya tax lebih bergantung pada input manual.
Sekarang sistem menyesuaikan tax sementara berdasarkan mode harga yang dipakai pada PO.

Hasilnya:

- proses lebih sederhana untuk user,
- risiko tax tidak sinkron dengan mode harga menjadi lebih kecil.

### 5. Ringkasan harga diperjelas

Halaman `purchase/sup` dan `detailPO` sekarang menampilkan ringkasan yang lebih jelas:

- total sebelum diskon,
- total diskon,
- total setelah diskon,
- tax,
- grand total.

Selain itu, tampilan dibagi ke tab:

- `Include PPN`
- `Exclude PPN`

### 6. Perhitungan diskon diperbaiki

Perubahan hari ini juga merapikan pembacaan diskon:

- diskon item,
- diskon global,
- diskon merk.

Tujuannya agar hasil total akhir lebih konsisten di tampilan input, detail, dan print.

### 7. Opsi print PO bertambah

Di halaman `detailPO`, user sekarang memiliki pilihan print:

- internal include,
- internal exclude,
- supplier include,
- supplier exclude.

Ini membantu jika perusahaan membutuhkan format cetak yang berbeda antara kebutuhan internal dan dokumen yang dibagikan ke supplier.

## Penjelasan Per Modul

### Modul `purchase/listBarang`

Perubahan:

- tambah pilihan mode harga `Include PPN` dan `Exclude PPN`,
- tambah kolom hasil hitung `Harga Satuan Exclude PPN`,
- tambah pesan peringatan saat user mencoba mencampur mode harga,
- bonus tetap bisa diinput tanpa memengaruhi harga utama.

### Modul `purchase/sup`

Perubahan:

- tampilan summary diperbarui,
- tab harga include dan exclude dibuat lebih jelas,
- tax temporary mengikuti mode harga,
- total diskon lebih akurat,
- aksi diskon nominal dan persen diperjelas pada tombol.

### Modul `detailPO`

Perubahan:

- tampilan total dibuat sejalan dengan halaman input PO,
- validasi revisi item mengikuti mode harga PO,
- pilihan print ditambah,
- area setting tax manual di halaman detail tidak lagi menjadi fokus alur baru.

## Dampak Positif Ke Pengguna

- Harga vendor tidak berubah makna.
- User lebih mudah memilih apakah harga sudah termasuk PPN atau belum.
- Risiko salah total lebih kecil.
- Revisi PO menjadi lebih aman.
- Hasil print lebih fleksibel.

## File Yang Terkait Dengan Development Hari Ini

- `application/controllers/purchaseorder/C_Order.php`
- `application/controllers/postatus/C_PoStatus.php`
- `application/models/PO/M_Purchase.php`
- `application/views/content/po/modal/modalList.php`
- `application/views/content/po/modal/msuplier.php`
- `application/views/content/po/purchase.php`
- `application/views/content/postatus/detailpo.php`
- `application/config/routes.php`

## Catatan Untuk Tim Internal

- Jika user mengeluhkan total PO berbeda dari kebiasaan sebelumnya, cek dulu apakah item memakai `Include PPN` atau `Exclude PPN`.
- Jika user ingin mengganti mode harga di tengah input, arahkan untuk mengosongkan list item terlebih dahulu.
- Setelah perubahan ini, pengecekan PO sebaiknya dilakukan dari tab include dan exclude sebelum print final.
