# Development Realisasi Harga Nyata PONK

Tanggal: 2026-07-30

## Ringkasan

Development ini mengubah fitur `Harga Nyata` pada `detailponk/{kd_po_nk}` menjadi alur realisasi pembelian setelah `ACC DIREKTUR`.

Tujuan utama:

- Membandingkan harga pengajuan yang sudah disetujui Direktur dengan harga nyata pembelian.
- Mencatat `Qty Nyata` tanpa menjadikannya pemicu approval Direktur.
- Meminta approval Direktur hanya ketika `Harga Nyata` per item lebih besar dari `Harga Pengajuan`.
- Menjaga audit trail input, approval, dan reject harga nyata.

## File Terdampak

- `application/config/routes.php`
- `application/controllers/postatus/C_PoStatus.php`
- `application/models/PO/M_Postatus.php`
- `application/views/content/postatus/detailponk.php`
- `application/views/content/postatus/modal_setting/modalponk.php`
- `db/2026/add_realisasi_harga_nyata_ponk_20260730.sql`

## Alur Aplikasi

1. PONK berjalan seperti biasa sampai status `ACC DIREKTUR`.
2. User Purchasing dengan `lv = 2` membuka `detailponk/{kd_po_nk}`.
3. Purchasing mengaktifkan switch `Harga Nyata ON`.
4. Sistem menampilkan kolom:
   - `Qty Nyata`
   - `Harga Nyata`
   - `Total Harga Nyata`
   - `Approval Harga`
5. Purchasing mengisi realisasi pembelian per item melalui modal `Input Realisasi Pembelian`.
6. Sistem membandingkan `Harga Nyata` dengan `Harga Pengajuan`.
7. Jika `Harga Nyata <= Harga Pengajuan`, status approval menjadi `DISETUJUI_OTOMATIS`.
8. Jika `Harga Nyata > Harga Pengajuan`, status approval menjadi `PENDING_DIREKTUR`.
9. Direktur dengan `lv = 3` dapat approve/reject item yang pending dari tabel detail.
10. Proses pembelian diblokir jika masih ada harga nyata yang pending atau ditolak Direktur.

## Aturan Bisnis

- Approval Direktur hanya dipicu oleh perubahan harga real per item yang lebih besar dari harga pengajuan.
- Perubahan qty nyata tidak memicu approval Direktur.
- Qty nyata tetap disimpan untuk catatan realisasi pembelian dan perbandingan operasional.
- Switch `Harga Nyata` tidak dapat dimatikan setelah ada item yang mulai diinput, supaya audit tidak hilang dari tampilan.
- Jika fitur Harga Nyata ON, semua item wajib diisi sebelum PO masuk `PROSES PEMBELIAN`.

## Route Baru

- `approve_harganyata/{id_det_po_nk}`
- `reject_harganyata/{id_det_po_nk}`

Route existing yang tetap digunakan:

- `edit_harganyata`
- `hrgnyataon/{kd_po_nk}`
- `hrgnyataoff/{kd_po_nk}`

## Catatan Kompatibilitas

Kode tetap membaca kolom lama `tbpo_detail_po_nk.hrg_nyata` dan `tbpo_detail_po_nk.total_nyata` sebagai fallback.

Setelah migration baru dijalankan, data utama realisasi dibaca dari:

- `tbpo_realisasi_po_nk`
- `tbpo_realisasi_detail_po_nk`
- `tbpo_realisasi_harganyata_log`

Jika tabel realisasi belum ada dan harga nyata lebih tinggi dari harga pengajuan, proses pembelian akan diblokir karena sistem belum memiliki tempat approval Direktur yang akuntabel.
