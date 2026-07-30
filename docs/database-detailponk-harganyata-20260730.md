# Database Detail PONK Harga Nyata

Tanggal: 2026-07-30

## Ringkasan

Tidak ada perubahan struktur database pada development ini.

## Tabel dan Kolom Existing Yang Digunakan

- `tbpo_po_nk.status_hrg_nyata`
  - Dipakai sebagai switch tampilan Harga Nyata.
  - Nilai `1` berarti Harga Nyata ON.
  - Nilai `0` berarti Harga Nyata OFF.
- `tbpo_detail_po_nk.hrg_nyata`
  - Menyimpan harga nyata per item.
- `tbpo_detail_po_nk.total_nyata`
  - Menyimpan total harga nyata per item dari hasil `qty * hrg_nyata`.

## Query/Model Existing

- `M_Postatus::sumharganyata($kdpo)` membaca total dari `SUM(total_nyata)`.
- `M_Postatus::editharganyatadetail($id, $data)` menyimpan `hrg_nyata` dan `total_nyata`.
- `M_Postatus::changestatusnyata($kdponk, $data)` dipakai oleh switch Harga Nyata ON/OFF.

## Migrasi

Tidak diperlukan migrasi database.

## Rollback Database

Tidak ada rollback database yang diperlukan karena tidak ada perubahan schema maupun data otomatis.
