# Development Aplikasi - PO Jasa Tahap 3

Tanggal: 2026-09-02

## Modul

- Route utama: `pononkomersiljasa`
- Route report: `pojasa/report`
- Controller: `application/controllers/purchaseorder/C_Pojasa.php`
- Model: `application/models/PO/M_Pojasa.php`
- View utama: `application/views/content/po/jasa/index.php`
- View detail: `application/views/content/po/jasa/detail.php`
- View report: `application/views/content/po/jasa/report.php`
- AJAX: `application/views/content/po/jasa/ajax.php`

## Scope Tahap 3

Tahap 3 menambahkan lapisan monitoring manajemen setelah Tahap 1 dan Tahap 2.

Fungsi yang ditambahkan:

- Payment tracking vendor.
- Evaluasi vendor setelah project `DONE`.
- Report histori jasa vendor project done.
- Dashboard monitoring tambahan pada halaman utama PO Jasa.
- Vendor performance summary.

Folder `apps_production` tidak diubah.

## Alur Bisnis

1. Project masuk fase `SPK TERBIT`, `PROGRESS VENDOR`, atau `DONE`.
2. Purchasing/Admin atau Keuangan mencatat invoice dan status pembayaran vendor.
3. Setelah project `DONE`, user terkait dapat mengisi evaluasi vendor.
4. Report histori menampilkan project jasa yang sudah `DONE`.
5. Vendor performance dihitung dari project `DONE`, biaya realisasi, durasi BAST, dan score evaluasi.

## Payment Tracking

Data yang dicatat:

- Tanggal invoice.
- Jatuh tempo.
- No invoice vendor.
- Nominal tagihan.
- Nominal terbayar.
- Status bayar: `BELUM BAYAR`, `PARTIAL`, `LUNAS`.
- Catatan payment.

Status bayar otomatis disesuaikan:

- Bila bayar sama atau lebih besar dari tagihan, status menjadi `LUNAS`.
- Bila bayar lebih dari 0 tetapi status dipilih `BELUM BAYAR`, status menjadi `PARTIAL`.

## Evaluasi Vendor

Evaluasi hanya dapat dilakukan saat status project `DONE`.

Score yang dicatat:

- Kualitas pekerjaan.
- Ketepatan waktu.
- Kontrol biaya.

Total score adalah rata-rata dari ketiga score tersebut.

## Report Histori Project Done

Report menampilkan:

- Kode PO Jasa dan No SPK.
- Vendor dan kategori jasa.
- Departemen.
- No dan tanggal BAST.
- Estimasi.
- Realisasi.
- Selisih.
- Score vendor.

Filter tersedia:

- Tanggal start.
- Tanggal end.
- Vendor.
- Departemen.

## Dashboard Monitoring

Dashboard utama PO Jasa ditambah:

- Project overdue aktif.
- Payment pending.
- Payment lunas.
- Average vendor score.

## Javascript dan AJAX

AJAX digunakan untuk:

- Simpan payment tracking.
- Simpan evaluasi vendor.

Javascript digunakan untuk:

- Menghitung sisa bayar input secara langsung.
- Menghitung rata-rata score evaluasi sebelum submit.
- Menjalankan DataTables pada report histori dan vendor performance.

## Dampak Javascript dan AJAX

Dampak positif:

- Keuangan/Purchasing langsung melihat sisa bayar sebelum menyimpan invoice.
- Evaluasi vendor lebih transparan karena total score terlihat sebelum submit.
- Report bisa dicari, difilter, dan disortir memakai DataTables.

Dampak risiko:

- Nilai pembayaran dan evaluasi tetap divalidasi di controller.
- Payment tracking Tahap 3 masih bersifat monitoring internal, belum integrasi jurnal/accounting.
- Bila CSRF aplikasi diaktifkan nanti, endpoint AJAX perlu ditambah token.

## Tata Cara Penggunaan

1. Jalankan migration database Tahap 3.
2. Login ke aplikasi.
3. Buka menu `PO Jasa`.
4. Buka detail project dengan status `SPK TERBIT`, `PROGRESS VENDOR`, atau `DONE`.
5. Input payment tracking dari panel `Payment Tracking Vendor`.
6. Setelah project `DONE`, input evaluasi vendor.
7. Buka `Report Vendor Jasa` dari halaman utama PO Jasa.
8. Gunakan filter untuk melihat histori project done dan ranking vendor performance.

## Catatan Validasi

- Tahap 3 tidak membuat mutasi stok.
- Tahap 3 tidak membuat jurnal/accounting otomatis.
- Tahap 3 tidak mengubah tabel PO Non Komersil.
- Payment dan evaluasi menambahkan audit note ke `tbpo_jasa_note`.
- Migration database berhasil dijalankan pada database lokal `kiucoid_karismaerp_local`.
