# Development PO Jasa - 2026-07-28

## Tujuan

Membuat modul PO Jasa yang terpisah dari PO barang dan PONK barang. Modul ini dipakai untuk request penggunaan jasa vendor, pencatatan kegiatan vendor, breakdown biaya, status approval, dan histori aktivitas.

## File aplikasi yang ditambahkan/diubah

- `application/config/routes.php`
  - Memperbaiki route `pononkomersiljasa` agar mengarah ke `purchaseorder/C_Pojasa`.
  - Menambahkan endpoint AJAX vendor, request, detail, status, dan summary PO Jasa.
- `application/controllers/purchaseorder/C_Pojasa.php`
  - Controller utama PO Jasa.
  - Menyediakan halaman modul dan endpoint JSON.
  - Memvalidasi sesi login, kesiapan tabel, akses vendor, request, detail, dan update status.
- `application/models/PO/M_Pojasa.php`
  - Model khusus PO Jasa.
  - Mengelola vendor jasa, request jasa, rincian biaya, summary, nomor PO Jasa, dan log aktivitas.
- `application/views/content/po/jasa/body.php`
  - Tampilan modul PO Jasa.
  - Berisi tab Request Jasa, List Request, dan Vendor Jasa.
- `application/views/content/po/jasa/ajax.php`
  - JavaScript AJAX untuk DataTables, SweetAlert, form request, form vendor, detail modal, update status, dan hitung total biaya realtime.

## Alur modul

1. User membuka menu `PO Jasa`.
2. Sistem menampilkan warning apabila tabel `tb_pojasa_*` belum tersedia.
3. Admin Keuangan/Purchasing mengisi master Vendor Jasa pada tab `Vendor Jasa`.
4. PIC membuat request jasa pada tab `Request Jasa`.
5. User memilih vendor jasa khusus dari tabel `tb_pojasa_vendor`, bukan `tb_suplier`.
6. User mengisi kegiatan vendor, lokasi, tanggal kebutuhan, alasan kebutuhan, dan rincian biaya.
7. Rincian biaya dihitung realtime di browser:
   - `JASA`
   - `OPERASIONAL`
   - `BAHAN`
   - `LAIN_LAIN`
8. User menyimpan sebagai `DRAFT` atau langsung `DIAJUKAN`.
9. List request dimuat dengan AJAX DataTables tanpa reload halaman penuh.
10. Detail request menampilkan header, rincian biaya, histori log, dan aksi status yang sesuai dengan role/status.

## Lifecycle status

- `DRAFT`
- `DIAJUKAN`
- `APPROVED KADEP`
- `REJECT KADEP`
- `REVIEW BIAYA`
- `APPROVED DIREKTUR`
- `REJECT DIREKTUR`
- `PO TERBIT`
- `DALAM PELAKSANAAN`
- `SELESAI PIC`
- `CLOSED`
- `CANCEL`

## Role awal

- PIC level `4`
  - Membuat draft/request.
  - Melihat request miliknya.
  - Submit draft.
  - Cancel draft/diajukan.
  - Konfirmasi selesai saat status `DALAM PELAKSANAAN`.
- KADEP level `5`
  - Melihat request departemennya.
  - Approve/reject request status `DIAJUKAN`.
- Keuangan/Purchasing level `1`/`2`
  - Mengelola vendor jasa.
  - Review biaya.
  - Terbitkan PO Jasa.
  - Update pelaksanaan.
  - Close request setelah selesai PIC.
- Direktur level `3`
  - Approve/reject setelah review biaya.

## Catatan teknis

- Modul ini tidak memakai `tb_suplier`.
- Modul ini tidak memakai tabel stok, `tb_tmp_item_nk`, `tb_detail_po_nk`, atau `tb_transaksi`.
- Nomor PO Jasa memakai format `POJddmmyyNNNN`.
- Nomor dibuat dengan MySQL named lock `kiu_po_pojasa_YYYYMMDD` dan dicatat di `tb_pojasa_generate` agar lebih aman dari double-submit.
- Endpoint AJAX akan mengembalikan pesan JSON jika tabel belum tersedia.

## Verifikasi yang perlu dilakukan setelah import SQL

1. Login sebagai user Keuangan/Purchasing.
2. Buka `pononkomersiljasa`.
3. Tambahkan Vendor Jasa.
4. Login sebagai PIC, buat request jasa.
5. Login KADEP untuk approve.
6. Login Keuangan/Purchasing untuk review biaya dan terbitkan PO.
7. Login Direktur untuk approve bila alur bisnis mewajibkan approval direktur.
8. Cek detail request dan pastikan histori aktivitas tercatat.
