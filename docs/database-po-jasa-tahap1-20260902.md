# Dokumentasi Database - PO Jasa Tahap 1

Tanggal: 2026-09-02

## Modul

- Route utama: `pononkomersiljasa`
- Controller: `application/controllers/purchaseorder/C_Pojasa.php`
- Model: `application/models/PO/M_Pojasa.php`
- SQL migration: `docs/database/2026-09-02-po-jasa-tahap1.sql`

## Perubahan Struktur Database

Tahap 1 membutuhkan tabel baru khusus PO Jasa agar data vendor, request, scope pekerjaan, approval, dan nomor SPK tidak bercampur dengan PO Non Komersil barang.

Tabel baru:

- `tbpo_jasa_vendor`
- `tbpo_jasa_request`
- `tbpo_jasa_request_detail`
- `tbpo_jasa_note`

Tidak ada perubahan pada tabel PO Non Komersil existing seperti `tbpo_po_nk`, `tbpo_detail_po_nk`, `tbpo_tmp_item_nk`, atau transaksi stok.

## Alasan Tabel Baru

Historis jasa sebelumnya tercatat sebagai item PO Non Komersil dan vendor sering berada di teks keterangan. Struktur baru membuat vendor menjadi data relasional, approval jasa lebih mudah diaudit, dan proses jasa tidak ikut masuk ke mutasi stok barang.

## Tabel `tbpo_jasa_vendor`

Menyimpan master vendor jasa.

Kolom utama:

- `kd_vendor_jasa`: kode vendor jasa, contoh `VJ0001`.
- `nama_vendor`: nama vendor.
- `kategori_jasa`: kategori pekerjaan jasa.
- `nama_pic`, `no_telpon`, `email`: kontak vendor.
- `alamat_vendor`, `npwp`: identitas vendor.
- `status_vendor`: `AKTIF` atau `NONAKTIF`.

## Tabel `tbpo_jasa_request`

Menyimpan header request PO Jasa.

Kolom utama:

- `kd_po_jasa`: kode request, contoh `PJASA0209260001`.
- `no_spk`: nomor PO/SPK jasa setelah diterbitkan.
- `kd_vendor_jasa`: relasi ke vendor.
- `kd_user`, `nm_user`, `departemen`: identitas requester.
- `tgl_request`, `tgl_target`: tanggal request dan target selesai.
- `lokasi_pekerjaan`, `tujuan_pekerjaan`: konteks pekerjaan.
- `estimasi_total`: total estimasi dari detail scope.
- `status`: status approval.
- `acc_with_kadep`, `acc_at_kadep`: approval KADEP.
- `acc_with_direktur`, `acc_at_direktur`: approval Direktur.
- `generated_by`, `generated_at`: penerbit SPK.

## Tabel `tbpo_jasa_request_detail`

Menyimpan scope pekerjaan dan estimasi biaya per baris.

Kolom utama:

- `kd_po_jasa`: relasi header request.
- `nama_pekerjaan`: nama scope.
- `deskripsi`: detail pekerjaan.
- `qty`, `satuan`, `hrg_satuan`, `total_harga`: estimasi biaya.

## Tabel `tbpo_jasa_note`

Menyimpan audit status dan catatan approval.

Kolom utama:

- `kd_po_jasa`: relasi request.
- `isi_note`: catatan proses.
- `kd_user`, `nama_user`: user yang melakukan aksi.
- `aksi_status`: status setelah aksi.
- `create_at`: waktu audit.

## Cara Menjalankan Migration

Jalankan pada database development yang dipakai aplikasi `kiu_po`. Saat scan ini, konfigurasi lokal aktif mengarah ke database `kiucoid_karismaerp_local`.

Contoh PowerShell:

```powershell
Get-Content docs\database\2026-09-02-po-jasa-tahap1.sql | C:\xampp\mysql\bin\mysql.exe -u root kiucoid_karismaerp_local
```

Sesuaikan nama database dan credential jika konfigurasi lokal berbeda.

## Rollback Struktur

Rollback hanya boleh dilakukan bila belum ada data produksi yang dibutuhkan.

```sql
DROP TABLE IF EXISTS tbpo_jasa_note;
DROP TABLE IF EXISTS tbpo_jasa_request_detail;
DROP TABLE IF EXISTS tbpo_jasa_request;
DROP TABLE IF EXISTS tbpo_jasa_vendor;
```

## Dampak Data

- Data PO Jasa baru tersimpan di tabel khusus.
- Data PO Non Komersil existing tidak diubah.
- Tidak ada mutasi stok saat PO/SPK Jasa diterbitkan.
- Audit approval tersimpan di `tbpo_jasa_note`.

## Validasi Lokal

Migration sudah dijalankan pada database lokal `kiucoid_karismaerp_local`.

Tabel yang terverifikasi tersedia:

- `tbpo_jasa_vendor`
- `tbpo_jasa_request`
- `tbpo_jasa_request_detail`
- `tbpo_jasa_note`
