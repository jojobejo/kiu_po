-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 12 Sep 2024 pada 10.30
-- Versi server: 10.4.17-MariaDB
-- Versi PHP: 8.0.1

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `qrcode_path` text NOT NULL,
  `qrcode_data` varchar(50) NOT NULL,
  `inputer` varchar(25) NOT NULL,
  `create_at` datetime NOT NULL,
  `last_updated` varchar(25) NOT NULL,
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_barang_nk`
--

INSERT INTO `tb_barang_nk` (`id_brg_nk`, `kd_barang`, `kd_br_adm`, `kat_barang`, `nama_barang`, `descnk`, `satuan`, `gbr_barang`, `qrcode_path`, `qrcode_data`, `inputer`, `create_at`, `last_updated`, `update_at`) VALUES
(1, 'PONK3007240001', 'QKREBES1', 'KATBR002', 'kresek plastik', 'Besar Uk 40-50 Cm Merah', 11, 'Karisma.png', 'kresekplastik645.png', 'QRC0408240010', 'KIUADMIN', '2024-07-30 00:00:00', 'KEU02', '2024-08-04 14:33:21'),
(2, 'PONK3007240002', 'QKREBES2', 'KATBR002', 'kresek plastik', 'Sedang Uk 36-40 cm', 11, 'Karisma.png', 'kresekplastik584.png', 'QRC0408240011', 'KIUADMIN', '2024-07-30 00:00:00', 'KEU02', '2024-08-04 14:34:05'),
(3, 'PONK3007240003', 'QKREBES3', 'KATBR002', 'kresek plastik', 'Sedang Uk 30-35 Cm', 11, 'Karisma.png', 'kresekplastik529.png', 'QRC0608240001', 'KIUADMIN', '2024-07-30 00:00:00', 'KEU02', '2024-08-06 03:59:52'),
(4, 'PONK3007240004', 'QKREBES4', 'KATBR002', 'kresek plastik', 'Kecil Uk 28 Cm', 11, '2024081724039948_QKREBES4.jpg', 'kresekplastik939.png', 'QRC2008240002', 'KIUADMIN', '2024-07-30 00:00:00', 'KEU01', '2024-08-20 07:02:28'),
(5, 'PONK3007240005', 'QTINMER1', 'KATBR001', 'Tinta Epson 664', 'Warna Merah', 2, '1724040114-QTINMER1.jpg', 'tintaepson664279.png', 'QRC2008240003', 'KIUADMIN', '2024-07-30 00:00:00', 'KEU01', '2024-08-20 07:02:42'),
(6, 'PONK3007240006', 'QTINMER2', 'KATBR001', 'Tinta Epson 664', 'Warna Kuning', 2, 'Karisma.png', 'tintaepson664963.png', 'QRC2708240003', 'KIUADMIN', '2024-07-30 00:00:00', 'KEU02', '2024-08-27 04:38:57'),
(7, 'PONK3007240007', 'QTINMER3', 'KATBR001', 'Tinta Epson 664', 'Warna Hitam', 2, 'Karisma.png', '', '', 'KIUADMIN', '2024-07-30 00:00:00', 'KIUADMIN', '2024-07-29 17:00:00'),
(8, 'PONK3007240008', 'QTINMER4', 'KATBR001', 'Tinta Epson 664', 'Warna Biru', 2, 'Karisma.png', '', '', 'KIUADMIN', '2024-07-30 00:00:00', 'KIUADMIN', '2024-07-29 17:00:00'),
(9, 'PONK3007240009', 'QAIRKEM1', 'KATBR002', 'Air Mineral Cleo', 'Kemasan gelas 230 ml', 3, 'Karisma.png', '', '', 'KIUADMIN', '2024-07-30 00:00:00', 'KIUADMIN', '2024-07-29 17:00:00'),
(10, 'PONK3007240010', 'QAIRGAL1', 'KATBR002', 'Air Galon Cleo', 'Galon Cleo 18 Liter', 2, 'Karisma.png', '', '', 'KIUADMIN', '2024-07-30 00:00:00', 'KIUADMIN', '2024-07-29 17:00:00'),
(19, 'PONK0608240001', 'QCONTO', 'KATBR001', 'asdasdasd', 'asdasdasd', 10, 'Karisma.png', 'asdasdasd599.png', 'QRC0608240003', 'KARYAWAN2', '2024-08-06 15:44:38', 'KARYAWAN2', '2024-08-06 08:44:38'),
(20, 'PONK1908240001', 'QHDM01', 'KATBR001', 'Kabel HDMI', 'HDMI Ugreen 2.1 - 3 Meter', 2, '2024081724039644_ugreenhdmi.png', 'kabelhdmi709.png', 'QRC1908240001', 'KARYAWAN2', '2024-08-19 10:35:33', 'KARYAWAN2', '2024-08-19 03:54:04'),
(21, 'PONK2008240002', 'QSTAP01', 'KATBR001', 'Staples Besar', 'Staples Besar  pcs ', 2, 'Karisma.png', 'staplesbesar468.png', 'QRC2008240001', 'KARYAWAN5', '2024-08-20 14:01:32', 'KARYAWAN5', '2024-08-20 07:01:32'),
(23, 'PONK2708240003', 'QRCONTO1231111', 'KATBR001', 'cb1', 'cb2', 2, 'Karisma.png', 'cb1985.png', 'QRC2708240002', 'KARYAWAN2', '2024-08-27 10:50:58', 'KARYAWAN2', '2024-08-27 03:50:58');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_detail_po_nk`
--

