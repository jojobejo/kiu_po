-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 28 Agu 2024 pada 16.44
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
  `qrcode_path` text NOT NULL,
  `qrcode_data` varchar(50) NOT NULL,
  `inputer` varchar(25) NOT NULL,
  `create_at` datetime NOT NULL,
  `last_updated` varchar(25) NOT NULL,
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `kd_user` varchar(25) NOT NULL,
  `tgl_transaksi` text NOT NULL,
  `kd_bsys` varchar(25) NOT NULL,
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

--
-- Dumping data untuk tabel `tb_detail_po_nk`
--

INSERT INTO `tb_detail_po_nk` (`id_det_po_nk`, `kd_po_nk`, `kd_user`, `tgl_transaksi`, `kd_bsys`, `kd_barang`, `nama_barang`, `deskripsi`, `keterangan`, `qty`, `hrg_satuan`, `hrg_nyata`, `total_harga`, `total_nyata`, `gbr_produk`, `create_at`) VALUES
(1, ' NKPO2608240001', ' KARYAWAN2', ' 2024-08-26', ' PONK3007240003', ' QKREBES3', 'kresek plastik', 'Sedang Uk 30-35 Cm', '-', 15, 0, 0, 0, 0, '-', '2024-08-28 14:44:12'),
(2, ' NKPO2608240001', ' KARYAWAN2', ' 2024-08-26', ' PONK3007240005', ' QTINMER1', 'Tinta Epson 664', 'Warna Merah', '-', 10, 0, 0, 0, 0, '-', '2024-08-28 14:44:12'),
(3, ' NKPO2608240001', ' KARYAWAN2', ' 2024-08-26', ' PONK3007240009', ' QAIRKEM1', 'Air Mineral Cleo', 'Kemasan gelas 230 ml', '-', 10, 0, 0, 0, 0, '-', '2024-08-28 14:44:12'),
(4, ' NKPO2608240001', ' KARYAWAN2', ' 2024-08-26', ' PONK3007240010', ' QAIRGAL1', 'Air Galon Cleo', 'Galon Cleo 18 Liter', '-', 10, 0, 0, 0, 0, '-', '2024-08-28 14:44:12');

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
  `status` int(11) NOT NULL,
  `sts_done` int(2) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_detail_req`
--

INSERT INTO `tb_detail_req` (`id_det_po_nk`, `kd_po_nk`, `kd_user`, `tgl_transaksi`, `kd_bsys`, `kd_barang`, `nama_barang`, `deskripsi`, `keterangan`, `qty`, `status`, `sts_done`, `create_at`) VALUES
(1, 'PONK2708240008', 'KARYAWAN2', '2024-08-27', 'PONK3007240007', 'QTINMER3', 'Tinta Epson 664', 'Warna Hitam', '-', 5, 3, 0, '2024-08-28 05:37:12'),
(2, 'PONK2708240008', 'KARYAWAN2', '2024-08-27', 'PONK3007240010', 'QAIRGAL1', 'Air Galon Cleo', 'Galon Cleo 18 Liter', '-', 2, 1, 0, '2024-08-28 05:40:23'),
(3, 'PONK2708240008', 'KARYAWAN2', '2024-08-27', 'PONK3007240002', 'QKREBES2', 'kresek plastik', 'Sedang Uk 36-40 cm', '-', 3, 3, 0, '2024-08-28 05:40:21'),
(4, 'PONK2708240008', 'KARYAWAN2', '2024-08-27', 'PONK1908240001', 'QHDM01', 'Kabel HDMI', 'HDMI Ugreen 2.1 - 3 Meter', '-', 2, 3, 0, '2024-08-28 05:37:10');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_diskon`
--

