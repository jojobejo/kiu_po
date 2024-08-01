-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 01 Agu 2024 pada 17.26
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kiucoid_po_dev`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_akun_tr`
--

CREATE TABLE `tb_akun_tr` (
  `id_akun` int(11) NOT NULL,
  `kd_akun` varchar(25) NOT NULL,
  `ket_akun` text NOT NULL,
  `input_by` varchar(25) NOT NULL,
  `create_at` datetime NOT NULL,
  `update_by` varchar(25) NOT NULL,
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_akun_tr`
--

INSERT INTO `tb_akun_tr` (`id_akun`, `kd_akun`, `ket_akun`, `input_by`, `create_at`, `update_by`, `update_at`) VALUES
(1, '11510', 'Pengeluaran barang non komersil', 'KEU02', '2024-07-31 12:57:39', 'KEU02', '2024-07-31 06:11:50'),
(2, '11511', 'Pembelian barang non komersil', 'KEU02', '2024-07-31 12:57:39', 'KEU02', '2024-07-31 06:11:50'),
(3, '11513', 'Penyesuaian barang non komersil', 'KEU02', '2024-07-31 12:57:39', 'KEU02', '2024-07-31 06:11:50');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_barang_nk`
--

CREATE TABLE `tb_barang_nk` (
  `id_brg_nk` int(11) NOT NULL,
  `kd_barang` varchar(25) NOT NULL,
  `kd_br_adm` varchar(25) NOT NULL,
  `kat_barang` varchar(25) NOT NULL,
  `nama_barang` text NOT NULL,
  `descnk` text NOT NULL,
  `satuan` int(5) NOT NULL,
  `gbr_barang` text NOT NULL,
  `inputer` varchar(25) NOT NULL,
  `create_at` datetime NOT NULL,
  `last_updated` varchar(25) NOT NULL,
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_barang_nk`
--

INSERT INTO `tb_barang_nk` (`id_brg_nk`, `kd_barang`, `kd_br_adm`, `kat_barang`, `nama_barang`, `descnk`, `satuan`, `gbr_barang`, `inputer`, `create_at`, `last_updated`, `update_at`) VALUES
(1, 'PONK3007240001', 'QKREBES1', 'KATBR002', 'kresek plastik', 'Besar Uk 40-50 Cm Merah', 11, 'Karisma.png', 'KIUADMIN', '2024-07-30 00:00:00', 'KIUADMIN', '2024-07-29 17:00:00'),
(2, 'PONK3007240002', 'QKREBES2', 'KATBR002', 'kresek plastik', 'Sedang Uk 36-40 cm', 11, 'Karisma.png', 'KIUADMIN', '2024-07-30 00:00:00', 'KIUADMIN', '2024-07-29 17:00:00'),
(3, 'PONK3007240003', 'QKREBES3', 'KATBR002', 'kresek plastik', 'Sedang Uk 30-35 Cm', 11, 'Karisma.png', 'KIUADMIN', '2024-07-30 00:00:00', 'KIUADMIN', '2024-07-29 17:00:00'),
(4, 'PONK3007240004', 'QKREBES4', 'KATBR002', 'kresek plastik', 'Kecil Uk 28 Cm', 11, 'Karisma.png', 'KIUADMIN', '2024-07-30 00:00:00', 'KIUADMIN', '2024-07-29 17:00:00'),
(5, 'PONK3007240005', 'QTINMER1', 'KATBR001', 'Tinta Epson 664', 'Warna Merah', 2, 'Karisma.png', 'KIUADMIN', '2024-07-30 00:00:00', 'KIUADMIN', '2024-07-29 17:00:00'),
(6, 'PONK3007240006', 'QTINMER2', 'KATBR001', 'Tinta Epson 664', 'Warna Kuning', 2, 'Karisma.png', 'KIUADMIN', '2024-07-30 00:00:00', 'KIUADMIN', '2024-07-29 17:00:00'),
(7, 'PONK3007240007', 'QTINMER3', 'KATBR001', 'Tinta Epson 664', 'Warna Hitam', 2, 'Karisma.png', 'KIUADMIN', '2024-07-30 00:00:00', 'KIUADMIN', '2024-07-29 17:00:00'),
(8, 'PONK3007240008', 'QTINMER4', 'KATBR001', 'Tinta Epson 664', 'Warna Biru', 2, 'Karisma.png', 'KIUADMIN', '2024-07-30 00:00:00', 'KIUADMIN', '2024-07-29 17:00:00'),
(9, 'PONK3007240009', 'QAIRKEM1', 'KATBR002', 'Air Mineral Cleo', 'Kemasan gelas 230 ml', 3, 'Karisma.png', 'KIUADMIN', '2024-07-30 00:00:00', 'KIUADMIN', '2024-07-29 17:00:00'),
(10, 'PONK3007240010', 'QAIRGAL1', 'KATBR002', 'Air Galon Cleo', 'Galon Cleo 18 Liter', 2, 'Karisma.png', 'KIUADMIN', '2024-07-30 00:00:00', 'KIUADMIN', '2024-07-29 17:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_detail_po_nk`
--

CREATE TABLE `tb_detail_po_nk` (
  `id_det_po_nk` int(11) NOT NULL,
  `kd_po_nk` varchar(25) NOT NULL,
  `kd_user` varchar(25) NOT NULL,
  `tgl_transaksi` text NOT NULL,
  `kd_barang` varchar(25) NOT NULL,
  `nama_barang` text NOT NULL,
  `deskripsi` text NOT NULL,
  `keterangan` text NOT NULL,
  `qty` int(12) NOT NULL,
  `hrg_satuan` int(25) NOT NULL,
  `hrg_nyata` int(25) NOT NULL,
  `total_harga` int(25) NOT NULL,
  `total_nyata` int(25) NOT NULL,
  `gbr_produk` varchar(255) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_file_nk`
--

CREATE TABLE `tb_file_nk` (
  `id_file_nk` int(11) NOT NULL,
  `kd_po_nk` varchar(255) NOT NULL,
  `keterangan` text NOT NULL,
  `user_upload` varchar(25) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_uploaded` varchar(255) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_generate_kd`
--

CREATE TABLE `tb_generate_kd` (
  `id` int(11) NOT NULL,
  `kd_barang` varchar(25) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kat_br`
--

CREATE TABLE `tb_kat_br` (
  `id_kat_br` int(11) NOT NULL,
  `kd_kat` varchar(25) NOT NULL,
  `nama_kategori` text NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_kat_br`
--

INSERT INTO `tb_kat_br` (`id_kat_br`, `kd_kat`, `nama_kategori`, `keterangan`) VALUES
(1, 'KATBR001', 'ATK', 'Alat Tulis Kerja'),
(2, 'KATBR002', 'RTK', 'Rumah Tangga Konsumsi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_note_barang`
--

CREATE TABLE `tb_note_barang` (
  `id_nt_barang` int(25) NOT NULL,
  `kd_po` varchar(25) NOT NULL,
  `kd_suplier` varchar(25) NOT NULL,
  `isi_note` text NOT NULL,
  `color_box` text NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_note_direktur`
--

CREATE TABLE `tb_note_direktur` (
  `id_note` int(11) NOT NULL,
  `kd_po` varchar(25) NOT NULL,
  `isi_note` text NOT NULL,
  `kd_user` varchar(25) NOT NULL,
  `nama_user` text NOT NULL,
  `note_for` int(5) NOT NULL,
  `update_status` int(5) NOT NULL,
  `log_create` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_note_pembelian`
--

CREATE TABLE `tb_note_pembelian` (
  `id_nt_pembelian` int(11) NOT NULL,
  `kd_po` varchar(25) NOT NULL,
  `keterangan` text NOT NULL,
  `kd_user` varchar(25) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_nt_tmp_pembelian`
--

CREATE TABLE `tb_nt_tmp_pembelian` (
  `id_tmp_nt_pembelian` int(12) NOT NULL,
  `keterangan` text NOT NULL,
  `kd_user` varchar(25) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_po_nk`
--

CREATE TABLE `tb_po_nk` (
  `id_po_nk` int(12) NOT NULL,
  `jns_po` int(5) NOT NULL,
  `kd_po_nk` varchar(25) NOT NULL,
  `nopo` text NOT NULL,
  `kd_user` varchar(25) NOT NULL,
  `nm_user` text NOT NULL,
  `tgl_transaksi` text NOT NULL,
  `jml_item` int(12) NOT NULL,
  `total_harga` int(25) NOT NULL,
  `status` varchar(25) NOT NULL,
  `departemen` text NOT NULL,
  `tj_pembelian` text NOT NULL,
  `tax` int(3) NOT NULL,
  `hrg_pajak` int(25) NOT NULL,
  `hrg_nyata` int(25) NOT NULL,
  `status_hrg_nyata` int(11) NOT NULL,
  `acc_with` varchar(25) NOT NULL,
  `acc_with_kadep` varchar(255) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_po_nk`
--

INSERT INTO `tb_po_nk` (`id_po_nk`, `jns_po`, `kd_po_nk`, `nopo`, `kd_user`, `nm_user`, `tgl_transaksi`, `jml_item`, `total_harga`, `status`, `departemen`, `tj_pembelian`, `tax`, `hrg_pajak`, `hrg_nyata`, `status_hrg_nyata`, `acc_with`, `acc_with_kadep`, `create_at`) VALUES
(1, 1, 'NKPO1005240003', '004/10/05/2024', 'KARYAWAN2', 'Bram', '2024-05-10', 3, 50000, 'DONE', 'KEUANGAN', 'Kebutuhan ATK', 0, 0, 0, 0, 'KIUDIREKTUR03', 'KADEP01', '2024-08-01 13:22:34');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_satuan`
--

CREATE TABLE `tb_satuan` (
  `id_satuan` int(5) NOT NULL,
  `nm_satuan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_satuan`
--

INSERT INTO `tb_satuan` (`id_satuan`, `nm_satuan`) VALUES
(1, 'Btl'),
(2, 'Pcs'),
(3, 'Box'),
(4, 'Roll'),
(5, 'Drum'),
(6, 'Zak'),
(8, 'SatuanContoh'),
(9, 'Kg'),
(10, 'Ltr'),
(11, 'Pack'),
(12, 'Pail'),
(13, 'Gal'),
(14, 'Ember');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_set_tax`
--

CREATE TABLE `tb_set_tax` (
  `id_tax` int(5) NOT NULL,
  `nm_tax` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_set_tax`
--

INSERT INTO `tb_set_tax` (`id_tax`, `nm_tax`) VALUES
(1, 0),
(2, 20),
(3, 11);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_tmp_item_nk`
--

CREATE TABLE `tb_tmp_item_nk` (
  `id_tmp_nk` int(11) NOT NULL,
  `nama_barang` text NOT NULL,
  `deskripsi` text NOT NULL,
  `keterangan` text NOT NULL,
  `qty` int(12) NOT NULL,
  `hrg_satuan` int(25) NOT NULL,
  `total_harga` int(25) NOT NULL,
  `kd_barang` varchar(25) NOT NULL,
  `kd_user` varchar(25) NOT NULL,
  `gbr_produk` varchar(255) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_tmp_note_barang`
--

CREATE TABLE `tb_tmp_note_barang` (
  `id_nt_tmp_barang` int(11) NOT NULL,
  `kd_suplier` varchar(25) NOT NULL,
  `isi_note` text NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_tmp_note_barang`
--

INSERT INTO `tb_tmp_note_barang` (`id_nt_tmp_barang`, `kd_suplier`, `isi_note`, `create_at`) VALUES
(385, 'KHARI01', '', '2024-01-13 01:55:52');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_tmp_tax`
--

CREATE TABLE `tb_tmp_tax` (
  `id_tmp_tax` int(11) NOT NULL,
  `kd_suplier` varchar(25) NOT NULL,
  `tax` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data untuk tabel `tb_tmp_tax`
--

INSERT INTO `tb_tmp_tax` (`id_tmp_tax`, `kd_suplier`, `tax`) VALUES
(442, 'KHARI01', 0),
(867, 'GOLDE02', 11);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_transaksi`
--

CREATE TABLE `tb_transaksi` (
  `id_transnk` int(11) NOT NULL,
  `kd_akun` varchar(25) NOT NULL,
  `kd_po_nk` varchar(25) NOT NULL,
  `kd_barang` varchar(25) NOT NULL,
  `kd_barangsys` varchar(25) NOT NULL,
  `kat_barang` varchar(25) NOT NULL,
  `tr_qty` double NOT NULL,
  `satuan` int(2) NOT NULL,
  `inputer` varchar(25) NOT NULL,
  `create_at` datetime NOT NULL,
  `last_updated_by` varchar(25) NOT NULL,
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_transaksi`
--

INSERT INTO `tb_transaksi` (`id_transnk`, `kd_akun`, `kd_po_nk`, `kd_barang`, `kd_barangsys`, `kat_barang`, `tr_qty`, `satuan`, `inputer`, `create_at`, `last_updated_by`, `update_at`) VALUES
(1, '11511', 'NKPO1005240003', 'QKREBES1', 'PONK3007240001', 'KATBR002', 10, 11, 'KIUADMIN', '2024-07-31 12:57:39', 'KIUADMIN', '2024-07-31 05:57:39'),
(2, '11511', 'NKPO1005240003', 'QKREBES2', 'PONK3007240002', 'KATBR002', 5, 11, 'KIUADMIN', '2024-07-31 12:57:39', 'KIUADMIN', '2024-07-31 05:57:39'),
(3, '11511', 'NKPO1005240003', 'QTINMER3', 'PONK3007240007', 'KATBR001', 3, 2, 'KIUADMIN', '2024-07-31 12:57:39', 'KIUADMIN', '2024-07-31 05:57:39');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(12) NOT NULL,
  `kode_user` varchar(25) NOT NULL,
  `nama_user` text NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `aksess_lv` int(5) NOT NULL,
  `departement` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `kode_user`, `nama_user`, `username`, `password`, `aksess_lv`, `departement`) VALUES
(1, 'KIUADMIN', 'Admin', 'admin', '$2y$10$seJv4qBUldBZQUjvoWUxGuJvtNsO.cLzT.9IGqshkdla6QLxladGW', 1, 'Admin'),
(4, 'KEU01', 'Supriyanto', 'keuangan1', '$2y$10$sCheJ3KQmaL2uUEOKLvmLuC2ixXcq6r5L9TN37eGZzAehKfDoBKvC', 2, 'KEUANGAN'),
(5, 'KIUDIREKTUR01', 'Agoes Santoso', 'direktur1', '$2y$10$fKtWlc8KmnuSxrq7p98k8.WCGk7vS38md0A1AY5gyskiMrE8z5zIK', 3, 'DIREKTUR'),
(6, 'KIUDIREKTUR02', 'Annelia Kartika', 'direktur2', '$2y$10$CrrNDht4fm8DGUun1FDIMuRdLRTHTQiv81TgI0GPnMS/b.jiPzOxS', 3, 'DIREKTUR'),
(7, 'KIUDIREKTUR03', 'Yuanita Setiawati', 'direktur3', '$2y$10$S/H/EG8zEBkxX7eZezmdGOOGLEY39//2YLwd5dRamq46NIYUpDeju', 3, 'DIREKTUR'),
(8, 'KEU02', 'Arini', 'keuangan2', '$2y$10$sCheJ3KQmaL2uUEOKLvmLuC2ixXcq6r5L9TN37eGZzAehKfDoBKvC', 2, 'KEUANGAN'),
(9, 'KEU03', 'Nadia', 'keuangan3', '$2y$10$sCheJ3KQmaL2uUEOKLvmLuC2ixXcq6r5L9TN37eGZzAehKfDoBKvC', 2, 'KEUANGAN'),
(10, 'KEU05', 'Supriyanto', 'direktur4', '$2y$10$b/iG5dgP9dafpoG.vbdjUO6US2ZZb0uKFqy7N3pjAWaUprYQhQGaC', 3, 'DIREKTUR'),
(11, 'KEU04', 'Tarizqa', 'keuangan4', '$2y$10$sCheJ3KQmaL2uUEOKLvmLuC2ixXcq6r5L9TN37eGZzAehKfDoBKvC', 2, 'KEUANGAN'),
(12, 'KARYAWAN1', 'Ika', 'pickeu', '$2y$10$KeBGAKJTXGYXt39wb.FZYedFST5fbIuxQ8hRcHRsYTxsauhoxyNbO', 4, 'KEUANGAN'),
(13, 'KARYAWAN2', 'Bram', 'picit', '$2y$10$KeBGAKJTXGYXt39wb.FZYedFST5fbIuxQ8hRcHRsYTxsauhoxyNbO', 4, 'KEUANGAN'),
(14, 'KADEP01', 'Diana Wulandari', 'kadepkeu', '$2y$10$0oqW2GOFypG50vbNluIakurV.rEKjRdhYsuFI9Hq3BrJP28VIhdke', 5, 'KEUANGAN'),
(15, 'KARYAWAN5', 'Nita', 'picsales', '$2y$10$KeBGAKJTXGYXt39wb.FZYedFST5fbIuxQ8hRcHRsYTxsauhoxyNbO', 4, 'SALES'),
(16, 'KARYAWAN3', 'Bayu', 'piclogistik', '$2y$10$KeBGAKJTXGYXt39wb.FZYedFST5fbIuxQ8hRcHRsYTxsauhoxyNbO', 4, 'LOGISTIK'),
(17, 'KARYAWAN6', 'Riza', 'pichrd', '$2y$10$KeBGAKJTXGYXt39wb.FZYedFST5fbIuxQ8hRcHRsYTxsauhoxyNbO', 4, 'KEUANGAN'),
(18, 'KARYAWAN4', 'Arif', 'picga', '$2y$10$KeBGAKJTXGYXt39wb.FZYedFST5fbIuxQ8hRcHRsYTxsauhoxyNbO', 4, 'GA'),
(19, 'KADEP02', 'Heru Sucahyo', 'kadepsales', '$2y$10$0oqW2GOFypG50vbNluIakurV.rEKjRdhYsuFI9Hq3BrJP28VIhdke', 5, 'SALES'),
(20, 'KADEP03', 'Nandang Ernoko', 'kadeplogistik', '$2y$10$0oqW2GOFypG50vbNluIakurV.rEKjRdhYsuFI9Hq3BrJP28VIhdke', 5, 'LOGISTIK'),
(21, 'KADEP04', 'Diana Wulandari', 'kadephrd', '$2y$10$0oqW2GOFypG50vbNluIakurV.rEKjRdhYsuFI9Hq3BrJP28VIhdke', 5, 'HRD'),
(22, 'KADEP05', 'Lisgianto', 'kadepga', '$2y$10$susAFHsAVUhEAGoNV/R8XeQA7ql0f0r2ZohS/D4medlaKkGppbvXe', 5, 'GA'),
(23, 'KIUDIREKTUR05', 'Annelia Kartika', 'direktur5', '$2y$10$KeBGAKJTXGYXt39wb.FZYedFST5fbIuxQ8hRcHRsYTxsauhoxyNbO', 3, 'DIREKTUR'),
(25, 'KARYAWAN7', 'Arini', 'picpurchasing', '$2y$10$KeBGAKJTXGYXt39wb.FZYedFST5fbIuxQ8hRcHRsYTxsauhoxyNbO', 4, 'KEUANGAN'),
(26, 'KEU0010', 'Supriyanto', 'superadmin', '$2y$10$KeBGAKJTXGYXt39wb.FZYedFST5fbIuxQ8hRcHRsYTxsauhoxyNbO', 2, 'KEUANGAN');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_akun_tr`
--
ALTER TABLE `tb_akun_tr`
  ADD PRIMARY KEY (`id_akun`);

--
-- Indeks untuk tabel `tb_barang_nk`
--
ALTER TABLE `tb_barang_nk`
  ADD PRIMARY KEY (`id_brg_nk`);

--
-- Indeks untuk tabel `tb_detail_po_nk`
--
ALTER TABLE `tb_detail_po_nk`
  ADD PRIMARY KEY (`id_det_po_nk`);

--
-- Indeks untuk tabel `tb_file_nk`
--
ALTER TABLE `tb_file_nk`
  ADD PRIMARY KEY (`id_file_nk`);

--
-- Indeks untuk tabel `tb_generate_kd`
--
ALTER TABLE `tb_generate_kd`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_kat_br`
--
ALTER TABLE `tb_kat_br`
  ADD PRIMARY KEY (`id_kat_br`);

--
-- Indeks untuk tabel `tb_note_barang`
--
ALTER TABLE `tb_note_barang`
  ADD PRIMARY KEY (`id_nt_barang`);

--
-- Indeks untuk tabel `tb_note_direktur`
--
ALTER TABLE `tb_note_direktur`
  ADD PRIMARY KEY (`id_note`);

--
-- Indeks untuk tabel `tb_note_pembelian`
--
ALTER TABLE `tb_note_pembelian`
  ADD PRIMARY KEY (`id_nt_pembelian`);

--
-- Indeks untuk tabel `tb_nt_tmp_pembelian`
--
ALTER TABLE `tb_nt_tmp_pembelian`
  ADD PRIMARY KEY (`id_tmp_nt_pembelian`);

--
-- Indeks untuk tabel `tb_po_nk`
--
ALTER TABLE `tb_po_nk`
  ADD PRIMARY KEY (`id_po_nk`);

--
-- Indeks untuk tabel `tb_satuan`
--
ALTER TABLE `tb_satuan`
  ADD PRIMARY KEY (`id_satuan`);

--
-- Indeks untuk tabel `tb_set_tax`
--
ALTER TABLE `tb_set_tax`
  ADD PRIMARY KEY (`id_tax`);

--
-- Indeks untuk tabel `tb_tmp_item_nk`
--
ALTER TABLE `tb_tmp_item_nk`
  ADD PRIMARY KEY (`id_tmp_nk`);

--
-- Indeks untuk tabel `tb_tmp_note_barang`
--
ALTER TABLE `tb_tmp_note_barang`
  ADD PRIMARY KEY (`id_nt_tmp_barang`);

--
-- Indeks untuk tabel `tb_tmp_tax`
--
ALTER TABLE `tb_tmp_tax`
  ADD PRIMARY KEY (`id_tmp_tax`);

--
-- Indeks untuk tabel `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD PRIMARY KEY (`id_transnk`);

--
-- Indeks untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_akun_tr`
--
ALTER TABLE `tb_akun_tr`
  MODIFY `id_akun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_barang_nk`
--
ALTER TABLE `tb_barang_nk`
  MODIFY `id_brg_nk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `tb_detail_po_nk`
--
ALTER TABLE `tb_detail_po_nk`
  MODIFY `id_det_po_nk` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_file_nk`
--
ALTER TABLE `tb_file_nk`
  MODIFY `id_file_nk` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_generate_kd`
--
ALTER TABLE `tb_generate_kd`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_kat_br`
--
ALTER TABLE `tb_kat_br`
  MODIFY `id_kat_br` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tb_note_barang`
--
ALTER TABLE `tb_note_barang`
  MODIFY `id_nt_barang` int(25) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_note_direktur`
--
ALTER TABLE `tb_note_direktur`
  MODIFY `id_note` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_note_pembelian`
--
ALTER TABLE `tb_note_pembelian`
  MODIFY `id_nt_pembelian` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_nt_tmp_pembelian`
--
ALTER TABLE `tb_nt_tmp_pembelian`
  MODIFY `id_tmp_nt_pembelian` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `tb_po_nk`
--
ALTER TABLE `tb_po_nk`
  MODIFY `id_po_nk` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_satuan`
--
ALTER TABLE `tb_satuan`
  MODIFY `id_satuan` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `tb_set_tax`
--
ALTER TABLE `tb_set_tax`
  MODIFY `id_tax` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_tmp_item_nk`
--
ALTER TABLE `tb_tmp_item_nk`
  MODIFY `id_tmp_nk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=228;

--
-- AUTO_INCREMENT untuk tabel `tb_tmp_note_barang`
--
ALTER TABLE `tb_tmp_note_barang`
  MODIFY `id_nt_tmp_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=932;

--
-- AUTO_INCREMENT untuk tabel `tb_tmp_tax`
--
ALTER TABLE `tb_tmp_tax`
  MODIFY `id_tmp_tax` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1073;

--
-- AUTO_INCREMENT untuk tabel `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  MODIFY `id_transnk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
