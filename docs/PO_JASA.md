# Modul PO Jasa

Dokumen ini merangkum instalasi dan penggunaan implementasi PO Jasa sampai Fase 9. Modul menggunakan tabel berawalan `tbpo_`, session/login CodeIgniter 3, policy backend, transaksi InnoDB, DataTables, Bootstrap, jQuery, dan SweetAlert yang telah tersedia di proyek.

## Instalasi database

Backup database sebelum instalasi. Jalankan migration secara berurutan pada database aplikasi:

```sh
mysql -u USER -p DATABASE < database/sql/pojasa_phase2_foundation_20260910.sql
mysql -u USER -p DATABASE < database/sql/pojasa_phase3_pic_request_20260910.sql
mysql -u USER -p DATABASE < database/sql/pojasa_phase4_approval_workflow_20260910.sql
mysql -u USER -p DATABASE < database/sql/pojasa_phase5_purchasing_stock_spk_20260910.sql
mysql -u USER -p DATABASE < database/sql/pojasa_phase6_execution_finalization_20260910.sql
mysql -u USER -p DATABASE < database/sql/pojasa_phase7_limited_improvements_20260910.sql
mysql -u USER -p DATABASE < database/sql/pojasa_phase8_purchase_revision_cost_20260911.sql
mysql -u USER -p DATABASE < database/sql/pojasa_phase9_sequential_approval_flow_20260911.sql
mysql -u USER -p DATABASE < database/sql/pojasa_phase10_material_catalog_20260914.sql
mysql -u USER -p DATABASE < database/sql/pojasa_phase11_purchasing_review_20260914.sql
mysql -u USER -p DATABASE < database/sql/pojasa_phase12_pic_purchasing_confirmation_20260914.sql
mysql -u USER -p DATABASE < database/sql/pojasa_phase13_estimasi_header_dan_alur_approval_20260914.sql
mysql -u USER -p DATABASE < database/sql/pojasa_phase15_keep_purchase_in_process_20260915.sql
```

Migration Fase 2–9 bersifat idempotent. Migration tidak membuat user, tidak menghapus data, dan tidak mengubah transaksi stok existing. Fase 9 memetakan status request aktif ke checkpoint alur baru tanpa mengubah request yang telah selesai. Pastikan seluruh tabel memakai InnoDB agar rollback dan penguncian baris bekerja.

## Role dan prasyarat user

- Admin: level 1 atau departemen `ADMIN`; akses override backend untuk dukungan operasional.
- Purchasing: hanya level 2 dengan departemen tepat `PURCHASING`. User level 2 lain, termasuk Finance, tidak mendapat hak Purchasing.
- Direktur: level 3 dengan departemen `DIREKTUR`.
- PIC: level 4; hanya request miliknya.
- KADEP: level 5; hanya departemennya.
- Direktur Operasional: level 6 dengan departemen `DIREKTUR OPERASIONAL` dan memproses seluruh departemen. Ejaan database `DIREKTUR OPRASIONAL` dinormalisasi oleh policy.

User level 6 Direktur Operasional wajib tersedia karena seluruh request harus melewati tahap tersebut. User tidak dibuat otomatis oleh migration.

## Status bisnis

Alur utama wajib: `PIC → PURCHASING (harga pembanding) → PIC (konfirmasi kesepakatan) → KADEP → DIREKTUR OPERASIONAL → DIREKTUR → SPK TERBIT & PO PEMBELIAN OTOMATIS`.

Setelah KADEP menyetujui, request langsung ke Direktur Operasional tanpa kembali ke Purchasing. Setelah Direktur Operasional menyetujui, request langsung ke Direktur. Revisi dari tahap mana pun kembali ke PIC dan saat diajukan ulang kembali melalui pemeriksaan awal Purchasing, sehingga approval dimulai kembali dari PIC.

Header request menyimpan dua nilai terpisah: `Estimasi PIC` (`estimasi_total`) dan `Estimasi Purchasing` (`estimasi_purchasing`). Estimasi Purchasing diisi otomatis dari hasil review harga pembanding; revisi PIC mengosongkannya sampai review awal berikutnya selesai.

