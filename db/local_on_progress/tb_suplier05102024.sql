-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 05 Okt 2024 pada 09.13
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
-- Database: `kiucoid_po_komersil`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_suplier`
--

CREATE TABLE `tb_suplier` (
  `id_suplier` int(11) NOT NULL,
  `kd_suplier` varchar(25) NOT NULL,
  `nama_suplier` text NOT NULL,
  `alamat_suplier` text NOT NULL,
  `no_telpon` text NOT NULL,
  `no_fax` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `gbr_logo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_suplier`
--

INSERT INTO `tb_suplier` (`id_suplier`, `kd_suplier`, `nama_suplier`, `alamat_suplier`, `no_telpon`, `no_fax`, `email`, `gbr_logo`) VALUES
(1, 'SAPRO01', ' CV .Saprotan Utama', 'Bangkong Plaza C-7', '-', '-', '-', '-'),
(2, 'SUMBE15', ' CV.Sumber Bahagia', 'Jl. Dorowati Timur No. 51 RT. 01 / RW. 08 Mulyoarjo', '-', '-', '-', '-'),
(3, 'ADITY01', ' CV.Aditya Sentana Agro', 'Jl. Kertanegara No. 87 Karangploso', '0341 461 647', '0341 461 647', '-', '-'),
(4, 'AGROT05', ' CV.Agro Tani Semarapura', 'Klungkung', '-', '-', '-', '-'),
(5, 'ARTHA01', ' CV.Artha Buana Mandiri/Graha Niaga Mandiri', 'Jl. Jemursari XI No. 15', '031 848 1176', '031 841 3547', '-', '-'),
(6, 'BINAN02', ' CV.Binangun Agro Lestari', 'Jl. Bumi Mas Blok A No. 25 Kawasan Pergudangan RT 010 RW 001 Binong, Curug, Tangerang', '-', '-', '-', '-'),
(7, 'BUNGA04', ' CV.Bunga Tani Sejahtera', 'Jl. Rengganis No. 9 RT.003 RW.011', '-', '-', '-', '-'),
(8, 'CRIND01', ' CV.Crindo Satria Agro', 'Cenggerayam Inside Kav. B 1A Malang', '-', '-', '-', '-'),
(9, 'GRAHA01', ' CV.Graha Agro', '-', '-', '-', '-', '-'),
(10, 'INDOT01', ' CV.Indotani Subur Cemerlang', 'Jl. Gajah mada No 176 Pontianak', '(0561) 741609', '-', '-', '-'),
(11, 'JAVAM01', ' CV.Javamas Agrophos', 'Jl. Raya Sambipitu-Nglipar Km 8.3 Kedungkeris, Nglipar, Gunungkidul', '-', '-', '-', '-'),
(12, 'LESTA01', ' CV.Lestari Inti Agro', 'Jl. Laswi 371 Bale Endah PO. Box 1914', '022 595 3072', '-', '-', '-'),
(13, 'MAHAK01', ' CV.Mahakam', 'Jl. Pluit Karang Cantik Blok B-4 Barat No. 43-A', '021-66606247', '021-66691645', '-', '-'),
(14, 'MENTA01', ' CV.Mentari', '-', '-', '-', '-', '-'),
(15, 'MITRA25', ' CV.Mitra Tani Abadi Jaya', 'Nogosari', '-', '-', '-', '-'),
(16, 'MULTI07', ' CV.Multiagro Sarana Cemerlang', 'Jl. Perdana No. 53 Pontianak Selatan, KalBar', '-', '-', '-', '-'),
(17, 'PRIMA01', ' CV.Prima Agro Bumi', 'Malang', '-', '-', '-', '-'),
(18, 'RESTU03', ' CV.Restu Tani', 'Dsn. Kandang Rejo RT.03 RW.017, Ds. Sukorejo, Kec. Umbulsari', '-', '-', '-', '-'),
(19, 'SARAN04', ' CV.Sarana Tani Makmur', '-', '-', '-', '-', '-'),
(20, 'SEKAW01', ' CV.Sekawan Tani Indonesia', 'Jln. Lengkong No. 27 Puger', '-', '-', '-', '-'),
(21, 'SEMIC01', ' CV.Semi', '-', '-', '-', '-', '-'),
(22, 'SINAR13', ' CV.Sinar Agro Kimia Indonesia', 'Jl. Suryalaya IX No. 19A RT.08/RW.04 Kel. Cijagra, Kec. Lengkong', '-', '-', '-', '-'),
(23, 'SURYA01', ' CV.Surya Kencana Agrifarm', 'Jl. Dr. Sutomo III/89 Jember', '0331 426788', '0331 412210', '-', '-'),
(24, 'SYNER01', ' CV.Synergy Sedaya', 'Jl. Basuki Rahmad KM 2 Kota Madiun', '-', '-', '-', '-'),
(25, 'TANIA05', ' CV.Tani Abadi', 'Jl. Eyang Tirtapraja RT. 005 RW. 004, Pamanukan, Subang', '-', '-', '-', '-'),
(26, 'TANIA04', ' CV.Tani Abadi Borneo', 'Jl. Arteri Supadio Gg. Jutek RT.002 RW.001, Kubu Raya', '-', '-', '-', '-'),
(27, 'TRISN01', ' CV.Trisna', 'Jl. Soekarno Hatta 2 PO. Box 189', '0354 671 999', '0354 671 999', '-', '-'),
(28, 'TUNAS08', ' CV.Tunas Subur', '-', '-', '-', '-', '-'),
(29, 'UNIAG01', ' CV.Uni Agro', '-', '-', '-', '-', '-'),
(30, 'DHARM01', ' PT.Dharma Guna Wibawa', '-', '-', '-', '-', '-'),
(31, 'FAMIN01', ' PT.FAM Indonesia', 'Ruko Perumahan Tamansari Persada A/15', '+62 251 7541 709', '+62 251 7541 709', '-', '-'),
(32, 'INTIE01', ' PT.Inti Everspring Indonesia', 'Plaza Sentral Lantai 5B, Jl. Jend. Sudirman No.47 RT.05/RW 04, Kel.Karet Semanggi, Kec.Setiabudi, Jakarta Selatan', '021-57905245', '021-57905244', '-', '-'),
(33, 'NUSAP01', ' PT.Nusa Palapa Gemilang', 'Jl. Raya Jemursari No. 15 ', '-', '-', '-', '-'),
(34, 'PERDA01', ' PT.Perdana Agro Mandiri', 'Medan', '-', '-', '-', '-'),
(35, 'PIJAR01', ' PT.Pijar Nusa Pasifik', 'Jl. Raya Jemursari No. 15', '-', '-', '-', '-'),
(36, 'ABADI02', ' PT.Abadi Nylon Rope & Fishing Net Manufacturing', 'Ruko Manyar Megah Indah Plaza Blok B 17-18, Jl. Ngagel Jaya Selatan', '-', '-', '-', '-'),
(37, 'ACEBI01', ' PT.Ace Bio Care', 'Jl. Angkasa Kav. B6, Blok D2', '-', '-', '-', '-'),
(38, 'ADILM01', ' PT.Adil Makmur Fajar', 'Jl. Kali besar barat No. 50 A ', '021 6901885', '021 6929717', '-', '-'),
(39, 'ADVAN01', ' PT.Advansia Indotani', 'BSD City, Golden Road C.27/48', '-', '-', '-', '-'),
(40, 'ADVAN02', ' PT.Advanta Seeds Indonesia', 'Jakarta', '-', '-', '-', '-'),
(41, 'AGRIM01', ' PT.Agri Makmur Pertiwi', 'Surabaya', '-', '-', '-', '-'),
(42, 'AGRIC01', ' PT.Agricon', 'Jl. Siliwangi no. 68', '031 546 7312', '031 532 1101', '-', '-'),
(43, 'AGRIC02', ' PT.Agriculture Constraction Indonesia', 'Jl. Siliwangi No 68, Lawang Gintung', '0251-8313070', '-', '-', '-'),
(44, 'AGROD01', ' PT.Agro Dynamics Indo', 'Jl. Pelita Raya I Blok F No 20 Kim Star, Tanjung Morawa B,', '-', '-', '-', '-'),
(45, 'AGROG01', ' PT.Agro Guna Makmur', '-', '-', '-', '-', '-'),
(46, 'AGROL02', ' PT.Agro Lestari', '-', '-', '-', '-', '-'),
(47, 'AGRON01', ' PT.Agro Natural Technology', 'The Prominance 38D No. 41', '-', '-', '-', '-'),
(48, 'AGROI01', ' PT.Agroiris Crop Protection Indonesia', '-', '-', '-', '-', '-'),
(49, 'AGROM01', ' PT.Agromanna Jaya Lestari', 'Komplek Ruko Daan Mogot Baru Blok KJE No.39', '-', '-', '-', '-'),
(50, 'AGROT01', ' PT.Agrotech Pesticide Industry', 'Jakarta', '-', '-', '-', '-'),
(51, 'ALISH01', ' PT.Alishan Nusa Indah', 'Praban Wetan V/1', '031 5316941', '031 8288104', '-', '-'),
(52, 'ARENA01', ' PT.Arena Bio Agri', 'Bandung', '-', '-', '-', '-'),
(53, 'ARYST01', ' PT.Arysta Lifescience Tirta', 'Jl. Lengkong Kecil No. 46 Paledang Lengkong', '022 422 1188', '022 422 3377', '-', '-'),
(54, 'ASIAG01', ' PT.Asia Gala Kimia', '-', '-', '-', '-', '-'),
(55, 'JAGU01', ' PT.Asian Hybrid Seeds T. I', 'Jl. Wolter Monginsidi No.26, Desa Rowo Indah,Ajung', '0331-325566', '-', '-', '-'),
(56, 'ASIAN01', ' PT.Asiana Chemicalindo Lestari', '-', '-', '-', '-', '-'),
(57, 'BASFI01', ' PT.BASF Indonesia', '-', '-', '-', '-', '-'),
(58, 'BAYER01', ' PT.Bayer Indonesia', 'Mid Plaza I Jl. Jend. Sudirman Kav. 10-11', '021 570 3661', '021 5790 7062', '-', '-'),
(59, 'BEHNM01', ' PT.Behn Meyer AgriCare', 'Taman Tekno Blok B No. 1 BSD Sektor XI', '62-21-756 1000', '62-21-756 1038', '-', '-'),
(60, 'BEHNM02', ' PT.Behn Meyer Chemicals', 'Taman Tekno BSD Blok B1 Sektor XI Setu', '021 756 5000', '021 7560860', '-', '-'),
(61, 'BELIR01', ' PT.Belirang Kalisari', '-', '-', '-', '-', '-'),
(62, 'BENIH01', ' PT.Benih Citra Asia', 'Jl. Akmaludin No. 26 Po Box 26', '0331 323216', '0331 323603', '-', '-'),
(63, 'BERSA01', ' PT.Bersama Satu Teguh', '-', '-', '-', '-', '-'),
(64, 'BHUMI01', ' PT.Bhumi Nastari Suasti', '-', '-', '-', '-', '-'),
(65, 'BINAG01', ' PT.Bina Guna Kimia', 'Wisma Kodel Lt. 10 Jl. H. R. Rasuna Said Kav. B-4', '021 522 2350', '021 522 2365', '-', '-'),
(66, 'BINAN01', ' PT.Binangun Agro Lestari', 'KO. Ruko Mutiara Karawaci Blok F No. 11, RT 001 RW 003', '-', '-', '-', '-'),
(67, 'BIOAG01', ' PT.Bio Agritech Nusantara', '-', '-', '-', '-', '-'),
(68, 'BIOTE01', ' PT.Biotek Saranatama', '-', '021-7315577', '-', '-', '-'),
(69, 'BIOTI01', ' PT.Biotis Agrindo', '-', '-', '-', '-', '-'),
(70, 'BIOWO01', ' PT.Bioworld Biosciencen ML', '-', '-', '-', '-', '-'),
(71, 'BRANI01', ' PT.Branita Sandhini', 'Ruko Rungkut Megah Raya', '-', '-', '-', '-'),
(72, 'CATUR01', ' PT.Catur Agrodaya Mandiri', 'Gedung AIA Central Lt. 27, Jend. Sudirman Kav. 48-A, Karet Semanggi, Setiabudi, Jakarta Selatan, DKI Jakarta', '021 252 3393', '021 252 3394', '-', '-'),
(73, 'CENTA01', ' PT.Centa Brasindo Abadi', 'Intercon Plaza Blok A 4/27 Jl. Meruya Ilir', '021 587 1880', '021 586 8402', '-', '-'),
(74, 'CHAND01', ' PT.Chandra Asri Petrochemical Tbk', '-', '-', '-', '-', '-'),
(75, 'CORTE01', ' PT.Corteva Agriscience Indonesia', '-', '-', '-', '-', '-'),
(76, 'CORTE02', ' PT.Corteva Agriscience Seeds Indonesia', 'Gedung Cibis Nine Lt. 10, Cilandak Commercial Estate, Jl TB Simatupang No 2 RT 001 RW 005', '-', '-', '-', '-'),
(77, 'DALZO01', ' PT.Dalzon Chemicals Indonesia', '-', '-', '-', '-', '-'),
(78, 'DANKE01', ' PT.Danken Indonesia', 'Central Park APL Tower 6th Floor T2', '021-29339389', '021-29339390', '-', '-'),
(79, 'DELIS01', ' PT.Deli Standart', 'Jakarta', '-', '-', '-', '-'),
(80, 'DELTA01', ' PT.Deltacipta Saranapromosi', '-', '-', '-', '-', '-'),
(81, 'DHARM03', ' PT.Dharma Ayu Tani', '-', '-', '-', '-', '-'),
(82, 'DOWAG01', ' PT.Dow Agro Sciences Ind', 'Wisma GKBI Lt. 20 Suite 2001 Jl. Jend. Sudirman No. 28', '021 575 9332', '021 572 7067', '-', '-'),
(83, 'DUPON01', ' PT.Dupont Agricultural Product Indonesia', 'Beltway Office Park Gedung A Lt 5 & 6, Jl. Ampera Raya No. 9-10', '-', '-', '-', '-'),
(84, 'DYRIZ01', ' PT.Dyriz Indonesia', '-', '-', '-', '-', '-'),
(85, 'EASTW01', ' PT.East West Seed Indonesia', 'Purwakarta', '-', '-', '-', '-'),
(86, 'ERATA01', ' PT.Era Tani', 'Jl. Pinangsia Timur No. 2-R', '021 624 3435', '021 659 8509', '-', '-'),
(87, 'ETONG01', ' PT.Etong Chemical Indonesia', '-', '-', '-', '-', '-'),
(88, 'EXCEL01', ' PT.Excel Meg Indo', 'Jl. Angkasa Kav. B6, Blok D2', '-', '-', '-', '-'),
(89, 'EXIND01', ' PT.Exindo Raharja Pratama', '-', '-', '-', '-', '-'),
(90, 'FARMC01', ' PT.Farmco Kimia', 'Gedung Graha Pena, Unit 806', '-', '-', '-', '-'),
(91, 'FMCAG01', ' PT.FMC Agricultural Manufacturing', 'Gedung BEI Tower I Suite 1601', '-', '-', '-', '-'),
(92, 'FORUM02', ' PT.Forum Agro Sukses Timur', 'Jl. Majapahit AD-10', '-', '-', '-', '-'),
(93, 'FORUM01', ' PT.Forum Bintang Perkasa', 'Jl. Jemursari 236 Kav 7', '031 849 0751', '031 849 0752', '-', '-'),
(94, 'GLOBA01', ' PT.Global Agrotech', 'Jl. Raya Kamal-Lingkar Luar-Taman Palem Lestari Blok C5/30', '-', '-', '-', '-'),
(95, 'GOLDE01', ' PT.Golden Agin I', '-', '-', '-', '-', '-'),
(96, 'GOLDE02', ' PT.Golden Planter Indonesia', 'Jl. Malabar A/09 Ruko Mas Naga', '021 8853661', '-', '-', '-'),
(97, 'GREEN01', ' PT.Green Apple Indonesia', 'Menara Imperium 20th Floor, Suite C', '021 83792563', '021 83792782', '-', '-'),
(98, 'GREEN02', ' PT.Greentech International', 'Jl. Kebon Sirih Barat No. 3, Kel. Kebon Sirih, Kec. Menteng, Kota Adiministrasi', '-', '-', '-', '-'),
(99, 'HEXTA03', ' PT.Hextar Chemical Indonesia', '-', '-', '-', '-', '-'),
(100, 'HEXTA01', ' PT.Hextar Fertilizer Indonesia', 'Surabaya', '031 398 9436', '-', '-', '-'),
(101, 'HEXTA02', ' PT.Hextar Seed Indonesia', 'Jl. Batu Ceper No. 87A', '-', '-', '-', '-'),
(102, 'IMTAS01', ' PT.Imta Sukses Abadi', '-', '-', '-', '-', '-'),
(103, 'INDAG01', ' PT.Indagro', 'Jakarta', '-', '-', '-', '-'),
(104, 'INDOA01', ' PT.Indo Acidatama Tbk', 'Rukan Artha Gading Niaga Blok E No. 2, Kelapa Gading Barat', '-', '-', '-', '-'),
(105, 'INDOG01', ' PT.Indo Global Trade', '-', '-', '-', '-', '-'),
(106, 'INDOI01', ' PT.Indoin Business Group', 'Palma One Building, 7th FL, Suite 718', '-', '-', '-', '-'),
(107, 'INDOT02', ' PT.Indotani', '-', '-', '-', '-', '-'),
(108, 'INKOS01', ' PT.Inko Seed Makmur', 'Bandung', '-', '-', '-', '-'),
(109, 'INTER01', ' PT.Inter Agro Indonesia', '-', '-', '-', '-', '-'),
(110, 'JAFRA01', ' PT.Jafran Indonesia', 'Jl. Doho Blok II/3 Perum Bukit Permai RT.004 RW.029', '-', '-', '-', '-'),
(111, 'JAVAK01', ' PT.Java Karlos Indonesia', 'Jl. Zentana No. 88 Ngijo,Karangploso-Malang', '-', '-', '-', '-'),
(112, 'JAVAS01', ' PT.Java Seeds Indonesia', 'Perkantoran Kencana Niaga', '021 5858877', '021 5858834', '-', '-'),
(113, 'JAWAA01', ' PT.Jawa Agrindo Internasional', '-', '-', '-', '-', '-'),
(114, 'JOHNN01', ' PT.Johnny Jaya Makmur', 'Jl. Agung Utara I Blok A2 No. 28', '021 65307518', '021 65307517', '-', '-'),
(115, 'KALAT01', ' PT.Kalatham', 'Jakarta', '-', '-', '-', '-'),
(116, 'KARIS04', ' PT.Karisma Indoagro Universal', 'Imam Bonjol No. 45', '-', '-', '-', '-'),
(117, 'KARUN03', ' PT.Karunia Sukses Utama', '-', '-', '-', '-', '-'),
(118, 'KENSO01', ' PT.Kenso Indonesia', '-', '-', '-', '-', '-'),
(119, 'KERTO01', ' PT.Kertopaten Kencana', 'Jl. Ambengan No. 20', '031 3762888', '031 3718436', '-', '-'),
(120, 'KORE01', ' PT.Koreana Seed Indonesia', 'Dsn. Bendorejo Tawang Wates ', '0354-442614', '0354-442533', '-', '-'),
(121, 'KRIST01', ' PT.Kristalindo Karunia Internasional', 'Kelapa Puan Raya Blok CA No. 15 Gading Serpong', '-', '-', '-', '-'),
(122, 'LANGG02', ' PT.Langgeng Mustika Chemindo', '-', '-', '-', '-', '-'),
(123, 'LEMSI01', ' PT.Lemsi Triguna Abadi', '-', '-', '-', '-', '-'),
(124, 'MAJUM01', ' PT.Maju Makmur Utomo', 'Jl. Agung Utara I Blok A2, No. 28 Sunter Agung Podomoro Jakarta Utara- 14350', '021-65307518', '-', '-', '-'),
(125, 'MANUN03', ' PT.Manunggal Alam Sentosa', 'Balung', '-', '-', '-', '-'),
(126, 'MESTI02', ' PT.Mest Indonesiy', 'Jl. Tengku Amir Hamzah No 2 ( Simpang Karya )', '-', '-', '-', '-'),
(127, 'MESTI01', ' PT.Mestika Karunia Utama', '-', '-', '-', '-', '-'),
(128, 'MIOCH01', ' PT.Miochem Winner Indonesia', '-', '-', '-', '-', '-'),
(129, 'MIRAD', ' PT.Mirado Abadi', 'Jl. Raya Arjuna 148-B', '-', '-', '-', '-'),
(130, 'MITOK01', ' PT.Mitoku Sukses Makmur', '-', '-', '-', '-', '-'),
(131, 'MITRA26', ' PT.Mitra Artha Sejati', 'Komp. Griya Cikotra Blok E 1, Cikotra', '-', '-', '-', '-'),
(132, 'MITRA09', ' PT.Mitra Indotani Abadi', 'Jl. Semeru No. 89 RT 001 RW 004 Ajung', '-', '-', '-', '-'),
(133, 'MITRA01', ' PT.Mitra Kreasi Dharma', 'Wisma UIC Lt. 4 Jl. Jend. Gatot Subroto 6-7', '031 329 8150', '031 329 8150', '-', '-'),
(134, 'MUKTI01', ' PT.Mukti Jaya Agro', 'Jl. Patriot 8/11 RT/RW 05/12', '-', '-', '-', '-'),
(135, 'MULTI05', ' PT.Multi Niaga Nusantara Indonesia', 'Soho Pancoran, Tower Splendor', '-', '-', '-', '-'),
(136, 'MULTI04', ' PT.Multidaya Putra Sejahtera', 'Jl. Raya Meduran No. 153, Manyar', '-', '-', '-', '-'),
(137, 'MURNI01', ' PT.Murni Mapan Makmur', 'Jl. Raya Purwosari km 2,8', '-', '-', '-', '-'),
(138, 'MUTUP01', ' PT.Mutu Prima Sejati', '-', '0354-683 631', '-', '-', '-'),
(139, 'NATHA01', ' PT.Nathani Indonesia', 'Perancis Raya No. 188 Tangerang', '-', '-', '-', '-'),
(140, 'NUFAR01', ' PT.Nufarm Indonesia', 'Plaza Aminta SUite 802, 8th Floor', '021 7590 4844', '021 7590 4846', '-', '-'),
(141, 'NUSAM01', ' PT.Nusa Mandiri Utama', 'Mega Plaza Building 3rd Floor', '-', '-', '-', '-'),
(142, 'OATMI01', ' PT.Oat Mitoku Agrio', '-', '-', '-', '-', '-'),
(143, 'ORIEN01', ' PT.Oriental Seed Indonesia', 'Dsn. Kamal RT02 RW 04 Pagersari, Mungkid', '0293-782450', '0293-782436', '-', '-'),
(144, 'PANEN03', ' PT.Panen Agro Perkasa Indonesia', '-', '-', '-', '-', '-'),
(145, 'PERSA01', ' PT.Persada Agro Sukses', '-', '-', '-', '-', '-'),
(146, 'PETRO03', ' PT.Petrokimia Gresik', 'Jl. A. Yani', '-', '-', '-', '-'),
(147, 'PETRO01', ' PT.Petrokimia Kayaku', 'Jl. Jend A Yani', '031 3981815', '031 3975979', '-', '-'),
(148, 'PETRO02', ' PT.Petrosida Gresik', 'Jl. Ahmad Yani ', '031 398 7909', '031 398 2761', '-', '-'),
(149, 'PLANT01', ' PT.Plant Power Seed', '-', '-', '-', '-', '-'),
(150, 'PRIMA02', ' PT.Prima Jaya', 'Jl. H. Agus Salim 141', '0351 451 898', '-', '-', '-'),
(151, 'PRIMA03', ' PT.Prima Karya Berjaya', 'Jl. Jembatan Dua Raya No. 11-I', '021 6693759', '021 6695965', '-', '-'),
(152, 'PUPUK01', ' PT.Pupuk Kaltim', '-', '-', '-', '-', '-'),
(153, 'PUPUK02', ' PT.Pupuk Kujang', 'Jl. Jend. A. Yani No. 39 Cikampek', '-', '-', '-', '-'),
(154, 'RABAN01', ' PT.Rabana Agro Resources', '-', '-', '-', '-', '-'),
(155, 'RAGAM01', ' PT.Ragam Mandiri', 'Jl. Tri Dharma No. 6', '031 398 7323', '031 398 5323', '-', '-'),
(156, 'RAJAP01', ' PT.Raja Pilar Agrotama', 'Yogyakarta', '-', '-', '-', '-'),
(157, 'REJEK04', ' PT.Rejeki Indo Agrotec', '-', '-', '-', '-', '-'),
(158, 'ROLIM01', ' PT.Rolimex Kimia Nusamas', '-', '-', '-', '-', '-'),
(159, 'ROTAM01', ' PT.Rotam Indonesia', 'Jl. HR Rasuna Said, Kav. C-17, Kuningan', '-', '-', '-', '-'),
(160, 'ROYAL01', ' PT.Royal Agro Indonesia', 'Menara 165, 12A Floor, Unit B', '021 29406633', '021 29406634', '-', '-'),
(161, 'SAFEC01', ' PT.Safe Chemical Indonesia', '-', '-', '-', '-', '-'),
(162, 'SANIT01', ' PT.Sanitas', 'Jl. Yos Sudarso 43', '0231 221 585', '0231 204 562', '-', '-'),
(163, 'SANLE01', ' PT.Sanlex Malindo', '-', '-', '-', '-', '-'),
(164, 'SANTA02', ' PT.Santani Agro Perkasa', '-', '-', '-', '-', '-'),
(165, 'SANTA01', ' PT.Santani Sejahtera', '-', '-', '-', '-', '-'),
(166, 'SAPRO03', ' PT.Saprotan Utama Nusantara', 'Bangkong Plaza C-7', '-', '-', '-', '-'),
(167, 'SARAN08', ' PT.Sarana Tani Indonesia Makmur', '-', '-', '-', '-', '-'),
(168, 'SARIB01', ' PT.Sari Benih Unggul', 'Jl Raya Jemursari 79', '031 849 6206', '031 849 6009', '-', '-'),
(169, 'SARIK01', ' PT.Sari Kimia Unggul', 'Jl. Raya Jemursari 79', '031 849 6206', '031 849 6009', '-', '-'),
(170, 'SARIK02', ' PT.Sari Kresna Kimia', 'Jl Biak 1/B1', '021 6336338', '021 6326586', '-', '-'),
(171, 'SATYA01', ' PT.Satya Agro Indonesia', 'Komplek Semen Merah Putih Blok A No. 11', '021-82732083', '021-82732082', '-', '-'),
(172, 'SELEC01', ' PT.Selectani Hortikultur', '-', '-', '-', '-', '-'),
(173, 'SENTA01', ' PT.Sentana Adidaya Pratama', 'Gresik', '-', '-', '-', '-'),
(174, 'SHRIR01', ' PT.Shriram Seed Indonesia', '-', '-', '-', '-', '-'),
(175, 'SINAM01', ' PT.Sinamyang Indonesia', 'Floor 9 Suite A Perwata Tower', '-', '-', '-', '-'),
(176, 'SINAR01', ' PT.Sinar General Industries', 'Jakarta', '-', '-', '-', '-'),
(177, 'SINON01', ' PT.Sinon Indonesia', '-', '-', '-', '-', '-'),
(178, 'STARM01', ' PT.Star Metal Ware Industry', 'Jl. Kebayoran Lama, Gg. Kemandoran V/11', '021 5332070', '-', '-', '-'),
(179, 'SUMBE01', ' PT.Sumber Makmur Agrikultur Indonesia', 'Jl. Prof. Moh Yamin No. 53 Kav. 10-11', '0341-322607', '0341-326982', '-', '-'),
(180, 'SUMMA01', ' PT.Summa Agro Tech Perkasa', 'Nusa Loka, Sektor 14-15', '-', '-', '-', '-'),
(181, 'SURAB01', ' PT.Surabaya Perdana Rotopack', 'Jl. Tambak Sawah No. 19 Waru', '-', '-', '-', '-'),
(182, 'SURYA03', ' PT.Surya Berkah Plastindo', 'Jl. Raya Serang KM. 60 Kawasan Industri Pancatama KAv. 48', '0254 400384', '-', '-', '-'),
(183, 'SURYA02', ' PT.Surya Mandiri Sejahtera', 'Taman Ratu Indah C1 No. 37 Jakarta 11510', '021-5651207', '021-5651207/ 061-7864034', '-', '-'),
(184, 'SYNGE01', ' PT.Syngenta Indonesia', 'Gedung CIBIS Nine Lt. 6 Unit C#G, Jl TB Simatupang No. 2 RT 001 RW 005', '021 3042 1000', '021 8068 2838', '-', '-'),
(185, 'SYNGE02', ' PT.Syngenta Seed', 'Gedung CIBIS Nine Lt. 6 Unit C#G, Jl TB Simatupang No. 2 RT 001 RW 005', '021 3042 1000', '021 8068 2838', '-', '-'),
(186, 'SYUKU01', ' PT.Syukur Jamin Mulia', 'Komplek Cemara Hijau Blok FF No. 17', '-', '-', '-', '-'),
(187, 'TAKII01', ' PT.TakII Seed', '-', '-', '-', '-', '-'),
(188, 'TAKIR01', ' PT.Takiron Indonesia', 'Pasuruan', '0343 659060', '0343 659063', '-', '-'),
(189, 'TANIM27', ' PT.Tani Mas Subur', 'Sidoarjo', '-', '-', '-', '-'),
(190, 'TANIN01', ' PT.Tanindo Intertraco', 'Jl Raya Surabaya Mojokerto KM 19', '031 7882528', '031 7871131', '-', '-'),
(191, 'TIARA01', ' PT.Tiara Buana Mandiri', 'Jl. Jalur Sutra Barat No. 17 Alam Sutra', '021 378 28376', '-', '-', '-'),
(192, 'TIGAM01', ' PT.Tiga Muara Emas Makmur', 'Jl. Muara Karang Raya Blok Z 4 Selatan No. 22-23 RT.001 RW.003', '021-66606247', '021-66691645', '-', '-'),
(193, 'TIRTA03', ' PT.Tirta Agung Plastik', '-', '-', '-', '-', '-'),
(194, 'TOMAN01', ' PT.Tomang Plastindo Utama', 'Jakarta', '-', '-', '-', '-'),
(195, 'TRIUS01', ' PT.Tri Usaha Sejahtera Pratama', 'Jl. Raya Solo - Sragen, Km 21.2', '-', '-', '-', '-'),
(196, 'TRIDA01', ' PT.Trida Kimia Sakti', 'Jl. Tiang Bendera IV Selatan No. 17 - 19', '021 6900138', '021 6909630', '-', '-'),
(197, 'TRIMA01', ' PT.Trimarga Nusantara Indonesia', '-', '-', '-', '-', '-'),
(198, 'UTOMO01', ' PT.Utomo Utomo', 'Jl. Sunter Paradise Raya 2 Blok F-21 No. C-27', '-', '-', '-', '-'),
(199, 'WAHAN02', ' PT.Wahana Inti Selaras', 'Jl. MT Haryono Kav. 8 Bidara Cina, Jatinegara', '-', '-', '-', '-'),
(200, 'WAHAN01', ' PT.Wahana Pundhi Karsa Abadi', 'Jl. Pahlawan 5 Mayang ', '0331 592 818', '-', '-', '-'),
(201, 'WILMA01', ' PT.Wilmar Chemical Indonesia', 'Multivision Tower Lt. 12, Jl. Kuningan Mulia Kav. IX-B', '-', '-', '-', '-'),
(202, 'WONDER01', ' PT.Wonderindo Pharmatama', '-', '-', '-', '-', '-'),
(203, 'YASID01', ' PT.Yasida Makmur Abadi', '-', '-', '-', '-', '-'),
(204, 'ZEENE01', ' PT.Zeenex Agroscience Indonesia', 'HR Rasuna Said Kav. 62', '-', '-', '-', '-'),
(205, 'ZENIT01', ' PT.Zenith Cropsciences Indonesia', '18 Office Park Lt. 22 Unit EFG', '-', '-', '-', '-'),
(206, 'DELTR01', ' PT/ Sanitas.Deltragro Mulia Sejati', '-', '-', '-', '-', '-'),
(207, 'BISII01', ' Tbk.Bisi International', 'Jl. Surabaya Mojokerto KM 19,', '-', '-', '-', '-'),
(208, 'KELUD01', ' UD.Kelud Jaya', 'Mojokerto', '-', '-', '-', '-'),
(209, 'WIDJA01', ' UD.Widjaya', 'Jl. Kalijudan No. 47.49', '031 389 6476', '-', '-', '-'),
(210, 'AGRIM02', 'Agrimas Citra Mandiri', 'Ruko Sentra Taman Gapura G-16', '-', '-', '-', '-'),
(211, 'AGROS03', 'Agro Sejahtera Indonesia', 'Jakarta', '-', '-', '-', '-'),
(212, 'ANANG01', 'Anang Catur', 'Jember', '-', '-', '-', '-'),
(213, 'ANMDE01', 'ANM/Dermawan', 'Jakarta', '-', '-', '-', '-'),
(214, 'APPOL01', 'Appolo Star Plastik', 'Malang', '-', '-', '-', '-'),
(215, 'AURAS01', 'Aura Seed', 'Kediri', '-', '-', '-', '-'),
(216, 'CATUR03', 'Catur Manunggal Jaya Abadi', '-', '-', '-', '-', '-'),
(217, 'DITYA01', 'Ditya Chemindo', 'Kediri', '-', '-', '-', '-'),
(218, 'GADAS01', 'Gada Sakti Nusantara Bahari', '-', '-', '-', '-', '-'),
(219, 'JUNHO01', 'Jun Hok', '-', '(031) 3545828', '-', '-', '-'),
(220, 'KNOWY01', 'Know You Seeds', '-', '-', '-', '-', '-'),
(221, 'LANGG03', 'Langgeng Jaya Megabox', 'Jl. Kepatihan Industri ,Desa Gempol kurung', '25100080271', '-', '-', '-'),
(222, 'LILIS01', 'Lili Somantry', 'Jl. Raya Pangalengan No. 14 Pangalengan', '022-423 3155', '-', '-', '-'),
(223, 'MAKMU03', 'Makmur Sejahtera Nusantara', '-', '-', '-', '-', '-'),
(224, 'NUNTU01', 'Nuntun Tani', 'AKBP %R. Agil Kumadya ( Perum Jati Indah ) No. 121-122', '0291 434 856', '-', '-', '-'),
(225, 'PERTA01', 'Pertamina', '-', '-', '-', '-', '-'),
(226, 'PUTRA05', 'Putra Sejati Persada', '-', '-', '-', '-', '-'),
(227, 'REJEK01', 'Rejeki Plas', 'Surabaya', '-', '-', '-', '-'),
(228, 'SARAN01', 'Sarana Agro Lestari', 'Probolinggo', '-', '-', '-', '-'),
(229, 'SONGG03', 'Songgolangit Persada', '-', '-', '-', '-', '-'),
(230, 'SUKOT01', 'Suko Tani', 'Jl. Balung, Ds. Sukorejo, Kec. Bangsalsari', '-', '-', '-', '-'),
(231, 'TANIM01', 'CV Tani Murni Paskal', '-', '-', '-', '-', '-'),
(232, 'TUNAS04', 'Tunas Subur', 'Jl. Wolter Mongensidi 18', '-', '-', '-', '-'),
(233, 'WINON01', 'PT Winon International', '', '', '', '', '-'),
(234, 'TUNAS05', 'Tunas Harapan Murni, PT', 'Tangerang Selatan', '', '', '', ''),
(235, 'SONGG02', 'Songgolangit Persada - Surabaya', 'Surabaya', '', '', '', ''),
(236, 'SONGG01', 'Songgolangit Persada - Denpasar', 'Denpasar', '', '', '', ''),
(237, 'KHARI01', 'CV Kharisma Eka Putra', 'Jl. Mayor Unus No. 18 Punduhan RT 005 RW 001, Jogonegoro - Mertoyudan - Magelang 56172', '0293-3215959', '', '', ''),
(238, 'ANUGE01', 'Anugerah Agro Mandiri, PT', 'Jl. Muncar No. 228 RT 003 RW 009 Kebaman Srono, Banyuwangi', '', '', '', ''),
(239, 'SINER01', 'Sinergi Chem Indonesia, PT', '', '', '', '', ''),
(240, 'ALPHA01', 'Alphagrow, PT', '', '', '', '', ''),
(241, 'SURYA05', 'Surya Manunggal Agro Sejati, PT', 'Surabaya', '', '', '', ''),
(242, 'BAS01', 'Basindo, PT', '', '', '', 'ptbasindo@yahoo.com', ''),
(243, 'BERB01', 'Berbak Agro Sejati, PT', 'Sunrise Bizpark,\r\nJalan SS. C.51 -52 Kel. Kuta Jaya, Kec. Pasar Kemis\r\nTangerang-Banten', '', '', 'ptbasindo@yahoo.com', ''),
(244, 'SEAGR01', 'Sea Grow Indonesia, PT', 'Jl. Semeru 102, Sumbersari - Jember', '', '', '', ''),
(245, 'QNUSA01', 'Nusa Palapa Gemilang, PT', 'Jl. Raya Daendeles Km. 56, Desa Banyutengah, Kecamatan Panceng, Kabupaten Gresik', '031-3940440', '031-3940440', 'corporatesecretary@ptnpg.com', ''),
(246, 'JAYA01', 'Jaya Tani', 'Sukamandi, Subang-Jawa Barat', '', '', 'Vyalie17@gmail.com', ''),
(247, 'UPLIN01', 'UPL Indonesia, PT', 'Gedung AIA Central Lt. 27, Jend. Sudirman Kav. 48-A, Karet Semanggi, Setiabudi, Jakarta Selatan, DKI Jakarta', '', '', '', ''),
(248, 'INDOF01', 'PT. Indofert Subur Utama', '', '', '', '', ''),
(249, 'TEGUH03', 'PT. Teguh Satyakarsa', 'Jakarta', '', '', '', ''),
(250, 'RIZKY01', 'CV.Rizky Jaya', 'Magetan', '', '', '', ''),
(251, 'BERKA01', 'Berkah Tani Mukti, PT', '', '', '', '', ''),
(252, 'MEGA01', 'CV. Mega Jaya Semesta', 'Tasikmalaya', '', '', 'Megajayasemesta16@gmail.com', ''),
(253, 'SUMAN01', 'Sumans Mandiri Sejahtera, PT', 'Bogor', '(0251)-8326750', '(0251)-8326750', '', ''),
(254, 'BAY01', 'Bayer Seeds Indonesia, PT', 'Mid Plaza I Jl. Jend. Sudirman Kav. 10-11', '021 570 3661', '', '', ''),
(255, 'QTMM', 'PT. Tanaman Makmur Mandiri', 'Jl. DR. Ide Anak Agung Gde Agung Kav.E.1.2 No. 1&2 Jakarta-12950', '', '', 'info@tmmindo.com', ''),
(256, 'CV. Nuralifa Berniaga', '', 'Mekarjati No. 96 RT.003 RW.005 Kel. Pair Biru Kec. Cibiru Kota Bandung, Jawa Barat', '', '', '', ''),
(257, 'NUR01', 'CV. Nuralifa Berniaga', 'Mekarjati No. 96 RT. 003 RW. 005 Kel. Pasirbiru Kec. Pasirbiru Kota Bandung Jawa Barat', '', '', '', ''),
(258, '', 'Culture Agritech Interzona, PT', 'Purimas jl legian paradise H 10-11 gunung anyar, gunung anyar, kota  surabaya', '', '', '', ''),
(259, 'CULTU01', 'Culture Agritech Interzona', 'Purimas jl legian paradise H 10-11 gunung anyar, gunung anyar, kota  surabaya', '', '', '', ''),
(260, 'AGROR01', 'Agrorisen Indomakmur Cemerlang, PT', 'Jl. Raya Mojosari Trawas KM3.99, Pungging, Mojokerto', '', '', '', ''),
(261, 'EDYKI01', 'Edy Kia', '', '', '', '', ''),
(262, 'RESTU04', 'RESTU AGROPRO JAYAMAS, PT', '', '', '', '', ''),
(263, 'REST01', 'Restu Agropro Jayamas, PT', 'JALAN PERMATA HIJAU CC 123 NOMOR 07, Kel. Kuningan, Kec. Semarang Utara, Kota Semarang, Provinsi Jawa Tengah 50176', '0812-3453-7772', '', 'yudha_hermawanto@restusejati.com', ''),
(264, 'SAF03', 'Safeeko Bio Indonesia, PT', 'My Republic Plaza, Wing A, Zona 6, Green Office Park. Jl. Bsd Grand Boulevard, Bsd City, Desa/Kelurahan Sampora, Kec. Cisauk, Kab. Tangerang, Provinsi Banten, 15345', '', '', '', ''),
(265, 'SAF04', 'PT. Safeeko Bio Indonesia', 'My Republic Plaza, Wing A, Zona 6, Green Office Park. Jl. Bsd Grand Boulevard, Bsd City, Desa/Kelurahan Sampora, Kec. Cisauk, Kab. Tangerang, Provinsi Banten, 15345', '', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_suplier`
--
ALTER TABLE `tb_suplier`
  ADD PRIMARY KEY (`id_suplier`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_suplier`
--
ALTER TABLE `tb_suplier`
  MODIFY `id_suplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=266;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
