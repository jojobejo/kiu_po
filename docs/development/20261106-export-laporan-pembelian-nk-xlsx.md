# Perbaikan export XLSX laporan pembelian nonkomersil

Tanggal: 6 November 2026

## Masalah

File contoh `lap_beli_po_nonkomersil (1).xlsx` diawali 2.360 byte HTML error PHP sebelum header ZIP `PK`. Pesan error berasal dari PHPExcel pada PHP 8.3: `Implicit conversion from float 4.5 to int loses precision` di `Writer/Excel2007/StringTable.php`. Akibatnya Excel menganggap file XLSX tidak valid. Nama sheet yang memakai dua tanggal dalam bentuk teks panjang juga dapat melampaui batas Excel 31 karakter.

## Perubahan aplikasi

- Route `srclapbeli` tetap menampilkan hasil pencarian; tombol **Export Excel** memanggil `export_laporan_pembelian_nk` pada `application/controllers/laporan/C_Laporan.php`.
- Export menahan dan membersihkan output sebelum mengirim XLSX. Writer menyimpan hasil ke file sementara, kemudian mengirimnya dengan tipe MIME XLSX dan ukuran file yang sesuai.
- Pesan deprecation dari PHPExcel pada PHP 8.3 tidak ditampilkan di respons XLSX. Error lain tetap mengikuti penanganan aplikasi.
- Rentang tanggal sesi harus berformat `YYYY-MM-DD`; jika tidak ada atau tidak valid, export memberikan respons error 400.
- Nama sheet memakai `lap_YYYYMMDD_YYYYMMDD`, sehingga tetap menunjukkan rentang tanggal dan tidak melebihi batas 31 karakter.

## Cara menggunakan

1. Buka **Laporan Pembelian** (`lap_nonkomersil`).
2. Isi **Tanggal Start** dan **Tanggal End**, lalu klik **Cari Data** (`srclapbeli`).
3. Klik **Export Excel**. Unduhan `lap_beli_po_nonkomersil.xlsx` dapat dibuka di Excel. File lama yang sudah terunduh sebelum perbaikan perlu diunduh ulang.

## Validasi

- Lint controller: lolos dengan PHP CLI lokal 7.4.33.
- Uji export dengan satu baris data contoh: proses keluar dengan kode 0, output dimulai `PK 03 04`, arsip ZIP berisi 11 entri, dan `xl/workbook.xml` memiliki sheet `lap_20261101_20261106`.
- Runtime PHP 8.3 production dan UAT browser terautentikasi belum tersedia untuk diuji di lingkungan lokal; unduh ulang di production untuk verifikasi akhir.