CREATE TABLE `tb_detail_po_nk` (
  `id_det_po_nk` int(11) NOT NULL,
  `kd_po_nk` varchar(25) NOT NULL,
  `kd_po_req` varchar(25) NOT NULL,
  `kd_user` varchar(25) NOT NULL,
  `tgl_transaksi` text NOT NULL,
  `kd_bsys` varchar(25) NOT NULL,
  `kd_barang` varchar(25) NOT NULL,
  `nama_barang` text NOT NULL,
  `deskripsi` text NOT NULL,
  `keterangan` text NOT NULL,
  `qty` int(12) NOT NULL,
  `satuan` int(2) NOT NULL,
  `kat_barang` varchar(25) NOT NULL,
  `hrg_satuan` int(25) NOT NULL,
  `hrg_nyata` int(25) NOT NULL,
  `total_harga` int(25) NOT NULL,
  `total_nyata` int(25) NOT NULL,
  `gbr_produk` varchar(255) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_detail_po_nk`
--

INSERT INTO `tb_detail_po_nk` (`id_det_po_nk`, `kd_po_nk`, `kd_po_req`, `kd_user`, `tgl_transaksi`, `kd_bsys`, `kd_barang`, `nama_barang`, `deskripsi`, `keterangan`, `qty`, `satuan`, `kat_barang`, `hrg_satuan`, `hrg_nyata`, `total_harga`, `total_nyata`, `gbr_produk`, `create_at`) VALUES
(1, 'NKPO0709240001', 'PONK0709240001', 'KARYAWAN2', '2024-09-07', 'PONK3007240001', 'QKREBES1', 'kresek plastik', 'Besar Uk 40-50 Cm Merah', '-', 25, 11, 'KATBR002', 0, 0, 0, 0, 'Karisma.png', '2024-09-07 06:27:12'),
(2, 'NKPO0709240001', 'PONK0709240001', 'KARYAWAN2', '2024-09-07', 'PONK1908240001', 'QHDM01', 'Kabel HDMI', 'HDMI Ugreen 2.1 - 3 Meter', '-', 50, 2, 'KATBR001', 0, 0, 0, 0, 'Karisma.png', '2024-09-07 06:27:12'),
(3, 'NKPO1209240001', 'PONK1209240003', 'KARYAWAN2', '2024-09-12', 'PONK3007240007', 'QTINMER3', 'Tinta Epson 664', 'Warna Hitam', '-', 50, 2, 'KATBR001', 0, 0, 0, 0, 'Karisma.png', '2024-09-12 04:54:04'),
(4, 'NKPO1209240001', 'PONK1209240003', 'KARYAWAN2', '2024-09-12', 'PONK0608240001', 'QCONTO', 'asdasdasd', 'asdasdasd', '-', 30, 10, 'KATBR001', 0, 0, 0, 0, 'Karisma.png', '2024-09-12 04:54:04');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_detail_req`
--

CREATE TABLE `tb_detail_req` (
  `id_det_po_nk` int(11) NOT NULL,
  `kd_po_nk` varchar(25) NOT NULL,
  `kd_user` varchar(25) NOT NULL,
  `tgl_transaksi` text NOT NULL,
  `kd_bsys` varchar(25) NOT NULL,
  `kd_barang` varchar(25) NOT NULL,
  `nama_barang` text NOT NULL,
  `deskripsi` text NOT NULL,
  `keterangan` text NOT NULL,
  `qty` int(12) NOT NULL,
  `satuan` int(2) NOT NULL,
  `kat_barang` varchar(25) NOT NULL,
  `status` int(11) NOT NULL,
  `sts_done` int(2) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_detail_req`
--

INSERT INTO `tb_detail_req` (`id_det_po_nk`, `kd_po_nk`, `kd_user`, `tgl_transaksi`, `kd_bsys`, `kd_barang`, `nama_barang`, `deskripsi`, `keterangan`, `qty`, `satuan`, `kat_barang`, `status`, `sts_done`, `create_at`) VALUES
(1, 'PONK0709240001', 'KARYAWAN2', '2024-09-07', 'PONK3007240010', 'QAIRGAL1', 'Air Galon Cleo', 'Galon Cleo 18 Liter', '-', 5, 2, 'KATBR002', 1, 0, '2024-09-07 06:26:57'),
(2, 'PONK0709240001', 'KARYAWAN2', '2024-09-07', 'PONK3007240009', 'QAIRKEM1', 'Air Mineral Cleo', 'Kemasan gelas 230 ml', '-', 15, 3, 'KATBR002', 1, 0, '2024-09-07 06:26:59'),
(5, 'PONK0709240001', 'KARYAWAN2', '2024-09-07', 'PONK3007240007', 'QTINMER3', 'Tinta Epson 664', 'Warna Hitam', '-', 20, 2, 'KATBR001', 1, 0, '2024-09-07 06:27:01'),
(8, 'PONK1209240003', 'KARYAWAN2', '2024-09-12', 'PONK1908240001', 'QHDM01', 'Kabel HDMI', 'HDMI Ugreen 2.1 - 3 Meter', '-', 5, 2, 'KATBR001', 1, 0, '2024-09-12 04:50:16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_diskon`
--

CREATE TABLE `tb_diskon` (
  `id_diskon` int(11) NOT NULL,
  `kd_po` varchar(255) NOT NULL,
  `kd_suplier` varchar(25) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `nominal` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_file_bukti_beli`
--

CREATE TABLE `tb_file_bukti_beli` (
  `id_fk_bukti` int(11) NOT NULL,
  `kd_po_nk` varchar(255) NOT NULL,
  `keterangan` text NOT NULL,
  `user_upload` varchar(255) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `file_uploaded` varchar(255) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_file_bukti_beli`
--

INSERT INTO `tb_file_bukti_beli` (`id_fk_bukti`, `kd_po_nk`, `keterangan`, `user_upload`, `file_name`, `file_uploaded`, `create_at`) VALUES
(1, 'NKPO0709240001', '-', 'KEU02', '2024091725682382', '2024091725682382.png', '2024-09-07 04:13:02'),
(2, 'NKPO0709240001', '-', 'KEU02', '2024091725683815', '2024091725683815.png', '2024-09-07 04:36:55'),
(3, 'NKPO0709240002', '-', 'KEU02', '2024091725686154', '2024091725686154.png', '2024-09-07 05:15:54'),
(4, 'NKPO0709240001', '-', 'KEU02', '2024091725690525', '2024091725690525.png', '2024-09-07 06:28:45'),
(5, 'NKPO1209240001', '-', 'KEU02', '2024091726121625', '2024091726121625.png', '2024-09-12 06:13:45');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_generateqrcode`
--

CREATE TABLE `tb_generateqrcode` (
  `id_gqrcode` int(11) NOT NULL,
  `kd_qrcode` varchar(25) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_generate_kd`
--

CREATE TABLE `tb_generate_kd` (
  `id` int(11) NOT NULL,
  `kd_barang` varchar(25) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_generate_kd`
--

INSERT INTO `tb_generate_kd` (`id`, `kd_barang`, `create_at`) VALUES
(1, 'PONK0709240001', '2024-09-07 06:26:40'),
(2, 'ADJQTY1209240001', '2024-09-12 02:23:18'),
(3, 'ADJQTY1209240002', '2024-09-12 03:22:29'),
(4, 'PONK1209240003', '2024-09-12 04:34:44'),
(5, 'ADJQTY1209240004', '2024-09-12 06:31:18'),
(6, 'ADJQTY1209240005', '2024-09-12 06:31:26'),
(7, 'ADJQTY1209240006', '2024-09-12 06:56:49'),
(8, 'ADJQTY1209240007', '2024-09-12 07:14:17'),
(9, 'ADJQTY1209240008', '2024-09-12 07:34:13'),
(10, 'ADJQTY1209240009', '2024-09-12 07:34:18'),
(11, 'ADJQTY1209240010', '2024-09-12 07:51:24'),
(12, 'ADJQTY1209240011', '2024-09-12 08:08:36'),
(13, 'ADJQTY1209240012', '2024-09-12 08:15:43'),
(14, 'ADJQTY1209240013', '2024-09-12 08:18:53'),
(15, 'ADJQTY1209240014', '2024-09-12 08:20:13'),
(16, 'ADJQTY1209240015', '2024-09-12 08:21:12'),
(17, 'ADJQTY1209240016', '2024-09-12 08:27:24');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kat_br`
--

CREATE TABLE `tb_kat_br` (
  `id_kat_br` int(11) NOT NULL,
  `kd_kat` varchar(25) NOT NULL,
  `nama_kategori` text NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `create_at` text NOT NULL,
  `log_create` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_note_direktur`
--

INSERT INTO `tb_note_direktur` (`id_note`, `kd_po`, `isi_note`, `kd_user`, `nama_user`, `note_for`, `update_status`, `create_at`, `log_create`) VALUES
(1, 'PONK0709240001', 'REQUEST BARU', 'KARYAWAN2', 'Bram', 2, 2, '', '2024-09-07 06:26:40'),
(2, 'PONK0709240001', 'PENGAJUAN DITERIMA', 'KEU02', 'Arini', 2, 2, '', '2024-09-07 06:27:12'),
(3, 'NKPO0709240001', 'PO Re-Stock Barang Kebutuhan', 'KEU02', 'Arini', 2, 2, '', '2024-09-07 06:27:12'),
(4, 'NKPO0709240001', 'PO ACCEPT KADEP', 'KADEP01', 'Diana Wulandari', 1, 1, '', '2024-09-07 06:27:54'),
(5, 'NKPO0709240001', 'SEDANG DIAJUKAN', 'KEU02', 'Arini', 1, 1, '', '2024-09-07 06:28:12'),
(6, 'NKPO0709240001', 'PO ACCEPT DIREKTUR', 'KIUDIREKTUR05', 'Annelia Kartika', 1, 1, '', '2024-09-07 06:28:19'),
(7, 'NKPO0709240001', 'PROSES PEMBELIAN', 'KEU02', 'Arini', 1, 1, '', '2024-09-07 06:28:45'),
(8, 'NKPO0709240001', 'BARANG DI TERIMA - ADMIN', 'KEU02', 'Arini', 1, 1, '', '2024-09-07 06:29:35'),
(9, 'PONK0709240001', 'BARANG DI TERIMA - ADMIN', 'KEU02', 'Arini', 2, 2, '', '2024-09-07 06:29:35'),
(10, 'PONK0709240001', 'ON HAND - Bram', 'KEU02', 'Arini', 2, 2, '', '2024-09-07 06:31:08'),
(11, 'PONK1209240003', 'REQUEST BARU', 'KARYAWAN2', 'Bram', 2, 2, '', '2024-09-12 04:34:44'),
(12, 'PONK1209240003', 'PENGAJUAN DITERIMA', 'KEU02', 'Arini', 2, 2, '', '2024-09-12 04:54:04'),
(13, 'NKPO1209240001', 'PO Re-Stock Barang Kebutuhan', 'KEU02', 'Arini', 2, 2, '', '2024-09-12 04:54:04'),
(14, 'NKPO1209240001', 'PO ACCEPT KADEP', 'KADEP01', 'Diana Wulandari', 1, 1, '', '2024-09-12 04:54:43'),
(15, 'NKPO1209240001', 'SEDANG DIAJUKAN', 'KEU02', 'Arini', 1, 1, '', '2024-09-12 04:57:11'),
(16, 'NKPO1209240001', 'PO ACCEPT DIREKTUR', 'KIUDIREKTUR05', 'Annelia Kartika', 1, 1, '', '2024-09-12 06:12:25'),
(17, 'NKPO1209240001', 'PROSES PEMBELIAN', 'KEU02', 'Arini', 1, 1, '', '2024-09-12 06:13:45'),
(18, 'NKPO1209240001', 'BARANG DI TERIMA - ADMIN', 'KEU02', 'Arini', 1, 1, '', '2024-09-12 06:17:30'),
(19, 'PONK1209240003', 'BARANG DI TERIMA - ADMIN', 'KEU02', 'Arini', 2, 2, '', '2024-09-12 06:17:30'),
(20, 'PONK1209240003', 'ON HAND - Bram', 'KEU02', 'Arini', 2, 2, '', '2024-09-12 06:19:23'),
(21, 'PONK0608240001', 'ADJUSTMENT PENGURANGAN QTY - SALAH HITUNG', 'KEU02', 'Arini', 3, 3, '2024-09-12 09:09:24', '2024-09-12 08:14:58'),
(22, 'PONK0608240001', 'ADJUSTMENT PENGURANGAN QTY - PENYESUAIAN BARANG\r\n', 'KEU01', 'Supriyanto', 3, 3, '2024-09-12 10:09:43', '2024-09-12 08:15:43'),
(24, 'PONK0608240001', 'ADJUSTMENT PENAMBAHAN QTY - KESALAHAN INPUT', 'KEU01', 'Supriyanto', 3, 3, '2024-09-12 10:09:13', '2024-09-12 08:20:13'),
(25, 'PONK0608240001', 'ADJUSTMENT PENAMBAHAN QTY - \r\nasd', 'KEU01', 'Supriyanto', 3, 3, '2024-09-12 03:09:12', '2024-09-12 08:21:12'),
(26, 'PONK0608240001', 'ADJUSTMENT PENAMBAHAN QTY - asddasd', 'KEU01', 'Supriyanto', 3, 3, '2024-09-12 15:27:24', '2024-09-12 08:27:24');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_nt_tmp_pembelian`
--

CREATE TABLE `tb_nt_tmp_pembelian` (
  `id_tmp_nt_pembelian` int(12) NOT NULL,
  `keterangan` text NOT NULL,
  `kd_user` varchar(25) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_po_nk`
--

CREATE TABLE `tb_po_nk` (
  `id_po_nk` int(12) NOT NULL,
  `jns_po` int(5) NOT NULL,
  `kd_po_nk` varchar(25) NOT NULL,
  `kd_po_req` varchar(25) NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_po_nk`
--

INSERT INTO `tb_po_nk` (`id_po_nk`, `jns_po`, `kd_po_nk`, `kd_po_req`, `nopo`, `kd_user`, `nm_user`, `tgl_transaksi`, `jml_item`, `total_harga`, `status`, `departemen`, `tj_pembelian`, `tax`, `hrg_pajak`, `hrg_nyata`, `status_hrg_nyata`, `acc_with`, `acc_with_kadep`, `create_at`) VALUES
(1, 2, 'NKPO0709240001', 'PONK0709240001', '-', 'KARYAWAN2', 'Bram', '2024-09-07', 2, 0, 'DONE', 'KEUANGAN', 'TESTINGPO001', 0, 0, 0, 0, 'KIUDIREKTUR05', 'KADEP01', '2024-09-07 06:29:35'),
(2, 2, 'NKPO1209240001', 'PONK1209240003', 'PO/0001/12/09/2024', 'KARYAWAN2', 'Bram', '2024-09-12', 2, 0, 'DONE', 'KEUANGAN', 'TESTPO120924', 0, 0, 0, 0, 'KIUDIREKTUR05', 'KADEP01', '2024-09-12 06:17:30');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_req_masterbarang`
--

CREATE TABLE `tb_req_masterbarang` (
  `id_reqmbarang` int(11) NOT NULL,
  `nama_barang` text NOT NULL,
  `deskripsi` text NOT NULL,
  `satuan` int(2) NOT NULL,
  `req_by` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_req_nk`
--

CREATE TABLE `tb_req_nk` (
  `id_po_nk` int(12) NOT NULL,
  `jns_po` int(5) NOT NULL,
  `kd_po_nk` varchar(25) NOT NULL,
  `kd_user` varchar(25) NOT NULL,
  `nm_user` text NOT NULL,
  `tgl_transaksi` text NOT NULL,
  `tgl_ambil` text NOT NULL,
  `jml_item` int(12) NOT NULL,
  `status` varchar(25) NOT NULL,
  `departemen` text NOT NULL,
  `tj_pembelian` text NOT NULL,
  `acc_with` varchar(25) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_req_nk`
--

INSERT INTO `tb_req_nk` (`id_po_nk`, `jns_po`, `kd_po_nk`, `kd_user`, `nm_user`, `tgl_transaksi`, `tgl_ambil`, `jml_item`, `status`, `departemen`, `tj_pembelian`, `acc_with`, `create_at`) VALUES
(1, 2, 'PONK0709240001', 'KARYAWAN2', 'Bram', '2024-09-07', '2024-09-07', 5, 'DONE', 'KEUANGAN', 'TESTINGPO001', 'KEU02', '2024-09-07 06:31:08'),
(2, 2, 'PONK1209240003', 'KARYAWAN2', 'Bram', '2024-09-12', '2024-09-12', 3, 'DONE', 'KEUANGAN', 'TESTPO120924', 'KEU02', '2024-09-12 06:19:23');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_satuan`
--

CREATE TABLE `tb_satuan` (
  `id_satuan` int(5) NOT NULL,
  `nm_satuan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `jnis_po` int(11) NOT NULL,
  `nama_barang` text NOT NULL,
  `deskripsi` text NOT NULL,
  `keterangan` text NOT NULL,
  `qty` int(12) NOT NULL,
  `satuan` int(2) NOT NULL,
  `hrg_satuan` int(25) NOT NULL,
  `total_harga` int(25) NOT NULL,
  `kd_bsys` varchar(25) NOT NULL,
  `kd_barang` varchar(25) NOT NULL,
  `kat_barang` varchar(25) NOT NULL,
  `kd_user` varchar(25) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_tmp_note_barang`
--

CREATE TABLE `tb_tmp_note_barang` (
  `id_nt_tmp_barang` int(11) NOT NULL,
  `kd_suplier` varchar(25) NOT NULL,
  `isi_note` text NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_tmp_tax`
--

CREATE TABLE `tb_tmp_tax` (
  `id_tmp_tax` int(11) NOT NULL,
  `kd_suplier` varchar(25) NOT NULL,
  `tax` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
  `keterangan` text NOT NULL,
  `kat_barang` varchar(25) NOT NULL,
  `tr_qty` double NOT NULL,
  `satuan` int(2) NOT NULL,
  `inputer` varchar(25) NOT NULL,
  `req_by` varchar(25) NOT NULL,
  `tgl_transaksi` text NOT NULL,
  `create_at` datetime NOT NULL,
  `last_updated_by` varchar(25) NOT NULL,
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_transaksi`
--

INSERT INTO `tb_transaksi` (`id_transnk`, `kd_akun`, `kd_po_nk`, `kd_barang`, `kd_barangsys`, `keterangan`, `kat_barang`, `tr_qty`, `satuan`, `inputer`, `req_by`, `tgl_transaksi`, `create_at`, `last_updated_by`, `update_at`) VALUES
(1, '11511', 'PONK3108240001', 'QKREBES1', 'PONK3007240001', '-', 'KATBR002', 20, 11, 'KEU02', '', '2024-08-31', '2024-08-31 00:00:00', 'KEU02', '2024-09-12 04:18:18'),
(2, '11511', 'PONK3108240001', 'QKREBES2', 'PONK3007240002', '-', 'KATBR002', 20, 11, 'KEU02', '', '2024-08-31', '2024-08-31 00:00:00', 'KEU02', '2024-09-12 04:18:18'),
(3, '11511', 'PONK3108240001', 'QKREBES3', 'PONK3007240003', '-', 'KATBR002', 20, 11, 'KEU02', '', '2024-08-31', '2024-08-31 00:00:00', 'KEU02', '2024-09-12 04:18:18'),
(4, '11511', 'PONK3108240001', 'QKREBES4', 'PONK3007240004', '-', 'KATBR002', 20, 11, 'KEU02', '', '2024-08-31', '2024-08-31 00:00:00', 'KEU02', '2024-09-12 04:18:18'),
(5, '11511', 'PONK3108240001', 'QTINMER1', 'PONK3007240005', '-', 'KATBR001', 20, 2, 'KEU02', '', '2024-08-31', '2024-08-31 00:00:00', 'KEU02', '2024-09-12 04:18:18'),
(6, '11511', 'PONK3108240001', 'QTINMER2', 'PONK3007240006', '-', 'KATBR001', 20, 2, 'KEU02', '', '2024-08-31', '2024-08-31 00:00:00', 'KEU02', '2024-09-12 04:18:18'),
(7, '11511', 'PONK3108240001', 'QTINMER3', 'PONK3007240007', '-', 'KATBR001', 20, 2, 'KEU02', '', '2024-08-31', '2024-08-31 00:00:00', 'KEU02', '2024-09-12 04:18:18'),
(8, '11511', 'PONK3108240001', 'QTINMER4', 'PONK3007240008', '-', 'KATBR001', 20, 2, 'KEU02', '', '2024-08-31', '2024-08-31 00:00:00', 'KEU02', '2024-09-12 04:18:18'),
(9, '11511', 'PONK3108240001', 'QAIRKEM1', 'PONK3007240009', '-', 'KATBR002', 20, 3, 'KEU02', '', '2024-08-31', '2024-08-31 00:00:00', 'KEU02', '2024-09-12 04:18:18'),
(10, '11511', 'PONK3108240001', 'QAIRGAL1', 'PONK3007240010', '-', 'KATBR002', 20, 2, 'KEU02', '', '2024-08-31', '2024-08-31 00:00:00', 'KEU02', '2024-09-12 04:18:18'),
(11, '11511', 'PONK3108240001', 'QCONTO', 'PONK0608240001', '-', 'KATBR001', 20, 10, 'KEU02', '', '2024-08-31', '2024-08-31 00:00:00', 'KEU02', '2024-09-12 04:18:18'),
(12, '11511', 'PONK3108240001', 'QHDM01', 'PONK1908240001', '-', 'KATBR001', 20, 2, 'KEU02', '', '2024-08-31', '2024-08-31 00:00:00', 'KEU02', '2024-09-12 04:18:18'),
(13, '11511', 'PONK3108240001', 'QSTAP01', 'PONK2008240002', '-', 'KATBR001', 20, 2, 'KEU02', '', '2024-08-31', '2024-08-31 00:00:00', 'KEU02', '2024-09-12 04:18:18'),
(14, '11511', 'PONK3108240001', 'QRCONTO1231111', 'PONK2708240003', '-', 'KATBR001', 20, 2, 'KEU02', '', '2024-08-31', '2024-08-31 00:00:00', 'KEU02', '2024-09-12 04:18:18'),
(61, '11512', 'PONK0709240001', 'QAIRGAL1', 'PONK3007240010', '-', 'KATBR002', 5, 2, 'KEU02', '', '2024-09-07', '2024-09-07 01:09:57', 'KEU02', '2024-09-07 06:26:57'),
(62, '11512', 'PONK0709240001', 'QAIRKEM1', 'PONK3007240009', '-', 'KATBR002', 15, 3, 'KEU02', '', '2024-09-07', '2024-09-07 01:09:59', 'KEU02', '2024-09-07 06:26:59'),
(63, '11512', 'PONK0709240001', 'QTINMER3', 'PONK3007240007', '-', 'KATBR001', 20, 2, 'KEU02', '', '2024-09-07', '2024-09-07 01:09:01', 'KEU02', '2024-09-07 06:27:01'),
(64, '11511', 'PONK0709240001', 'QHDM01', 'PONK1908240001', '-', 'KATBR001', 50, 2, 'KEU02', '', '2024-09-07', '2024-09-07 08:09:35', 'KEU02', '2024-09-07 06:29:35'),
(65, '11511', 'PONK0709240001', 'QKREBES1', 'PONK3007240001', '-', 'KATBR002', 25, 11, 'KEU02', '', '2024-09-07', '2024-09-07 08:09:35', 'KEU02', '2024-09-07 06:29:35'),
(66, '11512', 'PONK0709240001', 'QHDM01', 'PONK1908240001', '-', 'KATBR001', 50, 2, 'KEU02', '', '2024-09-07', '2024-09-07 00:00:00', 'KEU02', '2024-09-07 06:31:08'),
(67, '11512', 'PONK0709240001', 'QKREBES1', 'PONK3007240001', '-', 'KATBR002', 25, 11, 'KEU02', '', '2024-09-07', '2024-09-07 00:00:00', 'KEU02', '2024-09-07 06:31:08'),
(68, '11513', 'ADJQTY1209240001', 'QAIRKEM1', 'PONK3007240009', 'ADJUSTMENT QTY', 'KATBR002', 5, 3, 'KEU02', '', '2024-09-12', '2024-09-12 04:09:18', 'KEU02', '2024-09-12 02:43:36'),
(69, '11514', 'ADJQTY1209240002', 'QAIRKEM1', 'PONK3007240009', 'ADJUSTMENT QTY', 'KATBR002', 2, 3, 'KEU02', '', '2024-09-12', '2024-09-12 05:09:29', 'KEU02', '2024-09-11 22:09:29'),
(71, '11512', 'PONK1209240003', 'QHDM01', 'PONK1908240001', '-', 'KATBR001', 5, 2, 'KEU02', 'KARYAWAN2', '2024-09-12', '2024-09-12 11:09:16', 'KEU02', '2024-09-12 04:50:16'),
(72, '11511', 'PONK1209240003', 'QCONTO', 'PONK0608240001', '-', 'KATBR001', 30, 10, 'KEU02', 'KARYAWAN2', '2024-09-12', '2024-09-12 08:09:30', 'KEU02', '2024-09-12 06:17:30'),
(73, '11511', 'PONK1209240003', 'QTINMER3', 'PONK3007240007', '-', 'KATBR001', 50, 2, 'KEU02', 'KARYAWAN2', '2024-09-12', '2024-09-12 08:09:30', 'KEU02', '2024-09-12 06:17:30'),
(74, '11512', 'PONK1209240003', 'QCONTO', 'PONK0608240001', '-', 'KATBR001', 30, 10, 'KEU02', 'KARYAWAN2', '2024-09-12', '2024-09-12 00:00:00', 'KEU02', '2024-09-12 06:19:23'),
(75, '11512', 'PONK1209240003', 'QTINMER3', 'PONK3007240007', '-', 'KATBR001', 50, 2, 'KEU02', 'KARYAWAN2', '2024-09-12', '2024-09-12 00:00:00', 'KEU02', '2024-09-12 06:19:23'),
(79, '11513', 'ADJQTY1209240007', 'QCONTO', 'PONK0608240001', 'ADJUSTMENT QTY', 'KATBR001', 5, 10, 'KEU02', '-', '2024-09-12', '2024-09-12 09:09:17', 'KEU02', '2024-09-12 02:09:17'),
(80, '11514', 'ADJQTY1209240008', 'QCONTO', 'PONK0608240001', 'ADJUSTMENT QTY', 'KATBR001', 5, 10, 'KEU02', '-', '2024-09-12', '2024-09-12 09:09:13', 'KEU02', '2024-09-12 02:09:13'),
(81, '11513', 'ADJQTY1209240009', 'QCONTO', 'PONK0608240001', 'ADJUSTMENT QTY', 'KATBR001', 20, 10, 'KEU02', '-', '2024-09-12', '2024-09-12 09:09:18', 'KEU02', '2024-09-12 02:09:18'),
(82, '11513', 'ADJQTY1209240010', 'QCONTO', 'PONK0608240001', 'coba\r\n', 'KATBR001', 5, 10, 'KEU02', '-', '2024-09-12', '2024-09-12 09:09:24', 'KEU02', '2024-09-12 02:09:24'),
(83, '11514', 'ADJQTY1209240011', 'QCONTO', 'PONK0608240001', 'SALAH HITUNG', 'KATBR001', 20, 10, 'KEU02', '-', '2024-09-12', '2024-09-12 10:09:36', 'KEU02', '2024-09-12 03:09:36'),
(84, '11514', 'ADJQTY1209240012', 'QCONTO', 'PONK0608240001', 'PENYESUAIAN BARANG\r\n', 'KATBR001', 20, 10, 'KEU01', '-', '2024-09-12', '2024-09-12 10:09:43', 'KEU01', '2024-09-12 03:09:43'),
(85, '11513', 'ADJQTY1209240013', 'QCONTO', 'PONK0608240001', 'PERSEDIAN BARANG ', 'KATBR001', 50, 10, 'KEU01', '-', '2024-09-12', '2024-09-12 10:09:53', 'KEU01', '2024-09-12 03:09:53'),
(86, '11513', 'ADJQTY1209240014', 'QCONTO', 'PONK0608240001', 'KESALAHAN INPUT', 'KATBR001', 50, 10, 'KEU01', '-', '2024-09-12', '2024-09-12 10:09:13', 'KEU01', '2024-09-12 03:09:13'),
(87, '11513', 'ADJQTY1209240015', 'QCONTO', 'PONK0608240001', '\r\nasd', 'KATBR001', 5, 10, 'KEU01', '-', '2024-09-12', '2024-09-12 03:09:12', 'KEU01', '2024-09-11 20:09:12'),
(88, '11513', 'ADJQTY1209240016', 'QCONTO', 'PONK0608240001', 'asddasd', 'KATBR001', 5, 10, 'KEU01', '-', '2024-09-12', '2024-09-12 15:27:24', 'KEU01', '2024-09-12 08:27:24');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_transaksi_tmp`
--

CREATE TABLE `tb_transaksi_tmp` (
  `id_transnk` int(11) NOT NULL,
  `kd_akun` varchar(25) NOT NULL,
  `kd_po_nk` varchar(25) NOT NULL,
  `kd_barang` varchar(25) NOT NULL,
  `kd_barangsys` varchar(25) NOT NULL,
  `kat_barang` varchar(25) NOT NULL,
  `tr_qty` double NOT NULL,
  `satuan` int(2) NOT NULL,
  `status` varchar(255) NOT NULL,
  `keterangan` text NOT NULL,
  `inputer` varchar(25) NOT NULL,
  `create_at` datetime NOT NULL,
  `last_updated_by` varchar(25) NOT NULL,
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `v_stockbarangnk`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `v_stockbarangnk` (
`kode_barangs` varchar(25)
,`kode_barang` varchar(25)
,`nama_barang` text
,`deskripsi` text
,`gbr_barang` text
,`qty_in` double
,`qty_out` double
,`qty_ready` double
,`id_satuan` int(5)
,`satuan` text
,`id_brg_nk` int(11)
,`kat_barang` varchar(25)
);

-- --------------------------------------------------------

--
-- Struktur untuk view `v_stockbarangnk`
--
DROP TABLE IF EXISTS `v_stockbarangnk`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_stockbarangnk`  AS SELECT `x`.`kode_barangs` AS `kode_barangs`, `x`.`kode_barang` AS `kode_barang`, `x`.`nama_barang` AS `nama_barang`, `x`.`deskripsi` AS `deskripsi`, `x`.`gbr_barang` AS `gbr_barang`, coalesce(`x`.`qty_in`,0) + coalesce(`x`.`adjqty_in`,0) AS `qty_in`, coalesce(`x`.`qty_out`,0) + coalesce(`x`.`adjqty_out`,0) AS `qty_out`, coalesce(`x`.`qty_in`,0) + coalesce(`x`.`adjqty_in`,0) - (coalesce(`x`.`qty_out`,0) + coalesce(`x`.`adjqty_out`,0)) AS `qty_ready`, `x`.`id_s` AS `id_satuan`, `x`.`satuan` AS `satuan`, `x`.`id_brg_nk` AS `id_brg_nk`, `x`.`kat_barang` AS `kat_barang` FROM (select `a`.`kd_barang` AS `kode_barangs`,`a`.`kd_br_adm` AS `kode_barang`,`a`.`nama_barang` AS `nama_barang`,`a`.`descnk` AS `deskripsi`,`b`.`id_satuan` AS `id_s`,`b`.`nm_satuan` AS `satuan`,`a`.`gbr_barang` AS `gbr_barang`,`a`.`id_brg_nk` AS `id_brg_nk`,`a`.`kat_barang` AS `kat_barang`,(select sum(`d`.`tr_qty`) from `tb_transaksi` `d` where `d`.`kd_barang` = `a`.`kd_br_adm` and `d`.`kd_akun` = '11512' group by `d`.`kd_barang`) AS `qty_out`,(select sum(`d`.`tr_qty`) from `tb_transaksi` `d` where `d`.`kd_barang` = `a`.`kd_br_adm` and `d`.`kd_akun` = '11514' group by `d`.`kd_barang`) AS `adjqty_out`,(select sum(`e`.`tr_qty`) from `tb_transaksi` `e` where `e`.`kd_barang` = `a`.`kd_br_adm` and `e`.`kd_akun` = '11511' group by `e`.`kd_barang`) AS `qty_in`,(select sum(`e`.`tr_qty`) from `tb_transaksi` `e` where `e`.`kd_barang` = `a`.`kd_br_adm` and `e`.`kd_akun` = '11513' group by `e`.`kd_barang`) AS `adjqty_in` from ((`tb_barang_nk` `a` join `tb_satuan` `b` on(`b`.`id_satuan` = `a`.`satuan`)) join `tb_kat_br` `c` on(`c`.`kd_kat` = `a`.`kat_barang`)) group by `a`.`kd_br_adm`) AS `x` ;

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
-- Indeks untuk tabel `tb_detail_req`
--
ALTER TABLE `tb_detail_req`
  ADD PRIMARY KEY (`id_det_po_nk`);

--
-- Indeks untuk tabel `tb_diskon`
--
ALTER TABLE `tb_diskon`
  ADD PRIMARY KEY (`id_diskon`);

--
-- Indeks untuk tabel `tb_file_bukti_beli`
--
ALTER TABLE `tb_file_bukti_beli`
  ADD PRIMARY KEY (`id_fk_bukti`);

--
-- Indeks untuk tabel `tb_file_nk`
--
ALTER TABLE `tb_file_nk`
  ADD PRIMARY KEY (`id_file_nk`);

--
-- Indeks untuk tabel `tb_generateqrcode`
--
ALTER TABLE `tb_generateqrcode`
  ADD PRIMARY KEY (`id_gqrcode`);

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
-- Indeks untuk tabel `tb_req_masterbarang`
--
ALTER TABLE `tb_req_masterbarang`
  ADD PRIMARY KEY (`id_reqmbarang`);

--
-- Indeks untuk tabel `tb_req_nk`
--
ALTER TABLE `tb_req_nk`
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
-- Indeks untuk tabel `tb_transaksi_tmp`
--
ALTER TABLE `tb_transaksi_tmp`
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
  MODIFY `id_brg_nk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `tb_detail_po_nk`
--
ALTER TABLE `tb_detail_po_nk`
  MODIFY `id_det_po_nk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tb_detail_req`
--
ALTER TABLE `tb_detail_req`
  MODIFY `id_det_po_nk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tb_diskon`
--
ALTER TABLE `tb_diskon`
  MODIFY `id_diskon` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_file_bukti_beli`
--
ALTER TABLE `tb_file_bukti_beli`
  MODIFY `id_fk_bukti` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `tb_file_nk`
--
ALTER TABLE `tb_file_nk`
  MODIFY `id_file_nk` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_generateqrcode`
--
ALTER TABLE `tb_generateqrcode`
  MODIFY `id_gqrcode` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_generate_kd`
--
ALTER TABLE `tb_generate_kd`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

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
  MODIFY `id_note` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `tb_note_pembelian`
--
ALTER TABLE `tb_note_pembelian`
  MODIFY `id_nt_pembelian` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_nt_tmp_pembelian`
--
ALTER TABLE `tb_nt_tmp_pembelian`
  MODIFY `id_tmp_nt_pembelian` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tb_po_nk`
--
ALTER TABLE `tb_po_nk`
  MODIFY `id_po_nk` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tb_req_masterbarang`
--
ALTER TABLE `tb_req_masterbarang`
  MODIFY `id_reqmbarang` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_req_nk`
--
ALTER TABLE `tb_req_nk`
  MODIFY `id_po_nk` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `id_tmp_nk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT untuk tabel `tb_tmp_note_barang`
--
ALTER TABLE `tb_tmp_note_barang`
  MODIFY `id_nt_tmp_barang` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_tmp_tax`
--
ALTER TABLE `tb_tmp_tax`
  MODIFY `id_tmp_tax` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1073;

--
-- AUTO_INCREMENT untuk tabel `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  MODIFY `id_transnk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT untuk tabel `tb_transaksi_tmp`
--
ALTER TABLE `tb_transaksi_tmp`
  MODIFY `id_transnk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
