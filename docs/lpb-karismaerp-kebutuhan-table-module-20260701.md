# Kebutuhan Tabel dan Module LPB di KarismaERP

Tanggal: 2026-07-01

## Tujuan module

Module LPB (Laporan Penerimaan Barang) di KarismaERP menerima data PO komersil dari aplikasi KIU PO, lalu mencatat penerimaan fisik barang di ERP.

API KIU PO hanya menyediakan data PO dan barang tanpa harga. Nomor invoice, kode faktur penerimaan, gudang, batch, lot, expired date, dan qty diterima dicatat di ERP.

## Module yang dibutuhkan

1. LPB Sync PO Komersil
   - Menarik data dari endpoint KIU PO.
   - Menyimpan data staging/upsert berdasarkan `kode_sync`.
   - Menampilkan status sync sukses/gagal.

2. LPB Penerimaan Barang
   - Membuat LPB dari data PO komersil yang sudah tersinkron.
   - Input nomor invoice, kode faktur, tanggal terima, gudang, no lot, expired date, dan qty diterima.
   - Mendukung partial receive jika barang datang bertahap.

3. Mapping Master
   - Mapping `kode_suplier` KIU PO ke supplier ERP jika kode master berbeda.
   - Mapping `kode_barang` KIU PO ke barang ERP jika kode master berbeda.

4. Stock Integration
   - Posting LPB ke tabel stock ERP.
   - Menambah stock batch dan stock ledger dengan referensi LPB.

5. Audit Log
   - Mencatat sync, create LPB, edit LPB, cancel LPB, dan posting stock.

## Tabel minimal yang disarankan

### `tberp_lpb_po_sync`

Staging data detail PO komersil dari API KIU PO.

