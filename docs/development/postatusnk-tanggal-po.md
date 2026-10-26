# Perbaikan Tanggal PO pada Status Nonkomersil

Tanggal: 26 Oktober 2026

## Perubahan pengembangan

Helper `format_indo()` sebelumnya mengambil tahun, bulan, dan hari berdasarkan posisi karakter, lalu mengindeks nama hari dan bulan tanpa memeriksa hasil parsing. Nilai `tgl_transaksi` berformat `DD/MM/YYYY` membuat `strtotime()` gagal dan memicu `Undefined offset: -1` pada halaman `postatusnk`.

Helper kini mem-parsing format ISO (`YYYY-MM-DD`, termasuk waktu), `DD/MM/YYYY`, `DD-MM-YYYY`, dan `DD.MM.YYYY`. Nilai tanggal kosong atau nol ditampilkan sebagai `-`; nilai yang tidak dikenali ditampilkan dengan aman tanpa memicu offset error. Waktu hanya ditampilkan bila tersedia.

## Cara menggunakan

Tidak ada langkah tambahan untuk pengguna. Muat ulang halaman **PO Pembelian** (`postatusnk`); tanggal yang ada akan tampil dalam format bahasa Indonesia, misalnya `Kamis, 17 Oktober 2024`.

## Validasi

Pemeriksaan database lokal menemukan 1.458 nilai tanggal ISO dan 5 nilai `DD/MM/YYYY` di `tb_po_nk`. Uji tampilan lewat browser belum dilakukan.
