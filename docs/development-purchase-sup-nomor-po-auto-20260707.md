# Development - Auto Nomor PO Supplier

Tanggal: 2026-07-07

## Modul

- Route utama: `purchase/sup/{kd_suplier}`
- Controller: `application/controllers/purchaseorder/C_Order.php`
- Model: `application/models/PO/M_Purchase.php`
- View: `application/views/content/po/purchase.php`
- Script AJAX: `application/views/content/po/ajaxPO.php`

## Ringkasan Perubahan

Nomor PO pada halaman purchase supplier sekarang otomatis terisi dengan format:

```text
Q001/KIU/VII/2026
Q001/KIU/VII/2026A
```

Penjelasan format:

- `Q` / `A`: kode PO yang dipilih user melalui select pada form.
- `001`: nomor urut PO berdasarkan supplier dan kode PO. Jika supplier yang sama sudah pernah memakai nomor dasar tersebut, sistem naik ke nomor berikutnya.
- `KIU`: kode tetap.
- `VII`: bulan berjalan dalam angka romawi.
- `2026`: tahun berjalan.
- `A`: suffix alfabet opsional di belakang tahun jika nomor dasar yang sama sudah dipakai supplier berbeda.

## Perilaku Baru

1. Saat halaman `purchase/sup/{kd_suplier}` dibuka, kolom Nomor PO otomatis berisi nomor berikutnya untuk supplier tersebut.
2. User masih dapat mengubah nomor PO secara manual.
3. User memilih kode PO `Q` atau `A`; pilihan tersebut otomatis menjadi huruf depan nomor PO.
4. Input manual otomatis dirapikan:
   - angka depan dibuat 3 digit,
   - kode tengah dipaksa `KIU`,
   - huruf dibuat uppercase,
   - spasi dihapus.
5. Jika nomor dasar sudah digunakan supplier yang sama, kolom menjadi merah dan user diminta memakai nomor berikutnya.
6. Jika nomor dasar sudah digunakan supplier berbeda, sistem dapat memakai suffix `A` sampai `Z` pada akhir nomor.
7. Tombol simpan menolak submit ketika nomor PO exact sudah ada, nomor dasar bentrok dengan supplier yang sama, atau format tidak sesuai.
8. Backend `rekam_po()` juga memvalidasi format dan duplikasi agar data tetap aman dari request manual.

## Endpoint Baru

```text
POST purchase/check-nomor-po
```

Payload:

```text
no_po=Q001/KIU/VII/2026&kode_po=Q
```

Response:

```json
{"exists": true, "same_supplier": false, "suggested": "Q001/KIU/VII/2026A"}
```

## Cara Penggunaan

1. Buka menu Purchase Order.
2. Pilih supplier.
3. Masuk ke route `purchase/sup/{kd_suplier}`.
4. Kolom Nomor PO otomatis terisi.
5. Jika kolom berubah merah karena supplier berbeda, gunakan nomor dengan suffix alfabet yang disarankan. Jika supplier sama, gunakan nomor berikutnya.
6. Lengkapi tanggal, pengiriman, tempo, item, lalu klik selesai/simpan.
