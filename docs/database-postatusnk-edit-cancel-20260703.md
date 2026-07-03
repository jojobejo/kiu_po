# Database Postatus NK Edit dan Cancel Pengajuan

Tanggal: 2026-07-03
Module: `postatusnk/`

## Tabel Terkait

### `tb_po_nk`

Kolom yang digunakan:

- `kd_po_req`: kode request asal yang menghubungkan PO NK dengan pengajuan.
- `kd_po_nk`: kode PO Non Komersil.
- `status`: status workflow PO NK.
- `tj_pembelian`: tujuan pembelian.

Perubahan data:

- Fitur Cancel Pengajuan mengubah `status` menjadi `PENGAJUAN DIBATALKAN`.
- Fitur Edit Tujuan Pembelian mengubah `tj_pembelian`.

### `tb_req_nk`

Kolom yang digunakan:

- `kd_po_nk`: kode request asal.
- `tj_pembelian`: tujuan pembelian dari request.

Perubahan data:

- Saat tujuan pembelian PO NK diedit, `tb_req_nk.tj_pembelian` ikut diperbarui jika `tb_req_nk.kd_po_nk` sama dengan `tb_po_nk.kd_po_req`.

### `tb_note_direktur`

Kolom yang digunakan:

- `kd_po`
- `isi_note`
- `kd_user`
- `nama_user`
- `note_for`
- `update_status`

Perubahan data:

- Cancel Pengajuan menambah note `PO CANCEL - PENGAJUAN DIBATALKAN`.
- Edit Tujuan Pembelian menambah note `EDIT DATA TUJUAN PEMBELIAN`.

## Status Final yang Dikunci

Data tidak dapat diedit atau dibatalkan melalui endpoint baru jika status berada pada salah satu nilai berikut:

- `DONE`
- `REJECT`
- `PENGAJUAN DIBATALKAN`

## SQL Verifikasi Manual

Cek data PO NK berdasarkan kode request:

```sql
SELECT kd_po_nk, kd_po_req, nopo, status, tj_pembelian
FROM tb_po_nk
WHERE kd_po_req = 'KODE_REQUEST';
```

Cek sinkronisasi tujuan pembelian dengan request asal:

```sql
SELECT kd_po_nk, status, tj_pembelian
FROM tb_req_nk
WHERE kd_po_nk = 'KODE_REQUEST';
```

Cek histori note:

```sql
SELECT kd_po, isi_note, kd_user, nama_user, log_create
FROM tb_note_direktur
WHERE kd_po IN ('KODE_PO_NK', 'KODE_REQUEST')
ORDER BY id_note DESC;
```

## Migrasi Schema

Tidak ada perubahan struktur tabel pada development ini.

Catatan:

- Pastikan kolom `tb_po_nk.status` cukup menampung nilai `PENGAJUAN DIBATALKAN`.
- Pada dump database yang tersedia di repo, kolom status PO NK umumnya bertipe `varchar(25)`, sehingga nilai tersebut masih aman.
