# Development Notes - Fix Merge Akun Draft Request PONK

Tanggal: 2026-07-27

## Latar Belakang

Pada route `reqpic/`, draft request barang PONK dapat terlihat merge dengan akun lain saat submit draft melalui tombol biru. Akar masalahnya ada pada proses generate nomor `kd_po_nk` yang sebelumnya dibuat saat halaman draft dibuka, lalu dikirim sebagai hidden input. Jika dua user membuka atau submit request dalam waktu berdekatan, hidden input dapat membawa nomor yang sama.

## File Yang Diubah

- `application/controllers/purchaseorder/C_Reqpic.php`
- `application/models/PO/M_Reqpic.php`
- `application/config/routes.php`
- `application/views/content/po/Reqpic/body.php`
- `application/views/content/po/Reqpic/restockpo.php`
- `application/views/content/po/Reqpic/promosiseed.php`
- `application/views/content/po/Reqpic/promosicp.php`

## Perubahan Aplikasi

1. Submit draft PONK sekarang memakai helper internal `submit_non_komersil_request()`.
2. Controller tidak lagi mempercayai `kd_user` dari URL `addnewreq/(:any)`.
3. Controller tidak lagi memakai `kdponk` dari hidden input sebagai nomor resmi request.
4. Nomor resmi PONK dibuat saat submit oleh `M_Reqpic::reserve_kdnonkomersial()`.
5. `reserve_kdnonkomersial()` memakai MySQL named lock per tanggal, sehingga dua submit bersamaan akan antre.
6. Insert header `tb_req_nk`, detail `tb_detail_req`, note, dan hapus draft temp dibungkus transaction.
7. Jumlah item `jml_item` dihitung dari draft session user, bukan dari hidden input `totbr`.
8. PIC detail route sekarang mengecek ownership lewat `getrequestbypicuser($kdpo, $kduser)`.
9. Dataset item untuk tampilan PIC difilter dengan `kd_po_nk` dan `kd_user`.
10. View submit draft sekarang memakai endpoint tanpa parameter user:
   - `addnewreq`
   - `add_promosi_seed`
   - `add_promosi_cp`

## Alur Baru Submit Draft

1. PIC menambah barang ke draft seperti biasa.
2. Draft tetap tersimpan di `tb_tmp_item_nk` berdasarkan `kd_user` session.
3. Saat tombol biru submit ditekan, controller mengambil `kd_user` dari session.
4. Model mengambil lock `kiu_po_nponk_YYYYMMDD`.
5. Model membaca nomor terakhir hari itu dari `tb_generate_kd_ponk`.
6. Model membuat nomor `NPONKddmmyyNNNN`, memastikan belum dipakai, lalu menyimpan nomor ke `tb_generate_kd_ponk`.
7. Controller membuat header request di `tb_req_nk`.
8. Controller memindahkan semua draft user tersebut ke `tb_detail_req`.
9. Controller membuat note request dan menghapus draft temp user.
10. Jika salah satu proses insert gagal, transaction rollback dan request tidak diproses setengah jalan.

## Dampak Ke Role

PIC:
- Submit draft tidak lagi rawan mengambil nomor yang sama dengan akun lain.
- PIC tidak bisa membuka detail request akun lain hanya dengan mengganti URL.
- Jika ada data lama yang pernah merge, tampilan PIC akan memfilter item berdasarkan akun PIC tersebut.

Admin Keuangan:
- Alur monitoring dan proses detail request tetap sama.
- Admin tetap dapat melihat request lintas akun sesuai role.
- Data request baru tidak akan tercampur antar akun karena nomor request di-reserve server-side.

## Verifikasi Development

Perintah lint yang sudah dijalankan:

```bash
C:\xampp\php\php.exe -l application\controllers\purchaseorder\C_Reqpic.php
C:\xampp\php\php.exe -l application\models\PO\M_Reqpic.php
C:\xampp\php\php.exe -l application\config\routes.php
C:\xampp\php\php.exe -l application\views\content\po\Reqpic\body.php
C:\xampp\php\php.exe -l application\views\content\po\Reqpic\restockpo.php
C:\xampp\php\php.exe -l application\views\content\po\Reqpic\promosiseed.php
C:\xampp\php\php.exe -l application\views\content\po\Reqpic\promosicp.php
```

Semua file tersebut lulus lint PHP.

