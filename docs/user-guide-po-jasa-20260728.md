# Panduan Penggunaan PO Jasa - 2026-07-28

## Akses modul

Buka menu:

`Purchase Order > Non Komersil > PO Jasa`

## Master Vendor Jasa

1. Buka tab `Vendor Jasa`.
2. Isi nama vendor, kategori jasa, alamat, kontak, telpon, email, dan NPWP bila ada.
3. Klik `Simpan Vendor`.
4. Vendor aktif akan muncul sebagai pilihan pada form Request Jasa.
5. Vendor dapat dinonaktifkan tanpa menghapus histori request lama.

## Membuat Request Jasa

1. Buka tab `Request Jasa`.
2. Pilih Vendor Jasa.
3. Isi prioritas, judul jasa, tanggal kebutuhan, lokasi, kegiatan vendor, alasan kebutuhan, dan catatan.
4. Isi rincian biaya:
   - `JASA`
   - `OPERASIONAL`
   - `BAHAN`
   - `LAIN_LAIN`
5. Total estimasi dan pajak dihitung otomatis.
6. Klik `Draft` jika belum ingin diajukan.
7. Klik `Ajukan` jika request siap masuk approval.

## Melihat Histori dan Status

1. Buka tab `List Request`.
2. Gunakan filter status/tanggal bila diperlukan.
3. Klik tombol mata pada kolom `#`.
4. Detail menampilkan data request, breakdown biaya, dan histori aktivitas.

## Update Status

Aksi status muncul sesuai role dan status dokumen.

- PIC dapat submit draft dan konfirmasi selesai.
- KADEP dapat approve/reject request departemennya.
- Keuangan/Purchasing dapat review biaya, terbitkan PO, mulai pelaksanaan, dan close.
- Direktur dapat approve/reject setelah review biaya.

Setiap update status akan masuk ke histori aktivitas.