INSERT INTO `tb_diskon` (`id_diskon`, `kd_po`, `kd_suplier`, `keterangan`, `nominal`) VALUES
(1, 'SKPO300823SYNGE010001', 'SYNGE01', 'Diskon Barang - Agrimec 18 EC 100 X 50 ml (5%)', 125000),
(2, 'SKPO300823SYNGE010001', 'SYNGE01', 'Agrimec 18 EC 100 X 50 ml - Diskon Per Botol', 35000),
(3, 'AKPO010923SYNGE010001', 'SYNGE01', 'Diskon Barang - Agrimec 18 EC 100 X 50 ml (10%)', 100000),
(4, 'AKPO010923SYNGE010001', 'SYNGE01', 'Agrimec 18 EC 100 X 50 ml - p', 500),
(5, 'AKPO010923SYNGE010001', 'SYNGE01', 'Diskon pelanggan', 50000),
(6, 'NKPO010923AGROG010002', 'AGROG01', 'Diskon Barang - Alfatox 50 EC 20 X 400 ml (AGM) (5%)', 5000),
(7, 'NKPO010923AGROG010002', 'AGROG01', 'Alfatox 50 EC 20 X 400 ml (AGM) - diskon per lt', 1000),
(8, 'NKPO010923AGROG010002', 'AGROG01', 'Alfatox 50 EC 20 X 400 ml (AGM) - diskon per lt', 200000),
(9, 'AKPO040923SAPRO030002', 'SAPRO03', 'Avidor 25 WP 4 X 25 X 100 gr - PO 4 ton diskon invoice 2.500/pack', 100000000),
(10, 'NKPO040923AGRIC020003', 'AGRIC02', 'Diskon Barang - Blast 200 SC 20 X 500 ml (2%)', 2496800),
(11, 'NKPO060923AGRIC020002', 'AGRIC02', 'Diskon Barang-Mospilan 30 EC 48 X 100 ml(2%)', 1066080),
(12, 'NKPO060923AGRIC020002', 'AGRIC02', 'Diskon Barang-Mospilan 30 EC 20 X 400 ml(2%)', 2864000),
(13, 'NKPO060923MITRA010007', 'MITRA01', 'Fenval Disc. 3%', 10492500),
(14, 'NKPO080923AGRIM010002', 'AGRIM01', 'Jagung Manis Panglima 40 X 1750 seed - SD 7%', 2520000),
(15, 'NKPO080923AGRIM010002', 'AGRIM01', 'Jagung Manis Panglima 40 X 1750 seed - CBD 3%', 1004400),
(17, 'NKPO110923AGRIM010002', 'AGRIM01', 'Jagung Manis Panglima 40 X 1750 seed - SD 7%', 6300000),
(18, 'NKPO110923AGRIM010002', 'AGRIM01', 'Jagung Manis Panglima 40 X 1750 seed - CBD 3%', 2511000),
(19, 'NKPO140923AGRIM010002', 'AGRIM01', 'Jagung Manis Panglima 40 X 1750 seed - SD 7%', 6300000),
(20, 'NKPO140923AGRIM010002', 'AGRIM01', 'Jagung Manis Panglima 40 X 1750 seed - CBD 3%', 2511000),
(21, 'NKPO140923AGRIC020004', 'AGRIC02', 'Diskon Barang - Ratgone 0.005 BB 10 X 1 kg (2%)', 728000),
(22, 'NKPO160923MITRA010005', 'MITRA01', 'Metindo SP Qty Disc. 2,5%', 14500000),
(23, 'NKPO160923MITRA010005', 'MITRA01', 'Metindo SP Reguler Disc. 1,5%', 8700000),
(24, 'NKPO160923MITRA010005', 'MITRA01', 'Metindo SP Special Disc. 2%', 11600000),
(25, 'NKPO160923MITRA010005', 'MITRA01', 'Unirex Disc. 2%', 1900000),
(26, 'NKPO190923AGRIM010001', 'AGRIM01', 'Jagung Manis Exsotic 40 X 250 gr - SD 5%', 20000000),
(27, 'NKPO190923AGRIM010001', 'AGRIM01', 'Jagung Manis Exsotic 40 X 250 gr - CBD 3%', 11400000),
(28, 'NKPO200923EXCEL010002', 'EXCEL01', 'Celquat Potongan PO 5 ton Rp. 4.000/L', 20000000),
(29, 'NKPO200923EXCEL010002', 'EXCEL01', 'Celquat Potongan Tambahan PO 5 ton Rp. 2.000/L', 10000000),
(30, 'NKPO200923EXCEL010002', 'EXCEL01', 'Celquat Potongan TOP 45 hari Rp. 1.000/L', 5000000),
(31, 'NKPO200923EXCEL010002', 'EXCEL01', 'Ketave Potongan TOP 45 hari Rp. 3.000/L', 1500000),
(32, 'NKPO200923CORTE010003', 'CORTE01', 'Acapela System 280 SC 50 X 100 ml - EPD 1.5%', 8533125),
(33, 'NKPO230923EXCEL010001', 'EXCEL01', 'Ketave Potongan TOP 45 hari Rp. 3.000/L', 1500000),
(34, 'NKPO230923EXCEL010002', 'EXCEL01', 'Celquat Potongan Rp. 9.000/L', 90000000),
(35, 'NKPO230923EXCEL010002', 'EXCEL01', 'Celquat Potongan TOP 45 hari Rp. 1.000/L', 10000000),
(36, 'AKPO260923BAYER010002', 'BAYER01', 'Disc. 3%', 110475000),
(37, 'NKPO270923MITRA010008', 'MITRA01', 'Qty Disc. 1%', 6167500),
(38, 'NKPO270923MITRA010008', 'MITRA01', 'TOP 60 hari Disc.1%', 6167500),
(39, 'NKPO290923AGRIC020004', 'AGRIC02', 'Diskon Barang - Mospilan 30 EC 20 X 400 ml (2%)', 2864000),
(40, 'NKPO290923AGRIC020005', 'AGRIC02', 'Diskon Barang - Mospilan 30 EC 20 X 400 ml (2%)', 1432000),
(41, 'AKPO290923PETRO010006', 'PETRO01', 'Applaud 10 WP 25 X 400 gr - Applaud Potong Invoice Rp 500/kg', 1500000),
(42, 'AKPO290923PETRO010006', 'PETRO01', 'Mipcinta 50 WP 20 X 5 X 100 gr - Mipcinta Potong Invoice Rp 1.000/kg', 3000000),
(43, 'AKPO290923PETRO010006', 'PETRO01', 'Mipcinta 50 WP 20 X 500 gr - Mipcinta Potong Invoice Rp 1.000/kg', 7000000),
(44, 'AKPO290923PETRO010006', 'PETRO01', 'Topsin 500 SC 20 X 200 ml - Topsin Potong Invoice Rp 2.000/L', 2000000),
(45, 'AKPO290923PETRO010006', 'PETRO01', 'Topsin 500 SC 20 X 500 ml - Topsin Potong Invoice Rp 2.000/L', 8000000),
(46, 'AKPO290923PETRO010006', 'PETRO01', 'Disc. 3% Cash', 63121125),
(47, 'NKPO290923MITRA010007', 'MITRA01', 'Qty Disc. 1%', 6167500),
(48, 'NKPO290923MITRA010007', 'MITRA01', 'TOP 60 hari Disc.1%', 6167500),
(49, 'NKPO290923AGRIC020009', 'AGRIC02', 'Diskon Barang - Sevin 85 SP 100 X 100 gr (2%)', 6438000),
(50, 'NKPO091023CORTE010004', 'CORTE01', 'EPD 1.5%', 8533125),
(51, 'NKPO091023AGRIC020005', 'AGRIC02', 'Diskon Barang - Ratgone 0.005 BB 10 X 1 kg (2%)', 728000),
(52, 'KPOREV0910230006', 'PETRO01', 'Applaud 10 WP 25 X 400 gr - Applaud Potong Invoice Rp 500/kg', 1500000),
(53, 'KPOREV0910230006', 'PETRO01', 'Mipcinta 50 WP 20 X 5 X 100 gr - Mipcinta Potong Invoice Rp 1.000/kg', 3000000),
(54, 'KPOREV0910230006', 'PETRO01', 'Mipcinta 50 WP 20 X 500 gr - Mipcinta Potong Invoice Rp 1.000/kg', 7000000),
(55, 'KPOREV0910230006', 'PETRO01', 'Topsin 500 SC 20 X 200 ml - Topsin Potong Invoice Rp 2.000/L', 2000000),
(56, 'KPOREV0910230006', 'PETRO01', 'Topsin 500 SC 20 X 500 ml - Topsin Potong Invoice Rp 2.000/L', 8000000),
(57, 'KPOREV0910230006', 'PETRO01', 'Disc. 3% Cash', 67131075),
(58, 'NKPO111023ADVAN020002', 'ADVAN02', 'Diskon Barang - Jagung ADV 132 20 X 1 kg (2%)', 6480000),
(59, 'KPOREV1110230003', 'ADVAN02', 'Diskon Barang - Jagung ADV 132 20 X 1 kg (2%)', 6480000),
(61, 'NKPO121023AGRIM010008', 'AGRIM01', 'SD 5%', 20000000),
(62, 'NKPO121023AGRIM010008', 'AGRIM01', 'CBD 3%', 11400000),
(63, 'NKPO121023CORTE010009', 'CORTE01', 'EPD 1.5%', 3960000),
(65, 'NKPO141023AGRIC020002', '', 'Spontan Dsic. 4,5%', 25758000),
(66, 'NKPO161023AGRIC020001', 'AGRIC02', 'Spontan Disc. 4,5%', 136731330),
(67, 'NKPO161023MITRA010002', 'MITRA01', 'Diskon Barang - Android 72 EC 20 X 400 ml (14%)', 23800000),
(68, 'NKPO161023MITRA010002', 'MITRA01', 'Diskon Barang - Fenval 200 EC 20 X 500 ml (3%)', 10725000),
(69, 'NKPO161023MITRA010002', 'MITRA01', 'Diskon Barang - Fenval 200 EC 15 X 1 ltr (3%)', 2295000),
(70, 'NKPO161023MITRA010002', 'MITRA01', 'Diskon Barang - Forsil 20 X 500 ml (5%)', 1530000),
(71, 'NKPO201023ADILM010005', 'ADILM01', 'Potongan Rp. 1.500/L', 7500000),
(72, 'NKPO211023MITRA010002', 'MITRA01', 'Neocron Disc. 8%', 448400000),
(73, 'NKPO211023MITRA010002', 'MITRA01', 'Neocron Disc. One Shoot R1 2%', 112100000),
(74, 'NKPO211023MITRA010002', 'MITRA01', 'Metsulindo Plus Qty Disc. 2%', 88800000),
(75, 'NKPO211023MITRA010002', 'MITRA01', 'Metsulindo Plus Special Disc. 1,5%', 66600000),
(78, 'NKPO251023EXCEL010001', 'EXCEL01', 'Abacel Pot. Rp. 10.000/L', 20000000),
(79, 'NKPO251023EXCEL010001', 'EXCEL01', 'Abacel Pot. TOP 45 hari Rp. 5.000/L', 10000000),
(80, 'NKPO251023EXCEL010001', 'EXCEL01', 'Emacel Pot. Rp. 10.000/L', 30000000),
(81, 'NKPO251023EXCEL010001', 'EXCEL01', 'Emacel Pot. TOP 45 hari Rp. 6.000/L', 18000000),
(82, 'KPOREV2510230002', 'EXCEL01', 'Abacel Pot. Rp. 10.000/L', 20000000),
(83, 'KPOREV2510230002', 'EXCEL01', 'Abacel Pot. TOP 45 hari Rp. 5.000/L', 10000000),
(84, 'KPOREV2510230002', 'EXCEL01', 'Emacel Pot. Rp. 10.000/L', 30000000),
(85, 'KPOREV2510230002', 'EXCEL01', 'Emacel Pot. TOP 45 hari Rp. 7.000/L', 21000000),
(86, 'NKPO251023EXCEL010003', 'EXCEL01', 'Lancer Gold Pot. TOP 45 hari Rp. 4.000/kg', 2000000),
(87, 'NKPO251023KALAT010004', 'KALAT01', 'Dekamon Disc. 3%', 11448000),
(88, 'AKPO261023BAYER010008', 'BAYER01', 'Disc. 3%', 88380000),
(89, 'NKPO271023CORTE010015', 'CORTE01', 'EPD 1.5%', 3960000),
(90, 'KPOREV2710230018', 'SUMBE01', 'Antracol 70 WP 12 X 1 kg - Potongan Selisih Harga Gold Star 50 dos ', 8000000),
(91, 'NKPO271023AGRIC020019', 'AGRIC02', 'Diskon Barang - Win 10 WP 25 X 20 X 10 gr (4%)', 1765000),
(93, 'KPOREV3010230001', 'AGRIC02', 'Diskon Barang-Win 10 WP 25 X 20 X 10 gr(2%)', 882500),
(94, 'KPOREV3110230003', 'PETRO01', 'Applaud 10 WP 25 X 400 gr - Applaud Potong Invoice Rp 500/kg', 1500000),
(95, 'KPOREV3110230003', 'PETRO01', 'Mipcinta 50 WP 20 X 5 X 100 gr - Mipcinta Potong Invoice Rp 1.000/kg', 3000000),
(96, 'KPOREV3110230003', 'PETRO01', 'Mipcinta 50 WP 20 X 500 gr - Mipcinta Potong Invoice Rp 1.000/kg', 7000000),
(97, 'KPOREV3110230003', 'PETRO01', 'Topsin 500 SC 20 X 200 ml - Topsin Potong Invoice Rp 2.000/L', 2000000),
(98, 'KPOREV3110230003', 'PETRO01', 'Topsin 500 SC 20 X 500 ml - Topsin Potong Invoice Rp 2.000/L', 8000000),
(99, 'KPOREV3110230003', 'PETRO01', 'Disc. 3% Cash', 68064825),
(100, 'NKPO021123DANKE010006', '', 'Cashback Rp.20.000/L', 23000000),
(101, 'NKPO031123MULTI040001', 'MULTI04', 'Potongan Rp.200/kg (angkutan)', 1000000),
(103, 'NKPO031123ADILM010006', 'ADILM01', 'Potongan Rp. 1.500/L', 1500000),
(104, 'KPOREV0311230007', 'ADILM01', 'Potongan Rp. 1.500/L', 1500000),
(105, 'NKPO041123AGRIM010003', 'AGRIM01', 'SD 5%', 3750000),
(106, 'NKPO041123AGRIM010003', 'AGRIM01', 'CBD 3%', 2137500),
(107, 'AKPO061123SAPRO030001', 'SAPRO03', 'Saprodap 16.20.0+125 @25 kg - Cash Disc. 2%', 3390000),
(108, 'NKPO061123CORTE010002', 'CORTE01', 'EPD 1.5%', 6336000),
(109, 'KPOREV0611230003', 'SAPRO03', 'Saprodap 16.20.0+125 @25 kg - Cash Disc. 2%', 5612500),
(111, 'KPOREV0611230005', '', 'Cashback Rp.10.000/L', 11500000),
(112, 'KPOREV0711230003', 'CORTE01', 'EPD 3%', 7920000),
(113, 'KPOREV0711230003', '', 'Pot. tambahan disc. 1.5 % PO 029 Inv.7710870769', 8533125),
(114, 'KPOREV0711230003', '', 'Pot. tambahan disc. 1.5 % PO 030 Inv.7710870784', 8533125),
(115, 'NKPO071123CORTE010004', 'CORTE01', 'EPD 3%', 21542400),
(116, 'NKPO071123CORTE010004', 'CORTE01', 'Pot. Tambahan disc. 1.5% PO 031', 3960000),
(117, 'NKPO081123CORTE010001', 'CORTE01', 'EPD 3%', 11377500),
(118, 'NKPO081123CORTE010001', 'CORTE01', 'Pot. Tambahan disc. 1.5% PO 029 Inv.7710870769', 8533125),
(119, 'NKPO081123CORTE010001', 'CORTE01', 'Pot. Tambahan disc. 1.5% PO 030 Inv.7710870784', 8533125),
(120, 'NKPO081123CORTE010002', 'CORTE01', 'EPD 3%', 20640000),
(121, 'NKPO081123CORTE010003', 'CORTE01', 'EPD 3%', 8256000),
(122, 'AKPO091123SAPRO030006', 'SAPRO03', 'Cash Disc. 2%', 33495000),
(123, 'NKPO091123ADILM010009', 'ADILM01', 'Pot. Program R1 Rp. 1.500/L', 5700000),
(124, 'NKPO091123AGRIC020010', 'AGRIC02', 'Diskon Barang - Blast 200 SC 20 X 500 ml (2%)', 624200),
(125, 'KPOREV1011230001', '', 'Disc. 35%', 13440000),
(126, 'NKPO101123AGRIC020003', 'AGRIC02', 'Diskon Barang - Ratgone 0.005 BB 10 X 1 kg (2%)', 728000),
(127, 'NKPO111123CORTE010001', 'CORTE01', 'EPD 3%', 8870400),
(128, 'NKPO141123MITRA010006', 'MITRA01', 'Metindo SP Qty Disc. 2,5%', 20422000),
(129, 'NKPO141123MITRA010006', 'MITRA01', 'Metindo SP Reguler Disc. 1,5%', 12253200),
(130, 'NKPO141123MITRA010006', 'MITRA01', 'Metindo SP Special Disc. 2%', 16337600),
(131, 'NKPO141123MITRA010006', 'MITRA01', 'Metindo WP Qty Disc. 2%', 13070000),
(132, 'NKPO141123MITRA010006', 'MITRA01', 'Metindo WP Reguler Disc. 2%', 13070000),
(133, 'NKPO141123MITRA010006', 'MITRA01', 'Metindo WP Special Disc. 2%', 13070000),
(134, 'NKPO151123AGRIC020001', 'AGRIC02', 'Diskon Barang - Sevin 85 SP 40 X 500 gr (2%)', 6056000),
(135, 'NKPO161123AGRIM010001', 'AGRIM01', 'SD 5%', 40000000),
(136, 'NKPO161123AGRIM010001', 'AGRIM01', 'CBD 3%', 22800000),
(137, 'NKPO161123KALAT010003', 'KALAT01', 'Osmocote Disc. 5%', 10110000),
(138, 'NKPO161123KALAT010003', 'KALAT01', 'Dektin disc. 5%', 8155000),
(139, 'NKPO171123ADVAN020001', 'ADVAN02', 'Disc. R1 5%', 4750000),
(141, 'NKPO171123ADVAN020001', '', 'Disc. CBD 5%', 4750000),
(142, 'KPOREV1711230004', '', 'Asuransi', -229595.55),
(143, 'KPOREV2711230002', 'CORTE01', 'EPD 3%', 20640000),
(144, 'KPOREV2711230003', 'CORTE01', 'EPD 3%', 8256000),
(145, 'NKPO291123CORTE010002', 'CORTE01', 'EPD 3%', 12672000),
(146, 'NKPO291123ADVAN020005', 'ADVAN02', 'Qty Disc. 2%', 25650000),
(147, 'NKPO301123AGRIC020002', 'AGRIC02', 'Diskon Barang - Blast 200 SC 20 X 500 ml (2%)', 4993600),
(148, 'NKPO051223KALAT010004', 'KALAT01', 'Gandasil Disc.6%', 400950000),
(149, 'AKPO061223SAPRO010003', 'SAPRO01', 'disc qty 3 ton 2.500/pack', 75000000),
(150, 'AKPO061223SAPRO010003', 'SAPRO01', 'disc tambahan 2.250/kg', 6750000),
(151, 'AKPO061223SAPRO030003', 'SAPRO03', 'disc qty 3 ton 2.500/pack', 75000000),
(152, 'AKPO061223SAPRO030003', 'SAPRO03', 'disc tambahan 2.250/kg', 6750000),
(153, 'AKPO071223ROYAL010003', 'ROYAL01', 'Agil Disc. 7%', 281586620),
(154, 'AKPO071223ROYAL010003', 'ROYAL01', 'Remazole Disc. 9%', 279395100),
(155, 'AKPO071223ROYAL010003', 'ROYAL01', 'EP', 91706654.46),
(156, 'AKPO071223PETRO010004', 'PETRO01', 'Mipcinta 50 WP 20 X 5 X 100 gr - Mipcinta Potong Invoice Rp 1.000/kg', 6000000),
(157, 'AKPO071223PETRO010004', 'PETRO01', 'Mipcinta 50 WP 20 X 500 gr - Mipcinta Potong Invoice Rp 1.000/kg', 4000000),
(158, 'AKPO071223PETRO010004', 'PETRO01', 'Disc. 3% Cash', 34366500),
(159, 'NKPO111223KALAT010007', 'KALAT01', 'Dekapirim Disc.5%', 5137500),
(160, 'NKPO121223CORTE010002', 'CORTE01', 'EPD 3%', 12672000),
(161, 'NKPO131223MITRA010003', 'MITRA01', 'Fenval Reguler Disc. 2%', 26000000),
(162, 'NKPO131223MITRA010003', 'MITRA01', 'Fenval Qty Disc. 1%', 13000000),
(163, 'NKPO131223MITRA010003', 'MITRA01', 'Folirfos Disc. 1%', 2100000),
(164, 'NKPO131223MITRA010003', 'MITRA01', 'Metindo WP Qty Disc. 2%', 12705000),
(165, 'NKPO131223MITRA010003', 'MITRA01', 'Metindo WP Reguler Disc. 2%', 12705000),
(166, 'NKPO131223MITRA010003', 'MITRA01', 'Metindo WP Special Disc. 2%', 12705000),
(167, 'NKPO131223MITRA010003', 'MITRA01', 'Metindo SP Qty Disc. 2,5%', 33430000),
(168, 'NKPO131223MITRA010003', 'MITRA01', 'Metindo SP Reguler Disc. 1,5%', 20058000),
(169, 'NKPO131223MITRA010003', 'MITRA01', 'Metindo WP Special Disc. 2%', 26744000),
(170, 'NKPO131223MITRA010003', 'MITRA01', 'Rotraz Disc. 2%', 10400000),
(171, 'NKPO131223MITRA010003', 'MITRA01', 'Android Disc. 14%', 12180000),
(172, 'NKPO131223MITRA010003', 'MITRA01', 'Forsil Disc. 5%', 1912500),
(173, 'NKPO131223MITRA010003', 'MITRA01', 'Unirex Disc. 2%', 6580000),
(174, 'NKPO131223GLOBA010005', 'GLOBA01', 'All Produk Disc. R1 8%', 135780000),
(178, 'NKPO131223GLOBA010005', '', 'Cymoxan Pot. Rp. 1000/pack', 6000000),
(181, 'NKPO131223GLOBA010005', '', 'Maestro Pot. Rp. 3.500/L', 9800000),
(183, 'NKPO131223GLOBA010005', '', 'Agrogib Pot. Rp. 2.000/pack', 77400000),
(184, 'MKPO141223GLOBA010002', 'GLOBA01', 'Disc. R1 8%', 135780000),
(185, 'MKPO141223GLOBA010002', 'GLOBA01', 'Cymoxan Pot. Rp.1000/Pack', 6000000),
(186, 'MKPO141223GLOBA010002', 'GLOBA01', 'Maestro Pot. 3.500/L', 9800000),
(187, 'MKPO141223GLOBA010002', 'GLOBA01', 'Agrogib Pot. Rp.2.000/btl', 77400000),
(188, 'KPOREV1412230002', 'GLOBA01', 'All Produk Disc. R1 10%', 169725000),
(189, 'KPOREV1412230002', '', 'Cymoxan Pot. Rp. 1000/pack', 6000000),
(190, 'KPOREV1412230002', '', 'Maestro Pot. Rp. 3.500/L', 9800000),
(191, 'KPOREV1412230002', '', 'Agrogib Pot. Rp. 2.000/pack', 77400000),
(192, 'KPOREV1912230006', 'ROYAL01', 'Agil Disc. 7%', 281586620),
(193, 'KPOREV1912230006', 'ROYAL01', 'Remazole Disc. 9%', 279395100),
(194, 'KPOREV1912230006', 'ROYAL01', 'EP', 93704257),
(195, 'NKPO201223MITRA010002', 'MITRA01', 'Qty Disc. 1%', 2055850),
(196, 'NKPO201223MITRA010002', 'MITRA01', 'TOP 60 hari Disc.1%', 2055850),
(197, 'AKPO201223BAYER010003', 'BAYER01', 'Discount 8%', 9018000),
(198, 'NKPO211223EXCEL010003', 'EXCEL01', 'Pot. Invoice Rp. 10.000/L', 120000000),
(199, 'NKPO211223EXCEL010003', 'EXCEL01', 'Pot. TOP 90 hari  Rp. 5.000/L', 60000000),
(200, 'KPOREV2712230006', 'ROYAL01', 'Agil Disc. 7%', 213945200),
(201, 'KPOREV2712230006', 'ROYAL01', 'Remazole Disc. 9%', 368473500),
(202, 'KPOREV2712230006', 'ROYAL01', 'EP', 93704257),
(203, 'KPOREV2812230009', 'ROYAL01', 'Agil Disc. 7%', 213945200),
(204, 'KPOREV2812230009', 'ROYAL01', 'Remazole Disc. 9%', 368509500),
(205, 'KPOREV2812230009', 'ROYAL01', 'EP', 93704257),
(206, 'NKPO020124SAPRO030007', 'SAPRO03', 'Cash Disc.2%', 23055000),
(207, 'KPOREV0301240001', 'SAPRO03', 'Cash Disc.2%', 28515000),
(208, 'KPOREV0301240002', 'SAPRO03', 'Cash Disc.2%', 28525920),
(209, 'MKPO090124BASFI010001', 'BASFI01', 'Disc. 2%', 13088040),
(210, 'NKPO090124GLOBA010004', 'GLOBA01', 'All Produk Disc. R1 8%', 27200000),
(211, 'NKPO090124GLOBA010004', 'GLOBA01', 'Maestro Pot. Rp.3.500/L', 7000000),
(212, 'NKPO100124CORTE010004', 'CORTE01', 'EPD 3%', 22755000),
(213, 'KPOREV1001240006', 'CORTE01', 'EPD 1.5 %', 11377500),
(214, 'MKPO110124AGRIC020003', 'AGRIC02', 'Diskon Barang - Ratgone 0.005 BB 10 X 1 kg (2%)', 728000),
(215, 'NKPO120124EXCEL010002', 'EXCEL01', 'Pot. Invoice Rp. 10.000/kg', 2500000),
(216, 'KPOREV1301240001', 'EXCEL01', 'Pot. Invoice Rp. 10.000/kg', 2500000),
(217, 'KPOREV1301240001', '', 'Pot. TOP 45 hari Rp. 5.000/kg', 1250000),
(218, 'NKPO130124MITRA010005', 'MITRA01', 'Topsindo Reguler Disc. 1%', 725000),
(219, 'NKPO130124MITRA010005', 'MITRA01', 'Topsindo Qty Disc. 2%', 1450000),
(220, 'MKPO150124AGRIM010001', 'AGRIM01', 'SD 5%', 20000000),
(221, 'MKPO150124AGRIM010001', 'AGRIM01', 'CBD 3%', 11400000),
(222, 'NKPO150124BASFI010006', 'BASFI01', 'Disc. 2%', 53506840),
(223, 'NKPO160124INTIE010001', 'INTIE01', 'Metindo WP Qty Disc. 2%', 11081400),
(224, 'NKPO160124INTIE010001', 'INTIE01', 'Metindo WP Reguler Disc. 2%', 11081400),
(225, 'NKPO160124INTIE010001', 'INTIE01', 'Metindo WP Special Disc. 2%', 11081400),
(226, 'NKPO160124INTIE010001', 'INTIE01', 'Metindo SP Qty Disc. 2,5%', 15520000),
(227, 'NKPO160124INTIE010001', 'INTIE01', 'Metindo Reguler Disc. 1,5%', 9312000),
(228, 'NKPO160124INTIE010001', 'INTIE01', 'Metindo SP Special Disc. 2%', 12416000),
(229, 'MKPO160124EXCEL010004', 'EXCEL01', 'Pot. Invoice Rp. 10.000/L', 50000000),
(230, 'MKPO160124EXCEL010004', 'EXCEL01', 'Pot. TOP 90 hari Rp. 5.000/L', 25000000),
(231, 'MKPO170124AGRIC020002', 'AGRIC02', 'Diskon Barang - Mospilan 30 EC 20 X 400 ml (2%)', 3723200),
(232, 'NKPO180124BASFI010008', 'BASFI01', 'Disc. 2%', 83284860),
(233, 'MKPO190124AGRIM010012', 'AGRIM01', 'Jagung Manis Panglima 40 X 1750 seed - SD 7%', 25200000),
(234, 'MKPO190124AGRIM010012', 'AGRIM01', 'Jagung Manis Panglima 40 X 1750 seed - CBD 3%', 10044000),
(235, 'MKPO240124ASIAN010001', 'ASIAN01', 'Disc. Megaxone 1000/L', 11000000),
(236, 'NKPO240124BASFI010003', 'BASFI01', 'Disc. 2%', 14986440),
(237, 'MKPO250124KALAT010001', 'KALAT01', 'Dekamon Disc. 3%', 8652000),
(238, 'KPOREV2501240004', 'KALAT01', 'Dekamon Disc. 3%', 8652000),
(239, 'MKPO250124AGRIC020008', 'AGRIC02', 'disc. Blast 200 SC 2%', 5833120),
(240, 'KPOREV2501240008', 'AGRIC02', 'Diskon Barang - Mospilan 30 EC 20 X 400 ml (2%)', 2864000),
(241, 'KPOREV2501240008', '', 'Diskon Barang - Blast 200 SC 20 X 500 ml (2%)', 2496800),
(242, 'KPOREV2501240010', 'BASFI01', 'Disc. 2%', 46640160),
(243, 'MKPO260124AGRIC020013', 'AGRIC02', 'Diskon Barang - Blast 200 SC 20 X 500 ml (2%)', 2646608),
(244, 'MKPO260124AGRIC020013', 'AGRIC02', 'Diskon Barang - Ratgone 0.005 BB 10 X 1 kg (2%)', 1456000),
(245, 'KPOREV2701240002', 'AGRIC02', 'Diskon Barang - Blast 200 SC 20 X 500 ml (2%)', 4993600),
(246, 'KPOREV2701240002', 'AGRIC02', 'Diskon Barang - Ratgone 0.005 BB 10 X 1 kg (2%)', 1456000),
(247, 'KPOREV2901240001', 'AGRIC02', 'Diskon Barang - Blast 200 SC 20 X 500 ml (2%)', 4993600),
(248, 'KPOREV2901240001', 'AGRIC02', 'Diskon Barang - Ratgone 0.005 BB 10 X 1 kg (2%)', 1456000),
(249, 'KPOREV2901240001', '', 'Diskon Barang-Mospilan 30 EC 48 X 100 ml(2%)', 2132160),
(250, 'KPOREV2901240001', '', 'Diskon Barang - Mospilan 30 EC 20 X 400 ml (2%)', 1432000),
(251, 'MKPO300124ADVAN010001', 'ADVAN01', 'Disc. Akalis Rp. 20.000/ltr incl PPN ', 10000000),
(252, 'MKPO300124ADVAN010002', 'ADVAN01', 'Disc. Akalis Rp. 20.000/ltr incl PPN', 10000000),
(253, 'MKPO310124AGRIC020004', 'AGRIC02', 'Spontan Disc. 6%', 57513600),
(254, 'MKPO310124EXCEL010006', 'EXCEL01', 'Pot. Invoice - Abacell 100 ml Rp. 10.000/L', 10000000),
(255, 'MKPO310124EXCEL010006', 'EXCEL01', 'Pot. TOP 90 hari - Abacell 100 ml Rp. 5.000/L', 5000000),
(256, 'MKPO310124EXCEL010006', 'EXCEL01', 'Qty Disc. - Abacell 100 ml Rp. 4.000/L', 4000000),
(257, 'MKPO310124EXCEL010006', 'EXCEL01', 'Additional Disc. - Abacell 100 ml Rp. 10.000/L', 10000000),
(258, 'MKPO310124EXCEL010006', 'EXCEL01', 'Point Sceme Disc. - Bluezeb 1 kg Rp. 4000/kg', 12000000),
(259, 'MKPO310124EXCEL010006', 'EXCEL01', 'Qty Disc. - Bluezeb 1 kg Rp. 10.000/kg', 30000000),
(260, 'MKPO310124AGRIC020007', 'AGRIC02', 'Spontan Disc. 6%', 58297200),
(261, 'MKPO310124AGRIC020008', 'AGRIC02', 'Spontan Disc. 6%', 58297200),
(262, 'MKPO010224AGRIC020011', 'AGRIC02', 'Diskon Barang - Sevin 85 SP 100 X 100 gr (2%)', 6438000),
(263, 'MKPO010224AGRIC020011', 'AGRIC02', 'Diskon ZOD - Sevin 85 SP 100 X 100 gr (2%)', 6438000),
(264, 'MKPO010224AGRIC020015', 'AGRIC02', 'Diskon Barang-Win 10 WP 25 X 20 X 10 gr(2%)', 1765000),
(265, 'MKPO010224AGRIC020015', 'AGRIC02', 'Diskon Barang - Blast 200 SC 48 X 100 ml (2%)', 419760),
(266, 'MKPO010224AGRIC020015', 'AGRIC02', 'Diskon Barang - Throne 250 EC 20 X 250 ml (2%)', 1028250),
(267, 'MKPO010224AGRIC020015', 'AGRIC02', 'Diskon Barang - Throne 250 EC 20 X 500 ml (2%)', 1164000),
(269, 'KPOREV0502240002', 'AGRIC02', 'Diskon ZOD - Sevin 85 SP 100 X 100 gr (2%)', 6438000),
(270, 'MKPO070224AGRIM010003', '', 'SD 5%', 20000000),
(271, 'MKPO070224AGRIM010003', '', 'CBD 3%', 11400000),
(272, 'NKPO120224BASFI010002', 'BASFI01', 'Disc. 2%', 61820000),
(274, 'NKPO130224SAPRO030003', 'SAPRO03', 'Cash Disc.2%', 14865000),
(275, 'MKPO150224EXCEL010003', 'EXCEL01', 'Pot. Invoice Rp. 10.000/kg', 5000000),
(276, 'MKPO150224EXCEL010003', 'EXCEL01', 'Pot. TOP 45 hari Rp. 5.000/kg', 2500000),
(277, 'NKPO150224SARAN040007', 'SARAN04', 'Disc. 25%', 812500),
(278, 'MKPO160224AGRIC020002', 'AGRIC02', 'Diskon Barang - Throne 250 EC 20 X 250 ml (2%)', 2056500),
(279, 'MKPO160224AGRIC020002', 'AGRIC02', 'Diskon Barang - Ratgone 0.005 BB 10 X 1 kg (2%)', 728000),
(280, 'MKPO160224AGRIC020002', 'AGRIC02', 'Diskon Barang - Mospilan 30 EC 20 X 400 ml (2%)', 1317440),
(281, 'MKPO160224KALAT010005', 'KALAT01', 'Gandasil Disc.6%', 47580000),
(282, 'MKPO160224EXCEL010008', 'EXCEL01', 'Pot. TOP 45 hari Rp. 2.000/kg', 1000000),
(283, 'AKPO190224SAPRO030001', 'SAPRO03', 'Saprodap 16.20.0+125 @25 kg - Cash Disc. 2%', 5012500),
(284, 'MKPO190224GLOBA010002', 'GLOBA01', 'All Produk Disc. R1 6%', 14400000),
(285, 'KPOREV2002240005', '', 'Qty Disc. Asia Top Rp. 750/L', 7500000),
(286, 'KPOREV2002240006', '', 'Qty Disc. Asia Top Rp. 750/L', 7500000),
(287, 'KPOREV2002240006', '', 'Disc. Spontas Rp. 2.500/L', 2500000),
(293, 'NKPO220224PETRO010003', '', 'Termiban Potong  Invoice Rp.1.500/ltr', 375000),
(295, 'NKPO220224PETRO010003', '', 'Mipcinta Potong Invoice Rp.1.000/kg', 15000000),
(296, 'NKPO220224PETRO010003', '', 'Applaud Potong Invoice Rp.500/kg', 1000000),
(297, 'NKPO220224PETRO010003', '', 'Cash Disc. 3%', 59101125),
(298, 'MKPO220224EXCEL010004', 'EXCEL01', 'Pot. Invoice Rp. 10.000/L', 50000000),
(299, 'MKPO220224EXCEL010004', 'EXCEL01', 'Pot. TOP 90 hari Rp. 5.000/L', 25000000),
(300, 'MKPO220224EXCEL010004', 'EXCEL01', 'Qty Disc. Rp. 4.000/L', 20000000),
(301, 'MKPO220224EXCEL010004', 'EXCEL01', 'Additional Disc. Rp. 10.000/L', 50000000),
(302, 'NKPO220224PETRO010007', 'PETRO01', 'Applaud Pot. Invoice Rp.500/kg', 1000000),
(303, 'NKPO220224PETRO010007', 'PETRO01', 'Mipcinta Potong Invoice Rp.1.500/kg', 15000000),
(304, 'NKPO220224PETRO010007', 'PETRO01', 'Termiban Pot. Invoice Rp.1.500/ltr', 375000),
(305, 'NKPO220224PETRO010007', 'PETRO01', 'Cash Disc.3%', 59101125),
(306, 'NKPO220224TANIA040008', '', 'Campaign Disc. Rp.1.157/ltr', 2314000),
(307, 'NKPO230224BASFI010002', 'BASFI01', 'Disc. 2%', 3920000),
(308, 'MKPO230224GLOBA010004', 'GLOBA01', 'All Produk Disc. R1 6%', 67500000),
(309, 'KPOREV2302240007', 'EXCEL01', 'Pot. Invoice Rp. 10.000/L', 50000000),
(310, 'KPOREV2302240007', 'EXCEL01', 'Pot. TOP 90 hari Rp. 5.000/L', 25000000),
(311, 'KPOREV2302240007', 'EXCEL01', 'Qty Disc. Rp. 4.000/L', 20000000),
(312, 'KPOREV2302240007', 'EXCEL01', 'Additional Disc. Rp. 10.000/L', 50000000),
(313, 'MKPO240224DANKE010002', 'DANKE01', 'Cashback Rp.10.000/L', 10000000),
(314, 'MKPO270224UPLIN010001', 'UPLIN01', 'Spesial discount Rp.30.000/ltr', 9000000),
(315, 'MKPO270224UPLIN010001', 'UPLIN01', 'SBU discount  Rp.11.000/ltr', 3300000),
(316, 'NKPO270224MITRA010005', 'MITRA01', 'Metsulindo Plus Qty Disc. 2%', 79564800),
(317, 'NKPO270224MITRA010005', 'MITRA01', 'Metsulindo Plus Special Disc. 3%', 119347200),
(318, 'NKPO270224MITRA010005', 'MITRA01', 'Pot. 1.5% Kompensasi dgn program 3.5%', 59673600),
(319, 'MKPO280224EXCEL010002', 'EXCEL01', 'Emacel Pot. Rp. 10.000/L', 30000000),
(320, 'MKPO280224EXCEL010002', 'EXCEL01', 'Emacel Pot. TOP 45 hari Rp. 7.000/L', 21000000),
(321, 'NKPO280224BASFI010003', 'BASFI01', 'Disc. 2%', 37092000),
(322, 'NKPO280224BASFI010004', 'BASFI01', 'Cash Disc.2%', 8622240),
(323, 'KPOREV2802240008', 'BASFI01', 'Disc. 2%', 53620688),
(324, 'MKPO280224AGRIM010011', 'AGRIM01', 'SD 5%', 20000000),
(325, 'MKPO280224AGRIM010011', 'AGRIM01', 'CBD 3%', 11400000),
(326, 'NKPO290224BASFI010012', 'BASFI01', 'Disc. 2%', 1196700),
(330, 'KPOREV2902240016', 'PETRO01', 'TOP 30 hari disc.2%', 15365750),
(331, 'KPOREV2902240018', 'BASFI01', 'Disc. 2%', 4786800),
(332, 'KPOREV2902240019', 'PETRO01', 'TOP 30 hari disc.2%', 20414000),
(333, 'MKPO010324KALAT010003', 'KALAT01', 'Gandasil Disc.6%', 100560000),
(334, 'KPOREV0203240001', 'PETRO01', 'TOP 30 hari disc.2%', 20414000),
(335, 'KPOREV0203240002', 'BASFI01', 'Disc. 2%', 99803088),
(336, 'KPOREV0203240005', 'PETRO01', 'TOP 30 hari disc.2%', 20414000),
(337, 'NKPO070324SAPRO030005', 'SAPRO03', 'Cash Disc.2%', 30775920),
(338, 'MKPO090324ASIAN010002', 'ASIAN01', 'Qty Disc. Asia Top Rp. 500/L', 5000000),
(339, 'NKPO120324PETRO010005', 'PETRO01', 'Mipcinta Potong Invoice Rp.1000/kg', 11000000),
(340, 'NKPO120324PETRO010005', 'PETRO01', 'Cash Disc. 3%', 31155000),
(341, 'KPOREV1203240006', 'PETRO01', 'Mipcinta Potong Invoice Rp.1000/kg', 11000000),
(342, 'KPOREV1203240006', 'PETRO01', 'Cash Disc. 2%', 20770000),
(343, 'KPOREV1203240007', 'PETRO01', 'Mipcinta Potong Invoice Rp.1000/kg', 11000000),
(344, 'KPOREV1203240007', 'PETRO01', 'TOP 30 hari Disc.2%', 20770000),
(345, 'MKPO130324CATUR010001', 'CATUR01', 'Special discount Manzate Rp.5.000/kg', 25000000),
(346, 'MKPO130324CATUR010001', 'CATUR01', 'SBU discount Manzate Rp.4.000/kg', 20000000),
(347, 'MKPO130324CATUR010001', 'CATUR01', 'Gold Scheme disc. Rp.250/kg', 1250000),
(348, 'MKPO130324CATUR010001', 'CATUR01', 'Special discount Manzate  500 gr Rp.4.000/kg', 4000000),
(349, 'MKPO130324CATUR010001', 'CATUR01', 'Special discount Manzate  1 kg Rp.2.500/kg', 10000000),
(350, 'MKPO130324KALAT010004', 'KALAT01', 'Dekapirim Disc.5%', 5137500),
(351, 'NKPO140324ROYAL010001', 'ROYAL01', 'Diskon Barang - Revus 250 SC 50 X 100 ml (3%)', 28014210),
(352, 'KPOREV1403240002', 'CATUR01', 'Special discount Manzate Rp.5.000/kg', 25000000),
(353, 'KPOREV1403240002', 'CATUR01', 'SBU discount Manzate Rp.4.000/kg', 20000000),
(355, 'KPOREV1403240002', 'CATUR01', 'Special discount Manzate  500 gr Rp.4.000/kg', 4000000),
(356, 'KPOREV1403240002', 'CATUR01', 'Special discount Manzate  1 kg Rp.2.500/kg', 10000000),
(367, 'KPOREV1403240002', '', 'Diskon R1 - Manzate Rp.3.500/kg', 17500000),
(368, 'NKPO150324STARM010002', 'STARM01', 'Diskon Barang - Kran Yoto 5L (10%)', 1500000),
(369, 'MKPO150324GLOBA010003', 'GLOBA01', 'Disc. R1 8%', 40800000),
(370, 'KPOREV1503240005', 'CATUR01', 'Special discount Manzate Rp.5.000/kg', 25000000),
(371, 'KPOREV1503240005', 'CATUR01', 'SBU discount Manzate Rp.4.000/kg', 20000000),
(372, 'KPOREV1503240005', 'CATUR01', 'Special discount Manzate  500 gr Rp.4.000/kg', 4000000),
(373, 'KPOREV1503240005', 'CATUR01', 'Special discount Manzate  1 kg Rp.2.500/kg', 10000000),
(374, 'KPOREV1503240005', '', 'Diskon R1 - Manzate Rp.3.500/kg', 17500000),
(376, 'KPOREV1503240009', 'ROYAL01', 'Diskon Barang-Revus 250 SC 50 X 100 ml(3%)', 12264000),
(377, 'MKPO160324AGRIC020008', 'AGRIC02', 'Diskon Barang-Win 10 WP 25 X 20 X 10 gr(2%)', 4412500),
(378, 'MKPO160324AGRIC020008', '', 'Diskon Barang - Blast 200 SC 20 X 500 ml (2%)', 2496800),
(379, 'NKPO180324CORTE010014', '', 'EPD 2.5 %', 17561625),
(380, 'NKPO180324BASFI010020', 'BASFI01', 'Disc. 2%', 52523535),
(381, 'KPOREV1903240002', 'BASFI01', 'Disc. 2%', 52523535),
(382, 'MKPO190324AGRIC020003', 'AGRIC02', 'Diskon Barang - Throne 250 EC 48 X 100 ml (2%)', 1289952),
(383, 'MKPO190324AGRIC020003', 'AGRIC02', 'Diskon Barang - Throne 250 EC 20 X 250 ml (2%)', 4113000),
(384, 'NKPO190324SARAN040008', 'SARAN04', 'Disc. 25%', 5125000),
(389, 'KPOREV2003240008', 'GLOBA01', 'Disc. R1 6%', 30600000),
(390, 'NKPO210324INTIE010001', 'INTIE01', 'Metindo WP Qty Disc. 2%', 12970000),
(391, 'NKPO210324INTIE010001', 'INTIE01', 'Metindo WP Qty Disc. 2%', 12970000),
(392, 'NKPO210324INTIE010001', 'INTIE01', 'Metindo WP Special Disc. 2%', 12970000),
(393, 'NKPO210324INTIE010001', 'INTIE01', 'Metindo SP Qty Disc. 2,5%', 13180000),
(394, 'NKPO210324INTIE010001', 'INTIE01', 'Metindo SP Reguler Disc. 1,5%', 7908000),
(395, 'NKPO210324INTIE010001', 'INTIE01', 'Metindo SP Special Disc. 2%', 10544000),
(396, 'NKPO210324MITRA010002', 'MITRA01', 'Topsindo Reguler Disc. 1%', 1450000),
(397, 'NKPO210324MITRA010002', 'MITRA01', 'Topsindo Qty Disc. 2%', 2900000),
(398, 'MKPO210324KALAT010003', 'KALAT01', 'Gandasil Disc.6%', 158940000),
(399, 'NKPO220324ROYAL010006', 'ROYAL01', 'Diskon Barang - Revus 250 SC 50 X 100 ml (3%)', 16173150),
(400, 'MKPO220324ADVAN020007', 'ADVAN02', 'Distributor Disc 5%', 85500000),
(401, 'MKPO220324ADVAN020007', 'ADVAN02', 'Kios Disc. 3%', 51300000),
(402, 'MKPO220324ADVAN020007', 'ADVAN02', 'Farmer Disc. 3%', 51300000),
(403, 'NKPO220324ROYAL010008', 'ROYAL01', 'Agil Disc.7%', 43036000),
(404, 'NKPO220324ROYAL010008', 'ROYAL01', 'Remazole Disc. 9%', 147975552),
(406, 'KPOREV2303240009', 'ROYAL01', 'Diskon Barang-Revus 250 SC 50 X 100 ml(4%)', 21564200),
(408, 'KPOREV2303240010', 'ROYAL01', 'Diskon Barang-Revus 250 SC 50 X 100 ml(4%)', 16352000),
(409, 'NKPO230324MITRA010013', 'MITRA01', 'Neocron Disc. 8%', 33800000),
(410, 'NKPO230324MITRA010013', 'MITRA01', 'Neocron Disc. One Shoot R1 2%', 8450000),
(411, 'MKPO230324CATUR010014', 'CATUR01', 'Special discount Manzate Rp.5.000/kg', 25000000),
(412, 'MKPO230324CATUR010014', 'CATUR01', 'SBU discount Manzate Rp.4.000/kg', 20000000),
(413, 'MKPO230324CATUR010014', 'CATUR01', 'Special discount Manzate 1 kg Rp.2.500/kg', 12500000),
(414, 'MKPO230324CATUR010014', 'CATUR01', 'Diskon R1 - Manzate Rp.3.500/kg', 17500000),
(415, 'NKPO250324MAJUM010003', 'MAJUM01', 'Diskon Barang - Mr. Qlett 30 X 200 ml (5%)', 3750000),
(416, 'NKPO250324SAPRO030004', 'SAPRO03', 'Cash Disc.2%', 3165000),
(417, 'KPOREV2503240006', 'MAJUM01', 'Diskon Barang - Mr. Qlett 30 X 200 ml (5%)', 3750000),
(418, 'MKPO250324EXCEL010006', 'EXCEL01', 'Pot. Invoice Rp. 10.000/L', 50000000),
(419, 'MKPO250324EXCEL010006', 'EXCEL01', 'Pot. TOP 90 hari Rp. 5.000/L', 25000000),
(420, 'MKPO250324EXCEL010006', 'EXCEL01', 'Qty Disc. Rp. 4.000/L', 20000000),
(421, 'MKPO250324EXCEL010006', 'EXCEL01', 'Additional Disc. Rp. 10.000/L', 50000000),
(422, 'NKPO260324PETRO010002', 'PETRO01', 'Saturn Plus Pot. Invoice Rp.3.000/L', 6000000),
(423, 'MKPO260324AGRIM010003', 'AGRIM01', 'Jagung Manis Panglima 40 X 1750 seed - SD 5%', 10000000),
(424, 'MKPO260324AGRIM010003', 'AGRIM01', 'Jagung Manis Panglima 40 X 1750 seed - CBD 3%', 5700000),
(426, 'MKPO260324AGRIC020006', 'AGRIC02', 'Diskon Barang - Blast 200 SC 20 X 500 ml (2%)', 4993600),
(427, 'MKPO260324AGRIC020007', 'AGRIC02', 'Diskon Barang - Blast 200 SC 20 X 500 ml (2%)', 4993600),
(428, 'MKPO300324AGRIC020007', 'AGRIC02', 'Spontan Disc. 6%', 54232200),
(429, 'MKPO300324AGRIC020008', 'AGRIC02', 'Spontan Disc. 6%', 54852000),
(430, 'MKPO300324AGRIC020011', 'AGRIC02', 'Spontan Disc. 6%', 61150800),
(431, 'MKPO010424AGRIM010002', 'AGRIM01', 'SD 5%', 20000000),
(432, 'MKPO010424AGRIM010002', 'AGRIM01', 'CBD 3%', 11400000),
(433, 'KPOREV0104240006', 'AGRIC02', 'Spontan Disc. 6%', 61150800),
(434, 'KPOREV0104240007', 'AGRIC02', 'Spontan Disc. 6%', 61150800),
(435, 'MKPO030424AGRIC020003', 'AGRIC02', 'Diskon Barang - Mospilan 30 EC 20 X 400 ml (2%)', 2864000),
(436, 'MKPO030424AGRIC020003', 'AGRIC02', 'Diskon ZOD - Sevin 85 SP 100 X 100 gr (2%)', 6438000),
(437, 'MKPO030424AGRIC020003', 'AGRIC02', 'Diskon Barang - Throne 250 EC 20 X 500 ml (2%)', 1940000),
(438, 'MKPO030424AGRIC020003', 'AGRIC02', 'Diskon Barang - Blast 200 SC 48 X 100 ml (2%)', 419760),
(439, 'KPOREV0304240004', '', 'TOP 15 hari Disc.3%', 9990000),
(440, 'MKPO030424KALAT010007', 'KALAT01', 'Dektin disc. 5% ', 8155000),
(442, 'NKPO170424SAPRO030002', 'SAPRO03', 'Cash Disc.2%', 30028920),
(447, 'MKPO230424AGRIM010003', 'AGRIM01', 'SD 5%', 40000000),
(448, 'MKPO230424AGRIM010003', 'AGRIM01', 'CBD 3%', 22800000),
(449, 'NKPO240424MITRA010003', 'MITRA01', 'Rotraz Disc. 2%', 3400000),
(450, 'NKPO240424MITRA010003', 'MITRA01', 'Neocron Disc. 8%', 11400000),
(451, 'NKPO240424MITRA010003', 'MITRA01', 'Neocron Disc. One Shoot R1 2%', 2850000),
(452, 'MKPO250424ADVAN020001', 'ADVAN02', 'Disc. R1 5%', 950000),
(453, 'MKPO250424ADVAN020001', 'ADVAN02', 'Disc. CBD 4.5%', 855000),
(454, 'NKPO250424MITRA010003', 'MITRA01', 'Neocron Disc. 8%', 44800000),
(455, 'NKPO250424MITRA010003', 'MITRA01', 'Neocron Disc. One Shoot R1 2%', 11200000),
(456, 'MKPO250424AGRIM010005', 'AGRIM01', 'Jagung Manis Panglima 40 X 1750 seed - SD 5%', 20000000),
(457, 'MKPO250424AGRIM010005', 'AGRIM01', 'Jagung Manis Panglima 40 X 1750 seed - CBD 3%', 11400000),
(458, 'MKPO260424ASIAN010008', 'ASIAN01', 'Disc Rp. 1.500/ltr', 3000000),
(459, 'MKPO260424ASIAN010008', '', 'Disc Rp. 750/L', 1500000),
(461, 'NKPO300424BASFI010008', 'BASFI01', 'Disc. 2%', 12187728),
(462, 'MKPO020524CATUR010005', 'CATUR01', 'Disc. 5%', 2850000),
(463, 'KPOREV0205240007', 'CATUR01', 'Disc. 4.000/kg', 2000000),
(464, 'NKPO020524SAPRO030011', 'SAPRO03', 'Cash Disc.2%', 31033920),
(465, 'MKPO030524KALAT010003', 'KALAT01', 'Gandasil Disc.6%', 95160000),
(466, 'KPOREV0305240007', '', 'Disc. 13%', 16367000),
(467, 'NKPO060524PETRO010003', 'PETRO01', 'Saturn Plus Pot. Invoice Rp.3.000/L', 6000000),
(468, 'MKPO060524ADILM010005', 'ADILM01', 'Disc. 1.500/ltr', 22500000),
(469, 'MKPO130524GLOBA010001', 'GLOBA01', 'Disc. R1 6%', 19200000),
(471, 'MKPO130524KALAT010006', 'KALAT01', 'Gandasil Disc.6%', 117330000),
(472, 'NKPO140524MIOCH010005', 'MIOCH01', 'TOP 15 Hari Disc. 3%', 9990000),
(473, 'NKPO150524INTIE010003', 'INTIE01', 'Metindo SP Qty Disc. 2,5%', 15600000),
(474, 'NKPO150524INTIE010003', 'INTIE01', 'Metindo SP Reguler Disc. 1,5%', 9360000),
(475, 'NKPO150524INTIE010003', 'INTIE01', 'Metindo SP Special Disc. 2%', 12480000),
(476, 'NKPO150524CORTE010002', 'CORTE01', 'EPD 2.5%', 28443750),
(477, 'KPOREV1605240001', 'CORTE01', 'EPD 2.5%', 28443750),
(478, 'KPOREV1605240006', 'CORTE01', 'EPD 2.5%', 28443773),
(479, 'MKPO160524AGRON010007', 'AGRON01', 'disc 3% pembayaran 25 maret 2024 ', 9000000),
(480, 'MKPO160524GLOBA010014', 'GLOBA01', 'All Produk Disc. R1 6%', 15000000),
(481, 'NKPO170524BASFI010010', 'BASFI01', 'Diskon Barang-Melyra 200/200 SC 24 X 250 ml(2%)', 4786800),
(482, 'NKPO210524SAPRO030001', 'SAPRO03', 'Disc. qty 3 ton Rp. 2.500/pack', 75000000),
(483, 'NKPO210524SAPRO030001', 'SAPRO03', 'Disc. tambahan Rp. 2.250/kg', 6750000),
(484, 'MKPO210524EXCEL010003', 'EXCEL01', 'Pot. TOP 45 hari Rp. 2.000/kg', 1000000),
(485, 'NKPO210524CORTE010003', 'CORTE01', 'Disc. 2.5% TOP 60 hari', 25800000),
(486, 'NKPO240524BASFI010006', 'BASFI01', 'Diskon Barang - Insure Max 510 FS 200 ltr (2%)', 3920000),
(487, 'NKPO250524QTMM0002', 'QTMM', 'FOC 10% Price ', 3180000),
(489, 'MKPO290524CATUR010001', 'CATUR01', 'Disc. Rp.2.000/kg', 2000000),
(490, 'KPOREV2905240002', 'CATUR01', 'Disc. Rp.2.500/kg', 2500000),
(491, 'MKPO290524CATUR010008', 'CATUR01', 'Additional disc. Rp. 2.500/kg', 2500000),
(492, 'MKPO290524AGRIM010007', 'AGRIM01', 'SD 5%', 250000000),
(493, 'MKPO290524AGRIM010007', 'AGRIM01', 'CBD 3% ', 142500000),
(494, 'KPOREV2905240009', 'AGRIM01', 'SD 5%', 250000000),
(495, 'KPOREV2905240009', 'AGRIM01', 'CBD 3% ', 142500000),
(496, 'KPOREV2905240010', 'AGRIM01', 'SD 5%', 250000000),
(497, 'KPOREV2905240010', 'AGRIM01', 'CBD 3% ', 142500000),
(498, 'NKPO300524MIOCH010001', 'MIOCH01', 'TOP 15 Hari Disc. 3%', 9990000),
(499, 'MKPO300524ASIAN010002', 'ASIAN01', 'Qty Disc. Asia Top Rp. 500/L', 8500000),
(500, 'MKPO300524ASIAN010002', 'ASIAN01', 'Disc. Megaxone 1000/L', 12000000),
(501, 'MKPO300524CATUR010003', 'CATUR01', 'Additional disc. Rp. 2.500/kg', 2500000),
(502, 'NKPO300524MITRA010004', 'MITRA01', 'Neocron Disc. 8%', 112000000),
(503, 'NKPO300524MITRA010004', 'MITRA01', 'Neocron Disc. One Shoot R1 2%', 28000000),
(504, 'NKPO300524MITRA010004', 'MITRA01', 'Rotraz Disc. 2%', 3400000),
(505, 'NKPO300524BASFI010005', 'BASFI01', 'Disc. 2%', 30644983),
(506, 'MKPO300524AGRIC020006', 'AGRIC02', 'Spontan Disc. 6%', 162120000),
(509, 'NKPO300524PETRO010009', 'PETRO01', 'Mipcinta Potong Invoice Rp.2000/kg', 20000000),
(510, 'NKPO300524PETRO010009', 'PETRO01', 'TOP 30 hari disc. 2%', 18640000),
(511, 'MKPO310524AGRIM010014', 'AGRIM01', 'SD 5%', 20000000),
(512, 'MKPO310524AGRIM010014', 'AGRIM01', 'CBD 3%', 11400000),
(513, 'NKPO310524SAPRO030015', 'SAPRO03', 'Cash Disc.2%', 34410000),
(514, 'KPOREV3105240017', 'BASFI01', 'Disc. 2%', 30644230),
(515, 'KPOREV3105240018', 'SAPRO03', 'Cash Disc.2%', 34410000),
(516, 'NKPO310524BAY010019', 'BAY01', 'Disc. 3%', 15466500),
(517, 'MKPO030624BERB010004', 'BERB01', 'Disc Rp.13.000/btl', 12480000),
(518, 'KPOREV0406240001', '', 'Asuransi', -257311.7),
(519, 'MKPO060624KALAT010001', 'KALAT01', 'Dektin disc. 5%', 16310000),
(520, 'MKPO060624KALAT010001', 'KALAT01', 'Dekapirim Disc.5%', 5137500),
(521, 'MKPO060624KALAT010002', 'KALAT01', 'Gandasil Disc.6%', 113985000),
(522, 'MKPO060624KALAT010003', 'KALAT01', 'Gandasil Disc.6%', 113985000),
(523, 'MKPO060624KALAT010004', 'KALAT01', 'Gandasil Disc.6%', 57924000),
(524, 'KPOREV0606240007', 'PETRO01', 'Mipcinta Potong Invoice Rp.1000/kg', 10000000),
(525, 'KPOREV0606240007', 'PETRO01', 'TOP 30 hari disc. 2%', 18840000),
(526, 'MKPO180624AGRIM010002', 'AGRIM01', 'SD 5%', 20000000),
(527, 'MKPO180624AGRIM010002', 'AGRIM01', 'CBD 3%', 11400000),
(528, 'MKPO180624EXCEL010003', 'EXCEL01', 'Cash Disc. Rp.5000/kg', 6400000),
(529, 'MKPO180624CATUR010004', 'CATUR01', 'Additional disc. Rp. 2.500/kg', 1250000),
(530, 'KPOREV1806240007', 'AGRIM01', 'SD 5%', 30000000),
(531, 'KPOREV1806240007', 'AGRIM01', 'CBD 3%', 17100000),
(532, 'NKPO190624ROYAL010004', 'ROYAL01', 'Agil Disc. 12%', 420806400),
(533, 'NKPO190624ROYAL010004', 'ROYAL01', 'Remazole Disc. 11%', 19692750),
(534, 'NKPO190624ROYAL010004', 'ROYAL01', 'EP', 212386261),
(535, 'MKPO190624KALAT010004', 'KALAT01', 'Gandasil Disc.6%', 100560000),
(536, 'KPOREV1906240005', 'KALAT01', 'Gandasil Disc.6%', 100560000),
(537, 'NKPO200624INTIE010004', 'INTIE01', 'Metindo SP Qty Disc. 2,5%', 11880000),
(538, 'NKPO200624INTIE010004', 'INTIE01', 'Metindo SP Reguler Disc. 1,5%', 7128000),
(539, 'NKPO200624INTIE010004', 'INTIE01', 'Metindo SP Special Disc. 2%', 9504000),
(540, 'NKPO200624INTIE010004', 'INTIE01', 'Metindo WP Qty Disc. 2%', 12870000),
(541, 'NKPO200624INTIE010004', 'INTIE01', 'Metindo WP Reguler Disc. 2%', 12870000),
(542, 'NKPO200624INTIE010004', 'INTIE01', 'Metindo WP Special Disc. 2%', 12870000),
(543, 'MKPO210624AGRIM010012', 'AGRIM01', 'SD 5%', 187500000),
(544, 'MKPO210624AGRIM010012', 'AGRIM01', 'CBD 3%', 106875000),
(545, 'MKPO240624CATUR010001', 'CATUR01', 'Additional disc. Rp. 2.500/kg', 1250000),
(546, 'NKPO240624PETRO010002', 'PETRO01', 'Applaud Pot. Invoice Rp.2000/kg', 5000000),
(547, 'NKPO240624PETRO010002', 'PETRO01', 'Petrokum Pot. Invoice Rp.2000/kg', 16800000),
(548, 'NKPO240624PETRO010002', 'PETRO01', 'Termikon Pot. Invoice Rp.2000/ltr', 10000000),
(549, 'NKPO240624PETRO010002', 'PETRO01', 'Topsin Pot. Invoice Rp.4000/ltr', 6000000),
(550, 'NKPO240624PETRO010002', 'PETRO01', 'TOP 30 hari disc. 2%', 20412500),
(551, 'NKPO240624SAPRO030003', 'SAPRO03', 'Cash Disc.2%', 15910920),
(552, 'KPOREV2406240006', 'PETRO01', 'Applaud Pot. Invoice Rp.2000/kg', 4000000),
(553, 'KPOREV2406240006', 'PETRO01', 'Petrokum Pot. Invoice Rp.2000/kg', 18000000),
(554, 'KPOREV2406240006', 'PETRO01', 'Termikon Pot. Invoice Rp.2000/ltr', 6800000),
(555, 'KPOREV2406240006', 'PETRO01', 'Topsin Pot. Invoice Rp.4000/ltr', 12000000),
(556, 'KPOREV2406240006', 'PETRO01', 'TOP 30 hari disc. 2%', 21802000),
(557, 'KPOREV2406240012', 'PETRO01', 'Applaud Pot. Invoice Rp.2000/kg', 4000000),
(558, 'KPOREV2406240012', 'PETRO01', 'Petrokum Pot. Invoice Rp.2000/kg', 18000000),
(559, 'KPOREV2406240012', 'PETRO01', 'Termikon Pot. Invoice Rp.2000/ltr', 10000000),
(560, 'KPOREV2406240012', 'PETRO01', 'Topsin Pot. Invoice Rp.4000/ltr', 12000000),
(561, 'KPOREV2406240012', 'PETRO01', 'TOP 30 hari disc. 2%', 23666000),
(562, 'MKPO250624ADVAN010004', 'ADVAN01', 'Diskon Extravaganza', 20000000),
(563, 'NKPO250624SAPRO030005', 'SAPRO03', 'Disc. qty 3 ton Rp. 2.500/pack', 75000000),
(564, 'NKPO250624SAPRO030005', 'SAPRO03', 'Disc. tambahan Rp. 2.250/kg', 6750000),
(565, 'KPOREV2506240008', 'ADVAN01', 'Diskon Extravaganza', 20000000),
(566, 'KPOREV2606240005', 'PETRO01', 'Applaud Pot. Invoice Rp.500/kg', 1000000),
(567, 'KPOREV2606240005', 'PETRO01', 'Petrokum Pot. Invoice Rp.1000/kg', 9000000),
(568, 'KPOREV2606240005', 'PETRO01', 'Termikon Pot. Invoice Rp.1000/ltr', 5000000),
(569, 'KPOREV2606240005', 'PETRO01', 'Topsin Pot. Invoice Rp.4000/ltr', 12000000),
(570, 'KPOREV2606240005', 'PETRO01', 'TOP 30 hari disc. 2%', 24006000),
(571, 'MKPO260624KALAT010009', 'KALAT01', 'Dekamon Disc. 3%', 6528000),
(572, 'KPOREV2606240011', 'ROYAL01', 'Agil Disc. 10%', 350996400),
(573, 'KPOREV2606240011', 'ROYAL01', 'Remazole Disc. 11%', 19692750),
(574, 'KPOREV2606240011', 'ROYAL01', 'EP', 208035902),
(575, 'NKPO270624MITRA010003', 'MITRA01', 'Fenval Reguler Disc. 2%', 24580000),
(576, 'NKPO270624MITRA010003', 'MITRA01', 'Fenval Qty Disc. 1%', 12290000),
(577, 'NKPO270624MITRA010003', 'MITRA01', 'Folirfos Disc. 1%', 2100000),
(578, 'NKPO270624MITRA010003', 'MITRA01', 'Nemaguard Qty Disc. 2%', 1380000),
(579, 'NKPO270624MITRA010003', 'MITRA01', 'Rotraz Disc. 2%', 10200000),
(580, 'NKPO270624MITRA010003', 'MITRA01', 'Topsindo Reguler Disc. 1%', 2900000),
(581, 'NKPO270624MITRA010003', 'MITRA01', 'Topsindo Qty Disc. 2%', 5800000),
(582, 'NKPO270624MITRA010003', 'MITRA01', 'Unirex Disc. 2%', 1540000),
(583, 'NKPO270624MITRA010003', 'MITRA01', 'Neocron Disc. 8%', 265440000),
(584, 'NKPO270624MITRA010003', 'MITRA01', 'Neocron Disc. One Shoot R1 2%', 66360000),
(585, 'NKPO270624INTIE010004', 'INTIE01', 'Metindo WP Qty Disc. 2%', 25850000),
(586, 'NKPO270624INTIE010004', 'INTIE01', 'Metindo WP Reguler Disc. 2%', 25850000),
(587, 'NKPO270624INTIE010004', 'INTIE01', 'Metindo WP Special Disc. 2%', 25850000),
(588, 'NKPO270624INTIE010004', 'INTIE01', 'Metindo SP Qty Disc. 2,5%', 49850000),
(589, 'NKPO270624INTIE010004', 'INTIE01', 'Metindo SP Reguler Disc. 1,5%', 29910000),
(590, 'NKPO270624INTIE010004', 'INTIE01', 'Metindo SP Special Disc. 2%', 39880000),
(591, 'MKPO280624KALAT010001', 'KALAT01', 'Dekamon Disc. 3%', 3858000),
(592, 'MKPO280624KALAT010001', 'KALAT01', 'Dektin disc. 5%', 8155000),
(595, 'NKPO280624BASFI010003', '', 'Disc. 2%', 54722160),
(596, 'MKPO010724CATUR010001', 'CATUR01', 'Special discount Manzate Rp.5.000/kg', 25000000),
(597, 'MKPO010724CATUR010001', 'CATUR01', 'SBU discount Manzate Rp.4.000/kg', 20000000),
(598, 'MKPO010724CATUR010001', 'CATUR01', 'Special discount Manzate 1 kg Rp.2.500/kg', 12500000),
(599, 'MKPO010724CATUR010001', 'CATUR01', 'Diskon R1 - Manzate Rp.3.500/kg', 17500000),
(604, 'KPOREV0107240002', 'CATUR01', 'Special discount Manzate Rp.5.000/kg', 25000000),
(605, 'KPOREV0107240002', 'CATUR01', 'SBU discount Manzate Rp.4.000/kg', 20000000),
(606, 'KPOREV0107240002', 'CATUR01', 'Special discount Manzate 1 kg Rp.2.500/kg', 12500000),
(607, 'KPOREV0107240002', 'CATUR01', 'Diskon R1 - Manzate Rp.3.500/kg', 17500000),
(608, 'MKPO010724CATUR010002', 'CATUR01', 'Special discount Manzate Rp.5.000/kg', 25000000),
(609, 'MKPO010724CATUR010002', 'CATUR01', 'SBU discount Manzate Rp.4.000/kg', 20000000),
(610, 'MKPO010724CATUR010002', 'CATUR01', 'Special discount Manzate 1 kg Rp.2.500/kg', 12500000),
(611, 'MKPO010724CATUR010002', 'CATUR01', 'Diskon R1 - Manzate Rp.3.500/kg', 17500000),
(612, 'KPOREV0107240003', 'CATUR01', 'Special discount Manzate Rp.5.000/kg', 25000000),
(613, 'KPOREV0107240003', 'CATUR01', 'SBU discount Manzate Rp.4.000/kg', 20000000),
(614, 'KPOREV0107240003', 'CATUR01', 'Special discount Manzate 1 kg Rp.2.500/kg', 12500000),
(615, 'KPOREV0107240003', 'CATUR01', 'Diskon R1 - Manzate Rp.3.500/kg', 17500000),
(616, 'MKPO010724CATUR010003', 'CATUR01', 'Special discount Manzate Rp.5.000/kg', 25000000),
(617, 'MKPO010724CATUR010003', 'CATUR01', 'SBU discount Manzate Rp.4.000/kg', 20000000),
(618, 'MKPO010724CATUR010003', 'CATUR01', 'Special discount Manzate 1 kg Rp.2.500/kg', 12500000),
(619, 'MKPO010724CATUR010003', 'CATUR01', 'Diskon R1 - Manzate Rp.3.500/kg', 17500000),
(620, 'MKPO030724KALAT010002', 'KALAT01', 'Dekapirim Disc.5%', 3878000),
(621, 'MKPO030724ASIAN010005', 'ASIAN01', 'Disc. Spontas Rp. 2.500/L', 1250000),
(622, 'NKPO040724SAPRO030002', 'SAPRO03', 'Cash Disc.2%', 30792300),
(623, 'KPOREV0807240003', '', 'Asuransi', -280042.87),
(624, 'NKPO090724SAPRO030005', 'SAPRO03', 'Cash Disc.2%', 18030000),
(625, 'MKPO090724GLOBA010006', 'GLOBA01', 'All Produk Disc. R1 6%', 67500000),
(626, 'MKPO090724GLOBA010006', 'GLOBA01', 'Pot. Rp. 2.500/btl', 112500000),
(627, 'MKPO090724DANKE010007', 'DANKE01', 'Cashback Rp.10.000/L', 2500000);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_file_bukti_beli`
--

INSERT INTO `tb_file_bukti_beli` (`id_fk_bukti`, `kd_po_nk`, `keterangan`, `user_upload`, `file_name`, `file_uploaded`, `create_at`) VALUES
(2, 'NKPO0708240002', 'bukti pembelian', 'KEU02', '2024081723292942', '2024081723292942.jpg', '2024-08-10 12:29:02'),
(3, 'NKPO1208240001', '-', 'KEU01', '2024081723466724', '2024081723466724.jpg', '2024-08-12 12:45:24'),
(4, 'NKPO1908240001', '-', 'KEU02', '2024081724054704', '2024081724054704.csv', '2024-08-19 08:05:04'),
(5, 'NKPO1908240001', '-', 'KEU02', '2024081724055707', '2024081724055707.csv', '2024-08-19 08:21:47'),
(6, 'NKPO2108240002', '-', 'KEU02', '2024081724226983', '2024081724226983.png', '2024-08-21 07:56:23'),
(7, 'NKPO2208240001', 'Pembelian on progress', 'KEU02', '2024081724321433', '2024081724321433.jpg', '2024-08-22 10:10:33'),
(8, 'NKPO2608240001', '-', 'KEU02', '2024081724646864', '2024081724646864.png', '2024-08-26 04:34:24');

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

--
-- Dumping data untuk tabel `tb_file_nk`
--

INSERT INTO `tb_file_nk` (`id_file_nk`, `kd_po_nk`, `keterangan`, `user_upload`, `file_name`, `file_uploaded`, `create_at`) VALUES
(1, 'NKPO0708240002', '123', 'KARYAWAN2', '2024081723018082', '2024081723018082.csv', '2024-08-07 08:08:02');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_generateqrcode`
--

