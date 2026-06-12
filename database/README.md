# Database Backup

Folder ini dipakai untuk backup database proyek.

- `backups/kiucoid_po_full_20260530_145420.sql`: dump terbaru dari database lokal `kiucoid_po`, berisi struktur dan data.
- `archive/`: salinan arsip SQL lama dari folder `db` dan file `kiucoid_po (1).sql` di root proyek.

Catatan: dump terbaru dibuat tanpa opsi routines karena metadata routine MySQL/MariaDB lokal perlu diperbaiki dengan `mysql_upgrade`. Struktur tabel, data, trigger, dan view tetap ikut masuk ke dump.