```sql
CREATE TABLE `tberp_lpb_po_sync` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_sync` varchar(100) NOT NULL,
  `kd_po` varchar(255) NOT NULL,
  `kode_faktur_source` varchar(255) DEFAULT NULL,
  `nomor_po` varchar(255) DEFAULT NULL,
  `nomor_invoice_source` varchar(255) DEFAULT NULL,
  `tanggal_po` date DEFAULT NULL,
  `status_po` varchar(50) DEFAULT NULL,
  `kode_suplier_source` varchar(25) DEFAULT NULL,
  `nama_suplier_source` text DEFAULT NULL,
  `id_detail_source` int(11) DEFAULT NULL,
  `kode_barang_source` varchar(50) DEFAULT NULL,
  `nama_barang_source` text DEFAULT NULL,
  `satuan` varchar(50) DEFAULT NULL,
  `qty_po` decimal(18,4) DEFAULT 0.0000,
  `isi` decimal(15,2) DEFAULT 0.00,
  `kemasan` decimal(15,2) DEFAULT 0.00,
  `qty_kecil` decimal(18,4) DEFAULT 0.0000,
  `is_bonus` tinyint(1) DEFAULT 0,
  `keterangan_bonus` varchar(255) DEFAULT NULL,
  `po_updated_at` datetime DEFAULT NULL,
  `detail_updated_at` datetime DEFAULT NULL,
  `sync_status` enum('NEW','READY','MAPPED','LPB_CREATED','ERROR') NOT NULL DEFAULT 'NEW',
  `sync_message` text DEFAULT NULL,
  `last_synced_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_tberp_lpb_po_sync_kode_sync` (`kode_sync`),
  KEY `idx_tberp_lpb_po_sync_kd_po` (`kd_po`),
  KEY `idx_tberp_lpb_po_sync_barang` (`kode_barang_source`),
  KEY `idx_tberp_lpb_po_sync_suplier` (`kode_suplier_source`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

### `tberp_lpb`

Header LPB di ERP.

```sql
CREATE TABLE `tberp_lpb` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no_lpb` varchar(50) NOT NULL,
  `kd_po` varchar(255) NOT NULL,
  `nomor_po` varchar(255) DEFAULT NULL,
  `nomor_invoice` varchar(100) DEFAULT NULL,
  `kode_faktur` varchar(100) DEFAULT NULL,
  `tanggal_po` date DEFAULT NULL,
  `tanggal_terima` date NOT NULL,
  `kode_suplier_source` varchar(25) DEFAULT NULL,
  `supplier_erp_id` int(11) DEFAULT NULL,
  `nama_suplier` text DEFAULT NULL,
  `gudang_id` int(11) DEFAULT NULL,
  `status` enum('DRAFT','POSTED','CANCELLED') NOT NULL DEFAULT 'DRAFT',
  `catatan` text DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `posted_by` varchar(50) DEFAULT NULL,
  `posted_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_tberp_lpb_no_lpb` (`no_lpb`),
  KEY `idx_tberp_lpb_kd_po` (`kd_po`),
  KEY `idx_tberp_lpb_invoice` (`nomor_invoice`),
  KEY `idx_tberp_lpb_kode_faktur` (`kode_faktur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

### `tberp_lpb_detail`

Detail penerimaan barang.

```sql
CREATE TABLE `tberp_lpb_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lpb_id` int(11) NOT NULL,
  `sync_id` int(11) DEFAULT NULL,
  `kode_sync` varchar(100) NOT NULL,
  `id_detail_source` int(11) DEFAULT NULL,
  `kode_barang_source` varchar(50) DEFAULT NULL,
  `barang_erp_id` int(11) DEFAULT NULL,
  `kode_barang_erp` varchar(50) DEFAULT NULL,
  `nama_barang` text DEFAULT NULL,
  `satuan` varchar(50) DEFAULT NULL,
  `qty_po` decimal(18,4) DEFAULT 0.0000,
  `qty_terima` decimal(18,4) DEFAULT 0.0000,
  `qty_kecil_po` decimal(18,4) DEFAULT 0.0000,
  `qty_kecil_terima` decimal(18,4) DEFAULT 0.0000,
  `no_lot` varchar(100) DEFAULT NULL,
  `expired_date` date DEFAULT NULL,
  `is_bonus` tinyint(1) DEFAULT 0,
  `keterangan` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_tberp_lpb_detail_lpb_sync` (`lpb_id`,`kode_sync`),
  KEY `idx_tberp_lpb_detail_barang` (`kode_barang_source`),
  CONSTRAINT `fk_tberp_lpb_detail_header` FOREIGN KEY (`lpb_id`) REFERENCES `tberp_lpb` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

### `tberp_lpb_sync_log`

Log proses penarikan API.

```sql
CREATE TABLE `tberp_lpb_sync_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `endpoint` varchar(255) NOT NULL,
  `request_params` text DEFAULT NULL,
  `response_status` varchar(50) DEFAULT NULL,
  `total_data` int(11) DEFAULT 0,
  `success_count` int(11) DEFAULT 0,
  `error_count` int(11) DEFAULT 0,
  `message` text DEFAULT NULL,
  `started_at` datetime DEFAULT NULL,
  `finished_at` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

## Relasi ke stock ERP

Pada dump KarismaERP ditemukan tabel stock seperti:

- `tberp_stock_batch`
- `tberp_stock_ledger`

Saat LPB diposting:

1. Tambahkan atau update batch di `tberp_stock_batch`.
2. Tambahkan pergerakan masuk di `tberp_stock_ledger`.
3. Gunakan `ref_type = 'LPB'`.
4. Gunakan `ref_no = no_lpb`.

## Status yang disarankan

1. `NEW`
   - Data baru masuk dari API.

2. `MAPPED`
   - Supplier dan barang sudah cocok dengan master ERP.

3. `LPB_CREATED`
   - Data sudah dibuat menjadi dokumen LPB.

4. `POSTED`
   - LPB sudah masuk stock.

5. `CANCELLED`
   - LPB dibatalkan.

## Kunci sinkronisasi

Gunakan `kode_sync` dari API sebagai unique key detail sumber. Formatnya:

```text
{kd_po}-{id_detail_source}
```

Contoh:

```text
SKPO010726WAHAN010001-7875
```

Dengan kunci ini, ERP aman melakukan upsert saat sync dijalankan berulang.