CREATE TABLE `tb_generateqrcode` (
  `id_gqrcode` int(11) NOT NULL,
  `kd_qrcode` varchar(25) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_generateqrcode`
--

INSERT INTO `tb_generateqrcode` (`id_gqrcode`, `kd_qrcode`, `create_at`) VALUES
(1, 'QRC0408240001', '2024-08-04 13:05:28'),
(2, 'QRC0408240002', '2024-08-04 13:21:27'),
(3, 'QRC0408240003', '2024-08-04 13:24:23'),
(4, 'QRC0408240004', '2024-08-04 13:25:49'),
(5, 'QRC0408240005', '2024-08-04 13:26:08'),
(6, 'QRC0408240006', '2024-08-04 13:36:39'),
(7, 'QRC0408240007', '2024-08-04 14:29:54'),
(8, 'QRC0408240008', '2024-08-04 14:31:30'),
(9, 'QRC0408240009', '2024-08-04 14:31:36'),
(10, 'QRC0408240010', '2024-08-04 14:33:21'),
(11, 'QRC0408240011', '2024-08-04 14:34:05'),
(12, 'QRC0408240012', '2024-08-04 14:54:01'),
(13, 'QRC0608240001', '2024-08-06 03:59:52'),
(14, 'QRC0608240002', '2024-08-06 08:42:45'),
(15, 'QRC0608240003', '2024-08-06 08:44:38'),
(16, 'QRC1908240001', '2024-08-19 03:35:33'),
(17, 'QRC2008240001', '2024-08-20 07:01:32'),
(18, 'QRC2008240002', '2024-08-20 07:02:28'),
(19, 'QRC2008240003', '2024-08-20 07:02:42'),
(20, 'QRC2708240001', '2024-08-27 02:33:09'),
(21, 'QRC2708240002', '2024-08-27 03:50:58'),
(22, 'QRC2708240003', '2024-08-27 04:38:57');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_generate_kd`
--

CREATE TABLE `tb_generate_kd` (
  `id` int(11) NOT NULL,
  `kd_barang` varchar(25) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_generate_kd`
--

INSERT INTO `tb_generate_kd` (`id`, `kd_barang`, `create_at`) VALUES
(1, 'PONK0408240001', '2024-08-04 13:05:28'),
(2, 'PONK0408240002', '2024-08-04 13:21:27'),
(3, 'PONK0408240003', '2024-08-04 13:24:23'),
(4, 'PONK0408240004', '2024-08-04 13:25:49'),
(5, 'PONK0408240005', '2024-08-04 13:26:08'),
(6, 'PONK0408240006', '2024-08-04 13:36:39'),
(7, 'PONK0408240007', '2024-08-04 14:54:01'),
(8, 'QRCONTO123', '2024-08-06 08:42:45'),
(9, 'PONK0608240001', '2024-08-06 08:44:38'),
(10, 'PONK1908240001', '2024-08-19 03:35:33'),
(11, 'PONK1908240002', '2024-08-19 03:35:33'),
(12, 'PONK1908240003', '2024-08-19 06:39:49'),
(13, 'PONK1908240004', '2024-08-19 08:06:01'),
(14, 'PONK1908240005', '2024-08-19 08:26:21'),
(15, 'PONK1908240006', '2024-08-19 12:53:28'),
(16, 'PONK2008240001', '2024-08-20 03:16:00'),
(17, 'PONK2008240002', '2024-08-20 07:01:32'),
(18, 'PONK2008240003', '2024-08-20 07:06:25'),
(19, 'PONK2108240001', '2024-08-21 07:02:17'),
(20, 'PONK2108240002', '2024-08-21 08:49:52'),
(21, 'PONK2208240001', '2024-08-22 10:46:21'),
(22, 'PONK2208240002', '2024-08-22 16:21:27'),
(23, 'PONK2408240001', '2024-08-24 04:19:02'),
(24, 'PONK2608240001', '2024-08-26 04:59:20'),
(25, 'PONK2608240002', '2024-08-26 05:16:31'),
(26, 'PONK2608240003', '2024-08-26 05:20:17'),
(27, 'PONK2708240001', '2024-08-27 02:33:09'),
(28, 'PONK2708240002', '2024-08-27 03:26:50'),
(29, 'PONK2708240003', '2024-08-27 03:50:58'),
(30, 'PONK2708240004', '2024-08-27 05:17:58'),
(31, 'PONK2708240005', '2024-08-27 05:21:30'),
(32, 'PONK2708240006', '2024-08-27 06:58:38'),
(33, 'PONK2708240007', '2024-08-27 07:00:45'),
(34, 'PONK2708240008', '2024-08-27 08:45:23');

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

--
-- Dumping data untuk tabel `tb_note_direktur`
--

INSERT INTO `tb_note_direktur` (`id_note`, `kd_po`, `isi_note`, `kd_user`, `nama_user`, `note_for`, `update_status`, `log_create`) VALUES
(1, 'PONK2608240002', 'REQUEST BARU', 'KARYAWAN2', 'Bram', 2, 2, '2024-08-26 05:16:31'),
(2, 'PONK2608240002', 'PENGAJUAN DITERIMA', 'KEU02', 'Arini', 2, 2, '2024-08-26 05:17:44'),
(3, 'PONK2608240002', 'ON HAND - Bram', 'KEU02', 'Arini', 2, 2, '2024-08-26 05:18:17'),
(4, 'PONK2608240003', 'REQUEST BARU', 'KARYAWAN2', 'Bram', 2, 2, '2024-08-26 05:20:17'),
(5, 'PONK2608240003', 'PENGAJUAN DITERIMA', 'KEU02', 'Arini', 2, 2, '2024-08-26 05:24:29'),
(6, 'PONK2608240003', 'ON HAND - Bram', 'KEU02', 'Arini', 2, 2, '2024-08-26 05:35:23'),
(7, 'NKPO2608240001', 'REQUEST BARU ', 'KARYAWAN2', 'Bram', 2, 2, '2024-08-26 05:20:17'),
(8, 'PONK2608240003', 'REQUEST BARU ', 'KARYAWAN2', 'Bram', 2, 2, '2024-08-26 05:20:17'),
(9, 'PONK2708240002', 'REQUEST BARU', 'KARYAWAN2', 'Bram', 2, 2, '2024-08-27 03:26:50'),
(10, 'PONK2708240002', 'PENGAJUAN DITERIMA', 'KEU02', 'Arini', 2, 2, '2024-08-27 04:58:30'),
(11, 'PONK2708240002', 'ON HAND - Bram', 'KEU02', 'Arini', 2, 2, '2024-08-27 04:59:37'),
(12, 'PONK2708240004', 'REQUEST BARU', 'KARYAWAN2', 'Bram', 2, 2, '2024-08-27 05:17:58'),
(13, 'PONK2708240005', 'REQUEST BARU', 'KARYAWAN2', 'Bram', 2, 2, '2024-08-27 05:21:30'),
(14, 'PONK2708240005', 'PENGAJUAN DITERIMA', 'KEU02', 'Arini', 2, 2, '2024-08-27 06:22:59'),
(15, 'PONK2708240005', 'ON HAND - Bram', 'KEU02', 'Arini', 2, 2, '2024-08-27 06:27:51'),
(16, 'PONK2708240006', 'REQUEST BARU', 'KARYAWAN2', 'Bram', 2, 2, '2024-08-27 06:58:38'),
(17, 'PONK2708240007', 'REQUEST BARU', 'KARYAWAN2', 'Bram', 2, 2, '2024-08-27 07:00:45'),
(18, 'PONK2708240007', 'PENGAJUAN DITERIMA', 'KEU01', 'Supriyanto', 2, 2, '2024-08-27 07:01:50'),
(19, 'PONK2708240007', 'ON HAND - Bram', 'KEU01', 'Supriyanto', 2, 2, '2024-08-27 07:03:06'),
(20, 'PONK2708240006', 'PENGAJUAN DITERIMA', 'KEU02', 'Arini', 2, 2, '2024-08-27 08:05:39'),
(21, 'PONK2708240008', 'REQUEST BARU', 'KARYAWAN2', 'Bram', 2, 2, '2024-08-27 08:45:23'),
(22, 'PONK2708240008', 'PENGAJUAN DITERIMA', 'KEU02', 'Arini', 2, 2, '2024-08-28 08:05:28');

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
(1, 1, 'NKPO1908240001', 'KARYAWAN2KEUANGAN', 'KARYAWAN2', 'Bram', '2024-08-19', 3, 1375000, 'DONE', 'KEUANGAN', '-', 0, 0, 0, 0, 'KIUDIREKTUR05', 'KADEP01', '2024-08-19 08:25:09'),
(2, 1, 'NKPO2108240002', 'KARYAWAN2KEUANGAN', 'KARYAWAN2', 'Bram', '2024-08-21', 1, 0, 'DONE', 'KEUANGAN', 'TRIAL1', 0, 0, 0, 0, 'KIUDIREKTUR05', 'KADEP01', '2024-08-21 07:56:45'),
(3, 1, 'NKPO2208240001', 'KARYAWAN2KEUANGAN', 'KARYAWAN2', 'Bram', '2024-08-22', 3, 0, 'DONE', 'KEUANGAN', 'ATK Bulanan ', 0, 0, 0, 0, 'KIUDIREKTUR05', 'KADEP01', '2024-08-22 10:10:40'),
(4, 1, 'NKPO2608240001', 'KARYAWAN2KEUANGAN', 'KARYAWAN2', 'Bram', '2024-08-26', 4, 0, 'DONE', 'KEUANGAN', '-', 0, 0, 0, 0, 'KIUDIREKTUR05', 'KADEP01', '2024-08-26 04:47:16');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_req_masterbarang`
--

INSERT INTO `tb_req_masterbarang` (`id_reqmbarang`, `nama_barang`, `deskripsi`, `satuan`, `req_by`) VALUES
(3, 'test', 'test', 2, 'KARYAWAN2');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_req_nk`
--

INSERT INTO `tb_req_nk` (`id_po_nk`, `jns_po`, `kd_po_nk`, `kd_user`, `nm_user`, `tgl_transaksi`, `tgl_ambil`, `jml_item`, `status`, `departemen`, `tj_pembelian`, `acc_with`, `create_at`) VALUES
(7, 2, 'PONK2708240008', 'KARYAWAN2', 'Bram', '2024-08-27', '', 4, 'REQUEST ACC', 'KEUANGAN', 'Test PO', 'KEU02', '2024-08-28 08:05:28');

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
  `jnis_po` int(11) NOT NULL,
  `nama_barang` text NOT NULL,
  `deskripsi` text NOT NULL,
  `keterangan` text NOT NULL,
  `qty` int(12) NOT NULL,
  `hrg_satuan` int(25) NOT NULL,
  `total_harga` int(25) NOT NULL,
  `kd_bsys` varchar(25) NOT NULL,
  `kd_barang` varchar(25) NOT NULL,
  `kat_barang` varchar(25) NOT NULL,
  `kd_user` varchar(25) NOT NULL,
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
  `keterangan` text NOT NULL,
  `kat_barang` varchar(25) NOT NULL,
  `tr_qty` double NOT NULL,
  `satuan` int(2) NOT NULL,
  `inputer` varchar(25) NOT NULL,
  `tgl_transaksi` text NOT NULL,
  `create_at` datetime NOT NULL,
  `last_updated_by` varchar(25) NOT NULL,
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_transaksi`
--

INSERT INTO `tb_transaksi` (`id_transnk`, `kd_akun`, `kd_po_nk`, `kd_barang`, `kd_barangsys`, `keterangan`, `kat_barang`, `tr_qty`, `satuan`, `inputer`, `tgl_transaksi`, `create_at`, `last_updated_by`, `update_at`) VALUES
(1, '11511', 'NKPO2608240001', 'QKREBES3', 'PONK3007240003', '', 'KATBR002', 15, 11, 'KARYAWAN2', '2024-08-26', '2024-08-26 11:47:16', 'KARYAWAN2', '2024-08-26 04:47:16'),
(2, '11511', 'NKPO2608240001', 'QTINMER1', 'PONK3007240005', '', 'KATBR001', 10, 2, 'KARYAWAN2', '2024-08-26', '2024-08-26 11:47:16', 'KARYAWAN2', '2024-08-26 04:47:16'),
(3, '11511', 'NKPO2608240001', 'QAIRKEM1', 'PONK3007240009', '', 'KATBR002', 10, 3, 'KARYAWAN2', '2024-08-26', '2024-08-26 11:47:16', 'KARYAWAN2', '2024-08-26 04:47:16'),
(4, '11511', 'NKPO2608240001', 'QAIRGAL1', 'PONK3007240010', '', 'KATBR002', 10, 2, 'KARYAWAN2', '2024-08-26', '2024-08-26 11:47:16', 'KARYAWAN2', '2024-08-26 04:47:16'),
(11, '11512', 'PONK2708240008', 'QAIRGAL1', 'PONK3007240010', '-', 'KATBR002', 2, 2, 'KEU02', '2024-08-27', '2024-08-28 00:00:00', 'KEU02', '2024-08-28 08:05:28');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
,`qty_in` double
,`qty_out` double
,`qty_ready` double
,`satuan` text
);

-- --------------------------------------------------------

--
-- Struktur untuk view `v_stockbarangnk`
--
DROP TABLE IF EXISTS `v_stockbarangnk`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_stockbarangnk`  AS SELECT `x`.`kode_barangs` AS `kode_barangs`, `x`.`kode_barang` AS `kode_barang`, `x`.`nama_barang` AS `nama_barang`, `x`.`deskripsi` AS `deskripsi`, coalesce(`x`.`qty_in`,0) AS `qty_in`, coalesce(`x`.`qty_out`,0) AS `qty_out`, coalesce(`x`.`qty_in`,0) - coalesce(`x`.`qty_out`,0) AS `qty_ready`, `x`.`satuan` AS `satuan` FROM (select `a`.`kd_barang` AS `kode_barangs`,`a`.`kd_br_adm` AS `kode_barang`,`a`.`nama_barang` AS `nama_barang`,`a`.`descnk` AS `deskripsi`,`b`.`nm_satuan` AS `satuan`,(select sum(`d`.`tr_qty`) from `tb_transaksi` `d` where `d`.`kd_barang` = `a`.`kd_br_adm` and `d`.`kd_akun` = '11512' group by `d`.`kd_barang`) AS `qty_out`,(select sum(`e`.`tr_qty`) from `tb_transaksi` `e` where `e`.`kd_barang` = `a`.`kd_br_adm` and `e`.`kd_akun` = '11511' group by `e`.`kd_barang`) AS `qty_in` from ((`tb_barang_nk` `a` join `tb_satuan` `b` on(`b`.`id_satuan` = `a`.`satuan`)) join `tb_kat_br` `c` on(`c`.`kd_kat` = `a`.`kat_barang`)) group by `a`.`kd_br_adm`) AS `x``x`  ;

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
  MODIFY `id_det_po_nk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tb_diskon`
--
ALTER TABLE `tb_diskon`
  MODIFY `id_diskon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=628;

--
-- AUTO_INCREMENT untuk tabel `tb_file_bukti_beli`
--
ALTER TABLE `tb_file_bukti_beli`
  MODIFY `id_fk_bukti` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tb_file_nk`
--
ALTER TABLE `tb_file_nk`
  MODIFY `id_file_nk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tb_generateqrcode`
--
ALTER TABLE `tb_generateqrcode`
  MODIFY `id_gqrcode` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `tb_generate_kd`
--
ALTER TABLE `tb_generate_kd`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

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
  MODIFY `id_note` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

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
  MODIFY `id_po_nk` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tb_req_masterbarang`
--
ALTER TABLE `tb_req_masterbarang`
  MODIFY `id_reqmbarang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_req_nk`
--
ALTER TABLE `tb_req_nk`
  MODIFY `id_po_nk` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
  MODIFY `id_tmp_nk` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `id_transnk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `tb_transaksi_tmp`
--
ALTER TABLE `tb_transaksi_tmp`
  MODIFY `id_transnk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
