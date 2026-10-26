# Pemilihan Kadep Approval pada Detail Request PIC

## Perubahan

Pada route `reqpic/detreqbarangpic/{kode}`, Purchasing dapat memilih departemen Kadep sebelum menekan **ORDER CONFIRMED** ketika request memiliki item tertunda dan sistem akan membuat PO baru untuk approval. Pilihan yang tersedia adalah GA, KEUANGAN, LOGISTIK, PROMOSI SEED, PURCHASING, SALES, dan DIROP.

Saat PO dibuat, pilihan disimpan sebagai `tb_po_nk.departemen`. Daftar approval Kadep yang sudah ada menggunakan departemen pada PO untuk menampilkan request kepada Kadep terkait. Controller memvalidasi pilihan dengan daftar yang diizinkan; nilai yang kosong atau di luar daftar ditolak.

## Cara menggunakan

1. Buka detail request PIC melalui `reqpic/detreqbarangpic/{kode}` sebagai pengguna Purchasing.
2. Jika ada item tertunda, pilih departemen Kadep pada field **Pilih Departemen Kadep Approval**.
3. Tekan **ORDER CONFIRMED** untuk membuat PO dan meneruskannya ke antrean approval departemen pilihan.

Jalur **ORDER CONFIRMED** untuk request tanpa item tertunda tetap memproses penerimaan request tanpa membuat PO approval Kadep, sehingga tidak meminta pilihan departemen.

## Cakupan dan validasi

- Route dan alur status PO yang sudah ada tetap digunakan.
- Pilihan diperiksa lagi di server sebelum PO dibuat.
- Perubahan form diterapkan pada view detail request PIC.
- Belum dilakukan UAT dengan akun Purchasing dan akun Kadep tiap departemen.
