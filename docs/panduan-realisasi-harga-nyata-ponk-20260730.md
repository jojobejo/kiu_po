# Panduan Penggunaan Realisasi Harga Nyata PONK

Tanggal: 2026-07-30

## Tujuan Modul

Modul Realisasi Harga Nyata PONK dipakai untuk mencatat harga pembelian real setelah PONK disetujui Direktur.

Modul ini menjaga dua data tetap terpisah:

- Harga pengajuan: harga yang dilihat dan disetujui Direktur.
- Harga nyata: harga real saat Purchasing melakukan pembelian.

## Alur Bisnis

1. PIC membuat pengajuan PONK.
2. Kadep melakukan approval kebutuhan.
3. Direktur melakukan approval atas harga pengajuan.
4. Setelah status menjadi `ACC DIREKTUR`, Purchasing mengisi realisasi pembelian.
5. Qty nyata dicatat sebagai data realisasi, tetapi tidak menjadi pemicu approval Direktur.
6. Harga nyata dibandingkan dengan harga pengajuan.
7. Jika harga nyata lebih rendah atau sama, Purchasing dapat lanjut proses pembelian.
8. Jika harga nyata lebih tinggi, Direktur wajib approve/reject harga tersebut.
9. Purchasing baru dapat lanjut ke `PROSES PEMBELIAN` setelah semua item selesai input dan tidak ada approval harga yang pending/ditolak.

## Cara Penggunaan Purchasing

1. Buka menu `PO Status NK`.
2. Buka detail PONK dengan status `ACC DIREKTUR`.
3. Klik `Harga Nyata OFF` sampai berubah menjadi `Harga Nyata ON`.
4. Pada tiap item, klik `Add Harganyata`.
5. Isi:
   - `Qty Nyata`
   - `Harga Nyata`
   - `Alasan Selisih` bila ada perubahan dari kondisi pengajuan.
6. Simpan.
7. Perhatikan kolom `Approval Harga`.
8. Jika semua item `OTOMATIS` atau `DISETUJUI DIREKTUR`, Purchasing dapat melanjutkan `PROSES PEMBELIAN`.

## Cara Penggunaan Direktur

1. Buka detail PONK yang memiliki item `PENDING DIREKTUR`.
2. Lihat kolom pembanding:
   - Harga pengajuan
   - Harga nyata
   - Total harga nyata
   - Alasan selisih
3. Klik `Approve` jika harga nyata dapat diterima.
4. Klik `Reject` jika harga nyata harus dinegosiasikan ulang.

## Catatan Kontrol Internal

- Approval Direktur hanya berdasarkan `Harga Nyata > Harga Pengajuan`.
- Perubahan `Qty Nyata` tidak memicu approval Direktur.
- Jika harga nyata ditolak, Purchasing harus revisi harga nyata sebelum proses pembelian.
- Setelah ada realisasi yang diinput, switch Harga Nyata tidak dapat dimatikan agar data tetap terbuka untuk audit.