Status workflow: `DRAFT`, `MENUNGGU_PURCHASING_AWAL`, `MENUNGGU_KONFIRMASI_PIC`, `MENUNGGU_KADEP`, `PENDING_KADEP`, `REVISI_PIC`, `MENUNGGU_DIRUT_OPS`, `MENUNGGU_DIREKTUR`, `SPK_TERBIT`, `ON_PROGRESS`, `SELESAI`, `DITUTUP`, `DITOLAK_KADEP`, `DITOLAK_DIRUT_OPS`, dan `DITOLAK_DIREKTUR`.

Status pekerjaan PIC adalah `BELUM_DIMULAI`, `ON_PROGRESS`, `SELESAI`, dan `DITUTUP`. Progress tidak boleh mundur. `SELESAI` wajib 100%, sedangkan `DITUTUP` hanya dapat dibuat setelah request berstatus `SELESAI`.

## Route utama

- `GET /pojasa/pic` — daftar request PIC.
- `GET /pojasa/pic/detail/{kode}` — detail, timeline, penerimaan, dan biaya PIC.
- `GET /pojasa/workflow` — daftar kerja approval.
- `GET /pojasa/workflow/detail/{kode}` — detail lintas-role, dokumen aman, timeline, dan status pemenuhan.
- `GET /pojasa/workflow/document/{id}/preview` — preview internal khusus JPG/JPEG/PNG/PDF.
- `GET /pojasa/workflow/document/{id}/download` — unduh dokumen terotorisasi.
- `GET /pojasa/purchasing/detail/{kode}` — vendor, reservasi stok, dan draft pembelian.
- `GET /pojasa/spk/{kode}` — lihat SPK; suffix `/print` dan `/download` untuk keluaran dokumen.
- `GET /pojasa/ajax/pic/execution/{kode}` — state eksekusi PIC.
- `POST /pojasa/ajax/pic/progress/save` — simpan progress dan evidence.
- `POST /pojasa/ajax/stock/confirm-receipt` — konfirmasi material diterima dan posting stok 11512.
- `POST /pojasa/ajax/cost/save` — simpan biaya aktual beserta bukti.
- `POST /pojasa/ajax/cost/update` dan `/verify` — perbaikan oleh PIC/Admin dan verifikasi oleh Purchasing/Admin.
- `POST /pojasa/ajax/purchasing/purchase/submit` — buat satu PO Pembelian komprehensif dari draft aktif.
- `POST /pojasa/ajax/purchasing/purchase/receive` dan `/reverse` — penerimaan parsial/ON_HAND dan reversal aditif.
- `POST /pojasa/ajax/purchasing/change/submit` dan `/decide` — revisi data/biaya pasca-SPK.
- `GET /pojasa/ajax/pic/material-catalog` — pencarian Select2 katalog `tbpo_barang_nk` untuk form PIC.
- `GET /pojasa/ajax/notifications` dan `POST /pojasa/ajax/notifications/read` — polling notifikasi.

Semua endpoint mutasi mengharuskan login, AJAX, method POST, CSRF modul, otorisasi berbasis role/departemen/owner, validasi status asal, dan validasi input server-side.

## Penggunaan setelah SPK terbit

1. PIC membuka detail request dan tab **Progress & Biaya**.
2. PIC mencatat aktivitas, tanggal, persentase, kendala, tindak lanjut, catatan, dan evidence opsional.
3. Untuk material reservasi stok, PIC mengonfirmasi kuantitas yang benar-benar diterima. Reservasi tidak mengurangi stok; penerimaan membuat transaksi `tbpo_transaksi` akun `11512` dalam transaksi database yang sama.
4. PIC mencatat biaya aktual dengan bukti wajib. Sumber biaya hanya `PEMBELIAN_BARU` atau `NOTA_INVOICE_BARU`; material stok nonkomersial tidak dihitung.
5. Ringkasan menampilkan biaya request, biaya disetujui saat SPK, biaya aktual, dan selisih.
6. PIC mencatat progress 100% dengan status `SELESAI`, lalu mencatat `DITUTUP` untuk finalisasi.

## Integrasi PO Pembelian dan revisi pasca-SPK

