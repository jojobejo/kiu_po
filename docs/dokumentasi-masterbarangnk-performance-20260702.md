# Dokumentasi Optimasi Master Barang NK

Tanggal dokumentasi: 2 Juli 2026

## Modul

- Route: `masterbarangnk`
- Controller: `application/controllers/master_barang/C_MasterBarang.php`
- Model: `application/models/Master_barang/M_MasterBarang.php`
- View utama: `application/views/content/mbarang/mbody.php`
- Modal: `application/views/content/mbarang/modal/modalmbarang.php`

## Masalah

Halaman Master Barang Non Komersil terasa lambat karena semua data barang dimuat sekaligus dan view membuat modal aksi berulang untuk setiap barang.

Sebelum perubahan, file `modalmbarang.php` melakukan `foreach ($barangnk as $brnk)` lalu merender:

- modal tambah barang,
- modal edit,
- modal hapus,
- modal upload gambar.

Dampaknya, jika data berisi 1.000 barang, halaman mengirim ribuan blok modal/form ke browser sebelum user melakukan aksi apa pun. Pada database lokal yang dicek tanggal 2 Juli 2026, `tb_barang_nk` berisi 875 barang; pola lama berarti sekitar 3.500 modal/form tambahan. Biaya render HTML, parsing DOM, dan inisialisasi modal menjadi besar.

## Perubahan Development

1. Modal tambah, edit, hapus, dan upload sekarang hanya dirender satu kali.
2. Tombol aksi di tabel membawa data barang melalui atribut `data-*`.
3. Saat modal dibuka, JavaScript mengisi field form dari tombol yang diklik.
4. Query `get_all_masterbarang()` tidak lagi memakai `SELECT *`; hanya kolom yang digunakan halaman yang diambil.
5. Perilaku route dan endpoint form tetap dipertahankan:
   - tambah: `add_mbarang`
   - edit: `edit_mbarangnk`
   - hapus: `delmbarangnk`
   - upload: `uploadmbarangnk`
   - generate QR: `genqrcode/...`
6. Modal tambah barang diberi scanning kode barang pada field `kd_adm`.
7. Endpoint `masterbarangnk/check-kode` mengecek `tb_barang_nk.kd_barang` dan mengembalikan nama barang jika kode sudah dipakai.
8. Submit tambah barang diberi guard server-side agar kode duplikat tidak tersimpan jika user melewati validasi browser.

## Dampak

- Ukuran HTML awal halaman turun signifikan karena tidak ada lagi tiga modal aksi per baris data.
- Browser lebih cepat membangun DOM.
- Form edit, hapus, dan upload tetap memakai endpoint lama sehingga alur bisnis tidak berubah.
- Halaman kosong sekarang tetap memiliki modal tambah barang, karena modal tambah tidak lagi bergantung pada adanya baris barang.
- Saat kode barang pada modal tambah sudah dipakai, field berubah merah dan menampilkan teks: `Kode barang telah di gunakan dengan nama barang: ...`.

## Catatan Database

Tidak ada perubahan struktur database.

Perubahan query hanya membatasi kolom hasil select dari tabel:

- `tb_barang_nk`
- `tb_satuan`
- `tb_kat_br`

Tidak ada perubahan struktur database untuk fitur scanning kode barang.

## Verifikasi

- Syntax PHP controller/model/view dicek dengan `C:\xampp\php\php.exe -l`.
- Query baru dicek ke database lokal `kiucoid_po` dan berhasil mengambil data dari 875 master barang.
- HTTP check ke `http://localhost/kiu_po/masterbarangnk` mengembalikan `307`, sehingga validasi browser perlu dilakukan dengan session login aktif.
- Validasi manual yang perlu dilakukan di browser:
  - buka route `masterbarangnk`,
  - klik tombol tambah barang,
- isi kode barang yang sudah ada, contoh data lokal `QAIR002`, lalu pastikan field berubah merah dan menampilkan nama barang `Air Mineral`,
  - isi kode barang baru, lalu pastikan tombol Simpan bisa digunakan kembali,
  - klik tombol edit pada salah satu baris dan pastikan field terisi sesuai baris,
  - klik tombol hapus dan pastikan ID barang yang dikirim sesuai,
  - klik tombol upload gambar dan pastikan form submit masih menuju `uploadmbarangnk`.
