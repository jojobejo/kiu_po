-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 25 Sep 2024 pada 10.59
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
-- Struktur dari tabel `tbq_module`
--

CREATE TABLE `tbq_module` (
  `id_qmodule` int(11) NOT NULL,
  `kd_module` varchar(25) NOT NULL,
  `type_m` int(2) NOT NULL,
  `nm_module` text NOT NULL,
  `m_status` int(11) NOT NULL,
  `create_at` datetime NOT NULL,
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `lastupdated` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tbq_module`
--

INSERT INTO `tbq_module` (`id_qmodule`, `kd_module`, `type_m`, `nm_module`, `m_status`, `create_at`, `update_at`, `lastupdated`) VALUES
(1, 'QMODNK1709240001', 2, 'Purchase Order ', 2, '2024-09-17 15:50:09', '2024-09-25 03:14:35', 'KEU02'),
(2, 'QMODNK2309240001', 2, 'Request Barang', 1, '2024-09-23 08:58:18', '2024-09-23 01:58:41', 'KEU02'),
(3, 'QMODNK2309240002', 2, 'Stock Barang', 1, '2024-09-23 08:58:41', '2024-09-23 01:58:51', 'KEU02'),
(4, 'QMODNK2309240003', 2, 'Master Barang', 1, '2024-09-23 09:07:58', '2024-09-23 02:12:33', 'KEU02');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbq_review_pic`
--

CREATE TABLE `tbq_review_pic` (
  `id_review` int(11) NOT NULL,
  `kd_module` varchar(25) NOT NULL,
  `kd_reviewq` varchar(25) NOT NULL,
  `isi_review` text NOT NULL,
  `nilai` int(2) NOT NULL,
  `inputer` varchar(25) NOT NULL,
  `create_at` datetime NOT NULL,
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbq_review_q`
--

CREATE TABLE `tbq_review_q` (
  `id_reviewq` int(11) NOT NULL,
  `kd_reviewq` varchar(25) NOT NULL,
  `kd_module` varchar(25) NOT NULL,
  `question` text NOT NULL,
  `inputer` varchar(25) NOT NULL,
  `create_at` datetime NOT NULL,
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(23, 'PONK2708240003', 'QRCONTO1231111', 'KATBR001', 'cb1', 'cb2', 2, 'Karisma.png', 'cb1985.png', 'QRC2708240002', 'KARYAWAN2', '2024-08-27 10:50:58', 'KARYAWAN2', '2024-08-27 03:50:58'),
(24, 'PONK2309240003', 'QDOU01', 'KATBR001', 'double tape', 'besar', 4, 'Karisma.png', 'doubletape744.png', 'QRC2309240001', 'KARYAWAN2', '2024-09-23 10:05:08', 'KARYAWAN2', '2024-09-23 03:05:08');

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
(4, 'NKPO1209240001', 'PONK1209240003', 'KARYAWAN2', '2024-09-12', 'PONK0608240001', 'QCONTO', 'asdasdasd', 'asdasdasd', '-', 30, 10, 'KATBR001', 0, 0, 0, 0, 'Karisma.png', '2024-09-12 04:54:04'),
(5, 'NKPO2309240001', 'PONK2309240004', 'KARYAWAN2', '2024-09-23', 'PONK2309240003', 'QDOU01', 'double tape', 'besar', '-', 5, 4, 'KATBR001', 25000, 0, 125000, 0, 'Karisma.png', '2024-09-23 03:11:58'),
(6, 'NKPO2309240002', 'PONK2309240007', 'KARYAWAN2', '2024-09-23', 'PONK2309240003', 'QDOU01', 'double tape', 'besar', '-', 5, 4, 'KATBR001', 0, 0, 0, 0, 'Karisma.png', '2024-09-23 03:21:25'),
(8, 'NKPO2309240004', 'PONK2309240009', 'KARYAWAN2', '2024-09-23', 'PONK2309240003', 'QDOU01', 'double tape', 'besar', 'Kebutuhan Ruangan', 7, 4, 'KATBR001', 25000, 0, 175000, 0, 'Karisma.png', '2024-09-23 07:22:11'),
(9, 'NKPO2309240005', 'PONK2309240010', 'KARYAWAN2', '2024-09-23', 'PONK2309240003', 'QDOU01', 'double tape', 'besar', '-', 10, 4, 'KATBR001', 13500, 0, 135000, 0, 'Karisma.png', '2024-09-23 07:44:22'),
(10, 'NKPO2409240001', 'PONK2409240001', 'KARYAWAN2', '2024-09-24', 'PONK2309240003', 'QDOU01', 'double tape', 'besar', '-', 50, 4, 'KATBR001', 12500, 0, 625000, 0, 'Karisma.png', '2024-09-24 01:58:22'),
(11, 'NKPO2409240003', 'PONK2409240003', 'KARYAWAN2', '2024-09-24', 'PONK2309240003', 'QDOU01', 'double tape', 'besar', '-', 75, 4, 'KATBR001', 2500, 0, 187500, 0, 'Karisma.png', '2024-09-24 06:12:07'),
(12, 'NKPO2409240004', 'PONK2409240007', 'KARYAWAN2', '2024-09-24', 'PONK2309240003', 'QDOU01', 'double tape', 'besar', '0', 50, 4, 'KATBR001', 2500, 0, 125000, 0, 'Karisma.png', '2024-09-24 06:29:33'),
(13, 'NKPO2409240005', 'PONK2409240009', 'KARYAWAN2', '2024-09-24', 'PONK3007240003', 'QKREBES3', 'kresek plastik', 'Sedang Uk 30-35 Cm', '-', 50, 11, 'KATBR002', 2500, 0, 125000, 0, 'Karisma.png', '2024-09-24 08:13:14'),
(14, 'NKPO2409240005', 'PONK2409240009', 'KARYAWAN2', '2024-09-24', 'PONK2309240003', 'QDOU01', 'double tape', 'besar', 'Kebutuhan Ruangan', 20, 4, 'KATBR001', 2500, 0, 50000, 0, 'Karisma.png', '2024-09-24 08:13:14'),
(15, 'NKPO2409240006', 'PONK2409240010', 'KARYAWAN2', '2024-09-24', 'PONK3007240003', 'QKREBES3', 'kresek plastik', 'Sedang Uk 30-35 Cm', '-', 75, 11, 'KATBR002', 2500, 0, 187500, 0, 'Karisma.png', '2024-09-24 08:43:44'),
(16, 'NKPO2509240001', 'PONK2509240001', 'KARYAWAN2', '2024-09-25', 'PONK0608240001', 'QCONTO', 'asdasdasd', 'asdasdasd', '-', 50, 10, 'KATBR001', 2500, 0, 125000, 0, 'Karisma.png', '2024-09-25 02:07:06'),
(17, 'NKPO2509240001', 'PONK2509240001', 'KARYAWAN2', '2024-09-25', 'PONK2708240003', 'QRCONTO1231111', 'cb1', 'cb2', '-', 25, 2, 'KATBR001', 5000, 0, 125000, 0, 'Karisma.png', '2024-09-25 02:07:06');

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
(8, 'PONK1209240003', 'KARYAWAN2', '2024-09-12', 'PONK1908240001', 'QHDM01', 'Kabel HDMI', 'HDMI Ugreen 2.1 - 3 Meter', '-', 5, 2, 'KATBR001', 1, 0, '2024-09-12 04:50:16'),
(9, 'PONK2309240004', 'KARYAWAN2', '2024-09-23', 'PONK3007240001', 'QKREBES1', 'kresek plastik', 'Besar Uk 40-50 Cm Merah', '-', 5, 11, 'KATBR002', 1, 0, '2024-09-23 03:07:21'),
(10, 'PONK2309240004', 'KARYAWAN2', '2024-09-23', 'PONK3007240006', 'QTINMER2', 'Tinta Epson 664', 'Warna Kuning', '-', 10, 2, 'KATBR001', 1, 0, '2024-09-23 03:07:29'),
(19, 'PONK2409240009', 'KARYAWAN2', '2024-09-24', 'PONK2309240003', 'QDOU01', 'double tape', 'besar', 'Kebutuhan Ruangan', 10, 4, 'KATBR001', 4, 0, '2024-09-24 08:13:14'),
(20, 'PONK2409240009', 'KARYAWAN2', '2024-09-24', 'PONK2708240003', 'QRCONTO1231111', 'cb1', 'cb2', '-', 10, 2, 'KATBR001', 1, 0, '2024-09-24 08:02:29'),
(21, 'PONK2409240009', 'KARYAWAN2', '2024-09-24', 'PONK0608240001', 'QCONTO', 'asdasdasd', 'asdasdasd', '-', 20, 10, 'KATBR001', 1, 0, '2024-09-24 08:02:31'),
(22, 'PONK2409240009', 'KARYAWAN2', '2024-09-24', 'PONK3007240003', 'QKREBES3', 'kresek plastik', 'Sedang Uk 30-35 Cm', '-', 50, 11, 'KATBR002', 4, 0, '2024-09-24 08:13:14'),
(23, 'PONK2409240010', 'KARYAWAN2', '2024-09-24', 'PONK3007240003', 'QKREBES3', 'kresek plastik', 'Sedang Uk 30-35 Cm', '-', 50, 11, 'KATBR002', 4, 0, '2024-09-24 08:43:44'),
(24, 'PONK2509240001', 'KARYAWAN2', '2024-09-25', 'PONK0608240001', 'QCONTO', 'asdasdasd', 'asdasdasd', '-', 20, 10, 'KATBR001', 4, 0, '2024-09-25 02:07:06'),
(25, 'PONK2509240001', 'KARYAWAN2', '2024-09-25', 'PONK2708240003', 'QRCONTO1231111', 'cb1', 'cb2', '-', 15, 2, 'KATBR001', 4, 0, '2024-09-25 02:07:06'),
(26, 'PONK2509240001', 'KARYAWAN2', '2024-09-25', 'PONK3007240003', 'QKREBES3', 'kresek plastik', 'Sedang Uk 30-35 Cm', '-', 20, 11, 'KATBR002', 1, 0, '2024-09-25 02:07:04');

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
(5, 'NKPO1209240001', '-', 'KEU02', '2024091726121625', '2024091726121625.png', '2024-09-12 06:13:45'),
(6, 'NKPO2309240001', '-', 'KEU02', '2024091727061326', '2024091727061326.JPG', '2024-09-23 03:15:26'),
(7, 'NKPO2309240004', '12123', 'KEU02', '2024091727077158', '2024091727077158.png', '2024-09-23 07:39:18'),
(8, 'NKPO2309240005', '123\r\n', 'KEU02', '2024091727080705', '2024091727080705.png', '2024-09-23 08:38:25'),
(9, 'NKPO2409240001', '12333213', 'KEU02', '2024091727143220', '2024091727143220.png', '2024-09-24 02:00:20'),
(10, 'NKPO2409240003', '-', 'KEU02', '2024091727158535', '2024091727158535.png', '2024-09-24 06:15:36'),
(11, 'NKPO2409240004', '1111', 'KEU02', '2024091727159475', '2024091727159475.png', '2024-09-24 06:31:15'),
(12, 'NKPO2409240005', '123', 'KEU02', '2024091727166270', '2024091727166270.png', '2024-09-24 08:24:30'),
(13, 'NKPO2409240006', '1233321', 'KEU02', '2024091727167478', '2024091727167478.png', '2024-09-24 08:44:38'),
(14, 'NKPO2509240001', '-', 'KEU02', '2024091727230222', '2024091727230222.png', '2024-09-25 02:10:22');

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

--
-- Dumping data untuk tabel `tb_generateqrcode`
--

INSERT INTO `tb_generateqrcode` (`id_gqrcode`, `kd_qrcode`, `create_at`) VALUES
(1, 'QRC2309240001', '2024-09-23 03:05:08');

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
(17, 'ADJQTY1209240016', '2024-09-12 08:27:24'),
(18, 'ADJQTY1209240017', '2024-09-12 08:32:01'),
(19, 'ADJQTY2309240001', '2024-09-23 01:57:53'),
(20, 'ADJQTY2309240002', '2024-09-23 03:00:29'),
(21, 'PONK2309240003', '2024-09-23 03:05:08'),
(22, 'PONK2309240004', '2024-09-23 03:06:18'),
(23, 'ADJQTY2309240005', '2024-09-23 03:19:05'),
(24, 'ADJQTY2309240006', '2024-09-23 03:19:15'),
(25, 'PONK2309240007', '2024-09-23 03:20:55'),
(26, 'PONK2309240008', '2024-09-23 03:23:03'),
(27, 'PONK2309240009', '2024-09-23 07:18:43'),
(28, 'PONK2309240010', '2024-09-23 07:43:59'),
(29, 'PONK2409240001', '2024-09-24 01:57:55'),
(30, 'ADJQTY2409240002', '2024-09-24 04:10:41'),
(31, 'PONK2409240003', '2024-09-24 04:11:00'),
(32, 'ADJQTY2409240004', '2024-09-24 05:54:12'),
(33, 'ADJQTY2409240005', '2024-09-24 05:54:31'),
(34, 'ADJQTY2409240006', '2024-09-24 06:28:29'),
(35, 'PONK2409240007', '2024-09-24 06:29:09'),
(36, 'ADJQTY2409240008', '2024-09-24 06:54:18'),
(37, 'PONK2409240009', '2024-09-24 06:58:29'),
(38, 'PONK2409240010', '2024-09-24 08:36:18'),
(39, 'PONK2509240001', '2024-09-25 02:06:28');

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
(26, 'PONK0608240001', 'ADJUSTMENT PENAMBAHAN QTY - asddasd', 'KEU01', 'Supriyanto', 3, 3, '2024-09-12 15:27:24', '2024-09-12 08:27:24'),
(27, 'PONK3007240009', 'ADJUSTMENT PENAMBAHAN QTY - coba2', 'KEU03', 'Nadia', 3, 3, '2024-09-12 15:32:01', '2024-09-12 08:32:01'),
(28, 'PONK3007240007', 'ADJUSTMENT PENAMBAHAN QTY - -\r\n', 'KEU02', 'Arini', 3, 3, '2024-09-23 08:57:53', '2024-09-23 01:57:53'),
(29, 'PONK3007240009', 'ADJUSTMENT PENAMBAHAN QTY - penambahan', 'KEU02', 'Arini', 3, 3, '2024-09-23 10:00:29', '2024-09-23 03:00:29'),
(30, 'PONK2309240004', 'REQUEST BARU', 'KARYAWAN2', 'Bram', 2, 2, '', '2024-09-23 03:06:18'),
(31, 'PONK2309240004', 'PENGAJUAN DITERIMA', 'KEU02', 'Arini', 2, 2, '', '2024-09-23 03:07:46'),
(32, 'NKPO2309240001', 'PO Re-Stock Barang Kebutuhan', 'KEU02', 'Arini', 2, 2, '', '2024-09-23 03:07:46'),
(33, 'NKPO2309240001', 'PO ACCEPT KADEP', 'KADEP01', 'Diana Wulandari', 1, 1, '', '2024-09-23 03:11:12'),
(34, 'NKPO2309240001', 'SEDANG DIAJUKAN', 'KEU02', 'Arini', 1, 1, '', '2024-09-23 03:14:21'),
(35, 'NKPO2309240001', 'PO ACCEPT DIREKTUR', 'KIUDIREKTUR05', 'Annelia Kartika', 1, 1, '', '2024-09-23 03:14:46'),
(36, 'NKPO2309240001', 'PROSES PEMBELIAN', 'KEU02', 'Arini', 1, 1, '', '2024-09-23 03:15:26'),
(37, 'NKPO2309240001', 'BARANG DI TERIMA - ADMIN', 'KEU02', 'Arini', 1, 1, '', '2024-09-23 03:15:58'),
(38, 'PONK2309240004', 'BARANG DI TERIMA - ADMIN', 'KEU02', 'Arini', 2, 2, '', '2024-09-23 03:15:58'),
(39, 'PONK2309240004', 'ON HAND - Bram', 'KEU02', 'Arini', 2, 2, '', '2024-09-23 03:16:53'),
(40, 'PONK2309240003', 'ADJUSTMENT PENAMBAHAN QTY - -', 'KEU02', 'Arini', 3, 3, '2024-09-23 10:19:05', '2024-09-23 03:19:05'),
(41, 'PONK2309240003', 'ADJUSTMENT PENGURANGAN QTY - -', 'KEU02', 'Arini', 3, 3, '2024-09-23 10:19:15', '2024-09-23 03:19:15'),
(42, 'PONK2309240007', 'REQUEST BARU', 'KARYAWAN2', 'Bram', 2, 2, '', '2024-09-23 03:20:55'),
(43, 'PONK2309240007', 'PENGAJUAN DITERIMA', 'KEU02', 'Arini', 2, 2, '', '2024-09-23 03:21:25'),
(44, 'NKPO2309240002', 'PO Re-Stock Barang Kebutuhan', 'KEU02', 'Arini', 2, 2, '', '2024-09-23 03:21:25'),
(45, 'PONK2309240008', 'REQUEST BARU', 'KARYAWAN2', 'Bram', 2, 2, '', '2024-09-23 03:23:03'),
(46, 'PONK2309240008', 'PENGAJUAN DITERIMA', 'KEU02', 'Arini', 2, 2, '', '2024-09-23 07:14:34'),
(47, 'NKPO2309240003', 'PO Re-Stock Barang Kebutuhan', 'KEU02', 'Arini', 2, 2, '', '2024-09-23 07:14:34'),
(48, 'PONK2309240009', 'REQUEST BARU', 'KARYAWAN2', 'Bram', 2, 2, '', '2024-09-23 07:18:43'),
(49, 'PONK2309240009', 'PENGAJUAN DITERIMA', 'KEU02', 'Arini', 2, 2, '', '2024-09-23 07:22:11'),
(50, 'NKPO2309240004', 'PO Re-Stock Barang Kebutuhan', 'KEU02', 'Arini', 2, 2, '', '2024-09-23 07:22:11'),
(51, 'NKPO2309240004', 'PO ACCEPT KADEP', 'KADEP01', 'Diana Wulandari', 1, 1, '', '2024-09-23 07:36:49'),
(52, 'NKPO2309240004', 'SEDANG DIAJUKAN', 'KEU02', 'Arini', 1, 1, '', '2024-09-23 07:37:32'),
(53, 'NKPO2309240004', 'PO ACCEPT DIREKTUR', 'KIUDIREKTUR05', 'Annelia Kartika', 1, 1, '', '2024-09-23 07:37:48'),
(54, 'NKPO2309240004', 'PROSES PEMBELIAN', 'KEU02', 'Arini', 1, 1, '', '2024-09-23 07:39:18'),
(55, 'NKPO2309240004', 'BARANG DI TERIMA - ADMIN', 'KEU02', 'Arini', 1, 1, '', '2024-09-23 07:42:12'),
(56, 'PONK2309240009', 'BARANG DI TERIMA - ADMIN', 'KEU02', 'Arini', 2, 2, '', '2024-09-23 07:42:12'),
(57, 'PONK2309240009', 'ON HAND - Bram', 'KEU02', 'Arini', 2, 2, '', '2024-09-23 07:42:26'),
(58, 'PONK2309240010', 'REQUEST BARU', 'KARYAWAN2', 'Bram', 2, 2, '', '2024-09-23 07:43:59'),
(59, 'PONK2309240010', 'PENGAJUAN DITERIMA', 'KEU02', 'Arini', 2, 2, '', '2024-09-23 07:44:22'),
(60, 'NKPO2309240005', 'PO Re-Stock Barang Kebutuhan', 'KEU02', 'Arini', 2, 2, '', '2024-09-23 07:44:22'),
(61, 'NKPO2309240005', 'PO ACCEPT KADEP', 'KADEP01', 'Diana Wulandari', 1, 1, '', '2024-09-23 08:37:31'),
(62, 'NKPO2309240005', 'SEDANG DIAJUKAN', 'KEU02', 'Arini', 1, 1, '', '2024-09-23 08:37:46'),
(63, 'NKPO2309240005', 'PO ACCEPT DIREKTUR', 'KIUDIREKTUR05', 'Annelia Kartika', 1, 1, '', '2024-09-23 08:38:01'),
(64, 'NKPO2309240005', 'PROSES PEMBELIAN', 'KEU02', 'Arini', 1, 1, '', '2024-09-23 08:38:25'),
(65, 'NKPO2309240005', 'BARANG DI TERIMA - ADMIN', 'KEU02', 'Arini', 1, 1, '', '2024-09-23 08:40:23'),
(66, 'PONK2309240010', 'BARANG DI TERIMA - ADMIN', 'KEU02', 'Arini', 2, 2, '', '2024-09-23 08:40:23'),
(67, 'PONK2309240010', 'ON HAND - Bram', 'KEU02', 'Arini', 2, 2, '', '2024-09-24 01:57:36'),
(68, 'PONK2409240001', 'REQUEST BARU', 'KARYAWAN2', 'Bram', 2, 2, '', '2024-09-24 01:57:55'),
(69, 'PONK2409240001', 'PENGAJUAN DITERIMA', 'KEU02', 'Arini', 2, 2, '', '2024-09-24 01:58:22'),
(70, 'NKPO2409240001', 'PO Re-Stock Barang Kebutuhan', 'KEU02', 'Arini', 2, 2, '', '2024-09-24 01:58:22'),
(71, 'NKPO2409240001', 'PO ACCEPT KADEP', 'KADEP01', 'Diana Wulandari', 1, 1, '', '2024-09-24 01:59:21'),
(72, 'NKPO2309240002', 'PO REJECT', 'KADEP01', 'Diana Wulandari', 1, 1, '', '2024-09-24 01:59:27'),
(73, 'NKPO2409240001', 'SEDANG DIAJUKAN', 'KEU02', 'Arini', 1, 1, '', '2024-09-24 02:00:00'),
(74, 'NKPO2409240001', 'PO ACCEPT DIREKTUR', 'KIUDIREKTUR05', 'Annelia Kartika', 1, 1, '', '2024-09-24 02:00:08'),
(75, 'NKPO2409240001', 'PROSES PEMBELIAN', 'KEU02', 'Arini', 1, 1, '', '2024-09-24 02:00:20'),
(76, 'NKPO2409240001', 'BARANG DI TERIMA - ADMIN', 'KEU02', 'Arini', 1, 1, '', '2024-09-24 04:05:04'),
(77, 'PONK2409240001', 'BARANG DI TERIMA - ADMIN', 'KEU02', 'Arini', 2, 2, '', '2024-09-24 04:05:04'),
(78, 'PONK2409240001', 'ON HAND - Bram', 'KEU02', 'Arini', 2, 2, '', '2024-09-24 04:06:00'),
(79, 'PONK2309240003', 'ADJUSTMENT PENAMBAHAN QTY - 1', 'KEU02', 'Arini', 3, 3, '2024-09-24 11:10:41', '2024-09-24 04:10:41'),
(80, 'PONK2409240003', 'REQUEST BARU', 'KARYAWAN2', 'Bram', 2, 2, '', '2024-09-24 04:11:00'),
(81, 'PONK2309240003', 'ADJUSTMENT PENAMBAHAN QTY - 2\r\n', 'KEU02', 'Arini', 3, 3, '2024-09-24 12:54:12', '2024-09-24 05:54:12'),
(82, 'PONK2309240003', 'ADJUSTMENT PENGURANGAN QTY - 23', 'KEU02', 'Arini', 3, 3, '2024-09-24 12:54:31', '2024-09-24 05:54:31'),
(83, 'PONK2409240003', 'PENGAJUAN DITERIMA', 'KEU02', 'Arini', 2, 2, '', '2024-09-24 06:12:07'),
(84, 'NKPO2409240003', 'PO Re-Stock Barang Kebutuhan', 'KEU02', 'Arini', 2, 2, '', '2024-09-24 06:12:07'),
(85, 'NKPO2409240003', 'PO ACCEPT KADEP', 'KADEP01', 'Diana Wulandari', 1, 1, '', '2024-09-24 06:12:53'),
(86, 'NKPO2409240003', 'SEDANG DIAJUKAN', 'KEU02', 'Arini', 1, 1, '', '2024-09-24 06:14:20'),
(87, 'NKPO2409240003', 'PO ACCEPT DIREKTUR', 'KIUDIREKTUR05', 'Annelia Kartika', 1, 1, '', '2024-09-24 06:14:54'),
(88, 'NKPO2409240003', 'PROSES PEMBELIAN', 'KEU02', 'Arini', 1, 1, '', '2024-09-24 06:15:35'),
(89, 'NKPO2409240003', 'BARANG DI TERIMA - ADMIN', 'KEU02', 'Arini', 1, 1, '', '2024-09-24 06:19:13'),
(90, 'PONK2409240003', 'BARANG DI TERIMA - ADMIN', 'KEU02', 'Arini', 2, 2, '', '2024-09-24 06:19:13'),
(91, 'NKPO2409240003', 'BARANG DI TERIMA - ADMIN', 'KEU02', 'Arini', 1, 1, '', '2024-09-24 06:24:55'),
(92, 'PONK2409240003', 'BARANG DI TERIMA - ADMIN', 'KEU02', 'Arini', 2, 2, '', '2024-09-24 06:24:55'),
(93, 'PONK2409240003', 'ON HAND - Bram', 'KEU02', 'Arini', 2, 2, '', '2024-09-24 06:25:09'),
(94, 'PONK2309240003', 'ADJUSTMENT PENAMBAHAN QTY - ', 'KEU02', 'Arini', 3, 3, '2024-09-24 13:28:29', '2024-09-24 06:28:29'),
(95, 'PONK2409240007', 'REQUEST BARU', 'KARYAWAN2', 'Bram', 2, 2, '', '2024-09-24 06:29:09'),
(96, 'PONK2409240007', 'PENGAJUAN DITERIMA', 'KEU02', 'Arini', 2, 2, '', '2024-09-24 06:29:33'),
(97, 'NKPO2409240004', 'PO Re-Stock Barang Kebutuhan', 'KEU02', 'Arini', 2, 2, '', '2024-09-24 06:29:33'),
(98, 'NKPO2409240004', 'PO ACCEPT KADEP', 'KADEP01', 'Diana Wulandari', 1, 1, '', '2024-09-24 06:29:51'),
(99, 'NKPO2409240004', 'SEDANG DIAJUKAN', 'KEU02', 'Arini', 1, 1, '', '2024-09-24 06:30:05'),
(100, 'NKPO2409240004', 'PO ACCEPT DIREKTUR', 'KIUDIREKTUR05', 'Annelia Kartika', 1, 1, '', '2024-09-24 06:30:10'),
(101, 'NKPO2409240004', 'PROSES PEMBELIAN', 'KEU02', 'Arini', 1, 1, '', '2024-09-24 06:31:15'),
(102, 'NKPO2409240004', 'BARANG DI TERIMA - ADMIN', 'KEU02', 'Arini', 1, 1, '', '2024-09-24 06:31:35'),
(103, 'PONK2409240007', 'BARANG DI TERIMA - ADMIN', 'KEU02', 'Arini', 2, 2, '', '2024-09-24 06:31:35'),
(104, 'PONK2409240007', 'ON HAND - Bram', 'KEU02', 'Arini', 2, 2, '', '2024-09-24 06:31:52'),
(105, 'PONK2409240007', 'ON HAND - Bram', 'KEU02', 'Arini', 2, 2, '', '2024-09-24 06:53:54'),
(106, 'PONK2309240003', 'ADJUSTMENT PENAMBAHAN QTY - ', 'KEU02', 'Arini', 3, 3, '2024-09-24 13:54:18', '2024-09-24 06:54:18'),
(107, 'PONK2409240009', 'REQUEST BARU', 'KARYAWAN2', 'Bram', 2, 2, '', '2024-09-24 06:58:29'),
(108, 'PONK2409240009', 'PENGAJUAN DITERIMA', 'KEU02', 'Arini', 2, 2, '', '2024-09-24 08:13:14'),
(109, 'NKPO2409240005', 'PO Re-Stock Barang Kebutuhan', 'KEU02', 'Arini', 2, 2, '', '2024-09-24 08:13:14'),
(110, 'NKPO2409240005', 'PO ACCEPT KADEP', 'KADEP01', 'Diana Wulandari', 1, 1, '', '2024-09-24 08:23:45'),
(111, 'NKPO2409240005', 'SEDANG DIAJUKAN', 'KEU02', 'Arini', 1, 1, '', '2024-09-24 08:24:13'),
(112, 'NKPO2409240005', 'PO ACCEPT DIREKTUR', 'KIUDIREKTUR05', 'Annelia Kartika', 1, 1, '', '2024-09-24 08:24:18'),
(113, 'NKPO2409240005', 'PROSES PEMBELIAN', 'KEU02', 'Arini', 1, 1, '', '2024-09-24 08:24:30'),
(114, 'NKPO2409240005', 'BARANG DI TERIMA - ADMIN', 'KEU02', 'Arini', 1, 1, '', '2024-09-24 08:26:39'),
(115, 'PONK2409240009', 'BARANG DI TERIMA - ADMIN', 'KEU02', 'Arini', 2, 2, '', '2024-09-24 08:26:39'),
(116, 'PONK2409240009', 'ON HAND - Bram', 'KEU02', 'Arini', 2, 2, '', '2024-09-24 08:28:31'),
(117, 'PONK2409240010', 'REQUEST BARU', 'KARYAWAN2', 'Bram', 2, 2, '', '2024-09-24 08:36:18'),
(118, 'PONK2409240010', 'PENGAJUAN DITERIMA', 'KEU02', 'Arini', 2, 2, '', '2024-09-24 08:43:44'),
(119, 'NKPO2409240006', 'PO Re-Stock Barang Kebutuhan', 'KEU02', 'Arini', 2, 2, '', '2024-09-24 08:43:44'),
(120, 'NKPO2409240006', 'PO ACCEPT KADEP', 'KADEP01', 'Diana Wulandari', 1, 1, '', '2024-09-24 08:44:10'),
(121, 'NKPO2409240006', 'SEDANG DIAJUKAN', 'KEU02', 'Arini', 1, 1, '', '2024-09-24 08:44:23'),
(122, 'NKPO2409240006', 'PO ACCEPT DIREKTUR', 'KIUDIREKTUR05', 'Annelia Kartika', 1, 1, '', '2024-09-24 08:44:28'),
(123, 'NKPO2409240006', 'PROSES PEMBELIAN', 'KEU02', 'Arini', 1, 1, '', '2024-09-24 08:44:38'),
(124, 'NKPO2409240006', 'BARANG DI TERIMA - ADMIN', 'KEU02', 'Arini', 1, 1, '', '2024-09-24 08:45:46'),
(125, 'PONK2409240010', 'BARANG DI TERIMA - ADMIN', 'KEU02', 'Arini', 2, 2, '', '2024-09-24 08:45:46'),
(126, 'PONK2409240010', 'ON HAND - Bram', 'KEU02', 'Arini', 2, 2, '', '2024-09-24 08:55:09'),
(127, 'PONK2509240001', 'REQUEST BARU', 'KARYAWAN2', 'Bram', 2, 2, '', '2024-09-25 02:06:28'),
(128, 'PONK2509240001', 'PENGAJUAN DITERIMA', 'KEU02', 'Arini', 2, 2, '', '2024-09-25 02:07:06'),
(129, 'NKPO2509240001', 'PO Re-Stock Barang Kebutuhan', 'KEU02', 'Arini', 2, 2, '', '2024-09-25 02:07:06'),
(130, 'NKPO2509240001', 'PO ACCEPT KADEP', 'KADEP01', 'Diana Wulandari', 1, 1, '', '2024-09-25 02:09:52'),
(131, 'NKPO2509240001', 'SEDANG DIAJUKAN', 'KEU02', 'Arini', 1, 1, '', '2024-09-25 02:10:08'),
(132, 'NKPO2509240001', 'PO ACCEPT DIREKTUR', 'KIUDIREKTUR05', 'Annelia Kartika', 1, 1, '', '2024-09-25 02:10:12'),
(133, 'NKPO2509240001', 'PROSES PEMBELIAN', 'KEU02', 'Arini', 1, 1, '', '2024-09-25 02:10:22'),
(134, 'NKPO2509240001', 'BARANG DI TERIMA - ADMIN', 'KEU02', 'Arini', 1, 1, '', '2024-09-25 02:12:22'),
(135, 'PONK2509240001', 'BARANG DI TERIMA - ADMIN', 'KEU02', 'Arini', 2, 2, '', '2024-09-25 02:12:22'),
(136, 'PONK2509240001', 'ON HAND - Bram', 'KEU02', 'Arini', 2, 2, '', '2024-09-25 02:12:28');

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
(2, 2, 'NKPO1209240001', 'PONK1209240003', 'PO/0001/12/09/2024', 'KARYAWAN2', 'Bram', '2024-09-12', 2, 0, 'DONE', 'KEUANGAN', 'TESTPO120924', 0, 0, 0, 0, 'KIUDIREKTUR05', 'KADEP01', '2024-09-12 06:17:30'),
(3, 2, 'NKPO2309240001', 'PONK2309240004', 'po/001/2024//09/23', 'KARYAWAN2', 'Bram', '2024-09-23', 1, 0, 'DONE', 'KEUANGAN', 'REQUEST BARU ', 0, 0, 0, 0, 'KIUDIREKTUR05', 'KADEP01', '2024-09-23 03:15:58'),
(4, 2, 'NKPO2309240002', 'PONK2309240007', '-', 'KARYAWAN2', 'Bram', '2024-09-23', 1, 0, 'REJECT', 'KEUANGAN', 'rebaru1', 0, 0, 0, 0, 'KEU02', '', '2024-09-24 01:59:27'),
(6, 2, 'NKPO2309240004', 'PONK2309240009', 'KPOK/23/09/2024', 'KEU02', 'Arini', '2024-09-23', 1, 175000, 'DONE', 'KEUANGAN', 'Request Baru', 0, 0, 0, 0, 'KIUDIREKTUR05', 'KADEP01', '2024-09-23 07:42:12'),
(7, 2, 'NKPO2309240005', 'PONK2309240010', '-', 'KEU02', 'Arini', '2024-09-23', 1, 135000, 'DONE', 'KEUANGAN', 'coba 123', 0, 0, 0, 0, 'KIUDIREKTUR05', 'KADEP01', '2024-09-23 08:40:23'),
(8, 2, 'NKPO2409240001', 'PONK2409240001', 'NKPO2024/005/09/2024', 'KEU02', 'Arini', '2024-09-24', 1, 625000, 'DONE', 'KEUANGAN', 'TESPO123890', 0, 0, 0, 0, 'KIUDIREKTUR05', 'KADEP01', '2024-09-24 04:05:04'),
(9, 2, 'NKPO2409240003', 'PONK2409240003', '-', 'KEU02', 'Arini', '2024-09-24', 1, 187500, 'DONE', 'KEUANGAN', '1', 0, 0, 0, 0, 'KIUDIREKTUR05', 'KADEP01', '2024-09-24 06:24:55'),
(10, 2, 'NKPO2409240004', 'PONK2409240007', '-', 'KEU02', 'Arini', '2024-09-24', 1, 125000, 'DONE', 'KEUANGAN', '0000', 0, 0, 0, 0, 'KIUDIREKTUR05', 'KADEP01', '2024-09-24 06:31:35'),
(11, 2, 'NKPO2409240005', 'PONK2409240009', '-', 'KEU02', 'Arini', '2024-09-24', 2, 175000, 'DONE', 'KEUANGAN', '123123123123', 0, 0, 0, 0, 'KIUDIREKTUR05', 'KADEP01', '2024-09-24 08:26:39'),
(12, 2, 'NKPO2409240006', 'PONK2409240010', '-', 'KEU02', 'Arini', '2024-09-24', 1, 187500, 'DONE', 'KEUANGAN', 'testing123123123123', 0, 0, 0, 0, 'KIUDIREKTUR05', 'KADEP01', '2024-09-24 08:45:46'),
(13, 2, 'NKPO2509240001', 'PONK2509240001', '-', 'KEU02', 'Arini', '2024-09-25', 2, 250000, 'DONE', 'KEUANGAN', '111111111', 0, 0, 0, 0, 'KIUDIREKTUR05', 'KADEP01', '2024-09-25 02:12:22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_ratings`
--

CREATE TABLE `tb_ratings` (
  `id_rating` int(11) NOT NULL,
  `kd_user` varchar(25) NOT NULL,
  `kdq_rate` varchar(25) NOT NULL,
  `u_rate` int(2) NOT NULL,
  `inpt_by` varchar(25) NOT NULL,
  `create_at` datetime NOT NULL,
  `update_by` varchar(25) NOT NULL,
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(2, 2, 'PONK1209240003', 'KARYAWAN2', 'Bram', '2024-09-12', '2024-09-12', 3, 'DONE', 'KEUANGAN', 'TESTPO120924', 'KEU02', '2024-09-12 06:19:23'),
(3, 2, 'PONK2309240004', 'KARYAWAN2', 'Bram', '2024-09-23', '2024-09-23', 3, 'DONE', 'KEUANGAN', 'REQUEST BARU ', 'KEU02', '2024-09-23 03:16:53'),
(6, 2, 'PONK2309240009', 'KARYAWAN2', 'Bram', '2024-09-23', '2024-09-23', 1, 'DONE', 'KEUANGAN', 'Request Baru', 'KEU02', '2024-09-23 07:42:26'),
(7, 2, 'PONK2309240010', 'KARYAWAN2', 'Bram', '2024-09-23', '2024-09-24', 1, 'DONE', 'KEUANGAN', 'coba 123', 'KEU02', '2024-09-24 01:57:36'),
(8, 2, 'PONK2409240001', 'KARYAWAN2', 'Bram', '2024-09-24', '2024-09-24', 1, 'DONE', 'KEUANGAN', 'TESPO123890', 'KEU02', '2024-09-24 04:06:00'),
(9, 2, 'PONK2409240003', 'KARYAWAN2', 'Bram', '2024-09-24', '2024-09-24', 1, 'DONE', 'KEUANGAN', '1', 'KEU02', '2024-09-24 06:35:15'),
(10, 2, 'PONK2409240007', 'KARYAWAN2', 'Bram', '2024-09-24', '2024-09-24', 1, 'DONE', 'KEUANGAN', '0000', 'KEU02', '2024-09-24 06:53:54'),
(11, 2, 'PONK2409240009', 'KARYAWAN2', 'Bram', '2024-09-24', '2024-09-24', 4, 'DONE', 'KEUANGAN', '123123123123', 'KEU02', '2024-09-24 08:28:31'),
(12, 2, 'PONK2409240010', 'KARYAWAN2', 'Bram', '2024-09-24', '2024-09-24', 1, 'DONE', 'KEUANGAN', 'testing123123123123', 'KEU02', '2024-09-24 08:55:09'),
(13, 2, 'PONK2509240001', 'KARYAWAN2', 'Bram', '2024-09-25', '2024-09-25', 3, 'DONE', 'KEUANGAN', '111111111', 'KEU02', '2024-09-25 02:12:28');

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
(73, '11511', 'PONK1209240003', 'QTINMER3', 'PONK3007240007', '-', 'KATBR001', 50, 2, 'KEU02', 'KARYAWAN2', '2024-09-12', '2024-09-12 08:09:30', 'KEU02', '2024-09-12 06:17:30'),
(75, '11512', 'PONK1209240003', 'QTINMER3', 'PONK3007240007', '-', 'KATBR001', 50, 2, 'KEU02', 'KARYAWAN2', '2024-09-12', '2024-09-12 00:00:00', 'KEU02', '2024-09-12 06:19:23'),
(89, '11513', 'ADJQTY1209240017', 'QAIRKEM1', 'PONK3007240009', 'coba2', 'KATBR002', 50, 3, 'KEU03', '-', '2024-09-12', '2024-09-12 15:32:01', 'KEU03', '2024-09-12 08:32:01'),
(90, '11513', 'ADJQTY2309240001', 'QTINMER3', 'PONK3007240007', '-\r\n', 'KATBR001', 14, 2, 'KEU02', '-', '2024-09-23', '2024-09-23 08:57:53', 'KEU02', '2024-09-23 01:57:53'),
(91, '11513', 'ADJQTY2309240002', 'QAIRKEM1', 'PONK3007240009', 'penambahan', 'KATBR002', 5, 3, 'KEU02', '-', '2024-09-23', '2024-09-23 10:00:29', 'KEU02', '2024-09-23 03:00:29'),
(92, '11512', 'PONK2309240004', 'QKREBES1', 'PONK3007240001', '-', 'KATBR002', 5, 11, 'KEU02', 'KARYAWAN2', '2024-09-23', '2024-09-23 10:09:21', 'KEU02', '2024-09-23 03:07:21'),
(93, '11512', 'PONK2309240004', 'QTINMER2', 'PONK3007240006', '-', 'KATBR001', 10, 2, 'KEU02', 'KARYAWAN2', '2024-09-23', '2024-09-23 10:09:29', 'KEU02', '2024-09-23 03:07:29'),
(113, '11512', 'PONK2409240009', 'QRCONTO1231111', 'PONK2708240003', '-', 'KATBR001', 10, 2, 'KEU02', 'KARYAWAN2', '2024-09-24', '2024-09-24 03:09:29', 'KEU02', '2024-09-24 08:02:29'),
(114, '11512', 'PONK2409240009', 'QCONTO', 'PONK0608240001', '-', 'KATBR001', 20, 10, 'KEU02', 'KARYAWAN2', '2024-09-24', '2024-09-24 03:09:31', 'KEU02', '2024-09-24 08:02:31'),
(115, '11511', 'PONK2409240009', 'QDOU01', 'PONK2309240003', 'Kebutuhan Ruangan', 'KATBR001', 20, 4, 'KEU02', 'KARYAWAN2', '2024-09-24', '2024-09-24 10:09:39', 'KEU02', '2024-09-24 08:26:39'),
(116, '11511', 'PONK2409240009', 'QKREBES3', 'PONK3007240003', '-', 'KATBR002', 50, 11, 'KEU02', 'KARYAWAN2', '2024-09-24', '2024-09-24 10:09:39', 'KEU02', '2024-09-24 08:26:39'),
(117, '11512', 'PONK2409240009', 'QDOU01', 'PONK2309240003', 'Kebutuhan Ruangan', 'KATBR001', 10, 4, 'KEU02', 'KARYAWAN2', '2024-09-24', '2024-09-24 00:00:00', 'KEU02', '2024-09-24 08:28:31'),
(118, '11512', 'PONK2409240009', 'QKREBES3', 'PONK3007240003', '-', 'KATBR002', 50, 11, 'KEU02', 'KARYAWAN2', '2024-09-24', '2024-09-24 00:00:00', 'KEU02', '2024-09-24 08:28:31'),
(119, '11511', 'PONK2409240010', 'QKREBES3', 'PONK3007240003', '-', 'KATBR002', 75, 11, 'KEU02', 'KARYAWAN2', '2024-09-24', '2024-09-24 10:09:46', 'KEU02', '2024-09-24 08:45:46'),
(120, '11512', 'PONK2409240010', 'QKREBES3', 'PONK3007240003', '-', 'KATBR002', 50, 11, 'KEU02', 'KARYAWAN2', '2024-09-24', '2024-09-24 00:00:00', 'KEU02', '2024-09-24 08:55:09'),
(121, '11512', 'PONK2509240001', 'QKREBES3', 'PONK3007240003', '-', 'KATBR002', 20, 11, 'KEU02', 'KARYAWAN2', '2024-09-25', '2024-09-25 09:09:04', 'KEU02', '2024-09-25 02:07:04'),
(122, '11511', 'PONK2509240001', 'QCONTO', 'PONK0608240001', '-', 'KATBR001', 50, 10, 'KEU02', 'KARYAWAN2', '2024-09-25', '2024-09-25 04:09:22', 'KEU02', '2024-09-25 02:12:22'),
(123, '11511', 'PONK2509240001', 'QRCONTO1231111', 'PONK2708240003', '-', 'KATBR001', 25, 2, 'KEU02', 'KARYAWAN2', '2024-09-25', '2024-09-25 04:09:22', 'KEU02', '2024-09-25 02:12:22'),
(124, '11512', 'PONK2509240001', 'QCONTO', 'PONK0608240001', '-', 'KATBR001', 20, 10, 'KEU02', 'KARYAWAN2', '2024-09-25', '2024-09-25 00:00:00', 'KEU02', '2024-09-25 02:12:28'),
(125, '11512', 'PONK2509240001', 'QRCONTO1231111', 'PONK2708240003', '-', 'KATBR001', 15, 2, 'KEU02', 'KARYAWAN2', '2024-09-25', '2024-09-25 00:00:00', 'KEU02', '2024-09-25 02:12:28');

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
  `hrg_satuan` int(11) NOT NULL,
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
-- Indeks untuk tabel `tbq_module`
--
ALTER TABLE `tbq_module`
  ADD PRIMARY KEY (`id_qmodule`);

--
-- Indeks untuk tabel `tbq_review_pic`
--
ALTER TABLE `tbq_review_pic`
  ADD PRIMARY KEY (`id_review`);

--
-- Indeks untuk tabel `tbq_review_q`
--
ALTER TABLE `tbq_review_q`
  ADD PRIMARY KEY (`id_reviewq`);

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
-- Indeks untuk tabel `tb_ratings`
--
ALTER TABLE `tb_ratings`
  ADD PRIMARY KEY (`id_rating`);

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
-- AUTO_INCREMENT untuk tabel `tbq_module`
--
ALTER TABLE `tbq_module`
  MODIFY `id_qmodule` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tbq_review_pic`
--
ALTER TABLE `tbq_review_pic`
  MODIFY `id_review` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbq_review_q`
--
ALTER TABLE `tbq_review_q`
  MODIFY `id_reviewq` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_akun_tr`
--
ALTER TABLE `tb_akun_tr`
  MODIFY `id_akun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_barang_nk`
--
ALTER TABLE `tb_barang_nk`
  MODIFY `id_brg_nk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `tb_detail_po_nk`
--
ALTER TABLE `tb_detail_po_nk`
  MODIFY `id_det_po_nk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `tb_detail_req`
--
ALTER TABLE `tb_detail_req`
  MODIFY `id_det_po_nk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `tb_diskon`
--
ALTER TABLE `tb_diskon`
  MODIFY `id_diskon` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_file_bukti_beli`
--
ALTER TABLE `tb_file_bukti_beli`
  MODIFY `id_fk_bukti` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `tb_file_nk`
--
ALTER TABLE `tb_file_nk`
  MODIFY `id_file_nk` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_generateqrcode`
--
ALTER TABLE `tb_generateqrcode`
  MODIFY `id_gqrcode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_generate_kd`
--
ALTER TABLE `tb_generate_kd`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

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
  MODIFY `id_note` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=137;

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
  MODIFY `id_po_nk` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `tb_ratings`
--
ALTER TABLE `tb_ratings`
  MODIFY `id_rating` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_req_masterbarang`
--
ALTER TABLE `tb_req_masterbarang`
  MODIFY `id_reqmbarang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_req_nk`
--
ALTER TABLE `tb_req_nk`
  MODIFY `id_po_nk` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
  MODIFY `id_tmp_nk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

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
  MODIFY `id_transnk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- AUTO_INCREMENT untuk tabel `tb_transaksi_tmp`
--
ALTER TABLE `tb_transaksi_tmp`
  MODIFY `id_transnk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
