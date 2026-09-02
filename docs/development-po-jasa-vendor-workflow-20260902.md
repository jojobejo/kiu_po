# Development PO Jasa Vendor Workflow 2026-09-02

## Scope

Modul: PO Jasa Vendor.

Route utama:

- `pononkomersiljasa`
- `pojasa/vendor/save`
- `pojasa/vendor/approval`
- `pojasa/request/save`
- `pojasa/request/revise`
- `pojasa/scope/save`
- `pojasa/approval`
- `pojasa/progress/save`
- `pojasa/file/upload`
- `pojasa/biaya/save`
- `pojasa/bast/complete`
- `pojasa/payment/save`
- `pojasa/evaluation/save`

File aplikasi:

- `application/controllers/purchaseorder/C_Pojasa.php`
- `application/models/PO/M_Pojasa.php`
- `application/views/content/po/jasa/index.php`
- `application/views/content/po/jasa/detail.php`
- `application/views/content/po/jasa/vendor_form.php`
- `application/views/content/po/jasa/ajax.php`

## Alur Bisnis

1. PIC memilih vendor jasa aktif dari database.
2. Jika vendor belum cocok, PIC mengirim request vendor baru melalui modal vendor jasa.
3. Vendor request masuk dengan status `REQUEST` dan belum tampil pada dropdown request pekerjaan.
4. Admin/Purchasing melakukan ACC vendor request. Setelah ACC, vendor berubah menjadi `AKTIF` dan dapat dipakai oleh PIC.
5. PIC membuat request project jasa dengan vendor aktif, scope pekerjaan, estimasi biaya, target selesai, lokasi, tujuan, dan dokumen project.
6. Dokumen project jasa wajib diupload saat request awal agar KADEP menerima pengajuan dengan lampiran pendukung.
7. KADEP departemen melakukan ACC, pending, atau reject.
8. Jika KADEP atau direktur melakukan reject/pending, PIC pemilik request dapat revisi data dan mengajukan ulang ke KADEP.
9. Setelah KADEP ACC, purchasing melakukan review scope dan estimasi biaya.
10. Purchasing dapat mengganti seluruh scope/estimasi melalui form review scope.
11. Purchasing mengajukan request ke direktur.
12. Direktur melakukan ACC, pending, atau reject.
13. Setelah direktur ACC, PIC terkait dapat menginput tracking progress vendor.
14. Purchasing/Admin dapat menerbitkan nomor PO/SPK setelah direktur ACC.
15. Audit biaya project vendor, BAST/project completion, payment tracking vendor, audit approval, dan evaluasi vendor dikelola oleh Purchasing/Admin.
16. KADEP, Purchasing/Admin, Direktur, dan PIC terkait dapat melihat tracking sesuai filter akses list/detail.

## Status Workflow

- `REQUEST`: vendor baru diajukan oleh PIC dan menunggu ACC Purchasing/Admin.
- `AKTIF`: vendor telah disetujui dan dapat dipilih pada request pekerjaan jasa.
- `ON PROGRESS`: request pekerjaan jasa telah diajukan PIC dan menunggu KADEP.
- `ACC-KADEP`: KADEP menyetujui, purchasing mulai review scope.
- `REVIEW PURCHASING`: purchasing sudah menyimpan review scope/estimasi.
- `PENGAJUAN DIREKTUR`: purchasing mengajukan hasil review ke direktur.
- `ACC DIREKTUR`: direktur menyetujui; progress vendor, SPK, audit biaya, payment, dan BAST dapat diproses sesuai hak akses.
- `SPK TERBIT`: nomor PO/SPK telah diterbitkan.
- `PROGRESS VENDOR`: progress vendor sudah berjalan.
- `DONE`: project selesai melalui BAST.
- `PENDING`: pengajuan dikembalikan untuk dilengkapi.
- `REJECT`: pengajuan ditolak dan dikembalikan ke PIC untuk revisi bila masih ingin diajukan ulang.

## Kontrol Akses

- PIC level `4`: request vendor, request pekerjaan, upload dokumen project, revisi saat `REJECT`/`PENDING`, dan input tracking progress setelah `ACC DIREKTUR`.
- KADEP level `5`: ACC/pending/reject request dari departemennya saat status `ON PROGRESS`; dapat melihat data departemen.
- Purchasing/Admin level `1`/`2`: ACC request vendor, CRUD master vendor, review scope, ajukan ke direktur, generate SPK, audit biaya, BAST, payment tracking, dan evaluasi vendor.
- Direktur level `3`: ACC/pending/reject setelah status `PENGAJUAN DIREKTUR`.

## Catatan Validasi

- Lint PHP wajib dijalankan untuk controller, model, dan view PO Jasa.
- UAT browser terautentikasi tetap diperlukan untuk memastikan tombol sesuai level login.
- Upload file diuji dengan ekstensi `jpg`, `jpeg`, `png`, `pdf`, `doc`, `docx`, `xls`, dan `xlsx`.
