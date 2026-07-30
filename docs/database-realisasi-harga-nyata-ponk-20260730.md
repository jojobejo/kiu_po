# Database Realisasi Harga Nyata PONK

Tanggal: 2026-07-30

## Ringkasan

Development ini membutuhkan struktur database baru untuk memisahkan data pengajuan dan data realisasi pembelian.

File migration:

- `db/2026/add_realisasi_harga_nyata_ponk_20260730.sql`

## Tabel Baru

### tbpo_realisasi_po_nk

Header realisasi per nomor PONK.

Kolom utama:

- `kd_po_nk`
- `status_realisasi`
- `created_by`
- `updated_by`
- `created_at`
- `updated_at`

Constraint:

- `kd_po_nk` dibuat unique supaya satu PONK hanya memiliki satu header realisasi aktif.

### tbpo_realisasi_detail_po_nk

Detail realisasi per item PONK.

Kolom utama:

- `kd_po_nk`
- `id_det_po_nk`
- `qty_pengajuan`
- `harga_pengajuan`
- `total_pengajuan`
- `qty_nyata`
- `harga_nyata`
- `total_nyata`
- `selisih_harga`
- `status_approval_harga`
- `alasan_realisasi`
- `approved_by`
- `approved_at`

Nilai `status_approval_harga`:

- `BELUM_INPUT`
- `DISETUJUI_OTOMATIS`
- `PENDING_DIREKTUR`
- `DISETUJUI_DIREKTUR`
- `DITOLAK_DIREKTUR`

Constraint:

- `id_det_po_nk` dibuat unique supaya satu detail item hanya memiliki satu realisasi aktif.

### tbpo_realisasi_harganyata_log

Log aktivitas realisasi harga nyata.

Kolom utama:

- `kd_po_nk`
- `id_det_po_nk`
- `aksi`
- `keterangan`
- `kd_user`
- `nama_user`
- `created_at`

## Tabel Existing Yang Tetap Digunakan

- `tbpo_po_nk.status_hrg_nyata`
  - Tetap dipakai sebagai switch tampilan fitur Harga Nyata.
- `tbpo_detail_po_nk.hrg_nyata`
  - Tetap diisi sebagai legacy compatibility.
- `tbpo_detail_po_nk.total_nyata`
  - Tetap diisi sebagai legacy compatibility.
- `tbpo_note_direktur`
  - Dipakai untuk mencatat note approval/reject harga nyata.

## Cara Menjalankan Migration

Contoh untuk database lokal XAMPP:

```powershell
Get-Content db\2026\add_realisasi_harga_nyata_ponk_20260730.sql | C:\xampp\mysql\bin\mysql.exe -u root kiucoid_karismaerp_local
```

Sesuaikan nama database jika environment production berbeda.

## Rollback

Rollback struktur:

```sql
DROP TABLE IF EXISTS tbpo_realisasi_harganyata_log;
DROP TABLE IF EXISTS tbpo_realisasi_detail_po_nk;
DROP TABLE IF EXISTS tbpo_realisasi_po_nk;
```

Rollback ini tidak menghapus kolom legacy `hrg_nyata`, `total_nyata`, dan `status_hrg_nyata` karena kolom tersebut sudah existing sebelum development ini.
