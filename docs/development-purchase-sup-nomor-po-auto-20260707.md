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
001/KIU/VII/2026
```

Penjelasan format:

- `001`: nomor urut PO berdasarkan supplier. Jika supplier belum memiliki PO, sistem mulai dari `001`.
- `KIU`: kode tetap.
- `VII`: bulan berjalan dalam angka romawi.
- `2026`: tahun berjalan.

## Perilaku Baru

1. Saat halaman `purchase/sup/{kd_suplier}` dibuka, kolom Nomor PO otomatis berisi nomor berikutnya untuk supplier tersebut.
2. User masih dapat mengubah nomor PO secara manual.
3. Input manual otomatis dirapikan:
   - angka depan dibuat 3 digit,
   - kode tengah dipaksa `KIU`,
   - huruf dibuat uppercase,
   - spasi dihapus.
4. Jika nomor PO sudah pernah digunakan di `tb_po.no_po`, kolom menjadi merah dan muncul pesan peringatan.
5. Tombol simpan menolak submit ketika nomor PO duplikat atau format tidak sesuai.
6. Backend `rekam_po()` juga memvalidasi format dan duplikasi agar data tetap aman dari request manual.

## Endpoint Baru

```text
POST purchase/check-nomor-po
```

Payload:

```text
no_po=001/KIU/VII/2026
```

Response:

```json
{"exists": true}
```

## Cara Penggunaan

1. Buka menu Purchase Order.
2. Pilih supplier.
3. Masuk ke route `purchase/sup/{kd_suplier}`.
4. Kolom Nomor PO otomatis terisi.
5. Jika kolom berubah merah, gunakan nomor PO lain karena nomor tersebut sudah dipakai.
6. Lengkapi tanggal, pengiriman, tempo, item, lalu klik selesai/simpan.

