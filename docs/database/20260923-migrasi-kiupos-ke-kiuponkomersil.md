# Dokumentasi database: migrasi kiupos ke kiuponkomersil

## File

- Skrip: [20260923_migrate_kiupos_to_kiuponkomersil.sql](20260923_migrate_kiupos_to_kiuponkomersil.sql)
- Sumber lama: `kiupos`
- Target baru: `kiuponkomersil`

## Prasyarat

Kedua database harus berada pada instance MySQL/MariaDB yang sama. Jalankan dump struktur/data target baru terlebih dahulu. Backup target sebelum migrasi.

Contoh eksekusi dari PowerShell:

```powershell
Get-Content .\docs\database\20260923_migrate_kiupos_to_kiuponkomersil.sql | mysql.exe -u <user> -p
```

Jika server menggunakan host/port tertentu, tambahkan opsi koneksi sesuai lingkungan.

## Validasi minimum

```sql
SELECT COUNT(*) AS old_po FROM `kiupos`.`tb_po`;
SELECT COUNT(*) AS new_po FROM `kiuponkomersil`.`tbpo_po`;

SELECT COUNT(*) AS old_detail FROM `kiupos`.`tb_detail_po`;
SELECT COUNT(*) AS new_detail FROM `kiuponkomersil`.`tbpo_detail_po`;

SELECT COUNT(*) AS old_po_nk FROM `kiupos`.`tb_po_nk`;
SELECT COUNT(*) AS new_po_nk FROM `kiuponkomersil`.`tbpo_po_nk`;
```

Perbedaan jumlah tidak selalu berarti gagal karena target dapat sudah berisi data. Audit baris yang konflik berdasarkan primary key sebelum memutuskan apakah perlu mode overwrite.

## Batasan

Skrip ini tidak mengisi tabel baru yang tidak ada di sumber lama, tidak mengubah struktur, tidak menyalin view, dan tidak menimpa baris target yang memiliki key sama. Foreign key checks dimatikan selama proses dan diaktifkan kembali setelah commit.