- Ketika Direktur meng-ACC dan SPK diterbitkan, semua draft pembelian aktif dikirim menjadi satu header `tbpo_po_nk` berstatus `PROSES PEMBELIAN`. Mapping request/SPK/material/draft tersimpan eksplisit dan replay tidak menggandakan PO.
- Header PO Pembelian otomatis PO Jasa selalu berstatus legacy `PROSES PEMBELIAN` agar tetap berada pada antrian monitoring lintas peran. Status pemenuhan material disimpan terpisah pada tabel integrasi sebagai `ON_HAND`/`PARTIAL_ON_HAND`.
- Kolom quantity dan harga PO Pembelian lama bertipe integer. Draft dengan quantity atau harga pecahan ditolak dengan pesan kompatibilitas; nilai tidak dibulatkan diam-diam.
- Penerimaan dapat parsial. Setiap penerimaan membentuk biaya aktual otomatis dari harga aktual, tanpa membuat transaksi stok. Reversal membuat record penerimaan dan biaya negatif; record asal tidak dihapus.
- Perubahan data atau biaya setelah SPK diajukan Purchasing. Departemen IT/HRD/GA melewati Direktur Operasional kemudian Direktur; departemen lain langsung Direktur. Aksi hanya `ACC`, `REVISI`, atau `REJECT`.
- ACC final mengarsipkan snapshot SPK lama, menerbitkan versi baru, dan menyinkronkan PO Pembelian yang belum selesai. Perubahan terhadap PO legacy `DONE` dicatat sebagai penyesuaian menunggu tindak lanjut.
- Biaya yang melampaui anggaran request atau material berstatus `MENUNGGU_PERSETUJUAN_REVISI` hingga revisi biaya disetujui.

Upload menerima TXT/RTF/CSV, PDF, Word, Excel, JPG/JPEG, dan PNG dengan maksimum 10 MB. Backend memeriksa ekstensi, MIME hasil `finfo`, ukuran, path penyimpanan, nama terenkripsi, dan SHA-256.

## Notifikasi dan dashboard

Widget notifikasi melakukan polling setiap 45 detik hanya ketika halaman aktif, menunda request yang tumpang tindih, dan memakai exponential backoff hingga 5 menit saat gagal. Progress mengabari KADEP departemen dan Purchasing; penerimaan material serta biaya aktual mengabari Purchasing. Dashboard utama menampilkan ringkasan PO Jasa sesuai scope role.

## Checklist pengujian

```sh
php index.php cli/PojasaPhase2Check
php index.php cli/PojasaPhase3Check
php index.php cli/PojasaPhase4Check
php index.php cli/PojasaPhase5Check
php index.php cli/PojasaPhase6Check
php index.php cli/PojasaPhase7Check
php index.php cli/PojasaPhase8Check
php index.php cli/PojasaPhase9Check
```

Checklist manual:

- Login PIC owner dan PIC lain; pastikan detail/endpoint owner terisolasi.
- Uji upload valid, MIME palsu, ekstensi terlarang, file kosong, dan file lebih dari 10 MB.
- Uji progress 0%, 1–99%, 100%, regresi tanggal/persentase, dan aksi setelah `DITUTUP`.
- Uji dua penerimaan paralel pada alokasi yang sama, replay token, kuantitas berlebih, dan stok fisik tidak cukup.
- Pastikan hanya penerimaan menghasilkan transaksi `11512`; reservasi tidak membuat transaksi dan tidak ada `11511` untuk stok existing.
- Uji biaya tanpa bukti, sumber stok, draft pembelian request lain, replay token, PIC lain, Purchasing, dan session berakhir.
- Uji badge notifikasi saat tab aktif/nonaktif dan dashboard PIC/KADEP/Purchasing/Direktur/Admin.
- Uji alur penuh: PIC, Purchasing, konfirmasi PIC, KADEP, Direktur Operasional, lalu Direktur.

## Dependency dan keterbatasan

- Template SPK perusahaan resmi belum tersedia. View saat ini adalah draft yang kompatibel dengan pola print existing dan jelas ditandai `DRAFT KOMPATIBILITAS`; format resmi harus diberikan dan disetujui sebelum dipakai sebagai dokumen final perusahaan.
- Payment, BAST, invoice workflow, dan evaluasi vendor tidak termasuk implementasi inti ini. Endpoint/view legacy terkait tidak dikembangkan pada rangkaian fase ini.
- Pengujian otomatis CLI menggunakan transaksi rollback dan tidak menggantikan uji konkurensi multi-koneksi serta UAT browser dengan user nyata.
- Dump rollback awal menyertakan schema, data, dan trigger. Routine/event tidak disertakan karena `mysql.proc` lokal tidak kompatibel dengan versi server dan event scheduler dinonaktifkan; project archive lengkap tetap memuat seluruh source termasuk `.git`.
