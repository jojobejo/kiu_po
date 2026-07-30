# Rollback Development Modul Hari Ini - 2026-07-29

## Tujuan

Mengembalikan development hari ini kecuali modul Laporan Cost PO NK Per PIC.

## Dipertahankan

- Modul laporan cost PIC/PONK tetap dipertahankan.
- Route `export_cost_pic_ponk` tetap aktif.
- File laporan `application/controllers/laporan/C_Laporan.php`, `application/views/content/laporan/lap_cost_pic_ponk.php`, menu sidebar laporan, dan dokumentasi laporan cost PIC tetap ada.
- Logic `M_Laporanp::getcostpicponk()` dan `M_Laporanp::getdetailcostpicponk()` tetap memakai nilai realisasi bila tabel `tb_penerimaan_po_nk_detail` tersedia, dengan fallback ke nilai PO lama bila tabel belum ada.

## Dikembalikan

- Perubahan lokal flow Reqpic/Postatus hari ini dikembalikan ke kondisi `HEAD`.
- Route baru `listbarangready/ajax`, `realisasi_pembelian_nk`, dan `barang_ready_nk` dihapus.
- Route `pononkomersiljasa` dikembalikan ke target lama `purchaseorder/pojasa/C_Pojasa`.
- File modul PO Jasa yang dibuat pada development hari ini dihapus dari working tree.
- Dokumen development, database, user guide, dan SQL pendukung untuk modul yang dikembalikan ikut dihapus.

## Validasi

- `C:\xampp\php\php.exe -l application\config\routes.php`
- `C:\xampp\php\php.exe -l application\models\Laporan\M_Laporanp.php`

